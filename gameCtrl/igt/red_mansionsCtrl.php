<?
require_once('IGTCtrl.php');
require_once('SlotReel.php');
require_once('ReelWithReel.php');

class red_mansionsCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params><param name="softwareid" value="200-1231-001"/><param name="minbet" value="1.0"/><param name="availablebalance" value="0.0"/><param name="denomid" value="44"/><param name="gametitle" value="Red Mansions"/><param name="terminalid" value=""/><param name="ipaddress" value="31.131.103.75"/><param name="affiliate" value=""/><param name="gameWindowHeight" value="815"/><param name="gameWindowWidth" value="1024"/><param name="nsbuyin" value=""/><param name="nscashout" value=""/><param name="cashiertype" value="N"/><param name="game" value="RedMansions"/><param name="studio" value="crdc"/><param name="nsbuyinamount" value=""/><param name="buildnumber" value="4.2.F.O.CL104654_220"/><param name="autopull" value="N"/><param name="consoleCode" value="CSTM"/><param name="BCustomViewHeight" value="47"/><param name="BCustomViewWidth" value="1024"/><param name="consoleTimeStamp" value="1349855268588"/><param name="filtered" value="Y"/><param name="defaultbuyinamount" value="0.0"/><param name="xtautopull" value=""/><param name="server" value="../../../../../"/><param name="showInitialCashier" value="false"/><param name="audio" value="on"/><param name="nscode" value="MRGR"/><param name="uniqueid" value="Guest"/><param name="countrycode" value=""/><param name="presenttype" value="FLSH"/><param name="securetoken" value=""/><param name="denomamount" value="1.0"/><param name="skincode" value="MRGR"/><param name="language" value="en"/><param name="channel" value="INT"/><param name="currencycode" value="FPY"/></params>';
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
    <PaytableStatistics description="Red Mansions 40L + 1024 Ways" maxRTP="95.03" minRTP="92.90" name="Red Mansions" type="Slot"/>
    <PrizeInfo name="BaseGame.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s01">
            <PrizePay count="5" pph="101256" value="5000"/>
            <PrizePay count="4" pph="15821" value="800"/>
            <PrizePay count="3" pph="2341" value="125"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="97506" value="2000"/>
            <PrizePay count="4" pph="10187" value="500"/>
            <PrizePay count="3" pph="1870" value="100"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s02" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="70317" value="1000"/>
            <PrizePay count="4" pph="7347" value="400"/>
            <PrizePay count="3" pph="657" value="75"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s03" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="135008" value="500"/>
            <PrizePay count="4" pph="28772" value="100"/>
            <PrizePay count="3" pph="3002" value="50"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s04" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="95982" value="500"/>
            <PrizePay count="4" pph="35549" value="100"/>
            <PrizePay count="3" pph="4043" value="50"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s05" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="17848" value="300"/>
            <PrizePay count="4" pph="2163" value="75"/>
            <PrizePay count="3" pph="423" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s06" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="15746" value="300"/>
            <PrizePay count="4" pph="3674" value="75"/>
            <PrizePay count="3" pph="863" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s07" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="16081" value="150"/>
            <PrizePay count="4" pph="5555" value="50"/>
            <PrizePay count="3" pph="352" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s08" required="false"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="22974" value="150"/>
            <PrizePay count="4" pph="2785" value="50"/>
            <PrizePay count="3" pph="720" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="FreeSpin.PrizeInfoLines" strategy="PayLeft">
        <Prize name="s01">
            <PrizePay count="5" pph="103604" value="5000"/>
            <PrizePay count="4" pph="9867" value="800"/>
            <PrizePay count="3" pph="1758" value="125"/>
            <PrizePay count="2" pph="106" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="97506" value="2000"/>
            <PrizePay count="4" pph="10187" value="500"/>
            <PrizePay count="3" pph="1870" value="100"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s02" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="70317" value="1000"/>
            <PrizePay count="4" pph="7347" value="400"/>
            <PrizePay count="3" pph="657" value="75"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s03" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="135008" value="500"/>
            <PrizePay count="4" pph="28772" value="100"/>
            <PrizePay count="3" pph="3002" value="50"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s04" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="95982" value="500"/>
            <PrizePay count="4" pph="35549" value="100"/>
            <PrizePay count="3" pph="4043" value="50"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s05" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="17848" value="300"/>
            <PrizePay count="4" pph="2163" value="75"/>
            <PrizePay count="3" pph="423" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s06" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="15746" value="300"/>
            <PrizePay count="4" pph="3674" value="75"/>
            <PrizePay count="3" pph="863" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s07" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="16081" value="150"/>
            <PrizePay count="4" pph="5555" value="50"/>
            <PrizePay count="3" pph="352" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s08" required="false"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="22974" value="150"/>
            <PrizePay count="4" pph="2785" value="50"/>
            <PrizePay count="3" pph="720" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoLeftRight" strategy="PayMultiWayLeftRight">
        <Prize name="s01">
            <PrizePay count="5" pph="98.882705149668" value="500"/>
            <PrizePay count="4" pph="95.5334790028788" value="100"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="95" value="350"/>
            <PrizePay count="4" pph="54" value="75"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s02" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="69" value="250"/>
            <PrizePay count="4" pph="39" value="75"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s03" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="132" value="100"/>
            <PrizePay count="4" pph="201" value="40"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s04" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="94" value="100"/>
            <PrizePay count="4" pph="357" value="40"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s05" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="17" value="40"/>
            <PrizePay count="4" pph="12" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s06" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="15" value="40"/>
            <PrizePay count="4" pph="27" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s07" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="16" value="40"/>
            <PrizePay count="4" pph="53" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s08" required="false"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="22" value="40"/>
            <PrizePay count="4" pph="15" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s09" required="false"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        <Strip name="Reel0">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="2"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="7"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="5"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="3"/>
        </Strip>
        <Strip name="Reel5">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="7"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="5"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="3"/>
        </Strip>
        <Strip name="Reel6">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="7"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="5"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="3"/>
        </Strip>
        <Strip name="Reel7">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s03" weight="5"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="7"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="5"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="3"/>
        </Strip>
        <Strip name="Reel8">
            <Stop symbolID="s03" weight="7"/>
            <Stop symbolID="s04" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s09" weight="23"/>
            <Stop symbolID="s09" weight="22"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s02" weight="8"/>
            <Stop symbolID="s02" weight="8"/>
        </Strip>
        <Strip name="Reel9">
            <Stop symbolID="s03" weight="7"/>
            <Stop symbolID="s04" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s09" weight="23"/>
            <Stop symbolID="s09" weight="22"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s02" weight="8"/>
            <Stop symbolID="s02" weight="8"/>
        </Strip>
        <Strip name="Reel10">
            <Stop symbolID="s03" weight="7"/>
            <Stop symbolID="s04" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s09" weight="23"/>
            <Stop symbolID="s09" weight="22"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s02" weight="8"/>
            <Stop symbolID="s02" weight="8"/>
        </Strip>
        <Strip name="Reel11">
            <Stop symbolID="s03" weight="7"/>
            <Stop symbolID="s04" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s05" weight="5"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s06" weight="14"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s08" weight="15"/>
            <Stop symbolID="s09" weight="23"/>
            <Stop symbolID="s09" weight="22"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s02" weight="8"/>
            <Stop symbolID="s02" weight="8"/>
        </Strip>
        <Strip name="Reel12">
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="6"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel13">
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="6"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel14">
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="6"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel15">
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s06" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="s09" weight="8"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="6"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="4"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel16">
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
        </Strip>
        <Strip name="Reel17">
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
        </Strip>
        <Strip name="Reel18">
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
        </Strip>
        <Strip name="Reel19">
            <Stop symbolID="s05" weight="4"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s07" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
        </Strip>
    </StripInfo>
    <StripInfo name="FreeSpin">
        <Strip name="Reel0">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s06" weight="4"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s08" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
            <Stop symbolID="s09" weight="6"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="12"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
        </Strip>
        <Strip name="Reel5">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="12"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
        </Strip>
        <Strip name="Reel6">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="12"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
        </Strip>
        <Strip name="Reel7">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s06" weight="5"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s07" weight="6"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="12"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="w01" weight="4"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
        </Strip>
        <Strip name="Reel8">
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="11"/>
            <Stop symbolID="s06" weight="10"/>
            <Stop symbolID="s07" weight="8"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
        </Strip>
        <Strip name="Reel9">
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="11"/>
            <Stop symbolID="s06" weight="10"/>
            <Stop symbolID="s07" weight="8"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
        </Strip>
        <Strip name="Reel10">
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="11"/>
            <Stop symbolID="s06" weight="10"/>
            <Stop symbolID="s07" weight="8"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
        </Strip>
        <Strip name="Reel11">
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="11"/>
            <Stop symbolID="s06" weight="10"/>
            <Stop symbolID="s07" weight="8"/>
            <Stop symbolID="s07" weight="7"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s08" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="s09" weight="10"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="b01" weight="2"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="2"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
        </Strip>
        <Strip name="Reel12">
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="4"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel13">
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="4"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel14">
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="4"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel15">
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="3"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s07" weight="2"/>
            <Stop symbolID="s08" weight="5"/>
            <Stop symbolID="s08" weight="4"/>
            <Stop symbolID="s09" weight="5"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="3"/>
            <Stop symbolID="s01" weight="2"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s03" weight="3"/>
            <Stop symbolID="s03" weight="2"/>
        </Strip>
        <Strip name="Reel16">
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
        </Strip>
        <Strip name="Reel17">
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
        </Strip>
        <Strip name="Reel18">
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
        </Strip>
        <Strip name="Reel19">
            <Stop symbolID="s05" weight="3"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s05" weight="2"/>
            <Stop symbolID="s06" weight="2"/>
            <Stop symbolID="s07" weight="4"/>
            <Stop symbolID="s08" weight="3"/>
            <Stop symbolID="s08" weight="2"/>
            <Stop symbolID="s09" weight="4"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s02" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="2"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="3"/>
            <Stop symbolID="s04" weight="2"/>
            <Stop symbolID="s04" weight="2"/>
        </Strip>
    </StripInfo>
    <PatternSliderInfo name="PatternSliderInfo">
        <PatternInfo max="80" min="1">
            <Step>1</Step>
            <Step>10</Step>
            <Step>20</Step>
            <Step>40</Step>
            <Step>80</Step>
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
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy>HighestOnly</Strategy>
            <MaxFreeSpins>130</MaxFreeSpins>
            <Triggers>
                <Trigger freespins="10" name="2 b01"/>
                <Trigger freespins="15" name="3 b01"/>
                <Trigger freespins="20" name="4 b01"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy>ConstantDecrement</Strategy>
            <Count>1</Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <DenominationList>
        <Denomination softwareId="200-1231-001">1.0</Denomination>
    </DenominationList>
    <GameBetInfo>
        <MinChipValue>1.0</MinChipValue>
        <MinBet>1.0</MinBet>
        <MaxBet>15.0</MaxBet>
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

        $patternsBet = 80;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2110-14264049083714</TransactionId>
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
        <Entry name="Reel0" stripIndex="14">
            <Cell name="L0C0R0" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="14">
            <Cell name="L0C0R1" stripIndex="14">s01</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="13">
            <Cell name="L0C0R2" stripIndex="13">s01</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="17">
            <Cell name="L0C0R3" stripIndex="17">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="15">
            <Cell name="L0C1R0" stripIndex="15">s02</Cell>
        </Entry>
        <Entry name="Reel5" stripIndex="8">
            <Cell name="L0C1R1" stripIndex="8">s02</Cell>
        </Entry>
        <Entry name="Reel6" stripIndex="15">
            <Cell name="L0C1R2" stripIndex="15">s03</Cell>
        </Entry>
        <Entry name="Reel7" stripIndex="15">
            <Cell name="L0C1R3" stripIndex="15">s03</Cell>
        </Entry>
        <Entry name="Reel8" stripIndex="3">
            <Cell name="L0C2R0" stripIndex="3">b01</Cell>
        </Entry>
        <Entry name="Reel9" stripIndex="18">
            <Cell name="L0C2R1" stripIndex="18">w01</Cell>
        </Entry>
        <Entry name="Reel10" stripIndex="13">
            <Cell name="L0C2R2" stripIndex="13">s04</Cell>
        </Entry>
        <Entry name="Reel11" stripIndex="16">
            <Cell name="L0C2R3" stripIndex="16">s06</Cell>
        </Entry>
        <Entry name="Reel12" stripIndex="3">
            <Cell name="L0C3R0" stripIndex="3">s01</Cell>
        </Entry>
        <Entry name="Reel13" stripIndex="0">
            <Cell name="L0C3R1" stripIndex="0">s01</Cell>
        </Entry>
        <Entry name="Reel14" stripIndex="20">
            <Cell name="L0C3R2" stripIndex="20">s04</Cell>
        </Entry>
        <Entry name="Reel15" stripIndex="5">
            <Cell name="L0C3R3" stripIndex="5">s04</Cell>
        </Entry>
        <Entry name="Reel16" stripIndex="3">
            <Cell name="L0C4R0" stripIndex="3">s05</Cell>
        </Entry>
        <Entry name="Reel17" stripIndex="7">
            <Cell name="L0C4R1" stripIndex="7">s01</Cell>
        </Entry>
        <Entry name="Reel18" stripIndex="16">
            <Cell name="L0C4R2" stripIndex="16">s04</Cell>
        </Entry>
        <Entry name="Reel19" stripIndex="21">
            <Cell name="L0C4R3" stripIndex="21">s07</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="14">
            <Cell name="L0C0R0" stripIndex="14">s02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="14">
            <Cell name="L0C0R1" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="12">
            <Cell name="L0C0R2" stripIndex="12">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="16">
            <Cell name="L0C0R3" stripIndex="16">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="17">
            <Cell name="L0C1R0" stripIndex="17">s03</Cell>
        </Entry>
        <Entry name="Reel5" stripIndex="8">
            <Cell name="L0C1R1" stripIndex="8">s08</Cell>
        </Entry>
        <Entry name="Reel6" stripIndex="17">
            <Cell name="L0C1R2" stripIndex="17">s04</Cell>
        </Entry>
        <Entry name="Reel7" stripIndex="17">
            <Cell name="L0C1R3" stripIndex="17">s04</Cell>
        </Entry>
        <Entry name="Reel8" stripIndex="5">
            <Cell name="L0C2R0" stripIndex="5">s03</Cell>
        </Entry>
        <Entry name="Reel9" stripIndex="18">
            <Cell name="L0C2R1" stripIndex="18">s01</Cell>
        </Entry>
        <Entry name="Reel10" stripIndex="14">
            <Cell name="L0C2R2" stripIndex="14">s07</Cell>
        </Entry>
        <Entry name="Reel11" stripIndex="16">
            <Cell name="L0C2R3" stripIndex="16">s07</Cell>
        </Entry>
        <Entry name="Reel12" stripIndex="2">
            <Cell name="L0C3R0" stripIndex="2">s03</Cell>
        </Entry>
        <Entry name="Reel13" stripIndex="0">
            <Cell name="L0C3R1" stripIndex="0">s04</Cell>
        </Entry>
        <Entry name="Reel14" stripIndex="21">
            <Cell name="L0C3R2" stripIndex="21">s04</Cell>
        </Entry>
        <Entry name="Reel15" stripIndex="5">
            <Cell name="L0C3R3" stripIndex="5">s05</Cell>
        </Entry>
        <Entry name="Reel16" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="2">s03</Cell>
        </Entry>
        <Entry name="Reel17" stripIndex="11">
            <Cell name="L0C4R1" stripIndex="11">w01</Cell>
        </Entry>
        <Entry name="Reel18" stripIndex="18">
            <Cell name="L0C4R2" stripIndex="18">s04</Cell>
        </Entry>
        <Entry name="Reel19" stripIndex="21">
            <Cell name="L0C4R3" stripIndex="21">s05</Cell>
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

        if($totalBet == 80) {
            $this->gameParams->winLineType = 'lineWays';
        }
        else {
            $this->gameParams->winLineType = 'left';
        }

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new SlotReel($this->gameParams, $pick, $stake);
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

        if($pick == 80) {
            $this->gameParams->winLineType = 'lineWays';
        }
        else {
            $this->gameParams->winLineType = 'left';
        }

        $this->gameParams->reels[0] = $this->gameParams->reels[1];
        $this->gameParams->winPay = $this->gameParams->winPayFree;
        $this->slot = new SlotReel($this->gameParams, $pick, $stake);
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

        $report['scattersReport'] = $this->slot->getSymbolAnyCount('b01');
        if($report['scattersReport']['count'] > 1) {
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = 0;
        }


        if($this->gameParams->testBonusEnable && $_SESSION['state'] == 'SPIN') {
            $url = $_SERVER['HTTP_REFERER'];
            if (strpos($url, 'bonus=fs') > 0) {
                if($report['scattersReport']['count'] < 2) {
                    $respin = true;
                }
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
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'BaseGame', 'MultiWayLeftRight');
        $display = $this->getDisplayReels($report);
        $winLines = $this->getWinLines($report);
        $leftWinLines = $this->getLeftWayWinLines($report, 'BaseGame', 'MultiWayLeftRight');
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
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    <HighlightOutcome name="BaseGame.MultiWayLeftRight" type="" />
    '.$highlight.$highlightLeft.'

    '.$display.'
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
    '.$winLines.$leftWinLines.'
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
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'BaseGame', 'MultiWayLeftRight');
        $display = $this->getDisplayReels($report);
        $winLines = $this->getWinLines($report);
        $leftWinLines = $this->getLeftWayWinLines($report, 'BaseGame', 'MultiWayLeftRight');
        $betPerLine = $report['bet'] / $report['linesCount'];


        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets']);

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $awarded = 10;
        if($report['scattersReport']['count'] == 3) {
            $awarded = 15;
        }
        if($report['scattersReport']['count'] == 4) {
            $awarded = 20;
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
    '.$highlight.$highlightLeft.$scattersPay.$scattersHighlight.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="14">
            <Cell name="L0C0R0" stripIndex="14">s02</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="14">
            <Cell name="L0C0R1" stripIndex="14">s04</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="12">
            <Cell name="L0C0R2" stripIndex="12">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="16">
            <Cell name="L0C0R3" stripIndex="16">s04</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="17">
            <Cell name="L0C1R0" stripIndex="17">s03</Cell>
        </Entry>
        <Entry name="Reel5" stripIndex="8">
            <Cell name="L0C1R1" stripIndex="8">s08</Cell>
        </Entry>
        <Entry name="Reel6" stripIndex="17">
            <Cell name="L0C1R2" stripIndex="17">s04</Cell>
        </Entry>
        <Entry name="Reel7" stripIndex="17">
            <Cell name="L0C1R3" stripIndex="17">s04</Cell>
        </Entry>
        <Entry name="Reel8" stripIndex="5">
            <Cell name="L0C2R0" stripIndex="5">s03</Cell>
        </Entry>
        <Entry name="Reel9" stripIndex="18">
            <Cell name="L0C2R1" stripIndex="18">s01</Cell>
        </Entry>
        <Entry name="Reel10" stripIndex="14">
            <Cell name="L0C2R2" stripIndex="14">s07</Cell>
        </Entry>
        <Entry name="Reel11" stripIndex="16">
            <Cell name="L0C2R3" stripIndex="16">s07</Cell>
        </Entry>
        <Entry name="Reel12" stripIndex="2">
            <Cell name="L0C3R0" stripIndex="2">s03</Cell>
        </Entry>
        <Entry name="Reel13" stripIndex="0">
            <Cell name="L0C3R1" stripIndex="0">s04</Cell>
        </Entry>
        <Entry name="Reel14" stripIndex="21">
            <Cell name="L0C3R2" stripIndex="21">s04</Cell>
        </Entry>
        <Entry name="Reel15" stripIndex="5">
            <Cell name="L0C3R3" stripIndex="5">s05</Cell>
        </Entry>
        <Entry name="Reel16" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="2">s03</Cell>
        </Entry>
        <Entry name="Reel17" stripIndex="11">
            <Cell name="L0C4R1" stripIndex="11">w01</Cell>
        </Entry>
        <Entry name="Reel18" stripIndex="18">
            <Cell name="L0C4R2" stripIndex="18">s04</Cell>
        </Entry>
        <Entry name="Reel19" stripIndex="21">
            <Cell name="L0C4R3" stripIndex="21">s05</Cell>
        </Entry>
    </PopulationOutcome>
    '.$display.'
    '.$winLines.$leftWinLines.'
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
        $highlightLeft = $this->getLeftHighlight($report['winLines'], 'FreeSpin', 'MultiWayLeftRight');
        $display = $this->getDisplayReels($report, false, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $leftWinLines = $this->getLeftWayWinLines($report, 'FreeSpin', 'MultiWayLeftRight');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $betPerLine = $report['bet'] / $report['linesCount'];
        $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');

        $awarded = 0;
        $scattersHighlight = '';
        if($report['scattersReport']['count'] > 1) {
            if($report['scattersReport']['count'] == 2) {
                $awarded = 10;
            }
            if($report['scattersReport']['count'] == 3) {
                $awarded = 15;
            }
            if($report['scattersReport']['count'] == 4) {
                $awarded = 20;
            }
            $_SESSION['totalAwarded'] += $awarded;
            $_SESSION['fsLeft'] += $awarded;
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
    '.$highlight.$highlightLeft.$scattersHighlight.$scattersPay.$display.$baseReels.'
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
    '.$winLines.$leftWinLines.'
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