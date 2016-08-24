<?

require_once('qsOriginal_Ctrl.php');

class qso_jewelblastCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"stackReplacements":{"RAND":"F8","RAND3":"M1","RAND2":"M1"},"grid":"base","respins":[],"ended":true,"stops":[13,146,85,75,99],"roundType":"normal","winnings":[],"win":0,"symbols":[["F8","F8","F8"],["M1","M1","M1"],["F10","M4","F6"],["M1","M1","M1"],["M4","F7","M4"]],"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[25,50,75,100,125,250,500,750,1000,1250,2500,5000,10000],"tokenRoundCost":0.16000000000000003},"sid":"7d0bc7973c6c159e70e7eb0072c2aa0a73e169d6"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stackReplacements":{"RAND":"F8","RAND3":"M3","RAND2":"M1"},"stats":{"b":499872,"fm":100000,"currency":"EUR","tokens":0},"grid":"base","respins":[],"ended":true,"stops":[91,108,168,26,92],"roundType":"demo","winnings":[],"win":0,"symbols":[["F9","M5","F7"],["M1","M1","F8"],["F7","BN","F9"],["M3","M3","M3"],["M3","M3","M3"]],"ba":100}';

        $this->outJSON($json);
    }

}