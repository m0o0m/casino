<?

class x_menParams extends Params {
    // раскладки
    // Основная, FS Villain, FS Hero
    public $reels = array(
        // раскладка для главной игры
        array(
            array(4,5,6,3,7,8,4,9,10,11,5,6,1,7,8,2,6,10,3,5,6,3,7,8,2,9,10,3,8,10,4,9,8,2,10,8,3,10,6,0,7,8,1,9,10),
            array(0,7,8,1,10,9,2,5,4,9,8,3,6,4,10,2,5,6,1,7,8,2,6,10,3,5,6,3,7,8,11,9,10,3,8,10,4,9,8,2,7,10,3,6,10),
            array(9,10,2,5,6,3,7,8,4,9,10,11,5,6,1,7,8,2,6,10,3,5,6,4,10,0,9,11,10,3,8,10,4,9,6,11,7,9,3,10,6,0,7,8,1),
            array(7,8,1,10,9,2,5,6,3,8,9,4,11,10,9,6,5,2,7,8,1,6,10,3,5,6,4,7,8,2,9,10,3,8,10,4,9,2,6,10,8,4,6,10,0),
            array(5,6,0,7,8,1,9,10,2,5,6,3,7,8,4,9,10,11,5,6,1,7,8,2,9,10,3,5,6,4,7,8,2,9,10,3,8,10,4,9,3,10,9,4,8),
        ),
        // Villain mod
        array(
            array(7,9,0,5,3,1,9,7,5,3,9,7,5,1,9,5,7,9,3,5,7,9,5,7,9,1,5,9,3,7,5,9,3,7,9,3),
            array(9,7,0,5,3,1,9,7,5,3,9,7,5,1,9,5,7,9,3,5,7,9,5,7,9,1,5,9,3,7,5,9,3,7,1,3),
            array(7,9,1,7,9,2,3,5,1,7,5,3,1,9,3,5,7,9,2,7,5,3,9,1,5,9,3,5,7,3,9,0,7,1,9,5),
            array(9,7,0,5,3,1,9,7,5,3,9,7,5,1,9,5,7,9,3,5,7,9,5,7,9,1,5,9,3,7,5,9,3,7,1,3),
            array(9,7,0,5,3,1,9,7,5,3,9,7,5,1,9,5,7,9,3,5,7,9,5,7,9,1,5,9,3,7,5,9,3,7,1,3),
        ),
        // Hero mod
        array(
            array(6,10,0,6,4,2,10,8,6,2,10,8,6,2,10,6,8,10,2,6,8,10,6,8,10,2,6,10,4,8,6,10,4,8,6,4,8,10,6,8,10,4),
            array(10,8,0,6,4,2,10,8,2,4,10,8,6,2,10,6,8,10,4,6,2,10,6,8,10,2,6,10,4,8,6,10,4,8,2,4,8,10,6,8,2,4),
            array(8,10,2,8,10,1,4,6,2,8,6,4,2,10,4,6,8,10,1,8,6,4,10,2,6,10,4,6,8,4,10,0,8,2,10,6,8,2,4,8,10,6),
            array(10,8,0,6,4,2,10,8,6,4,10,8,6,2,10,6,8,10,4,6,8,10,6,8,10,2,6,10,4,8,6,10,4,8,2,4,8,10,6,8,2,4),
            array(10,8,0,6,4,2,10,8,6,4,10,8,6,2,10,6,8,10,4,6,8,10,6,8,10,2,6,10,4,8,6,10,4,8,2,4,8,10,6,8,2,4),
        ),

    );
    // Символы
    public $symbols = array(
        // Juggernaut
        'K' => array(10),
        // Cyclop
        'J' => array(9),
        // Sabretooth
        'I' => array(8),
        // Wolverine
        'D' => array(3),
        // Magneto
        'C' => array(2),
        // X-men Scatter
        'L' => array(11),
        // Mystic
        'G' => array(6),
        // Storm
        'H' => array(7),
        // Night Snake
        'F' => array(5),
        // Professor X
        'B' => array(1),
        // Lady deadly strike
        'E' => array(4),
        // Wild
        'A' => array(0),

    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(11);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 5,
        '4' => 25,
        '5' => 200,
    );
    // Выигрышные линии
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
        array(2,0,0,0,2),
        array(1,2,0,2,1),
        array(1,0,2,0,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
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
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 10000.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 3000.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 1500.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 1500.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 500.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 400.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 400.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 300.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 300.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 250.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 70.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 70.00),
        array('symbol'=> 'A', 'count'=> 2, 'multiplier'=> 50.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 8.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 8.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'B', 'count'=> 2, 'multiplier'=> 4.00),
        array('symbol'=> 'C', 'count'=> 2, 'multiplier'=> 4.00),
    );

    // Символы, которые нужны для X бонуса
    public $xBonus = array(
        'symbols' => array(1, 3, 7, 5, 9),
        'multiplier' => 5,
    );
    // Вайлды в Hero Mode
    public $heroWilds = array(0, 2);
    // Вайлды в Villains Mode
    public $villainsWilds = array(0, 1);
}