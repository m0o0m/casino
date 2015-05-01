<?
require_once('IGTCtrl.php');

class star_trekCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1144-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Star Trek"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="StarTrek"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

        $this->outXML($xml);
    }

    protected function startPaytable($request) {
        $symbolPay = $this->getSymbolPay();

        $baseReel = $this->getReelXml($this->gameParams->reels[0]);
        $b1Reel = $this->getReelXml($this->gameParams->reels[1]);
        $b2Reel = $this->getReelXml($this->gameParams->reels[2]);
        $b3Reel = $this->getReelXml($this->gameParams->reels[3]);
        $b4Reel = $this->getReelXml($this->gameParams->reels[4]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="Star Trek 30L 3x3x3x3x3" maxRTP="95.16" minRTP="92.66" name="Star Trek" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b03" required="true"/>
        </Prize>
        <Prize name="b04">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b04" required="true"/>
        </Prize>
        <Prize name="b05">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b05" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="KirkBonus">
        '.$b1Reel.'
    </StripInfo>
    <StripInfo name="SpockBonus">
        '.$b2Reel.'
    </StripInfo>
    <StripInfo name="UhuraBonus">
        '.$b3Reel.'
    </StripInfo>
    <StripInfo name="ScottyBonus">
        '.$b4Reel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="30" min="30">
            <Step>30</Step>
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
    <PickerInfo name="BaseGame.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">1</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>true</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="SpockBonus"/>
        <ExitOutcomeTrigger name="SpockBonus"/>
        <Triggers>
            <Trigger name="KirkBonus" picks="1"/>
            <Trigger name="SpockBonus" picks="1"/>
            <Trigger name="UhuraBonus" picks="1"/>
            <Trigger name="ScottyBonus" picks="1"/>
        </Triggers>
        <Layer index="0" name="level0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
        </Layer>
    </PickerInfo>
    <PickerInfo name="GeneralBonusStart.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">1</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="SpockBonus"/>
        <ExitOutcomeTrigger name="SpockBonus"/>
        <Triggers>
            <Trigger name="SpockBonus" picks="1"/>
        </Triggers>
        <Layer index="0" name="level0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
        </Layer>
    </PickerInfo>
    <DenominationList>
        <Denomination softwareId="200-1144-001">1.0</Denomination>
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
        <GameLogicVersion>1.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043371645</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="40">
            <Cell name="L0C0R0" stripIndex="40">s01</Cell>
            <Cell name="L0C0R1" stripIndex="41">s08</Cell>
            <Cell name="L0C0R2" stripIndex="42">s03</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="45">
            <Cell name="L0C1R0" stripIndex="45">s02</Cell>
            <Cell name="L0C1R1" stripIndex="46">s02</Cell>
            <Cell name="L0C1R2" stripIndex="47">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="5">
            <Cell name="L0C2R0" stripIndex="5">s01</Cell>
            <Cell name="L0C2R1" stripIndex="6">s07</Cell>
            <Cell name="L0C2R2" stripIndex="7">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="15">
            <Cell name="L0C3R0" stripIndex="15">s07</Cell>
            <Cell name="L0C3R1" stripIndex="16">b03</Cell>
            <Cell name="L0C3R2" stripIndex="17">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="22">
            <Cell name="L0C4R0" stripIndex="22">s07</Cell>
            <Cell name="L0C4R1" stripIndex="23">s04</Cell>
            <Cell name="L0C4R2" stripIndex="24">s09</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="KirkBonus.Reels" stage="KirkBonus">
        <Entry name="Reel0" stripIndex="25">
            <Cell name="L0C0R0" stripIndex="25">s14</Cell>
            <Cell name="L0C0R1" stripIndex="26">s09</Cell>
            <Cell name="L0C0R2" stripIndex="27">s17</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="69">
            <Cell name="L0C1R0" stripIndex="69">w05</Cell>
            <Cell name="L0C1R1" stripIndex="70">w05</Cell>
            <Cell name="L0C1R2" stripIndex="71">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s16</Cell>
            <Cell name="L0C2R1" stripIndex="11">s16</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="4">
            <Cell name="L0C3R0" stripIndex="4">s15</Cell>
            <Cell name="L0C3R1" stripIndex="5">s07</Cell>
            <Cell name="L0C3R2" stripIndex="6">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="51">
            <Cell name="L0C4R0" stripIndex="51">w04</Cell>
            <Cell name="L0C4R1" stripIndex="52">s07</Cell>
            <Cell name="L0C4R2" stripIndex="53">w05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="SpockBonus.Reels" stage="SpockBonus">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s11</Cell>
            <Cell name="L0C0R1" stripIndex="3">s07</Cell>
            <Cell name="L0C0R2" stripIndex="4">s12</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="45">
            <Cell name="L0C1R0" stripIndex="45">w03</Cell>
            <Cell name="L0C1R1" stripIndex="46">w03</Cell>
            <Cell name="L0C1R2" stripIndex="47">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="3">s05</Cell>
            <Cell name="L0C2R1" stripIndex="4">s10</Cell>
            <Cell name="L0C2R2" stripIndex="5">s10</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">w03</Cell>
            <Cell name="L0C3R1" stripIndex="1">s05</Cell>
            <Cell name="L0C3R2" stripIndex="2">s13</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="3">
            <Cell name="L0C4R0" stripIndex="3">w02</Cell>
            <Cell name="L0C4R1" stripIndex="4">s08</Cell>
            <Cell name="L0C4R2" stripIndex="5">s13</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="UhuraBonus.Reels" stage="UhuraBonus">
        <Entry name="Reel0" stripIndex="4">
            <Cell name="L0C0R0" stripIndex="4">s03</Cell>
            <Cell name="L0C0R1" stripIndex="5">s08</Cell>
            <Cell name="L0C0R2" stripIndex="6">s18</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="6">b01</Cell>
            <Cell name="L0C1R1" stripIndex="7">s08</Cell>
            <Cell name="L0C1R2" stripIndex="8">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s09</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="27">
            <Cell name="L0C3R0" stripIndex="27">s02</Cell>
            <Cell name="L0C3R1" stripIndex="28">s07</Cell>
            <Cell name="L0C3R2" stripIndex="29">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="7">
            <Cell name="L0C4R0" stripIndex="7">s01</Cell>
            <Cell name="L0C4R1" stripIndex="8">s07</Cell>
            <Cell name="L0C4R2" stripIndex="9">s18</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="ScottyBonus.Reels" stage="ScottyBonus">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s21</Cell>
            <Cell name="L0C0R1" stripIndex="1">s05</Cell>
            <Cell name="L0C0R2" stripIndex="2">s19</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s19</Cell>
            <Cell name="L0C1R1" stripIndex="1">s08</Cell>
            <Cell name="L0C1R2" stripIndex="2">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s20</Cell>
            <Cell name="L0C2R1" stripIndex="11">s20</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="12">
            <Cell name="L0C3R0" stripIndex="12">s21</Cell>
            <Cell name="L0C3R1" stripIndex="13">s08</Cell>
            <Cell name="L0C3R2" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="49">
            <Cell name="L0C4R0" stripIndex="49">s06</Cell>
            <Cell name="L0C4R1" stripIndex="50">s05</Cell>
            <Cell name="L0C4R2" stripIndex="51">w07</Cell>
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