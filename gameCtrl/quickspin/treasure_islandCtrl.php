
<?

class treasure_islandCtrl extends Ctrl {
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
    </EEGLoadOddsResponse>
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="1">
            '.$this->gameParams->getPrizes2().'
            <BetOdds type="line" />
        </DrawOdds>
    </EEGLoadOddsResponse>
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

        $this->slot = new Slot($this->gameParams, $pick, $stake, 8/10);

        $this->slot->createCustomReels($this->gameParams->reels[0], array(4,4,4,4,4));
        $this->slot->rows = 4;

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

        $report = $this->slot->spin(array(
            'type' => 'explodedWild',
            'countToStart' => $this->gameParams->pirateAttack['countToStart'],
            'hitsCount' => $this->gameParams->pirateAttack['hitsCount'],
            'hitsChance' => $this->gameParams->pirateAttack['hitsChance'],
            'explodedSymbol' => $this->gameParams->pirateAttack['explodedSymbol'],
            'explodedSymbolReplace' => $this->gameParams->pirateAttack['explodedSymbolReplace'],
            'nonChangedSymbol' => $this->gameParams->pirateAttack['nonChangedSymbol'],
            'newWildsCount' => $this->gameParams->pirateAttack['newWildsCount'],
            'newWildSymbol' => $this->gameParams->pirateAttack['newWildSymbol'],
            'offsets' => $this->gameParams->pirateAttack['offsets'],
            'missChance' => $this->gameParams->pirateAttack['missChance'],
            'missSymbol' => $this->gameParams->pirateAttack['missSymbol'],
        ));

        if($this->slot->bonusIterateCount > 1000) {
            $respin = true;
        }

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] == 3) {
            $this->getFreeSpinData($report);
            $bonusWin = $this->bonus['bonusWin'];
            $report['type'] = 'FS';
        }

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) {
                        $respin = true;
                    }
            }
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
        if(!empty($report['bonusData']['explode'])) {
            $bonus = $this->getExplodeXml($report['bonusData']['explode']);
        }

        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'display' => 'startRows',
            'addString' => $addString,
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

        if(!empty($report['bonusData']['explode']) || $totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
        }

        $this->outXML($xml);
    }

    protected function getExplodeXml($data) {
        $xml = '<Feature name="Pirate Ship">';

        foreach($data as $e) {
            if($e['changed']) {
                $reelNumber = $e['explodeOffset'] % 5;
                $p = floor($e['explodeOffset'] / 5);
                $xml .= '<Detail name="cannonBall" type="Hit" x="'.$p.'" y="'.$reelNumber.'" offsets="'.$e['explodeOffset'].'">';
                foreach($e['newOffsets'] as $o) {
                    $reelNumber = $o % 5;
                    $p = floor($o / 5);
                    $xml .= '<Detail name="cannonBall" type="Explosion" x="'.$p.'" y="'.$reelNumber.'" offsets="'.$o.'" />';
                }
                $xml .= '</Detail>';
            }
            else {
                $reelNumber = $e['explodeOffset'] % 5;
                $p = floor($e['explodeOffset'] / 5);
                $xml .= '<Detail name="cannonBall" type="Miss" x="'.$p.'" y="'.$reelNumber.'" offsets="'.$e['explodeOffset'].'" />';
            }
        }

        $xml .= '</Feature>';

        return $xml;
    }

    protected function getFreeSpinData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;
        $this->bonus['spins'] = 0;
        $fsConfig = $this->gameParams->fsConfig;

        $fsType = $fsConfig['fsType'][$this->getRandParam($fsConfig['fsTypeChance'])];

        $this->bonus['fsType'] = $fsType;

        switch($fsType) {
            case 'credit':
                $this->getCreditData($report);
                break;
            case 'hunt':
                $this->getHuntData($report);
                break;
            case 'fs':
                $this->getFsData($report);
                break;
        }
    }

    protected function getCreditData($report) {
        $this->bonus['totalWin'] += $report['bet'] * 2;
        $this->bonus['bonusWin'] += $report['bet'] * 2;

        $this->bonusPays[] = $report['bet'] * 2;

        $this->bonus['bonus'] = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="3S" length="3" payout="0.00" />
                <Bonus offsets="" prize="Credit Bonus" length="0" payout="'.$this->bonus['bonusWin'].'" />
                <Feature name="BaseGameIntroBonusPick">
                    <Feature name="BonusIntroPick" won="false" />
                    <Feature name="TreasureHunt" won="false" />
                    <Feature name="Credit Bonus" payout="'.$this->bonus['bonusWin'].'" won="true" />
                </Feature>';

        $this->bonus['drawStates'] = '';
    }

    protected function getHuntData($report) {
        $treasureMultipleArray = array();
        $digMultipleArray = array();

        $config = $this->gameParams->huntConfig;

        for($i = 0; $i < 2; $i++) {
            if(rnd(0,100) <= $config['treasureChance'] && empty($treasureMultipleArray)) {
                $tMultiple = $config['treasureMultiple'][$this->getRandParam($config['treasureMultipleChance'])];
                while(in_array($tMultiple, $treasureMultipleArray)) {
                    $tMultiple = $config['treasureMultiple'][$this->getRandParam($config['treasureMultipleChance'])];
                }
                $treasureMultipleArray[] = $tMultiple;
            }
            else {
                $dMultiple = $config['digMultiple'][$this->getRandParam($config['digMultipleChance'])];
                while(in_array($dMultiple, $digMultipleArray)) {
                    $dMultiple = $config['digMultiple'][$this->getRandParam($config['digMultipleChance'])];
                }
                $digMultipleArray[] = $dMultiple;
            }
        }
        $totalWin = $report['betOnLine'] * (array_sum($treasureMultipleArray) + array_sum($digMultipleArray));
        $this->bonus['bonusWin'] += $totalWin;
        $this->bonus['totalWin'] += $totalWin;

        $this->bonusPays[] = $totalWin;

        $treasureWin = array_sum($treasureMultipleArray) * $report['betOnLine'];
        $digWin = array_sum($digMultipleArray) * $report['betOnLine'];

        $seq = 0;

        $treasureDetail = '';

        if($treasureWin == 0) {
            $treasureDetail .= '<Detail name="TreasureChest" won="false">';
        }
        else {
            $treasureDetail .= '<Detail name="TreasureChest" type="Hit" payout="'.$treasureWin.'" seq="'.($seq++).'" won="true">';
        }

        $last = array_diff($config['treasureMultiple'], $treasureMultipleArray);
        foreach($last as $l) {
            $treasureDetail .= '<Detail name="TreasureChest" type="Miss" payDescs="'.($l * $report['betOnLine']).'" />';
        }
        $treasureDetail .= '</Detail>';


        $digDetail = '';

        foreach($config['digMultiple'] as $d) {
            if(in_array($d, $digMultipleArray)) {
                $digDetail .= '<Detail name="dig" payout="'.($d * $report['betOnLine']).'" seq="'.($seq++).'" won="true" />';
            }
            else {
                $digDetail .= '<Detail name="dig" payout="'.($d * $report['betOnLine']).'" won="false" />';
            }
        }

        $detail = $treasureDetail . $digDetail;

        $xml = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="3S" length="3" payout="0.00" />
                <Bonus offsets="" prize="TreasureHunt" length="0" payout="'.$this->bonus['bonusWin'].'" />
                <Feature name="BaseGameIntroBonusPick">
                    <Feature name="BonusIntroPick" won="false" />
                    <Feature name="Credit Bonus" payout="5.00" won="false" />
                    <Feature name="TreasureHunt">
                        '.$detail.'
                    </Feature>
                </Feature>';

        $this->bonus['bonus'] = $xml;
        $this->bonus['drawStates'] = '';
    }


    protected function getFsData($report) {
        $config = $this->gameParams->fsConfig;

        $bonusArray = $config['bonusArray'];
        shuffle($bonusArray);

        $betOnLine = $report['betOnLine'];

        $bonusType = '';
        $xWildLevel = 1;
        $spins = 6;
        $resultArray = array();
        $seq = 0;
        $end = false;
        foreach($bonusArray as $b) {

            $item = array(
                'name' => $b,
                'won' => !$end,
            );
            if(!$end) {
                $item['seq'] = $seq++;
            }
            if($b == 'freeSpins') {
                $item['spins'] = $config['addFsCount'][$this->getRandParam($config['addFsCountChance'])];
            }
            if($b == 'xWilds') {
                $item['number'] = $xWildLevel++;
            }

            $resultArray[] = $item;
            if($b == 'starFs') {
                $end = true;
            }
        }

        foreach($resultArray as $r) {
            if(in_array($r['name'], array('xWilds', 'superWilds', 'barrelsLocked')) && $r['won']) {
                $bonusType = $r['name'];
                break;
            }
        }

        if($bonusType == '') {
            $bonusType = 'xWilds';
        }

        $totalPayout = 0;

        foreach($resultArray as &$r) {
            $payout = $betOnLine * $config['payout'][$this->getRandParam($config['payoutChance'])];

            if($r['name'] !== $bonusType && $r['name'] !== 'freeSpins' && $r['name'] !== 'starFs') {
                $r['payout'] = $payout;
                if($r['won']) {
                    $totalPayout += $payout;
                }
            }
        }
        $realXLevel = 0;
        foreach($resultArray as $i) {
            if($i['name'] == 'xWilds' && $i['won'] && $bonusType == 'xWilds') {
                $realXLevel = $i['number'];
            }
            if($i['name'] == 'freeSpins' && $i['won']) {
                $spins += $i['spins'];
            }
        }

        $this->bonus['bonusWin'] += $report['betOnLine'] * $totalPayout;
        $this->bonus['totalWin'] += $report['betOnLine'] * $totalPayout;

        $this->bonusPays[] = $report['betOnLine'] * $totalPayout;

        $detail = '';
        foreach($resultArray as $l) {
            $item = '';
            $item .= '<Detail';
            foreach($l as $k=>$v) {
                if($v === true) $v = 'true';
                if($v === false) $v = 'false';
                $item .= ' '.$k.'="'.$v.'"';
            }
            $item .= ' />';
            $detail .= $item;
        }

        $this->bonus['bonus'] = '<Scatter offsets="'.implode(',', $report['scattersReport']['offsets']).'" prize="3S" length="3" payout="0.00" />
                <Bonus offsets="" prize="BonusIntroPick" length="0" payout="'.$this->bonus['bonusWin'].'" />
                <Feature name="BaseGameIntroBonusPick">
                    <Feature name="Credit Bonus" payout="5.00" won="false" />
                    <Feature name="TreasureHunt" won="false" />
                    <Feature name="BonusIntroPick">'.$detail.'</Feature>
                </Feature>';

        $this->bonus['spins'] = $spins;
        $this->bonus['xWildLevel'] = $realXLevel;

        $this->gameParams->winPay = $this->gameParams->winPay2;
        $this->slot->setParams($this->gameParams);

        $this->bonus['bonusType'] = $bonusType;


        if($bonusType == 'barrelsLocked') {
            $this->getBarrelsData($report);
        }
        if($bonusType == 'superWilds') {
            $this->getSuperWildsData($report);
        }
        if($bonusType == 'xWilds') {
            $this->getWildsData($report);
        }
    }

    protected function getBarrelsData($report) {
        $this->slot->createCustomReels($this->gameParams->reels[3], array(4,4,4,4,4));
        $this->slot->rows = 4;
        $this->slot->drawID = 0;

        $xOffset = array();
        $eOffset = array();
        $mOffset = array();

        $spins = $this->bonus['spins'];

        $draws = '';

        while($spins > 0) {
            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'wildsOnPos',
                    'offsets' => $xOffset,
                    'wildSymbol' => 16,
                ),
                array(
                    'type' => 'wildsOnPos',
                    'offsets' => $eOffset,
                    'wildSymbol' => 17,
                ),
                array(
                    'type' => 'wildsOnPos',
                    'offsets' => $mOffset,
                    'wildSymbol' => 18,
                ),
                array(
                    'type' => 'explodedWild',
                    'countToStart' => $this->gameParams->pirateAttack['countToStart'],
                    'hitsCount' => $this->gameParams->pirateAttack['hitsCount'],
                    'hitsChance' => $this->gameParams->pirateAttack['hitsChance'],
                    'explodedSymbol' => $this->gameParams->pirateAttack['explodedSymbol'],
                    'explodedSymbolReplace' => $this->gameParams->pirateAttack['explodedSymbolReplace'],
                    'nonChangedSymbol' => $this->gameParams->pirateAttack['nonChangedSymbol'],
                    'newWildsCount' => $this->gameParams->pirateAttack['newWildsCount'],
                    'newWildSymbol' => $this->gameParams->pirateAttack['newWildSymbol'],
                    'offsets' => $this->gameParams->pirateAttack['offsets'],
                    'missChance' => $this->gameParams->pirateAttack['missChance'],
                    'missSymbol' => $this->gameParams->pirateAttack['missSymbol'],
                ),
            ));

            if(!empty($fsReport['bonusData']['explode'])) {
                $b1 = $this->slot->getSymbolAnyCount('X');
                $b2 = $this->slot->getSymbolAnyCount('E');
                $b3 = $this->slot->getSymbolAnyCount('M');

                $xOffset = $b1['offsets'];
                $eOffset = $b2['offsets'];
                $mOffset = $b3['offsets'];
            }


            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $this->fsPays[] = $fsReport['totalWin'];

            $bonus = '';
            if(!empty($fsReport['bonusData']['explode'])) {
                $bonus = $this->getExplodeXml($fsReport['bonusData']['explode']);
            }
            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'addString' => $addString,
                'spins' => $this->bonus['spins'],
                'currentSpins' => $this->bonus['spins'],
                'reelset' => 3,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;

            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }

    protected function getWildsData($report) {
        $wilds = array(5,6,7);
        $wildsArray = array_merge(array(0,1,16,17,18), array_slice($wilds, 0, $this->bonus['xWildLevel']));

        $this->slot->createCustomReels($this->gameParams->reels[1], array(4,4,4,4,4));
        $this->slot->rows = 4;
        $this->slot->setWilds($wildsArray);
        $this->slot->drawID = 0;

        $spins = $this->bonus['spins'];

        $draws = '';

        while($spins > 0) {
            $fsReport = $this->slot->spin(array(
                'type' => 'explodedWild',
                'countToStart' => $this->gameParams->pirateAttack['countToStart'],
                'hitsCount' => $this->gameParams->pirateAttack['hitsCount'],
                'hitsChance' => $this->gameParams->pirateAttack['hitsChance'],
                'explodedSymbol' => $this->gameParams->pirateAttack['explodedSymbol'],
                'explodedSymbolReplace' => $this->gameParams->pirateAttack['explodedSymbolReplace'],
                'nonChangedSymbol' => $this->gameParams->pirateAttack['nonChangedSymbol'],
                'newWildsCount' => $this->gameParams->pirateAttack['newWildsCount'],
                'newWildSymbol' => $this->gameParams->pirateAttack['newWildSymbol'],
                'offsets' => $this->gameParams->pirateAttack['offsets'],
                'missChance' => $this->gameParams->pirateAttack['missChance'],
                'missSymbol' => $this->gameParams->pirateAttack['missSymbol'],
            ));

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $this->fsPays[] = $fsReport['totalWin'];

            $bonus = '';
            if(!empty($fsReport['bonusData']['explode'])) {
                $bonus = $this->getExplodeXml($fsReport['bonusData']['explode']);
            }
            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'addString' => $addString,
                'spins' => $this->bonus['spins'],
                'currentSpins' => $this->bonus['spins'],
                'reelset' => 1,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;

            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }

    protected function getSuperWildsData($report) {
        $this->slot->createCustomReels($this->gameParams->reels[2], array(4,4,4,4,4));
        $this->slot->rows = 4;
        $this->slot->drawID = 0;

        $spins = $this->bonus['spins'];

        $draws = '';

        while($spins > 0) {
            $fsReport = $this->slot->spin(array(
                'type' => 'explodedWild',
                'countToStart' => $this->gameParams->pirateAttack['countToStart'],
                'hitsCount' => $this->gameParams->pirateAttack['hitsCount'],
                'hitsChance' => $this->gameParams->pirateAttack['hitsChance'],
                'explodedSymbol' => $this->gameParams->pirateAttack['explodedSymbol'],
                'explodedSymbolReplace' => $this->gameParams->pirateAttack['explodedSymbolReplace'],
                'nonChangedSymbol' => $this->gameParams->pirateAttack['nonChangedSymbol'],
                'newWildsCount' => $this->gameParams->pirateAttack['newWildsCount'],
                'newWildSymbol' => $this->gameParams->pirateAttack['newWildSymbol'],
                'offsets' => $this->gameParams->pirateAttack['offsets'],
                'missChance' => $this->gameParams->pirateAttack['missChance'],
                'missSymbol' => $this->gameParams->pirateAttack['missSymbol'],
            ));

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $this->fsPays[] = $fsReport['totalWin'];

            $bonus = '';
            if(!empty($fsReport['bonusData']['explode'])) {
                $bonus = $this->getExplodeXml($fsReport['bonusData']['explode']);
            }
            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'addString' => $addString,
                'spins' => $this->bonus['spins'],
                'currentSpins' => $this->bonus['spins'],
                'reelset' => 2,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;

            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }

    protected function showFreeSpinReport($report, $totalWin) {
        $bonus = $this->bonus['bonus'];

        $runningTotal = $totalWin;
        if($this->bonus['fsType'] == 'fs') {
            $runningTotal = $report['totalWin'];
        }

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $runningTotal,
            'spins' => $this->bonus['spins'],
            'currentSpins' => $this->bonus['spins'],
        ));


        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="true"/>
                </DrawState>'.$this->bonus['drawStates'];

        $xml = '<CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

    protected function startBonusResult() {
        $draws = gzuncompress(base64_decode($_SESSION['drawStates']));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">'.$draws.'</EEGLoadResultsResponse>
</CompositeResponse>';

        $this->outXML($xml);
    }

}