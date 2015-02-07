<?

class battlestar_galacticaParams extends Params {
    // раскладки
    // Главная, Капитан Америка, Халк, Тор, Железный человек.
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(0,0,0,11,5,13,2,6,12,1,10,11,8,13,9,7,12,3,10,14,11,5,13,9,6,12,4,10,11,8,13,9,7,12,10,11,13,12,10,9),
            array(0,9,3,12,1,13,2,11,4,10,9,7,12,5,13,6,11,8,10,14,9,7,12,5,13,6,11,8,10),
            array(0,9,3,12,1,13,2,11,4,10,9,7,12,5,13,6,11,8,10,14,9,7,12,5,13,6,11,8,10),
            array(0,9,3,12,1,13,2,11,4,10,9,7,12,5,13,6,11,8,10,14,9,7,12,5,13,6,11,8,10),
            array(0,7,11,13,5,10,8,12,9,6,14,1,4,7,11,13,5,10,8,12,9,6,2,3,9),
        ),
    );
    // Символы
    public $symbols = array(
        // WILD
        'W' => array(0),
        // Scatter
        'S' => array(14),
        // Starbuck
        'B' => array(1),
        // Apollo
        'P' => array(2),
        // Baltar
        'L' => array(3),
        // Six
        'X' => array(4),
        // Coltigh
        'C' => array(5),
        // Helo
        'H' => array(6),
        // Ellen
        'E' => array(7),
        // Tyrol
        'Y' => array(8),
        // A
        'A' => array(9),
        // K
        'K' => array(10),
        // Q
        'Q' => array(11),
        // J
        'J' => array(12),
        // 10
        'T' => array(13),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(14);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 5,
        '4' => 10,
        '5' => 50,
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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'600.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'40.00'),
        array('symbol'=>'W', 'count'=>2, 'multiplier'=>'4.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'35.00'),

        array('symbol'=>'P', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'P', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'P', 'count'=>3, 'multiplier'=>'35.00'),

        array('symbol'=>'L', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'L', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'L', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'X', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'X', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'X', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'C', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'C', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'C', 'count'=>3, 'multiplier'=>'25.00'),

        array('symbol'=>'H', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'H', 'count'=>4, 'multiplier'=>'40.00'),
        array('symbol'=>'H', 'count'=>3, 'multiplier'=>'25.00'),

        array('symbol'=>'E', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'E', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'E', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'Y', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'Y', 'count'=>4, 'multiplier'=>'30.00'),
        array('symbol'=>'Y', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'60.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'40.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'10.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'5.00'),

    );
    public $doubleIfWild = false;
}