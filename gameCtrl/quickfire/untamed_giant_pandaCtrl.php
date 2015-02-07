<?
require_once('QFCtrl.php');

class untamed_giant_pandaCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10194" cid="10001" sid="1867" sessionid="23323580-7a98-4a4c-b80f-f09a54570033" verb="Refresh" /><Response><Framework state="4" /><Player balance="200000" totalWin="440" userID="111752" transNumber="1173592" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="1306125" chipSize="5" date="2014-04-11 13:29:07" /><PlayInfo value="425250" chipSize="5" date="2014-04-11 13:30:06" /><PlayInfo value="331875" chipSize="5" date="2014-03-26 17:12:54" /><PlayInfo value="321000" chipSize="5" date="2014-03-06 12:04:12" /><PlayInfo value="285150" chipSize="5" date="2014-05-16 19:47:52" /></PlayInfos></Player><Slot win="440" triggeringWin="440" state="0" reelSet="0" reelPos="16,15,65,39,39" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="5,2,1,9,3" reelPos="15,14,64,38,38" /><Row symbols="9,5,7,2,4" reelPos="16,15,65,39,39" /><Row symbols="7,6,5,6,5" reelPos="17,16,66,40,40" /></VisArea><Wins><Win payline="0" id="17" numCoinsWon="88" matchPos="10,6,2" /></Wins><NextSpin nextActivePaylines="0" nextNumChips="11" nextChipSize="5" nextMaxChips="15" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="440" /><ReelSets><ReelSet defaultPos="10,3,27,16,6" /><ReelSet defaultPos="10,4,27,16,6" /></ReelSets></Slot><Bet numChips="11" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="15" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><TriggerConditions><TriggerCondition id="1"><TriggeredEffect id="0" numTimesApplied="7" /></TriggerCondition></TriggerConditions><Gamble state="2" maxAttempts="-1" maxWin="1000000" gamblesMade="0" win="0" winningsHistory="" creditsBanked="0" availableToBank="220" /><TokenManagers><TokenManager name="Reel_1" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_1_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_2" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_2_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_3" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_3_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_4" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_4_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_5" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_5_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></TokenManagers><WagerTokenManagers><Wager value="30"><TokenManagers><Reel_1 ids="0,0" /><Reel_2 ids="0,0" /><Reel_3 ids="0" /><Reel_4 ids="0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="150"><TokenManagers><Reel_1 ids="0" /><Reel_2 ids="0,0" /><Reel_3 ids="0" /><Reel_4 ids="0,0,0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="300"><TokenManagers><Reel_1 ids="0" /><Reel_2 ids="0" /><Reel_3 ids="0" /><Reel_4 ids="0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="450"><TokenManagers><Reel_1 ids="0,0" /><Reel_2 ids="0" /><Reel_4 ids="0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="900"><TokenManagers><Reel_1 ids="0" /><Reel_3 ids="0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="1200"><TokenManagers><Reel_1 ids="0" /><Reel_2 ids="0" /><Reel_3 ids="0" /><Reel_4 ids="0" /><Reel_5 ids="0" /></TokenManagers></Wager><Wager value="1500"><TokenManagers><Reel_1 ids="0" /><Reel_2 ids="0" /><Reel_3 ids="0,0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="2100"><TokenManagers><Reel_1 ids="0,0" /><Reel_3 ids="0,0" /><Reel_4 ids="0,0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="60"><TokenManagers><Reel_2 ids="0,0" /><Reel_3 ids="0,0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="600"><TokenManagers><Reel_2 ids="0,0" /><Reel_3 ids="0" /><Reel_4 ids="0" /></TokenManagers></Wager><Wager value="2250"><TokenManagers><Reel_2 ids="0,0,0" /><Reel_3 ids="0,0,0" /><Reel_4 ids="0" /></TokenManagers></Wager><Wager value="1050"><TokenManagers><Reel_4 ids="0" /></TokenManagers></Wager><Wager value="1950"><TokenManagers><Reel_5 ids="0" /></TokenManagers></Wager></WagerTokenManagers></Response></Pkt>';
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
    <Id mid="10194" cid="10001" sid="1867" sessionid="23323580-7a98-4a4c-b80f-f09a54570033" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="1306125" chipSize="5" date="2014-04-11 13:29:07" />
                <PlayInfo value="425250" chipSize="5" date="2014-04-11 13:30:06" />
                <PlayInfo value="331875" chipSize="5" date="2014-03-26 17:12:54" />
                <PlayInfo value="321000" chipSize="5" date="2014-03-06 12:04:12" />
                <PlayInfo value="285150" chipSize="5" date="2014-05-16 19:47:52" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="11" nextChipSize="5" nextMaxChips="15" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
        </Slot>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
