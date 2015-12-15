<?
require_once('IGTCtrl.php');

class pyramidCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1024-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="100,000 Pyramid"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="Pyramid"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="100K Pyramid 15L 3x3x3x3x3" maxRTP="95.03" minRTP="92.78" name="100K Pyramid" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAllExcept" name="FreeSpinPrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAllExcept" name="FreeSpinPrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="5" pph="92631.2" value="15"/>
            <PrizePay count="4" pph="1894.7" value="10"/>
            <PrizePay count="3" pph="100.4" value="5"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">15</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>5</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <AutoAdvance>false</AutoAdvance>
        <OutcomeTrigger name="Picker"/>
        <ExitOutcomeTrigger name="FreeSpin"/>
        <Layer index="0" name="layer0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
            <Pick cellName="pick3" name="L0C3R0"/>
            <Pick cellName="pick4" name="L0C4R0"/>
        </Layer>
        <Layer index="1" name="layer1">
            <Pick cellName="pick0" name="L1C0R0"/>
            <Pick cellName="pick1" name="L1C1R0"/>
            <Pick cellName="pick2" name="L1C2R0"/>
            <Pick cellName="pick3" name="L1C3R0"/>
        </Layer>
        <Layer index="2" name="layer2">
            <Pick cellName="pick0" name="L2C0R0"/>
            <Pick cellName="pick1" name="L2C1R0"/>
            <Pick cellName="pick2" name="L2C2R0"/>
        </Layer>
        <Layer index="3" name="layer3">
            <Pick cellName="pick0" name="L3C0R0"/>
            <Pick cellName="pick1" name="L3C1R0"/>
        </Layer>
        <Layer index="4" name="layer4">
            <Pick cellName="pick0" name="L4C0R0"/>
        </Layer>
    </PickerInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="15" min="1">
            <Step>1</Step>
            <Step>3</Step>
            <Step>5</Step>
            <Step>9</Step>
            <Step>15</Step>
        </PatternInfo>
        '.$this->getBetInfo().'
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame"/>
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <DenominationList>
        <Denomination softwareId="200-1024-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>15.0</MaxBet>
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
        <TransactionId>A2210-14264043380841</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s03</Cell>
            <Cell name="L0C0R1" stripIndex="01">s05</Cell>
            <Cell name="L0C0R2" stripIndex="02">s08</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s05</Cell>
            <Cell name="L0C1R1" stripIndex="01">s02</Cell>
            <Cell name="L0C1R2" stripIndex="02">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s03</Cell>
            <Cell name="L0C2R1" stripIndex="01">s07</Cell>
            <Cell name="L0C2R2" stripIndex="02">s02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">s03</Cell>
            <Cell name="L0C3R1" stripIndex="01">s04</Cell>
            <Cell name="L0C3R2" stripIndex="02">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="0">
            <Cell name="L0C4R0" stripIndex="0">s05</Cell>
            <Cell name="L0C4R1" stripIndex="01">s02</Cell>
            <Cell name="L0C4R2" stripIndex="02">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s03</Cell>
            <Cell name="L0C0R1" stripIndex="01">s02</Cell>
            <Cell name="L0C0R2" stripIndex="02">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s09</Cell>
            <Cell name="L0C1R1" stripIndex="01">s08</Cell>
            <Cell name="L0C1R2" stripIndex="02">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">w01</Cell>
            <Cell name="L0C2R1" stripIndex="01">s07</Cell>
            <Cell name="L0C2R2" stripIndex="02">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">s06</Cell>
            <Cell name="L0C3R1" stripIndex="01">b01</Cell>
            <Cell name="L0C3R2" stripIndex="02">s09</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="0">
            <Cell name="L0C4R0" stripIndex="0">s07</Cell>
            <Cell name="L0C4R1" stripIndex="01">s01</Cell>
            <Cell name="L0C4R2" stripIndex="02">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>15</PatternsBet>
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
        $betPerLine = (float) $obj->BetPerPattern;

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