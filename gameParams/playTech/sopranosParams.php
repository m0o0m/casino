<?

class sopranosParams extends Params {
    // раскладки
    // Основная игра, FS Soldier, FS Capo, FS Boss, FS Family
    public $reels = array(
        // раскладка для главной игры
        array(
            array(2,6,3,7,10,11,9,1,8,6,4,7,8,3,9,10,5,8,2,6,5,7,1,8,5,9,4,10,0,7,11,6,4,8,13,10,3,9,2,6,7,5,8,6,1,7,4,8,3,9,5,10,4,6,7,2,10,9,0,10,8,5,9,10),
            array(0,6,3,7,5,8,4,9,10,2,6,5,7,8,12,9,3,10,4,6,2,7,13,8,1,9,12,5,10,3,9,5,10,12,8,2,6,7,0,9,10,13,6,3,7,8,4,9,10,2,6,4,7,1,8,5,9,4,10,12,6,8,4,9),
            array(2,9,3,7,10,12,9,0,8,13,6,4,7,8,3,9,10,5,8,2,6,5,7,1,8,5,9,4,10,0,7,12,6,4,8,5,10,3,9,2,6,5,7,13,6,1,7,4,8,3,9,5,10,4,7,3,9,2,10,8,12,10,9,0,6,10),
            array(1,6,3,7,5,8,4,9,2,10,5,6,12,8,5,9,3,10,4,6,2,7,13,8,1,9,12,7,10,3,9,5,10,12,8,2,6,7,0,9,10,13,6,3,7,8,4,6,7,5,8,9,1,10,9,2,7,3,8,4,9,5,10,12,9,4,10),
            array(2,9,3,6,10,11,9,1,8,13,6,4,7,8,3,9,10,5,8,2,6,5,7,1,8,5,9,4,10,0,7,6,4,8,5,10,3,9,2,6,5,7,13,6,1,10,4,8,3,9,5,10,4,7,9,10,3,9,8,10,7,2,10,6),
        ),
        // Soldier
        array(
            array(2,10,7,3,6,10,9,5,8,10,6,4,7,8,3,9,10,5,8,9,6,5,7,1,8,5,9,4,10,7,0,8,6,4,8,9,3,10,9,2,6,5,7,13,6,1,7,4,8,3,9,5,10,4,6,7,2,10,9),
            array(10,6,3,7,5,8,4,9,10,2,6,7,5,8,9,7,3,10,4,6,2,7,13,8,1,9,5,10,3,9,5,10,8,2,6,7,0,9,10,6,3,7,8,4,9,10,6,4,7,1,8,5,9,4,10,6,8,9),
            array(2,9,3,7,10,2,9,8,13,6,7,5,8,9,10,4,8,5,6,7,1,8,5,9,10,4,7,6,5,8,6,4,10,8,3,9,6,5,7,6,1,7,4,8,3,9,5,10,7,2,9,3,10,8,2,10,9,0,6,10),
            array(1,6,8,3,7,5,8,4,9,10,5,8,6,3,10,9,5,10,4,6,7,13,8,9,1,7,10,3,9,5,10,8,2,6,7,0,9,10,6,3,7,8,4,6,7,5,9,8,10,2,9,7,4,8,9,5,10,9,4,6,10),
            array(2,9,6,3,10,9,1,8,13,6,4,7,8,3,9,10,5,8,2,6,5,7,9,5,8,9,4,10,0,7,8,4,6,8,5,10,3,9,6,5,7,13,10,6,1,10,8,4,7,9,5,10,7,9,4,8,9,2,10,7,3,10,6),
        ),
        // Capo
        array(
            array(2,10,7,3,6,10,5,9,0,8,4,6,10,3,8,7,13,9,10,5,8,9,5,6,7,1,8,5,9,4,10,7,0,8,6,4,8,9,3,10,9,2,6,5,7,13,6,1,7,4,8,3,9,5,8,1,10,4,6,7,2,10,1,9),
            array(10,6,3,7,5,8,4,9,10,2,6,7,5,8,9,3,7,10,4,6,2,9,13,8,7,1,9,5,10,3,9,5,10,8,2,6,7,0,6,10,3,6,8,4,7,10,1,9,7,4,8,5,9,1,8,10,13,8,9,5,10,0,6,4,9),
            array(2,9,7,0,10,9,13,10,6,5,7,8,1,9,10,4,8,5,6,7,1,8,5,9,4,10,2,7,6,3,9,5,8,6,4,10,8,3,9,6,5,7,6,1,7,4,8,3,9,5,10,4,7,9,3,10,8,2,10,9,0,6,10),
            array(1,6,8,3,7,5,8,4,9,8,0,10,6,2,10,5,9,3,10,5,6,7,13,8,9,1,7,10,3,9,5,10,8,2,6,7,0,9,6,1,7,4,6,2,7,4,9,5,8,10,13,9,7,4,8,5,10,3,9,4,6,10),
            array(2,9,6,3,10,1,9,8,13,6,4,7,8,3,9,10,5,8,2,6,5,7,9,5,8,9,4,10,0,7,8,4,6,8,5,10,3,9,6,5,7,10,13,6,10,8,4,7,9,5,10,7,1,9,4,8,9,2,10,7,3,10,6),
        ),
        // Boss
        array(
            array(13,10,7,8,3,6,10,5,7,9,8,4,6,10,9,3,8,7,5,9,10,7,13,8,9,10,5,6,7,1,8,6,5,9,8,10,0,7,8,6,4,8,9,5,6,7,9,3,10,9,2,6,10,5,9,7,13,6,9,10,1,7,6,10,4,8,10,9,5,8,9,10,4,8,7,6,2,10,8,9),
            array(10,6,5,7,6,8,4,9,10,2,6,7,5,8,9,3,7,10,8,4,6,8,9,13,8,9,1,7,10,9,5,10,9,3,8,5,10,9,6,7,0,6,10,3,6,8,4,7,10,5,9,7,4,9,10,8,5,9,8,10,13,8,7,5,9,10,6,4,9),
            array(2,9,7,10,5,6,9,7,0,10,6,5,7,8,1,9,10,4,8,10,5,6,7,4,8,10,5,9,6,4,10,8,5,7,6,3,9,7,5,8,6,4,10,8,9,3,6,8,7,13,6,9,7,4,8,9,10,5,8,9,10,4,7,9,3,10,8,2,10,9,0,6,10),
            array(1,6,8,4,7,6,5,9,8,4,9,8,0,10,6,2,10,8,5,9,7,3,10,8,5,6,7,13,8,9,5,7,10,3,9,8,5,10,8,2,6,7,1,6,9,4,7,6,2,7,10,4,9,10,5,8,10,13,9,7,4,8,9,5,10,3,9,4,6,10),
            array(2,9,6,3,10,1,9,8,13,6,4,7,8,3,9,10,5,8,10,6,5,7,9,5,8,9,4,10,9,0,7,8,4,6,8,10,5,8,9,6,5,7,10,13,6,10,8,4,7,9,5,10,7,9,4,8,9,2,10,8,7,3,10,6),
        ),
        // Family
        array(
            array(5,3,13,5,4,3,1,5,0,2,4,5,2,4,3,5,13,4,2,5,4,3,1,5,2,3,4,5,3,2,1,5,13,3,2,5,3,1,2,5,0,3,1,5,3,1,13,5,3,1,5,4,3,2,5,3,1,4,5,13,3,4,5,3,5,2,3,1,5,3,4,2,5,13,3,4,5,1,3,2,1),
            array(5,1,4,13,5,4,2,1,5,0,3,4,5,1,4,3,5,13,4,3,5,4,3,1,5,2,3,4,5,2,4,1,5,13,1,4,5,3,4,2,5,4,3,1,5,4,13,5,4,1,5,4,3,5,0,4,5,13,4,5,1,4,5,3,2,5,1,4,5,1,4,2),
            array(1,2,4,13,5,3,2,1,5,3,0,4,3,5,1,2,4,3,2,13,4,2,5,4,3,1,4,2,3,4,5,2,4,3,2,13,3,4,2,1,3,4,2,5,4,3,1,5,2,4,13,3,5,4,3,5,4,3,2,4,3,1,4,3,13,4,3,2,4,3,2,4,3,2,4,13,3,5,1,3,2,4),
            array(1,5,2,1,5,4,2,1,5,0,3,4,5,2,4,3,5,1,2,3,5,4,3,1,5,2,3,4,13,5,2,4,1,5,3,1,2,5,4,1,2,13,5,4,3,1,5,2,4,1,5,3,2,1,5,4,3,2,5,3,1,4,5,3,4,5,3,4,5,3,2,4,5,3,4,2,13,1,5,2,1,4,3,2),
            array(1,5,4,3,5,4,2,1,5,0,3,4,5,2,4,3,5,13,2,3,5,4,3,1,5,2,3,4,5,2,4,1,5,3,2,4,5,3,4,2,5,4,3,1,5,2,4,1,5,3,2,1,5,4,3,2,5,13,3,1,4,5,3,4,5,3,4,5,3,2,4,5,3,4,5,13,2,1,5,2,1,4,3,2),
        ),
    );
    // Символы
    public $symbols = array(
        // Wild Тони
        'Z' => array(0),
        // Пауль
        'P' => array(1),
        // Кристофер
        'C' => array(2),
        // Джонни
        'H' => array(3),
        // Бобби
        'B' => array(4),
        // Арти
        'R' => array(5),
        // A
        'A' => array(6),
        // K
        'K' => array(7),
        // Q
        'Q' => array(8),
        // J
        'J' => array(9),
        // 10
        'T' => array(10),
        // Safe
        'O' => array(11),
        // Bada Bing
        'I' => array(12),
        // Sopranos
        'S' => array(13),
    );
    // Настройки бонуса BadaBing
    public $badaBingConfig = array(
        // Символ бонуса BadaBing
        'symbol' => 'I',
        // Множитель выигрышей для BadaBing
        'multiplier' => array(4,5,6,7,8,9,10),
        // Минимальное количество визитов
        'minCount' => 3,
        // Максимальное количество визитов
        'maxCount' => 5,
    );
    // Настройки Stolen Goods
    public $stolenGoodsParams = array(
        'symbol' => 'O',
        'multiplier' => array(30, 20, 15, 12, 11, 10, 9, 8, 6, 4),
    );
    public $fsConfig = array(
        'symbol' => 'S',
    );
    // raid bonus chance. Шанс 1 к 25
    public $randBonusChance = 25;
    // Вайлд
    public $wild = array(0);
    // Soldier wild
    public $soldierWild = array(0, 2);
    // Скаттер
    public $scatter = array(13);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
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
        array('symbol'=> 'Z', 'count'=> 5, 'multiplier'=> 3000.00),
        array('symbol'=> 'P', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'Z', 'count'=> 4, 'multiplier'=> 500.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 400.00),
        array('symbol'=> 'Z', 'count'=> 3, 'multiplier'=> 300.00),
        array('symbol'=> 'P', 'count'=> 4, 'multiplier'=> 300.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 300.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 200.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'P', 'count'=> 3, 'multiplier'=> 150.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 150.00),
        array('symbol'=> 'R', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'Q', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'R', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'T', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 30.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'Q', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'R', 'count'=> 3, 'multiplier'=> 20.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'T', 'count'=> 4, 'multiplier'=> 20.00),
        array('symbol'=> 'Z', 'count'=> 2, 'multiplier'=> 10.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'P', 'count'=> 2, 'multiplier'=> 5.00),
        array('symbol'=> 'Q', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'T', 'count'=> 3, 'multiplier'=> 5.00),
        array('symbol'=> 'C', 'count'=> 2, 'multiplier'=> 4.00),
    );
    // Шанс выпадения вайлдов в Боссе
    public $bonusRand = array(
        2,2,2,2,
        3,3,3,
        4,4,
        5,
    );
}