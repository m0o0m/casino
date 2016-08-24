<?

require_once('qsOriginal_Ctrl.php');

class qso_spinionsCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        parse_str($_SERVER['REQUEST_URI']);
        $json = $jsonp.'({"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0,"realityCheck":{"result":0,"sessionMinutes":0,"lossLimit":null,"winSum":0,"resetedResult":0,"hardErrors":false,"totalSessionMinutes":0,"sessionLimitSeconds":null,"betSum":0,"status":"ok"}},"refresh":{"grid":"BaseGameGrid","ended":true,"startStickyWilds":[],"stops":[76,116,74,117,7],"roundType":"normal","spinwin":0,"winnings":[],"win":0,"symbols":[["F6","F7","M1"],["F9","M5","F8"],["F7","F8","M2"],["M2","F7","F10"],["F8","BN","F7"]],"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[10,25,50,75,100,125,250,500,750,1000,1250,2500,5000,10000],"tokenRoundCost":0.42000000000000004},"sid":"30a0c772b580464983271cc5684015ddbd24679f"});';

        $this->outJSON($json);
    }

    public function startSpin() {
        parse_str($_SERVER['REQUEST_URI']);
        $json = $jsonp.'({"stats":{"b":499800,"fm":100000,"currency":"EUR","tokens":0,"realityCheck":{"result":0,"sessionMinutes":1,"lossLimit":null,"winSum":0,"resetedResult":0,"hardErrors":false,"totalSessionMinutes":1,"sessionLimitSeconds":null,"betSum":0,"status":"ok"}},"grid":"BaseGameGrid","ended":true,"startStickyWilds":[],"stops":[79,55,80,132,27],"roundType":"demo","spinwin":0,"winnings":[],"win":0,"symbols":[["F6","F9","M1"],["M2","F6","F8"],["F8","F9","M1"],["F8","F7","F10"],["M5","F7","M2"]],"ba":100});';

        $this->outJSON($json);
    }

}