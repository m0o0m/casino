<?

class beowulfCtrl extends Ctrl {
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
        $betAttr = (array) $request->Bet;
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['stake'];
        $pick = substr($betAttr['pick'], 1);

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake, 10/12);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $payType = 'standart';

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'GRENDEL':
                $payType = 'bonus';
                $this->showGrendelReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FS':
                $payType = 'free';
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, $payType);
    }

    protected function getSpinData() {
        $this->slot->drawID = -1;
        $respin = false;

        $bonusWin = 0;

        $bonusCount = 0;

        $bonus = array();

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(2,17,37,10,0),
                    );
                    break;
                case 'fs4':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(2,17,37,68,0),
                    );
                    break;
                case 'fs5':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(2,17,37,68,32),
                    );
                    break;
            }
        }

        if(rnd(1, $this->gameParams->grendelConfig['chance']) == 1) {
            $bonusCount++;
            $this->slot->setReels($this->gameParams->reels[3]);
            $this->slot->setWilds(array(0,18));

            $wildsCount = $this->gameParams->grendelConfig['wildsCountRange'][$this->getRandParam($this->gameParams->grendelConfig['wildsCountChance'])];

            $report = $this->slot->spin(array(
                'type' => 'randomWildsOnPos',
                'positions' => array(0,1,2,3,5,6,7,8,10,11,12,13),
                'wildSymbol' => 18,
                'wildsCount' => $wildsCount,
            ));
            $report['type'] = 'GRENDEL';

            $report['bonusData']['symbolInfo'] = $this->slot->getSymbolAnyCount('Q');

            $report['mask'] = '';

            $maskArray = array();
            for($i = 0; $i < 15; $i++) {
                if(in_array($i, $report['bonusData']['wildsOffsets'])) {
                    $maskArray[] = 1;
                }
                else {
                    $maskArray[] = 0;
                }
            }

            $m1 = array_slice($maskArray, 0, 5);
            $m2 = array_slice($maskArray, 5,5);
            $m3 = array_slice($maskArray, 10, 5);

            $report['mask'] = implode(',', $m1).';'.implode(',', $m2).';'.implode(',', $m3);

            $this->getGrendelData($report);
            $bonusWin = $this->bonus['bonusWin'];
        }
        else {
            $report = $this->slot->spin($bonus);
            $report['type'] = 'SPIN';
        }




        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $bonusCount++;

            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['type'] = 'FS';

            $this->getFreeSpinData($report);

            $bonusWin = $this->bonus['bonusWin'];
        }

        if($bonusCount > 1) {
            $respin = true;
        }

        $totalWin = $report['totalWin'] + $bonusWin;

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                '.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        if($totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    protected function getGrendelData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $spins = $report['bonusData']['symbolInfo']['count'];

        $this->slot->setReels($this->gameParams->reels[4]);
        $this->slot->setWilds(array(18,0));

        $draws = '';

        while($spins > 0) {
            $rReport = $this->slot->spin(array(
                'type' => 'wildsOnPos',
                'offsets' => $report['bonusData']['wildsOffsets'],
                'wildSymbol' => 18,
            ));

            $this->bonus['bonusWin'] += $rReport['totalWin'];
            $this->bonus['totalWin'] += $rReport['totalWin'];

            $addString = ' mask="'.$report['mask'].'" reelsetName="GrendelRespin"';

            $winLines = $this->getWinLinesData($rReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'reelset' => 4,
                'addString' => $addString,
                'spins' => $report['bonusData']['symbolInfo']['count'],
                'currentSpins' => 0,
            ));

            $draws .= '<DrawState drawId="'.$this->slot->drawID.'">' . $winLines . '
                    <ReplayInfo foItems="' . $rReport['stops'] . '"/>
                </DrawState>';

            $spins--;
        }

        $this->bonus['drawStates'] = $draws;

    }

    protected function showGrendelReport($report, $totalWin) {
        $bonus = '<Bonus offsets="" prize="grendelAttack" length="0" payout="'.$this->bonus['bonusWin'].'" />
                <Features><Feature name="GrendelAttack" awardedRespins="'.$report['bonusData']['symbolInfo']['count'].'" mask="'.$report['mask'].'" /></Features>';

        $addString = ' reelsetName="GrendelTrigger"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'reelset' => 3,
            'addString' => $addString,
            'spins' => $report['bonusData']['symbolInfo']['count'],
            'currentSpins' => $report['bonusData']['symbolInfo']['count'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>'.$this->bonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

    protected function getFreeSpinData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $this->slot->setWilds(array(0,2,3,19));
        $grendelLife = 5;
        $beowulfLife = 5;

        $spinsWithOutWD = $report['scattersReport']['count'];

        $bonusSpins = 0;

        $swordOffsets = array();

        $bonusAwarded = false;

        $draws = '';

        while(($grendelLife > 0 && $beowulfLife > 0) || $bonusSpins > 0) {
            if($spinsWithOutWD > 0 || $bonusSpins > 0) {
                $reelset = 1;
                $spinsWithOutWD--;
                $bonusSpins--;
            }
            else {
                $reelset = 2;
            }
            $this->slot->setReels($this->gameParams->reels[$reelset]);

            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'wildsOnPos',
                    'offsets' => $swordOffsets,
                    'wildSymbol' => 2,
                ),
                array(
                    'type' => 'wildReelsIfSymbol',
                    'symbol' => 'O',
                    'offsets' => $swordOffsets,
                    'wildSymbol' => 19,
                    'symbolIfEmpty' => 'N',
                    'cancelIfLess' => $grendelLife,
                ),
            ));

            $swordInfo = $this->slot->getSymbolAnyCount('N');
            $noInSword = array_diff($fsReport['bonusData']['changedOffsets'], $swordOffsets);
            $newOffsets = array_diff($swordInfo['offsets'], $swordOffsets);
            $wsAwarded = count($newOffsets) + count($noInSword);
            $grendelLife -= $wsAwarded;
            if($grendelLife < 0) $grendelLife = 0;



            $tmpOffsets = array();
            foreach($swordOffsets as $o) {
                if(in_array($o, $fsReport['bonusData']['changedOffsets'])) {

                }
                else {
                    $tmpOffsets[] = $o;
                }
            }
            foreach($newOffsets as $o) {
                if(in_array($o, $fsReport['bonusData']['changedOffsets'])) {

                }
                else {
                    $tmpOffsets[] = $o;
                }
            }
            if(count($swordOffsets) > 0) {
                foreach($noInSword as $o) {
                    $tmpOffsets[] = $o;
                }
            }

            $swordOffsets = $tmpOffsets;

            $grendelInfo = $this->slot->getSymbolAnyCount('O');
            if($grendelLife > 0) {
                $beowulfLife -= $grendelInfo['count'];
                if($beowulfLife < 0) $beowulfLife = 0;
            }

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            if($reelset == 1) {
                $addString = ' reelsetName="FreeSpinsNoWD"';
            }
            else {
                $addString = ' reelsetName="FreeSpin"';
            }
            if($bonusSpins >= 0) {
                $bonus = '<Features><Feature name="GrendelPostFight" wsAwarded="'.$wsAwarded.'" wsOffsets="'.implode(',', $swordOffsets).'" /></Features>';
            }
            else {
                $bonus = '<Features><Feature name="GrendelFight" grendelLife="'.$grendelLife.'" beowulfLife="'.$beowulfLife.'" wsAwarded="'.$wsAwarded.'" wdAwarded="'.$grendelInfo['count'].'" wsOffsets="'.implode(',', $swordOffsets).'" /></Features>';
            }


            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'reelset' => $reelset,
                'addString' => $addString,
                'spins' => '{{count}}',
                'currentSpins' => $this->slot->drawID + 1,
            ));

            $draws.= '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            if($grendelLife == 0 && $beowulfLife > 0 && !$bonusAwarded) {
                $bonusSpins = 3;
                $bonusAwarded = true;
            }
        }

        $draws = str_replace('{{count}}', $this->slot->drawID + 1, $draws);
        $this->bonus['drawStates'] = $draws;
    }

    protected function showFreeSpinReport($report, $totalWin) {
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" spins="1" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$report['scattersReport']['totalWin'].'" />';

        $addString = ' reelsetName="Base"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'addString' => $addString,
            'currentSpins' => 1,
            'spins' => $this->slot->drawID + 1,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>'.$this->bonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

}