<?
require_once('QFCtrl.php');
class jurassic_parkCtrl extends QFCtrl {

    protected function startLogin($request) {
        $xml = '<Pkt><Id mid="1" cid="10001" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="Login" Inverb="Login" /><Response><Credentials UserType="5" SessionNumber="66997314" /><PlayerInfo Balance="200000" LoginName="1867Demo1169" /><SessionAuthentication token="6e3a59bc-ef43-4ee0-b8e2-0b2df8439787" userId="114288" /><Loyalty pointBalance="0" /><LSR AcquisitionType="0" /><FC ID1="19A05967-E032-48CB-8262-436E9563D6AC" /></Response></Pkt>';

        $this->outXML($xml);
    }

    protected function startInformation($request) {
        $xml = '<Pkt><Id mid="151" cid="1" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="PlayerInformationRequest" Inverb="PlayerInformationRequest"/><Response><PlayerInfo><RegistrationInfo><FirstName>Microgaming</FirstName><Surname>Systems</Surname><City>Dbn</City><CasinoID>1867</CasinoID><CasinoName>Quickfire Demo Play MAL</CasinoName><RegisteredCountry>ZAF</RegisteredCountry><RegisteredState /><ZipCode>4001</ZipCode><UserType>Demo User</UserType><DateOfBirth>1969-01-20T00:00:00</DateOfBirth><HasPurchased>0</HasPurchased><IsVIP>0</IsVIP></RegistrationInfo><SessionInfo><SessionCountry>UKR</SessionCountry><SessionState /><Currency /><ThrottleDownloads>1</ThrottleDownloads><CurrencyISOCode /><CurrencyMultiplier>1</CurrencyMultiplier><Alias>Al</Alias><CurrencyDisplayFormat>$#,###.##</CurrencyDisplayFormat></SessionInfo></PlayerInfo></Response></Pkt>';
        $this->outXML($xml);
    }

    protected function startHiddenList($request) {
        $xml = '<Pkt><Id mid="144" cid="10001" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="GetHiddenGameList" Inverb="GetHiddenGameList" /><Response show="0" download="0" message="0"><Game mid="2" cid="10" /><Game mid="8" cid="1" /><Game mid="8" cid="2" /><Game mid="8" cid="3" /><Game mid="8" cid="10001" /><Game mid="8" cid="10002" /><Game mid="8" cid="20101" /><Game mid="8" cid="30001" /><Game mid="8" cid="40001" /><Game mid="8" cid="40002" /><Game mid="8" cid="40003" /><Game mid="8" cid="40004" /><Game mid="8" cid="40005" /><Game mid="8" cid="51978" /><Game mid="8" cid="51983" /><Game mid="38" cid="1" /><Game mid="58" cid="1" /><Game mid="58" cid="10001" /><Game mid="64" cid="10001" /><Game mid="67" cid="1" /><Game mid="67" cid="2" /><Game mid="67" cid="3" /><Game mid="68" cid="1" /><Game mid="70" cid="1" /><Game mid="119" cid="10002" /><Game mid="129" cid="4" /><Game mid="129" cid="10003" /><Game mid="129" cid="17002" /><Game mid="133" cid="10002" /><Game mid="143" cid="3" /><Game mid="143" cid="10002" /><Game mid="148" cid="10002" /><Game mid="10056" cid="10002" /><Game mid="10154" cid="1" /><Game mid="10154" cid="10001" /><Game mid="10182" cid="17001" /><Game mid="10184" cid="1" /><Game mid="10191" cid="17002" /><Game mid="10200" cid="2" /><Game mid="10200" cid="10002" /><Game mid="10204" cid="17002" /><Game mid="10205" cid="1" /><Game mid="10206" cid="3" /><Game mid="10206" cid="10003" /><Game mid="10208" cid="10001" /><Game mid="10208" cid="17001" /><Game mid="10211" cid="1" /><Game mid="10213" cid="17001" /><Game mid="10216" cid="40600" /><Game mid="10217" cid="10001" /><Game mid="10223" cid="17001" /><Game mid="10235" cid="1" /><Game mid="10237" cid="10001" /><Game mid="10239" cid="17001" /><Game mid="10250" cid="1" /><Game mid="10255" cid="1" /><Game mid="10263" cid="1" /><Game mid="10263" cid="17001" /><Game mid="10264" cid="10001" /><Game mid="10265" cid="1" /><Game mid="10266" cid="1" /><Game mid="10267" cid="1" /><Game mid="10268" cid="1" /><Game mid="10268" cid="17001" /><Game mid="10269" cid="17001" /><Game mid="10270" cid="1" /><Game mid="10270" cid="17001" /><Game mid="10271" cid="17001" /><Game mid="10272" cid="17001" /><Game mid="10274" cid="17001" /><Game mid="10276" cid="17001" /><Game mid="10278" cid="10001" /><Game mid="10279" cid="17001" /><Game mid="10280" cid="1" /><Game mid="10281" cid="17001" /><Game mid="10282" cid="17001" /><Game mid="10284" cid="17001" /><Game mid="10286" cid="1" /><Game mid="10286" cid="10001" /><Game mid="10287" cid="1" /><Game mid="10287" cid="10001" /><Game mid="10288" cid="1" /><Game mid="10289" cid="1" /><Game mid="10289" cid="10001" /><Game mid="10290" cid="1" /><Game mid="10290" cid="10001" /><Game mid="10291" cid="17001" /><Game mid="10293" cid="10001" /><Game mid="10294" cid="1" /><Game mid="10304" cid="17001" /><Game mid="10310" cid="1" /><Game mid="10310" cid="10001" /><Game mid="10314" cid="2" /><Game mid="10314" cid="10002" /><Game mid="10316" cid="1" /><Game mid="10316" cid="10001" /><Game mid="10323" cid="1" /><Game mid="10323" cid="10001" /><Game mid="10354" cid="1" /><Game mid="10354" cid="10001" /><Game mid="10362" cid="1" /><Game mid="10362" cid="10001" /><Game mid="10363" cid="1" /><Game mid="10363" cid="10001" /><Game mid="10364" cid="1" /><Game mid="10364" cid="10001" /><Game mid="10377" cid="10001" /><Game mid="10381" cid="10001" /><Game mid="10382" cid="1" /><Game mid="10382" cid="10001" /><Game mid="10385" cid="10001" /><Game mid="10394" cid="1" /><Game mid="10394" cid="10001" /><Game mid="10395" cid="1" /><Game mid="10395" cid="10001" /><Game mid="10450" cid="10001" /><Game mid="11016" cid="2" /><Game mid="11016" cid="3" /><Game mid="11016" cid="4" /><Game mid="11016" cid="10002" /><Game mid="11054" cid="10001" /><Game mid="11062" cid="10001" /><Game mid="11068" cid="10001" /><Game mid="11068" cid="10002" /><Game mid="11081" cid="1" /><Game mid="11081" cid="10001" /><Game mid="11086" cid="3" /><Game mid="11086" cid="10001" /><Game mid="11086" cid="10003" /><Game mid="11087" cid="4" /><Game mid="11087" cid="10002" /><Game mid="11092" cid="2" /><Game mid="11151" cid="10001" /><Game mid="11151" cid="10002" /><Game mid="11153" cid="1" /><Game mid="11153" cid="10001" /><Game mid="11172" cid="10001" /><Game mid="12506" cid="5" /><Game mid="12506" cid="10005" /><Game mid="12667" cid="10001" /><Game mid="12671" cid="10002" /><Game mid="12684" cid="10001" /><Game mid="12686" cid="10001" /><Game mid="12688" cid="10001" /><Game mid="12771" cid="1" /><Game mid="12772" cid="10002" /><Game mid="12820" cid="1" /><Game mid="12820" cid="10001" /><Game mid="12825" cid="10001" /><Game mid="12856" cid="2" /><Game mid="12856" cid="10003" /><Game mid="13000" cid="10002" /><Game mid="14027" cid="1" /><Game mid="14027" cid="10001" /><Game mid="14039" cid="10001" /><Game mid="14040" cid="10001" /><Game mid="14043" cid="10001" /><Game mid="15002" cid="10001" /><Game mid="15010" cid="1" /><Game mid="15010" cid="10001" /><Game mid="15010" cid="17001" /><Game mid="18500" cid="17001" /><Game mid="27601" cid="10001" /><Game mid="29019" cid="1" /><Game mid="29020" cid="1" /><Game mid="29021" cid="1" /><Game mid="29022" cid="1" /><Game mid="30002" cid="1" /><Game mid="60001" cid="1" /><Game mid="60001" cid="2" /><Game mid="60001" cid="10001" /><Game mid="60001" cid="10002" /><Game mid="60006" cid="1" /><Game mid="60006" cid="2" /><Game mid="60006" cid="3" /><Game mid="60006" cid="10001" /><Game mid="60006" cid="10002" /><Game mid="60006" cid="10003" /><Game mid="60006" cid="10004" /><Game mid="60008" cid="1" /><Game mid="60008" cid="2" /><Game mid="60008" cid="10001" /><Game mid="60008" cid="10002" /><Game mid="60009" cid="1" /><Game mid="60009" cid="2" /><Game mid="60009" cid="10001" /><Game mid="60009" cid="10002" /><Game mid="60009" cid="17001" /><Game mid="60010" cid="1" /><Game mid="60010" cid="10001" /><Game mid="60014" cid="1" /><Game mid="60014" cid="10001" /><Game mid="60016" cid="1" /><Game mid="60016" cid="10001" /><Game mid="60018" cid="10001" /><Game mid="60020" cid="1" /><Game mid="60020" cid="2" /><Game mid="60020" cid="10001" /><Game mid="60020" cid="10002" /><Game mid="60023" cid="1" /><Game mid="60023" cid="10001" /><Game mid="60024" cid="10001" /><Game mid="60025" cid="1" /><Game mid="60025" cid="10001" /><Game mid="60025" cid="10002" /><Game mid="60025" cid="17001" /><Game mid="60025" cid="17002" /><Game mid="60026" cid="1" /><Game mid="60026" cid="10001" /><Game mid="60027" cid="10001" /><Game mid="60027" cid="17001" /><Game mid="60028" cid="10001" /><Game mid="60028" cid="17001" /><Game mid="60034" cid="10001" /><Game mid="60034" cid="17001" /><Game mid="60035" cid="10001" /><Game mid="60035" cid="17001" /><Game mid="60036" cid="10001" /><Game mid="60036" cid="17001" /><Game mid="60037" cid="10001" /><Game mid="60037" cid="17001" /><Game mid="60039" cid="10001" /><Game mid="60039" cid="17001" /><Game mid="70021" cid="4" /><Game mid="70021" cid="5" /><Game mid="70021" cid="6" /><Game mid="70022" cid="4" /><Game mid="70022" cid="5" /><Game mid="70022" cid="6" /><Game mid="70023" cid="4" /><Game mid="70023" cid="5" /><Game mid="70023" cid="6" /><Game mid="70024" cid="4" /><Game mid="70024" cid="5" /><Game mid="70024" cid="6" /><Game mid="70025" cid="4" /><Game mid="70025" cid="5" /><Game mid="70025" cid="6" /><Game mid="70026" cid="4" /><Game mid="70026" cid="5" /><Game mid="70026" cid="6" /><Game mid="70027" cid="4" /><Game mid="70027" cid="5" /><Game mid="70027" cid="6" /><Game mid="70028" cid="4" /><Game mid="70028" cid="5" /><Game mid="70028" cid="6" /><Game mid="70029" cid="4" /><Game mid="70029" cid="5" /><Game mid="70029" cid="6" /><Game mid="70030" cid="4" /><Game mid="70030" cid="5" /><Game mid="70030" cid="6" /><Game mid="70031" cid="4" /><Game mid="70031" cid="5" /><Game mid="70031" cid="6" /><Game mid="70032" cid="4" /><Game mid="70032" cid="5" /><Game mid="70032" cid="6" /><Game mid="80005" cid="10002" /><Game mid="80006" cid="10002" /><Game mid="80007" cid="10002" /><Game mid="200024" cid="1" /><Game mid="200024" cid="10001" /><Game mid="210007" cid="17002" /><Game mid="210008" cid="17002" /><Game mid="210009" cid="17002" /><Game mid="210010" cid="17004" /><Game mid="210010" cid="17005" /><Game mid="210010" cid="17006" /><Game mid="210011" cid="10002" /><Game mid="210011" cid="10003" /><Game mid="210011" cid="10005" /><Game mid="210011" cid="17003" /><Game mid="210011" cid="17004" /><Game mid="210011" cid="17005" /><Game mid="210013" cid="17003" /><Game mid="210013" cid="17004" /><Game mid="210015" cid="17002" /><Game mid="210017" cid="17002" /><Game mid="210038" cid="1" /><Game mid="210051" cid="10001" /><Game mid="210057" cid="1" /><Game mid="402004" cid="1" /><Game mid="402012" cid="1" /><Game mid="402026" cid="1" /><Game mid="402027" cid="1" /><Game mid="408000" cid="1" /><Game mid="408000" cid="10001" /></Response></Pkt>';
        $this->outXML($xml);
    }

    protected function startPing($request) {
        $xml = '<Pkt><Id mid="0" cid="10001" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="Ping" Inverb="Ping"/><Response/></Pkt>';
        $this->outXML($xml);
    }

    protected function startNumMessages($request) {
        $xml = '<Pkt><Id mid="130" cid="0" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="VP_GETNUMMESSAGES"/><Response><NumMessages count="0"/></Response></Pkt>';

        $this->outXML($xml);
    }

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10305" cid="10001" sid="1867" sessionid="ead75c2a-47e7-4faf-bed8-00a9f668d914" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="0" userID="114288" transNumber="205741" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="103500" chipSize="5" date="2014-11-28 01:21:08" /><PlayInfo value="75750" chipSize="5" date="2014-11-20 16:22:17" /><PlayInfo value="64500" chipSize="5" date="2014-11-26 20:23:04" /><PlayInfo value="56250" chipSize="5" date="2014-11-20 16:09:52" /><PlayInfo value="54000" chipSize="5" date="2014-11-18 21:18:38" /></PlayInfos></Player><Slot win="0" triggeringWin="0" state="0" reelSet="1" reelPos="82,135,103,141,174" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="9,5,4,9,7" reelPos="81,134,102,140,173" /><Row symbols="8,3,8,7,2" reelPos="82,135,103,141,174" /><Row symbols="6,4,1,8,6" reelPos="83,136,104,142,175" /></VisArea><Wins /><NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="5" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="0" /><ReelSets><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="1,2,1,1,1" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="5,5,5,5,5" /><ReelSet defaultPos="1,1,1,1,1" /><ReelSet defaultPos="9,9,9,9,9" /><ReelSet defaultPos="2,2,2,2,2" /></ReelSets></Slot><Bet numChips="10" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="10" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet><BonusGames lastBonusPlayed="-1"><Bonus id="0" state="0" bonusName="DinosaursNoChoice" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings"><TokenManager name="DinosaursNoChoiceTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus><Bonus id="1" state="0" bonusName="DinosaursChoice" numBonusLevels="1" tickets="0" ticketsNeeded="1" winScaler="NoWinnings"><TokenManager name="DinosaursChoiceTokenMan" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /></Bonus></BonusGames><TokenManagers><TokenManager name="PlayedTriceratops" numTokensToCollect="1" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="JurassicGuaranteedReelWildEvent" numTokensToCollect="12" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="SpinCounter" numTokensToCollect="12" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="GeneticistStatus" numTokensToCollect="16" tokenIDsAwarded="0,0,0,0,0,0,0,0,0" multiplier="0.000000000000000" /><TokenManager name="TRexMode" numTokensToCollect="5" tokenIDsAwarded="0" multiplier="0.000000000000000" /><TokenManager name="BrachiosaurusFreeSpinMultiplier" numTokensToCollect="5,5,4,4,4" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="BrachiosaurusNumSpins" numTokensToCollect="1000000" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="VelociraptorNumSpins" numTokensToCollect="12" tokenIDsAwarded="" multiplier="0.000000000000000" /><TokenManager name="DilophosaurusNumSpins" numTokensToCollect="12" tokenIDsAwarded="" multiplier="0.000000000000000" /></TokenManagers><WagerTokenManagers><Wager value="1500"><TokenManagers><TRexMode ids="0" /></TokenManagers></Wager></WagerTokenManagers><Achievements><Achievement name="Wild Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2" winCombosAcquired="" /><Achievement name="AlanGrant Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="3,4,5" winCombosAcquired="4,5" /><Achievement name="EllieSattler Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="9,10,11" winCombosAcquired="11,9,10" /><Achievement name="JohnHammond Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="15,16,17" winCombosAcquired="17,16" /><Achievement name="IanMalcolm Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="21,22,23" winCombosAcquired="23,22" /><Achievement name="TRex Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="27,28,29" winCombosAcquired="29,28,27" /><Achievement name="Velociraptors Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="33,34,35" winCombosAcquired="35,34,33" /><Achievement name="Brachiosaurus Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="39,40,41" winCombosAcquired="41,39,40" /><Achievement name="Triceratops Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="45,46,47" winCombosAcquired="46,47,45" /><Achievement name="Dilophosaurus Symbols" isComplete="1" wasJustAwarded="0" winCombosRequired="51,52,53" winCombosAcquired="52,53,51" /><Achievement name="Scatter Symbols" isComplete="0" wasJustAwarded="0" winCombosRequired="57,58,59,60" winCombosAcquired="60,59" /><Achievement name="Gold Status" isComplete="0" wasJustAwarded="0" winCombosRequired="0,1,2,3,4,5,9,10,11,15,16,17,21,22,23,27,28,29,33,34,35,39,40,41,45,46,47,51,52,53,57,58,59,60" winCombosAcquired="60,11,29,35,28,41,46,47,52,34,45,53,39,51,40,59,4,9,17,27,5,23,22,10,16,33" /><Achievement name="GeneticistStatus" isComplete="0" wasJustAwarded="0" tokensRequired="25" tokensCollected="9" /></Achievements></Response></Pkt>';
        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $betAttr = (array) $request['Request'];
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['numChips'] * $betAttr['chipSize'] * 0.30;
        $pick = 30;

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

        switch($spinData['report']['type']) {
            case 'SPIN':
                $spinData['report']['numChips'] = $betAttr['numChips'];
                $spinData['report']['chipSize'] = $betAttr['chipSize'];
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['rows']['1']);
        $row2 = implode(',', $report['rows']['2']);
        $row3 = implode(',', $report['rows']['3']);

        $wins = '';

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * 100 / $report['chipSize'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="10305" cid="10001" sid="1867" sessionid="3eaef042-da1f-4f02-8c2d-2f5f34657770" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="111285" transNumber="1486095">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="431500" chipSize="5" date="2014-08-10 10:26:10" />
                <PlayInfo value="256250" chipSize="5" date="2014-08-09 06:52:41" />
                <PlayInfo value="233250" chipSize="5" date="2014-08-08 21:53:06" />
                <PlayInfo value="210000" chipSize="5" date="2014-08-10 09:23:02" />
                <PlayInfo value="121500" chipSize="5" date="2014-08-09 11:41:36" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="10" nextChipSize="2" nextMaxChips="10" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
        </Slot>
        <BonusGames lastBonusPlayed="-1" />
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}