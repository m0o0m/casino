<pre>
<?
    $xml = '<DrawOdds payTableSet="0">
            <Prize odds="500.00" type="5WR" />
            <Prize odds="50.00" type="4WR" />
            <Prize odds="50.00" type="5M1" />
            <Prize odds="50.00" type="5M2" />
            <Prize odds="50.00" type="5M3" />
            <Prize odds="40.00" type="3WR" />
            <Prize odds="40.00" type="5M4" />
            <Prize odds="40.00" type="5M5" />
            <Prize odds="20.00" type="4M1" />
            <Prize odds="20.00" type="4M2" />
            <Prize odds="15.00" type="4M3" />
            <Prize odds="15.00" type="4M4" />
            <Prize odds="15.00" type="4M5" />
            <Prize odds="15.00" type="5F6" />
            <Prize odds="15.00" type="5F7" />
            <Prize odds="10.00" type="3M1" />
            <Prize odds="10.00" type="3M2" />
            <Prize odds="10.00" type="3M3" />
            <Prize odds="10.00" type="5F8" />
            <Prize odds="10.00" type="5F9" />
            <Prize odds="10.00" type="5F10" />
            <Prize odds="8.00" type="4F6" />
            <Prize odds="8.00" type="4F7" />
            <Prize odds="5.00" type="2WR" />
            <Prize odds="5.00" type="3M4" />
            <Prize odds="5.00" type="3M5" />
            <Prize odds="5.00" type="4F8" />
            <Prize odds="5.00" type="4F9" />
            <Prize odds="5.00" type="4F10" />
            <Prize odds="3.00" type="3F8" />
            <Prize odds="2.00" type="2M1" />
            <Prize odds="2.00" type="3F6" />
            <Prize odds="2.00" type="3F7" />
            <Prize odds="2.00" type="3F9" />
            <Prize odds="2.00" type="3F10" />
            <Prize type="3BN" odds="2.00" />
            <Prize type="2SN" odds="0.00" />
            <Prize type="3DD" odds="0.00" />
            <Prize type="2DD" odds="0.00" />
            <Prize type="1DD" odds="0.00" />
            <BetOdds type="line" />
        </DrawOdds>';
    $obj = (array) simplexml_load_string($xml);
    
    $c = array();
    
    foreach($obj['Prize'] as $prize) {
        $prize = (array) $prize;
        
        $type = $prize['@attributes']['type'];
        $odds = $prize['@attributes']['odds'];
            
        $count = substr($type, 0, 1);
        $symbol = substr($type, 1, 1);
        $str = 'array(\'symbol\'=> \''.$symbol.'\', \'count\'=> '.$count.', \'multiplier\'=> '.$odds.'),'.PHP_EOL;
        
        $f = true;
        foreach($c as $item) {
            if($item['symbol'] == $symbol && $item['count'] == $count) $f = false;
        }
        if($f) {
            echo $str;
            $c[] = array(
                'symbol' => $symbol,
                'count' => $count,
            );
        }
    }
    
    
    
