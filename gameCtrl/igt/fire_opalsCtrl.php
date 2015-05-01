<?
require_once('IGTCtrl.php');

class fire_opalsCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1159-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Fire Opals"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="FireOpals"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Fire Opals 720 Multiway 3x4x5x4x3" maxRTP="94.92" minRTP="92.99" name="Fire Opals" type="Slot" />
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="2829" value="2000" />
            <PrizePay count="4" pph="485" value="150" />
            <PrizePay count="3" pph="83" value="50" />
            <Symbol id="s01" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="386" value="500" />
            <PrizePay count="4" pph="86" value="75" />
            <PrizePay count="3" pph="23" value="25" />
            <Symbol id="s02" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="351" value="300" />
            <PrizePay count="4" pph="28" value="50" />
            <PrizePay count="3" pph="42" value="20" />
            <Symbol id="s03" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="87" value="125" />
            <PrizePay count="4" pph="13" value="30" />
            <PrizePay count="3" pph="18" value="15" />
            <Symbol id="s04" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="70" value="100" />
            <PrizePay count="4" pph="115" value="25" />
            <PrizePay count="3" pph="42" value="10" />
            <Symbol id="s05" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="95" value="100" />
            <PrizePay count="4" pph="126" value="20" />
            <PrizePay count="3" pph="143" value="5" />
            <Symbol id="s06" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="133" value="100" />
            <PrizePay count="4" pph="16" value="20" />
            <PrizePay count="3" pph="12" value="5" />
            <Symbol id="s07" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="150" value="100" />
            <PrizePay count="4" pph="284" value="20" />
            <PrizePay count="3" pph="35" value="5" />
            <Symbol id="s08" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="b01">
            <PrizePay count="5" pph="136" value="100" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftBaseGame" strategy="PayMultiWayRightLeft">
        <Prize name="s01">
            <PrizePay count="5" doNotGeneratePrize="true" value="2000" />
            <PrizePay count="4" pph="514" value="150" />
            <PrizePay count="3" pph="82" value="50" />
            <Symbol id="s01" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" doNotGeneratePrize="true" value="500" />
            <PrizePay count="4" pph="644" value="75" />
            <PrizePay count="3" pph="109" value="25" />
            <Symbol id="s02" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" doNotGeneratePrize="true" value="300" />
            <PrizePay count="4" pph="64" value="50" />
            <PrizePay count="3" pph="18" value="20" />
            <Symbol id="s03" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="102" value="30" />
            <PrizePay count="3" pph="100" value="15" />
            <Symbol id="s04" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="82" value="25" />
            <PrizePay count="3" pph="12" value="10" />
            <Symbol id="s05" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="8" value="20" />
            <PrizePay count="3" pph="25" value="5" />
            <Symbol id="s06" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="17" value="20" />
            <PrizePay count="3" pph="49" value="5" />
            <Symbol id="s07" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="20" value="20" />
            <PrizePay count="3" pph="5" value="5" />
            <Symbol id="s08" required="false" />
            <Symbol id="w01" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRightFreeSpin" strategy="PayMultiWayLeftRight">
        <Prize name="s10">
            <PrizePay count="5" pph="166" value="1000" />
            <PrizePay count="4" pph="26" value="150" />
            <PrizePay count="3" pph="18" value="50" />
            <Symbol id="s10" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="35" value="300" />
            <PrizePay count="4" pph="5" value="75" />
            <PrizePay count="3" pph="4" value="25" />
            <Symbol id="s11" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="5" pph="22" value="200" />
            <PrizePay count="4" pph="22" value="50" />
            <PrizePay count="3" pph="10" value="15" />
            <Symbol id="s12" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="5" pph="12" value="125" />
            <PrizePay count="4" pph="2" value="25" />
            <PrizePay count="3" pph="8" value="10" />
            <Symbol id="s13" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="5" pph="20" value="125" />
            <PrizePay count="4" pph="2" value="25" />
            <PrizePay count="3" pph="15" value="10" />
            <Symbol id="s14" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s15">
            <PrizePay count="5" pph="22" value="100" />
            <PrizePay count="4" pph="33" value="20" />
            <PrizePay count="3" pph="63" value="5" />
            <Symbol id="s15" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s16">
            <PrizePay count="5" pph="37" value="100" />
            <PrizePay count="4" pph="28" value="20" />
            <PrizePay count="3" pph="14" value="5" />
            <Symbol id="s16" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s17">
            <PrizePay count="5" pph="38" value="100" />
            <PrizePay count="4" pph="58" value="20" />
            <PrizePay count="3" pph="20" value="5" />
            <Symbol id="s17" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="b02">
            <PrizePay count="5" pph="131" value="100" />
            <Symbol id="b02" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftFreeSpin" strategy="PayMultiWayRightLeft">
        <Prize name="s10">
            <PrizePay count="5" doNotGeneratePrize="true" value="1000" />
            <PrizePay count="4" pph="31" value="150" />
            <PrizePay count="3" pph="19" value="50" />
            <Symbol id="s10" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" doNotGeneratePrize="true" value="300" />
            <PrizePay count="4" pph="56" value="75" />
            <PrizePay count="3" pph="34" value="25" />
            <Symbol id="s11" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="5" doNotGeneratePrize="true" value="200" />
            <PrizePay count="4" pph="4" value="50" />
            <PrizePay count="3" pph="4" value="15" />
            <Symbol id="s12" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="21" value="25" />
            <PrizePay count="3" pph="24" value="10" />
            <Symbol id="s13" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="5" doNotGeneratePrize="true" value="125" />
            <PrizePay count="4" pph="32" value="25" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="s14" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s15">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="2" value="20" />
            <PrizePay count="3" pph="6" value="5" />
            <Symbol id="s15" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s16">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="3" value="20" />
            <PrizePay count="3" pph="11" value="5" />
            <Symbol id="s16" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
        <Prize name="s17">
            <PrizePay count="5" doNotGeneratePrize="true" value="100" />
            <PrizePay count="4" pph="3" value="20" />
            <PrizePay count="3" pph="3" value="5" />
            <Symbol id="s17" required="false" />
            <Symbol id="w02" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterBaseGame" strategy="PayAny">
        <Prize name="s09">
            <PrizePay count="5" pph="33801" value="100" />
            <PrizePay count="4" pph="948" value="20" />
            <PrizePay count="3" pph="67" value="3" />
            <Symbol id="s09" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterFreeSpin" strategy="PayAny">
        <Prize name="s18">
            <PrizePay count="5" pph="35454" value="100" />
            <PrizePay count="4" pph="986" value="20" />
            <PrizePay count="3" pph="69" value="3" />
            <Symbol id="s18" required="false" />
        </Prize>
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
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame" />
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <DenominationList>
        <Denomination softwareId="200-1159-001">1.0</Denomination>
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
        <TransactionId>A2210-14264043322165</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="75">
            <Cell name="L0C0R0" stripIndex="75">s05</Cell>
            <Cell name="L0C0R1" stripIndex="76">s04</Cell>
            <Cell name="L0C0R2" stripIndex="77">s02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="4">
            <Cell name="L0C1R0" stripIndex="4">s08</Cell>
            <Cell name="L0C1R1" stripIndex="5">s01</Cell>
            <Cell name="L0C1R2" stripIndex="6">s04</Cell>
            <Cell name="L0C1R3" stripIndex="7">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="38">
            <Cell name="L0C2R0" stripIndex="38">s05</Cell>
            <Cell name="L0C2R1" stripIndex="39">b01</Cell>
            <Cell name="L0C2R2" stripIndex="40">b01</Cell>
            <Cell name="L0C2R3" stripIndex="41">b01</Cell>
            <Cell name="L0C2R4" stripIndex="42">s07</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="108">
            <Cell name="L0C3R0" stripIndex="108">w01</Cell>
            <Cell name="L0C3R1" stripIndex="109">w01</Cell>
            <Cell name="L0C3R2" stripIndex="110">s06</Cell>
            <Cell name="L0C3R3" stripIndex="111">s03</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="113">
            <Cell name="L0C4R0" stripIndex="113">s09</Cell>
            <Cell name="L0C4R1" stripIndex="114">s02</Cell>
            <Cell name="L0C4R2" stripIndex="115">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="75">
            <Cell name="L0C0R0" stripIndex="75">s05</Cell>
            <Cell name="L0C0R1" stripIndex="76">s04</Cell>
            <Cell name="L0C0R2" stripIndex="77">s02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="15">
            <Cell name="L0C1R0" stripIndex="15">s08</Cell>
            <Cell name="L0C1R1" stripIndex="16">s01</Cell>
            <Cell name="L0C1R2" stripIndex="17">s06</Cell>
            <Cell name="L0C1R3" stripIndex="18">s05</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="12">
            <Cell name="L0C2R0" stripIndex="12">s02</Cell>
            <Cell name="L0C2R1" stripIndex="13">s02</Cell>
            <Cell name="L0C2R2" stripIndex="14">b01</Cell>
            <Cell name="L0C2R3" stripIndex="15">s09</Cell>
            <Cell name="L0C2R4" stripIndex="16">s02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="82">
            <Cell name="L0C3R0" stripIndex="82">w01</Cell>
            <Cell name="L0C3R1" stripIndex="83">w01</Cell>
            <Cell name="L0C3R2" stripIndex="84">s06</Cell>
            <Cell name="L0C3R3" stripIndex="85">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="155">
            <Cell name="L0C4R0" stripIndex="155">s09</Cell>
            <Cell name="L0C4R1" stripIndex="156">s03</Cell>
            <Cell name="L0C4R2" stripIndex="157">s08</Cell>
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