<?

class age_of_troyParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            array(7, 2, 4, 0, 6, 10, 2, 5, 9, 2, 8, 8, 8, 8, 2, 3, 1, 6, 2, 7, 1, 3, 10, 1, 3, 0, 4, 2, 5, 1),
            array(9, 1, 8, 8, 8, 8, 6, 4, 1, 3, 0, 7, 1, 4, 2, 6, 1, 4, 0, 7, 1, 6, 4, 2, 6, 1, 4, 5, 0, 3),
            array(0, 6, 9, 0, 8, 8, 8, 8, 0, 5, 4, 10, 1, 6, 2, 7, 0, 5, 2, 4, 0, 5, 1, 4, 3, 2, 5, 0, 4, 2),
            array(2, 3, 1, 9, 2, 8, 8, 8, 8, 6, 1, 4, 2, 5, 0, 4, 1, 7, 2, 3, 0, 5, 1, 4, 7, 0, 1, 2, 3, 0),
            array(3, 0, 5, 4, 1, 6, 9, 5, 8, 8, 8, 8, 4, 6, 2, 7, 0, 3, 7, 1, 4, 10, 5, 3, 0, 7, 6, 3, 4, 7),
        ),
        array(
            array(7, 0, 6, 1, 4, 0, 7, 2, 8, 8, 8, 8, 6, 9, 9, 9, 9, 3, 2, 4, 1, 10, 0, 4, 1, 10, 2, 4, 1, 10),
            array(3, 0, 4, 2, 5, 0, 7, 1, 5, 2, 8, 8, 8, 8, 0, 9, 9, 9, 9, 3, 1, 4, 2, 5, 0, 3, 2, 6, 1, 7),
            array(1, 4, 0, 3, 1, 7, 8, 8, 8, 8, 7, 9, 9, 9, 9, 7, 2, 3, 0, 10, 2, 5, 1, 3, 0, 6, 10, 1, 0, 3),
            array(1, 3, 2, 7, 4, 0, 5, 1, 4, 8, 8, 8, 8, 3, 9, 9, 9, 9, 5, 4, 2, 6, 4, 0, 5, 1, 3, 2, 7, 0),
            array(4, 0, 6, 2, 10, 4, 1, 3, 2, 7, 0, 4, 8, 8, 8, 8, 5, 9, 9, 9, 9, 3, 7, 0, 6, 4, 2, 3, 1, 5)
        ),
        array(
            array(7, 2, 4, 0, 6, 10, 2, 5, 9, 2, 8, 8, 8, 8, 2, 3, 1, 6, 2, 7, 1, 3, 10, 1, 3, 0, 4, 2, 5, 1),
            array(9, 1, 8, 8, 8, 8, 6, 4, 1, 3, 0, 7, 1, 4, 2, 6, 1, 4, 0, 7, 1, 6, 4, 2, 6, 1, 4, 5, 0, 3),
            array(0, 6, 9, 0, 8, 8, 8, 8, 0, 5, 4, 10, 1, 6, 2, 7, 0, 5, 2, 4, 0, 5, 1, 4, 3, 2, 5, 0, 4, 2),
            array(2, 3, 1, 9, 2, 8, 8, 8, 8, 6, 1, 4, 2, 5, 0, 4, 1, 7, 2, 3, 0, 5, 1, 4, 7, 0, 1, 2, 3, 0),
            array(3, 0, 5, 4, 1, 6, 9, 5, 8, 8, 8, 8, 4, 6, 2, 7, 0, 3, 7, 1, 4, 10, 5, 3, 0, 7, 6, 3, 4, 7),
        ),
        array(
            array(7, 0, 6, 1, 4, 0, 7, 2, 8, 8, 8, 8, 6, 9, 9, 9, 9, 3, 2, 4, 1, 10, 0, 4, 1, 10, 2, 4, 1, 10),
            array(3, 0, 4, 2, 5, 0, 7, 1, 5, 2, 8, 8, 8, 8, 0, 9, 9, 9, 9, 3, 1, 4, 2, 5, 0, 3, 2, 6, 1, 7),
            array(1, 4, 0, 3, 1, 7, 8, 8, 8, 8, 7, 9, 9, 9, 9, 7, 2, 3, 0, 10, 2, 5, 1, 3, 0, 6, 10, 1, 0, 3),
            array(1, 3, 2, 7, 4, 0, 5, 1, 4, 8, 8, 8, 8, 3, 9, 9, 9, 9, 5, 4, 2, 6, 4, 0, 5, 1, 3, 2, 7, 0),
            array(4, 0, 6, 2, 10, 4, 1, 3, 2, 7, 0, 4, 8, 8, 8, 8, 5, 9, 9, 9, 9, 3, 7, 0, 6, 4, 2, 3, 1, 5)
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        // Scatter
        '10' => array(10),
        // Wild
        '9' => array(9),
        //
        '8' => array(8),
        //
        '7' => array(7),
        //
        '6' => array(6),
        //
        '5' => array(5),
        //
        '4' => array(4),
        //
        '3' => array(3),
        //
        '2' => array(2),
        //
        '1' => array(1),
        //
        '0' => array(0),
    );
    // Вайлд
    public $wild = array(9);
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(

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
        array(2,1,1,1,2),
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,2,1,1),
        array(1,1,0,1,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        array(1,0,2,0,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
    public $currency = '$';
    public $curiso = 'USD';
    public $default_coinvalue = 0.05;
    public $defaultCoinsCount = 20;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 150),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> '8', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> '8', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> '8', 'count'=> 3, 'multiplier'=> 50),
        array('symbol'=> '8', 'count'=> 2, 'multiplier'=> 10),
    );
}