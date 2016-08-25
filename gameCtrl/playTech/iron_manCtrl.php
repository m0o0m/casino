<?

class iron_manCtrl extends Ctrl {

    protected function startDevice($request) {
        $xml = '<CompositeResponse duine="'.$this->gameID.'" elapsed="0" date="'.$this->getFormatedDate().'"><DeviceTypeResponse deviceID="26894"/><CustomerAuthenticateResponse/></CompositeResponse>';
        $this->outXML($xml);
    }

    protected function startCustomer($request) {
        $stake = $this->gameParams->betConfig;
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><CustomerDetailsResponse domain="harrycasino.com" anonymous="true" currency="'.$stake['currency'].'" currencyPrefix="'.$stake['currencyPrefix'].'"/></CompositeResponse>';

        $this->outXML($xml);
    }

    protected function startFunBalance($request) {
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><CustomerFunBalanceResponse balance="'.$this->getBalance().'"/></CompositeResponse>';

        $this->outXML($xml);
    }

    public function startInit($request) {
        $this->setSessionIfEmpty('seed', true);
        $stake = $this->gameParams->betConfig;

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <FOConfigResponse minStake="'.$stake['minBet'].'" maxStake="'.$stake['maxBet'].'" maxWin="75000.00" defaultStake="'.$stake['defaultBet'].'" roundLimit="'.$stake['maxBet'].'">
        '.$this->gameParams->getIncreaseData().'
        <GameConfig>
            <FreeGames minScatter="3" spins="10" prizeMult="1" />
        </GameConfig>
    </FOConfigResponse>
</CompositeResponse>';

        $this->outXML($xml);
    }

    public function startGameId($request) {
        $response = '<FOOpenGameResponse gameId="'.$this->gameID.'" nextDrawId="0"/>';
        if(!empty($_SESSION['drawStates'])) {
            $gDraw = '';
            try {
                $gDraw = gzuncompress(base64_decode($_SESSION['drawStates']));
            }
            catch (Exception $e) {
                print_r($e);
            }

            if(!empty($_SESSION['gameDrawStates'])) {
                try {
                    $gDraw .= gzuncompress(base64_decode($_SESSION['gameDrawStates']));
                }
                catch (Exception $e) {
                    print_r($e);
                }
            }

            if(!empty($_SESSION['savedState'])) {
                $savedState = '';
                foreach($_SESSION['savedState'] as $key=>$val) {
                    $savedState .= $val;
                }
                $draws = $savedState.$gDraw;
            }
            else $draws = $gDraw;
            $response = '<FOOpenGameResponse gameId="'.$this->gameID.'" nextDrawId="'.$_SESSION['nextDraw'].'">';
            $response .= $draws;
            $response .= '</FOOpenGameResponse>';
        }
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">'.$response.'</CompositeResponse>';

        $this->outXML($xml);
    }

    public function startBalance($request) {
        unset($_SESSION['drawStates']);
        unset($_SESSION['savedState']);
        unset($_SESSION['bonusWIN']);
        unset($_SESSION['bonus']);
        unset($_SESSION['gameDrawStates']);
        unset($_SESSION['nextDraw']);
        unset($_SESSION['bonusWIN']);
        unset($_SESSION['savedState']);

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><FOSettleBetsResponse nextDrawId="1" newBalance="'.$this->getBalance().'"/><FOCloseGameResponse/></CompositeResponse>';

        $this->outXML($xml);
    }

    protected function startSaveState($request) {
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><FOSaveStateResponse/></CompositeResponse>';

        $this->outXML($xml);

        $tmp = (array) $request['FOSaveStateRequest']->SavedState;
        $attrs = $tmp['@attributes'];
        $st = '<SavedState';
        foreach($attrs as $key=>$value) {
            $st.= ' '.$key.'="'.$value.'"';
        }
        $st .= '/>';

        if(empty($_SESSION['savedState'])) $_SESSION['savedState'] = array();
        $seq = $attrs['seq'];
        $_SESSION['savedState'][$seq] = $st;
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
            case 'FREESPIN':
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

        $respin = false;
        $report = $this->slot->spin(array(
            'type' => 'expandWild',
            'reels' => $this->gameParams->expandConf['reels'],
            'symbolsID' => $this->gameParams->expandConf['symbolsID'],
            'wild' => $this->gameParams->expandConf['wild'],
        ));

        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $report['mixedPay'] = $this->getMixedPay();
        if($report['mixedPay']['win']) {
            $report['totalWin'] += $report['betOnLine'] * $report['mixedPay']['totalMultiple'];
            $report['spinWin'] += $report['betOnLine'] * $report['mixedPay']['totalMultiple'];
        }

        if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $this->getFreeSpinBonus($report);
                $report['totalWin'] = $this->fsBonus['totalWin'];
                $report['type'] = 'FREESPIN';
            }
        }

        $totalWin = $report['totalWin'];

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) $respin = true;
                    break;
                case 'mixed':
                    if(!$report['mixedPay']['win']) $respin = true;
                    break;
            }
        }

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function getWinLinesData($report, $override = array()) {
        $params = array(
            'spins' => 0,
            'currentSpins' => 0,
            'lastSpins' => 0,
            'reelset' => 0,
            'runningTotal' => 0,
            'addString' => '',
            'bonus' => '',
            'trigger' => '',
            'drawWin' => $report['totalWin'],
            'display' => 'rows',
        );
        $params = $this->extendArray($params, $override);

        $display = $this->gameParams->getDisplay($report[$params['display']]);

        if(empty($report['winLines']) && empty($params['bonus'])) {
            $xml = '<WinLines runningTotal="'.$params['runningTotal'].'" spins="'.$params['spins'].'" display="'.$display.'"'.$params['addString'].' />';
        }
        else {
            $xml = '<WinLines runningTotal="'.$params['runningTotal'].'" spins="'.$params['spins'].'" display="'.$display.'"'.$params['addString'].'>';
            foreach($report['winLines'] as $winLine) {
                $offset = $this->slot->getOffsetsByLine($winLine['line'], $winLine['count']);
                $xml .= '<WinLine line="'.$winLine['id'].'" offsets="'.implode(',', $offset).'" length="'.$winLine['count'].'" payout="'.$report['bet']*$winLine['multiple'] / $report['linesCount'].'" />';
            }
            $xml .= $params['bonus'];
            $xml .= '</WinLines>';
            $xml .= $params['trigger'];
        }
        return $xml;
    }

    protected function showSpinReport($report, $totalWin) {
        $bonus = '';

        // create mixedPay Lines
        $m = $report['mixedPay'];
        if($m['win']) {
            $lines = '';
            foreach($m['lines'] as $line) {
                $lines .= '<WinLine line="'.$line['lineId'].'" offsets="'.implode(',', $line['offsets']).'" length="'.count($line['offsets']).'" payout="'.$report['bet']*$line['multiple'] / $report['linesCount'].'" />';
            }
            $bonus = $lines;
        }
        if(!empty($report['scattersReport']['totalWin'])) {
            $sr = $report['scattersReport'];
            $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }
        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $win = ($report['totalWin'] > 0) ? "true" : "false";

        $seed = rnd(1000000000, 1999999999);
        if(isset($_SESSION['seed'])) {
            if($_SESSION['seed'] == true) {
                $seed = ''.strval($seed);
                $_SESSION['seed'] = false;
            }
            else {
                $seed = '-'.strval($seed);
                $_SESSION['seed'] = true;
            }
        }
        else {
            $seed = '-'.strval($seed);
            $_SESSION['seed'] = true;
        }

        $event = $this->getEvent($report);

        $drawStates = '<DrawState drawId="0" seed="'.$seed.'" state="settling">
        '.$event.'
            '.$winLines.'
            <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
        </DrawState>';

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <FOPlaceBetsResponse drawId="0" gameId="'.$this->gameID.'" newBalance="'.$balanceWithoutBet.'" />
    <FOLoadResultsResponse gameId="'.$this->gameID.'">'.$drawStates.'</FOLoadResultsResponse>
</CompositeResponse>';

        if($totalWin > 0) {
            $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
            $_SESSION['bonusWIN'] = $totalWin;
            $_SESSION['nextDraw'] = 1;
        }

        $this->outXML($xml);
    }

    private function getEvent($report) {
        $event = '';
        $display = $this->gameParams->getDisplay($report['startRows']);
        $tmp = explode(';', $display);
        $needle = explode(',', $tmp[1]);
        $stops = explode(',', $report['stops']);
        for($i = 0; $i < 5; $i++) {
            $stop = $stops[$i];
            $event .= '<Event seq="'.$i.'" id="'.$stop.'" type="'.$stop.':'.$needle[$i].'" />';
        }
        return $event;
    }

    private function getMixedPay() {
        $bonus = $this->slot->getFullLineBonus(5);
        if(!$bonus['win']) {
            $bonus = $this->slot->getFullLineBonus(4);
            if(!$bonus['win']) {
                $bonus = $this->slot->getFullLineBonus(3);
                if(!$bonus['win']) {
                    $bonus = $this->slot->getFullLineBonus(2);
                }
            }
        }
        return $bonus;
    }

    public function getFreeSpinBonus($report) {
        $startWin = $report['totalWin'];

        $this->fsBonus['totalWin'] = $report['totalWin'];
        $this->fsBonus['preBonusWin'] = 0;
        $this->fsBonus['bonusWin'] = 0;
        $this->fsBonus['drawStates'] = '';
        $this->fsBonus['bonusItems'] = array();

        $multiple = 0;
        $fsCount = 0;
        $prize = 0;
        $cnt = 0;
        $picks = 0;

        $params = $this->gameParams->fsConf;
        while(($multiple == 0 || $fsCount == 0 || $prize == 0 || $cnt < 12) && $cnt < 20) {
            $type = $this->getRandParam($params['typeRnd']);
            if($type == 'prize') {
                $rnd = $this->getRandParam($params['prize']['rnd']);
                $this->fsBonus['bonusItems'][] = $params['prize']['alias'][$rnd];
                if($multiple == 0 || $fsCount == 0 || $prize == 0) {
                    $prize += $report['bet'] * $params['prize']['multiple'][$rnd];
                    $picks++;
                }
            }
            elseif($type == 'fsCount') {
                $rnd = $this->getRandParam($params['fsCount']['rnd']);
                $this->fsBonus['bonusItems'][] = $params['fsCount']['alias'][$rnd];
                if($multiple == 0 || $fsCount == 0 || $prize == 0) {
                    $fsCount += $params['fsCount']['count'][$rnd];
                    $picks++;
                }
            }
            else {
                $rnd = $this->getRandParam($params['multiple']['rnd']);
                $this->fsBonus['bonusItems'][] = $params['multiple']['alias'][$rnd];
                if($multiple == 0) {
                    $multiple = $params['multiple']['count'][$rnd];
                    $picks++;
                }
                else {
                    $cnt = 30;
                }

            }
            $cnt++;
        }
        $itemsCount = count($this->fsBonus['bonusItems']);

        $_SESSION['gameDrawStates'] = '';

        while($itemsCount != 12) {
            $multiple = 0;
            $fsCount = 0;
            $prize = 0;
            $cnt = 0;
            $picks = 0;
            $this->fsBonus['bonusItems'] = array();

            while(($multiple == 0 || $fsCount == 0 || $prize == 0 || $cnt < 12) && $cnt < 20) {
                $type = $this->getRandParam($params['typeRnd']);
                if($type == 'prize') {
                    $rnd = $this->getRandParam($params['prize']['rnd']);
                    $this->fsBonus['bonusItems'][] = $params['prize']['alias'][$rnd];
                    if($multiple == 0 || $fsCount == 0 || $prize == 0) {
                        $prize += $report['bet'] * $params['prize']['multiple'][$rnd];
                        $picks++;
                    }
                }
                elseif($type == 'fsCount') {
                    $rnd = $this->getRandParam($params['fsCount']['rnd']);
                    $this->fsBonus['bonusItems'][] = $params['fsCount']['alias'][$rnd];
                    if($multiple == 0 || $fsCount == 0 || $prize == 0) {
                        $fsCount += $params['fsCount']['count'][$rnd];
                        $picks++;
                    }
                }
                else {
                    $rnd = $this->getRandParam($params['multiple']['rnd']);
                    $this->fsBonus['bonusItems'][] = $params['multiple']['alias'][$rnd];
                    if($multiple == 0) {
                        $multiple = $params['multiple']['count'][$rnd];
                        $picks++;
                    }
                    else {
                        $cnt = 30;
                    }

                }
                $cnt++;
            }

            $itemsCount = count($this->fsBonus['bonusItems']);
        }

        $this->fsBonus['preBonusWin'] = $prize;
        $this->fsBonus['prizeCount'] = $prize;
        $this->fsBonus['startFsCount'] = $fsCount;
        $this->fsBonus['multiple'] = $multiple;
        $this->fsBonus['picked'] = $picks;
        $this->fsBonus['bonusWin'] = $this->fsBonus['preBonusWin'];
        $this->fsBonus['totalWin'] = $this->fsBonus['bonusWin'] + $startWin;

        $totalFs = $fsCount;

        // Выплата за ракеты
        $this->fsPays[] = array(
            'win' => $prize,
            'report' => $report,
        );

        $this->slot->setReels($this->gameParams->reels[1]);
        $counter = 1;
        while($fsCount > 0) {
            $report = $this->slot->spin(array(
                array(
                    'type' => 'multiple',
                    'range' => array($multiple, $multiple),
                ),
                array(
                    'type' => 'expandWild',
                    'reels' => $this->gameParams->expandConf['reels'],
                    'symbolsID' => $this->gameParams->expandConf['symbolsID'],
                    'wild' => $this->gameParams->expandConf['wild'],
                ),
            ));

            $report['scattersReport'] = $this->slot->getScattersCount();

            $sr = $report['scattersReport'];
            if(!empty($this->gameParams->scatterMultiple[$sr['count']])) {
                if($sr['count'] >= 3) {
                    $fsCount += 10;
                    $totalFs += 10;
                }
                $sr['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$sr['count']] * $multiple;
                $report['totalWin'] += $sr['totalWin'];
                $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
            }
            else {
                $bonus = '';
            }
            $report['mixedPay'] = $this->getMixedPay();
            $m = $report['mixedPay'];
            if($m['win']) {
                $report['totalWin'] += $report['betOnLine'] * $m['totalMultiple'];
                $lines = '';
                foreach($m['lines'] as $line) {
                    $lines .= '<WinLine line="'.$line['lineId'].'" offsets="'.implode(',', $line['offsets']).'" length="'.count($line['offsets']).'" payout="'.$report['bet']*$line['multiple'] / $report['linesCount'].'" />';
                }
                $bonus .= $lines;
            }

            $this->fsBonus['bonusWin'] += $report['totalWin'];

            $this->fsPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );

            $winLines = $this->getWinLinesData($report, array(
                'spins' => '{{count}}',
                'runningTotal' => $this->fsBonus['bonusWin'] + $startWin,
                'bonus' => $bonus,
                'addString' => ' currentSpins="'.$totalFs.'"',
            ));

            $seed = rnd(1000000000, 1999999999);
            if(isset($_SESSION['seed'])) {
                if($_SESSION['seed'] == true) {
                    $seed = ''.strval($seed);
                    $_SESSION['seed'] = false;
                }
                else {
                    $seed = '-'.strval($seed);
                    $_SESSION['seed'] = true;
                }
            }
            else {
                $seed = '-'.strval($seed);
                $_SESSION['seed'] = true;
            }

            $event = $this->getEvent($report);

            $drawState = '<DrawState drawId="'.$counter.'" seed="'.$seed.'" state="betting">
            '.$event.$winLines.'
        </DrawState>';
            $xml = '<FOLoadResultsResponse gameId="'.$this->gameID.'">'.$drawState.'</FOLoadResultsResponse>';

            $_SESSION['gameDrawStates'] .= $drawState;

            $this->fsBonus['drawStates'] .= $xml;

            $fsCount--;
            $counter++;
        }

        $this->fsBonus['totalWin'] = $startWin + $this->fsBonus['bonusWin'];
        $this->fsBonus['totalFs'] = $totalFs;

        $this->fsBonus['drawStates'] = str_replace('{{count}}', $totalFs, $this->fsBonus['drawStates']);
        $_SESSION['gameDrawStates'] = str_replace('{{count}}', $totalFs, $_SESSION['gameDrawStates']);
        $_SESSION['gameDrawStates'] = base64_encode(gzcompress($_SESSION['gameDrawStates'], 9));
    }

    public function showFreeSpinReport($report, $totalWin) {
        $bonus = '';
        // create mixedPay Lines
        $m = $report['mixedPay'];
        if($m['win']) {
            $lines = '';
            foreach($m['lines'] as $line) {
                $lines .= '<WinLine line="'.$line['lineId'].'" offsets="'.implode(',', $line['offsets']).'" length="'.count($line['offsets']).'" payout="'.$report['bet']*$line['multiple'] / $report['linesCount'].'" />';
            }
            $bonus = $lines;
        }
        $sr = $report['scattersReport'];
        $bonus .= '<Scatter offsets="'.implode(',', $sr['offsets']).'" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        $bonus .= '<Bonus items="'.implode(',', $this->fsBonus['bonusItems']).'" picked="'.$this->fsBonus['picked'].'" prize="'.$this->fsBonus['prizeCount'].'" multiplier="'.$this->fsBonus['multiple'].'" payout="'.$this->fsBonus['preBonusWin'].'" />';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'spins' => $this->fsBonus['totalFs'],
            'addString' => ' currentSpins="'.$this->fsBonus['startFsCount'].'"',
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        if($report['totalMultiple'] > 0) {
            $win = 'true';
        }
        else {
            $win = 'false';
        }
        $seed = rnd(1000000000, 1999999999);
        if(isset($_SESSION['seed'])) {
            if($_SESSION['seed'] == true) {
                $seed = ''.strval($seed);
                $_SESSION['seed'] = false;
            }
            else {
                $seed = '-'.strval($seed);
                $_SESSION['seed'] = true;
            }
        }
        else {
            $seed = '-'.strval($seed);
            $_SESSION['seed'] = true;
        }

        $event = $this->getEvent($report);

        $drawStates = '<DrawState drawId="0" seed="'.$seed.'" state="settling">
        '.$event.'
            '.$winLines.'
            <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="' . $win . '"/>
        </DrawState>';

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <FOPlaceBetsResponse drawId="0" gameId="'.$this->gameID.'" newBalance="'.$balanceWithoutBet.'" />
    <FOLoadResultsResponse gameId="'.$this->gameID.'">
        '.$drawStates.'
    </FOLoadResultsResponse>
</CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates));
        $_SESSION['bonusWIN'] = $report['totalWin'];
        $_SESSION['nextDraw'] = $this->fsBonus['totalFs'] + 1;

        $this->outXML($xml);
    }

    public function startResult() {
        $draws = '<FOLoadResultsResponse gameId="'.$this->gameID.'">';
        try {
            $draws .= gzuncompress(base64_decode($_SESSION['gameDrawStates']));
        }
        catch (Exception $e) {

        }

        $draws .= '</FOLoadResultsResponse>';

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">'.$draws.'</CompositeResponse>';

        $this->outXML($xml);
    }



}
