<?

class immortal_romanceParams extends Params {
    // раскладки
    // Главная, Капитан Америка, Халк, Тор, Железный человек.
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(0,1,12,9,4,11,6,7,8,3,1,12,4,7,13,10,8,3,12,9,2,4,11,13,6,10,9,3,1,11,7,10,12,6,5,12,13,5,2,13,12,8,11,12,5),
            array(0,12,1,8,11,6,5,4,12,10,7,12,1,8,12,6,5,10,4,9,7,3,12,1,8,6,12,10,4,9,7,12,8,11,12,5,4,9,7,3,1,8,11,6,5,10,9,7,12,3,4,2,11,3,12,13,3),
            array(0,1,12,8,7,11,6,13,10,4,9,8,7,6,10,4,1,3,12,8,7,11,6,5,4,9,2,12,8,7,11,6,5,10,4,9,1,12,8,7,11,6,5,10,4,9,2,3,8,11,6,10,4,2,12,7,11,5,3,9,13,12),
            array(0,12,1,8,11,6,5,4,9,7,1,8,6,5,10,4,7,3,12,1,8,11,6,5,10,4,9,7,12,1,8,11,6,5,10,4,9,7,2,3,1,8,11,5,10,4,9,12,13,11,3,2,10),
            array(0,1,12,9,4,12,7,10,8,3,1,12,4,11,12,7,10,8,3,1,9,4,11,6,7,10,8,3,5,1,12,9,2,11,6,10,8,5,1,9,4,2,3,6,7,10,8,12,9,4,2,3,11,6,7,5,12,4,2,11,10,5,12,13,9),
        ),
    );
    // Символы
    public $symbols = array(
        // Девушка в красном
        'R' => array(1),
        // A
        'A' => array(7),
        // Девушка в зеленом
        'G' => array(4),
        // J
        'J' => array(10),
        // 9
        'N' => array(12),
        // Q
        'Q' => array(9),
        // Замок
        'H' => array(5),
        // K
        'K' => array(8),
        // Книга, свеча, бокал
        'B' => array(6),
        // Темный чувак
        'D' => array(3),
        // Scatter Lion
        'S' => array(13),
        // 10
        'T' => array(11),
        // Белый чувак
        'W' => array(2),
        // Wild
        'I' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(13);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 2,
        '4' => 20,
        '5' => 200,
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
        array('symbol'=>'I', 'count'=>5, 'multiplier'=>'1500.00'),
        array('symbol'=>'I', 'count'=>4, 'multiplier'=>'250.00'),
        array('symbol'=>'I', 'count'=>3, 'multiplier'=>'100.00'),

        array('symbol'=>'R', 'count'=>5, 'multiplier'=>'500.00'),
        array('symbol'=>'R', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'R', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'450.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'D', 'count'=>5, 'multiplier'=>'400.00'),
        array('symbol'=>'D', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'D', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'350.00'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'H', 'count'=>5, 'multiplier'=>'300.00'),
        array('symbol'=>'H', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'H', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'B', 'count'=>5, 'multiplier'=>'250.00'),
        array('symbol'=>'B', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'B', 'count'=>3, 'multiplier'=>'15.00'),

        array('symbol'=>'A', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'A', 'count'=>4, 'multiplier'=>'25.00'),
        array('symbol'=>'A', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'25.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'10.00'),

        array('symbol'=>'Q', 'count'=>5, 'multiplier'=>'125.00'),
        array('symbol'=>'Q', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'Q', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'J', 'count'=>5, 'multiplier'=>'125.00'),
        array('symbol'=>'J', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'J', 'count'=>3, 'multiplier'=>'7.00'),

        array('symbol'=>'T', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'T', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'T', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'N', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'N', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'N', 'count'=>3, 'multiplier'=>'5.00'),
    );
    public $doubleIfWild = true;
}