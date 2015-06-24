<?
require_once('IGTCtrl.php');

class da_vinci_dual_playCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1158-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Da Vinci Diamonds Dual Play"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="DaVinciDualPlay"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Da Vinci Diamonds Dual Play 40L 6x6x6x6x6" maxRTP="95.29" minRTP="93.41" name="Da Vinci Diamonds Dual Play" type="Slot" />
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="FreeSpinPrizeInfoLines" strategy="PayLeft">
        <Prize name="s01">
            <PrizePay count="5" pph="3208.7" value="5000" />
            <PrizePay count="4" pph="156.3" value="500" />
            <PrizePay count="3" pph="15.8" value="100" />
            <Symbol id="w01" required="false" />
            <Symbol id="s01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="259.7" value="1000" />
            <PrizePay count="4" pph="41.4" value="200" />
            <PrizePay count="3" pph="7.9" value="50" />
            <Symbol id="w01" required="false" />
            <Symbol id="s02" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="168.9" value="500" />
            <PrizePay count="4" pph="27.9" value="80" />
            <PrizePay count="3" pph="5.3" value="30" />
            <Symbol id="w01" required="false" />
            <Symbol id="s03" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="75.8" value="300" />
            <PrizePay count="4" pph="12" value="60" />
            <PrizePay count="3" pph="2.9" value="20" />
            <Symbol id="w01" required="false" />
            <Symbol id="s04" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="41.2" value="100" />
            <PrizePay count="4" pph="6.5" value="30" />
            <PrizePay count="3" pph="1.6" value="10" />
            <Symbol id="w01" required="false" />
            <Symbol id="s05" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="27.8" value="100" />
            <PrizePay count="4" pph="8.3" value="30" />
            <PrizePay count="3" pph="1.8" value="8" />
            <Symbol id="w01" required="false" />
            <Symbol id="s06" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="38.9" value="80" />
            <PrizePay count="4" pph="8.7" value="20" />
            <PrizePay count="3" pph="2" value="6" />
            <Symbol id="w01" required="false" />
            <Symbol id="s07" required="false" />
        </Prize>
        <Prize name="b01">
            <PrizePay count="3" pph="49.2" value="0" />
            <Symbol id="b01" required="false" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
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
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame" />
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <DenominationList>
        <Denomination softwareId="200-1158-001">1.0</Denomination>
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
        <GameLogicVersion>1.1</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14264049088731</TransactionId>
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
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="24">
            <Cell name="L0C1R0" stripIndex="24">b01</Cell>
            <Cell name="L0C1R1" stripIndex="25">s04</Cell>
            <Cell name="L0C1R2" stripIndex="26">s06</Cell>
            <Cell name="L0C1R3" stripIndex="27">s05</Cell>
            <Cell name="L0C1R4" stripIndex="28">s03</Cell>
            <Cell name="L0C1R5" stripIndex="29">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="31">
            <Cell name="L0C2R0" stripIndex="31">s03</Cell>
            <Cell name="L0C2R1" stripIndex="32">s07</Cell>
            <Cell name="L0C2R2" stripIndex="33">s01</Cell>
            <Cell name="L0C2R3" stripIndex="34">s04</Cell>
            <Cell name="L0C2R4" stripIndex="35">s07</Cell>
            <Cell name="L0C2R5" stripIndex="36">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="40">
            <Cell name="L0C1R0" stripIndex="40">s06</Cell>
            <Cell name="L0C1R1" stripIndex="41">s07</Cell>
            <Cell name="L0C1R2" stripIndex="42">s03</Cell>
            <Cell name="L0C1R3" stripIndex="43">s06</Cell>
            <Cell name="L0C1R4" stripIndex="44">s07</Cell>
            <Cell name="L0C1R5" stripIndex="45">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="8">
            <Cell name="L0C2R0" stripIndex="8">w01</Cell>
            <Cell name="L0C2R1" stripIndex="9">s01</Cell>
            <Cell name="L0C2R2" stripIndex="10">s04</Cell>
            <Cell name="L0C2R3" stripIndex="11">s07</Cell>
            <Cell name="L0C2R4" stripIndex="12">b01</Cell>
            <Cell name="L0C2R5" stripIndex="13">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
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
        $this->slot->createCustomReels($this->gameParams->reels[0], array(6,6,6,6,6));
        $this->slot->rows = 6;

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