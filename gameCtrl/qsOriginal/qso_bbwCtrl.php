<?

require_once('qsOriginal_Ctrl.php');

class qso_bbwCtrl extends qsOriginal_Ctrl {

    public function startInit() {
        $json = '{"savedSettings":"","stats":{"b":500000,"fm":100000,"currency":"EUR","tokens":0},"refresh":{"grid":"BaseGameGrid","generations":[{"offsetsBefore":[[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1]],"avalanche":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"offsetsAfter":[[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1]],"winnings":[],"symbols":[["f9","m2","f9"],["f6","sc","f9"],["f7","f5","m4"],["f8","m2","f6"],["m1","f5","f6"]]}],"ended":true,"stops":[93,87,42,22,19],"roundType":"normal","win":0,"ba":25},"betMultiplier":1,"limits":{"defaultBet":25,"legalBets":[25,50,75,100,125,250,500,750,1000,1250,2500,5000,10000],"tokenRoundCost":0.41000000000000003},"sid":"2f66760ca96518e924546a217c03b63404238081"}';
        $this->outJSON($json);
    }

    public function startSpin() {
        $json = '{"stats":{"b":500065,"fm":100000,"currency":"EUR","tokens":0},"grid":"BaseGameGrid","generations":[{"offsetsBefore":[[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1],[-1,0,1]],"avalanche":[[0,0,1],[1,0,0],[1,0,0],[0,0,0],[0,0,0]],"offsetsAfter":[[-2,-1,0],[-2,0,1],[-2,0,1],[-1,0,1],[-1,0,1]],"winnings":[["normal",23,5,[{"x":1,"y":3},{"x":2,"y":1},{"x":3,"y":1}]]],"symbols":[["f5","m4","f7"],["f7","m1","f8"],["f7","wr","f6"],["f6","m4","f9"],["m1","f5","f6"]]},{"offsetsBefore":[[-2,-1,0],[-2,0,1],[-2,0,1],[-1,0,1],[-1,0,1]],"avalanche":[[1,0,0],[0,1,0],[0,1,0],[0,0,0],[0,0,0]],"offsetsAfter":[[-3,-1,0],[-3,-2,1],[-3,-2,1],[-1,0,1],[-1,0,1]],"winnings":[["normal",16,25,[{"x":1,"y":1},{"x":2,"y":2},{"x":3,"y":2}]]],"symbols":[["m1","f5","m4"],["sc","m1","f8"],["m4","wr","f6"],["f6","m4","f9"],["m1","f5","f6"]]},{"offsetsBefore":[[-3,-1,0],[-3,-2,1],[-3,-2,1],[-1,0,1],[-1,0,1]],"avalanche":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"offsetsAfter":[[-3,-1,0],[-3,-2,1],[-3,-2,1],[-1,0,1],[-1,0,1]],"winnings":[],"symbols":[["f7","f5","m4"],["f8","sc","f8"],["f9","m4","f6"],["f6","m4","f9"],["m1","f5","f6"]]}],"ended":true,"stops":[50,8,12,27,19],"roundType":"demo","win":30,"ba":25}';

        $this->outJSON($json);
    }

}