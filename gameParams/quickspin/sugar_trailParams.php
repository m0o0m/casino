<?

class sugar_trailParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(4,10,8,6,8,5,10,3,10,12,8,4,10,12,8,4,10,12,5,8,6,10,12,8,4,10,0,0,9,6,8,5,10,0,0,8,4,8,12,9,2,10,5,8,0,0,0,10,5,8,2,10,4,10,12,10,6,9,4,8,5,9,6,8,12,10,5,11,6,10,4,8,10,6,8,3,8,5,7,12,8,6,10,4,8,6,10,12,10,6,8,5,10,3,10,4,10,12,8,4,8,12,7,5,9,6,10,8,4,10,12,10,6,8,5,10,6,8,4,8,12,10,6,7,2,9,0,0,10,5,8,12,10,5,7,6,8,12,7,2,7,6,10,4,10,12,10,6,7,4,7,6,8,10,5,11,6,9,4,8,10,6,7,5,9,3,7,5,8),
            array(0,0,0,11,6,9,13,10,4,7,0,0,0,9,3,11,10,6,10,7,13,10,2,7,13,8,6,10,13,9,4,10,12,8,3,9,10,3,8,12,9,6,10,11,2,7,0,0,0,9,6,7,12,10,2,7,13,10,4,10,12,11,2,10,0,0,0,9,2,7,13,9,4,10,12,8,6,7,13,10,3,11,12,10,2,10,0,0,0,11,3,10,13,9,4,10,12,9,6,11,13,7,3,10,13,9,2,11,13,10,4,7,12,10,4,9,13,7,6,7,12,9,4,7,12,11,3,7,13,9,4,10,0,0,0,7,2,7,13,10,4,7,12,11,3,7,10,5,11,0,0,0,10,6,7,12,11,2,7,0,0,0,11,3,11,13,10,2,11,13,9,6,9,3,10,11,5,8),
            array(3,9,14,8,5,7,5,11,14,8,3,7,12,8,3,8,14,10,4,8,14,8,5,11,14,10,3,7,5,11,14,8,0,0,10,3,9,13,8,5,10,14,8,3,11,14,11,0,0,7,2,8,14,11,5,11,13,9,5,11,6,8,2,8,14,10,5,11,14,8,3,11,7,6,11,14,8,5,11,5,8,14,4,10,6,8,12,8,5,7,13,6,11,2,11,13,8,6,9,5,8,6,10,0,0,9,4,8,14,7,6,9,13,3,8,13,11,5,7,14,8,11,3,9,13,8,5,8,6,11,14,8,6,10,3,8,4,8,12,8,6,12,8,5,11,13,9,5,11,10,3,11,13,6,8,5,9,6,11,14,8,3,11,6,12,11,2,8,14,11,5,8,5,11,6,8,2,8,0,0,0,10,5,8,13,3,11,6,8,11,5,8,12,11,4,13,11,6,8,12,8,5,11,13,6,11,2,8,13,6,8,5,8,12,6,11,13,4,9,12,7,6,7,13,3,8,5,8,12,8),
            array(0,0,0,11,2,7,13,9,4,11,13,8,2,10,13,11,0,0,0,8,4,7,14,9,4,9,13,11,2,7,14,9,4,11,14,7,2,11,13,9,6,9,13,7,5,9,7,4,11,13,9,2,7,13,11,4,9,14,7,3,9,14,5,11,0,0,7,2,7,14,4,10,13,5,11,13,3,10,14,6,11,13,2,7,13,4,9,14,6,7,0,0,9,14,11,5,8,0,0,11,14,9,2,7,14,9,2,4,11,14,11,4,11,14,7,2,9,13,8,2,10,0,0,0,11,14,8,4,7,14,7,4,9,13,11,2,7,14,9,6,9,14,5,9,4,11,9,2,7,14,11,4,9,13,11,3,9,5,11,13,7,2,7,4,7,14,10,5,11,3,10,0,0,0,6,7,2,7,13,4,9,6,14,7,2,9,14,11,5,8),
            array(0,0,0,8,3,10,6,8,5,8,3,10,14,8,4,10,0,0,0,11,6,8,3,10,14,8,6,14,7,5,10,2,11,10,6,8,5,10,6,7,3,10,14,9,6,7,2,10,5,8,5,10,6,7,14,8,2,10,6,11,4,9,7,3,8,5,11,2,7,4,10,5,7,3,11,2,7,4,8,10,3,9,5,14,8,5,7,5,10,3,10,14,8,6,8,4,8,6,10,5,8,0,0,0,10,3,8,5,10,5,10,7,2,9,6,14,10,5,8,5,10,6,8,2,11,0,0,0,10,4,9,14,10,6,11,3,8,5,7,0,0,0,9,4,7,5,11,3,8,6,8,4,9,6,8,3,10,5,7,3,9,8,5,11,14,8,3,10,14,8,4,10,6,8,3,10,6,11,5,8,14,10,3,8,5,9,3,10,14,11,6,9,2,10,5,8,14,5,9,6,14,8,2,11,4,9,14,10,6,10,3,8,5,8,2,7,4,10,5,8,3,11,14,6,9,2,7,6,8,4,8,14,7,6,7,3,10,5,8,5,8,5,11,6,8,2,8,6,10,4,9,14,10,6,7,3,8,14,7,4,10,5,10,3,11,6,9,2,11,6,7,4,8,14,9,6,10,3,10,5,8,2,6,8,5,8,2,10,14,8,4,10,6,8,3,10,6,10,0,0,0,9,6,8,5,6,10,14,10,6,10,2,10),
        ),
        array(
            array(4,10,6,8,5,8,10,3,10,8,4,10,8,4,10,5,8,6,10,8,4,10,9,6,8,5,10,8,4,8,9,2,10,5,8,10,5,8,2,10,4,10,6,10,9,4,8,5,9,6,8,10,5,11,6,10,4,8,10,6,8,3,8,5,7,8,6,10,4,8,10,6,10,6,8,5,10,3,10,4,10,8,4,8,7,5,9,6,10,8,4,10,8,6,10,5,10,6,8,4,8,10,6,8,2,9,0,0,0,10,5,8,10,5,7,6,8,7,2,8,6,10,4,10,6,10,8,4,8,6,8,5,10,5,11,6,9,4,8,10,6,8,3,9,5,7,8),
            array(0,0,0,11,9,6,9,10,4,10,7,3,11,10,0,0,0,9,10,6,7,10,2,7,8,4,7,10,3,9,10,3,8,9,4,10,11,2,7,6,7,10,2,7,10,4,10,2,11,4,9,2,7,9,4,10,8,4,7,10,3,11,10,2,10,9,0,0,0,11,7,3,10,9,4,8,9,4,11,7,3,10,9,2,11,10,4,7,10,4,9,0,0,0,7,6,10,7,4,9,11,3,7,9,4,10,11,0,0,0,11,7,2,7,4,7,11,3,10,5,11,10,4,7,2,11,7,3,11,10,2,9,10,6,9,3,10,11,5,8,10),
            array(3,9,8,5,11,5,7,6,8,3,8,3,8,0,0,0,10,4,8,10,5,8,11,3,7,8,5,11,10,3,9,8,5,10,11,3,11,2,8,6,11,5,11,8,5,9,11,6,8,2,8,6,10,5,8,6,11,3,8,6,11,8,5,11,5,8,4,10,6,11,8,5,8,7,6,11,2,11,8,6,9,5,8,6,10,5,9,0,0,0,8,6,8,9,3,11,8,5,8,11,3,9,8,5,8,6,11,0,0,0,8,6,10,3,8,4,8,6,10,5,11,9,5,11,8,3,11,6,8,5,9,6,11,8,3,11,6,11,2,8,11,5,8,5,11,6,8,2,8,6,10,5,8,3,11,6,8,11,5,8,4,11,6,8,11,5,8,11,6,11,2,8,6,8,5,8,6,11,4,9,7,6,7,3,8,5,8),
            array(0,0,0,11,9,2,7,9,4,11,8,2,10,11,0,0,0,11,8,4,9,7,4,7,9,2,7,9,4,11,7,2,11,9,6,7,5,9,7,4,11,9,2,7,11,4,9,3,9,5,11,7,2,7,4,10,5,11,3,10,6,11,2,7,4,9,6,7,2,9,11,5,8,0,0,0,11,9,2,7,9,4,11,8,4,11,7,2,11,9,2,8,10,4,11,7,4,7,9,11,2,7,9,6,9,5,9,4,11,9,2,7,11,4,9,11,3,9,5,11,7,2,7,4,7,10,5,11,3,10,6,7,2,7,4,9,6,7,2,9,11,5,8),
            array(0,0,0,8,3,10,6,8,5,8,3,10,15,8,4,10,0,0,0,11,6,15,8,3,10,15,8,6,7,5,10,2,11,10,6,8,15,5,10,6,7,3,10,15,9,6,7,2,10,15,5,8,5,10,6,7,15,8,2,10,15,6,11,4,9,7,3,8,5,15,11,2,7,4,10,5,7,3,11,2,7,4,8,15,10,3,9,5,8,5,7,5,10,3,10,15,8,6,8,4,8,6,10,5,8,15,10,3,8,5,10,5,10,0,0,0,7,2,9,6,10,5,8,5,10,6,8,2,11,10,4,9,10,6,11,3,8,5,7,4,7,5,11,3,8,6,9,15,8,4,9,6,8,3,10,5,7,3,9,15,8,5,11,8,3,10,15,8,4,10,6,8,3,10,6,11,5,8,15,10,3,8,5,9,3,10,15,11,6,9,2,10,5,8,5,9,6,8,2,11,4,9,15,10,6,10,3,8,5,8,2,7,4,10,5,8,3,11,6,9,2,7,6,8,4,8,15,7,6,7,3,10,5,8,5,8,5,11,6,8,2,8,6,10,4,9,15,10,6,7,3,8,15,7,4,10,5,10,3,11,6,9,2,11,6,7,4,8,15,9,6,10,3,10,5,8,2,6,8,5,8,2,10,15,8,4,10,6,8,3,10,6,10,9,6,8,5,10,6,10,6,10,2,10),
        ),
        array(
            array(4,10,6,8,5,8,10,3,10,8,4,10,8,4,10,5,8,6,10,8,4,10,9,6,8,5,10,8,4,8,9,2,10,5,8,0,0,0,0,10,5,8,2,10,4,10,6,10,9,4,8,5,9,6,8,10,5,11,6,10,4,8,10,6,8,3,8,5,7,8,6,10,4,8,10,6,10,6,8,5,10,3,10,4,10,8,4,8,7,5,9,6,10,8,4,10,10,6,8,5,10,6,8,4,8,10,6,7,2,9,0,0,0,0,10,5,8,10,5,7,6,8,7,2,7,6,10,4,10,6,10,7,4,7,6,8,5,10,5,11,6,9,4,8,10,6,7,3,9,5,7,8),
            array(0,0,0,0,11,9,7,6,9,10,4,7,3,11,10,0,0,0,0,10,6,7,10,2,7,8,6,10,9,4,10,3,9,0,0,0,0,10,3,8,9,6,10,11,2,7,6,7,10,2,7,10,4,10,2,11,0,0,0,0,9,2,7,9,4,10,8,6,7,10,3,11,10,2,10,9,0,0,0,0,11,7,3,10,9,10,4,8,9,6,11,7,3,10,9,2,11,10,4,7,10,4,9,7,6,7,4,9,11,3,7,9,4,10,11,0,0,0,0,11,7,2,7,4,7,11,3,10,5,11,10,6,7,2,11,7,3,10,2,11,9,10,6,9,3,10,11,5,8,10),
            array(3,9,8,5,7,5,11,8,3,7,3,8,10,4,8,5,8,11,10,3,7,5,11,8,10,3,9,8,5,10,11,8,3,11,0,0,0,0,7,2,8,11,5,11,9,8,5,11,6,8,2,8,10,5,8,11,3,7,6,11,8,5,11,5,8,4,10,6,11,8,5,8,7,6,11,2,11,8,6,9,5,8,6,10,4,9,8,7,6,9,3,8,11,7,5,8,0,0,0,0,11,3,9,8,5,8,6,11,8,6,10,3,8,4,8,8,6,5,11,9,5,11,8,10,3,11,6,8,5,9,6,11,8,3,11,6,11,2,8,11,5,8,5,11,6,8,2,8,10,5,8,3,11,6,8,11,5,8,4,11,6,8,5,8,11,6,11,2,8,6,8,5,8,6,11,4,9,7,6,7,3,8,5,8,11,8),
            array(0,0,0,0,0,0,11,9,2,7,9,4,11,8,2,10,11,8,4,9,7,4,7,9,11,2,7,9,4,11,7,2,11,9,6,7,5,9,0,0,0,0,7,4,11,9,2,7,11,4,9,3,9,5,11,0,0,0,0,7,2,7,4,10,5,11,3,10,6,11,2,7,4,9,6,7,2,9,11,5,8,0,0,0,0,11,9,2,7,9,4,11,4,11,7,2,11,9,2,8,10,0,0,0,0,11,8,4,7,4,7,9,11,2,7,9,6,9,5,9,4,11,9,2,7,11,4,9,0,0,0,0,11,3,9,5,11,7,2,7,4,7,10,5,11,3,10,6,7,2,7,4,9,6,7,2,9,11,5,8),
            array(0,0,0,0,0,0,0,0,8,3,10,6,8,5,8,3,10,8,4,10,0,0,0,0,11,6,8,3,10,8,6,7,5,10,2,11,0,0,0,0,10,6,8,5,10,6,7,3,10,9,6,7,2,10,5,8,5,10,6,7,8,2,10,6,11,4,9,0,0,0,0,7,3,8,5,11,2,7,4,10,5,7,3,11,2,7,4,8,10,3,9,5,8,5,7,5,10,3,10,8,6,8,4,8,6,10,5,8,10,3,8,5,10,5,10,7,2,9,6,10,5,8,5,10,6,8,2,11,0,0,0,0,0,0,10,4,9,10,6,11,3,8,5,7,4,7,5,11,3,8,6,9,8,4,9,6,8,3,10,5,7,3,9,8,5,11,8,3,10,8,4,10,6,8,3,10,6,11,5,8,10,3,8,5,9,3,10,11,6,9,2,10,5,8,5,9,6,8,2,11,4,9,10,6,10,3,8,5,8,2,7,4,10,5,8,3,11,6,9,2,7,6,8,4,8,7,6,7,3,10,5,8,5,8,5,11,6,8,2,8,6,10,4,9,10,6,7,3,8,7,4,10,5,10,3,11,6,9,2,11,6,7,4,8,9,6,10,3,10,5,8,2,6,8,5,8,2,10,8,4,10,6,8,3,10,6,10,0,0,0,0,9,6,8,5,10,6,10,6,10,2,10),
        ),


    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Доп.вайлд в бонусе. Z - просто поставил
        'Z' => array(1),
        // Золотая конфета
        'A' => array(2),
        // Полосатая конфета
        'C' => array(3),
        // Красная конфета
        'D' => array(4),
        // Зеленая конфета
        'E' => array(5),
        // Синия конфета
        'G' => array(6),
        // A
        'H' => array(7),
        // K
        'J' => array(8),
        // Q
        'K' => array(9),
        // J
        'L' => array(10),
        // 10
        'N' => array(11),
        // Фиолетовый медведь
        'F' => array(12),
        // Зеленый медведь
        'R' => array(13),
        // Синий медведь
        'M' => array(14),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(14);
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
        array(0,0,0,1,2),
        array(0,1,0,1,2),
        array(2,1,2,1,0),
        array(0,0,0,0,1),
        array(2,2,2,2,1),
        array(0,1,1,2,2),
        array(2,1,1,0,0),
        array(0,0,1,1,2),
        array(2,2,1,1,0),
        array(2,0,2,1,1),
        array(0,2,0,1,1),
        array(1,1,2,1,0),
        array(1,1,0,1,2),
        array(0,1,2,1,1),
        array(2,1,0,1,1),
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.03;
    public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=> 'W', 'count'=> 5, 'multiplier'=> 500.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 80.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 80.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 80.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'L', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'N', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'L', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'N', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'L', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'N', 'count'=> 3, 'multiplier'=> 3.00),

    );

}