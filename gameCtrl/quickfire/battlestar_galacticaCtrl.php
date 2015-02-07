<?
require_once('QFCtrl.php');

class battlestar_galacticaCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10213" cid="10001" sid="1867" sessionid="27c4259d-2b96-42c2-aa45-460e3873b930" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="66600" userID="113868" transNumber="657722" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="360000" chipSize="5" date="2013-12-08 15:57:35" /><PlayInfo value="161250" chipSize="5" date="2014-03-12 15:09:40" /><PlayInfo value="128250" chipSize="5" date="2014-08-21 12:43:32" /><PlayInfo value="120000" chipSize="5" date="2014-05-21 18:56:10" /><PlayInfo value="81900" chipSize="5" date="2014-05-23 16:30:55" /></PlayInfos></Player><Slot win="66600" triggeringWin="66600" state="0" reelSet="0" reelPos="1,28,5,7,24" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="0,8,1,2,3" reelPos="0,27,4,6,23" /><Row symbols="0,10,13,11,9" reelPos="1,28,5,7,24" /><Row symbols="0,0,2,4,0" reelPos="2,0,6,8,0" /></VisArea><Wins><Win payline="0" id="13" numCoinsWon="4000" matchPos="5,1,2,13,4" /><Win payline="0" id="13" numCoinsWon="4000" matchPos="0,1,2,13,4" /><Win payline="0" id="13" numCoinsWon="4000" matchPos="10,1,2,13,4" /><Win payline="0" id="9" numCoinsWon="350" matchPos="5,1,12" /><Win payline="0" id="9" numCoinsWon="350" matchPos="0,1,12" /><Win payline="0" id="9" numCoinsWon="350" matchPos="10,1,12" /><Win payline="0" id="81" numCoinsWon="50" matchPos="5,1,7" /><Win payline="0" id="81" numCoinsWon="50" matchPos="0,1,7" /><Win payline="0" id="81" numCoinsWon="50" matchPos="10,1,7" /><Win payline="0" id="3" numCoinsWon="40" matchPos="5,1" /><Win payline="0" id="3" numCoinsWon="40" matchPos="0,1" /><Win payline="0" id="3" numCoinsWon="40" matchPos="10,1" /></Wins><NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="66600" /><Ranking rankId="5" wasJustAwarded="0" percentComplete="4.129320" percentCompleteRank="65.172800" percentCompleteCredits="0.000000" /><ReelSets><ReelSet defaultPos="6,18,1,5,5" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="6,18,1,5,5" /><ReelSet defaultPos="4,1,8,3,9" /><ReelSet defaultPos="4,2,1,2,7" /><ReelSet defaultPos="17,1,25,9,2" /></ReelSets></Slot><Bet numChips="10" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><TriggerConditions><TriggerCondition id="4"><TriggeredEffect id="0" type="AwardTokens" tokenManager="SpinManager" tokenIDs="0" numTimesApplied="1" /></TriggerCondition></TriggerConditions><TokenManagers><TokenManager name="SpinManager" numTokensToCollect="9" tokenIDsAwarded="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" multiplier="0.000000000000000" /><TokenManager name="ModeManager" numTokensToCollect="2,2" tokenIDsAwarded="" multiplier="0.000000000000000" /></TokenManagers><Achievements><Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,85,1,86,2,87,3,88" winCombosAcquired="3,88,1,2,87" /><Achievement name="High1 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="4,89,5,90,6,91" winCombosAcquired="6,91,90" /><Achievement name="High2 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="10,95,11,96,12,97" winCombosAcquired="97" /><Achievement name="High3 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="16,101,17,102,18,103" winCombosAcquired="102,103,18,17" /><Achievement name="High4 Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="22,107,23,108,24,109" winCombosAcquired="109,24,108" /><Achievement name="High5 Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="28,113,29,114,30,115" winCombosAcquired="30,115,113,114" /><Achievement name="High6 Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="34,119,35,120,36,121" winCombosAcquired="36,34,121,35" /><Achievement name="High7 Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="40,125,41,126,42,127" winCombosAcquired="127,126,42,41,40" /><Achievement name="High8 Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="46,131,47,132,48,133" winCombosAcquired="47,133,48,46,132" /><Achievement name="Ace Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="52,137,53,138,54,139" winCombosAcquired="54,138,139,53,137,52" /><Achievement name="King Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="58,143,59,144,60,145" winCombosAcquired="60,145,59,143,58,144" /><Achievement name="Queen Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="64,149,65,150,66,151" winCombosAcquired="64,65,66,150,151,149" /><Achievement name="Jack Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="70,155,71,156,72,157" winCombosAcquired="72,157,156,71,70,155" /><Achievement name="Ten Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="76,161,77,162,78,163" winCombosAcquired="162,163,161,78,77,76" /><Achievement name="Scatter Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="82,83,84" winCombosAcquired="84,83" /><Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,85,1,86,2,87,3,88,4,89,5,90,6,91,10,95,11,96,12,97,16,101,17,102,18,103,22,107,23,108,24,109,28,113,29,114,30,115,34,119,35,120,36,121,40,125,41,126,42,127,46,131,47,132,48,133,52,137,53,138,54,139,58,143,59,144,60,145,64,149,65,150,66,151,70,155,71,156,72,157,76,161,77,162,78,163,82,83,84" winCombosAcquired="60,72,64,54,84,65,47,66,3,30,162,150,115,113,157,145,151,138,163,109,139,156,88,127,161,78,59,71,36,77,53,126,137,143,149,133,70,48,46,58,6,42,155,114,76,34,91,102,121,52,1,24,97,144,132,103,108,2,41,87,29,35,18,83,120,40,90,28,17" /></Achievements></Response></Pkt>';
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
    <Id mid="10213" cid="10001" sid="1867" sessionid="d12fa800-251c-49bd-a8bb-715c9ef236b1" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="111285" transNumber="1486095">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="322800" chipSize="5" date="2014-04-06 23:37:46" />
                <PlayInfo value="241250" chipSize="5" date="2014-04-06 22:37:21" />
                <PlayInfo value="240000" chipSize="5" date="2014-01-25 21:18:05" />
                <PlayInfo value="180000" chipSize="5" date="2013-11-30 12:07:25" />
                <PlayInfo value="115600" chipSize="5" date="2014-11-01 03:13:04" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
            <Ranking rankId="5" wasJustAwarded="0" percentComplete="4.807335" percentCompleteRank="92.293400" percentCompleteCredits="0.000000" />
        </Slot>
        <TriggerConditions>
            <TriggerCondition id="4">
                <TriggeredEffect id="0" type="AwardTokens" tokenManager="SpinManager" tokenIDs="0" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
