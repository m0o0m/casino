<?

class black_widowParams extends Params {
    public $reels = array(
        array(
            array(11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,4,5,7,6,2,5,9,0,6,8,7,2,5,7,1,9,2,7,9,7,1,6,3,7,6,2,5,6,9,3,5,7,6,3,5,9,6,7,9,5,1,6,3,9,5,1,7,9,6,9,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11),
            array(12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,6,8,2,5,4,9,5,0,6,1,8,6,9,1,8,9,7,5,8,9,1,5,6,8,2,5,9,1,6,9,5,6,8,9,5,6,2,5,8,3,6,9,5,2,8,9,6,8,5,6,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12),
            array(13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,3,1,7,8,5,1,8,6,4,5,0,7,4,8,1,5,8,7,2,5,3,8,7,4,5,1,7,9,7,3,5,7,5,8,7,3,5,8,4,5,8,7,8,1,5,7,4,8,5,3,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13,13),
            array(14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,4,8,6,4,7,5,1,9,9,7,6,2,8,6,4,7,0,8,3,7,6,9,6,7,8,6,9,4,8,9,8,9,7,9,6,7,8,9,6,9,7,8,7,6,8,4,6,7,8,9,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14),
            array(15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,4,6,2,7,6,4,1,6,8,3,0,5,9,5,8,3,6,7,2,8,3,5,7,4,9,9,2,6,7,3,6,8,7,5,4,8,5,6,7,9,5,9,2,5,8,8,5,6,7,9,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15),
        ),
    );
    public $symbols = array(
        // Вилд
        'w01' => array(0),
        // Девушка
        's01' => array(1),
        // Зеленый
        's02' => array(2),
        // Розовый
        's03' => array(3),
        // Синий
        's04' => array(4),
        // A
        's05' => array(5),
        // K
        's06' => array(6),
        // Q
        's07' => array(7),
        // J
        's08' => array(8),
        // 10
        's09' => array(9),
        // Random 1
        'r01' => array(11),
        // Random 1
        'r02' => array(12),
        // Random 1
        'r03' => array(13),
        // Random 1
        'r04' => array(14),
        // Random 1
        'r05' => array(15),


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
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 50),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's01', 'count'=> 2, 'multiplier'=> 4),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 25),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 7),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 25),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 7),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 25),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 15),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 7),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 15),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 14),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 9),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 4),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 13),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 8),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 3),
        array('symbol'=> 's08', 'count'=> 5, 'multiplier'=> 12),
        array('symbol'=> 's08', 'count'=> 4, 'multiplier'=> 7),
        array('symbol'=> 's08', 'count'=> 3, 'multiplier'=> 2),
        array('symbol'=> 's09', 'count'=> 5, 'multiplier'=> 11),
        array('symbol'=> 's09', 'count'=> 4, 'multiplier'=> 6),
        array('symbol'=> 's09', 'count'=> 3, 'multiplier'=> 1),
        array('symbol'=> 'w01', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> 'w01', 'count'=> 4, 'multiplier'=> 250),
        array('symbol'=> 'w01', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> 'w01', 'count'=> 2, 'multiplier'=> 10),
    );
}