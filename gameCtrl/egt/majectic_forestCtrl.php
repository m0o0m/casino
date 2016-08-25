<?
require_once('egtCtrl.php');

class majectic_forestCtrl extends egtCtrl {

    public function startLogin($request) {
        $this->setSessionIfEmpty('gambles', 0);
        $this->setSessionIfEmpty('state', 'SPIN');
        $this->setSessionIfEmpty('gambleCards', array());

        $balance = $this->getBalance() * 100;

        if($_SESSION['state'] == 'FREE') {
            $balance -= $_SESSION['fsTotalWin'] * 100;
        }

        $json = '{
    "playerName": "igambler1515",
    "balance": '.$balance.',
    "currency": "'.$this->gameParams->curiso.'",
    "languages": ["en","ru"],
    "groups": ["all"],
    "showRtp": false,
    "multigame": true,
    "autoplayLimit": 0,
    "complex": {
        "MFJSlot": [{
            "gameIdentificationNumber": 830,
            "recovery": "norecovery",
            "gameName": "Majestic Forest",
            "featured": false,
            "mlmJackpot": false,
            "totalBet": 0,
            "groups": [{
                "name": "all",
                "order": 39
            }]
        }]
    },
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.LoginResponse",
    "command": "login",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $this->out($json);
    }

    public function startSubscribe($request) {
        $state = '';

        $this->slot = new Slot($this->gameParams, 1, 1);

        $add = '';
        if($_SESSION['state'] == 'SPIN') {
            $state = 'idle';
            $winAmount = 0;
            $fsUsed = 0;
            $gamblesUsed = 0;
            $totalFs = 0;
            $reelsLinesScatters = $this->getRandomDisplay().'
            "lines": [],
            "scatters": [],';
        }
        elseif($_SESSION['state'] == 'FREE') {
            $state = 'freespin';
            $winAmount = $_SESSION['fsTotalWin'] * 100;
            $fsUsed = $_SESSION['fsPlayed'];
            $gamblesUsed = 0;
            $totalFs = $_SESSION['fsLeft'];

            $report = unserialize(gzuncompress(base64_decode($_SESSION['report'])));
            $reelsLinesScatters = $_SESSION['reels'].$this->getWinLinesData($report).$this->getScatters($report, $this->gameParams->scatter[0]);
            $add = '"freeSpinsExpandSymbol": '.$_SESSION['fsExpandSymbol'].',';
        }
        elseif($_SESSION['state'] == 'GAMBLE') {
            $state = 'gamble';
            $winAmount = $_SESSION['lastWin'] * 100;
            $fsUsed = 0;
            $gamblesUsed = 5 - $_SESSION['gambles'] + 1;
            $totalFs = 0;

            $report = unserialize(gzuncompress(base64_decode($_SESSION['report'])));
            $reelsLinesScatters = $_SESSION['reels'].$this->getWinLinesData($report).$this->getScatters($report, $this->gameParams->scatter[0]);
        }

        $json = '{
    "complex": {
        "currentState": {
            "gamblesUsed": '.$gamblesUsed.',
            "freespinsUsed": '.$fsUsed.',
            "previousGambles": ['.implode(',', $_SESSION['gambleCards']).'],
            "bet": 100,
            "numberOfLines": '.count($this->gameParams->winLines).',
            "denomination": 100,
            "state": "'.$state.'",
            "winAmount": '.$winAmount.',
            "firstSpin": {
                '.$reelsLinesScatters.'
                "expand": []
            },
            '.$reelsLinesScatters.'
            "expand": [],
            "gambles": '.$_SESSION['gambles'].',
            "freespins": '.$totalFs.',
            '.$add.'
            "jackpot": false
        }
    },
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1272704999439,
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "subscribe",
    "eventTimestamp": '.$this->getTimeStamp().'
}';


        $this->out($json);
    }

    protected function startSpin($request) {
        $_SESSION['state'] = 'SPIN';
        $pick = $request->bet->lines;
        $betPerLine = $request->bet->bet / 100;
        $stake = $pick * $betPerLine;


        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        if($this->gameParams->jackpotEnable) {
            $this->slot->createCustomReels($this->gameParams->reels[2], $this->gameParams->reelConfig);
        }
        else {
            $this->slot->createCustomReels($this->gameParams->reels[0], $this->gameParams->reelConfig);
        }

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
    }

    protected function startFreeSpin($request) {
        $pick = $_SESSION['lastPick'];
        $stake = $_SESSION['lastBet'];

        $balance = $this->getBalance();
        if($balance < 0) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        if($this->gameParams->jackpotEnable) {
            $this->slot->createCustomReels($this->gameParams->reels[3], $this->gameParams->reelConfig);
        }
        else {
            $this->slot->createCustomReels($this->gameParams->reels[1], $this->gameParams->reelConfig);
        }

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while($this->checkBankPayments($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['totalWin'],
            'report' => $spinData['report'],
        );
        $this->startPay();

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array();

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        if($_SESSION['state'] == 'SPIN') {
            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $report['spinWin'] += $report['scattersReport']['totalWin'];
                if($report['scattersReport']['count'] > 2) {
                    $report['type'] = 'FREE';
                    $_SESSION['state'] = 'FREE';
                }
            }
            else {
                $report['scattersReport']['totalWin'] = 0;
            }
        }
        else {
            $report['scattersReport'] = $this->slot->getScattersCount();
            if(!empty($this->gameParams->scatterMultiple[$report['scattersReport']['count']])) {
                $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
                $report['totalWin'] += $report['scattersReport']['totalWin'];
                $report['spinWin'] += $report['scattersReport']['totalWin'];

                $_SESSION['fsLeft'] += 12;
            }
            else {
                $report['scattersReport']['totalWin'] = 0;
            }

            $extraLinesReport = $this->slot->getExpandLines($_SESSION['fsExpandSymbol']);
            $report['extraLines'] = $extraLinesReport['winLines'];
            $report['extraLinesWin'] = $extraLinesReport['totalMultiple'] * $report['betOnLine'];
            $report['totalWin'] += $report['extraLinesWin'];
            $report['spinWin'] += $report['extraLinesWin'];
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    public function showSpinReport($report, $totalWin) {
        if($report['totalWin'] >= $report['bet'] * 35) {
            $this->spinPays[] = array(
                'win' => $report['totalWin'],
                'report' => $report,
            );
        }
        else {
            $this->spinPays[] = array(
                'win' => 0,
                'report' => $report,
            );

        }
        $this->startPay();

        $display = $this->getDisplay();
        $winLines = $this->getWinLinesData($report);
        $balance = $this->getBalance() * 100;
        $scatters = $this->getScatters($report, $this->gameParams->scatter[0]);

        $state = 'idle';
        $_SESSION['gambles'] = 0;
        if($report['totalWin'] > 0 && $report['totalWin'] < $report['bet'] * 35) {
            $state = 'gamble';
            $_SESSION['gambles'] = 5;
            $_SESSION['report'] = base64_encode(gzcompress(serialize(array(
                'winLines' => $report['winLines'],
                'reels' => $report['reels'],
                'type' => $report['type'],
                'bet' => $report['bet'],
                'betOnLine' => $report['betOnLine'],
                'linesCount' => $report['linesCount'],
                'scattersReport' => $report['scattersReport'],
            )), 9));
            $_SESSION['reels'] = $display;
            $_SESSION['state'] = 'GAMBLE';
        }

        $json = '{
    "complex": {
        '.$display.$winLines.$scatters.'
        "expand": [],
        "gambles": '.$_SESSION['gambles'].',
        "freespins": 0,
        "jackpot": false,
        "freeSpinsExpandSymbol": -1,
        "freeSpinsExpandLines": [],
        "freeSpinsExpandWinAmount": 0,
        "gameCommand": "bet"
    },
    "state": "'.$state.'",
    "winAmount": '.($report['totalWin']*100).',
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1303752974352,
    "balance": '.$balance.',
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $_SESSION['lastWin'] = $report['totalWin'];

        $this->out($json);
    }

    public function showStartFreeSpinReport($report, $totalWin) {
        $display = $this->getDisplay();
        $winLines = $this->getWinLinesData($report);
        $balance = $this->getBalance() * 100 - $report['bet'] * 100;
        $scatters = $this->getScatters($report, $this->gameParams->scatter[0]);

        $_SESSION['fsExpandSymbol'] = rnd(0,8);

        $json = '{
    "complex": {
        '.$display.$winLines.$scatters.'
        "expand": [],
        "gambles": 0,
        "freespins": 12,
        "freespinScatters": ['.$this->gameParams->scatter[0].'],
        "jackpot": false,
        "freeSpinsExpandSymbol": '.$_SESSION['fsExpandSymbol'].',
        "freeSpinsExpandLines": [],
        "freeSpinsExpandWinAmount": 0,
        "gameCommand": "bet"
    },
    "state": "freespin",
    "winAmount": '.($report['totalWin']*100).',
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1304913358885,
    "balance": '.$balance.',
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $_SESSION['fsLeft'] = 10;
        $_SESSION['fsPlayed'] = 0;
        $_SESSION['fsTotalWin'] = $report['totalWin'];
        $_SESSION['report'] = base64_encode(gzcompress(serialize(array(
            'winLines' => $report['winLines'],
            'reels' => $report['reels'],
            'type' => $report['type'],
            'bet' => $report['bet'],
            'betOnLine' => $report['betOnLine'],
            'linesCount' => $report['linesCount'],
            'scattersReport' => $report['scattersReport'],
        )), 9));
        $_SESSION['reels'] = $display;

        $this->spinPays[] = array(
            'win' => $report['totalWin'],
            'report' => $report,
        );
        $this->startPay();

        $this->out($json);
    }

    public function showPlayFreeSpinReport($report, $totalWin) {
        $display = $this->getDisplayByTmp();
        $winLines = $this->getWinLinesData($report);
        $scatters = $this->getScatters($report, $this->gameParams->scatter[0]);


        $expandLines = $this->getExpandSymbolLines($report);

        $_SESSION['fsTotalWin'] += $report['totalWin'];
        $_SESSION['fsLeft']--;
        $_SESSION['fsPlayed']++;

        $state = 'freespin';
        $balance = '';
        if($_SESSION['fsLeft'] <= 0) {
            $state = 'idle';
            $balance = '"balance": '.($this->getBalance() * 100).',';
        }
        $bonusSpins = 0;
        if($report['scattersReport']['count'] > 2) {
            $bonusSpins = 12;
        }

        $json = '{
    "complex": {
        '.$display.$winLines.$scatters.'
        "expand": [],
        "gambles": 0,
        "freespins": '.$bonusSpins.',
        "jackpot": false,
        "freeSpinsExpandSymbol": '.$_SESSION['fsExpandSymbol'].',
        '.$expandLines.'
        "freeSpinsExpandWinAmount": '.($report['extraLinesWin']*100).',
        "gameCommand": "bet"
    },
    "state": "'.$state.'",
    "winAmount": '.($_SESSION['fsTotalWin']*100).',
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1304913358885,
    '.$balance.'
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        if($_SESSION['fsLeft'] <= 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['report']);
            unset($_SESSION['reels']);
        }

        $this->out($json);
    }

}