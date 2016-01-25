<?
require_once('IGTCtrl.php');

class noahs_arkCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1129-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Noah`s Ark"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="NoahsArk"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="Cats 30L 3x3x3x3x3" maxRTP="94.93" minRTP="93.04" name="Cats" type="Slot" />
    <PrizeInfo name="PrizeInfoLines" strategy="PayExpandSymbolLeft">
        <Prize name="w01">
            <PrizePay count="5" pph="528095" value="10000" />
            <PrizePay count="4" pph="203114" value="1000" />
            <PrizePay count="3" pph="11788" value="300" />
            <Symbol id="w01" required="true" />
        </Prize>
        <Prize name="s01">
            <PrizePay count="10" pph="11237" value="2500" />
            <PrizePay count="9" pph="3225" value="1000" />
            <PrizePay count="8" pph="1837" value="500" />
            <PrizePay count="7" pph="1301" value="300" />
            <PrizePay count="6" pph="367" value="200" />
            <PrizePay count="5" pph="160" value="100" />
            <PrizePay count="4" pph="47" value="30" />
            <PrizePay count="3" pph="21" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s01" required="false" />
        </Prize>
        <Prize name="s02">
            <PrizePay count="10" pph="7459" value="1000" />
            <PrizePay count="9" pph="2987" value="800" />
            <PrizePay count="8" pph="1781" value="500" />
            <PrizePay count="7" pph="1369" value="300" />
            <PrizePay count="6" pph="275" value="200" />
            <PrizePay count="5" pph="167" value="100" />
            <PrizePay count="4" pph="37" value="30" />
            <PrizePay count="3" pph="21" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s02" required="false" />
        </Prize>
        <Prize name="s03">
            <PrizePay count="10" pph="8546" value="1000" />
            <PrizePay count="9" pph="3390" value="800" />
            <PrizePay count="8" pph="2017" value="500" />
            <PrizePay count="7" pph="1547" value="300" />
            <PrizePay count="6" pph="315" value="200" />
            <PrizePay count="5" pph="188" value="100" />
            <PrizePay count="4" pph="37" value="25" />
            <PrizePay count="3" pph="21" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s03" required="false" />
        </Prize>
        <Prize name="s04">
            <PrizePay count="10" pph="5661" value="1000" />
            <PrizePay count="9" pph="2611" value="800" />
            <PrizePay count="8" pph="1568" value="500" />
            <PrizePay count="7" pph="1259" value="300" />
            <PrizePay count="6" pph="216" value="200" />
            <PrizePay count="5" pph="155" value="100" />
            <PrizePay count="4" pph="25" value="25" />
            <PrizePay count="3" pph="17" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s04" required="false" />
        </Prize>
        <Prize name="s05">
            <PrizePay count="10" pph="5140" value="1000" />
            <PrizePay count="9" pph="3040" value="800" />
            <PrizePay count="8" pph="1689" value="500" />
            <PrizePay count="7" pph="1547" value="200" />
            <PrizePay count="6" pph="223" value="150" />
            <PrizePay count="5" pph="201" value="100" />
            <PrizePay count="4" pph="25" value="25" />
            <PrizePay count="3" pph="23" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s05" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="203" value="200" />
            <PrizePay count="4" pph="94" value="20" />
            <PrizePay count="3" pph="09" value="8" />
            <Symbol id="w01" required="false" />
            <Symbol id="s06" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="224" value="100" />
            <PrizePay count="4" pph="104" value="15" />
            <PrizePay count="3" pph="08" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s07" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="203" value="100" />
            <PrizePay count="4" pph="94" value="15" />
            <PrizePay count="3" pph="09" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s08" required="false" />
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="224" value="100" />
            <PrizePay count="4" pph="104" value="15" />
            <PrizePay count="3" pph="08" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s09" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="BonusPrizeInfoLines" strategy="PayExpandSymbolLeft">
        <Prize name="w01">
            <PrizePay count="5" pph="279572" value="10000" />
            <PrizePay count="4" pph="86022" value="1000" />
            <PrizePay count="3" pph="4236" value="300" />
            <Symbol id="w01" required="true" />
        </Prize>
        <Prize name="s10">
            <PrizePay count="10" pph="1667" value="2500" />
            <PrizePay count="9" pph="1037" value="1000" />
            <PrizePay count="8" pph="505" value="500" />
            <PrizePay count="7" pph="469" value="300" />
            <PrizePay count="6" pph="70" value="200" />
            <PrizePay count="5" pph="72" value="100" />
            <PrizePay count="4" pph="04" value="30" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s10" required="false" />
        </Prize>
        <Prize name="s11">
            <PrizePay count="10" pph="1670" value="1000" />
            <PrizePay count="9" pph="1037" value="800" />
            <PrizePay count="8" pph="505" value="500" />
            <PrizePay count="7" pph="469" value="300" />
            <PrizePay count="6" pph="70" value="200" />
            <PrizePay count="5" pph="72" value="100" />
            <PrizePay count="4" pph="04" value="30" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s11" required="false" />
        </Prize>
        <Prize name="s12">
            <PrizePay count="10" pph="1670" value="1000" />
            <PrizePay count="9" pph="1037" value="800" />
            <PrizePay count="8" pph="505" value="500" />
            <PrizePay count="7" pph="469" value="300" />
            <PrizePay count="6" pph="70" value="200" />
            <PrizePay count="5" pph="72" value="100" />
            <PrizePay count="4" pph="04" value="25" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s12" required="false" />
        </Prize>
        <Prize name="s13">
            <PrizePay count="10" pph="1670" value="1000" />
            <PrizePay count="9" pph="1037" value="800" />
            <PrizePay count="8" pph="505" value="500" />
            <PrizePay count="7" pph="469" value="300" />
            <PrizePay count="6" pph="70" value="200" />
            <PrizePay count="5" pph="72" value="100" />
            <PrizePay count="4" pph="04" value="25" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s13" required="false" />
        </Prize>
        <Prize name="s14">
            <PrizePay count="10" pph="1670" value="1000" />
            <PrizePay count="9" pph="1037" value="800" />
            <PrizePay count="8" pph="505" value="500" />
            <PrizePay count="7" pph="469" value="200" />
            <PrizePay count="6" pph="70" value="150" />
            <PrizePay count="5" pph="72" value="100" />
            <PrizePay count="4" pph="04" value="25" />
            <PrizePay count="3" pph="10" value="10" />
            <Symbol id="w02" required="false" />
            <Symbol id="s14" required="false" />
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="375" value="200" />
            <PrizePay count="4" pph="151" value="20" />
            <PrizePay count="3" pph="10" value="8" />
            <Symbol id="w01" required="false" />
            <Symbol id="s06" required="false" />
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="341" value="100" />
            <PrizePay count="4" pph="138" value="15" />
            <PrizePay count="3" pph="09" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s07" required="false" />
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="273" value="100" />
            <PrizePay count="4" pph="109" value="15" />
            <PrizePay count="3" pph="07" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s08" required="false" />
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="300" value="100" />
            <PrizePay count="4" pph="120" value="15" />
            <PrizePay count="3" pph="08" value="5" />
            <Symbol id="w01" required="false" />
            <Symbol id="s09" required="false" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayExpandSymbolAny">
        <Prize name="b01">
            <PrizePay count="6" pph="33" value="0" />
            <PrizePay count="5" pph="07" value="0" />
            <PrizePay count="4" pph="02" value="2" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="FreeSpin">
        '.$freeReel.'
    </StripInfo>
    <PatternSliderInfo>
        <PatternInfo max="30" min="1">
            <Step>1</Step>
            <Step>3</Step>
            <Step>5</Step>
            <Step>9</Step>
            <Step>15</Step>
            <Step>30</Step>
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
    <GameData>
        <DoubleSymbol name="s01" />
        <DoubleSymbol name="s02" />
        <DoubleSymbol name="s03" />
        <DoubleSymbol name="s04" />
        <DoubleSymbol name="s05" />
        <DoubleSymbol name="s10" />
        <DoubleSymbol name="s11" />
        <DoubleSymbol name="s12" />
        <DoubleSymbol name="s13" />
        <DoubleSymbol name="s14" />
        <DoubleSymbol name="w01" />
    </GameData>
    <DenominationList>
        <Denomination softwareId="200-1137-001">1.0</Denomination>
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
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
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
    </PrizeOutcome>';
        }

        $patternsBet = 30;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043302834</TransactionId>
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
        <Entry name="Reel0" stripIndex="15">
            <Cell name="L0C0R0" stripIndex="7">s07</Cell>
            <Cell name="L0C0R1" stripIndex="8">s09</Cell>
            <Cell name="L0C0R2" stripIndex="9">d01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="43">
            <Cell name="L0C1R0" stripIndex="53">s08</Cell>
            <Cell name="L0C1R1" stripIndex="54">s07</Cell>
            <Cell name="L0C1R2" stripIndex="55">s09</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="66">
            <Cell name="L0C2R0" stripIndex="68">s02</Cell>
            <Cell name="L0C2R1" stripIndex="1">s06</Cell>
            <Cell name="L0C2R2" stripIndex="2">d02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="31">
            <Cell name="L0C3R0" stripIndex="5">s06</Cell>
            <Cell name="L0C3R1" stripIndex="6">d04</Cell>
            <Cell name="L0C3R2" stripIndex="7">d05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="25">
            <Cell name="L0C4R0" stripIndex="4">w01</Cell>
            <Cell name="L0C4R1" stripIndex="5">s01</Cell>
            <Cell name="L0C4R2" stripIndex="6">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="20">
            <Cell name="L0C0R0" stripIndex="20">d12</Cell>
            <Cell name="L0C0R1" stripIndex="21">d10</Cell>
            <Cell name="L0C0R2" stripIndex="22">s08</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="20">
            <Cell name="L0C1R0" stripIndex="20">s07</Cell>
            <Cell name="L0C1R1" stripIndex="21">d13</Cell>
            <Cell name="L0C1R2" stripIndex="22">d11</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="28">
            <Cell name="L0C2R0" stripIndex="28">d10</Cell>
            <Cell name="L0C2R1" stripIndex="29">s06</Cell>
            <Cell name="L0C2R2" stripIndex="30">d13</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="37">
            <Cell name="L0C3R0" stripIndex="37">s06</Cell>
            <Cell name="L0C3R1" stripIndex="38">w01</Cell>
            <Cell name="L0C3R2" stripIndex="39">d12</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="27">
            <Cell name="L0C4R0" stripIndex="27">d14</Cell>
            <Cell name="L0C4R1" stripIndex="28">s07</Cell>
            <Cell name="L0C4R2" stripIndex="29">d10</Cell>
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

        $this->slot = new Slot($this->gameParams, $pick, $stake);
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
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $report = $this->slot->spin();

        $report['type'] = 'SPIN';

        $r1 = $this->slot->getSymbolAnyCount('b01');
        $r2 = $this->slot->getSymbolAnyCount('b02');

        $totalCount = $r1['count'] + $r2['count'] * 2;

        $report['scattersReport'] = array();
        $report['scattersReport']['count'] = $totalCount;
        $report['scattersReport']['offsets'] = array_merge($r1['offsets'], $r2['offsets']);
        $report['scattersReport']['totalWin'] = 0;
        if($totalCount == 4) {
            $report['scattersReport']['totalWin'] = $report['bet'] * 2;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        if($totalCount > 4) {
            $report['type'] = 'FREE';
        }
        else {
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

        $winLines = str_replace('d01', 's01', $winLines);
        $winLines = str_replace('d02', 's02', $winLines);
        $winLines = str_replace('d03', 's03', $winLines);
        $winLines = str_replace('d04', 's04', $winLines);
        $winLines = str_replace('d05', 's05', $winLines);


        $betPerLine = $report['bet'] / $report['linesCount'];

        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $scattersHighlight = '<HighlightOutcome name="BaseGame.Scatter" type=""/>';
        if($report['scattersReport']['count'] > 3) {
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
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
    <TriggerOutcome component="" name="CurrentLevels" stage=""/>
    <TriggerOutcome component="" name="Common.BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector=""/>
    </TriggerOutcome>
    '.$highlight.$scattersPay.$scattersHighlight.'

    '.$display.'
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
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);

        $winLines = str_replace('d01', 's01', $winLines);
        $winLines = str_replace('d02', 's02', $winLines);
        $winLines = str_replace('d03', 's03', $winLines);
        $winLines = str_replace('d04', 's04', $winLines);
        $winLines = str_replace('d05', 's05', $winLines);

        $betPerLine = $report['bet'] / $report['linesCount'];

        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $awarded = 5;
        if($report['scattersReport']['count'] == 6) {
            $awarded = 10;
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout></Payout>
    </OutcomeDetail>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$awarded.'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$awarded.'</TotalAwarded>
        <Count>0</Count>
        <Countdown>'.$awarded.'</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$highlight.$scattersPay.$scattersHighlight.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
                  <Entry name="Reel0" stripIndex="20">
                        <Cell name="L0C0R0" stripIndex="20">d12</Cell>
                        <Cell name="L0C0R1" stripIndex="21">d10</Cell>
                        <Cell name="L0C0R2" stripIndex="22">s08</Cell>
                  </Entry>
                  <Entry name="Reel1" stripIndex="20">
                        <Cell name="L0C1R0" stripIndex="20">s07</Cell>
                        <Cell name="L0C1R1" stripIndex="21">d13</Cell>
                        <Cell name="L0C1R2" stripIndex="22">d11</Cell>
                  </Entry>
                  <Entry name="Reel2" stripIndex="28">
                        <Cell name="L0C2R0" stripIndex="28">d10</Cell>
                        <Cell name="L0C2R1" stripIndex="29">s06</Cell>
                        <Cell name="L0C2R2" stripIndex="30">d13</Cell>
                  </Entry>
                  <Entry name="Reel3" stripIndex="37">
                        <Cell name="L0C3R0" stripIndex="37">s06</Cell>
                        <Cell name="L0C3R1" stripIndex="38">w01</Cell>
                        <Cell name="L0C3R2" stripIndex="39">d12</Cell>
                  </Entry>
                  <Entry name="Reel4" stripIndex="27">
                        <Cell name="L0C4R0" stripIndex="27">d14</Cell>
                        <Cell name="L0C4R1" stripIndex="28">s07</Cell>
                        <Cell name="L0C4R2" stripIndex="29">d10</Cell>
                  </Entry>
              </PopulationOutcome>
    '.$display.'
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

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['initAwarded'] = $awarded;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlight.$winLines, 9));
        $_SESSION['pickerCount'] = 1;
    }


    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $display = $this->getDisplay($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');

        $winLines = str_replace('d10', 's10', $winLines);
        $winLines = str_replace('d11', 's11', $winLines);
        $winLines = str_replace('d12', 's12', $winLines);
        $winLines = str_replace('d13', 's13', $winLines);
        $winLines = str_replace('d14', 's14', $winLines);

        $betPerLine = $report['bet'] / $report['linesCount'];
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');

        $awarded = 0;
        $scattersHighlight = '';

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
    '.$highlight.$scattersHighlight.$scattersPay.$display.$baseReels.'
    <FreeSpinOutcome name="">
        <InitAwarded>15</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern">
        <Prize betMultiplier="30" multiplier="1" name="Scatter" pay="0" payName="5 b01" symbolCount="5" totalPay="0" ways="0" />
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
