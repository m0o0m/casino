<?

require_once('qsOriginal_Ctrl.php');

class qso_colossusCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"base","freespins":[],"ended":true,"stops":[47,228,113,108,92],"roundType":"normal","winnings":[],"win":0,"symbols":[["F5","F9","WR"],["F6","F9","M2"],["M4","F5","M1"],["F9","WR","WR"],["M1","M1","M1"]],"ba":80},"betMultiplier":1,"limits":{"defaultBet":80,"legalBets":[40,80,120,200,400,800,1200,2000,4000,8000,12000],"tokenRoundCost":0.4000000000000001},"sid":"d53de3a2157764518a5d982857dbc83b4c1200f3"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499908,"fm":100000,"currency":"EUR","tokens":0},"grid":"base","freespins":[],"ended":true,"stops":[77,12,1,202,52],"roundType":"demo","winnings":[],"win":0,"symbols":[["M4","F6","F5"],["M2","F7","M2"],["M1","M1","M1"],["WR","WR","WR"],["F7","M2","F6"]],"ba":80}';

        $this->outJSON($json);
    }

}