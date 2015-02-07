<pre>
<?
    // название игры
    $game = $api->gameSession->game->string_id;
    // протокол
    $protocol = ($_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://';
    // ссылка на статику с папкой игры
    $sh = $protocol.$api->staticHost.'/'.$api->sectionId.'/'.$game.'/';
    // bonus
    $bonus = (empty($_GET['bonus'])) ? '' : '?bonus='.$_GET['bonus'];
    // ссылка на обработчик
    $serverLink = $protocol.$api->sessionHost.'/core/WebEngine.php'.$bonus;
    
    $flash_fullscreen = true;
    // ссылка на флешку + GET параметры для флешки
	$game_swf = $sh. 'GTSWrapper.swf?brand=vanilla&theGame='.$sh.$game.'.swf&lang='.$sh.$game.'_en.xml&edgeServlet='.$serverLink.'&width=100%25&height=100%25&vssession=&loginScript=loadLobby()&play4=free&domain=harrycasino.com&nativeHeight=700&nativeWidth=1130&gameTitle='.$game;
    
    $timeLink = $protocol.$api->sessionHost.'/core/time.php';
    $jscript = 'window.addEventListener("load", function() {
        var link = "'.$timeLink.'",
            obj = document.getElementById("flashGameObject"),
            counter = 0,
            interval = setInterval(function() {
                checkTime();
            }, 1000);
        function checkTime() {
            var xmlhttp = new XMLHttpRequest(),
				currentTime = Math.round(+new Date() / 1000),
                resp, time, r;
            xmlhttp.open("POST", link + "?time=" + currentTime, false);
            xmlhttp.send(null);
            if(xmlhttp.status == 200) {
                resp = xmlhttp.responseText;
                time = Math.round(+new Date() / 1000);
                r = resp - time;
				console.log(r);
                if(r < 4 && r > -4) {
                    clearInterval(interval);
                    obj.style.width = "100%";
                }
                else {
                    if(counter % 2 == 0) {
                        obj.style.width = "100%";
                    }
                    else {
                        obj.style.width = "100.1%";
                    }
                    counter++;
                }
            }
        }
    });';
	$flashvars = 'helpURL: "javascript:$j(&quot;#Avengers&quot;).data(&quot;game&quot;).loadGameRules();"';
	
	include 'flash_html.php';
?>
