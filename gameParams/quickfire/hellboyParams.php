<?

class hellboyParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(0,6,10,2,7,8,4,9,6,3,7,10,5,8,1,11,10,2,7,8,4,9,6,3,9,10,5,8,1,9,5,10,9,4,10,9,6,3,7),
            array(0,7,9,4,6,8,1,10,9,3,7,10,5,9,6,2,10,3,8,4,11,7,9,4,6,8,1,10,9,3,7,10,5,9,6,2,10,5,8),
            array(0,8,7,1,6,9,4,10,8,5,7,9,2,10,6,3,9,2,10,11,8,7,1,6,9,4,10,8,5,7,9,5,10,6,5,9,10,5),
            array(0,8,6,2,9,4,10,3,7,2,6,1,9,3,10,4,7,5,8,1,7,10,5,9,4,6,10,5,8,3,10,2,8,9,5,7,11,6,2,9,4,10,9,3),
            array(0,9,8,5,6,3,7,1,8,4,10,2,6,3,7,4,9,10,3,6,4,8,1,7,5,9,4,8,3,10,5,9,2,7,11,5,6,10),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild Hellboy Title
        'W' => array(0),
        // Scatter
        'S' => array(11),
        // HellBoy
        'H' => array(1),
        // Hellboy Girlfriend
        'G' => array(2),
        // Стремный
        'M' => array(3),
        // Робот
        'R' => array(4),
        // Седоволосый
        'O' => array(5),
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
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(11);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 2,
        '3' => 4,
        '4' => 25,
        '5' => 500,
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = true;

    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(1,0,0,0,1),
        array(1,2,2,2,1),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
    );

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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'10000'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'1000'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'100'),

        array('symbol'=>'H', 'count'=>5, 'multiplier'=>'5000'),
        array('symbol'=>'H', 'count'=>4, 'multiplier'=>'500'),
        array('symbol'=>'H', 'count'=>3, 'multiplier'=>'50'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'2000'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'200'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'40'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'1000'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'100'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'30'),

        array('symbol'=>'R', 'count'=>5, 'multiplier'=>'750'),
        array('symbol'=>'R', 'count'=>4, 'multiplier'=>'60'),
        array('symbol'=>'R', 'count'=>3, 'multiplier'=>'20'),

        array('symbol'=>'O', 'count'=>5, 'multiplier'=>'500'),
        array('symbol'=>'O', 'count'=>4, 'multiplier'=>'40'),
        array('symbol'=>'O', 'count'=>3, 'multiplier'=>'15'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'150'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'25'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'10'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'125'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'20'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'8'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'100'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'15'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'6'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'90'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'12'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'5'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'80'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'10'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'5'),

    );
    public $doubleIfWild = true;
}