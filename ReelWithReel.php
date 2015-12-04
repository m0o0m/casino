<?

class ReelWithReel extends Reel {
    public $reels = array();

    public function __construct($reelsArray) {
        foreach($reelsArray as $r) {
            $this->reels[] = new Reel($r, 1);
        }
    }

    public function spin() {
        foreach($this->reels as $r) {
            $r->spin();
        }
    }

    public function getVisibleSymbols() {
        $visible = array();
        foreach($this->reels as $r) {
            $v = $r->getVisibleSymbols();
            foreach($v as $s) {
                $visible[] = $s;
            }
        }

        return $visible;
    }

    public function getVisibleSymbol($pos) {
        $visible = $this->reels[$pos]->getVisibleSymbols();
        return $visible[0];
    }

    public function checkSymbol($symbol, $iterate) {
        $visible = $this->getVisibleSymbols();
        $offsets = array();
        for($i = 0; $i < count($visible); $i++) {
            if(in_array($visible[$i], $symbol)) {
                $offsets[] = $i * 5 + $iterate;
            }
        }
        return $offsets;
    }

}