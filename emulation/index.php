<?  
    $game = $api->gameSession->game->string_id;
    $paramsName = $game.'Params';
    
    require_once('../../skvCore/Params.php');
    require_once('../../skvCore/gameParams/'.$api->sectionId.'/'.$paramsName.'.php');
    $params = new $paramsName($api->gameSession->create_time);
    $maxLines = count($params->winLines);
    
    
    $protocol = ($_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://';
    $serverLink = $protocol.$api->sessionHost.'/skvCore/WebEngine.php';
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title><?=$api->gameSession->game->string_id?> Emulation?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        .progress {
            height:50px;
            position:relative;
            padding:0;
            margin:0;
        }
        .progressBar {
            position:absolute;
            z-index:5;
            height:100%;
            width:0%;
            background:#924747;
        }
        .progressLabel * {
            position:relative;
            color:black;
            font-size:30px;
            z-index:10;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="progress hide">
            <div class="progressBar"></div>
            <div class="progressLabel text-center">
                <span class="currentProgress">0</span>
                <span>/</span>
                <span class="totalProgress">1000</span>
            </div>
        </div>
        <div class="controls">
            <div class="column large-4 medium-4">
                <h3>Количество спинов</h3>
                <input type="number" class="totalSpins" value="1000">
            </div>
            <div class="column large-4 medium-4">
                <h3>Количество линий</h3>
                <input type="number" class="totalLines" value="<?=$maxLines?>" max="<?=$maxLines?>" min="1">
            </div>
            <div class="column large-4 medium-4">
                <h3>Ставка на линию</h3>
                <input type="number" class="betOnLine" value="10" min="1">
            </div>            
        </div>
        <div class="info row">
            <div class="column left large-4 medium-4 text-center">
                <h3>Стартовый баланс</h3>
                <label class="startBalance"><?=$api->playerBalance / 100?></label>
            </div>
            <div class="column left large-4 medium-4 text-center">
                <h3>Текущий баланс</h3>
                <label class="currentBalance"><?=$api->playerBalance / 100?></label>
            </div>
            <div class="column left large-4 medium-4 text-center">
                <h3>Общий % выигрыша</h3>
                <label class="currentWin">0</label>
            </div>
            <div class="button GoGoGo expand">Начать</div>
        </div>
    </div>
    <div class="container history">
        
    </div>
    
    <script>
        var startBalance = $('.startBalance').text();
        var currentBalance = startBalance;
        var serverLink = "<?=$serverLink?>";
        var maxLines = "<?=$maxLines?>";
        var totalSpins, totalLines, betOnLine, totalBet, xmlData
        $('.GoGoGo').click(function() {
            $('.progress').show();
            totalSpins = $('.totalSpins').val(),
            totalLines = $('.totalLines').val(),
            betOnLine = $('.betOnLine').val(),
            totalBet = totalLines * betOnLine,
            xmlData = '<CompositeRequest><EEGPlaceBetsRequest gameTitle="1" gameId="1"><Bet type="line" pick="L'+totalLines+'" stake="'+totalBet+'"'+'/'+'></EEGPlaceBetsRequest><EEGLoadResultsRequest gameId="1" gameTitle="1"'+'/'+'><'+'/'+'CompositeRequest>';
            $('.totalProgress').text(totalSpins);
            currentSpin = 1;
            makeReq();
        });
        
        function makeReq() {
            if(currentSpin > totalSpins) return;
            $.ajax({
                    type: "POST",
                    url: serverLink,
                    data: {xml: xmlData},
                    dataType: "xml",
                    success: function(data) {
                        var eegp = $(data).find('EEGPlaceBetsResponse')[0];
                        var currentBalance = $(eegp).attr('newBalance');
                        $('.currentBalance').text(currentBalance);
                        var currentWin = currentBalance / startBalance * 100;
                        $('.currentWin').text(currentWin.toFixed(3));
                        $('.currentProgress').text(currentSpin);
                        $('.progressBar').css({width: (currentSpin / totalSpins * 100) + '%'});
                        currentSpin++;
                        makeReq();
                    }
                });
        }
    </script>
</body>
</html>
