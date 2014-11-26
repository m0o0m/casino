<?

class santa_surpriseCtrl extends Ctrl {
    protected $bonusGift = array();

    protected function startInit($request) {
        if(empty($_SESSION['drawStates'])) {
            $draws = '<DrawState drawId="0"/>';
        }
        else {
            if(!empty($_SESSION['savedState'])) {
                $savedState = '';
                foreach($_SESSION['savedState'] as $key=>$val) {
                    $savedState .= $val;
                }
                $draws = $savedState.$_SESSION['drawStates'];
            }
            else $draws = $_SESSION['drawStates'];
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
            case 'FREESPIN':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $bonusCount = 0;

        $report['bonusGift'] = $this->checkBonusGift();
        if($report['bonusGift']['win']) {
            $this->getBonusGift($report);
            $report['totalWin'] = $this->bonusGift['totalWin'];
            $bonusCount++;
        }

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getFreeSpinBonus($report);
                $report['totalWin'] = $this->fsBonus['totalWin'];
                $report['type'] = 'FREESPIN';
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
                case 'gift':
                    if(!$report['bonusGift']['win']) $respin = true;
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
        if($report['bonusGift']['win']) {
            $r = $report['bonusGift'];
            $winLine = '<WinLine line="'.$r['primaryLine'].'" offsets="'.implode(',', $r['lines'][0]['offsets']).'" prize="'.$r['count'].'N" length="'.$r['count'].'" payout="'.$this->bonusGift['bonusWin'].'" />';
            $bonus .= $winLine;
            $bonus .= '<Feature name="Bonus" payout="'.$this->bonusGift['bonusWin'].'">
                    <Detail payDescs="'.implode(',', $this->bonusGift['payDescs']).'" eventDescs="'.implode(',', $this->bonusGift['eventDescs']).'" type="multipick" />
                </Feature>';
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
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                '.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $this->outXML($xml);

        if($report['bonusGift']['win']) {
            $_SESSION['drawStates'] = $drawStates;
            $_SESSION['bonusWIN'] = $report['totalWin'];
        }
    }

    private function checkBonusGift() {
        $bonus = $this->slot->getFullLineBonus(5);
        if(!$bonus['win']) {
            $bonus = $this->slot->getFullLineBonus(4);
            if(!$bonus['win']) {
                $bonus = $this->slot->getFullLineBonus(3);
            }
        }
        return $bonus;
    }

    private function getBonusGift($report) {
        $this->bonusGift['totalWin'] = $report['totalWin'];
        $this->bonusGift['bonusWin'] = 0;
        $this->bonusGift['payDescs'] = array();
        $this->bonusGift['eventDescs'] = array();
        $r = $report['bonusGift'];

        $betOnLine = $report['betOnLine'];
        for($i = 1; $i <= $r['count']; $i++) {
            $multiple = $this->getRandParam($this->gameParams->giftBonus['multiple']);
            $win =$betOnLine * $multiple;
            $this->bonusGift['bonusWin'] += $win;
            $this->bonusGift['payDescs'][] = $win;
            $this->bonusGift['eventDescs'][] = $multiple;
        }
        $this->bonusGift['totalWin'] += $this->bonusGift['bonusWin'];
    }


    public function getFreeSpinBonus($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';

        $multiple = 3;
        $fsCount = 10;
        $totalFsCount = 10;

        $this->slot->setReels($this->gameParams->reels[1]);

        $fsCounter = 0;
        while($fsCount > 0) {
            $fsCounter++;
            $report = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array($multiple, $multiple),
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();
            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                if($sr['count'] >= 3) {
                    $fsCount += 10;
                    $totalFsCount += 10;
                }
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $multiple;
                $report['totalWin'] += $sr['totalWin'];
                $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }
            else {
                $bonus = '';
            }
            $report['bonusGift'] = $this->checkBonusGift();
            $r = $report['bonusGift'];
            if($r['win']) {
                $this->getBonusGift($report);
                $report['totalWin'] = $this->bonusGift['totalWin'];
                $winLine = '<WinLine line="'.$r['primaryLine'].'" offsets="'.implode(',', $r['lines'][0]['offsets']).'" prize="'.$r['count'].'N" length="'.$r['count'].'" payout="'.$this->bonusGift['bonusWin'].'" />';
                $bonus .= $winLine;
                $bonus .= '<Feature name="Bonus" payout="'.$this->bonusGift['bonusWin'].'">
                    <Detail payDescs="'.implode(',', $this->bonusGift['payDescs']).'" eventDescs="'.implode(',', $this->bonusGift['eventDescs']).'" type="multipick" />
                </Feature>';
            }

            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $winLines = $this->getWinLinesData($report, array(
                'currentSpins' => $totalFsCount,
                'spins' => $totalFsCount,
                'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                'bonus' => $bonus,
                'addString' => ' multiplier="'.$multiple.'"',
            ));

            $drawState = '<DrawState drawId="'.$fsCounter.'">'.$winLines.'<ReplayInfo foItems="'.$report['stops'].'" /></DrawState>';
            $this->fsBonus['drawStates'] .= $drawState;


            $fsCount -= 1;
        }
        $this->fsBonus['fsCount'] = $fsCounter;
        $this->fsBonus['totalWin'] += $this->fsBonus['bonusWin'];
    }

    public function showFreeSpinReport($report, $totalWin) {
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'S" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';

        $winLines = $this->getWinLinesData($report, array(
            'runningTotal' => $report['totalWin'] - $this->fsBonus['bonusWin'],
            'spins' => 10,
            'currentSpins' => 10,
            'bonus' => $bonus,
            'drawWin' => $report['totalWin'] - $this->fsBonus['bonusWin'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
            <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
        </DrawState>'.$this->fsBonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGPlaceBetsResponse newBalance="'.$balanceWithoutBet.'" gameId="'.$this->gameID.'" />
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">
    '.$drawStates.'
    </EEGLoadResultsResponse>
</CompositeResponse>';

        $this->outXML($xml);

        $_SESSION['drawStates'] = $drawStates;
        $_SESSION['bonusWIN'] = $totalWin;
        $_SESSION['bonus'] = 'freespin';
    }

}
