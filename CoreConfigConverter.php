<?
    require_once('Params.php');

    $game = $_GET['game'];
    $publisher = $_GET['publisher'];

    $paramName = $game.'Params';

    //require_once('gameParams/'.$publisher.'/'.$paramName.'.php');

function rnd($n1, $n2){return $n1;}

class OldConfigConverter
{
    /**
     * @param $phpCode
     * @param $comments
     * @return array
     */
    public function parsePhpConfig($phpCode, &$comments = null)
    {
        $phpCode = str_replace('public', '', $phpCode);
        $phpCode = preg_replace("/.*rnd\(.*/m", ';', $phpCode);
        $startClass = strpos($phpCode, 'class');
        $endClass = strpos($phpCode, '{');
        $delete = substr($phpCode, $startClass, $endClass);
        $phpCode = str_replace($delete, '', $phpCode);
        $phpCode = str_replace('}', '', $phpCode);

        preg_match_all("/(?<comment>^[ \t]*(?:(?:\/\/|#).*[\r\n]+)+)?\\$(?<name>[a-zA-Z\d_]+)\s*=/m", $phpCode, $matches);

        $varNames = $matches['name'];

        @eval("?>".$phpCode);
//		$comments = array_combine($matches['name'], $matches['comment']);
        $comments=[];
        foreach($matches['name'] as $k=>$v)if(!array_key_exists($v,$comments))$comments[$v]=$matches['comment'][$k];
        $comments = array_map(function($comment){
            $comment = trim($comment);
            return preg_replace("/^(\/\/)[\t ]*/m", '', $comment);
        }, $comments);
        return compact($varNames);
    }

    private static function containsArray($array)
    {
        foreach($array as $value)
            if(is_array($value))
                return true;
        return false;
    }

    public function formatAsYaml($data, $comments = null)
    {
        $yaml = '';
        unset($data['action']);

        foreach($data as $key => $value)
        {
            if(!empty($comments[$key]))
            {
                $comment = $comments[$key];
                $lines = preg_split("/[\r\n]+/", $comment);
                $lines = array_map(function($line){ return "# {$line}\n"; }, $lines);
                $comment = implode('', $lines);
                $yaml .= $comment;
            }
            if($key === 'denominations')
            {
                if(is_string($value))
                    $yaml .= $key.': '.$this->yamlEncodeInline(array_map('floatval', explode(',', $value)))."\n";
                else
                    $yaml .= $key.': '.$this->yamlEncodeInline($value)."\n";
            }
            else if(preg_match("/^(?:lines|cyl.*|cyf.*|cyr.*|comb|comf|bonus_wheel|pt|num|.*)$/", $key) && is_array($value) && self::containsArray($value))
            {
                $yaml .= "$key:\n";
                if(array_keys($value) === range(0, count($value)-1))
                {
                    foreach($value as $line)
                        $yaml .= "- ".$this->yamlEncodeInline($line)."\n";
                }
                else
                {
                    foreach($value as $i => $line)
                        $yaml .= "  {$i}: ".$this->yamlEncodeInline($line)."\n";
                }
            }
            else
            {
                $yaml .= $key.': '.$this->yamlEncodeInline($value)."\n";
            }
        }

        return $yaml;
    }

    private function yamlEncodeInline($val)
    {
        $json = json_encode($val, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $str = preg_replace("/([\[,])\"(?!\s)([^,\[\]\"]+)(?<!\s)\"(?=[,\]])/", "$1$2", $json);
        if(preg_match("/^\"(?!\s).*(?<!\s)\"$/", $str) && $str !== '""')
            $str = trim($str, '"');
        return $str;
    }
}
header('Content-Type: text/plain');
$converter = new OldConfigConverter();
$configContent = file_get_contents('gameParams/'.$publisher.'/'.$paramName.'.php');
$config = $converter->parsePhpConfig($configContent, $comments);
echo $yaml =  $converter->formatAsYaml($config, $comments);



?>
