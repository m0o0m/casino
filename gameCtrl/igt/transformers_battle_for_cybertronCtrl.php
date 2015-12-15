<?
require_once('IGTCtrl.php');

class transformers_battle_for_cybertronCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1194-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="TRANSFORMERS Battle For Cybertron"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="TransformersBattleForCybertron"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="TRANSFORMERS Battle For Cybertron 40L 4x4x4x4x4" maxRTP="96.47" minRTP="92.61" name="TRANSFORMERS Battle For Cybertron" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="FreeSpinPrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
            <Pick cellName="pick3" name="L0C3R0"/>
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
        <AutoAdvance>false</AutoAdvance>
        <OutcomeTrigger name="FreeSpin"/>
        <ExitOutcomeTrigger name="FreeSpin"/>
        <Triggers>
            <Trigger name="3 b01" picks="1"/>
        </Triggers>
        <Increment>
            <Strategy>NoIncrement</Strategy>
            <Triggers/>
        </Increment>
        <Decrement>
            <Strategy>PickSize</Strategy>
            <Count>0</Count>
        </Decrement>
    </PickerInfo>
    <PatternSliderInfo>
        <PatternInfo max="60" min="60">
            <Step>60</Step>
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
        <Denomination softwareId="200-1194-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>60.0</MaxBet>
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
        <TransactionId>A2310-14264037762802</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s05</Cell>
            <Cell name="L0C0R1" stripIndex="4">s02</Cell>
            <Cell name="L0C0R2" stripIndex="5">s04</Cell>
            <Cell name="L0C0R3" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="17">
            <Cell name="L0C1R0" stripIndex="17">s03</Cell>
            <Cell name="L0C1R1" stripIndex="18">s06</Cell>
            <Cell name="L0C1R2" stripIndex="19">s01</Cell>
            <Cell name="L0C1R3" stripIndex="20">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="13">
            <Cell name="L0C2R0" stripIndex="13">s03</Cell>
            <Cell name="L0C2R1" stripIndex="14">s07</Cell>
            <Cell name="L0C2R2" stripIndex="15">s05</Cell>
            <Cell name="L0C2R3" stripIndex="16">w01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="2">
            <Cell name="L0C3R0" stripIndex="2">s03</Cell>
            <Cell name="L0C3R1" stripIndex="3">s05</Cell>
            <Cell name="L0C3R2" stripIndex="4">s04</Cell>
            <Cell name="L0C3R3" stripIndex="5">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="2">s06</Cell>
            <Cell name="L0C4R1" stripIndex="3">s02</Cell>
            <Cell name="L0C4R2" stripIndex="4">b01</Cell>
            <Cell name="L0C4R3" stripIndex="5">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">spins,5,multiplier,10,trigger,MegatronMult</Cell>
            <!-- Megatron Multipier -->
        </Entry>
        <Entry name="L0C1R0" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">spins,8,multiplier,10,trigger,OptimusMult</Cell>
            <!-- Optimus Multiplier -->
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,12,multiplier,5,trigger,ShockwaveMult</Cell>
            <!-- Shockwave Multiplier -->
        </Entry>
        <Entry name="L0C3R0" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">spins,15,multiplier,4,trigger,BumblebeeMult</Cell>
            <!-- Bumblebee Multiplier -->
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s03</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s02</Cell>
            <Cell name="L0C0R3" stripIndex="5">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="4">
            <Cell name="L0C1R0" stripIndex="4">s05</Cell>
            <Cell name="L0C1R1" stripIndex="5">s03</Cell>
            <Cell name="L0C1R2" stripIndex="6">s06</Cell>
            <Cell name="L0C1R3" stripIndex="7">s02</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="16">
            <Cell name="L0C2R0" stripIndex="16">s01</Cell>
            <Cell name="L0C2R1" stripIndex="17">s06</Cell>
            <Cell name="L0C2R2" stripIndex="18">s04</Cell>
            <Cell name="L0C2R3" stripIndex="19">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="7">
            <Cell name="L0C3R0" stripIndex="7">s05</Cell>
            <Cell name="L0C3R1" stripIndex="8">s04</Cell>
            <Cell name="L0C3R2" stripIndex="9">w01</Cell>
            <Cell name="L0C3R3" stripIndex="10">s06</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="20">
            <Cell name="L0C4R0" stripIndex="20">s07</Cell>
            <Cell name="L0C4R1" stripIndex="21">s02</Cell>
            <Cell name="L0C4R2" stripIndex="22">s06</Cell>
            <Cell name="L0C4R3" stripIndex="23">s01</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>60</PatternsBet>
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
        $pick = (int) $totalBet * 4/6;

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake, 4/6);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(4,4,4,4,4));
        $this->slot->rows = 4;

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
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

}