<?

class dragon_reelsParams extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            array(10, 2, 5, 6, 12, 9, 5, 7, 2, 1, 11, 2, 6, 1, 7, 4, 8, 1, 7, 3),
            array(10, 3, 1, 8, 4, 12, 9, 2, 4, 8, 7, 4, 11, 3, 0, 6, 4, 3, 5, 9),
            array(5, 9, 2, 4, 8, 5, 2, 12, 4, 6, 0, 11, 5, 7, 3, 8, 1, 10, 0, 2),
            array(7, 0, 11, 1, 5, 9, 0, 8, 3, 2, 10, 1, 6, 11, 4, 2, 10, 1, 0, 12),
            array(12, 3, 4, 6, 1, 4, 11, 3, 8, 10, 5, 3, 2, 11, 1, 3, 9, 0, 4, 7),
        ),
        array(
            array(10, 2, 5, 6, 12, 9, 5, 7, 2, 1, 11, 2, 6, 1, 7, 4, 8, 1, 7, 3),
            array(10, 3, 1, 8, 4, 12, 9, 2, 4, 8, 7, 4, 11, 3, 0, 6, 4, 3, 5, 9),
            array(5, 9, 2, 4, 8, 5, 2, 12, 4, 6, 0, 11, 5, 7, 3, 8, 1, 10, 0, 2),
            array(7, 0, 11, 1, 5, 9, 0, 8, 3, 2, 10, 1, 6, 11, 4, 2, 10, 1, 0, 12),
            array(12, 3, 4, 6, 1, 4, 11, 3, 8, 10, 5, 3, 2, 11, 1, 3, 9, 0, 4, 7),
        ),
        array(
            array(10, 2, 5, 6, 12, 9, 5, 7, 2, 1, 11, 2, 6, 1, 7, 4, 8, 1, 7, 3),
            array(10, 3, 1, 8, 4, 12, 9, 2, 4, 8, 7, 4, 11, 3, 0, 6, 4, 3, 5, 9),
            array(5, 9, 2, 4, 8, 5, 2, 12, 4, 6, 0, 11, 5, 7, 3, 8, 1, 10, 0, 2),
            array(7, 0, 11, 1, 5, 9, 0, 8, 3, 2, 10, 1, 6, 11, 4, 2, 10, 1, 0, 12),
            array(12, 3, 4, 6, 1, 4, 11, 3, 8, 10, 5, 3, 2, 11, 1, 3, 9, 0, 4, 7),
        ),
        array(
            array(10, 2, 5, 6, 12, 9, 5, 7, 2, 1, 11, 2, 6, 1, 7, 4, 8, 1, 7, 3),
            array(10, 3, 1, 8, 4, 12, 9, 2, 4, 8, 7, 4, 11, 3, 0, 6, 4, 3, 5, 9),
            array(5, 9, 2, 4, 8, 5, 2, 12, 4, 6, 0, 11, 5, 7, 3, 8, 1, 10, 0, 2),
            array(7, 0, 11, 1, 5, 9, 0, 8, 3, 2, 10, 1, 6, 11, 4, 2, 10, 1, 0, 12),
            array(12, 3, 4, 6, 1, 4, 11, 3, 8, 10, 5, 3, 2, 11, 1, 3, 9, 0, 4, 7),
        ),
    );

    public $reelConfig = array(3,3,3,3,3);

    public $jackpotEnable = false;

    public $symbols = array(
        // Мужик
        '10' => array(10),
        // Баба
        '9' => array(9),
        // Барабан
        '8' => array(8),
        // Шарик?
        '7' => array(7),
        // Питарды
        '6' => array(6),
        // A
        '5' => array(5),
        // K
        '4' => array(4),
        // Q
        '3' => array(3),
        // J
        '2' => array(2),
        // 10
        '1' => array(1),
        // 9
        '0' => array(0),
        // Wild
        '11' => array(11),
        // Scatter
        '12' => array(12),
    );
    // Вайлд
    public $wild = array(11);
    // Скаттер
    public $scatter = array(12);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 2,
        '3' => 4,
        '4' => 50,
        '5' => 100,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,2,2,2,1),
        array(1,0,0,0,1),
        // 10
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,0,1,0),
        // 15
        array(2,1,2,1,2),
        array(1,1,2,1,1),
        array(1,1,0,1,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
        // 20
        array(1,0,2,0,1),
        array(1,2,0,2,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
        // 25
        array(2,0,0,0,2),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 25;

    // СТРОГО 5 ЗНАЧЕНИЙ!!!
    public $denominations = array(1, 2, 5, 10, 20);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> '0', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '7', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '7', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '7', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '8', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '8', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '8', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '9', 'count'=> 5, 'multiplier'=> 750),
        array('symbol'=> '9', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '9', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '10', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> '10', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> '10', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '11', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> '11', 'count'=> 4, 'multiplier'=> 1000),
        array('symbol'=> '11', 'count'=> 3, 'multiplier'=> 100),
    );
}