<?
require_once('IGTCtrl.php');

class garden_partyCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1172-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Garden Party"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="GardenParty"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Garden Party 1024 Multiway 4x4x4x4x4" maxRTP="96.03" minRTP="92.89" name="Garden Party" type="Slot" />
    <PrizeInfo name="BaseGame.PrizeInfoLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="265.7" value="500" />
            <PrizePay count="4" pph="63.9" value="200" />
            <PrizePay count="3" pph="10.1" value="50" />
            <PrizePay count="2" pph="6.9" value="10" />
            <Symbol id="s01" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="614.2" value="250" />
            <PrizePay count="4" pph="365.9" value="75" />
            <PrizePay count="3" pph="93.4" value="25" />
            <Symbol id="s02" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="443.2" value="250" />
            <PrizePay count="4" pph="230.5" value="75" />
            <PrizePay count="3" pph="63.8" value="25" />
            <Symbol id="s03" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="160.9" value="150" />
            <PrizePay count="4" pph="117." value="50" />
            <PrizePay count="3" pph="45.8" value="20" />
            <Symbol id="s04" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="74.2" value="150" />
            <PrizePay count="4" pph="54.6" value="50" />
            <PrizePay count="3" pph="26.3" value="20" />
            <Symbol id="s05" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="188.1" value="100" />
            <PrizePay count="4" pph="140." value="20" />
            <PrizePay count="3" pph="33." value="5" />
            <Symbol id="s06" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="150.9" value="100" />
            <PrizePay count="4" pph="108.5" value="20" />
            <PrizePay count="3" pph="46.3" value="5" />
            <Symbol id="s07" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="375.3" value="100" />
            <PrizePay count="4" pph="197.1" value="10" />
            <PrizePay count="3" pph="96.8" value="5" />
            <Symbol id="s08" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="87.6" value="100" />
            <PrizePay count="4" pph="40.4" value="10" />
            <PrizePay count="3" pph="20.4" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s09" required="true" />
        </Prize>
        <Prize name="s10">
            <PrizePay count="5" pph="174.1" value="100" />
            <PrizePay count="4" pph="139.3" value="10" />
            <PrizePay count="3" pph="56.1" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s10" required="true" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="119.4" value="100" />
            <PrizePay count="4" pph="85.9" value="10" />
            <PrizePay count="3" pph="70.1" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s11" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="FreeSpin.PrizeInfoLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="265.7" value="500" />
            <PrizePay count="4" pph="63.9" value="200" />
            <PrizePay count="3" pph="10.1" value="50" />
            <PrizePay count="2" pph="6.9" value="10" />
            <Symbol id="s01" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="614.2" value="250" />
            <PrizePay count="4" pph="365.9" value="75" />
            <PrizePay count="3" pph="93.4" value="25" />
            <Symbol id="s02" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="443.2" value="250" />
            <PrizePay count="4" pph="230.5" value="75" />
            <PrizePay count="3" pph="63.8" value="25" />
            <Symbol id="s03" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="160.9" value="150" />
            <PrizePay count="4" pph="117." value="50" />
            <PrizePay count="3" pph="45.8" value="20" />
            <Symbol id="s04" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="74.2" value="150" />
            <PrizePay count="4" pph="54.6" value="50" />
            <PrizePay count="3" pph="26.3" value="20" />
            <Symbol id="s05" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="188.1" value="100" />
            <PrizePay count="4" pph="140." value="20" />
            <PrizePay count="3" pph="33." value="5" />
            <Symbol id="s06" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="150.9" value="100" />
            <PrizePay count="4" pph="108.5" value="20" />
            <PrizePay count="3" pph="46.3" value="5" />
            <Symbol id="s07" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="375.3" value="100" />
            <PrizePay count="4" pph="197.1" value="10" />
            <PrizePay count="3" pph="96.8" value="5" />
            <Symbol id="s08" required="true" />
            <Symbol id="w01" required="false" />
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="87.6" value="100" />
            <PrizePay count="4" pph="40.4" value="10" />
            <PrizePay count="3" pph="20.4" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s09" required="true" />
        </Prize>
        <Prize name="s10">
            <PrizePay count="5" pph="174.1" value="100" />
            <PrizePay count="4" pph="139.3" value="10" />
            <PrizePay count="3" pph="56.1" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s10" required="true" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="119.4" value="100" />
            <PrizePay count="4" pph="85.9" value="10" />
            <PrizePay count="3" pph="70.1" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s11" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="BaseGame.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="5" pph="137329.1" value="10" />
            <PrizePay count="4" pph="2781.3" value="4" />
            <PrizePay count="3" pph="142.4" value="2" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">15</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <AutoAdvance>false</AutoAdvance>
        <OutcomeTrigger name="FreeSpin" />
        <ExitOutcomeTrigger name="FreeSpin" />
        <Layer index="0" name="layer0">
            <Pick cellName="pick0" name="L0C0R0" />
            <Pick cellName="pick1" name="L0C1R0" />
            <Pick cellName="pick2" name="L0C2R0" />
            <Pick cellName="pick3" name="L0C3R0" />
            <Pick cellName="pick4" name="L0C4R0" />
        </Layer>
    </PickerInfo>
    <PatternSliderInfo>
        <PatternInfo max="50" min="50">
            <Step>50</Step>
        </PatternInfo>
        <BetInfo max="500" min="1">
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
        <Denomination softwareId="200-1172-001">1.0</Denomination>
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
        <TransactionId>A2110-14264049099527</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="8">
            <Cell name="L0C0R0" stripIndex="8">s11</Cell>
            <Cell name="L0C0R1" stripIndex="9">s03</Cell>
            <Cell name="L0C0R2" stripIndex="10">s10</Cell>
            <Cell name="L0C0R3" stripIndex="11">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="113">
            <Cell name="L0C1R0" stripIndex="113">s01</Cell>
            <Cell name="L0C1R1" stripIndex="114">s01</Cell>
            <Cell name="L0C1R2" stripIndex="115">s01</Cell>
            <Cell name="L0C1R3" stripIndex="116">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="40">
            <Cell name="L0C2R0" stripIndex="40">s01</Cell>
            <Cell name="L0C2R1" stripIndex="41">s01</Cell>
            <Cell name="L0C2R2" stripIndex="42">s01</Cell>
            <Cell name="L0C2R3" stripIndex="43">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="147">
            <Cell name="L0C3R0" stripIndex="147">s09</Cell>
            <Cell name="L0C3R1" stripIndex="148">s02</Cell>
            <Cell name="L0C3R2" stripIndex="149">s07</Cell>
            <Cell name="L0C3R3" stripIndex="0">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="136">
            <Cell name="L0C4R0" stripIndex="136">s11</Cell>
            <Cell name="L0C4R1" stripIndex="137">b01</Cell>
            <Cell name="L0C4R2" stripIndex="138">s09</Cell>
            <Cell name="L0C4R3" stripIndex="139">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">spins,5,multiplier,20,trigger,multiplier20</Cell>
        </Entry>
        <Entry name="L0C1R0" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">spins,10,multiplier,15,trigger,multiplier15</Cell>
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,15,multiplier,10,trigger,multiplier10</Cell>
        </Entry>
        <Entry name="L0C3R0" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">spins,20,multiplier,5,trigger,multiplier5</Cell>
        </Entry>
        <Entry name="L0C4R0" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">spins,30,multiplier,3,trigger,multiplier3</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="18">
            <Cell name="L0C0R0" stripIndex="18">s10</Cell>
            <Cell name="L0C0R1" stripIndex="19">s03</Cell>
            <Cell name="L0C0R2" stripIndex="20">s06</Cell>
            <Cell name="L0C0R3" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="10">
            <Cell name="L0C1R0" stripIndex="10">s05</Cell>
            <Cell name="L0C1R1" stripIndex="11">s08</Cell>
            <Cell name="L0C1R2" stripIndex="12">s04</Cell>
            <Cell name="L0C1R3" stripIndex="13">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="6">
            <Cell name="L0C2R0" stripIndex="6">s03</Cell>
            <Cell name="L0C2R1" stripIndex="7">s06</Cell>
            <Cell name="L0C2R2" stripIndex="8">b01</Cell>
            <Cell name="L0C2R3" stripIndex="9">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">s09</Cell>
            <Cell name="L0C3R1" stripIndex="4">s05</Cell>
            <Cell name="L0C3R2" stripIndex="5">s08</Cell>
            <Cell name="L0C3R3" stripIndex="6">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="14">
            <Cell name="L0C4R0" stripIndex="14">s01</Cell>
            <Cell name="L0C4R1" stripIndex="15">s01</Cell>
            <Cell name="L0C4R2" stripIndex="16">s01</Cell>
            <Cell name="L0C4R3" stripIndex="17">s01</Cell>
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