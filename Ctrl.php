<?php

/**
 * Class Ctrl
 *
 * Контроллер игры
 */
class Ctrl {
    /**
     * @var array $request XML объект, который содержит в себе запрос от флешки
     */
    protected $request;
    /**
     * @var object $api Глобальный объект для работы с балансом и т.д
     */
    protected $api;
    /**
     * @var string $game Строковое название игры.
     */
    protected $game;
    /**
     * @var object $slot Основной объект, логика
     */
    protected $slot;
    /**
     * @var object $gameParams Параметры игры
     */
    protected $gameParams;
    /**
     * @var array $bonus Содержит информацию по текущим бонусам
     */
    public $bonus = array();
    /**
     * @var array $fsBonus Содержит информацию по текущим FSам
     */
    public $fsBonus = array();

    /**
     * Обработка запроса и запуск нужного метода
     *
     * @param object $params Параметры игры
     */
    public function __construct($params) {
        $this->api = WebEngine::api();
        $this->game = $this->api->gameSession->game->string_id;
        $this->gameID = $this->api->gameSession->create_time;
        $this->request = $this->getRequest();
        $this->gameParams = $params;

        $this->processRequest($this->request);
    }

    /**
     * Обработка запроса
     *
     * @param array $request
     */
    protected function processRequest($request) {
        // Тип девайса... одинаковый ответ
        if(!empty($request['DeviceTypeRequest'])) {
            $this->startDevice($request);
        }
        // баланс + выплаты + раскладки + восстановление игры
        else if(!empty($request['EEGLoadOddsRequest']) || !empty($request['FOConfigRequest'])) {
            $this->startInit($request);
        }
        // спин
        else if(!empty($request['EEGPlaceBetsRequest'])) {
            $this->startSpin($request['EEGPlaceBetsRequest']);
        }
        // получение баланса после спина
        else if(!empty($request['EEGSettleBetsRequest'])) {
            $this->startBalance($request['EEGSettleBetsRequest']);
        }
        // получение баланса + параметры ставок
        else if(!empty($request['EEGConfigRequest'])) {
            $this->startStakeConfig($request['EEGConfigRequest']);
        }
        // Сохранение состояния бонуса
        else if(!empty($request['EEGSaveStateRequest']) || !empty($request['FOSaveStateRequest'])) {
            $this->startSaveState($request);
        }
        // Запросы для бонусов и т.д
        else if(!empty($request['EEGActionRequest'])) {
            $this->startAction($request['EEGActionRequest']);
        }
        else if(isset($request['CustomerDetailsRequest'])) {
            $this->startCustomer($request['CustomerDetailsRequest']);
        }
        else if(isset($request['CustomerFunBalanceRequest'])) {
            $this->startFunBalance($request['CustomerFunBalanceRequest']);
        }
        else if(!empty($request['FOOpenGameRequest'])) {
            $this->startGameId($request['FOOpenGameRequest']);
        }
        else if(!empty($request['FOPlaceBetsRequest'])) {
            $this->startSpin($request['FOPlaceBetsRequest']);
        }
        else if(!empty($request['FOSettleBetsRequest'])) {
            $this->startBalance($request['FOSettleBetsRequest']);
        }
        else if(isset($request['FOLoadResultsRequest'])) {
            $this->startResult();
        }
    }

    /**
     * Получение запроса из POST
     *
     * @return array
     */
    protected  function getRequest() {
        if(isset($_POST['xml'])) return (array) simplexml_load_string($_POST['xml']);
        else return (array) simplexml_load_string($this->api->getRequestBody());
        //echo '<pre>';
        //return (array) simplexml_load_string('<CompositeRequest><EEGPlaceBetsRequest gameTitle="PT-Avengers" gameId="172704504"><Bet type="line" pick="L20" stake="1" autoPlay="false"/></EEGPlaceBetsRequest><EEGLoadResultsRequest gameId="172704504" gameTitle="PT-Avengers"/></CompositeRequest>');
    }

    /**
     * Получение отформатированной даты
     *
     * @return string
     */
    protected function getFormatedDate() {
        return date('Y-m:d').'T'.date('H:m:s').'+0200';
    }

    /**
     * Отдаем отформатированный XML.
     *
     * @param string $xml
     */
    protected function outXML($xml) {
        $xml = str_replace(PHP_EOL, '', $xml);
        $xml = preg_replace('/> +</', '><', $xml);
        echo $xml;
    }

    /**
     * Получение баланса игрока
     *
     * @return float
     */
    protected function getBalance() {
        $balance = $this->api->playerBalance / 100;
        if(!empty($_SESSION['bonusWIN'])) $balance -= $_SESSION['bonusWIN'];
        return $balance;
    }

    /**
     * Получение конфига ставок
     *
     * @return string
     */
    protected function getStakeParams() {
        $stake = $this->gameParams->betConfig;
        $xml = '<EEGConfigResponse minStake="'.$stake['minBet'].'" maxStake="'.$stake['maxBet'].'" maxWin="75000.00" defaultStake="'.$stake['defaultBet'].'" roundLimit="'.$stake['maxBet'].'">
        '.$this->gameParams->getIncreaseData().'</EEGConfigResponse>';

        return $xml;
    }

    /**
     * Ответ на запрос на девайсы
     *
     * @param $request
     */
    protected function startDevice($request) {
        $stake = $this->gameParams->betConfig;
        $xml = '<CompositeResponse duine="1401764" elapsed="0" date="'.$this->getFormatedDate().'"><CustomerAuthenticateResponse/><CustomerDetailsResponse domain="harrycasino.com" anonymous="true" currency="'.$stake['currency'].'" currencyPrefix="'.$stake['currencyPrefix'].'"/><DeviceTypeResponse deviceID="23097"/></CompositeResponse>';
        $this->outXML($xml);
    }

    /**
     * Баланс после СПИНА и БОНУСОВ
     *
     * Когда флешка вызывает этот метод, то это значит, что спин или любой бонус закончился
     * и нужно подчистить все переменные в сессии, которые использовались бонусами.
     * Это нужно, в основном, для безопасной перезагрузки флешки с дальнейшим восстановлением
     *
     * @param $request
     */
    protected function startBalance($request) {
        $this->clearSession();

        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><EEGSettleBetsResponse newBalance="'.$this->getBalance().'" gameId="'.$this->gameID.'"/><EEGCloseGameResponse/></CompositeResponse>';
        $this->outXML($xml);
    }

    /**
     *
     * Параметры сессии, которые должны подчиститься на startBalance
     *
     */
    protected function clearSession() {
        unset($_SESSION['drawStates']);
        unset($_SESSION['savedState']);
        unset($_SESSION['bonusWIN']);
        unset($_SESSION['bonus']);
    }

    /**
     * Баланс + данные о ставках после СПИНА
     *
     * @param $request
     */
    protected function startStakeConfig($request) {
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><CustomerFunBalanceResponse balance="'.$this->getBalance().'"/><EEGOpenGameResponse gameId="'.$this->gameID.'"><DrawState drawId="0"/></EEGOpenGameResponse>'.$this->getStakeParams().'</CompositeResponse>';
        $this->outXML($xml);
    }

    /**
     * Сохранение состояния флешки в бонусах
     *
     * @param array $request
     */
    protected function startSaveState($request) {
        $xml = '<CompositeResponse elapsed="0" date="'.$this->getFormatedDate().'"><EEGSaveStateResponse/></CompositeResponse>';

        $this->outXML($xml);

        $tmp = (array) $request['EEGSaveStateRequest']->SavedState;
        $attrs = $tmp['@attributes'];
        $st = '<SavedState';
        foreach($attrs as $key=>$value) {
            $st.= ' '.$key.'="'.$value.'"';
        }
        $st .= '/>';

        if(empty($_SESSION['savedState'])) $_SESSION['savedState'] = array();
        $seq = $attrs['seq'];
        $_SESSION['savedState'][$seq] = $st;
        $this->afterSaveState($attrs);

    }

    /**
     * Коллбэк, после сохранения состояния.
     *
     * @param array $attrs
     */
    protected function afterSaveState($attrs) {

    }

    /**
     * Формирование XML для выигрышных линий по переданному репорту и доп.конфигу
     *
     * @param array $report
     * @param array $override
     * @return string
     */
    protected function getWinLinesData($report, $override = array()) {
        $params = array(
            'spins' => 0,
            'currentSpins' => 0,
            'lastSpins' => 0,
            'reelset' => 0,
            'runningTotal' => 0,
            'addString' => '',
            'bonus' => '',
            'trigger' => '',
            'drawWin' => $report['totalWin'],
            'display' => 'rows',
        );
        $params = $this->extendArray($params, $override);

        $runningTotal = $params['runningTotal'];

        $display = $this->gameParams->getDisplay($report[$params['display']]);

        if(empty($report['winLines']) && empty($params['bonus']) && empty($params['trigger'])) {
            $xml = '<WinLines spins="'.$params['spins'].'" currentSpins="'.$params['currentSpins'].'" lastSpins="'.$params['lastSpins'].'" runningTotal="'.$runningTotal.'" reelset="'.$params['reelset'].'" stops="'.$report['stops'].'" display="'.$display.'" drawWin="'.$params['drawWin'].'" '.$params['addString'].' />';
        }
        else {
            $xml = '<WinLines spins="'.$params['spins'].'" currentSpins="'.$params['currentSpins'].'" lastSpins="'.$params['lastSpins'].'" runningTotal="'.$runningTotal.'" reelset="'.$params['reelset'].'" stops="'.$report['stops'].'" display="'.$display.'" drawWin="'.$params['drawWin'].'" '.$params['addString'].'>';
            foreach($report['winLines'] as $winLine) {
                $star = '';
                if($winLine['withWild']) $star = '*';
                $offset = $this->slot->getOffsetsByLine($winLine['line'], $winLine['count']);
                $xml .= '<WinLine line="'.$winLine['id'].'" offsets="'.implode(',', $offset).'" prize="'.$winLine['count'].$winLine['alias'].$star.'" length="'.$winLine['count'].'" payout="'.$report['betOnLine']*$winLine['multiple'].'" />';
            }
            $xml .= $params['bonus'];
            $xml .= '</WinLines>';
            $xml .= $params['trigger'];
        }
        return $xml;
    }

    /**
     * Дополняет\перезаписывает массив $c всем из массива $p
     *
     * @param array $c
     * @param array $p
     * @return array
     */
    protected function extendArray($c, $p) {
        foreach($p as $k=>$v) {
            $c[$k] = $v;
        }
        return $c;
    }

    /**
     * Получение рандомного элемента массива
     *
     * @param array $param
     * @return mixed
     */
    protected function getRandParam($param) {
        return $param[rnd(0, count($param)-1)];
    }

    /**
     * Меняет местами строки(переворачивает) в переданном оффсете.
     *
     * @param array $offsets
     * @return array
     */
    public function invertOffsets($offsets) {
        $newOffsets = array();
        foreach($offsets as $offset) {
            if($offset < 5) $newOffsets[] = $offset + 10;
            if($offset >= 5 && $offset <= 9) $newOffsets[] = $offset;
            if($offset > 9) $newOffsets[] = $offset - 10;
        }
        return $newOffsets;
    }

    /**
     * Снижение каждого элемента массива на единицу
     *
     * @param array $array
     * @return array
     */
    public function arrayDecrease($array) {
        $c = array();
        foreach($array as $i) {
            $c[] = $i - 1;
        }
        return $c;
    }
}
