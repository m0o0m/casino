<?
require_once('IGTCtrl.php');

class one_hundred_ladiesCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1239-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="100 Ladies"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="OneHundredLadies"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="One Hundred Pandas 100L 4x4x4x4x4" maxRTP="96.52" minRTP="93.04" name="One Hundred Pandas" type="Slot"/>
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
        <PatternInfo max="100" min="1">
            <Step>1</Step>
            <Step>10</Step>
            <Step>25</Step>
            <Step>50</Step>
            <Step>75</Step>
            <Step>100</Step>
        </PatternInfo>
        <BetInfo max="2000" min="1">
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
        </BetInfo>
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame"/>
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy> HighestOnly </Strategy>
            <MaxFreeSpins> 255 </MaxFreeSpins>
            <Triggers>
                <Trigger freespins="10" name="3 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy> ConstantDecrement </Strategy>
            <Count> 1  </Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <DenominationList>
        <Denomination softwareId="200-1239-001">1.0</Denomination>
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
        <GameLogicVersion>1.1</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14262314474737</TransactionId>
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
            <Cell name="L0C0R0" stripIndex="0">s06</Cell>
            <Cell name="L0C0R1" stripIndex="1">s02</Cell>
            <Cell name="L0C0R2" stripIndex="2">s02</Cell>
            <Cell name="L0C0R3" stripIndex="3">s06</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="0">w01</Cell>
            <Cell name="L0C1R1" stripIndex="1">w01</Cell>
            <Cell name="L0C1R2" stripIndex="2">w01</Cell>
            <Cell name="L0C1R3" stripIndex="3">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="1">
            <Cell name="L0C2R0" stripIndex="0">s03</Cell>
            <Cell name="L0C2R1" stripIndex="1">s10</Cell>
            <Cell name="L0C2R2" stripIndex="2">s08</Cell>
            <Cell name="L0C2R3" stripIndex="3">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="1">
            <Cell name="L0C3R0" stripIndex="0">s05</Cell>
            <Cell name="L0C3R1" stripIndex="1">b01</Cell>
            <Cell name="L0C3R2" stripIndex="2">s07</Cell>
            <Cell name="L0C3R3" stripIndex="3">s10</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="0">s10</Cell>
            <Cell name="L0C4R1" stripIndex="1">s08</Cell>
            <Cell name="L0C4R2" stripIndex="2">s01</Cell>
            <Cell name="L0C4R3" stripIndex="3">s01</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="0">s01</Cell>
            <Cell name="L0C0R1" stripIndex="1">s01</Cell>
            <Cell name="L0C0R2" stripIndex="2">s06</Cell>
            <Cell name="L0C0R3" stripIndex="3">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="0">s04</Cell>
            <Cell name="L0C1R1" stripIndex="1">s07</Cell>
            <Cell name="L0C1R2" stripIndex="2">s09</Cell>
            <Cell name="L0C1R3" stripIndex="3">s02</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="1">
            <Cell name="L0C2R0" stripIndex="0">w01</Cell>
            <Cell name="L0C2R1" stripIndex="1">w01</Cell>
            <Cell name="L0C2R2" stripIndex="2">w01</Cell>
            <Cell name="L0C2R3" stripIndex="3">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="1">
            <Cell name="L0C3R0" stripIndex="0">b01</Cell>
            <Cell name="L0C3R1" stripIndex="1">s05</Cell>
            <Cell name="L0C3R2" stripIndex="2">s07</Cell>
            <Cell name="L0C3R3" stripIndex="3">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="0">s06</Cell>
            <Cell name="L0C4R1" stripIndex="1">s03</Cell>
            <Cell name="L0C4R2" stripIndex="2">s03</Cell>
            <Cell name="L0C4R3" stripIndex="3">s08</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>100</PatternsBet>
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