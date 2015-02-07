<?

class avalon_2Params extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(10,3,11,5,8,4,7,11,9,7,1,11,4,8,5,9,7,2,9,11,10,6,0,0,0,5,7,8,9,11,1,2,10,3,8,6,11,3,7,11,4,9,13,7,11,9,1,7,11,4,7,9,11,2,9,13,1,8,10,6,7,11,9,5,10,11,9,7,10,9,11,3,7,9,11,7,9,11,7),
            array(2,4,8,10,6,8,10,6,2,10,8,5,3,10,8,6,9,8,7,9,4,6,10,8,2,5,6,10,13,2,10,7,8,10,0,0,0,10,6,8,3,4,6,10,4,8,11,9,2,5,6,11,9,5,6,10,8,1,10,6,8,11,6,10,8,3,6,1,3,6,8,11,9,6,7,8,10,1,8,9,6,7,10,6,11,10,7,11,10,13,11,6,8,5,3,10,6,1,7,8,6,4,8,13,10,1,8,10),
            array(3,7,10,11,4,5,7,11,9,13,7,10,5,7,8,9,1,8,11,2,7,10,11,7,6,11,9,3,11,10,2,7,5,6,11,7,6,8,11,12,2,3,9,7,11,10,9,7,1,9,2,5,6,11,10,3,9,4,11,3,9,0,0,0,3,8,6,10,9,7,4,13,3,11,9,4,6,9,10,8,9,7,1,2,8,5,9,10,2,11,9,8,7,9,4,11,7,1,9,11,8,7,11,9,7,11,9,7,8,11),
            array(9,2,6,0,0,0,8,10,3,11,8,6,1,9,10,6,8,10,5,3,6,8,5,10,6,4,10,6,8,10,7,5,8,10,6,8,10,4,6,11,2,8,7,10,4,9,1,10,7,1,5,13,10,8,11,10,6,3,8,11,9,10,8,6,4,8,13,6,10,2,8,9,11,2,10,4,9,6,3,7,6,10,8,6,10,8,6,1,5,11,8,6,9,1,11,8,7,11,8,10,6,8,10,2,6,9,3,10,6,7),
            array(11,8,2,13,5,9,4,7,8,0,0,0,10,11,9,7,10,11,2,9,3,6,9,7,11,5,9,10,1,6,11,4,8,11,7,10,11,7,9,2,11,9,10,8,13,5,11,10,9,13,6,1,11,9,7,13,9,6,8,10,6,11,4,8,7,9,11,7,9,11,3,10,9,7,6,9,11,7,10,3,7,9,13,7,9,10,7,11,13,7,9,5,11,6,9,7,8,1,7),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Scatter
        'S' => array(13),
        // Arthur
        'U' => array(1),
        // Merlin
        'M' => array(2),
        // Guinevere
        'G' => array(3),
        // Morgan
        'R' => array(4),
        // Black Knight
        'B' => array(5),
        // A
        'A' => array(6),
        // K
        'K' => array(7),
        // Q
        'Q' => array(8),
        // J
        'J' => array(9),
        // 10
        'T' => array(10),
        // 9
        'N' => array(11),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(13);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 5,
        '4' => 20,
        '5' => 100,
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = false;

    public $winLines = array();

    public $winLineType = '243';
    public $minWinCount = 2;

    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'2000.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'500.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'100.00'),
        array('symbol'=>'W', 'count'=>2, 'multiplier'=>'5.00'),

        array('symbol'=>'U', 'count'=>5, 'multiplier'=>'1000.00'),
        array('symbol'=>'U', 'count'=>4, 'multiplier'=>'150.00'),
        array('symbol'=>'U', 'count'=>3, 'multiplier'=>'40.00'),
        array('symbol'=>'U', 'count'=>2, 'multiplier'=>'2.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'800.00'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'30.00'),
        array('symbol'=>'M', 'count'=>2, 'multiplier'=>'2.00'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'600.00'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'R', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'R', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'R', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'6.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'6.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'10.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'4.00'),

        array('symbol'=>'N', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'N', 'count'=>4, 'multiplier'=>'10.00'),
        array('symbol'=>'N', 'count'=>3, 'multiplier'=>'4.00'),
    );
    public $doubleIfWild = false;
}