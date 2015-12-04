<?
    $z = scandir(__DIR__);
    foreach($z as $l) {
        $m = str_replace('-', '_', $l);
        echo $m.'<br>';
    }
