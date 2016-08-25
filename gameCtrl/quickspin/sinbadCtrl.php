<?

class sinbadCtrl extends Ctrl {
    public $useSessionBet = true;

    protected function startInit($request) {
        if(empty($_SESSION['gameState'])) {
            $_SESSION['gameState'] = 'SPIN';
        }

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

        if(!empty($_SESSION['fsPick'])) {
            switch($_SESSION['fsPick']) {
                case 'ape':
                    $draws = $this->updateStringOption($draws, 'currentSpins', 7);
                    break;
                case 'roc':
                    $draws = $this->updateStringOption($draws, 'currentSpins', 10);
                    break;
                case 'snake':
                    $draws = $this->updateStringOption($draws, 'currentSpins', 12);
                    break;

            }
        }

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
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
        $_SESSION['gameState'] = 'SPIN';
        $betAttr = (array) $request->Bet;
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['stake'];
        $pick = substr($betAttr['pick'], 1);

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);

        $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,4,4,3));
        $this->slot->rows = 4;

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $this->slot->createCustomReels($this->gameParams->reels[0], array(3,4,4,4,3));
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FS':
                $this->showFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $report = $this->slot->spin(array(
            'type' => 'randomReplace',
            'symbols' => array(0,1,2),
            'replacement' => array(4,5,6,7,8,9,10,11,12,13),
        ));

        $report['type'] = 'SPIN';
        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 2) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            $report['type'] = 'FS';
        }

        if($this->gameParams->testBonusEnable) {
            $g = (empty($_GET['bonus'])) ? '' : $_GET['bonus'];
            switch($g) {
                case 'fs':
                    if($report['scattersReport']['count'] < 3) {
                        $respin = true;
                    }
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
        $bonus = '';
        $sr = $report['scattersReport'];
        if(isset($sr['totalWin'])) {
            $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'BN" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" />';
        }


        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'" replacement="'.implode(',', $report['bonusData']['replaced']).'"';

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

        $xml = '<CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
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
        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'BN" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" /><Feature name="freeSpin" state="pending" />';


        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'" replacement="'.implode(',', $report['bonusData']['replaced']).'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $totalWin,
            'display' => 'startRows',
            'addString' => $addString,
        ));

        $balanceWithoutBet = $this->getBalance() - $report['bet'];

        $drawStates = '<DrawState drawId="0" state="betting">' . $winLines . '
                    <ReplayInfo foItems="'.$report['stops'].'"/>
                    <Bet seq="0" type="line" stake="' . $report['bet'] . '" pick="L' . $report['linesCount'] . '" payout="' . $totalWin . '" won="pending"/>
                </DrawState>';

        $xml = '<CompositeResponse elapsed="0" date="' . $this->getFormatedDate() . '">
            <EEGPlaceBetsResponse newBalance="' . $balanceWithoutBet . '" gameId="' . $this->gameID . '"/>
            <EEGLoadResultsResponse gameId="' . $this->gameID . '">'.$drawStates.'</EEGLoadResultsResponse>
        </CompositeResponse>';

        $_SESSION['gameState'] = 'FS';
        $_SESSION['report'] = $report;
        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] = $totalWin;

        if($this->emulation) {
            $_POST['xml'] = '<CompositeRequest>
  <EEGActionRequest gameTitle="QS-Sinbad" gameId="1411559061">
    <Action type="pick" pick="roc"/>
  </EEGActionRequest>
</CompositeRequest>';
            $this->request = $this->getRequest();
            $this->processRequest($this->request);

            $_POST['xml'] = '<CompositeRequest>
  <EEGLoadResultsRequest gameTitle="QS-Sinbad" gameId="1411559061"/>
</CompositeRequest>';
            $this->request = $this->getRequest();
            $this->processRequest($this->request);
        }
        else {
            $this->outXML($xml);
        }
    }

    protected function startAction($request) {
        if($_SESSION['gameState'] == 'FS') {
            $attrs = (array) $request->Action;
            $pick = $attrs['@attributes']['pick'];
            $_SESSION['fsPick'] = $pick;

            $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><EEGActionResponse name="'.$pick.'" gameId="'.$this->gameID.'"/></CompositeResponse>';
            if($this->emulation) {

            }
            else {
                $this->outXML($xml);
            }

        }
        else {
            die('Hack error');
        }
    }

    protected function startBonusResult() {
        if(empty($_SESSION['fsPick'])) {
            $draw = gzuncompress(base64_decode($_SESSION['drawStates']));
            $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">'.$draw.'</EEGLoadResultsResponse>
</CompositeResponse>';

            $this->outXML($xml);
        }
        else {
            $this->slot = new Slot($this->gameParams, $_SESSION['report']['linesCount'], $_SESSION['report']['bet']);
            $this->slot->rows = 4;

            $this->getBonusResult();
            while($this->checkBankPayments(0, $this->bonus['bonusWin'] * 100)) {

                $this->getBonusResult();
            }

            $this->showBonusReport();

            $this->startPay();

            unset($_SESSION['report']);
            unset($_SESSION['fsPick']);
            $_SESSION['gameState'] = 'SPIN';
        }
    }

    protected function getBonusResult() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        switch($_SESSION['fsPick']) {
            case 'ape':
                $this->getApeData($_SESSION['report']);
                break;
            case 'roc':
                $this->getRocData($_SESSION['report']);
                break;
            case 'snake':
                $this->getSnakeData($_SESSION['report']);
                break;

        }
    }

    protected function getApeData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;
        $this->bonus['spins'] = 7;

        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,4,4,4,3));
        $this->slot->setWilds(array(3,17));
        $this->slot->drawID = 0;

        $wlCount = 0;
        $wlOffsets = array();
        $positions = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,16,17,18);

        $spins = 7;

        $apeConfig = $this->gameParams->apeConfig;

        $draws = '';

        while($spins > 0) {
            $wlNewCount = 0;
            if(rnd(0,100) <= $apeConfig['x1Percent']) {
                $wlNewCount = 1;
            }
            if(rnd(0,100) <= $apeConfig['x2Percent']) {
                $wlNewCount = 2;
            }
            $wlCount += $wlNewCount;

            while(count($wlOffsets) !== $wlCount) {
                $randPos = $positions[rnd(0, count($positions)-1)];
                if(!in_array($randPos, $wlOffsets)) {
                    $wlOffsets[] = $randPos;
                }
            }

            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'randomReplace',
                    'symbols' => array(0,1),
                    'replacement' => array(4,5,6,7,8,9,10,11,12,13),
                ),
                array(
                    'type' => 'symbolOnPosition',
                    'offsets' => $wlOffsets,
                    'symbol' => 'WL',
                ),
            ));

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $this->fsPays[] = array(
                'win' => $fsReport['totalWin'],
                'report' => $fsReport,
            );

            $bonus = '';
            if($wlNewCount > 0) {
                $bonus = '<Feature name="ape" no="'.$wlNewCount.'" />';
            }

            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'" replacement="'.implode(',', $fsReport['bonusData']['replaced']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'addString' => $addString,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'spins' => 7,
                'currentSpins' => 7,
                'reelset' => 1,
                'addString' => $addString,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;


            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }

    protected function getRocData($report) {
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
        $this->bonus['reelset'] = 2;

        $this->slot->createCustomReels($this->gameParams->reels[2], array(3,4,4,4,3));
        $this->slot->drawID = 0;

        while($spins > 0) {
            $currentReels = $this->bonus['reelset'];

            $this->bonus['ladder']['bonusSpins'] = 0;

            $fsReport = $this->slot->spin(array(
                'type' => 'randomReplace',
                'symbols' => array(0,1),
                'replacement' => array(4,5,6,7,8,9,10,11,12,13),
            ));

            if(!$this->bonus['ladder']['l3PD']) {
                $fsReport['diamonds'] = $this->slot->getSymbolAnyCount('DD');
                $this->checkLadderLevel($fsReport['diamonds']['count']);
                $bonus = '<Feature name="roc" count="'.$this->bonus['ladder']['ladderLevel'].'" />';
                if($fsReport['diamonds']['count'] > 0) {
                    $bonus .= '<Scatter offsets="'.implode(',', $fsReport['diamonds']['offsets']).'" prize="'.$fsReport['diamonds']['count'].'DD" length="'.$fsReport['diamonds']['count'].'" payout="0.00" />';
                }
            }
            else {
                $bonus = '<Feature name="roc" count="'.$this->bonus['ladder']['ladderLevel'].'" />';
            }

            $spins += $this->bonus['ladder']['bonusSpins'];
            $totalSpins += $this->bonus['ladder']['bonusSpins'];

            $this->bonus['bonusWin'] += $fsReport['totalWin'];
            $this->bonus['totalWin'] += $fsReport['totalWin'];

            $this->fsPays[] = array(
                'win' => $fsReport['totalWin'],
                'report' => $fsReport,
            );

            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'" replacement="'.implode(',', $fsReport['bonusData']['replaced']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'runningTotal' => $this->bonus['totalWin'],
                'reelset' => $currentReels,
                'spins' => '{{count}}',
                'display' => 'startRows',
                'currentSpins' => $totalSpins,
                'lastSpins' => $totalSpins,
                'bonus' => $bonus,
                'addString' => $addString,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;

            $spins--;
        }

        $draws = str_replace('{{count}}', $totalSpins, $draws);

        $this->bonus['spins'] = $totalSpins;
        $this->bonus['drawStates'] = $draws;
    }


    protected function checkLadderLevel($stickyCount) {
        $this->bonus['ladder']['ladderLevel'] += $stickyCount;
        $this->bonus['ladder']['bonusSpins'] = 0;
        if($this->bonus['ladder']['ladderLevel'] > 10 && !$this->bonus['ladder']['l3PD']) {
            $this->bonus['ladder']['level'] = 3;
            $this->bonus['ladder']['bonusSpins'] += 2;
            $this->slot->createCustomReels($this->gameParams->reels[3], array(3,4,4,4,3));
            $this->bonus['reelset'] = 3;
            $this->slot->setWilds(array(3,4,5,6));
            $this->bonus['ladder']['l3PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 6 && !$this->bonus['ladder']['l2PD']) {
            $this->bonus['ladder']['level'] = 2;
            $this->bonus['ladder']['bonusSpins'] += 2;
            $this->slot->setWilds(array(3,4,5));
            $this->bonus['ladder']['l2PD'] = true;
        }
        elseif($this->bonus['ladder']['ladderLevel'] > 2 && !$this->bonus['ladder']['l1PD']) {
            $this->bonus['ladder']['level'] = 1;
            $this->slot->setWilds(array(3,4));
            $this->bonus['ladder']['l1PD'] = true;
        }
    }

    protected function getSnakeData($report) {
        $this->bonus['totalWin'] = $report['totalWin'];
        $this->bonus['bonusWin'] = 0;
        $this->bonus['spins'] = 12;

        $this->slot->createCustomReels($this->gameParams->reels[4], array(3,4,4,4,3));
        $this->slot->setWilds(array(3,15,18));
        $this->slot->drawID = 0;

        $positions = array(1,2,3,6,7,8,11,12,13,16,17,18);

        $spins = 12;

        $draws = '';

        while($spins > 0) {

            $fsReport = $this->slot->spin(array(
                array(
                    'type' => 'randomReplace',
                    'symbols' => array(0,1),
                    'replacement' => array(4,5,6,7,8,9,10,11,12,13),
                ),
                array(
                    'type' => 'randomWildIfSymbolCount',
                    'offsets' => $positions,
                    'symbol' => 'SN',
                    'needleCount' => 2,
                    'wildConfig' => $this->gameParams->snakeConfig,
                ),
            ));

            $this->bonus['totalWin'] += $fsReport['totalWin'];
            $this->bonus['bonusWin'] += $fsReport['totalWin'];

            $this->fsPays[] = array(
                'win' => $fsReport['totalWin'],
                'report' => $fsReport,
            );

            $bonus = '';
            $sn = $this->slot->getSymbolAnyCount('SN');
            if($sn['count'] == 2) {
                $bonus = '<Scatter offsets="'.implode(',', $sn['offsets']).'" prize="2SN" length="2" payout="0.00" />';
            }

            $addString = ' display2="'.$this->gameParams->getDisplay($fsReport['rows']).'" replacement="'.implode(',', $fsReport['bonusData']['replaced']).'"';

            $winLines = $this->getWinLinesData($fsReport, array(
                'bonus' => $bonus,
                'addString' => $addString,
                'runningTotal' => $this->bonus['totalWin'],
                'display' => 'startRows',
                'spins' => 12,
                'currentSpins' => 12,
                'reelset' => 4,
                'addString' => $addString,
            ));

            $draw = '<DrawState drawId="'.$this->slot->drawID.'">'.$winLines.'<ReplayInfo foItems="'.$fsReport['stops'].'" /></DrawState>';

            $draws .= $draw;


            $spins--;
        }

        $this->bonus['drawStates'] = $draws;
    }



    protected function showBonusReport() {
        $report = $_SESSION['report'];

        $sr = $report['scattersReport'];
        $bonus = '<Scatter offsets="'.implode(',', $sr['offsets']).'" prize="'.$sr['count'].'BN" length="'.$sr['count'].'" payout="'.$sr['totalWin'].'" /><Feature name="freeSpin" type="'.$_SESSION['fsPick'].'" />';

        $addString = ' display2="'.$this->gameParams->getDisplay($report['rows']).'" replacement="'.implode(',', $report['bonusData']['replaced']).'"';

        $winLines = $this->getWinLinesData($report, array(
            'bonus' => $bonus,
            'runningTotal' => $report['totalWin'],
            'display' => 'startRows',
            'spins' => $this->bonus['spins'],
            'currentSpins' => $this->bonus['spins'],
            'addString' => $addString,
        ));

        $drawStates = '<DrawState drawId="0" state="settling">' . $winLines . '
                    <ReplayInfo foItems="'.$report['stops'].'"/>
                    <Bet seq="0" type="line" stake="'.$report['bet'].'" pick="L'.$report['linesCount'].'" payout="'.$this->bonus['totalWin'].'" won="true"/>
                </DrawState>'.$this->bonus['drawStates'];

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'">
    <EEGLoadResultsResponse gameId="'.$this->gameID.'">'.$drawStates.'</EEGLoadResultsResponse>
</CompositeResponse>';

        $_SESSION['drawStates'] = base64_encode(gzcompress($drawStates, 9));
        $_SESSION['bonusWIN'] += $this->bonus['bonusWin'];

        $this->outXML($xml);
    }

}