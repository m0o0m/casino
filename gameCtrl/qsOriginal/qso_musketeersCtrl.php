<?

require_once('qsOriginal_Ctrl.php');

class qso_musketeersCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"base","multiplier":1,"bonusRounds":[],"ended":true,"stops":[156,98,224,133,6],"roundType":"normal","winnings":[],"win":0,"symbols":[["S8","S0","M4"],["S7","C5","S9"],["BN","S7","C6"],["M1A","M1B","M1C"],["C5","S0","S7"]],"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[25,50,75,100,125,250,500,750,1000,1250,2500,5000,10000],"tokenRoundCost":0.43000000000000005},"sid":"fd13f2cddc4e000452e6844982825161b27a9764"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499800,"fm":100000,"currency":"EUR","tokens":0},"grid":"base","multiplier":1,"bonusRounds":[],"ended":true,"stops":[136,101,8,26,66],"roundType":"demo","winnings":[],"win":0,"symbols":[["S8","S0","C6"],["BN","S8","C5"],["S0","C5","S0"],["WRA","WRB","WRC"],["C5","S7","C6"]],"ba":100}';

        $this->outJSON($json);
    }

}