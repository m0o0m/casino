<?

class qsOriginal_Ctrl extends Ctrl {

    protected function processRequest($request) {
        $action = $_GET['action'];

        switch($action) {
            case 'init':
                $this->startInit($request);
                break;
            case 'spin':
                $this->startSpin($request);
                break;
            case 'updated':
                $this->startUpdated($request);
                break;
        }
    }

    protected function startUpdated() {
        $json = '{"updated":true}';

        $this->outJSON($json);
    }

    protected function getRequest() {

    }

}