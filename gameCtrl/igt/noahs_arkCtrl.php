
<?
require_once('IGTCtrl.php');

class noahs_arkCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1129-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Noah`s Ark"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="NoahsArk"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';

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
    <PaytableStatistics description="Noah`s Ark 30L 3x3x3x3x3" maxRTP="94.93" minRTP="93.04" name="Noah`s Ark" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayExpandSymbolLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="BonusPrizeInfoLines" strategy="PayExpandSymbolLeft">
        <Prize name="w01">
            <PrizePay count="5" pph="279572" value="10000"/>
            <PrizePay count="4" pph="86022" value="1000"/>
            <PrizePay count="3" pph="4236" value="300"/>
            <Symbol id="w01" required="true"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="10" pph="1667" value="2500"/>
            <PrizePay count="9" pph="1037" value="1000"/>
            <PrizePay count="8" pph="505" value="500"/>
            <PrizePay count="7" pph="469" value="300"/>
            <PrizePay count="6" pph="70" value="200"/>
            <PrizePay count="5" pph="72" value="100"/>
            <PrizePay count="4" pph="04" value="30"/>
            <PrizePay count="3" pph="10" value="10"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s10" required="false"/>
        </Prize>
        <Prize name="s11">
            <PrizePay count="10" pph="1670" value="1000"/>
            <PrizePay count="9" pph="1037" value="800"/>
            <PrizePay count="8" pph="505" value="500"/>
            <PrizePay count="7" pph="469" value="300"/>
            <PrizePay count="6" pph="70" value="200"/>
            <PrizePay count="5" pph="72" value="100"/>
            <PrizePay count="4" pph="04" value="30"/>
            <PrizePay count="3" pph="10" value="10"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s11" required="false"/>
        </Prize>
        <Prize name="s12">
            <PrizePay count="10" pph="1670" value="1000"/>
            <PrizePay count="9" pph="1037" value="800"/>
            <PrizePay count="8" pph="505" value="500"/>
            <PrizePay count="7" pph="469" value="300"/>
            <PrizePay count="6" pph="70" value="200"/>
            <PrizePay count="5" pph="72" value="100"/>
            <PrizePay count="4" pph="04" value="25"/>
            <PrizePay count="3" pph="10" value="10"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s12" required="false"/>
        </Prize>
        <Prize name="s13">
            <PrizePay count="10" pph="1670" value="1000"/>
            <PrizePay count="9" pph="1037" value="800"/>
            <PrizePay count="8" pph="505" value="500"/>
            <PrizePay count="7" pph="469" value="300"/>
            <PrizePay count="6" pph="70" value="200"/>
            <PrizePay count="5" pph="72" value="100"/>
            <PrizePay count="4" pph="04" value="25"/>
            <PrizePay count="3" pph="10" value="10"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s13" required="false"/>
        </Prize>
        <Prize name="s14">
            <PrizePay count="10" pph="1670" value="1000"/>
            <PrizePay count="9" pph="1037" value="800"/>
            <PrizePay count="8" pph="505" value="500"/>
            <PrizePay count="7" pph="469" value="200"/>
            <PrizePay count="6" pph="70" value="150"/>
            <PrizePay count="5" pph="72" value="100"/>
            <PrizePay count="4" pph="04" value="25"/>
            <PrizePay count="3" pph="10" value="10"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s14" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="375" value="200"/>
            <PrizePay count="4" pph="151" value="20"/>
            <PrizePay count="3" pph="10" value="8"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s06" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="341" value="100"/>
            <PrizePay count="4" pph="138" value="15"/>
            <PrizePay count="3" pph="09" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s07" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="273" value="100"/>
            <PrizePay count="4" pph="109" value="15"/>
            <PrizePay count="3" pph="07" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s08" required="false"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="300" value="100"/>
            <PrizePay count="4" pph="120" value="15"/>
            <PrizePay count="3" pph="08" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayExpandSymbolAny">
        <Prize name="b01">
            <PrizePay count="6" pph="33" value="0"/>
            <PrizePay count="5" pph="07" value="0"/>
            <PrizePay count="4" pph="02" value="2"/>
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
        <PatternInfo max="30" min="1">
            <Step>1</Step>
            <Step>5</Step>
            <Step>9</Step>
            <Step>15</Step>
            <Step>30</Step>
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
    <GameData>
        <DoubleSymbol name="s01"/>
        <DoubleSymbol name="s02"/>
        <DoubleSymbol name="s03"/>
        <DoubleSymbol name="s04"/>
        <DoubleSymbol name="s05"/>
        <DoubleSymbol name="s10"/>
        <DoubleSymbol name="s11"/>
        <DoubleSymbol name="s12"/>
        <DoubleSymbol name="s13"/>
        <DoubleSymbol name="s14"/>
        <DoubleSymbol name="w01"/>
    </GameData>
    <DenominationList>
        <Denomination softwareId="200-1129-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>150.0</MaxBet>
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

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2010-14264054816760</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="15">
            <Cell name="L0C0R0" stripIndex="15">d01</Cell>
            <Cell name="L0C0R1" stripIndex="16">s07</Cell>
            <Cell name="L0C0R2" stripIndex="17">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="43">
            <Cell name="L0C1R0" stripIndex="43">s08</Cell>
            <Cell name="L0C1R1" stripIndex="44">b02</Cell>
            <Cell name="L0C1R2" stripIndex="45">d05</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="66">
            <Cell name="L0C2R0" stripIndex="66">d02</Cell>
            <Cell name="L0C2R1" stripIndex="67">w01</Cell>
            <Cell name="L0C2R2" stripIndex="68">s02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="31">
            <Cell name="L0C3R0" stripIndex="31">s09</Cell>
            <Cell name="L0C3R1" stripIndex="32">s01</Cell>
            <Cell name="L0C3R2" stripIndex="33">b01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="25">
            <Cell name="L0C4R0" stripIndex="25">w01</Cell>
            <Cell name="L0C4R1" stripIndex="26">s03</Cell>
            <Cell name="L0C4R2" stripIndex="27">s05</Cell>
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
            <Cell name="L0C3R2" stripIndex="39">s12</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="27">
            <Cell name="L0C4R0" stripIndex="27">d14</Cell>
            <Cell name="L0C4R1" stripIndex="28">s07</Cell>
            <Cell name="L0C4R2" stripIndex="29">d10</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>30</PatternsBet>
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

        $this->spinPays[] = $spinData['report']['spinWin'];

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

        $report = $this->slot->spin();

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