<?

class x_menCtrl extends Ctrl {
    private $hero = array();

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

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'HERO':
                $this->showHeroReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    /*
     * Получаем данные спина и сумарный выигрыш
     */
    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getHeroData($report);
                $report['totalWin'] = $this->hero['totalWin'];
                $report['type'] = 'HERO';
            }
        }

        if($this->checkXBonus()) {
            $bonusWin = $report['bet'] * $this->gameParams->xBonus['multiplier'];
            $report['totalWin'] += $bonusWin;
            $report['xBonus'] = true;
            $report['xBonusWin'] = $bonusWin;
        }
        else {
            $report['xBonus'] = false;
        }

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'xbonus':
                    if(!$report['xBonus']) $respin = true;
                    break;
            }
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        if($report['xBonus']) {
            $bonus = '<Bonus offsets="1,3,7,11,13" prize="5X" length="5" payout="'.$report['xBonusWin'].'" />';
        }
        else {
            $bonus = '';
        }
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                <DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);
    }
    private function checkXBonus() {
        $currentX = array();
        $currentX[] = $this->slot->getReelSymbol(1, 0);
        $currentX[] = $this->slot->getReelSymbol(3, 0);
        $currentX[] = $this->slot->getReelSymbol(2, 1);
        $currentX[] = $this->slot->getReelSymbol(1, 2);
        $currentX[] = $this->slot->getReelSymbol(3, 2);
        $f = true;
        foreach($currentX as $symbolID) {
            if(!in_array($symbolID, $this->gameParams->xBonus['symbols'])) $f = false;
        }
        return $f;
    }

    private function getHeroData($report) {
        $this->hero = array();
        $this->hero['drawStates'] = '';
        $villainsCount = 8;
        $mode = 'hero';
        $startWin = $report['totalWin'];
        $this->hero['bonusWin'] = 0;
        $drawStateID = 1;

        while($villainsCount > 0) {
            if($mode === 'hero') {
                $this->slot->setReels($this->gameParams->reels[1]);
                $this->slot->setWilds($this->gameParams->heroWilds);
                $report = $this->slot->spin();

                $this->hero['bonusWin'] += $report['totalWin'];
                // check mode change
                $centerReel = $this->slot->getReelSymbols(2);
                if(in_array(2, $centerReel)) {
                    $offset = 2;
                    if($centerReel[1] == 2) $offset = 7;
                    if($centerReel[2] == 2) $offset = 12;
                    $changer = 'offsets="'.$offset.'"';
                    $mode = 'villains';
                }
                else {
                    $changer = '';
                }

                $winLines = $this->getWinLinesData($report, array(
                    'bonus' => '<Feature name="FreeSpin">
                    <Detail name="Detail" spins="Unlimited" mode="HEROES" '.$changer.' />
                </Feature>',
                    'reelset' => 1,
                    'runningTotal' => $this->hero['bonusWin'] + $startWin,
                    'currentSpins' => ($drawStateID + 1),
                    'spins' => '{{count}}',
                ));
                $this->hero['drawStates'] .= '<DrawState drawId="'.$drawStateID.'">'.$winLines.'
            <ReplayInfo foItems="'.$report['stops'].'" />
        </DrawState>';

            }
            else {
                $villainsCount -= 1;
                $this->slot->setReels($this->gameParams->reels[2]);
                $this->slot->setWilds($this->gameParams->villainsWilds);

                $report = $this->slot->spin();
                $this->hero['bonusWin'] += $report['totalWin'];

                $centerReel = $this->slot->getReelSymbols(2);
                if(in_array(1, $centerReel)) {
                    $offset = 2;
                    if($centerReel[1] == 1) $offset = 7;
                    if($centerReel[2] == 1) $offset = 12;
                    $changer = 'offsets="'.$offset.'"';
                    $mode = 'hero';
                }
                else {
                    $changer = '';
                }

                $winLines = $this->getWinLinesData($report, array(
                    'bonus' => '<Feature name="FreeSpin"><Detail name="Detail" spins="'.$villainsCount.'" mode="VILLAINS" '.$changer.' /></Feature>',
                    'reelset' => 2,
                    'runningTotal' => $this->hero['bonusWin'] + $startWin,
                    'currentSpins' => ($drawStateID + 1),
                    'spins' => '{{count}}',
                ));

                $this->hero['drawStates'] .= '<DrawState drawId="'.$drawStateID.'">'.$winLines.'
            <ReplayInfo foItems="'.$report['stops'].'" />
        </DrawState>';
            }
            $drawStateID++;
        }
        $this->hero['drawStates'] = str_replace('{{count}}', ($drawStateID-1), $this->hero['drawStates']);
        $this->hero['drawStatesCount'] = $drawStateID - 1;

        $this->hero['totalWin'] = $startWin + $this->hero['bonusWin'];
    }
    public function showHeroReport($report, $totalWin) {
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'L" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        $bonus .= '<Feature name="FreeSpin"><Detail name="Detail" spins="Unlimited" mode="HEROES" /></Feature>';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $totalWin - $this->hero['bonusWin'],
            'currentSpins' => 1,
            'bonus' => $bonus,
            'spins' => $this->hero['drawStatesCount'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">
            '.$winLines.'
            <ReplayInfo foItems="11,33,28,16,16" />
            <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
        </DrawState>
        '.$this->hero['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGPlaceBetsResponse newBalance="'.$balanceWithoutBet.'" gameId="'.$this->gameID.'" />
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">
        '.$drawStates.'
    </EEGLoadResultsResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;
        $_SESSION['savedState'] = array();
    }

}
