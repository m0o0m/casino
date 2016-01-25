<?
require_once('IGTCtrl.php');

class star_trekCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1144-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Star Trek"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="StarTrek"/>
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
        $b1Reel = $this->getReelXml($this->gameParams->reels[1]);
        $b2Reel = $this->getReelXml($this->gameParams->reels[2]);
        $b3Reel = $this->getReelXml($this->gameParams->reels[3]);
        $b4Reel = $this->getReelXml($this->gameParams->reels[4]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="Star Trek 30L 3x3x3x3x3" maxRTP="95.16" minRTP="92.66" name="Star Trek" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b03" required="true"/>
        </Prize>
        <Prize name="b04">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b04" required="true"/>
        </Prize>
        <Prize name="b05">
            <PrizePay count="3" pph="466.9" value="3"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b05" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="KirkBonus">
        '.$b1Reel.'
    </StripInfo>
    <StripInfo name="SpockBonus">
        '.$b2Reel.'
    </StripInfo>
    <StripInfo name="UhuraBonus">
        '.$b3Reel.'
    </StripInfo>
    <StripInfo name="ScottyBonus">
        '.$b4Reel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="30" min="30">
            <Step>30</Step>
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
    <PickerInfo name="BaseGame.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">1</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>true</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="SpockBonus"/>
        <ExitOutcomeTrigger name="SpockBonus"/>
        <Triggers>
            <Trigger name="KirkBonus" picks="1"/>
            <Trigger name="SpockBonus" picks="1"/>
            <Trigger name="UhuraBonus" picks="1"/>
            <Trigger name="ScottyBonus" picks="1"/>
        </Triggers>
        <Layer index="0" name="level0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
        </Layer>
    </PickerInfo>
    <PickerInfo name="GeneralBonusStart.PickerInfo" verifierStrategy="LayerPicker">
        <MinPicks name="MinPicks">1</MinPicks>
        <MaxPicksPerTurn name="MaxPicksPerTurn">1</MaxPicksPerTurn>
        <MaxTotalPicks name="MaxTotalPicks">1</MaxTotalPicks>
        <UniquePickRequired name="UniquePickRequired">true</UniquePickRequired>
        <MultiplePicksAllowed name="MultiplePicksAllowed">false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="SpockBonus"/>
        <ExitOutcomeTrigger name="SpockBonus"/>
        <Triggers>
            <Trigger name="SpockBonus" picks="1"/>
        </Triggers>
        <Layer index="0" name="level0">
            <Pick cellName="pick0" name="L0C0R0"/>
            <Pick cellName="pick1" name="L0C1R0"/>
            <Pick cellName="pick2" name="L0C2R0"/>
        </Layer>
    </PickerInfo>
    <DenominationList>
        <Denomination softwareId="200-1144-001">1.0</Denomination>
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
        <GameLogicVersion>1.0</GameLogicVersion>
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
            if($_SESSION['fsType'] == 'KIRK') {
                $nextStage = 'KirkBonusStart';
            }
            if($_SESSION['fsType'] == 'SPOCK') {
                $nextStage = 'SpockBonusStart';
            }
            if($_SESSION['fsType'] == 'UHURA') {
                $nextStage = 'UhuraBonusStart';
            }
            if($_SESSION['fsType'] == 'SCOTTY') {
                $nextStage = 'ScottyBonusStart';
            }

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
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>';
        }
        if($_SESSION['state'] == 'FREE') {
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
    <MultiplierOutcome name="">
        <Multiplier name="">3</Multiplier>
    </MultiplierOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>';
            $fs .= $baseGame;

            if($_SESSION['fsType'] == 'KIRK') {
                $state = 'KirkBonus';
                $nextStage = 'KirkBonus';
                $fs .= '<PrizeOutcome multiplier="1" name="KirkBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>';
            }
            if($_SESSION['fsType'] == 'SPOCK') {
                $state = 'SpockBonus';
                $nextStage = 'SpockBonus';
                $fs .= '<PrizeOutcome multiplier="1" name="SpockBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>';
            }
            if($_SESSION['fsType'] == 'UHURA') {
                $state = 'UhuraBonus';
                $nextStage = 'UhuraBonus';
                $fs .= '<PrizeOutcome multiplier="1" name="UhuraBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>';
            }
            if($_SESSION['fsType'] == 'SCOTTY') {
                $state = 'ScottyBonus';
                $nextStage = 'ScottyBonus';
                $fs .= '<PrizeOutcome multiplier="1" name="ScottyBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>';

                $fs .= '<MultiplierOutcome name="">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>';
            }
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043371645</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$fs.'
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="40">
            <Cell name="L0C0R0" stripIndex="40">s01</Cell>
            <Cell name="L0C0R1" stripIndex="41">s08</Cell>
            <Cell name="L0C0R2" stripIndex="42">s03</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="45">
            <Cell name="L0C1R0" stripIndex="45">s02</Cell>
            <Cell name="L0C1R1" stripIndex="46">s02</Cell>
            <Cell name="L0C1R2" stripIndex="47">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="5">
            <Cell name="L0C2R0" stripIndex="5">s01</Cell>
            <Cell name="L0C2R1" stripIndex="6">s07</Cell>
            <Cell name="L0C2R2" stripIndex="7">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="15">
            <Cell name="L0C3R0" stripIndex="15">s07</Cell>
            <Cell name="L0C3R1" stripIndex="16">b03</Cell>
            <Cell name="L0C3R2" stripIndex="17">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="22">
            <Cell name="L0C4R0" stripIndex="22">s07</Cell>
            <Cell name="L0C4R1" stripIndex="23">s04</Cell>
            <Cell name="L0C4R2" stripIndex="24">s09</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="KirkBonus.Reels" stage="KirkBonus">
        <Entry name="Reel0" stripIndex="25">
            <Cell name="L0C0R0" stripIndex="25">s14</Cell>
            <Cell name="L0C0R1" stripIndex="26">s09</Cell>
            <Cell name="L0C0R2" stripIndex="27">s17</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="69">
            <Cell name="L0C1R0" stripIndex="69">w05</Cell>
            <Cell name="L0C1R1" stripIndex="70">w05</Cell>
            <Cell name="L0C1R2" stripIndex="71">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s16</Cell>
            <Cell name="L0C2R1" stripIndex="11">s16</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="4">
            <Cell name="L0C3R0" stripIndex="4">s15</Cell>
            <Cell name="L0C3R1" stripIndex="5">s07</Cell>
            <Cell name="L0C3R2" stripIndex="6">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="51">
            <Cell name="L0C4R0" stripIndex="51">w04</Cell>
            <Cell name="L0C4R1" stripIndex="52">s07</Cell>
            <Cell name="L0C4R2" stripIndex="53">w05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="SpockBonus.Reels" stage="SpockBonus">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s11</Cell>
            <Cell name="L0C0R1" stripIndex="3">s07</Cell>
            <Cell name="L0C0R2" stripIndex="4">s12</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="45">
            <Cell name="L0C1R0" stripIndex="45">w03</Cell>
            <Cell name="L0C1R1" stripIndex="46">w03</Cell>
            <Cell name="L0C1R2" stripIndex="47">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="3">s05</Cell>
            <Cell name="L0C2R1" stripIndex="4">s10</Cell>
            <Cell name="L0C2R2" stripIndex="5">s10</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">w03</Cell>
            <Cell name="L0C3R1" stripIndex="1">s05</Cell>
            <Cell name="L0C3R2" stripIndex="2">s13</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="3">
            <Cell name="L0C4R0" stripIndex="3">w02</Cell>
            <Cell name="L0C4R1" stripIndex="4">s08</Cell>
            <Cell name="L0C4R2" stripIndex="5">s13</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="UhuraBonus.Reels" stage="UhuraBonus">
        <Entry name="Reel0" stripIndex="4">
            <Cell name="L0C0R0" stripIndex="4">s03</Cell>
            <Cell name="L0C0R1" stripIndex="5">s08</Cell>
            <Cell name="L0C0R2" stripIndex="6">s18</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="6">b01</Cell>
            <Cell name="L0C1R1" stripIndex="7">s08</Cell>
            <Cell name="L0C1R2" stripIndex="8">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s09</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="27">
            <Cell name="L0C3R0" stripIndex="27">s02</Cell>
            <Cell name="L0C3R1" stripIndex="28">s07</Cell>
            <Cell name="L0C3R2" stripIndex="29">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="7">
            <Cell name="L0C4R0" stripIndex="7">s01</Cell>
            <Cell name="L0C4R1" stripIndex="8">s07</Cell>
            <Cell name="L0C4R2" stripIndex="9">s18</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="ScottyBonus.Reels" stage="ScottyBonus">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s21</Cell>
            <Cell name="L0C0R1" stripIndex="1">s05</Cell>
            <Cell name="L0C0R2" stripIndex="2">s19</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s19</Cell>
            <Cell name="L0C1R1" stripIndex="1">s08</Cell>
            <Cell name="L0C1R2" stripIndex="2">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s20</Cell>
            <Cell name="L0C2R1" stripIndex="11">s20</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="12">
            <Cell name="L0C3R0" stripIndex="12">s21</Cell>
            <Cell name="L0C3R1" stripIndex="13">s08</Cell>
            <Cell name="L0C3R2" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="49">
            <Cell name="L0C4R0" stripIndex="49">s06</Cell>
            <Cell name="L0C4R1" stripIndex="50">s05</Cell>
            <Cell name="L0C4R2" stripIndex="51">w07</Cell>
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

        $needleReels = $this->gameParams->reels[1];
        switch($_SESSION['fsType']) {
            case 'KIRK':
                $needleReels = $this->gameParams->reels[1];
                break;
            case 'SPOCK':
                $needleReels = $this->gameParams->reels[2];
                break;
            case 'UHURA':
                $needleReels = $this->gameParams->reels[3];
                break;
            case 'SCOTTY':
                $needleReels = $this->gameParams->reels[4];
                break;

        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($needleReels, array(3,3,3,3,3));

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
            switch($_SESSION['fsType']) {
                case 'KIRK':
                    $bonus = array(
                        'type' => 'multiple',
                        'range' => array(3,3),
                    );
                    break;
                case 'SPOCK':
                    $bonus = array(

                    );
                    break;
                case 'UHURA':
                    $bonus = array(

                    );
                    break;
                case 'SCOTTY':
                    $bonus = array(
                        'type' => 'multiple',
                        'range' => array($_SESSION['nextMultiple'], $_SESSION['nextMultiple']),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $s1Report = $this->slot->getSymbolAnyCount('b01');
        $s2Report = $this->slot->getSymbolAnyCount('b02');
        $s3Report = $this->slot->getSymbolAnyCount('b03');
        $s4Report = $this->slot->getSymbolAnyCount('b04');
        $s5Report = $this->slot->getSymbolAnyCount('b05');

        $startFS = false;
        $scattersOffsets = array();

        if($s1Report['count'] == 2 && $s2Report['count'] == 1) {
            $_SESSION['fsType'] = 'KIRK';
            $scattersOffsets = array_merge($s1Report['offsets'], $s2Report['offsets']);
            $startFS = true;
        }
        if($s1Report['count'] == 2 && $s3Report['count'] == 1) {
            $_SESSION['fsType'] = 'SPOCK';
            $scattersOffsets = array_merge($s1Report['offsets'], $s3Report['offsets']);
            $startFS = true;
        }
        if($s1Report['count'] == 2 && $s4Report['count'] == 1) {
            $_SESSION['fsType'] = 'UHURA';
            $scattersOffsets = array_merge($s1Report['offsets'], $s4Report['offsets']);
            $startFS = true;
        }
        if($s1Report['count'] == 2 && $s5Report['count'] == 1) {
            $_SESSION['fsType'] = 'SCOTTY';
            $scattersOffsets = array_merge($s1Report['offsets'], $s5Report['offsets']);
            $startFS = true;
        }



        if($startFS) {
            $report['scattersReport'] = array(
                'offsets' => $scattersOffsets,
                'count' => 3,
                'totalWin' => $report['bet'] * 3,
            );

            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];

            $report['type'] = 'FREE';
            $_SESSION['state'] = 'FREE';
        }
        else {
            $report['scattersReport'] = $this->slot->getScattersCount();
            if($report['scattersReport']['count'] > 2) {
                $report['scattersReport']['totalWin'] = $report['bet'] * 3;
                if($_SESSION['state'] == 'FREE') {
                    if($_SESSION['fsType'] == 'KIRK') {
                        $report['scattersReport']['totalWin'] *= 3;
                    }
                    if($_SESSION['fsType'] == 'SCOTTY') {
                        $report['scattersReport']['totalWin'] *= $_SESSION['nextMultiple'];
                    }
                }
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $report['spinWin'] += $report['scattersReport']['totalWin'];
            }
            else {
                $report['scattersReport']['totalWin'] = 0;
            }
        }

        if($_SESSION['state'] == 'FREE') {
            if($_SESSION['fsType'] == 'UHURA') {
                $sR = $this->slot->getSymbolAnyCount('s03');
                $wR = $this->slot->getSymbolAnyCount('w06');
                $tC = $sR['count'] + $wR['count'];
                $oR = array_merge($sR['offsets'], $wR['offsets']);
                $multiple = 0;
                if($tC > 2) {
                    $multiple = 2;
                    if($tC == 4) $multiple = 10;
                    if($tC == 5) $multiple = 20;
                    if($tC == 6) $multiple = 40;
                    if($tC == 7) $multiple = 100;
                    if($tC == 8) $multiple = 250;

                    $report['totalWin'] += $report['bet'] * $multiple;
                    $report['spinWin'] += $report['bet'] * $multiple;
                }
                $report['uhuraMultiple'] = $multiple;
                $report['uhuraPay'] = $report['bet'] * $multiple;
                $report['uhuraOffsets'] = $oR;
                $report['uhuraCount'] = $tC;
            }
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

    protected function showStartFreeSpinReport($report, $totalWin) {
        switch($_SESSION['fsType']) {
            case 'KIRK':
                $this->showStartKirk($report, $totalWin);
                break;
            case 'SPOCK':
                $this->showStartSpock($report, $totalWin);
                break;
            case 'UHURA':
                $this->showStartUhura($report, $totalWin);
                break;
            case 'SCOTTY':
                $this->showStartScotty($report, $totalWin);
                break;
        }
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        switch($_SESSION['fsType']) {
            case 'KIRK':
                $this->showKirkPlayFreeSpinReport($report, $totalWin);
                break;
            case 'SPOCK':
                $this->showSpockPlayFreeSpinReport($report, $totalWin);
                break;
            case 'UHURA':
                $this->showUhuraPlayFreeSpinReport($report, $totalWin);
                break;
            case 'SCOTTY':
                $this->showScottyPlayFreeSpinReport($report, $totalWin);
                break;
        }
    }

    protected function startPick($request) {
        $pick = (array) $request['PickerInput']->Pick->attributes()->name;
        $pick = $pick[0];
        switch($_SESSION['fsType']) {
            case 'KIRK':
                $this->startPickKirk($pick);
                break;
            case 'SPOCK':
                $this->startPickSpock($pick);
                break;
            case 'UHURA':
                $this->startPickUhura($pick);
                break;
            case 'SCOTTY':
                $this->startPickScotty($pick);
                break;
        }
    }

    protected function showStartKirk($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $_SESSION['totalWin'] = $totalWin;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$scattersPay.$highlight.$winLines, 9));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353233017658</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>KirkBonusStart</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>30</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="SpockBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="FreeSpin" stage="" />
    <TriggerOutcome component="" name="AwardCap" stage="" />
    <TriggerOutcome component="" name="" stage="">
        <Trigger name="KirkBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$scattersHighlight.'
    <HighlightOutcome name="BaseGame.Lines" type="" />
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017590</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $_SESSION['state'] = 'PICK';

        $_SESSION['pickerCount'] = 1;

        $this->outXML($xml);
    }

    protected function startPickKirk($pick) {

        $betPerPattern = $_SESSION['lastBet'] / $_SESSION['lastPick'];

        $awardArray = array();
        while(count($awardArray) < 3) {
            $rnd = rnd(3,6);
            if(!in_array($rnd, $awardArray)) {
                $awardArray[] = $rnd;
            }
        }
        $awarded = $awardArray[0];

        $_SESSION['initAwarded'] = $awarded;
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['state'] = 'FREE';

        if($pick == 'L0C2R0') {
            $lastPicks = array('L0C1R0', 'L0C0R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C2R0', 'L0C0R0');
        }

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353270871003</TransactionId>
        <Stage>KirkBonusStart</Stage>
        <NextStage>KirkBonus</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$_SESSION['lastBet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseGame.'
    <TriggerOutcome component="" name="" stage="" />
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
        <Layer index="0" name="level0">
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
    <MultiplierOutcome name="">
        <Multiplier name="">3</Multiplier>
    </MultiplierOutcome>
    <PopulationOutcome name="KirkBonusStart.Picker" stage="KirkBonusStart">
        <Entry name="Pick1" stripIndex="0">
            <Cell name="'.$pick.'" stripIndex="0">spins,'.$awardArray[0].'</Cell>
        </Entry>
        <Entry name="Unpick1" stripIndex="0">
            <Cell name="'.$lastPicks[0].'" stripIndex="0">spins,'.$awardArray[1].'</Cell>
        </Entry>
        <Entry name="Unpick2" stripIndex="0">
            <Cell name="'.$lastPicks[1].'" stripIndex="0">spins,'.$awardArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="KirkBonus.Reels" stage="KirkBonus">
        <Entry name="Reel0" stripIndex="25">
            <Cell name="L0C0R0" stripIndex="25">s14</Cell>
            <Cell name="L0C0R1" stripIndex="26">s09</Cell>
            <Cell name="L0C0R2" stripIndex="27">s17</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="69">
            <Cell name="L0C1R0" stripIndex="69">w05</Cell>
            <Cell name="L0C1R1" stripIndex="70">w05</Cell>
            <Cell name="L0C1R2" stripIndex="71">s08</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s16</Cell>
            <Cell name="L0C2R1" stripIndex="11">s16</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="4">
            <Cell name="L0C3R0" stripIndex="4">s15</Cell>
            <Cell name="L0C3R1" stripIndex="5">s07</Cell>
            <Cell name="L0C3R2" stripIndex="6">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="51">
            <Cell name="L0C4R0" stripIndex="51">w04</Cell>
            <Cell name="L0C4R1" stripIndex="52">s07</Cell>
            <Cell name="L0C4R2" stripIndex="53">w05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="KirkBonusStartCombined.Picker" stage="KirkBonusStartCombined">
        <Entry name="Pick" stripIndex="21">
            <Cell name="L0C0R0" stripIndex="21">spins,'.$awardArray[2].',spins,'.$awardArray[1].',spins,'.$awardArray[0].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017658</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerPattern.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['pickerCount']--;
    }

    protected function showKirkPlayFreeSpinReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];

        $display = $this->getDisplay($report, false, 'KirkBonus');
        $winLines = $this->getWinLines($report, 'KirkBonus');
        $highlight = $this->getHighlight($report['winLines'], 'KirkBonus.Lines');
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'KirkBonus.Scatter');
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'KirkBonus.Scatter');

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $awarded = 0;
        if($report['scattersReport']['count'] == 3) {
            $_SESSION['totalAwarded'] += $_SESSION['initAwarded'];
            $_SESSION['fsLeft'] += $_SESSION['initAwarded'];
            $awarded = $_SESSION['initAwarded'];
        }

        $_SESSION['fsPlayed']++;
        if($totalWin > 0) {
            $_SESSION['fsLeft']--;
        }

        $_SESSION['fsTotalWin'] += $totalWin;


        $nextStage = 'KirkBonus';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $balance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0340-14353232964653</TransactionId>
        <Stage>KirkBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseGame.$scattersHighlight.$highlight.'
    <MultiplierOutcome name="">
        <Multiplier name="">3</Multiplier>
    </MultiplierOutcome>
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
    '.$display.'
    <PrizeOutcome multiplier="1" name="KirkBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <TransactionId>R0140-14353270871003</TransactionId>
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

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['totalWin']);
            unset($_SESSION['baseWinLinesWin']);

        }
    }

    protected function showStartSpock($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $_SESSION['totalWin'] = $totalWin;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$scattersPay.$highlight.$winLines, 9));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353233017658</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>SpockBonusStart</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>30</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="SpockBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="FreeSpin" stage="" />
    <TriggerOutcome component="" name="AwardCap" stage="" />
    <TriggerOutcome component="" name="" stage="">
        <Trigger name="SpockBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$scattersHighlight.'
    <HighlightOutcome name="BaseGame.Lines" type="" />
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017590</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $_SESSION['state'] = 'PICK';

        $_SESSION['pickerCount'] = 1;

        $this->outXML($xml);
    }

    protected function startPickSpock($pick) {

        $betPerPattern = $_SESSION['lastBet'] / $_SESSION['lastPick'];

        $awardArray = array();
        while(count($awardArray) < 3) {
            $rnd = rnd(10,15);
            if(!in_array($rnd, $awardArray)) {
                $awardArray[] = $rnd;
            }
        }
        $awarded = $awardArray[0];

        $_SESSION['initAwarded'] = $awarded;
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['state'] = 'FREE';

        if($pick == 'L0C2R0') {
            $lastPicks = array('L0C1R0', 'L0C0R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C2R0', 'L0C0R0');
        }

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353270871003</TransactionId>
        <Stage>SpockBonusStart</Stage>
        <NextStage>SpockBonus</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$_SESSION['lastBet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseGame.'
    <TriggerOutcome component="" name="" stage="" />
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
        <Layer index="0" name="level0">
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
    <PopulationOutcome name="SpockBonusStart.Picker" stage="SpockBonusStart">
        <Entry name="Pick1" stripIndex="0">
            <Cell name="'.$pick.'" stripIndex="0">spins,'.$awardArray[0].'</Cell>
        </Entry>
        <Entry name="Unpick1" stripIndex="0">
            <Cell name="'.$lastPicks[0].'" stripIndex="0">spins,'.$awardArray[1].'</Cell>
        </Entry>
        <Entry name="Unpick2" stripIndex="0">
            <Cell name="'.$lastPicks[1].'" stripIndex="0">spins,'.$awardArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="SpockBonus.Reels" stage="SpockBonus">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="2">s11</Cell>
            <Cell name="L0C0R1" stripIndex="3">s07</Cell>
            <Cell name="L0C0R2" stripIndex="4">s12</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="45">
            <Cell name="L0C1R0" stripIndex="45">w03</Cell>
            <Cell name="L0C1R1" stripIndex="46">w03</Cell>
            <Cell name="L0C1R2" stripIndex="47">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="3">s05</Cell>
            <Cell name="L0C2R1" stripIndex="4">s10</Cell>
            <Cell name="L0C2R2" stripIndex="5">s10</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">w03</Cell>
            <Cell name="L0C3R1" stripIndex="1">s05</Cell>
            <Cell name="L0C3R2" stripIndex="2">s13</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="3">
            <Cell name="L0C4R0" stripIndex="3">w02</Cell>
            <Cell name="L0C4R1" stripIndex="4">s08</Cell>
            <Cell name="L0C4R2" stripIndex="5">s13</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="SpockBonusStartCombined.Picker" stage="SpockBonusStartCombined">
        <Entry name="Pick" stripIndex="21">
            <Cell name="L0C0R0" stripIndex="21">spins,'.$awardArray[2].',spins,'.$awardArray[1].',spins,'.$awardArray[0].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017658</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerPattern.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['pickerCount']--;
    }

    protected function showSpockPlayFreeSpinReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];

        $display = $this->getDisplay($report, false, 'SpockBonus');
        $winLines = $this->getWinLines($report, 'SpockBonus');
        $highlight = $this->getHighlight($report['winLines'], 'SpockBonus.Lines');
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'SpockBonus.Scatter');
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'SpockBonus.Scatter');

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $awarded = 0;
        if($report['scattersReport']['count'] == 3) {
            $_SESSION['totalAwarded'] += $_SESSION['initAwarded'];
            $_SESSION['fsLeft'] += $_SESSION['initAwarded'];
            $awarded = $_SESSION['initAwarded'];
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $_SESSION['fsTotalWin'] += $totalWin;


        $nextStage = 'SpockBonus';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $balance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0340-14353232964653</TransactionId>
        <Stage>SpockBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseGame.$scattersHighlight.$highlight.'
    <MultiplierOutcome name="">
        <Multiplier name="">3</Multiplier>
    </MultiplierOutcome>
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
    '.$display.'
    <PrizeOutcome multiplier="1" name="SpockBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <TransactionId>R0140-14353270871003</TransactionId>
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

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['totalWin']);
            unset($_SESSION['baseWinLinesWin']);

        }
    }


    protected function showStartUhura($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $_SESSION['totalWin'] = $totalWin;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$scattersPay.$highlight.$winLines, 9));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353233017658</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>UhuraBonusStart</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>30</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="UhuraBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="FreeSpin" stage="" />
    <TriggerOutcome component="" name="AwardCap" stage="" />
    <TriggerOutcome component="" name="" stage="">
        <Trigger name="UhuraBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$scattersHighlight.'
    <HighlightOutcome name="BaseGame.Lines" type="" />
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
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017590</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $_SESSION['state'] = 'PICK';

        $_SESSION['pickerCount'] = 1;

        $this->outXML($xml);
    }

    protected function startPickUhura($pick) {

        $betPerPattern = $_SESSION['lastBet'] / $_SESSION['lastPick'];

        $awardArray = array();
        while(count($awardArray) < 3) {
            $rnd = rnd(6,12);
            if(!in_array($rnd, $awardArray)) {
                $awardArray[] = $rnd;
            }
        }
        $awarded = $awardArray[0];

        $_SESSION['initAwarded'] = $awarded;
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['state'] = 'FREE';

        if($pick == 'L0C2R0') {
            $lastPicks = array('L0C1R0', 'L0C0R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C2R0', 'L0C0R0');
        }

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353270871003</TransactionId>
        <Stage>UhuraBonusStart</Stage>
        <NextStage>UhuraBonus</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$_SESSION['lastBet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseGame.'
    <TriggerOutcome component="" name="" stage="" />
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
        <Layer index="0" name="level0">
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
    <PopulationOutcome name="UhuraBonusStart.Picker" stage="UhuraBonusStart">
        <Entry name="Pick1" stripIndex="0">
            <Cell name="'.$pick.'" stripIndex="0">spins,'.$awardArray[0].'</Cell>
        </Entry>
        <Entry name="Unpick1" stripIndex="0">
            <Cell name="'.$lastPicks[0].'" stripIndex="0">spins,'.$awardArray[1].'</Cell>
        </Entry>
        <Entry name="Unpick2" stripIndex="0">
            <Cell name="'.$lastPicks[1].'" stripIndex="0">spins,'.$awardArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="UhuraBonus.Reels" stage="UhuraBonus">
        <Entry name="Reel0" stripIndex="4">
            <Cell name="L0C0R0" stripIndex="4">s03</Cell>
            <Cell name="L0C0R1" stripIndex="5">s08</Cell>
            <Cell name="L0C0R2" stripIndex="6">s18</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="6">b01</Cell>
            <Cell name="L0C1R1" stripIndex="7">s08</Cell>
            <Cell name="L0C1R2" stripIndex="8">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s09</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="27">
            <Cell name="L0C3R0" stripIndex="27">s02</Cell>
            <Cell name="L0C3R1" stripIndex="28">s07</Cell>
            <Cell name="L0C3R2" stripIndex="29">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="7">
            <Cell name="L0C4R0" stripIndex="7">s01</Cell>
            <Cell name="L0C4R1" stripIndex="8">s07</Cell>
            <Cell name="L0C4R2" stripIndex="9">s18</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="UhuraBonusStartCombined.Picker" stage="UhuraBonusStartCombined">
        <Entry name="Pick" stripIndex="21">
            <Cell name="L0C0R0" stripIndex="21">spins,'.$awardArray[2].',spins,'.$awardArray[1].',spins,'.$awardArray[0].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017658</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerPattern.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['pickerCount']--;
    }


    protected function showUhuraPlayFreeSpinReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];

        $display = $this->getDisplay($report, false, 'UhuraBonus');
        $winLines = $this->getWinLines($report, 'UhuraBonus');
        $highlight = $this->getHighlight($report['winLines'], 'UhuraBonus.Lines');
        $scattersXml = $this->getUhuraScatterXml($report);

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $awarded = 0;
        if($report['scattersReport']['count'] == 3) {
            $_SESSION['totalAwarded'] += $_SESSION['initAwarded'];
            $_SESSION['fsLeft'] += $_SESSION['initAwarded'];
            $awarded = $_SESSION['initAwarded'];
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $_SESSION['fsTotalWin'] += $totalWin;


        $nextStage = 'UhuraBonus';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $balance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0340-14353232964653</TransactionId>
        <Stage>UhuraBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseGame.$highlight.'
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
    '.$display.'
    <PrizeOutcome multiplier="1" name="UhuraBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>
    '.$scattersXml.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <TransactionId>R0140-14353270871003</TransactionId>
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

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['totalWin']);
            unset($_SESSION['baseWinLinesWin']);

        }
    }

    protected function getUhuraScatterXml($report) {

        $xml = '<HighlightOutcome name="UhuraBonus.Scatter" type="">
        <Highlight name="Scatter" type="">';
        foreach($report['scattersReport']['offsets'] as $o) {
            $c = ($o % 5);
            $r = floor($o / 5);
            $xml .= '<Cell name="L0C'.$c.'R'.$r.'" type="" />';
        }
        $xml .= '</Highlight>';

        $xml .= '<Highlight name="s03" type="">';
        foreach($report['uhuraOffsets'] as $o) {
            $c = ($o % 5);
            $r = floor($o / 5);
            $xml .= '<Cell name="L0C'.$c.'R'.$r.'" type="" />';
        }
        $xml .= '</Highlight>';
        $xml .= '</HighlightOutcome>';


        $totalPay = $report['uhuraPay'] + $report['scattersReport']['totalWin'];
        $xml .= '<PrizeOutcome multiplier="1" name="UhuraBonus.Scatter" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';
        if($report['uhuraPay'] > 0) {
            $xml .= '<Prize betMultiplier="30" multiplier="1" name="s03" pay="'.$report['uhuraMultiple'].'" payName="'.$report['uhuraCount'].' s03" symbolCount="'.$report['uhuraCount'].'" totalPay="'.$report['uhuraPay'].'" ways="0" />';
        }
        if($report['scattersReport']['totalWin'] > 0) {
            $xml .= '<Prize betMultiplier="30" multiplier="1" name="Scatter" pay="3" payName="3 b04" symbolCount="3" totalPay="'.$report['scattersReport']['totalWin'].'" ways="0" />';
        }

        $xml .= '</PrizeOutcome>';

        return $xml;
    }

    protected function showStartScotty($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $_SESSION['totalWin'] = $totalWin;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$scattersPay.$highlight.$winLines, 9));

        $_SESSION['initAwarded'] = 10;
        $_SESSION['totalAwarded'] = 10;
        $_SESSION['fsLeft'] = 10;
        $_SESSION['fsPlayed'] = 0;

        $_SESSION['nextMultiple'] = rnd(2,5);

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14353233017658</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>ScottyBonusStart</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>30</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="FreeSpin" stage="" />
    <TriggerOutcome component="" name="AwardCap" stage="" />
    '.$scattersHighlight.'
    <HighlightOutcome name="BaseGame.Lines" type="" />
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>10</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <MultiplierOutcome name="">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>
    <TriggerOutcome component="" name="" stage="">
        <Trigger name="ScottyBonus" priority="0" stageConnector="" />
    </TriggerOutcome>
    <PopulationOutcome name="ScottyBonus.Reels" stage="ScottyBonus">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s21</Cell>
            <Cell name="L0C0R1" stripIndex="1">s05</Cell>
            <Cell name="L0C0R2" stripIndex="2">s19</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s19</Cell>
            <Cell name="L0C1R1" stripIndex="1">s08</Cell>
            <Cell name="L0C1R2" stripIndex="2">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s20</Cell>
            <Cell name="L0C2R1" stripIndex="11">s20</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="12">
            <Cell name="L0C3R0" stripIndex="12">s21</Cell>
            <Cell name="L0C3R1" stripIndex="13">s08</Cell>
            <Cell name="L0C3R2" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="49">
            <Cell name="L0C4R0" stripIndex="49">s06</Cell>
            <Cell name="L0C4R1" stripIndex="50">s05</Cell>
            <Cell name="L0C4R2" stripIndex="51">w07</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display.'
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017590</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $_SESSION['state'] = 'PICK';

        $_SESSION['pickerCount'] = 1;



        $this->outXML($xml);
    }

    protected function startPickScotty($pick) {

        $betPerPattern = $_SESSION['lastBet'] / $_SESSION['lastPick'];

        $awardArray = array();
        while(count($awardArray) < 3) {
            $rnd = rnd(2,5);
            if(!in_array($rnd, $awardArray)) {
                $awardArray[] = $rnd;
            }
        }
        $awarded = $awardArray[0];

        $_SESSION['nextMultiple'] = $awarded;

        $_SESSION['state'] = 'FREE';

        if($pick == 'L0C2R0') {
            $lastPicks = array('L0C1R0', 'L0C0R0');
        }
        if($pick == 'L0C0R0') {
            $lastPicks = array('L0C1R0', 'L0C2R0');
        }
        if($pick == 'L0C1R0') {
            $lastPicks = array('L0C2R0', 'L0C0R0');
        }

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0140-14353270871003</TransactionId>
        <Stage>ScottyBonusStart</Stage>
        <NextStage>ScottyBonus</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$_SESSION['lastBet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseGame.'
    <TriggerOutcome component="" name="" stage="" />
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>10</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <MultiplierOutcome name="">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>
    <PickerOutcome name="">
        <Layer index="0" name="level0">
            <Pick name="'.$pick.'" picked="true">
                <Feature type="spins" value="10" />
                <Feature type="multiplier" value="'.$awardArray[0].'" />
            </Pick>
            <Pick name="'.$lastPicks[0].'" picked="false">
                <Feature type="spins" value="10" />
                <Feature type="multiplier" value="'.$awardArray[1].'" />
            </Pick>
            <Pick name="'.$lastPicks[1].'" picked="false">
                <Feature type="spins" value="10" />
                <Feature type="multiplier" value="'.$awardArray[2].'" />
            </Pick>
        </Layer>
    </PickerOutcome>
    <PopulationOutcome name="ScottyBonusStart.Picker" stage="ScottyBonusStart">
        <Entry name="Pick1" stripIndex="0">
            <Cell name="'.$pick.'" stripIndex="0">spins,10,multiplier,'.$awardArray[0].'</Cell>
        </Entry>
        <Entry name="Unpick1" stripIndex="0">
            <Cell name="'.$lastPicks[0].'" stripIndex="0">spins,10,multiplier,'.$awardArray[1].'</Cell>
        </Entry>
        <Entry name="Unpick2" stripIndex="0">
            <Cell name="'.$lastPicks[1].'" stripIndex="0">spins,10,multiplier,'.$awardArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="ScottyBonus.Reels" stage="ScottyBonus">
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s21</Cell>
            <Cell name="L0C0R1" stripIndex="1">s05</Cell>
            <Cell name="L0C0R2" stripIndex="2">s19</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s19</Cell>
            <Cell name="L0C1R1" stripIndex="1">s08</Cell>
            <Cell name="L0C1R2" stripIndex="2">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">s20</Cell>
            <Cell name="L0C2R1" stripIndex="11">s20</Cell>
            <Cell name="L0C2R2" stripIndex="12">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="12">
            <Cell name="L0C3R0" stripIndex="12">s21</Cell>
            <Cell name="L0C3R1" stripIndex="13">s08</Cell>
            <Cell name="L0C3R2" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="49">
            <Cell name="L0C4R0" stripIndex="49">s06</Cell>
            <Cell name="L0C4R1" stripIndex="50">s05</Cell>
            <Cell name="L0C4R2" stripIndex="51">w07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="ScottyBonusStartCombined.Picker" stage="ScottyBonusStartCombined">
        <Entry name="Pick" stripIndex="21">
            <Cell name="L0C0R0" stripIndex="21">spins,10,multiplier,'.$awardArray[2].',spins,10,multiplier,'.$awardArray[1].',spins,10,multiplier,'.$awardArray[0].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="level0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1540-14353233017658</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$betPerPattern.'</BetPerPattern>
        <PatternsBet>30</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick.'" />
    </PickerInput>
    <Balances totalBalance="'.$_SESSION['startBalance'].'">
        <Balance name="FREE">'.$_SESSION['startBalance'].'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['pickerCount']--;
    }

    protected function showScottyPlayFreeSpinReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];

        $display = $this->getDisplay($report, false, 'ScottyBonus');
        $winLines = $this->getWinLines($report, 'ScottyBonus');
        $highlight = $this->getHighlight($report['winLines'], 'ScottyBonus.Lines');
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'ScottyBonus.Scatter');
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'ScottyBonus.Scatter');

        $baseGame = gzuncompress(base64_decode($_SESSION['baseScatter'])) . gzuncompress(base64_decode($_SESSION['baseDisplay']));

        $awarded = 0;
        if($report['scattersReport']['count'] == 3) {
            $_SESSION['totalAwarded'] += $_SESSION['initAwarded'];
            $_SESSION['fsLeft'] += $_SESSION['initAwarded'];
            $awarded = $_SESSION['initAwarded'];
        }

        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;

        $_SESSION['fsTotalWin'] += $totalWin;


        $nextStage = 'ScottyBonus';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $balance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
        }

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'] + $_SESSION['scatterWin'];

        if($_SESSION['fsPlayed'] == 5) {
            $_SESSION['nextMultiple'] *= 2;
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0340-14353232964653</TransactionId>
        <Stage>ScottyBonus</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$gameStatus.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>'.$payout.'</Payout>
    </OutcomeDetail>
    '.$baseGame.$scattersHighlight.$highlight.'
    <MultiplierOutcome name="">
        <Multiplier name="">'.$_SESSION['nextMultiple'].'</Multiplier>
    </MultiplierOutcome>
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
    '.$display.'
    <PrizeOutcome multiplier="1" name="ScottyBonus.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <TransactionId>R0140-14353270871003</TransactionId>
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

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['totalWin']);
            unset($_SESSION['baseWinLinesWin']);
            unset($_SESSION['nextMultiple']);

        }
    }

}
