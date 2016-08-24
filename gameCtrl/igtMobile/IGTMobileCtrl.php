<?

require_once('gameCtrl/igt/IGTCtrl.php');

class IGTMobileCtrl extends IGTCtrl {

    protected function processRequest($request) {

        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            $this->outJSON('{}');
            die();
        }

        $action = $_GET['action'];

        switch($action) {
            case 'authenticate':
                $this->startAuthenticate($request);
                break;
            case 'paytable':
                $this->startPaytable($request);
                break;
            case 'initstate':
                $this->startInit($request);
                break;
            case 'play':
                if(!empty($_SESSION['state'])) {
                    if($_SESSION['state'] == 'SPIN') {
                        $this->startSpin($request);
                    }
                    elseif($_SESSION['state'] == 'FREE') {
                        $this->startFreeSpin($request);
                    }
                    elseif($_SESSION['state'] == 'PICK') {
                        $this->startPick($request);
                    }
                    elseif($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'SPIN') {
                        $this->startTumble($request);
                    }
                    elseif($_SESSION['state'] == 'TUMBLE' && $_SESSION['preState'] == 'FREE') {
                        $this->startTumbleFree($request);
                    }
                }
                else {
                    $this->startSpin($request);
                }

                break;
        }
    }

    protected  function getRequest() {
        return (array) json_decode($this->api->getRequestBody(), true);
    }

    protected function startAuthenticate($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $json = '{"ReturnStatus":{"Code":"1000000","Message":"","Debug":""},"Authentication":{"Status":"Success"}}';

        $this->outJSON($json);
    }

    protected function getDenomination() {
        $tDenom = array();
        foreach($this->gameParams->denominations as $d) {
            $tDenom[] = '"'.$d.'"';
        }

        return implode(', ', $tDenom);
    }

    protected function getStripInfo($reelsNumber) {
        $reels = $this->gameParams->reels[$reelsNumber];

        $reelsArray = array();

        for($i = 0; $i < count($reels); $i++) {
            $r = $reels[$i];
            $reel = new ArrayObject();
            $reel['@name'] = 'Reel'.$i;
            $tmp = array();
            foreach($r as $id) {
                $tmp[] = $this->gameParams->getSymbolByID(array($id));
            }

            $reel['#text'] = implode(',', $tmp);

            $reelsArray[] = $reel;
        }

        return json_encode($reelsArray);
    }

    protected function getDisplay($report, $full = false, $name = 'BaseGame', $afterName = 'Reels', $startRows = false) {

        $symbols = array();


        $addCount = 0;
        $rows = 'rows';
        if($full) {
            $addCount = 2;
            $rows = 'fullRows';
        }
        if($startRows === true) {
            $rows = 'startRows';
        }
        if($startRows !== true && $startRows !== false) {
            $rows = $startRows;
        }
        for($i = 0; $i < count($this->gameParams->reelConfig); $i++) {
            for($j = 0; $j < $this->gameParams->reelConfig[$i] + $addCount; $j++) {
                $elem = array_shift($report[$rows][$j + 1]);
                $symbol = $this->gameParams->getSymbolByID(array($elem));
                $symbols[] = $symbol;
            }
        }

        return implode(',', $symbols);
    }

    protected function getWinLines($report, $name = 'BaseGame') {
        $prizes = array();
        $totalPay = 0;
        foreach($report['winLines'] as $w) {
            if($w['type'] == 'line') {
                $payout = $report['betOnLine'] * $w['multiple'];
                $totalPay += $payout;
                $pay = $payout / $this->slot->double;

                $prize = new ArrayObject();
                $prize['@betMultiplier'] = 1;
                $prize['@multiplier'] = $this->slot->double;
                $prize['@name'] = 'Line ' . $w['id'];
                $prize['@pay'] = $pay;
                $prize['@payName'] = $w['count'] . ' ' . $w['alias'];
                $prize['@position'] = 0;
                $prize['@symbolCount'] = $w['count'];
                $prize['@totalPay'] = $payout;
                $prize['@ways'] = 0;

                $prizes[] = $prize;
            }

        }

        $json = '{
            "@multiplier": "1",
            "@name": "'.$name.'.Lines",
            "@pay": "'.$totalPay.'",
            "@stage": "",
            "@totalPay": "'.$totalPay.'",
            "@type": "Pattern",
            "Prize": '.json_encode($prizes).'
        }';

        return $json;
    }

    protected function getLeftWayWinLines($report, $name = 'BaseGame', $afterName = 'LeftRightMultiWay') {
        $leftLines = array();
        $totalPay = 0;
        $prizes = array();

        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'left' && $w['type'] == 'ways') {
                $leftLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(!empty($leftLines)) {
            $aliasArray = array();
            $resultArray = array();

            foreach($leftLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'totalPay' => 0,
                        'withWild' => 0,
                        'withoutWild' => 0,
                    );
                    if($this->gameParams->doubleIfWild) {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'] / $w['double'];
                    }
                    else {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'];
                    }

                }
            }

            foreach($aliasArray as $a) {
                foreach($leftLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        if($w['withWild']) {
                            $resultArray[$a]['withWild']++;
                        }
                        else {
                            $resultArray[$a]['withoutWild']++;
                        }
                        $resultArray[$a]['totalPay'] += $report['betOnLine']*$w['multiple'];
                    }
                }
            }

            foreach($resultArray as $r) {
                if($this->gameParams->doubleIfWild) {
                    $r['ways'] = $r['withWild'] * 2 + $r['withoutWild'];
                }
                else {
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                $payname = $r['count'].' '.$r['alias'];

                $prize = new ArrayObject();
                $prize['@betMultiplier'] = 1;
                $prize['@multiplier'] = $this->slot->double;
                $prize['@name'] = $payname;
                $prize['@pay'] = $r['wayPay'];
                $prize['@payName'] = $payname;
                $prize['@position'] = 0;
                $prize['@symbolCount'] = $r['count'];
                $prize['@totalPay'] = $r['totalPay'];
                $prize['@ways'] = $r['ways'];

                $prizes[] = $prize;

            }
        }

        $json = '{
            "@multiplier": "1",
            "@name": "'.$name.'.'.$afterName.'",
            "@pay": "'.$totalPay.'",
            "@stage": "",
            "@totalPay": "'.$totalPay.'",
            "@type": "Pattern",
            "Prize": '.json_encode($prizes).'
        }';

        return $json;
    }

    protected function getRightWayWinLines($report, $name = 'BaseGame', $afterName = 'RightLeftMultiWay') {
        $rightLines = array();
        $totalPay = 0;
        $prizes = array();

        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'right' && $w['type'] == 'ways') {
                $rightLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(!empty($rightLines)) {
            $aliasArray = array();
            $resultArray = array();

            foreach($rightLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'totalPay' => 0,
                        'withWild' => 0,
                        'withoutWild' => 0,
                    );
                    if($this->gameParams->doubleIfWild) {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'] / $w['double'];
                    }
                    else {
                        $resultArray[$w['alias']]['wayPay'] = $report['betOnLine']*$w['multiple'];
                    }

                }
            }

            foreach($aliasArray as $a) {
                foreach($rightLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        if($w['withWild']) {
                            $resultArray[$a]['withWild']++;
                        }
                        else {
                            $resultArray[$a]['withoutWild']++;
                        }
                        $resultArray[$a]['totalPay'] += $report['betOnLine']*$w['multiple'];
                    }
                }
            }

            foreach($resultArray as $r) {
                if($this->gameParams->doubleIfWild) {
                    $r['ways'] = $r['withWild'] * 2 + $r['withoutWild'];
                }
                else {
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                $payname = $r['count'].' '.$r['alias'];

                $prize = new ArrayObject();
                $prize['@betMultiplier'] = 1;
                $prize['@multiplier'] = $this->slot->double;
                $prize['@name'] = $payname;
                $prize['@pay'] = $r['wayPay'];
                $prize['@payName'] = $payname;
                $prize['@position'] = 0;
                $prize['@symbolCount'] = $r['count'];
                $prize['@totalPay'] = $r['totalPay'];
                $prize['@ways'] = $r['ways'];

                $prizes[] = $prize;

            }
        }

        $json = '{
            "@multiplier": "1",
            "@name": "'.$name.'.'.$afterName.'",
            "@pay": "'.$totalPay.'",
            "@stage": "",
            "@totalPay": "'.$totalPay.'",
            "@type": "Pattern",
            "Prize": '.json_encode($prizes).'
        }';

        return $json;
    }

    protected function getHighlight($winLines, $name = 'BaseGame.Lines', $inc = 0, $type = '') {
        $prize = array();
        $reelsCount = $this->slot->getReelsCount() - 1;

        foreach($winLines as $w) {
            $resultType = $type;
            $symbolsArray = array();
            if($w['type'] == 'line') {
                    for($i = 0; $i < count($w['useSymbols']); $i++) {
                        $ceil = $i;
                        if($w['direction'] == 'right') {
                            $ceil = $reelsCount - $i;
                        }
                        $row = $w['line'][$ceil] + $inc;

                        if($this->gameParams->doubleCount) {
                            $symbol = $w['useSymbols'][$i];
                            $mainSymbolID = $w['symbol'][0];

                            if(isset($this->gameParams->doubleCountConfig[$symbol])) {
                                foreach($this->gameParams->doubleCountConfig[$symbol] as $j) {
                                    if($j == $mainSymbolID) {
                                        $resultType = 2;
                                    }
                                }
                            }
                        }

                        $symbolsArray[] = 'L0C'.$ceil.'R'.$row;
                    }

                    $line = new ArrayObject();
                    $line['@name'] = 'Line '.$w['id'];
                    $line['@type'] = $resultType;
                    $line['#text'] = implode(',', $symbolsArray);

                    $prize[] = $line;
            }
        }

        $json = '{
            "@name": "'.$name.'",
            "@type": "",
            "Highlight": '.json_encode($prize).'
        }';

        return $json;
    }

    protected function getWaysLeftHighlight($winLines, $name = 'BaseGame', $afterName = 'LeftRightMultiWay') {
        $leftLines = array();
        $prize = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'left' && $w['type'] == 'ways') {
                $leftLines[] = $w;
            }
        }

        if(!empty($leftLines)) {
            $aliasArray = array();
            $resultArray = array();
            foreach($leftLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'offsets' => array(),
                    );
                }
            }

            foreach($aliasArray as $a) {
                foreach($leftLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        $resultArray[$a]['offsets'] = array_unique($resultArray[$a]['offsets']);
                    }
                }
            }
            $reelsCount = count($this->gameParams->reelConfig);

            foreach($resultArray as $r) {
                $symbolsArray = array();
                $cnt = 0;
                foreach($r['offsets'] as $o) {
                    $row = floor($o / $reelsCount);
                    $ceil = $o % $reelsCount;
                    $cnt++;
                    $symbolsArray[] = 'L0C'.$ceil.'R'.$row;
                }

                $line = new ArrayObject();
                $line['@name'] = $r['count'].' '.$r['alias'];
                $line['@type'] = '';
                $line['#text'] = implode(',', $symbolsArray);

                $prize[] = $line;
            }


        }



        $json = '{
            "@name": "'.$name.'.'.$afterName.'",
            "@type": "",
            "Highlight": '.json_encode($prize).'
        }';

        return $json;
    }

    protected function getWaysRightHighlight($winLines, $name = 'BaseGame', $afterName = 'RightLeftMultiWay') {
        $rightLines = array();
        $prize = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'right' && $w['type'] == 'ways') {
                $rightLines[] = $w;
            }
        }

        if(!empty($rightLines)) {
            $aliasArray = array();
            $resultArray = array();
            foreach($rightLines as $w) {
                if(!in_array($w['alias'], $aliasArray)) {
                    $aliasArray[] = $w['alias'];
                    $resultArray[$w['alias']] = array(
                        'count' => $w['count'],
                        'alias' => $w['alias'],
                        'offsets' => array(),
                    );
                }
            }

            foreach($aliasArray as $a) {
                foreach($rightLines as $w) {
                    if($w['alias'] == $a) {
                        foreach($w['line'] as $l) {
                            $resultArray[$a]['offsets'][] = $l;
                        }
                        $resultArray[$a]['offsets'] = array_unique($resultArray[$a]['offsets']);
                    }
                }
            }
            $reelsCount = count($this->gameParams->reelConfig);

            foreach($resultArray as $r) {
                $symbolsArray = array();
                $cnt = 0;
                foreach($r['offsets'] as $o) {
                    $row = floor($o / $reelsCount);
                    $ceil = $o % $reelsCount;
                    $cnt++;
                    $symbolsArray[] = 'L0C'.$ceil.'R'.$row;
                }

                $line = new ArrayObject();
                $line['@name'] = $r['count'].' '.$r['alias'];
                $line['@type'] = '';
                $line['#text'] = implode(',', $symbolsArray);

                $prize[] = $line;
            }
        }



        $json = '{
            "@name": "'.$name.'.'.$afterName.'",
            "@type": "",
            "Highlight": '.json_encode($prize).'
        }';

        return $json;
    }



    protected function getScattersPay($scattersReport, $name = 'BaseGame.Scatter', $symbol = 'b01', $show = false) {
        $totalWin = 0;
        if(!empty($scattersReport['totalWin']) || $show) {
            $totalWin = $scattersReport['totalWin'];
            $pay = $scattersReport['totalWin'];
            $cnt = $scattersReport['count'];
            $json = '{
            "@multiplier": "1",
            "@name": "'.$name.'",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "Pattern",
            "Prize": {
                "@betMultiplier": "'.$this->slot->betOnLine.'",
                "@multiplier": "1",
                "@name": "Scatter",
                "@pay": "'.$pay.'",
                "@payName": "'.$cnt.' '.$symbol.'",
                "@position": "0",
                "@symbolCount": "'.$cnt.'",
                "@totalPay": "'.$totalWin.'",
                "@ways": "0"
            }
        }';
        }
        else {
            $json = '{
            "@multiplier": "1",
            "@name": "'.$name.'",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "Pattern"
            }';
        }

        return $json;
    }

    protected function getScattersHighlight($scattersReport, $name = 'BaseGame.Scatter', $inc = 0, $onlyIfWin = false) {
        $symbols = array();
        $type = '';

        $highlight = '';

        if(isset($scattersReport['totalWin'])) {
            foreach($scattersReport['offsets'] as $o) {
                if($this->gameParams->doubleCount) {
                    $symbol = $this->slot->getSymbolByOffset($o);
                    if(in_array($symbol, $this->gameParams->doubleCountScatter)) {
                        //$type = 2;
                    }
                }
                $c = ($o % 5);
                $r = floor($o / 5) + $inc;
                $symbols[] = 'L0C'.$c.'R'.$r;
            }

            $highlight = ', "Highlight": {
                "@name": "Scatter",
                "@type": "",
                "#text": "'.implode(',', $symbols).'"
            }';
        }

        if($onlyIfWin && $scattersReport['totalWin'] == 0) {
            $highlight = '';
        }

        $json = '{
            "@name": "'.$name.'",
            "@type": "'.$type.'"'.$highlight.'

        }';

        return $json;
    }


}