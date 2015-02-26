<?php

/**
 * Class Reel
 *
 * Барабаны
 */
class Reel {
    /**
     * @var array $symbols Символы барабана. Берутся из переданной раскладки
     */
    private $symbols = array();
    /**
     * @var array $newSymbols Новый массив символов после спина
     */
    private $newSymbols = array();
    /**
     * @var array $visibleSymbols Видимые символы барабана
     */
    private $visibleSymbols = array();
    /**
     * @var int $visibleCount Количество видимых символов на барабане
     */
    private $visibleCount = 3;
    /**
     * @var int $offset Смещение барабана
     */
    private $offset = 0;

    /**
     * Устанавливаем символы барабана согласно переданной раскладке
     *
     * @param $symbols Раскладка
     * @param int $visibleCount Количество видимых символов
     */
    public function __construct($symbols, $visibleCount = 3) {
        $this->symbols = $symbols;
        $this->newSymbols = $symbols;
        $this->visibleCount = $visibleCount;
        $this->updateVisibleSymbols();
    }

    /**
     * Спиним барабан.
     *
     * Смещаем символы на рандомное значение.
     * Устанавливаем offset барабана
     * Обновляем видимые символы
     *
     * @return $this
     */
    public function spin() {
        $tmp = array_merge($this->symbols, $this->symbols);
        $cnt = count($this->symbols);
        $this->offset = rnd(0, $cnt);
        $this->newSymbols = array_slice($tmp, $this->offset, $cnt);
        $this->updateVisibleSymbols();

        return $this;
    }

    /**
     * Заменяет символ на другой
     *
     * @param $old
     * @param $new
     */
    public function replaceSymbols($old, $new) {
        foreach($this->newSymbols as &$s) {
            if($s == $old) {
                $s = $new;
            }
        }
        $this->updateVisibleSymbols();
    }

    /**
     * Функция подобна spin(), но смещение барабана мы задаем вручную
     *
     * @param $offset
     * @return $this
     */
    public function setOffset($offset) {
        $tmp = array_merge($this->symbols, $this->symbols);
        $cnt = count($this->symbols);
        $this->offset = $offset;
        $this->newSymbols = array_slice($tmp, $this->offset, $cnt);
        $this->updateVisibleSymbols();

        return $this;
    }

    /**
     * Получение видимых символов барабана
     *
     * @return array Видимые символы барабана
     */
    public function getVisibleSymbols() {
        return $this->visibleSymbols;
    }

    /**
     * Обновление видимых символов барабана. Устанавливаются как первые символы барабана(после смещения)
     */
    private function updateVisibleSymbols() {
        for($i = 0; $i < $this->visibleCount; $i++) {
            $this->visibleSymbols[$i] = $this->newSymbols[$i];
        }
    }

    /**
     * Получение видимого символа барабана по позиции (начинается с 0)
     *
     * @param int $pos Позиция символа
     * @return int Числовой идентификатор символа
     */
    public function getVisibleSymbol($pos) {
        return $this->visibleSymbols[$pos];
    }

    /**
     * Устанавливает барабан как wild-барабан
     *
     * @param int $wildSymbol Числовой идентификатор вайлда
     */
    public function setAsWild($wildSymbol) {
        for($i = 0; $i < $this->visibleCount; $i++) {
            $this->setSymbolOnPosition($i, $wildSymbol);
        }
    }

    /**
     * Установка символа на определенную позицию
     *
     * @param int $pos Позиция на барабане (начинается с 0)
     * @param int $symbol Числовой идентификатор символа
     */
    public function setSymbolOnPosition($pos, $symbol) {
        $this->newSymbols[$pos] = $symbol;
        $this->updateVisibleSymbols();
    }

    /**
     * Получение позиций скаттеров на барабане
     *
     * Формирует и повзращает массив оффсетов скаттеров
     *
     * @param array $scatter Массив числовых идентификаторов скаттеров
     * @param int $iterate Номер барабана. Нужен для формирования оффсета
     * @return array
     */
    public function checkScatters($scatter, $iterate) {
        $offsets = array();
        $visibleCount = $this->visibleCount - 1;
        for($i = 0; $i <= $visibleCount; $i++) {
            if(in_array($this->newSymbols[$i], $scatter)) {
                $offsets[] = $i * 5 + $iterate;
            }
        }
        return $offsets;
    }

    /**
     * Получение позиций символа\символов на барабане
     *
     * Формирует и повзращает массив оффсетов символа\символов
     *
     * @param array $symbol Массив числовых идентификаторов символа\символов
     * @param int $iterate Номер барабана. Нужен для формирования оффсета
     * @return array
     */
    public function checkSymbol($symbol, $iterate) {
        $offsets = array();
        $visibleCount = $this->visibleCount - 1;
        for($i = 0; $i <= $visibleCount; $i++) {
            if(in_array($this->newSymbols[$i], $symbol)) {
                $offsets[] = $i * 5 + $iterate;
            }
        }
        return $offsets;
    }

    /**
     * Получение смещения барабана
     *
     * @return int $this->offset
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * Удаление выигрышныго символа линии и сдвиг предыдущих с добавлением 1 невидимого символа слота
     *
     * @param int $position
     */
    public function avalanche($position) {
        $del = $this->newSymbols[$position];
        unset($this->newSymbols[$position]);
        $lastSymbol = array_pop($this->newSymbols);
        array_unshift($this->newSymbols, $lastSymbol);
        $this->newSymbols = array_values($this->newSymbols);
        $this->newSymbols = array_merge(array_slice($this->newSymbols, 0, $this->visibleCount), array($del), array_slice($this->newSymbols, $this->visibleCount));

        $this->updateVisibleSymbols();
    }

    /**
     * Возвращает количество видимых символов на барабане
     *
     * @return int
     */
    public function getVisibleCount() {
        return $this->visibleCount;
    }
}

?>
