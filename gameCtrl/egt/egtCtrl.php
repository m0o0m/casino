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

    protected function getExpand($offsets) {
        if(!empty($offsets)) {
            $pos = array();
            foreach($offsets as $o) {
                $cr = $this->slot->getCeilRowByOffset($o);
                $pos[] = $cr['ceil'];
                $pos[] = $cr['row'];
            }

            return '"expand": ['.implode(',', $pos).'],';
        }
        else {
            return '"expand": [],';
        }
    }

}