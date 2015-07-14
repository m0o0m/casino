<?
require_once('IGTCtrl.php');

class black_widowCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params>
    <param name="softwareid" value="200-1187-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Black Widow"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="BlackWidow"/>
    <param name="studio" value="interactive"/>
    <param name="nsbuyinamount" value=""/>
    <param name="buildnumber" value="4.2.F.O.CL104654_220"/>
    <param name="autopull" value="N"/>
    <param name="consoleCode" value="CSTM"/>
    <param name="BCustomViewHeight" value="47"/>
    <param name="BCustomViewWidth" value="1024"/>
    <param name="consoleTimeStamp" value="1349855268588"/>
    <param name="filtered" value="Y"/>
    <param name="defaultbuyinamount" value="0.0"/>
    <param name="xtautopull" value=""/>
    <param name="server" value="../../../../../"/>
    <param name="showInitialCashier" value="false"/>
    <param name="audio" value="on"/>
    <param name="nscode" value="MRGR"/>
    <param name="uniqueid" value="Guest"/>
    <param name="countrycode" value=""/>
    <param name="presenttype" value="FLSH"/>
    <param name="securetoken" value=""/>
    <param name="denomamount" value="1.0"/>
    <param name="skincode" value="MRGR"/>
    <param name="language" value="en"/>
    <param name="channel" value="INT"/>
    <param name="currencycode" value="FPY"/>
</params>';

        $this->outXML($xml);
    }

    protected function startPaytable($request) {
        $symbolPay = $this->getSymbolPay();

        $baseReel = $this->getReelXml($this->gameParams->reels[0]);
        $freeReel = $this->getReelXml($this->gameParams->reels[1]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="BlackWidow 40L 3x3x3x3x3" gameOnlyRTP="" jackpotPPH="" maxRTP="96.00" minRTP="91.99" name="BlackWidow" type="Slot" />
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoScatter" strategy="payAny">
        <Prize name="b01">
            <PrizePay count="9" value="0" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="WebCapture.PrizeInfo" strategy="payTrigger">
        <!-- GreenMan Prizes -->
        <Prize name="GreenPrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="GreenPrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="GreenPrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="GreenPrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="GreenPrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="GreenPrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="GreenPrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="GreenPrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="GreenPrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="GreenPrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="GreenPrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="GreenPrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="GreenPrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="GreenPrize14">
            <PrizePay count="1" value="1000" />
        </Prize>
        <!-- RedMan Prizes -->
        <Prize name="RedPrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="RedPrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="RedPrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="RedPrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="RedPrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="RedPrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="RedPrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="RedPrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="RedPrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="RedPrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="RedPrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="RedPrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="RedPrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="RedPrize14">
            <PrizePay count="1" value="1000" />
        </Prize>
        <!-- BlueMan Prizes -->
        <Prize name="BluePrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="BluePrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="BluePrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="BluePrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="BluePrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="BluePrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="BluePrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="BluePrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="BluePrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="BluePrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="BluePrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="BluePrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="BluePrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="BluePrize14">
            <PrizePay count="1" value="1000" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="40" min="40">
            <Step>40</Step>
        </PatternInfo>
        '.$betPattern.'
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame" />
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <SelectiveStackingBetIncrements name="SelectiveStackingValues">
        '.$selective.'
    </SelectiveStackingBetIncrements>
    <DenominationList>
        <Denomination softwareId="200-1187-001">1.0</Denomination>
    </DenominationList>
    <AutoSpinInfo enable="True">
        <Step>10</Step>
        <Step>20</Step>
        <Step>30</Step>
        <Step>40</Step>
        <Step>50</Step>
    </AutoSpinInfo>
    <VersionInfo>
        <GameLogicVersion>1.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $this->setSessionIfEmpty('greenLevel', 1);
        $this->setSessionIfEmpty('redLevel', 1);
        $this->setSessionIfEmpty('blueLevel', 1);
        $this->setSessionIfEmpty('state', 'SPIN');

        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>10</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>';

            $fs .= '<PrizeOutcome multiplier="1" name="WebCapture.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="1 s01" symbolCount="1" totalPay="0" ways="0" />
    </PrizeOutcome>';
            $fs .= '<HighlightOutcome name="WebCapture.Scatter" type=""/>';
            $fs .= '<TriggerOutcome component="" name="WebCapture" stage=""/>';
            $fs .= '<TriggerOutcome component="" name="WebCapture.Prizes" stage=""/>';
            $fs .= '<PrizeOutcome multiplier="1" name="WebCapture.Total" pay="0" stage="" totalPay="0" type="Pattern"/>';
            $fs .= '<TriggerOutcome component="" name="CurrentLevels" stage="">
        <Trigger name="GreenLevel'.$_SESSION['greenLevel'].'" priority="0" stageConnector="" />
        <Trigger name="RedLevel'.$_SESSION['redLevel'].'" priority="0" stageConnector="" />
        <Trigger name="BlueLevel'.$_SESSION['blueLevel'].'" priority="0" stageConnector="" />
    </TriggerOutcome>';
        }

        $patternsBet = 100;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043298614</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.'
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="46">
            <Cell name="L0C0R0" stripIndex="46">s02</Cell>
            <Cell name="L0C0R1" stripIndex="47">s07</Cell>
            <Cell name="L0C0R2" stripIndex="48">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="36">
            <Cell name="L0C1R0" stripIndex="36">s05</Cell>
            <Cell name="L0C1R1" stripIndex="37">w01</Cell>
            <Cell name="L0C1R2" stripIndex="38">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="53">
            <Cell name="L0C2R0" stripIndex="53">s04</Cell>
            <Cell name="L0C2R1" stripIndex="54">s05</Cell>
            <Cell name="L0C2R2" stripIndex="55">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="33">
            <Cell name="L0C3R0" stripIndex="33">s04</Cell>
            <Cell name="L0C3R1" stripIndex="34">s07</Cell>
            <Cell name="L0C3R2" stripIndex="35">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="39">
            <Cell name="L0C4R0" stripIndex="39">s03</Cell>
            <Cell name="L0C4R1" stripIndex="40">w01</Cell>
            <Cell name="L0C4R2" stripIndex="41">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="101">
            <Cell name="L0C0R0" stripIndex="101">w01</Cell>
            <Cell name="L0C0R1" stripIndex="102">w01</Cell>
            <Cell name="L0C0R2" stripIndex="103">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="62">
            <Cell name="L0C1R0" stripIndex="62">s06</Cell>
            <Cell name="L0C1R1" stripIndex="63">s08</Cell>
            <Cell name="L0C1R2" stripIndex="64">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="98">
            <Cell name="L0C2R0" stripIndex="98">s01</Cell>
            <Cell name="L0C2R1" stripIndex="99">s01</Cell>
            <Cell name="L0C2R2" stripIndex="100">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="80">
            <Cell name="L0C3R0" stripIndex="80">s09</Cell>
            <Cell name="L0C3R1" stripIndex="81">s02</Cell>
            <Cell name="L0C3R2" stripIndex="82">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="23">
            <Cell name="L0C4R0" stripIndex="23">s04</Cell>
            <Cell name="L0C4R1" stripIndex="24">s04</Cell>
            <Cell name="L0C4R2" stripIndex="25">s04</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>40</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $obj = $request['PatternSliderInput'];
        $totalBet = $obj->PatternsBet;
        $betPerLine = $obj->BetPerPattern;

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

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

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->gameParams->symbolWithoutWild = array(2,3,4);

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,3,3,3,3));
        $this->slot->rows = 3;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array(
            array(
                'type' => 'randomReplace',
                'symbols' => array(11,15),
                'replacement' => array(0,1,2,3,4,5,6,7,8,9),
            ),
            array(
                'type' => 'randomReplace',
                'symbols' => array(12,13,14),
                'replacement' => array(0,1,2,3,4,5,6,7,8,9,10),
            ),
        );


        $checkRespin = false;
        if($this->gameParams->testBonusEnable && $_SESSION['state'] == 'SPIN') {
            $url = $_SERVER['HTTP_REFERER'];
            $g = '';
            if(strpos($url, 'bonus=fs') > 0) {
                $g = 'fs';
            }
            switch($g) {
                case 'fs':
                    $checkRespin = true;
                    $bonus = array(
                        array(
                            'type' => 'randomReplace',
                            'symbols' => array(11,15),
                            'replacement' => array(0,1,2,3,4,5,6,7,8,9),
                        ),
                        array(
                            'type' => 'randomReplace',
                            'symbols' => array(12,13,14),
                            'replacement' => array(10),
                        ),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);


        $report['type'] = 'SPIN';

        if($_SESSION['state'] == 'FREE') {
            $greenLevel = $_SESSION['greenLevel'];
            $redLevel = $_SESSION['redLevel'];
            $blueLevel = $_SESSION['blueLevel'];


            $_SESSION['levelUp'] = false;
            $_SESSION['greenWin'] = $_SESSION['redWin'] = $_SESSION['blueWin'] = 0;
            $symbol = $this->slot->getReelSymbol(2,1);
            if($symbol == 1) {
                $_SESSION['levelUp'] = 'Woman';

                $greenLevel++;
                if($greenLevel > 14) $greenLevel = 14;
                $redLevel++;
                if($redLevel > 14) $redLevel = 14;
                $blueLevel++;
                if($blueLevel > 14) $blueLevel = 14;

                $multiple = $this->gameParams->captureLevels[$greenLevel-2];
                $_SESSION['greenWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['greenWin'];

                $multiple = $this->gameParams->captureLevels[$redLevel-2];
                $_SESSION['redWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['redWin'];

                $multiple = $this->gameParams->captureLevels[$blueLevel-2];
                $_SESSION['blueWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['blueWin'];
            }
            if($symbol == 2) {
                $greenLevel++;
                if($greenLevel > 14) $greenLevel = 14;
                $_SESSION['levelUp'] = 'Green';
                $multiple = $this->gameParams->captureLevels[$greenLevel-2];
                $_SESSION['greenWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['greenWin'];
            }
            if($symbol == 3) {
                $redLevel++;
                if($redLevel > 14) $redLevel = 14;
                $_SESSION['levelUp'] = 'Red';
                $multiple = $this->gameParams->captureLevels[$redLevel-2];
                $_SESSION['redWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['redWin'];
            }
            if($symbol == 4) {
                $blueLevel++;
                if($blueLevel > 14) $blueLevel = 14;
                $_SESSION['levelUp'] = 'Blue';
                $multiple = $this->gameParams->captureLevels[$blueLevel-2];
                $_SESSION['blueWin'] = $report['bet'] * $multiple;
                $report['totalWin'] += $_SESSION['blueWin'];
            }
        }

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] == 9) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
        }
        else {
            if($this->gameParams->testBonusEnable && $_SESSION['state'] == 'SPIN' && $checkRespin) {
                $respin = true;
            }
        }

        $report['spinWin'] = $report['totalWin'];
        $totalWin = $report['totalWin'];

        if(!$respin && $_SESSION['state'] == 'FREE') {
            $_SESSION['greenLevel'] = $greenLevel;
            $_SESSION['redLevel'] = $redLevel;
            $_SESSION['blueLevel'] = $blueLevel;
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>'.$report['bet'].'</Settled>
        <Pending>0</Pending>
        <Payout>'.$totalWin.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    '.$highlight.'

    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="0" stage="" totalPay="0" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$scattersHighlight.'
    <TriggerOutcome component="" name="CurrentLevels" stage="">
        <Trigger name="GreenLevel1" priority="0" stageConnector="" />
        <Trigger name="RedLevel1" priority="0" stageConnector="" />
        <Trigger name="BlueLevel1" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="WebCapture" stage="" />
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="WebCapture.Prizes" stage="" />
    <TriggerOutcome component="" name="FreeSpin" stage="">
        <Trigger name="freespin" priority="0" stageConnector="" />
    </TriggerOutcome>
    <HighlightOutcome name="WebCapture.Scatter" type="" />
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="50">
            <Cell name="L0C0R0" stripIndex="50">s01</Cell>
            <Cell name="L0C0R1" stripIndex="51">s06</Cell>
            <Cell name="L0C0R2" stripIndex="52">s03</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="53">
            <Cell name="L0C1R0" stripIndex="53">s08</Cell>
            <Cell name="L0C1R1" stripIndex="54">s02</Cell>
            <Cell name="L0C1R2" stripIndex="55">s05</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="20">s07</Cell>
            <Cell name="L0C2R1" stripIndex="21">s07</Cell>
            <Cell name="L0C2R2" stripIndex="22">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="72">
            <Cell name="L0C3R0" stripIndex="72">s07</Cell>
            <Cell name="L0C3R1" stripIndex="73">s06</Cell>
            <Cell name="L0C3R2" stripIndex="74">s08</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="50">
            <Cell name="L0C4R0" stripIndex="50">s03</Cell>
            <Cell name="L0C4R1" stripIndex="51">s05</Cell>
            <Cell name="L0C4R2" stripIndex="52">s07</Cell>
        </Entry>
    </PopulationOutcome>
    '.$highlight.'

    '.$display.'
    <FreeSpinOutcome name="">
        <InitAwarded>7</InitAwarded>
        <Awarded>7</Awarded>
        <TotalAwarded>7</TotalAwarded>
        <Count>0</Count>
        <Countdown>7</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$report['scattersReport']['totalWin'].'" stage="" totalPay="'.$report['scattersReport']['totalWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$report['scattersReport']['totalWin'].'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 7;
        $_SESSION['fsLeft'] = 7;
        $_SESSION['fsPlayed'] = 0;

        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlight.$winLines, 9));

        $_SESSION['greenLevel'] = 1;
        $_SESSION['redLevel'] = 1;
        $_SESSION['blueLevel'] = 1;
    }



    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];
        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));

        $awarded = 0;
        $scattersHighlight = '';
        if($report['scattersReport']['count'] == 9) {
            $_SESSION['totalAwarded'] += 7;
            $_SESSION['fsLeft'] += 7;
            $awarded = 7;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $needBalance = $_SESSION['startBalance'];

        if(!$_SESSION['levelUp']) {
            $webCaptureHightlight = '<HighlightOutcome name="WebCapture.Scatter" type=""/>';
            $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture" stage=""/>';
            $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture.Prizes" stage=""/>';
            $webCaptureHightlight .= '<PrizeOutcome multiplier="1" name="WebCapture.Total" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $webCaptureHightlight = '<HighlightOutcome name="WebCapture.Scatter" type="">
        <Highlight name="Scatter" type="">
            <Cell name="L0C2R1" type="" />
        </Highlight>
    </HighlightOutcome>';

            $WtotalWin = $_SESSION['greenWin'] + $_SESSION['redWin'] + $_SESSION['blueWin'];
            $greenLevel = $_SESSION['greenLevel'] - 1;
            $redLevel = $_SESSION['redLevel'] - 1;
            $blueLevel = $_SESSION['blueLevel'] - 1;

            if($_SESSION['levelUp'] == 'Woman') {
                $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture" stage="">
        <Trigger name="Woman" priority="0" stageConnector="" />
    </TriggerOutcome>';
                $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture.Prizes" stage="">
        <Trigger name="GreenPrize'.($_SESSION['greenLevel']-1).'" priority="0" stageConnector="" />
        <Trigger name="RedPrize'.($_SESSION['redLevel']-1).'" priority="0" stageConnector="" />
        <Trigger name="BluePrize'.($_SESSION['blueLevel']-1).'" priority="0" stageConnector="" />
    </TriggerOutcome>';




                $webCaptureHightlight .= '<PrizeOutcome multiplier="1" name="WebCapture.Total" pay="'.$WtotalWin.'" stage="" totalPay="'.$WtotalWin.'" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="GreenPrize'.$greenLevel.'" pay="'.$_SESSION['greenLevel'].'" payName="GreenPrize'.$greenLevel.'" symbolCount="1" totalPay="'.$_SESSION['greenWin'].'" ways="0" />
        <Prize betMultiplier="40" multiplier="1" name="RedPrize'.$redLevel.'" pay="'.$_SESSION['redLevel'].'" payName="RedPrize'.$redLevel.'" symbolCount="1" totalPay="'.$_SESSION['redWin'].'" ways="0" />
        <Prize betMultiplier="40" multiplier="1" name="BluePrize'.$blueLevel.'" pay="'.$_SESSION['blueLevel'].'" payName="BluePrize'.$blueLevel.'" symbolCount="1" totalPay="'.$_SESSION['blueWin'].'" ways="0" />
    </PrizeOutcome>';
            }
            else {
                $u = strtolower($_SESSION['levelUp']);
                $level = $_SESSION[$u.'Level'] - 1;
                $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture" stage="">
        <Trigger name="'.$_SESSION['levelUp'].'Man" priority="0" stageConnector="" />
    </TriggerOutcome>';
                $webCaptureHightlight .= '<TriggerOutcome component="" name="WebCapture.Prizes" stage="">
        <Trigger name="'.$_SESSION['levelUp'].'Prize'.$level.'" priority="0" stageConnector="" />
    </TriggerOutcome>';

                $webCaptureHightlight .= '<PrizeOutcome multiplier="1" name="WebCapture.Total" pay="'.$WtotalWin.'" stage="" totalPay="'.$WtotalWin.'" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="'.$_SESSION['levelUp'].'Prize'.$level.'" pay="'.($level+1).'" payName="'.$_SESSION['levelUp'].'Prize'.$level.'" symbolCount="1" totalPay="'.$WtotalWin.'" ways="0" />
    </PrizeOutcome>';
            }
        }



        $_SESSION['fsTotalWin'] += $totalWin;

        $nextStage = 'FreeSpin';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
        }

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseScatter.'
    <TriggerOutcome component="" name="CurrentLevels" stage="">
        <Trigger name="GreenLevel'.$_SESSION['greenLevel'].'" priority="0" stageConnector="" />
        <Trigger name="RedLevel'.$_SESSION['redLevel'].'" priority="0" stageConnector="" />
        <Trigger name="BlueLevel'.$_SESSION['blueLevel'].'" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$webCaptureHightlight.'
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlight.'
    '.$scattersHighlight.'
    '.$display.'
    <FreeSpinOutcome name="">
        <InitAwarded>10</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="WebCapture.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="1 s01" symbolCount="1" totalPay="0" ways="0" />
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$needBalance.'">
        <Balance name="FREE">'.$needBalance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}