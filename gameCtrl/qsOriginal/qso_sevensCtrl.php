<?

require_once('qsOriginal_Ctrl.php');

class qso_sevensCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"baseGrid","generations":[{"runningTotal":0,"meterAdd":0,"meter":0,"stops":[34,46,90,42,11],"winnings":[],"symbols":[["F8","F7","SC"],["F6","F5","F8"],["F9","F5","M4"],["F6","M4","F5"],["M1","F8","F9"]]}],"ended":true,"roundType":"normal","win":0,"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[25,50,75,100,125,250,500,750,1000,1250,2500,5000,10000],"tokenRoundCost":0.4000000000000001},"sid":"cc5ec50133135efd7afbfc09d6c687cafc6d7a78"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499880,"fm":100000,"currency":"EUR","tokens":0},"grid":"baseGrid","generations":[{"runningTotal":0,"meterAdd":1,"meter":0,"stops":[54,21,69,12,10],"winnings":[["normal",17,80,[{"x":1,"y":3},{"x":2,"y":2},{"x":3,"y":2},{"x":4,"y":2}]]],"symbols":[["F7","M4","F5"],["F8","F5","M4"],["M4","F5","F7"],["F6","WR","WR"],["M1","M1","F8"]]},{"runningTotal":80,"meterAdd":0,"meter":1,"stops":[84,22,98,17,15],"winnings":[],"symbols":[["M1","M1","M1"],["F5","M4","F5"],["M4","F9","WR"],["F9","F8","F7"],["F6","F5","M4"]]}],"ended":true,"roundType":"demo","win":80,"ba":100}';

        $this->outJSON($json);
    }

}