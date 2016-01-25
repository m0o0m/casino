<?

class pixies_of_the_forestParams extends Params {
    public $reels = array(
        array(
            array(6,51,5,3,6,4,7,6,4,5,51,4,5,6,1,5,4,7,5,4,2,5,4,2,5,),
            array(6,7,4,5,6,1,7,3,6,7,3,6,51,7,6,0,7,6,2,7,6,3,7,4,6,3,),
            array(3,1,5,4,7,5,0,7,3,5,1,51,2,7,4,6,7,51,4,7,1,3,7,4,6,51,5,7,),
            array(7,6,5,4,6,7,2,6,7,2,5,6,7,5,3,1,7,6,0,3,5,7,6,4,5,7,6,5,),
            array(2,5,7,6,4,2,5,7,6,3,5,7,6,3,1,5,7,6,5,7,6,5,4,),
        ),
        array(
            array(6,0,5,3,6,4,7,6,4,5,0,4,5,6,1,5,4,7,5,4,2,5,4,2,5,),
            array(6,7,4,5,6,1,7,3,6,7,3,6,0,7,6,0,7,6,2,7,6,3,7,4,6,3,),
            array(3,1,5,4,7,5,0,7,3,5,1,0,2,7,4,6,7,0,4,7,1,3,7,4,6,0,5,7,),
            array(7,6,5,4,6,7,2,6,7,2,5,6,7,5,3,1,7,6,0,3,5,7,6,4,5,7,6,5,),
            array(2,5,7,6,4,2,5,7,6,3,5,7,6,3,1,5,7,6,5,7,6,5,4,),
        ),
    );

    public $symbolWithoutWild = array(51);

    public $reelConfig = array(3,3,3,3,3);

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
    public $scatter = array(10);
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
        array(2,2,2,1,0),
        array(0,1,2,2,2),
        array(2,1,0,0,0),
        array(0,1,0,1,0),
        // 25
        array(2,1,2,1,2),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(1,0,0,0,1),
        array(1,2,2,2,1),
        // 30
        array(0,1,0,1,2),
        array(2,1,2,1,0),
        array(0,1,2,2,1),
        array(2,1,0,0,1),
        array(0,1,2,1,1),
        // 35
        array(2,1,0,1,1),
        array(1,2,1,2,1),
        array(1,0,1,0,1),
        array(0,1,2,1,2),
        array(2,1,0,1,0),
        // 40
        array(0,0,1,0,0),
        array(2,2,1,2,2),
        array(0,0,1,1,2),
        array(2,2,1,1,0),
        array(0,1,1,2,2),
        // 45
        array(2,1,1,0,0),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(1,0,1,1,2),
        array(1,2,1,1,0),
        // 50
        array(0,1,1,2,1),
        array(2,1,1,0,1),
        array(0,0,0,1,1),
        array(2,2,2,1,1),
        array(1,1,1,0,0),
        // 55
        array(1,1,1,2,2),
        array(0,0,1,1,1),
        array(2,2,1,1,1),
        array(1,1,0,0,0),
        array(1,1,2,2,2),
        // 60
        array(0,0,0,1,0),
        array(2,2,2,1,2),
        array(0,0,0,0,1),
        array(2,2,2,2,1),
        array(1,0,0,0,0),
        // 65
        array(1,2,2,2,2),
        array(0,0,1,0,1),
        array(2,2,1,2,1),
        array(1,0,0,1,0),
        array(1,2,2,1,2),
        // 70
        array(0,0,1,1,0),
        array(2,2,1,1,2),
        array(1,0,0,1,1),
        array(1,2,2,1,1),
        array(0,1,0,0,0),
        // 75
        array(2,1,2,2,2),
        array(1,0,1,0,0),
        array(1,2,1,2,2),
        array(0,1,0,0,1),
        array(2,1,2,2,1),
        // 80
        array(1,0,1,1,0),
        array(1,2,1,1,2),
        array(0,1,0,1,1),
        array(2,1,2,1,1),
        array(1,0,1,1,1),
        // 85
        array(1,2,1,1,1),
        array(0,1,1,0,0),
        array(2,1,1,2,2),
        array(1,1,0,0,1),
        array(1,1,2,2,1),
        // 90
        array(0,1,1,0,1),
        array(2,1,1,2,1),
        array(1,1,0,1,0),
        array(1,1,2,1,2),
        array(0,1,1,1,1),
        // 95
        array(2,1,1,1,1,),
        array(1,1,1,0,1),
        array(1,1,1,2,1),
        array(1,1,1,1,0),
        array(1,1,1,1,2),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 33;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 0),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 0),
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 0),
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 2000),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 400),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 40),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 3),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 30),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 10),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 2),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 25),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 5),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 1),

        array('symbol'=> 'b01', 'count'=> 5, 'multiplier'=> 0),
        array('symbol'=> 'b01', 'count'=> 4, 'multiplier'=> 0),
        array('symbol'=> 'b01', 'count'=> 3, 'multiplier'=> 0),

    );
}