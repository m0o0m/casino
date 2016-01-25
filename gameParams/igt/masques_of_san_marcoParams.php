<?

class masques_of_san_marcoParams extends Params {
    public $reels = array(
        array(
            array(5,2,4,5,2,3,5,51,6,7,5,1,4,5,6,4,5,51,4,5,6,4,5,7,4,5,2,4,5,2,3,5,6,7,5,1,4,5,6,4,5,51,4,5,6,4,5,7,4,),
            array(6,4,6,5,3,6,7,2,6,3,0,6,2,5,6,7,3,6,7,3,6,1,7,6,51,4,6,5,3,6,7,2,6,3,0,6,2,5,6,7,3,6,7,3,6,1,7,),
            array(7,3,5,51,7,6,3,7,1,4,7,51,5,4,7,2,7,4,3,7,5,0,7,1,6,7,3,5,51,7,6,3,7,1,4,7,51,5,4,7,2,7,4,3,7,5,0,7,1,6,),
            array(5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,3,5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,3,),
            array(4,5,6,2,5,3,7,6,1,3,6,7,4,3,6,7,5,2,4,6,7,2,),
        ),
        array(
            array(5,2,4,5,2,3,5,6,7,5,1,4,5,6,4,5,51,4,5,6,4,5,7,4,5,2,4,5,2,3,5,6,7,5,1,4,5,6,4,5,51,4,5,6,4,5,7,4,),
            array(6,51,4,6,5,3,6,7,2,6,3,0,6,2,5,6,0,7,3,6,7,3,6,1,7,6,51,4,6,5,3,6,7,2,6,3,0,6,2,5,6,7,3,6,7,3,6,1,7,),
            array(7,3,5,51,7,6,3,7,0,1,4,7,51,5,4,7,2,7,4,3,7,5,0,7,1,6,7,3,5,51,7,6,3,7,1,0,4,7,51,5,4,7,2,0,7,4,3,7,5,0,7,1,6,),
            array(5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,0,3,5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,3,),
            array(4,5,6,2,5,3,7,6,1,3,6,7,4,3,6,7,5,2,4,6,7,2,),
        ),
    );

    public $symbolWithoutWild = array(51);

    public $reelConfig = array(6,6,6,6,6);

    public $symbols = array(
        'b01' => array(51),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        'w01' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(51);
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

        // 21
        array(4,4,4,4,4),
        array(3,3,3,3,3),
        array(5,5,5,5,5),
        array(3,4,5,4,3),
        // 25
        array(5,4,3,4,5),
        array(3,3,4,3,3),
        array(5,5,4,5,5),
        array(4,5,5,5,4),
        array(4,3,3,3,4),
        // 30
        array(3,4,4,4,3),
        array(5,4,4,4,5),
        array(3,4,3,4,3),
        array(5,4,5,4,5),
        array(4,3,4,3,4),
        // 35
        array(4,5,4,5,4),
        array(4,4,3,4,4),
        array(4,4,5,4,4),
        array(3,5,3,5,3),
        array(5,3,5,3,5),
        // 40
        array(4,3,5,3,4),
    );


    public $winLinesFree = array(
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

        // 21
        array(4,4,4,4,4),
        array(3,3,3,3,3),
        array(5,5,5,5,5),
        array(3,4,5,4,3),
        // 25
        array(5,4,3,4,5),
        array(3,3,4,3,3),
        array(5,5,4,5,5),
        array(4,5,5,5,4),
        array(4,3,3,3,4),
        // 30
        array(3,4,4,4,3),
        array(5,4,4,4,5),
        array(3,4,3,4,3),
        array(5,4,5,4,5),
        array(4,3,4,3,4),
        // 35
        array(4,5,4,5,4),
        array(4,4,3,4,4),
        array(4,4,5,4,4),
        array(3,5,3,5,3),
        array(5,3,5,3,5),
        // 40
        array(4,3,5,3,4),

        // NEW LINES
        array(1,2,3,2,1),
        array(4,3,2,3,4),
        array(2,3,4,3,2),
        array(3,2,1,2,3),
        // 45
        array(2,2,3,2,2),
        array(3,3,2,3,3),
        array(2,3,3,3,2),
        array(3,2,2,2,3),
        array(2,3,2,3,2),
        // 50
        array(3,2,3,2,3),
        array(1,3,1,3,1),
        array(3,1,3,1,3),
        array(2,4,2,4,2),
        array(4,2,4,2,4),
        // 55
        array(3,4,2,4,3),
        array(4,3,2,1,0),
        array(1,2,3,4,5),
        array(2,1,3,1,2),
        array(3,2,4,2,3),
        // 60
        array(2,3,1,3,2),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 40;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 500),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 80),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 60),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 8),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 80),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 6),

        array('symbol'=> 'b01', 'count'=> 3, 'multiplier'=> 0),
    );
}