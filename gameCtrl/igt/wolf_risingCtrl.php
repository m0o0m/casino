<?
require_once('IGTCtrl.php');

class wolf_risingCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1202-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Wolf Rising"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="WolfRising"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Wolf Rising 100L 8x8x8x8x8" maxRTP="96.05" minRTP="93.37" name="Wolf Rising" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoScatter" strategy="payAny">
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
            <Step>8</Step>
            <Step>25</Step>
            <Step>50</Step>
            <Step>75</Step>
            <Step>100</Step>
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
    <DenominationList>
        <Denomination softwareId="200-1202-001">1.0</Denomination>
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
        <TransactionId>A2210-14264043403454</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="31">
            <Cell name="L0C0R0" stripIndex="31">s15</Cell>
            <Cell name="L0C0R1" stripIndex="32">s04</Cell>
            <Cell name="L0C0R2" stripIndex="33">s05</Cell>
            <Cell name="L0C0R3" stripIndex="34">s06</Cell>
            <Cell name="L0C0R4" stripIndex="35">s16</Cell>
            <Cell name="L0C0R5" stripIndex="36">s11</Cell>
            <Cell name="L0C0R6" stripIndex="37">s15</Cell>
            <Cell name="L0C0R7" stripIndex="38">s13</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="51">
            <Cell name="L0C1R0" stripIndex="51">s12</Cell>
            <Cell name="L0C1R1" stripIndex="52">s14</Cell>
            <Cell name="L0C1R2" stripIndex="53">b01</Cell>
            <Cell name="L0C1R3" stripIndex="54">s11</Cell>
            <Cell name="L0C1R4" stripIndex="55">s13</Cell>
            <Cell name="L0C1R5" stripIndex="56">s12</Cell>
            <Cell name="L0C1R6" stripIndex="57">s07</Cell>
            <Cell name="L0C1R7" stripIndex="58">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="134">
            <Cell name="L0C2R0" stripIndex="134">s12</Cell>
            <Cell name="L0C2R1" stripIndex="135">s13</Cell>
            <Cell name="L0C2R2" stripIndex="136">s04</Cell>
            <Cell name="L0C2R3" stripIndex="137">s05</Cell>
            <Cell name="L0C2R4" stripIndex="138">s06</Cell>
            <Cell name="L0C2R5" stripIndex="139">s16</Cell>
            <Cell name="L0C2R6" stripIndex="140">s13</Cell>
            <Cell name="L0C2R7" stripIndex="141">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="46">
            <Cell name="L0C3R0" stripIndex="46">w01</Cell>
            <Cell name="L0C3R1" stripIndex="47">w02</Cell>
            <Cell name="L0C3R2" stripIndex="48">w03</Cell>
            <Cell name="L0C3R3" stripIndex="49">w04</Cell>
            <Cell name="L0C3R4" stripIndex="50">w05</Cell>
            <Cell name="L0C3R5" stripIndex="51">w06</Cell>
            <Cell name="L0C3R6" stripIndex="52">w07</Cell>
            <Cell name="L0C3R7" stripIndex="53">w08</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="86">
            <Cell name="L0C4R0" stripIndex="86">s09</Cell>
            <Cell name="L0C4R1" stripIndex="87">s10</Cell>
            <Cell name="L0C4R2" stripIndex="88">s16</Cell>
            <Cell name="L0C4R3" stripIndex="89">s11</Cell>
            <Cell name="L0C4R4" stripIndex="90">s14</Cell>
            <Cell name="L0C4R5" stripIndex="91">s12</Cell>
            <Cell name="L0C4R6" stripIndex="92">s01</Cell>
            <Cell name="L0C4R7" stripIndex="93">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="12">
            <Cell name="L0C0R0" stripIndex="12">s12</Cell>
            <Cell name="L0C0R1" stripIndex="13">s13</Cell>
            <Cell name="L0C0R2" stripIndex="14">s01</Cell>
            <Cell name="L0C0R3" stripIndex="15">s02</Cell>
            <Cell name="L0C0R4" stripIndex="16">s03</Cell>
            <Cell name="L0C0R5" stripIndex="17">s11</Cell>
            <Cell name="L0C0R6" stripIndex="18">s14</Cell>
            <Cell name="L0C0R7" stripIndex="19">s16</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="42">
            <Cell name="L0C1R0" stripIndex="42">s12</Cell>
            <Cell name="L0C1R1" stripIndex="43">s15</Cell>
            <Cell name="L0C1R2" stripIndex="44">s14</Cell>
            <Cell name="L0C1R3" stripIndex="45">s04</Cell>
            <Cell name="L0C1R4" stripIndex="46">s05</Cell>
            <Cell name="L0C1R5" stripIndex="47">s06</Cell>
            <Cell name="L0C1R6" stripIndex="48">s13</Cell>
            <Cell name="L0C1R7" stripIndex="49">s11</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="67">
            <Cell name="L0C2R0" stripIndex="67">w01</Cell>
            <Cell name="L0C2R1" stripIndex="68">w02</Cell>
            <Cell name="L0C2R2" stripIndex="69">w03</Cell>
            <Cell name="L0C2R3" stripIndex="70">w04</Cell>
            <Cell name="L0C2R4" stripIndex="71">w05</Cell>
            <Cell name="L0C2R5" stripIndex="72">w06</Cell>
            <Cell name="L0C2R6" stripIndex="73">w07</Cell>
            <Cell name="L0C2R7" stripIndex="74">w08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="4">
            <Cell name="L0C3R0" stripIndex="4">s07</Cell>
            <Cell name="L0C3R1" stripIndex="5">s08</Cell>
            <Cell name="L0C3R2" stripIndex="6">s13</Cell>
            <Cell name="L0C3R3" stripIndex="7">s16</Cell>
            <Cell name="L0C3R4" stripIndex="8">b01</Cell>
            <Cell name="L0C3R5" stripIndex="9">s14</Cell>
            <Cell name="L0C3R6" stripIndex="10">s04</Cell>
            <Cell name="L0C3R7" stripIndex="11">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="34">
            <Cell name="L0C4R0" stripIndex="34">w06</Cell>
            <Cell name="L0C4R1" stripIndex="35">w07</Cell>
            <Cell name="L0C4R2" stripIndex="36">w08</Cell>
            <Cell name="L0C4R3" stripIndex="37">s12</Cell>
            <Cell name="L0C4R4" stripIndex="38">s16</Cell>
            <Cell name="L0C4R5" stripIndex="39">s09</Cell>
            <Cell name="L0C4R6" stripIndex="40">s10</Cell>
            <Cell name="L0C4R7" stripIndex="41">s14</Cell>
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
        $this->slot->createCustomReels($this->gameParams->reels[0], array(8,8,8,8,8));
        $this->slot->rows = 8;

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