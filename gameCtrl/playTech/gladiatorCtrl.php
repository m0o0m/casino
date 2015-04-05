<?

class gladiatorCtrl extends Ctrl {
    private $helmetBonus = array();
    private $coliseumBonus = array();

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
    '.$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse>
    '.$this->gameParams->getReels().'</CompositeResponse>';

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

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = $spinData['report']['spinWin'];

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                if($spinData['report']['helmetReport']['count'] >= 3) {
                }
                break;
            case 'COLISEUM':
                $this->showColiseumReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];

        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getColiseumBonus($report);
                $report['totalWin'] = $this->coliseumBonus['totalWin'];
                $report['type'] = 'COLISEUM';
            }
        }

        $report['helmetReport'] = $this->slot->getSymbolAnyCount('W');
        if($report['helmetReport']['count'] >= 3) {
            $this->getHelmetBonus($report);
            $report['totalWin'] = $this->helmetBonus['totalWin'];
        }

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'helmet':
                    if($report['helmetReport']['count'] < 3) $respin = true;
                    break;
            }
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        if($report['helmetReport']['count'] >= 3) {
            $bonus .= '<Feature name="SpecialFeature" payout="'.$this->helmetBonus['bonusWin'].'">
                    <Detail name="Mask" eventDescs="'.implode(',', $this->helmetBonus['alias']).'" payDescs="'.implode(',', $this->helmetBonus['payDesc']).'" payout="'.$this->helmetBonus['bonusWin'].'" />
                </Feature>';
        }
        $drawWin = (empty($this->helmetBonus['bonusWin'])) ? $report['totalWin'] : $totalWin - $this->helmetBonus['bonusWin'];

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'drawWin' => $drawWin,
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
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        if($report['helmetReport']['count'] >= 3 || $totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    private function getHelmetBonus($report, $mult = 1) {
        $bet = $report['bet'];
        $this->helmetBonus['totalWin'] = $report['totalWin'];
        $this->helmetBonus['payDesc'] = array();
        $this->helmetBonus['bonusWin'] = 0;
        $this->helmetBonus['alias'] = array();

        $bonusParam = $this->gameParams->helmetBonus;
        for($i = 0; $i < 9; $i++) {
            $rnd = $bonusParam['rand'][rnd(0, count($bonusParam['rand']) - 1)];
            $multiple = $bonusParam['multiple'][$rnd] * $mult;
            $this->helmetBonus['alias'][] = $bonusParam['alias'][$rnd];
            $win = $multiple * $bet;
            $this->helmetBonus['bonusWin'] += $win;
            $this->helmetBonus['payDesc'][] = $win;
        }
        $this->helmetBonus['totalWin'] += $this->helmetBonus['bonusWin'];

        $this->bonusPays[] = $this->helmetBonus['bonusWin'];
    }



    private function getColiseumBonus($report) {
        $this->coliseumBonus = array();
        $startWin = $report['totalWin'];

        $this->coliseumBonus['totalWin'] = $report['totalWin'];
        $this->coliseumBonus['bonusWin'] = 0;
        $this->coliseumBonus['drawStates'] = '';

        $bonusParams = $this->gameParams->coliseumBonus;

        $fsRnd1 = $this->getRandParam($bonusParams['fsCountRand']);
        $fsCount1 = $bonusParams['fsCount'][$fsRnd1];
        $fsRnd2 = $this->getRandParam($bonusParams['fsCountRand']);
        $fsCount2 = $bonusParams['fsCount'][$fsRnd2];
        $totalFS = $fsCount1 + $fsCount2;
        $this->coliseumBonus['startFsCount'] = $totalFS;
        $currentFsCount = $totalFS;
        $fsCounter = 0;

        $multiple1Rnd = $this->getRandParam($bonusParams['multipleRand']);
        $multiple1 = $bonusParams['multiple'][$multiple1Rnd];
        $multiple2Rnd = $this->getRandParam($bonusParams['multipleRand']);
        $multiple2 = $bonusParams['multiple'][$multiple2Rnd];
        $totalMultiple = $multiple1 + $multiple2;
        while($totalMultiple < 2 || $totalMultiple > 5) {
            $multiple1Rnd = $this->getRandParam($bonusParams['multipleRand']);
            $multiple1 = $bonusParams['multiple'][$multiple1Rnd];
            $multiple2Rnd = $this->getRandParam($bonusParams['multipleRand']);
            $multiple2 = $bonusParams['multiple'][$multiple2Rnd];
            $totalMultiple = $multiple1 + $multiple2;
        }
        $this->coliseumBonus['multiple'] = $totalMultiple;

        $extraWild = 'null';

        $extraScatter = 'null';
        if(rnd(1, $bonusParams['extraScatterChance']) == $bonusParams['extraScatterChance']) {
            $extraScatter = $this->getRandParam($bonusParams['extraScatterSymbols']);
        }
        // Если выпал дополнительный скаттер, то может выпасть дополнительный вайлд
        if($extraScatter != 'null') {
            if(rnd(1, $bonusParams['extraWildChance']) == $bonusParams['extraWildChance']) {
                $extraWild = $this->getRandParam($bonusParams['extraWildSymbols']);
            }
            $this->coliseumBonus['wild'] = $extraWild;
        }

        while($extraWild == $extraScatter && $extraScatter != 'null' && $extraWild != 'null') {
            $extraScatter = $this->getRandParam($bonusParams['extraScatterSymbols']);
        }
        $this->coliseumBonus['scatter'] = $extraScatter;
        $this->coliseumBonus['wild'] = $extraWild;

        $this->coliseumBonus['eventDescs'] = $fsCount1.','.$fsCount2.';'.$multiple1.','.$multiple2.';'.$extraScatter.';'.$extraWild;


        $this->slot->setReels($this->gameParams->reels[1]);
        if($extraWild != 'null') {
            array_push($this->gameParams->wild, $this->gameParams->getSymbolID($extraWild));
            $this->slot->setWilds($this->gameParams->wild);
        }
        while($totalFS > 0) {
            $fsCounter++;
            $report = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array($totalMultiple, $totalMultiple),
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $totalMultiple;
                $report['totalWin'] += $sr['totalWin'];
                $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }
            else {
                $bonus = '';
            }

            if($this->coliseumBonus['scatter'] != 'null') {
                $report['extraScatterReport'] = $this->slot->getSymbolAnyCount($this->coliseumBonus['scatter']);
                $esr = $report['extraScatterReport'];
                if(!empty($this->gameParams->scatterMultiple[$esr['count']])) {
                    $esr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$esr['count']] * $totalMultiple;
                    $report['totalWin'] += $esr['totalWin'];
                    $bonus .= '<Scatter offsets="'.implode(',', $esr['offsets']).'" prize="'.$esr['count'].$this->coliseumBonus['scatter'].'" length="'.$esr['count'].'" payout="'.$esr['totalWin'].'" />';
                }
            }

            $report['helmetReport'] = $this->slot->getSymbolAnyCount('W');
            if($report['helmetReport']['count'] >= 3) {
                $this->getHelmetBonus($report, $totalMultiple);
                $report['totalWin'] += $this->helmetBonus['bonusWin'] * $totalMultiple;
                $bonus .= '<Feature name="SpecialFeature" payout="'.($this->helmetBonus['bonusWin'] * $totalMultiple).'">
                    <Detail name="Mask" eventDescs="'.implode(',', $this->helmetBonus['alias']).'" payDescs="'.implode(',', $this->helmetBonus['payDesc']).'" payout="'.($this->helmetBonus['bonusWin'] * $totalMultiple).'" />
                </Feature>';
            }

            $this->coliseumBonus['bonusWin'] += $report['totalWin'];

            $this->fsPays[] = $report['totalWin'];

            $reelSymbols = $this->slot->getReelSymbols(2);
            if(in_array(0, $reelSymbols)) {
                $totalFS += 3;
                $currentFsCount += 3;
            }

            $winLines = $this->getWinLinesData($report, array(
                'reelset' => 1,
                'currentSpins' => $currentFsCount,
                'spins' => '{{count}}',
                'runningTotal' => $this->coliseumBonus['bonusWin'] + $startWin,
                'bonus' => $bonus,
            ));

            $drawState = '<DrawState drawId="'.$fsCounter.'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';
            $this->coliseumBonus['drawStates'] .= $drawState;


            $totalFS -= 1;
        }
        $this->coliseumBonus['fsCount'] = $fsCounter;
        $this->coliseumBonus['drawStates'] = str_replace('{{count}}', $fsCounter, $this->coliseumBonus['drawStates']);
        $this->coliseumBonus['totalWin'] += $this->coliseumBonus['bonusWin'];
    }

    public function showColiseumReport($report, $totalWin) {
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        $bonus .= '<Feature name="ColiseumBonus">';
        $bonus .= '<Detail eventDescs="'.$this->coliseumBonus['eventDescs'].'" ';
        $bonus .= 'multiplier="'.$this->coliseumBonus['multiple'].'" ';
        $bonus .= 'extraWild="'.$this->coliseumBonus['wild'].'" ';
        $bonus .= 'extraScatter="'.$this->coliseumBonus['scatter'].'" /></Feature>';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['totalWin'] - $this->coliseumBonus['bonusWin'],
            'spins' => $this->coliseumBonus['fsCount'],
            'currentSpins' => $this->coliseumBonus['startFsCount'],
            'bonus' => $bonus,
            'drawWin' => $report['totalWin'] - $this->coliseumBonus['bonusWin'],
        ));
        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
            <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
        </DrawState>'.$this->coliseumBonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGPlaceBetsResponse newBalance="'.$balanceWithoutBet.'" gameId="'.$this->gameID.'" />
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">
    '.$drawStates.'
    </EEGLoadResultsResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;
        $_SESSION['bonus'] = 'coliseum';
    }

}
