<?

require_once('qsOriginal_Ctrl.php');

class qso_sinbadCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"stackReplacements":{"RAND":"F6","RAND3":"M4","RAND2":"M4"},"ver":2,"grid":"baseGrid","bonusRounds":[],"ended":true,"stops":[136,221,116,279,36],"roundType":"normal","winnings":[],"win":0,"symbols":[["M5","F9","M3"],["M1","F10","BN","F8"],["F8","M5","F8","M4"],["M4","F9","M4","WR"],["M5","F7","M4"]],"ba":80},"betMultiplier":1,"limits":{"defaultBet":80,"legalBets":[40,80,120,200,400,800,1200,2000,4000,8000],"tokenRoundCost":0.43000000000000005},"sid":"26675d6157f3d57f42d82af790f5e1116ac5dcea"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stackReplacements":{"RAND":"F10","RAND3":"F9","RAND2":"M2"},"ver":2,"stats":{"b":499840,"fm":100000,"currency":"EUR","tokens":0},"grid":"baseGrid","bonusRounds":[],"ended":true,"stops":[36,233,177,46,98],"roundType":"demo","winnings":[],"win":0,"symbols":[["M1","F9","M4"],["M2","M2","M2","M2"],["M2","M2","M2","M2"],["M3","F8","F9","F9"],["F9","F9","F9"]],"ba":80}';

        $this->outJSON($json);
    }

}