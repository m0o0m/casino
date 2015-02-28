<?

class treasure_islandParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(7,13,9,11,15,11,8,13,6,13,1,11,7,13,15,11,7,13,8,11,9,13,15,11,7,13,1,12,9,11,8,13,15,11,7,11,15,12,5,13,8,11,1,13,8,11,5,13,7,13,15,13,9,12,7,11,8,12,9,11,1,13,8,14,9,13,7,11,15,13,9,11,6,11,8,10,15,11,9,13,7,11,9,13,15,13,9,11,8,13,6,13,7,13,15,11,7,11,10,8,12,9,13,15,11,7,13,1,13,9,11,8,13,15,11,9,7,11,15,13,9,10,5,12,0,0,0,0,13,8,11,1,13,8,10,9,11,15,10,5,10,9,13,7,13,15,13,9,10,7,10,9,11,8,13,8,14,9,12,7,11,15,13,9,10,6,12,8,10,15,11),
            array(0,0,0,0,14,12,10,9,12,13,7,10,6,14,13,0,0,0,0,13,9,10,13,5,10,11,9,13,12,7,13,6,12,13,6,11,12,9,13,14,5,10,9,10,13,5,10,13,7,13,5,14,0,0,0,0,12,5,10,12,7,13,11,9,10,13,6,14,13,5,13,12,0,0,0,0,14,10,6,13,12,13,7,11,12,9,14,10,6,13,12,5,14,13,7,10,13,7,12,10,9,10,7,12,14,6,10,12,7,13,14,0,0,0,0,14,10,5,10,7,10,14,6,13,8,14,13,9,10,5,14,10,6,13,5,14,12,13,9,12,6,13,14,8,11,13),
            array(6,12,11,8,10,8,14,15,11,6,10,6,11,13,7,11,15,11,13,8,14,6,10,8,14,15,11,13,6,12,1,11,8,13,14,15,11,6,14,0,0,0,0,10,5,11,14,8,14,1,12,11,8,14,9,11,5,11,15,13,14,8,14,1,11,14,6,10,9,11,8,14,8,11,7,13,9,11,15,11,14,8,10,9,14,5,11,9,12,8,11,9,13,7,12,11,15,10,9,12,6,11,1,14,10,8,11,14,6,12,1,11,8,11,9,14,15,11,9,13,6,11,7,11,15,11,9,8,14,1,12,8,14,11,15,13,6,14,9,11,8,12,9,14,15,11,6,14,9,14,5,11,14,8,11,8,14,9,11,5,11,15,13,8,11,6,14,9,11,14,8,11,7,14,9,11,15,11,8,14,9,14,5,11,9,11,8,11,9,14,7,12,15,10,9,10,6,11,8,11,15,14,11),
            array(0,0,0,0,0,0,14,12,5,10,12,7,14,11,5,13,14,11,7,10,12,10,7,12,14,5,10,12,7,14,10,5,14,12,9,10,8,12,10,7,14,12,5,10,14,7,12,6,12,8,14,10,5,10,7,13,8,14,6,13,9,14,5,10,7,12,9,10,5,12,14,8,11,0,0,0,0,14,12,5,10,12,7,14,7,14,10,5,14,12,11,5,13,0,0,0,0,0,14,11,7,10,10,7,12,14,5,10,12,9,12,8,12,7,14,12,5,10,14,7,12,0,0,0,0,14,6,12,8,14,10,5,10,7,10,13,8,14,6,13,9,10,5,10,7,12,9,10,5,12,14,8,11),
            array(0,0,0,0,11,6,13,11,9,13,8,11,6,13,15,11,7,11,14,9,11,6,13,1,11,9,10,13,8,13,5,14,13,9,11,8,13,9,10,6,13,1,12,9,10,5,13,8,11,8,13,9,10,1,11,5,13,9,14,7,12,15,10,6,14,8,14,5,10,7,13,8,10,6,14,5,10,7,11,15,13,6,12,8,11,8,10,8,13,6,13,15,11,9,11,7,11,9,13,8,11,1,13,6,11,8,13,8,10,5,12,9,13,8,11,8,13,9,11,5,14,1,13,7,12,15,13,9,14,6,11,8,10,7,10,8,14,6,11,9,11,7,12,15,12,9,11,6,13,8,10,6,12,8,14,11,6,13,15,11,7,13,9,11,6,13,9,14,8,11,1,13,6,11,8,12,6,13,15,14,9,12,5,13,8,11,8,12,9,11,5,14,7,12,15,13,9,13,6,11,8,11,5,10,7,13,8,11,6,9,12,5,10,9,11,7,11,15,10,9,10,6,13,8,11,8,11,8,14,9,11,5,11,9,13,7,12,15,13,9,10,6,10,7,13,8,13,6,14,9,12,5,14,9,10,7,11,15,12,9,13,6,13,8,11,5,13,9,11,8,11,5,13,15,11,7,13,9,11,6,13,9,13,0,0,0,0,0,12,9,11,8,9,13,15,13,9,13,5,13),
        )
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Wild TNT
        'B' => array(1),
        // Мальчик
        'H' => array(5),
        // Скелет
        'F' => array(6),
        // Пират
        'L' => array(7),
        // Дед
        'G' => array(8),
        // Пиратка
        'N' => array(9),
        // A
        'A' => array(10),
        // K
        'K' => array(11),
        // Q
        'Q' => array(12),
        // J
        'J' => array(13),
        // 10
        'T' => array(14),
        // Scatter
        'S' => array(15),

    );
    // Вайлд
    public $wild = array(0,1);
    // Скаттер
    public $scatter = array(15);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
    );
    // Выигрышные линии
    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(3,3,3,3,3),
        array(0,0,1,2,3),
        array(2,1,0,1,2),
        array(1,2,3,2,1),
        array(3,3,2,1,0),
        array(0,1,2,3,3),
        array(1,0,0,0,1),
        array(2,3,3,3,2),
        array(3,2,1,0,0),
        array(0,1,0,1,0),
        array(3,2,3,2,3),
        array(3,2,1,0,1),
        array(0,1,2,3,2),
        array(1,0,1,2,3),
        array(2,3,2,1,0),
        array(2,3,3,2,1),
        array(1,0,0,1,2),
        array(0,1,2,1,1),
        array(3,2,1,2,2),
        array(1,1,0,1,2),
        array(2,2,3,2,1),
        array(3,3,3,2,1),
        array(0,0,0,1,2),
        array(0,1,2,2,2),
        array(3,2,1,1,1),
        array(0,0,0,0,1),
        array(3,3,3,3,2),
        array(1,2,1,2,1),
        array(2,1,2,1,2),
        array(0,2,0,2,0),
        array(3,1,3,1,3),
        array(1,3,1,3,1),
        array(2,0,2,0,2),
        array(1,0,1,0,1),
        array(2,3,2,3,2),
        array(3,0,0,0,3),
        array(0,3,3,3,0),
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
        array('symbol'=> 'W', 'count'=> 5, 'multiplier'=> 500.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'L', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'N', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 60.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'L', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'Q', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'T', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'L', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'N', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'N', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'Q', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'T', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'Q', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'T', 'count'=> 3, 'multiplier'=> 3.00),
    );

    public $winPay2 = array(
        array('symbol'=> 'W', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'L', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'N', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'N', 'count'=> 4, 'multiplier'=> 40.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 40.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'L', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 20.00),
        array('symbol'=> 'Q', 'count'=> 5, 'multiplier'=> 20.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 20.00),
        array('symbol'=> 'T', 'count'=> 5, 'multiplier'=> 20.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'L', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'Q', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'T', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'N', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'Q', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'T', 'count'=> 3, 'multiplier'=> 2.00),
        array('symbol'=> 'S', 'count'=> 3, 'multiplier'=> 0.00),
    );

}