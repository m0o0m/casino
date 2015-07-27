<?
require_once('IGTCtrl.php');

class pixies_of_the_forestCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');
        $this->setSessionIfEmpty('preState', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1157-002"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Pixies of the Forest"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="PixiesOfTheForest"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Pixies of the Forest 99L 3x3x3x3x3 3for1" maxRTP="94.90" minRTP="93.00" name="Pixies of the Forest" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="FreeSpinPrizeInfoLines" strategy="PayLeftHighestCount">
        '.$symbolPay.'
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
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>1</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="FreeSpin"/>
        <ExitOutcomeTrigger name="FreeSpin"/>
        <Triggers>
            <Trigger name="FreeSpin" picks="1"/>
        </Triggers>
    </PickerInfo>
    <PatternSliderInfo>
        <PatternInfo max="33" min="33" multiplier="3">
            <Step>33</Step>
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
        <Denomination softwareId="200-1157-002">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>33.0</MaxBet>
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

    /*
    protected function startInit($request) {
        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'SPIN') {
            $state = 'BaseGameTumble';
        }
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'FREE') {
            $state = 'FreeSpinTumble';
        }
        if($_SESSION['state'] == 'PICK') {
            $state = 'Picker';
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE' || $_SESSION['preState'] == 'FREE') {
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>6</InitAwarded>
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
    </PrizeOutcome>';
        }

        if($_SESSION['state'] == 'PICK') {
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>0</TotalAwarded>
        <Count>0</Count>
        <Countdown>0</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <TriggerOutcome component="" name="PickerTriggers" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Bonus" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>';
        }

        $base = '<PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s03</Cell>
            <Cell name="L0C0R1" stripIndex="3">s06</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s06</Cell>
            <Cell name="L0C1R1" stripIndex="4">s01</Cell>
            <Cell name="L0C1R2" stripIndex="5">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s07</Cell>
            <Cell name="L0C2R1" stripIndex="20">s01</Cell>
            <Cell name="L0C2R2" stripIndex="21">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">s03</Cell>
            <Cell name="L0C3R1" stripIndex="15">s01</Cell>
            <Cell name="L0C3R2" stripIndex="16">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s03</Cell>
            <Cell name="L0C4R1" stripIndex="5">s02</Cell>
            <Cell name="L0C4R2" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s01</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s02</Cell>
            <Cell name="L0C1R1" stripIndex="4">s07</Cell>
            <Cell name="L0C1R2" stripIndex="5">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s03</Cell>
            <Cell name="L0C2R1" stripIndex="20">s05</Cell>
            <Cell name="L0C2R2" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">w01</Cell>
            <Cell name="L0C3R1" stripIndex="15">s03</Cell>
            <Cell name="L0C3R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s06</Cell>
            <Cell name="L0C4R1" stripIndex="5">s04</Cell>
            <Cell name="L0C4R2" stripIndex="6">s02</Cell>
        </Entry>
    </PopulationOutcome>';
        if($_SESSION['state'] !== 'SPIN') {
            $base = gzuncompress(base64_decode($_SESSION['baseDisplay'])) . gzuncompress(base64_decode($_SESSION['baseScatter']));
            if(!empty($_SESSION['baseFreeDisplay'])) {
                $base .= gzuncompress(base64_decode($_SESSION['baseFreeDisplay'])) . gzuncompress(base64_decode($_SESSION['baseFreeScatter']));
            }
        }

        $patternsBet = 33;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043359686</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.$base.'
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>'.$patternsBet.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }
    */

    protected function startInit($request) {
        $balance = $this->getBalance();

        $base = '<PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s03</Cell>
            <Cell name="L0C0R1" stripIndex="3">s06</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s06</Cell>
            <Cell name="L0C1R1" stripIndex="4">s01</Cell>
            <Cell name="L0C1R2" stripIndex="5">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s07</Cell>
            <Cell name="L0C2R1" stripIndex="20">s01</Cell>
            <Cell name="L0C2R2" stripIndex="21">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">s03</Cell>
            <Cell name="L0C3R1" stripIndex="15">s01</Cell>
            <Cell name="L0C3R2" stripIndex="16">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s03</Cell>
            <Cell name="L0C4R1" stripIndex="5">s02</Cell>
            <Cell name="L0C4R2" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s01</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s02</Cell>
            <Cell name="L0C1R1" stripIndex="4">s07</Cell>
            <Cell name="L0C1R2" stripIndex="5">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s03</Cell>
            <Cell name="L0C2R1" stripIndex="20">s05</Cell>
            <Cell name="L0C2R2" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">w01</Cell>
            <Cell name="L0C3R1" stripIndex="15">s03</Cell>
            <Cell name="L0C3R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s06</Cell>
            <Cell name="L0C4R1" stripIndex="5">s04</Cell>
            <Cell name="L0C4R2" stripIndex="6">s02</Cell>
        </Entry>
    </PopulationOutcome>';

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }
        if($_SESSION['state'] == 'PICK') {
            $state = 'Picker';
        }
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'SPIN') {
            $state = 'BaseGameTumble';
        }
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'FREE') {
            $state = 'FreeSpinTumble';
        }

        if($_SESSION['state'] !== 'SPIN') {
            $base = gzuncompress(base64_decode($_SESSION['baseDisplay'])) . gzuncompress(base64_decode($_SESSION['baseScatter']));
            if(!empty($_SESSION['baseFreeDisplay'])) {
                $base .= gzuncompress(base64_decode($_SESSION['baseFreeDisplay'])) . gzuncompress(base64_decode($_SESSION['baseFreeScatter']));
            }
        }

        $fs = '';

        if($_SESSION['state'] == 'PICK') {
            $fs .= '<PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <TriggerOutcome component="" name="PickerTriggers" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Bonus" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>';
        }

        if($_SESSION['state'] == 'FREE' || $_SESSION['preState'] == 'FREE') {
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
    </PrizeOutcome>';
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043359686</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.$base.'
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>33</PatternsBet>
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
        $pick = (int) $totalBet * 3;

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake, 3);

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

    protected function startPick($request) {
        $pick = (array) $request['PickerInput']->Pick->attributes()->name;
        $pick = $pick[0];

        $balance = $this->getBalance();

        $awardArray = array();
        while(count($awardArray) < 3) {
            $rnd = rnd(7,13);
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
            $lastPicks = array('L0C1R0', 'L0C0R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C2R0', 'L0C0R0');
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353206120250</TransactionId>
        <Stage>Picker</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>33</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>

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
        </Layer>
    </PickerOutcome>
    <PopulationOutcome name="Picker.CombinedPicks" stage="Picker">
        <Entry name="Pick" stripIndex="17">
            <Cell name="L0C0R0" stripIndex="17">spins,'.$awardArray[0].',spins,'.$awardArray[1].',spins,'.$awardArray[2].'</Cell>
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
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s01</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s02</Cell>
            <Cell name="L0C1R1" stripIndex="4">s07</Cell>
            <Cell name="L0C1R2" stripIndex="5">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s03</Cell>
            <Cell name="L0C2R1" stripIndex="20">s05</Cell>
            <Cell name="L0C2R2" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">w01</Cell>
            <Cell name="L0C3R1" stripIndex="15">s03</Cell>
            <Cell name="L0C3R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s06</Cell>
            <Cell name="L0C4R1" stripIndex="5">s04</Cell>
            <Cell name="L0C4R2" stripIndex="6">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="0" stage="" totalPay="0" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="0" payName="" symbolCount="0" totalPay="0" ways="0" />
    </PrizeOutcome>
    <TransactionId>R0140-14353244090019</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>33</PatternsBet>
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

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake, 3);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,3,3,3,3));

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

    protected function startTumble($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake, 3);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,3,3,3,3));
        $this->slot->reels = unserialize($_SESSION['reels']);

        foreach($_SESSION['avalancheOffsets'] as $o) {
            $ceilRow = $this->slot->getCeilRowByOffset($o);
            $this->slot->reels[$ceilRow['ceil']]->avalanche($ceilRow['row']);
        }

        $this->slot->resetSlotData();
        $this->slot->startRows = $this->slot->getRows();

        $report = $this->slot->makeReport();
        $report['type'] = 'TUMBLE';

        $this->fsPays[] = array(
            'win' => $report['spinWin'],
            'report' => $report,
        );

        $f = false;
        foreach($report['winLines'] as $w) {
            if($w['alias'] == 'b01') {
                $f = true;
            }
        }

        if($f) {
            $this->showFreeFromTumble($report, $report['totalWin']);
        }
        else {
            $this->showTumbleReport($report, $report['totalWin']);
        }



        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $report['stops'];
        $this->startPay();
    }

    protected function startTumbleFree($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake, 3);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,3,3,3,3));
        $this->slot->reels = unserialize($_SESSION['reelsFree']);

        foreach($_SESSION['avalancheOffsetsFree'] as $o) {
            $ceilRow = $this->slot->getCeilRowByOffset($o);
            $this->slot->reels[$ceilRow['ceil']]->avalanche($ceilRow['row']);
        }

        $this->slot->resetSlotData();
        $this->slot->startRows = $this->slot->getRows();

        $report = $this->slot->makeReport();
        $report['type'] = 'TUMBLE';

        $this->fsPays[] = array(
            'win' => $report['spinWin'],
            'report' => $report,
        );

        $this->showTumbleFreeReport($report, $report['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $report['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array();

        if($this->gameParams->testBonusEnable && $_SESSION['state'] == 'SPIN') {
            $url = $_SERVER['HTTP_REFERER'];
            $g = '';
            if (strpos($url, 'bonus=fs') > 0) {
                $bonus = array(
                    'type' => 'setReelsOffsets',
                    'offsets' => array(1,12,11,5,10),
                );
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        if(!empty($report['winLines'])) {
            if($_SESSION['state'] == 'SPIN') $_SESSION['preState'] = 'SPIN';
            if($_SESSION['state'] == 'FREE') $_SESSION['preState'] = 'FREE';
            $_SESSION['state'] = 'TUMBLE';
        }

        foreach($report['winLines'] as $w) {
            if($w['alias'] == 'b01') {
                $_SESSION['state'] = 'PICK';
                $report['type'] = 'FREE';
            }
        }



        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $nextStage = 'BaseGame';
        $status = 'Start';
        $settled = $report['bet'];
        $pending = 0;
        $payout = $totalWin;
        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        if(!empty($report['winLines'])) {
            $balance = $this->getBalance() - $report['bet'];
            $nextStage = 'BaseGameTumble';
            $status = 'InProgress';
            $settled = 0;
            $pending = $report['bet'];
            $payout = 0;
            $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>';


            $_SESSION['reels'] = serialize($this->slot->reels);
            $_SESSION['avalancheOffsets'] = array();
            $tmp = array();
            foreach($report['winLines'] as $w) {
                $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
            }
            foreach($tmp as $l) {
                foreach($l as $o) {
                    $_SESSION['avalancheOffsets'][] = $o;
                }
            }
            $_SESSION['avalancheOffsets'] = array_unique($_SESSION['avalancheOffsets']);
            $_SESSION['totalWin'] = $totalWin;
            $_SESSION['startSpinBalance'] = $balance;

            $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
            $_SESSION['baseScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$status.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    '.$trigger.$highlight.'

    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    public function showTumbleReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['totalWin'] += $totalWin;

        $nextStage = 'BaseGame';
        $status = 'Start';
        $settled = 0;
        $pending = $report['bet'];
        $payout = $_SESSION['totalWin'];
        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        if(!empty($report['winLines'])) {
            $balance = $_SESSION['startSpinBalance'];
            $nextStage = 'BaseGameTumble';
            $status = 'InProgress';
            $settled = $report['bet'];
            $pending = 0;
            $payout = 0;

            $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>';


            $_SESSION['reels'] = serialize($this->slot->reels);
            $_SESSION['avalancheOffsets'] = array();
            $tmp = array();
            foreach($report['winLines'] as $w) {
                $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
            }
            foreach($tmp as $l) {
                foreach($l as $o) {
                    $_SESSION['avalancheOffsets'][] = $o;
                }
            }
            $_SESSION['avalancheOffsets'] = array_unique($_SESSION['avalancheOffsets']);

            $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
            $_SESSION['baseScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGameTumble</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$status.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$trigger.$highlight.'

    '.$display.'
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['totalWin'].'" stage="" totalPay="'.$_SESSION['totalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['totalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['totalWin'].'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if(empty($report['winLines'])) {
            if($_SESSION['preState'] == 'SPIN') $_SESSION['state'] = 'SPIN';
            if($_SESSION['preState'] == 'FREE') $_SESSION['state'] = 'FREE';

            unset($_SESSION['reels']);
            unset($_SESSION['avalancheOffsets']);
            unset($_SESSION['totalWin']);
            unset($_SESSION['startSpinBalance']);
        }
    }

    public function showFreeFromTumble($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $_SESSION['startSpinBalance'];

        $_SESSION['startSpinBalance'] = $balance;

        $_SESSION['fsTotalWin'] = 0;

        $_SESSION['startFreeBalance'] = $this->getBalance();
        $_SESSION['startBalance'] = $this->getBalance();



        $_SESSION['reels'] = serialize($this->slot->reels);
        $_SESSION['avalancheOffsets'] = array();
        $tmp = array();
        foreach($report['winLines'] as $w) {
            $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
        }
        foreach($tmp as $l) {
            foreach($l as $o) {
                $_SESSION['avalancheOffsets'][] = $o;
            }
        }
        $_SESSION['avalancheOffsets'] = array_unique($_SESSION['avalancheOffsets']);



        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$_SESSION['startFreeBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="PickerTriggers" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Bonus" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$highlight.'

    '.$display.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s01</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s02</Cell>
            <Cell name="L0C1R1" stripIndex="4">s07</Cell>
            <Cell name="L0C1R2" stripIndex="5">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s03</Cell>
            <Cell name="L0C2R1" stripIndex="20">s05</Cell>
            <Cell name="L0C2R2" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">w01</Cell>
            <Cell name="L0C3R1" stripIndex="15">s03</Cell>
            <Cell name="L0C3R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s06</Cell>
            <Cell name="L0C4R1" stripIndex="5">s04</Cell>
            <Cell name="L0C4R2" stripIndex="6">s02</Cell>
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
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'PICK';
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
    }


    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'];

        $_SESSION['startSpinBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = 0;

        $_SESSION['startFreeBalance'] = $this->getBalance() - $report['bet'];
        $_SESSION['startBalance'] = $this->getBalance() - $report['bet'];



        $_SESSION['reels'] = serialize($this->slot->reels);
        $_SESSION['avalancheOffsets'] = array();
        $tmp = array();
        foreach($report['winLines'] as $w) {
            $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
        }
        foreach($tmp as $l) {
            foreach($l as $o) {
                $_SESSION['avalancheOffsets'][] = $o;
            }
        }
        $_SESSION['avalancheOffsets'] = array_unique($_SESSION['avalancheOffsets']);



        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$_SESSION['startFreeBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="PickerTriggers" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Bonus" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$highlight.'

    '.$display.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s01</Cell>
            <Cell name="L0C0R1" stripIndex="3">s05</Cell>
            <Cell name="L0C0R2" stripIndex="4">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="3">
            <Cell name="L0C1R0" stripIndex="3">s02</Cell>
            <Cell name="L0C1R1" stripIndex="4">s07</Cell>
            <Cell name="L0C1R2" stripIndex="5">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="19">
            <Cell name="L0C2R0" stripIndex="19">s03</Cell>
            <Cell name="L0C2R1" stripIndex="20">s05</Cell>
            <Cell name="L0C2R2" stripIndex="21">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="14">
            <Cell name="L0C3R0" stripIndex="14">w01</Cell>
            <Cell name="L0C3R1" stripIndex="15">s03</Cell>
            <Cell name="L0C3R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="4">
            <Cell name="L0C4R0" stripIndex="4">s06</Cell>
            <Cell name="L0C4R1" stripIndex="5">s04</Cell>
            <Cell name="L0C4R2" stripIndex="6">s02</Cell>
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
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'PICK';

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines', 0, 'Remove');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $awarded = 0;
        if($report['type'] == 'FREE') {
            $_SESSION['totalAwarded'] += 6;
            $_SESSION['fsLeft'] += 6;
            $awarded = 6;
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
            $nextStage = 'BaseGameTumble';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        }


        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        if(!empty($report['winLines'])) {
            $nextStage = 'FreeSpinTumble';

            $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>';

            $_SESSION['reelsFree'] = serialize($this->slot->reels);
            $_SESSION['avalancheOffsetsFree'] = array();
            $tmp = array();
            foreach($report['winLines'] as $w) {
                $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
            }
            foreach($tmp as $l) {
                foreach($l as $o) {
                    $_SESSION['avalancheOffsetsFree'][] = $o;
                }
            }
            $_SESSION['avalancheOffsetsFree'] = array_unique($_SESSION['avalancheOffsetsFree']);
            $_SESSION['totalWin'] = $totalWin;
            $_SESSION['startBalance'] = $balance;
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>FreeSpin</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$needBalance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$baseScatter.'
    '.$trigger.$highlight.'
    '.$display.$baseReels.'
    <FreeSpinOutcome name="">
        <InitAwarded>6</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
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
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$needBalance.'">
        <Balance name="FREE">'.$needBalance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        if($_SESSION['fsLeft'] == 0 && $_SESSION['state'] == 'FREE') {
            $_SESSION['preState'] = 'SPIN';
            $_SESSION['state'] = 'TUMBLE';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
        }

        $_SESSION['baseFreeDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseFreeScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
    }


    public function showTumbleFreeReport($report, $totalWin) {
        $balance = $this->getBalance() + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines', 0, 'Remove');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];


        $_SESSION['totalWin'] += $totalWin;

        $_SESSION['fsTotalWin'] += $totalWin;


        $nextStage = 'FreeSpin';
        $status = 'Start';
        $settled = 0;
        $pending = $report['bet'];
        $payout = $_SESSION['totalWin'];
        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        if(!empty($report['winLines'])) {
            $balance = $_SESSION['startBalance'];
            $nextStage = 'FreeSpinTumble';
            $status = 'InProgress';
            $settled = $report['bet'];
            $pending = 0;
            $payout = 0;

            $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>';


            $_SESSION['reelsFree'] = serialize($this->slot->reels);
            $_SESSION['avalancheOffsetsFree'] = array();
            $tmp = array();
            foreach($report['winLines'] as $w) {
                $tmp[] = $this->slot->getOffsetsByLine($w['line'], $w['count']);
            }
            foreach($tmp as $l) {
                foreach($l as $o) {
                    $_SESSION['avalancheOffsetsFree'][] = $o;
                }
            }
            $_SESSION['avalancheOffsetsFree'] = array_unique($_SESSION['avalancheOffsetsFree']);
        }
        else {
            if($_SESSION['fsLeft'] == 0) {
                $nextStage = 'BaseGameTumble';
                $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
                $status = 'Start';
            }
        }

        $awarded = 0;

        foreach($report['winLines'] as $w) {
            if($w['alias'] == 'b01') {
                $_SESSION['totalAwarded'] += 6;
                $_SESSION['fsLeft'] += 6;
                $awarded = 6;
            }
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>FreeSpinTumble</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$status.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$trigger.$highlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>6</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$display.$baseReels.'
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>'.($report['linesCount']/3).'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['baseFreeDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseFreeScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));

        if(empty($report['winLines'])) {
            if($_SESSION['preState'] == 'SPIN') $_SESSION['state'] = 'SPIN';
            if($_SESSION['preState'] == 'FREE') $_SESSION['state'] = 'FREE';

            unset($_SESSION['reelsFree']);
            unset($_SESSION['avalancheOffsetsFree']);
        }


        if($_SESSION['fsLeft'] == 0 && $_SESSION['state'] == 'FREE') {
            $_SESSION['preState'] = 'SPIN';
            $_SESSION['state'] = 'TUMBLE';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}