<?

class sugar_trailCtrl extends Ctrl {
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
            <FreeSpinsAwardReelGrid id="0" numStops="12" stops="F1,80,F1,60,F1,80,F1,40,F2,120,F1,80" />
            <FreeSpinsAwardReelGrid id="1" numStops="12" stops="F6,F9,F7,F6,F8,F10,F8,F6,F7,F8,F6,F7" />
            <FreeSpinsAwardReelGrid id="2" numStops="12" stops="W3,W1,W2,W1,W2,W1,W2,W1,W3,W1,W2,W1" />
            <RepinsAwardReelGrid id="0" numStops="12" stops="20,W1,40,W1,60,40,W1,20,W1,40,W1,40" />
            <RepinsAwardReelGrid id="1" numStops="12" stops="W3,W5,W4,W3,W5,W3,W5,W3,W5,W4,W3,W4" />
            <RepinsAwardReelGrid id="2" numStops="12" stops="R2,R1,R2,R1,R2,R1,R3,R2,R1,R2,R2,R1" />
            <MultiplierReelGrid id="0" numStops="12" stops="40,80,40,120,80,40,120,40,80,40,80,60" />
            <MultiplierReelGrid id="1" numStops="12" stops="M2,25,M3,30,M2,40,M3,50,M2,40,M3,60" />
            <MultiplierReelGrid id="2" numStops="12" stops="M3,50,M2,75,M5,30,M2,30,M3,20,M4,30" />
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
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();

        $report['type'] = 'SPIN';
        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 0) $respin = true;

        $m = $this->slot->getSymbolAnyCount('F');
        if($m['count'] > 2) $respin = true;

        $m = $this->slot->getSymbolAnyCount('R');
        if($m['count'] > 2) $respin = true;

        $m = $this->slot->getSymbolAnyCount('M');
        if($m['count'] > 2) $respin = true;

        $totalWin = $report['totalWin'];

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

}