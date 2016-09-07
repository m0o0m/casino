<?
require_once('IGTCtrl.php');

class da_vinci_dual_playCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');
        $this->setSessionIfEmpty('preState', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1158-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Da Vinci Diamonds Dual Play"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="DaVinciDualPlay"/>
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
    <PaytableStatistics description="Da Vinci Diamonds Dual Play 40L 6x6x6x6x6" maxRTP="95.29" minRTP="93.41" name="Da Vinci Diamonds Dual Play" type="Slot" />
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="FreeSpinPrizeInfoLines" strategy="PayLeft">
        <Prize name="s01">
            <PrizePay count="5" pph="3208.7" value="5000" />
            <PrizePay count="4" pph="156.3" value="500" />
            <PrizePay count="3" pph="15.8" value="100" />
            <Symbol id="w01" required="false" />
            <Symbol id="s01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="259.7" value="1000" />
            <PrizePay count="4" pph="41.4" value="200" />
            <PrizePay count="3" pph="7.9" value="50" />
            <Symbol id="w01" required="false" />
            <Symbol id="s02" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="168.9" value="500" />
            <PrizePay count="4" pph="27.9" value="80" />
            <PrizePay count="3" pph="5.3" value="30" />
            <Symbol id="w01" required="false" />
            <Symbol id="s03" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="75.8" value="300" />
            <PrizePay count="4" pph="12" value="60" />
            <PrizePay count="3" pph="2.9" value="20" />
            <Symbol id="w01" required="false" />
            <Symbol id="s04" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="41.2" value="100" />
            <PrizePay count="4" pph="6.5" value="30" />
            <PrizePay count="3" pph="1.6" value="10" />
            <Symbol id="w01" required="false" />
            <Symbol id="s05" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="27.8" value="100" />
            <PrizePay count="4" pph="8.3" value="30" />
            <PrizePay count="3" pph="1.8" value="8" />
            <Symbol id="w01" required="false" />
            <Symbol id="s06" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="38.9" value="80" />
            <PrizePay count="4" pph="8.7" value="20" />
            <PrizePay count="3" pph="2" value="6" />
            <Symbol id="w01" required="false" />
            <Symbol id="s07" required="false" />
        </Prize>
        <Prize name="b01">
            <PrizePay count="3" pph="49.2" value="0" />
            <Symbol id="b01" required="false" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="40" min="40">
            <Step>40</Step>
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
        <Denomination softwareId="200-1158-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>40.0</MaxBet>
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
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'SPIN') {
            $state = 'BaseGameTumble';
        }
        if($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'FREE') {
            $state = 'FreeSpinTumble';
        }

        $baseReels = '<PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="24">
            <Cell name="L0C1R0" stripIndex="24">b01</Cell>
            <Cell name="L0C1R1" stripIndex="25">s04</Cell>
            <Cell name="L0C1R2" stripIndex="26">s06</Cell>
            <Cell name="L0C1R3" stripIndex="27">s05</Cell>
            <Cell name="L0C1R4" stripIndex="28">s03</Cell>
            <Cell name="L0C1R5" stripIndex="29">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="31">
            <Cell name="L0C2R0" stripIndex="31">s03</Cell>
            <Cell name="L0C2R1" stripIndex="32">s07</Cell>
            <Cell name="L0C2R2" stripIndex="33">s01</Cell>
            <Cell name="L0C2R3" stripIndex="34">s04</Cell>
            <Cell name="L0C2R4" stripIndex="35">s07</Cell>
            <Cell name="L0C2R5" stripIndex="36">b01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>';

        $freeReels = '<PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="40">
            <Cell name="L0C1R0" stripIndex="40">s06</Cell>
            <Cell name="L0C1R1" stripIndex="41">s07</Cell>
            <Cell name="L0C1R2" stripIndex="42">s03</Cell>
            <Cell name="L0C1R3" stripIndex="43">s06</Cell>
            <Cell name="L0C1R4" stripIndex="44">s07</Cell>
            <Cell name="L0C1R5" stripIndex="45">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="8">
            <Cell name="L0C2R0" stripIndex="8">w01</Cell>
            <Cell name="L0C2R1" stripIndex="9">s01</Cell>
            <Cell name="L0C2R2" stripIndex="10">s04</Cell>
            <Cell name="L0C2R3" stripIndex="11">s07</Cell>
            <Cell name="L0C2R4" stripIndex="12">b01</Cell>
            <Cell name="L0C2R5" stripIndex="13">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>';

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

            if(!empty($_SESSION['baseFreeDisplay'])) {
                $freeReels .= $this->getDisplayFromArray($this->decompressArray($_SESSION['baseFreeDisplay']), 'FreeSpin') . gzuncompress(base64_decode($_SESSION['baseFreeScatter']));
            }
        }

        if($_SESSION['state'] !== 'SPIN') {
            $baseReels = $this->getDisplayFromArray($this->decompressArray($_SESSION['baseDisplay']), 'BaseGame') . gzuncompress(base64_decode($_SESSION['baseScatter']));
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = (int) $_SESSION['lastPick'];
            $coinValue = (float) ($_SESSION['lastBet'] / $_SESSION['lastPick']);
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14264049088731</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseReels.$freeReels.$fs.'
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

        // unset
        unset($_SESSION['baseDisplay']);
        unset($_SESSION['startSpinBalance']);

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(6,6,6,6,6));
        $this->slot->rows = 6;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $_SESSION['state'] = 'SPIN';
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
        $stake = (float) $_SESSION['lastBet'];
        $pick = (int) $_SESSION['lastPick'];

        $this->gameParams->winLines = $this->gameParams->winLinesFree;
        $this->slot = new Slot($this->gameParams, 60, $stake, 6/4);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(6,6,6,6,6));
        $this->slot->rows = 6;

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

    protected function startTumble($request) {
        $stake = (float) $_SESSION['lastBet'];
        $pick = (int) $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[0], array(6,6,6,6,6));
        $this->slot->rows = 6;
        $this->slot->setReelsCreate($this->decompressArray($_SESSION['reels']));

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
        $stake = (float) $_SESSION['lastBet'];
        $pick = (int) $_SESSION['lastPick'];

        $this->gameParams->winLines = $this->gameParams->winLinesFree;
        $this->slot = new Slot($this->gameParams, 60, $stake, 6/4);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(6,6,6,6,6));
        $this->slot->rows = 6;
        $this->slot->setReelsCreate($this->decompressArray($_SESSION['reelsFree']));

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

        /*
        $bonus = array(
            'type' => 'setReelsOffsets',
            'offsets' => array(17,23,10,47,21),
        );
        */


        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        if(!empty($report['winLines'])) {
            if($_SESSION['state'] == 'SPIN') $_SESSION['preState'] = 'SPIN';
            if($_SESSION['state'] == 'FREE') $_SESSION['preState'] = 'FREE';
            $_SESSION['state'] = 'TUMBLE';
        }
        else {
            $_SESSION['state'] == $_SESSION['preState'];
        }


        $startFS = false;
        $winLines = false;
        foreach($report['winLines'] as $w) {
            if($w['alias'] == 'b01') {
                $_SESSION['state'] = 'FREE';
                $report['type'] = 'FREE';
                $startFS = true;
            }
            else {
                $winLines = true;
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


            $_SESSION['reels'] = $this->compressArray($this->slot->getReelsCreateArray());
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
            sort($_SESSION['avalancheOffsets']);
            $_SESSION['totalWin'] = $totalWin;
            $_SESSION['startBalance'] = $balance;
            $_SESSION['startSpinBalance'] = $balance;

            $_SESSION['baseDisplay'] = $this->compressArray(array(
                'offset' => $report['offset'],
                'rows' => $report['rows'],
            ));

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
    <TriggerOutcome component="" name="Bonus" stage="" />
    '.$trigger.$highlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    '.$display.'
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
    }

    public function showTumbleReport($report, $totalWin) {
        $balance = $this->getBalance() + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];


        $_SESSION['totalWin'] += $totalWin;


        $nextStage = 'BaseGame';
        $status = 'Start';
        $settled = 0;
        $pending = $report['bet'];
        $payout = $balance - $_SESSION['startSpinBalance'];
        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        $gameTotal = $balance - $_SESSION['startSpinBalance'];

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


            $_SESSION['reels'] = $this->compressArray($this->slot->getReelsCreateArray());
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
            sort($_SESSION['avalancheOffsets']);

            $_SESSION['baseDisplay'] = $this->compressArray(array(
                'offset' => $report['offset'],
                'rows' => $report['rows'],
            ));
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
    '.$trigger.$highlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    '.$display.'
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0"/>
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

        if(empty($report['winLines'])) {
            if($_SESSION['preState'] == 'SPIN') $_SESSION['state'] = 'SPIN';
            if($_SESSION['preState'] == 'FREE') $_SESSION['state'] = 'FREE';

            unset($_SESSION['reels']);
            unset($_SESSION['avalancheOffsets']);
            unset($_SESSION['totalWin']);
        }

        if($nextStage == 'BaseGame') {
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['startSpinBalance']);
            unset($_SESSION['baseScatter']);
            unset($_SESSION['startBalance']);
        }
    }


    public function showFreeFromTumble($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'];
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 0, 'Remove');
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['totalWin'] += $totalWin;

        $_SESSION['baseWinLinesWin'] = $_SESSION['totalWin'];

        $_SESSION['fsTotalWin'] = 0;

        $_SESSION['startFreeBalance'] = $this->getBalance();



        $_SESSION['reels'] = $this->compressArray($this->slot->getReelsCreateArray());
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
        sort($_SESSION['avalancheOffsets']);



        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGameTumble</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startFreeBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlight.'

    '.$display.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="40">
            <Cell name="L0C1R0" stripIndex="40">s06</Cell>
            <Cell name="L0C1R1" stripIndex="41">s07</Cell>
            <Cell name="L0C1R2" stripIndex="42">s03</Cell>
            <Cell name="L0C1R3" stripIndex="43">s06</Cell>
            <Cell name="L0C1R4" stripIndex="44">s07</Cell>
            <Cell name="L0C1R5" stripIndex="45">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="8">
            <Cell name="L0C2R0" stripIndex="8">w01</Cell>
            <Cell name="L0C2R1" stripIndex="9">s01</Cell>
            <Cell name="L0C2R2" stripIndex="10">s04</Cell>
            <Cell name="L0C2R3" stripIndex="11">s07</Cell>
            <Cell name="L0C2R4" stripIndex="12">b01</Cell>
            <Cell name="L0C2R5" stripIndex="13">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>6</InitAwarded>
        <Awarded>6</Awarded>
        <TotalAwarded>6</TotalAwarded>
        <Count>0</Count>
        <Countdown>6</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
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
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 6;
        $_SESSION['fsLeft'] = 6;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['baseDisplay'] = $this->compressArray(array(
            'offset' => $report['offset'],
            'rows' => $report['rows'],
        ));
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



        $_SESSION['reels'] = $this->compressArray($this->slot->getReelsCreateArray());
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
        sort($_SESSION['avalancheOffsets']);



        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startFreeBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$highlight.'

    '.$display.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s02</Cell>
            <Cell name="L0C0R1" stripIndex="2">s04</Cell>
            <Cell name="L0C0R2" stripIndex="3">s05</Cell>
            <Cell name="L0C0R3" stripIndex="4">s02</Cell>
            <Cell name="L0C0R4" stripIndex="5">s03</Cell>
            <Cell name="L0C0R5" stripIndex="6">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="40">
            <Cell name="L0C1R0" stripIndex="40">s06</Cell>
            <Cell name="L0C1R1" stripIndex="41">s07</Cell>
            <Cell name="L0C1R2" stripIndex="42">s03</Cell>
            <Cell name="L0C1R3" stripIndex="43">s06</Cell>
            <Cell name="L0C1R4" stripIndex="44">s07</Cell>
            <Cell name="L0C1R5" stripIndex="45">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="8">
            <Cell name="L0C2R0" stripIndex="8">w01</Cell>
            <Cell name="L0C2R1" stripIndex="9">s01</Cell>
            <Cell name="L0C2R2" stripIndex="10">s04</Cell>
            <Cell name="L0C2R3" stripIndex="11">s07</Cell>
            <Cell name="L0C2R4" stripIndex="12">b01</Cell>
            <Cell name="L0C2R5" stripIndex="13">s05</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="9">
            <Cell name="L0C3R0" stripIndex="9">w01</Cell>
            <Cell name="L0C3R1" stripIndex="10">s06</Cell>
            <Cell name="L0C3R2" stripIndex="11">s07</Cell>
            <Cell name="L0C3R3" stripIndex="12">s01</Cell>
            <Cell name="L0C3R4" stripIndex="13">s03</Cell>
            <Cell name="L0C3R5" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="1">
            <Cell name="L0C4R0" stripIndex="1">s05</Cell>
            <Cell name="L0C4R1" stripIndex="2">s06</Cell>
            <Cell name="L0C4R2" stripIndex="3">s02</Cell>
            <Cell name="L0C4R3" stripIndex="4">s05</Cell>
            <Cell name="L0C4R4" stripIndex="5">s03</Cell>
            <Cell name="L0C4R5" stripIndex="6">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>6</InitAwarded>
        <Awarded>6</Awarded>
        <TotalAwarded>6</TotalAwarded>
        <Count>0</Count>
        <Countdown>6</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
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
        <BetPerPattern>'.$betPerLine.'</BetPerPattern>
        <PatternsBet>'.$report['linesCount'].'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 6;
        $_SESSION['fsLeft'] = 6;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['baseDisplay'] = $this->compressArray(array(
            'offset' => $report['offset'],
            'rows' => $report['rows'],
        ));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];
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

        $_SESSION['singleFreeSpin'] = $totalWin;

        $nextStage = 'FreeSpin';

        $baseReels = '';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGameTumble';
            $needBalance = $_SESSION['startBalance'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';
            $baseReels = $this->getDisplayFromArray($this->decompressArray($_SESSION['baseDisplay']), 'BaseGame');
        }


        $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="" />';

        if(!empty($report['winLines'])) {
            $nextStage = 'FreeSpinTumble';

            $trigger = '<TriggerOutcome component="" name="BaseGameTumble" stage="">
        <Trigger name="BaseGameTumble" priority="0" stageConnector="" />
    </TriggerOutcome>';

            $_SESSION['reelsFree'] = $this->compressArray($this->slot->getReelsCreateArray());
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
            sort($_SESSION['avalancheOffsetsFree']);
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
        <Payout>0</Payout>
    </OutcomeDetail>
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
    <PrizeOutcome multiplier="1" name="FreeSpin.Total.SingleFreeSpin" pay="'.$_SESSION['singleFreeSpin'].'" stage="" totalPay="'.$_SESSION['singleFreeSpin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['singleFreeSpin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['singleFreeSpin'].'" ways="0" />
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
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>40</PatternsBet>
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
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseWinLinesWin']);
        }

        $_SESSION['baseFreeDisplay'] = $this->compressArray(array(
            'offset' => $report['offset'],
            'rows' => $report['rows'],
        ));

        $_SESSION['baseFreeScatter'] = base64_encode(gzcompress($highlight.$winLines, 9));
    }


    public function showTumbleFreeReport($report, $totalWin) {
        $balance = $_SESSION['startBalance'];
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines', 0, 'Remove');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];


        $_SESSION['totalWin'] += $totalWin;

        $_SESSION['fsTotalWin'] += $totalWin;

        $_SESSION['singleFreeSpin'] += $totalWin;


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


            $_SESSION['reelsFree'] = $this->compressArray($this->slot->getReelsCreateArray());
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
            sort($_SESSION['avalancheOffsetsFree']);
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

        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
        $baseReels = $this->getDisplayFromArray($this->decompressArray($_SESSION['baseDisplay']), 'BaseGame');

        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>FreeSpinTumble</Stage>
        <NextStage>'.$nextStage.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>'.$status.'</GameStatus>
        <Settled>'.$settled.'</Settled>
        <Pending>'.$pending.'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
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
    '.$display.$baseReels.$baseScatter.'
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="FreeSpin.Total.SingleFreeSpin" pay="'.$_SESSION['singleFreeSpin'].'" stage="" totalPay="'.$_SESSION['singleFreeSpin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['singleFreeSpin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['singleFreeSpin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>A2210-14264043293637</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$this->slot->betOnLine.'</BetPerPattern>
        <PatternsBet>40</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['baseFreeDisplay'] = $this->compressArray(array(
            'offset' => $report['offset'],
            'rows' => $report['rows'],
        ));

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
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}
