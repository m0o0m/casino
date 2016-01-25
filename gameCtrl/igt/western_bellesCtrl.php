<?
require_once('IGTCtrl.php');

class western_bellesCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1162-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Western Belles"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="WesternBelles"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="Western Belles 40L 4x4x4x4x4" maxRTP="96.33" minRTP="92.85" name="Western Belles" type="Slot"/>
    <MaxFreeSpins> 255 </MaxFreeSpins>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="3" value="2"/>
            <Symbol id="b01" required="false"/>
            <Symbol id="b02" required="false"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo name="PatternSliderInfo">
        <PatternInfo max="800" min="1">
            <Step>1</Step>
            <Step>10</Step>
            <Step>20</Step>
            <Step>40</Step>
            <Step trigger="WildReel">200</Step>
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
        <Denomination softwareId="200-1162-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>200.0</MaxBet>
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
            $state = 'FreeSpin';
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>5</InitAwarded>
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

        $patternsBet = 200;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043400857</TransactionId>
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
        <Entry name="Reel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s01</Cell>
            <Cell name="L0C0R1" stripIndex="1">s01</Cell>
            <Cell name="L0C0R2" stripIndex="2">s09</Cell>
            <Cell name="L0C0R3" stripIndex="3">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="60">
            <Cell name="L0C1R0" stripIndex="60">s10</Cell>
            <Cell name="L0C1R1" stripIndex="61">b01</Cell>
            <Cell name="L0C1R2" stripIndex="62">s07</Cell>
            <Cell name="L0C1R3" stripIndex="63">s10</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="56">
            <Cell name="L0C2R0" stripIndex="56">s03</Cell>
            <Cell name="L0C2R1" stripIndex="57">s08</Cell>
            <Cell name="L0C2R2" stripIndex="58">s05</Cell>
            <Cell name="L0C2R3" stripIndex="59">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="47">
            <Cell name="L0C3R0" stripIndex="47">s08</Cell>
            <Cell name="L0C3R1" stripIndex="48">w01</Cell>
            <Cell name="L0C3R2" stripIndex="49">w01</Cell>
            <Cell name="L0C3R3" stripIndex="50">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="12">
            <Cell name="L0C4R0" stripIndex="12">s10</Cell>
            <Cell name="L0C4R1" stripIndex="13">s01</Cell>
            <Cell name="L0C4R2" stripIndex="14">s01</Cell>
            <Cell name="L0C4R3" stripIndex="15">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="93">
            <Cell name="L0C0R0" stripIndex="93">s01</Cell>
            <Cell name="L0C0R1" stripIndex="94">s01</Cell>
            <Cell name="L0C0R2" stripIndex="95">s05</Cell>
            <Cell name="L0C0R3" stripIndex="96">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="10">
            <Cell name="L0C1R0" stripIndex="10">b01</Cell>
            <Cell name="L0C1R1" stripIndex="11">s06</Cell>
            <Cell name="L0C1R2" stripIndex="12">s07</Cell>
            <Cell name="L0C1R3" stripIndex="13">s05</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="6">
            <Cell name="L0C2R0" stripIndex="6">s09</Cell>
            <Cell name="L0C2R1" stripIndex="7">s02</Cell>
            <Cell name="L0C2R2" stripIndex="8">s02</Cell>
            <Cell name="L0C2R3" stripIndex="9">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="53">
            <Cell name="L0C3R0" stripIndex="53">s06</Cell>
            <Cell name="L0C3R1" stripIndex="54">s02</Cell>
            <Cell name="L0C3R2" stripIndex="55">s02</Cell>
            <Cell name="L0C3R3" stripIndex="56">s09</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="38">
            <Cell name="L0C4R0" stripIndex="38">w01</Cell>
            <Cell name="L0C4R1" stripIndex="39">w01</Cell>
            <Cell name="L0C4R2" stripIndex="40">w01</Cell>
            <Cell name="L0C4R3" stripIndex="41">s05</Cell>
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

        $_SESSION['betPerLine'] = $stake / $totalBet;
        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;

        $slotPick = $pick;

        if($pick == 200) {
            $i = 1/5;
            $this->wildReel = true;
            $slotPick = 40;
        }
        else {
            $i = 1;
            $this->wildReel = false;
        }
        $_SESSION['wildReel'] = $this->wildReel;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $slotPick, $stake, $i);
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

        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $slotPick = $pick;

        $i = 1;
        if($_SESSION['wildReel']) {
            $i = 1/5;
            $this->wildReel = true;
            $slotPick = 40;
        }
        else {
            $this->wildReel = false;
        }

        $this->slot = new Slot($this->gameParams, $slotPick, $stake, $i);
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
        if($this->wildReel) {
            $r = rnd(0,4);
            $this->wildReel = $r;
            $bonus = array(
                'type' => 'wildReel',
                'number' => $r,
            );

            if($_SESSION['state'] == 'FREE') {
                $r1 = rnd(0,4);
                while($r1 == $r) {
                    $r1 = rnd(0,4);
                }
                $this->wildReel = array($r, $r1);
                $bonus = array(
                    'type' => 'wildReels',
                    'reels' => $this->wildReel,
                );
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        $sCount = 0;
        foreach($report['startRows'] as $r) {
            foreach($r as $rr) {
                if($rr == 51 || $rr == 52) {
                    $sCount++;
                }
            }
        }

        if($sCount > 2) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['bet'] * 2;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
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
        $patternsBet = $report['linesCount'];
        if($this->wildReel) {
            $betPerLine = $betPerLine / 5;
            $patternsBet *= 5;
        }

        if($this->wildReel) {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage="">
        <Trigger name="WildReel" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <TriggerOutcome component="" name="WildReels" stage="">
        <Trigger name="Reel'.$this->wildReel.'Wild" priority="0" stageConnector=""/>
    </TriggerOutcome>
        <TriggerOutcome component="" name="BaseGame.SimpleWildReels" stage="">
        <Trigger name="'.$this->wildReel.'" priority="0" stageConnector=""/>
    </TriggerOutcome>';
            $popularity = '<PopulationOutcome name="BaseGame.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="'.$this->wildReel.'">
            <Cell name="WildReel" stripIndex="'.$this->wildReel.'">Reel2Wild</Cell>
        </Entry>
    </PopulationOutcome>';
        }
        else {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage=""/>
    <TriggerOutcome component="" name="WildReels" stage=""/>';

            $popularity = '<PopulationOutcome name="BaseGame.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="1">
            <Cell name="WildReel" stripIndex="1">Reel'.$this->wildReel.'Wild</Cell>
        </Entry>
    </PopulationOutcome>';
        }

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
    '.$wx.'
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
    '.$popularity.'
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'. $_SESSION['betPerLine'].'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);
    }

    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $display2 = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];
        $patternsBet = $report['linesCount'];
        if($this->wildReel) {
            $betPerLine = $betPerLine / 5;
            $patternsBet *= 5;
        }

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        if($this->wildReel) {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage="">
        <Trigger name="WildReel" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <TriggerOutcome component="" name="WildReels" stage="">
        <Trigger name="Reel'.$this->wildReel.'Wild" priority="0" stageConnector=""/>
    </TriggerOutcome>
        <TriggerOutcome component="" name="BaseGame.SimpleWildReels" stage="">
        <Trigger name="'.$this->wildReel.'" priority="0" stageConnector=""/>
    </TriggerOutcome>';
            $popularity = '<PopulationOutcome name="BaseGame.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="'.$this->wildReel.'">
            <Cell name="WildReel" stripIndex="'.$this->wildReel.'">Reel2Wild</Cell>
        </Entry>
    </PopulationOutcome>';
        }
        else {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage=""/>
    <TriggerOutcome component="" name="WildReels" stage=""/>';

            $popularity = '<PopulationOutcome name="BaseGame.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="1">
            <Cell name="WildReel" stripIndex="1">Reel2Wild</Cell>
        </Entry>
    </PopulationOutcome>';
        }

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
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
    '.$highlight.$wx.$popularity.'

    '.$display.$display2.'
    <FreeSpinOutcome name="">
        <InitAwarded>5</InitAwarded>
        <Awarded>5</Awarded>
        <TotalAwarded>5</TotalAwarded>
        <Count>0</Count>
        <Countdown>5</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'. $_SESSION['betPerLine'].'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 5;
        $_SESSION['fsLeft'] = 5;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlight.$winLines, 9));
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];
        $patternsBet = $report['linesCount'];
        if($this->wildReel) {
            $betPerLine = $betPerLine / 5;
            $patternsBet *= 5;
        }
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');

        $awarded = 0;
        $scattersHighlight = '';
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['totalAwarded'] += 5;
            $_SESSION['fsLeft'] += 5;
            $awarded = 5;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
        }


        if($this->wildReel) {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage="">
        <Trigger name="WildReel" priority="0" stageConnector=""/>
    </TriggerOutcome>
    <TriggerOutcome component="" name="WildReels" stage="">
        <Trigger name="Reel'.$this->wildReel[0].'Wild" priority="0" stageConnector=""/>
        <Trigger name="Reel'.$this->wildReel[1].'Wild" priority="0" stageConnector=""/>
    </TriggerOutcome>
        <TriggerOutcome component="" name="FreeSpin.SimpleWildReels" stage="">
        <Trigger name="'.$this->wildReel[0].'" priority="0" stageConnector=""/>
        <Trigger name="'.$this->wildReel[1].'" priority="0" stageConnector=""/>
    </TriggerOutcome>';
            $popularity = '<PopulationOutcome name="FreeSpin.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="'.$this->wildReel[0].'">
            <Cell name="WildReel" stripIndex="'.$this->wildReel[0].'">Reel2Wild</Cell>
        </Entry>
        <Entry name="WildReel" stripIndex="'.$this->wildReel[1].'">
            <Cell name="WildReel" stripIndex="'.$this->wildReel[1].'">Reel2Wild</Cell>
        </Entry>
    </PopulationOutcome>';
        }
        else {
            $wx = '<TriggerOutcome component="" name="WildReelsMapping" stage=""/>
    <TriggerOutcome component="" name="WildReels" stage=""/>';

            $popularity = '<PopulationOutcome name="FreeSpin.WildReels" stage="BaseGame">
        <Entry name="WildReel" stripIndex="1">
            <Cell name="WildReel" stripIndex="1">Reel2Wild</Cell>
        </Entry>
    </PopulationOutcome>';
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
        }

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

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
    '.$baseScatter.'
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlight.$scattersHighlight.$scattersPay.$display.$baseReels.$wx.$popularity.'
    <FreeSpinOutcome name="">
        <InitAwarded>5</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>
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
        <BetPerPattern>'.$_SESSION['betPerLine'].'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
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