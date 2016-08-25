<?

class big_bad_wolfCtrl extends Ctrl {
    public $useSessionBet = true;

    protected function startInit($request) {
        if(empty($_SESSION['drawStates'])) {
            $draws = '<DrawState drawId="0"/>';
        }
        else {
            $gDraw = '';
            try {
                $gDraw = gzuncompress(base64_decode($_SESSION['drawStates']));
            }
            catch (Exception $e) {

            }
            if(!empty($_SESSION['savedState'])) {
                $savedState = '';
                foreach($_SESSION['savedState'] as $key=>$val) {
                    $savedState .= $val;
                }
                $draws = $savedState.$gDraw;
            }
            else $draws = $gDraw;
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        '.$draws.'
    </EEGOpenGameResponse>
    '.$this->gameParams->getReels().$this->gameParams->getWinLines().$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse></CompositeResponse>';

        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $this->level = 0;
        $betAttr = (array) $request->Bet;
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['stake'];
        $pick = substr($betAttr['pick'], 1);

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->setCtrl($this);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $this->slot->setDefaultReels();
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report'][0]['baseSpinWin'],
            'report' => $spinData['report'][0],
        );

        $this->showSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $this->slot->setWilds($this->gameParams->wild);
        $this->slot->setReels($this->gameParams->reels[0]);
        $this->slot->drawID = -1;
        $this->slot->setBonus(array());
        $this->fsBonus = array();

        $reports = array();

        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';
        $report['rsName'] = 'Base';

        if($report['scattersReport']['count'] >= 3) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            $this->getFreeSpinBonus($report, $report['totalWin']);
            $totalWin = $this->fsBonus['totalWin'];
            $report['addDraws'] = $this->fsBonus['drawStates'];
            $this->slot->drawID = $this->fsBonus['lastDraw'];
        }
        else {
            $totalWin = $report['totalWin'];
        }

        $report['runningTotal'] = $report['totalWin'];
        $report['baseSpinWin'] = $report['spinWin'];

        $reports[] = $report;

        if(!empty($report['winLines']) || $report['scattersReport']['count'] >= 3) {
            $this->slot->setBonus(array(
                'type' => 'stepWild',
                'steps' => $this->gameParams->stepWildConfig,
            ));
            $w = $report['winLines'];
            $s = $report['scattersReport']['count'];
            $r = $report;
            $stageCount = 0;
            while(!empty($w) || $s >= 3) {
                $this->slot->startAvalanche($r);
                $r = $this->slot->getReport();
                $r['type'] = 'AVALANCHE';
                $r['rsName'] = 'Base';
                $r['trigger'] = $report['drawID'];
                $r['stage'] = $stageCount;
                $r['scattersReport'] = $this->slot->getScattersCount();

                $preTotal = $totalWin;
                if($r['scattersReport']['count'] >= 3) {
                    $r['scattersReport']['totalWin'] = $r['bet'] * $this->gameParams->scatterMultiple[$r['scattersReport']['count']];
                    $r['totalWin'] += $r['scattersReport']['totalWin'];
                    $this->getFreeSpinBonus($r, $preTotal + $r['totalWin']);
                    $totalWin = $this->fsBonus['totalWin'];
                    $r['addDraws'] = $this->fsBonus['drawStates'];
                    $this->slot->drawID = $this->fsBonus['lastDraw'];
                }
                else {
                    $totalWin += $r['totalWin'];
                    $r['addDraws'] = '';
                }

                $w = $r['winLines'];
                $s = $r['scattersReport']['count'];


                $r['runningTotal'] = $preTotal + $r['totalWin'];

                $this->fsPays[] = array(
                    'win' => $r['totalWin'],
                    'report' => $r,
                );

                $reports[] = $r;
                $stageCount++;
            }
        }

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if(empty($this->fsBonus)) $respin = true;
                    if(!empty($this->fsBonus)) {
                        if(!$this->fsBonus['addSpins']) $respin = true;
                    }
                    break;
                case 'avalanche':
                    if(count($reports) < 2) $respin = true;
                    break;
            }
        }



        return array(
            'totalWin' => $totalWin,
            'report' => $reports,
            'respin' => $respin,
        );
    }

    protected function getDraws($report, $totalWin) {
        $draw = '';
        switch($report['type']) {
            case 'SPIN':
                $draw = $this->getSpinDraw($report, $totalWin);
                break;
            case 'AVALANCHE':
                $draw = $this->getAvalancheDraw($report, $totalWin);
                break;
        }
        return $draw;
    }

    protected function getSpinDraw($report, $totalWin) {
        $spins = 0;
        $bonus = '';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" spins="10" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            $spins = 10;
        }
        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['runningTotal'],
            'spins' => $spins,
            'bonus' => $bonus,
            'addString' => ' payout="'.$report['totalWin'].'" rsName="'.$report['rsName'].'" multiplier="'.$report['double'].'"',
            'currentSpins' => '{{count}}',
        ));

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawState = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>'.$report['addDraws'];

        return $drawState;
    }

    protected function getAvalancheDraw($report, $totalWin) {
        $spins = 0;
        $bonus = '';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" spins="10" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            $spins = 10;
        }
        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['runningTotal'],
            'spins' => $spins,
            'bonus' => $bonus,
            'addString' => ' payout="'.$report['totalWin'].'" rsName="'.$report['rsName'].'" multiplier="'.$report['double'].'"',
            'currentSpins' => '{{count}}',
        ));

        $drawState = '<DrawState drawId="'.$report['drawID'].'" avalancheStage="'.$report['stage'].'" triggeringDraw="'.$report['trigger'].'">'
            .$winLines.'</DrawState>'.$report['addDraws'];

        return $drawState;
    }

    protected function showSpinReport($reports, $totalWin) {
        $draws = '';
        foreach($reports as $report) {
            $draws .= $this->getDraws($report, $totalWin);
        }

        $draws = str_replace('{{count}}', $this->slot->drawID, $draws);

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                '.$draws.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($draws, 9));
        $_SESSION['bonusWIN'] = $totalWin;
    }

    protected function getFreeSpinBonus($report, $totalWin) {
        $startWin = $totalWin;

        $this->fsBonus['totalWin'] = $totalWin;
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $lastDraw = $this->slot->drawID;

        $slot = new Slot($this->gameParams, $report['linesCount'], $report['bet']);
        $slot->drawID = $lastDraw;

        $fsCount = 10;
        $totalFS = 10;

        $fsTrigger = $report['drawID'];

        $reelset = 1;
        $multiple = 1;

        $moons = 0;
        $level = 0;

        $p1Payd = false;
        $p2Payd = false;

        $addSpins = false;

        while($fsCount > 0) {
            $spins = 0;
            $added = 0;
            $canAvalanche = true;
            $slot->setReels($this->gameParams->reels[$reelset]);
            $slot->setWilds($this->gameParams->wild);

            $report = $slot->spin(array(
                'type' => 'multipleByLevel',
                'increaseSymbol' => 'J',
                'currentLevel' => $moons,
                'steps' => array(
                    '6' => 2,
                ),
            ));
            $report['scattersReport'] = $slot->getScattersCount();
            $report['type'] = 'SPIN';
            $report['rsName'] = 'FreeSpin';


            $addOffset = array();
            $mR = $slot->getSymbolAnyCount('J');
            if($mR['count'] > 0) {
                $addOffset = $mR['offsets'];
                $moons++;
                $added = 1;
                if($moons > 2 && !$p1Payd) {
                    $canAvalanche = false;
                    $level = $reelset = $multiple = 1;
                    $spins = 2;
                    $fsCount += 2;
                    $totalFS += 2;
                    $p1Payd = true;
                }
                if($moons > 5 && !$p2Payd) {
                    $canAvalanche = false;
                    $fsCount += 2;
                    $totalFS += 2;
                    $level = 2;
                    $spins = 2;
                    $reelset = 2;
                    $multiple = 2;
                    $p2Payd = true;
                }
            }

            $bonus = '';
            if($report['scattersReport']['count'] >= 3) {
                $addSpins = true;
                $fsCount += 10;
                $totalFS += 10;
                $spins += 10;
                $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $sr = $report['scattersReport'];
                $bonus = '<Scatter spins="10" offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }



            $this->fsBonus['totalWin'] += $report['totalWin'];

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );

            $report['runningTotal'] = $this->fsBonus['totalWin'];

            /* ----------------- */

            $bonus .= '<Features>
                    <Feature name="ladder" value="'.$moons.'" level="'.$level.'" spins="'.$spins.'" added="'.$added.'" multiplier="'.$multiple.'" />
                </Features>';

            $winLines = $this->getWinLinesData($report, array(
                'runningTotal' => $report['runningTotal'],
                'bonus' => $bonus,
                'reelset' => $reelset,
                'spins' => $spins,
                'addString' => ' payout="'.$report['totalWin'].'" rsName="'.$report['rsName'].'" multiplier="'.$report['double'].'"',
                'currentSpins' => '{{count}}',
            ));

            $draw = '<DrawState fsLeft="'.$fsCount.'" drawId="'.$report['drawID'].'" fsBaseDraw="0" fsTriggeringDraw="'.$fsTrigger.'">
            '.$winLines.'
            <ReplayInfo foItems="'.$report['stops'].'" />
        </DrawState>';

            $this->fsBonus['drawStates'] .= $draw;
            $lastDraw = $report['drawID'];

            /* ----------------- */

            if((!empty($report['winLines']) || $report['scattersReport']['count'] >= 3 || !empty($addOffset))) {
                $slot->setBonus(array(
                    array(
                    'type' => 'stepWild',
                    'steps' => $this->gameParams->stepWildConfig,
                    ),
                    array(
                        'type' => 'multipleByLevel',
                        'increaseSymbol' => 'J',
                        'currentLevel' => $moons,
                        'steps' => array(
                            '6' => 2,
                        ),
                    )
                ));
                $w = $report['winLines'];
                $s = $report['scattersReport']['count'];
                $aO = !empty($addOffset);
                $r = $report;
                $stageCount = 0;
                while((!empty($w) || $s >= 3 || $aO)) {
                    $spins = 0;
                    $added = 0;
                    $slot->startAvalanche($r, $addOffset);
                    $r = $slot->getReport();
                    $r['type'] = 'AVALANCHE';
                    $r['rsName'] = 'FreeSpin';
                    $r['trigger'] = $report['drawID'];
                    $r['stage'] = $stageCount;
                    $r['scattersReport'] = $slot->getScattersCount();

                    $bonus = '';

                    $mR = $slot->getSymbolAnyCount('J');
                    if($mR['count'] > 0) {
                        $addOffset = $mR['offsets'];
                        $moons++;
                        $added = 1;
                        if($moons > 2 && !$p1Payd) {
                            $canAvalanche = false;
                            $level = $reelset = $multiple = 1;
                            $spins = 2;
                            $fsCount += 2;
                            $totalFS += 2;
                            $p1Payd = true;
                        }
                        if($moons > 5 && !$p2Payd) {
                            $canAvalanche = false;
                            $fsCount += 2;
                            $totalFS += 2;
                            $level = 2;
                            $spins = 2;
                            $reelset = 2;
                            $multiple = 2;
                            $p2Payd = true;
                        }
                    }
                    else {
                        $addOffset = array();
                    }

                    if($r['scattersReport']['count'] >= 3) {
                        $r['scattersReport']['totalWin'] = $r['bet'] * $this->gameParams->scatterMultiple[$r['scattersReport']['count']];
                        $r['totalWin'] += $r['scattersReport']['totalWin'];
                        $sr = $r['scattersReport'];
                        $bonus = '<Scatter spins="10" offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
                        $fsCount += 10;
                        $totalFS += 10;
                        $spins += 10;
                        $addSpins = true;
                    }

                    $w = $r['winLines'];
                    $s = $r['scattersReport']['count'];
                    $this->fsBonus['totalWin'] += $r['totalWin'];

                    $this->fsPays[] = array(
                        'win' => $r['totalWin'],
                        'report' => $r,
                    );

                    $r['runningTotal'] = $this->fsBonus['totalWin'];
                    $stageCount++;

                    /* ----------------------- */

                    $bonus .= '<Features>
                    <Feature name="ladder" value="'.$moons.'" level="'.$level.'" spins="'.$spins.'" added="'.$added.'" multiplier="'.$multiple.'" />
                </Features>';

                    $winLines = $this->getWinLinesData($r, array(
                        'runningTotal' => $r['runningTotal'],
                        'bonus' => $bonus,
                        'spins' => $spins,
                        'reelset' => $reelset,
                        'addString' => ' payout="'.$r['totalWin'].'" rsName="'.$r['rsName'].'" multiplier="'.$r['double'].'"',
                        'currentSpins' => '{{count}}',
                    ));

                    $draw = '<DrawState drawId="'.$r['drawID'].'" avalancheStage="'.$r['stage'].'" triggeringDraw="'.$r['trigger'].'">'
                        .$winLines.'</DrawState>';

                    $this->fsBonus['drawStates'] .= $draw;
                    $lastDraw = $r['drawID'];
                    /* ----------------------- */
                    $aO = !empty($addOffset);
                }
            }

            $fsCount--;
        }

        $this->fsBonus['moons'] = $moons;
        $this->fsBonus['addSpins'] = $addSpins;
        $this->fsBonus['bonusWin'] = $this->fsBonus['totalWin'] - $startWin;
        $this->fsBonus['totalFS'] = $totalFS;
        $this->fsBonus['lastDraw'] = $lastDraw;

        $this->level = $level;
    }

}