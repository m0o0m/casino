<?
/**
 * Casino logic
 *
 * Основные файлы логики
 *
 * @category Casino Slots
 * @author Kirill Speransky
 */



/**
 * Class Ways
 *
 * Основная логика путей
 */
class Ways {
    /**
     * @var array Пути
     */
    public $paths;

    /**
     * Создание экземпляра с начальными настройками
     *
     * @param array $symbol
     * @param string $alias
     * @param bool $doubleIfWild Удваивать, если на линии вайлд
     * @param int $currentDouble Текущий множитель линий
     * @param int $minWinCount
     * @param string $direction "left" or "right"
     */
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

    /**
     * Добавляем новый путь к уже имеющимся
     *
     * @param array $data
     */
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

    /**
     * Получение результата выигрышных линий по путям символа
     *
     * @return array
     */
    public function getWinLines() {
        $winLines = array();
        foreach($this->paths as $p) {
            if(count(array_intersect($this->symbol, $p['symbols'])) > 0) {
                if(count($p['offsets']) >= $this->minWinCount) {
                    if($this->direction == 'right' && count($p['offsets']) == 5) {

                    }
                    else {
                        $winLines[] = array(
                            'line' => $p['offsets'],
                            'count' => count($p['offsets']),
                            'id' => implode('', $p['offsets']),
                            'double' => $p['double'],
                            'withWild' => $p['withWild'],
                            'collecting' => $p['collecting'],
                            'direction' => $this->direction,
                            'useSymbols' => $p['symbols'],
                            'type' => 'ways',
                        );
                    }

                }

            }
        }
        return $winLines;
    }
}