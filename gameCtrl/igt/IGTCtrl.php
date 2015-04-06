<?

class IGTCtrl extends Ctrl {
    protected function processRequest($request) {
        //$action = $_GET['action'];
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, 'clientconfig') > 0) $action = 'config';
        if(strpos($uri, 'initstate') > 0) $action = 'init';
        if(strpos($uri, 'paytable') > 0) $action = 'paytable';
        if(strpos($uri, 'play') > 0) $action = 'spin';
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

    protected function getDisplay($report) {
        $xml = '<PopulationOutcome name="BaseGame.Reels" stage="BaseGame">';



        for($i = 0; $i < 5; $i++) {
            $stop = $report['offset'][1][$i];
            $xml .= '<Entry name="Reel'.$i.'" stripIndex="'.$stop.'">';
            for($j = 0; $j < 3; $j++) {
                $symbol = $this->gameParams->getSymbolByID(array($report['rows'][$j + 1][$i]));
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
}