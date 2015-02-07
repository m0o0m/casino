<?
require_once('QFCtrl.php');

class thunderstruck_2Ctrl extends QFCtrl {

    protected  function startInit($request) {
        $numChips = (empty($_SESSION['numChips'])) ? 10 : $_SESSION['numChips'];
        $chipSize = (empty($_SESSION['chipSize'])) ? 5 : $_SESSION['chipSize'];

        $this->setSessionIfEmpty('spinType', 'spin');
        $this->setSessionIfEmpty('fsLevel', 0);
        $this->setSessionIfEmpty('state', 0);

        $slot = '<Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="7,18,47,17,41" hasRespinFeature="0">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="6,9,6,1,2" reelPos="6,17,46,16,40" />
                <Row symbols="11,10,7,11,11" reelPos="7,18,47,17,41" />
                <Row symbols="5,4,9,6,6" reelPos="8,19,48,18,42" />
            </VisArea>
            <Wins />
            <NextSpin nextActivePaylines="0" nextNumChips="'.$chipSize.'" nextChipSize="'.$numChips.'" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="0" />
            <ReelSets>
                <ReelSet defaultPos="2,2,1,12,6" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,2,2,2,2" />
                <ReelSet defaultPos="2,16,18,10,30" />
            </ReelSets>
        </Slot>';

        $totalWin = 0;

        if(!empty($_SESSION['lastSlot'])) {
            $slot = gzuncompress(base64_decode($_SESSION['lastSlot']));
            $slot = $this->updateStringOption($slot, 'win', $_SESSION['fsTotalWin'] * 100);
            $totalWin = $_SESSION['fsTotalWin'] * 100;
        }


        $xml = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="d5bc5a6b-d39c-4ecd-ac07-6d25485d3f71" verb="Refresh" />
    <Response>
        <Framework state="'.$_SESSION['state'].'" />
        <Player balance="'.$this->getBalance() * 100 .'" totalWin="'.$totalWin.'" userID="111283" transNumber="1274612" type="5" currency="0" brandId="1867" hasPlayedBefore="1">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="440800" chipSize="5" date="2014-10-22 09:07:38" />
                <PlayInfo value="348250" chipSize="5" date="2014-09-25 17:58:54" />
                <PlayInfo value="78950" chipSize="5" date="2014-09-20 21:42:30" />
                <PlayInfo value="66250" chipSize="5" date="2014-09-14 18:18:39" />
                <PlayInfo value="63900" chipSize="5" date="2014-09-14 18:47:26" />
            </PlayInfos>
        </Player>
        '.$slot.'
        <Bet numChips="'.$numChips.'" chipSize="'.$chipSize.'" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1">
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
            <TokenManager name="GreatHallofSpins" numTokensToCollect="'.(20 - $_SESSION['fsLevel']).'" tokenIDsAwarded="" multiplier="0.000000000000000" />
        </TokenManagers>
        <Achievements>
            <Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2" winCombosAcquired="" />
            <Achievement name="Thor Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="3,4,5" winCombosAcquired="5" />
            <Achievement name="Odin Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="9,10,11" winCombosAcquired="11" />
            <Achievement name="Loki Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="15,16,17" winCombosAcquired="" />
            <Achievement name="Valkyrie Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="21,22,23" winCombosAcquired="23,22" />
            <Achievement name="Asgard Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="27,28,29" winCombosAcquired="29" />
            <Achievement name="Long Boat Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="33,34,35" winCombosAcquired="33,35" />
            <Achievement name="Ace Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="39,40,41" winCombosAcquired="39,41,40" />
            <Achievement name="King Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="45,46,47" winCombosAcquired="47,46" />
            <Achievement name="Queen Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="51,52,53" winCombosAcquired="53,52" />
            <Achievement name="Jack Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="57,58,59" winCombosAcquired="58,59" />
            <Achievement name="Ten Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="63,64,65" winCombosAcquired="63,65,64" />
            <Achievement name="Nine Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="69,70,71" winCombosAcquired="70,69,71" />
            <Achievement name="Scatter Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="75,76,77,78" winCombosAcquired="78,77" />
            <Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3,4,5,9,10,11,15,16,17,21,22,23,27,28,29,33,34,35,39,40,41,45,46,47,51,52,53,57,58,59,63,64,65,69,70,71,75,76,77,78" winCombosAcquired="29,63,70,47,65,78,39,53,46,41,69,58,33,59,77,5,11,71,35,64,23,22,40,52" />
            <Achievement name="GreatHallofSpins" isComplete="0" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
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

        $spinData['report']['numChips'] = $betAttr['numChips'];
        $spinData['report']['chipSize'] = $betAttr['chipSize'];
        $spinData['report']['coinRatio'] = 100 / $betAttr['chipSize'];

        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREESPIN':
                $_SESSION['fsLevel']++;
                if($_SESSION['fsLevel'] > 20) $_SESSION['fsLevel'] = 20;
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['numChips'] = $betAttr['numChips'];
        $_SESSION['chipSize'] = $betAttr['chipSize'];
        $_SESSION['lastStops'] = $spinData['report']['stops'];
    }

    protected function getSpinData() {
        $respin = false;
        /* Определяем параметры wildStorm */
        if(rnd(1, $this->gameParams->wildStormParams['chance']) == $this->gameParams->wildStormParams['chance']) {
            $wildStormStart = true;
            $reelsCount = $this->getRandParam($this->gameParams->wildStormParams['reelsCountRand']);
            $wildReels = [];
            while(count($wildReels) != $reelsCount) {
                $r = rnd(0,4);
                if(!in_array($r, $wildReels)) {
                    $wildReels[] = $r;
                }
            }
        }
        else {
            $wildStormStart = false;

        }
        if($wildStormStart) {
            $bonus = array(
                'type' => 'wildReels',
                'reels' => $wildReels,
            );

            $this->slot->setReels($this->gameParams->reels[5]);
        }
        else {
            $bonus = array();
            $this->slot->setReels($this->gameParams->reels[0]);
        }
        /* ------- */
        $report = $this->slot->spin($bonus);
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';
        $bonusCount = 0;
        if($wildStormStart) {
            $report['wildStorm'] = true;
        }
        else {
            $report['wildStorm'] = false;
        }

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $report['type'] = 'FREESPIN';
                $_SESSION['spinType'] = 'fs';
            }
        }

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    $_SESSION['fsLevel'] = 20;
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'wildstorm':
                    if(!$report['wildStorm']) $respin = true;
                    break;
            }
        }

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
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        $wins = '';

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
                $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
                $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100;

        $wildStormOffsets = '';
        $wildStormExtend = '';
        $reelSet = '0';
        if($report['wildStorm']) {
            $wo = array();
            foreach($report['bonusData']['offsets'] as $o) {
                $wo = array_merge($wo, $o);
            }
            $wildStormOffsets = ' wildVABoxes="'.implode(',', $wo).'"';
            $wildStormExtend = '<ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="WildStorm" isActiveCurrentSpin="1" isActiveNextSpin="1" />
                <QualifyingRandomWildWins>
                    <Win payline="0" id="59" numCoinsWon="70" matchPos="10,6,2" />
                </QualifyingRandomWildWins>
            </ExtendedSpinStyles>';
            $reelSet = '5';
        }


        $response = '<Pkt>
    <Id mid="12772" cid="10001" sid="1866" sessionid="ddef7de9-bffa-49b2-9b92-4ea56862d19a" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278" />
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="'.$reelSet.'" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1"'.$wildStormOffsets.'>
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="'.$report['numChips'].'" nextChipSize="'.$report['chipSize'].'" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
            '.$wildStormExtend.'
        </Slot>
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

    public function showFreeSpinReport($report, $totalWin) {

        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        $wins = '<Wins>'.PHP_EOL;
        foreach($report['winLines'] as $w) {
            $pos = $this->invertOffsets($w['line']);
            $posStr = implode(',', $pos);
            $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
            $double = '';
            if($w['double'] > 1) {
                $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
            }
            $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
        }
        $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
        $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
        $wins .= '<Win payline="-1" id="77" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';

        $wins .= '</Wins>'.PHP_EOL;


        $balance = $this->getBalance() * 100;

        $_SESSION['baseWin'] = $totalWin * 100;

        $visArea = '<VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins;

        $savedState = '<Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="1105028">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="370600" chipSize="5" date="2014-10-28 15:26:42" />
                <PlayInfo value="156400" chipSize="5" date="2014-08-15 11:23:52" />
                <PlayInfo value="154250" chipSize="5" date="2014-09-11 20:39:33" />
                <PlayInfo value="98850" chipSize="5" date="2014-09-11 20:08:23" />
                <PlayInfo value="96950" chipSize="5" date="2014-08-23 18:58:01" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">'.$visArea;

        $response = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="8c763c64-3d58-4194-a168-cd26cd1e60dc" verb="Spin" />
    <Response>
        <Framework state="2" />
            '.$savedState.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
        </Slot>
        <BonusGames lastBonusPlayed="-1">
            <Bonus id="3" state="1" win="0" items="0,1,2,3" extraPicksForActiveLevel="0" maxPlayerPicksAllowed="1" activeBonusLevel="0" levelStates="1" lastPlayedBonusLevel="-1" gameEndRule="-1" tickets="1" ticketsNeeded="1" winScaler="NoWinnings">
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="20" tokenIDsAwarded="" multiplier="1500.000000000000000" />
            </Bonus>
        </BonusGames>
        <Achievements>
            <Achievement name="GreatHallofSpins" isComplete="0" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
        </Achievements>
    </Response>
</Pkt>';

        $_SESSION['savedState'] = base64_encode(gzcompress($savedState, 9));
        $_SESSION['visArea'] = base64_encode(gzcompress($visArea, 9));
        $_SESSION['fsTotalWin'] = $totalWin;

        $_SESSION['state'] = 2;

        $this->outXML($response);
    }

    protected function startBonusPick($item) {
        if($_SESSION['spinType'] !== 'fs') die();
        $level = $_SESSION['fsLevel'];
        if($item == 0) {
            $this->startValkyrie();
            $_SESSION['fsType'] = 0;
            $_SESSION['fsCount'] = 10;
        }
        else if($item == 1 && $level >= 5) {
            $this->startLoki();
            $_SESSION['fsType'] = 1;
            $_SESSION['fsCount'] = 15;
        }
        else if($item == 2 && $level >= 10) {
            $this->startOdin();
            $_SESSION['fsType'] = 2;
            $_SESSION['fsCount'] = 20;
        }
        else if($item == 3 && $level >= 15) {
            $this->startThor();
            $_SESSION['fsType'] = 3;
            $_SESSION['fsCount'] = 25;
        }
        else {
            die('hack error');
        }
    }

    protected function startValkyrie() {
        $savedState = gzuncompress(base64_decode($_SESSION['savedState']));

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="57d8ef12-8817-4ace-ba2c-1f291eb88408" verb="BonusPick" />
    <Response>
        <Framework state="3" />
        '.$savedState.'
            <NextSpin freeSpinsRemaining="10" reelSet="1" freeSpinMultiplier="5" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="3000" />
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="10" freeSpinReelSet="1" freeSpinMultiplier="5" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
        </Slot>
        <BonusGames lastBonusPlayed="3">
            <Bonus id="3" state="3" win="0" items="0,1,2,3" extraPicksForActiveLevel="0" maxPlayerPicksAllowed="1" activeBonusLevel="-1" levelStates="3" lastPlayedBonusLevel="0" gameEndRule="-1" tickets="1" ticketsNeeded="1" winScaler="NoWinnings">
                <Picks>
                    <Pick item="0" pickedBy="1" pickedByLevel="0">
                        <Result id="0" rawValue="0" value="0" consolationValue="0" multiplier="0" playerBenefit="2" doesMultiplierApply="0" credits="0" />
                    </Pick>
                </Picks>
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="0" tokenIDsAwarded="0" multiplier="1500.000000000000000" />
            </Bonus>
        </BonusGames>
        <Achievements>
            <Achievement name="GreatHallofSpins" isComplete="1" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
        </Achievements>
    </Response>
</Pkt>';

        $this->outXML($responce);
    }

    protected function startLoki() {
        $savedState = gzuncompress(base64_decode($_SESSION['savedState']));

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="04d5b890-efcd-4427-ac36-1f7f79c8f5ea" verb="BonusPick" />
    <Response>
        <Framework state="3" />
        '.$savedState.'
            <NextSpin freeSpinsRemaining="15" reelSet="2" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="10" nextChipSize="1" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="600" />
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="15" freeSpinReelSet="2" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Loki JumpingWild" isActiveCurrentSpin="0" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
        <TriggerConditions>
            <TriggerCondition id="12">
                <TriggeredEffect id="0" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>
        <BonusGames lastBonusPlayed="3">
            <Bonus id="3" state="3" win="0" items="0,1,2,3" extraPicksForActiveLevel="0" maxPlayerPicksAllowed="1" activeBonusLevel="-1" levelStates="3" lastPlayedBonusLevel="0" gameEndRule="-1" tickets="1" ticketsNeeded="1" winScaler="NoWinnings">
                <Picks>
                    <Pick item="1" pickedBy="1" pickedByLevel="0">
                        <Result id="0" rawValue="0" value="0" consolationValue="0" multiplier="0" playerBenefit="2" doesMultiplierApply="0" credits="0" />
                    </Pick>
                </Picks>
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="0" tokenIDsAwarded="0" multiplier="300.000000000000000" />
            </Bonus>
        </BonusGames>
        <Achievements>
            <Achievement name="GreatHallofSpins" isComplete="1" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
        </Achievements>
    </Response>
</Pkt>';

        $this->outXML($responce);
    }

    protected function startOdin() {
        $savedState = gzuncompress(base64_decode($_SESSION['savedState']));

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="941cf6d9-6ea1-4f53-96cb-8c383ee758c0" verb="BonusPick" />
    <Response>
        <Framework state="3" />
        '.$savedState.'
            <NextSpin freeSpinsRemaining="20" reelSet="3" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="3000" />
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="20" freeSpinReelSet="3" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Odin Ravens" isActiveCurrentSpin="0" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
        <TriggerConditions>
            <TriggerCondition id="18">
                <TriggeredEffect id="0" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>
        <BonusGames lastBonusPlayed="3">
            <Bonus id="3" state="3" win="0" items="0,1,2,3" extraPicksForActiveLevel="0" maxPlayerPicksAllowed="1" activeBonusLevel="-1" levelStates="3" lastPlayedBonusLevel="0" gameEndRule="-1" tickets="1" ticketsNeeded="1" winScaler="NoWinnings">
                <Picks>
                    <Pick item="2" pickedBy="1" pickedByLevel="0">
                        <Result id="0" rawValue="0" value="0" consolationValue="0" multiplier="0" playerBenefit="2" doesMultiplierApply="0" credits="0" />
                    </Pick>
                </Picks>
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="0" tokenIDsAwarded="0" multiplier="1500.000000000000000" />
            </Bonus>
        </BonusGames>
        <Achievements>
            <Achievement name="GreatHallofSpins" isComplete="1" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
        </Achievements>
    </Response>
</Pkt>';
        $this->outXML($responce);
    }

    protected function startThor() {
        $savedState = gzuncompress(base64_decode($_SESSION['savedState']));

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="cd2b7f05-ba94-4c6b-aa75-e1c28f73b97f" verb="BonusPick" />
    <Response>
        <Framework state="3" />
        '.$savedState.'
            <NextSpin freeSpinsRemaining="25" reelSet="4" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="3500" />
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="25" freeSpinReelSet="4" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Thor ReelSlide" isActiveCurrentSpin="0" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
        <TriggerConditions>
            <TriggerCondition id="19">
                <TriggeredEffect id="0" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>
        <BonusGames lastBonusPlayed="3">
            <Bonus id="3" state="3" win="0" items="0,1,2,3" extraPicksForActiveLevel="0" maxPlayerPicksAllowed="1" activeBonusLevel="-1" levelStates="3" lastPlayedBonusLevel="0" gameEndRule="-1" tickets="1" ticketsNeeded="1" winScaler="NoWinnings">
                <Picks>
                    <Pick item="3" pickedBy="1" pickedByLevel="0">
                        <Result id="0" rawValue="0" value="0" consolationValue="0" multiplier="0" playerBenefit="2" doesMultiplierApply="0" credits="0" />
                    </Pick>
                </Picks>
                <TokenManager name="Bonus_Valkyrie_Loki_Odin_ThorTokenMan" numTokensToCollect="0" tokenIDsAwarded="0" multiplier="1500.000000000000000" />
            </Bonus>
        </BonusGames>
        <Achievements>
            <Achievement name="GreatHallofSpins" isComplete="1" wasJustAwarded="0" tokensRequired="'.(20 - $_SESSION['fsLevel']).'" tokensCollected="'.$_SESSION['fsLevel'].'" />
        </Achievements>
    </Response>
</Pkt>';

        $this->outXML($responce);
    }



    protected function startFreeSpin() {
        if($_SESSION['spinType'] !== 'fs' || $_SESSION['fsCount'] <= 0) {
            die('hack error');
        }

        $stake = $_SESSION['lastBet'];

        $this->slot = new Slot($this->gameParams, $_SESSION['lastPick'], $stake);
        $this->slot->setScatter(array(14));
        $spinData = $this->getFreeSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl(0, $totalWin * 100) || $respin) {
            $spinData = $this->getFreeSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        if(empty($spinData['report']['type'])) {
            $type = $spinData['report'][0]['type'];
            $spinData['report'][0]['numChips'] = $_SESSION['numChips'];
            $spinData['report'][0]['chipSize'] = $_SESSION['chipSize'];
            $spinData['report'][0]['coinRatio'] = 100 / $_SESSION['chipSize'];
        }
        else {
            $type = $spinData['report']['type'];
            $spinData['report']['numChips'] = $_SESSION['numChips'];
            $spinData['report']['chipSize'] = $_SESSION['chipSize'];
            $spinData['report']['coinRatio'] = 100 / $_SESSION['chipSize'];
        }

        switch($type) {
            case 'Valkyrie':
                $this->showValkyrieReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'Loki':
                $this->showLokiReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'Odin':
                $this->showOdinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'Thor':
                $this->showThorReport($spinData['report'], $spinData['totalWin']);
                break;
        }
        if($_SESSION['fsCount'] == 0) {
            $_SESSION['spinType'] = 'spin';
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['fsCount']);
            unset($_SESSION['fsType']);
            unset($_SESSION['visArea']);
            unset($_SESSION['lastSlot']);

        }

        $_SESSION['state'] = 0;
        unset($_SESSION['savedState']);


        game_ctrl(0, $totalWin * 100, 0, 'standart');
    }

    protected function getFreeSpinData() {
        switch($_SESSION['fsType']) {
            case 0:
                $data = $this->getValkyrieData();
                break;
            case 1:
                $data = $this->getLokiData();
                break;
            case 2:
                $data = $this->getOdinData();
                break;
            case 3:
                $data = $this->getThorData();
                break;
        }
        return $data;
    }

    protected function getValkyrieData() {
        $respin = false;

        $this->slot->setReels($this->gameParams->reels[1]);
        $bonus = array(
            'type' => 'multiple',
            'range' => array(5,5),
        );
        $multiple = 5;

        $report = $this->slot->spin($bonus);
        $report['scattersReport'] = $this->slot->getScattersCount();

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
        }

        $report['type'] = 'Valkyrie';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function getLokiData() {
        $respin = false;
        $this->slot->setReels($this->gameParams->reels[2]);

        $bonus = array(
            'type' => 'setWildsIf',
            'symbol' => 'C',
            'reel' => 2,
            'countConfig' => $this->gameParams->lokiWild,
        );

        $report = $this->slot->spin($bonus);
        $report['scattersReport'] = $this->slot->getScattersCount();

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
        }

        $report['type'] = 'Loki';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function getOdinData() {
        $respin = false;
        $this->slot->setReels($this->gameParams->reels[3]);

        $bonus = array(
            'type' => 'odinRavens',
            'positions' => $this->gameParams->odinRavens['positions'],
            'x3Chance' => $this->gameParams->odinRavens['x3Chance'],
            'x6Chance' => $this->gameParams->odinRavens['x6Chance'],
        );

        $report = $this->slot->spin($bonus);
        $report['scattersReport'] = $this->slot->getScattersCount();

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
        }

        $report['type'] = 'Odin';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function getThorData() {
        $respin = false;
        $this->slot->setReels($this->gameParams->reels[4]);

        $multiple = 1;
        $reports = array();

        $bonus = array(
            'type' => 'multiple',
            'range' => array($multiple, $multiple),
        );

        $report = $this->slot->spin($bonus);
        $report['scattersReport'] = $this->slot->getScattersCount();

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
        }

        $report['rsName'] = 'Base';
        $report['type'] = 'Thor';
        $reports[] = $report;

        $totalWin = $report['totalWin'];

        if(!empty($report['winLines']) || $report['scattersReport']['count'] >= 2) {

            $w = $report['winLines'];
            $s = $report['scattersReport']['count'];
            $r = $report;
            $stageCount = 0;
            while(!empty($w) || $s >= 2) {
                $multiple++;
                if($multiple > 5) $multiple = 5;
                $this->slot->setBonus(array(
                    'type' => 'multiple',
                    'range' => array($multiple, $multiple),
                ));
                $this->slot->startAvalanche($r, array(), false, 2);
                $r = $this->slot->getReport();
                $r['type'] = 'AVALANCHE';
                $r['rsName'] = 'Base';
                $r['trigger'] = $report['drawID'];
                $r['stage'] = $stageCount;
                $r['scattersReport'] = $this->slot->getScattersCount();

                $preTotal = $totalWin;
                if($r['scattersReport']['count'] >= 3) {
                    $r['scattersReport']['totalWin'] = $r['bet'] * $this->gameParams->scatterMultiple[$r['scattersReport']['count']];
                    $r['totalWin'] += $r['scattersReport']['totalWin'];
                }
                $totalWin += $r['totalWin'];

                $w = $r['winLines'];

                $r['runningTotal'] = $preTotal + $r['totalWin'];

                $reports[] = $r;
                $stageCount++;
            }
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $reports,
            'respin' => $respin,
        );
    }

    protected function showValkyrieReport($report, $totalWin) {
        $_SESSION['fsTotalWin'] += $totalWin;
        $visArea = gzuncompress(base64_decode($_SESSION['visArea']));

        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        $wins = '';

        $fsAdd = '';

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
                $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
                $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
                if($report['scattersReport']['count'] >= 3) {
                    $_SESSION['fsCount'] += 10;
                    $fsAdd = '<TriggerConditions>
            <TriggerCondition id="9" type="Composite">
                <TriggerCondition id="0" />
                <TriggerCondition id="1" />
                <TriggeredEffect id="0" type="FreeSpinAdder" freeSpinNum="10" numTimesApplied="1" />
            </TriggerCondition>
        </TriggerConditions>';
                }
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $_SESSION['fsCount']--;

        $slot = '<Slot win="'.$totalWin * 100 .'" triggeringWin="'. $_SESSION['baseWin'] .'" state="2" freeSpinMultiplier="5" freeSpinMultiplierStatus="0" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" reelSet="1" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin freeSpinsRemaining="'.$_SESSION['fsCount'].'" reelSet="1" freeSpinMultiplier="5" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="'.$report['numChips'].'" nextChipSize="'.$report['chipSize'].'" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$_SESSION['baseWin'].'">
                '.$visArea.'
            </TriggeringSpin>
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="10" freeSpinReelSet="1" freeSpinMultiplier="5" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
        </Slot>';

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="57d8ef12-8817-4ace-ba2c-1f291eb88408" verb="FreeSpin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$_SESSION['fsTotalWin'] * 100 .'" userID="131505" transNumber="979278">
        </Player>
        '.$slot.$fsAdd.'
    </Response>
</Pkt>';

        $_SESSION['lastSlot'] = base64_encode(gzcompress($slot, 9));

        $this->outXML($responce);
    }

    protected function showLokiReport($report, $totalWin) {
        $_SESSION['fsTotalWin'] += $totalWin;
        $visArea = gzuncompress(base64_decode($_SESSION['visArea']));

        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        $addFs = '';
        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
                $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
                $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
                if($report['scattersReport']['count'] >= 2) {
                    $fsAddCount = $report['scattersReport']['count'] - 1;
                    $_SESSION['fsCount'] += $fsAddCount;
                    $addFs = '<FreeSpinAward freeSpinNum="'.$fsAddCount.'" freeSpinReelSet="2" freeSpinMultiplier="0" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="0" win="0" />';
                }
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $_SESSION['fsCount']--;

        if(!empty($report['bonusData'])) {
            $bonusOffset = $this->invertOffsets($report['bonusData']['randomWilds']);
            $visAdd = ' wildVABoxes="'.implode(',', $bonusOffset).'"';
            $wildBase = $this->invertOffsets($report['bonusData']['baseWildOffset']);
            $extend = '<ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Loki JumpingWild" isActiveCurrentSpin="1" isActiveNextSpin="1" />
                <QualifyingRandomWildWins>
                    <Win payline="-1" id="83" numCoinsWon="0" matchPos="'.$wildBase.'" />
                </QualifyingRandomWildWins>
            </ExtendedSpinStyles>';
        }
        else {
            $visAdd = '';
            $extend = '<ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Loki JumpingWild" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>';
        }

        $slot = '<Slot win="'.$totalWin * 100 .'" triggeringWin="'. $_SESSION['baseWin'] .'" state="2" freeSpinMultiplier="1" freeSpinMultiplierStatus="0" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" reelSet="2" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1"'.$visAdd.'>
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin freeSpinsRemaining="'.$_SESSION['fsCount'].'" reelSet="2" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="'.$report['numChips'].'" nextChipSize="'.$report['chipSize'].'" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$_SESSION['baseWin'].'">
                '.$visArea.'
            </TriggeringSpin>
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="15" freeSpinReelSet="2" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="3750" />
                '.$addFs.'
            </FreeSpinAwards>
            '.$extend.'
        </Slot>';

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="04d5b890-efcd-4427-ac36-1f7f79c8f5ea" verb="FreeSpin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$_SESSION['fsTotalWin'] * 100 .'" userID="131505" transNumber="979278"></Player>
        '.$slot.'
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $_SESSION['lastSlot'] = base64_encode(gzcompress($slot, 9));

        $this->outXML($responce);
    }

    protected function showOdinReport($report, $totalWin) {
        $_SESSION['fsTotalWin'] += $totalWin;
        $visArea = gzuncompress(base64_decode($_SESSION['visArea']));

        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                $double = '';
                if($w['double'] > 1 || !empty($w['addMultiplier'])) {
                    $w['addMultiplier'][] = $w['double'];
                    $doubleStr = implode(',', $w['addMultiplier']);
                    $double = ' multipliers="'.$doubleStr.'" multiplierOperation="Multiply" multiple="'.$doubleStr.'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
                $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
                $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $_SESSION['fsCount']--;

        if(!empty($report['bonusData'])) {
            $bonusOffset = array_reverse($this->invertOffsets($report['bonusData']['randomWilds']));
            $visAdd = ' wildVABoxes="'.implode(',', $bonusOffset).'"';
            $resultX = 1;
            foreach($this->slot->bonusWildsMultiple as $b) {
                $resultX *= $b['multiple'];
            }
            $extend = '<ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Raven'.$resultX.'x" isActiveCurrentSpin="1" isActiveNextSpin="0" />
                <ExtendedSpinStyle styleName="Odin Ravens" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>';
        }
        else {
            $visAdd = '';
            $extend = '<ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Raven2x" isActiveCurrentSpin="1" isActiveNextSpin="0" />
                <ExtendedSpinStyle styleName="Odin Ravens" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>';
        }

        $slot = '<Slot win="'.$totalWin * 100 .'" triggeringWin="'.$_SESSION['baseWin'] .'" state="2" freeSpinMultiplier="1" freeSpinMultiplierStatus="0" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" reelSet="3" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1"'.$visAdd.'>
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin freeSpinsRemaining="'.$_SESSION['fsCount'].'" reelSet="3" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="'.$report['numChips'].'" nextChipSize="'.$report['chipSize'].'" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$_SESSION['baseWin'].'">
                '.$visArea.'
            </TriggeringSpin>
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="20" freeSpinReelSet="3" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="1500" />
            </FreeSpinAwards>
            '.$extend.'
        </Slot>';

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="941cf6d9-6ea1-4f53-96cb-8c383ee758c0" verb="FreeSpin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$_SESSION['fsTotalWin'] * 100 .'" userID="131505" transNumber="979278"></Player>
        '.$slot.'
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $_SESSION['lastSlot'] = base64_encode(gzcompress($slot, 9));

        $this->outXML($responce);
    }

    protected function showThorReport($reports, $totalWin) {
        $report = $reports[0];

        $_SESSION['fsTotalWin'] += $totalWin;
        $visArea = gzuncompress(base64_decode($_SESSION['visArea']));

        if($totalWin == 0) {

        }
        else {
            $matchPos = array();
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                foreach($pos as $p) {
                    $matchPos[] = $p;
                }
            }
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        if(count($reports) == 1) {
            $reelSlide = '<ReelSlide maxMultiplier="5" maxReelSlides="60" multiplierIncrement="1" />';
        }
        else {
            $reelSlide = '<ReelSlide maxMultiplier="5" maxReelSlides="60" multiplierIncrement="1">';
            for($i = 1; $i < count($reports); $i++) {
                $r = $reports[$i];
                $multiple = $i + 1;
                if($multiple > 5) $multiple = 5;
                $dissolved = implode(',', array_unique($matchPos));

                $reelPos1 = implode(',', $this->arrayDecrease($r['offset']['1']));
                $reelPos2 = implode(',', $this->arrayDecrease($r['offset']['2']));
                $reelPos3 = implode(',', $this->arrayDecrease($r['offset']['3']));
                $row1 = implode(',', $r['rows']['1']);
                $row2 = implode(',', $r['rows']['2']);
                $row3 = implode(',', $r['rows']['3']);

                $totalCoins = 0;
                if($r['totalWin'] == 0) {
                    $wins = '<Wins />';
                }
                else {
                    $wins = '<Wins>'.PHP_EOL;
                    $matchPos = array();

                    foreach($r['winLines'] as $w) {
                        $pos = $this->invertOffsets($w['line']);
                        foreach($pos as $p) {
                            $matchPos[] = $p;
                        }
                        $posStr = implode(',', $pos);
                        $coins = $r['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                        $totalCoins += $coins;
                        $double = '';
                        if($w['double'] > 1) {
                            $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                        }
                        $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
                    }
                    if(!empty($this->gameParams->scatterMultiple[$r['scattersReport']['count']])) {
                        $offsets = $this->invertOffsets($r['scattersReport']['offsets']);
                        $scatterTotalWin = $r['scattersReport']['totalWin'] * $report['coinRatio'];
                        $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
                    }
                    $wins .= '</Wins>'.PHP_EOL;
                }

                $str = '<ReelSlideStep step="'.($i - 1).'" activeMultiplier="'.$multiple.'" dissolvedVABoxes="'.$dissolved.'" win="'.$totalCoins.'">
                    <VisArea numRows="3" numCols="5" numPaylines="1">
                        <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                        <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                        <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
                    </VisArea>
                    '.$wins.'
                </ReelSlideStep>';

                $reelSlide .= $str;
            }

            $reelSlide .= '</ReelSlide>';
        }

        $_SESSION['fsCount']--;

        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['startRows']['1']);
        $row2 = implode(',', $report['startRows']['2']);
        $row3 = implode(',', $report['startRows']['3']);

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            $matchPos = array();
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                foreach($pos as $p) {
                    $matchPos[] = $p;
                }
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * $report['coinRatio'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $offsets = $this->invertOffsets($report['scattersReport']['offsets']);
                $scatterTotalWin = $report['scattersReport']['totalWin'] * $report['coinRatio'];
                $wins .= '<Win payline="-1" id="78" numCoinsWon="'.$scatterTotalWin.'" matchPos="'.implode(',', $offsets).'" />';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $slot = '<Slot win="'.$totalWin * 100 .'" triggeringWin="'.$_SESSION['baseWin'] .'" state="2" freeSpinMultiplier="1" freeSpinMultiplierStatus="0" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" reelSet="4" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            '.$reelSlide.'
            <NextSpin freeSpinsRemaining="'.$_SESSION['fsCount'].'" reelSet="4" freeSpinMultiplier="1" freeSpinGuaranteedWin="0" scaledFreeSpinGuaranteedWin="0" freeSpinMultiplyGuaranteedWin="0" nextActivePaylines="0" nextNumChips="'.$report['numChips'].'" nextChipSize="'.$report['chipSize'].'" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$_SESSION['baseWin'].'">
                '.$visArea.'
            </TriggeringSpin>
            <FreeSpinAwards>
                <FreeSpinAward freeSpinNum="25" freeSpinReelSet="4" freeSpinMultiplier="1" freeSpinMaxMultiplier="0" freeSpinGuaranteedWin="0" freeSpinMultiplierGuaranteedWin="0" wasAwardedAtStart="1" win="0" />
            </FreeSpinAwards>
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="Thor ReelSlide" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>';

        $responce = '<Pkt>
    <Id mid="12772" cid="10001" sid="1867" sessionid="cd2b7f05-ba94-4c6b-aa75-e1c28f73b97f" verb="FreeSpin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$_SESSION['fsTotalWin'] * 100 .'" userID="131505" transNumber="979278"></Player>
        '.$slot.'
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $_SESSION['lastSlot'] = base64_encode(gzcompress($slot, 9));

        $this->outXML($responce);
    }

}
