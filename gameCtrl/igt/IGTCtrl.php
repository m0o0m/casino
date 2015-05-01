<?

class IGTCtrl extends Ctrl {
    protected function processRequest($request) {
        //$action = $_GET['action'];
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, 'clientconfig') > 0) $action = 'config';
        if(strpos($uri, 'initstate') > 0) $action = 'init';
        if(strpos($uri, 'paytable') > 0) $action = 'paytable';
        if(strpos($uri, 'play') > 0) $action = 'spin';

        /*
        echo '<pre>';
        $request = (array) simplexml_load_string('<GameLogicRequest>
  <TransactionId>R1540-14228693316850</TransactionId>
  <ActionInput>
    <Action>play</Action>
  </ActionInput>
  <PatternSliderInput>
    <BetPerPattern>1</BetPerPattern>
    <PatternsBet>40</PatternsBet>
  </PatternSliderInput>
</GameLogicRequest>');
        $action = 'spin';
        */



        switch($action) {
            case 'config':
                $this->startConfig($request);
                break;
            case 'paytable':
                $this->startPaytable($request);
                break;
            case 'init':
                $this->startInit($request);
                break;
            case 'spin':
                $this->startSpin($request);
                break;
        }
    }

    protected function getHighlight($winLines) {
        if(empty($winLines)) {
            $xml = '<HighlightOutcome name="BaseGame.Lines" type=""/>';
        }
        else {
            $xml = '<HighlightOutcome name="BaseGame.Lines" type="">';

            foreach($winLines as $w) {
                $item = '<Highlight name="Line '.$w['id'].'" type="">';
                for($i = 0; $i < $w['count']; $i++) {
                    $row = $w['line'][$i];
                    $item .= '<Cell name="L0C'.$i.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }

            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getLeftHighlight($winLines) {
        $leftLines = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'left') {
                $leftLines[] = $w;
            }
        }

        if(empty($leftLines)) {
            $xml = '<HighlightOutcome name="BaseGame.LeftRightMultiWay" type="" />';
        }
        else {
            $reelsCount = count($this->gameParams->reelConfig);
            $xml = '<HighlightOutcome name="BaseGame.LeftRightMultiWay" type="">';
            foreach($leftLines as $w) {
                $item = '<Highlight name="'.$w['count'].' '.$w['alias'].'" type="">';
                for($i = 0; $i < $w['count']; $i++) {
                    $offset = array_shift($w['line']);
                    $row = floor($offset / $reelsCount);
                    $item .= '<Cell name="L0C'.$i.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }
            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getRightHighlight($winLines) {
        $rightLines = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'right') {
                $rightLines[] = $w;
            }
        }

        if(empty($rightLines)) {
            $xml = '<HighlightOutcome name="BaseGame.RightLeftMultiWay" type="" />';
        }
        else {
            $reelsCount = count($this->gameParams->reelConfig);
            $xml = '<HighlightOutcome name="BaseGame.RightLeftMultiWay" type="">';
            foreach($rightLines as $w) {
                $item = '<Highlight name="'.$w['count'].' '.$w['alias'].'" type="">';
                for($i = $reelsCount - 1; $i > ($reelsCount - $w['count']); $i--) {
                    $offset = array_shift($w['line']);
                    $row = floor($offset / $reelsCount);
                    $item .= '<Cell name="L0C'.$i.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }
            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getDisplay($report, $full = false) {
        $xml = '<PopulationOutcome name="BaseGame.Reels" stage="BaseGame">';


        $addCount = 0;
        $rows = 'rows';
        if($full) {
            $addCount = 2;
            $rows = 'fullRows';
        }
        for($i = 0; $i < count($this->gameParams->reelConfig); $i++) {
            $stop = $report['offset'][1][$i];
            $xml .= '<Entry name="Reel'.$i.'" stripIndex="'.$stop.'">';
            for($j = 0; $j < $this->gameParams->reelConfig[$i] + $addCount; $j++) {
                $elem = array_shift($report[$rows][$j + 1]);
                $symbol = $this->gameParams->getSymbolByID(array($elem));
                $xml .= '<Cell name="L0C'.$i.'R'.$j.'" stripIndex="'.($stop + $j).'">'.$symbol.'</Cell>';
            }
            $xml .= '</Entry>';
        }

        $xml .= '</PopulationOutcome>';

        return $xml;
    }

    protected function getWinLines($report) {
        if(empty($report['winLines'])) {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.Lines" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.Lines" pay="'.$report['totalWin'].'" stage="" totalPay="'.$report['totalWin'].'" type="Pattern">';

            foreach($report['winLines'] as $w) {
                $payout = $report['betOnLine']*$w['multiple'];
                $xml .= '<Prize betMultiplier="1" multiplier="1" name="Line '.$w['id'].'" pay="'.$payout.'" payName="'.$w['count'].' '.$w['alias'].'" symbolCount="'.$w['count'].'" totalPay="'.$payout.'" ways="0" />';
            }

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function getLeftWayWinLines($report) {
        $leftLines = array();
        $totalPay = 0;
        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'left') {
                $leftLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(empty($leftLines)) {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.LeftRightMultiWay" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.LeftRightMultiWay" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';

            foreach($leftLines as $w) {
                $payout = $report['betOnLine']*$w['multiple'];
                $payname = $w['count'].' '.$w['alias'];
                $xml .= '<Prize betMultiplier="1" multiplier="1" name="'.$payname.'" pay="'.$payout.'" payName="'.$payname.'" symbolCount="'.$w['count'].'" totalPay="'.$payout.'" ways="1" />';
            }

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function getRightWayWinLines($report) {
        $rightLines = array();
        $totalPay = 0;
        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'right') {
                $rightLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(empty($rightLines)) {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.RightLeftMultiWay" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="BaseGame.RightLeftMultiWay" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';

            foreach($rightLines as $w) {
                $payout = $report['betOnLine']*$w['multiple'];
                $payname = $w['count'].' '.$w['alias'];
                $xml .= '<Prize betMultiplier="1" multiplier="1" name="'.$payname.'" pay="'.$payout.'" payName="'.$payname.'" symbolCount="'.$w['count'].'" totalPay="'.$payout.'" ways="1" />';
            }

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function getSymbolPay() {
        $pay = $this->gameParams->winPay;

        $symbolList = array();
        foreach($pay as $p) {
            if(!in_array($p['symbol'], $symbolList)) {
                $symbolList[] = $p['symbol'];
            }
        }
        $payXml = '';
        $wildSymbol = $this->gameParams->getSymbolByID(array($this->gameParams->wild[0]));
        $wildRequire = '<Symbol id="'.$wildSymbol.'" required="false" />';
        foreach($symbolList as $s) {
            $itemXml = '<Prize name="'.$s.'">';
            $symbolID = $this->gameParams->getSymbolID($s);
            foreach($pay as $p) {
                if($p['symbol'] == $s) {
                    $itemXml .= '<PrizePay count="'.$p['count'].'" value="'.$p['multiplier'].'" />';
                }
            }
            if($s !== $wildSymbol) {
                $itemXml .= $wildRequire;
            }
            $itemXml .= '<Symbol id="'.$s.'" required="true" />';

            $itemXml .= '</Prize>';

            $payXml .= $itemXml;
        }

        return $payXml;
    }

    protected function getReelXml($reels) {
        $reelsXml = '';
        for($i = 0; $i < count($reels); $i++) {
            $stripXml = '<Strip name="Reel'.$i.'">';
            $reel = $reels[$i];
            foreach($reel as $r) {
                $symbol = $this->gameParams->getSymbolByID(array($r));
                $stripXml .= '<Stop symbolID="'.$symbol.'" weight="1" />';
            }
            $stripXml .= '</Strip>';

            $reelsXml .= $stripXml;
        }

        return $reelsXml;
    }

    protected function getBetPattern() {
        $config = $this->gameParams->denominations;

        $xml = '<BetInfo max="'.max($config).'" min="'.min($config).'">';
        foreach($config as $d) {
            $xml .= '<Step>'.$d.'</Step>';
        }
        $xml .= '</BetInfo>';

        return $xml;
    }

    protected function getSelective() {
        $config = $this->gameParams->denominations;

        $xml = '';
        foreach($config as $d) {
            $xml .= '<Value>'.$d.'</Value>';
        }

        return $xml;
    }
}