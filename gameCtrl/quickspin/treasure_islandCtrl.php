
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

        $payType = 'standart';

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FS':
                $payType = 'free';
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, $payType);
    }

    protected function getSpinData() {
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

        $seq = 0;

        $detail = '';
        $treasureWon = (array_sum($treasureMultipleArray) > 0) ? 'true' : 'false';
        if($treasureWon !== 'true') {
            $detail .= '<Detail name="TreasureChest" won="false">';
        }

        if(in_array(300, $treasureMultipleArray)) {
            $d1 = '<Detail name="TreasureChest" type="Hit" payout="'.($report['betOnLine']*300).'" seq="'.$seq++.'" won="true">';
            $d1Won = true;
        }
        else {
            $d1 = '<Detail name="TreasureChest" type="Miss" payDescs="'.($report['betOnLine']*300).'" />';
            $d1Won = false;
        }

        if(in_array(500, $treasureMultipleArray)) {
            $d2 = '<Detail name="TreasureChest" type="Hit" payout="'.($report['betOnLine']*500).'" seq="'.$seq++.'" won="true">';
            $d2Won = true;
        }
        else {
            $d2 = '<Detail name="TreasureChest" type="Miss" payDescs="'.($report['betOnLine']*500).'" />';
            $d2Won = false;
        }

        if(in_array(700, $treasureMultipleArray)) {
            $d3 = '<Detail name="TreasureChest" type="Hit" payout="'.($report['betOnLine']*700).'" seq="'.$seq++.'" won="true">';
            $d3Won = true;
        }
        else {
            $d3 = '<Detail name="TreasureChest" type="Miss" payDescs="'.($report['betOnLine']*700).'" />';
            $d3Won = false;
        }

        if($d1Won) {
            $detail .= $d1.$d2.$d3;
        }
        elseif($d2Won) {
            $detail .= $d2.$d1.$d3;
        }
        elseif($d3Won) {
            $detail .= $d3.$d1.$d2;
        }
        else {
            $detail .= $d1.$d2.$d3;
        }

        $detail .= '</Detail>';

        if(in_array(50, $digMultipleArray)) {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*50).'" seq="'.$seq++.'" won="true" />';
        }
        else {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*50).'" won="false" />';
        }

        if(in_array(60, $digMultipleArray)) {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*60).'" seq="'.$seq++.'" won="true" />';
        }
        else {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*60).'" won="false" />';
        }

        if(in_array(160, $digMultipleArray)) {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*160).'" seq="'.$seq++.'" won="true" />';
        }
        else {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*160).'" won="false" />';
        }

        if(in_array(250, $digMultipleArray)) {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*250).'" seq="'.$seq++.'" won="true" />';
        }
        else {
            $detail .= '<Detail name="dig" payout="'.($report['betOnLine']*250).'" won="false" />';
        }

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
        shuffle($bonusArray );

        $bonusType = '';
        $xWildLevel = 1;
        $end = false;



        $spins = 6;

        $resultArray = array();


        foreach($bonusArray as $b) {
            if($b == 'xWilds' && !$end) {
                if($bonusType == '') $bonusType = 'xWilds';
                $resultArray[] = array(
                    'name' => 'xWilds',
                    'won' => true,
                );
            }
            elseif($b == 'xWilds' && $end) {
                $resultArray[] = array(
                    'name' => 'xWilds',
                    'won' => false,
                );
            }

            if($b == 'freeSpins' && !$end) {
                $resultArray[] = array(
                    'name' => 'freeSpins',
                    'won' => true,
                );
            }
            elseif($b == 'freeSpins' && $end) {
                $resultArray[] = array(
                    'name' => 'freeSpins',
                    'won' => false,
                );
            }


            if($b == 'credit' && !$end) {
                $resultArray[] = array(
                    'name' => 'credit',
                    'won' => true,
                );
            }
            elseif($b == 'credit' && $end) {
                $resultArray[] = array(
                    'name' => 'credit',
                    'won' => false,
                );
            }


            if($b == 'superWilds' && !$end) {
                if($bonusType == '') $bonusType = 'superWilds';
                $resultArray[] = array(
                    'name' => 'superWilds',
                    'won' => true,
                );
            }
            elseif($b == 'superWilds' && $end) {
                $resultArray[] = array(
                    'name' => 'superWilds',
                    'won' => false,
                );
            }



            if($b == 'starFs' && !$end) {
                $end = true;
                $resultArray[] = array(
                    'name' => 'starFs',
                    'won' => true,
                );
            }
            elseif($b == 'starFs' && $end) {
                $resultArray[] = array(
                    'name' => 'starFs',
                    'won' => false,
                );
            }


            if($b == 'barrelsLocked' && !$end) {
                if($bonusType == '') $bonusType = 'barrelsLocked';
                $resultArray[] = array(
                    'name' => 'barrelsLocked',
                    'won' => true,
                );
            }
            elseif($b == 'barrelsLocked' && $end) {
                $resultArray[] = array(
                    'name' => 'barrelsLocked',
                    'won' => false,
                );
            }
        }

        if($bonusType == '') {
            $bonusType = 'xWilds';
        }

        $iterate = 0;
        $bonusPayout = 0;

        $xWildPaid = false;
        $superWildPaid = false;
        $barrelPaid = false;
        $starPaid = false;

        $realXLevel = 0;
        foreach($resultArray as &$r) {
            if($r['name'] == 'freeSpins') {
                $fsCount = $config['addFsCount'][$this->getRandParam($config['addFsCountChance'])];
                $r['spins'] = $fsCount;
                if($r['won']) {
                    $r['seq'] = $iterate;
                    $spins += $fsCount;
                }
            }

            if($r['name'] == 'starFs' && !$starPaid) {
                $starPaid = true;
                $r['seq'] = $iterate;
            }

            if($r['name'] == 'credit') {
                $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                if($r['won']) {
                    $r['seq'] = $iterate;
                    $bonusPayout += $r['payout'];
                }
            }

            if($r['name'] == 'xWilds') {
                if($bonusType == 'xWilds') {
                    if($r['won']) {
                        $r['number'] = $xWildLevel++;
                        $r['seq'] = $iterate;
                        $realXLevel++;
                    }
                    else {
                        $r['number'] = $xWildLevel++;
                    }
                }
                else {
                    if($r['won']) {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                        $r['seq'] = $iterate;
                        $bonusPayout += $r['payout'];
                    }
                    else {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                    }

                }
            }

            if($r['name'] == 'superWilds') {
                if($bonusType == 'superWilds' && !$superWildPaid) {
                    $superWildPaid = true;
                    if($r['won']) {
                        $r['seq'] = $iterate;
                    }
                }
                else {
                    if($r['won']) {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                        $r['seq'] = $iterate;
                        $bonusPayout += $r['payout'];
                    }
                    else {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                    }

                }
            }

            if($r['name'] == 'barrelsLocked') {
                if($bonusType == 'barrelsLocked' && !$barrelPaid) {
                    $barrelPaid = true;
                    if($r['won']) {
                        $r['seq'] = $iterate;
                    }
                }
                else {
                    if($r['won']) {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                        $r['seq'] = $iterate;
                        $bonusPayout += $r['payout'];
                    }
                    else {
                        $r['payout'] = $report['betOnLine'] * $config['payout'][$this->getRandParam($config['payoutChance'])];
                    }

                }
            }

            $iterate++;
        }

        $this->bonus['bonusWin'] += $report['betOnLine'] * $bonusPayout;
        $this->bonus['totalWin'] += $report['betOnLine'] * $bonusPayout;

        $detail = '';
        foreach($resultArray as $r) {
            $detail .= '<Detail';
            foreach($r as $k=>$v) {
                if($v === true) $v = 'true';
                if($v === false) $v = 'false';
                $detail .= ' '.$k.'="'.$v.'"';
            }
            $detail .= ' />';
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

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
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