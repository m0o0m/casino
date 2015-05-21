<?
    $m = scandir('games/igt');
    
    foreach($m as $d) {
        if(strlen($d) > 3) {
            echo $d.'<br>';
            unlink('games/igt/'.$d.'/index.html');
        }
    }
