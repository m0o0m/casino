<?

class super_hot_20Params extends Params {
    // Main Reels No Jackpot
    // Fs Reels No Jackpot
    // Main Reels Jackpot
    // Fs Reels Jackpot
    public $reels = array(
        array(
            [6, 6, 6, 1, 1, 1, 0, 0, 0, 3, 3, 3, 4, 4, 4, 2, 2, 2, 5, 5, 5, 1, 1, 1, 7, 4, 4, 4, 2, 2],
            [6, 6, 6, 2, 2, 2, 1, 1, 1, 0, 0, 0, 5, 5, 5, 1, 1, 1, 7, 3, 3, 3, 2, 2, 2, 0, 0, 0, 5, 5],
            [6, 6, 6, 4, 4, 4, 0, 0, 0, 1, 1, 1, 5, 5, 5, 2, 2, 2, 7, 3, 3, 3, 0, 0, 0, 2, 2, 2, 5, 5],
            [6, 6, 6, 2, 2, 2, 4, 4, 4, 0, 0, 0, 5, 5, 5, 3, 3, 3, 1, 1, 1, 7, 2, 2, 2, 0, 0, 0, 4, 4],
            [6, 6, 6, 1, 1, 1, 4, 4, 4, 2, 2, 2, 5, 5, 5, 0, 0, 0, 7, 1, 1, 1, 3, 3, 3, 2, 2, 2, 5, 5]
        ),
        array(

        ),
        array(
            [6, 6, 6, 1, 1, 1, 0, 0, 0, 3, 3, 3, 4, 4, 4, 2, 2, 2, 5, 5, 5, 1, 1, 1, 7, 4, 4, 4, 2, 2],
            [6, 6, 6, 2, 2, 2, 1, 1, 1, 0, 0, 0, 5, 5, 5, 1, 1, 1, 7, 3, 3, 3, 2, 2, 2, 0, 0, 0, 5, 5],
            [6, 6, 6, 4, 4, 4, 0, 0, 0, 1, 1, 1, 5, 5, 5, 2, 2, 2, 7, 3, 3, 3, 0, 0, 0, 2, 2, 2, 5, 5],
            [6, 6, 6, 2, 2, 2, 4, 4, 4, 0, 0, 0, 5, 5, 5, 3, 3, 3, 1, 1, 1, 7, 2, 2, 2, 0, 0, 0, 4, 4],
            [6, 6, 6, 1, 1, 1, 4, 4, 4, 2, 2, 2, 5, 5, 5, 0, 0, 0, 7, 1, 1, 1, 3, 3, 3, 2, 2, 2, 5, 5]
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
        // Семерка
        '6' => array(6),
        // Звезда
        '7' => array(7),
    );
    // Вайлд
    public $wild = array(6);
    // Скаттер
    public $scatter = array(7);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
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
        array('symbol'=> '0', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '0', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '1', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '1', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '1', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '2', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> '2', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> '2', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> '3', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '3', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '3', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '4', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> '4', 'count'=> 4, 'multiplier'=> 40),
        array('symbol'=> '4', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '5', 'count'=> 5, 'multiplier'=> 400),
        array('symbol'=> '5', 'count'=> 4, 'multiplier'=> 80),
        array('symbol'=> '5', 'count'=> 3, 'multiplier'=> 20),
        array('symbol'=> '6', 'count'=> 5, 'multiplier'=> 1000),
        array('symbol'=> '6', 'count'=> 4, 'multiplier'=> 400),
        array('symbol'=> '6', 'count'=> 3, 'multiplier'=> 40),
    );
}