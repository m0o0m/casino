<?

class cash_coasterParams extends Params {
    public $reels = array(
        array(
            array(11,5,7,9,3,11,5,11,11,3,1,9,10,2,1,11,1,6,5,10,4,6,3,9,5,6,11,4,10,7,3,8,8,1,9,9,5,7,7,3,10,10,2,6,6,1,11,11,5,6,10,2,7,3,11,10,5,6,7,9,3,10,7,2,9,9,1,7,6,),
            array(10,12,8,4,6,10,1,8,3,10,1,11,5,6,3,8,6,2,6,6,3,8,12,11,3,10,12,8,8,2,9,9,4,2,1,10,7,12,10,4,8,5,0,7,0,6,0,11,10,5,8,4,11,12,6,6,4,8,5,10,),
            array(2,10,5,10,7,4,6,8,5,1,12,6,6,5,3,2,6,7,3,7,7,12,9,1,8,2,9,9,5,10,10,1,8,8,3,6,1,2,9,12,2,6,4,7,4,10,10,2,11,3,9,7,4,3,4,10,7,4,10,10,4,11,2,12,9,3,8,4,6,10,5,12,7,4,8,5,5,11,6,2,8,7,1,3,12,7,2,8,6,3,11,10,4,11,5,12,7,7,1,11,8,2,11,12,6,4,3,7,3,8,1,11,7,5,9,6,5,5,6,),
            array(11,5,2,10,10,5,9,9,1,7,12,6,4,11,11,2,6,3,12,10,11,4,5,3,6,6,0,7,0,10,0,8,8,3,7,2,5,3,7,10,12,10,11,3,11,2,10,4,7,5,9,1,6,4,9,5,11,4,9,3,7,9,5,10,7,3,9,12,8,),
            array(10,1,9,7,1,8,11,4,6,2,7,3,6,10,5,8,10,3,8,11,1,6,6,5,8,7,4,7,2,6,5,8,8,4,10,10,2,11,1,6,7,3,11,11,4,7,7,3,9,9,2,6,7,1,7,11,2,9,10,6,4,8,9,5,8,11,),
        ),
        array(
            array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,),
            array(10,12,8,4,11,11,1,8,3,10,1,3,5,6,8,3,6,7,10,0,0,0,0,11,3,8,12,6,6,2,9,9,12,2,10,1,7,12,10,4,8,5,10,2,11,8,3,11,11,5,8,4,11,12,8,6,4,6,5,10,),
            array(2,9,5,10,7,4,6,8,5,12,7,6,5,8,2,6,1,9,3,7,6,12,9,1,8,3,9,5,3,10,7,2,9,1,3,2,7,9,9,12,3,10,4,7,4,8,8,2,11,3,6,6,4,8,4,10,7,4,9,9,4,11,2,8,6,3,8,4,6,10,5,12,7,4,8,5,5,11,6,2,8,7,1,7,12,9,2,8,6,3,11,10,4,11,9,12,7,8,1,9,8,2,9,12,6,4,9,7,3,8,1,11,7,5,9,6,5,5,6,3,7,12,9,2,6,8,),
            array(11,5,2,10,11,5,9,10,1,7,12,6,4,11,10,2,6,3,12,10,5,4,11,3,6,4,10,0,0,0,0,8,11,2,9,1,4,3,6,6,12,6,8,3,6,2,10,4,7,5,9,1,6,4,9,5,11,4,9,3,7,9,5,10,7,3,9,12,8,),
            array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        'w01' => array(0),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        's08' => array(8),
        's09' => array(9),
        's10' => array(10),
        's11' => array(11),
        'b01' => array(12),
    );

    public $extraLine = true;

    public $extraLineConfig = array(
        'symbols' => array(1,2,3,4,5),
        'any' => true,
        'alias' => 'any7',
        'multiplier' => 40,
    );

    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(12);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
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
        array(1,2,0,2,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
        // 25
        array(2,0,0,0,2),
        array(0,2,1,2,0),
        array(2,0,1,0,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        // 30
        array(1,0,1,2,1),
    );

    public $winLineType = 'leftRight';
    public $minWinCount = 3;

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 40;

    //public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $denominations = array(0.1, 1,2,3,5,10,20,30,50,100,200,300,500,1000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 150),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 75),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 60),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's10', 'count'=> 5, 'multiplier'=> 75),
        array('symbol'=> 's10', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's10', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's11', 'count'=> 5, 'multiplier'=> 75),
        array('symbol'=> 's11', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's11', 'count'=> 3, 'multiplier'=> 5),
    );

    // шанс 1 к 10, что один из барабанов станет wild
    public $wildChance = 10;

    // Шанс 1 к 100, что оба барабана (первый и последний) станут вайлдами
    public $doubleWildChance = 100;
}