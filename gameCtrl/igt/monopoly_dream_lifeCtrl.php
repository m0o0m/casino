<?
require_once('IGTCtrl.php');

class monopoly_dream_lifeCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1192-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="MONOPOLY Dream Life"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="MonopolyDreamLife"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Monopoly Dream Life 20L 3x3x3x3x3" maxRTP="96.01" minRTP="94.44" name="Monopoly Dream Life" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="FreeSpinPrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
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
            <Pick cellName="pick3" name="L0C3R0"/>
            <Pick cellName="pick4" name="L0C4R0"/>
            <Pick cellName="pick5" name="L0C5R0"/>
            <Pick cellName="pick6" name="L0C6R0"/>
            <Pick cellName="pick7" name="L0C7R0"/>
            <Pick cellName="pick8" name="L0C8R0"/>
            <Pick cellName="pick9" name="L0C9R0"/>
            <Pick cellName="pick10" name="L0C10R0"/>
            <Pick cellName="pick11" name="L0C11R0"/>
            <Pick cellName="pick12" name="L0C12R0"/>
            <Pick cellName="pick13" name="L0C13R0"/>
            <Pick cellName="pick14" name="L0C14R0"/>
            <Pick cellName="pick15" name="L0C15R0"/>
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>6</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <AutoAdvance>false</AutoAdvance>
        <OutcomeTrigger name="picker"/>
        <ExitOutcomeTrigger name="picker"/>
        <Triggers/>
        <Increment>
            <Strategy>noIncrement</Strategy>
            <Triggers/>
        </Increment>
        <Decrement>
            <Strategy>Trigger</Strategy>
            <Count>0</Count>
            <Triggers>
                <!-- Each time a card is accepted, decrement picks remaining by 1 (need 4 total accepted cards) -->
                <Trigger name="accept" picks="1"/>
            </Triggers>
        </Decrement>
    </PickerInfo>
    <FreeSpinInfo name="Picker.FreeSpinInfo.PotentialCardPrize">
        <Reset>true</Reset>
        <Increment>
            <Strategy>additive</Strategy>
            <MaxFreeSpins>16</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="5" name="blue2"/>
                <Trigger freespins="4" name="blue1"/>
                <Trigger freespins="4" name="green2"/>
                <Trigger freespins="3" name="green1"/>
                <Trigger freespins="3" name="yellow2"/>
                <Trigger freespins="2" name="yellow1"/>
                <Trigger freespins="3" name="red2"/>
                <Trigger freespins="2" name="red1"/>
                <Trigger freespins="3" name="orange2"/>
                <Trigger freespins="1" name="orange1"/>
                <Trigger freespins="3" name="pink2"/>
                <Trigger freespins="1" name="pink1"/>
                <Trigger freespins="2" name="turquoise2"/>
                <Trigger freespins="1" name="turquoise1"/>
                <Trigger freespins="2" name="brown2"/>
                <Trigger freespins="1" name="brown1"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>noDecrement</Strategy>
            <Count>0</Count>
        </Decrement>
        <OutcomeTrigger name="freeSpin"/>
    </FreeSpinInfo>
    <PatternSliderInfo>
        <PatternInfo max="20" min="20">
            <Step>20</Step>
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
    <DenominationList>
        <Denomination softwareId="200-1192-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>20.0</MaxBet>
    </GameBetInfo>
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
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2310-14264037729876</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="8">
            <Cell name="L0C1R0" stripIndex="8">s02</Cell>
            <Cell name="L0C1R1" stripIndex="9">s06</Cell>
            <Cell name="L0C1R2" stripIndex="10">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="24">
            <Cell name="L0C2R0" stripIndex="24">s07</Cell>
            <Cell name="L0C2R1" stripIndex="25">s01</Cell>
            <Cell name="L0C2R2" stripIndex="26">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="11">
            <Cell name="L0C3R0" stripIndex="11">w01</Cell>
            <Cell name="L0C3R1" stripIndex="12">s06</Cell>
            <Cell name="L0C3R2" stripIndex="13">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="15">
            <Cell name="L0C4R0" stripIndex="15">s07</Cell>
            <Cell name="L0C4R1" stripIndex="16">s05</Cell>
            <Cell name="L0C4R2" stripIndex="17">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="26">
            <Cell name="L0C1R0" stripIndex="26">s03</Cell>
            <Cell name="L0C1R1" stripIndex="27">s06</Cell>
            <Cell name="L0C1R2" stripIndex="28">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="21">
            <Cell name="L0C2R0" stripIndex="21">w01</Cell>
            <Cell name="L0C2R1" stripIndex="22">w01</Cell>
            <Cell name="L0C2R2" stripIndex="23">w01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="11">
            <Cell name="L0C3R0" stripIndex="11">w01</Cell>
            <Cell name="L0C3R1" stripIndex="12">w01</Cell>
            <Cell name="L0C3R2" stripIndex="13">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="11">
            <Cell name="L0C4R0" stripIndex="11">s07</Cell>
            <Cell name="L0C4R1" stripIndex="12">s04</Cell>
            <Cell name="L0C4R2" stripIndex="13">s03</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>20</PatternsBet>
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
        }

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

        $report = $this->slot->spin();

        $report['type'] = 'SPIN';

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

}