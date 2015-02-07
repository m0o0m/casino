<?
require_once('QFCtrl.php');

class immortal_romanceCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt>
    <Id mid="10145" cid="10001" sid="1867" sessionid="034d3f92-3390-4992-8d97-e9fe4adee6f7" verb="Refresh" />
    <Response>
        <Framework state="0" />
        <Player balance="'. $this->getBalance() * 100 .'" totalWin="0" userID="111306" transNumber="1700806" type="5" currency="0" brandId="1867" hasPlayedBefore="1" />
        <Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="34,16,45,1,38" hasRespinFeature="0">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="6,6,4,0,5" reelPos="33,15,44,0,37" />
                <Row symbols="5,5,9,12,1" reelPos="34,16,45,1,38" />
                <Row symbols="12,10,2,1,9" reelPos="35,17,46,2,39" />
            </VisArea>
            <Wins />
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="2" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="0" />
            <ReelSets>
                <ReelSet defaultPos="2,6,1,49,42" />
                <ReelSet defaultPos="2,5,1,10,15" />
                <ReelSet defaultPos="2,6,1,49,42" />
                <ReelSet defaultPos="2,7,1,12,6" />
                <ReelSet defaultPos="8,13,1,34,17" />
                <ReelSet defaultPos="2,6,1,48,1" />
            </ReelSets>
        </Slot>
        <Bet numChips="10" chipSize="2" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2" slotBetMethod="1">
            <Paylines>
                <Payline payline="0" paylineCost="30" />
            </Paylines>
        </Bet>
    </Response>
</Pkt>';
        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $betAttr = (array) $request['Request'];
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['numChips'] * $betAttr['chipSize'] * 0.30;
        $pick = 30;

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
                $spinData['report']['numChips'] = $betAttr['numChips'];
                $spinData['report']['chipSize'] = $betAttr['chipSize'];
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
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['rows']['1']);
        $row2 = implode(',', $report['rows']['2']);
        $row3 = implode(',', $report['rows']['3']);

        $wins = '';

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * 100 / $report['chipSize'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="10145" cid="10001" sid="1867" sessionid="f92cc5b6-952e-4db8-aeb1-f9dbe490354f" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="111285" transNumber="1486095" />
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="2" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
        </Slot>
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
