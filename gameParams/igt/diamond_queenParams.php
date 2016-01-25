<?

class diamond_queenParams extends Params {
    public $reels = array(
        array(
            array(3,7,4,6,1,7,5,8,3,1,7,5,2,7,4,9,2,6,5,7,2,6,4,5,7,2,3,7,2,9,1,6,2,3,8,5,4,6,2,7,4,6,2,7,5,8,),
            array(2,7,5,6,2,21,7,3,6,1,8,2,7,0,4,9,3,6,5,21,4,8,3,7,2,6,1,8,3,7,2,8,5,6,4,9,2,7,0,5,9,3,21,2,1,8,5,2,7,4,9,),
            array(3,9,4,8,5,7,0,6,8,4,6,5,7,6,2,9,21,5,6,3,7,1,8,3,7,21,9,2,8,3,7,5,8,4,21,9,3,6,5,7,3,6,4,7,5,9,0,7,4,6,1,8,4,6,5,8,6,),
            array(7,3,2,9,5,4,21,5,2,8,3,5,0,2,6,4,5,6,2,5,7,4,6,21,2,8,4,2,6,4,2,9,4,6,2,3,7,1,21,4,6,3,2,7,3,2,9,4,7,2,1,8,5,4,6,),
            array(4,2,6,4,7,5,4,6,9,4,7,4,3,4,6,2,7,4,6,2,7,4,6,2,7,4,3,4,7,2,8,4,6,7,5,4,6,4,1,6,4,7,5,8,6,3,4,7,6,5,4,7,),
        ),
        array(
            array(9,6,1,1,1,7,5,8,2,7,5,21,8,5,7,4,8,5,9,3,7,5,9,21,5,6,4,7,6,3,9,5,7,4,6,7,5,6,3,7,5,8,4,7,6,2,7,5,),
            array(0,0,0,),
            array(7,3,8,5,7,1,1,1,7,2,9,7,5,8,4,7,3,7,5,6,1,1,1,6,2,7,5,7,3,8,1,1,1,9,4,6,3,7,5,6,4,9,5,),
            array(7,3,8,6,2,7,4,8,2,7,6,4,8,2,9,7,4,8,6,2,8,9,4,7,6,2,9,6,4,7,6,3,8,4,9,1,1,1,7,4,9,5,6,4,8,5,7,9,3,6,9,4,),
            array(7,3,6,5,9,2,7,9,4,8,3,9,8,5,9,8,3,7,8,5,9,2,8,4,7,3,8,9,2,7,4,6,2,8,9,4,6,1,1,1,7,5,6,4,8,7,6,3,9,8,2,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        'b01' => array(21),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        's08' => array(8),
        's09' => array(9),
        'w01' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(21);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 2,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
        array(0,0,1,0,0),
        array(2,2,1,2,2),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        // 10
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,0,1,0,1),
        // 15
        array(1,2,1,2,1),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        // 20
        array(1,0,2,0,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 20;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 150),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 's01', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 75),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 45),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 175),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 35),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
    );
}