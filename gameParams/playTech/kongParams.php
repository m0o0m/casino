<?

class kongParams extends Params {

    // раскладки
    // Основная, Фриспины
    public $reels = array(
        // раскладка для главной игры
        array(
            array(9,7,8,2,5,6,4,9,5,7,3,9,8,10,6,7,5,0,9,8,2,6,5,4,9,7,1,8,6,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,8,4,9,6,7,1,9,7,6,3),
            array(9,7,8,2,5,6,4,9,8,7,3,9,8,10,5,8,7,0,9,8,2,6,5,4,9,7,1,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,8,4,9,6,7,1,9,5,2,7,6,3,5),
            array(3,7,8,2,5,6,4,9,6,5,3,9,8,10,5,8,7,1,9,8,2,6,5,4,9,7,1,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
            array(3,7,8,2,5,6,4,9,8,7,4,5,8,9,10,8,7,6,0,9,8,2,5,8,4,9,7,1,8,5,4,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
            array(3,7,8,2,5,6,4,9,8,4,7,5,3,9,8,7,10,8,9,2,6,8,5,4,9,7,1,8,5,4,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
        ),
        // FS
        array(
            array(9,7,8,2,5,6,4,9,5,7,3,9,8,10,6,7,5,0,9,8,2,6,5,4,9,7,1,8,6,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,8,4,9,6,7,1,9,7,6,3),
            array(9,7,8,2,5,6,4,9,8,7,3,9,8,10,5,8,7,0,9,8,2,6,5,4,9,7,1,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,8,4,9,6,7,1,9,5,2,7,6,3,5),
            array(3,7,8,2,5,6,4,9,6,5,3,9,8,10,5,8,7,1,9,8,2,6,5,4,9,7,1,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
            array(3,7,8,2,5,6,4,9,8,7,4,5,8,9,10,8,7,6,0,9,8,2,5,8,4,9,7,1,8,5,4,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
            array(3,7,8,2,5,6,4,9,8,4,7,5,3,9,8,7,10,8,9,2,6,8,5,4,9,7,1,8,5,4,8,5,3,8,9,10,6,7,0,8,9,3,7,8,4,9,6,7,4,9,6,7,1,9,5,2,6,9),
        ),
    );
    // Символы
    public $symbols = array(
        // K
        'G' => array(7),
        // Main Hero
        'C' => array(4),
        // 10
        'J' => array(9),
        // A
        'F' => array(5),
        // Wild
        'A' => array(0),
        // J
        'I' => array(6),
        // Q
        'H' => array(8),
        // В шляпе
        'E' => array(2),
        // Woman
        'B' => array(1),
        // Man
        'D' => array(3),
        // Bonus Scatter
        'K' => array(10),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 5,
        '4' => 10,
        '5' => 100,
    );
    // Выигрышные линии
    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,0,1,2,1),
        array(1,2,1,0,1),
        // 10
        array(1,0,0,0,0),
        array(1,2,2,2,2),
        array(0,1,1,1,1),
        array(2,1,1,1,1),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
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
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 3000.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 1000.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 600.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 500.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 500.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 300.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 300.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 200.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 100.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 75.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 30.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 10.00),
        array('symbol'=> 'A', 'count'=> 2, 'multiplier'=> 7.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 7.00),
        array('symbol'=> 'B', 'count'=> 2, 'multiplier'=> 5.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'C', 'count'=> 2, 'multiplier'=> 2.00),
    );
    // multiple - множители
    // rnd - шанс выпадения определенного животного
    public $skullBonus = array(
        'multiple' => array(10,15,20,30),
        'alias' => array('Giant Spider', 'Venatosaurusx', 'Rex', 'King Kong'),
        'rnd' => array(
            0,0,0,0,
            1,1,1,
            2,2,
            3,
        ),
    );
    // multiple - множитель при сбивании самолета
    // rnd - шанс выпадения определенного множителя
    public $cityBonus = array(
        'multiple' => array(1,2,3,4,5,6,7,8),
        'count' => 3,
        'rnd' => array(
            0,
            1,
            2,
            3,
            4,
            5,
            6,
            7,
        ),
    );

}
