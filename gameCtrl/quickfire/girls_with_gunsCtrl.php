<?
require_once('QFCtrl.php');

class girls_with_gunsCtrl extends QFCtrl {

    protected  function startInit($request) {
        $xml = '<Pkt><Id mid="10238" cid="10001" sid="1867" sessionid="80ba2191-f846-4dbf-932e-1956faa6f4aa" verb="Refresh" /><Response><Framework state="0" /><Player balance="200000" totalWin="0" userID="111300" transNumber="1370610" type="5" currency="0" brandId="1867" hasPlayedBefore="1"><PlayInfos type="TopWins" id="0"><PlayInfo value="1182700" chipSize="5" date="2014-03-06 19:39:52" /><PlayInfo value="689200" chipSize="5" date="2014-03-06 19:31:21" /><PlayInfo value="394800" chipSize="5" date="2013-03-10 05:05:23" /><PlayInfo value="282000" chipSize="5" date="2013-03-10 04:34:41" /><PlayInfo value="262200" chipSize="5" date="2014-04-18 02:21:47" /></PlayInfos></Player><Slot win="0" triggeringWin="0" state="0" reelSet="0" reelPos="26,47,30,5,20" hasRespinFeature="0"><VisArea numRows="3" numCols="5" numPaylines="1"><Row symbols="4,10,3,12,11" reelPos="25,46,29,4,19" /><Row symbols="11,1,11,9,1" reelPos="26,47,30,5,20" /><Row symbols="5,12,8,14,13" reelPos="27,48,31,6,21" /></VisArea><Wins /><NextSpin nextActivePaylines="0" nextNumChips="20" nextChipSize="5" nextMaxChips="20" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" /><TriggeringSpin triggeringWin="0" /><ExtendedSpinStyles><ExtendedSpinStyle styleName="ExpandTheGroupShot" isActiveCurrentSpin="1" isActiveNextSpin="1" /></ExtendedSpinStyles><ReelSets><ReelSet defaultPos="1,42,24,68,21" /><ReelSet defaultPos="1,42,24,68,21" /></ReelSets></Slot><Bet numChips="20" chipSize="5" activePaylines="0" numActiveGames="1" maxChips="20" minChips="1" validNumGames="1" numPaylinesPerGame="1" validChips="1,2,5" slotBetMethod="1"><Paylines><Payline payline="0" paylineCost="30" /></Paylines></Bet></Response></Pkt>';
        $this->outXML($xml);
    }

    protected function startSpin($request) {
        $betAttr = (array) $request['Request'];
        $betAttr = $betAttr['@attributes'];

        $stake = $betAttr['numChips'] * $betAttr['chipSize'] * 0.30;
        $pick = 30;

        $balance = $this->getBalance();
        if($stake > $balance) {
            die();
        }

        $this->slot = new Slot($this->gameParams, $pick, $stake);
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
                $spinData['report']['numChips'] = $betAttr['numChips'];
                $spinData['report']['chipSize'] = $betAttr['chipSize'];
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        game_ctrl($stake * 100, $totalWin * 100, 0, 'standart');
    }

    protected function getSpinData() {
        $respin = false;
        $report = $this->slot->spin();
        $report['scattersReport'] = $this->slot->getScattersCount();
        $report['type'] = 'SPIN';

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $reelPos1 = implode(',', $this->arrayDecrease($report['offset']['1']));
        $reelPos2 = implode(',', $this->arrayDecrease($report['offset']['2']));
        $reelPos3 = implode(',', $this->arrayDecrease($report['offset']['3']));
        $row1 = implode(',', $report['rows']['1']);
        $row2 = implode(',', $report['rows']['2']);
        $row3 = implode(',', $report['rows']['3']);

        $wins = '';

        if($totalWin == 0) {
            $wins = '<Wins />';
        }
        else {
            $wins = '<Wins>'.PHP_EOL;
            foreach($report['winLines'] as $w) {
                $pos = $this->invertOffsets($w['line']);
                $posStr = implode(',', $pos);
                $coins = $report['betOnLine'] * $w['multiple'] * 100 / $report['chipSize'];
                $double = '';
                if($w['double'] > 1) {
                    $double = ' multipliers="'.$w['double'].'" multiplierOperation="Multiply" multiple="'.$w['double'].'"';
                }
                $wins .= '<Win payline="0" id="23" numCoinsWon="'.$coins.'" matchPos="'.$posStr.'" '.$double.'/>';
            }
            $wins .= '</Wins>'.PHP_EOL;
        }

        $balance = $this->getBalance() * 100 + $totalWin * 100;

        $response = '<Pkt>
    <Id mid="10238" cid="10001" sid="1867" sessionid="1a02e874-cb0f-4c24-a64c-3a1af5611be5" verb="Spin" />
    <Response>
        <Framework state="0" />
        <Player balance="'.$balance .'" totalWin="'.$totalWin * 100 .'" userID="131505" transNumber="979278">
            <PlayInfos type="TopWins" id="0">
                <PlayInfo value="36720" chipSize="1" date="2014-09-08 16:35:40" />
                <PlayInfo value="17100" chipSize="1" date="2014-09-08 16:46:22" />
                <PlayInfo value="13560" chipSize="1" date="2014-09-08 16:56:05" />
                <PlayInfo value="12000" chipSize="1" date="2014-09-08 16:56:37" />
                <PlayInfo value="11820" chipSize="1" date="2014-09-08 16:33:57" />
            </PlayInfos>
        </Player>
        <Slot win="'.$totalWin * 100 .'" triggeringWin="'.$totalWin * 100 .'" state="0" reelSet="0" reelPos="'.$reelPos2.'">
            <VisArea numRows="3" numCols="5" numPaylines="1">
                <Row symbols="'.$row1.'" reelPos="'.$reelPos1.'" />
                <Row symbols="'.$row2.'" reelPos="'.$reelPos2.'" />
                <Row symbols="'.$row3.'" reelPos="'.$reelPos3.'" />
            </VisArea>
            '.$wins.'
            <NextSpin nextActivePaylines="0" nextNumChips="20" nextChipSize="1" nextMaxChips="20" nextMinChips="1" nextNumActiveGames="1" nextValidNumGames="1" />
            <TriggeringSpin triggeringWin="'.$totalWin * 100 .'" />
            <ExtendedSpinStyles>
                <ExtendedSpinStyle styleName="ExpandTheGroupShot" isActiveCurrentSpin="1" isActiveNextSpin="1" />
            </ExtendedSpinStyles>
        </Slot>
    </Response>
</Pkt>';

        $this->outXML($response);
    }

}
