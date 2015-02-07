<?
//session_start();
$d = time() - $_GET['time'];
$time = (empty($_SESSION['lastRequestTime'])) ? false : $_SESSION['lastRequestTime'];
echo $time - $d;
