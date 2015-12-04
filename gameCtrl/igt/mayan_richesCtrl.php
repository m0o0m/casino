<?
require_once('IGTCtrl.php');

class mayan_richesCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1223-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Mayan Riches"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="MayanRiches"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Mayan Riches 40L 4x4x4x4x4" maxRTP="94.98" minRTP="92.50" name="Mayan Riches" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
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
        <PatternInfo max="40" min="1">
            <Step>1</Step>
            <Step>5</Step>
            <Step>10</Step>
            <Step>20</Step>
            <Step>30</Step>
            <Step>40</Step>
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
        <Denomination softwareId="200-1223-001">1.0</Denomination>
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
        <GameLogicVersion>1.0</GameLogicVersion>
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

        $patternsBet = 40;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2010-14264054809653</TransactionId>
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
        <Entry name="Reel0" stripIndex="9">
            <Cell name="L0C0R0" stripIndex="8">s02</Cell>
            <Cell name="L0C0R1" stripIndex="9">s06</Cell>
            <Cell name="L0C0R2" stripIndex="10">s09</Cell>
            <Cell name="L0C0R3" stripIndex="11">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="62">
            <Cell name="L0C1R0" stripIndex="61">b01</Cell>
            <Cell name="L0C1R1" stripIndex="62">s07</Cell>
            <Cell name="L0C1R2" stripIndex="63">s10</Cell>
            <Cell name="L0C1R3" stripIndex="64">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="15">
            <Cell name="L0C2R0" stripIndex="14">s01</Cell>
            <Cell name="L0C2R1" stripIndex="15">s08</Cell>
            <Cell name="L0C2R2" stripIndex="16">b01</Cell>
            <Cell name="L0C2R3" stripIndex="17">s03</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="5">w01</Cell>
            <Cell name="L0C3R1" stripIndex="6">w01</Cell>
            <Cell name="L0C3R2" stripIndex="7">w01</Cell>
            <Cell name="L0C3R3" stripIndex="8">w01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="74">
            <Cell name="L0C4R0" stripIndex="73">s05</Cell>
            <Cell name="L0C4R1" stripIndex="74">s03</Cell>
            <Cell name="L0C4R2" stripIndex="75">s06</Cell>
            <Cell name="L0C4R3" stripIndex="76">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="93">
            <Cell name="L0C0R0" stripIndex="92">s07</Cell>
            <Cell name="L0C0R1" stripIndex="93">s01</Cell>
            <Cell name="L0C0R2" stripIndex="94">s06</Cell>
            <Cell name="L0C0R3" stripIndex="95">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="30">
            <Cell name="L0C1R0" stripIndex="29">s02</Cell>
            <Cell name="L0C1R1" stripIndex="30">b01</Cell>
            <Cell name="L0C1R2" stripIndex="31">s08</Cell>
            <Cell name="L0C1R3" stripIndex="32">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="2">w01</Cell>
            <Cell name="L0C2R1" stripIndex="3">w01</Cell>
            <Cell name="L0C2R2" stripIndex="4">w01</Cell>
            <Cell name="L0C2R3" stripIndex="5">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="40">
            <Cell name="L0C3R0" stripIndex="39">s08</Cell>
            <Cell name="L0C3R1" stripIndex="40">s02</Cell>
            <Cell name="L0C3R2" stripIndex="41">s09</Cell>
            <Cell name="L0C3R3" stripIndex="42">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="34">
            <Cell name="L0C4R0" stripIndex="33">s10</Cell>
            <Cell name="L0C4R1" stripIndex="34">s06</Cell>
            <Cell name="L0C4R2" stripIndex="35">w01</Cell>
            <Cell name="L0C4R3" stripIndex="36">w01</Cell>
        </Entry>
    </PopulationOutcome>
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

    protected function startSpin($request) {
        $obj = $request['PatternSliderInput'];
        $totalBet = $obj->PatternsBet;
        $betPerLine = (float) $obj->BetPerPattern;

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

        if($this->gameParams->testBonusEnable && $_SESSION['state'] == 'SPIN') {
            $url = $_SERVER['HTTP_REFERER'];
            $g = '';
            if(strpos($url, 'bonus=fs') > 0) {
                $g = 'fs';
            }
            switch($g) {
                case 'fs':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(13,10,15,17,5),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
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
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $display = $this->getDisplay($report);
        $display2 = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

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
    '.$highlight.'

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
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$report['scattersReport']['totalWin'].'" stage="" totalPay="'.$report['scattersReport']['totalWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$report['scattersReport']['totalWin'].'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
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

        $awarded = 0;
        $scattersHighlight = '';
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['totalAwarded'] += 5;
            $_SESSION['fsLeft'] += 5;
            $awarded = 5;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
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
    '.$highlight.'
    '.$scattersHighlight.'
    '.$display.$baseReels.'
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