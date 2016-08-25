<?
require_once('IGTCtrl.php');

class cash_coasterCtrl extends IGTCtrl {

    protected function startConfig($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $xml = '<params>
    <param name="softwareid" value="200-1232-001" />
    <param name="minbet" value="1.0" />
    <param name="availablebalance" value="0.0" />
    <param name="denomid" value="44" />
    <param name="gametitle" value="Cash Coaster" />
    <param name="terminalid" value="" />
    <param name="ipaddress" value="31.131.103.75" />
    <param name="affiliate" value="" />
    <param name="gameWindowHeight" value="815" />
    <param name="gameWindowWidth" value="1024" />
    <param name="nsbuyin" value="" />
    <param name="nscashout" value="" />
    <param name="cashiertype" value="N" />
    <param name="game" value="CashCoaster" />
    <param name="studio" value="interactive" />
    <param name="nsbuyinamount" value="" />
    <param name="buildnumber" value="4.2.F.O.CL104654_220" />
    <param name="autopull" value="N" />
    <param name="consoleCode" value="CSTM" />
    <param name="BCustomViewHeight" value="47" />
    <param name="BCustomViewWidth" value="1024" />
    <param name="consoleTimeStamp" value="1349855268588" />
    <param name="filtered" value="Y" />
    <param name="defaultbuyinamount" value="0.0" />
    <param name="xtautopull" value="" />
    <param name="server" value="../../../../../" />
    <param name="showInitialCashier" value="false" />
    <param name="audio" value="on" />
    <param name="nscode" value="MRGR" />
    <param name="uniqueid" value="Guest" />
    <param name="countrycode" value="" />
    <param name="presenttype" value="FLSH" />
    <param name="securetoken" value="" />
    <param name="denomamount" value="'.$this->getDenominationAmount().'" />
    <param name="skincode" value="MRGR" />
    <param name="language" value="en" />
    <param name="channel" value="INT" />
    <param name="currencycode" value="'.$this->gameParams->curiso.'" />
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
    <PaytableStatistics description="Cash Coaster 30L 3x3x3x3x3" maxRTP="96.06" minRTP="91.99" name="Cash Coaster" type="Slot"/>
    <PrizeInfo multiplierStrategy="null" name="PrizeInfoLines" strategy="PayBoth">
        <Prize name="s01">
            <PrizePay count="5" pph="633600" value="500"/>
            <PrizePay count="4" pph="30171.4" value="150"/>
            <PrizePay count="3" pph="2618.2" value="50"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s01" required="false"/>
        </Prize>
        <Prize name="s02">
            <PrizePay count="5" pph="52800" value="300"/>
            <PrizePay count="4" pph="8336.8" value="75"/>
            <PrizePay count="3" pph="1440" value="30"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s02" required="false"/>
        </Prize>
        <Prize name="s03">
            <PrizePay count="5" pph="31680" value="250"/>
            <PrizePay count="4" pph="5002.1" value="60"/>
            <PrizePay count="3" pph="864" value="20"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s03" required="false"/>
        </Prize>
        <Prize name="s04">
            <PrizePay count="5" pph="10560" value="200"/>
            <PrizePay count="4" pph="1667.4" value="30"/>
            <PrizePay count="3" pph="378.9" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s04" required="false"/>
        </Prize>
        <Prize name="s05">
            <PrizePay count="5" pph="5280" value="200"/>
            <PrizePay count="4" pph="833.7" value="30"/>
            <PrizePay count="3" pph="189.5" value="15"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s05" required="false"/>
        </Prize>
        <Prize name="s06">
            <PrizePay count="5" pph="5280" value="150"/>
            <PrizePay count="4" pph="1104.3" value="25"/>
            <PrizePay count="3" pph="224.6" value="10"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s06" required="false"/>
        </Prize>
        <Prize name="s07">
            <PrizePay count="5" pph="4224" value="125"/>
            <PrizePay count="4" pph="938.7" value="25"/>
            <PrizePay count="3" pph="202.1" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s07" required="false"/>
        </Prize>
        <Prize name="s08">
            <PrizePay count="5" pph="10560" value="100"/>
            <PrizePay count="4" pph="1667.4" value="20"/>
            <PrizePay count="3" pph="378.9" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s08" required="false"/>
        </Prize>
        <Prize name="s09">
            <PrizePay count="5" pph="5280" value="100"/>
            <PrizePay count="4" pph="833.7" value="20"/>
            <PrizePay count="3" pph="189.5" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s09" required="false"/>
        </Prize>
        <Prize name="s10">
            <PrizePay count="5" pph="5280" value="75"/>
            <PrizePay count="4" pph="1104.3" value="15"/>
            <PrizePay count="3" pph="224.6" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s10" required="false"/>
        </Prize>
        <Prize name="s11">
            <PrizePay count="5" pph="4224" value="75"/>
            <PrizePay count="4" pph="938.7" value="15"/>
            <PrizePay count="3" pph="202.1" value="5"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s11" required="false"/>
        </Prize>
        <Prize name="any7">
            <PrizePay count="5" pph="4224" value="40"/>
            <Symbol id="w01" required="false"/>
            <Symbol id="s01" required="false"/>
            <Symbol id="s02" required="false"/>
            <Symbol id="s03" required="false"/>
            <Symbol id="s04" required="false"/>
            <Symbol id="s05" required="false"/>
        </Prize>
    </PrizeInfo>
    <PrizeInfo name="PrizeInfoScatter" strategy="PayAny">
        <Prize name="b01">
            <PrizePay count="3" pph="142.4" value="1"/>
            <Symbol id="b01" required="true"/>
        </Prize>
    </PrizeInfo>
    <StripInfo name="BaseGame">
        <Strip name="Reel0">
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
        </Strip>
    </StripInfo>
    <StripInfo name="FreeSpin">
        <Strip name="Reel0">
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
        </Strip>
        <Strip name="Reel1">
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
        </Strip>
        <Strip name="Reel2">
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
        </Strip>
        <Strip name="Reel3">
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s02" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s01" weight="1"/>
            <Stop symbolID="s06" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s11" weight="1"/>
            <Stop symbolID="s04" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="s05" weight="1"/>
            <Stop symbolID="s10" weight="1"/>
            <Stop symbolID="s07" weight="1"/>
            <Stop symbolID="s03" weight="1"/>
            <Stop symbolID="s09" weight="1"/>
            <Stop symbolID="b01" weight="1"/>
            <Stop symbolID="s08" weight="1"/>
        </Strip>
        <Strip name="Reel4">
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
            <Stop symbolID="w01" weight="1"/>
        </Strip>
    </StripInfo>
    <PickerInfo name="Picker.PickerInfo" verifierStrategy="LayerPicker">
        <Layer index="0" name="layer0">
            <Pick cellName="Pick0" name="L0C0R0"/>
            <Pick cellName="Pick1" name="L0C1R0"/>
            <Pick cellName="Pick2" name="L0C2R0"/>
        </Layer>
        <MinPicks>1</MinPicks>
        <MaxPicksPerTurn>1</MaxPicksPerTurn>
        <MaxTotalPicks>50</MaxTotalPicks>
        <UniquePickRequired>true</UniquePickRequired>
        <MultiplePicksAllowed>false</MultiplePicksAllowed>
        <InitialLayer>0</InitialLayer>
        <InitialPickCount>1</InitialPickCount>
        <Initial>false</Initial>
        <RevealLayer>true</RevealLayer>
        <RevealAll>true</RevealAll>
        <OutcomeTrigger name="FreeSpin"/>
        <ExitOutcomeTrigger name="FreeSpin"/>
        <Triggers/>
        <Increment>
            <Strategy>NoIncrement</Strategy>
            <Triggers/>
        </Increment>
        <Decrement>
            <Strategy>PickSize</Strategy>
            <Count>0</Count>
            <Triggers/>
        </Decrement>
    </PickerInfo>
    <FreeSpinInfo name="FreeSpin.FreeSpinInfo">
        <Reset>false</Reset>
        <Increment>
            <Strategy> HighestOnly </Strategy>
            <MaxFreeSpins> 200  </MaxFreeSpins>
            <Triggers>
                <Trigger freespins="0" name="3 b01"/>
                <Trigger freespins="4" name="4spins"/>
                <Trigger freespins="5" name="5spins"/>
                <Trigger freespins="6" name="6spins"/>
                <Trigger freespins="4" name="4spinsRetrigger"/>
                <Trigger freespins="5" name="5spinsRetrigger"/>
                <Trigger freespins="6" name="6spinsRetrigger"/>
            </Triggers>
        </Increment>
        <Decrement>
            <Strategy> ConstantDecrement </Strategy>
            <Count> 1  </Count>
        </Decrement>
        <OutcomeTrigger name="FreeSpin"/>
    </FreeSpinInfo>
    <PatternSliderInfo>
        <PatternInfo max="40" min="40">
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
        <Denomination softwareId="200-1232-001">1.0</Denomination>
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
        <GameLogicVersion>2.0</GameLogicVersion>
    </VersionInfo>
</PaytableResponse>';

        $this->outXML($xml);
    }

    protected function startInit($request) {
        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = $_SESSION['fsState'];
        }

        $fs = '';
        if($_SESSION['state'] == 'FREE') {
            $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));

            $fs = '<FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>0</Awarded>
        <TotalAwarded>'.$_SESSION['totalPLAY'].'</TotalAwarded>
        <Count>'.($_SESSION['fsPlayed'] + $_SESSION['prePLAY']).'</Count>
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
    '.$baseScatter.'
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="L0C0R0" stripIndex="1">
            <Cell name="L0C0R0" stripIndex="1">spins,4</Cell>
        </Entry>
        <Entry name="L0C1R0" stripIndex="0">
            <Cell name="L0C1R0" stripIndex="0">spins,5</Cell>
        </Entry>
        <Entry name="L0C2R0" stripIndex="2">
            <Cell name="L0C2R0" stripIndex="2">spins,6</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>A2310-14264037677168</TransactionId>
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
        <Entry name="Reel0" stripIndex="17">
            <Cell name="L0C0R0" stripIndex="15">s11</Cell>
            <Cell name="L0C0R1" stripIndex="16">s01</Cell>
            <Cell name="L0C0R2" stripIndex="17">s06</Cell>
            <Cell name="L0C0R3" stripIndex="18">s05</Cell>
            <Cell name="L0C0R4" stripIndex="19">s10</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="34">
            <Cell name="L0C1R0" stripIndex="32">s04</Cell>
            <Cell name="L0C1R1" stripIndex="33">s02</Cell>
            <Cell name="L0C1R2" stripIndex="34">s01</Cell>
            <Cell name="L0C1R3" stripIndex="35">s10</Cell>
            <Cell name="L0C1R4" stripIndex="36">s07</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="103">
            <Cell name="L0C2R0" stripIndex="101">s02</Cell>
            <Cell name="L0C2R1" stripIndex="102">s11</Cell>
            <Cell name="L0C2R2" stripIndex="103">b01</Cell>
            <Cell name="L0C2R3" stripIndex="104">s06</Cell>
            <Cell name="L0C2R4" stripIndex="105">s04</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="17">
            <Cell name="L0C3R0" stripIndex="15">s02</Cell>
            <Cell name="L0C3R1" stripIndex="16">s06</Cell>
            <Cell name="L0C3R2" stripIndex="17">s03</Cell>
            <Cell name="L0C3R3" stripIndex="18">b01</Cell>
            <Cell name="L0C3R4" stripIndex="19">s10</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="6">
            <Cell name="L0C4R0" stripIndex="4">s01</Cell>
            <Cell name="L0C4R1" stripIndex="5">s08</Cell>
            <Cell name="L0C4R2" stripIndex="6">s11</Cell>
            <Cell name="L0C4R3" stripIndex="7">s04</Cell>
            <Cell name="L0C4R4" stripIndex="8">s06</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="0">w01</Cell>
            <Cell name="L0C0R1" stripIndex="1">w01</Cell>
            <Cell name="L0C0R2" stripIndex="2">w01</Cell>
            <Cell name="L0C0R3" stripIndex="3">w01</Cell>
            <Cell name="L0C0R4" stripIndex="4">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="4">s11</Cell>
            <Cell name="L0C1R1" stripIndex="5">s11</Cell>
            <Cell name="L0C1R2" stripIndex="6">s01</Cell>
            <Cell name="L0C1R3" stripIndex="7">s08</Cell>
            <Cell name="L0C1R4" stripIndex="8">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="18">s03</Cell>
            <Cell name="L0C2R1" stripIndex="19">s07</Cell>
            <Cell name="L0C2R2" stripIndex="20">s06</Cell>
            <Cell name="L0C2R3" stripIndex="21">b01</Cell>
            <Cell name="L0C2R4" stripIndex="22">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="4">s11</Cell>
            <Cell name="L0C3R1" stripIndex="5">s05</Cell>
            <Cell name="L0C3R2" stripIndex="6">s09</Cell>
            <Cell name="L0C3R3" stripIndex="7">s10</Cell>
            <Cell name="L0C3R4" stripIndex="8">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="0">w01</Cell>
            <Cell name="L0C4R1" stripIndex="1">w01</Cell>
            <Cell name="L0C4R2" stripIndex="2">w01</Cell>
            <Cell name="L0C4R3" stripIndex="3">w01</Cell>
            <Cell name="L0C4R4" stripIndex="4">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <TriggerOutcome component="" name="MysteryTrigger" stage="" />
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
        if(!isset($_SESSION['fsType'])) {

            $pick = (array) $request['PickerInput']->Pick;
            $pick = $pick['@attributes']['name'];
            $pick = $pick[3];
            $_SESSION['fsType'] = $pick;

            $_SESSION['fsState'] = 'FreeSpin';

            $this->showPickInfo($request);
        }
        else {
            $_SESSION['fsState'] = 'FreeSpin';
            $stake = $_SESSION['lastBet'];
            $pick = $_SESSION['lastPick'];

            $this->slot = new Slot($this->gameParams, $pick, $stake);
            $this->slot->createCustomReels($this->gameParams->reels[1], array(3,3,3,3,3));
            $this->slot->rows = 3;

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
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array();

        if(rnd(1, $this->gameParams->wildChance) == 1) {
            $r = rnd(0,1);
            $reelNumber = ($r == 1) ? 0 : 4;
            $bonus = array(
                'type' => 'fullWildReels',
                'reels' => array($reelNumber),
            );
        }
        if(rnd(1, $this->gameParams->doubleWildChance) == 1) {
            $bonus = array(
                'type' => 'fullWildReels',
                'reels' => array(0,4),
            );
        }

        if($_SESSION['state'] == 'FREE') {
            $bonus = array(
                'type' => 'fullWildReels',
                'reels' => array(0,4),
            );
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $multiple = 30;
            $report['type'] = 'FREE';
            $report['scattersReport']['totalWin'] = $report['betOnLine'] * $multiple;
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
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 1);
        $display = $this->getDisplay($report, true, 'BaseGame', 'Reels', 'startFullRows');
        $display2 = $this->getDisplay($report, true, 'BaseGame', 'TransformedReels');
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];

        $mystery = '<PopulationOutcome name="BaseGame.MysteryFeature" stage="BaseGame">
        <Entry name="MysteryFeature" stripIndex="0">
            <Cell name="L0C5R0" stripIndex="0">inactive</Cell>
        </Entry>
    </PopulationOutcome>';
        if(!empty($report['bonusData'])) {
            $mystery = '<PopulationOutcome name="BaseGame.MysteryFeature" stage="BaseGame">';
            $transform = '<HighlightOutcome name="BaseGame.TransformedReels" type="">';
            $trigger = '<TriggerOutcome component="" name="MysteryTrigger" stage="">';
            foreach($report['bonusData']['reels'] as $r) {
                if($r == 0) {
                    $transform .= '<Highlight name="CoasterReel1" type="">
            <Cell name="L0C0R0" type="" />
            <Cell name="L0C0R1" type="" />
            <Cell name="L0C0R2" type="" />
            <Cell name="L0C0R3" type="" />
            <Cell name="L0C0R4" type="" />
        </Highlight>';
                    $trigger .= '<Trigger name="CoasterReel1" priority="0" stageConnector="" />';

                    $mystery .= '<Entry name="MysteryFeature" stripIndex="1">
            <Cell name="L0C5R0" stripIndex="1">CoasterReel1</Cell>
        </Entry>';
                }
                if($r == 4) {
                    $transform .= '<Highlight name="CoasterReel5" type="">
            <Cell name="L0C4R0" type="" />
            <Cell name="L0C4R1" type="" />
            <Cell name="L0C4R2" type="" />
            <Cell name="L0C4R3" type="" />
            <Cell name="L0C4R4" type="" />
        </Highlight>';
                    $trigger .= '<Trigger name="CoasterReel5" priority="10" stageConnector="" />';

                    $mystery .= '<Entry name="MysteryFeature" stripIndex="2">
            <Cell name="L0C5R0" stripIndex="2">CoasterReel5</Cell>
        </Entry>';
                }
            }
            $transform .= '</HighlightOutcome>';
            $trigger .= '</TriggerOutcome>';
            $mystery .= '</PopulationOutcome>';
        }
        else {
            $transform = '<HighlightOutcome name="BaseGame.TransformedReels" type="" />';
            $trigger = '<TriggerOutcome component="" name="MysteryTrigger" stage="" />';
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
    <HighlightOutcome name="BaseGame.Scatter" type=""/>
    '.$transform.$highlight.'
    <TriggerOutcome component="" name="Picker" stage="" />
    '.$trigger.'
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
    '.$display2.$display.$mystery.'
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="0">w01</Cell>
            <Cell name="L0C0R1" stripIndex="1">w01</Cell>
            <Cell name="L0C0R2" stripIndex="2">w01</Cell>
            <Cell name="L0C0R3" stripIndex="3">w01</Cell>
            <Cell name="L0C0R4" stripIndex="4">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="4">s11</Cell>
            <Cell name="L0C1R1" stripIndex="5">s11</Cell>
            <Cell name="L0C1R2" stripIndex="6">s01</Cell>
            <Cell name="L0C1R3" stripIndex="7">s08</Cell>
            <Cell name="L0C1R4" stripIndex="8">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="18">s03</Cell>
            <Cell name="L0C2R1" stripIndex="19">s07</Cell>
            <Cell name="L0C2R2" stripIndex="20">s06</Cell>
            <Cell name="L0C2R3" stripIndex="21">b01</Cell>
            <Cell name="L0C2R4" stripIndex="22">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="4">s11</Cell>
            <Cell name="L0C3R1" stripIndex="5">s05</Cell>
            <Cell name="L0C3R2" stripIndex="6">s09</Cell>
            <Cell name="L0C3R3" stripIndex="7">s10</Cell>
            <Cell name="L0C3R4" stripIndex="8">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="0">w01</Cell>
            <Cell name="L0C4R1" stripIndex="1">w01</Cell>
            <Cell name="L0C4R2" stripIndex="2">w01</Cell>
            <Cell name="L0C4R3" stripIndex="3">w01</Cell>
            <Cell name="L0C4R4" stripIndex="4">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>0</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="0" stage="" totalPay="0" type="Pattern"/>
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



    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'BaseGame.Scatter', 1);
        $scattersPay = $this->getScattersPay($report['scattersReport']);
        $highlight = $this->getHighlight($report['winLines'], 'BaseGame.Lines', 1);
        $display = $this->getDisplay($report, true);
        $winLines = $this->getWinLines($report);
        $betPerLine = $report['bet'] / $report['linesCount'];


        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];

        $_SESSION['startBalance'] = $balance-$totalWin;

        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['fsState'] = 'Picker';

        if(!empty($report['bonusData'])) {
            $transform = '<HighlightOutcome name="BaseGame.TransformedReels" type="">';
            $trigger = '<TriggerOutcome component="" name="MysteryTrigger" stage="">';
            foreach($report['bonusData']['reels'] as $r) {
                if($r == 0) {
                    $transform .= '<Highlight name="CoasterReel1" type="">
            <Cell name="L0C0R0" type="" />
            <Cell name="L0C0R1" type="" />
            <Cell name="L0C0R2" type="" />
            <Cell name="L0C0R3" type="" />
            <Cell name="L0C0R4" type="" />
        </Highlight>';
                    $trigger .= '<Trigger name="CoasterReel1" priority="0" stageConnector="" />';
                }
                if($r == 4) {
                    $transform .= '<Highlight name="CoasterReel5" type="">
            <Cell name="L0C4R0" type="" />
            <Cell name="L0C4R1" type="" />
            <Cell name="L0C4R2" type="" />
            <Cell name="L0C4R3" type="" />
            <Cell name="L0C4R4" type="" />
        </Highlight>';
                    $trigger .= '<Trigger name="CoasterReel5" priority="0" stageConnector="" />';
                }
            }
            $transform .= '</HighlightOutcome>';
            $trigger .= '</TriggerOutcome>';
        }
        else {
            $transform = '<HighlightOutcome name="BaseGame.TransformedReels" type="" />';
            $trigger = '';
        }


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1540-14228693316850</TransactionId>
        <Stage>BaseGame</Stage>
        <NextStage>Picker</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>'.$report['bet'].'</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$scattersHighlight.$transform.$trigger.$highlight.'
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="Picker" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="MysteryTrigger" stage="" />
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
    <PopulationOutcome name="BaseGame.MysteryFeature" stage="BaseGame">
        <Entry name="MysteryFeature" stripIndex="0">
            <Cell name="L0C5R0" stripIndex="0">inactive</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="0">w01</Cell>
            <Cell name="L0C0R1" stripIndex="1">w01</Cell>
            <Cell name="L0C0R2" stripIndex="2">w01</Cell>
            <Cell name="L0C0R3" stripIndex="3">w01</Cell>
            <Cell name="L0C0R4" stripIndex="4">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="4">s11</Cell>
            <Cell name="L0C1R1" stripIndex="5">s11</Cell>
            <Cell name="L0C1R2" stripIndex="6">s01</Cell>
            <Cell name="L0C1R3" stripIndex="7">s08</Cell>
            <Cell name="L0C1R4" stripIndex="8">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="18">s03</Cell>
            <Cell name="L0C2R1" stripIndex="19">s07</Cell>
            <Cell name="L0C2R2" stripIndex="20">s06</Cell>
            <Cell name="L0C2R3" stripIndex="21">b01</Cell>
            <Cell name="L0C2R4" stripIndex="22">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="4">s11</Cell>
            <Cell name="L0C3R1" stripIndex="5">s05</Cell>
            <Cell name="L0C3R2" stripIndex="6">s09</Cell>
            <Cell name="L0C3R3" stripIndex="7">s10</Cell>
            <Cell name="L0C3R4" stripIndex="8">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="0">w01</Cell>
            <Cell name="L0C4R1" stripIndex="1">w01</Cell>
            <Cell name="L0C4R2" stripIndex="2">w01</Cell>
            <Cell name="L0C4R3" stripIndex="3">w01</Cell>
            <Cell name="L0C4R4" stripIndex="4">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>1</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$scattersPay.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0"/>
    </PrizeOutcome>
    <TransactionId>R0140-14353242665419</TransactionId>
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

        $_SESSION['totalPLAY'] = 0;
        $_SESSION['prePLAY'] = 0;

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 0;
        $_SESSION['fsLeft'] = 0;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['initAwarded'] = 0;
        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatter'] = base64_encode(gzcompress($scattersHighlight.$highlight.$winLines, 9));
        $_SESSION['pickerCount'] = 1;
    }




    protected function showPickInfo($request) {
        $pick = (array) $request['PickerInput']->Pick->attributes()->name;
        $balance = $this->getBalance();
        $display2 = $this->getDisplayByReel($this->gameParams->reels[1], false, 'FreeSpin');
        $baseReels = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        $baseScatter = gzuncompress(base64_decode($_SESSION['baseScatter']));

        $fsWin = $_SESSION['fsTotalWin'];

        $totalWin = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];

        $leftArray = array();

        if($pick[0] == 'L0C0R0') {
            $leftArray = array('L0C1R0', 'L0C2R0');
        }
        if($pick[0] == 'L0C1R0') {
            $leftArray = array('L0C0R0', 'L0C2R0');
        }

        if($pick[0] == 'L0C2R0') {
            $leftArray = array('L0C0R0', 'L0C1R0');
        }



        $fsArray = array(4,5,6);
        shuffle($fsArray);

        $_SESSION['totalAwarded'] = $fsArray[0];
        $_SESSION['fsLeft'] = $fsArray[0];
        $_SESSION['initAwarded'] = $fsArray[0];


        $_SESSION['prePLAY'] = $_SESSION['totalPLAY'];
        $_SESSION['totalPLAY'] += $fsArray[0];


        $xml = '<GameLogicResponse>
    <OutcomeDetail>
        <TransactionId>R1440-14353204666097</TransactionId>
        <Stage>Picker</Stage>
        <NextStage>FreeSpin</NextStage>
        <Balance>'.$balance.'</Balance>
        <GameStatus>InProgress</GameStatus>
        <Settled>0</Settled>
        <Pending>40</Pending>
        <Payout>0</Payout>
    </OutcomeDetail>
    '.$baseScatter.'
    <TriggerOutcome component="" name="Picker" stage="">
        <Trigger name="FreeSpin" priority="0" stageConnector="" />
    </TriggerOutcome>
    <TriggerOutcome component="" name="MysteryTrigger" stage="" />
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>'.$_SESSION['initAwarded'].'</Awarded>
        <TotalAwarded>'.$_SESSION['totalPLAY'].'</TotalAwarded>
        <Count>'.$_SESSION['prePLAY'].'</Count>
        <Countdown>'.($_SESSION['totalAwarded'] + $_SESSION['prePLAY']).'</Countdown>
        <IncrementTriggered>true</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerOutcome name="">
        <Layer index="0" name="layer0">
            <Pick name="'.$pick[0].'" picked="true">
                <Feature type="spins" value="'.$fsArray[0].'" />
            </Pick>
            <Pick name="'.$leftArray[0].'" picked="false">
                <Feature type="spins" value="'.$fsArray[1].'" />
            </Pick>
            <Pick name="'.$leftArray[1].'" picked="false">
                <Feature type="spins" value="'.$fsArray[2].'" />
            </Pick>
        </Layer>
    </PickerOutcome>
    <PopulationOutcome name="Picker.PresetPickPopulation" stage="Picker">
        <Entry name="PresetPickPopulation" stripIndex="3">
            <Cell name="L0C0R0" stripIndex="4">spins,'.$fsArray[0].',spins,'.$fsArray[1].',spins,'.$fsArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="Picker.Picks" stage="Picker">
        <Entry name="'.$pick[0].'" stripIndex="1">
            <Cell name="'.$pick[0].'" stripIndex="1">spins,'.$fsArray[0].'</Cell>
        </Entry>
        <Entry name="'.$leftArray[0].'" stripIndex="0">
            <Cell name="'.$leftArray[0].'" stripIndex="2">spins,'.$fsArray[1].'</Cell>
        </Entry>
        <Entry name="'.$leftArray[1].'" stripIndex="0">
            <Cell name="'.$leftArray[1].'" stripIndex="2">spins,'.$fsArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    '.$baseReels.'
    <PopulationOutcome name="Picker.PresetSplit" stage="Picker">
        <Entry name="'.$pick[0].'" stripIndex="0">
            <Cell name="'.$pick[0].'" stripIndex="0">spins,'.$fsArray[0].'</Cell>
        </Entry>
        <Entry name="'.$leftArray[0].'" stripIndex="0">
            <Cell name="'.$leftArray[0].'" stripIndex="0">spins,'.$fsArray[1].'</Cell>
        </Entry>
        <Entry name="'.$leftArray[1].'" stripIndex="0">
            <Cell name="'.$leftArray[1].'" stripIndex="0">spins,'.$fsArray[2].'</Cell>
        </Entry>
    </PopulationOutcome>
    <PopulationOutcome name="FreeSpin.Reels" stage="FreeSpin">
        <Entry name="Reel0" stripIndex="2">
            <Cell name="L0C0R0" stripIndex="0">w01</Cell>
            <Cell name="L0C0R1" stripIndex="1">w01</Cell>
            <Cell name="L0C0R2" stripIndex="2">w01</Cell>
            <Cell name="L0C0R3" stripIndex="3">w01</Cell>
            <Cell name="L0C0R4" stripIndex="4">w01</Cell>
        </Entry>
        <Entry name="Reel1" stripIndex="6">
            <Cell name="L0C1R0" stripIndex="4">s11</Cell>
            <Cell name="L0C1R1" stripIndex="5">s11</Cell>
            <Cell name="L0C1R2" stripIndex="6">s01</Cell>
            <Cell name="L0C1R3" stripIndex="7">s08</Cell>
            <Cell name="L0C1R4" stripIndex="8">s03</Cell>
        </Entry>
        <Entry name="Reel2" stripIndex="20">
            <Cell name="L0C2R0" stripIndex="18">s03</Cell>
            <Cell name="L0C2R1" stripIndex="19">s07</Cell>
            <Cell name="L0C2R2" stripIndex="20">s06</Cell>
            <Cell name="L0C2R3" stripIndex="21">b01</Cell>
            <Cell name="L0C2R4" stripIndex="22">s09</Cell>
        </Entry>
        <Entry name="Reel3" stripIndex="6">
            <Cell name="L0C3R0" stripIndex="4">s11</Cell>
            <Cell name="L0C3R1" stripIndex="5">s05</Cell>
            <Cell name="L0C3R2" stripIndex="6">s09</Cell>
            <Cell name="L0C3R3" stripIndex="7">s10</Cell>
            <Cell name="L0C3R4" stripIndex="8">s01</Cell>
        </Entry>
        <Entry name="Reel4" stripIndex="2">
            <Cell name="L0C4R0" stripIndex="0">w01</Cell>
            <Cell name="L0C4R1" stripIndex="1">w01</Cell>
            <Cell name="L0C4R2" stripIndex="2">w01</Cell>
            <Cell name="L0C4R3" stripIndex="3">w01</Cell>
            <Cell name="L0C4R4" stripIndex="4">w01</Cell>
        </Entry>
    </PopulationOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>0</PicksRemaining>
        <PickCount>1</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>0</Awarded>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$totalWin.'" stage="" totalPay="'.$totalWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$totalWin.'" payName="" symbolCount="0" totalPay="'.$totalWin.'" ways="0" />
    </PrizeOutcome>
    <TransactionId>R1440-14353204661190</TransactionId>
    <ActionInput>
        <Action>play</Action>
    </ActionInput>
    <PatternSliderInput>
        <BetPerPattern>'.($_SESSION['lastBet']/$_SESSION['lastPick']).'</BetPerPattern>
        <PatternsBet>'.$_SESSION['lastPick'].'</PatternsBet>
    </PatternSliderInput>
    <PickerInput>
        <Pick name="'.$pick[0].'" />
    </PickerInput>
    <Balances totalBalance="'.$balance.'">
        <Balance name="FREE">'.$balance.'</Balance>
    </Balances>
</GameLogicResponse>';

        $this->outXML($xml);

        $_SESSION['pickerCount']--;
    }




    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines', 1);
        $display = $this->getDisplay($report, true, 'FreeSpin');
        $winLines = $this->getWinLines($report, 'FreeSpin');
        $betPerLine = $report['bet'] / $report['linesCount'];

        $awarded = 0;
        $scattersHighlight = '';
        $scattersPay = '';
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['pickerCount']++;
            $awarded = 1;
            $scattersHighlight = $this->getScattersHighlight($report['scattersReport']['offsets'], 'FreeSpin.Scatter', 1);
            $scattersPay = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
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

            if($_SESSION['pickerCount'] > 0) {
                $nextStage = 'Picker';
                $_SESSION['fsState'] = 'Picker';
            }
        }



        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

        $gameTotal = $_SESSION['baseWinLinesWin'] + $_SESSION['fsTotalWin'];

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
    '.$highlight.$scattersHighlight.'
    <AwardCapOutcome name="AwardCap">
        <AwardCapExceeded>false</AwardCapExceeded>
    </AwardCapOutcome>
    <FreeSpinOutcome name="">
        <InitAwarded>'.$_SESSION['initAwarded'].'</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <TotalAwarded>'.$_SESSION['totalPLAY'].'</TotalAwarded>
        <Count>'.($_SESSION['fsPlayed'] + $_SESSION['prePLAY']).'</Count>
        <Countdown>'.$_SESSION['fsLeft'].'</Countdown>
        <IncrementTriggered>false</IncrementTriggered>
        <MaxAwarded>false</MaxAwarded>
        <MaxSpinsHit>false</MaxSpinsHit>
    </FreeSpinOutcome>
    <PickerSummaryOutcome name="">
        <PicksRemaining>'.$_SESSION['pickerCount'].'</PicksRemaining>
        <PickCount>0</PickCount>
        <CurrentLayer index="0" name="layer0" />
        <InitAwarded>1</InitAwarded>
        <Awarded>'.$awarded.'</Awarded>
        <IncrementTriggered>'.(($awarded > 0) ? 'true' : 'false').'</IncrementTriggered>
        <MaxPicksAwarded>false</MaxPicksAwarded>
    </PickerSummaryOutcome>
    '.$baseReels.$display.'

    <PrizeOutcome multiplier="1" name="BaseGame.Scatter" pay="'.$_SESSION['scatterWin'].'" stage="" totalPay="'.$_SESSION['scatterWin'].'" type="Pattern">
        <Prize betMultiplier="100" multiplier="1" name="Scatter" pay="2" payName="3 b01" symbolCount="3" totalPay="'.$_SESSION['scatterWin'].'" ways="0" />
    </PrizeOutcome>

    <PrizeOutcome multiplier="1" name="FreeSpin.Total" pay="'.$fsWin.'" stage="" totalPay="'.$fsWin.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$fsWin.'" payName="" symbolCount="0" totalPay="'.$fsWin.'" ways="0"/>
    </PrizeOutcome>
    '.$winLines.'
    <PrizeOutcome multiplier="1" name="Game.Total" pay="'.$gameTotal.'" stage="" totalPay="'.$gameTotal.'" type="">
        <Prize betMultiplier="1" multiplier="1" name="Total" pay="'.$gameTotal.'" payName="" symbolCount="0" totalPay="'.$gameTotal.'" ways="0" />
    </PrizeOutcome>
    '.$scattersPay.'
    <TransactionId>R1540-14228769811020</TransactionId>
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


        if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['fsState']);
            unset($_SESSION['initAwarded']);
            unset($_SESSION['fsType']);
            unset($_SESSION['baseWinLinesWin']);
            unset($_SESSION['totalPLAY']);
            unset($_SESSION['prePLAY']);
        }
        else {
            if($_SESSION['fsLeft'] == 0 && $_SESSION['pickerCount'] > 0) {
                unset($_SESSION['fsType']);
                $_SESSION['fsPlayed'] = 0;
            }
        }

    }

}
