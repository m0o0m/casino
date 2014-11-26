<?
require_once('QFCtrl.php');

class thunderstruck_2Ctrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="d5bc5a6b-d39c-4ecd-ac07-6d25485d3f71" verb="Refresh" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$this->getBalance() * 100 .'" totalWin="0" userID="111283" transNumber="1274612" type="5" currency="0" brandId="1867" hasPlayedBefore="1">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="440800" chipSize="5" date="2014-10-22 09:07:38" />
                <PlayInfo value="348250" chipSize="5" date="2014-09-25 17:58:54" />
                <PlayInfo value="78950" chipSize="5" date="2014-09-20 21:42:30" />
                <PlayInfo value="66250" chipSize="5" date="2014-09-14 18:18:39" />
                <PlayInfo value="63900" chipSize="5" date="2014-09-14 18:47:26" />
            </PlayInfos>
        </Player>
        <Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="7,18,47,17,41" hasRespinFeature="0">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="6,9,6,1,2" reelPos="6,17,46,16,40" />
                <Row symbols="11,10,7,11,11" reelPos="7,18,47,17,41" />
                <Row symbols="5,4,9,6,6" reelPos="8,19,48,18,42" />
            </VisArea>
            <Wins />
            <NextSpin nextActivePaylines="0" nextNumChips="9" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="0" />
            <ReelSets>
                <ReelSet defaultPos="2,2,1,12,6" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,16,18,10,30" />
            </ReelSets>
        </Slot>
        <Bet numChips="9" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1">
            <Paylines>
                <Payline payline="0" paylineCost="30" />
            </Paylines>
        </Bet>
        <BonusGames lastBonusPlayed="-1">
            <Bonus id="0" state="0" bonusName="Bonus_Valkyrie" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings">
                <TokenManager name="Bonus_ValkyrieTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" />
            </Bonus>
            <Bonus id="1" state="0" bonusName="Bonus_Valkyrie_Loki" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings">
                <TokenManager name="Bonus_Valkyrie_LokiTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" />
            </Bonus>
            <Bonus id="2" state="0" bonusName="Bonus_Valkyrie_Loki_Odin" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings">
                <TokenManager name="Bonus_Valkyrie_Loki_OdinTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" />
            </Bonus>
            <Bonus id="3" state="0" bonusName="Bonus_Valkyrie_Loki_Odin_Thor" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings">
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" />
            </Bonus>
        </BonusGames>
        <TokenManagers>
            <TokenManager name="GreatHallofSpins" numTokensToCollect="0" tokenIDsAwarded="0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" multiplier="1447.500000000000000" />
        </TokenManagers>
        <Achievements>
            <Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2" winCombosAcquired="2,1" />
            <Achievement name="Thor Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="3,4,5" winCombosAcquired="5,4,3" />
            <Achievement name="Odin Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="9,10,11" winCombosAcquired="11,9,10" />
            <Achievement name="Loki Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="15,16,17" winCombosAcquired="17,16,15" />
            <Achievement name="Valkyrie Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="21,22,23" winCombosAcquired="22,23,21" />
            <Achievement name="Asgard Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="27,28,29" winCombosAcquired="29,28,27" />
            <Achievement name="Long Boat Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="33,34,35" winCombosAcquired="35,34,33" />
            <Achievement name="Ace Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="39,40,41" winCombosAcquired="41,40,39" />
            <Achievement name="King Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="45,46,47" winCombosAcquired="47,45,46" />
            <Achievement name="Queen Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="51,52,53" winCombosAcquired="53,51,52" />
            <Achievement name="Jack Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="57,58,59" winCombosAcquired="58,59,57" />
            <Achievement name="Ten Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="63,64,65" winCombosAcquired="65,64,63" />
            <Achievement name="Nine Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="69,70,71" winCombosAcquired="70,71,69" />
            <Achievement name="Scatter Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="75,76,77,78" winCombosAcquired="78,77,76,75" />
            <Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3,4,5,9,10,11,15,16,17,21,22,23,27,28,29,33,34,35,39,40,41,45,46,47,51,52,53,57,58,59,63,64,65,69,70,71,75,76,77,78" winCombosAcquired="70,47,53,41,58,22,17,71,45,35,78,65,59,69,23,77,64,40,11,5,46,57,63,4,39,29,9,51,34,52,16,10,3,28,33,76,2,27,21,15,1,75" />
            <Achievement name="GreatHallofSpins" isComplete="1" wasJustAwarded="0" tokensRequired="20" tokensCollected="20" />
        </Achievements>
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
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="'.$w['id'].'" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="12772" cid="10001" sid="1866" sessionid="ddef7de9-bffa-49b2-9b92-4ea56862d19a" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278" />
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="2" />
        </Slot>
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
