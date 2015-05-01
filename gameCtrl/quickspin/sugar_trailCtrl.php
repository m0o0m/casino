<?

class sugar_trailCtrl extends Ctrl {
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

        $lastBet = (empty($_SESSION['lastBet'])) ? '' : $_SESSION['lastBet'];
        $lastPick = (empty($_SESSION['lastPick'])) ? '' : 'L'.$_SESSION['lastPick'];
        $lastStops = (empty($_SESSION['lastStops'])) ? '14,41,26,19,34' : $_SESSION['lastStops'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGOpenGameResponse gameId="'.$this->gameID.'">
        <LastGameInfo pick="'.$lastPick.'" stake="'.$lastBet.'" stops="'.$lastStops.'" />
        '.$draws.'
    </EEGOpenGameResponse>
     <CustomerFunBalanceResponse balance="'.$this->getBalance().'" />
    '.$this->gameParams->getReels().'<EEGLoadWinLinesResponse gameId="'.$this->gameID.'">
        <WinLines>
            <Line num="1" offsets=" 0,  0,  0,  0,  0" />
            <Line num="2" offsets="-1, -1, -1, -1, -1" />
            <Line num="3" offsets=" 1,  1,  1,  1,  1" />
            <Line num="4" offsets="-1,  0,  1,  0, -1" />
            <Line num="5" offsets=" 1,  0, -1,  0,  1" />
            <Line num="6" offsets="-1, -1,  0, -1, -1" />
            <Line num="7" offsets=" 1,  1,  0,  1,  1" />
            <Line num="8" offsets=" 0,  1,  1,  1,  0" />
            <Line num="9" offsets=" 0, -1, -1, -1,  0" />
            <Line num="10" offsets=" 0, -1,  0, -1,  0" />
            <Line num="11" offsets=" 0,  1,  0,  1,  0" />
            <Line num="12" offsets="-1,  0, -1,  0, -1" />
            <Line num="13" offsets=" 1,  0,  1,  0,  1" />
            <Line num="14" offsets=" 0,  0, -1,  0,  0" />
            <Line num="15" offsets=" 0,  0,  1,  0,  0" />
            <Line num="16" offsets="-1,  0,  0,  0, -1" />
            <Line num="17" offsets=" 1,  0,  0,  0,  1" />
            <Line num="18" offsets="-1,  0,  1,  1,  1" />
            <Line num="19" offsets=" 1,  0, -1, -1, -1" />
            <Line num="20" offsets="-1,  1, -1,  1, -1" />
            <Line num="21" offsets=" 1, -1,  1, -1,  1" />
            <Line num="22" offsets="-1,  1,  1,  1, -1" />
            <Line num="23" offsets=" 1, -1, -1, -1,  1" />
            <Line num="24" offsets="-1, -1,  1, -1, -1" />
            <Line num="25" offsets=" 1,  1, -1,  1,  1" />
            <Line num="26" offsets="-1, -1, -1,  0,  1" />
            <Line num="27" offsets="-1,  0, -1,  0,  1" />
            <Line num="28" offsets=" 1,  0,  1,  0, -1" />
            <Line num="29" offsets="-1, -1, -1, -1,  0" />
            <Line num="30" offsets=" 1,  1,  1,  1,  0" />
            <Line num="31" offsets="-1,  0,  0,  1,  1" />
            <Line num="32" offsets=" 1,  0,  0, -1, -1" />
            <Line num="33" offsets="-1, -1,  0,  0,  1" />
            <Line num="34" offsets=" 1,  1,  0,  0, -1" />
            <Line num="35" offsets=" 1, -1,  1,  0,  0" />
            <Line num="36" offsets="-1,  1, -1,  0,  0" />
            <Line num="37" offsets=" 0,  0,  1,  0, -1" />
            <Line num="38" offsets=" 0,  0, -1,  0,  1" />
            <Line num="39" offsets="-1,  0,  1,  0,  0" />
            <Line num="40" offsets=" 1,  0, -1,  0,  0" />
        </WinLines>
    </EEGLoadWinLinesResponse>'.$this->getStakeParams().'
    <EEGLoadOddsResponse gameId="'.$this->gameID.'">
        <DrawOdds payTableSet="0">
            '.$this->gameParams->getPrizes().'
            <BetOdds type="line" />
            <FreeSpinsAwardReelGrid id="0" numStops="12" stops="F1,80,F1,60,F1,80,F1,40,F2,120,F1,80" />
            <FreeSpinsAwardReelGrid id="1" numStops="12" stops="F6,F9,F7,F6,F8,F10,F8,F6,F7,F8,F6,F7" />
            <FreeSpinsAwardReelGrid id="2" numStops="12" stops="W3,W1,W2,W1,W2,W1,W2,W1,W3,W1,W2,W1" />
            <RepinsAwardReelGrid id="0" numStops="12" stops="20,W1,40,W1,60,40,W1,20,W1,40,W1,40" />
            <RepinsAwardReelGrid id="1" numStops="12" stops="W3,W5,W4,W3,W5,W3,W5,W3,W5,W4,W3,W4" />
            <RepinsAwardReelGrid id="2" numStops="12" stops="R2,R1,R2,R1,R2,R1,R3,R2,R1,R2,R2,R1" />
            <MultiplierReelGrid id="0" numStops="12" stops="40,80,40,120,80,40,120,40,80,40,80,60" />
            <MultiplierReelGrid id="1" numStops="12" stops="M2,25,M3,30,M2,40,M3,50,M2,40,M3,60" />
            <MultiplierReelGrid id="2" numStops="12" stops="M3,50,M2,75,M5,30,M2,30,M3,20,M4,30" />
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
            case 'LOCK':
                $this->showLockReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'CASH':
                $this->showCashReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'CANDY':
                $this->showCandyReport($spinData['report'], $spinData['totalWin']);
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
        $bonus = array();

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'candy':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(9,32,12,3,0),
                    );
                    break;
                case 'lock':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(0,6,37,6,0),
                    );
                    break;
                case 'cash':
                    $bonus = array(
                        'type' => 'setReelsOffsets',
                        'offsets' => array(0,5,2,22,12),
                    );
                    break;
            }
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $bonusWin = 0;

        $f = $this->slot->getSymbolAnyCount('F');
        if($f['count'] > 2) {
            $bonusCount++;
            $report['type'] = 'CANDY';
            $this->getCandyBonusData($report);
            $bonusWin = $this->bonus['bonusWin'];
        }

        $r = $this->slot->getSymbolAnyCount('R');
        if($r['count'] > 2) {
            $bonusCount++;
            $report['type'] = 'LOCK';
            $this->getLockBonusData($report);
            $bonusWin = $this->bonus['bonusWin'];
        }

        $m = $this->slot->getSymbolAnyCount('M');
        if($m['count'] > 2) {
            $bonusCount++;
            $report['type'] = 'CASH';
            $this->getCashBonusData($report);
            $bonusWin = $this->bonus['bonusWin'];
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

    protected function showLockReport($report, $totalWin) {
        $report['totalWin'] += $this->bonus['preBonusWin'];
        $bonus = '<Bonus offsets="" prize="RespinFeatureCreditsPayout" length="0" payout="'.$this->bonus['preBonusWin'].'" />
        <BonusRespins credits="'.$this->bonus['credits'].'" respins="'.$this->bonus['respins'].'" wilds="'.$this->bonus['wilds'].'" />';

        $addString = ' preReelStops="'.implode(',', $this->bonus['stops']).'" preReelDisplay="'.$this->bonus['display'].'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'addString' => $addString,
            'spins' => $this->bonus['respins'],
            'currentSpins' => $this->bonus['respins'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>
'.$this->bonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" freeGames="0" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                '.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

    public function showCashReport($report, $totalWin) {
        $bonus = '<Bonus offsets="" prize="MultiplierFeature" length="0" payout="'.$this->bonus['bonusWin'].'" />
                <bonusMultiplierAmount multiplier="'.$this->bonus['multiple'].'" credits="'.$this->bonus['credits'].'" />';

        $addString = ' preReelStops="'.implode(',', $this->bonus['stops']).'" preReelDisplay="'.$this->bonus['display'].'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'addString' => $addString,
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

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

    public function showCandyReport($report, $totalWin) {
        $report['totalWin'] += $this->bonus['preBonusWin'];
        $bonus = '<Bonus offsets="" prize="FreeSpinFeatureCreditsPayout" length="0" payout="'.$this->bonus['preBonusWin'].'" />
                <BonusFreeSpins credits="'.$this->bonus['credits'].'" freeSpins="'.$this->bonus['spins'].'" wilds="'.$this->bonus['wilds'].'" />';

        $addString = ' preReelStops="'.implode(',', $this->bonus['stops']).'" preReelDisplay="'.$this->bonus['display'].'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'addString' => $addString,
            'spins' => $this->bonus['spins'] + 1,
            'currentSpins' => $this->bonus['spins'],
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="' . $report['stops'] . '"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
                </DrawState>
'.$this->bonus['drawStates'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" freeGames="0" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">
                '.$drawStates.'
            </EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        $this->outXML($xml);
    }

    protected function getLockBonusData($report) {
        $conf = $this->gameParams->sugarLockReel;

        $this->bonus['preBonusWin'] = 0;
        $this->bonus['bonusWin'] = 0;
        $this->bonus['totalWin'] = $report['totalWin'];

        $multiple = 0;
        $wildsCount = 0;
        $respins = 0;

        $display = array();

        $stops = array(
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
        );

        for($i = 0; $i <= 2; $i++) {
            $current = $conf[$i][$stops[$i]];
            $display[] = $current;
            $first = substr($current, 0, 1);
            if($first == 'W') {
                $wildsCount += intval(substr($current, 1));
            }
            else if($first == 'R') {
                $respins += intval(substr($current, 1));
            }
            else {
                $multiple += intval($current);
            }
        }

        $this->bonus['preBonusWin'] = $report['betOnLine'] * $multiple;
        $this->bonus['stops'] = $stops;
        $this->bonus['display'] = implode(',', $display);

        $this->bonus['bonusWin'] += $this->bonus['preBonusWin'];
        $this->bonus['totalWin'] += $this->bonus['preBonusWin'];

        $this->bonusPays[] = $this->bonus['preBonusWin'];

        $this->bonus['credits'] = $multiple;
        $this->bonus['respins'] = $respins;
        $this->bonus['wilds'] = $wildsCount;

        $wildsPositions = array();
        while(count($wildsPositions) != $wildsCount) {
            $r = rnd(0,14);
            if(!in_array($r, $wildsPositions)) {
                $wildsPositions[] = $r;
            }
        }

        $this->slot->setReels($this->gameParams->reels[2]);
        $this->slot->setWilds(array(0,1));

        $drawStates = '';

        for($i = 0; $i < $respins; $i++) {
            $fsReport = $this->slot->spin(array(
                'type' => 'wildsOnPos',
                'offsets' => $wildsPositions,
                'wildSymbol' => 1,
            ));

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $this->fsPays[] = $fsReport['totalWin'];


            $display = $this->gameParams->getDisplay($fsReport['rows']);
            $addString = ' displayWithWildOverlays="'.$display.'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'addString' => $addString,
                'spins' => $respins,
                'currentSpins' => $respins,
                'display' => 'startRows',
                'reelset' => 2,
            ));


            $draw = '<DrawState drawId="'.($i+1).'">'.$winLines.'<ReplayInfo foItems="' . $fsReport['stops'] . '" /></DrawState>';

            $drawStates .= $draw;
        }

        $this->bonus['drawStates'] = $drawStates;
    }

    protected function getCashBonusData($report) {
        $conf = $this->gameParams->sugarCashReel;

        $this->bonus['bonusWin'] = 0;
        $this->bonus['totalWin'] = $report['totalWin'];

        $multipleArray = array();

        $credits = 0;

        $display = array();

        $stops = array(
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
        );

        for($i = 0; $i <= 2; $i++) {
            $current = $conf[$i][$stops[$i]];
            $display[] = $current;
            $first = substr($current, 0, 1);
            if($first == 'M') {
                $multipleArray[] = intval(substr($current, 1));
            }
            else {
                $credits += intval($current);
            }
        }

        $cWin = $credits;
        foreach($multipleArray as $m) {
            $cWin *= $m;
        }

        if(empty($multipleArray)) {
            $multipleArray = array(1);
        }

        $this->bonus['bonusWin'] = $report['betOnLine'] * $cWin;
        $this->bonus['totalWin'] += $this->bonus['bonusWin'];

        $this->bonus['stops'] = $stops;
        $this->bonus['display'] = implode(',', $display);

        $this->bonus['credits'] = $credits;
        $this->bonus['multiple'] = array_sum($multipleArray);

        $this->bonusPays[] = $this->bonus['bonusWin'];
    }

    protected function getCandyBonusData($report) {
        $conf = $this->gameParams->sugarCandyReel;

        $this->bonus['preBonusWin'] = 0;
        $this->bonus['bonusWin'] = 0;
        $this->bonus['totalWin'] = $report['totalWin'];

        $credits = 0;
        $wildsCount = 0;
        $spins = 0;

        $display = array();

        $stops = array(
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
            rnd(0, count($conf[0])-1),
        );

        for($i = 0; $i <= 2; $i++) {
            $current = $conf[$i][$stops[$i]];
            $display[] = $current;
            $first = substr($current, 0, 1);
            if($first == 'W') {
                $wildsCount += intval(substr($current, 1));
            }
            else if($first == 'F') {
                $spins += intval(substr($current, 1));
            }
            else {
                $credits += intval($current);
            }
        }

        $this->bonus['preBonusWin'] = $report['betOnLine'] * $credits;
        $this->bonus['stops'] = $stops;
        $this->bonus['display'] = implode(',', $display);

        $this->bonus['bonusWin'] += $this->bonus['preBonusWin'];
        $this->bonus['totalWin'] += $this->bonus['preBonusWin'];

        $this->bonusPays[] = $this->bonus['preBonusWin'];

        $this->bonus['credits'] = $credits;
        $this->bonus['wilds'] = $wildsCount;
        $this->bonus['spins'] = $spins;

        $totalFs = $spins;

        $this->slot->setReels($this->gameParams->reels[1]);
        $this->slot->setWilds(array(1,0));

        $draws = '';


        $drawID = 1;
        $prevOffsets = array();
        while($spins > 0) {
            if($drawID == 1) {
                $spawnWild = false;
            }
            else {
                if(rnd(0, $this->gameParams->sugarCandyAddWildChance) == 0) {
                    $spawnWild = true;
                    $wildsCount++;
                }
                else {
                    $spawnWild = false;
                }
            }


            $this->gameParams->bonusRand = array($wildsCount);

            $fsReport = $this->slot->spin(array(
                'type' => 'randomWild',
                'range' => array($wildsCount, $wildsCount),
            ));

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $this->fsPays[] = $fsReport['totalWin'];


            $display = $this->gameParams->getDisplay($fsReport['rows']);

            $addString = '';
            $i = 0;
            foreach($fsReport['bonusData']['offsets'] as $pos) {
                $reelNumber = $pos % 5;
                $p = floor($pos / 5);

                if(isset($prevOffsets[$i])) {
                    $pRN = $prevOffsets[$i] % 5;
                    $pp = floor($prevOffsets[$i] / 5);
                    $startCoord = $pp.','.$pRN;
                }
                else {
                    $startCoord = '-1,-1';
                }

                $addString .= ' WildStartCoordinate'.$i.'="'.$startCoord.'" WildStopCoordinate'.$i.'="'.$p.','.$reelNumber.'"';

                $i++;
            }
            if($drawID > 1 || $spawnWild) {
                $addString .= ' spawnWilds="'.(($spawnWild)?1:0).'"';
            }
            if($drawID == 1) {
                $addString .= ' displayBeforeMovement="'.$this->gameParams->getDisplay($fsReport['startRows']).'" displayAfterMovement="'.$display.'"';
            }
            else {
                if($spawnWild) {
                    $offset = $fsReport['bonusData']['offsets'][0];
                    $symbol = $this->gameParams->getSymbolByID(array($fsReport['bonusData']['replacedSymbols'][0]));
                    $m = str_replace(';', ',', $display);
                    $displayArray = explode(',', $m);
                    $displayArray[$offset] = $symbol;
                    $display2 = '';
                    for($i = 0; $i < count($displayArray); $i++) {
                        $last = '';
                        if($i !== count($displayArray) - 1) {
                            if(($i - 4) % 5 == 0) {
                                $last = ';';
                            }
                            else {
                                $last = ',';
                            }
                        }
                        $display2 .= $displayArray[$i].$last;
                    }
                    $addString .= ' displayBeforeMovement="'.$display2.'" displayAfterMovement="'.$display.'"';
                }
                else {
                    $addString .= ' displayBeforeMovement="'.$display.'" displayAfterMovement="'.$display.'"';
                }

            }

            $prevOffsets = $fsReport['bonusData']['offsets'];

            $winLines = $this->getWinLinesData($fsReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'addString' => $addString,
                'spins' => $totalFs + 1,
                'currentSpins' => $totalFs + 1,
                'display' => 'startRows',
                'reelset' => 1,
            ));

            $totalItems = $fsReport['stops'].','.implode(',', $fsReport['bonusData']['offsets']);

            $draw = '<DrawState drawId="'.$drawID.'">'.$winLines.'<ReplayInfo foItems="'.$totalItems.'" /></DrawState>';

            $draws .= $draw;

            $bonusFs = substr_count($this->gameParams->getDisplay($fsReport['startRows']), 'Z');
            $spins += $bonusFs;
            $totalFs += $bonusFs;

            $drawID++;
            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
        $this->bonus['totalFs'] = $totalFs;
    }

}