<?

require_once('qsOriginal_Ctrl.php');

class qso_journeyCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"ended":true,"grid1":{"grid":"BaseGameGrid1","stops":[82,95,192,129,134],"winnings":[],"symbols":[["M2","M2","M2","M2"],["F6","F6","F6","F6"],["F10","F10","F10","SCATTERA"],["M3","M3","M3","F10"],["WR","WR","WR","F7"]]},"roundType":"normal","grid2":{"grid":"BaseGameGrid2","stops":[55,90,167,45,98],"winnings":[],"symbols":[["F7","F7","M3","M3"],["F9","F9","F9","F9"],["F7","M5","M5","M5"],["F6","F6","F6","F6"],["F9","F9","F9","M1"]]},"grid3":{"grid":"BaseGameGrid3","stops":[136,120,100,72,196],"winnings":[],"symbols":[["M5","M5","M5","M5"],["F9","F9","F9","F9"],["F7","F7","M2","M2"],["F6","F6","M1","M1"],["F9","M2","M2","M2"]]},"win":0,"ba":80},"betMultiplier":1,"limits":{"defaultBet":80,"legalBets":[80,160,240,400,800,1200,2000,4000,8000],"tokenRoundCost":0.31000000000000005},"sid":"a9b6a928ad6f8b89db06979e4f3773ea89804821"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499840,"fm":100000,"currency":"EUR","tokens":0},"ended":true,"grid1":{"grid":"BaseGameGrid1","stops":[116,63,39,82,247],"winnings":[],"symbols":[["F7","F7","F7","F7"],["F8","F8","F8","F8"],["WBA","WBB","F10","F10"],["F8","F8","F8","F8"],["F6","M1","M1","M1"]]},"roundType":"demo","grid2":{"grid":"BaseGameGrid2","stops":[63,3,98,101,63],"winnings":[],"symbols":[["F10","F9","F9","WR"],["F9","F9","F9","F9"],["F10","F10","F10","F10"],["F6","F6","F6","F8"],["F9","F9","F9","F9"]]},"grid3":{"grid":"BaseGameGrid3","stops":[42,17,23,88,24],"winnings":[],"symbols":[["M5","M5","M5","M5"],["F9","F9","M2","M2"],["F7","F7","M1","M1"],["F9","F9","F9","F9"],["F9","M2","M2","M2"]]},"win":0,"ba":80}';

        $this->outJSON($json);
    }

}