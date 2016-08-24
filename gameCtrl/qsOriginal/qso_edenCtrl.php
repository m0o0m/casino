<?

require_once('qsOriginal_Ctrl.php');

class qso_edenCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"stackReplacements":{"RAND":"F6","RAND3":"M4","RAND2":"M4"},"grid":"base","multiplier":2,"bonusRounds":[],"wildMode":2,"ended":true,"stops":[82,179,97,274,123],"roundType":"normal","winnings":[],"win":0,"symbols":[["M1","F7","M3"],["M4","M4","M4","M4"],["M5","F10","M4","F6"],["M4","M4","M4","M4"],["M4","M4","M4"]],"ba":60},"betMultiplier":1,"limits":{"defaultBet":1,"legalBets":[1,2,3,4,5,10,20,30,40,50,75,100],"tokenRoundCost":0.3400000000000001},"sid":"6d866d31f5128289b304c6754506d58011124898"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"multiplier":3,"bonusRounds":[],"wildMode":2,"winnings":[],"symbols":[["M2","F7","M3"],["M3","M3","M3","F10"],["M4","M1","F10","M5"],["F8","F8","F8","F8"],["M1","F6","M3"]],"stackReplacements":{"RAND":"M3","RAND3":"F8","RAND2":"M3"},"stats":{"b":499906,"fm":100000,"currency":"EUR","tokens":0},"grid":"base","ended":true,"stops":[77,66,257,255,87],"roundType":"demo","win":0,"ba":60}';

        $this->outJSON($json);
    }

}