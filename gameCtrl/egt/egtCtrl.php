<?

class egtCtrl extends Ctrl {

    public $sessionKey;
    public $messageId;
    public $gameIdentificationNumber;

    protected function processRequest($request) {
        $this->sessionKey = $request->sessionKey;
        $this->messageId = $request->messageId;
        if(isset($request->gameIdentificationNumber)) {
            $this->gameIdentificationNumber = $request->gameIdentificationNumber;
        }

        switch($request->command) {
            case 'login':
                $this->startLogin($request);
                break;
            case 'settings':
                $this->startSettings($request);
                break;
            case 'subscribe':
                $this->startSubscribe($request);
                break;
            case 'ping':
                $this->startPing($request);
                break;
            case 'bet':
                if($request->bet->gameCommand == 'bet') {
                    if($_SESSION['state'] == 'SPIN') {
                        $this->startSpin($request);
                    }
                    elseif($_SESSION['state'] == 'FREE') {
                        $this->startFreeSpin($request);
                    }

                }
                if($request->bet->gameCommand == 'collect') {
                    $this->startCollect($request);
                }
                if($request->bet->gameCommand == 'gamble') {
                    $this->startGamble($request);
                }
                break;
            case 'unsubscribe':
                echo 'off';
                break;
        }
    }

    protected  function getRequest() {
        $json = json_decode($_GET['json']);
        return $json;
    }

    protected function out($json) {
        echo $json;
    }

    protected function getDisplay() {
        $display = array();
        foreach($this->slot->reels as $r) {
            $display = array_merge($display, $r->getFullVisibleSymbols());
        }

        return '"reels": ['.implode(',', $display).'],';
    }

    protected function getDisplayByTmp() {
        $display = array();
        if(isset($this->slot->tmpReels)) {
            foreach($this->slot->tmpReels as $r) {
                $display = array_merge($display, $r->getFullVisibleSymbols());
            }
        }
        else {
            foreach($this->slot->reels as $r) {
                $display = array_merge($display, $r->getFullVisibleSymbols());
            }
        }


        return '"reels": ['.implode(',', $display).'],';
    }

    protected function getWinLinesData($report, $override = array()) {
        $winLines = '"lines": [';
        $linesArray = array();
        foreach($report['winLines'] as $w) {
            $lineWin = $report['betOnLine'] * $w['multiple'] * 100;
            $alias = $this->gameParams->getSymbolID($w['alias'])[0];
            $linesArray[] = '{
                "line": '.($w['id']-1).',
                "winAmount": '.$lineWin.',
                "cells": ['.$this->getLineHighlight($w).'],
                "card": '.$alias.'
            }';
        }
        $winLines .= implode(',', $linesArray);

        $winLines .= '],';

        return $winLines;
    }

    protected function getWinWaysData($report) {
        $combos = '"combos": [';

        $tmpArray = array();
        foreach($report['winLines'] as $w) {
            if(empty($tmpArray[$w['alias']])) {
                $tmpArray[$w['alias']] = array();
            }
            $tmpArray[$w['alias']][] = $w;
        }

        $resultArray = array();
        foreach($tmpArray as $s=>$a) {
            $resultArray[$s] = array(
                'symbol' => $s,
                'lenght' => 0,
                'count' => 0,
                'multiple' => 0,
                'totalMultiple' => 0,
                'offsets' => array(),
            );

            foreach($a as $w) {
                $resultArray[$s]['count']++;
                $resultArray[$s]['lenght'] = $w['count'];
                $resultArray[$s]['multiple'] = $w['multiple'];
                $resultArray[$s]['totalMultiple'] += $w['multiple'];
                $resultArray[$s]['offsets'] = array_merge($resultArray[$s]['offsets'], $w['line']);
            }
            $resultArray[$s]['offsets'] = array_unique($resultArray[$s]['offsets']);
        }

        $combosArray = array();

        foreach($resultArray as $k=>$v) {
            $pos = array();
            foreach($v['offsets'] as $o) {
                $ceilRow = $this->slot->getCeilRowByOffset($o);
                $pos[] = $ceilRow['ceil'];
                $pos[] = $ceilRow['row'];
            }

            $combosArray[] = '{
                "card": '.$v['symbol'].',
                "len": '.$v['lenght'].',
                "count": '.$v['count'].',
                "winPerCount": '.($v['multiple']*$report['betOnLine']*100).',
                "multiplier": '.$report['double'].',
                "winAmount": '.($v['totalMultiple']*$report['betOnLine']*100).',
                "cells": ['.implode(',', $pos).']
            }';
        }

        $combos .= implode(',', $combosArray);

        $combos .= '],';
        return $combos;
    }


    protected function getExpandSymbolLines($report) {
        $winLines = '"freeSpinsExpandLines": [';
        $linesArray = array();
        foreach($report['extraLines'] as $w) {
            $lineWin = $report['betOnLine'] * $w['multiple'] * 100;
            $alias = $this->gameParams->getSymbolID($w['alias'])[0];
            $pos = array();
            foreach($w['colNumber'] as $c) {
                $pos[] = $c;
                $pos[] = $w['line'][$c];
            }
            $linesArray[] = '{
                "line": '.($w['id']-1).',
                "winAmount": '.$lineWin.',
                "cells": ['.implode(',', $pos).'],
                "card": '.$alias.'
            }';
        }
        $winLines .= implode(',', $linesArray);

        $winLines .= '],';

        return $winLines;
    }

    protected function getLineHighlight($line) {
        $pos = array();
        for($i = 0; $i < $line['count']; $i++) {
            $pos[] = $i;
            $pos[] = $line['line'][$i];
        }
        return implode(',', $pos);
    }

    protected function getScatters($report, $name) {
        if($report['scattersReport']['totalWin'] <= 0) {
            $data = '"scatters": [],';
        }
        else {
            $pos = array();
            foreach($report['scattersReport']['offsets'] as $o) {
                $cr = $this->slot->getCeilRowByOffset($o);
                $pos[] = $cr['ceil'];
                $pos[] = $cr['row'];
            }

            $data = '"scatters": [{
            "scatterName": "'.$name.'",
            "cells": ['.implode(',', $pos).'],
            "winAmount": '.($report['scattersReport']['totalWin']*100).'
        }],';
        }

        return $data;
    }

    protected function getPaytable($multiple = 1, $scatters = 1) {
        $data = array();
        foreach($this->gameParams->winPay as $w) {
            if(!isset($data[$w['symbol']])) {
                $data[$w['symbol']] = array();
            }
            $data[$w['symbol']][] = $w['multiplier'] * $multiple;
            sort($data[$w['symbol']]);
        }

        if(!empty($this->gameParams->scatter)) {
            if(count($this->gameParams->scatter) == 1) {
                foreach($this->gameParams->scatterMultiple as $m) {
                    $data[$this->gameParams->scatter[0]][] = $m / $scatters;
                }
            }
            else {
                foreach($this->gameParams->scatter as $s) {
                    $data[$s] = array();
                    foreach($this->gameParams->scatterMultiple[$s] as $m) {
                        $data[$s][] = $m / $scatters;
                    }
                }
            }

        }

        $jsonStrings = array();
        foreach($data as $s=>$m) {
            $currentMultiplier = 1;
            if($this->gameParams->doubleIfWild) {
                $currentMultiplier = 2;
            }
            if(in_array($s, $this->gameParams->wild) || in_array($s, $this->gameParams->scatter)) {
                $currentMultiplier = 1;
            }
            $jsonStrings[] = '"'.$s.'": {
                "coef": ['.implode(',', $m).'],
                "multiplier": '.$currentMultiplier.'
            }';
        }

        $json = '"paytableCoef": {' . PHP_EOL . implode(',', $jsonStrings) . '},'.PHP_EOL;

        return $json;
    }

    protected function getMainReels() {
        $jsonStrings = array();
        if($this->gameParams->jackpotEnable) {
            $reels = $this->gameParams->reels[2];
        }
        else {
            $reels = $this->gameParams->reels[0];
        }

        foreach($reels as $r) {
            $jsonStrings[] = '['.implode(',', $r).']'.PHP_EOL;
        }

        $json = '"mainFakeReels": ['.PHP_EOL.implode(',', $jsonStrings).'],';

        return $json;
    }

    protected function getTimeStamp() {
        return round(microtime(true) * 1000);
    }

    protected function getRandomDisplay() {
        if(empty($this->slot)) {
            $this->slot = new Slot($this->gameParams, 1, 1);
        }

        $this->slot->spin();

        return $this->getDisplay();
    }

    protected function getExpand($offsets, $name = 'expand') {
        if(!empty($offsets)) {
            $pos = array();
            foreach($offsets as $o) {
                $cr = $this->slot->getCeilRowByOffset($o);
                $pos[] = $cr['ceil'];
                $pos[] = $cr['row'];
            }

            return '"'.$name.'": ['.implode(',', $pos).'],';
        }
        else {
            return '"'.$name.'": [],';
        }
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
        //$rndCard = 0;

        $unset = false;

        if( ($color == 0 && ($rndCard == 1 || $rndCard == 2)) || ($color == 1 && ($rndCard == 0 || $rndCard == 3))) {
            $state = 'gamble';
            $_SESSION['gambles']--;
            $_SESSION['lastWin'] *= 2;
            if($_SESSION['lastWin'] > $_SESSION['lastBet'] * 35 || $_SESSION['gambles'] == 0) {


                $report = unserialize(gzuncompress(base64_decode($_SESSION['report'])));
                $this->bonusPays[] = array(
                    'win' => $_SESSION['lastWin'],
                    'report' => $report,
                );
                $this->startPay();

                $state = 'idle';
                $_SESSION['gambles'] = 0;
                $_SESSION['state'] = 'SPIN';
                $unset = true;
                unset($_SESSION['report']);
                unset($_SESSION['reels']);

            }
        }
        else {
            $state = 'idle';
            $_SESSION['gambles'] = 0;
            $_SESSION['lastWin'] = 0;
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['report']);
            unset($_SESSION['reels']);
        }

        $balance = $this->getBalance() * 100;

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
    "balance": '.$balance.',
    "sessionKey": "'.$this->sessionKey.'",
    "msg": "success",
    "messageId": "'.$this->messageId.'",
    "qName": "app.services.messages.response.GameEventResponse",
    "command": "bet",
    "eventTimestamp": '.$this->getTimeStamp().'
}';

        $this->out($json);

        if($unset) {
            $_SESSION['lastWin'] = 0;
        }
    }

}