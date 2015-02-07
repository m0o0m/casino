<pre>
<?
    $m = 0.5;
    $winPay = array(
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'250.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'125.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'25.00'),
        array('symbol'=>'W', 'count'=>2, 'multiplier'=>'2.5'),

        array('symbol'=>'I', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'I', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'I', 'count'=>3, 'multiplier'=>'12.50'),
        array('symbol'=>'I', 'count'=>2, 'multiplier'=>'1.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'87.50'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'37.50'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'7.50'),
        array('symbol'=>'M', 'count'=>2, 'multiplier'=>'1.00'),

        array('symbol'=>'D', 'count'=>5, 'multiplier'=>'75.00'),
        array('symbol'=>'D', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'D', 'count'=>3, 'multiplier'=>'6.00'),

        array('symbol'=>'N', 'count'=>5, 'multiplier'=>'62.50'),
        array('symbol'=>'N', 'count'=>4, 'multiplier'=>'25.00'),
        array('symbol'=>'N', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'4.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'37.50'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'2.50'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'37.50'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'2.50'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'30.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'1.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'30.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'1.00'),
        
    );
    
    foreach($winPay as $winLine) {
        $symbol = $winLine['symbol'];
        $count = $winLine['count'];
        $multiplier = $winLine['multiplier'];
        $multiplier = $multiplier / $m;
        $multiplier .= '.00';
        
        $string = 'array(\'symbol\'=>\''.$symbol.'\', \'count\'=>'.$count.', \'multiplier\'=>\''.$multiplier.'\'),'.PHP_EOL;
        echo $string;
        
    }
?>
