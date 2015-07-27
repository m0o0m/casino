<?

class rich_girlParams extends Params {
    public $reels = array(
        array(
            array(3,5,10,9,1,5,4,7,3,9,0,6,5,3,9,1,6,4,7,8,3,6,2,8,4,6,5,10,7,2,8,4,),
            array(5,4,7,10,5,7,1,0,9,4,51,8,2,7,0,5,2,8,6,3,8,4,6,51,7,3,6,10,1,9,51,3,),
            array(7,10,8,1,6,51,5,9,4,8,2,6,4,8,10,7,2,3,8,51,6,3,9,1,7,9,0,5,3,4,5,3,),
            array(1,7,10,1,6,7,51,9,4,3,7,0,9,8,4,6,51,2,5,3,4,5,0,8,3,6,10,9,4,5,2,8,),
            array(3,7,6,9,1,5,6,10,9,8,4,9,6,2,7,9,0,5,7,4,8,3,2,7,4,8,3,9,5,1,8,6,),
        ),
        array(
            array(14,12,102,12,13,11,12,13,102,12,13,11,14,13,12,11,13,12,14,11,13,14,12,11,14,12,13,11,14,12,11,14,13,11,14,12,11,14,13,11,12,13,14,11,13,),
            array(12,13,11,14,102,11,12,13,14,102,13,12,11,14,12,11,13,14,12,11,13,12,11,13,12,14,13,11,12,14,11,12,14,11,13,14,12,13,11,12,13,14,11,13,14,),
            array(11,14,13,11,102,14,11,12,102,13,14,12,11,13,14,12,13,14,12,13,11,14,11,12,13,11,12,14,13,12,11,14,12,11,13,14,12,11,13,12,11,13,12,14,13,),
            array(12,13,11,14,102,14,12,13,14,102,13,14,12,11,102,12,14,13,11,12,14,13,11,12,14,11,12,14,13,12,11,14,12,11,14,13,11,14,11,12,14,13,11,102,14,),
            array(14,11,102,14,13,11,12,14,102,11,13,14,12,14,11,12,13,14,11,13,12,14,13,11,12,14,11,12,14,13,102,11,14,12,11,14,12,13,11,12,13,14,12,102,14,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        // START FS
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
        // SCATTER PAYD
        's10' => array(10),
        's11' => array(11),
        's12' => array(12),
        's13' => array(13),
        's14' => array(14),
        'w01' => array(0),
        'w02' => array(102),
    );
    // Вайлд
    public $wild = array(0, 102);
    public $doubleIfWild = true;
    // Скаттер
    public $scatter = array(51);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 2,
        '4' => 10,
        '5' => 25,
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
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;

    //public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $denominations = array(0.5, 1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's09', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 10000),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 500),
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 'w01', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> 's11', 'count'=> 5, 'multiplier'=> 50),
        array('symbol'=> 's11', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's11', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's11', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's12', 'count'=> 5, 'multiplier'=> 50),
        array('symbol'=> 's12', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's12', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's12', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's13', 'count'=> 5, 'multiplier'=> 50),
        array('symbol'=> 's13', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's13', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's13', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 's14', 'count'=> 5, 'multiplier'=> 50),
        array('symbol'=> 's14', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's14', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's14', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> 'w02', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 'w02', 'count'=> 4, 'multiplier'=> 250),
        array('symbol'=> 'w02', 'count'=> 3, 'multiplier'=> 50),
    );
}