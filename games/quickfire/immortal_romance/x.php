<?php
    session_start();
    if(!empty($_POST['<Pkt><Id_mid'])) {
        $c = $_POST['<Pkt><Id_mid'];
        $c = substr($c, 1);
        $p = strpos($c, '"');
        $id = substr($c, 0, $p);
        switch($id) {
            case "1":
                echo '';
                break;
            case "151":
                echo '';
                break;
            case "144":
                session_destroy();
                echo '';
                break;
            case "0":
                echo '';
                break;
            case "130":
                echo '';
                break;
            
        }
    }
    if(!empty($_POST['<Pkt_version'])) {
        if(!empty($_SESSION['rrr'])) {
            echo '';
            die();
        }
        $_SESSION['rrr'] = true;
        echo '';
    }
    
    
?>  
