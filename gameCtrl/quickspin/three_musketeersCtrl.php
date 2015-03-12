<?

class three_musketeersCtrl extends Ctrl {
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
    '.$this->gameParams->getReels().'<EEGLoadWinLinesResponse gameId="197390568">
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

        $this->slot = new Slot($this->gameParams, $pick, $stake, 8/10);
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
            case 'FS':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
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

        $bonus = array(
            'type' => 'multipleReel',
            'wildConfig' => $this->gameParams->wildMultipleConfig,
        );

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(26,6,10,13,37),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] == 3) {
            $report['scattersReport']['totalWin'] = $report['bet'] * 3;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $this->getFreeSpinBonus($report);
            $bonusWin = $this->bonus['bonusWin'];
            $report['type'] = 'FS';
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

        $mMultiple = array();
        $mIndex = array();
        foreach($report['bonusData'] as $m) {
            $mMultiple[] = $m['multiple'];
            $mIndex[] = $m['stop'];
        }
        if(count($mMultiple) > 0) {
            $bonus .= '<WildReelMultiplier Multiplier="'.implode(',', $mMultiple).'" Index="'.implode(',', $mIndex).'" />';
        }

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
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        if($totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    protected function getFreeSpinBonus($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $this->gameParams->collectingPay = true;
        $this->gameParams->collectingSymbols = array(0,1,2);

        $this->slot->setParams($this->gameParams);
        $this->slot->setReels($this->gameParams->reels[1]);
        $this->slot->drawID = 0;

        $spins = 10;

        $draws = '';
        while($spins > 0) {
            $bonus = '';
            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'wildReelIfSymbolPresent',
                    'symbol' => 11,
                ),
                array(
                    'type' => 'multipleReel',
                    'wildConfig' => $this->gameParams->wildMultipleConfig,
                )
            ));

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $addString = ' rsName="FreeSpins" display2="'.$this->gameParams->getDisplay($fsReport['rows']).'"';

            $mMultiple = array();
            $mIndex = array();
            foreach($fsReport['bonusData'] as $m) {
                $mMultiple[] = $m['multiple'];
                $mIndex[] = $m['stop'];
            }
            if(count($mMultiple) > 0) {
                $bonus .= '<WildReelMultiplier Multiplier="'.implode(',', $mMultiple).'" Index="'.implode(',', $mIndex).'" />';
            }

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'addString' => $addString,
                'reelset' => 1,
                'spins' => 10,
                'currentSpins' => 10,
                'collecting' => true,
                'collectingSymbol' => 'AM',
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;

            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }

    protected function showFreeSpinReport($report, $totalWin) {
        $bonus = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" spins="10" prize="3BN" length="3" payout="'.$report['scattersReport']['totalWin'].'" />';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'spins' => 10,
            'currentSpins' => 10,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
                </DrawState>'.$this->bonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '" freeGames="0" />
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

}