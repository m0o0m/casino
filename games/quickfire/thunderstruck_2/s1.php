<?
    session_start();
    $lang = (empty($_SESSION['lang'])) ? 'en' : $_SESSION['lang'];
    
    $content = file_get_contents('s1.js');
    $content = str_replace('REPLACE_LANG', $lang, $content);
    
    echo $content;
?>
