<?

class dazzling_hotParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            array(6, 2, 2, 2, 0, 0, 0, 5, 4, 1, 5, 1, 1, 1, 3, 4, 7, 4, 4, 4),
            array(7, 2, 2, 2, 5, 5, 0, 0, 0, 6, 3, 3, 1, 1, 4, 1, 4, 4, 4, 2),
            array(6, 1, 1, 1, 7, 1, 5, 3, 3, 3, 4, 4, 0, 4, 2, 2, 2, 0, 0, 0),
            array(1, 1, 1, 7, 1, 3, 3, 3, 6, 4, 4, 4, 2, 2, 0, 2, 0, 0, 5, 5),
            array(7, 3, 3, 2, 2, 1, 6, 1, 1, 1, 3, 3, 3, 2, 7, 0, 0, 4, 4, 4),
        ),
        array(

        ),
        array(
            array(6, 2, 2, 2, 0, 0, 0, 5, 4, 1, 5, 1, 1, 1, 3, 4, 7, 4, 4, 4),
            array(7, 2, 2, 2, 5, 5, 0, 0, 0, 6, 3, 3, 1, 1, 4, 1, 4, 4, 4, 2),
            array(6, 1, 1, 1, 7, 1, 5, 3, 3, 3, 4, 4, 0, 4, 2, 2, 2, 0, 0, 0),
            array(1, 1, 1, 7, 1, 3, 3, 3, 6, 4, 4, 4, 2, 2, 0, 2, 0, 0, 5, 5),
            array(7, 3, 3, 2, 2, 1, 6, 1, 1, 1, 3, 3, 3, 2, 7, 0, 0, 4, 4, 4),
        ),
        array(

        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        // Вишня
        '0' => array(0),
        // Апельсин
        '1' => array(1),
        // Лимон
        '2' => array(2),
        // Слива
        '3' => array(3),
        // Арбуз
        '4' => array(4),
        // Виноград
        '5' => array(5),
        // Звезда
        '6' => array(6),
        // Семерка
        '7' => array(7),
    );
    // Вайлд
    public $wild = array();
    // Скаттер
    public $scatter = array(6);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 2,
        '4' => 10,
        '5' => 50,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 5;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '0', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 1000),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 100),
    );
}