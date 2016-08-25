<?
require_once('IGTCtrl.php');

class ghostbustersCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1171-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Ghostbusters"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="Ghostbusters"/>
    <param name="studio" value="interactive"/>
    <param name="nsbuyinamount" value=""/>
    <param name="buildnumber" value="4.2.F.O.CL104654_220"/>
    <param name="autopull" value="N"/>
    <param name="consoleCode" value="CSTM"/>
    <param name="BCustomViewHeight" value="47"/>
    <param name="BCustomViewWidth" value="1024"/>
    <param name="consoleTimeStamp" value="1349855268588"/>
    <param name="filtered" value="Y"/>
    <param name="defaultbuyinamount" value="0.0"/>
    <param name="xtautopull" value=""/>
    <param name="server" value="../../../../../"/>
    <param name="showInitialCashier" value="false"/>
    <param name="audio" value="on"/>
    <param name="nscode" value="MRGR"/>
    <param name="uniqueid" value="Guest"/>
    <param name="countrycode" value=""/>
    <param name="presenttype" value="FLSH"/>
    <param name="securetoken" value=""/>
    <param name="denomamount" value="'.$this->getDenominationAmount().'"/>
    <param name="skincode" value="MRGR"/>
    <param name="language" value="en"/>
    <param name="channel" value="INT"/>
    <param name="currencycode" value="'.$this->gameParams->curiso.'"/>
</params>';

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
        '.$this->getBetInfo().'
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

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'StayPuftBonus';
        }
        if($_SESSION['state'] == 'PICK') {
            $state = 'BallroomBonus';
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

            $sticky = '<HighlightOutcome name="StayPuftBonus.StickyWilds" type="">
        <Highlight name="swp1" type="">';
            foreach($_SESSION['wildsOffsets'] as $o) {
                $ceil = $o % 5;
                $row = floor($o / 5);

                $sticky .= '<Cell name="L0C'.$ceil.'R'.$row.'" type="" />';
            }
            $sticky .= '</Highlight>
    </HighlightOutcome>';

            $fs = '<TriggerOutcome component="" name="StayPuftBonus.ActiveStickyWildsPatterns" stage="">
        <Trigger name="swp1" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="StayPuftBonus.Features" stage="">
        <Trigger name="stickyWildsActive" priority="0" stageConnector="" />
    </TriggerOutcome>
    <FreeSpinOutcome name="StayPuftBonus.FreeSpinOutcome">
        <InitAwarded>8</InitAwarded>
        <Awarded>8</Awarded>
        <TotalAwarded>8</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="StayPuftBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>'.$sticky;
        }
        if($_SESSION['state'] == 'PICK') {
            $fs = $this->getPicksXml();

            $totalWin = $_SESSION['spinWin'] + $_SESSION['ballroomTotalWin'];

            $fs .= '<PrizeOutcome multiplier="1" name="BallroomBonus.Total" pay="'.$_SESSION['ballroomTotalWin'].'" stage="" totalPay="'.$_SESSION['ballroomTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['ballroomTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['ballroomTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2010-14264054796419</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.'
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
        <BetPerPattern>'.$coinValue.'</BetPerPattern>
        <PatternsBet>'.$patternsBet.'</PatternsBet>
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
        $betPerLine = (float) $obj->BetPerPattern;

        $stake = $totalBet * $betPerLine * $_SESSION['denominationAmount'];
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $pick, $stake);

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
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

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->gameParams->winLines = $this->gameParams->winLinesFree;
        $this->gameParams->reelConfig = array(4,4,4,4,4);
        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->gameParams->winPay = $this->gameParams->winPay2;
        $this->slot->setParams($this->gameParams);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(4,4,4,4,4));
        $this->slot->rows = 4;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['totalWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->bonusData = array();
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $bonusCount = 0;

        $respin = false;


        $mysteryConfig = $this->gameParams->mysteryConfig;
        $bonus = array();
        $f = false;
        if(rnd(1, $mysteryConfig['bonusChance']) == 1) {
            $bonusCount++;
            $bonusType = $mysteryConfig['bonusType'][$this->getRandParam($mysteryConfig['bonusTypeChance'])];
            switch($bonusType) {
                case 'multiple':
                    $multiple = $mysteryConfig['multipleValue'][$this->getRandParam($mysteryConfig['multipleValueChance'])];
                    $bonus = array(
                        'type' => 'multiple',
                        'range' => array($multiple, $multiple),
                    );
                    $this->bonusData = array(
                        'type' => 'multiple',
                        'multiple' => $multiple,
                    );
                    break;
                case 'award':
                    $credits = $mysteryConfig['awardValue'][$this->getRandParam($mysteryConfig['awardValueChance'])];
                    $this->bonusData = array(
                        'type' => 'award',
                        'credits' => $credits,
                    );
                    $f = true;
                    break;
                case 'reels':
                    $reelsCount = $mysteryConfig['reelsCount'][$this->getRandParam($mysteryConfig['reelsCountChance'])];
                    $reels = array();
                    while(count($reels) < $reelsCount) {
                        $rnd = rnd(0,4);
                        if(in_array($rnd, $reels)) {

                        }
                        else {
                            $reels[] = $rnd;
                        }
                    }
                    $bonus = array(
                        'type' => 'wildReels',
                        'reels' => $reels,
                    );
                    $this->bonusData = array(
                        'type' => 'reels',
                        'reels' => $reels,
                    );
                    break;
                case 'wilds':
                    $bonus = array(
                        'type' => 'wildsExpansion',
                        'wildsCount' => $mysteryConfig['wildsCount'],
                        'wildsCountChance' => $mysteryConfig['wildsCountChance'],
                        'wildsExpansionChance' => $mysteryConfig['wildsExpansionChance'],
                        'wildSymbol' => 102,
                    );
                    $this->bonusData = array(
                        'type' => 'wilds',
                    );
                    break;
            }
        }

        if($_SESSION['state'] == 'FREE') {
            $config = $this->gameParams->puftConfig;
            $wildCount = $config['wildCount'][$this->getRandParam($config['wildCountChance'])];
            $newWildsOffsets = array();
            while(count($newWildsOffsets) < $wildCount) {
                $rnd = rnd(0,19);
                if(!in_array($rnd, $newWildsOffsets) && !in_array($rnd,$_SESSION['wildsOffsets'])) {
                    $newWildsOffsets[] = $rnd;
                    $_SESSION['wildsOffsets'][] = $rnd;
                }
                $bonus = array(
                    'type' => 'wildsOnPos',
                    'offsets' => $_SESSION['wildsOffsets'],
                    'wildSymbol' => 103,
                );
            }

            if(rnd(1, $config['awardChance']) == 1) {
                $credits = $config['awardValue'][$this->getRandParam($config['awardValueChance'])];
                $f = true;
                $this->bonusData = array(
                    'credits' => $credits,
                );
            }
        }

        else {

        }

        $report = $this->slot->spin($bonus);

        if($f) {
            $report['totalWin'] += $report['betOnLine'] * $credits;
            $report['spinWin'] += $report['betOnLine'] * $credits;
        }
        $report['type'] = 'SPIN';

        $b1Report = $this->slot->getSymbolAnyCount('b01');
        $b2Report = $this->slot->getSymbolAnyCount('b02');
        $b3Report = $this->slot->getSymbolAnyCount('b03');

        $report['scattersReport']['offsets'] = array_merge($b1Report['offsets'], $b2Report['offsets'], $b3Report['offsets']);
        $totalCount = $b1Report['count'] + $b2Report['count'] + $b3Report['count'];
        $report['scattersReport']['count'] = $totalCount;
        $report['scattersReport']['totalWin'] = 0;
        if($b1Report['count'] == 2 && $b2Report['count'] == 1) {
            $_SESSION['state'] = 'PICK';
            $_SESSION['pickerCount'] = 5;
            $bonusCount++;
        }

        if($b1Report['count'] == 2 && $b3Report['count'] == 1) {
            $_SESSION['state'] = 'FREE';
            $bonusCount++;
        }

        $totalWin = $report['totalWin'];

        if($bonusCount > 1) {
            $_SESSION['state'] = 'SPIN';
            $respin = true;
        }

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
        $scatterHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $bonus = '<HighlightOutcome name="BaseGame.MysteryWildReels" type="" />
    <HighlightOutcome name="BaseGame.MysterySingleWilds" type="" />
    <HighlightOutcome name="BaseGame.MysterySingleWilds.Expansion" type="" />
    <TriggerOutcome component="" name="MysteryBonus" stage="" />
    <TriggerOutcome component="" name="MysteryBonus.Awards" stage="" />
    <TriggerOutcome component="" name="Bonus" stage=""/>
    <TriggerOutcome component="" name="StayPuftBonus.ActiveStickyWildsPatterns" stage=""/>';
        if(!empty($this->bonusData)) {
            switch($this->bonusData['type']) {
                case 'multiple':
                    $bonus = '<TriggerOutcome component="" name="MysteryBonus" stage="">
        <Trigger name="MysteryMultiplier" priority="100" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="MysteryBonus.Awards" stage="">
        <Trigger name="Multiplier,'.$this->bonusData['multiple'].'" priority="100" stageConnector="" />
    </TriggerOutcome>
    <MultiplierOutcome name="MysteryFeature.Multiplier">
        <Multiplier name="">'.$this->bonusData['multiple'].'</Multiplier>
    </MultiplierOutcome>';
                    break;
                case 'award':
                    $pay = $report['betOnLine'] * $this->bonusData['credits'];
                    $bonus = '<TriggerOutcome component="" name="MysteryBonus" stage="">
        <Trigger name="MysteryCredits" priority="100" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="MysteryBonus.Awards" stage="">
        <Trigger name="Credits,'.$this->bonusData['credits'].'" priority="100" stageConnector="" />
    </TriggerOutcome>
    <PrizeOutcome multiplier="1" name="Mystery.Credits" pay="'.$pay.'" stage="" totalPay="'.$pay.'" type="Pattern">
        <Prize betMultiplier="1" multiplier="1" name="Credits" pay="'.$pay.'" payName="Credits,'.$this->bonusData['credits'].'" symbolCount="1" totalPay="'.$pay.'" ways="0" />
    </PrizeOutcome>';
                    break;
                case 'reels':
                    $tmp = array();
                    foreach($this->bonusData['reels'] as $r) {
                        $tmp[] = $r + 1;
                    }
                    $reelStr = implode('', $tmp);
                    $bonus = '<TriggerOutcome component="" name="MysteryBonus" stage="">
        <Trigger name="MysteryWildReels" priority="100" stageConnector="" />
    </TriggerOutcome>
    <HighlightOutcome name="BaseGame.MysteryWildReels" type="">
        <Highlight name="WildReel'.$reelStr.'" type="">';
                    foreach($this->bonusData['reels'] as $r) {
                        $bonus .= '<Cell name="L0C'.$r.'R0" type="" />
            <Cell name="L0C'.$r.'R1" type="" />
            <Cell name="L0C'.$r.'R2" type="" />';
                    }
                    $bonus .= '</Highlight>
    </HighlightOutcome>';
                    $display = $this->getDisplay($report, false, 'BaseGame', 'Reels', true);
                    $display2 = $this->getDisplay($report, false, 'BaseGame', 'MysteryWildReels');
                    $display .= $display2;
                    break;
                case 'wilds':
                    $display = $this->getDisplay($report, false, 'BaseGame', 'Reels', true);
                    $display2 = $this->getDisplay($report, false, 'BaseGame', 'MysteryWildReels');
                    $display .= $display2;
                    $bonus = '<TriggerOutcome component="" name="MysteryBonus" stage="">
        <Trigger name="MysterySingleWilds" priority="100" stageConnector="" />
    </TriggerOutcome>';

                    $bonus .= '<HighlightOutcome name="BaseGame.MysterySingleWilds" type="">
        <Highlight name="SingleWildPattern" type="">';
                    foreach($report['bonusData']['wildsOffsets'] as $o) {
                        $ceilRow = $this->slot->getCeilRowByOffset($o);
                            $bonus .= '<Cell name="L0C'.$ceilRow['ceil'].'R'.$ceilRow['row'].'" type="" />';
                    }
                    $bonus .= '</Highlight></HighlightOutcome>';

                    $bonus .= '<HighlightOutcome name="BaseGame.MysterySingleWilds.Expansion" type="">';
                    foreach($report['bonusData']['wildExpansion'] as $e) {
                        $main = $e['main'];
                        $expansion = $e['expansion'];
                        $mainCeilRow = $this->slot->getCeilRowByOffset($main);
                        $bonus .= '<Highlight name="L0C'.$mainCeilRow['ceil'].'R'.$mainCeilRow['row'].'" type="">';
                        $expansionCeilRow = $this->slot->getCeilRowByOffset($expansion);
                        $bonus .= '<Cell name="L0C'.$expansionCeilRow['ceil'].'R'.$expansionCeilRow['row'].'" type="" />';
                        $bonus .= '</Highlight>';
                    }
                    $bonus .= '</HighlightOutcome>';

                    break;
            }
        }

        $picks = 0;
        $nextStage = 'BaseGame';
        if($_SESSION['state'] == 'PICK') {
            $bonus .= '<TriggerOutcome component="" name="Bonus" stage="">
        <Trigger name="3 b03" priority="0" stageConnector="" />
    </TriggerOutcome>';
            $picks = 5;
            $nextStage = 'BallroomBonus';
            $this->startPickData();
        }

        $awarded = 0;
        if($_SESSION['state'] == 'FREE') {
            $nextStage = 'StayPuftBonus';
            $awarded = 8;
            $_SESSION['totalAwarded'] = $awarded;
            $_SESSION['fsLeft'] = $awarded;
            $_SESSION['fsPlayed'] = 0;
            $_SESSION['initAwarded'] = $awarded;
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1440-14228540951428</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>'.$report['bet'].'</Settled>
        <Pending>0</Pending>
        <Payout>'.$totalWin.'</Payout>
    </OutcomeDetail>
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    '.$highlight.$scatterHighlight.'
    '.$bonus.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="StayPuftBonus.FreeSpinOutcome">
        <InitAwarded>'.$awarded.'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$awarded.'</TotalAwarded>
        <Count>0</Count>
        <Countdown>'.$awarded.'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
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
    <PickerOutcome name="" />
    <PopulationOutcome name="BaseGame.RandomPresentationSeed" stage="BaseGame">
        <Entry name="RandomPresentationSeed" stripIndex="24">
            <Cell name="L0C0R0" stripIndex="24">24</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$picks.'</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>'.$picks.'</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
    '.$winLines.'
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

        $_SESSION['spinWin'] = $totalWin;

        if($_SESSION['state'] !== 'SPIN') {
            $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
            $_SESSION['baseScatter'] = base64_encode(gzcompress($scatterHighlight.$highlight.$winLines, 9));

            $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];
            $_SESSION['startBalance'] = $balance-$totalWin;
            $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
            $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

            $_SESSION['wildsOffsets'] = array();
        }

        $this->outXML($xml);
    }

    public function startPickData() {
        $place = array('L0C0R0', 'L0C8R0', 'L0C4R0', 'L0C9R0', 'L0C7R0', 'L0C1R0', 'L0C2R0', 'L0C3R0', 'L0C5R0', 'L0C6R0');
        $multiple = array(150,150,200,275,275,1250);
        shuffle($place);
        shuffle($multiple);
        $placeMultiple = array();
        foreach($place as $p) {
            $placeMultiple[] = array(
                'place' => $p,
                'credits' => array_pop($multiple),
                'multiple' => 1,
                'picked' => false,
            );
        }
        $_SESSION['placeMultiple'] = $placeMultiple;
        $_SESSION['ballroomTotalWin'] = 0;
    }

    public function startPick($request) {
        $balance = $this->getBalance();
        $stake = $_SESSION['lastBet'];
        $betOnLine = $stake / 50;

        $pick = (array) $request['PickerInput']->Pick->attributes()->name;
        $pick = $pick[0];

        $_SESSION['pickerCount']--;
        if($_SESSION['pickerCount'] < 0) {
            die('No picks allowed');
        }
        $credits = 0;
        $multiple = 1;

        $config = $this->gameParams->ballroomConfig;

        foreach($_SESSION['placeMultiple'] as &$p) {
            if($p['place'] == $pick) {
                if($p['picked'] == true) {
                    die('Already picked');
                }
                else {
                    $p['picked'] = true;
                    if(!empty($p['credits'])) {

                        $credits = $p['credits'];
                        if(rnd(1, $config['multipleChance']) == 1) {
                            $multiple = $config['multipleValue'][$this->getRandParam($config['multipleValueChance'])];
                        }
                        $p['payed'] = true;
                        $p['multiple'] = $multiple;
                    }
                    else {
                        $credits = 0;
                    }
                }
            }
        }

        $pickWin = $credits * $betOnLine * $multiple;

        $_SESSION['ballroomTotalWin'] += $pickWin;
        $totalWin = $_SESSION['spinWin'] + $_SESSION['ballroomTotalWin'];



        $payout = 0;
        $nextStage = 'BallroomBonus';
        $addString = '';
        if($_SESSION['pickerCount'] == 0) {
            $nextStage = 'BaseGame';
            $pickXml = $this->getPicksXml(true);
            $payout = $totalWin;
            $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
            $addString = $baseScatter . $baseReels;
        }
        else {
            $pickXml = $this->getPicksXml();
        }

        $balance += $pickWin;


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0240-14353242067151</TransactionId>
        <Stage>BallroomBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>50</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$addString.$pickXml.'
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <MultiplierOutcome name="BallroomBonus.Multiplier">
        <Multiplier name="">'.$multiple.'</Multiplier>
    </MultiplierOutcome>
    <PrizeOutcome multiplier="1" name="BallroomBonus.Total" pay="'.$_SESSION['ballroomTotalWin'].'" stage="" totalPay="'.$_SESSION['ballroomTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['ballroomTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['ballroomTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BallroomBonus.Picks" pay="'.$pickWin.'" stage="" totalPay="'.$pickWin.'" type="">
        <Prize betMultiplier="1" multiplier="'.$multiple.'" name="BallroomBonus" pay="'.($credits * $betOnLine).'" payName="Credits" symbolCount="0" totalPay="'.$pickWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R0340-14353205063940</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$_SESSION['lastBet'] / $_SESSION['lastPick'].'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $this->bonusPays[] = array(
            'win' => $pickWin,
        );

        $this->startPay();

        if($_SESSION['pickerCount'] == 0) {
            unset($_SESSION['pickerCount']);
            unset($_SESSION['placeMultiple']);
            unset($_SESSION['ballroomTotalWin']);
            unset($_SESSION['spinWin']);
            $_SESSION['state'] = 'SPIN';
        }
    }

    private function getPicksXml($all = false) {
        $xml = '<PickerOutcome name="">
        <Layer index="0" name="layer0">';
        foreach($_SESSION['placeMultiple'] as $p) {
            if($p['picked'] || $all) {
                $xml .= '<Pick name="'.$p['place'].'" picked="'.(($p['picked']) ? "true" : "false").'">';
                if(!empty($p['payed']) || ($all && !empty($p['credits']))) {
                    $xml .= '<Feature type="credits" value="'.$p['credits'].'" />';
                    $xml .= '<Feature type="multiplier" value="'.$p['multiple'].'" />';
                }
                else {
                    $xml .= '<Feature type="none" value="-1" />';
                }
                $xml .= '</Pick>';
            }
        }

        $xml .= '</Layer>
    </PickerOutcome>';

        $xml .= '<PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>'.(5 - $_SESSION['pickerCount']).'</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>5</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>';

        return $xml;
    }



    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'StayPuftBonus.Lines');
        $display = $this->getDisplay($report, false, 'StayPuftBonus', 'Reels', true);
        $display .= $this->getDisplay($report, false, 'StayPuftBonus', 'StickyWildsReels', false);
        $winLines = $this->getWinLines($report, 'StayPuftBonus');

        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $needBalance = $_SESSION['startBalance'];

        $_SESSION['fsTotalWin'] += $totalWin;

        $nextStage = 'StayPuftBonus';

        $baseReels = '';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        }

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];

        $sticky = '<HighlightOutcome name="StayPuftBonus.StickyWilds" type="">
        <Highlight name="swp1" type="">';
        foreach($_SESSION['wildsOffsets'] as $o) {
            $ceilRow = $this->slot->getCeilRowByOffset($o);
            $sticky .= '<Cell name="L0C'.$ceilRow['ceil'].'R'.$ceilRow['row'].'" type="" />';
        }
        $sticky .= '</Highlight>
    </HighlightOutcome>';


        $bonusFutures = '';
        $bonusCredits = 0;
        if(!empty($this->bonusData['credits'])) {
            $bonusCredits = $this->bonusData['credits'];
            $bonusFutures = '<HighlightOutcome name="StayPuftBonus.Features" type="">
        <Highlight name="features" type="">
            <Cell name="features" type="" />
        </Highlight>
    </HighlightOutcome>';
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>StayPuftBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="StayPuftBonus.ActiveStickyWildsPatterns" stage="">
        <Trigger name="swp1" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="StayPuftBonus.Features" stage="">
        <Trigger name="stickyWildsActive" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$bonusFutures.'
    '.$baseScatter.$sticky.'
    '.$highlight.$display.$baseReels.'
    <FreeSpinOutcome name="StayPuftBonus.FreeSpinOutcome">
        <InitAwarded>8</InitAwarded>
        <Awarded>8</Awarded>
        <TotalAwarded>8</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="StayPuftBonus.CreditsGag" pay="'.($bonusCredits*$report['betOnLine']).'" stage="" totalPay="'.($bonusCredits*$report['betOnLine']).'" type="">
        <Prize betMultiplier="1" multiplier="1" name="features" pay="'.($bonusCredits*$report['betOnLine']).'" payName="credits,'.$bonusCredits.'" symbolCount="1" totalPay="'.($bonusCredits*$report['betOnLine']).'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="StayPuftBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$needBalance.'">
        <Balance name="FREE">'.$needBalance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}
