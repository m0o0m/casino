<?

class three_musketeersParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(9,5,8,6,3,7,0,0,0,9,5,9,6,0,0,0,7,4,6,8,3,6,8,5,6,8,0,0,0,8,6,5,7,8,4,6,0,0,0,9,5,8,6,5,9,3,8,9,5,6,8,0,0,0,6,8,4,9,6,1,1,1,6,9,5,6,9,4,7,6,2,2,2,6,9,5,6,9,2,2,2,9,4,9,6,3,7,6,4,7,9,3,7,4,6,8,0,0,0,6,9,4,9,7,4,9,6,5,6,7,4,9,6,3,8,9,4,9,7,5,9,8,4,9,6,5,9,6,3,9,6,5,9,6,4,7,9,5,6,9,4,7,9,5,6,9,0,0,0,6,9,4,7,9,5,7,9,3,7,6,4,9,6,4,9,6,0,0,0,6,9,5,6,8,4,9,6,1,1,1,6,9,3,6,9,4,9,6,0,0,0,6,9,4,8),
            array(1,1,1,9,5,6,10,6,4,8,7,10,8,4,7,2,2,2,9,4,7,0,0,0,7,5,9,11,11,11,4,7,0,0,0,7,4,8,10,7,4,9,11,11,11,7,4,7,11,11,11,9,4,7,0,0,0,9,3,8,11,11,11,9,3,7,4,7,10,8,4,8,7,10,8,4,9,11,11,11,7,9,2,2,2,6,5,9,11,11,11,6,5,9,11,11,11,6,4,8,10,7,4,6,10,9,4,6,11,11,11,6,5,9,4,7,10,8,4,8,10,8,4,9,3,6,0,0,0,6,10,9,1,1,1,7,4,8,10,8,4,8,10,7,8),
            array(1,1,1,8,5,9,3,9,4,9,10,8,5,7,3,8,9,4,9,3,9,3,8,4,9,11,11,11,9,8,5,6,10,9,4,9,11,11,11,8,4,7,1,1,1,9,4,8,0,0,0,9,5,8,3,7,4,6,5,7,0,0,0,6,3,7,5,6,4,9,8,0,0,0,6,3,9,4,7,3,7,5,6,0,0,0,7,4,9,0,0,0,6,5,7,4,6,5,7,3,7,5,8,4,7,5,7,10,6,5,7,4,8,5,7,10,6,5,7,3,8,5,8,3,7,5,8,4,7,10,7,5,7,0,0,0,8,5,8,10,7,5,8,4,6,10,8,5,7,2,2,2,7,5,6,10,7,4,8,10,7,4,7,5,8,4,8,5,8,3,7,4,6,5,7,0,0,0,6,3,7,5,6,4,7,10,8,5,8,3,7,5,7,4,7,3,7,10,6,5,7,4,7,11,11,11,6,5,7,10,6,5,7,3,7,4,7,10,7,5,6,5,7,10,6,5,7,4,8,5,7,4,6,5,7),
            array(2,2,2,8,6,5,9,11,11,11,7,4,7,10,8,3,8,6,11,11,11,8,6,5,8,11,11,11,6,3,6,2,2,2,9,8,4,9,6,3,7,10,6,5,8,6,5,7,10,6,3,9,7,11,11,11,7,6,4,8,11,11,11,7,4,9,1,1,1,7,3,6,2,2,2,8,5,6,10,8,3,8,11,11,11,7,4,7,3,7,1,1,1,6,3,6,10,8,5,6,8,0,0,0,7,8,5,8,7,11,11,11,7,8,3,8,7,4,6,10,8,3,6,8,5,8,0,0,0,7,4,8,0,0,0,6,4,6,10,8,3,6,10,8,4,8,6,3,8,10,6,4,7,6,0,0,0,8,5,6,7),
            array(0,0,0,8,7,4,9,6,4,7,2,2,2,9,5,7,8,3,6,7,5,8,4,8,2,2,2,6,4,9,5,8,4,9,7,5,8,6,5,9,7,4,7,3,7,9,2,2,2,7,9,4,9,7,5,7,4,8,5,9,4,7,5,6,7,4,6,5,9,5,8,6,4,9,7,1,1,1,8,7,3,9,1,1,1,7,5,9,3,6,5,8,4,9,6,5,8,1,1,1,6,4,9,5,8,7,4,6,8,3,8,5,6,4,7,8),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(11),
        // Красный большой
        'M1' => array(0),
        // Зеленый большой
        'M2' => array(1),
        // Синий большой
        'M3' => array(2),
        // Синий маленький
        'M4' => array(3),
        // Розовый маленький
        'C5' => array(4),
        // Оранжевый маленький
        'C6' => array(5),
        // A
        'S7' => array(6),
        // K
        'S8' => array(7),
        // Q
        'S9' => array(8),
        // J
        'S0' => array(9),
        // Scatter Rapier
        'BN' => array(10),
    );
    // Вайлд
    public $wild = array(11);
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
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
        array('symbol'=> 'M4', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'M1', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'M2', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'M3', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'C5', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'C6', 'count'=> 5, 'multiplier'=> 100.00),
        //array('symbol'=> 'AM', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'M4', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'C5', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'C6', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'M1', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'M2', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'M3', 'count'=> 4, 'multiplier'=> 30.00),
        //array('symbol'=> 'AM', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'M4', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'S7', 'count'=> 5, 'multiplier'=> 25.00),
        array('symbol'=> 'S8', 'count'=> 5, 'multiplier'=> 25.00),
        array('symbol'=> 'S9', 'count'=> 5, 'multiplier'=> 25.00),
        array('symbol'=> 'S0', 'count'=> 5, 'multiplier'=> 25.00),
        array('symbol'=> 'M1', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'M2', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'M3', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'C5', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'C6', 'count'=> 3, 'multiplier'=> 20.00),
        //array('symbol'=> 'AM', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'S7', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'S8', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'S9', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'S0', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'S7', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'S8', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'M1', 'count'=> 2, 'multiplier'=> 3.00),
        array('symbol'=> 'M2', 'count'=> 2, 'multiplier'=> 3.00),
        array('symbol'=> 'M3', 'count'=> 2, 'multiplier'=> 3.00),
        array('symbol'=> 'S9', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'S0', 'count'=> 3, 'multiplier'=> 3.00),
        //array('symbol'=> 'AM', 'count'=> 2, 'multiplier'=> 3.00),
        array('symbol'=> 'BN', 'count'=> 3, 'multiplier'=> 3.00),
    );

}