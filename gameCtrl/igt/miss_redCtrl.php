<?
require_once('IGTCtrl.php');

class miss_redCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1227-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Miss Red"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="MissRed"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="Miss Red 1024 Multiway 4x4x4x4x4" maxRTP="96.16" minRTP="92.00" name="Miss Red" type="Slot"/>
    <MaxFreeSpins>280</MaxFreeSpins>
    <PrizeInfo name="BaseGame.PrizeInfoOriginalLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s03_LeftRight">
            <PrizePay count="5" pph="443.2" value="150"/>
            <PrizePay count="4" pph="230.5" value="75"/>
            <PrizePay count="3" pph="63.8" value="10"/>
            <Symbol id="s03" required="true"/>
        </Prize>
        <Prize name="s04_LeftRight">
            <PrizePay count="5" pph="160.9" value="125"/>
            <PrizePay count="4" pph="117." value="75"/>
            <PrizePay count="3" pph="45.8" value="10"/>
            <Symbol id="s04" required="true"/>
        </Prize>
        <Prize name="s05_LeftRight">
            <PrizePay count="5" pph="74.2" value="25"/>
            <PrizePay count="4" pph="54.6" value="8"/>
            <Symbol id="s05" required="true"/>
        </Prize>
        <Prize name="s06_LeftRight">
            <PrizePay count="5" pph="188.1" value="25"/>
            <PrizePay count="4" pph="140." value="8"/>
            <Symbol id="s06" required="true"/>
        </Prize>
        <Prize name="s07_LeftRight">
            <PrizePay count="5" pph="150.9" value="15"/>
            <PrizePay count="4" pph="108.5" value="5"/>
            <Symbol id="s07" required="true"/>
        </Prize>
        <Prize name="s08_LeftRight">
            <PrizePay count="5" pph="375.3" value="15"/>
            <PrizePay count="4" pph="197.1" value="5"/>
            <Symbol id="s08" required="true"/>
        </Prize>
        <Prize name="s09_LeftRight">
            <PrizePay count="5" pph="87.6" value="15"/>
            <PrizePay count="4" pph="40.4" value="5"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10_LeftRight">
            <PrizePay count="5" pph="174.1" value="15"/>
            <PrizePay count="4" pph="139.3" value="5"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="FreeSpin.PrizeInfoOriginalLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s03_LeftRight">
            <PrizePay count="5" pph="443.2" value="150"/>
            <PrizePay count="4" pph="230.5" value="75"/>
            <PrizePay count="3" pph="63.8" value="10"/>
            <Symbol id="s03" required="true"/>
        </Prize>
        <Prize name="s04_LeftRight">
            <PrizePay count="5" pph="160.9" value="125"/>
            <PrizePay count="4" pph="117." value="75"/>
            <PrizePay count="3" pph="45.8" value="10"/>
            <Symbol id="s04" required="true"/>
        </Prize>
        <Prize name="s05_LeftRight">
            <PrizePay count="5" pph="74.2" value="25"/>
            <PrizePay count="4" pph="54.6" value="8"/>
            <Symbol id="s05" required="true"/>
        </Prize>
        <Prize name="s06_LeftRight">
            <PrizePay count="5" pph="188.1" value="25"/>
            <PrizePay count="4" pph="140." value="8"/>
            <Symbol id="s06" required="true"/>
        </Prize>
        <Prize name="s07_LeftRight">
            <PrizePay count="5" pph="150.9" value="15"/>
            <PrizePay count="4" pph="108.5" value="5"/>
            <Symbol id="s07" required="true"/>
        </Prize>
        <Prize name="s08_LeftRight">
            <PrizePay count="5" pph="375.3" value="15"/>
            <PrizePay count="4" pph="197.1" value="5"/>
            <Symbol id="s08" required="true"/>
        </Prize>
        <Prize name="s09_LeftRight">
            <PrizePay count="5" pph="87.6" value="15"/>
            <PrizePay count="4" pph="40.4" value="5"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10_LeftRight">
            <PrizePay count="5" pph="174.1" value="15"/>
            <PrizePay count="4" pph="139.3" value="5"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="BaseGame.PrizeInfoExpandedLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s01_LeftRight">
            <PrizePay count="5" pph="265.7" value="50"/>
            <PrizePay count="4" pph="63.9" value="15"/>
            <PrizePay count="3" pph="10.1" value="8"/>
            <Symbol id="s01" required="true"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="e01" required="false"/>
        </Prize>
        <Prize name="s02_LeftRight">
            <PrizePay count="5" pph="614.2" value="40"/>
            <PrizePay count="4" pph="365.9" value="12"/>
            <PrizePay count="3" pph="93.4" value="5"/>
            <Symbol id="s02" required="true"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="e02" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="FreeSpin.PrizeInfoExpandedLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="w01_LeftRight">
            <PrizePay count="5" pph="265.7" value="50"/>
            <PrizePay count="4" pph="63.9" value="15"/>
            <PrizePay count="3" pph="10.1" value="8"/>
            <Symbol id="w01" required="true"/>
            <Symbol id="w02" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="BaseGame.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="3" pph="142.4" value="0"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
            <Pick cellName="pick3" name="L0C3R0"/>
            <Pick cellName="pick4" name="L0C4R0"/>
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>56</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="FreeSpin"/>
        <ExitOutcomeTrigger name="FreeSpin"/>
        <Triggers/>
    </PickerInfo>
    <FreeSpinInfo name="Picker.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy>HighestOnly</Strategy>
            <MaxFreeSpins>280</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="5" name="5"/>
                <Trigger freespins="6" name="6"/>
                <Trigger freespins="7" name="7"/>
                <Trigger freespins="8" name="8"/>
                <Trigger freespins="9" name="9"/>
                <Trigger freespins="10" name="10"/>
                <Trigger freespins="15" name="15"/>
                <Trigger freespins="5" name="5retrigger"/>
                <Trigger freespins="15" name="15retrigger"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>ConstantDecrement</Strategy>
            <Count>0</Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <PatternSliderInfo>
        <PatternInfo max="45" min="45">
            <Step>45</Step>
        </PatternInfo>
        '.$this->getBetInfo().'
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame"/>
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <DenominationList>
        <Denomination softwareId="200-1227-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>30.0</MaxBet>
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
        $nextStage = 'BaseGame';
        $fs = '';
        if($_SESSION['state'] == 'PICK') {
            $balance = $_SESSION['startBalance'];
            $totalWin = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $state = 'BaseGame';
            $nextStage = 'Picker';

            $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

            $fs = '<AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>';

            $fs .= $baseGame;
        }
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
            $nextStage = 'FreeSpin';
            $balance = $_SESSION['startBalance'];
            $totalWin = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $fsWin = $_SESSION['fsTotalWin'];

            $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>';
            $fs .= $baseGame;
        }

        $patternsBet = 45;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14262320172105</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="149">
            <Cell name="L0C0R0" stripIndex="149">s02</Cell>
            <Cell name="L0C0R1" stripIndex="150">s03</Cell>
            <Cell name="L0C0R2" stripIndex="151">s08</Cell>
            <Cell name="L0C0R3" stripIndex="152">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="30">
            <Cell name="L0C1R0" stripIndex="30">s05</Cell>
            <Cell name="L0C1R1" stripIndex="31">s02</Cell>
            <Cell name="L0C1R2" stripIndex="32">s02</Cell>
            <Cell name="L0C1R3" stripIndex="33">s02</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="32">
            <Cell name="L0C2R0" stripIndex="32">s03</Cell>
            <Cell name="L0C2R1" stripIndex="33">s08</Cell>
            <Cell name="L0C2R2" stripIndex="34">b01</Cell>
            <Cell name="L0C2R3" stripIndex="35">s10</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="29">
            <Cell name="L0C3R0" stripIndex="29">s01</Cell>
            <Cell name="L0C3R1" stripIndex="30">s01</Cell>
            <Cell name="L0C3R2" stripIndex="31">s01</Cell>
            <Cell name="L0C3R3" stripIndex="32">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="6">
            <Cell name="L0C4R0" stripIndex="6">s06</Cell>
            <Cell name="L0C4R1" stripIndex="7">s01</Cell>
            <Cell name="L0C4R2" stripIndex="8">s10</Cell>
            <Cell name="L0C4R3" stripIndex="9">s03</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">spins,5</Cell>
        </Entry>
        <Entry name="L0C1R0" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">spins,6</Cell>
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,15</Cell>
        </Entry>
        <Entry name="L0C3R0" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">spins,7</Cell>
        </Entry>
        <Entry name="L0C4R0" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">spins,5</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="55">
            <Cell name="L0C0R0" stripIndex="55">s10</Cell>
            <Cell name="L0C0R1" stripIndex="56">s04</Cell>
            <Cell name="L0C0R2" stripIndex="57">s08</Cell>
            <Cell name="L0C0R3" stripIndex="58">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="21">
            <Cell name="L0C1R0" stripIndex="21">s04</Cell>
            <Cell name="L0C1R1" stripIndex="22">s07</Cell>
            <Cell name="L0C1R2" stripIndex="23">s01</Cell>
            <Cell name="L0C1R3" stripIndex="24">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="33">
            <Cell name="L0C2R0" stripIndex="33">s08</Cell>
            <Cell name="L0C2R1" stripIndex="34">b01</Cell>
            <Cell name="L0C2R2" stripIndex="35">s10</Cell>
            <Cell name="L0C2R3" stripIndex="36">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="19">
            <Cell name="L0C3R0" stripIndex="19">s02</Cell>
            <Cell name="L0C3R1" stripIndex="20">s09</Cell>
            <Cell name="L0C3R2" stripIndex="21">s07</Cell>
            <Cell name="L0C3R3" stripIndex="22">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s03</Cell>
            <Cell name="L0C4R1" stripIndex="47">s01</Cell>
            <Cell name="L0C4R2" stripIndex="48">s08</Cell>
            <Cell name="L0C4R3" stripIndex="49">s10</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.ExpandedReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="55">
            <Cell name="L0C0R0" stripIndex="55">s10</Cell>
            <Cell name="L0C0R1" stripIndex="56">s04</Cell>
            <Cell name="L0C0R2" stripIndex="57">s08</Cell>
            <Cell name="L0C0R3" stripIndex="58">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="21">
            <Cell name="L0C1R0" stripIndex="21">s04</Cell>
            <Cell name="L0C1R1" stripIndex="22">s07</Cell>
            <Cell name="L0C1R2" stripIndex="23">s01</Cell>
            <Cell name="L0C1R3" stripIndex="24">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="33">
            <Cell name="L0C2R0" stripIndex="33">s08</Cell>
            <Cell name="L0C2R1" stripIndex="34">b01</Cell>
            <Cell name="L0C2R2" stripIndex="35">s10</Cell>
            <Cell name="L0C2R3" stripIndex="36">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="19">
            <Cell name="L0C3R0" stripIndex="19">s02</Cell>
            <Cell name="L0C3R1" stripIndex="20">s09</Cell>
            <Cell name="L0C3R2" stripIndex="21">s07</Cell>
            <Cell name="L0C3R3" stripIndex="22">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s03</Cell>
            <Cell name="L0C4R1" stripIndex="47">s01</Cell>
            <Cell name="L0C4R2" stripIndex="48">s08</Cell>
            <Cell name="L0C4R3" stripIndex="49">s10</Cell>
        </Entry>
    </PopulationOutcome>
    '.$fs.'
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

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

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

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
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

        $this->gameParams->winPay = $this->gameParams->winPayFree;
        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(4,4,4,4,4));
        $this->slot->rows = 4;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

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
        $bonus = array();

        if($_SESSION['state'] == 'FREE') {
            $bonus = array(
                'type' => 'randomReplace',
                'symbols' => array(1,2),
                'replacement' => array(0),
            );
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
        }

        if($_SESSION['state'] == 'SPIN') {
            $newReport = $this->slot->getMissRedBonus($report);
        }
        if($_SESSION['state'] == 'FREE') {
            $r = $this->slot->getSymbolAnyCount('w01');
            $report['replace'] = $r;
            $newReport = $this->slot->getMissRedBonusFree($report);
        }



        $fullWinLines = $newReport['winLines'];
        foreach($report['winLines'] as $w) {
            $alias = $w['alias'];
            if($alias !== 's01' && $alias !== 's02') {
                $present = false;
                foreach($newReport['winLines'] as $nw) {
                    if($alias == $nw['alias']) {
                        $present = true;
                    }
                }
                if(!$present) {
                    $fullWinLines[] = $w;
                }
            }
        }

        $totalMultiple = 0;
        foreach($fullWinLines as $w) {
            $totalMultiple += $w['multiple'];
        }
        $report['totalMultiple'] = $totalMultiple;
        $report['totalWin'] = $this->slot->betOnLine * $totalMultiple;
        $report['spinWin'] = $report['totalWin'];
        $report['winLines'] = $fullWinLines;
        $report['newReport'] = $newReport;
        $report['replace'] = $newReport['replace'];

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function getMultiWay($winLines, $original = true, $name = 'BaseGame', $afterName = 'OriginalMultiWay') {
        $originLines = array();
        foreach($winLines as $w) {
            if($original) {
                if($w['alias'] !== 's01' && $w['alias'] !== 's02' && $w['alias'] !== 'w01') {
                    $originLines[] = $w;
                }
            }
            else {
                if($w['alias'] == 's01' || $w['alias'] == 's02' || $w['alias'] == 'w01') {
                    $originLines[] = $w;
                }
            }

        }

        if(empty($originLines)) {
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="" />';
        }
        else {
            $aliasArray = array();
            $resultArray = array();
            foreach($originLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'direction' => $w['direction'],
                        'offsets' => array(),
                    );
                }
            }

            foreach($aliasArray as $a) {
                foreach($originLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        $resultArray[$a]['offsets'] = array_unique($resultArray[$a]['offsets']);
                    }
                }
            }

            $reelsCount = count($this->gameParams->reelConfig);
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="">';
            foreach($resultArray as $r) {
                $direction = '';
                if($r['direction'] == 'left') {
                    $direction = 'LeftRight';
                }
                if($r['direction'] == 'right') {
                    $direction = 'RightLeft';
                }
                if($r['direction'] == 'middle') {
                    $direction = 'Middle';
                }
                $item = '<Highlight name="'.$r['count'].' '.$r['alias'].'_'.$direction.'" type="">';
                foreach($r['offsets'] as $o) {
                    $row = floor($o / $reelsCount);
                    $ceil = $o % $reelsCount;
                    $item .= '<Cell name="L0C'.$ceil.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }
            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getWayWinLines($report, $original = true, $name = 'BaseGame', $afterName = 'LeftRightMultiWay') {
        $originLines = array();
        $totalPay = 0;

        foreach($report['winLines'] as $w) {
            if($original) {
                if($w['alias'] !== 's01' && $w['alias'] !== 's02' && $w['alias'] !== 'w01') {
                    $originLines[] = $w;
                    $totalPay += $w['multiple'] * $report['betOnLine'];
                }
            }
            else {
                if($w['alias'] == 's01' || $w['alias'] == 's02' || $w['alias'] == 'w01') {
                    $originLines[] = $w;
                    $totalPay += $w['multiple'] * $report['betOnLine'];
                }
            }
        }

        if(empty($originLines)) {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';

            $aliasArray = array();
            $resultArray = array();

            foreach($originLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'direction' => $w['direction'],
                        'totalPay' => 0,
                        'withWild' => 0,
                        'withoutWild' => 0,
                    );
                    if($this->gameParams->doubleIfWild) {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'] / $w['double'];
                    }
                    else {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'];
                    }

                }
            }

            foreach($aliasArray as $a) {
                foreach($originLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        if($w['withWild']) {
                            $resultArray[$a]['withWild']++;
                        }
                        else {
                            $resultArray[$a]['withoutWild']++;
                        }
                        $resultArray[$a]['totalPay'] += $report['betOnLine']*$w['multiple'];
                    }
                }
            }

            foreach($resultArray as $r) {
                if($this->gameParams->doubleIfWild) {
                    $r['ways'] = $r['withWild'] * 2 + $r['withoutWild'];
                }
                else {
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }

                $direction = '';
                if($r['direction'] == 'left') {
                    $direction = 'LeftRight';
                }
                if($r['direction'] == 'right') {
                    $direction = 'RightLeft';
                }
                if($r['direction'] == 'middle') {
                    $direction = 'Middle';
                }

                $payname = $r['count'].' '.$r['alias'].'_'.$direction;
                $xml .= '<Prize betMultiplier="1" multiplier="'.$this->slot->double.'" name="'.$payname.'" pay="'.$r['wayPay'].'" payName="'.$payname.'" symbolCount="'.$r['count'].'" totalPay="'.$r['totalPay'].'" ways="'.$r['ways'].'" />';
            }

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function showSpinReport($report, $totalWin) {
        $originalHighLight = $this->getMultiWay($report['winLines'], true, 'BaseGame', 'OriginalMultiWay');
        $extendedHighLight = $this->getMultiWay($report['winLines'], false, 'BaseGame', 'ExpandedMultiWay');

        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $display2 = $this->getDisplay($report['newReport'], false, 'BaseGame', 'LittleRedExpandedReels');
        $display3 = $this->getDisplay($report['newReport'], false, 'BaseGame', 'WolfExpandedReels');

        $originalWinLines = $this->getWayWinLines($report, true, 'BaseGame', 'OriginalMultiWay');
        $extendedWinLines = $this->getWayWinLines($report, false, 'BaseGame', 'ExpandedMultiWay');

        $littleActivated = '<TriggerOutcome component="" name="BaseGame.LittleRedExpansionActivated" stage="" />';
        if($report['newReport']['ladyChange']) {
            $littleActivated = '<TriggerOutcome component="" name="BaseGame.LittleRedExpansionActivated" stage="">
        <Trigger name="MissRedExpansionActivated" priority="0" stageConnector="" />
    </TriggerOutcome>';
        }
        $wolfActivated = '<TriggerOutcome component="" name="BaseGame.WolfExpansionActivated" stage="" />';
        if($report['newReport']['wolfChange']) {
            $wolfActivated = '<TriggerOutcome component="" name="BaseGame.WolfExpansionActivated" stage="">
        <Trigger name="WolfExpansionActivated" priority="0" stageConnector="" />
    </TriggerOutcome>';
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353277958758</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>45</Settled>
        <Pending>0</Pending>
        <Payout>'.$totalWin.'</Payout>
    </OutcomeDetail>
    <HighlightOutcome name="BaseGame.Scatter" type="" />
    '.$originalHighLight.$extendedHighLight.$wolfActivated.$littleActivated.'
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
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">spins,5</Cell>
        </Entry>
        <Entry name="L0C1R0" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">spins,6</Cell>
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,15</Cell>
        </Entry>
        <Entry name="L0C3R0" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">spins,7</Cell>
        </Entry>
        <Entry name="L0C4R0" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">spins,5</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display.$display2.$display3.'
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    '.$originalWinLines.$extendedWinLines.'
    <TransactionId>A2310-14397961404755</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.$this->slot->linesCount.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    protected function showStartFreeSpinReport($report, $totalWin) {
        $originalHighLight = $this->getMultiWay($report['winLines'], true, 'BaseGame', 'OriginalMultiWay');
        $extendedHighLight = $this->getMultiWay($report['winLines'], false, 'BaseGame', 'ExpandedMultiWay');

        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $display2 = $this->getDisplay($report['newReport'], false, 'BaseGame', 'LittleRedExpandedReels');
        $display3 = $this->getDisplay($report['newReport'], false, 'BaseGame', 'WolfExpandedReels');

        $scattersHighLight = $this->getScattersHighlight($report['scattersReport']['offsets']);

        $originalWinLines = $this->getWayWinLines($report, true, 'BaseGame', 'OriginalMultiWay');
        $extendedWinLines = $this->getWayWinLines($report, false, 'BaseGame', 'ExpandedMultiWay');

        $littleActivated = '<TriggerOutcome component="" name="BaseGame.LittleRedExpansionActivated" stage="" />';
        if($report['newReport']['ladyChange']) {
            $littleActivated = '<TriggerOutcome component="" name="BaseGame.LittleRedExpansionActivated" stage="">
        <Trigger name="MissRedExpansionActivated" priority="0" stageConnector="" />
    </TriggerOutcome>';
        }
        $wolfActivated = '<TriggerOutcome component="" name="BaseGame.WolfExpansionActivated" stage="" />';
        if($report['newReport']['wolfChange']) {
            $wolfActivated = '<TriggerOutcome component="" name="BaseGame.WolfExpansionActivated" stage="">
        <Trigger name="WolfExpansionActivated" priority="0" stageConnector="" />
    </TriggerOutcome>';
        }


        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];
        $_SESSION['gameTotal'] = $totalWin;

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353277958758</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Start</GameStatus>
        <Settled>45</Settled>
        <Pending>0</Pending>
        <Payout>'.$totalWin.'</Payout>
    </OutcomeDetail>
    '.$scattersHighLight.$originalHighLight.$extendedHighLight.$wolfActivated.$littleActivated.'
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
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">spins,5</Cell>
        </Entry>
        <Entry name="L0C1R0" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">spins,6</Cell>
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,15</Cell>
        </Entry>
        <Entry name="L0C3R0" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">spins,7</Cell>
        </Entry>
        <Entry name="L0C4R0" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">spins,5</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display.$display2.$display3.'
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>1</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    '.$originalWinLines.$extendedWinLines.'
    <TransactionId>A2310-14397961404755</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.$this->slot->linesCount.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'PICK';
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display.$display2.$display3, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighLight.$originalHighLight.$originalWinLines.$extendedHighLight.$extendedWinLines, 9));
        $_SESSION['pickerCount'] = 1;
    }


    protected function startPick($request) {
        $pick = (array) $request['PickerInput']->Pick->attributes()->name;
        $pick = $pick[0];

        $_SESSION['pickerCount']--;

        $balance = $this->getBalance();

        $awardArray = array();
        while(count($awardArray) < 5) {
            $rnd = rnd(5,15);
            if(!in_array($rnd, $awardArray)) {
                $awardArray[] = $rnd;
            }
        }
        $awarded = $awardArray[0];

        $_SESSION['initAwarded'] = $awarded;
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;

        if($pick == 'L0C2R0') {
            $lastPicks = array('L0C0R0', 'L0C1R0', 'L0C3R0', 'L0C4R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0', 'L0C3R0', 'L0C4R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C0R0', 'L0C2R0', 'L0C3R0', 'L0C4R0');
        }
        if($pick == 'L0C3R0') {
            $lastPicks = array('L0C0R0', 'L0C1R0', 'L0C2R0', 'L0C4R0');
        }
        if($pick == 'L0C4R0') {
            $lastPicks = array('L0C1R0', 'L0C0R0', 'L0C2R0', 'L0C3R0');
        }

        $gameTotal = $_SESSION['gameTotal'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353206120250</TransactionId>
        <Stage>Picker</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>45</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>

    <FreeSpinOutcome name="">
        <InitAwarded>'.$awarded.'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$awarded.'</TotalAwarded>
        <Count>0</Count>
        <Countdown>'.$awarded.'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerOutcome name="">
        <Layer index="0" name="layer0">
            <Pick name="'.$pick.'" picked="true">
                <Feature type="spins" value="'.$awardArray[0].'" />
            </Pick>
            <Pick name="'.$lastPicks[0].'" picked="false">
                <Feature type="spins" value="'.$awardArray[1].'" />
            </Pick>
            <Pick name="'.$lastPicks[1].'" picked="false">
                <Feature type="spins" value="'.$awardArray[2].'" />
            </Pick>
            <Pick name="'.$lastPicks[2].'" picked="false">
                <Feature type="spins" value="'.$awardArray[3].'" />
            </Pick>
            <Pick name="'.$lastPicks[3].'" picked="false">
                <Feature type="spins" value="'.$awardArray[4].'" />
            </Pick>
        </Layer>
    </PickerOutcome>
    <PopulationOutcome name="Picker.CombinedPicks" stage="Picker">
        <Entry name="Pick" stripIndex="17">
            <Cell name="L0C0R0" stripIndex="17">spins,'.$awardArray[0].',spins,'.$awardArray[1].',spins,'.$awardArray[2].',spins,'.$awardArray[3].',spins,'.$awardArray[4].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="Picker" stage="Picker">
        <Entry name="Pick1" stripIndex="0">
            <Cell name="'.$pick.'" stripIndex="0">spins,'.$awardArray[0].'</Cell>
        </Entry>
        <Entry name="Pick2" stripIndex="0">
            <Cell name="'.$lastPicks[0].'" stripIndex="0">spins,'.$awardArray[1].'</Cell>
        </Entry>
        <Entry name="Pick3" stripIndex="0">
            <Cell name="'.$lastPicks[1].'" stripIndex="0">spins,'.$awardArray[2].'</Cell>
        </Entry>
        <Entry name="Pick4" stripIndex="0">
            <Cell name="'.$lastPicks[2].'" stripIndex="0">spins,'.$awardArray[3].'</Cell>
        </Entry>
        <Entry name="Pick5" stripIndex="0">
            <Cell name="'.$lastPicks[3].'" stripIndex="0">spins,'.$awardArray[4].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="55">
            <Cell name="L0C0R0" stripIndex="55">s10</Cell>
            <Cell name="L0C0R1" stripIndex="56">s04</Cell>
            <Cell name="L0C0R2" stripIndex="57">s08</Cell>
            <Cell name="L0C0R3" stripIndex="58">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="21">
            <Cell name="L0C1R0" stripIndex="21">s04</Cell>
            <Cell name="L0C1R1" stripIndex="22">s07</Cell>
            <Cell name="L0C1R2" stripIndex="23">s01</Cell>
            <Cell name="L0C1R3" stripIndex="24">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="33">
            <Cell name="L0C2R0" stripIndex="33">s08</Cell>
            <Cell name="L0C2R1" stripIndex="34">b01</Cell>
            <Cell name="L0C2R2" stripIndex="35">s10</Cell>
            <Cell name="L0C2R3" stripIndex="36">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="19">
            <Cell name="L0C3R0" stripIndex="19">s02</Cell>
            <Cell name="L0C3R1" stripIndex="20">s09</Cell>
            <Cell name="L0C3R2" stripIndex="21">s07</Cell>
            <Cell name="L0C3R3" stripIndex="22">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s03</Cell>
            <Cell name="L0C4R1" stripIndex="47">s01</Cell>
            <Cell name="L0C4R2" stripIndex="48">s08</Cell>
            <Cell name="L0C4R3" stripIndex="49">s10</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.ExpandedReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="55">
            <Cell name="L0C0R0" stripIndex="55">s10</Cell>
            <Cell name="L0C0R1" stripIndex="56">s04</Cell>
            <Cell name="L0C0R2" stripIndex="57">s08</Cell>
            <Cell name="L0C0R3" stripIndex="58">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="21">
            <Cell name="L0C1R0" stripIndex="21">s04</Cell>
            <Cell name="L0C1R1" stripIndex="22">s07</Cell>
            <Cell name="L0C1R2" stripIndex="23">s01</Cell>
            <Cell name="L0C1R3" stripIndex="24">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="33">
            <Cell name="L0C2R0" stripIndex="33">s08</Cell>
            <Cell name="L0C2R1" stripIndex="34">b01</Cell>
            <Cell name="L0C2R2" stripIndex="35">s10</Cell>
            <Cell name="L0C2R3" stripIndex="36">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="19">
            <Cell name="L0C3R0" stripIndex="19">s02</Cell>
            <Cell name="L0C3R1" stripIndex="20">s09</Cell>
            <Cell name="L0C3R2" stripIndex="21">s07</Cell>
            <Cell name="L0C3R3" stripIndex="22">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s03</Cell>
            <Cell name="L0C4R1" stripIndex="47">s01</Cell>
            <Cell name="L0C4R2" stripIndex="48">s08</Cell>
            <Cell name="L0C4R3" stripIndex="49">s10</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'0" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R0140-14353244090019</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.($_SESSION['lastBet']/$_SESSION['lastPick']).'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['preState'] = 'SPIN';
    }

    protected function getTransform($offsets) {

        if(!empty($offsets)) {
            $xml = '<HighlightOutcome name="FreeSpin.TransformedReels" type="">
        <Highlight name="FreeSpin" type="">';
            foreach($offsets as $o) {
                $CeilRow = $this->slot->getCeilRowByOffset($o);
                $xml .= '<Cell name="L0C'.$CeilRow['ceil'].'R'.$CeilRow['row'].'" type="" />';
            }
            $xml .= '</Highlight>
    </HighlightOutcome>';
        }
        else {
            $xml = '<HighlightOutcome name="FreeSpin.TransformedReels" type="" />';
        }


        return $xml;
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $transform = $this->getTransform($report['replace']['offsets']);

        $originalHighLight = $this->getMultiWay($report['winLines'], true, 'FreeSpin', 'OriginalMultiWay');
        $extendedHighLight = $this->getMultiWay($report['winLines'], false, 'FreeSpin', 'ExpandedMultiWay');

        $balance = $_SESSION['startBalance'];

        $display = $this->getDisplay($report, false, 'FreeSpin', 'Reels', true);
        $display2 = $this->getDisplay($report, false, 'FreeSpin', 'TransformedReels', false);
        $display3 = $this->getDisplay($report['newReport'], false, 'FreeSpin', 'ExpandedReels');

        $originalWinLines = $this->getWayWinLines($report, true, 'FreeSpin', 'OriginalMultiWay');
        $extendedWinLines = $this->getWayWinLines($report, false, 'FreeSpin', 'ExpandedMultiWay');

        $awarded = 0;
        $scattersHighlight = '';
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['pickerCount']++;
            $awarded = 1;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $_SESSION['fsTotalWin'] += $totalWin;

        $needBalance = $_SESSION['startBalance'];
        $nextStage = 'FreeSpin';
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

            if($_SESSION['pickerCount'] > 0) {
                $nextStage = 'Picker';
                $_SESSION['fsState'] = 'Picker';
            }
        }



        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];

        if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] > 0) {
            $nextStage = 'Picker';
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353277958758</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseScatter.$extendedHighLight.$transform.$originalHighLight.$scattersHighlight.'
    <TriggerOutcome component="" name="FreeSpin.Trigger" stage="" />
    <TriggerOutcome component="" name="Retrigger" stage="" />
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$display2.$display.$display3.$baseReels.'
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <IncrementTriggered>'.(($awarded > 0) ? 'true' : 'false').'</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="45" multiplier="1" name="Scatter" pay="0" payName="3 b01" symbolCount="3" totalPay="0" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$originalWinLines.$extendedWinLines.'
    <TransactionId>A2310-14397961404755</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.$this->slot->linesCount.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['initAwarded']);
            unset($_SESSION['baseWinLinesWin']);
        }
        else {
            if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] > 0) {
                $_SESSION['state'] = 'PICK';
                $_SESSION['fsPlayed'] = 0;
            }
        }
    }

}
