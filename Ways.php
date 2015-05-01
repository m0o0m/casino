<?

class Ways {
    public $paths;

    public function __construct($symbol, $alias, $doubleIfWild, $currentDouble, $minWinCount, $direction) {
        $this->symbol = $symbol;
        $this->direction = $direction;
        $this->minWinCount = $minWinCount;
        $this->alias = $alias;
        $this->doubleIfWild = $doubleIfWild;
        $this->currentDouble = $currentDouble;
        $this->canAdded = true;
        $this->paths = array(
            array(
                'offsets' => array(),
                'symbols' => array(),
                'withWild' => false,
                'collecting' => false,
                'double' => $currentDouble,
            ),
        );
    }

    public function addMatches($data) {

        if(empty($data)) {
            $this->canAdded = false;
        }
        if($this->canAdded) {
            $tmpPath = array();
            foreach($this->paths as $p) {
                foreach($data as $d) {
                    $newP = $p;
                    array_push($newP['offsets'], $d['offset']);
                    array_push($newP['symbols'], $d['symbol']);
                    if($d['type'] == 'wild') {
                        $newP['withWild'] = true;
                        if($this->doubleIfWild) {
                            $newP['double'] = $this->currentDouble * 2;
                        }
                    }
                    if($d['type'] == 'collecting') {
                        $newP['collecting'] = true;
                    }
                    $tmpPath[] = $newP;
                }
            }
            $this->paths = $tmpPath;
        }
    }

    public function getWinLines() {
        $winLines = array();
        foreach($this->paths as $p) {
            if(count(array_intersect($this->symbol, $p['symbols'])) > 0) {
                if(count($p['offsets']) >= $this->minWinCount) {
                    $winLines[] = array(
                        'line' => $p['offsets'],
                        'count' => count($p['offsets']),
                        'id' => implode('', $p['offsets']),
                        'double' => $p['double'],
                        'withWild' => $p['withWild'],
                        'collecting' => $p['collecting'],
                        'direction' => $this->direction,
                    );
                }

            }
        }
        return $winLines;
    }
}