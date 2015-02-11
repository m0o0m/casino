<pre>
<?
    $xml = '<WinLines>
            <Line num="1" offsets="-1, -1, -1, -1, -1" />
            <Line num="2" offsets="-1,  0, -1,  0, -1" />
            <Line num="3" offsets=" 0,  0,  0,  0,  0" />
            <Line num="4" offsets=" 0,  1, -1,  1,  0" />
            <Line num="5" offsets=" 1,  1,  2,  1,  1" />
            <Line num="6" offsets=" 1,  2,  2,  2,  1" />
            <Line num="7" offsets="-1,  0,  1,  2,  1" />
            <Line num="8" offsets=" 1,  0, -1, -1, -1" />
            <Line num="9" offsets=" 0,  0, -1,  0,  0" />
            <Line num="10" offsets=" 0,  1,  2,  1,  0" />
            <Line num="11" offsets=" 0, -1,  0, -1,  0" />
            <Line num="12" offsets=" 1,  2,  1,  2,  1" />
            <Line num="13" offsets=" 0,  0,  1,  0,  0" />
            <Line num="14" offsets=" 0,  1,  0,  1,  0" />
            <Line num="15" offsets=" 1,  1,  0,  1,  1" />
            <Line num="16" offsets=" 1,  1,  2,  1,  1" />
            <Line num="17" offsets=" 1,  2,  2,  1,  0" />
            <Line num="18" offsets="-1, -1, -1,  0,  0" />
            <Line num="19" offsets=" 0,  1,  2,  1,  1" />
            <Line num="20" offsets=" 0,  1,  0,  0,  0" />
            <Line num="21" offsets=" 0,  1,  2,  2,  1" />
            <Line num="22" offsets=" 0,  0, -1, -1,  0" />
            <Line num="23" offsets=" 1,  2,  1,  0, -1" />
            <Line num="24" offsets="-1, -1,  0, -1, -1" />
            <Line num="25" offsets=" 1,  1,  0, -1, -1" />
            <Line num="26" offsets=" 1,  2,  2,  1,  1" />
            <Line num="27" offsets="-1, -1,  0, -1, -1" />
            <Line num="28" offsets="-1,  0, -1, -1, -1" />
            <Line num="29" offsets="-1, -1, -1,  0, -1" />
            <Line num="30" offsets="-1,  0,  0, -1, -1" />
            <Line num="31" offsets=" 1,  1,  2,  2,  1" />
            <Line num="32" offsets=" 0,  1,  0, -1,  0" />
            <Line num="33" offsets=" 0,  1,  1,  0,  0" />
            <Line num="34" offsets=" 1,  0, -1,  0,  1" />
            <Line num="35" offsets="-1,  0,  1,  0, -1" />
            <Line num="36" offsets="-1,  1,  2,  1, -1" />
            <Line num="37" offsets="-1,  1,  0,  1, -1" />
            <Line num="38" offsets=" 1,  0,  1,  0,  1" />
            <Line num="39" offsets="-1,  0,  1,  0,  1" />
            <Line num="40" offsets=" 1,  0, -1,  0, -1" />
        </WinLines>';
    $obj = (array) simplexml_load_string($xml);
    foreach($obj['Line'] as $line) {
        $t = (array) $line;
        $offsets = $t['@attributes']['offsets'];
        $offsets = str_replace(' ', '', $offsets);
        $t = explode(',', $offsets);
        $new = array();
        foreach($t as $s) {
            $new[] = (int) $s + 1;
        }
        $newStr = implode(',', $new);
        echo 'array('.$newStr.'),'.PHP_EOL;
    }
?>
