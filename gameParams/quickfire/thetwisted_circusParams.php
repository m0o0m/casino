<?

class thetwisted_circusParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(0,8,6,4,8,2,1,6,4,8,2,6,4,8,6,5,2,6,4,8,2,3,6,4,8,2,6,4,8,2,6,4,8,2,6,4,8,2,7,8,6,9,8,6,9,8,6,4),
            array(0,5,3,7,1,2,5,3,7,1,5,3,7,1,3,6,5,3,7,1,5,3,7,1,5,3,7,1,5,3,7,1,9,7,5,3,7,1,4,8,5,7,1,5,7,1,5,7),
            array(0,6,4,8,2,5,1,2,6,4,8,2,6,4,8,2,10,3,8,6,4,8,2,6,4,8,2,6,4,10,6,4,8,2,9,8,2,7,6,4,8,2,6,4,10,6,4,8,2),
            array(0,5,3,7,1,2,5,3,7,1,5,3,7,1,3,6,5,3,7,1,5,3,7,1,5,3,10,1,5,3,7,1,9,7,5,3,7,10,4,8,5,7,1,5,10,7,1,5,7),
            array(0,7,6,1,5,8,2,7,8,3,5,6,4,8,1,6,7,10,5,4,7,6,1,5,8,2,7,8,3,5,6,4,8,2,6,7,10,5,7,9,3,6,10,5,8),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Scatter
        'S' => array(9),
        // Bonus
        'B' => array(10),
        // Огнедышащий
        'F' => array(1),
        // Зеленая
        'G' => array(2),
        // Силач
        'P' => array(3),
        // Близнецы
        'Z' => array(4),
        // Гимнастка
        'M' => array(5),
        // Фокусница
        'O' => array(6),
        // Цыганка :D
        'C' => array(7),
        // Мартышка
        'K' => array(8),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(9);
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
        array('symbol'=>'W', 'count'=>5, 'multiplier'=>'750.00'),
        array('symbol'=>'W', 'count'=>4, 'multiplier'=>'300.00'),
        array('symbol'=>'W', 'count'=>3, 'multiplier'=>'125.00'),

        array('symbol'=>'F', 'count'=>5, 'multiplier'=>'250.00'),
        array('symbol'=>'F', 'count'=>4, 'multiplier'=>'100.00'),
        array('symbol'=>'F', 'count'=>3, 'multiplier'=>'40.00'),

        array('symbol'=>'G', 'count'=>5, 'multiplier'=>'200.00'),
        array('symbol'=>'G', 'count'=>4, 'multiplier'=>'80.00'),
        array('symbol'=>'G', 'count'=>3, 'multiplier'=>'30.00'),

        array('symbol'=>'P', 'count'=>5, 'multiplier'=>'175.00'),
        array('symbol'=>'P', 'count'=>4, 'multiplier'=>'60.00'),
        array('symbol'=>'P', 'count'=>3, 'multiplier'=>'25.00'),

        array('symbol'=>'Z', 'count'=>5, 'multiplier'=>'150.00'),
        array('symbol'=>'Z', 'count'=>4, 'multiplier'=>'50.00'),
        array('symbol'=>'Z', 'count'=>3, 'multiplier'=>'20.00'),

        array('symbol'=>'M', 'count'=>5, 'multiplier'=>'100.00'),
        array('symbol'=>'M', 'count'=>4, 'multiplier'=>'20.00'),
        array('symbol'=>'M', 'count'=>3, 'multiplier'=>'5.00'),

        array('symbol'=>'O', 'count'=>5, 'multiplier'=>'90.00'),
        array('symbol'=>'O', 'count'=>4, 'multiplier'=>'15.00'),
        array('symbol'=>'O', 'count'=>3, 'multiplier'=>'8.00'),

        array('symbol'=>'C', 'count'=>5, 'multiplier'=>'80.00'),
        array('symbol'=>'C', 'count'=>4, 'multiplier'=>'12.00'),
        array('symbol'=>'C', 'count'=>3, 'multiplier'=>'6.00'),

        array('symbol'=>'K', 'count'=>5, 'multiplier'=>'70.00'),
        array('symbol'=>'K', 'count'=>4, 'multiplier'=>'10.00'),
        array('symbol'=>'K', 'count'=>3, 'multiplier'=>'5.00'),
    );
    public $doubleIfWild = true;
}