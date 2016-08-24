<?

require_once('qsOriginal_Ctrl.php');

class qso_illuminousCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":["base","base","base","base","base"],"ended":true,"stops":[84,4,66,65,10],"roundType":"normal","winnings":[],"win":0,"symbols":[["M3","F6","M2"],["F8","M4","F9"],["F5","M1","F7"],["F7","F8","M2"],["M2","F8","F10"]],"ba":80},"betMultiplier":1,"limits":{"defaultBet":80,"legalBets":[40,80,120,200,400,800,1200,2000,4000,8000],"tokenRoundCost":0.44000000000000006},"sid":"536168cfafd4de5985fbcc1c90badb7c2906d1a6"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499840,"fm":100000,"currency":"EUR","tokens":0},"grid":["base","base","base","base","base"],"ended":true,"stops":[92,120,37,25,56],"roundType":"demo","winnings":[],"win":0,"symbols":[["F5","F7","SC"],["F6","F8","M4"],["M1","F9","F10"],["F9","F8","F5"],["F10","M1","F8"]],"ba":80}';

        $this->outJSON($json);
    }

}