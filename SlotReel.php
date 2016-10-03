<?

class SlotReel extends Slot {
    public function __construct($params, $linesCount, $bet, $betOnLineIndex = 1) {
        $this->params = $params;
        $this->lines = $this->getWinLines($params->winLines, $linesCount);
        $this->wins = $params->winPay;
        $this->winSymbols = $this->getWinSymbols();
        $this->symbols = $params->symbols;
        $this->wild = $params->wild;
        $this->scatter = $params->scatter;
        $this->drawID = -1;

        $this->bet = $bet;
        $this->linesCount = $linesCount;
        $this->betOnLine = (float) ($bet * $betOnLineIndex / $linesCount);

        if(round($this->betOnLine,3) < 0.01) {
            die('bad bet');
        }
        $this->betOnLine = round($this->betOnLine, 2);

        $this->setReels($params->reels[0]);
    }

    public function setReels($params) {
        $this->reels = array();
        for($i = 0; $i < $this->params->ceils; $i++) {
            $reelsArray = array();
            for($j = 0; $j < $this->params->rows; $j++) {
                $reelsArray[] = $params[$i*$this->params->rows + $j];
            }
            $this->reels[] = new ReelWithReel($reelsArray);
        }
    }

    public function getReelsCount() {
        return count($this->reels);
    }

    public function createCustomReels($reels, $config) {
        $this->reels = array();

        for($i = 0; $i < count($reels); $i++) {
            $this->reels[] = new Reel($reels[$i], $config[$i]);
        }
    }
}