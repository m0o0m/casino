<?

class vegas_babyParams extends Params {
    public $reels = array(
        array(
            array(51,7,9,0,8,6,2,7,1,8,5,7,4,10,1,11,3,9,5,8,10,3,9,6,4,10,8,2,11,10,),
            array(5,11,8,3,7,1,9,2,10,1,11,51,6,4,10,7,2,9,8,5,9,4,8,9,3,8,6,0,8,9,),
            array(3,7,9,0,8,10,3,11,9,1,6,10,4,6,5,1,11,10,2,8,11,4,7,5,11,51,6,11,5,10,),
            array(4,11,5,2,11,6,0,7,11,5,8,2,9,1,10,4,9,3,8,5,9,10,4,6,8,51,10,7,3,9,),
            array(2,7,10,0,7,11,1,10,5,6,9,51,11,6,4,8,6,4,9,5,8,3,11,0,9,2,8,7,5,9,10,3,8,4,11,1,6,11,3,10,9,),
        ),
        array(
            array(51,7,9,0,8,6,2,7,1,8,5,7,4,10,1,11,3,9,5,8,10,3,9,6,4,10,8,2,11,10,),
            array(5,11,8,3,7,1,9,2,10,1,11,51,6,4,10,7,2,9,8,5,9,4,8,9,3,8,6,0,8,9,),
            array(3,7,9,0,8,10,3,11,9,1,6,10,4,6,5,1,11,10,2,8,11,4,7,5,11,51,6,11,5,10,),
            array(4,11,5,2,11,6,0,7,11,5,8,2,9,1,10,4,9,3,8,5,9,10,4,6,8,51,10,7,3,9,),
            array(2,7,10,0,7,11,1,10,5,6,9,51,11,6,4,8,6,4,9,5,8,3,11,0,9,2,8,7,5,9,10,3,8,4,11,1,6,11,3,10,9,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $allCanDouble = false;

    public $banSymbols = array(
        '0-5',
    );

    public $symbols = array(
        'b01' => array(51),
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
        'w01' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    public $doubleIfWild = true;
    // Скаттер
    public $scatter = array(51);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '5' => 100,
        '4' => 20,
        '3' => 5,
        '2' => 2,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,0,1,2,1),
        array(1,2,1,0,1),
        // 10
        array(0,1,1,1,2),
        array(2,1,1,1,0),
        array(1,0,0,1,2),
        array(1,2,2,1,0),
        array(1,1,0,1,2),
        // 15
        array(1,1,2,1,0),
        array(0,0,1,2,1),
        array(2,2,1,0,1),
        array(1,0,1,2,2),
        array(1,2,1,0,0),
        // 20
        array(0,0,0,1,2),
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
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> 's01', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> 's02', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 75),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's10', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's10', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's10', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's11', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's11', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's11', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's11', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 10000),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 2000),
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 200),
        array('symbol'=> 'w01', 'count'=> 2, 'multiplier'=> 10),
    );
}