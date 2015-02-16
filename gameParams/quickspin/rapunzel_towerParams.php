<?

class rapunzel_towerParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(0,0,0,5,9,4,5,3,7,5,2,5,7,4,9,5,1,9,4,5,2,7,9,1,5,9,4,5,7,2,8,9,4,5,7,2,9,4,5,3,7,9,4,5,7,3,9,6,4,10,7,3,6,10,4,8,7,3,6,4,10,8,3,6,10,4,6,7,3,9,4,10,3,7,9,1,8,7,3,6,4,8,9,1,10,3,9,8,4,5),
            array(11,11,5,2,10,12,5,4,8,5,12,10,4,8,1,6,5,4,6,12,8,2,8,4,5,12,6,4,6,8,2,6,5,4,6,11,11,8,2,8,4,6,11,11,10,1,5,4,8,2,10,4,6,1,8,12,9,1,10,6,2,8,4,6,2,10,11,11,8,2,6,12,8,3,6,11,11,10,4,8,2,8,12,10,8,2,7,6,11,11,10,8,2,6,4,10,12,6,3,7,2,6,4,9,2,10,12,7,2,10,1,8,0,0,0,10,4,7,2,6,12,8,4,10,1,10,4,6,2,8,12,6,4,10,2,6,0,0,10,2,7,12,10,3,8,11,11,7,4,6,12,10,2,8,11,11,9,4,10,12,10,2,8,4,6),
            array(11,11,5,9,2,5,4,7,3,5,1,5,7,4,9,12,5,4,5,2,7,4,9,2,5,9,2,5,3,9,2,7,4,9,3,6,4,9,3,5,4,6,11,11,9,1,5,4,7,1,9,3,7,2,10,12,6,1,9,7,3,6,9,12,7,4,7,0,0,0,9,4,9,12,7,3,9,4,7,2,9,4,8,12,7,3,7,11,8,3,7,12,9,3,5,2,9,8,4,5,9,12,5,4,7,3,9,1,5,11,7,3,9,1,5,3,7,2,9,1,5,2,7,3,9,10,12,5,3,10,2,5,7,3,9,5,12,9,2,6,3,9),
            array(6,3,10,12,6,3,5,8,11,11,6,4,10,6,3,8,1,5,12,10,8,4,10,0,0,5,1,10,2,10,12,8,10,1,6,10,6,1,6,8,1,10,6,2,10,0,0,0,9,6,12,8,2,9,10,11,11,6,8,2,8,6,4,8,0,0,0,8,6,1,8,12,10,8,1,6,7,3,8,10,11,11,8,2,8,10,3,6,12,6,2,10,8,2,8,9,4,10,1,7,4,8,7,2,6),
            array(0,0,0,5,9,1,5,7,3,9,7,4,5,9,1,5,7,4,9,5,1,9,5,2,7,3,7,9,1,5,9,1,7,5,2,7,9,1,5,7,3,5,1,9,5,3,9,7,2,9,1,7,5,0,0,0,10,1,7,3,6,10,8,7,3,6,10,8,3,6,5,3,7,1,9,7,3,9,7,3,9,4,8,9,5),
        ),

    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Принц
        'A' => array(1),
        // Ведьма
        'B' => array(2),
        // Король
        'C' => array(3),
        // Королева
        'D' => array(4),
        // A
        'E' => array(5),
        // K
        'F' => array(6),
        // Q
        'G' => array(7),
        // J
        'H' => array(8),
        // 10
        'I' => array(9),
        // 9
        'J' => array(10),
        // Sticky Wild
        'T' => array(11),
        // Tower
        'S' => array(12),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(12);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
        '4' => 3,
        '5' => 3,
    );
    // Выигрышные линии
    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(1,0,1,0,1),
        array(1,2,1,2,1),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(0,2,0,1,1),
        array(2,0,2,1,1),
        array(0,2,1,0,1),
        array(2,0,1,2,1),
        array(0,0,1,0,1),
        array(2,2,1,2,1),
        array(1,1,0,1,1),
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=> 'W', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 150.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 40.00),

        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 30.00),

        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 30.00),

        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 15.00),

        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 15.00),

        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 5.00),

        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 5.00),



        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 5.00),

        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 5.00),

        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 5.00),

        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 5.00),

    );

}