<?

require_once('qsOriginal_Ctrl.php');

class qso_treasureislandCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"BaseGameGrid","bonusRounds":[],"ended":true,"stops":[143,97,164,30,12],"roundType":"normal","winnings":[],"win":0,"symbols":[["f9","m3","f9","sc"],["f9","m3","f8","f6"],["m4","f7","m2","f10"],["f10","f6","m1","f10"],["f7","m2","f9","sc"]],"ba":50},"betMultiplier":1,"limits":{"defaultBet":50,"legalBets":[50,100,250,500,750,1000,1500,2000,2500,5000,7500,10000],"tokenRoundCost":0.31000000000000005},"sid":"881e887ecf8082512a8c855c5dc1e6f12e395205"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499903,"fm":100000,"currency":"EUR","tokens":0},"grid":"BaseGameGrid","bonusRounds":[],"ended":true,"stops":[58,107,131,54,38],"roundType":"demo","winnings":[["normal",13,3,[{"x":1,"y":1},{"x":2,"y":2},{"x":3,"y":1}]]],"win":3,"symbols":[["f8","m5","f7","wb"],["f6","f8","m3","f9"],["f8","m4","f10","f7"],["f6","m3","f9","m4"],["m5","f6","m2","f9"]],"ba":50}';

        $this->outJSON($json);
    }

}