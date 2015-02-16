<?

class supernovaParams extends Params {
    public $reels = array(
        // раскладка для главной игры.
        array(
            array(),
            array(),
            array(),
            array(),
            array(),
        ),
    );
    // Символы
    public $symbols = array(

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