<?

class book_of_magicParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            array(11, 4, 5, 12, 0, 8, 1, 2, 7, 0, 10, 5, 4, 6, 3, 2, 12, 1, 3, 9),
            array(11, 5, 2, 12, 1, 7, 4, 10, 3, 8, 1, 9, 2, 6, 0, 3, 10, 5, 6, 1),
            array(7, 3, 11, 0, 1, 12, 5, 10, 2, 6, 11, 1, 6, 2, 9, 3, 5, 8, 4, 0),
            array(5, 6, 3, 2, 11, 4, 0, 9, 3, 2, 10, 0, 1, 7, 4, 2, 8, 3, 4, 12),
            array(8, 4, 2, 12, 1, 6, 2, 8, 4, 3, 6, 5, 7, 11, 9, 0, 8, 3, 4, 10),
        ),
        array(
            array(11, 4, 5, 12, 0, 8, 1, 2, 7, 0, 10, 5, 4, 6, 3, 2, 12, 1, 3, 9),
            array(11, 5, 2, 12, 1, 7, 4, 10, 3, 8, 1, 9, 2, 6, 0, 3, 10, 5, 6, 1),
            array(7, 3, 11, 0, 1, 12, 5, 10, 2, 6, 11, 1, 6, 2, 9, 3, 5, 8, 4, 0),
            array(5, 6, 3, 2, 11, 4, 0, 9, 3, 2, 10, 0, 1, 7, 4, 2, 8, 3, 4, 12),
            array(8, 4, 2, 12, 1, 6, 2, 8, 4, 3, 6, 5, 7, 11, 9, 0, 8, 3, 4, 10),
        ),
        array(
            array(11, 4, 5, 12, 0, 8, 1, 2, 7, 0, 10, 5, 4, 6, 3, 2, 12, 1, 3, 9),
            array(11, 5, 2, 12, 1, 7, 4, 10, 3, 8, 1, 9, 2, 6, 0, 3, 10, 5, 6, 1),
            array(7, 3, 11, 0, 1, 12, 5, 10, 2, 6, 11, 1, 6, 2, 9, 3, 5, 8, 4, 0),
            array(5, 6, 3, 2, 11, 4, 0, 9, 3, 2, 10, 0, 1, 7, 4, 2, 8, 3, 4, 12),
            array(8, 4, 2, 12, 1, 6, 2, 8, 4, 3, 6, 5, 7, 11, 9, 0, 8, 3, 4, 10),
        ),
        array(
            array(11, 4, 5, 12, 0, 8, 1, 2, 7, 0, 10, 5, 4, 6, 3, 2, 12, 1, 3, 9),
            array(11, 5, 2, 12, 1, 7, 4, 10, 3, 8, 1, 9, 2, 6, 0, 3, 10, 5, 6, 1),
            array(7, 3, 11, 0, 1, 12, 5, 10, 2, 6, 11, 1, 6, 2, 9, 3, 5, 8, 4, 0),
            array(5, 6, 3, 2, 11, 4, 0, 9, 3, 2, 10, 0, 1, 7, 4, 2, 8, 3, 4, 12),
            array(8, 4, 2, 12, 1, 6, 2, 8, 4, 3, 6, 5, 7, 11, 9, 0, 8, 3, 4, 10),
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
        array(1,1,2,1,1),
        array(1,1,0,1,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        array(1,0,2,0,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 20;

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