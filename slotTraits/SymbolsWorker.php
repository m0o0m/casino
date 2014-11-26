<?php

/**
 * Class SymbolsWorker
 *
 * Получение\Проверка символов на барабанах
 */
trait SymbolsWorker {
    /**
     * Проверка наличия символа на отображаемых символах барабана
     *
     * false - символа нету.
     * int - относительное положение символа на слоте
     *
     * @param string $symbol Буквенный идентификатор символа
     * @param int $reelNumber Номер барабана ( начинается с 0)
     * @return bool|int
     */
    public function checkSymbolOnReelAnyPosition($symbol, $reelNumber) {
        $id = $this->params->getSymbolID($symbol);
        $visible = $this->reels[$reelNumber]->getVisibleSymbols();
        $f = false;
        $c = 0;
        $offset = false;
        foreach($visible as $v) {
            if(in_array($v, $id)) {
                $offset = $c * 5 + $reelNumber;
            }
            $c++;
        }
        return $offset;
    }

    /**
     * Проверка и получение оффсета символа на барабане.
     * Если символа нету на барабане+позиции, то возвращает false
     *
     * @param array $symbol Числовые идентификаторы символа
     * @param int $reel Номер барабана
     * @param int $position Позиция символа на барабане
     * @return bool
     */
    public function getSymbolPositionOnReel($symbol, $reel, $position) {
        $v = $this->getReelSymbol($reel, $position);
        $offset = false;
        if(in_array($v, $symbol)) {
            $offset = $position * 5 + $reel;
        }
        return $offset;
    }

    /**
     * Проверка положения символа на определенной позиции барабана
     *
     * @param string $symbol Буквенный идентификатор символа
     * @param $reelNumber Номер барабана ( начинается с 0)
     * @param $position Позиция на отображаемых символах барабана (начинается с 0)
     * @return bool
     */
    public function chechSymbolOnReel($symbol, $reelNumber, $position) {
        $id = $this->params->getSymbolID($symbol);
        $reelSymbol = $this->getReelSymbol($reelNumber, $position);
        return in_array($reelSymbol, $id);
    }

    /**
     * Получение символа барабана на определенной позиции
     *
     * @param int $reel Номер барабана (начинается с 0)
     * @param int $position Позиция на отображаемых символах барабана (начинается с 0)
     * @return int
     */
    public function getReelSymbol($reel, $position) {
        $visible = $this->getReelSymbols($reel);
        return $visible[$position];
    }

    /**
     * Получение массива отображаемых символов барабана
     *
     * @param int $reel Номер барабана (начинается с 0)
     * @return array Массив числовых идентификаторов символов, которые отображаются на барабане
     */
    public function getReelSymbols($reel) {
        return $this->reels[$reel]->getVisibleSymbols();
    }

    /**
     * Получение количества и положения скаттров на барабанах
     *
     *
     * @return array
     * count - количество скаттеров
     * offsets - Массив позиций скаттеров
     */
    public function getScattersCount() {
        $s = $this->scatter;
        $cnt = 0;
        $offsets = array();
        $i = 0;
        foreach($this->reels as $reel) {
            $report = $reel->checkScatters($s, $i);
            foreach($report as $m) {
                $cnt++;
                $offsets[] = $m;
            }
            $i++;
        }
        return array(
            'count' => $cnt,
            'offsets' => $offsets,
        );
    }

    /**
     * Получение количества символа на барабанах
     *
     * @param string $symbol Буквенный идентификатор символа
     * @return array
     * count - Количество символа на барабанах
     * offsets - Позиции символа на барабанах
     */
    public function getSymbolAnyCount($symbol) {
        $id = $this->params->getSymbolID($symbol);
        $cnt = 0;
        $offsets = array();
        $i = 0;
        foreach($this->reels as $reel) {
            $report = $reel->checkSymbol($id, $i);
            foreach($report as $m) {
                $cnt++;
                $offsets[] = $m;
            }
            $i++;
        }
        return array(
            'count' => $cnt,
            'offsets' => $offsets,
        );
    }
}
