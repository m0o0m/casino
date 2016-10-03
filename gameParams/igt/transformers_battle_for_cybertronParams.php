<?

class transformers_battle_for_cybertronParams extends Params {
    public $reels = array(
        array(
            array(5,2,3,5,2,4,5,7,5,1,4,5,6,4,5,51,4,5,6,4,5,7,4,7,5,1,4,5,6,4,),
            array(6,7,4,6,5,3,6,2,5,6,7,0,6,2,5,6,7,3,6,1,7,6,4,5,6,3,5,6,7,3,6,1,),
            array(7,6,3,7,1,4,7,51,4,7,2,7,6,3,7,5,0,7,1,6,4,7,2,7,4,6,3,7,6,3,7,1,4,),
            array(5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,3,),
            array(4,5,6,2,51,5,3,7,6,1,3,6,7,4,3,6,7,5,2,4,6,7,2,6,1,3,6,7,4,3,6,),
        ),
        array(
            array(5,2,3,5,2,4,5,7,5,1,4,5,6,4,5,4,5,6,4,5,7,4,7,5,1,4,5,6,4,),
            array(6,7,4,6,5,3,6,2,6,7,0,6,2,5,6,7,3,6,1,7,4,6,5,3,6,2,6,7,),
            array(7,6,3,7,1,4,7,4,2,7,6,3,7,5,0,7,1,6,4,7,2,4,7,6,3,7,6,3,7,1,4,7,4,2,7,6,3,),
            array(5,7,3,5,4,2,6,5,4,0,6,7,1,3,4,7,6,5,2,4,7,6,2,3,5,7,3,5,4,2,6,5,),
            array(4,5,6,2,5,3,7,6,1,3,6,7,4,3,6,7,5,2,4,6,7,2,6,1,3,6,7,4,3,6,),
        ),
    );

    public $reelConfig = array(4,4,4,4,4);

    public $symbols = array(
        'b01' => array(51),
        's01' => array(1),
        's02' => array(2),
        's03' => array(3),
        's04' => array(4),
        's05' => array(5),
        's06' => array(6),
        's07' => array(7),
        'w01' => array(0),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(10);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '3' => 3,
    );

    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(2,2,2,2,2),
        array(0,0,0,0,0),
        array(3,3,3,3,3),
        // 5
        array(1,2,3,2,1),
        array(2,1,0,1,2),
        array(0,0,1,2,3),
        array(3,3,2,1,0),
        array(1,0,0,0,1),
        // 10
        array(2,3,3,3,2),
        array(0,1,2,3,3),
        array(3,2,1,0,0),
        array(1,0,1,2,1),
        array(2,3,2,1,2),
        // 15
        array(0,1,0,1,0),
        array(3,2,3,2,3),
        array(1,2,1,0,1),
        array(2,1,2,3,2),
        array(0,1,1,1,0),
        // 20
        array(3,2,2,2,3),
        array(1,1,2,3,3),
        array(2,2,1,0,0),
        array(1,1,0,1,1),
        array(2,2,3,2,2),
        // 25
        array(1,2,2,2,3),
        array(2,1,1,1,0),
        array(0,0,1,0,0),
        array(3,3,2,3,3),
        array(0,1,2,2,3),
        // 30
        array(3,2,1,1,0),
        array(0,0,0,1,2),
        array(3,3,3,2,1),
        array(1,0,0,1,2),
        array(2,3,3,2,1),
        // 35
        array(0,1,1,2,3),
        array(3,2,2,1,0),
        array(1,0,1,2,3),
        array(2,3,2,1,0),
        array(0,1,2,3,2),
        // 40
        array(3,2,1,0,1),
    );

    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $defaultCoinsCount = 60;

    public $denominations = array(1,2,3,5,10,20,30,50,100,200,300,500,1000,2000,3000,5000,10000,20000,30000,50000,100000);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;

    public $winPay = array(
        array('symbol'=> 's01', 'count'=> 5, 'multiplier'=> 4000),
        array('symbol'=> 's01', 'count'=> 4, 'multiplier'=> 500),
        array('symbol'=> 's01', 'count'=> 3, 'multiplier'=> 100),
        array('symbol'=> 's02', 'count'=> 5, 'multiplier'=> 800),
        array('symbol'=> 's02', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's02', 'count'=> 3, 'multiplier'=> 60),
        array('symbol'=> 's03', 'count'=> 5, 'multiplier'=> 800),
        array('symbol'=> 's03', 'count'=> 4, 'multiplier'=> 200),
        array('symbol'=> 's03', 'count'=> 3, 'multiplier'=> 60),
        array('symbol'=> 's04', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's04', 'count'=> 4, 'multiplier'=> 60),
        array('symbol'=> 's04', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's05', 'count'=> 5, 'multiplier'=> 300),
        array('symbol'=> 's05', 'count'=> 4, 'multiplier'=> 60),
        array('symbol'=> 's05', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's06', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's06', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's06', 'count'=> 3, 'multiplier'=> 10),
        array('symbol'=> 's07', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 's07', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 's07', 'count'=> 3, 'multiplier'=> 10),
    );
}