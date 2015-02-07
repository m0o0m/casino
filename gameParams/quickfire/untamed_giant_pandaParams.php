<?

class untamed_giant_pandaParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        // 34 - 9
        // 33 - 8
        // 32 - 7
        // 31 - 6
        // 30 - 5
        // 29 - 4
        // 28 - 3
        // 27 - 2
        // 26 - 1
        // 25 - 0
        // 24 - 9
        // 23 - 8
        // 22 - 7
        // 21 - 6
        // 20 - 5
        // 19 - 4
        // 18 - 3
        // 17 - 2
        // 16 - 1
        // 15 - 0
        array(
            array(0,7,4,8,9,7,5,6,9,2,3,7,4,9,8,5,9,7,2,8,4,7,8,6,3,7,9,4,8,9,10,7,2,4,8,2,7,8,3,7,9,4,8,9,7,2,9,4,8,9,3,7,6,9,4,8,9,7,8,9,4,8,9,10,1,7,9,1,4,8,1,9,7,1,3,4,8,3,7,4,8,3,7,10,4,8,9,3,8,7,3,9,8,7,3,9,8,7,3,9),
            array(0,6,8,1,4,6,1,3,8,1,4,2,1,10,2,5,6,8,9,4,6,9,4,2,8,4,2,7,1,6,8,1,4,6,1,5,8,2,1,4,2,10,5,1,6,8,1,4,6,1,5,8,2,1,4,2,5,6,8,4,6,5,7,6,8,1,4,6,1,5,8,2,7,4,2,5,6,8,4,6,5,4,6,8,4,6,5,8),
            array(0,1,3,6,1,7,5,1,9,3,1,6,9,2,7,5,2,9,3,6,7,5,9,3,6,7,5,10,9,3,6,9,7,5,8,4,9,8,6,7,5,10,9,1,3,9,6,1,7,5,1,9,3,1,6,7,5,10,1,9,3,1,6,9,1,7,5,1,10,3,6,9,7,5,9,1,3,6,1,9,5,1,9,3,1,6,3,7,5,9,3,7,5,9,3,7,5,9,3,7),
            array(0,5,7,8,4,9,6,3,9,5,2,7,8,9,2,6,9,5,7,8,4,9,6,3,9,10,5,7,8,4,9,6,3,9,5,2,7,8,9,2,6,9,5,7,8,4,9,6,3,9,5,7,1,8,4,1,9,6,1,3,9,10,5,2,7,8,2,6,5,7,8,4,9,6,3,9,1,5,7,8,4,1,5,7,8,4,7,8),
            array(0,3,4,5,8,3,4,2,7,6,2,1,3,4,1,5,8,1,7,6,1,3,4,5,8,3,4,2,7,6,2,3,4,5,8,7,6,10,3,4,5,8,9,7,6,9,3,4,5,8,9,7,6,9,3,4,5,8,2,7,6,2,3,4,5,8,7,6,10,3,4,5,8,9,7,6,9,3,4,5,8,9,7,6,9,3,4,5,8,9,7,4,5,8,9,7,5,8,9,7),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Scatter
        'S' => array(10),
        // Panda
        'P' => array(1),
        // Small Panda
        'M' => array(2),
        // Бамбук
        'B' => array(3),
        // Nature
        'N' => array(4),
        // A
        'A' => array(5),
        // K
        'K' => array(6),
        // Q
        'Q' => array(7),
        // J
        'J' => array(8),
        // 10
        'T' => array(9),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 5,
        '4' => 25,
        '5' => 250,
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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'500.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'250.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'50.00'),

        array('symbol'=>'P', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'P', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'P', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'175.00'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'75.00'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'N', 'count'=>5, 'multiplier'=>'125.00'),
        array('symbol'=>'N', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'N', 'count'=>3, 'multiplier'=>'12.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'2.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'2.00'),

    );
    public $doubleIfWild = false;
}