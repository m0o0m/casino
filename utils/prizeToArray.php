<pre>
<?
    $xml = '<DrawOdds payTableSet="1">
            <Prize type="5W" odds="250.00" />
            <Prize type="5H" odds="100.00" />
            <Prize type="5F" odds="100.00" />
            <Prize type="5L" odds="100.00" />
            <Prize type="5G" odds="75.00" />
            <Prize type="5N" odds="75.00" />
            <Prize type="4W" odds="50.00" />
            <Prize type="4G" odds="40.00" />
            <Prize type="4N" odds="40.00" />
            <Prize type="5A" odds="40.00" />
            <Prize type="4H" odds="25.00" />
            <Prize type="4F" odds="25.00" />
            <Prize type="4L" odds="25.00" />
            <Prize type="5K" odds="20.00" />
            <Prize type="5Q" odds="20.00" />
            <Prize type="5J" odds="20.00" />
            <Prize type="5T" odds="20.00" />
            <Prize type="3W" odds="15.00" />
            <Prize type="3H" odds="10.00" />
            <Prize type="3F" odds="10.00" />
            <Prize type="3L" odds="10.00" />
            <Prize type="4A" odds="10.00" />
            <Prize type="4K" odds="10.00" />
            <Prize type="4Q" odds="10.00" />
            <Prize type="4J" odds="10.00" />
            <Prize type="4T" odds="10.00" />
            <Prize type="3G" odds="5.00" />
            <Prize type="3N" odds="5.00" />
            <Prize type="3A" odds="3.00" />
            <Prize type="3K" odds="2.00" />
            <Prize type="3Q" odds="2.00" />
            <Prize type="3J" odds="2.00" />
            <Prize type="3T" odds="2.00" />
            <Prize type="3S" odds="0.00" />
            <BetOdds type="line" />
        </DrawOdds>';
    $obj = (array) simplexml_load_string($xml);
    
    $c = array();
    
    foreach($obj['Prize'] as $prize) {
        $prize = (array) $prize;
        
        $type = $prize['@attributes']['type'];
        $odds = $prize['@attributes']['odds'];
            
        $count = substr($type, 0, 1);
        $symbol = substr($type, 1);
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
    
    
    
