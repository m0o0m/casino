<?

class witches_charmParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [2, 4, 10, 3, 2, 7, 0, 6, 1, 4, 9, 11, 5, 6, 1, 2, 10, 12, 5, 8],
            [7, 8, 0, 12, 3, 2, 4, 11, 0, 6, 7, 12, 9, 1, 5, 0, 11, 2, 5, 1],
            [0, 3, 9, 7, 1, 12, 6, 2, 0, 8, 3, 0, 6, 1, 4, 10, 2, 7, 11, 5],
            [3, 6, 12, 1, 7, 0, 4, 8, 0, 2, 6, 11, 5, 7, 8, 6, 12, 4, 10, 2],
            [2, 10, 11, 0, 3, 7, 12, 5, 6, 2, 9, 4, 7, 3, 0, 6, 5, 1, 8, 4]
        ),
        array(
            [2, 4, 10, 3, 2, 7, 0, 6, 1, 4, 9, 11, 5, 6, 1, 2, 10, 12, 5, 8],
            [7, 8, 0, 12, 3, 2, 4, 11, 0, 6, 7, 12, 9, 1, 5, 0, 11, 2, 5, 1],
            [0, 3, 9, 7, 1, 12, 6, 2, 0, 8, 3, 0, 6, 1, 4, 10, 2, 7, 11, 5],
            [3, 6, 12, 1, 7, 0, 4, 8, 0, 2, 6, 11, 5, 7, 8, 6, 12, 4, 10, 2],
            [2, 10, 11, 0, 3, 7, 12, 5, 6, 2, 9, 4, 7, 3, 0, 6, 5, 1, 8, 4]
        ),
        array(
            [2, 4, 10, 3, 2, 7, 0, 6, 1, 4, 9, 11, 5, 6, 1, 2, 10, 12, 5, 8],
            [7, 8, 0, 12, 3, 2, 4, 11, 0, 6, 7, 12, 9, 1, 5, 0, 11, 2, 5, 1],
            [0, 3, 9, 7, 1, 12, 6, 2, 0, 8, 3, 0, 6, 1, 4, 10, 2, 7, 11, 5],
            [3, 6, 12, 1, 7, 0, 4, 8, 0, 2, 6, 11, 5, 7, 8, 6, 12, 4, 10, 2],
            [2, 10, 11, 0, 3, 7, 12, 5, 6, 2, 9, 4, 7, 3, 0, 6, 5, 1, 8, 4]
        ),
        array(
            [2, 4, 10, 3, 2, 7, 0, 6, 1, 4, 9, 11, 5, 6, 1, 2, 10, 12, 5, 8],
            [7, 8, 0, 12, 3, 2, 4, 11, 0, 6, 7, 12, 9, 1, 5, 0, 11, 2, 5, 1],
            [0, 3, 9, 7, 1, 12, 6, 2, 0, 8, 3, 0, 6, 1, 4, 10, 2, 7, 11, 5],
            [3, 6, 12, 1, 7, 0, 4, 8, 0, 2, 6, 11, 5, 7, 8, 6, 12, 4, 10, 2],
            [2, 10, 11, 0, 3, 7, 12, 5, 6, 2, 9, 4, 7, 3, 0, 6, 5, 1, 8, 4]
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        //
        '10' => array(10),
        //
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
        //
        '11' => array(11),
        // Scatter
        '12' => array(12),
    );
    // Вайлд
    public $wild = array(11);
    public $doubleIfWild = true;
    // Скаттер
    public $scatter = array(12);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 2,
        '3' => 5,
        '4' => 20,
        '5' => 500,
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
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

    public $defaultCoinsCount = 15;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '0', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 5),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 125),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 75),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 250),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 75),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 15),
        array('symbol'=> '8', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '8', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '8', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '9', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> '9', 'count'=> 4, 'multiplier'=> 125),
        array('symbol'=> '9', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> '9', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> '10', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> '10', 'count'=> 4, 'multiplier'=> 125),
        array('symbol'=> '10', 'count'=> 3, 'multiplier'=> 25),
        array('symbol'=> '10', 'count'=> 2, 'multiplier'=> 2),
        array('symbol'=> '11', 'count'=> 5, 'multiplier'=> 10000),
        array('symbol'=> '11', 'count'=> 4, 'multiplier'=> 2500),
        array('symbol'=> '11', 'count'=> 3, 'multiplier'=> 250),
        array('symbol'=> '11', 'count'=> 2, 'multiplier'=> 10),
    );
}