<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>treasure_island</title>
    <style>
        * {
            margin:0;
            padding:0;
        }
        html, body {
            height:100%;
            overflow:hidden;
        }   
    </style>
</head>
<body>
<?
    $full = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
    <object width="99%" height="100%" id="flash" name="treasureisland_flash" data="<?=$full?>GTSWrapper.swf?brand=vanilla&amp;theGame=<?=$full?>treasure_island.swf&amp;lang=treasure_island_ru.xml&amp;edgeServlet=http://localhost/core/WebEngine.php?game=treasure_island|||quickspin&amp;width=640&amp;height=480&amp;vssession=&amp;loginScript=loadLobby()&amp;play4=free&amp;domain=casinoeuro.com&amp;nativeHeight=768&amp;nativeWidth=1024&amp;gameTitle=treasure island" type="application/x-shockwave-flash" style="opacity: 1; width: 100%;"><param name="movie" value="https://casinoeuro.hs.llnwd.net/e2/web-static/gts/wrapper/1.7/GTSWrapper.swf?brand=vanilla&amp;theGame=https://casinoeuro.hs.llnwd.net/e2/web-static/gts/games/treasure island/1-0/treasure island.swf&amp;lang=https://casinoeuro.hs.llnwd.net/e2/web-static/gts/games/treasure island/1-0/lang/treasure island_ru.xml&amp;edgeServlet=http://gts.bgamemodule.com/edge/WebEngine&amp;width=640&amp;height=480&amp;vssession=&amp;loginScript=loadLobby()&amp;play4=free&amp;domain=casinoeuro.com&amp;nativeHeight=768&amp;nativeWidth=1024&amp;gameTitle=treasure island"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="quality" value="high"><param name="base" value="."><param name="wmode" value="direct"><param name="scale" value="exactfit"><param name="flashvars" value="helpURL=javascript:$j(&quot;#treasureisland&quot;).data(&quot;game&quot;).loadGameRules();"></object>
    
    <script>
        setTimeout(function() {
            
            var o = document.getElementById("flash");
            o.setAttribute("height", "99%");
            setTimeout(function() {
                o.setAttribute("height", "100%");
            }, 500);
            
        }, 2000);
    </script>
</body>
</html>



