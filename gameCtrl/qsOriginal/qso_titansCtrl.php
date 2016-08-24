<?

require_once('qsOriginal_Ctrl.php');

class qso_titansCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"baseGrid","freespins":[],"ended":true,"stops":[98,134,94,144,129],"roundType":"normal","winnings":[],"win":0,"symbols":[["F6","M1","F9","F9"],["F8","F8","SC","F9"],["M3","F7","F6","M4"],["M3","F8","F8","SC"],["F9","WR","WR","WR"]],"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[50,100,250,500,750,1000,1500,2000,2500,5000,7500,10000],"tokenRoundCost":0.4000000000000001},"sid":"2bac55425746132fd2772e980c6457fc5b4f89ab"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499800,"fm":100000,"currency":"EUR","tokens":0},"grid":"baseGrid","freespins":[],"ended":true,"stops":[164,44,111,3,141],"roundType":"demo","winnings":[],"win":0,"symbols":[["F6","F6","M3","F7"],["F10","SC","F8","F10"],["M4","M4","F9","F9"],["F10","F10","SC","F7"],["M5","F9","F8","M5"]],"ba":100}';

        $this->outJSON($json);
    }

}