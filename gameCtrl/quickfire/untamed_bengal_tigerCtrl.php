<?
require_once('QFCtrl.php');

class untamed_bengal_tigerCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10184" cid="10001" sid="1867" sessionid="fcd06c63-23fa-4667-91c0-e362601c9caa" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="0" userID="111739" transNumber="821374" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="1914150" chipSize="5" date="2014-03-01 18:02:45" /><PlayInfo value="244800" chipSize="5" date="2014-03-24 23:36:33" /><PlayInfo value="241878" chipSize="5" date="2014-03-17 16:21:41" /><PlayInfo value="158850" chipSize="5" date="2013-04-21 19:28:19" /><PlayInfo value="145125" chipSize="5" date="2013-01-13 11:23:50" /></PlayInfos></Player><Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="67,63,11,29,34" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="9,7,7,8,5" reelPos="66,62,10,28,33" /><Row symbols="1,6,6,4,8" reelPos="67,63,11,29,34" /><Row symbols="4,8,9,9,7" reelPos="68,64,12,30,35" /></VisArea><Wins /><NextSpin nextActivePaylines="0" nextNumChips="14" nextChipSize="5" nextMaxChips="15" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="0" /><ExtendedSpinStyles><ExtendedSpinStyle styleName="Lucky Nudge" isActiveCurrentSpin="1" isActiveNextSpin="0" /></ExtendedSpinStyles><ReelSets><ReelSet defaultPos="31,9,9,24,3" /><ReelSet defaultPos="10,4,37,7,11" /></ReelSets></Slot><Bet numChips="14" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="15" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><Gamble state="0" maxAttempts="-1" maxWin="1000000" /><TokenManagers><TokenManager name="Reel_1" numTokensToCollect="2" tokenIDsAwarded="0,0" multiplier="0.000000000000000" /><TokenManager name="Reel_1_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_2" numTokensToCollect="1" tokenIDsAwarded="0,0,0" multiplier="0.000000000000000" /><TokenManager name="Reel_2_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_3" numTokensToCollect="4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_3_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_4" numTokensToCollect="1" tokenIDsAwarded="0,0,0" multiplier="0.000000000000000" /><TokenManager name="Reel_4_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="Reel_5" numTokensToCollect="2" tokenIDsAwarded="0,0" multiplier="0.000000000000000" /><TokenManager name="Reel_5_active" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></TokenManagers><WagerTokenManagers><Wager value="150"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_3 ids="0,0" /><Reel_4 ids="0,0,0" /></TokenManagers></Wager><Wager value="240"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_2 ids="0,0" /><Reel_3 ids="0,0,0" /><Reel_4 ids="0,0" /><Reel_5 ids="0" /></TokenManagers></Wager><Wager value="300"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_2 ids="0" /><Reel_3 ids="0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="390"><TokenManagers><Reel_1 ids="0" /><Reel_2 ids="0" /><Reel_5 ids="0" /></TokenManagers></Wager><Wager value="450"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_4 ids="0" /></TokenManagers></Wager><Wager value="600"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_2 ids="0,0" /><Reel_3 ids="0" /><Reel_4 ids="0,0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="900"><TokenManagers><Reel_1 ids="0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="1050"><TokenManagers><Reel_1 ids="0" /></TokenManagers></Wager><Wager value="1350"><TokenManagers><Reel_1 ids="0,0,0" /><Reel_2 ids="0" /><Reel_4 ids="0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="1950"><TokenManagers><Reel_1 ids="0,0" /><Reel_2 ids="0" /><Reel_3 ids="0" /><Reel_4 ids="0,0" /></TokenManagers></Wager><Wager value="2100"><TokenManagers><Reel_1 ids="0,0" /><Reel_2 ids="0,0,0" /><Reel_4 ids="0,0,0" /><Reel_5 ids="0,0" /></TokenManagers></Wager><Wager value="1200"><TokenManagers><Reel_2 ids="0" /><Reel_3 ids="0,0" /></TokenManagers></Wager><Wager value="1500"><TokenManagers><Reel_2 ids="0" /><Reel_4 ids="0,0,0" /></TokenManagers></Wager><Wager value="1650"><TokenManagers><Reel_2 ids="0,0,0" /><Reel_3 ids="0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="30"><TokenManagers><Reel_3 ids="0" /><Reel_4 ids="0,0,0" /><Reel_5 ids="0,0,0" /></TokenManagers></Wager><Wager value="750"><TokenManagers><Reel_3 ids="0" /></TokenManagers></Wager><Wager value="2250"><TokenManagers><Reel_4 ids="0" /><Reel_5 ids="0" /></TokenManagers></Wager></WagerTokenManagers></Response></Pkt>';
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
    <Id mid="10184" cid="10001" sid="1867" sessionid="fcd06c63-23fa-4667-91c0-e362601c9caa" verb="Spin" />
    <Response>
        <Framework state="1" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="1914150" chipSize="5" date="2014-03-01 18:02:45" />
                <PlayInfo value="244800" chipSize="5" date="2014-03-24 23:36:33" />
                <PlayInfo value="241878" chipSize="5" date="2014-03-17 16:21:41" />
                <PlayInfo value="158850" chipSize="5" date="2013-04-21 19:28:19" />
                <PlayInfo value="145125" chipSize="5" date="2013-01-13 11:23:50" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="14" nextChipSize="5" nextMaxChips="15" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Lucky Nudge" isActiveCurrentSpin="1" isActiveNextSpin="0" />
            </ExtendedSpinStyles>
        </Slot>
        <TriggerConditions>
            <TriggerCondition id="1">
                <TriggeredEffect id="0" numTimesApplied="1" />
            </TriggerCondition>
            <TriggerCondition id="28">
                <TriggeredEffect id="0" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>
        <Gamble state="1" gamblesMade="0" win="0" winningsHistory="" posibleWinnings="2800,1400,931,700,560,462,399,350,308,280,252,231,210,196,182,175,161,154,147" creditsBanked="0" availableToBank="70" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
