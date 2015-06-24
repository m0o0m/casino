<?

class kongCtrl extends Ctrl {
    public $mode = 'JungleMode';

    protected function startInit($request) {
        $this->checkMode();

        if(empty($_SESSION['drawStates'])) {
            $draws = '<GameState mode="'.$this->mode.'" />
        <DrawState drawId="0" />';
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

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        '.$draws.'
    </EEGOpenGameResponse>
    '.$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse>
    '.$this->gameParams->getReels().'</CompositeResponse>';

        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $this->checkMode();

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

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
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
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        $bonusCount = 0;

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getBonus($report);
                $report['totalWin'] = $this->bonus['totalWin'];
                $totalWin = $this->bonus['totalWin'];
                $bonusCount++;
            }
        }
        $report['fsBonus'] = $this->slot->getSymbolAnyCount('A');
        if($report['fsBonus']['count'] >= 3) {
            $this->getFsBonus($report);
            $report['totalWin'] = $this->fsBonus['totalWin'];
            $totalWin = $this->fsBonus['totalWin'];
            $bonusCount++;
        }

        if($bonusCount > 1) $respin = true;

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'scatter':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'respin':
                    if($report['fsBonus']['count'] < 3) $respin = true;
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
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'K" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            if($this->mode == 'JungleMode') {
                $bonus .= '<Feature name="JungleBonus" payout="'.$this->bonus['bonusWin'].'">
                    <Detail eventDescs="'.$this->bonus['eventDescs'].'" type="multipick" />
                </Feature>';
            }
            else {
                $bonus .= '<Feature name="CityBonus" payout="'.$this->bonus['bonusWin'].'">
                    <Detail payDescs="'.$this->bonus['payDescs'].'" type="multipick" />
                </Feature>';
            }
        }
        $addDraws = '';
        $bonusDec = 0;
        $spinsCount = 0;
        if($report['fsBonus']['count'] >= 3) {
            if($this->mode == 'JungleMode') {
                $bonus .= '<Feature name="JungleFeature">
                    <Detail multiplier="1.0" spins="3" />
                </Feature>';
            }
            else {
                $bonus .= '<Feature name="CityFeature">
                    <Detail multiplier="1.0" spins="3" />
                </Feature>';
            }

            $addDraws = $this->fsBonus['drawStates'];
            $bonusDec = $this->fsBonus['bonusWin'];
            $spinsCount = 3;
        }

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin - $bonusDec,
            'spins' => $spinsCount,
            'currentSpins' => $spinsCount,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<GameState mode="'.$this->mode.'" /><DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>'.$addDraws;

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        if($totalWin > 0) {
            $_SESSION['bonusWIN'] = $report['totalWin'];
        }

    }

    public function getBonus($report) {
        if($this->mode == 'JungleMode') {
            $this->getSkullBonus($report);
        }
        else {
            $this->getCityBonus($report);
        }
    }

    public function getSkullBonus($report) {
        $bet = $report['bet'];
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $bonusParams = $this->gameParams->skullBonus;

        $wins = array();
        $c = 0;
        $stop = false;

        while($c < 3 && $stop == false) {
            $rnd = $this->getRandParam($bonusParams['rnd']);
            $alias = $bonusParams['alias'][$rnd];

            $wins[] = $alias;
            if($alias == 'King Kong') {
                $stop = true;
                $this->bonus['bonusWin'] = $bet * $bonusParams['multiple'][3];
            }
            $c = max(array_count_values($wins));
        }
        if(!$stop) {
            $vals = array_count_values($wins);
            foreach($vals as $key => $value) {
                if($value == 3) {
                    $this->bonus['bonusWin'] = $bet * $bonusParams['multiple'][array_search($key, $bonusParams['alias'])];
                    break;
                }
            }
        }
        $this->bonus['totalWin'] += $this->bonus['bonusWin'];

        $this->bonusPays[] = array(
            'win' => $this->bonus['bonusWin'],
            'report' => $report,
        );

        $this->bonus['eventDescs'] = implode(',', $wins);

        $_SESSION['mode'] = 'CityMode';
    }

    public function getCityBonus($report) {
        $bet = $report['bet'];
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $bonusParams = $this->gameParams->cityBonus;

        $wins = array();

        for($i = 0; $i < $bonusParams['count']; $i++) {
            $rnd = $this->getRandParam($bonusParams['rnd']);
            $win = $bet * $bonusParams['multiple'][$rnd];
            $wins[] = $win / $bet;
            $this->bonus['bonusWin'] += $win;
        }

        $this->bonus['totalWin'] += $this->bonus['bonusWin'];

        $this->bonusPays[] = array(
            'win' => $this->bonus['bonusWin'],
            'report' => $report,
        );

        $this->bonus['payDescs'] = implode(';', $wins);

        $_SESSION['mode'] = 'JungleMode';
    }

    public function getFsBonus($report) {
        if($this->mode == 'JungleMode') {
            $this->getJungleRespin($report);
        }
        else {
            $this->getKongRespin($report);
        }
    }

    public function getJungleRespin($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $wildOffsets = array();
        $this->slot->setReels($this->gameParams->reels[1]);
        $c = 3;
        while($c > 0) {
            $report = $this->slot->spin(array(
                'type' => 'wildsOnPos',
                'offsets' => $wildOffsets,
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();

            if(empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['fsBonus'] = $this->slot->getSymbolAnyCount('A');
                $wildOffsets = $report['fsBonus']['offsets'];

                $this->fsBonus['bonusWin'] += $report['totalWin'];

                $this->fsPays[] = array(
                    'win' => $report['totalWin'],
                    'report' => $report,
                );

                $display2 = $this->gameParams->getDisplay($report['rows']);
                $bonus = '<Feature name="FrozenWild" payout="'.($this->fsBonus['bonusWin'] + $startWin).'">
                    <Detail offsets="'.implode(',', $wildOffsets).'" />
                </Feature>';
                $winLines = $this->getWinLinesData($report, array(
                    'reelset' => 2,
                    'currentSpins' => 3,
                    'spins' => 3,
                    'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                    'display' => 'startRows',
                    'bonus' => $bonus,
                    'addString' => ' display2="'.$display2.'"',
                ));

                $drawState = '<DrawState drawId="'.(4-$c).'">'.$winLines.'
                    <ReplayInfo foItems="'.$report['stops'].'" />
                </DrawState>';

                $this->fsBonus['drawStates'] .= $drawState;
                $c -= 1;
            }
        }
        $this->fsBonus['totalWin'] += $this->fsBonus['bonusWin'];
    }

    public function getKongRespin($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $wildOffsets = $report['fsBonus']['offsets'];
        $this->slot->setReels($this->gameParams->reels[1]);
        $c = 3;
        while($c > 0) {
            if($c == 3) $wildReels = array(0,4);
            if($c == 2) $wildReels = array(1,3);
            if($c == 1) $wildReels = array(0,2,4);
            $report = $this->slot->spin(array(
                'type' => 'wildReels',
                'reels' => $wildReels,
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();

            if(empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                if($c == 3) $wildOffsets = '0,4,5,9,10,14';
                if($c == 2) $wildOffsets = '1,3,6,8,11,13';
                if($c == 1) $wildOffsets = '0,2,4,5,7,9,10,12,14';


                $this->fsBonus['bonusWin'] += $report['totalWin'];

                $this->fsPays[] = array(
                    'win' => $report['totalWin'],
                    'report' => $report,
                );

                $display2 = $this->gameParams->getDisplay($report['rows']);
                $bonus = '<Feature name="FrozenWild" payout="'.($this->fsBonus['bonusWin'] + $startWin).'">
                    <Detail offsets="'.$wildOffsets.'" />
                </Feature>';
                $winLines = $this->getWinLinesData($report, array(
                    'reelset' => 2,
                    'currentSpins' => 3,
                    'spins' => 3,
                    'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                    'display' => 'startRows',
                    'bonus' => $bonus,
                    'addString' => ' display2="'.$display2.'"',
                ));

                $drawState = '<DrawState drawId="'.(4-$c).'">'.$winLines.'
                    <ReplayInfo foItems="'.$report['stops'].'" />
                </DrawState>';

                $this->fsBonus['drawStates'] .= $drawState;
                $c -= 1;
            }
        }
        $this->fsBonus['totalWin'] += $this->fsBonus['bonusWin'];

    }

    public function checkMode() {
        if(!empty($_SESSION['mode'])) {
            $this->mode = $_SESSION['mode'];
        }
        else {
            $_SESSION['mode'] = $this->mode;
        }
    }

}
