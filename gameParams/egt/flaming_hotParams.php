<?

class flaming_hotParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [6, 6, 6, 1, 1, 1, 0, 0, 0, 3, 3, 3, 4, 4, 4, 2, 2, 2, 5, 5, 5, 1, 1, 1, 7, 7, 7, 9, 2, 2],
            [8, 8, 8, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 9, 2, 2, 2, 2, 0, 0, 0, 6, 6, 6, 2, 2, 2, 2, 7],
            [0, 0, 7, 7, 3, 3, 1, 1, 1, 1, 4, 4, 4, 4, 8, 8, 8, 8, 0, 0, 0, 0, 9, 3, 3, 3, 3, 6, 6, 6],
            [2, 2, 2, 2, 7, 7, 7, 7, 5, 5, 5, 5, 6, 6, 6, 8, 8, 8, 8, 8, 0, 0, 0, 0, 0, 5, 5, 5, 5, 9],
            [6, 6, 6, 1, 1, 1, 4, 4, 4, 2, 2, 2, 5, 5, 5, 0, 0, 0, 7, 7, 7, 7, 3, 3, 3, 2, 2, 2, 5, 9],
        ),
        array(

        ),
        array(
            [6, 6, 6, 1, 1, 1, 0, 0, 0, 3, 3, 3, 4, 4, 4, 2, 2, 2, 5, 5, 5, 1, 1, 1, 7, 7, 7, 9, 2, 2],
            [8, 8, 8, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 9, 2, 2, 2, 2, 0, 0, 0, 6, 6, 6, 2, 2, 2, 2, 7],
            [0, 0, 7, 7, 3, 3, 1, 1, 1, 1, 4, 4, 4, 4, 8, 8, 8, 8, 0, 0, 0, 0, 9, 3, 3, 3, 3, 6, 6, 6],
            [2, 2, 2, 2, 7, 7, 7, 7, 5, 5, 5, 5, 6, 6, 6, 8, 8, 8, 8, 8, 0, 0, 0, 0, 0, 5, 5, 5, 5, 9],
            [6, 6, 6, 1, 1, 1, 4, 4, 4, 2, 2, 2, 5, 5, 5, 0, 0, 0, 7, 7, 7, 7, 3, 3, 3, 2, 2, 2, 5, 9],
        ),
        array(

        ),
    );

    public $reelConfig = array(4,4,4,4,4);

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
        // Scatter
        '9' => array(9),
    );
    // Вайлд
    public $wild = array(8);
    // Скаттер
    public $scatter = array(9);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 2,
        '4' => 20,
        '5' => 50,
    );

    public $winLines = array(
        array(1,1,1,1,1),
        array(2,2,2,2,2),
        array(0,0,0,0,0),
        array(3,3,3,3,3),
        array(1,2,3,2,1),
        array(2,1,0,1,2),
        array(0,0,1,2,3),
        array(3,3,2,1,0),
        array(2,3,3,3,2),
        array(1,0,0,0,1),
        array(0,1,2,3,3),
        array(3,2,1,0,0),
        array(2,3,2,1,2),
        array(1,0,1,2,1),
        array(0,1,0,1,0),
        array(3,2,3,2,3),
        array(1,2,1,0,1),
        array(2,1,2,3,2),
        array(0,1,1,1,0),
        array(3,2,2,2,3),
        array(1,1,2,3,3),
        array(2,2,1,0,0),
        array(0,1,2,2,3),
        array(3,2,1,1,0),
        array(1,2,2,2,3),
        array(2,1,1,1,0),
        array(0,0,1,0,0),
        array(3,3,2,3,3),
        array(2,2,3,2,2),
        array(1,1,0,1,1),
        array(0,0,0,1,2),
        array(3,3,3,2,1),
        array(2,3,3,2,1),
        array(1,0,0,1,2),
        array(0,1,1,2,3),
        array(3,2,2,1,0),
        array(2,3,2,1,0),
        array(1,0,1,2,3),
        array(0,1,2,3,2),
        array(3,2,1,0,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 40;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 8),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 8),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 8),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 8),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 80),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 80),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 40),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 60),
        array('symbol'=> '7', 'count'=> 2, 'multiplier'=> 4),
    );
}