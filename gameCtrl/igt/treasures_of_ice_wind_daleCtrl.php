<?
require_once('IGTCtrl.php');

class treasures_of_ice_wind_daleCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1201-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="DUNGEONS &amp; DRAGONS Treasures of Icewind Dale"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="TreasuresOfIcewindDale"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

        $this->outXML($xml);
    }

    protected function startPaytable($request) {
        $symbolPay = $this->getSymbolPay();

        $baseReel1 = $this->getReelXml($this->gameParams->reels[0]);
        $baseReel2 = $this->getReelXml($this->gameParams->reels[1]);
        $freeReel1 = $this->getReelXml($this->gameParams->reels[2]);
        $freeReel2 = $this->getReelXml($this->gameParams->reels[3]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="TreasuresOfIcewindDale 40L 3x3x3x3x3" gameOnlyRTP="" jackpotPPH="" maxRTP="96.52" minRTP="93.06" name="Dungeons and Dragons Treasures of Icewind Dale" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoScatter" strategy="payAny">
        <Prize name="b01">
            <PrizePay count="3" pph="124" value="3"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BSet0">
        '.$baseReel1.'
    </StripInfo>
    <StripInfo name="BSet1">
        '.$baseReel2.'
    </StripInfo>
    <StripInfo name="FSet0">
        '.$freeReel1.'
    </StripInfo>
    <StripInfo name="FSet1">
        '.$freeReel2.'
    </StripInfo>
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy>highestOnly</Strategy>
            <MaxFreeSpins>225</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="15" name="3 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>constantDecrement</Strategy>
            <Count>1</Count>
        </Decrement>
        <OutcomeTrigger name="freeSpin"/>
    </FreeSpinInfo>
    <PatternSliderInfo>
        <PatternInfo max="30" min="30">
            <Step>30</Step>
        </PatternInfo>
        <BetInfo max="1000" min="1">
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
        <Denomination softwareId="200-1201-001">1.0</Denomination>
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
        <GameLogicVersion>1.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043390203</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="19">
            <Cell name="L0C0R0" stripIndex="19">s03</Cell>
            <Cell name="L0C0R1" stripIndex="20">s03</Cell>
            <Cell name="L0C0R2" stripIndex="21">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="12">
            <Cell name="L0C1R0" stripIndex="12">s08</Cell>
            <Cell name="L0C1R1" stripIndex="13">s03</Cell>
            <Cell name="L0C1R2" stripIndex="14">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="65">
            <Cell name="L0C2R0" stripIndex="65">b01</Cell>
            <Cell name="L0C2R1" stripIndex="66">s08</Cell>
            <Cell name="L0C2R2" stripIndex="67">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="11">
            <Cell name="L0C3R0" stripIndex="11">s03</Cell>
            <Cell name="L0C3R1" stripIndex="12">s03</Cell>
            <Cell name="L0C3R2" stripIndex="13">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s07</Cell>
            <Cell name="L0C4R1" stripIndex="47">s07</Cell>
            <Cell name="L0C4R2" stripIndex="48">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>7d625d41454150405b595a7f414750565d571050344040545e5972515e5a7d5e50564b04120212132f535f540d0f73554153735159561d6b55575c602446100f3a240d715c424649145d5254550f126124575e625559131441424659447a5d5d554a0d1171100c3b39240d77575a58105a525e5c0d107c0302026001120d4240405f44795a5756410d1000117f706154441d1d76615340001871605c44021c71125746011c6f625146061872675647091c70635635021e73634845041e74675540031f7b635744036d706154441d1d76615340001871605c44021c71125746011c6f62514606081f77565f550e38390f6e775c4542540f3e0e19645f44465f58445b5f5d0e4746525f40540a38</Data>
    </ObfuscatedOutcome>
    <ObfuscatedOutcome>
        <Data>7d625d41454150405b595a7f414750565d571050344040545e5972515e5a7d5e50564b04120212132f535f540d0f73554153735159561d6a535a555e2061574512133b3d0e735a44464a1357515f550e63615159554050675742161047474150407b5e57244a0f13000f0f3e3b3f0873515f5f195e535d567c107e01731d630410164744465a43705e56554b7c1002130e1e0207010518030700000a1c01030072011e02031e02071e05070307001f0a030103006d010102031e1d07010507031800000a03011c00720101021c1e0207010518030700000a1c01030072011e02031e02071e05070307000f1673575c5f7f383b0d1f685f40404f0a3a081c635640475c52355b5d5f7f5845575d5b510e3e</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="BaseGame.CurrentReelSet" stage="BaseGame">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">BSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.InitialReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.InitialReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>30</PatternsBet>
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