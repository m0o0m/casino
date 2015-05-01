<?php
    session_start();
    
    $link = (empty($_SESSION['server_link'])) ? 'WebEngine.php?game=untamed_giant_panda|||quickfire' : $_SESSION['server_link'];
    
    $content = file_get_contents('config.xml');
    $content = str_replace('SERVER_LINK', $link, $content);
    
    echo $content;
    
    
?>
