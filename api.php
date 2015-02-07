<?

class Api {
    public $gameSession;
    
    public function __construct() {
        $this->gameSession = new stdClass();
        $this->gameSession->game = new stdClass();
        $tmp = $_GET['game'];
        $p = explode('|||', $_GET['game']);
        $this->gameSession->game->string_id = $p[0];
        $this->sectionId = $p[1];

        if(!empty($p[2])) {
            $_GET['bonus'] = $p[2];
        }

        
        $this->gameSession->create_time = 1411559061;
        
        if(empty($_SESSION['balance'])) $_SESSION['balance'] = 100000;
        
        $this->playerBalance = $_SESSION['balance'];
    }
    
    public function setBalance($value) {
        $this->playerBalance = $value;
        $_SESSION['balance'] = $value;
    }
    
    public function getRequestBody() {
        return file_get_contents('php://input');
    }

}

$api = new Api;
