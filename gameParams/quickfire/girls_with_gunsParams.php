<?

class girls_with_gunsParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(0,0,0,11,13,3,12,10,8,14,13,2,10,12,7,13,14,6,13,11,1,13,15,9,13,4,11,5,13,3,11,8,14,13,2,11,7,13,11,14,6,13,11,1,13,15,11,13,9,10,13,4,11,12,5,14,11),
            array(0,0,0,10,12,9,14,11,5,10,13,2,12,11,7,14,10,1,12,14,4,10,12,3,14,10,15,12,6,14,10,12,8,14,10,12,9,14,5,10,13,2,12,7,14,8,10,1,12,14,4,12,3,14,15,6,14,10),
            array(0,0,0,11,13,3,11,10,8,14,13,2,10,12,7,13,14,6,13,11,1,13,15,9,13,4,11,5,13,3,11,8,14,13,11,2,12,11,7,13,11,17,13,11,6,14,11,1,13,11,9,13,11,4,12,11,5,13,11),
            array(0,0,0,10,12,9,14,11,5,10,13,2,12,11,7,14,10,1,12,14,4,10,14,12,3,14,10,15,12,6,14,10,12,8,14,11,10,12,9,14,12,5,10,14,2,12,11,7,14,10,1,12,14,4,10,14,12,3,14,10,15,14,12,6,14,10,12,8,14),
            array(0,0,0,11,13,3,12,10,8,14,13,2,10,11,7,13,14,6,13,11,1,13,16,9,13,4,10,5,11,13,3,12,11,8,14,13,2,10,11,7,13,14,6,13,11,1,13,16,9,13,4,12,5,14,11),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Scatter
        'S' => array(15),
        // Leader-Katherine
        'E' => array(1),
        // Artillery-Maria
        'M' => array(2),
        // Sniper-Kira
        'I' => array(3),
        // Demolition-Alex
        'X' => array(4),
        // Tactical-Zoe
        'Z' => array(5),
        // Infiltrator-Jess
        'F' => array(6),
        // Курящий
        'O' => array(7),
        // 2 чувака
        'G' => array(8),
        // Здание
        'H' => array(9),
        // A
        'A' => array(10),
        // K
        'K' => array(),
        // Q
        'Q' => array(12),
        // J
        'J' => array(13),
        // 10
        'T' => array(14),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(15);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 2,
        '4' => 10,
        '5' => 100,
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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'40.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'40.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'350.00'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'70.00'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'I', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'I', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'I', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'X', 'count'=>5, 'multiplier'=>'275.00'),
        array('symbol'=>'X', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'X', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'Z', 'count'=>5, 'multiplier'=>'250.00'),
        array('symbol'=>'Z', 'count'=>4, 'multiplier'=>'45.00'),
        array('symbol'=>'Z', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'F', 'count'=>5, 'multiplier'=>'225.00'),
        array('symbol'=>'F', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'F', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'O', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'O', 'count'=>4, 'multiplier'=>'35.00'),
        array('symbol'=>'O', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'175.00'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'6.00'),

        array('symbol'=>'H', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'H', 'count'=>4, 'multiplier'=>'25.00'),
        array('symbol'=>'H', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'12.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'2.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'10.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'2.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'40.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'8.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'2.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'35.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'6.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'2.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'30.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'5.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'2.00'),
    );
    public $doubleIfWild = false;
}