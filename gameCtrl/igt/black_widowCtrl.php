<?
require_once('IGTCtrl.php');

class black_widowCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params>
    <param name="softwareid" value="200-1187-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="Black Widow"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="BlackWidow"/>
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
    <param name="currencycode" value="FPY"/>
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
    <PaytableStatistics description="BlackWidow 40L 3x3x3x3x3" gameOnlyRTP="" jackpotPPH="" maxRTP="96.00" minRTP="91.99" name="BlackWidow" type="Slot" />
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoScatter" strategy="payAny">
        <Prize name="b01">
            <PrizePay count="9" value="0" />
            <Symbol id="b01" required="true" />
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="WebCapture.PrizeInfo" strategy="payTrigger">
        <!-- GreenMan Prizes -->
        <Prize name="GreenPrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="GreenPrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="GreenPrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="GreenPrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="GreenPrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="GreenPrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="GreenPrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="GreenPrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="GreenPrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="GreenPrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="GreenPrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="GreenPrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="GreenPrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="GreenPrize14">
            <PrizePay count="1" value="1000" />
        </Prize>
        <!-- RedMan Prizes -->
        <Prize name="RedPrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="RedPrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="RedPrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="RedPrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="RedPrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="RedPrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="RedPrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="RedPrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="RedPrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="RedPrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="RedPrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="RedPrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="RedPrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="RedPrize14">
            <PrizePay count="1" value="1000" />
        </Prize>
        <!-- BlueMan Prizes -->
        <Prize name="BluePrize1">
            <PrizePay count="1" value="2" />
        </Prize>
        <Prize name="BluePrize2">
            <PrizePay count="1" value="3" />
        </Prize>
        <Prize name="BluePrize3">
            <PrizePay count="1" value="5" />
        </Prize>
        <Prize name="BluePrize4">
            <PrizePay count="1" value="8" />
        </Prize>
        <Prize name="BluePrize5">
            <PrizePay count="1" value="12" />
        </Prize>
        <Prize name="BluePrize6">
            <PrizePay count="1" value="18" />
        </Prize>
        <Prize name="BluePrize7">
            <PrizePay count="1" value="25" />
        </Prize>
        <Prize name="BluePrize8">
            <PrizePay count="1" value="35" />
        </Prize>
        <Prize name="BluePrize9">
            <PrizePay count="1" value="50" />
        </Prize>
        <Prize name="BluePrize10">
            <PrizePay count="1" value="75" />
        </Prize>
        <Prize name="BluePrize11">
            <PrizePay count="1" value="100" />
        </Prize>
        <Prize name="BluePrize12">
            <PrizePay count="1" value="200" />
        </Prize>
        <Prize name="BluePrize13">
            <PrizePay count="1" value="500" />
        </Prize>
        <Prize name="BluePrize14">
            <PrizePay count="1" value="1000" />
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
        '.$betPattern.'
    </PatternSliderInfo>
    <AwardCapInfo name="AwardCapInfo">
        <TriggerInfo name="AwardCapExceeded" priority="100" stageConnector="AwardCapToBaseGame" />
        <CurrencyCap>
            <CurrencyType>FPY</CurrencyType>
            <AwardCap>25000000</AwardCap>
        </CurrencyCap>
    </AwardCapInfo>
    <SelectiveStackingBetIncrements name="SelectiveStackingValues">
        '.$selective.'
    </SelectiveStackingBetIncrements>
    <DenominationList>
        <Denomination softwareId="200-1187-001">1.0</Denomination>
    </DenominationList>
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

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043298614</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="46">
            <Cell name="L0C0R0" stripIndex="46">s02</Cell>
            <Cell name="L0C0R1" stripIndex="47">s07</Cell>
            <Cell name="L0C0R2" stripIndex="48">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="36">
            <Cell name="L0C1R0" stripIndex="36">s05</Cell>
            <Cell name="L0C1R1" stripIndex="37">w01</Cell>
            <Cell name="L0C1R2" stripIndex="38">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="53">
            <Cell name="L0C2R0" stripIndex="53">s04</Cell>
            <Cell name="L0C2R1" stripIndex="54">s05</Cell>
            <Cell name="L0C2R2" stripIndex="55">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="33">
            <Cell name="L0C3R0" stripIndex="33">s04</Cell>
            <Cell name="L0C3R1" stripIndex="34">s07</Cell>
            <Cell name="L0C3R2" stripIndex="35">s05</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="39">
            <Cell name="L0C4R0" stripIndex="39">s03</Cell>
            <Cell name="L0C4R1" stripIndex="40">w01</Cell>
            <Cell name="L0C4R2" stripIndex="41">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>7d625d41454150405b595a7f4147515655531157344040545e5972515e5a7d5e50564a041a0613142f535f540d0f725b5f5b5b5e1a6051515d5b50672446100f3a240d715c424649145d53545d0b1367225a575c517e544010164744465a42705652544c7c1002130e27383d0e75515c58135c5855530c160d027101621d131441424659447a5c5d5d4e0c1671100c03021c00051e04060105021e0b0a0700056d000000011c1d06000705011801000809071d06730303001c1f030503071802060203081404030570031e03021c00051e04060105021e0b0a0700056d000000011c1d0600070501081c715c545a0f3e480e1d745e59434d0c3c081f645c424c5457455d2e5c7d44444e5e5957083e</Data>
    </ObfuscatedOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>40</PatternsBet>
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
        $pick = (int) $totalBet;

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

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
        }

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

        $report = $this->slot->spin(array(
            'type' => 'randomReplace',
            'symbols' => array(11,12,13,14,15),
            'replacement' => array(0,1,2,3,4,5,6,7,8,9),
        ));

        $report['type'] = 'SPIN';

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

}