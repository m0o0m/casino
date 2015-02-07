<?

class thedark_knight_risesParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(4,11,6,2,12,10,6,4,9,2,8,6,9,11,6,7,10,11,2,7,4,9,11,7,4,8,2,11,10,7,9,5,2,7,11,4,2,6,9,7,2,9,7,6,3,7,9,11,4,6,0,11,5,4,11,6,9,11,4,6,9,7,12,9,7),
            array(8,3,5,11,8,10,3,12,5,6,10,12,11,10,7,8,3,10,8,11,5,8,9,10,8,4,11,9,8,10,3,5,10,2,6,4,7,5,9,10,5,3,10,0,8,3,5,8,9,3,8,5,10),
            array(9,8,7,10,5,11,9,7,5,9,6,4,7,3,4,9,1,11,3,5,12,7,11,5,7,3,9,7,3,11,5,3,10,8,3,11,5,6,8,9,7,10,3,11,4,3,5,2,7,5,9,11,10,6,9,2,11,3,9,6,5,9,11,2,0,8,9,6,5,11,8,4,2,8,11,7,5,9,11,7,3,11,7,3,9,2,5,6,4,1,9,10,4,9,3,5,11,7,8,10,11,12,10,3,7,12,9,7,5,8,7,3,9,5,7,3,10,6,11,12,3,6,5,7,2,11),
            array(5,8,7,2,4,9,8,11,4,8,10,2,3,9,11,6,10,5,8,2,10,6,4,10,9,12,6,2,8,4,11,6,7,8,0,4,10,2,6,10,9,11,6,8,10,2,6,4,2,3,8,10),
            array(11,12,2,8,4,6,5,4,9,10,12,2,6,11,10,9,2,4,10,8,4,6,11,0,4,6,10,3,4,8,2,4,10,9,8,10,9,6,8,11,2,5,10,8,7,2,8,7,6,3,8,10),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Expanding Wild
        'E' => array(1),
        // Scatter
        'S' => array(12),
        // Batman
        'B' => array(2),
        // Bane
        'N' => array(3),
        // CatWoman
        'C' => array(4),
        // Robin
        'R' => array(5),
        // Miranda
        'M' => array(6),
        // Gordon
        'G' => array(7),
        // A
        'A' => array(8),
        // K
        'K' => array(9),
        // Q
        'Q' => array(10),
        // J
        'J' => array(11),
    );
    // Вайлд
    public $wild = array(0, 1);
    // Скаттер
    public $scatter = array(13);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 5,
        '4' => 15,
        '5' => 50,
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = false;

    public $winLines = array();

    public $winLineType = '243';
    public $minWinCount = 3;

    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'1000.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'200.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'75.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'500.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'N', 'count'=>5, 'multiplier'=>'450.00'),
        array('symbol'=>'N', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'N', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'C', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'C', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'C', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'R', 'count'=>5, 'multiplier'=>'350.00'),
        array('symbol'=>'R', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'R', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'250.00'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'125.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'125.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'5.00'),

    );
    public $doubleIfWild = false;
}