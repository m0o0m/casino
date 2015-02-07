<?

class iron_man_2_50Ctrl extends Ctrl {
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

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREESPIN':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getFreeSpinBonus($report);
                $report['totalWin'] = $this->fsBonus['totalWin'];
                $report['type'] = 'FREESPIN';
            }
        }

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
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
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'K" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
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

    public function getFreeSpinBonus($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $multiple = 2;
        $this->slot->setReels($this->gameParams->reels[1]);
        for($i = 1; $i <= 10; $i++) {
            $report = $this->slot->spin(array(
                'type' => 'multipleWithWild',
                'multiple' => $multiple,
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $multiple;
                $report['totalWin'] += $sr['totalWin'];
                $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'K" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }
            else {
                $bonus = '';
            }

            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $winLines = $this->getWinLinesData($report, array(
                'reelset' => 1,
                'currentSpins' => 10,
                'spins' => 10,
                'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                'bonus' => $bonus,
                'addString' => ' multiplier="'.$multiple.'"',
            ));

            $drawState = '<DrawState drawId="'.$i.'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';
            $this->fsBonus['drawStates'] .= $drawState;


            if($i % 2 == 0) {
                $multiple++;
            }
        }
        $this->fsBonus['totalWin'] = $startWin + $this->fsBonus['bonusWin'];
    }

    public function showFreeSpinReport($report, $totalWin) {
        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'K" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['totalWin'] - $this->fsBonus['bonusWin'],
            'spins' => 10,
            'currentSpins' => 10,
            'bonus' => $bonus,
            'drawWin' => $report['totalWin'] - $this->fsBonus['bonusWin'],
        ));

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
            <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
        </DrawState>'.$this->fsBonus['drawStates'];

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
        $_SESSION['bonus'] = 'freespin';
    }

}
