<?
require_once('QFCtrl.php');

class thedark_knight_risesCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10250" cid="10001" sid="1867" sessionid="8faf450a-c2c4-4e31-9677-a7ca78393a34" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="0" userID="113830" transNumber="243459" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="322625" chipSize="5" date="2014-02-20 14:28:40" /><PlayInfo value="150500" chipSize="5" date="2014-01-04 00:22:17" /><PlayInfo value="132390" chipSize="5" date="2014-02-16 18:40:11" /><PlayInfo value="90200" chipSize="5" date="2014-02-09 17:13:40" /><PlayInfo value="78600" chipSize="5" date="2014-01-04 01:21:41" /></PlayInfos></Player><Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="28,25,59,44,38" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="11,8,9,8,6" reelPos="27,24,58,43,37" /><Row symbols="10,4,6,10,8" reelPos="28,25,59,44,38" /><Row symbols="7,11,5,2,11" reelPos="29,26,60,45,39" /></VisArea><Wins /><NextSpin nextActivePaylines="0" nextNumChips="5" nextChipSize="5" nextMaxChips="5" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="0" /><ExtendedSpinStyles><ExtendedSpinStyle styleName="ExpandingWild1" isActiveCurrentSpin="1" isActiveNextSpin="1" /></ExtendedSpinStyles><ReelSets><ReelSet defaultPos="1,1,1,34,1" /><ReelSet defaultPos="3,2,3,6,3" /><ReelSet defaultPos="3,2,3,6,3" /><ReelSet defaultPos="1,1,22,1,1" /><ReelSet defaultPos="1,1,22,1,1" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="2,2,1,1,1" /><ReelSet defaultPos="1,7,14,8,1" /><ReelSet defaultPos="1,1,1,1,1" /></ReelSets></Slot><Bet numChips="5" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="5" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><BonusGames lastBonusPlayed="-1"><Bonus id="0" state="0" bonusName="DarkKnightFight_Locked" numBonusLevels="3" tickets="0" ticketsNeeded="1" winScaler="ScaleByChipSize"><TokenManager name="DarkKnightFight_LockedTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><BonusSpecific><Paths step="0" /></BonusSpecific></Bonus><Bonus id="1" state="0" bonusName="DarkKnightFight_Unlocked" numBonusLevels="3" tickets="0" ticketsNeeded="1" winScaler="ScaleByChipSize"><TokenManager name="DarkKnightFight_UnlockedTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><BonusSpecific><Paths step="3"><Path path="0" freeSpins="27" multiplier="1" /><Path path="1" freeSpins="26" multiplier="1" /></Paths></BonusSpecific></Bonus></BonusGames><TokenManagers><TokenManager name="StateManager" numTokensToCollect="7" tokenIDsAwarded="0,0,0" multiplier="0.000000000000000" /><TokenManager name="UnlockManager" numTokensToCollect="0" tokenIDsAwarded="0,0,0,0,0,0,0,0,0" multiplier="533.333333333333370" /><TokenManager name="RedundentUnlockManager" numTokensToCollect="0" tokenIDsAwarded="0,0,0,0,0,0,0,0,0,0" multiplier="510.000000000000000" /></TokenManagers></Response></Pkt>';
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
    <Id mid="10250" cid="10001" sid="1867" sessionid="21bb25a7-d8cf-4a3f-a3e9-9daa7890385a" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="191250" chipSize="5" date="2014-04-11 08:41:02" />
                <PlayInfo value="174600" chipSize="5" date="2014-10-22 19:43:43" />
                <PlayInfo value="142775" chipSize="5" date="2014-08-17 01:49:54" />
                <PlayInfo value="136950" chipSize="5" date="2014-01-31 12:59:51" />
                <PlayInfo value="133500" chipSize="5" date="2013-12-09 18:22:35" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="5" nextChipSize="5" nextMaxChips="5" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="ExpandingWild1" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
