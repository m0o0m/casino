<?php

/**
 * Class BonusWorker
 *
 * Проверка, установка бонусов. Получение информации по бонусам
 */
trait BonusWorker {

    /**
     * Проверка переданных бонусов и запуск нужных
     *
     * Может передаваться как один бонус так и массив бонусов
     */
    private function checkBonus() {
        $bonus = $this->spinBonus;
        if(!empty($bonus['type'])) {
            $this->executeBonus($bonus);
        }
        else {
            foreach($bonus as $b) {
                $this->executeBonus($b);
            }
        }
    }

    /**
     * Применение бонуса
     *
     * type - Обязательный параметр бонуса. Указывает тип бонуса
     * Для каждого типа бонуса идут дополнительные параметры
     *
     * @param array $bonus
     */
    private function executeBonus($bonus) {
        switch($bonus['type']) {
            case 'multiple':
                $this->double = rnd($bonus['range'][0], $bonus['range'][1]);
                break;
            case 'wildReel':
                $this->setWildReel($bonus['number'], $this->wild[0]);
                break;
            case 'randomWild':
                $not = (empty($bonus['not'])) ? false : $bonus['not'];
                $this->setRandomWild($bonus['range'], $not);
                break;
            case 'multipleWithWild':
                $this->setMultipleWithWild($bonus['multiple']);
                break;
            case 'wildsOnPos':
                $this->setWildsOnPos($bonus['offsets']);
                break;
            case 'wildReels':
                $this->setWildReels($bonus['reels']);
                break;
            case 'expandWild':
                $this->checkExpandWild($bonus['reels'], $bonus['symbolsID'], $bonus['wild']);
                break;
            case 'testFS':
                $this->setScatters();
                break;
            case 'stepWild':
                $this->setStepWild($bonus['steps']);
                break;
            case 'setWildsIf':
                $this->setWildsIf($bonus['symbol'], $bonus['reel'], $bonus['countConfig']);
                break;
            case 'odinRavens':
                $this->odinRavens($bonus['positions'], $bonus['x3Chance'], $bonus['x6Chance']);
                break;
        }
    }

    /**
     * Если определенный символ присутствует на определенном барабане,
     * то случайные символы превращаются в вайлды. Количество превращений указано в countConfig
     *
     * @param string $symbol
     * @param int $reel
     * @param array $countConfig
     */
    private function setWildsIf($symbol, $reel, $countConfig) {
        $offset = $this->checkSymbolOnReelAnyPosition($symbol, $reel);
        if($offset) {
            $count = $countConfig['count'][$countConfig['countRnd'][rnd(0, count($countConfig['countRnd'])-1)]];
            $wildOffsets = array();
            while(count($wildOffsets) != $count) {
                $rnd = rnd(0,14);
                if(in_array($rnd, $wildOffsets) || $rnd == $offset) {

                }
                else {
                    $wildOffsets[] = $rnd;
                }
            }
            $this->bonusData = array(
                'randomWilds' => $wildOffsets,
                'baseWildOffset' => $offset,
            );
            $wildOffsets[] = $offset;
            $this->setWildsOnPos($wildOffsets);
        }

    }

    /**
     * Устанавливает барабан в wild-барабан
     *
     * @param int $reelNumber Номер барабана
     * @param int $wild Числовой идентификатор вайлда
     */
    private function setWildReel($reelNumber, $wild) {
        $this->reels[$reelNumber]->setAsWild($wild);
    }

    /**
     * Устанавливает рандомное число вайлдов в зависимости от диапазона ($range)
     *
     * Если передан $not, то на этот offset нельзя поставить wild
     *
     * @param array $range Диапазон количества рандомных вайлдов
     * @param int $not Offset
     */
    private function setRandomWild($range, $not) {
        $size = $this->params->bonusRand[rnd(0, count($this->params->bonusRand)-1)];
        $arr = array();
        while(count($arr) != $size) {
            $r = rnd(0,14);
            if(!in_array($r, $arr) && $r !== $not) $arr[] = $r;
        }
        $this->setWildOnReels($arr);
    }

    /**
     * Устанавливает множитель и wild на средний символ слота (3 барабан, 2 позиция)
     *
     * @param int $multiple Множитель всех выигрышей
     */
    private function setMultipleWithWild($multiple) {
        $this->double = $this->double * $multiple;
        $this->reels[2]->setSymbolOnPosition(1, $this->wild[0]);
        $this->bonusData = array(
            'offsets' => array(7),
            'multiple' => $multiple,
        );
    }

    /**
     * Устанавливает wild на определенную позицию барабана по переданному offsets
     *
     * @param array $offsets Относительное положение символов на слоте
     */
    private function setWildsOnPos($offsets) {
        foreach($offsets as $pos) {
            $reelNumber = $pos % 5;
            $p = floor($pos / 5);
            $this->reels[$reelNumber]->setSymbolOnPosition($p, $this->wild[0]);
        }
    }

    /**
     * Установка барабанов в wild-барабаны
     *
     * Если передан $setWild, то этот символ будет использоваться как Wild
     * Стандартно используется нулевой символ массива $this->wild
     *
     * @param array $reels Массив номеров барабанов(начинается с 0), которые нужно сделать wild-барабанами
     * @param bool $setWild
     */
    private function setWildReels($reels, $setWild = false) {
        $wild = $this->wild[0];
        if($setWild !== false) {
            $wild = $setWild;
        }
        foreach($reels as $reel) {
            $this->setWildReel($reel, $wild);
        }
        $offsets = array();
        foreach($reels as $r) {
            $offsets[] = $this->getReelOffset($r);
        }
        $this->bonusData = array(
            'reels' => $reels,
            'offsets' => $offsets,
        );
    }

    /**
     * Проверка на возможность сделать из барабана wild-барабан.
     *
     * Если отображаемые символы барабана содержат только символы, переданные в $symbolsID,
     * то отображаемые символы заменяются на $wild и барабан становится wild-барабаном
     *
     * @param array $reels Массив номеров барабанов(начинается с 0), на которых проходит проверка
     * @param array $symbolsID Массив числовых идентификаторов символов, которые должны быть на барабане
     * @param int $wild Идентификатор вайлда, который заменит все отображаемые символы барабана
     */
    private function checkExpandWild($reels, $symbolsID, $wild) {
        foreach($reels as $reel) {
            $r = $this->reels[$reel];
            $visible = $r->getVisibleSymbols();
            $f = true;
            foreach($visible as $symbol) {
                if(!in_array($symbol, $symbolsID)) {
                    $f = false;
                }
            }
            if($f) {
                $this->setWildReel($reel, $wild);
            }
        }
    }

    /**
     * Тестовый бонус для установки 3х скаттеров на последний барабан.
     * Этот бонус запускает фриспины.
     */
    private function setScatters() {
        $this->reels[4]->setSymbolOnPosition(0, $this->params->scatter[0]);
        $this->reels[4]->setSymbolOnPosition(1, $this->params->scatter[0]);
        $this->reels[4]->setSymbolOnPosition(2, $this->params->scatter[0]);
    }

    /**
     * Устанавливает вайлды на переданный offsets
     *
     * Вайлд берется как нулевой элемент $this->wild
     *
     * @param array $offsets
     */
    private function setWildOnReels($offsets) {
        foreach($offsets as $pos) {
            $reelNumber = $pos % 5;
            $p = floor($pos / 5);
            $this->reels[$reelNumber]->setSymbolOnPosition($p, $this->wild[0]);
        }
        $this->bonusData = array(
            'offsets' => $offsets,
        );
    }

    /**
     * Устанавливаем нужные вайлды в зависимости от номера спина
     *
     * @param array $steps
     */
    private function setStepWild($steps) {
        $needleWilds = array();
        foreach($steps as $key=>$value) {
            if($this->step >= $key) {
                $needleWilds = $value;
            }
        }
        $this->setWilds($needleWilds);
    }

    private function odinRavens($positions, $x3Chance, $x6Chance) {
        $present = $this->checkWinLinesPresent();
        if($present) {
            $multiple = 2;
            if(rnd(1, $x3Chance) == 1) {
                $multiple = 3;
            }
            $pos = $positions[rnd(0, count($positions) - 1)];
            $this->setWildOnReels(array($pos));
            $this->bonusWildsMultiple[] = array(
                'offset' => $pos,
                'multiple' => $multiple,
            );
            $resultPos = array($pos);
            if(rnd(1, $x6Chance) == 1) {
                $pos2 = $pos;
                while($pos2 == $pos) {
                    $pos2 = $positions[rnd(0, count($positions) - 1)];
                }
                $this->setWildOnReels(array($pos2));
                $newMultiple = 2;
                if($multiple == 2) $newMultiple = 3;
                $this->bonusWildsMultiple[] = array(
                    'offset' => $pos2,
                    'multiple' => $newMultiple,
                );
                $resultPos = array($pos, $pos2);
            }


            $this->bonusData = array(
                'randomWilds' => $resultPos,
            );
        }
    }

    /**
     * Получение данных по дополнительным выплатам по линиям
     *
     * Массив символов, которые проверяются содержится в параметрах игры в lineBonus['symbols']
     * Массив выплат по количеству содержится в lineBonus['multiplier']
     *
     * @param int $countSymbols
     * @return array
     *
     * totalMultiple - общий множитель по всем линиям, которые прошли
     * lines - массив линий, которые прошли. Содержит lineId(номер линии), multiple(множитель) и offsets(Положение символов на слоте)
     * win - true\false
     * count - Количество символов для проверки. То есть длина выигрышной линии.
     * primaryLine - ID последней выигрышной линии.
     */
    public function getFullLineBonus($countSymbols = 5) {
        $bonusArray = array(
            'totalMultiple' => 0,
            'lines' => array(),
            'win' => false,
            'count' => $countSymbols,
        );
        $paramSymbols = $this->params->lineBonus['symbols'];
        array_splice($paramSymbols, $countSymbols);
        foreach($this->lines as $i=>$line) {
            $symbols = $this->getLineSymbols($line);
            array_splice($symbols, $countSymbols);
            if(!array_diff($paramSymbols, $symbols) && !array_diff($symbols, $paramSymbols)) {
                $bonusArray['lines'][] = array(
                    'lineId' => $i + 1,
                    'multiple' => $this->params->lineBonus['multiplier'][$countSymbols],
                    'offsets' => $this->getOffsetsByLine($line, $countSymbols),
                );
                $bonusArray['primaryLine'] = $i + 1;
                $bonusArray['totalMultiple'] += $this->params->lineBonus['multiplier'][$countSymbols];
                $bonusArray['win'] = true;
            }
        }
        return $bonusArray;
    }

    /**
     *
     * Если есть выигрышные линии, то символы на этих линиях убираются и заменяются
     * предыдущими невидимыми символами слота. Репорт делается для каждой победы до тех пор,
     * пока выигрышных линий не будет.
     *
     * @param array $report - Репорт спина.
     * @param array $addOffset - Дополнительный массив оффсетов для сдвига
     * @return array
     */
    public function startAvalanche($report, $addOffset = array(), $getOffset = true, $scattersCount = 3) {
        $resultOffsets = array();
        foreach($report['winLines'] as $winLine) {
            if($getOffset) {
                $resultOffsets = array_merge($resultOffsets, $this->getOffsetsByLine($winLine['line'], $winLine['count']));
            }
            else {
                $resultOffsets = array_merge($resultOffsets, $winLine['line']);
            }

        }
        if($report['scattersReport']['count'] >= $scattersCount) {
            $resultOffsets = array_merge($resultOffsets, $report['scattersReport']['offsets']);
        }
        $resultOffsets = array_merge($resultOffsets, $addOffset);
        $resultOffsets = array_unique($resultOffsets);
        sort($resultOffsets);
        foreach($resultOffsets as $offset) {
            $reelNumber = $offset % 5;
            $p = floor($offset / 5);
            $this->reels[$reelNumber]->avalanche($p);
        }

        $this->step++;

        $this->resetSlotData();
    }

}
