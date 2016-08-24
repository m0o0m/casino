<?

require_once('qsOriginal_Ctrl.php');

class qso_sugartrailCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"baseGrid","ended":true,"stops":[107,144,10,23,297],"roundType":"normal","winnings":[],"win":0,"symbols":[["F9","F7","M3"],["F10","M2","F6"],["F7","M2","F6"],["SC3","F8","M3"],["M5","F9","WR"]],"ba":80},"betMultiplier":1,"limits":{"defaultBet":80,"legalBets":[40,80,120,200,400,800,1200,2000,4000,8000],"tokenRoundCost":0.35000000000000003},"sid":"c1a68b7c017529e891381bcaa3dd5769de7e0262"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499924,"fm":100000,"currency":"EUR","tokens":0},"grid":"baseGrid","ended":true,"stops":[80,118,226,104,28],"roundType":"demo","winnings":[],"win":0,"symbols":[["SC1","F7","M5"],["F6","M5","F6"],["F7","M4","F7"],["F6","SC3","F8"],["SC3","F6","M4"]],"ba":80}';

        $this->outJSON($json);
    }

}