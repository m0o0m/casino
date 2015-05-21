<?
require_once('IGTCtrl.php');

class golden_goddessCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1186-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Golden Goddess"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="GoldenGoddess"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="GoldenGoddess 40L 3x3x3x3x3" gameOnlyRTP="" jackpotPPH="" maxRTP="96.00" minRTP="93.50" name="GoldenGoddes" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="payAny">
        <Prize name="b01">
            <PrizePay count="9" pph="112.0" value="0"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="layerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
            <Pick cellName="pick3" name="L0C0R1"/>
            <Pick cellName="pick4" name="L0C1R1"/>
            <Pick cellName="pick5" name="L0C2R1"/>
            <Pick cellName="pick6" name="L0C0R2"/>
            <Pick cellName="pick7" name="L0C1R2"/>
            <Pick cellName="pick8" name="L0C2R2"/>
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>1</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="freespin"/>
        <ExitOutcomeTrigger name="freespin"/>
        <Triggers/>
        <Increment>
            <Strategy>noIncrement</Strategy>
            <Triggers/>
        </Increment>
        <Decrement>
            <Strategy>pickSize</Strategy>
            <Count>0</Count>
            <Triggers/>
        </Decrement>
    </PickerInfo>
    <PatternSliderInfo>
        <PatternInfo max="40" min="40">
            <Step>40</Step>
        </PatternInfo>
        <BetInfo max="3000" min="1">
            <Step>1</Step>
            <Step>2</Step>
            <Step>3</Step>
            <Step>5</Step>
            <Step>10</Step>
            <Step>20</Step>
            <Step>30</Step>
            <Step>50</Step>
            <Step>100</Step>
            <Step>200</Step>
            <Step>300</Step>
            <Step>500</Step>
            <Step>1000</Step>
            <Step>2000</Step>
            <Step>3000</Step>
        </BetInfo>
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame"/>
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <SelectiveStackingBetIncrements name="SelectiveStackingValues">
        <Value>1</Value>
        <Value>2</Value>
        <Value>3</Value>
        <Value>5</Value>
        <Value>10</Value>
        <Value>20</Value>
        <Value>30</Value>
        <Value>50</Value>
        <Value>100</Value>
        <Value>200</Value>
        <Value>300</Value>
        <Value>500</Value>
        <Value>1000</Value>
        <Value>2000</Value>
        <Value>3000</Value>
    </SelectiveStackingBetIncrements>
    <DenominationList>
        <Denomination softwareId="200-1186-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>50.0</MaxBet>
    </GameBetInfo>
    <AutoSpinInfo enable="True">
        <Step>10</Step>
        <Step>20</Step>
        <Step>30</Step>
        <Step>40</Step>
        <Step>50</Step>
    </AutoSpinInfo>
    <VersionInfo>
        <GameLogicVersion>1.1</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = $_SESSION['fsState'];
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>7</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>7</TotalAwarded>
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
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="9 b01" symbolCount="9" totalPay="0" ways="0" />
    </PrizeOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PickerInput>
        <Pick name="L0C0R1" />
    </PickerInput>
    <PopulationOutcome name="Picker.FreeSpinSymbol" stage="Picker">
        <Entry name="FreeSpinSymbol" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">'.$_SESSION['currentSymbol'].'</Cell>
        </Entry>
    </PopulationOutcome>'.$display2;
        }

        $patternsBet = 40;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14264049105193</TransactionId>
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
        <Entry name="Reel0" stripIndex="99">
            <Cell name="L0C0R0" stripIndex="99">s01</Cell>
            <Cell name="L0C0R1" stripIndex="100">s08</Cell>
            <Cell name="L0C0R2" stripIndex="101">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="31">
            <Cell name="L0C1R0" stripIndex="31">s02</Cell>
            <Cell name="L0C1R1" stripIndex="32">s06</Cell>
            <Cell name="L0C1R2" stripIndex="33">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="89">
            <Cell name="L0C2R0" stripIndex="89">s02</Cell>
            <Cell name="L0C2R1" stripIndex="90">w01</Cell>
            <Cell name="L0C2R2" stripIndex="91">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="24">
            <Cell name="L0C3R0" stripIndex="24">s03</Cell>
            <Cell name="L0C3R1" stripIndex="25">s04</Cell>
            <Cell name="L0C3R2" stripIndex="26">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="38">
            <Cell name="L0C4R0" stripIndex="38">s01</Cell>
            <Cell name="L0C4R1" stripIndex="39">s03</Cell>
            <Cell name="L0C4R2" stripIndex="40">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.InitialReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="99">
            <Cell name="L0C0R0" stripIndex="99">s01</Cell>
            <Cell name="L0C0R1" stripIndex="100">s08</Cell>
            <Cell name="L0C0R2" stripIndex="101">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="31">
            <Cell name="L0C1R0" stripIndex="31">s02</Cell>
            <Cell name="L0C1R1" stripIndex="32">s06</Cell>
            <Cell name="L0C1R2" stripIndex="33">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="89">
            <Cell name="L0C2R0" stripIndex="89">s02</Cell>
            <Cell name="L0C2R1" stripIndex="90">w01</Cell>
            <Cell name="L0C2R2" stripIndex="91">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="24">
            <Cell name="L0C3R0" stripIndex="24">s03</Cell>
            <Cell name="L0C3R1" stripIndex="25">s04</Cell>
            <Cell name="L0C3R2" stripIndex="26">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="38">
            <Cell name="L0C4R0" stripIndex="38">s01</Cell>
            <Cell name="L0C4R1" stripIndex="39">s03</Cell>
            <Cell name="L0C4R2" stripIndex="40">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>'.$patternsBet.'</PatternsBet>
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

        $this->spinPays[] = $spinData['report']['spinWin'];

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
        if(!isset($_SESSION['fsType'])) {
            $pick = (array) $request['PickerInput']->Pick;
            $pick = $pick['@attributes']['name'];
            $pick1 = $pick[3];
            $pick2 = $pick[5];

            $this->showPickInfo(array($pick1, $pick2));
        }
        else {
            $_SESSION['fsState'] = 'FreeSpin';
            $stake = $_SESSION['lastBet'];
            $pick = $_SESSION['lastPick'];

            $this->slot = new Slot($this->gameParams, $pick, $stake);
            $this->slot->createCustomReels($this->gameParams->reels[1], array(4,4,4,4,4));
            $this->slot->rows = 4;

            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];

            while(!game_ctrl(0, $totalWin * 100) || $respin) {
                $spinData = $this->getSpinData();
                $totalWin = $spinData['totalWin'];
                $respin = $spinData['respin'];
            }

            $this->fsPays[] = $spinData['report']['totalWin'];

            $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

            $_SESSION['lastBet'] = $stake;
            $_SESSION['lastPick'] = $pick;
            $_SESSION['lastStops'] = $spinData['report']['stops'];
            $this->startPay();
        }
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array(
            array(
                'type' => 'randomReplace',
                'symbols' => array(61,65),
                'replacement' => array(0,1,2,3,4,5,6,7,8,9),
            ),
            array(
                'type' => 'randomReplace',
                'symbols' => array(62,63,64),
                'replacement' => array(0,1,2,3,4,5,6,7,8,9,21),
            ),
        );

        if($_SESSION['state'] == 'FREE') {
            $symbolID = $this->gameParams->getSymbolId($_SESSION['currentSymbol']);
            $bonus = array(
                'type' => 'randomReplace',
                'symbols' => array(61,62,63,64,65),
                'replacement' => array($symbolID[0]),
            );
        }

        $report = $this->slot->spin($bonus);



        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] == 9) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
        }

        $totalWin = $report['totalWin'];

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
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['fsState'] = 'Picker';

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$scattersHighlight.'
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlight.'

    '.$display.'

    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.'
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="9 b01" symbolCount="9" totalPay="0" ways="0" />
    </PrizeOutcome>
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
        $_SESSION['initAwarded'] = 7;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
    }

    protected function showPickInfo($pick) {
        $balance = $this->getBalance();
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');

        $symbols = array('s01', 's02', 's03', 's04');

        $picker = '<PickerOutcome name=""><Layer index="0" name="layer0">';
        $current = '';
        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 3; $j++) {
                $picked = 'false';
                $rnd = $this->getRandParam($symbols);
                if($i == $pick[0] && $j == $pick[1]) {
                    $current = $rnd;
                    $picked = 'true';
                }
                $picker .= '<Pick name="L0C'.$i.'R'.$j.'" picked="'.$picked.'"><Feature type="populate" value="'.$rnd.'" /></Pick>';
            }
        }
        $picker .= '</Layer></PickerOutcome>';

        $_SESSION['currentSymbol'] = $current;

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1440-14228620554882</TransactionId>
        <Stage>Picker</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>40</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
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
    '.$picker.'
    <PopulationOutcome name="Picker.FreeSpinSymbol" stage="Picker">
        <Entry name="FreeSpinSymbol" stripIndex="0">
            <Cell name="L0C'.$pick[0].'R'.$pick[1].'" stripIndex="0">'.$current.'</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display2.'
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="9 b01" symbolCount="9" totalPay="0" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Lines" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="Game.Total" pay="0" stage="" totalPay="0" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="0" payName="" symbolCount="0" totalPay="0" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14228773024519</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>40</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="L0C'.$pick[0].'R'.$pick[1].'" />
    </PickerInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['fsType'] = 'good';
    }



    protected function showPlayFreeSpinReport($report, $totalWin) {

        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $needBalance = $_SESSION['startBalance'];

        $_SESSION['fsTotalWin'] += $totalWin;

        $nextStage = 'FreeSpin';
        $baseReels = '';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'];
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        }

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228769811206</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>50</Pending>
        <Payout>'.$report['totalWin'].'</Payout>
    </OutcomeDetail>
    '.$highlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PopulationOutcome name="Picker.FreeSpinSymbol" stage="Picker">
        <Entry name="FreeSpinSymbol" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">'.$_SESSION['currentSymbol'].'</Cell>
        </Entry>
    </PopulationOutcome>
    '.$baseReels.$display.'

    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="40" multiplier="1" name="Scatter" pay="0" payName="9 b01" symbolCount="9" totalPay="0" ways="0" />
    </PrizeOutcome>

    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14228769811020</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PickerInput>
        <Pick name="L0C0R1" />
    </PickerInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
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
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['fsState']);
            unset($_SESSION['initAwarded']);
            unset($_SESSION['fsType']);
            unset($_SESSION['currentSymbol']);
        }
    }

}