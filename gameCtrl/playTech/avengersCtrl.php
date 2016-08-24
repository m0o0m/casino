<?

class avengersCtrl extends Ctrl {
    public $useSessionBet = true;
    /*
     * Отвечает баланс+выплаты+расскладки
     */
    protected function startInit($request) {
        if(empty($_SESSION['drawStates'])) {
            $draws = '<DrawState drawId="0"/>';
        }
        else {
            $gDraw = '';
            try {
                $gDraw = gzuncompress(base64_decode($_SESSION['drawStates']));
            }
            catch (Exception $e) {

            }
            if(!empty($_SESSION['savedState'])) {
                $savedState = '';
                foreach($_SESSION['savedState'] as $key=>$val) {
                    $savedState .= $val;
                }
                $draws = $savedState.$gDraw;
            }
            else $draws = $gDraw;
        }

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        '.$draws.'
    </EEGOpenGameResponse>
    '.$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <Prize type="Avengers Assemble" odds="200.00" />
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse>
    '.$this->gameParams->getReels().'</CompositeResponse>';

        $this->outXML($xml);
    }

    /*
     * Спин
     */
    protected function startSpin($request) {
        $betAttr = (array) $request->Bet;
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['stake'];
        $pick = substr($betAttr['pick'], 1);

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $this->slot->setDefaultReels();
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],

        );
        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'WOH':
                $this->showWOHReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    /*
     * Получаем данные спина и сумарный выигрыш
     */
    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;
        $report = $this->slot->spin();

        $report['bonusLine'] = $this->slot->getFullLineBonus();
        if($report['bonusLine']['totalMultiple'] > 0) {
            $report['totalWin'] += $report['betOnLine'] * $report['bonusLine']['totalMultiple'];
            $report['spinWin'] += $report['betOnLine'] * $report['bonusLine']['totalMultiple'];
        }
        $report['type'] = 'SPIN';
        $report['scattersReport'] = $this->slot->getScattersCount();

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getWallOfHero($report);
                $report['totalWin'] = $this->fsBonus['totalWin'];
                $report['type'] = 'WOH';
            }
        }

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'line':
                    if($report['bonusLine']['totalMultiple'] < 1) $respin = true;
                    break;
            }
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        if($report['bonusLine']['totalMultiple'] > 0) {
            foreach($report['bonusLine']['lines'] as $line) {
                $bonus .= '<Bonus line="'.$line['lineId'].'" offsets="'.implode(',', $line['offsets']).'" prize="Avengers Assemble" length="5" payout="'.$report['betOnLine']*$line['multiple'].'" />';
            }
        }
        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        if($totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    /*
     * Получаем данные по Wall Of Hero
     */
    protected function getWallOfHero($report) {
        $this->fsBonus = array();
        $this->fsBonus['detailArray'] = array();
        $cnt = 0;
        $bonus = '';
        while($bonus !== 'Exit') {
            $d = $this->getWOHDetail($cnt);
            $this->fsBonus['detailArray'][] = $d;
            $bonus = $d['bonus'];
            $cnt++;
        }

        $this->fsBonus['spins'] = (count($this->fsBonus['detailArray']) - 1) * 9;
        $this->fsBonus['startWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawID'] = 0;
        $this->fsBonus['bonusArray'] = array();
        $currentStepNumber = 0;
        foreach($this->fsBonus['detailArray'] as $step) {
            switch($step['bonus']) {
                case 'Captain America':
                    $this->slot->setReels($this->gameParams->reels[1]);
                    $this->fsBonus['bonusArray'][] = $this->startCaptainAmericaBonus($currentStepNumber);
                    break;
                case 'Hulk':
                    $this->slot->setReels($this->gameParams->reels[2]);
                    $this->fsBonus['bonusArray'][] = $this->startHulkBonus($currentStepNumber);
                    break;
                case 'Thor':
                    $this->slot->setReels($this->gameParams->reels[3]);
                    $this->fsBonus['bonusArray'][] = $this->startThorBonus($currentStepNumber);
                    break;
                case 'Iron Man':
                    $this->slot->setReels($this->gameParams->reels[4]);
                    $this->fsBonus['bonusArray'][] = $this->startIronManBonus($currentStepNumber);
                    break;
            }

            $currentStepNumber++;
        }
        $this->fsBonus['totalWin'] = $this->fsBonus['startWin'] + $this->fsBonus['bonusWin'];
    }

    protected function showWOHReport($report, $totalWin) {
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        if($report['bonusLine']['totalMultiple'] > 0) {
            foreach($report['bonusLine']['lines'] as $line) {
                $bonus .= '<Bonus line="'.$line['lineId'].'" offsets="'.implode(',', $line['offsets']).'" prize="Avengers Assemble" length="5" payout="'.$report['betOnLine']*$line['multiple'].'" />';
            }
        }
        $bonus .= '<Feature name="Wall of Heroes" stage="1" picks="'.$this->fsBonus['detailArray'][0]['steps'].'" maxPicks="20">
                    '.$this->fsBonus['detailArray'][0]['xml'].'
                </Feature>';

        $bonusXML = '';
        foreach($this->fsBonus['bonusArray'] as $b) {
            $bonusXML .= $b;
        }

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin - $this->fsBonus['bonusWin'],
            'spins' => $this->fsBonus['spins'],
            'currentSpins' => 9,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
                </DrawState>';
        $drawStates .= $bonusXML;

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $this->fsBonus['totalWin'];
    }

    /*
     * Получаем данные следующего Stage при бонусе Wall Of Heroes
     */
    protected function getNextStep($step) {
        $needleData = $this->fsBonus['detailArray'][++$step];
        $xml = '<Feature name="Wall of Heroes" stage="'.$step.'" picks="'.$needleData['steps'].'" maxPicks="20">';
        $xml .= $needleData['xml'];
        $xml .= '</Feature>';
        return $xml;
    }

    /*
     * Бонус капитана америки
     */
    protected function startCaptainAmericaBonus($step) {
        $drawsXml = '';
        $currentSpins = ($step + 1) * 9;
        for($i = 0; $i < 9; $i++) {

            $this->fsBonus['drawID']++;
            $report = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array(2, 5),
            ));
            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $bonus = ($i == 8) ? $this->getNextStep($step) : '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $report['double'];
                $report['totalWin'] += $sr['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }

            if($i == 8) {
                $currentSpins += 9;
            }

            $winLines = $this->getWinLinesData($report, array(
                'currentSpins' => $currentSpins,
                'spins' => $this->fsBonus['spins'],
                'reelset' => 1,
                'runningTotal' => $this->fsBonus['startWin'] + $this->fsBonus['bonusWin'],
                'addString' => ' mult="'.$report['double'].'"',
                'bonus' => $bonus,
            ));

            $drawState = '<DrawState drawId="'.$this->fsBonus['drawID'].'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';

            $drawsXml .= $drawState;

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );
        }
        return $drawsXml;
    }

    /*
     * Бонус халка
     */
    protected function startHulkBonus($step) {
        $drawsXml = '';
        $currentSpins = ($step + 1) * 9;
        for($i = 0; $i < 9; $i++) {

            $this->fsBonus['drawID']++;
            $report = $this->slot->spin(array(
                'type' => 'wildReel',
                'number' => 2,
            ));
            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $bonus = ($i == 8) ? $this->getNextStep($step) : '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']];
                $report['totalWin'] += $sr['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }

            if($i == 8) {
                $currentSpins += 9;
            }

            $winLines = $this->getWinLinesData($report, array(
                'currentSpins' => $currentSpins,
                'spins' => $this->fsBonus['spins'],
                'reelset' => 4,
                'runningTotal' => $this->fsBonus['startWin'] + $this->fsBonus['bonusWin'],
                'bonus' => $bonus,
            ));

            $drawState = '<DrawState drawId="'.$this->fsBonus['drawID'].'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';

            $drawsXml .= $drawState;

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );
        }
        return $drawsXml;
    }

    /*
     * Бонус Тора
     */
    protected function startThorBonus($step) {
        $drawsXml = '';
        $currentSpins = ($step + 1) * 9;
        for($i = 0; $i < 9; $i++) {

            $this->fsBonus['drawID']++;
            $report = $this->slot->spin(array(
                'type' => 'randomWild',
                'range' => array(0, 5),
            ));
            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $offsets = implode(',', $report['bonusData']['offsets']);
            $d2 = $this->gameParams->getDisplay($report['rows']);
            $bonus = ($i == 8) ? $this->getNextStep($step) : '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']];
                $report['totalWin'] += $sr['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }

            if($i == 8) {
                $currentSpins += 9;
            }

            $winLines = $this->getWinLinesData($report, array(
                'currentSpins' => $currentSpins,
                'spins' => $this->fsBonus['spins'],
                'reelset' => 3,
                'runningTotal' => $this->fsBonus['startWin'] + $this->fsBonus['bonusWin'],
                'display' => 'startRows',
                'addString' => ' offsets="'.$offsets.'" display2="'.$d2.'"',
                'bonus' => $bonus,
            ));

            $drawState = '<DrawState drawId="'.$this->fsBonus['drawID'].'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';

            $drawsXml .= $drawState;

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );
        }
        return $drawsXml;
    }

    /*
     * Бонус Железного человека
     */
    protected function startIronManBonus($step) {
        $drawsXml = '';
        $currentSpins = ($step + 1) * 9;
        for($i = 0; $i < 9; $i++) {

            $this->fsBonus['drawID']++;
            $report = $this->slot->spin(array(
                'type' => 'multipleWithWild',
                'multiple' => ceil(($i+1)/3),
            ));
            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $offsets = implode(',', $report['bonusData']['offsets']);
            $d2 = $this->gameParams->getDisplay($report['rows']);
            $bonus = ($i == 8) ? $this->getNextStep($step) : '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $report['bonusData']['multiple'];
                $report['totalWin'] += $sr['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }

            if($i == 8) {
                $currentSpins += 9;
            }

            $winLines = $this->getWinLinesData($report, array(
                'currentSpins' => $currentSpins,
                'spins' => $this->fsBonus['spins'],
                'reelset' => 2,
                'runningTotal' => $this->fsBonus['startWin'] + $this->fsBonus['bonusWin'],
                'display' => 'startRows',
                'addString' => ' mult="'.$report['bonusData']['multiple'].'" offsets="'.$offsets.'" display2="'.$d2.'"',
                'bonus' => $bonus,
            ));

            $drawState = '<DrawState drawId="'.$this->fsBonus['drawID'].'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';

            $drawsXml .= $drawState;

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );
        }
        return $drawsXml;
    }
    // формирования описание шагов при выборе иконки в Wall Of Heroes bonus
    public function getWOHDetail($step = 0) {
        $symbols = $this->gameParams->WOHSymbols;
        //if($step > 0) array_push($symbols, $this->gameParams->WOHExit);

        if($step > 0) {
            $exitChance = $this->gameParams->WOHExitConfig['startChance'] + $this->gameParams->WOHExitConfig['stepIncrease'] * ($step - 1);
            $eRnd = rnd(1,100);
            if($exitChance > $eRnd) {
                $symbols = array($this->gameParams->WOHExit);
            }
        }
        $cnt = count($symbols) - 1;
        $symbolsCnt = array();
        $won = 'true';
        $xml = '';
        $steps = 0;
        $bonus = '';
        for($i = 1; $i <= 20; $i++) {
            $s = $symbols[rnd(0, $cnt)];
            if(empty($symbolsCnt[$s])) $symbolsCnt[$s] = 1;
            else $symbolsCnt[$s]++;
            $xml .= '<Detail order="'.$i.'" name="'.$s.'" won="'.$won.'" />';
            if($s == $this->gameParams->WOHExit && $won == 'true') {
                $steps = $i;
                $bonus = $s;
                $won = 'false';
            }
            if($symbolsCnt[$s] == 3 && $won == 'true' && $bonus !== $this->gameParams->WOHExit) {
                $steps = $i;
                $bonus = $s;
                $won = 'false';
            }

        }
        return array(
            'xml' => $xml,
            'steps' => $steps,
            'bonus' => $bonus,
        );
    }
}