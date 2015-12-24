<?

class supreme_hotParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [6, 1, 1, 1, 6, 0, 0, 0, 1, 1, 1, 2, 2, 2, 3, 3, 3, 5, 2, 2, 2, 5, 8, 2, 2, 2, 5, 1, 1, 1],
            [7, 6, 5, 0, 8, 2, 2, 2, 3, 3, 3, 7, 5, 1, 1, 1, 0, 0, 0, 2, 2, 2, 0, 8, 6, 0, 2, 2, 2, 0],
            [0, 0, 0, 2, 2, 2, 0, 7, 5, 6, 4, 0, 0, 0, 6, 0, 3, 3, 3, 5, 1, 1, 1, 5, 7, 2, 2, 2, 5, 8]
        ),
        array(

        ),
        array(
            [6, 1, 1, 1, 6, 0, 0, 0, 1, 1, 1, 2, 2, 2, 3, 3, 3, 5, 2, 2, 2, 5, 8, 2, 2, 2, 5, 1, 1, 1],
            [7, 6, 5, 0, 8, 2, 2, 2, 3, 3, 3, 7, 5, 1, 1, 1, 0, 0, 0, 2, 2, 2, 0, 8, 6, 0, 2, 2, 2, 0],
            [0, 0, 0, 2, 2, 2, 0, 7, 5, 6, 4, 0, 0, 0, 6, 0, 3, 3, 3, 5, 1, 1, 1, 5, 7, 2, 2, 2, 5, 8]
        ),
        array(

        ),
    );

    public $reelConfig = array(3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        //
        '0' => array(0),
        //
        '1' => array(1),
        //
        '2' => array(2),
        //
        '3' => array(3),
        //
        '4' => array(4),
        //
        '5' => array(5),
        //
        '6' => array(6),
        //
        '7' => array(7),
        //
        '8' => array(8),
    );
    // Вайлд
    public $wild = array();
    // Скаттер
    public $scatter = array();
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
    );

    public $winLines = array();

    public $winLineType = 'ways';
    public $minWinCount = 3;

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
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 80),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 80),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 100),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 200),
        array('symbol'=> '8', 'count'=> 3, 'multiplier'=> 300),
    );
}