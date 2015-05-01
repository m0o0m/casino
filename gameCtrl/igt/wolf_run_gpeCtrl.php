<?
require_once('IGTCtrl.php');

class wolf_run_gpeCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1196-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Wolf Run"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="WolfRunGPE"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Wolf Run 40L 4x4x4x4x4" maxRTP="94.98" minRTP="92.50" name="Wolf Run" type="Slot"/>
    <MaxFreeSpins> 255 </MaxFreeSpins>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="3" value="2"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="40" min="1">
            <Step>1</Step>
            <Step>5</Step>
            <Step>10</Step>
            <Step>20</Step>
            <Step>30</Step>
            <Step>40</Step>
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
    <StepInfo name="AutoSpin">
        <Step>5</Step>
        <Step>10</Step>
        <Step>20</Step>
        <Step>35</Step>
        <Step>50</Step>
    </StepInfo>
    <DenominationList>
        <Denomination softwareId="200-1196-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>40.0</MaxBet>
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
        <TransactionId>A2310-14264037775684</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="68">
            <Cell name="L0C0R0" stripIndex="68">s01</Cell>
            <Cell name="L0C0R1" stripIndex="69">s07</Cell>
            <Cell name="L0C0R2" stripIndex="70">s09</Cell>
            <Cell name="L0C0R3" stripIndex="0">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="28">
            <Cell name="L0C1R0" stripIndex="28">s01</Cell>
            <Cell name="L0C1R1" stripIndex="29">s08</Cell>
            <Cell name="L0C1R2" stripIndex="30">b01</Cell>
            <Cell name="L0C1R3" stripIndex="31">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="33">
            <Cell name="L0C2R0" stripIndex="33">s03</Cell>
            <Cell name="L0C2R1" stripIndex="34">s08</Cell>
            <Cell name="L0C2R2" stripIndex="35">s02</Cell>
            <Cell name="L0C2R3" stripIndex="36">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="4">
            <Cell name="L0C3R0" stripIndex="4">s01</Cell>
            <Cell name="L0C3R1" stripIndex="5">w01</Cell>
            <Cell name="L0C3R2" stripIndex="6">w01</Cell>
            <Cell name="L0C3R3" stripIndex="7">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="82">
            <Cell name="L0C4R0" stripIndex="82">s07</Cell>
            <Cell name="L0C4R1" stripIndex="83">s01</Cell>
            <Cell name="L0C4R2" stripIndex="84">s07</Cell>
            <Cell name="L0C4R3" stripIndex="85">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="83">
            <Cell name="L0C0R0" stripIndex="83">s03</Cell>
            <Cell name="L0C0R1" stripIndex="84">s05</Cell>
            <Cell name="L0C0R2" stripIndex="85">s08</Cell>
            <Cell name="L0C0R3" stripIndex="86">s03</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="32">
            <Cell name="L0C1R0" stripIndex="32">s03</Cell>
            <Cell name="L0C1R1" stripIndex="33">w01</Cell>
            <Cell name="L0C1R2" stripIndex="34">w01</Cell>
            <Cell name="L0C1R3" stripIndex="35">w01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="91">
            <Cell name="L0C2R0" stripIndex="91">s10</Cell>
            <Cell name="L0C2R1" stripIndex="92">s07</Cell>
            <Cell name="L0C2R2" stripIndex="93">s02</Cell>
            <Cell name="L0C2R3" stripIndex="94">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="55">
            <Cell name="L0C3R0" stripIndex="55">s01</Cell>
            <Cell name="L0C3R1" stripIndex="56">s09</Cell>
            <Cell name="L0C3R2" stripIndex="57">s10</Cell>
            <Cell name="L0C3R3" stripIndex="58">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="35">
            <Cell name="L0C4R0" stripIndex="35">w01</Cell>
            <Cell name="L0C4R1" stripIndex="36">w01</Cell>
            <Cell name="L0C4R2" stripIndex="37">w01</Cell>
            <Cell name="L0C4R3" stripIndex="38">w01</Cell>
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