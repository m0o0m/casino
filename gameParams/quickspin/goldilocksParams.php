<?

class goldilocksParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(0,8,2,10,6,4,8,2,6,5,10,4,8,7,2,6,9,2,8,4,10,6,2,7,10,4,6,2,10,9,5,8,4,9,8,5,10,2,6,4,10,8,2,6,8,4,6,5,8,2,6,8,3,6,4,8,7,2,6,8,2,8,4,6,7,4,6,2,8,10,3,8,4,9,3,6,4,8,2,9,6,4,10,3,10,6),
            array(0,7,2,7,11,9,3,8,5,7,3,9,5,6,3,9,11,8,3,9,5,10,9,1,10,9,5,7,2,9,10,1,9,10,3,7,5,9,11,8,4,6,5,10,9,1,10,9,3,8,5,7,3,10,9,1,10,9,3,6,2,8,11,6,5,10,9,1,10,9,5,7,3,6,5,10,3,7,4,10,3,7,11,6,4,10,3,7,11,10,3,7,11,10,5,7,3,9,5,7,2,10,3,7,11,7,5,9,3,10,5,8,11,9,5,7,11,10,5,7,4,10),
            array(0,6,2,10,4,6,3,8,2,6,8,1,6,8,2,10,4,8,11,7,2,6,4,9,2,6,10,1,6,10,4,8,11,6,2,10,5,9,4,8,5,9,2,8,2,10,5,6,2,8,11,6,4,10,2,6,10,1,6,10,4,7,2,6,10,1,6,10,2,10,11,8,2,10,4,8,11,10,2,7,11,10,4,6,8,1,6,8,11,6,2,8,3,6,4,9,2,8,4,6,3,8,11,6,4,8,3,7,4,6,5,10,4,8),
            array(0,9,5,7,9,1,7,9,3,7,11,7,3,10,5,9,2,8,5,7,3,9,0,9,3,7,11,9,5,8,0,7,5,10,4,7,3,10,11,6,5,9,3,10,4,9,5,7,0,6,5,7,3,8,0,10,2,6,5,9,3,9),
            array(0,8,2,6,5,9,4,7,2,10,4,8,3,7,0,6,5,9,2,6,0,7,4,6,2,9,3,8,5,9,3,9,5,7,4,8,2,9,5,6,0,10,3,7,4,8,3,8),
        ),

    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Multiplier wild
        'K' => array(1),
        // Медведь
        'A' => array(2),
        // Медведица
        'B' => array(3),
        // Медвежонок
        'C' => array(4),
        // Игрушка
        'D' => array(5),
        // A
        'E' => array(6),
        // K
        'F' => array(7),
        // Q
        'G' => array(8),
        // J
        'H' => array(9),
        // 10
        'I' => array(10),
        // Девочка
        'S' => array(11),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(11);
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
        array(0,0,1,0,0),
        array(2,2,1,2,2),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        array(1,0,1,0,1),
        array(1,2,1,2,1),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,2,2,2),
        array(2,1,0,0,0),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        array(0,2,2,2,0),
        array(2,0,0,0,2),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
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
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 250.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'W', 'count'=> 2, 'multiplier'=> 5.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 2.00),
    );

}