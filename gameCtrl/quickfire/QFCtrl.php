<?

class QFCtrl extends Ctrl {

    protected function getRequest() {
        if(isset($_POST['xml'])) return (array) simplexml_load_string($_POST['xml']);
        else return (array) simplexml_load_string($this->api->getRequestBody());
        //echo '<pre>';
        //return (array) simplexml_load_string('<Pkt version="5"><Id mid="12772" cid="10001" sid="1866" verb="AdvSlot" sessionid="034d3f92-3390-4992-8d97-e9fe4adee6f7" clientLang="en"/><Request verbex="Spin" numChips="9" chipSize="5" activePaylines="0"/></Pkt>');
    }

    protected function processRequest($request) {
        $id = (array) $request['Id'];
        $verb = $id['@attributes']['verb'];

        switch($verb) {
            case 'Login':
                $this->startLogin($request);
                break;
            case 'PlayerInformationRequest':
                $this->startInformation($request);
                break;
            case 'GetHiddenGameList':
                $this->startHiddenList($request);
                break;
            case 'Ping':
                $this->startPing($request);
                break;
            case 'AdvSlot':
                $r = (array) $request['Request'];
                $verbex = $r['@attributes']['verbex'];
                if($verbex == 'Refresh') {
                    $this->startInit($request);
                }
                if($verbex == 'Spin') {
                    $this->startSpin($request);
                }
                if($verbex == 'BonusPick') {
                    $this->startBonusPick($r['@attributes']['item']);
                }
                if($verbex == 'FreeSpin') {
                    $this->startFreeSpin();
                }
                break;
            case 'VP_GETNUMMESSAGES':
                $this->startNumMessages($request);
                break;
            case 'GetBalance':
                $this->startGetBalance();
                break;
        }
    }

    protected function startGetBalance() {
        $responce = '<Pkt><Id mid="1" cid="10001" sid="1867" sessionid="941cf6d9-6ea1-4f53-96cb-8c383ee758c0" verb="GetBalance" Inverb="GetBalance"/><Response><PlayerInfo Balance="'.$this->getBalance() * 100 .'"/></Response></Pkt>';

        $this->outXML($responce);
    }

    protected function startLogin($request) {
        $xml = '<Pkt>
            <Id mid="1" cid="10001" sid="1867" sessionid="034d3f92-3390-4992-8d97-e9fe4adee6f7" verb="Login" Inverb="Login" />
            <Response>
                <Credentials UserType="5" SessionNumber="'.$this->gameID.'" />
                <PlayerInfo Balance="'.$this->getBalance() * 100 .'" LoginName="1867Demo707" />
                <SessionAuthentication token="170f22c1-49ed-4fb4-87c2-184eed743726" userId="111269" />
                <Loyalty pointBalance="0" /><LSR AcquisitionType="0" /><FC ID1="04CCC3E9-8D1D-41F6-B1A9-2BD427D2A575" />
            </Response></Pkt>';

        $this->outXML($xml);
    }

    protected function startInformation($request) {
        $xml = '<Pkt>
            <Id mid="151" cid="1" sid="1867" sessionid="034d3f92-3390-4992-8d97-e9fe4adee6f7" verb="PlayerInformationRequest" Inverb="PlayerInformationRequest"/>
            <Response>
                <PlayerInfo>
                    <RegistrationInfo>
                        <FirstName>Tester</FirstName>
                        <Surname>Chester</Surname>
                        <City>Dbn</City>
                        <CasinoID>1867</CasinoID>
                        <CasinoName>Quickfire Demo Play MAL</CasinoName>
                        <RegisteredCountry>ZAF</RegisteredCountry>
                        <RegisteredState />
                        <ZipCode>4001</ZipCode>
                        <UserType>Demo User</UserType>
                        <DateOfBirth>1969-01-20T00:00:00</DateOfBirth>
                        <HasPurchased>0</HasPurchased>
                        <IsVIP>0</IsVIP>
                    </RegistrationInfo>
                    <SessionInfo>
                        <SessionCountry>UKR</SessionCountry>
                        <SessionState />
                        <Currency />
                        <ThrottleDownloads>1</ThrottleDownloads>
                        <CurrencyISOCode />
                        <CurrencyMultiplier>1</CurrencyMultiplier>
                        <Alias>Al</Alias>
                        <CurrencyDisplayFormat>$#,###.##</CurrencyDisplayFormat>
                    </SessionInfo>
                </PlayerInfo>
            </Response></Pkt>';

        $this->outXML($xml);
    }

    protected function startHiddenList($request) {
        $xml = '<Pkt>
            <Id mid="144" cid="10001" sid="1867" sessionid="034d3f92-3390-4992-8d97-e9fe4adee6f7" verb="GetHiddenGameList" Inverb="GetHiddenGameList" />
            <Response show="0" download="0" message="0"></Response>
        </Pkt>';

        $this->outXML($xml);
    }

    protected function startPing($request) {
        $xml = '<Pkt><Id mid="0" cid="10001" sid="1867" sessionid="a48b6702-4091-4ccc-a4e7-e82491f86893" verb="Ping" Inverb="Ping"/><Response/></Pkt>';

        $this->outXML($xml);
    }

    protected function startNumMessages($request) {
        $xml = '<Pkt>
            <Id mid="130" cid="0" sid="1867" sessionid="d5bc5a6b-d39c-4ecd-ac07-6d25485d3f71" verb="VP_GETNUMMESSAGES"/>
            <Response><NumMessages count="0"/></Response></Pkt>';

        $this->outXML($xml);
    }
}