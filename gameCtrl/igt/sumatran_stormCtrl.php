<?
require_once('IGTCtrl.php');

class sumatran_stormCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1207-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Sumatran Storm"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="SumatranStorm"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Sumatran Storm 720 Multiway 3x4x5x4x3" maxRTP="96.56" minRTP="93.23" name="Sumatran Storm" type="Slot"/>
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftBaseGame" strategy="PayMultiWayRightLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRightFreeSpin" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftFreeSpin" strategy="PayMultiWayRightLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterBaseGame" strategy="PayAny">
        <Prize name="s09">
            <PrizePay count="5" pph="29190" value="50"/>
            <PrizePay count="4" pph="845" value="10"/>
            <PrizePay count="3" pph="62" value="2"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterFreeSpin" strategy="PayAny">
        <Prize name="s18">
            <PrizePay count="5" pph="29545" value="50"/>
            <PrizePay count="4" pph="852" value="10"/>
            <PrizePay count="3" pph="62" value="2"/>
            <Symbol id="s18" required="false"/>
        </Prize>
    </PrizeInfo>
    <FreeSpinInfo name="BaseGame.FreeSpinInfo">
        <Reset>true</Reset>
        <Increment>
            <Strategy>Additive</Strategy>
            <MaxFreeSpins>150</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="5" name="5 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>NoDecrement</Strategy>
            <Count>0</Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="60" min="60">
            <Step>60</Step>
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
        <Denomination softwareId="200-1207-001">1.0</Denomination>
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
        <TransactionId>A2210-14264043378942</TransactionId>
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
            <Cell name="L0C0R1" stripIndex="140">s03</Cell>
            <Cell name="L0C0R2" stripIndex="141">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="166">
            <Cell name="L0C1R0" stripIndex="166">s05</Cell>
            <Cell name="L0C1R1" stripIndex="167">w01</Cell>
            <Cell name="L0C1R2" stripIndex="168">w01</Cell>
            <Cell name="L0C1R3" stripIndex="169">w01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="152">
            <Cell name="L0C2R0" stripIndex="152">b01</Cell>
            <Cell name="L0C2R1" stripIndex="153">s07</Cell>
            <Cell name="L0C2R2" stripIndex="154">s02</Cell>
            <Cell name="L0C2R3" stripIndex="155">s02</Cell>
            <Cell name="L0C2R4" stripIndex="156">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="138">
            <Cell name="L0C3R0" stripIndex="138">s06</Cell>
            <Cell name="L0C3R1" stripIndex="139">b01</Cell>
            <Cell name="L0C3R2" stripIndex="140">s02</Cell>
            <Cell name="L0C3R3" stripIndex="141">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="119">
            <Cell name="L0C4R0" stripIndex="119">s01</Cell>
            <Cell name="L0C4R1" stripIndex="120">s09</Cell>
            <Cell name="L0C4R2" stripIndex="121">s08</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="4">
            <Cell name="L0C0R0" stripIndex="4">b02</Cell>
            <Cell name="L0C0R1" stripIndex="5">s12</Cell>
            <Cell name="L0C0R2" stripIndex="6">s12</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="74">
            <Cell name="L0C1R0" stripIndex="74">s11</Cell>
            <Cell name="L0C1R1" stripIndex="75">s11</Cell>
            <Cell name="L0C1R2" stripIndex="76">s11</Cell>
            <Cell name="L0C1R3" stripIndex="77">s15</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="45">
            <Cell name="L0C2R0" stripIndex="45">b02</Cell>
            <Cell name="L0C2R1" stripIndex="46">b02</Cell>
            <Cell name="L0C2R2" stripIndex="47">w02</Cell>
            <Cell name="L0C2R3" stripIndex="48">w02</Cell>
            <Cell name="L0C2R4" stripIndex="49">w02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="126">
            <Cell name="L0C3R0" stripIndex="126">b02</Cell>
            <Cell name="L0C3R1" stripIndex="127">s11</Cell>
            <Cell name="L0C3R2" stripIndex="128">s11</Cell>
            <Cell name="L0C3R3" stripIndex="129">s14</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="21">
            <Cell name="L0C4R0" stripIndex="21">s10</Cell>
            <Cell name="L0C4R1" stripIndex="22">s10</Cell>
            <Cell name="L0C4R2" stripIndex="23">s16</Cell>
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
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
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
    '.$highlightLeft.$highlightRight.'
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
    '.$rightWinLines.'
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