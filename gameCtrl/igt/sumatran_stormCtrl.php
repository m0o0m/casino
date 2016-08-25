<?
require_once('IGTCtrl.php');

class sumatran_stormCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1207-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Sumatran Storm"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="SumatranStorm"/>
    <param name="studio" value="crdc"/>
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
    <PaytableStatistics description="Sumatran Storm 720 Multiway 3x4x5x4x3" maxRTP="96.56" minRTP="93.23" name="Sumatran Storm" type="Slot"/>
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftBaseGame" strategy="PayMultiWayRightLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRightFreeSpin" strategy="PayMultiWayLeftRight">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftFreeSpin" strategy="PayMultiWayRightLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterBaseGame" strategy="PayAny">
        <Prize name="s09">
            <PrizePay count="5" pph="29190" value="50"/>
            <PrizePay count="4" pph="845" value="10"/>
            <PrizePay count="3" pph="62" value="2"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterFreeSpin" strategy="PayAny">
        <Prize name="s18">
            <PrizePay count="5" pph="29545" value="50"/>
            <PrizePay count="4" pph="852" value="10"/>
            <PrizePay count="3" pph="62" value="2"/>
            <Symbol id="s18" required="false"/>
        </Prize>
    </PrizeInfo>
    <FreeSpinInfo name="BaseGame.FreeSpinInfo">
        <Reset>true</Reset>
        <Increment>
            <Strategy>Additive</Strategy>
            <MaxFreeSpins>150</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="5" name="5 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>NoDecrement</Strategy>
            <Count>0</Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="60" min="60">
            <Step>60</Step>
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
        <Denomination softwareId="200-1207-001">1.0</Denomination>
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
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="BaseGame.RightLeftMultiWay" pay="0" stage="" totalPay="0" type="Pattern" />
    <PrizeOutcome multiplier="1" name="BaseGame.LeftRightMultiWay" pay="0" stage="" totalPay="0" type="Pattern" />';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043378942</TransactionId>
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
        <Entry name="Reel0" stripIndex="139">
            <Cell name="L0C0R0" stripIndex="139">b01</Cell>
            <Cell name="L0C0R1" stripIndex="140">s03</Cell>
            <Cell name="L0C0R2" stripIndex="141">s04</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="166">
            <Cell name="L0C1R0" stripIndex="166">s05</Cell>
            <Cell name="L0C1R1" stripIndex="167">w01</Cell>
            <Cell name="L0C1R2" stripIndex="168">w01</Cell>
            <Cell name="L0C1R3" stripIndex="169">w01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="152">
            <Cell name="L0C2R0" stripIndex="152">b01</Cell>
            <Cell name="L0C2R1" stripIndex="153">s07</Cell>
            <Cell name="L0C2R2" stripIndex="154">s02</Cell>
            <Cell name="L0C2R3" stripIndex="155">s02</Cell>
            <Cell name="L0C2R4" stripIndex="156">s08</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="138">
            <Cell name="L0C3R0" stripIndex="138">s06</Cell>
            <Cell name="L0C3R1" stripIndex="139">b01</Cell>
            <Cell name="L0C3R2" stripIndex="140">s02</Cell>
            <Cell name="L0C3R3" stripIndex="141">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="119">
            <Cell name="L0C4R0" stripIndex="119">s01</Cell>
            <Cell name="L0C4R1" stripIndex="120">s09</Cell>
            <Cell name="L0C4R2" stripIndex="121">s08</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="4">
            <Cell name="L0C0R0" stripIndex="4">b02</Cell>
            <Cell name="L0C0R1" stripIndex="5">s12</Cell>
            <Cell name="L0C0R2" stripIndex="6">s12</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="74">
            <Cell name="L0C1R0" stripIndex="74">s11</Cell>
            <Cell name="L0C1R1" stripIndex="75">s11</Cell>
            <Cell name="L0C1R2" stripIndex="76">s11</Cell>
            <Cell name="L0C1R3" stripIndex="77">s15</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="45">
            <Cell name="L0C2R0" stripIndex="45">b02</Cell>
            <Cell name="L0C2R1" stripIndex="46">b02</Cell>
            <Cell name="L0C2R2" stripIndex="47">w02</Cell>
            <Cell name="L0C2R3" stripIndex="48">w02</Cell>
            <Cell name="L0C2R4" stripIndex="49">w02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="126">
            <Cell name="L0C3R0" stripIndex="126">b02</Cell>
            <Cell name="L0C3R1" stripIndex="127">s11</Cell>
            <Cell name="L0C3R2" stripIndex="128">s11</Cell>
            <Cell name="L0C3R3" stripIndex="129">s14</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="21">
            <Cell name="L0C4R0" stripIndex="21">s10</Cell>
            <Cell name="L0C4R1" stripIndex="22">s10</Cell>
            <Cell name="L0C4R2" stripIndex="23">s16</Cell>
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
        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,5,4,3));
        $this->slot->rows = 5;

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
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,4,5,4,3));
        $this->slot->rows = 5;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments(0, $totalWin * 100) || $respin) {
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

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        $fiveCount = 0;
        $noCount = 0;
        foreach($report['winLines'] as $w) {
            if(($w['alias'] == 'b01' || $w['alias'] == 'b02') && $w['count'] == 5) {
                $fiveCount++;
            }
            else {
                $noCount++;
            }
        }

        if($fiveCount > 0) {
            $_SESSION['initFS'] = 5 * $fiveCount;
            $_SESSION['fiveCount'] = $fiveCount;
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s09');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 2;
            if($scatterPayReport['count'] == 4) $multiple = 10;
            if($scatterPayReport['count'] == 5) $multiple = 50;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $scatterPayReport = $this->slot->getSymbolAnyCount('s18');

        if($scatterPayReport['count'] >= 3 ) {
            $multiple = 2;
            if($scatterPayReport['count'] == 4) $multiple = 10;
            if($scatterPayReport['count'] == 5) $multiple = 50;
            $report['scattersReport'] = $scatterPayReport;
            $report['scattersReport']['totalWin'] = $report['bet'] * $multiple;
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
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $sc = '<HighlightOutcome name="BaseGame.Scatter" type=""/>';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sc = $this->getScattersHighlight($report['scattersReport']['offsets']);
            $scattersPay = $this->getScattersPay($report['scattersReport'], 'BaseGame.Scatter', 's09');
        }
        else {
            $report['scattersReport']['totalWin'] = 0;
            $scattersPay = '';
        }

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
    '.$display.$sc.$scattersPay.$leftWinLines.'
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


    protected function showStartFreeSpinReport($report, $totalWin) {
        $_SESSION['fsTotalWin'] = 0;
        $_SESSION['scatterWin'] = $report['betOnLine'] * $_SESSION['fiveCount'] * 50;

        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $display = $this->getDisplay($report);
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;



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
    '.$highlightLeft.$highlightRight.'

    '.$display.$display2.'
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initFS'].'</InitAwarded>
        <Awarded>'.$_SESSION['initFS'].'</Awarded>
        <TotalAwarded>'.$_SESSION['initFS'].'</TotalAwarded>
        <Count>0</Count>
        <Countdown>'.$_SESSION['initFS'].'</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$scattersPay.'
    '.$leftWinLines.$rightWinLines.'
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
        $_SESSION['totalAwarded'] = $_SESSION['initFS'];
        $_SESSION['fsLeft'] = $_SESSION['initFS'];
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlightLeft.$highlightRight.$leftWinLines.$rightWinLines, 9));
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'FreeSpin');
        $highlightRight = $this->getRightHighlight($report['winLines'], 'FreeSpin');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report, 'FreeSpin');
        $rightWinLines = $this->getRightWayWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $awarded = 0;
        $scattersHighlight = '';
        $scattersPay = '';
        if($report['scattersReport']['count'] > 2) {
            if($report['type'] == 'FREE') {
                $_SESSION['totalAwarded'] += 5 * $_SESSION['fiveCount'];
                $_SESSION['fsLeft'] += 5 * $_SESSION['fiveCount'];
                $awarded = 5 * $_SESSION['fiveCount'];
                $report['scattersReport']['totalWin'] = 0;
                $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter', 'b02');
                $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
            }
            else {
                if(!empty($report['scattersReport']['totalWin'])) {
                    $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter', 's18');
                    $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
                }
            }
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

        $fsWin = $_SESSION['fsTotalWin'];

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];

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
    '.$highlightLeft.$highlightRight.$scattersHighlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initFS'].'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$baseReels.$display.'

    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />

    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$leftWinLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    '.$rightWinLines.'
    <TransactionId>R1540-14228769811020</TransactionId>
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
            unset($_SESSION['initFS']);
            unset($_SESSION['fiveCount']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}
