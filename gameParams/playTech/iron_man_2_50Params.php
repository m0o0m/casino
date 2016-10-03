<?

class iron_man_2_50Params extends Params {

    // раскладки
    // Основная, Фриспины
    public $reels = array(
        // Основная
        array(
            array(14,15,2,12,13,3,8,9,4,5,12,13,0,10,11,1,14,15,2,12,13,3,14,15,2,6,7,14,15,3,10,11,4,5,8,9,3,14,15,10,11,0,12,13,6,7,16,8,9,1,10,11,16,8,9),
            array(12,13,0,8,9,3,14,15,1,10,11,2,8,9,16,14,15,4,5,12,13,1,14,15,6,7,0,12,13,2,10,11,6,7,14,15,16,12,13,4,5,8,9,3,10,11,6,7,12,13,3,14,15,2,10,11,3),
            array(6,7,10,11,0,14,15,3,8,9,1,12,13,16,14,15,2,10,11,4,5,12,13,0,8,9,6,7,14,15,3,12,13,4,5,10,11,2,8,9,6,7,14,15,1,12,13,2),
            array(14,15,3,10,11,8,9,6,7,12,13,1,10,11,4,5,14,15,2,8,9,6,7,0,14,15,3,12,13,4,5,10,11,1,8,9,6,7,14,15,3,12,13,16,10,11,4,5,3,12,13,2,14,15,2,12,13,16),
            array(4,5,14,15,3,10,11,2,12,13,6,7,8,9,1,14,15,0,10,11,4,5,0,12,13,2,14,15,6,7,12,13,3,8,9,2,10,11,4,5,14,15,3,12,13,6,7,8,9,1,14,15,3,10,11,16,12,13),
        ),
        // FS
        array(
            array(14,15,2,12,13,3,8,9,4,5,14,15,0,10,11,12,13,1,14,15,2,12,13,3,14,15,6,7,14,15,3,10,11,4,5,8,9,1,14,15,10,11,6,7,12,13,16,8,9,10,11,16,8,9),
            array(12,13,0,8,9,3,14,15,1,10,11,8,9,16,14,15,4,5,12,13,1,14,15,6,7,12,13,2,10,11,6,7,14,15,16,12,13,4,5,8,9,2,10,11,6,7,12,13,3,14,15,2,10,11,3),
            array(6,7,10,11,14,15,8,9,3,12,13,2,14,15,1,10,11,4,5,12,13,8,9,6,7,14,15,3,12,13,4,5,10,11,2,8,9,16,6,7,14,15,2),
            array(14,15,3,10,11,0,8,9,6,7,12,13,1,10,11,4,5,14,15,2,8,9,6,7,14,15,3,12,13,4,5,10,11,1,8,9,6,7,14,15,3,12,13,16,10,11,4,5,3,12,13,2,14,15,2,12,13),
            array(4,5,14,15,3,10,11,2,12,13,6,7,8,9,1,14,15,0,10,11,4,5,12,13,2,14,15,6,7,12,13,3,8,9,2,10,11,4,5,14,15,3,12,13,6,7,8,9,1,14,15,3,10,11,16,12,13),
        ),
    );
    // Символы
    public $symbols = array(
        // Eagle Wild
        'A' => array(0),
        // IronMan
        'E' => array(4,5),
        // Stark
        'B' => array(1),
        // Robot machine gun
        'J' => array(14,15),
        // Robot State
        'H' => array(10,11),
        // Robot rockets around
        'I' => array(12,13),
        // Robot rockets
        'G' => array(8,9),
        // BlackWidow
        'C' => array(2),
        // Iron Patriot
        'F' => array(6,7),
        // Scatter
        'K' => array(16),
        // Mickey Rourke
        'D' => array(3),
    );
    // Вайлд
    public $wild = array(0);
    // Скаттер
    public $scatter = array(16);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 3,
        '4' => 10,
        '5' => 100,
    );
    // Выигрышные линии
    public $winLines = array(
        // 1
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        // 5
        array(2,1,0,1,2,),
        array(1,0,0,0,1),
        array(1,2,2,2,1),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        // 10
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        // 15
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        // 20
        array(0,2,2,2,0),
        array(2,0,0,0,2),
        array(1,2,0,2,1),
        array(1,0,2,0,1),
        array(0,2,0,2,0),
        // 25
        array(2,0,2,0,2),
        array(0,2,1,0,2),
        array(2,0,1,2,0),
        array(1,0,2,1,2),
        array(0,2,1,2,0),
        // 30
        array(2,1,0,0,1),
        array(0,1,2,2,1),
        array(1,0,1,0,1),
        array(1,2,1,2,1),
        array(0,1,0,1,2),
        // 35
        array(2,1,2,0,0),
        array(2,0,0,1,2),
        array(1,2,2,0,0),
        array(0,0,1,1,2),
        array(2,2,0,1,0),
        // 40
        array(0,0,2,2,2),
        array(2,2,0,0,0),
        array(1,2,0,1,2),
        array(1,0,2,1,0),
        array(0,1,2,1,1),
        // 45
        array(2,1,0,2,1),
        array(1,2,1,0,0),
        array(1,0,1,2,2),
        array(2,2,1,2,2),
        array(0,0,1,0,0),
        // 50
        array(2,1,2,0,1),
    );
    // Выплачивать только максимальный выигрыш на линии
    public $payOnlyHighter = true;
    // настройка ставок
	public $currency = 'USD';

	public $denominations = array(0.01,0.02,0.03,0.04,0.05,0.1,0.25,0.5,1,2,3,4,5,6,7,8,9,10);
    public $lang = 'en';
    public $flash_scale_exactfit = 1;
    // Выплаты
    public $winPay = array(
        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 3000.00),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 1000.00),
        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 1000.00),
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 600.00),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 500.00),
        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 400.00),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 300.00),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 200.00),
        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 200.00),
        array('symbol'=> 'F', 'count'=> 5, 'multiplier'=> 150.00),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 100.00),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 100.00),
        array('symbol'=> 'G', 'count'=> 5, 'multiplier'=> 100.00),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 75.00),
        array('symbol'=> 'F', 'count'=> 4, 'multiplier'=> 75.00),
        array('symbol'=> 'H', 'count'=> 5, 'multiplier'=> 75.00),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 50.00),
        array('symbol'=> 'G', 'count'=> 4, 'multiplier'=> 50.00),
        array('symbol'=> 'I', 'count'=> 5, 'multiplier'=> 50.00),
        array('symbol'=> 'H', 'count'=> 4, 'multiplier'=> 30.00),
        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 30.00),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 25.00),
        array('symbol'=> 'I', 'count'=> 4, 'multiplier'=> 25.00),
        array('symbol'=> 'F', 'count'=> 3, 'multiplier'=> 15.00),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 15.00),
        array('symbol'=> 'A', 'count'=> 2, 'multiplier'=> 10.00),
        array('symbol'=> 'G', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'H', 'count'=> 3, 'multiplier'=> 10.00),
        array('symbol'=> 'I', 'count'=> 3, 'multiplier'=> 7.00),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 5.00),
    );

}