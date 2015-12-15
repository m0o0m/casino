<?php
/**
 * Casino logic
 *
 * Основные файлы логики
 *
 * @category Casino Slots
 * @author Kirill Speransky
 */

/* DELETE */
if($_SERVER['HTTP_HOST'] == 'localhost') {
    if(isset($_GET['sessionID'])) {
        session_id($_GET['sessionID']);
        session_start();
    }
    else {
        session_start();
    }
    require_once 'api.php';
}

/* DELETE */

require_once 'slot_funcs.php';

require_once 'slotTraits/SymbolsWorker.php';
require_once 'slotTraits/BonusWorker.php';

require_once 'Slot.php';
require_once 'Reel.php';
require_once 'Ctrl.php';
require_once 'Params.php';
require_once 'Ways.php';
$_SESSION['lastRequestTime'] = time();

/**
 * Class WebEngine
 *
 * Входная точка обработки запроса
 */
class WebEngine {
    /**
     * Глобальный объект для работы с балансом, параметрами игры из базы и т.д
     *
     * @var Api
     */
    public static $api;

    /**
     * Возвращает глобальный объект Api для работы с балансом
     *
     * @return object Api
     */
    public static function api() {
        return self::$api;
    }
    /**
     * Инициализация обработчика. Проверяем, есть ли настройки игры.
     * Если есть - запускает обработку запроса флешки.
     */
    public function __construct() {
        global $api;
        self::$api = &$api;
        $game = $api->gameSession->game->string_id;

        $ctrlName = $game.'Ctrl';
        $paramsName = $game.'Params';
        if(file_exists(__DIR__.'/gameParams/'.$api->sectionId.'/'.$paramsName.'.php') && file_exists(__DIR__.'/gameCtrl/'.$api->sectionId.'/'.$game.'Ctrl.php')) {
            include_once 'gameParams/'.$api->sectionId.'/'.$paramsName.'.php';
            include_once 'gameCtrl/'.$api->sectionId.'/'.$ctrlName.'.php';

            $params = new $paramsName($api->gameSession->create_time);

            // Устанавливаем конфиг, загруженный из базы
            if(!empty($api->config)) {
                foreach($api->config as $key=>$value) {
                    $params->$key = $value;
                }
            }

            // Устанавливаем параметры, загруженные из базы
            if(!empty($api->gameParams)) {
                foreach($api->gameParams as $key=>$value) {
                    $params->$key = $value;
                }
            }

            $params->createBetConfig();

            $ctrl = new $ctrlName($params);
        }
        else {
            $this->error();
        }
    }

    /**
     * Выводим ошибку, если игра не была найдена
     */
    protected function error() {
        echo 'Game not found';
    }
}

$WE = new WebEngine();

/*
$json = json_encode($_SESSION);
$f = fopen('count', 'ab');
fwrite($f, strlen($json).PHP_EOL);
fclose($f);
*/

?>
