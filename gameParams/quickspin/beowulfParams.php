
<?

class beowulfParams extends Params {

    // раскладки
    public $reels = array(
        // Основная игра
        array(
            array(6,15,16,12,6,10,14,7,15,14,7,11,16,12,9,15,14,7,15,16,13,7,10,15,7,14,16,12,9,11,12,8,15,7,12,15,9,11,16,14,7,10,12,9,15,11,5,15,10,9,10,16,15,9,11,15,8,10,15,9,12,15,0,0,0,12,15,8,11,13,5,15,12,5,12,13,9,10,16,12,7,11,15,9,12,15,9,11,10),
            array(6,12,8,14,0,0,0,14,13,5,14,6,14,5,14,6,11,16,12,8,14,7,13,16,15,6,12,7,13,8,15,5,10,16,13,6,14,7,13,16,15,9,12,13,0,14,12,8,15,6,14,13,0,0,0,10,13,8,14,16,13,14,6,14,11,9,13,16,14,6,10,14,0,11,14,8,13,6,15,8,14,9,11,0,13,8,12,9,10),
            array(11,6,15,14,7,15,13,8,10,7,12,0,0,0,11,15,9,13,12,9,14,7,11,6,14,12,8,13,15,6,10,14,7,11,14,8,13,16,10,7,11,12,7,10,6,13,8,12,14,6,15,10,9,11,13,5,13,14,9,15,12,5,10,6,11,13,8,15,12,9,15,7,14,6,12,7,10),
            array(8,11,10,7,14,12,0,0,0,15,13,6,14,12,7,15,11,8,13,14,5,15,10,9,14,13,7,12,13,6,11,15,8,11,10,0,0,0,12,14,9,13,15,5,13,14,9,14,12,5,12,15,6,12,15,0,0,15,10,8,11,15,7,13,11,9,14,15,16,12,13,7,10,6,10,13,0,15,14,8,11,12,9,14,10),
            array(7,12,15,8,14,15,9,11,15,6,13,12,8,13,14,9,15,14,6,11,10,0,12,13,8,14,11,9,10,11,7,14,16,12,9,12,15,8,14,10,6,10,14,0,10,11,8,15,7,13,9,12,14,7,12,13,7,13,14,0,10,15,9,11,8,13,15,5,14,12,9,11,16,15,8,15,9,11,13,7,14,10,5,15,12,7,14,10,5,15,14,6,15,13),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild
        'W' => array(0),
        // Грендель
        'Z' => array(1),
        // Wild Sword
        'Z' => array(2),
        // Dragon Symbol
        'Z' => array(3),
        // Gold Wild
        'Z' => array(4),
        // Король
        'A' => array(5),
        // Принцесса
        'B' => array(6),
        // Бородач
        'C' => array(7),
        // Змееволосая?
        'D' => array(8),
        // Девочка в шкуре волка
        'E' => array(9),
        // A
        'F' => array(10),
        // K
        'G' => array(11),
        // Q
        'H' => array(12),
        // J
        'I' => array(13),
        // 10
        'J' => array(14),
        // 9
        'K' => array(15),
        // Scatter
        'S' => array(16),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(16);
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
        array(1,2,1,0,1),
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
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 125.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'W', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'W', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 3.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 3.00),
    );

}