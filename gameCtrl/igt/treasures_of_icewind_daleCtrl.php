<?
require_once('IGTCtrl.php');

class treasures_of_icewind_daleCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1201-001"/>
    <param name="minbet" value="1.0"/>
    <param name="availablebalance" value="0.0"/>
    <param name="denomid" value="44"/>
    <param name="gametitle" value="DUNGEONS &amp; DRAGONS Treasures of Icewind Dale"/>
    <param name="terminalid" value=""/>
    <param name="ipaddress" value="31.131.103.75"/>
    <param name="affiliate" value=""/>
    <param name="gameWindowHeight" value="815"/>
    <param name="gameWindowWidth" value="1024"/>
    <param name="nsbuyin" value=""/>
    <param name="nscashout" value=""/>
    <param name="cashiertype" value="N"/>
    <param name="game" value="TreasuresOfIcewindDale"/>
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

        $baseReel1 = $this->getReelXml($this->gameParams->reels[0]);
        $baseReel2 = $this->getReelXml($this->gameParams->reels[1]);
        $freeReel1 = $this->getReelXml($this->gameParams->reels[2]);
        $freeReel2 = $this->getReelXml($this->gameParams->reels[3]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="TreasuresOfIcewindDale 40L 3x3x3x3x3" gameOnlyRTP="" jackpotPPH="" maxRTP="96.52" minRTP="93.06" name="Dungeons and Dragons Treasures of Icewind Dale" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="payLeft">
        <Prize name="s01">
            <PrizePay count="5" pph="8035" value="500"/>
            <PrizePay count="4" pph="771" value="75"/>
            <PrizePay count="3" pph="72" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s01" required="true"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="7291" value="250"/>
            <PrizePay count="4" pph="487" value="50"/>
            <PrizePay count="3" pph="62" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s02" required="true"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="1421" value="100"/>
            <PrizePay count="4" pph="137" value="30"/>
            <PrizePay count="3" pph="17" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s03" required="true"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="1367" value="75"/>
            <PrizePay count="4" pph="174" value="25"/>
            <PrizePay count="3" pph="21" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s04" required="true"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="1688" value="30"/>
            <PrizePay count="4" pph="214" value="15"/>
            <PrizePay count="3" pph="29" value="2"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s05" required="true"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="2734" value="25"/>
            <PrizePay count="4" pph="304" value="10"/>
            <PrizePay count="3" pph="37" value="1"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s06" required="true"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="1119" value="25"/>
            <PrizePay count="4" pph="160" value="10"/>
            <PrizePay count="3" pph="19" value="1"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s07" required="true"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="2148" value="25"/>
            <PrizePay count="4" pph="206" value="10"/>
            <PrizePay count="3" pph="23" value="1"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s08" required="true"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="1236" value="25"/>
            <PrizePay count="4" pph="138" value="10"/>
            <PrizePay count="3" pph="15" value="1"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="w02" required="false"/>
            <Symbol id="s09" required="true"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoScatter" strategy="payAny">
        <Prize name="b01">
            <PrizePay count="3" pph="124" value="3"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BSet0">
        <Strip name="Reel0">
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s02" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s06" weight="103"/>
            <Stop symbolID="s06" weight="103"/>
            <Stop symbolID="s06" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s08" weight="103"/>
            <Stop symbolID="s08" weight="103"/>
            <Stop symbolID="s02" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="r01" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s01" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s09" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s07" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s01" weight="103"/>
            <Stop symbolID="s08" weight="103"/>
            <Stop symbolID="s08" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s02" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s03" weight="103"/>
            <Stop symbolID="s01" weight="103"/>
            <Stop symbolID="s05" weight="103"/>
            <Stop symbolID="s04" weight="103"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="s07" weight="123"/>
            <Stop symbolID="s07" weight="123"/>
            <Stop symbolID="s01" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="s05" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s01" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s07" weight="123"/>
            <Stop symbolID="s07" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s05" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s01" weight="123"/>
            <Stop symbolID="s05" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="r02" weight="123"/>
            <Stop symbolID="s05" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s04" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s08" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="s03" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s07" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="w01" weight="123"/>
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s09" weight="123"/>
            <Stop symbolID="s02" weight="123"/>
            <Stop symbolID="b01" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
            <Stop symbolID="s06" weight="123"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s05" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="r03" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s05" weight="117"/>
            <Stop symbolID="s01" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s05" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="w01" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="s02" weight="117"/>
            <Stop symbolID="s05" weight="117"/>
            <Stop symbolID="w01" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="s04" weight="117"/>
            <Stop symbolID="s04" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s02" weight="117"/>
            <Stop symbolID="s02" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="s02" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s05" weight="117"/>
            <Stop symbolID="s09" weight="117"/>
            <Stop symbolID="w01" weight="117"/>
            <Stop symbolID="w01" weight="117"/>
            <Stop symbolID="w01" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
            <Stop symbolID="s04" weight="117"/>
            <Stop symbolID="s04" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="s01" weight="117"/>
            <Stop symbolID="s01" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s07" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="b01" weight="117"/>
            <Stop symbolID="s08" weight="117"/>
            <Stop symbolID="s01" weight="117"/>
            <Stop symbolID="s04" weight="117"/>
            <Stop symbolID="s03" weight="117"/>
            <Stop symbolID="s01" weight="117"/>
            <Stop symbolID="s06" weight="117"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="b01" weight="110"/>
            <Stop symbolID="s09" weight="110"/>
            <Stop symbolID="s09" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="b01" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s01" weight="110"/>
            <Stop symbolID="w01" weight="110"/>
            <Stop symbolID="w01" weight="110"/>
            <Stop symbolID="w01" weight="110"/>
            <Stop symbolID="s08" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="s07" weight="110"/>
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s01" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="r04" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s01" weight="110"/>
            <Stop symbolID="s01" weight="110"/>
            <Stop symbolID="s08" weight="110"/>
            <Stop symbolID="b01" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s09" weight="110"/>
            <Stop symbolID="s09" weight="110"/>
            <Stop symbolID="s09" weight="110"/>
            <Stop symbolID="b01" weight="110"/>
            <Stop symbolID="s08" weight="110"/>
            <Stop symbolID="s02" weight="110"/>
            <Stop symbolID="s05" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s03" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s08" weight="110"/>
            <Stop symbolID="s08" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s06" weight="110"/>
            <Stop symbolID="s04" weight="110"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="r05" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s02" weight="112"/>
            <Stop symbolID="s02" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s02" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s02" weight="112"/>
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s09" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s06" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s01" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="w01" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s03" weight="112"/>
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s08" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
            <Stop symbolID="s05" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s07" weight="112"/>
            <Stop symbolID="s04" weight="112"/>
        </Strip>
    </StripInfo>
    <StripInfo name="BSet1">
        <Strip name="Reel0">
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s02" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s08" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s06" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s08" weight="71"/>
            <Stop symbolID="s02" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="r01" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s01" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s09" weight="71"/>
            <Stop symbolID="s01" weight="71"/>
            <Stop symbolID="s08" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s06" weight="71"/>
            <Stop symbolID="s02" weight="71"/>
            <Stop symbolID="s05" weight="71"/>
            <Stop symbolID="s04" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
            <Stop symbolID="s03" weight="71"/>
            <Stop symbolID="s08" weight="71"/>
            <Stop symbolID="s01" weight="71"/>
            <Stop symbolID="s06" weight="71"/>
            <Stop symbolID="s07" weight="71"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s07" weight="89"/>
            <Stop symbolID="s01" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s07" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s05" weight="89"/>
            <Stop symbolID="s01" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s05" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s07" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="s07" weight="89"/>
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="s01" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="r02" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s05" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="s05" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s04" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s03" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s07" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="w01" weight="89"/>
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s09" weight="89"/>
            <Stop symbolID="s02" weight="89"/>
            <Stop symbolID="b01" weight="89"/>
            <Stop symbolID="s08" weight="89"/>
            <Stop symbolID="s06" weight="89"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="r03" weight="83"/>
            <Stop symbolID="s05" weight="83"/>
            <Stop symbolID="s01" weight="83"/>
            <Stop symbolID="s01" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="s05" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s05" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="s05" weight="83"/>
            <Stop symbolID="s02" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="s04" weight="83"/>
            <Stop symbolID="s04" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="s02" weight="83"/>
            <Stop symbolID="s02" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="s02" weight="83"/>
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="s05" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="w01" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="s09" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="s04" weight="83"/>
            <Stop symbolID="s04" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="s01" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="s01" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="s04" weight="83"/>
            <Stop symbolID="b01" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
            <Stop symbolID="s01" weight="83"/>
            <Stop symbolID="s08" weight="83"/>
            <Stop symbolID="s03" weight="83"/>
            <Stop symbolID="s07" weight="83"/>
            <Stop symbolID="s06" weight="83"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s06" weight="76"/>
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s07" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s09" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s07" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s08" weight="76"/>
            <Stop symbolID="s01" weight="76"/>
            <Stop symbolID="s07" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s01" weight="76"/>
            <Stop symbolID="w01" weight="76"/>
            <Stop symbolID="w01" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s08" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s07" weight="76"/>
            <Stop symbolID="s09" weight="76"/>
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s07" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="r04" weight="76"/>
            <Stop symbolID="s01" weight="76"/>
            <Stop symbolID="w01" weight="76"/>
            <Stop symbolID="w01" weight="76"/>
            <Stop symbolID="w01" weight="76"/>
            <Stop symbolID="s08" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s06" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s09" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s08" weight="76"/>
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s06" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s09" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s05" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s04" weight="76"/>
            <Stop symbolID="s06" weight="76"/>
            <Stop symbolID="b01" weight="76"/>
            <Stop symbolID="s02" weight="76"/>
            <Stop symbolID="s08" weight="76"/>
            <Stop symbolID="s03" weight="76"/>
            <Stop symbolID="s06" weight="76"/>
            <Stop symbolID="s01" weight="76"/>
            <Stop symbolID="s09" weight="76"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="r05" weight="80"/>
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s02" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s02" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s02" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s02" weight="80"/>
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s09" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s01" weight="80"/>
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s06" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="w01" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s08" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
            <Stop symbolID="s05" weight="80"/>
            <Stop symbolID="s03" weight="80"/>
            <Stop symbolID="s07" weight="80"/>
            <Stop symbolID="s04" weight="80"/>
        </Strip>
    </StripInfo>
    <StripInfo name="FSet0">
        <Strip name="Reel0">
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="r01" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s01" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s05" weight="127"/>
            <Stop symbolID="s02" weight="127"/>
            <Stop symbolID="s06" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s08" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
            <Stop symbolID="s04" weight="127"/>
            <Stop symbolID="s09" weight="127"/>
            <Stop symbolID="s03" weight="127"/>
            <Stop symbolID="s07" weight="127"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="r02" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="r03" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="b01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s09" weight="155"/>
            <Stop symbolID="s03" weight="155"/>
            <Stop symbolID="s05" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s02" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="s08" weight="155"/>
            <Stop symbolID="s04" weight="155"/>
            <Stop symbolID="s07" weight="155"/>
            <Stop symbolID="s01" weight="155"/>
            <Stop symbolID="s06" weight="155"/>
            <Stop symbolID="w01" weight="155"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="w01" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="r04" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s01" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s01" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s01" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s01" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="w01" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="w01" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="w01" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s03" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="b01" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s06" weight="145"/>
            <Stop symbolID="s04" weight="145"/>
            <Stop symbolID="s07" weight="145"/>
            <Stop symbolID="s09" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
            <Stop symbolID="s05" weight="145"/>
            <Stop symbolID="s08" weight="145"/>
            <Stop symbolID="s02" weight="145"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s01" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s01" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="r05" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s01" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s01" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s01" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s02" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s02" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s02" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s07" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="w01" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="w02" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
            <Stop symbolID="s06" weight="118"/>
            <Stop symbolID="s08" weight="118"/>
            <Stop symbolID="s03" weight="118"/>
            <Stop symbolID="s05" weight="118"/>
            <Stop symbolID="s09" weight="118"/>
            <Stop symbolID="s04" weight="118"/>
        </Strip>
    </StripInfo>
    <StripInfo name="FSet1">
        <Strip name="Reel0">
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="r01" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s01" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s05" weight="107"/>
            <Stop symbolID="s02" weight="107"/>
            <Stop symbolID="s06" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s08" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
            <Stop symbolID="s04" weight="107"/>
            <Stop symbolID="s09" weight="107"/>
            <Stop symbolID="s03" weight="107"/>
            <Stop symbolID="s07" weight="107"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="r02" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s09" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s04" weight="113"/>
            <Stop symbolID="s06" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="b01" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s01" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s08" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="w01" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s02" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
            <Stop symbolID="s03" weight="113"/>
            <Stop symbolID="s07" weight="113"/>
            <Stop symbolID="s05" weight="113"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="r03" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="b01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s09" weight="134"/>
            <Stop symbolID="s03" weight="134"/>
            <Stop symbolID="s05" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s02" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="s08" weight="134"/>
            <Stop symbolID="s04" weight="134"/>
            <Stop symbolID="s07" weight="134"/>
            <Stop symbolID="s01" weight="134"/>
            <Stop symbolID="s06" weight="134"/>
            <Stop symbolID="w01" weight="134"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="w01" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="r04" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s01" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s01" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s01" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s01" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="w01" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="w01" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="w01" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s03" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="b01" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s06" weight="125"/>
            <Stop symbolID="s04" weight="125"/>
            <Stop symbolID="s07" weight="125"/>
            <Stop symbolID="s09" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
            <Stop symbolID="s05" weight="125"/>
            <Stop symbolID="s08" weight="125"/>
            <Stop symbolID="s02" weight="125"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s01" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s01" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="r05" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s01" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s01" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s01" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s02" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s02" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s02" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s07" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="w01" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
            <Stop symbolID="s06" weight="94"/>
            <Stop symbolID="w02" weight="94"/>
            <Stop symbolID="s08" weight="94"/>
            <Stop symbolID="s03" weight="94"/>
            <Stop symbolID="s05" weight="94"/>
            <Stop symbolID="s09" weight="94"/>
            <Stop symbolID="s04" weight="94"/>
        </Strip>
    </StripInfo>
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy>highestOnly</Strategy>
            <MaxFreeSpins>225</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="15" name="3 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>constantDecrement</Strategy>
            <Count>1</Count>
        </Decrement>
        <OutcomeTrigger name="freeSpin"/>
    </FreeSpinInfo>
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
    <SelectiveStackingBetIncrements name="SelectiveStackingValues">
        <Value>1</Value>
        <Value>2</Value>
        <Value>3</Value>
        <Value>5</Value>
        <Value>10</Value>
        <Value>20</Value>
        <Value>30</Value>
        <Value>50</Value>
        <Value>100</Value>
        <Value>200</Value>
        <Value>300</Value>
        <Value>500</Value>
        <Value>1000</Value>
        <Value>2000</Value>
        <Value>3000</Value>
    </SelectiveStackingBetIncrements>
    <DenominationList>
        <Denomination softwareId="200-1201-001">1.0</Denomination>
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

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2210-14264043390203</TransactionId>
        <Stage>'.$state.'</Stage>
        <NextStage>'.$state.'</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="19">
            <Cell name="L0C0R0" stripIndex="19">s03</Cell>
            <Cell name="L0C0R1" stripIndex="20">s03</Cell>
            <Cell name="L0C0R2" stripIndex="21">s09</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="12">
            <Cell name="L0C1R0" stripIndex="12">s08</Cell>
            <Cell name="L0C1R1" stripIndex="13">s03</Cell>
            <Cell name="L0C1R2" stripIndex="14">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="65">
            <Cell name="L0C2R0" stripIndex="65">b01</Cell>
            <Cell name="L0C2R1" stripIndex="66">s08</Cell>
            <Cell name="L0C2R2" stripIndex="67">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="11">
            <Cell name="L0C3R0" stripIndex="11">s03</Cell>
            <Cell name="L0C3R1" stripIndex="12">s03</Cell>
            <Cell name="L0C3R2" stripIndex="13">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="46">
            <Cell name="L0C4R0" stripIndex="46">s07</Cell>
            <Cell name="L0C4R1" stripIndex="47">s07</Cell>
            <Cell name="L0C4R2" stripIndex="48">s02</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome><Data>7d625d41454150405b595a7f414750565d571050344040545e5972515e5a7d5e50564b04120212132f535f540d0f73554153735159561d6b55575c602446100f3a240d715c424649145d5254550f126124575e625559131441424659447a5d5d554a0d1171100c3b39240d77575a58105a525e5c0d107c0302026001120d4240405f44795a5756410d1000117f706154441d1d76615340001871605c44021c71125746011c6f625146061872675647091c70635635021e73634845041e74675540031f7b635744036d706154441d1d76615340001871605c44021c71125746011c6f62514606081f77565f550e38390f6e775c4542540f3e0e19645f44465f58445b5f5d0e4746525f40540a38</Data></ObfuscatedOutcome><ObfuscatedOutcome><Data>7d625d41454150405b595a7f414750565d571050344040545e5972515e5a7d5e50564b04120212132f535f540d0f73554153735159561d6a535a555e2061574512133b3d0e735a44464a1357515f550e63615159554050675742161047474150407b5e57244a0f13000f0f3e3b3f0873515f5f195e535d567c107e01731d630410164744465a43705e56554b7c1002130e1e0207010518030700000a1c01030072011e02031e02071e05070307001f0a030103006d010102031e1d07010507031800000a03011c00720101021c1e0207010518030700000a1c01030072011e02031e02071e05070307000f1673575c5f7f383b0d1f685f40404f0a3a081c635640475c52355b5d5f7f5845575d5b510e3e</Data></ObfuscatedOutcome>
    <PopulationOutcome name="BaseGame.CurrentReelSet" stage="BaseGame">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">BSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.InitialReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.InitialReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
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

        if($_SESSION['state'] == 'FREE') {

            $wu = '<TriggerOutcome component="" name="FreeSpin.TrailTrigger" stage="">
        <Trigger name="1 w02" priority="0" stageConnector="" />
    </TriggerOutcome>

    <TriggerOutcome component="" name="FreeSpin.Trail" stage="">';
            if($_SESSION['wildLevel'] > 2) {
                $wu .= '<Trigger name="s01" priority="0" stageConnector="" />';
            }
            if($_SESSION['wildLevel'] > 5) {
                $wu .= '<Trigger name="s02" priority="0" stageConnector="" />';
            }
            if($_SESSION['wildLevel'] > 8) {
                $wu .= '<Trigger name="s03" priority="0" stageConnector="" />';
            }
            if($_SESSION['wildLevel'] > 11) {
                $wu .= '<Trigger name="s04" priority="0" stageConnector="" />';
            }
            $wu .= '</TriggerOutcome>';

            $wu .= '<HighlightOutcome name="FreeSpin.Trail" type="">
        <Highlight name="FreeSpin.Trail" type="">';
            if($_SESSION['wildLevel'] > 0) {
                for($i = 0; $i < $_SESSION['wildLevel']; $i++) {
                    $wu .= '<Cell name="L0C'.$i.'R0" type="" />';
                }
            }
            $wu .= '</Highlight>
    </HighlightOutcome>';

            $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));
            $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));

            $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0240-14353243054760</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>30</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$baseScatter.'
    <WagerOutcome amount="30" name="BaseGame.Scatter" payout="0" pending="0" settled="0" stage="BaseGame" type="Pattern">
        <Wager amount="30" name="Scatter" payout="0" pending="0" settled="0" />
    </WagerOutcome>
    <WagerOutcome amount="30" name="BaseGame.Lines" payout="0" pending="30" settled="0" stage="BaseGame" type="Pattern">
        <Wager amount="1" name="Line 1" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 2" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 3" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 4" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 5" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 6" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 7" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 8" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 9" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 10" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 11" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 12" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 13" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 14" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 15" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 16" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 17" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 18" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 19" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 20" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 21" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 22" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 23" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 24" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 25" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 26" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 27" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 28" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 29" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 30" payout="0" pending="1" settled="0" />
    </WagerOutcome>
    <WagerOutcome amount="30" name="Game.Total" payout="0" pending="30" settled="0" stage="" type="">
        <Wager amount="30" name="Total" payout="0" pending="30" settled="0" />
    </WagerOutcome>
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    '.$wu.'
    <FreeSpinOutcome name="">
        <InitAwarded>15</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalAwarded'].'</TotalAwarded>
        <Count>'.$_SESSION['fsPlayed'].'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PopulationOutcome name="FreeSpin.InitialReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f7746565060425d5d1e66575f535d3363574012133b3d0f705d46464a105b555a530d70764051557e415d5d66505a515e5166514314102144405d40645f50564d0e1006110e3f3d3e0a73375c5e145e4c5c510e177f0277036205161745442059427d5e49544c0e1701100a00030607041a03610301071c1e020700061f01070003061804050361031e07031e02071f06000107001c06070405037e030107031e1d07000600011800030607041a03610301071c1e020700061f01070003061804050361030e1b73485d580d3f3a0e1b765e41464e083a6e1f625b40585d55475c5c5c7b4644565b5a530e58</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.InitialReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f73554050745359561e66575f535d3363574012133b3d0f705d46464a105b555a530d7063515c55405067564111124747425c447e585437480f16000f0f3e3a3c0f71515f5c155a565b556f127e04731d630411154046465a407c5a5353486f1202160e15090c0b0d1f01070003061804050361031e07031e02071f06000107001c06070405037e030107031e1d07000600011800030607041a03610301071c1e020700061f01070003061804050361031e07031e02071f06000107000c1a77525a5c6c3a3b081f685f40414c0d38081c605a44425a5126595d5a7f5845575c58560c3e</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.CurrentReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.ReelSet" stage="FreeSpin">
        <Entry name="FreeSpinReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    '.$baseReels.'
    <PopulationOutcome name="BaseGame.CurrentReelSet" stage="BaseGame">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">BSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="BaseGame.CurrentSchemaSplit" stage="BaseGame">
        <Entry name="SchemaReel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel4" stripIndex="0">
            <Cell name="L0C4R0" stripIndex="0">s09</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f73554050745359561e6751525a633744100a3a240d715d41414b145d5158510a146237555e67555913144041415b447a5e51514f0b1262120c3e39240d7756595f125a525d5009157a0011006004120d4240415c437b5a57554d091506126c726151441d1d76605047021871635040071a72015546041c6f625147051f70675644051875655526001e76634845041f77605740031c77675242007e726151441d1d76605047021871635040071a72015546041c6f625147050f1d77565c590a3d3f0c7d755c4042540f3e0f1a635d44465c54405e595e1d4546575f40540a39</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$_SESSION['fsTotalWin'].'" stage="" totalPay="'.$_SESSION['fsTotalWin'].'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$_SESSION['fsTotalWin'].'" payName="" symbolCount="0" totalPay="'.$_SESSION['fsTotalWin'].'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R0240-14353243054728</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.$coinValue.'</BetPerPattern>
        <PatternsBet>'.$patternsBet.'</PatternsBet>
    </PatternSliderInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';
        }

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
        $this->slot->createCustomReels($this->gameParams->reels[2], array(3,3,3,3,3));

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

        $bonus = array(
            'type' => 'randomReplace',
            'symbols' => array(61,62,63,64,65),
            'replacement' => array(1,2,3,4,5,6,7,8,9),
        );

        if($_SESSION['state'] == 'FREE') {
            $bonus = array(
                array(
                    'type' => 'randomReplace',
                    'symbols' => array(61,62,63,64,65),
                    'replacement' => array(1,2,3,4),
                ),
                array(
                    'type' => 'KittyWaterBonus',
                ),
            );
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['bet'] * 3;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        if($_SESSION['state'] == 'FREE') {
            $r = $this->slot->getSymbolAnyCount('w02');
            if($r['count'] > 0) {
                $report['wildUp'] = true;
            }
            else {
                $report['wildUp'] = false;
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
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);
        $display = $this->getDisplay($report);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R0240-14353243054760</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$_SESSION['startBalance'].'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <TriggerOutcome component="" name="BetIncrement" stage="">
        <Trigger name="betIncrement0" priority="0" stageConnector="" />
    </TriggerOutcome>
    '.$scattersHighlight.$highlight.'
    <WagerOutcome amount="30" name="BaseGame.Scatter" payout="0" pending="0" settled="0" stage="BaseGame" type="Pattern">
        <Wager amount="30" name="Scatter" payout="0" pending="0" settled="0" />
    </WagerOutcome>
    <WagerOutcome amount="30" name="BaseGame.Lines" payout="0" pending="30" settled="0" stage="BaseGame" type="Pattern">
        <Wager amount="1" name="Line 1" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 2" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 3" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 4" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 5" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 6" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 7" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 8" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 9" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 10" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 11" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 12" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 13" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 14" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 15" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 16" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 17" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 18" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 19" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 20" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 21" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 22" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 23" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 24" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 25" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 26" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 27" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 28" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 29" payout="0" pending="1" settled="0" />
        <Wager amount="1" name="Line 30" payout="0" pending="1" settled="0" />
    </WagerOutcome>
    <WagerOutcome amount="30" name="Game.Total" payout="0" pending="30" settled="0" stage="" type="">
        <Wager amount="30" name="Total" payout="0" pending="30" settled="0" />
    </WagerOutcome>
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>15</InitAwarded>
        <Awarded>15</Awarded>
        <TotalAwarded>15</TotalAwarded>
        <Count>0</Count>
        <Countdown>15</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PopulationOutcome name="FreeSpin.InitialReels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f7746565060425d5d1e66575f535d3363574012133b3d0f705d46464a105b555a530d70764051557e415d5d66505a515e5166514314102144405d40645f50564d0e1006110e3f3d3e0a73375c5e145e4c5c510e177f0277036205161745442059427d5e49544c0e1701100a00030607041a03610301071c1e020700061f01070003061804050361031e07031e02071f06000107001c06070405037e030107031e1d07000600011800030607041a03610301071c1e020700061f01070003061804050361030e1b73485d580d3f3a0e1b765e41464e083a6e1f625b40585d55475c5c5c7b4644565b5a530e58</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.InitialReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f73554050745359561e66575f535d3363574012133b3d0f705d46464a105b555a530d7063515c55405067564111124747425c447e585437480f16000f0f3e3a3c0f71515f5c155a565b556f127e04731d630411154046465a407c5a5353486f1202160e15090c0b0d1f01070003061804050361031e07031e02071f06000107001c06070405037e030107031e1d07000600011800030607041a03610301071c1e020700061f01070003061804050361031e07031e02071f06000107000c1a77525a5c6c3a3b081f685f40414c0d38081c605a44425a5126595d5a7f5845575c58560c3e</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.CurrentReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.ReelSet" stage="FreeSpin">
        <Entry name="FreeSpinReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display.'
    <PopulationOutcome name="BaseGame.CurrentReelSet" stage="BaseGame">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">BSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="BaseGame.CurrentSchemaSplit" stage="BaseGame">
        <Entry name="SchemaReel0" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel1" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel3" stripIndex="0">
            <Cell name="L0C3R0" stripIndex="0">s09</Cell>
        </Entry>
        <Entry name="SchemaReel4" stripIndex="0">
            <Cell name="L0C4R0" stripIndex="0">s09</Cell>
        </Entry>
    </PopulationOutcome>
    <ObfuscatedOutcome>
        <Data>6e605d44454150405a5a5d7d4147535a59521653274240515e5972515f597a5c50564808160714103c515f510d0f73554050745359561e6751525a633744100a3a240d715d41414b145d5158510a146237555e67555913144041415b447a5e51514f0b1262120c3e39240d7756595f125a525d5009157a0011006004120d4240415c437b5a57554d091506126c726151441d1d76605047021871635040071a72015546041c6f625147051f70675644051875655526001e76634845041f77605740031c77675242007e726151441d1d76605047021871635040071a72015546041c6f625147050f1d77565c590a3d3f0c7d755c4042540f3e0f1a635d44465c54405e595e1d4546575f40540a39</Data>
    </ObfuscatedOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="3">s02</Cell>
            <Cell name="L0C0R1" stripIndex="4">s05</Cell>
            <Cell name="L0C0R2" stripIndex="5">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="9">
            <Cell name="L0C1R0" stripIndex="9">s01</Cell>
            <Cell name="L0C1R1" stripIndex="10">s01</Cell>
            <Cell name="L0C1R2" stripIndex="11">s06</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="0">
            <Cell name="L0C2R0" stripIndex="0">s05</Cell>
            <Cell name="L0C2R1" stripIndex="1">b01</Cell>
            <Cell name="L0C2R2" stripIndex="2">s06</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="48">
            <Cell name="L0C3R0" stripIndex="48">s01</Cell>
            <Cell name="L0C3R1" stripIndex="49">s09</Cell>
            <Cell name="L0C3R2" stripIndex="50">s07</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="40">
            <Cell name="L0C4R0" stripIndex="40">s08</Cell>
            <Cell name="L0C4R1" stripIndex="41">s01</Cell>
            <Cell name="L0C4R2" stripIndex="42">s05</Cell>
        </Entry>
    </PopulationOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$report['scattersReport']['totalWin'].'" stage="" totalPay="'.$report['scattersReport']['totalWin'].'" type="Pattern">
        <Prize betMultiplier="30" multiplier="1" name="Scatter" pay="3" payName="3 b01" symbolCount="3" totalPay="'.$report['scattersReport']['totalWin'].'" ways="0" />
    </PrizeOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>R0240-14353243054728</TransactionId>
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
        $_SESSION['totalAwarded'] = 15;
        $_SESSION['fsLeft'] = 15;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['wildLevel'] = 0;
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
            $_SESSION['totalAwarded'] += 15;
            $_SESSION['fsLeft'] += 15;
            $awarded = 15;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter');
        }

        $m = $this->slot->getSymbolAnyCount('w02');

        if($_SESSION['wildLevel'] > 12) {
            $_SESSION['wildLevel'] = 12;
        }


        $wu = '<TriggerOutcome component="" name="FreeSpin.TrailTrigger" stage="">
        <Trigger name="1 w02" priority="0" stageConnector="" />
    </TriggerOutcome>

    <TriggerOutcome component="" name="FreeSpin.Trail" stage="">';
        if($_SESSION['wildLevel'] > 2) {
            $wu .= '<Trigger name="s01" priority="0" stageConnector="" />';
        }
        if($_SESSION['wildLevel'] > 5) {
            $wu .= '<Trigger name="s02" priority="0" stageConnector="" />';
        }
        if($_SESSION['wildLevel'] > 8) {
            $wu .= '<Trigger name="s03" priority="0" stageConnector="" />';
        }
        if($_SESSION['wildLevel'] > 11) {
            $wu .= '<Trigger name="s04" priority="0" stageConnector="" />';
        }
        $wu .= '</TriggerOutcome>';

        $wu .= '<HighlightOutcome name="FreeSpin.Trail" type="">
        <Highlight name="FreeSpin.Trail" type="">';
        if($_SESSION['wildLevel'] > 0) {
            for($i = 0; $i < $_SESSION['wildLevel']; $i++) {
                $wu .= '<Cell name="L0C'.$i.'R0" type="" />';
            }
        }
        $wu .= '</Highlight>
    </HighlightOutcome>';
        if($report['wildUp']) {
            $offsets = $m['offsets'][0];
            $r = floor($offsets / 5);

            $wu .= '<HighlightOutcome name="FreeSpin.TrailTrigger" type="">
        <Highlight name="FreeSpin.TrailTrigger" type="">
            <Cell name="L0C4R'.$r.'" type="" />
        </Highlight>
    </HighlightOutcome>';


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
    '.$highlight.$wu.'
    '.$scattersHighlight.'
    '.$display.$baseReels.'
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
    <PopulationOutcome name="FreeSpin.CurrentReelSet" stage="FreeSpin">
        <Entry name="ReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.ReelSet" stage="FreeSpin">
        <Entry name="FreeSpinReelSet" stripIndex="0">
            <Cell name="L0C0R0" stripIndex="0">FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0,FSet0</Cell>
        </Entry>
    </PopulationOutcome>
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
            unset($_SESSION['wildLevel']);
            unset($_SESSION['baseWinLinesWin']);
        }
    }

}
