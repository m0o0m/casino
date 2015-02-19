<?

class rapunzel_towerCtrl extends Ctrl {
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

    protected function startStakeConfig($request) {
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
</CompositeResponse>';

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
            case 'FS':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $this->slot->drawID = -1;
        $respin = false;
        $bonusCount = 0;

        $bonus = array();
        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(0,5,15,3,0),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $bonusWin = 0;

        $report['type'] = 'SPIN';
        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $bonusCount++;
            $this->getFreeSpinData($report);
            $bonusWin = $this->bonus['bonusWin'];
            $report['type'] = 'FS';
        }


        $report['sticky'] = $this->slot->getSymbolAnyCount('T');
        if($report['sticky']['count'] > 2) {
            $bonusCount++;
            $report['bonus'] = $this->getRespinData($report, array(
                'rsName' => 'BaseRespin',
                'reel' => 1,
                'multiplier' => 1,
                'bonus' => '',
            ));
            $bonusWin += $report['bonus']['bonusWin'];
        }

        $totalWin = $report['totalWin'] + $bonusWin;

        if($bonusCount > 1) {
            $respin = true;
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';


        if($report['sticky']['count'] > 2) {
            $respin = 'true';
            $addDraws = $report['bonus']['drawStates'];
        }
        else {
            $respin = 'false';
            $addDraws = '';
        }
        $addString = ' respin="'.$respin.'" rsName="Base" multiplier="1.00"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'addString' => $addString,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>'.$addDraws;

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        if($respin == 'true') {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    protected function showFreeSpinReport($report, $totalWin) {
        $addString = ' respin="false" rsName="Base" multiplier="1.00"';
        $bonus = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" spins="10" prize="3S" length="3" payout="0.00" />';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'addString' => $addString,
            'spins' => '{{count}}',
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

    protected function getRespinData($report, $config) {
        $bonus = array();
        $bonus['totalWin'] = $report['totalWin'];

        $bonus['bonusWin'] = 0;

        $this->slot->setReels($this->gameParams->reels[$config['reel']]);

        $draws = '';

        $startOffsets = $report['sticky']['offsets'];
        $totalOffsets = $report['sticky']['offsets'];

        $totalRespin = 0;
        $drawID = (empty($config['drawID'])) ? $this->slot->drawID : $config['drawID'];
        while($bonus['bonusWin'] == 0) {
            $currentMultiple = $config['multiplier'];
            if(isset($config['fs'])) {
                if($this->bonus['ladder']['multiple'] > $currentMultiple) {
                    $currentMultiple = $this->bonus['ladder']['multiple'];
                }
            }
            
            $respinReport = $this->slot->spin(array(
                array(
                    'type' => 'wildsOnPos',
                    'offsets' => $totalOffsets,
                    'wildSymbol' => 11,
                ),
                array(
                    'type' => 'multiple',
                    'range' => array($config['multiplier'], $config['multiplier']),
                ),
            ));

            $bonus['bonusWin'] += $respinReport['totalWin'];
            $bonus['totalWin'] += $respinReport['totalWin'];

            if($respinReport['totalWin'] > 0) {
                $respin = 'false';
            }
            else {
                $respin = 'true';
            }

            $respinReport['sticky'] = $this->slot->getSymbolAnyCount('T');

            $totalOffsets = $respinReport['sticky']['offsets'];

            $addString = ' rsName="'.$config['rsName'].'" multiplier="'.$currentMultiple.'" respin="'.$respin.'"';

            $addTotal = empty($config['addTotal']) ? 0 : $config['addTotal'];

            if(isset($config['fs'])) {
                $newStickyCount = $respinReport['sticky']['count'] - count($startOffsets);
                $this->checkLadderLevel($newStickyCount);
                $startOffsets = $respinReport['sticky']['offsets'];

                $config['bonus'] = '<Feature name="ladder" value="'.$this->bonus['ladder']['ladderLevel'].'" level="'.$this->bonus['ladder']['level'].'" spins="'.$this->bonus['ladder']['bonusSpins'].'" />';
                $config['multiplier'] = $this->bonus['ladder']['multiple'];
            }

            $spins = empty($config['spins']) ? $drawID : $config['spins'];
            $currentSpins = empty($config['currentSpins']) ? $drawID : $config['currentSpins'];


            $winLines = $this->getWinLinesData($respinReport, array(
                'runningTotal' => $addTotal + $bonus['totalWin'],
                'addString' => $addString,
                'reelset' => $config['reel'],
                'spins' => $spins,
                'currentSpins' => $currentSpins,
                'bonus' => $config['bonus'],
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="' . $respinReport['stops'] . '" /></DrawState>';

            $draws .= $draw;

            $drawID++;
            $totalRespin++;
        }

        $bonus['drawStates'] = $draws;
        $bonus['totalRespin'] = $totalRespin;
        $bonus['offsets'] = $totalOffsets;

        return $bonus;
    }

    protected function getFreeSpinData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;

        $spins = 10;
        $totalSpins = 10;

        $draws = '';

        $this->bonus['ladder'] = array();

        $this->bonus['ladder']['multiple'] = 1;
        $this->bonus['ladder']['ladderLevel'] = 0;
        $this->bonus['ladder']['level'] = 0;

        $this->bonus['ladder']['l1PD'] = false;
        $this->bonus['ladder']['l2PD'] = false;
        $this->bonus['ladder']['l3PD'] = false;
        $this->bonus['ladder']['l4PD'] = false;

        $this->bonus['YES'] = false;

        while($spins > 0) {
            $up = false;
            $bonus = '';
            $respinWin = 0;
            $this->bonus['ladder']['bonusSpins'] = 0;

            $this->slot->setReels($this->gameParams->reels[2]);

            $fsReport = $this->slot->spin(array(
                'type' => 'multiple',
                'range' => array($this->bonus['ladder']['multiple'], $this->bonus['ladder']['multiple']),
            ));

            $currentDraw = $this->slot->drawID;

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $fsReport['scattersReport'] = $this->slot->getScattersCount();
            if($fsReport['scattersReport']['count'] == 3) {
                $bonus .= '<Scatter offsets="'.implode(',', $fsReport['scattersReport']['offsets']).'" spins="10" prize="3S" length="3" payout="0.00" />';
                $spins += 10;
                $totalSpins += 10;
            }

            $fsReport['sticky'] = $this->slot->getSymbolAnyCount('T');
            if($fsReport['sticky']['count'] > 0) {
                $this->checkLadderLevel($fsReport['sticky']['count']);
                $spins += $this->bonus['ladder']['bonusSpins'];
                $totalSpins += $this->bonus['ladder']['bonusSpins'];
                if($this->bonus['ladder']['bonusSpins'] > 0) {
                    $up = true;
                }
            }


            $bonus .= '<Feature name="ladder" value="'.$this->bonus['ladder']['ladderLevel'].'" level="'.$this->bonus['ladder']['level'].'" spins="'.$this->bonus['ladder']['bonusSpins'].'" />';


            $addDraws = '';
            if($fsReport['sticky']['count'] > 2) {
                $respin = 'true';
            }
            else {
                $respin = 'false';
            }
            $addString = ' respin="'.$respin.'" rsName="FreeSpin" multiplier="'.$this->bonus['ladder']['multiple'].'"';



            $winLines = $this->getWinLinesData($fsReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'addString' => $addString,
                'reelset' => 2,
                'spins' => '{{count}}',
                'currentSpins' => '{{currentSpins}}',
                'lastSpins' => $totalSpins,
                'bonus' => $bonus,
            ));
            if($fsReport['sticky']['count'] > 2) {
                $fsReport['bonus'] = $this->getRespinData($fsReport, array(
                    'rsName' => 'FSRespin',
                    'reel' => 3,
                    'multiplier' => $this->bonus['ladder']['multiple'],
                    'fs' => true,
                    'drawID' => $totalSpins,
                    'spins' => '{{count}}',
                    'currentSpins' => '{{currentPlus}}',
                    'addTotal' => $this->bonus['totalWin'] - $fsReport['totalWin'],
                ));
                $respinWin = $fsReport['bonus']['bonusWin'];
                $addDraws = $fsReport['bonus']['drawStates'];
                $totalSpins += $fsReport['bonus']['totalRespin'];
            }

            if(!$up) {
                $spins += $this->bonus['ladder']['bonusSpins'];
                $totalSpins += $this->bonus['ladder']['bonusSpins'];
            }

            if($fsReport['sticky']['count'] > 2) {
                if($spins == 1) {
                    $this->bonus['YES'] = true;
                }
            }


            $draw = '<DrawState drawId="'.$currentDraw.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>'.$addDraws;

            $draw = str_replace('{{currentSpins}}', $totalSpins, $draw);
            if(!$this->bonus['YES']) {
                $draw = str_replace('{{currentPlus}}', $totalSpins + 1, $draw);
            }
            else {
                $draw = str_replace('{{currentPlus}}', $totalSpins, $draw);
            }


            $draws .= $draw;



            $this->bonus['bonusWin'] += $respinWin;
            $this->bonus['totalWin'] += $respinWin;
            $spins--;
        }

        $this->bonus['totalFS'] = $totalSpins;
        $this->bonus['drawStates'] = $draws;
    }

    protected function checkLadderLevel($stickyCount) {
        $this->bonus['ladder']['ladderLevel'] += $stickyCount;
        if($this->bonus['ladder']['ladderLevel'] > 24 && !$this->bonus['ladder']['l4PD']) {
            $this->bonus['ladder']['level'] = 4;
            $this->bonus['ladder']['bonusSpins'] = 2;
            $this->bonus['ladder']['multiple'] = 2;
            $this->bonus['ladder']['l4PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 19 && !$this->bonus['ladder']['l3PD']) {
            $this->bonus['ladder']['level'] = 3;
            $this->bonus['ladder']['bonusSpins'] = 2;
            $this->bonus['ladder']['l3PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 14 && !$this->bonus['ladder']['l2PD']) {
            $this->bonus['ladder']['level'] = 2;
            $this->bonus['ladder']['bonusSpins'] = 1;
            $this->bonus['ladder']['l2PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 9 && !$this->bonus['ladder']['l1PD']) {
            $this->bonus['ladder']['level'] = 1;
            $this->bonus['ladder']['bonusSpins'] = 2;
            $this->bonus['ladder']['l1PD'] = true;
        }
        else {
            $this->bonus['ladder']['level'] = 0;
            $this->bonus['ladder']['bonusSpins'] = 0;
        }
    }

}