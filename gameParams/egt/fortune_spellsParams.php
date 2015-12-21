<?

class fortune_spellsParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [8, 1, 4, 0, 5, 2, 6, 1, 5, 7, 3, 3, 1, 4, 2, 9, 5, 6, 8, 2],
            [2, 8, 0, 6, 1, 5, 8, 2, 4, 3, 5, 9, 2, 4, 1, 7, 2, 8, 3, 6],
            [4, 0, 5, 1, 8, 3, 6, 4, 8, 1, 9, 3, 2, 5, 1, 7, 0, 3, 6, 2],
            [2, 6, 2, 5, 3, 8, 1, 7, 0, 5, 2, 5, 7, 1, 4, 8, 6, 3, 4, 9],
            [6, 1, 7, 3, 5, 0, 5, 4, 8, 1, 5, 9, 2, 4, 8, 7, 5, 0, 3, 4]
        ),
        array(
            [8, 1, 4, 0, 5, 2, 6, 1, 5, 7, 3, 3, 1, 4, 2, 9, 5, 6, 8, 2],
            [2, 8, 0, 6, 1, 5, 8, 2, 4, 3, 5, 9, 2, 4, 1, 7, 2, 8, 3, 6],
            [4, 0, 5, 1, 8, 3, 6, 4, 8, 1, 9, 3, 2, 5, 1, 7, 0, 3, 6, 2],
            [2, 6, 2, 5, 3, 8, 1, 7, 0, 5, 2, 5, 7, 1, 4, 8, 6, 3, 4, 9],
            [6, 1, 7, 3, 5, 0, 5, 4, 8, 1, 5, 9, 2, 4, 8, 7, 5, 0, 3, 4]
        ),
        array(
            [8, 1, 4, 0, 5, 2, 6, 1, 5, 7, 3, 3, 1, 4, 2, 9, 5, 6, 8, 2],
            [2, 8, 0, 6, 1, 5, 8, 2, 4, 3, 5, 9, 2, 4, 1, 7, 2, 8, 3, 6],
            [4, 0, 5, 1, 8, 3, 6, 4, 8, 1, 9, 3, 2, 5, 1, 7, 0, 3, 6, 2],
            [2, 6, 2, 5, 3, 8, 1, 7, 0, 5, 2, 5, 7, 1, 4, 8, 6, 3, 4, 9],
            [6, 1, 7, 3, 5, 0, 5, 4, 8, 1, 5, 9, 2, 4, 8, 7, 5, 0, 3, 4]
        ),
        array(
            [8, 1, 4, 0, 5, 2, 6, 1, 5, 7, 3, 3, 1, 4, 2, 9, 5, 6, 8, 2],
            [2, 8, 0, 6, 1, 5, 8, 2, 4, 3, 5, 9, 2, 4, 1, 7, 2, 8, 3, 6],
            [4, 0, 5, 1, 8, 3, 6, 4, 8, 1, 9, 3, 2, 5, 1, 7, 0, 3, 6, 2],
            [2, 6, 2, 5, 3, 8, 1, 7, 0, 5, 2, 5, 7, 1, 4, 8, 6, 3, 4, 9],
            [6, 1, 7, 3, 5, 0, 5, 4, 8, 1, 5, 9, 2, 4, 8, 7, 5, 0, 3, 4]
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        // Wild + Scatter
        '9' => array(9),
        '8' => array(8),
        '7' => array(7),
        '6' => array(6),
        '5' => array(5),
        '4' => array(4),
        '3' => array(3),
        '2' => array(2),
        '1' => array(1),
        '0' => array(0),
    );
    // Вайлд
    public $wild = array(9);
    // Скаттер
    public $scatter = array(9);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 2,
        '4' => 25,
        '5' => 250,
    );

    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        array(0,1,1,1,0),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 10;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> '5', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 30),
        array('symbol'=> '6', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 2000),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 400),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 40),
        array('symbol'=> '7', 'count'=> 2, 'multiplier'=> 5),
        array('symbol'=> '8', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> '8', 'count'=> 4, 'multiplier'=> 1000),
        array('symbol'=> '8', 'count'=> 3, 'multiplier'=> 100),
        array('symbol'=> '8', 'count'=> 2, 'multiplier'=> 10),
    );
}