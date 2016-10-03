<?

class iron_manParams extends Params {

    // раскладки
    // Основная, Фриспины
    public $reels = array(
        // раскладка для главной игры
        array(
            array(9,5,11,3,10,7,12,6,5,9,10,1,8,5,6,11,3,10,5,8,9,12,7,4,6,7,2,11,5,10,6,4,10,3,9,11,5,8,4,11),
            array(9,1,1,1,8,7,5,11,6,2,2,2,8,10,4,7,11,3,10,9,12,6,11,3,8,4,7,5,9,11,3,10,5,9,8,4,10,11,5,6),
            array(10,1,1,1,7,5,9,4,11,2,2,2,10,8,5,11,3,8,10,1,1,1,7,5,8,2,2,2,6,9,12,11,3,6,5,7,3,9,6,4),
            array(11,1,1,1,6,7,5,8,9,2,2,2,7,4,8,5,9,3,7,6,4,11,5,8,7,12,6,10,3,9,5,11,4,10,3,11,4,10,5,8),
            array(11,4,8,9,5,11,3,10,7,12,6,4,9,10,1,8,5,7,11,3,9,11,2,10,8,3,9,7,5,6,7,2,11,5,10,6,4,10,3,8),
        ),
        // FS
        array(
            array(9,5,11,3,10,7,12,6,4,9,10,1,8,5,6,11,3,10,5,8,9,12,7,4,6,7,2,11,5,10,6,4,10,3,9,11,5,8,4,11),
            array(9,1,1,1,8,5,7,4,6,2,2,2,8,4,10,3,7,5,9,1,1,1,11,3,7,2,2,2,9,11,3,10,4,8,6,12,10,11,5,6),
            array(10,1,1,1,7,3,9,4,11,2,2,2,10,8,4,11,12,8,10,1,1,1,7,5,8,2,2,2,6,9,12,11,3,6,5,7,3,9,6,4),
            array(11,1,1,1,6,7,5,8,9,2,2,2,7,4,8,5,9,3,7,6,4,11,5,8,7,12,6,10,3,9,5,11,4,10,3,11,4,10,5,8),
            array(11,4,8,9,5,11,3,10,7,12,6,4,9,10,1,8,5,7,11,3,9,11,2,10,8,3,9,7,5,6,7,2,11,5,10,6,4,10,3,8),
        )

    );
    // Символы
    public $symbols = array(
        // 10
        'T' => array(10),
        // Q
        'Q' => array(8),
        // Scatter
        'S' => array(12),
        // Stark
        'D' => array(3),
        // Iron Man
        'B' => array(1),
        // Suitcase
        'E' => array(4),
        // 9
        'N' => array(11),
        // J
        'J' => array(9),
        // K
        'K' => array(7),
        // Rockets
        'M' => array(5),
        // Iron Man Fly
        'C' => array(2),
        // A
        'A' => array(6),
        // WILD
        'Z' => array(13),
    );
    // Вайлд
    public $wild = array(13);
    // Скаттер
    public $scatter = array(12);
    // Умножение ставки, когда выпали скаттеры
    public $scatterMultiple = array(
        '2' => 1,
        '3' => 3,
        '4' => 10,
        '5' => 100,
    );
    // Выигрышные линии
    public $winLines = array(
        array(1,1,1,1,1),
        array(0,0,0,0,0),
        array(2,2,2,2,2),
        array(0,1,2,1,0),
        array(2,1,0,1,2),
        array(1,0,0,0,1),
        array(1,2,2,2,1),
        array(0,0,1,2,2),
        array(2,2,1,0,0),
        array(1,2,1,0,1),
        array(1,0,1,2,1),
        array(0,1,1,1,0),
        array(2,1,1,1,2),
        array(0,1,0,1,0),
        array(2,1,2,1,2),
        array(1,1,0,1,1),
        array(1,1,2,1,1),
        array(0,0,2,0,0),
        array(2,2,0,2,2),
        array(0,2,2,2,0),
        array(2,0,0,0,2),
        array(1,2,0,2,1),
        array(1,0,2,0,1),
        array(0,2,0,2,0),
        array(2,0,2,0,2),
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
        array('symbol'=> 'C', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> 'C', 'count'=> 4, 'multiplier'=> 350),
        array('symbol'=> 'C', 'count'=> 3, 'multiplier'=> 70),
        array('symbol'=> 'C', 'count'=> 2, 'multiplier'=> 10),

        array('symbol'=> 'B', 'count'=> 5, 'multiplier'=> 5000),
        array('symbol'=> 'B', 'count'=> 4, 'multiplier'=> 350),
        array('symbol'=> 'B', 'count'=> 3, 'multiplier'=> 70),
        array('symbol'=> 'B', 'count'=> 2, 'multiplier'=> 10),

        array('symbol'=> 'D', 'count'=> 5, 'multiplier'=> 500),
        array('symbol'=> 'D', 'count'=> 4, 'multiplier'=> 100),
        array('symbol'=> 'D', 'count'=> 3, 'multiplier'=> 25),

        array('symbol'=> 'M', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 'M', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 'M', 'count'=> 3, 'multiplier'=> 15),

        array('symbol'=> 'E', 'count'=> 5, 'multiplier'=> 200),
        array('symbol'=> 'E', 'count'=> 4, 'multiplier'=> 50),
        array('symbol'=> 'E', 'count'=> 3, 'multiplier'=> 15),

        array('symbol'=> 'A', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 'A', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 'A', 'count'=> 3, 'multiplier'=> 12),

        array('symbol'=> 'K', 'count'=> 5, 'multiplier'=> 150),
        array('symbol'=> 'K', 'count'=> 4, 'multiplier'=> 30),
        array('symbol'=> 'K', 'count'=> 3, 'multiplier'=> 12),

        array('symbol'=> 'Q', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 'Q', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 'Q', 'count'=> 3, 'multiplier'=> 10),

        array('symbol'=> 'J', 'count'=> 5, 'multiplier'=> 100),
        array('symbol'=> 'J', 'count'=> 4, 'multiplier'=> 25),
        array('symbol'=> 'J', 'count'=> 3, 'multiplier'=> 10),

        array('symbol'=> 'T', 'count'=> 5, 'multiplier'=> 75),
        array('symbol'=> 'T', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 'T', 'count'=> 3, 'multiplier'=> 7),

        array('symbol'=> 'N', 'count'=> 5, 'multiplier'=> 75),
        array('symbol'=> 'N', 'count'=> 4, 'multiplier'=> 20),
        array('symbol'=> 'N', 'count'=> 3, 'multiplier'=> 7),
    );

    // prize - описание шанса выпадения призов(х1, х2, х3, х4, х5), названия призов и множителя(сам приз)
    // fsCount - описание шанса выпадения фриспинов, название и количества фриспинов
    // multiple - описание шанса выпадения определенного множителя и самого множителя
    // typeRnd - описание рандома выпадения определенного типа(приз или фриспин или множитель)
    public $fsConf = array(
        'prize' => array(
            'alias' => array('P1', 'P2', 'P3', 'P4', 'P5'),
            'multiple' => array(1,2,3,4,5),
            'rnd' => array(
                0,1,2,3,4,
            ),
        ),
        'fsCount' => array(
            'alias' => array('F3', 'F4', 'F5', 'F6', 'F7', 'F8'),
            'count' => array(3,4,5,6,7,8),
            'rnd' => array(
                0,1,2,3,4,5,
            ),
        ),
        'multiple' => array(
            'alias' => array('M2', 'M3', 'M4'),
            'count' => array(2,3,4),
            'rnd' => array(
                0,1,2,
            ),
        ),
        'typeRnd' => array(
            'prize','prize','prize','prize','prize','prize','prize',
            'fsCount','fsCount',
            'multiple',
        ),
    );

    // Описание символов, которые могут быть объедененны и заменены в вайлд
    public $expandConf = array(
        'symbolsID' => array(1,2),
        'wild' => 13,
        // 2,3,4
        'reels' => array(1,2,3),
    );
    // Бонус объедененных символов
    public $lineBonus = array(
        'symbols' => array(1, 2),
        'multiplier' => array(
            '2' => 8,
            '3' => 30,
            '4' => 150,
            '5' => 750,
        ),
    );

}