<?

class goldilocksCtrl extends Ctrl {
    public $useSessionBet = true;

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
    '.$this->gameParams->getReels().$this->gameParams->getWinLines().$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse></CompositeResponse>';

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

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
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
            case 'FS':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
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

        $this->slot->drawID = -1;
        $respin = false;
        $bonusWin = 0;

        $bonus = array();

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(0,4,18,10,0),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['wildMultiple'] = $this->slot->getSymbolAnyCount('K');
        if($report['wildMultiple']['count'] > 0) {
            $report['totalWin'] *= ($report['wildMultiple']['count'] + 1);
            $report['spinWin'] *= ($report['wildMultiple']['count'] + 1);
        }


        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] == 3) {
            $report['scattersReport']['totalWin'] = $report['bet'] * 3;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];

            $this->getFreeSpinData($report);
            $bonusWin = $this->bonus['bonusWin'];
            $report['type'] = 'FS';
        }

        $totalWin = $report['totalWin'] + $bonusWin;

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';

        $wCnt = $report['wildMultiple']['count'];
        if($wCnt > 0) {
            $bonus = '<Feature><Detail name="wildmultiplier" multiplier="'.($wCnt+1).'" length="'.$wCnt.'" offsets="'.implode(',', $report['wildMultiple']['offsets']).'" /></Feature>';
        }

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'winLineMultiple' => $report['wildMultiple']['count'] + 1,
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


    protected function showFreeSpinReport($report, $totalWin) {
        $bonus = '';
        $wCnt = $report['wildMultiple']['count'];
        if($wCnt > 0) {
            $bonus = '<Feature><Detail name="wildmultiplier" multiplier="'.($wCnt+1).'" length="'.$wCnt.'" offsets="'.implode(',', $report['wildMultiple']['offsets']).'" /></Feature>';
        }
        $bonus .= '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" spins="10" prize="3S" length="3" payout="'.($report['bet'] * 3).'" />';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'spins' => $this->bonus['totalFS'],
            'currentSpins' => 10,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">'.$winLines.'
            <ReplayInfo foItems="'.$report['stops'].'" />
            <Bet seq="0" type="line" stake="'.$report['bet'].'" pick="L'.$report['linesCount'].'" payout="'.$totalWin.'" won="true"/>
        </DrawState>'.$this->bonus['drawStates'];

        $drawStates = str_replace('{{count}}', $this->bonus['totalFS'], $drawStates);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGPlaceBetsResponse newBalance="'.$balanceWithoutBet.'" freeGames="0" gameId="' . $this->gameID . '" />
    <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
</CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }


    protected function getFreeSpinData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $spins = 10;
        $totalSpins = 10;

        $draws = '';

        $this->bonus['ladder'] = array();

        $this->bonus['ladder']['ladderLevel'] = 0;
        $this->bonus['ladder']['level'] = 0;

        $this->bonus['ladder']['l1PD'] = false;
        $this->bonus['ladder']['l2PD'] = false;
        $this->bonus['ladder']['l3PD'] = false;
        $this->bonus['reelset'] = 1;

        $this->slot->setReels($this->gameParams->reels[1]);

        while($spins > 0) {
            $bonus = '';

            $this->bonus['ladder']['bonusSpins'] = 0;

            $fsReport = $this->slot->spin(array(
                'type' => 'wildsByLevel',
                'increaseSymbol' => 'S',
                'currentLevel' => $this->bonus['ladder']['ladderLevel'],
                'steps' => array(
                    '3' => array(0,1,2),
                    '8' => array(0,1,2,3),
                    '13' => array(0,1,2,3,4),
                ),
            ));

            $currentDraw = $this->slot->drawID;

            $fsReport['wildMultiple'] = $this->slot->getSymbolAnyCount('K');
            if($fsReport['wildMultiple']['count'] > 0) {
                $wCnt = $fsReport['wildMultiple']['count'];
                $fsReport['totalWin'] *= ($fsReport['wildMultiple']['count'] + 1);
                $wildDetail = '<Detail name="wildmultiplier" multiplier="'.($wCnt+1).'" length="'.$wCnt.'" offsets="'.implode(',', $fsReport['wildMultiple']['offsets']).'" />';
            }
            else {
                $wildDetail = '';
            }

            $fsReport['scattersReport'] = $this->slot->getScattersCount();

            if($fsReport['scattersReport']['count'] == 3) {
                $fsReport['scattersReport']['totalWin'] = $report['bet'] * 3;
                $fsReport['totalWin'] += $fsReport['scattersReport']['totalWin'];
                $bonus .= '<Scatter offsets="'.implode(',', $fsReport['scattersReport']['offsets']).'" prize="3S" length="3" payout="'.($report['bet'] * 3).'" />';
            }

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $this->fsPays[] = array(
                'win' => $fsReport['totalWin'],
                'report' => $fsReport,
            );

            if($fsReport['scattersReport']['count'] > 0) {
                $this->checkLadderLevel($fsReport['scattersReport']['count']);
                $spins += $this->bonus['ladder']['bonusSpins'];
                $totalSpins += $this->bonus['ladder']['bonusSpins'];
            }

            $ladderDetail = '<Detail name="ladder" value="'.$this->bonus['ladder']['ladderLevel'].'" level="'.$this->bonus['ladder']['level'].'" spins="'.$this->bonus['ladder']['bonusSpins'].'" added="'.$fsReport['scattersReport']['count'].'" offsets="'.implode(',', $fsReport['scattersReport']['offsets']).'" />';

            $bonus .= '<Feature>'.$wildDetail.$ladderDetail.'</Feature>';

            $winLines = $this->getWinLinesData($fsReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'reelset' => $this->bonus['reelset'],
                'spins' => '{{count}}',
                'currentSpins' => '{{currentSpins}}',
                'lastSpins' => $totalSpins,
                'bonus' => $bonus,
                'winLineMultiple' => $fsReport['wildMultiple']['count'] + 1,
            ));

            $draw = '<DrawState drawId="'.$currentDraw.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draw = str_replace('{{currentSpins}}', $totalSpins, $draw);

            $draws .= $draw;

            $spins--;

            if($this->bonus['ladder']['l3PD']) {
                $this->slot->setReels($this->gameParams->reels[2]);
                $this->bonus['reelset'] = 2;
            }
        }

        $this->bonus['totalFS'] = $totalSpins;
        $this->bonus['drawStates'] = $draws;
    }


    protected function checkLadderLevel($stickyCount) {
        $this->bonus['ladder']['ladderLevel'] += $stickyCount;
        $this->bonus['ladder']['bonusSpins'] = 0;
        if($this->bonus['ladder']['ladderLevel'] > 12 && !$this->bonus['ladder']['l3PD']) {
            $this->bonus['ladder']['level'] = 3;
            $this->bonus['ladder']['bonusSpins'] += 2;
            $this->bonus['ladder']['l3PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 7 && !$this->bonus['ladder']['l2PD']) {
            $this->bonus['ladder']['level'] = 2;
            $this->bonus['ladder']['bonusSpins'] += 2;
            $this->bonus['ladder']['l2PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 2 && !$this->bonus['ladder']['l1PD']) {
            $this->bonus['ladder']['level'] = 1;
            $this->bonus['ladder']['l1PD'] = true;
        }
    }

}