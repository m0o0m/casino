<?
require_once('IGTCtrl.php');

class star_trek_against_all_oddsCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $xml = '<params><param name="softwareid" value="200-1170-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Star Trek Against All Odds"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="StarTrekAgainstAllOdds"/><param name="studio" value="interactive"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="'.$this->gameParams->curiso.'"/></params>';

        $this->outXML($xml);
    }

    protected function startPaytable($request) {
        $symbolPay = $this->getSymbolPay();

        $baseReel = $this->getReelXml($this->gameParams->reels[0]);
        $denomination = $this->gameParams->denominations;

        $betPattern = $this->getBetPattern();
        $selective = $this->getSelective();

        $xml = '<PaytableResponse>
    <PaytableStatistics description="Star Trek Against All Odds - 720 Multiway 3x4x5x4x3" maxRTP="95" minRTP="92.51" name="Star Trek Against All Odds" type="Slot"/>
    <PrizeInfo name="PrizeInfoLeftRightBaseGame" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="3004" value="1000"/>
            <PrizePay count="4" pph="515" value="150"/>
            <PrizePay count="3" pph="88" value="50"/>
            <Symbol id="s01" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="391" value="500"/>
            <PrizePay count="4" pph="88" value="75"/>
            <PrizePay count="3" pph="23" value="25"/>
            <Symbol id="s02" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="359" value="300"/>
            <PrizePay count="4" pph="28" value="50"/>
            <PrizePay count="3" pph="42" value="20"/>
            <Symbol id="s03" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="86" value="125"/>
            <PrizePay count="4" pph="13" value="30"/>
            <PrizePay count="3" pph="18" value="15"/>
            <Symbol id="s04" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="71" value="100"/>
            <PrizePay count="4" pph="117" value="25"/>
            <PrizePay count="3" pph="42" value="10"/>
            <Symbol id="s05" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="97" value="100"/>
            <PrizePay count="4" pph="128" value="20"/>
            <PrizePay count="3" pph="142" value="5"/>
            <Symbol id="s06" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="131" value="100"/>
            <PrizePay count="4" pph="16" value="20"/>
            <PrizePay count="3" pph="12" value="5"/>
            <Symbol id="s07" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="153" value="100"/>
            <PrizePay count="4" pph="289" value="20"/>
            <PrizePay count="3" pph="36" value="5"/>
            <Symbol id="s08" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoRightLeftBaseGame" strategy="PayMultiWayRightLeft">
        <Prize name="s01">
            <PrizePay count="5" doNotGeneratePrize="true" value="1000"/>
            <PrizePay count="4" pph="515" value="150"/>
            <PrizePay count="3" pph="88" value="50"/>
            <Symbol id="s01" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" doNotGeneratePrize="true" value="500"/>
            <PrizePay count="4" pph="88" value="75"/>
            <PrizePay count="3" pph="23" value="25"/>
            <Symbol id="s02" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" doNotGeneratePrize="true" value="300"/>
            <PrizePay count="4" pph="28" value="50"/>
            <PrizePay count="3" pph="42" value="20"/>
            <Symbol id="s03" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" doNotGeneratePrize="true" value="125"/>
            <PrizePay count="4" pph="13" value="30"/>
            <PrizePay count="3" pph="18" value="15"/>
            <Symbol id="s04" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" doNotGeneratePrize="true" value="100"/>
            <PrizePay count="4" pph="117" value="25"/>
            <PrizePay count="3" pph="42" value="10"/>
            <Symbol id="s05" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" doNotGeneratePrize="true" value="100"/>
            <PrizePay count="4" pph="128" value="20"/>
            <PrizePay count="3" pph="142" value="5"/>
            <Symbol id="s06" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" doNotGeneratePrize="true" value="100"/>
            <PrizePay count="4" pph="16" value="20"/>
            <PrizePay count="3" pph="12" value="5"/>
            <Symbol id="s07" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" doNotGeneratePrize="true" value="100"/>
            <PrizePay count="4" pph="289" value="20"/>
            <PrizePay count="3" pph="36" value="5"/>
            <Symbol id="s08" required="false"/>
            <Symbol id="w01" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatterBaseGame" strategy="PayScatter">
        <Prize name="s09">
            <PrizePay count="5" pph="33998" value="100"/>
            <PrizePay count="4" pph="952" value="20"/>
            <PrizePay count="3" pph="67" value="3"/>
            <Symbol id="s09" required="true"/>
            <ValidPattern name="Scatter1"/>
        </Prize>
        <Prize name="b01">
            <PrizePay count="5" pph="137" value="0"/>
            <Symbol id="b01" required="true"/>
            <ValidPattern name="Scatter2"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="Wheel2SymbolCollectPrizeInfo" strategy="PayTrigger">
        <Prize name="LI3PrizeCollect6">
            <PrizePay count="1" value="6000"/>
        </Prize>
        <Prize name="LI3PrizeCollect5">
            <PrizePay count="1" value="3500"/>
        </Prize>
        <Prize name="LI3PrizeCollect4">
            <PrizePay count="1" value="2000"/>
        </Prize>
        <Prize name="LI3PrizeCollect3">
            <PrizePay count="1" value="1200"/>
        </Prize>
        <Prize name="LI3PrizeCollect2">
            <PrizePay count="1" value="800"/>
        </Prize>
        <Prize name="LI3PrizeCollect1">
            <PrizePay count="1" value="400"/>
        </Prize>
        <Prize name="CO2PrizeCollect8">
            <PrizePay count="1" value="12000"/>
        </Prize>
        <Prize name="CO2PrizeCollect7">
            <PrizePay count="1" value="8000"/>
        </Prize>
        <Prize name="CO2PrizeCollect6">
            <PrizePay count="1" value="6000"/>
        </Prize>
        <Prize name="CO2PrizeCollect5">
            <PrizePay count="1" value="3500"/>
        </Prize>
        <Prize name="CO2PrizeCollect4">
            <PrizePay count="1" value="2000"/>
        </Prize>
        <Prize name="CO2PrizeCollect3">
            <PrizePay count="1" value="1200"/>
        </Prize>
        <Prize name="CO2PrizeCollect2">
            <PrizePay count="1" value="800"/>
        </Prize>
        <Prize name="CO2PrizeCollect1">
            <PrizePay count="1" value="400"/>
        </Prize>
        <Prize name="CA3PrizeCollect9">
            <PrizePay count="1" value="20000"/>
        </Prize>
        <Prize name="CA3PrizeCollect8">
            <PrizePay count="1" value="12000"/>
        </Prize>
        <Prize name="CA3PrizeCollect7">
            <PrizePay count="1" value="8000"/>
        </Prize>
        <Prize name="CA3PrizeCollect6">
            <PrizePay count="1" value="6000"/>
        </Prize>
        <Prize name="CA3PrizeCollect5">
            <PrizePay count="1" value="3500"/>
        </Prize>
        <Prize name="CA3PrizeCollect4">
            <PrizePay count="1" value="2000"/>
        </Prize>
        <Prize name="CA3PrizeCollect3">
            <PrizePay count="1" value="1200"/>
        </Prize>
        <Prize name="CA3PrizeCollect2">
            <PrizePay count="1" value="800"/>
        </Prize>
        <Prize name="CA3PrizeCollect1">
            <PrizePay count="1" value="400"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="MysteryWildsPattern">
        <Strip name="MysteryWildsPattern">
            <Stop symbolID="noMysteryWilds" weight="11628"/>
            <Stop symbolID="mysteryWildsPattern1" weight="1"/>
            <Stop symbolID="mysteryWildsPattern2" weight="1"/>
            <Stop symbolID="mysteryWildsPattern3" weight="1"/>
            <Stop symbolID="mysteryWildsPattern4" weight="1"/>
            <Stop symbolID="mysteryWildsPattern5" weight="1"/>
            <Stop symbolID="mysteryWildsPattern6" weight="1"/>
            <Stop symbolID="mysteryWildsPattern7" weight="1"/>
            <Stop symbolID="mysteryWildsPattern8" weight="1"/>
            <Stop symbolID="mysteryWildsPattern9" weight="1"/>
            <Stop symbolID="mysteryWildsPattern10" weight="1"/>
            <Stop symbolID="mysteryWildsPattern11" weight="1"/>
            <Stop symbolID="mysteryWildsPattern12" weight="1"/>
            <Stop symbolID="mysteryWildsPattern13" weight="1"/>
            <Stop symbolID="mysteryWildsPattern14" weight="1"/>
            <Stop symbolID="mysteryWildsPattern15" weight="1"/>
            <Stop symbolID="mysteryWildsPattern16" weight="1"/>
            <Stop symbolID="mysteryWildsPattern17" weight="1"/>
            <Stop symbolID="mysteryWildsPattern18" weight="1"/>
            <Stop symbolID="mysteryWildsPattern19" weight="1"/>
            <Stop symbolID="mysteryWildsPattern20" weight="1"/>
            <Stop symbolID="mysteryWildsPattern21" weight="1"/>
            <Stop symbolID="mysteryWildsPattern22" weight="1"/>
            <Stop symbolID="mysteryWildsPattern23" weight="1"/>
            <Stop symbolID="mysteryWildsPattern24" weight="1"/>
            <Stop symbolID="mysteryWildsPattern25" weight="1"/>
            <Stop symbolID="mysteryWildsPattern26" weight="1"/>
            <Stop symbolID="mysteryWildsPattern27" weight="1"/>
            <Stop symbolID="mysteryWildsPattern28" weight="1"/>
            <Stop symbolID="mysteryWildsPattern29" weight="1"/>
            <Stop symbolID="mysteryWildsPattern30" weight="1"/>
            <Stop symbolID="mysteryWildsPattern31" weight="1"/>
            <Stop symbolID="mysteryWildsPattern32" weight="1"/>
            <Stop symbolID="mysteryWildsPattern33" weight="1"/>
            <Stop symbolID="mysteryWildsPattern34" weight="1"/>
            <Stop symbolID="mysteryWildsPattern35" weight="1"/>
            <Stop symbolID="mysteryWildsPattern36" weight="1"/>
            <Stop symbolID="mysteryWildsPattern37" weight="1"/>
            <Stop symbolID="mysteryWildsPattern38" weight="1"/>
            <Stop symbolID="mysteryWildsPattern39" weight="1"/>
            <Stop symbolID="mysteryWildsPattern40" weight="1"/>
            <Stop symbolID="mysteryWildsPattern41" weight="1"/>
            <Stop symbolID="mysteryWildsPattern42" weight="1"/>
            <Stop symbolID="mysteryWildsPattern43" weight="1"/>
            <Stop symbolID="mysteryWildsPattern44" weight="1"/>
            <Stop symbolID="mysteryWildsPattern45" weight="1"/>
            <Stop symbolID="mysteryWildsPattern46" weight="1"/>
            <Stop symbolID="mysteryWildsPattern47" weight="1"/>
            <Stop symbolID="mysteryWildsPattern48" weight="1"/>
            <Stop symbolID="mysteryWildsPattern49" weight="1"/>
            <Stop symbolID="mysteryWildsPattern50" weight="1"/>
            <Stop symbolID="mysteryWildsPattern51" weight="1"/>
            <Stop symbolID="mysteryWildsPattern52" weight="1"/>
            <Stop symbolID="mysteryWildsPattern53" weight="1"/>
            <Stop symbolID="mysteryWildsPattern54" weight="1"/>
            <Stop symbolID="mysteryWildsPattern55" weight="1"/>
            <Stop symbolID="mysteryWildsPattern56" weight="1"/>
            <Stop symbolID="mysteryWildsPattern57" weight="1"/>
            <Stop symbolID="mysteryWildsPattern58" weight="1"/>
            <Stop symbolID="mysteryWildsPattern59" weight="1"/>
            <Stop symbolID="mysteryWildsPattern60" weight="1"/>
            <Stop symbolID="mysteryWildsPattern61" weight="1"/>
            <Stop symbolID="mysteryWildsPattern62" weight="1"/>
            <Stop symbolID="mysteryWildsPattern63" weight="1"/>
            <Stop symbolID="mysteryWildsPattern64" weight="1"/>
            <Stop symbolID="mysteryWildsPattern65" weight="1"/>
            <Stop symbolID="mysteryWildsPattern66" weight="1"/>
            <Stop symbolID="mysteryWildsPattern67" weight="1"/>
            <Stop symbolID="mysteryWildsPattern68" weight="1"/>
            <Stop symbolID="mysteryWildsPattern69" weight="1"/>
            <Stop symbolID="mysteryWildsPattern70" weight="1"/>
            <Stop symbolID="mysteryWildsPattern71" weight="1"/>
            <Stop symbolID="mysteryWildsPattern72" weight="1"/>
            <Stop symbolID="mysteryWildsPattern73" weight="1"/>
            <Stop symbolID="mysteryWildsPattern74" weight="1"/>
            <Stop symbolID="mysteryWildsPattern75" weight="1"/>
            <Stop symbolID="mysteryWildsPattern76" weight="1"/>
            <Stop symbolID="mysteryWildsPattern77" weight="1"/>
            <Stop symbolID="mysteryWildsPattern78" weight="1"/>
            <Stop symbolID="mysteryWildsPattern79" weight="1"/>
            <Stop symbolID="mysteryWildsPattern80" weight="1"/>
            <Stop symbolID="mysteryWildsPattern81" weight="1"/>
            <Stop symbolID="mysteryWildsPattern82" weight="1"/>
            <Stop symbolID="mysteryWildsPattern83" weight="1"/>
            <Stop symbolID="mysteryWildsPattern84" weight="1"/>
            <Stop symbolID="mysteryWildsPattern85" weight="1"/>
            <Stop symbolID="mysteryWildsPattern86" weight="1"/>
            <Stop symbolID="mysteryWildsPattern87" weight="1"/>
            <Stop symbolID="mysteryWildsPattern88" weight="1"/>
            <Stop symbolID="mysteryWildsPattern89" weight="1"/>
            <Stop symbolID="mysteryWildsPattern90" weight="1"/>
            <Stop symbolID="mysteryWildsPattern91" weight="1"/>
            <Stop symbolID="mysteryWildsPattern92" weight="1"/>
            <Stop symbolID="mysteryWildsPattern93" weight="1"/>
            <Stop symbolID="mysteryWildsPattern94" weight="1"/>
            <Stop symbolID="mysteryWildsPattern95" weight="1"/>
            <Stop symbolID="mysteryWildsPattern96" weight="1"/>
            <Stop symbolID="mysteryWildsPattern97" weight="1"/>
            <Stop symbolID="mysteryWildsPattern98" weight="1"/>
            <Stop symbolID="mysteryWildsPattern99" weight="1"/>
            <Stop symbolID="mysteryWildsPattern100" weight="1"/>
            <Stop symbolID="mysteryWildsPattern101" weight="1"/>
            <Stop symbolID="mysteryWildsPattern102" weight="1"/>
            <Stop symbolID="mysteryWildsPattern103" weight="1"/>
            <Stop symbolID="mysteryWildsPattern104" weight="1"/>
            <Stop symbolID="mysteryWildsPattern105" weight="1"/>
            <Stop symbolID="mysteryWildsPattern106" weight="1"/>
            <Stop symbolID="mysteryWildsPattern107" weight="1"/>
            <Stop symbolID="mysteryWildsPattern108" weight="1"/>
            <Stop symbolID="mysteryWildsPattern109" weight="2"/>
            <Stop symbolID="mysteryWildsPattern110" weight="2"/>
            <Stop symbolID="mysteryWildsPattern111" weight="2"/>
            <Stop symbolID="mysteryWildsPattern112" weight="2"/>
            <Stop symbolID="mysteryWildsPattern113" weight="2"/>
            <Stop symbolID="mysteryWildsPattern114" weight="2"/>
            <Stop symbolID="mysteryWildsPattern115" weight="2"/>
            <Stop symbolID="mysteryWildsPattern116" weight="2"/>
            <Stop symbolID="mysteryWildsPattern117" weight="2"/>
            <Stop symbolID="mysteryWildsPattern118" weight="2"/>
            <Stop symbolID="mysteryWildsPattern119" weight="2"/>
            <Stop symbolID="mysteryWildsPattern120" weight="2"/>
            <Stop symbolID="mysteryWildsPattern121" weight="2"/>
            <Stop symbolID="mysteryWildsPattern122" weight="2"/>
            <Stop symbolID="mysteryWildsPattern123" weight="2"/>
            <Stop symbolID="mysteryWildsPattern124" weight="2"/>
            <Stop symbolID="mysteryWildsPattern125" weight="3"/>
            <Stop symbolID="mysteryWildsPattern126" weight="3"/>
            <Stop symbolID="mysteryWildsPattern127" weight="3"/>
            <Stop symbolID="mysteryWildsPattern128" weight="2"/>
            <Stop symbolID="mysteryWildsPattern129" weight="2"/>
            <Stop symbolID="mysteryWildsPattern130" weight="2"/>
            <Stop symbolID="mysteryWildsPattern131" weight="2"/>
            <Stop symbolID="mysteryWildsPattern132" weight="2"/>
            <Stop symbolID="mysteryWildsPattern133" weight="2"/>
            <Stop symbolID="mysteryWildsPattern134" weight="2"/>
            <Stop symbolID="mysteryWildsPattern135" weight="2"/>
            <Stop symbolID="mysteryWildsPattern136" weight="2"/>
            <Stop symbolID="mysteryWildsPattern137" weight="3"/>
            <Stop symbolID="mysteryWildsPattern138" weight="3"/>
            <Stop symbolID="mysteryWildsPattern139" weight="3"/>
            <Stop symbolID="mysteryWildsPattern140" weight="3"/>
            <Stop symbolID="mysteryWildsPattern141" weight="3"/>
            <Stop symbolID="mysteryWildsPattern142" weight="3"/>
            <Stop symbolID="mysteryWildsPattern143" weight="2"/>
            <Stop symbolID="mysteryWildsPattern144" weight="2"/>
            <Stop symbolID="mysteryWildsPattern145" weight="2"/>
            <Stop symbolID="mysteryWildsPattern146" weight="2"/>
            <Stop symbolID="mysteryWildsPattern147" weight="2"/>
            <Stop symbolID="mysteryWildsPattern148" weight="2"/>
            <Stop symbolID="mysteryWildsPattern149" weight="2"/>
            <Stop symbolID="mysteryWildsPattern150" weight="2"/>
            <Stop symbolID="mysteryWildsPattern151" weight="2"/>
            <Stop symbolID="mysteryWildsPattern152" weight="2"/>
            <Stop symbolID="mysteryWildsPattern153" weight="2"/>
            <Stop symbolID="mysteryWildsPattern154" weight="2"/>
            <Stop symbolID="mysteryWildsPattern155" weight="2"/>
            <Stop symbolID="mysteryWildsPattern156" weight="2"/>
            <Stop symbolID="mysteryWildsPattern157" weight="2"/>
            <Stop symbolID="mysteryWildsPattern158" weight="2"/>
            <Stop symbolID="mysteryWildsPattern159" weight="2"/>
            <Stop symbolID="mysteryWildsPattern160" weight="2"/>
            <Stop symbolID="mysteryWildsPattern161" weight="2"/>
            <Stop symbolID="mysteryWildsPattern162" weight="2"/>
            <Stop symbolID="mysteryWildsPattern163" weight="10"/>
            <Stop symbolID="mysteryWildsPattern164" weight="2"/>
            <Stop symbolID="mysteryWildsPattern165" weight="2"/>
            <Stop symbolID="mysteryWildsPattern166" weight="2"/>
            <Stop symbolID="mysteryWildsPattern167" weight="2"/>
            <Stop symbolID="mysteryWildsPattern168" weight="2"/>
            <Stop symbolID="mysteryWildsPattern169" weight="10"/>
            <Stop symbolID="mysteryWildsPattern170" weight="8"/>
            <Stop symbolID="mysteryWildsPattern171" weight="6"/>
            <Stop symbolID="mysteryWildsPattern172" weight="11"/>
            <Stop symbolID="mysteryWildsPattern173" weight="6"/>
            <Stop symbolID="mysteryWildsPattern174" weight="7"/>
            <Stop symbolID="mysteryWildsPattern175" weight="7"/>
            <Stop symbolID="mysteryWildsPattern176" weight="6"/>
            <Stop symbolID="mysteryWildsPattern177" weight="6"/>
            <Stop symbolID="mysteryWildsPattern178" weight="6"/>
            <Stop symbolID="mysteryWildsPattern179" weight="8"/>
            <Stop symbolID="mysteryWildsPattern180" weight="8"/>
            <Stop symbolID="mysteryWildsPattern181" weight="8"/>
        </Strip>
    </StripInfo>
    <StripInfo name="BaseGame.AllRandoms">
        <Strip name="Reel0">
            <Stop symbolID="weightedReel" weight="156"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="weightedReel" weight="192"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="weightedReel" weight="195"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="weightedReel" weight="184"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="weightedReel" weight="164"/>
        </Strip>
        <Strip name="MysteryWildsPattern">
            <Stop symbolID="noMysteryWilds" weight="11628"/>
            <Stop symbolID="mysteryWildsPattern1" weight="1"/>
            <Stop symbolID="mysteryWildsPattern2" weight="1"/>
            <Stop symbolID="mysteryWildsPattern3" weight="1"/>
            <Stop symbolID="mysteryWildsPattern4" weight="1"/>
            <Stop symbolID="mysteryWildsPattern5" weight="1"/>
            <Stop symbolID="mysteryWildsPattern6" weight="1"/>
            <Stop symbolID="mysteryWildsPattern7" weight="1"/>
            <Stop symbolID="mysteryWildsPattern8" weight="1"/>
            <Stop symbolID="mysteryWildsPattern9" weight="1"/>
            <Stop symbolID="mysteryWildsPattern10" weight="1"/>
            <Stop symbolID="mysteryWildsPattern11" weight="1"/>
            <Stop symbolID="mysteryWildsPattern12" weight="1"/>
            <Stop symbolID="mysteryWildsPattern13" weight="1"/>
            <Stop symbolID="mysteryWildsPattern14" weight="1"/>
            <Stop symbolID="mysteryWildsPattern15" weight="1"/>
            <Stop symbolID="mysteryWildsPattern16" weight="1"/>
            <Stop symbolID="mysteryWildsPattern17" weight="1"/>
            <Stop symbolID="mysteryWildsPattern18" weight="1"/>
            <Stop symbolID="mysteryWildsPattern19" weight="1"/>
            <Stop symbolID="mysteryWildsPattern20" weight="1"/>
            <Stop symbolID="mysteryWildsPattern21" weight="1"/>
            <Stop symbolID="mysteryWildsPattern22" weight="1"/>
            <Stop symbolID="mysteryWildsPattern23" weight="1"/>
            <Stop symbolID="mysteryWildsPattern24" weight="1"/>
            <Stop symbolID="mysteryWildsPattern25" weight="1"/>
            <Stop symbolID="mysteryWildsPattern26" weight="1"/>
            <Stop symbolID="mysteryWildsPattern27" weight="1"/>
            <Stop symbolID="mysteryWildsPattern28" weight="1"/>
            <Stop symbolID="mysteryWildsPattern29" weight="1"/>
            <Stop symbolID="mysteryWildsPattern30" weight="1"/>
            <Stop symbolID="mysteryWildsPattern31" weight="1"/>
            <Stop symbolID="mysteryWildsPattern32" weight="1"/>
            <Stop symbolID="mysteryWildsPattern33" weight="1"/>
            <Stop symbolID="mysteryWildsPattern34" weight="1"/>
            <Stop symbolID="mysteryWildsPattern35" weight="1"/>
            <Stop symbolID="mysteryWildsPattern36" weight="1"/>
            <Stop symbolID="mysteryWildsPattern37" weight="1"/>
            <Stop symbolID="mysteryWildsPattern38" weight="1"/>
            <Stop symbolID="mysteryWildsPattern39" weight="1"/>
            <Stop symbolID="mysteryWildsPattern40" weight="1"/>
            <Stop symbolID="mysteryWildsPattern41" weight="1"/>
            <Stop symbolID="mysteryWildsPattern42" weight="1"/>
            <Stop symbolID="mysteryWildsPattern43" weight="1"/>
            <Stop symbolID="mysteryWildsPattern44" weight="1"/>
            <Stop symbolID="mysteryWildsPattern45" weight="1"/>
            <Stop symbolID="mysteryWildsPattern46" weight="1"/>
            <Stop symbolID="mysteryWildsPattern47" weight="1"/>
            <Stop symbolID="mysteryWildsPattern48" weight="1"/>
            <Stop symbolID="mysteryWildsPattern49" weight="1"/>
            <Stop symbolID="mysteryWildsPattern50" weight="1"/>
            <Stop symbolID="mysteryWildsPattern51" weight="1"/>
            <Stop symbolID="mysteryWildsPattern52" weight="1"/>
            <Stop symbolID="mysteryWildsPattern53" weight="1"/>
            <Stop symbolID="mysteryWildsPattern54" weight="1"/>
            <Stop symbolID="mysteryWildsPattern55" weight="1"/>
            <Stop symbolID="mysteryWildsPattern56" weight="1"/>
            <Stop symbolID="mysteryWildsPattern57" weight="1"/>
            <Stop symbolID="mysteryWildsPattern58" weight="1"/>
            <Stop symbolID="mysteryWildsPattern59" weight="1"/>
            <Stop symbolID="mysteryWildsPattern60" weight="1"/>
            <Stop symbolID="mysteryWildsPattern61" weight="1"/>
            <Stop symbolID="mysteryWildsPattern62" weight="1"/>
            <Stop symbolID="mysteryWildsPattern63" weight="1"/>
            <Stop symbolID="mysteryWildsPattern64" weight="1"/>
            <Stop symbolID="mysteryWildsPattern65" weight="1"/>
            <Stop symbolID="mysteryWildsPattern66" weight="1"/>
            <Stop symbolID="mysteryWildsPattern67" weight="1"/>
            <Stop symbolID="mysteryWildsPattern68" weight="1"/>
            <Stop symbolID="mysteryWildsPattern69" weight="1"/>
            <Stop symbolID="mysteryWildsPattern70" weight="1"/>
            <Stop symbolID="mysteryWildsPattern71" weight="1"/>
            <Stop symbolID="mysteryWildsPattern72" weight="1"/>
            <Stop symbolID="mysteryWildsPattern73" weight="1"/>
            <Stop symbolID="mysteryWildsPattern74" weight="1"/>
            <Stop symbolID="mysteryWildsPattern75" weight="1"/>
            <Stop symbolID="mysteryWildsPattern76" weight="1"/>
            <Stop symbolID="mysteryWildsPattern77" weight="1"/>
            <Stop symbolID="mysteryWildsPattern78" weight="1"/>
            <Stop symbolID="mysteryWildsPattern79" weight="1"/>
            <Stop symbolID="mysteryWildsPattern80" weight="1"/>
            <Stop symbolID="mysteryWildsPattern81" weight="1"/>
            <Stop symbolID="mysteryWildsPattern82" weight="1"/>
            <Stop symbolID="mysteryWildsPattern83" weight="1"/>
            <Stop symbolID="mysteryWildsPattern84" weight="1"/>
            <Stop symbolID="mysteryWildsPattern85" weight="1"/>
            <Stop symbolID="mysteryWildsPattern86" weight="1"/>
            <Stop symbolID="mysteryWildsPattern87" weight="1"/>
            <Stop symbolID="mysteryWildsPattern88" weight="1"/>
            <Stop symbolID="mysteryWildsPattern89" weight="1"/>
            <Stop symbolID="mysteryWildsPattern90" weight="1"/>
            <Stop symbolID="mysteryWildsPattern91" weight="1"/>
            <Stop symbolID="mysteryWildsPattern92" weight="1"/>
            <Stop symbolID="mysteryWildsPattern93" weight="1"/>
            <Stop symbolID="mysteryWildsPattern94" weight="1"/>
            <Stop symbolID="mysteryWildsPattern95" weight="1"/>
            <Stop symbolID="mysteryWildsPattern96" weight="1"/>
            <Stop symbolID="mysteryWildsPattern97" weight="1"/>
            <Stop symbolID="mysteryWildsPattern98" weight="1"/>
            <Stop symbolID="mysteryWildsPattern99" weight="1"/>
            <Stop symbolID="mysteryWildsPattern100" weight="1"/>
            <Stop symbolID="mysteryWildsPattern101" weight="1"/>
            <Stop symbolID="mysteryWildsPattern102" weight="1"/>
            <Stop symbolID="mysteryWildsPattern103" weight="1"/>
            <Stop symbolID="mysteryWildsPattern104" weight="1"/>
            <Stop symbolID="mysteryWildsPattern105" weight="1"/>
            <Stop symbolID="mysteryWildsPattern106" weight="1"/>
            <Stop symbolID="mysteryWildsPattern107" weight="1"/>
            <Stop symbolID="mysteryWildsPattern108" weight="1"/>
            <Stop symbolID="mysteryWildsPattern109" weight="2"/>
            <Stop symbolID="mysteryWildsPattern110" weight="2"/>
            <Stop symbolID="mysteryWildsPattern111" weight="2"/>
            <Stop symbolID="mysteryWildsPattern112" weight="2"/>
            <Stop symbolID="mysteryWildsPattern113" weight="2"/>
            <Stop symbolID="mysteryWildsPattern114" weight="2"/>
            <Stop symbolID="mysteryWildsPattern115" weight="2"/>
            <Stop symbolID="mysteryWildsPattern116" weight="2"/>
            <Stop symbolID="mysteryWildsPattern117" weight="2"/>
            <Stop symbolID="mysteryWildsPattern118" weight="2"/>
            <Stop symbolID="mysteryWildsPattern119" weight="2"/>
            <Stop symbolID="mysteryWildsPattern120" weight="2"/>
            <Stop symbolID="mysteryWildsPattern121" weight="2"/>
            <Stop symbolID="mysteryWildsPattern122" weight="2"/>
            <Stop symbolID="mysteryWildsPattern123" weight="2"/>
            <Stop symbolID="mysteryWildsPattern124" weight="2"/>
            <Stop symbolID="mysteryWildsPattern125" weight="3"/>
            <Stop symbolID="mysteryWildsPattern126" weight="3"/>
            <Stop symbolID="mysteryWildsPattern127" weight="3"/>
            <Stop symbolID="mysteryWildsPattern128" weight="2"/>
            <Stop symbolID="mysteryWildsPattern129" weight="2"/>
            <Stop symbolID="mysteryWildsPattern130" weight="2"/>
            <Stop symbolID="mysteryWildsPattern131" weight="2"/>
            <Stop symbolID="mysteryWildsPattern132" weight="2"/>
            <Stop symbolID="mysteryWildsPattern133" weight="2"/>
            <Stop symbolID="mysteryWildsPattern134" weight="2"/>
            <Stop symbolID="mysteryWildsPattern135" weight="2"/>
            <Stop symbolID="mysteryWildsPattern136" weight="2"/>
            <Stop symbolID="mysteryWildsPattern137" weight="3"/>
            <Stop symbolID="mysteryWildsPattern138" weight="3"/>
            <Stop symbolID="mysteryWildsPattern139" weight="3"/>
            <Stop symbolID="mysteryWildsPattern140" weight="3"/>
            <Stop symbolID="mysteryWildsPattern141" weight="3"/>
            <Stop symbolID="mysteryWildsPattern142" weight="3"/>
            <Stop symbolID="mysteryWildsPattern143" weight="2"/>
            <Stop symbolID="mysteryWildsPattern144" weight="2"/>
            <Stop symbolID="mysteryWildsPattern145" weight="2"/>
            <Stop symbolID="mysteryWildsPattern146" weight="2"/>
            <Stop symbolID="mysteryWildsPattern147" weight="2"/>
            <Stop symbolID="mysteryWildsPattern148" weight="2"/>
            <Stop symbolID="mysteryWildsPattern149" weight="2"/>
            <Stop symbolID="mysteryWildsPattern150" weight="2"/>
            <Stop symbolID="mysteryWildsPattern151" weight="2"/>
            <Stop symbolID="mysteryWildsPattern152" weight="2"/>
            <Stop symbolID="mysteryWildsPattern153" weight="2"/>
            <Stop symbolID="mysteryWildsPattern154" weight="2"/>
            <Stop symbolID="mysteryWildsPattern155" weight="2"/>
            <Stop symbolID="mysteryWildsPattern156" weight="2"/>
            <Stop symbolID="mysteryWildsPattern157" weight="2"/>
            <Stop symbolID="mysteryWildsPattern158" weight="2"/>
            <Stop symbolID="mysteryWildsPattern159" weight="2"/>
            <Stop symbolID="mysteryWildsPattern160" weight="2"/>
            <Stop symbolID="mysteryWildsPattern161" weight="2"/>
            <Stop symbolID="mysteryWildsPattern162" weight="2"/>
            <Stop symbolID="mysteryWildsPattern163" weight="10"/>
            <Stop symbolID="mysteryWildsPattern164" weight="2"/>
            <Stop symbolID="mysteryWildsPattern165" weight="2"/>
            <Stop symbolID="mysteryWildsPattern166" weight="2"/>
            <Stop symbolID="mysteryWildsPattern167" weight="2"/>
            <Stop symbolID="mysteryWildsPattern168" weight="2"/>
            <Stop symbolID="mysteryWildsPattern169" weight="10"/>
            <Stop symbolID="mysteryWildsPattern170" weight="8"/>
            <Stop symbolID="mysteryWildsPattern171" weight="6"/>
            <Stop symbolID="mysteryWildsPattern172" weight="11"/>
            <Stop symbolID="mysteryWildsPattern173" weight="6"/>
            <Stop symbolID="mysteryWildsPattern174" weight="7"/>
            <Stop symbolID="mysteryWildsPattern175" weight="7"/>
            <Stop symbolID="mysteryWildsPattern176" weight="6"/>
            <Stop symbolID="mysteryWildsPattern177" weight="6"/>
            <Stop symbolID="mysteryWildsPattern178" weight="6"/>
            <Stop symbolID="mysteryWildsPattern179" weight="8"/>
            <Stop symbolID="mysteryWildsPattern180" weight="8"/>
            <Stop symbolID="mysteryWildsPattern181" weight="8"/>
        </Strip>
    </StripInfo>
    <StripInfo name="BaseGame">
        <Strip name="Reel0">
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="WheelPicker.AllRandoms">
        <Strip name="Group">
            <Stop symbolID="LieutenantGroup" weight="5"/>
            <Stop symbolID="CommanderGroup" weight="3"/>
            <Stop symbolID="CaptainGroup" weight="2"/>
        </Strip>
        <Strip name="LieutenantLevel">
            <Stop symbolID="LieutenantLevel_I" weight="1"/>
            <Stop symbolID="LieutenantLevel_II" weight="1"/>
            <Stop symbolID="LieutenantLevel_III" weight="1"/>
        </Strip>
        <Strip name="CommanderLevel">
            <Stop symbolID="CommanderLevel_I" weight="1"/>
            <Stop symbolID="CommanderLevel_II" weight="1"/>
            <Stop symbolID="CommanderLevel_III" weight="1"/>
        </Strip>
        <Strip name="CaptainLevel">
            <Stop symbolID="CaptainLevel_I" weight="1"/>
            <Stop symbolID="CaptainLevel_II" weight="1"/>
            <Stop symbolID="CaptainLevel_III" weight="1"/>
        </Strip>
        <Strip name="LieutenantIAdditionSeed">
            <Stop symbolID="LieutenantI_Reel2" weight="1"/>
            <Stop symbolID="LieutenantI_Reel3" weight="1"/>
            <Stop symbolID="LieutenantI_Reel4" weight="1"/>
            <Stop symbolID="LieutenantI_Reel5" weight="1"/>
            <Stop symbolID="LieutenantI_Reel6" weight="1"/>
            <Stop symbolID="LieutenantI_Reel7" weight="1"/>
            <Stop symbolID="LieutenantI_Reel8" weight="1"/>
            <Stop symbolID="LieutenantI_Reel9" weight="1"/>
            <Stop symbolID="LieutenantI_Reel10" weight="1"/>
            <Stop symbolID="LieutenantI_Reel11" weight="1"/>
            <Stop symbolID="LieutenantI_Reel12" weight="1"/>
            <Stop symbolID="LieutenantI_Reel13" weight="1"/>
            <Stop symbolID="LieutenantI_Reel14" weight="1"/>
            <Stop symbolID="LieutenantI_Reel15" weight="1"/>
            <Stop symbolID="LieutenantI_Reel16" weight="1"/>
            <Stop symbolID="LieutenantI_Reel17" weight="1"/>
            <Stop symbolID="LieutenantI_Reel18" weight="1"/>
            <Stop symbolID="LieutenantI_Reel19" weight="1"/>
            <Stop symbolID="LieutenantI_Reel20" weight="1"/>
            <Stop symbolID="LieutenantI_Reel21" weight="1"/>
            <Stop symbolID="LieutenantI_Reel22" weight="1"/>
            <Stop symbolID="LieutenantI_Reel23" weight="1"/>
            <Stop symbolID="LieutenantI_Reel24" weight="1"/>
            <Stop symbolID="LieutenantI_Reel25" weight="1"/>
        </Strip>
        <Strip name="CommanderIIIMultiplierSeed">
            <Stop symbolID="CommanderIII_Reel2" weight="1"/>
            <Stop symbolID="CommanderIII_Reel3" weight="1"/>
            <Stop symbolID="CommanderIII_Reel4" weight="1"/>
            <Stop symbolID="CommanderIII_Reel5" weight="1"/>
            <Stop symbolID="CommanderIII_Reel6" weight="1"/>
            <Stop symbolID="CommanderIII_Reel7" weight="1"/>
            <Stop symbolID="CommanderIII_Reel8" weight="1"/>
            <Stop symbolID="CommanderIII_Reel9" weight="1"/>
            <Stop symbolID="CommanderIII_Reel10" weight="1"/>
            <Stop symbolID="CommanderIII_Reel11" weight="1"/>
            <Stop symbolID="CommanderIII_Reel12" weight="1"/>
            <Stop symbolID="CommanderIII_Reel13" weight="1"/>
            <Stop symbolID="CommanderIII_Reel14" weight="1"/>
            <Stop symbolID="CommanderIII_Reel15" weight="1"/>
            <Stop symbolID="CommanderIII_Reel16" weight="1"/>
            <Stop symbolID="CommanderIII_Reel17" weight="1"/>
            <Stop symbolID="CommanderIII_Reel18" weight="1"/>
            <Stop symbolID="CommanderIII_Reel19" weight="1"/>
            <Stop symbolID="CommanderIII_Reel20" weight="1"/>
            <Stop symbolID="CommanderIII_Reel21" weight="1"/>
            <Stop symbolID="CommanderIII_Reel22" weight="1"/>
            <Stop symbolID="CommanderIII_Reel23" weight="1"/>
            <Stop symbolID="CommanderIII_Reel24" weight="1"/>
            <Stop symbolID="CommanderIII_Reel25" weight="1"/>
        </Strip>
        <Strip name="CaptainIIMultiplierSeed">
            <Stop symbolID="CaptainII_Reel2" weight="1"/>
            <Stop symbolID="CaptainII_Reel3" weight="1"/>
            <Stop symbolID="CaptainII_Reel4" weight="1"/>
            <Stop symbolID="CaptainII_Reel5" weight="1"/>
            <Stop symbolID="CaptainII_Reel6" weight="1"/>
            <Stop symbolID="CaptainII_Reel7" weight="1"/>
            <Stop symbolID="CaptainII_Reel8" weight="1"/>
            <Stop symbolID="CaptainII_Reel9" weight="1"/>
            <Stop symbolID="CaptainII_Reel10" weight="1"/>
            <Stop symbolID="CaptainII_Reel11" weight="1"/>
            <Stop symbolID="CaptainII_Reel12" weight="1"/>
            <Stop symbolID="CaptainII_Reel13" weight="1"/>
            <Stop symbolID="CaptainII_Reel14" weight="1"/>
            <Stop symbolID="CaptainII_Reel15" weight="1"/>
            <Stop symbolID="CaptainII_Reel16" weight="1"/>
            <Stop symbolID="CaptainII_Reel17" weight="1"/>
            <Stop symbolID="CaptainII_Reel18" weight="1"/>
            <Stop symbolID="CaptainII_Reel19" weight="1"/>
            <Stop symbolID="CaptainII_Reel20" weight="1"/>
            <Stop symbolID="CaptainII_Reel21" weight="1"/>
            <Stop symbolID="CaptainII_Reel22" weight="1"/>
            <Stop symbolID="CaptainII_Reel23" weight="1"/>
            <Stop symbolID="CaptainII_Reel24" weight="1"/>
            <Stop symbolID="CaptainII_Reel25" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantII_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="trigger,LI2_3Pointer" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="trigger,LI2_3Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_4Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="trigger,LI2_4Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_3Pointer" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI2_4Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI2_3Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_4Pointer" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="trigger,LI2_3Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_2Pointer" weight="1"/>
            <Stop symbolID="trigger,LI2_4Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel2">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1900" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel3">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel4">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,5750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,5750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel5">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,1900" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel6">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,3350" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel7">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,6500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,5900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel8">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,5500" weight="1"/>
            <Stop symbolID="credits,5750" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel9">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,3700" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel10">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3300" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3700" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3400" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel11">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3700" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,5500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel12">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel13">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel14">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,5800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,5900" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,5750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel15">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel16">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel17">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel18">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,5500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5850" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,5400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,5500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel19">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3300" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3400" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel20">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel21">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,5500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel22">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,3400" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel23">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5800" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3700" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,5900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,5750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel24">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,3300" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,3350" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantI_Reel25">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,2200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,3400" weight="1"/>
            <Stop symbolID="credits,2900" weight="1"/>
            <Stop symbolID="credits,3100" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI2_2Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI2_3Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,225" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI2_4Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LieutenantIII_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_A" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI3_SymbolCollect1_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI3_SymbolCollect2_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="LI3_SymbolCollect3_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="trigger,LI3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderI_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO1_3Pointer" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,CO1_2Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO1_6Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO1_2Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CO1_3Pointer" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,CO1_6Pointer" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO1_2Pointer" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO1_6Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO1_3Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CO1_3Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO1_6Pointer" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO1_2Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO1_2Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO1_3Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO1_6Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderII_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO2_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_A" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_A" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_A" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_A" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO2_SymbolCollect1_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO2_SymbolCollect2_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO2_SymbolCollect3_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CO2_SymbolCollect4_A">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect4_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CO2_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel2">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2250" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel3">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,12000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel4">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel5">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel6">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel7">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,8400" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel8">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,9000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel9">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel10">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel11">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel12">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,12000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,9000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,8000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel13">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,6500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel14">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,7500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,7500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel15">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel16">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,8400" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,13500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,10500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel17">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel18">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel19">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,8400" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,6300" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,5600" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel20">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2250" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel21">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel22">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel23">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,2250" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel24">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2250" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,2450" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,1750" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,6300" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CommanderIII_Reel25">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,3250" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainI_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="trigger,CA1_2Pointer1x" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer3x" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer1x" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer2x" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer3x" weight="1"/>
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer2x" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer2x" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer1x" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer2x" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA1_2Pointer3x" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA1_2Pointer1x">
        <Strip name="wheel0">
            <Stop symbolID="credits,1800" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,225" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA1_2Pointer2x">
        <Strip name="wheel0">
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,125" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,225" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,125" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,800" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,50" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,2000" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA1_2Pointer3x">
        <Strip name="wheel0">
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,2500" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,225" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,550" weight="1"/>
            <Stop symbolID="credits,200" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,100" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,150" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel2">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel3">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,22500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,7500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,22500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,8500" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel4">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,4900" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,5950" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel5">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel6">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel7">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,5250" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel8">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel9">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel10">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,18000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,22500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel11">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel12">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,18000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,18000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel13">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5250" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,3150" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,5950" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel14">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,11250" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,10500" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,12750" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel15">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel16">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,15000" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,4900" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel17">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,4000" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel18">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel19">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,10500" weight="1"/>
            <Stop symbolID="credits,3500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,9000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel20">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,5000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,4500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel21">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,10500" weight="1"/>
            <Stop symbolID="credits,3000" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel22">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,6750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,6500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel23">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1000" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,7500" weight="1"/>
            <Stop symbolID="credits,2100" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,6000" weight="1"/>
            <Stop symbolID="credits,4550" weight="1"/>
            <Stop symbolID="credits,6300" weight="1"/>
            <Stop symbolID="credits,2800" weight="1"/>
            <Stop symbolID="credits,4200" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel24">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,7000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,6500" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,1200" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,6500" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainII_Reel25">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,10000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,12000" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,900" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,1500" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,700" weight="1"/>
            <Stop symbolID="credits,450" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,12000" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,650" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="credits,850" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CaptainIII_Reel1">
        <Strip name="wheel0">
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_3Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CA3_2Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CA3_3Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CA3_2Pointer" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_4Pointer" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_4Pointer" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_3Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CA3_2Pointer" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
            <Stop symbolID="trigger,CA3_2Pointer" weight="1"/>
            <Stop symbolID="credits,400" weight="1"/>
            <Stop symbolID="trigger,CA3_4Pointer" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="credits,600" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA3_2Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA3_3Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,350" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,300" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="CA3_4Pointer">
        <Strip name="wheel0">
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="credits,750" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="credits,500" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect3_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="credits,250" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect2_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
            <Stop symbolID="trigger,CA3_SymbolCollect1_B" weight="1"/>
        </Strip>
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
        <Denomination softwareId="200-1170-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>60.0</MaxBet>
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
        <TransactionId>A2010-14264054842267</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>BaseGame</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>Initial</GameStatus>
        <Settled>0</Settled>
        <Pending>0</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    <PopulationOutcome name="BaseGame.Reels" stage="BaseGame">
        <Entry name="Reel0" stripIndex="14">
            <Cell name="L0C0R0" stripIndex="14">s01</Cell>
            <Cell name="L0C0R1" stripIndex="15">s03</Cell>
            <Cell name="L0C0R2" stripIndex="16">s05</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="15">
            <Cell name="L0C1R0" stripIndex="15">s08</Cell>
            <Cell name="L0C1R1" stripIndex="16">s07</Cell>
            <Cell name="L0C1R2" stripIndex="17">s06</Cell>
            <Cell name="L0C1R3" stripIndex="78">b01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="108">
            <Cell name="L0C2R0" stripIndex="108">w01</Cell>
            <Cell name="L0C2R1" stripIndex="109">w01</Cell>
            <Cell name="L0C2R2" stripIndex="110">w01</Cell>
            <Cell name="L0C2R3" stripIndex="111">w01</Cell>
            <Cell name="L0C2R4" stripIndex="112">w01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="111">
            <Cell name="L0C3R0" stripIndex="111">s03</Cell>
            <Cell name="L0C3R1" stripIndex="112">s03</Cell>
            <Cell name="L0C3R2" stripIndex="113">s04</Cell>
            <Cell name="L0C3R3" stripIndex="114">s02</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="102">
            <Cell name="L0C4R0" stripIndex="102">s09</Cell>
            <Cell name="L0C4R1" stripIndex="103">s06</Cell>
            <Cell name="L0C4R2" stripIndex="104">s08</Cell>
        </Entry>
    </PopulationOutcome>
    <PatternSliderInput>
        <BetPerPattern>1</BetPerPattern>
        <PatternsBet>60</PatternsBet>
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
        $highlightLeft = $this->getLeftHighlight($report['winLines']);
        $highlightRight = $this->getRightHighlight($report['winLines']);
        $display = $this->getDisplay($report);
        $leftWinLines = $this->getLeftWayWinLines($report);
        $rightWinLines = $this->getRightWayWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

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
    <HighlightOutcome name="BaseGame.Scatter" type="" />
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
    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern" />
    '.$leftWinLines.'
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

}
