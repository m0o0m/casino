<?
require_once('IGTCtrl.php');

class cash_coasterCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1232-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Cash Coaster"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="CashCoaster"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Cash Coaster 30L 3x3x3x3x3" maxRTP="96.06" minRTP="91.99" name="Cash Coaster" type="Slot" />
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="PayBoth">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="3" pph="142.4" value="1" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="Pick0" name="L0C0R0" />
            <Pick cellName="Pick1" name="L0C1R0" />
            <Pick cellName="Pick2" name="L0C2R0" />
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>50</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="FreeSpin" />
        <ExitOutcomeTrigger name="FreeSpin" />
        <Triggers />
        <Increment>
            <Strategy>NoIncrement</Strategy>
            <Triggers />
        </Increment>
        <Decrement>
            <Strategy>PickSize</Strategy>
            <Count>0</Count>
            <Triggers />
        </Decrement>
    </PickerInfo>
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy> HighestOnly </Strategy>
            <MaxFreeSpins> 200  </MaxFreeSpins>
            <Triggers>
                <Trigger freespins="0" name="3 b01" />
                <!-- The following triggers are for front-end ONLY please do not clone this method -->
                <Trigger freespins="4" name="4spins" />
                <Trigger freespins="5" name="5spins" />
                <Trigger freespins="6" name="6spins" />
                <Trigger freespins="4" name="4spinsRetrigger" />
                <Trigger freespins="5" name="5spinsRetrigger" />
                <Trigger freespins="6" name="6spinsRetrigger" />
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy> ConstantDecrement </Strategy>
            <Count> 1  </Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin" />
    </FreeSpinInfo>
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
    <DenominationList>
        <Denomination softwareId="200-1232-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>30.0</MaxBet>
    </GameBetInfo>
    <AutoSpinInfo enable="True">
        <Step>10</Step>
        <Step>20</Step>
        <Step>30</Step>
        <Step>40</Step>
        <Step>50</Step>
    </AutoSpinInfo>
    <VersionInfo>
        <GameLogicVersion>2.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2310-14264037677168</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="17">
            <Cell name="L0C0R0" stripIndex="15">s11</Cell>
            <Cell name="L0C0R1" stripIndex="16">s01</Cell>
            <Cell name="L0C0R2" stripIndex="17">s06</Cell>
            <Cell name="L0C0R3" stripIndex="18">s05</Cell>
            <Cell name="L0C0R4" stripIndex="19">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="34">
            <Cell name="L0C1R0" stripIndex="32">s04</Cell>
            <Cell name="L0C1R1" stripIndex="33">s02</Cell>
            <Cell name="L0C1R2" stripIndex="34">s01</Cell>
            <Cell name="L0C1R3" stripIndex="35">s10</Cell>
            <Cell name="L0C1R4" stripIndex="36">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="103">
            <Cell name="L0C2R0" stripIndex="101">s02</Cell>
            <Cell name="L0C2R1" stripIndex="102">s11</Cell>
            <Cell name="L0C2R2" stripIndex="103">b01</Cell>
            <Cell name="L0C2R3" stripIndex="104">s06</Cell>
            <Cell name="L0C2R4" stripIndex="105">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="17">
            <Cell name="L0C3R0" stripIndex="15">s02</Cell>
            <Cell name="L0C3R1" stripIndex="16">s06</Cell>
            <Cell name="L0C3R2" stripIndex="17">s03</Cell>
            <Cell name="L0C3R3" stripIndex="18">b01</Cell>
            <Cell name="L0C3R4" stripIndex="19">s10</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="6">
            <Cell name="L0C4R0" stripIndex="4">s01</Cell>
            <Cell name="L0C4R1" stripIndex="5">s08</Cell>
            <Cell name="L0C4R2" stripIndex="6">s11</Cell>
            <Cell name="L0C4R3" stripIndex="7">s04</Cell>
            <Cell name="L0C4R4" stripIndex="8">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="0">w01</Cell>
            <Cell name="L0C0R1" stripIndex="1">w01</Cell>
            <Cell name="L0C0R2" stripIndex="2">w01</Cell>
            <Cell name="L0C0R3" stripIndex="3">w01</Cell>
            <Cell name="L0C0R4" stripIndex="4">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="4">s11</Cell>
            <Cell name="L0C1R1" stripIndex="5">s11</Cell>
            <Cell name="L0C1R2" stripIndex="6">s01</Cell>
            <Cell name="L0C1R3" stripIndex="7">s08</Cell>
            <Cell name="L0C1R4" stripIndex="8">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="18">s03</Cell>
            <Cell name="L0C2R1" stripIndex="19">s07</Cell>
            <Cell name="L0C2R2" stripIndex="20">s06</Cell>
            <Cell name="L0C2R3" stripIndex="21">b01</Cell>
            <Cell name="L0C2R4" stripIndex="22">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="4">s11</Cell>
            <Cell name="L0C3R1" stripIndex="5">s05</Cell>
            <Cell name="L0C3R2" stripIndex="6">s09</Cell>
            <Cell name="L0C3R3" stripIndex="7">s10</Cell>
            <Cell name="L0C3R4" stripIndex="8">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="0">w01</Cell>
            <Cell name="L0C4R1" stripIndex="1">w01</Cell>
            <Cell name="L0C4R2" stripIndex="2">w01</Cell>
            <Cell name="L0C4R3" stripIndex="3">w01</Cell>
            <Cell name="L0C4R4" stripIndex="4">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <TriggerOutcome component="" name="MysteryTrigger" stage="" />
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
        $display = $this->getDisplay($report, true);
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