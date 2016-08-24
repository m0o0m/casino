<?

require_once('qsOriginal_Ctrl.php');

class qso_royalfrogCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"betMultiplier":1,"limits":{"defaultBet":40,"legalBets":[40,80,120,200,400,800,1200,2000,4000]},"sid":"48578d372a557eed59f20a644c5e642cad135cd6"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499980,"fm":100000,"currency":"EUR","tokens":0},"grid":"BaseGameGrid","bonusRounds":[],"wildMode":1,"ended":true,"stops":[31,319,84,428,403],"roundType":"demo","winnings":[],"win":0,"symbols":[["M1B","M1C","M1D","F10"],["S4","F11","BN","F9"],["S5","F9","F10","S6"],["WRC","WRD","F8","S4"],["F11","S4","F10","S5"]],"ba":40}';

        $this->outJSON($json);
    }

}