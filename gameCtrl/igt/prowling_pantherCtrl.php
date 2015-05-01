<?
require_once('IGTCtrl.php');

class prowling_pantherCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1246-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Prowling Panther"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="ProwlingPanther"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Prowling Panther 720 Multiway 3x4x5x4x3" maxRTP="96.09" minRTP="92.09" name="Prowling Panther" type="Slot"/>
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRightFreeSpin" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="50" min="50">
            <Step>50</Step>
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
    <DenominationList>
        <Denomination softwareId="200-1246-001">1.0</Denomination>
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
        <GameLogicVersion>1.1</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043361860</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="139">
            <Cell name="L0C0R0" stripIndex="139">b01</Cell>
            <Cell name="L0C0R1" stripIndex="140">s02</Cell>
            <Cell name="L0C0R2" stripIndex="141">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="170">
            <Cell name="L0C1R0" stripIndex="170">s05</Cell>
            <Cell name="L0C1R1" stripIndex="171">w01</Cell>
            <Cell name="L0C1R2" stripIndex="172">w01</Cell>
            <Cell name="L0C1R3" stripIndex="173">w01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="230">
            <Cell name="L0C2R0" stripIndex="230">s01</Cell>
            <Cell name="L0C2R1" stripIndex="231">b01</Cell>
            <Cell name="L0C2R2" stripIndex="232">s07</Cell>
            <Cell name="L0C2R3" stripIndex="233">s01</Cell>
            <Cell name="L0C2R4" stripIndex="234">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="219">
            <Cell name="L0C3R0" stripIndex="219">s03</Cell>
            <Cell name="L0C3R1" stripIndex="220">s07</Cell>
            <Cell name="L0C3R2" stripIndex="221">s05</Cell>
            <Cell name="L0C3R3" stripIndex="222">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="81">
            <Cell name="L0C4R0" stripIndex="81">s05</Cell>
            <Cell name="L0C4R1" stripIndex="82">s02</Cell>
            <Cell name="L0C4R2" stripIndex="83">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s02</Cell>
            <Cell name="L0C0R1" stripIndex="3">s02</Cell>
            <Cell name="L0C0R2" stripIndex="4">b01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="37">
            <Cell name="L0C1R0" stripIndex="37">s08</Cell>
            <Cell name="L0C1R1" stripIndex="38">s04</Cell>
            <Cell name="L0C1R2" stripIndex="39">b01</Cell>
            <Cell name="L0C1R3" stripIndex="40">b01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="134">
            <Cell name="L0C2R0" stripIndex="134">s01</Cell>
            <Cell name="L0C2R1" stripIndex="135">s08</Cell>
            <Cell name="L0C2R2" stripIndex="136">w01</Cell>
            <Cell name="L0C2R3" stripIndex="137">w01</Cell>
            <Cell name="L0C2R4" stripIndex="138">w01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="125">
            <Cell name="L0C3R0" stripIndex="125">b01</Cell>
            <Cell name="L0C3R1" stripIndex="126">s02</Cell>
            <Cell name="L0C3R2" stripIndex="127">s06</Cell>
            <Cell name="L0C3R3" stripIndex="128">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="13">
            <Cell name="L0C4R0" stripIndex="13">s03</Cell>
            <Cell name="L0C4R1" stripIndex="14">s03</Cell>
            <Cell name="L0C4R2" stripIndex="15">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>50</PatternsBet>
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
        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,5,4,3));
        $this->slot->rows = 5;

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
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $leftWinLines = $this->getLeftWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228740002404</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>50</Settled>
        <Pending>0</Pending>
        <Payout>'.$report['totalWin'].'</Payout>
    </OutcomeDetail>
    <HighlightOutcome name="BaseGame.Scatter" type="" />
    '.$highlightLeft.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>0</TotalAwarded>
        <Count>0</Count>
        <Countdown>0</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    '.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$report['totalWin'].'" stage="" totalPay="'.$report['totalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$report['totalWin'].'" payName="" symbolCount="0" totalPay="'.$report['totalWin'].'" ways="0" />
    </PrizeOutcome>
    <TransactionId>A2010-14296886706206</TransactionId>
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