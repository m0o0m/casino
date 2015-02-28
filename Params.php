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
 * Class Params
 *
 * Параметры игры
 */
class Params {
    /**
     * @var bool $doubleIfWild Удваивать, если в выиграшной линии есть вайлд
     */
    public $doubleIfWild = false;
    /**
     * @var int $minWinCount Минимальное количество подряд идущих символов, что бы линия попала в проверку по выплатам
     */
    public $minWinCount = 2;
    /**
     * @var bool Включить запуск нужным бонусов по переданному GET параметру bonus
     */
    public $testBonusEnable = true;

    /**
     * @var string По какому принципу получаются выигрышные линии
     */
    public $winLineType = 'left';

    /**
     * Создание параметров игры и установка текущего ID игры
     *
     * @param int $gameID Номер игры
     */
    public function __construct($gameID) {
        $this->gameID = $gameID;
    }

    /**
     * Создание XML по барабанам
     *
     * @return string
     */
    public function getReels() {
        $reelsStr = '';

        foreach($this->reels as $i=>$reel) {
            $reelsStr .= '<EEGLoadReelsResponse gameId="'.$this->gameID.'">';
            $c = count($reel);
            $reelsStr .= '<Reels reelset="'.$i.'" numReels="'.$c.'">';
            foreach($reel as $k=>$row) {
                $reelsStr .= '<Reel id="'.$k.'" numStops="'.count($row).'" stops="'.implode(',', $row).'" />';
            }
            $reelsStr .= '</Reels>';
            $reelsStr .= '</EEGLoadReelsResponse>';
        }

        return $reelsStr;
    }

    /**
     * Создание настроек ставок для игры
     */
    public function createBetConfig() {
        $this->betConfig = array();
        $winLinesCount = count($this->winLines);
        if(!is_array($this->denominations)) {
            $this->denominations = explode(',', $this->denominations);
        }
        $this->betConfig['minBet'] = $this->denominations[0];
        $this->betConfig['maxBet'] = end($this->denominations) * $winLinesCount;
        $this->betConfig['defaultBet'] = $this->default_coinvalue;
        $this->betConfig['currency'] = $this->curiso;
        $this->betConfig['currencyPrefix'] = $this->currency;
        $this->betConfig['increaseCount'] = array();
        foreach($this->denominations as $i) {
            $this->betConfig['increaseCount'][strval($i)] = 0;
        }
        
        if(file_exists('../enableCrutch')) {
            $this->testBonusEnable = true;
        }
        else {
            $this->testBonusEnable = false;
        }
    }

    /**
     * Создание XML по увеличению ставок
     *
     * @return string
     */
    public function getIncreaseData() {
        $xml = '';
        foreach($this->betConfig['increaseCount'] as $k=>$v) {
            $xml .= '<Option incStake="'.$k.'" incPeriod="'.$v.'" />';
        }
        return $xml;
    }

    /**
     * Создание XML по выплатам
     *
     * @return string
     */
    public function getPrizes() {
        $prizeStr = '';
        foreach($this->winPay as $prize) {
            $prizeStr .= '<Prize odds="'.$prize['multiplier'].'" type="'.$prize['count'].$prize['symbol'].'" />';
        }
        return $prizeStr;
    }

    /**
     * Создание XML по выплатам
     *
     * @return string
     */
    public function getPrizes2() {
        $prizeStr = '';
        foreach($this->winPay2 as $prize) {
            $prizeStr .= '<Prize odds="'.$prize['multiplier'].'" type="'.$prize['count'].$prize['symbol'].'" />';
        }
        return $prizeStr;
    }

    /**
     * Создание XML по выигрышным линиям
     *
     * @return string
     */
    public function getWinLines() {
        $xml = '<EEGLoadWinLinesResponse gameId="'.$this->gameID.'">
        <WinLines>';
        foreach($this->winLines as $k=>$line) {
            $tmp = array();
            foreach($line as $c) {
                $tmp[] = $c - 1;
            }
            $lineStr = implode(',', $tmp);
            $xml .= '<Line num="'.($k + 1).'" offsets="'.$lineStr.'" />';
        }
        $xml .= '</WinLines></EEGLoadWinLinesResponse>';

        return $xml;
    }

    /**
     * Получение ID символа по буквенному идентификатору.
     *
     * @param string $symbol
     * @return array
     */
    public function getSymbolID($symbol) {
        return $this->symbols[$symbol];
    }

    /**
     * Получение буквенного идентификатора по массиву числовых идентификаторов символа
     *
     * @param array $id
     * @return bool|int|string
     */
    public function getSymbolByID($id) {
        foreach($this->symbols as $k=>$v) {
            if ((!array_diff($id, $v) && !array_diff($v, $id)) || in_array($id[0], $v)) {
                return $k;
            }
        }
        return false;

    }

    /**
     * Проверка на то, что указанный символ в указанном количестве есть в таблице выплат.
     *
     * То есть идет проверка на то, что комбинация символов на какой-то линии является выигрышной.
     *
     * @param array $symbol
     * @param int $count
     * @return bool
     */
    public function checkSymbolCount($symbol, $count) {

        $s = $this->getSymbolByID($symbol);
        foreach($this->winPay as $w) {
            if($s == $w['symbol'] && $w['count'] == $count) return true;
        }
        return false;
    }

    /**
     * Получение множителя ставки на линию для указанного символа в указанном количестве
     *
     * @param array $symbol
     * @param int $count
     * @return int|bool
     */
    public function getWinMultiplier($symbol, $count) {

        $s = $this->getSymbolByID($symbol);
        foreach($this->winPay as $w) {
            if($s == $w['symbol'] && $w['count'] == $count) return $w['multiplier'];
        }
        return false;
    }

    /**
     * Создание строки для барабанов, которая отображает символы
     *
     * Например A,C,B,D,C;S,W,A,J,Q;J,K,T,S,W
     *
     * @param array $reels
     * @return string
     */
    public function getDisplay($reels) {
        $str = '';
        foreach($reels as $reel) {
            foreach($reel as $symbol) {
                $str .= $this->getSymbolByID(array($symbol)) .',';
            }
            $str = substr($str, 0, -1);
            $str .= ';';
        }
        return substr($str, 0, -1);
    }
}
