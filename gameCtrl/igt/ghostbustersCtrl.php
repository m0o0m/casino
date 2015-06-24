<?
require_once('IGTCtrl.php');

class ghostbustersCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1171-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Ghostbusters"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="Ghostbusters"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Ghostbusters 25L 3x3x3x3x3" maxRTP="94.5" minRTP="92.5" name="Ghostbusters" type="Slot" />
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="PrizeInfoLines" strategy="PayLeft">
        <Prize name="w01">
            <PrizePay count="5" pph="1081490" value="500" />
            <PrizePay count="4" pph="121516" value="200" />
            <PrizePay count="3" pph="13669" value="40" />
            <Symbol id="w02" required="false" />
            <Symbol id="w01" required="true" />
        </Prize>
        <Prize name="s01">
            <PrizePay count="5" pph="79133" value="250" />
            <PrizePay count="4" pph="14721" value="75" />
            <PrizePay count="3" pph="1909" value="25" />
            <Symbol id="w02" required="false" />
            <Symbol id="w01" required="false" />
            <Symbol id="s01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="62394" value="250" />
            <PrizePay count="4" pph="11416" value="75" />
            <PrizePay count="3" pph="2032" value="25" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s02" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="72675" value="200" />
            <PrizePay count="4" pph="15255" value="50" />
            <PrizePay count="3" pph="1827" value="20" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s03" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="33023" value="200" />
            <PrizePay count="4" pph="4157" value="50" />
            <PrizePay count="3" pph="738" value="20" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s04" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="11108" value="150" />
            <PrizePay count="4" pph="3087" value="30" />
            <PrizePay count="3" pph="577" value="10" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s05" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="6814" value="125" />
            <PrizePay count="4" pph="1972" value="25" />
            <PrizePay count="3" pph="451" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s06" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="5653" value="125" />
            <PrizePay count="4" pph="1291" value="25" />
            <PrizePay count="3" pph="289" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s07" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="6833" value="125" />
            <PrizePay count="4" pph="1193" value="25" />
            <PrizePay count="3" pph="269" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s08" required="false" />
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="7838" value="100" />
            <PrizePay count="4" pph="1372" value="20" />
            <PrizePay count="3" pph="321" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s09" required="false" />
        </Prize>
        <Prize name="s10">
            <PrizePay count="5" pph="3033" value="100" />
            <PrizePay count="4" pph="691" value="20" />
            <PrizePay count="3" pph="218" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="w02" required="false" />
            <Symbol id="s10" required="false" />
        </Prize>
        <!--
			<Prize name="b01">
				<PrizePay count="3" value="0" pph="74" />
				<Symbol required="false" id="b01" />
			</Prize>
			-->
    </PrizeInfo>
    <StripInfo name="StayPuftBonus">
        '.$freeReel.'
    </StripInfo>
    <PrizeInfo name="StayPuftBonus.PrizeInfoLines" strategy="PayLeft">
        <Prize name="w03">
            <PrizePay count="5" pph="38791541" value="250" />
            <PrizePay count="4" pph="5172206" value="100" />
            <PrizePay count="3" pph="459071" value="25" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="true" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="222940" value="125" />
            <PrizePay count="4" pph="28623" value="40" />
            <PrizePay count="3" pph="3720" value="15" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s11" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="5" pph="98769" value="125" />
            <PrizePay count="4" pph="18722" value="40" />
            <PrizePay count="3" pph="3098" value="15" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s12" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="5" pph="123540" value="100" />
            <PrizePay count="4" pph="19537" value="30" />
            <PrizePay count="3" pph="2470" value="10" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s13" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="5" pph="123540" value="100" />
            <PrizePay count="4" pph="27541" value="30" />
            <PrizePay count="3" pph="2257" value="10" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s14" required="false" />
        </Prize>
        <Prize name="s15">
            <PrizePay count="5" pph="40492" value="75" />
            <PrizePay count="4" pph="9017" value="20" />
            <PrizePay count="3" pph="1256" value="5" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s15" required="false" />
        </Prize>
        <Prize name="s16">
            <PrizePay count="5" pph="25690" value="60" />
            <PrizePay count="4" pph="5713" value="15" />
            <PrizePay count="3" pph="572" value="2" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s16" required="false" />
        </Prize>
        <Prize name="s17">
            <PrizePay count="5" pph="4682" value="60" />
            <PrizePay count="4" pph="1378" value="15" />
            <PrizePay count="3" pph="477" value="2" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s17" required="false" />
        </Prize>
        <Prize name="s18">
            <PrizePay count="5" pph="9858" value="60" />
            <PrizePay count="4" pph="2902" value="15" />
            <PrizePay count="3" pph="498" value="2" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s18" required="false" />
        </Prize>
        <Prize name="s19">
            <PrizePay count="5" pph="8224" value="50" />
            <PrizePay count="4" pph="1829" value="10" />
            <PrizePay count="3" pph="374" value="2" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s19" required="false" />
        </Prize>
        <Prize name="s20">
            <PrizePay count="5" pph="6031" value="50" />
            <PrizePay count="4" pph="1775" value="10" />
            <PrizePay count="3" pph="343" value="2" />
            <Symbol id="w04" required="true" />
            <Symbol id="w03" required="false" />
            <Symbol id="s20" required="false" />
        </Prize>
    </PrizeInfo>
    <PickerInfo name="BallroomBonus.PickerInfo" verifierStrategy="LayerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="pick1" name="L0C0R0" />
            <Pick cellName="pick2" name="L0C1R0" />
            <Pick cellName="pick3" name="L0C2R0" />
            <Pick cellName="pick4" name="L0C3R0" />
            <Pick cellName="pick5" name="L0C4R0" />
            <Pick cellName="pick6" name="L0C5R0" />
            <Pick cellName="pick7" name="L0C6R0" />
            <Pick cellName="pick8" name="L0C7R0" />
            <Pick cellName="pick9" name="L0C8R0" />
            <Pick cellName="pick10" name="L0C9R0" />
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>5</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <AutoAdvance>false</AutoAdvance>
        <OutcomeTrigger name="BallroomBonus" />
        <ExitOutcomeTrigger name="BallroomToBaseGame" />
        <Triggers />
    </PickerInfo>
    <PatternSliderInfo name="PatternSliderInfo">
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
        <Denomination softwareId="200-1171-001">1.0</Denomination>
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
        <TransactionId>A2010-14264054796419</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="36">
            <Cell name="L0C0R0" stripIndex="36">s09</Cell>
            <Cell name="L0C0R1" stripIndex="37">s07</Cell>
            <Cell name="L0C0R2" stripIndex="38">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="24">
            <Cell name="L0C1R0" stripIndex="24">s02</Cell>
            <Cell name="L0C1R1" stripIndex="25">b01</Cell>
            <Cell name="L0C1R2" stripIndex="26">s05</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="8">
            <Cell name="L0C2R0" stripIndex="8">s07</Cell>
            <Cell name="L0C2R1" stripIndex="9">s03</Cell>
            <Cell name="L0C2R2" stripIndex="10">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="12">
            <Cell name="L0C3R0" stripIndex="12">w01</Cell>
            <Cell name="L0C3R1" stripIndex="13">s10</Cell>
            <Cell name="L0C3R2" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="74">
            <Cell name="L0C4R0" stripIndex="74">s01</Cell>
            <Cell name="L0C4R1" stripIndex="75">s06</Cell>
            <Cell name="L0C4R2" stripIndex="76">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="StayPuftBonus.Reels" stage="StayPuftBonus">
        <Entry name="Reel0" stripIndex="6">
            <Cell name="L0C0R0" stripIndex="6">s11</Cell>
            <Cell name="L0C0R1" stripIndex="7">s19</Cell>
            <Cell name="L0C0R2" stripIndex="8">s15</Cell>
            <Cell name="L0C0R3" stripIndex="9">s15</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="6">s11</Cell>
            <Cell name="L0C1R1" stripIndex="7">s20</Cell>
            <Cell name="L0C1R2" stripIndex="8">s15</Cell>
            <Cell name="L0C1R3" stripIndex="9">s18</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="7">
            <Cell name="L0C2R0" stripIndex="7">s12</Cell>
            <Cell name="L0C2R1" stripIndex="8">s18</Cell>
            <Cell name="L0C2R2" stripIndex="9">s19</Cell>
            <Cell name="L0C2R3" stripIndex="10">s13</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="26">
            <Cell name="L0C3R0" stripIndex="26">w03</Cell>
            <Cell name="L0C3R1" stripIndex="27">s20</Cell>
            <Cell name="L0C3R2" stripIndex="28">s17</Cell>
            <Cell name="L0C3R3" stripIndex="29">s12</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s14</Cell>
            <Cell name="L0C4R1" stripIndex="2">s16</Cell>
            <Cell name="L0C4R2" stripIndex="3">s20</Cell>
            <Cell name="L0C4R3" stripIndex="4">w03</Cell>
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
        <TransactionId>R1440-14228540951428</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>'.$report['bet'].'</Settled>
        <Pending>0</Pending>
        <Payout>'.$totalWin.'</Payout>
    </OutcomeDetail>
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    '.$highlight.'
    <HighlightOutcome name="BaseGame.MysteryWildReels" type=""/>
    <HighlightOutcome name="BaseGame.MysterySingleWilds" type=""/>
    <HighlightOutcome name="BaseGame.MysterySingleWilds.Expansion" type=""/>
    <TriggerOutcome component="" name="Bonus" stage=""/>
    <TriggerOutcome component="" name="StayPuftBonus.ActiveStickyWildsPatterns" stage=""/>
    <TriggerOutcome component="" name="MysteryBonus" stage=""/>
    <TriggerOutcome component="" name="MysteryBonus.Awards" stage=""/>
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="StayPuftBonus.FreeSpinOutcome">
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>0</TotalAwarded>
        <Count>0</Count>
        <Countdown>0</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerOutcome name=""/>
    <MultiplierOutcome name="MysteryFeature.Multiplier">
        <Multiplier name="">1</Multiplier>
    </MultiplierOutcome>
    '.$display.'
    <PopulationOutcome name="BaseGame.RandomPresentationSeed" stage="BaseGame">
        <Entry name="RandomPresentationSeed" stripIndex="85">
            <Cell name="L0C0R0" stripIndex="85">85</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0"/>
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Mystery.Credits" pay="0" stage="" totalPay="0" type="Pattern"/>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043327753</TransactionId>
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