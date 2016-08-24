<?

require_once('qsOriginal_Ctrl.php');

class qso_crystalqueenCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"base","generations":[{"runningTotal":0,"firstRow":4,"removedSymbols":[],"multiplier":1,"offsetsBefore":[[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4]],"offsetsAfter":[[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4]],"wildTransformations":[],"winnings":[],"symbols":[["M1","F6","M2","F9","M1","F6"],["M1","F7","M4","F5","M2","F6"],["F8","M4","F5","F6","M3","F8"],["M3","F8","M4","F7","F8","M2"],["M2","F9","M4","F7","M2","F6"]]}],"ended":true,"stops":[191,61,55,197,177],"roundType":"normal","win":0,"ba":100},"betMultiplier":1,"limits":{"defaultBet":100,"legalBets":[50,100,250,500,750,1000,1500,2000,2500,5000,7500,10000],"tokenRoundCost":0.4000000000000001},"sid":"c3661e6d36dd56d618c31c2240f45e99cc512494"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":499800,"fm":100000,"currency":"EUR","tokens":0},"grid":"base","generations":[{"runningTotal":0,"firstRow":4,"removedSymbols":[],"multiplier":1,"offsetsBefore":[[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4]],"offsetsAfter":[[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4],[-1,0,1,2,3,4]],"wildTransformations":[],"winnings":[],"symbols":[["F9","M3","F7","M2","F9","M1"],["F7","M2","F8","M4","F7","F8"],["F5","M2","F6","M3","F8","F5"],["M2","F7","M3","F8","F7","BN"],["M2","F9","F7","M3","M2","M1"]]}],"ended":true,"stops":[136,104,114,77,7],"roundType":"demo","win":0,"ba":100}';

        $this->outJSON($json);
    }

}