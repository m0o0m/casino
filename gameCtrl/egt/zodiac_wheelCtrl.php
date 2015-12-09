<?
require_once('egtCtrl.php');

class zodiac_wheelCtrl extends egtCtrl {

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
        "ZWJSlot": [{
            "gameIdentificationNumber": 807,
            "recovery": "norecovery",
            "gameName": "Zodiac Wheel",
            "featured": false,
            "mlmJackpot": true,
            "totalBet": 0,
            "groups": [{
                "name": "all",
                "order": 6
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

    public function startSettings($request) {
        $paytable = $this->getPaytable();
        $reels = $this->getMainReels();

        $json = '{
    "complex": {
        '.$paytable.'
        "rtp": "96.44",
        "bets": ['.implode(',', $this->gameParams->denominations).'],
        "jackpotMinBet": 1,
        "jackpot": false,
        '.$reels.'
        "jackpotMaxBet": 100000,
        "denominations": [
            [100, 70, 3000000]
        ]
    },
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": -1,
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameResponse",
    "command": "settings",
    "eventTimestamp": '.$this->getTimeStamp().'
}';
        $this->out($json);
    }

    public function startSubscribe($request) {
        $state = '';

        $this->slot = new Slot($this->gameParams, 1, 1);
        $this->slot->createCustomReels($this->gameParams->reels[0], $this->gameParams->reelConfig);
        $this->slot->rows = 4;

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
            "previousGambles": ['.implode(',', $_SESSION['gambleCards']).'],
            "bet": 100,
            "numberOfLines": '.count($this->gameParams->winLines).',
            "denomination": 100,
            "state": "'.$state.'",
            "winAmount": '.$winAmount.',
            '.$reelsLinesScatters.'
            "expand": [],
            "gambles": '.$_SESSION['gambles'].',
            "jackpot": false
        }
    },
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": -1,
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "subscribe",
    "eventTimestamp": '.$this->getTimeStamp().'
}';


        $this->out($json);
    }

    public function startPing($request) {
        $json = '{
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.BaseResponse",
    "command": "ping",
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

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $bonus = array(
            'type' => 'expandWildIfLines',
            'symbol' => 8,
        );

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $sr1 = $this->slot->getSymbolAnyCount($this->gameParams->scatter[0]);
        $sr2 = $this->slot->getSymbolAnyCount($this->gameParams->scatter[1]);
        $report['scattersReport'] = array();
        $report['scattersReport']['totalWin'] = 0;
        $report['scattersReport']['alias'] = '';

        if(!empty($this->gameParams->scatterMultiple[$this->gameParams->scatter[0]][$sr1['count']])) {
            $report['scattersReport']['offsets'] = $sr1['offsets'];
            $report['scattersReport']['count'] = $sr1['count'];
            $report['scattersReport']['alias'] = $this->gameParams->scatter[0];

            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$this->gameParams->scatter[0]][$sr1['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        if(!empty($this->gameParams->scatterMultiple[$this->gameParams->scatter[1]][$sr2['count']])) {
            $report['scattersReport']['offsets'] = $sr2['offsets'];
            $report['scattersReport']['count'] = $sr2['count'];
            $report['scattersReport']['alias'] = $this->gameParams->scatter[1];

            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$this->gameParams->scatter[1]][$sr2['count']];
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    public function showSpinReport($report, $totalWin) {
        $this->spinPays[] = array(
            'win' => 0,
            'report' => $report,
        );
        $this->startPay();

        $display = $this->getDisplayByTmp();
        $winLines = $this->getWinLinesData($report);
        $balance = $this->getBalance() * 100;
        $scatters = $this->getScatters($report, $report['scattersReport']['alias']);

        $expandOffsets = array();
        foreach($report['bonusData'] as $b) {
            $expandOffsets = array_merge($expandOffsets, $b['expandOffsets']);
        }
        $expand = $this->getExpand($expandOffsets);

        $state = 'idle';
        $_SESSION['gambles'] = 0;
        if($report['totalWin'] > 0) {
            $state = 'gamble';
            $_SESSION['gambles'] = 5;
            $_SESSION['report'] = base64_encode(gzcompress(serialize($report), 9));
            $_SESSION['reels'] = $display;
            $_SESSION['state'] = 'GAMBLE';
        }

        $json = '{
    "complex": {
        '.$display.$winLines.$scatters.$expand.'
        "gambles": '.$_SESSION['gambles'].',
        "freespins": 0,
        "jackpot": false,
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

    public function startCollect($request) {
        if($_SESSION['lastWin'] <= 0) {
            die('error');
        }

        $report = unserialize(gzuncompress(base64_decode($_SESSION['report'])));

        $report['type'] = 'collect';
        $this->bonusPays[] = array(
            'win' => $_SESSION['lastWin'],
            'report' => $report,
        );
        $this->startPay();

        $balance = $this->getBalance() * 100;

        $json = '{
    "complex": {
        "gameCommand": "collect"
    },
    "state": "idle",
    "winAmount": '.($_SESSION['lastWin']*100).',
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1272723877896,
    "balance": '.$balance.',
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $_SESSION['gambles'] = 0;
        $_SESSION['lastWin'] = 0;
        $_SESSION['state'] = 'SPIN';

        $this->out($json);

        $_SESSION['report'] = base64_encode(gzcompress(serialize($report), 9));
    }

    protected function startGamble($request) {
        if($_SESSION['gambles'] <= 0) {
            die('error');
        }
        if($_SESSION['lastWin'] > $_SESSION['lastBet'] * 35) {
            die('error');
        }

        $color = $request->bet->color;
        $rndCard = rnd(0,3);

        if( ($color == 0 && ($rndCard == 1 || $rndCard == 2)) || ($color == 1 && ($rndCard == 0 || $rndCard == 3))) {
            $state = 'gamble';
            $_SESSION['gambles']--;
            $_SESSION['lastWin'] *= 2;
        }
        else {
            $state = 'idle';
            $_SESSION['gambles'] = 0;
            $_SESSION['lastWin'] = 0;
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['report']);
            unset($_SESSION['reels']);
        }

        array_push($_SESSION['gambleCards'], $rndCard);

        $json = '{
    "complex": {
        "gambles": '.$_SESSION['gambles'].',
        "card": '.$rndCard.',
        "jackpot": false,
        "gameCommand": "gamble"
    },
    "state": "'.$state.'",
    "winAmount": '.($_SESSION['lastWin']*100).',
    "gameIdentificationNumber": '.$this->gameIdentificationNumber.',
    "gameNumber": 1304901365810,
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $this->out($json);
    }

}