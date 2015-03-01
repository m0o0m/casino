<?php
/**
 * Casino logic
 *
 * Основные файлы логики
 *
 * @category Casino Slots
 * @author Kirill Speransky
 */



/**
 * Class Slot
 *
 * Основная логика барабанов, спинов, бонусов.
 */
class Slot {
    // Используем трейты.
    use SymbolsWorker, BonusWorker;

    /**
     * @var array $symbols Ассотиативный массив буквенного и числового значения символа
     */
    private $symbols = array();

    /**
     * @var array $reels Содержит массив барабанов слота. Каждый элемент - экземпляр Reel
     */
    private $reels = array();

    /**
     * @var array $lines Массив выигрышных линий.
     * Количество линий в массиве зависит от того, сколько линий выбрано в игре.
     */
    private $lines = array();

    /**
     * @var array $wins Массив выплат.
     * symbol - буквенной идентификатор символа
     * count - количество символов
     * multiplier - множитель ставки на линию
     */
    private $wins = array();

    /**
     * @var int $totalMultiple Суммарный множитель после спина (учитывая бонусы спина)
     */
    private $totalMultiple = 0;

    /**
     * @var array $wild Массив вайлдов слота. Может быть как 1 элемент(чаще всего), так и несколько
     */
    private $wild = array();

    /**
     * @var array $scatter Массив скаттеров слота. Может быть как 1 элемент(чаще всего), так и несколько
     */
    private $scatter = array();

    /**
     * @var array $report Содержит подробную информацию по результатам спина.
     *
     * winLines - массив линий, на которых выиграли
     * totalMultiple - полный множитель ставки на линию
     * offset - Массив сдвига барабанов
     * rows - Конечные символы строк(не барабанов, а именно строк) слота после спина и применения всех бонусов и т.д
     * startRows - Начальные строки слота после спина и ДО применения бонусов и т.д
     * bonusData - Дополнительная информация по бонусам
     * double - Множитель всех выигрышей
     * bet - Общая ставка
     * linesCount - Количество играющих линий
     * betOnLine - Ставка на линию
     * stops - Строка сдвига барабанов (отображает сдвиг второй строки)
     * totalWin - Общая сумма выигрыша
     */
    private $report = array();

    /**
     * @var array $bonusData Массив данных бонуса.
     * Используется для передачи дополнительной информации по бонусам (положение рандомных вайлдов и т.д)
     */
    private $bonusData = array();

    /**
     * @var int Номер запуска спина и бонусных спинов
     */
    private $step = 0;

    /**
     * Контроллер, который использует слот
     *
     * @var bool|object
     */
    private $ctrl = false;

    /**
     * @var int Номер отрисовки
     */
    public $drawID;

    /**
     * @var array Бонус спина
     */
    private $spinBonus = array();

    /**
     * @var int Количество строк слота
     */
    public $rows = 3;

    /**
     * Дополнительные вайлды-множители, которые при попадании на линюю умножают ее
     *
     * @var array
     */
    public $bonusWildsMultiple = array();

    /**
     * Итератор, для выхода из зациклившегося бонуса и респина
     *
     * @var int
     */
    public $bonusIterateCount = 0;

    /**
     * Инициализация слота
     *
     * Получение выигрышных линий в зависимости от количества играющих линий
     * Создание массива символов(без повторов), которые учавствуют в выплате
     * Создание барабанов слота из раскладок слота.
     *
     * @param object $params Параметры текущей игры
     * @param int $linesCount Количество линий, по которым будет считаться выигрыш
     * @param float $bet Общая ставка
     * @param float $betOnLineIndex Дополнительный множитель для правильного рассчета ставки на линию
     */
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
        $this->betOnLine = $bet * $betOnLineIndex / $linesCount;

        foreach($params->reels[0] as $reel) {
            $this->reels[] = new Reel($reel);
        }
    }

    /**
     * Установка контроллера для слота
     *
     * @param Ctrl $ctrl
     */
    public function setCtrl(Ctrl $ctrl) {
        $this->ctrl = $ctrl;
    }

    /**
     * Установка новых параметров игры
     *
     * @param Params $params
     */
    public function setParams(Params $params) {
        $this->params = $params;

        $this->lines = $this->getWinLines($params->winLines, $this->linesCount);
        $this->wins = $params->winPay;
        $this->winSymbols = $this->getWinSymbols();
        $this->symbols = $params->symbols;
        $this->wild = $params->wild;
        $this->scatter = $params->scatter;
        $this->drawID = -1;
    }

    /**
     * Получаем список линий, в зависимости от выигрышных линий
     *
     * @param array $lines Все выигрышные линии слота
     * @param int $linesCount Количество играющих линий
     * @return array Текущие выигрышные линии слота
     */
    public function getWinLines($lines, $linesCount) {
        return array_slice($lines, 0, $linesCount);
    }

    /**
     * Получаем список символов, которые учавствуют в выплате
     *
     * @return array
     */
    public function getWinSymbols() {
        $s = array();
        $c = array();
        foreach($this->wins as $win) {
            $symbol = $win['symbol'];
            if(!in_array($symbol, $c)) {
                $s[] = array('symbol' => $symbol);
                $c[] = $symbol;
            }
        }
        return $s;
    }

    /**
     * Установка новых барабанов
     *
     * @param array $params Создание новых барабанов из переданной раскладки
     */
    public function setReels($params) {
        $this->reels = array();
        foreach($params as $reel) {
            $this->reels[] = new Reel($reel);
        }
    }

    /**
     * Устанавливает новые барабаны с нужным количеством видимых символов
     *
     * @param array $reels
     * @param array $config Массив, содержащий количество видимых символов для каждого барабана
     */
    public function createCustomReels($reels, $config) {
        $this->reels = array();

        for($i = 0; $i < count($reels); $i++) {
            $this->reels[] = new Reel($reels[$i], $config[$i]);
        }
    }

    /**
     * Установка нового массива вайлдов
     *
     * @param array $wilds
     */
    public function setWilds($wilds) {
        $this->wild = $wilds;
    }

    /**
     * Установка нового массива скаттеров
     *
     * @param array $scatter
     */
    public function setScatter($scatter) {
        $this->scatter = $scatter;
    }

    /**
     * Крутим барабаны и создаем репорт спина.
     *
     * Инициализация начальных параметров репорта.
     * Кручение барабанов
     * Проверка и запуск бонусов
     * Создание репорта
     *
     * @param array $bonus Бонус(или бонусы) для спина
     * @return array $report Полная информация по спину
     */
    public function spin($bonus = array()) {
        $this->resetSlotData();

        $this->step = 0;

        foreach($this->reels as $reel) {
            $reel->spin();
        }

        $this->startRows = $this->getRows();

        $this->spinBonus = $bonus;

        return $this->getReport();
    }

    /**
     * Проверка бонусов и создание репорта спина
     *
     * @return array Полный репорт спина
     */
    public function getReport() {
        $this->checkBonus();

        $this->drawID++;

        return $this->makeReport();
    }

    /**
     * Сброс основных параметров слота до спина
     */
    public function resetSlotData() {
        $this->totalMultiple = 0;
        $this->winLines = array();
        $this->report = array();
        $this->double = 1;
        $this->bonusData = array();
        $this->bonusWildsMultiple = array();
    }

    /**
     * Установка бонуса спина
     *
     * @param array $bonus
     */
    public function setBonus($bonus) {
        $this->spinBonus = $bonus;
    }

    /**
     * Создание репорта спина
     *
     * @return array
     */
    public function makeReport() {
        foreach($this->winSymbols as $winLine) {
            // Номер символа

            $alias = $winLine['symbol'];
            // ARRAY
            $v = $this->params->getSymbolID($winLine['symbol']);
            // Получаем все комбинации
            if($this->params->winLineType == 'left') {
                $SymbolwinLines = $this->getLeft($v);
            }
            elseif($this->params->winLineType == '243') {
                $SymbolwinLines = $this->get243($v);
            }
            else {
                $SymbolwinLines = $this->getLeft($v);
            }
            foreach($SymbolwinLines as $w) {
                if($this->params->checkSymbolCount($v, $w['count'])) {
                    $multiplier = $this->params->getWinMultiplier($v, $w['count']);
                    $addMultiplier = array();
                    foreach($this->bonusWildsMultiple as $bonusWild) {
                        if(in_array($bonusWild['offset'], $w['line'])) {
                            $multiplier *= $bonusWild['multiple'];
                            $addMultiplier[] = $bonusWild['multiple'];
                        }
                    }
                    if($this->params->payOnlyHighter) {
                        $f = true;
                        foreach ($this->winLines as $k=>$zzz) {
                            if ($zzz['id'] == $w['id'] + 1) {
                                if ($zzz['multiple'] > $multiplier * $w['double']) {
                                    $f = false;
                                } else {
                                    $f = true;
                                    unset($this->winLines[$k]);
                                }
                            }
                        }
                        if ($f) {
                            $addArray = array(
                                'line' => $w['line'],
                                'multiple' => $multiplier * $w['double'],
                                'symbol' => $v,
                                'alias' => $alias,
                                'count' => $w['count'],
                                'id' => $w['id'] + 1,
                                'double' => $w['double'],
                                'withWild' => $w['withWild'],
                                'addMultiplier' => $addMultiplier,
                            );
                            if(!empty($w['collecting'])) {
                                $addArray['collecting'] = $w['collecting'];
                            }
                            $this->winLines[] = $addArray;
                        }
                    }
                    else {
                        $this->totalMultiple += $multiplier * $w['double'];
                        $addArray = array(
                            'line' => $w['line'],
                            'multiple' => $multiplier * $w['double'],
                            'symbol' => $v,
                            'alias' => $alias,
                            'count' => $w['count'],
                            'id' => $w['id'] + 1,
                            'collecting' => $w['collecting'],
                            'double' => $w['double'],
                            'withWild' => $w['withWild'],
                            'addMultiplier' => $addMultiplier,
                        );
                        if(!empty($w['collecting'])) {
                            $addArray['collecting'] = $w['collecting'];
                        }
                        $this->winLines[] = $addArray;

                    }
                }
            }
        }

        if($this->params->payOnlyHighter) {
            $this->totalMultiple = 0;
            foreach($this->winLines as $w) {
                $this->totalMultiple += $w['multiple'];
            }
        }

        $this->report = array(
            'winLines' => $this->winLines,
            'totalMultiple' => $this->totalMultiple,
            'offset' => $this->getOffsets(),
            'rows' => $this->getRows(),
            'startRows' => $this->startRows,
            'bonusData' => $this->bonusData,
            'double' => $this->double,
            'bet' => $this->bet,
            'linesCount' => $this->linesCount,
            'betOnLine' => $this->betOnLine,
            'stops' => implode(',', $this->getOffsets()[1]),
            'totalWin' => $this->betOnLine * $this->totalMultiple,
            'drawID' => $this->drawID,
            'addDraws' => '',
        );
        return $this->report;
    }

    /**
     * Получаем список для каждого символа по каждой линии слева на право
     *
     * Возвращает массив, содержащий описание линий, на которых символов >= minWinCount
     *
     * @param array $symbol Массив числовых идентификаторов символа
     * @return array
     */
    private function getLeft($symbol) {
        $winLines = array();
        $lineId = 0;
        $bonusWildPosition = array();
        foreach($this->bonusWildsMultiple as $b) {
            $bonusWildPosition[] = $b['offset'];
        }
        foreach($this->lines as $line) {
            $lineSymbol = $this->getLineSymbols($line);
            $cnt = 0;
            $f = true;
            $double = 1;
            $withWild = false;
            $lineSymbolCount = 0;
            $collecting = false;
            foreach($lineSymbol as $s) {
                $symbolPosition = $line[$lineSymbolCount];
                if(in_array($s, $symbol) && $f) {
                    $cnt++;
                }
                elseif(in_array($s, $this->wild) && $f && !in_array($symbol[0], $this->scatter)) {
                    $withWild = true;
                    $cnt++;
                    if($this->params->doubleIfWild) {
                        if(!in_array($symbolPosition, $bonusWildPosition)) {
                            $double = 2;
                        }
                    }
                }
                elseif($this->params->collectingPay && !in_array($s, $symbol) && $f && $lineSymbolCount > 0) {
                    if(in_array($s, $this->params->collectingSymbols) && in_array($symbol[0], $this->params->collectingSymbols)) {
                        $collecting = true;
                        $cnt++;
                    }
                    else {
                        $f = false;
                    }
                }
                else {
                    $f = false;
                }
                $lineSymbolCount++;
            }
            if($cnt >= $this->params->minWinCount) {
                $winLines[] = array(
                    'line' => $line,
                    'count' => $cnt,
                    'id' => $lineId,
                    'double' => $this->double * $double,
                    'withWild' => $withWild,
                    'collecting' => $collecting,
                );
            }


            $lineId++;
        }
        return $winLines;
    }

    /**
     * Получаем список выигрышных линий для символа по 243 ways
     *
     * Возвращает массив, содержащий описание линий, на которых символов >= minWinCount
     *
     * @param array $symbol Массив числовых идентификаторов символа
     * @return array
     */
    private function get243($symbol) {
        $winLines = array();
        $cnt = 0;
        $offsets = array();
        /*
         * Получаем длину всех путей, закидываем оффсеты символов и тип символа(обычный или вайлд)
         */
        $symbolPresent = false;

        $bonusWildPosition = array();
        foreach($this->bonusWildsMultiple as $b) {
            $bonusWildPosition[] = $b['offset'];
        }
        for($i = 0; $i <= 4; $i++) {
            $offsets[$i] = array();
            $update = false;
            for($j = 0; $j < $this->rows; $j++) {
                $symbolOffset = $this->getSymbolPositionOnReel($symbol, $i, $j);
                $wildOffset = $this->getSymbolPositionOnReel($this->wild, $i, $j);
                if($symbolOffset !== false) {
                    $symbolPresent = true;
                    $update = true;
                    $type = 'symbol';
                    if($this->wild[0] == $symbol[0]) {
                        $type = 'wild';
                    }
                    $offsets[$i][] = array(
                        'offset' => $symbolOffset,
                        'type' => $type,
                    );
                }
                elseif($wildOffset !== false) {
                    $update = true;
                    $type = 'wild';
                    if(in_array($wildOffset, $bonusWildPosition)) {
                        $type = 'symbol';
                    }
                    $offsets[$i][] = array(
                        'offset' => $wildOffset,
                        'type' => $type,
                    );
                }
            }

            if($update) {
                $cnt++;
            }
            else {
                break;
            }
        }
        if($cnt >= $this->params->minWinCount && $symbolPresent) {
            for($ccc = 0; $ccc <= 4; $ccc++) {
                if(empty($offsets[$ccc])) $offsets[$ccc] = array();
            }

            $s1 = count($offsets[0]);
            do {
                if(isset($offsets[0][$s1-1])) {
                    $item = $offsets[0][$s1-1];
                    $s1Offset = $item['offset'];
                    $s1Wild = ($item['type'] == 'wild') ? true : false;
                }
                $s2 = count($offsets[1]);
                do {
                    if(isset($offsets[1][$s2-1])) {
                        $item = $offsets[1][$s2-1];
                        $s2Offset = $item['offset'];
                        $s2Wild = ($item['type'] == 'wild') ? true : false;
                    }
                    $s3 = count($offsets[2]);
                    do {
                        if(isset($offsets[2][$s3-1])) {
                            $item = $offsets[2][$s3-1];
                            $s3Offset = $item['offset'];
                            $s3Wild = ($item['type'] == 'wild') ? true : false;
                        }
                        $s4 = count($offsets[3]);
                        do {
                            if(isset($offsets[3][$s4-1])) {
                                $item = $offsets[3][$s4-1];
                                $s4Offset = $item['offset'];
                                $s4Wild = ($item['type'] == 'wild') ? true : false;
                            }
                            $s5 = count($offsets[4]);
                            do {
                                if(isset($offsets[4][$s5-1])) {
                                    $item = $offsets[4][$s5-1];
                                    $s5Offset = $item['offset'];
                                    $s5Wild = ($item['type'] == 'wild') ? true : false;
                                }
                                $resultOffsets = array();
                                if(isset($s1Offset)) $resultOffsets[] = $s1Offset;
                                if(isset($s2Offset)) $resultOffsets[] = $s2Offset;
                                if(isset($s3Offset)) $resultOffsets[] = $s3Offset;
                                if(isset($s4Offset)) $resultOffsets[] = $s4Offset;
                                if(isset($s5Offset)) $resultOffsets[] = $s5Offset;

                                $double = 1;
                                if($this->params->doubleIfWild) {
                                    if(isset($s1Wild)) if($s1Wild) $double = 2;
                                    if(isset($s2Wild)) if($s2Wild) $double = 2;
                                    if(isset($s3Wild)) if($s3Wild) $double = 2;
                                    if(isset($s4Wild)) if($s4Wild) $double = 2;
                                    if(isset($s5Wild)) if($s5Wild) $double = 2;
                                }
                                $withWild = ($double > 1) ? true : false;
                                $winLines[] = array(
                                    'line' => $resultOffsets,
                                    'count' => $cnt,
                                    'id' => implode('', $resultOffsets),
                                    'double' => $this->double * $double,
                                    'withWild' => $withWild,
                                );
                                $s5--;
                            } while ($s5 > 0);
                            $s4--;
                        } while ($s4 > 0);
                        $s3--;
                    } while ($s3 > 0);
                    $s2--;
                } while ($s2 > 0);
                $s1--;
            } while ($s1 > 0);
        }


        return $winLines;
    }

    /**
     * Проверяем, есть ли выигрышные линии у слота после спина.
     * Данная функция нужна для бонусов, которые срабатывают, если есть выигрышные линии.
     *
     * @return bool
     */
    public function checkWinLinesPresent() {
        $present = false;
        foreach ($this->winSymbols as $winLine) {
            $v = $this->params->getSymbolID($winLine['symbol']);
            if ($this->params->winLineType == 'left') {
                $SymbolwinLines = $this->getLeft($v);
            } elseif ($this->params->winLineType == '243') {
                $SymbolwinLines = $this->get243($v);
            } else {
                $SymbolwinLines = $this->getLeft($v);
            }
            foreach ($SymbolwinLines as $w) {
                if ($this->params->checkSymbolCount($v, $w['count'])) {
                    $present = true;
                    return $present;
                }
            }
        }
        return $present;
    }

    /**
     * Получение списка символов, которые находятся на выигрышной линии
     *
     * @param int $line Номер выигрышной линии
     * @return array
     */
    private function getLineSymbols($line) {
        $lineSymbols = array();
        foreach($line as $k=>$v) {
            $lineSymbols[] = $this->reels[$k]->getVisibleSymbol($v);
        }
        return $lineSymbols;
    }

    /**
     * Получаем Offset по указанной линии в нужном количестве
     *
     * @param array $line Выигрышная линия
     * @param int $count Размер возвращаемого массива $offsets
     * @return array
     */
    public function getOffsetsByLine($line, $count) {
        $offsets = array();

        $position = array(
            // Первая строка слота
            array(0, 1, 2, 3, 4),
            // Вторая строка слота
            array(5, 6, 7, 8, 9),
            // Третья строка слота
            array(10, 11 , 12, 13, 14),
            // Четвертая строка
            array(15, 16, 17, 18, 19),
        );
        for($i = 0; $i < $count; $i++) {
            $offsets[] = $position[$line[$i]][$i];
        }
        return $offsets;
    }

    /**
     * Получаем Offset символов барабана по его номеру
     *
     * @param int $reelNumber
     * @return array
     */
    public function getReelOffset($reelNumber) {
        $position = array(
            // Первая строка слота
            array(0, 1, 2, 3, 4),
            // Вторая строка слота
            array(5, 6, 7, 8, 9),
            // Третья строка слота
            array(10, 11 , 12, 13, 14),
            // Четвертая строка
            array(15, 16, 17, 18, 19),
        );

        return array($position[0][$reelNumber], $position[1][$reelNumber], $position[2][$reelNumber]);
    }

    /**
     * Получение оффсета(смещения) барабанов
     *
     * Массив формируется как для строк слота, а не барабанов
     *
     * @return array
     */
    public function getOffsets() {
        $offsets = array();
        for($i = 1; $i <= $this->rows; $i++) {
            $offsets["$i"] = array();
        }
        foreach($this->reels as $r) {
            for($j = 1; $j <= $this->rows; $j++) {
                if($j <= $r->getVisibleCount()) {
                    $offsets["$j"][] = $r->getOffset() + $j;
                }
            }
        }
        return $offsets;
    }

    /**
     * Получение видимых символов барабанов
     *
     * Массив формируется как для строк слота, а не барабанов
     *
     * @return array
     */
    private function getRows() {
        $rows = array();
        for($i = 1; $i <= $this->rows; $i++) {
            $rows["$i"] = array();
        }

        foreach($this->reels as $r) {
            $symbols = $r->getVisibleSymbols();
            for($j = 1; $j <= count($symbols); $j++) {
                $rows["$j"][] = $symbols[$j - 1];
            }
        }
        return $rows;
    }
}

?>
