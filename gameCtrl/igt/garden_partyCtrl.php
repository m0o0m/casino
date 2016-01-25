<?
require_once('IGTCtrl.php');

class garden_partyCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1172-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Garden Party"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="GardenParty"/>
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
    <param name="denomamount" value="1.0"/>
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

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = $_SESSION['fsState'];
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
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
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="BaseGame.LeftRightMultiWay" pay="0" stage="" totalPay="0" type="Pattern" />
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <MultiplierOutcome name="NextMultiplier">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>';
        }

        $patternsBet = 50;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14264049099527</TransactionId>
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
        if(!isset($_SESSION['fsType'])) {
            $pick = (array) $request['PickerInput']->Pick;
            $pick = $pick['@attributes']['name'];
            $pick = $pick[3];
            $_SESSION['fsType'] = $pick;

            switch($pick) {
                case '0':
                    $_SESSION['initAwarded'] = 5;
                    $_SESSION['totalAwarded'] = 5;
                    $_SESSION['fsLeft'] = 5;
                    $_SESSION['maxMultiple'] = 20;
                    break;
                case '1':
                    $_SESSION['initAwarded'] = 10;
                    $_SESSION['totalAwarded'] = 10;
                    $_SESSION['fsLeft'] = 10;
                    $_SESSION['maxMultiple'] = 15;
                    break;
                case '2':
                    $_SESSION['initAwarded'] = 15;
                    $_SESSION['totalAwarded'] = 15;
                    $_SESSION['fsLeft'] = 15;
                    $_SESSION['maxMultiple'] = 10;
                    break;
                case '3':
                    $_SESSION['initAwarded'] = 20;
                    $_SESSION['totalAwarded'] = 20;
                    $_SESSION['fsLeft'] = 20;
                    $_SESSION['maxMultiple'] = 5;
                    break;
                case '4':
                    $_SESSION['initAwarded'] = 30;
                    $_SESSION['totalAwarded'] = 30;
                    $_SESSION['fsLeft'] = 30;
                    $_SESSION['maxMultiple'] = 3;
                    break;
            }

            $_SESSION['fsState'] = 'FreeSpin';

            $this->showPickInfo();
        }
        else {
            $_SESSION['fsState'] = 'FreeSpin';
            $stake = $_SESSION['lastBet'];
            $pick = $_SESSION['lastPick'];

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
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array();

        if($_SESSION['state'] == 'FREE') {
            $bonus = array(
                'type' => 'multiple',
                'range' => array($_SESSION['nextMultiple'], $_SESSION['nextMultiple']),
            );
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $multiple = 100;
            if($report['scattersReport']['count'] == 4) {
                $multiple = 200;
            }
            if($report['scattersReport']['count'] == 5) {
                $multiple = 500;
            }
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['betOnLine'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }
        else {
            //$respin = true;
        }

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

    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['fsState'] = 'Picker';

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$scattersHighlight.'
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlightLeft.'

    '.$display.$display2.'
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.'
    '.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
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

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 0;
        $_SESSION['fsLeft'] = 0;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['initAwarded'] = 0;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlightLeft.$leftWinLines, 9));
        $_SESSION['nextMultiple'] = 1;
        $_SESSION['pickerCount'] = 1;
    }

    protected function showPickInfo() {
        $balance = $this->getBalance();
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
        $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $_SESSION['nextMultiple'] = rnd(1, $_SESSION['maxMultiple']);

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $_SESSION['pickerCount']--;


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1440-14228620478679</TransactionId>
        <Stage>Picker</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>50</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <HighlightOutcome name="BaseGame.LeftRightMultiWay" type="" />
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>'.$_SESSION['initAwarded'].'</Awarded>
        <TotalAwarded>'.$_SESSION['initAwarded'].'</TotalAwarded>
        <Count>0</Count>
        <Countdown>'.$_SESSION['initAwarded'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerOutcome name="">
        <Layer index="0" name="layer0">
            <Pick name="L0C0R0" picked="'.(($_SESSION['fsType'] == 0) ? 'true' : 'false').'">
                <Feature type="spins" value="5" />
                <Feature type="multiplier" value="20" />
                <Feature type="trigger" value="multiplier20" />
            </Pick>
            <Pick name="L0C1R0" picked="'.(($_SESSION['fsType'] == 1) ? 'true' : 'false').'">
                <Feature type="spins" value="10" />
                <Feature type="multiplier" value="15" />
                <Feature type="trigger" value="multiplier15" />
            </Pick>
            <Pick name="L0C2R0" picked="'.(($_SESSION['fsType'] == 2) ? 'true' : 'false').'">
                <Feature type="spins" value="15" />
                <Feature type="multiplier" value="10" />
                <Feature type="trigger" value="multiplier10" />
            </Pick>
            <Pick name="L0C3R0" picked="'.(($_SESSION['fsType'] == 3) ? 'true' : 'false').'">
                <Feature type="spins" value="20" />
                <Feature type="multiplier" value="5" />
                <Feature type="trigger" value="multiplier5" />
            </Pick>
            <Pick name="L0C4R0" picked="'.(($_SESSION['fsType'] == 4) ? 'true' : 'false').'">
                <Feature type="spins" value="30" />
                <Feature type="multiplier" value="3" />
                <Feature type="trigger" value="multiplier3" />
            </Pick>
        </Layer>
    </PickerOutcome>
    <MultiplierOutcome name="NextMultiplier">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>
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
    <PopulationOutcome name="Picker.Multiplier" stage="Picker">
        <Entry name="multiplier20" stripIndex="6">
            <Cell name="L0C0R0" stripIndex="6">7</Cell>
        </Entry>
        <Entry name="multiplier15" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">2</Cell>
        </Entry>
        <Entry name="multiplier10" stripIndex="1">
            <Cell name="L0C2R0" stripIndex="1">2</Cell>
        </Entry>
        <Entry name="multiplier5" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">1</Cell>
        </Entry>
        <Entry name="multiplier3" stripIndex="0">
            <Cell name="L0C4R0" stripIndex="0">1</Cell>
        </Entry>
    </PopulationOutcome>
    '.$baseReels.$display2.'
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1440-14228620476904</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.($_SESSION['lastBet']/$_SESSION['lastPick']).'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="L0C0R0" />
    </PickerInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);


    }

    protected function showPlayFreeSpinReport($report, $totalWin) {

        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'FreeSpin');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $awarded = 0;
        $scattersHighlight = '';
        $scattersPay = '';
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['pickerCount']++;
            $awarded = 1;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
            $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $needBalance = $_SESSION['startBalance'];



        $_SESSION['fsTotalWin'] += $totalWin;

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

        $_SESSION['nextMultiple'] = rnd(1, $_SESSION['maxMultiple']);

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228769811206</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseScatter.'
    '.$highlightLeft.$scattersHighlight.'
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <IncrementTriggered>'.(($awarded > 0) ? 'true' : 'false').'</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <MultiplierOutcome name="NextMultiplier">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>
    '.$baseReels.$display.'

    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>

    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    <TransactionId>R1540-14228769811020</TransactionId>
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


        if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['fsState']);
            unset($_SESSION['initAwarded']);
            unset($_SESSION['fsType']);
            unset($_SESSION['maxMultiple']);
            unset($_SESSION['nextMultiple']);
            unset($_SESSION['baseWinLinesWin']);
        }
        else {
            if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] > 0) {
                unset($_SESSION['fsType']);
                $_SESSION['fsPlayed'] = 0;
            }
        }

    }

}
