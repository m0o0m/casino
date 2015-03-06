<?

class firestormCtrl extends Ctrl {
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
    '.$this->gameParams->getReels().'<EEGLoadWinLinesResponse gameId="'.$this->gameID.'">
        <WinLines>
            <Line num="1" offsets=" 0,  0,  0,  0,  0" />
            <Line num="2" offsets="-1, -1, -1, -1, -1" />
            <Line num="3" offsets=" 1,  1,  1,  1,  1" />
            <Line num="4" offsets="-1,  0,  1,  0, -1" />
            <Line num="5" offsets=" 1,  0, -1,  0,  1" />
            <Line num="6" offsets="-1, -1,  0, -1, -1" />
            <Line num="7" offsets=" 1,  1,  0,  1,  1" />
            <Line num="8" offsets=" 0,  1,  1,  1,  0" />
            <Line num="9" offsets=" 0, -1, -1, -1,  0" />
            <Line num="10" offsets=" 0, -1,  0, -1,  0" />
            <Line num="11" offsets=" 0,  1,  0,  1,  0" />
            <Line num="12" offsets="-1,  0, -1,  0, -1" />
            <Line num="13" offsets=" 1,  0,  1,  0,  1" />
            <Line num="14" offsets=" 0,  0, -1,  0,  0" />
            <Line num="15" offsets=" 0,  0,  1,  0,  0" />
            <Line num="16" offsets="-1,  0,  0,  0, -1" />
            <Line num="17" offsets=" 1,  0,  0,  0,  1" />
            <Line num="18" offsets="-1,  0,  1,  1,  1" />
            <Line num="19" offsets=" 1,  0, -1, -1, -1" />
            <Line num="20" offsets="-1,  1, -1,  1, -1" />
            <Line num="21" offsets=" 1, -1,  1, -1,  1" />
            <Line num="22" offsets="-1,  1,  1,  1, -1" />
            <Line num="23" offsets=" 1, -1, -1, -1,  1" />
            <Line num="24" offsets="-1, -1,  1, -1, -1" />
            <Line num="25" offsets=" 1,  1, -1,  1,  1" />
        </WinLines>
    </EEGLoadWinLinesResponse>'.$this->getStakeParams().'
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

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'LOCKED':
                $this->showLockedReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $this->slot->drawID = -1;
        $respin = false;
        $bonusWin = 0;

        $report = $this->slot->spin(array(
            array(
                'type' => 'randomReplace',
                'symbols' => array(12,13,14),
                'replacement' => array(1,2,3,4,5,6,7,8,9,10),
            ),
            array(
                'type' => 'multipleBySymbolCount',
                'symbol' => 'S',
                'multipleInc' => -1,
            ),
        ));

        $report['type'] = 'SPIN';
        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 1) {
            $report['type'] = 'LOCKED';

            $randomLockedArray = array('R1', 'R2', 'R3');
            $rnd = rnd(0, count($randomLockedArray)-1);
            $randomLocked = $randomLockedArray[$rnd];
            $randomLockedSymbol = $report['bonusData']['replaced'][$randomLocked];
            $report['randomLockedSymbol'] = $randomLockedSymbol;
            $report['randomLockedReplacement'] = $randomLockedArray[$rnd];
            $report['wildReport'] = $this->slot->getSymbolAnyCount('W');
            $report['randomReport'] = $this->slot->getSymbolAnyCount($randomLockedSymbol);

            $this->getLockedData($report);
            $bonusWin = $this->bonus['bonusWin'];
        }

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'lock':
                    if($report['scattersReport']['count'] < 2) {
                        $respin = true;
                    }
                    break;
            }
        }

        $totalWin = $report['totalWin'] + $bonusWin;

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $replaced = '';
        foreach($report['bonusData']['replaced'] as $k=>$v) {
            $replaced .= $k.'="'.$v.'" ';
        }
        $bonus = '<Features>
                    <Feature name="RandomReplacement" '.$replaced.' />
                    <Feature name="Multiplier" numScatters="'.$report['scattersReport']['count'].'" multiplier="1.0" />
                </Features>';

        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'display' => 'startRows',
            'addString' => $addString,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                <DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);
    }

    protected function getLockedData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $randomLockedSymbol = $report['randomLockedSymbol'];

        $scattersInfo = $this->slot->getSymbolAnyCount('S');
        $wildInfo = $this->slot->getSymbolAnyCount('W');
        $randomInfo = $this->slot->getSymbolAnyCount($randomLockedSymbol);

        $multiple = $scattersInfo['count'] - 1;

        $this->slot->setReels($this->gameParams->reels[1]);

        $lockedPresent = true;

        $replaced = '';
        foreach($report['bonusData']['replaced'] as $k=>$v) {
            $replaced .= $k.'="'.$v.'" ';
        }

        $draws = '';


        $lockedBeforeArray = array();
        for($i = 0; $i <= 14; $i++) {
            if(in_array($i, $scattersInfo['offsets'])) {
                $lockedBeforeArray[$i] = 'S';
            }
            elseif(in_array($i, $wildInfo['offsets'])) {
                $lockedBeforeArray[$i] = 'W';
            }
            elseif(in_array($i, $randomInfo['offsets'])) {
                $lockedBeforeArray[$i] = $randomLockedSymbol;
            }
            else {
                $lockedBeforeArray[$i] = '-';
            }
        }
        $lockedBefore = '';
        for($i = 0; $i <= 14; $i++) {
            if($i == 14) {
                $lockedBefore .= $lockedBeforeArray[$i];
            }
            elseif(($i+1) % 5 == 0) {
                $lockedBefore .= $lockedBeforeArray[$i].';';
            }
            else {
                $lockedBefore .= $lockedBeforeArray[$i].',';
            }
        }
        $lockedAfter = $lockedBefore;

        while($lockedPresent) {
            $lockedBefore = $lockedAfter;

            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'replace',
                    'relation' => $report['bonusData']['replaced'],
                ),
                array(
                    'type' => 'symbolOnPosition',
                    'offsets' => $scattersInfo['offsets'],
                    'symbol' => 'S',
                ),
                array(
                    'type' => 'symbolOnPosition',
                    'offsets' => $wildInfo['offsets'],
                    'symbol' => 'W',
                ),
                array(
                    'type' => 'symbolOnPosition',
                    'offsets' => $randomInfo['offsets'],
                    'symbol' => $randomLockedSymbol,
                ),
                array(
                    'type' => 'multipleBySymbolCount',
                    'symbol' => 'S',
                    'multipleInc' => -1,
                ),
            ));

            $sNew = $this->slot->getSymbolAnyCount('S');
            $wNew = $this->slot->getSymbolAnyCount('W');
            $rNew = $this->slot->getSymbolAnyCount($randomLockedSymbol);

            $sDiff = array_diff($sNew['offsets'], $scattersInfo['offsets']);
            $wDiff = array_diff($wNew['offsets'], $wildInfo['offsets']);
            $rDiff = array_diff($rNew['offsets'], $randomInfo['offsets']);

            $lockedAfterArray = array();
            for($i = 0; $i <= 14; $i++) {
                if(in_array($i, $sNew['offsets'])) {
                    $lockedAfterArray[$i] = 'S';
                }
                elseif(in_array($i, $wNew['offsets'])) {
                    $lockedAfterArray[$i] = 'W';
                }
                elseif(in_array($i, $rNew['offsets'])) {
                    $lockedAfterArray[$i] = $randomLockedSymbol;
                }
                else {
                    $lockedAfterArray[$i] = '-';
                }
            }
            $lockedAfter = '';
            for($i = 0; $i <= 14; $i++) {
                if($i == 14) {
                    $lockedAfter .= $lockedAfterArray[$i];
                }
                elseif(($i+1) % 5 == 0) {
                    $lockedAfter .= $lockedAfterArray[$i].';';
                }
                else {
                    $lockedAfter .= $lockedAfterArray[$i].',';
                }
            }

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $multiple = $sNew['count'] - 1;

            $bonus = '<Features>
                    <Feature name="RandomReplacement" '.$replaced.' />
                    <Feature name="LockedSymbols" lockedBefore="'.$lockedBefore.'" lockedAfter="'.$lockedAfter.'" lockedSymbol="'.$report['randomLockedReplacement'].'" addedScatterOffsets="'.implode(',', $sDiff).'" addedWildOffsets="'.implode(',', $wDiff).'" addedRandomOffsets="'.implode(',', $rDiff).'" />
                    <Feature name="Multiplier" numScatters="'.$sNew['count'].'" multiplier="'.$multiple.'" />
                </Features>';

            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'reelset' => 1,
                'spins' => '{{count}}',
                'currentSpins' => '{{count}}',
                'addString' => $addString,
            ));

            $draws .= '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            if(count($sDiff) > 0 || count($wDiff) > 0 || count($rDiff) > 0) {
                $lockedPresent = true;
            }
            else {
                $lockedPresent = false;
            }
            $scattersInfo = $sNew;
            $wildInfo = $wNew;
            $randomInfo = $rNew;


        }

        $draws = str_replace('{{count}}', $this->slot->drawID, $draws);
        $this->bonus['drawStates'] = $draws;
        $this->bonus['randomLockedSymbol'] = $randomLockedSymbol;
        $this->bonus['replaced'] = $replaced;
    }

    protected function showLockedReport($report, $totalWin) {
        $sNew = $report['scattersReport'];
        $wNew = $report['wildReport'];
        $rNew = $report['randomReport'];

        $multiple = $sNew['count'] - 1;

        $lockedAfterArray = array();
        for($i = 0; $i <= 14; $i++) {
            if(in_array($i, $sNew['offsets'])) {
                $lockedAfterArray[$i] = 'S';
            }
            elseif(in_array($i, $wNew['offsets'])) {
                $lockedAfterArray[$i] = 'W';
            }
            elseif(in_array($i, $rNew['offsets'])) {
                $lockedAfterArray[$i] = $this->bonus['randomLockedSymbol'];
            }
            else {
                $lockedAfterArray[$i] = '-';
            }
        }
        $lockedAfter = '';
        for($i = 0; $i <= 14; $i++) {
            if($i == 14) {
                $lockedAfter .= $lockedAfterArray[$i];
            }
            elseif(($i+1) % 5 == 0) {
                $lockedAfter .= $lockedAfterArray[$i].';';
            }
            else {
                $lockedAfter .= $lockedAfterArray[$i].',';
            }
        }

        $bonus = '<Features>
                    <Feature name="RandomReplacement" '.$this->bonus['replaced'].' />
                    <Feature name="LockedSymbols" lockedBefore="-,-,-,-,-;-,-,-,-,-;-,-,-,-,-" lockedAfter="'.$lockedAfter.'" lockedSymbol="'.$report['randomLockedReplacement'].'" addedScatterOffsets="'.implode(',', $sNew['offsets']).'" addedWildOffsets="'.implode(',', $wNew['offsets']).'" addedRandomOffsets="'.implode(',', $rNew['offsets']).'" />
                    <Feature name="Multiplier" numScatters="'.$sNew['count'].'" multiplier="'.$multiple.'" />
                </Features>';


        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'display' => 'startRows',
            'addString' => $addString,
            'spins' => $this->slot->drawID,
            'currentSpins' => 1,
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