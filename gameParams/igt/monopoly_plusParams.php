
<?

class monopoly_plusParams extends Params {
    public $reels = array(
        array(
            array(4,7,5,51,7,5,1,1,8,5,7,4,6,7,4,8,5,51,8,5,6,7,4,0,6,5,7,8,6,4,3,51,4,3,8,6,51,8,6,7,8,2,2,8,2,6,3,51,6,3,7,),
            array(4,5,0,8,7,3,6,5,7,3,5,8,4,3,7,6,8,4,7,8,6,7,5,6,8,4,7,8,5,6,1,1,6,5,8,6,7,5,3,7,8,4,5,2,2,6,5,4,8,7,6,3,8,6,3,7,4,3,0,8,),
            array(1,1,4,6,0,4,5,3,7,51,3,1,1,6,5,8,6,5,3,51,5,8,6,0,4,7,6,2,2,7,3,51,7,3,8,4,7,8,4,7,2,2,8,6,3,8,4,5,8,4,5,6,51,5,7,2,2,7,0,6,),
            array(1,4,5,3,0,2,6,1,1,6,2,2,3,6,4,1,1,6,7,8,6,7,8,1,1,7,5,3,6,5,7,3,5,8,2,2,5,4,0,3,5,1,1,8,4,2,2,8,7,4,8,6,2,2,6,7,3,5,4,3,),
            array(0,7,1,0,5,6,51,5,6,3,1,7,3,1,2,3,8,6,3,8,7,6,5,2,7,5,2,4,7,51,4,7,1,8,3,51,8,3,6,5,1,7,4,0,3,4,8,6,4,8,6,1,7,4,2,8,4,2,3,1,7,3,1,4,2,6,51,2,6,7,1,2,51,1,2,3,8,6,3,8,7,1,5,2,51,5,2,4,7,8,4,7,1,5,3,8,5,3,4,6,5,4,6,0,3,4,5,6,3,5,6,1,8,4,2,8,4,2,7,1,),
        ),
        array(
            array(10,11,9,11,10,11,9,11,10,11,9,11,10,11,9,11,10,11,9,11,10,11,),
            array(10,11,9,11,10,11,9,11,10,11,9,11,10,11,9,11,10,11,9,11,10,11,),
            array(10,11,9,11,52,11,9,11,10,11,53,11,10,11,9,11,52,11,9,11,53,11,),
        ),
        array(
            array(10,11,9,11,10,11,9,11,10,11,102,11,10,11,9,11,10,11,9,11,102,11,),
            array(10,11,9,11,10,11,9,11,10,11,102,11,10,11,9,11,10,11,9,11,102,11,),
            array(10,11,102,11,53,11,9,11,10,11,52,11,102,11,9,11,53,11,9,11,52,11,),
        ),
        array(
            array(10,11,9,11,10,11,9,11,10,11,103,11,10,11,9,11,10,11,9,11,103,11,),
            array(10,11,9,11,10,11,9,11,10,11,103,11,10,11,9,11,10,11,9,11,103,11,),
            array(10,11,103,11,53,11,9,11,10,11,52,11,103,11,9,11,53,11,9,11,52,11,),
        ),
        array(
            array(10,11,9,11,10,11,9,11,10,11,104,11,10,11,9,11,10,11,9,11,104,11,),
            array(10,11,9,11,10,11,9,11,10,11,104,11,10,11,9,11,10,11,9,11,104,11,),
            array(10,11,104,11,53,11,9,11,10,11,52,11,104,11,9,11,53,11,10,11,52,11,),
        ),
        array(
            array(13,11,12,11,13,11,12,11,13,11,105,11,13,11,12,11,13,11,12,11,105,11,),
            array(13,11,12,11,13,11,12,11,13,11,105,11,13,11,12,11,13,11,12,11,105,11,),
            array(13,11,105,11,53,11,12,11,13,11,52,11,105,11,12,11,53,11,12,11,52,11,),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $symbols = array(
        'b01' => array(51),
        'b02' => array(52),
        'b03' => array(53),
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
        's12' => array(12),
        's13' => array(13),
        'w01' => array(0),
        'w02' => array(102),
        'w03' => array(103),
        'w04' => array(104),
        'w05' => array(105),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(99);
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
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(0,1,1,1,2),
        array(2,1,1,1,0),
        array(0,1,0,0,1),
        // 15
        array(2,1,2,2,1),
        array(1,0,1,1,0),
        array(1,2,1,1,2),
        array(0,0,2,2,1),
        array(2,2,0,0,1),
        // 20
        array(1,0,2,1,2),
        array(1,2,0,1,0),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        array(1,1,0,1,1),
        // 25
        array(1,1,2,1,1),
        array(0,2,2,2,1),
        array(2,0,0,0,1),
        array(0,2,1,1,2),
        array(2,0,1,1,0),
        // 30
        array(1,1,1,0,0),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 30;

    //public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 90),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 300),
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 1500),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 60),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 800),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 100),

    );
}