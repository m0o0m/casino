<?
require_once('QFCtrl.php');

class terminator_2Ctrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10282" cid="10001" sid="1867" sessionid="bba9ad8c-51e7-43bb-b8fa-ea564918fcbd" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="0" userID="113828" transNumber="-1" type="5" currency="0" brandId="1867" hasPlayedBefore="0"><PlayInfos type="TopWins" id="0" /></Player><Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="9,56,3,1,1" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="6,9,7,2,5" reelPos="8,55,2,0,0" /><Row symbols="2,10,5,4,2" reelPos="9,56,3,1,1" /><Row symbols="4,3,0,9,9" reelPos="10,57,4,2,2" /></VisArea><Wins /><NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="1" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="0" /><ReelSets><ReelSet defaultPos="9,56,3,1,1" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="1,19,1,1,1" /><ReelSet defaultPos="1,4,1,1,1" /><ReelSet defaultPos="1,14,1,1,1" /><ReelSet defaultPos="1,13,1,1,1" /></ReelSets></Slot><Bet numChips="10" chipSize="1" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5,10" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><TokenManagers><TokenManager name="T800Activator" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></TokenManagers><Achievements><Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2" winCombosAcquired="" /><Achievement name="Terminator Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="3,4,5" winCombosAcquired="" /><Achievement name="John Connor Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="9,10,11" winCombosAcquired="" /><Achievement name="T1000 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="15,16,17" winCombosAcquired="" /><Achievement name="Sarah Connor Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="21,22,23" winCombosAcquired="" /><Achievement name="T800 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="27,28,29" winCombosAcquired="" /><Achievement name="All Suites" isComplete="0" wasJustAwarded="0" winCombosRequired="33,34,35,39,40,41,45,46,47,51,52,53" winCombosAcquired="" /><Achievement name="Spade Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="33,34,35" winCombosAcquired="" /><Achievement name="Heart Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="39,40,41" winCombosAcquired="" /><Achievement name="Diamond Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="45,46,47" winCombosAcquired="" /><Achievement name="Club Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="51,52,53" winCombosAcquired="" /><Achievement name="Scatter Orb Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="57,58,59,60" winCombosAcquired="" /><Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3,4,5,9,10,11,15,16,17,21,22,23,27,28,29,33,34,35,39,40,41,45,46,47,51,52,53,57,58,59,60" winCombosAcquired="" /></Achievements></Response></Pkt>';
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
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="10282" cid="10001" sid="1867" sessionid="bba9ad8c-51e7-43bb-b8fa-ea564918fcbd" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="300" chipSize="1" date="2014-12-08 08:51:53" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="1" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
        </Slot>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
