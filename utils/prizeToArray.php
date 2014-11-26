<pre>
<?
    $xml = '<DrawOdds payTableSet="0">
            <Prize type="5W" odds="1000.00" />
            <Prize type="5A" odds="300.00" />
            <Prize type="5B" odds="250.00" />
            <Prize type="5C" odds="250.00" />
            <Prize type="4W" odds="250.00" />
            <Prize type="5D" odds="200.00" />
            <Prize type="4A" odds="150.00" />
            <Prize type="5E" odds="100.00" />
            <Prize type="5F" odds="100.00" />
            <Prize type="5G" odds="100.00" />
            <Prize type="4B" odds="100.00" />
            <Prize type="4C" odds="100.00" />
            <Prize type="5H" odds="75.00" />
            <Prize type="5I" odds="75.00" />
            <Prize type="4D" odds="50.00" />
            <Prize type="3W" odds="50.00" />
            <Prize type="4E" odds="30.00" />
            <Prize type="4F" odds="30.00" />
            <Prize type="3A" odds="25.00" />
            <Prize type="4G" odds="20.00" />
            <Prize type="4H" odds="15.00" />
            <Prize type="4I" odds="15.00" />
            <Prize type="3B" odds="15.00" />
            <Prize type="3C" odds="15.00" />
            <Prize type="3D" odds="15.00" />
            <Prize type="3E" odds="5.00" />
            <Prize type="3F" odds="5.00" />
            <Prize type="3G" odds="5.00" />
            <Prize type="3H" odds="5.00" />
            <Prize type="3I" odds="5.00" />
            <Prize type="2W" odds="5.00" />
            <Prize type="5S" odds="75.00" />
            <Prize type="4S" odds="75.00" />
            <Prize type="3S" odds="75.00" />
            <Prize type="5J" odds="0.00" />
            <Prize type="4J" odds="0.00" />
            <Prize type="3J" odds="0.00" />
            <Prize type="2J" odds="0.00" />
            <Prize type="1J" odds="0.00" />
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
    
    
    
