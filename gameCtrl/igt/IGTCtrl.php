<?

class IGTCtrl extends Ctrl {
    protected function processRequest($request) {
        $uri = $_SERVER['REQUEST_URI'];

		$action = '';

        if(strpos($uri, 'clientconfig') > 0) $action = 'config';
        if(strpos($uri, 'initstate') > 0) $action = 'init';
        if(strpos($uri, 'paytable') > 0) $action = 'paytable';
        if(strpos($uri, '/play') > 0) $action = 'spin';


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

    protected function getHighlight($winLines, $name = 'BaseGame.Lines', $inc = 0, $type = '') {
        $baseType = $type;
        $reelsCount = $this->slot->getReelsCount() - 1;
        if(empty($winLines)) {
            $xml = '<HighlightOutcome name="'.$name.'" type=""/>';
        }
        else {
            $xml = '<HighlightOutcome name="'.$name.'" type="">';

            foreach($winLines as $w) {
                if($w['type'] == 'line') {
                    $item = '<Highlight name="Line '.$w['id'].'" type="">';
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
                                        $type = 2;
                                    }
                                }
                            }
                            else {
                                $type = $baseType;
                            }
                        }

                        $item .= '<Cell name="L0C'.$ceil.'R'.$row.'" type="'.$type.'" />';
                    }
                    $item .= '</Highlight>';

                    $xml .= $item;
                }

            }

            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getScattersHighlight($offsets, $name = 'BaseGame.Scatter', $inc = 0) {
        $xml = '<HighlightOutcome name="'.$name.'" type="">
        <Highlight name="Scatter" type="">';
        foreach($offsets as $o) {
            $type = '';
            if($this->gameParams->doubleCount) {
                $symbol = $this->slot->getSymbolByOffset($o);
                if(in_array($symbol, $this->gameParams->doubleCountScatter)) {
                    $type = 2;
                }
            }
            $c = ($o % 5);
            $r = floor($o / 5) + $inc;
            $xml .= '<Cell name="L0C'.$c.'R'.$r.'" type="'.$type.'" />';
        }
        $xml .= '</Highlight>
    </HighlightOutcome>';

        return $xml;
    }

    protected function getScattersPay($scattersReport, $name = 'BaseGame.Scatter', $symbol = 'b01') {
        $payd = false;
        if(!empty($scattersReport['totalWin'])) {
            if($scattersReport['totalWin'] > 0) {
                $payd = true;
            }
        }
        if($payd) {
            $pay = $scattersReport['totalWin'];
            $cnt = $scattersReport['count'];
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'" pay="'.$pay.'" stage="" totalPay="'.$pay.'" type="Pattern">
        <Prize betMultiplier="'.$this->slot->betOnLine.'" multiplier="1" name="Scatter" pay="'.$pay.'" payName="'.$cnt.' '.$symbol.'" symbolCount="'.$cnt.'" totalPay="'.$pay.'" ways="0" />
    </PrizeOutcome>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }

        return $xml;

    }

    protected function getLeftHighlight($winLines, $name = 'BaseGame', $afterName = 'LeftRightMultiWay') {
        $leftLines = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'left' && $w['type'] == 'ways') {
                $leftLines[] = $w;
            }
        }

        if(empty($leftLines)) {
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="" />';
        }
        else {
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
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="">';
            foreach($resultArray as $r) {
                $item = '<Highlight name="'.$r['count'].' '.$r['alias'].'" type="">';
                foreach($r['offsets'] as $o) {
                    $row = floor($o / $reelsCount);
                    $ceil = $o % $reelsCount;
                    $item .= '<Cell name="L0C'.$ceil.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }
            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getRightHighlight($winLines, $name = 'BaseGame', $afterName = 'RightLeftMultiWay') {
        $rightLines = array();
        foreach($winLines as $w) {
            if($w['direction'] == 'right' && $w['type'] == 'ways') {
                $rightLines[] = $w;
            }
        }

        if(empty($rightLines)) {
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="" />';
        }
        else {
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
            $xml = '<HighlightOutcome name="'.$name.'.'.$afterName.'" type="">';
            foreach($resultArray as $r) {
                $item = '<Highlight name="'.$r['count'].' '.$r['alias'].'" type="">';
                foreach($r['offsets'] as $o) {
                    $row = floor($o / $reelsCount);
                    $ceil = $o % $reelsCount;
                    $item .= '<Cell name="L0C'.$ceil.'R'.$row.'" type="" />';
                }
                $item .= '</Highlight>';

                $xml .= $item;
            }
            $xml .= '</HighlightOutcome>';
        }

        return $xml;
    }

    protected function getDisplay($report, $full = false, $name = 'BaseGame', $afterName = 'Reels', $startRows = false) {
        $xml = '<PopulationOutcome name="'.$name.'.'.$afterName.'" stage="'.$name.'">';


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

    protected function getDisplayReels($report, $full = false, $name = 'BaseGame') {
        $xml = '<PopulationOutcome name="'.$name.'.Reels" stage="'.$name.'">';

        $cnt = 0;
        for($i = 0; $i < count($this->gameParams->reelConfig); $i++) {
            for($j = 0; $j < $this->gameParams->reelConfig[$i]; $j++) {
                $reel = $this->slot->reels[$i]->reels[$j];
                $offset = $reel->getOffset();
                $visible = $reel->getVisibleSymbols();
                $symbol = $this->gameParams->getSymbolByID($visible);

                $xml .= '<Entry name="Reel'.$cnt.'" stripIndex="'.$offset.'">';
                $xml .= '<Cell name="L0C'.$i.'R'.$j.'" stripIndex="'.$offset.'">'.$symbol.'</Cell>';
                $xml .= '</Entry>';

                $cnt++;
            }
        }


        $xml .= '</PopulationOutcome>';

        return $xml;
    }

    protected function getDisplayByReel($reels, $full = false, $name = 'BaseGame') {
        $xml = '<PopulationOutcome name="'.$name.'.Reels" stage="'.$name.'">';

        $addCount = 0;
        if($full) {
            $addCount = 2;
        }
        for($i = 0; $i < count($this->gameParams->reelConfig); $i++) {
            $needleReel = $reels[$i];
            $tmp = array_merge($needleReel, $needleReel);
            $cnt = count($needleReel);
            $offset = rnd(0, $cnt);
            $fullCnt = $this->gameParams->reelConfig[$i] + $addCount;
            $newSymbols = array_slice($tmp, $offset, $fullCnt);

            $xml .= '<Entry name="Reel'.$i.'" stripIndex="'.$offset.'">';

            $sI = 0;
            foreach($newSymbols as $s) {
                $symbol = $this->gameParams->getSymbolByID(array($s));
                $xml .= '<Cell name="L0C'.$i.'R'.$sI.'" stripIndex="'.($offset + $sI).'">'.$symbol.'</Cell>';
                $sI++;
            }
            $xml .= '</Entry>';
        }

        $xml .= '</PopulationOutcome>';

        return $xml;
    }

    protected function getWinLines($report, $name = 'BaseGame') {
        $baseLinesWin = $report['totalWin'];
        if(!empty($report['scattersReport'])) {
            if(!empty($report['scattersReport']['totalWin'])) {
                $baseLinesWin -= $report['scattersReport']['totalWin'];
            }
        }
        if(empty($report['winLines'])) {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.Lines" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.Lines" pay="{{count}}" stage="" totalPay="{{count}}" type="Pattern">';
            $totalPay = 0;
            foreach($report['winLines'] as $w) {
                if($w['type'] == 'line') {
                    $payout = round($report['betOnLine'] * $w['multiple'], 2);
                    $totalPay += $payout;
                    $pay = round($payout / $this->slot->double, 2);
                    $xml .= '<Prize betMultiplier="1" multiplier="'.$this->slot->double.'" name="Line ' . $w['id'] . '" pay="' . $pay . '" payName="' . $w['count'] . ' ' . $w['alias'] . '" symbolCount="' . $w['count'] . '" totalPay="' . $payout . '" ways="0" />';
                }
            }

            $xml = str_replace('{{count}}', $totalPay, $xml);

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function getLeftWayWinLines($report, $name = 'BaseGame', $afterName = 'LeftRightMultiWay') {
        $leftLines = array();
        $totalPay = 0;

        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'left' && $w['type'] == 'ways') {
                $leftLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(empty($leftLines)) {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';

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
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                else {
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                $payname = $r['count'].' '.$r['alias'];
                $xml .= '<Prize betMultiplier="1" multiplier="'.$this->slot->double.'" name="'.$payname.'" pay="'.$r['wayPay'].'" payName="'.$payname.'" symbolCount="'.$r['count'].'" totalPay="'.$r['totalPay'].'" ways="'.$r['ways'].'" />';
            }

            $xml .= '</PrizeOutcome>';
        }

        return $xml;
    }

    protected function getRightWayWinLines($report, $name = 'BaseGame', $afterName = 'RightLeftMultiWay') {
        $rightLines = array();
        $totalPay = 0;
        foreach($report['winLines'] as $w) {
            if($w['direction'] == 'right' && $w['type'] == 'ways') {
                $rightLines[] = $w;
                $totalPay += $w['multiple'] * $report['betOnLine'];
            }
        }

        if(empty($rightLines)) {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="0" stage="" totalPay="0" type="Pattern"/>';
        }
        else {
            $xml = '<PrizeOutcome multiplier="1" name="'.$name.'.'.$afterName.'" pay="'.$totalPay.'" stage="" totalPay="'.$totalPay.'" type="Pattern">';

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
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                else {
                    $r['ways'] = $r['withWild'] + $r['withoutWild'];
                }
                $payname = $r['count'].' '.$r['alias'];
                $xml .= '<Prize betMultiplier="1" multiplier="1" name="'.$payname.'" pay="'.$r['wayPay'].'" payName="'.$payname.'" symbolCount="'.$r['count'].'" totalPay="'.$r['totalPay'].'" ways="'.$r['ways'].'" />';
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

    protected function getSelective() {
        $config = $this->gameParams->denominations;

        $xml = '';
        foreach($config as $d) {
            $xml .= '<Value>'.$d.'</Value>';
        }

        return $xml;
    }

	protected function getBetPattern() {
		/*
		$config = $this->gameParams->denominations;

		$xml = '<BetInfo max="'.max($config).'" min="'.min($config).'">';
		foreach($config as $d) {
			$xml .= '<Step>'.$d.'</Step>';
		}
		$xml .= '</BetInfo>';

		return $xml;
		*/

		return $this->getBetInfo();
	}

    protected function getBetInfo() {
        $config = $this->gameParams->denominations;
		$multiple = 1;

		if($config[0] < 0.1) {
			$multiple = 100;
		}
		elseif($config[0] < 1) {
			$multiple = 10;
		}

		foreach($config as &$d) {
			$d *= $multiple;
		}

        $xml = '<BetInfo max="'.end($config).'" min="'.$config[0].'">';
        foreach($config as $d) {
            $xml .= '<Step>'.$d.'</Step>';
        }

        $xml .= '</BetInfo>';

        return $xml;
    }

    protected function checkSpinAvailable($bet) {
        $balance = $this->getBalance();
        if($bet > $balance) {
            $xml = '<Exception>
    <Id>1024</Id>
    <Reference>R42-GE-1024</Reference>
    <Message>Not enough money for a spin</Message>
    <Buttons>
        <Button>
            <Text>OK</Text>
            <Cmd name="reloadGame" />
        </Button>
    </Buttons>
</Exception>';
            $this->outXML($xml);
            die();
        }
    }

    protected function getDenominationAmount() {
        if($_SESSION['state'] == 'SPIN') {
        	$coinvalue = 1;
			$multiple = 1;
			$elem = $this->gameParams->denominations[0];

			if($elem < 0.1) {
				$multiple = 100;
				$coinvalue = 0.01;
			}
			elseif($elem < 1) {
				$multiple = 10;
				$coinvalue = 0.1;
			}

			foreach($this->gameParams->denominations as &$d) {
				$d *= $multiple;
			}

			$this->gameParams->default_coinvalue = $coinvalue;
			$_SESSION['denominationAmount'] = $coinvalue;

			return $coinvalue;


			/*
            $this->gameParams->default_coinvalue;
            $this->gameParams->defaultCoinsCount;
            $balance = $this->getBalance();

            $coinMin = 1;
            if($this->gameParams->default_coinvalue < 1) {
                $coinMin = 0.1;
            }
            if($this->gameParams->default_coinvalue < 0.1) {
                $coinMin = 0.01;
            }

            $balanceMin = 1;
            if($this->gameParams->default_coinvalue * $this->gameParams->defaultCoinsCount > $balance) {
                $balanceMin = 0.1;
            }
            if($this->gameParams->default_coinvalue * $this->gameParams->defaultCoinsCount *10 > $balance) {
                $balanceMin = 0.01;
            }
            $j = array($coinMin, $balanceMin);

            $_SESSION['denominationAmount'] = min($j);

            return $_SESSION['denominationAmount'];
			*/
        }
        else {
            return $_SESSION['denominationAmount'];
        }
    }

    protected function outXML($xml) {
        $xml = str_replace(PHP_EOL, '', $xml);
        $xml = str_replace("\n", '', $xml);
        $xml = preg_replace('/> +</', '><', $xml);

        if(!empty($_SESSION['denominationAmount'])) {
            $multiple = 1 / $_SESSION['denominationAmount'];

            $xml = $this->multipleXmlParamValue($xml, 'totalPay', $multiple);
            $xml = $this->multipleXmlParamValue($xml, 'pay', $multiple);
            $xml = $this->multipleXmlParam($xml, 'Payout', $multiple);
            $xml = $this->multipleXmlParam($xml, 'BetPerPattern', $multiple);
        }

        $xml = $this->roundXmlParamValue($xml, 'pay');
        $xml = $this->roundXmlParamValue($xml, 'totalPay');
        $xml = $this->roundXmlParam($xml, 'Payout');



        echo $xml;
    }

    protected function getDisplayFromArray($array, $stage) {
        $reelsCount = count($this->gameParams->reelConfig);


        $xml = '<PopulationOutcome name="'.$stage.'.Reels" stage="'.$stage.'">';
        $entry = '';

        for($i = 1; $i <= $reelsCount; $i++) {
            $entryItem = '<Entry name="Reel'.($i-1).'" stripIndex="'.$array['offset'][1][$i-1].'">';

            for($j = 1; $j <= $this->gameParams->reelConfig[$i-1]; $j++) {
                $needOffset = $array['offset'][$j][$i-1];
                $needSymbol = $array['rows'][$j][$i-1];
                $symbol = $this->gameParams->getSymbolByID(array($needSymbol));
                $entryItem .= '<Cell name="L0C'.($i-1).'R'.($j-1).'" stripIndex="'.$needOffset.'">'.$symbol.'</Cell>';
            }

            $entryItem .= '</Entry>';

            $entry .= $entryItem;
        }

        $xml .= $entry;
        $xml .='</PopulationOutcome>';

        return $xml;
    }
}