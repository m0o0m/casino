<?

class burning_hotParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [6, 2, 2, 2, 0, 0, 0, 5, 4, 1, 5, 10, 1, 1, 3, 4, 7, 4, 9, 4],
            [7, 2, 2, 2, 5, 3, 0, 0, 10, 6, 3, 3, 1, 1, 4, 1, 4, 8, 4, 2],
            [6, 1, 1, 8, 7, 1, 5, 3, 3, 9, 1, 4, 0, 4, 2, 2, 2, 10, 0, 0],
            [1, 1, 1, 7, 1, 3, 3, 8, 6, 4, 3, 4, 2, 2, 10, 2, 0, 0, 5, 1],
            [7, 3, 3, 2, 2, 1, 6, 10, 1, 1, 3, 3, 3, 2, 7, 0, 0, 4, 9, 4]
        ),
        array(

        ),
        array(
            [6, 2, 2, 2, 0, 0, 0, 5, 4, 1, 5, 10, 1, 1, 3, 4, 7, 4, 9, 4],
            [7, 2, 2, 2, 5, 3, 0, 0, 10, 6, 3, 3, 1, 1, 4, 1, 4, 8, 4, 2],
            [6, 1, 1, 8, 7, 1, 5, 3, 3, 9, 1, 4, 0, 4, 2, 2, 2, 10, 0, 0],
            [1, 1, 1, 7, 1, 3, 3, 8, 6, 4, 3, 4, 2, 2, 10, 2, 0, 0, 5, 1],
            [7, 3, 3, 2, 2, 1, 6, 10, 1, 1, 3, 3, 3, 2, 7, 0, 0, 4, 9, 4]
        ),
        array(

        ),
    );

    public $reelConfig = array(3,3,3,3,3);

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
        // Wild
        '8' => array(8),
        // $
        '9' => array(9),
        // Звезда
        '10' => array(10),
    );
    // Вайлд
    public $wild = array(8);
    // Скаттер
    public $scatter = array(9,10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '9' => array(
            '3' => 20,
        ),
        '10' => array(
            '3' => 3,
            '4' => 20,
            '5' => 100,
        ),
    );

    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
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
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 40),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 40),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 3000),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> '7', 'count'=> 2, 'multiplier'=> 10),
    );
}