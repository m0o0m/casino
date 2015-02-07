<?php
    $f = $_GET['file'];
    header ("Content-type: application/x-shockwave-flash"); 
    
    $c = file_get_contents('Lang/'.$f.'.swf');
    
    die($c);
?>
