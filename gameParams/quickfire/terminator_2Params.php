<?

class terminator_2Params extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(8,5,9,4,5,6,7,8,6,2,4,8,6,5,1,10,8,6,7,8,9,5,4,2,6,0,2,1,9,3,6,8,4,3,5,1,3,8,6,9,8,5,6),
            array(5,4,7,8,2,3,7,8,2,5,9,8,7,3,9,7,5,6,1,4,5,3,0,5,3,8,6,2,9,7,6,2,5,8,1,9,4,6,8,9,4,3,8,4,9,6,8,1,7,3,4,8,1,7,5,9,10,3,2,1,6,9,7,6,3,7,8,10,3,5,7,9,1,7,2,1,4,9,2,1,10,4,9,6,5,9,6,5,4,8,9,3,6,2,7,8,6,4,9,6),
            array(9,8,7,5,0,9,8,10,7,9,2,3,7,6,5,8,7,1,8,6,4,7,8,9,6,3,7,9,8,2,3,4,5,8,1,3,4,9,8,2,7,6,2,5,7,8,6,7,3,6,4,8,1,4,8,3,7,9,6,7,5,8,1,9,6,1,8,6,7,9,10,4,8,6,9,5,3,4,10,7,2,5,7),
            array(2,4,9,2,10,9,7,3,8,7,6,8,7,5,10,7,2,5,9,8,10,1,4,6,7,0,5,2,9,3,4,5,8,3,4,1,9,2,5,7,6,8,5,3,4,9,7,3,9,8,7,2,1,5,2,4,5,3,9,7,1,3,5,4,1,7,3,1,9,4,3,2,9,4,1,7,4,3,7,1,5,6),
            array(5,2,9,6,8,4,6,0,7,9,8,7,1,8,10,6,8,5,1,3,8,5,6,3,8,2,3,6,2,8,6,5,9,6,4,1,6,8,9,4),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Scatter
        'S' => array(10),
        // Terminator
        'T' => array(1),
        // John Connor
        'J' => array(2),
        // T - 1000
        'H' => array(3),
        // Sarah Connor
        'C' => array(4),
        // T - 800
        'E' => array(5),
        // Пика
        'P' => array(6),
        // Чирва
        'I' => array(7),
        // Бубна
        'B' => array(8),
        // Креста
        'K' => array(9),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(13);
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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'1500.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'300.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'50.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'800.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'150.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'500.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'H', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'H', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'H', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'C', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'C', 'count'=>4, 'multiplier'=>'45.00'),
        array('symbol'=>'C', 'count'=>3, 'multiplier'=>'12.00'),

        array('symbol'=>'E', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'E', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'E', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'P', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'P', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'P', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'I', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'I', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'I', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'50.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'5.00'),

    );
    public $doubleIfWild = false;
}