<?

class sopranosCtrl extends Ctrl {

    protected function startInit($request) {
        if(empty($_SESSION['drawStates'])) {
            $draws = '<DrawState type="BASE" drawId="0" />';
        }
        else {
            $gDraw = '';
            try {
                $gDraw = gzuncompress(base64_decode($_SESSION['drawStates']));
            }
            catch (Exception $e) {
                //print_r($e);
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
        if(!empty($_SESSION['bonus'])) {
            if($_SESSION['bonus'] == 'stolen') {
                if(!empty($_SESSION['picks'])) {
                    $draws .= '<DrawState drawId="1" type="BONUS" name="StolenGoods">
            <Detail picks="'.implode(',', $_SESSION['picks']).'" wins="'.implode(',', $_SESSION['prizes']).'" />
            <ReplayInfo foItems="2" />
        </DrawState>';
                }

            }

        }
        $lastBet = (empty($_SESSION['lastBet'])) ? '' : $_SESSION['lastBet'];
        $lastPick = (empty($_SESSION['lastPick'])) ? '' : 'L'.$_SESSION['lastPick'];
        $lastStops = (empty($_SESSION['lastStops'])) ? '14,41,26,19,34' : $_SESSION['lastStops'];
        if(empty($_SESSION['fsLevel'])) $_SESSION['fsLevel'] = 0;
        $level = floor($_SESSION['fsLevel'] / 3);
        $bars = $_SESSION['fsLevel'] % 3;

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        <FGLevel currentLevel="'.$level.'" prBars="'.$bars.'" />
        <LastGameInfo pick="'.$lastPick.'" stake="'.$lastBet.'" stops="'.$lastStops.'" />
        '.$draws.'
    </EEGOpenGameResponse>
    '.$this->getStakeParams().$this->gameParams->getWinLines().$this->gameParams->getReels().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse></CompositeResponse>';

        $this->outXML($xml);
    }

    public function startAction($request) {
        switch($_SESSION['bonus']) {
            case 'raid':
                $this->showRaidCash($request);
                break;
            case 'stolen':
                $this->showStolenResult($request);
                break;
            case 'freespin':
                if(empty($_SESSION['fsStarted'])) {
                    $_SESSION['fsStarted'] = true;
                    $this->startFS($request);
                    $_SESSION['bonus'] = 'freespin';
                }
                break;
        }
    }

    public function startFS($request) {
        $attr = (array) $request->Action;
        $pick = $attr['@attributes']['pick'];

        $level = floor($_SESSION['fsLevel'] / 3);

        if($level >= $pick) {

            switch ($pick) {
                case 0:
                    $this->startSoldierFS();
                    break;
                case 1:
                    $this->startCapoFS();
                    break;
                case 2:
                    $this->startBossFS();
                    break;
                case 3:
                    $this->startFamilyFS();
                    break;
            }
        }
    }

    public function showStolenResult($request) {
        $_SESSION['stolenCount']++;
        if($_SESSION['stolenCount'] > 3) {
            game_ctrl(0, 0, 0, 'bonus');
            return;
        }
        $prizes = $this->getStolenPrizesByBet($_SESSION['lastBet']);
        $attr = (array) $request->Action;
        $pick = str_split($attr['@attributes']['pick']);
        $rt = '';
        $bp = '';
        if($pick[0] == 'k') {
            $lastWin = end($_SESSION['prizes']);
            $rt = ' runningTotal="'.$lastWin.'"';
            $bp = ' bonusPayout="'.$lastWin.'"';
            $wins = implode(',', $_SESSION['prizes']);
            $picks = implode(',', $_SESSION['picks']);
            $this->endStolenGoods($lastWin);

        }
        else {
            $_SESSION['picks'][] = $pick[0];
            $win = $prizes[rnd(0, count($prizes) - 1)];
            while(in_array($win, $_SESSION['prizes'])) {
                $win = $prizes[rnd(0, count($prizes) - 1)];
            }
            $_SESSION['prizes'][] = $win;
            $wins = implode(',', $_SESSION['prizes']);
            $picks = implode(',', $_SESSION['picks']);

            if($_SESSION['stolenCount'] == 3) {
                $totalWin = $win;
                $rt = ' runningTotal="'.$totalWin.'"';
                $bp = ' bonusPayout="'.$totalWin.'"';

                $this->endStolenGoods($win);
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">
        <DrawState drawId="1" type="BONUS" name="StolenGoods"'.$rt.'>
            <Detail picks="'.$picks.'" wins="'.$wins.'"'.$bp.' />
            <ReplayInfo foItems="1" />
        </DrawState>
    </EEGActionResponse>
</CompositeResponse>';

        $this->outXML($xml);
    }

    protected function clearSession() {
        unset($_SESSION['drawStates']);
        unset($_SESSION['savedState']);
        unset($_SESSION['bonusWIN']);
        unset($_SESSION['bonus']);
        unset($_SESSION['prizes']);
        unset($_SESSION['picks']);
        unset($_SESSION['pick']);
        unset($_SESSION['stolenCount']);
        unset($_SESSION['badabing']);
        unset($_SESSION['fsStarted']);
        unset($_SESSION['f18']);
        unset($_SESSION['f19']);
        unset($_SESSION['baseWin']);
    }

    protected function afterSaveState($attrs) {
        if(!empty($_SESSION['bonus'])) {
            if($_SESSION['bonus'] == 'badabing') {
                if(!empty($attrs['attr4'])) $_SESSION['badabing']['attrs'] = $attrs['attr4'];
                if(!empty($attrs['attr18'])) $_SESSION['badabing']['pick'] = $attrs['attr18'];
                if(!empty($_SESSION['badabing']['attrs'])) $a = 'attr4="'.$_SESSION['badabing']['attrs'].'"';
                else $a = '';
                $_SESSION['savedState'][0] = '<SavedState seq="0" '.$a.' attr18="'.$_SESSION['badabing']['pick'].'" />';
            }
            if($_SESSION['bonus'] == 'stolen') {
                $a = '';
                if(!empty($attrs['attr18'])) {
                    $a = 'attr18="'.$attrs['attr18'].'"';
                    $_SESSION['pick'] = $attrs['attr18'];
                }
                else {
                    if(!empty($_SESSION['pick'])) {
                        $a = 'attr18="'.$_SESSION['pick'].'"';
                    }
                }
                $_SESSION['savedState'][0] = '<SavedState seq="0" attr14="1,2,3" '.$a.' />';
            }
            if($_SESSION['bonus'] == 'freespin') {
                $a18 = '';
                if(!empty($attrs['attr18'])) {
                    $a18 = 'attr18="'.$attrs['attr18'].'"';
                    $_SESSION['f18'] = $attrs['attr18'];
                }
                else {
                    if(!empty($_SESSION['f18'])) {
                        $a18 = 'attr18="'.$_SESSION['f18'].'"';
                    }
                }

                $a19 = '';
                if(!empty($attrs['attr19'])) {
                    $a19 = 'attr19="'.$attrs['attr19'].'"';
                    $_SESSION['f19'] = $attrs['attr19'];
                }
                else {
                    if(!empty($_SESSION['f19'])) {
                        $a19 = 'attr19="'.$_SESSION['f19'].'"';
                    }
                }
                $_SESSION['savedState'][0] = '<SavedState seq="0" '.$a18.' '.$a19.'  />';
            }
        }

    }

    public function endStolenGoods($win) {
        $this->bonusPays[] = $win;
        $this->startPay();
    }



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
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = $spinData['report']['spinWin'];

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'BADABING':
                $this->showBadaBingReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'RAID':
                $this->showRaidReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'STOLEN':
                $this->showStolenReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREESPIN':
                $this->showFsReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;
        $bonusCount = 0;
        $report = $this->slot->spin();

        $report['type'] = 'SPIN';

        $report['badaBing'] = $this->slot->getSymbolAnyCount($this->gameParams->badaBingConfig['symbol']);
        if($report['badaBing']['count'] == 3) {
            $this->getBadaBingBonus($report);
            $report['totalWin'] = $this->bonus['totalWin'];
            $report['type'] = 'BADABING';
            $bonusCount++;
        }
        $this->bonus['stolen'] = $this->slot->getSymbolAnyCount($this->gameParams->stolenGoodsParams['symbol']);
        if($this->bonus['stolen']['count'] == 2) {
            $report['type'] = 'STOLEN';
            $bonusCount++;
        }
        $report['scattersReport'] = $this->slot->getScattersCount();
        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['type'] = 'FREESPIN';
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            $bonusCount++;
        }

        if($bonusCount == 0) {
            if(rnd(1, $this->gameParams->randBonusChance) == 1) {
                $report['type'] = 'RAID';
                $bonusCount++;
            }
        }

        if($bonusCount > 1) $respin = true;

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'badabing':
                    if($report['badaBing']['count'] < 3) $respin = true;
                    break;
                case 'stolen':
                    if($this->bonus['stolen']['count'] < 2) $respin = true;
                    break;
                case 'raid':
                    if($report['type'] != 'RAID') $respin = true;
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
        $winLines = $this->getWinLinesData($report);

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? true : false;

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

    public function showBadaBingReport($report, $totalWin) {
        $bonus = '<Bonus offsets="'.implode(',', $report['badaBing']['offsets']).'" prize="3I" featureId="0" payout="'.$this->bonus['bonusWin'].'" />';
        $trigger = '<TriggeringData><Feature id="0" type="BONUS" name="BadaBing">
                    <Detail wins="'.implode(',', $this->bonus['wins']).'" bonusPayout="'.$this->bonus['bonusWin'].'" picks="'.$this->bonus['picks'].'" />
                </Feature></TriggeringData>';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'trigger' => $trigger,
            'drawWin' => $totalWin - $this->bonus['bonusWin'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawState = '<DrawState drawId="0" state="settling" type="BASE" wCapMaxWin="75000.0">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawState.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['bonus'] = 'badabing';
        $_SESSION['drawStates'] = base64_encode(gzcompress($drawState, 9));
        $_SESSION['bonusWIN'] = $totalWin;
    }

    public function showRaidReport($report, $totalWin) {
        $cash = $report['bet'] * 2;
        $trigger = '<TriggeringData>
                <Feature id="0" type="BONUS" name="Raid" cash="'.$cash.'" />
            </TriggeringData>';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $totalWin,
            'trigger' => $trigger,
            'drawWin' => $totalWin,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? true : false;

        $drawState = '<DrawState drawId="0" state="settling" type="BASE" wCapMaxWin="75000.0">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawState.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawState, 9));
        $_SESSION['bonus'] = 'raid';
        $_SESSION['bonusWIN'] = $report['totalWin'];
    }

    public function showRaidCash($request) {
        // чистим сессию от восстановления игры
        unset($_SESSION['drawStates']);
        unset($_SESSION['bonus']);


        $attr = (array) $request->Action;
        $pick = str_split($attr['@attributes']['pick']);
        $bet = $_SESSION['lastBet'];
        $r1 = rnd(0,3);
        $r2 = $r1;
        while($r1 == $r2) {
            $r2 = rnd(0,3);
        }
        $wins = 0;
        for($i = 0; $i <= 3; $i++) {
            if($pick[$i] == $r1 || $pick[$i] == $r2) {

            }
            else {
                $wins++;
            }
        }

        $bonusWin = $wins * $bet * 2;
        $totalWin = $bonusWin;
        unset($_SESSION['bonusWin']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">
        <DrawState drawId="1" type="BONUS" name="Raid" runningTotal="'.$totalWin.'">
            <Detail selected="'.implode('', $pick).'" taken="'.$r1.','.$r2.'" bonusPayout="'.$bonusWin.'" cash="'.($bet*2).'" />
            <ReplayInfo foItems="'.$r1.','.$r2.'" />
        </DrawState>
    </EEGActionResponse>
</CompositeResponse>';

        $this->bonusPays[] = $totalWin;

        $this->startPay();

        $this->outXML($xml);


    }

    public function getBadaBingBonus($report) {
        $this->bonus = array();

        $startWin = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;
        $config = $this->gameParams->badaBingConfig;
        $c = rnd($config['minCount'], $config['maxCount']);
        $this->bonus['picks'] = $c;
        $this->bonus['wins'] = array();
        for($i = 0; $i < $c; $i++) {
            $win = $config['multiplier'][rnd(0, count($config['multiplier']) - 1)];
            $this->bonus['wins'][] = $win;
            $this->bonus['bonusWin'] += $report['bet'] * $win;
        }
        $this->bonus['totalWin'] = $startWin + $this->bonus['bonusWin'];
        $this->bonusPays[] = $this->bonus['bonusWin'];
    }

    public function showStolenReport($report, $totalWin) {
        $bonus = '<Bonus offsets="'.implode(',', $this->bonus['stolen']['offsets']).'" prize="2O" featureId="0" />';
        $trigger = '<TriggeringData>
                <Feature id="0" type="BONUS" name="StolenGoods" prizes="'.implode(',', $this->getStolenPrizesByBet($report['bet'])).'" />
            </TriggeringData>';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'trigger' => $trigger,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? true : false;

        $drawState = '<DrawState drawId="0" state="settling" type="BASE" wCapMaxWin="75000.0">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawState.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawState, 9));
        $_SESSION['bonus'] = 'stolen';
        $_SESSION['bonusWIN'] = $report['totalWin'];
        $_SESSION['stolenCount'] = 0;
        $_SESSION['picks'] = array();
        $_SESSION['prizes'] = array();
    }

    private function getStolenPrizesByBet($bet) {
        $prizes = array();
        foreach($this->gameParams->stolenGoodsParams['multiplier'] as $m) {
            $prizes[] = $m * $bet;
        }
        return $prizes;
    }

    public function showFsReport($report, $totalWin) {
        $inc = ($report['scattersReport']['count'] < 4) ? 1 : 2;
        $_SESSION['fsLevel'] += $inc;

        $level = floor($_SESSION['fsLevel'] / 3);
        $bars = $_SESSION['fsLevel'] % 3;

        $bonus = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="'.$report['scattersReport']['count'].'S" length="'.$report['scattersReport']['count'].'" payout="'.$report['scattersReport']['totalWin'].'" spins="0" />';
        $trigger = '<TriggeringData>
                <Feature id="0" type="FREE_SPINS" />
            </TriggeringData>
            <SpecificData>
                <FGLevel currentLevel="'.$level.'" prBars="'.$bars.'" />
            </SpecificData>';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'trigger' => $trigger,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? true : false;

        $drawState = '<DrawState drawId="0" state="settling" type="BASE" wCapMaxWin="75000.0">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawState.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['bonus'] = 'freespin';
        $_SESSION['drawStates'] = base64_encode(gzcompress($drawState, 9));
        $_SESSION['baseWin'] = $totalWin;
        $_SESSION['bonusWIN'] = $totalWin;
    }

    public function startSoldierFS() {
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $this->slot = new Slot($this->gameParams, $lastPick, $bet);
        $this->slot->setWilds($this->gameParams->soldierWild);
        $this->slot->setReels($this->gameParams->reels[1]);

        $spinData = $this->getSoldierData();
        $totalWin = $spinData['totalWin'];

        while(!game_ctrl($bet * 100, $totalWin * 100)) {
            $spinData = $this->getSoldierData();
            $totalWin = $spinData['totalWin'];
        }

        $drawStates = $spinData['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">';
        $xml .= $drawStates;
        $xml .= '</EEGActionResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $this->startPay();
    }
    private function getSoldierData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $fsCount = 25;
        $fsTotal = 25;
        $bet = $_SESSION['lastBet'];

        $drawStates = '';
        $totalWin = 0;

        $level = floor($_SESSION['fsLevel'] / 3);
        $bars = $_SESSION['fsLevel'] % 3;

        $i = 0;
        while($fsCount > 0) {
            $report = $this->slot->spin();

            if($this->slot->chechSymbolOnReel('C', 2, 1)) {
                $fsCount += 5;
                $fsTotal += 5;
                $bonus = '<Bonus offsets="7" prize="1C" featureId="0" />';
                $trigger = '<TriggeringData>
                <Feature id="0" type="FREE_SPINS" spins="5" />
            </TriggeringData>';
            }
            else {
                $bonus = '';
                $trigger = '';
            }

            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $bet * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="'.$report['scattersReport']['count'].'S" length="'.$report['scattersReport']['count'].'" payout="'.$report['scattersReport']['totalWin'].'" spins="0" />';
            }

            $totalWin += $report['totalWin'];

            $this->fsPays[] = $report['totalWin'];



            if($i == 0) {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'" baseWin="'.$_SESSION['baseWin'].'"';
            }
            else {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'"';
            }
            $winLines = $this->getWinLinesData($report, array(
                'spins' => $fsTotal,
                'currentSpins' => $fsTotal,
                'lastSpins' => $fsTotal,
                'reelset' => 1,
                'runningTotal' => $totalWin + $_SESSION['baseWin'],
                'addString' => $addString,
                'bonus' => $bonus,
                'trigger' => $trigger,
            ));

            $drawStates .= '<DrawState drawId="'.($i+1).'" type="FREE_SPINS">'.$winLines.'
            <SpecificData>
                <ExtraWilds offsets="2" />
            </SpecificData>
            <ReplayInfo foItems="6,57,6,30,11" />
        </DrawState>';
            $fsCount--;
            $i++;
        }

        $_SESSION['drawStates'] = gzuncompress(base64_decode($_SESSION['drawStates']));

        $_SESSION['drawStates'] .= $drawStates;
        $_SESSION['bonusWIN'] = $totalWin + $_SESSION['baseWin'];
        $_SESSION['drawStates'] = base64_encode(gzcompress($_SESSION['drawStates'], 9));
        return array(
            'totalWin' => $totalWin,
            'drawStates' => $drawStates,
        );

    }


    public function startCapoFS() {
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $this->slot = new Slot($this->gameParams, $lastPick, $bet);
        $this->slot->setReels($this->gameParams->reels[2]);

        $spinData = $this->getCapoData();
        $totalWin = $spinData['totalWin'];

        while(!game_ctrl($bet * 100, $totalWin * 100)) {
            $spinData = $this->getCapoData();
            $totalWin = $spinData['totalWin'];
        }

        $drawStates = $spinData['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">';
        $xml .= $drawStates;
        $xml .= '</EEGActionResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $this->startPay();
    }
    private function getCapoData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $fsCount = 20;
        $bet = $_SESSION['lastBet'];

        $drawStates = '';
        $totalWin = 0;

        $level = floor($_SESSION['fsLevel'] / 3);

        $i = 0;
        $multInc = 0;
        $startMult = rnd(2, 5);
        $baseWin = $_SESSION['baseWin'];
        while($fsCount > 0) {
            $startMult += $multInc;
            if($startMult < 2) $startMult = 2;
            if($startMult > 5) $startMult = 5;
            $report = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array($startMult, $startMult),
            ));


            $c = $this->slot->getSymbolAnyCount('P');
            if($c['count'] > 0) {
                $multInc = 1;
            }
            else {
                $multInc = -1;
            }
            $bonus = '';
            $trigger = '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $bet * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="'.$report['scattersReport']['count'].'S" length="'.$report['scattersReport']['count'].'" payout="'.$report['scattersReport']['totalWin'].'" spins="0" />';
            }

            $totalWin += $report['totalWin'];
            $this->fsPays[] = $report['totalWin'];

            if($i == 0) {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'" baseWin="'.$_SESSION['baseWin'].'" multiplier="'.$report['double'].'"';
            }
            else {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'" multiplier="'.$report['double'].'"';
            }
            $winLines = $this->getWinLinesData($report, array(
                'spins' => 20,
                'currentSpins' => 20,
                'lastSpins' => 20,
                'reelset' => 2,
                'runningTotal' => $totalWin + $baseWin,
                'addString' => $addString,
                'bonus' => $bonus,
                'trigger' => $trigger,
            ));

            $drawStates .= '<DrawState drawId="'.($i+1).'" type="FREE_SPINS">'.$winLines.'
            <ReplayInfo foItems="6,57,6,30,11" />
        </DrawState>';
            $fsCount--;
            $i++;
        }

        $_SESSION['drawStates'] = gzuncompress(base64_decode($_SESSION['drawStates']));

        $_SESSION['drawStates'] .= $drawStates;
        $_SESSION['bonusWIN'] = $totalWin + $_SESSION['baseWin'];
        $_SESSION['drawStates'] = base64_encode(gzcompress($_SESSION['drawStates'], 9));
        return array(
            'totalWin' => $totalWin,
            'drawStates' => $drawStates,
        );
    }



    public function startBossFS() {
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $this->slot = new Slot($this->gameParams, $lastPick, $bet);
        $this->slot->setWilds($this->gameParams->soldierWild);
        $this->slot->setReels($this->gameParams->reels[3]);

        $spinData = $this->getBossData();
        $totalWin = $spinData['totalWin'];

        while(!game_ctrl($bet * 100, $totalWin * 100)) {
            $spinData = $this->getBossData();
            $totalWin = $spinData['totalWin'];
        }

        $drawStates = $spinData['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">';
        $xml .= $drawStates;
        $xml .= '</EEGActionResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $this->startPay();
    }
    private function getBossData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $fsCount = 10;
        $fsTotal = 10;
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $drawStates = '';
        $totalWin = 0;

        $level = floor($_SESSION['fsLevel'] / 3);

        $i = 0;
        while($fsCount > 0) {
            $report = $this->slot->spin(array(
                'type' => 'randomWild',
                'range' => array(2, 5),
                'not' => 7,
            ));


            $wildOffsets = implode(',', $report['bonusData']['offsets']);

            if($this->slot->chechSymbolOnReel('Z', 2, 1)) {
                $fsCount += 5;
                $fsTotal += 5;
                $bonus = '<Bonus offsets="7" prize="1Z" featureId="0" />';
                $trigger = '<TriggeringData>
                <Feature id="0" type="FREE_SPINS" spins="5" />
            </TriggeringData>';
            }
            else {
                $bonus = '';
                $trigger = '';
            }

            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $bet * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="'.$report['scattersReport']['count'].'S" length="'.$report['scattersReport']['count'].'" payout="'.$report['scattersReport']['totalWin'].'" spins="0" />';
            }

            $totalWin += $report['totalWin'];
            $this->fsPays[] = $report['totalWin'];

            if($i == 0) {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'" baseWin="'.$_SESSION['baseWin'].'"';
            }
            else {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'"';
            }
            $winLines = $this->getWinLinesData($report, array(
                'spins' => $fsTotal,
                'currentSpins' => $fsTotal,
                'lastSpins' => $fsTotal,
                'reelset' => 3,
                'runningTotal' => $totalWin + $_SESSION['baseWin'],
                'addString' => $addString,
                'bonus' => $bonus,
                'trigger' => $trigger,
            ));

            $drawStates .= '<DrawState drawId="'.($i+1).'" type="FREE_SPINS">'.$winLines.'
            <SpecificData>
                <RandomWilds offsets="'.$wildOffsets.'" />
            </SpecificData>
            <ReplayInfo foItems="6,57,6,30,11" />
        </DrawState>';
            $fsCount--;
            $i++;
        }

        $_SESSION['drawStates'] = gzuncompress(base64_decode($_SESSION['drawStates']));

        $_SESSION['drawStates'] .= $drawStates;
        $_SESSION['bonusWIN'] = $totalWin + $_SESSION['baseWin'];
        $_SESSION['drawStates'] = base64_encode(gzcompress($_SESSION['drawStates'], 9));
        return array(
            'totalWin' => $totalWin,
            'drawStates' => $drawStates,
        );
    }



    public function startFamilyFS() {
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $this->gameParams->doubleIfWild = true;
        $this->slot = new Slot($this->gameParams, $lastPick, $bet);
        $this->slot->setReels($this->gameParams->reels[4]);

        $spinData = $this->getFamilyData();
        $totalWin = $spinData['totalWin'];

        while(!game_ctrl($bet * 100, $totalWin * 100)) {
            $spinData = $this->getFamilyData();
            $totalWin = $spinData['totalWin'];
        }

        $drawStates = $spinData['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGActionResponse gameId="'.$this->gameID.'">';
        $xml .= $drawStates;
        $xml .= '</EEGActionResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $this->startPay();
    }
    private function getFamilyData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $fsCount = 10;
        $lastPick = $_SESSION['lastPick'];
        $bet = $_SESSION['lastBet'];

        $drawStates = '';
        $totalWin = 0;

        $level = floor($_SESSION['fsLevel'] / 3);

        $i = 0;
        $baseWin = $_SESSION['baseWin'];
        while($fsCount > 0) {
            $report = $this->slot->spin();


            $bonus = '';
            $trigger = '';

            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $bet * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="'.$report['scattersReport']['count'].'S" length="'.$report['scattersReport']['count'].'" payout="'.$report['scattersReport']['totalWin'].'" spins="0" />';
            }

            $totalWin += $report['totalWin'];
            $this->fsPays[] = $report['totalWin'];

            if($i == 0) {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'" baseWin="'.$_SESSION['baseWin'].'"';
            }
            else {
                $addString = 'freeSpinsWin="'.($totalWin - $report['totalWin']).'" level="'.$level.'"';
            }
            $winLines = $this->getWinLinesData($report, array(
                'spins' => 10,
                'currentSpins' => 10,
                'lastSpins' => 10,
                'reelset' => 4,
                'runningTotal' => $totalWin + $baseWin,
                'addString' => $addString,
                'bonus' => $bonus,
                'trigger' => $trigger,
            ));

            $drawStates .= '<DrawState drawId="'.($i+1).'" type="FREE_SPINS">'.$winLines.'
            <ReplayInfo foItems="6,57,6,30,11" />
        </DrawState>';
            $fsCount--;
            $i++;
        }

        $_SESSION['drawStates'] = gzuncompress(base64_decode($_SESSION['drawStates']));

        $_SESSION['drawStates'] .= $drawStates;
        $_SESSION['bonusWIN'] = $totalWin + $_SESSION['baseWin'];
        $_SESSION['drawStates'] = base64_encode(gzcompress($_SESSION['drawStates'], 9));
        return array(
            'totalWin' => $totalWin,
            'drawStates' => $drawStates,
        );
    }







}
