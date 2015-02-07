<?

session_start();

$static = $_SESSION['server_game_link'];

$content = file_get_contents('HttpCombiner.js');
$content = str_replace('PcmGuid.ashx', $static.'PcmGuid.php', $content);
$content = str_replace('Genie.ashx', $static.'Genie.php', $content);
$content = str_replace('Metric.ashx', $static.'Metric.php', $content);
$content = str_replace('CacheDetection.ashx', $static.'CacheDetection.php', $content);
$content = str_replace('sessionrefresh.ashx', $static.'sessionrefresh.php', $content);
$content = str_replace('Strings.ashx', $static.'Strings.php', $content);

echo $content;
