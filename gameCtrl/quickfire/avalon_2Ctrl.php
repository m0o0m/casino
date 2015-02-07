<?
require_once('QFCtrl.php');

class avalon_2Ctrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10255" cid="10001" sid="1867" sessionid="8aa25ae7-c228-4e16-bfb9-669dd2dfe75a" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="50" userID="113864" transNumber="678960" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="216000" chipSize="5" date="2014-03-02 15:13:02" /><PlayInfo value="148500" chipSize="5" date="2014-11-16 06:51:49" /><PlayInfo value="141550" chipSize="5" date="2014-08-04 13:49:16" /><PlayInfo value="130200" chipSize="5" date="2014-02-15 08:16:47" /><PlayInfo value="129975" chipSize="5" date="2014-03-24 02:04:59" /></PlayInfos></Player><Slot win="50" triggeringWin="50" state="0" reelSet="0" reelPos="11,77,87,8,49" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="1,10,9,10,9" reelPos="10,76,86,7,48" /><Row symbols="11,1,10,3,13" reelPos="11,77,87,8,49" /><Row symbols="4,8,2,11,6" reelPos="12,78,88,9,50" /></VisArea><Wins><Win payline="0" id="11" numCoinsWon="10" matchPos="10,6" /></Wins><NextSpin nextActivePaylines="0" nextNumChips="5" nextChipSize="5" nextMaxChips="5" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="50" /><ExtendedSpinStyles><ExtendedSpinStyle styleName="LadyLakeExpanding" isActiveCurrentSpin="1" isActiveNextSpin="1" /></ExtendedSpinStyles><ReelSets><ReelSet defaultPos="41,24,62,47,19" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="20,49,31,17,12" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="1,1,1,1,1" /></ReelSets></Slot><Bet numChips="5" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="5" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><BonusGames lastBonusPlayed="-1"><Bonus id="0" state="0" bonusName="Lady of the Lake" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="Lady of the LakeTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="1" state="0" bonusName="Misty Vale" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings"><TokenManager name="Misty ValeTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="2" state="0" bonusName="Choose Your Path" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings"><TokenManager name="Choose Your PathTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="3" state="0" bonusName="Whispering Woods" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="Whispering WoodsTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="4" state="0" bonusName="Dusky Moors" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="Dusky MoorsTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><BonusSpecific numSameResultIds="2" /></Bonus><Bonus id="5" state="0" bonusName="Hall of Shadows" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleBySlotBet"><TokenManager name="Hall of ShadowsTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="6" state="0" bonusName="Avalon" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="ScaleByTokenManager"><TokenManager name="AvalonTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus></BonusGames><TokenManagers><TokenManager name="GrailBonusManager" numTokensToCollect="5" tokenIDsAwarded="0,0" multiplier="0.000000000000000" /></TokenManagers><Achievements><Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3" winCombosAcquired="3,2" /><Achievement name="Arthur Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="8,9,10,11" winCombosAcquired="11,9,10" /><Achievement name="Merlin Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="16,17,18,19" winCombosAcquired="19,18,17" /><Achievement name="Guinevere Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="24,25,26" winCombosAcquired="26,25,24" /><Achievement name="Morgan Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="30,31,32" winCombosAcquired="32,31,30" /><Achievement name="BlackKnight Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="36,37,38" winCombosAcquired="37,38" /><Achievement name="Royal Flush" isComplete="1" wasJustAwarded="0" winCombosRequired="42,43,44,48,49,50,54,55,56,60,61,62,66,67,68,72,73,74" winCombosAcquired="50,73,68,74,62,56,48,44,61,43,60,66,67,72,55,49,54,42" /><Achievement name="Ace Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="42,43,44" winCombosAcquired="44,43,42" /><Achievement name="King Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="48,49,50" winCombosAcquired="50,48,49" /><Achievement name="Queen Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="54,55,56" winCombosAcquired="56,55,54" /><Achievement name="Jack Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="60,61,62" winCombosAcquired="62,61,60" /><Achievement name="Ten Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="66,67,68" winCombosAcquired="68,66,67" /><Achievement name="Nine Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="72,73,74" winCombosAcquired="73,74,72" /><Achievement name="The Grail Scatter Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="78,79,80,81" winCombosAcquired="81,80,79" /><Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3,8,9,10,11,16,17,18,19,24,25,26,30,31,32,36,37,38,42,43,44,48,49,50,54,55,56,60,61,62,66,67,68,72,73,74,78,79,80,81" winCombosAcquired="50,73,81,68,74,62,56,48,19,32,11,26,44,61,3,43,9,60,66,67,72,80,31,55,49,54,18,10,37,79,42,38,25,2,30,24,17" /></Achievements><GameFeatureInfos><BonusFeatureInfo bonusId="0" triggeringWin="7500" bonusWin="27000" itemIds="8,3,4,2,5,6,0,1,7,9" pickedBys="1,1,1,1,1,1,1,1,1,1" levels="0,0,0,0,0,0,0,0,0,0" /><SlotFeatureInfo reelSet="2" triggeringWin="3750" totalWin="54350" /></GameFeatureInfos></Response></Pkt>';
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
    <Id mid="10255" cid="10001" sid="1867" sessionid="1b7075ff-adcc-4205-99ee-5c333e1997ba" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="199440" chipSize="5" date="2014-05-01 15:30:27" />
                <PlayInfo value="180000" chipSize="5" date="2014-08-28 23:58:13" />
                <PlayInfo value="129550" chipSize="5" date="2014-03-05 12:28:47" />
                <PlayInfo value="122750" chipSize="5" date="2014-03-18 23:22:58" />
                <PlayInfo value="104625" chipSize="5" date="2014-04-14 17:37:13" />
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
                <ExtendedSpinStyle styleName="LadyLakeExpanding" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
