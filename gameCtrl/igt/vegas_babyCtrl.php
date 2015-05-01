<?
require_once('IGTCtrl.php');

class vegas_babyCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1102-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Vegas Baby"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="VegasBaby"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Vegas Baby 20L 3x3x3x3x3" maxRTP="96.46" minRTP="93.65" name="Vegas Baby" type="Slot"/>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame"/>
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeftAll">
        '.$symbolPay.'
    </PrizeInfo>
    <PatternSliderInfo>
        <PatternInfo max="20" min="1">
            <Step>1</Step>
            <Step>5</Step>
            <Step>9</Step>
            <Step>15</Step>
            <Step>20</Step>
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
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <MaxFreeSpins> 180  </MaxFreeSpins>
    <DenominationList>
        <Denomination softwareId="200-1102-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>150.0</MaxBet>
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
        <TransactionId>A2110-14264049160569</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="13">
            <Cell name="L0C0R0" stripIndex="12">s04</Cell>
            <Cell name="L0C0R1" stripIndex="13">s10</Cell>
            <Cell name="L0C0R2" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="12">
            <Cell name="L0C1R0" stripIndex="11">b01</Cell>
            <Cell name="L0C1R1" stripIndex="12">s06</Cell>
            <Cell name="L0C1R2" stripIndex="13">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="30">
            <Cell name="L0C2R0" stripIndex="29">s10</Cell>
            <Cell name="L0C2R1" stripIndex="30">s03</Cell>
            <Cell name="L0C2R2" stripIndex="31">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="5">s06</Cell>
            <Cell name="L0C3R1" stripIndex="6">w01</Cell>
            <Cell name="L0C3R2" stripIndex="7">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="14">
            <Cell name="L0C4R0" stripIndex="13">s09</Cell>
            <Cell name="L0C4R1" stripIndex="14">s02</Cell>
            <Cell name="L0C4R2" stripIndex="15">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="11">
            <Cell name="L0C0R0" stripIndex="10">s05</Cell>
            <Cell name="L0C0R1" stripIndex="11">s07</Cell>
            <Cell name="L0C0R2" stripIndex="12">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="10">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s11</Cell>
            <Cell name="L0C1R2" stripIndex="11">b01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="29">
            <Cell name="L0C2R0" stripIndex="28">s05</Cell>
            <Cell name="L0C2R1" stripIndex="29">s10</Cell>
            <Cell name="L0C2R2" stripIndex="30">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="5">s06</Cell>
            <Cell name="L0C3R1" stripIndex="6">w01</Cell>
            <Cell name="L0C3R2" stripIndex="7">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="26">
            <Cell name="L0C4R0" stripIndex="25">s02</Cell>
            <Cell name="L0C4R1" stripIndex="26">s08</Cell>
            <Cell name="L0C4R2" stripIndex="27">s07</Cell>
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