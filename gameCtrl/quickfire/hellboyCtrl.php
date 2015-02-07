<?
require_once('QFCtrl.php');

class hellboyCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="12732" cid="10001" sid="1867" sessionid="13994dc3-fa8f-4873-beda-8ed7106b95c3" verb="Refresh" /><Response><Framework state="4" /><Player balance="200000" totalWin="80" userID="113633" transNumber="489333" type="5" currency="0" brandId="1867" hasPlayedBefore="1" /><Slot win="80" triggeringWin="80" state="0" reelSet="0" reelPos="37,10,30,25,6" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="20"><Row symbols="6,3,7,4,3" reelPos="36,9,29,24,5" /><Row symbols="3,7,9,6,7" reelPos="37,10,30,25,6" /><Row symbols="7,10,5,10,1" reelPos="38,11,31,26,7" /></VisArea><Wins><Win payline="4" id="11" numCoinsWon="80" matchPos="0,6,12" /></Wins><NextSpin nextActivePaylines="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19" nextNumChips="10" nextChipSize="1" /><ReelSets><ReelSet defaultPos="18,5,5,1,33" /><ReelSet defaultPos="18,5,5,1,33" /></ReelSets></Slot><Bet numChips="10" chipSize="1" activePaylines="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="20" validChips="1,2,5,10,20,25" slotBetMethod="1" /><BonusGames lastBonusPlayed="-1"><Bonus id="0" state="0" bonusName="UnderWorldBonus_Level_1" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="UnderWorldBonus_Level_1TokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="1" state="0" bonusName="UnderWorldBonus_Level_2" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="UnderWorldBonus_Level_2TokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="2" state="0" bonusName="UnderWorldBonus_Level_3" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="UnderWorldBonus_Level_3TokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="3" state="0" bonusName="UnderWorldBonus_Level_4" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="UnderWorldBonus_Level_4TokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="4" state="0" bonusName="Chamber of Fire" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="Chamber of FireTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus></BonusGames><Gamble state="2" maxAttempts="5" maxWin="1000000" allowedGambleMethod="2" allowedGambleSize="1" gamblesMade="0" prevCards="3" win="0" /></Response></Pkt>';
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
                $wins .= '<Win payline="'.($w['id']-1).'" id="'.($w['id']-1).'" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="12732" cid="10001" sid="1867" sessionid="cec63179-e43d-4cc0-96de-d512983962ed" verb="Spin" />
    <Response>
        <Framework state="1" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278" />
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="20">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19" nextNumChips="10" nextChipSize="2" />
        </Slot>
        <BonusGames lastBonusPlayed="-1" />
        <Gamble state="1" gamblesMade="0" prevCards="7,17,17,5,51,5,30" win="0" allowColour="1" allowSuit="1" allowHalf="0" allowFull="1" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
