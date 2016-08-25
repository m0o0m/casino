<?
require_once('IGTCtrl.php');

class monopoly_plusCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1166-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="MONOPOLY PLUS"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="MonopolyPlus"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

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
    <PaytableStatistics description="MONOPOLY PLUS 30L 3x3x3x3x3" maxRTP="96.71" minRTP="94.00" name="MONOPOLY PLUS" type="Slot"/>
    <PrizeInfo name="PrizeInfoLines" strategy="PayLeft">
        '.$symbolPay.'
    </PrizeInfo>
    <PrizeInfo name="BoardBonus.Doubles" strategy="PayAny">
        <Prize name="1">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="1" required="true"/>
        </Prize>
        <Prize name="2">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="2" required="true"/>
        </Prize>
        <Prize name="3">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="3" required="true"/>
        </Prize>
        <Prize name="4">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="4" required="true"/>
        </Prize>
        <Prize name="5">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="5" required="true"/>
        </Prize>
        <Prize name="6">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="6" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="PropertyBonus1.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s09">
            <PrizePay count="1" pph="4" value="90"/>
            <PrizePay count="2" pph="16" value="250"/>
            <PrizePay count="3" pph="214" value="1000"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="1" pph="3" value="30"/>
            <PrizePay count="2" pph="5" value="100"/>
            <PrizePay count="3" pph="60" value="300"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonus1.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="1" pph="9" value="0"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="1" pph="19" value="0"/>
            <Symbol id="b03" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="PropertyBonus2.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s09">
            <PrizePay count="1" pph="5" value="120"/>
            <PrizePay count="2" pph="16" value="320"/>
            <PrizePay count="3" pph="84" value="1500"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="1" pph="4" value="40"/>
            <PrizePay count="2" pph="6" value="150"/>
            <PrizePay count="3" pph="25" value="400"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonus2.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="1" pph="10" value="0"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="1" pph="23" value="0"/>
            <Symbol id="b03" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="PropertyBonus3.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s09">
            <PrizePay count="1" pph="4" value="150"/>
            <PrizePay count="2" pph="19" value="400"/>
            <PrizePay count="3" pph="118" value="2000"/>
            <Symbol id="w03" required="false"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="1" pph="3" value="50"/>
            <PrizePay count="2" pph="8" value="180"/>
            <PrizePay count="3" pph="38" value="500"/>
            <Symbol id="w03" required="false"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonus3.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="1" pph="10" value="0"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="1" pph="23" value="0"/>
            <Symbol id="b03" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="MultiplyAll" name="PropertyBonus4.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s09">
            <PrizePay count="1" pph="4" value="180"/>
            <PrizePay count="2" pph="17" value="500"/>
            <PrizePay count="3" pph="119" value="3000"/>
            <Symbol id="w04" required="false"/>
            <Symbol id="s09" required="true"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="1" pph="4" value="60"/>
            <PrizePay count="2" pph="8" value="200"/>
            <PrizePay count="3" pph="47" value="600"/>
            <Symbol id="w04" required="false"/>
            <Symbol id="s10" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonus4.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="1" pph="10" value="0"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="1" pph="23" value="0"/>
            <Symbol id="b03" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonusGold.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s12">
            <PrizePay count="1" pph="5" value="240"/>
            <PrizePay count="2" pph="22" value="800"/>
            <PrizePay count="3" pph="169" value="4000"/>
            <Symbol id="w05" required="false"/>
            <Symbol id="s12" required="true"/>
        </Prize>
        <Prize name="s13">
            <PrizePay count="1" pph="4" value="80"/>
            <PrizePay count="2" pph="8" value="300"/>
            <PrizePay count="3" pph="54" value="900"/>
            <Symbol id="w05" required="false"/>
            <Symbol id="s13" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PropertyBonusGold.PrizeInfoScatter" strategy="PayAny">
        <Prize name="b02">
            <PrizePay count="1" pph="10" value="0"/>
            <Symbol id="b02" required="true"/>
        </Prize>
        <Prize name="b03">
            <PrizePay count="1" pph="19" value="0"/>
            <Symbol id="b03" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="UtilityBonus.Sums" strategy="PayLeft">
        <Prize name="7">
            <PrizePay count="1" pph="6" value="50"/>
            <Symbol id="7" required="true"/>
        </Prize>
        <Prize name="8">
            <PrizePay count="1" pph="7.2" value="100"/>
            <Symbol id="8" required="true"/>
        </Prize>
        <Prize name="9">
            <PrizePay count="1" pph="9" value="200"/>
            <Symbol id="9" required="true"/>
        </Prize>
        <Prize name="10">
            <PrizePay count="1" pph="12" value="500"/>
            <Symbol id="10" required="true"/>
        </Prize>
        <Prize name="11">
            <PrizePay count="1" pph="18" value="800"/>
            <Symbol id="11" required="true"/>
        </Prize>
        <Prize name="12">
            <PrizePay count="1" pph="36" value="1500"/>
            <Symbol id="12" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="UtilityBonus.Doubles" strategy="PayAny">
        <Prize name="1">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="1" required="true"/>
        </Prize>
        <Prize name="2">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="2" required="true"/>
        </Prize>
        <Prize name="3">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="3" required="true"/>
        </Prize>
        <Prize name="4">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="4" required="true"/>
        </Prize>
        <Prize name="5">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="5" required="true"/>
        </Prize>
        <Prize name="6">
            <PrizePay count="2" pph="36" value="0"/>
            <Symbol id="6" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="JailBonus.Doubles" strategy="PayLeft">
        <Prize name="1">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="1" required="true"/>
        </Prize>
        <Prize name="2">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="2" required="true"/>
        </Prize>
        <Prize name="3">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="3" required="true"/>
        </Prize>
        <Prize name="4">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="4" required="true"/>
        </Prize>
        <Prize name="5">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="5" required="true"/>
        </Prize>
        <Prize name="6">
            <PrizePay count="2" pph="1" value="300"/>
            <Symbol id="6" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        '.$baseReel.'
    </StripInfo>
    <StripInfo name="PropertyBonus1">
        <Strip name="Reel0">
            <Stop symbolID="s10" weight="7"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="7"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="7"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s10" weight="7"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="b02" weight="7"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="8"/>
        </Strip>
    </StripInfo>
    <StripInfo name="PropertyBonus2">
        <Strip name="Reel0">
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="w02" weight="6"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="8"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w02" weight="6"/>
            <Stop symbolID="s11" weight="3"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="w02" weight="3"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="w02" weight="3"/>
            <Stop symbolID="s11" weight="3"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s10" weight="5"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="w02" weight="5"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="s10" weight="6"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="w02" weight="5"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="b03" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="5"/>
        </Strip>
    </StripInfo>
    <StripInfo name="PropertyBonus3">
        <Strip name="Reel0">
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="w03" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="w03" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w03" weight="1"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="w03" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s10" weight="5"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="w03" weight="4"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="s10" weight="5"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="w03" weight="5"/>
            <Stop symbolID="s11" weight="9"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="b03" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="4"/>
        </Strip>
    </StripInfo>
    <StripInfo name="PropertyBonus4">
        <Strip name="Reel0">
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="w04" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="w04" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w04" weight="1"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w04" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="w04" weight="4"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="s10" weight="3"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="w04" weight="4"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="s09" weight="3"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="b03" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s10" weight="2"/>
            <Stop symbolID="s11" weight="5"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="5"/>
        </Strip>
    </StripInfo>
    <StripInfo name="PropertyBonusGold">
        <Strip name="Reel0">
            <Stop symbolID="s13" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="3"/>
            <Stop symbolID="s11" weight="3"/>
            <Stop symbolID="w05" weight="2"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s13" weight="3"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="4"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="w05" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s13" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w05" weight="1"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="s13" weight="2"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s12" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s13" weight="2"/>
            <Stop symbolID="s11" weight="2"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
            <Stop symbolID="w05" weight="2"/>
            <Stop symbolID="s11" weight="4"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s13" weight="3"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="w05" weight="4"/>
            <Stop symbolID="s11" weight="10"/>
            <Stop symbolID="b03" weight="3"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="s13" weight="4"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="w05" weight="3"/>
            <Stop symbolID="s11" weight="8"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="b03" weight="2"/>
            <Stop symbolID="s11" weight="7"/>
            <Stop symbolID="s12" weight="2"/>
            <Stop symbolID="s11" weight="6"/>
            <Stop symbolID="b02" weight="6"/>
            <Stop symbolID="s11" weight="6"/>
        </Strip>
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
        <OutcomeTrigger name="BoardBonus"/>
        <ExitOutcomeTrigger name="BoardBonus"/>
        <Triggers>
            <Trigger name="BoardBonus" picks="1"/>
        </Triggers>
    </PickerInfo>
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
    <LadderInfo name="Levels" strategy="levelUp">
        <Version>1.0</Version>
        <InputEvents>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="Picker"/>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="Go"/>
            <Event isExtraIncrement="true" ladderIncrement="5" triggerName="PropertyBonus1"/>
            <Event isExtraIncrement="true" ladderIncrement="5" triggerName="PropertyBonus2"/>
            <Event isExtraIncrement="true" ladderIncrement="10" triggerName="PropertyBonus3"/>
            <Event isExtraIncrement="true" ladderIncrement="15" triggerName="PropertyBonus4"/>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="UtilityBonus"/>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="IncomeTax"/>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="JustVisiting"/>
            <Event isExtraIncrement="false" ladderIncrement="5" triggerName="SuperTaxRelief"/>
        </InputEvents>
        <OutputEvents>
            <Event extraIncrement="0" minTriggerCount="0" triggerName="Level0"/>
            <Event extraIncrement="5" minTriggerCount="25" triggerName="Level1"/>
            <Event extraIncrement="10" minTriggerCount="75" triggerName="Level2"/>
            <Event extraIncrement="15" minTriggerCount="150" triggerName="Level3"/>
            <Event extraIncrement="20" minTriggerCount="300" triggerName="Level4"/>
            <Event extraIncrement="25" minTriggerCount="600" triggerName="Level5"/>
        </OutputEvents>
        <OutcomeTrigger name="LevelUp"/>
        <MaxCount>99999</MaxCount>
    </LadderInfo>
    <DenominationList>
        <Denomination softwareId="200-1166-001">1.0</Denomination>
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

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2310-14264037727962</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="6">
            <Cell name="L0C0R0" stripIndex="6">s01</Cell>
            <Cell name="L0C0R1" stripIndex="7">s01</Cell>
            <Cell name="L0C0R2" stripIndex="8">s08</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="56">
            <Cell name="L0C1R0" stripIndex="56">s04</Cell>
            <Cell name="L0C1R1" stripIndex="57">s03</Cell>
            <Cell name="L0C1R2" stripIndex="58">w01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="39">
            <Cell name="L0C2R0" stripIndex="39">s07</Cell>
            <Cell name="L0C2R1" stripIndex="40">s02</Cell>
            <Cell name="L0C2R2" stripIndex="41">s02</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="1">
            <Cell name="L0C3R0" stripIndex="1">s04</Cell>
            <Cell name="L0C3R1" stripIndex="2">s05</Cell>
            <Cell name="L0C3R2" stripIndex="3">s03</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="6">
            <Cell name="L0C4R0" stripIndex="6">b01</Cell>
            <Cell name="L0C4R1" stripIndex="7">s05</Cell>
            <Cell name="L0C4R2" stripIndex="8">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="PropertyBonus1.Reels" stage="PropertyBonus1">
        <Entry name="Reel0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">s11</Cell>
            <Cell name="L0C0R1" stripIndex="2">s09</Cell>
            <Cell name="L0C0R2" stripIndex="3">s11</Cell>
            <Cell name="L0C0R3" stripIndex="4">s10</Cell>
            <Cell name="L0C0R4" stripIndex="5">s11</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="1">
            <Cell name="L0C1R0" stripIndex="1">s11</Cell>
            <Cell name="L0C1R1" stripIndex="2">s09</Cell>
            <Cell name="L0C1R2" stripIndex="3">s11</Cell>
            <Cell name="L0C1R3" stripIndex="4">s10</Cell>
            <Cell name="L0C1R4" stripIndex="5">s11</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="1">
            <Cell name="L0C2R0" stripIndex="1">s11</Cell>
            <Cell name="L0C2R1" stripIndex="2">s09</Cell>
            <Cell name="L0C2R2" stripIndex="3">s11</Cell>
            <Cell name="L0C2R3" stripIndex="4">b02</Cell>
            <Cell name="L0C2R4" stripIndex="5">s11</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="PropertyBonus2.Reels" stage="PropertyBonus2">
        <Entry name="Reel0" stripIndex="9">
            <Cell name="L0C0R0" stripIndex="9">s11</Cell>
            <Cell name="L0C0R1" stripIndex="10">w02</Cell>
            <Cell name="L0C0R2" stripIndex="11">s11</Cell>
            <Cell name="L0C0R3" stripIndex="12">s10</Cell>
            <Cell name="L0C0R4" stripIndex="13">s11</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="18">
            <Cell name="L0C1R0" stripIndex="18">s09</Cell>
            <Cell name="L0C1R1" stripIndex="19">s11</Cell>
            <Cell name="L0C1R2" stripIndex="20">w02</Cell>
            <Cell name="L0C1R3" stripIndex="21">s11</Cell>
            <Cell name="L0C1R4" stripIndex="0">s10</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="3">s11</Cell>
            <Cell name="L0C2R1" stripIndex="4">b03</Cell>
            <Cell name="L0C2R2" stripIndex="5">s11</Cell>
            <Cell name="L0C2R3" stripIndex="6">s09</Cell>
            <Cell name="L0C2R4" stripIndex="7">s11</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="PropertyBonus3.Reels" stage="PropertyBonus3">
        <Entry name="Reel0" stripIndex="17">
            <Cell name="L0C0R0" stripIndex="17">s11</Cell>
            <Cell name="L0C0R1" stripIndex="18">s09</Cell>
            <Cell name="L0C0R2" stripIndex="19">s11</Cell>
            <Cell name="L0C0R3" stripIndex="20">w03</Cell>
            <Cell name="L0C0R4" stripIndex="21">s11</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s11</Cell>
            <Cell name="L0C1R1" stripIndex="10">w03</Cell>
            <Cell name="L0C1R2" stripIndex="11">s11</Cell>
            <Cell name="L0C1R3" stripIndex="12">s10</Cell>
            <Cell name="L0C1R4" stripIndex="13">s11</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="10">
            <Cell name="L0C2R0" stripIndex="10">b02</Cell>
            <Cell name="L0C2R1" stripIndex="11">s11</Cell>
            <Cell name="L0C2R2" stripIndex="12">w03</Cell>
            <Cell name="L0C2R3" stripIndex="13">s11</Cell>
            <Cell name="L0C2R4" stripIndex="14">s09</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="PropertyBonus4.Reels" stage="PropertyBonus4">
        <Entry name="Reel0" stripIndex="9">
            <Cell name="L0C0R0" stripIndex="9">s11</Cell>
            <Cell name="L0C0R1" stripIndex="10">w04</Cell>
            <Cell name="L0C0R2" stripIndex="11">s11</Cell>
            <Cell name="L0C0R3" stripIndex="12">s10</Cell>
            <Cell name="L0C0R4" stripIndex="13">s11</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="18">
            <Cell name="L0C1R0" stripIndex="18">s09</Cell>
            <Cell name="L0C1R1" stripIndex="19">s11</Cell>
            <Cell name="L0C1R2" stripIndex="20">w04</Cell>
            <Cell name="L0C1R3" stripIndex="21">s11</Cell>
            <Cell name="L0C1R4" stripIndex="0">s10</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="1">
            <Cell name="L0C2R0" stripIndex="1">s11</Cell>
            <Cell name="L0C2R1" stripIndex="2">w04</Cell>
            <Cell name="L0C2R2" stripIndex="3">s11</Cell>
            <Cell name="L0C2R3" stripIndex="4">b03</Cell>
            <Cell name="L0C2R4" stripIndex="5">s11</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="PropertyBonusGold.Reels" stage="PropertyBonusGold">
        <Entry name="Reel0" stripIndex="7">
            <Cell name="L0C0R0" stripIndex="7">s11</Cell>
            <Cell name="L0C0R1" stripIndex="8">s13</Cell>
            <Cell name="L0C0R2" stripIndex="9">s11</Cell>
            <Cell name="L0C0R3" stripIndex="10">w05</Cell>
            <Cell name="L0C0R4" stripIndex="11">s11</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="8">
            <Cell name="L0C1R0" stripIndex="8">s13</Cell>
            <Cell name="L0C1R1" stripIndex="9">s11</Cell>
            <Cell name="L0C1R2" stripIndex="10">w05</Cell>
            <Cell name="L0C1R3" stripIndex="11">s11</Cell>
            <Cell name="L0C1R4" stripIndex="12">s13</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="12">
            <Cell name="L0C2R0" stripIndex="12">w05</Cell>
            <Cell name="L0C2R1" stripIndex="13">s11</Cell>
            <Cell name="L0C2R2" stripIndex="14">s12</Cell>
            <Cell name="L0C2R3" stripIndex="15">s11</Cell>
            <Cell name="L0C2R4" stripIndex="16">b03</Cell>
        </Entry>
    </PopulationOutcome>
    <LadderOutcome name="">
        <Ladder level="Level0">0</Ladder>
    </LadderOutcome>
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
        $betPerLine = (float) $obj->BetPerPattern;

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $pick, $stake);

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