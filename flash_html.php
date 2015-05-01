<?php
if($_SERVER['PHP_SELF']=='/flash_html.php')exit;
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<meta name="google-site-verification" content="" />';
echo '<meta name="description" content="Outcomebet" />';
echo '<meta name="keywords" content="Outcomebet" />';
echo '<link rel="shortcut icon" href="/favicon.ico" >';
echo '<title>'.$api->pageTitle.'</title>';
$flash_width=(isset($flash_width)?intval($flash_width):800);
$flash_height=(isset($flash_height)?intval($flash_height):600);
$flash_scale_exactfit=(isset($flash_scale_exactfit)&&$flash_scale_exactfit?1:0);
$flash_fullscreen=(isset($flash_fullscreen)&&$flash_fullscreen==2?2:0);
$flash_scale_showall=(isset($flash_scale_showall)&&$flash_scale_showall?1:0);
$flash_wmode=(isset($flash_wmode)&&preg_match("/^[a-z]+$/i",$flash_wmode)?$flash_wmode:'');
echo '<script type="text/javascript" src="/media/js/swfobject.js"></script>';
echo $api->renderScriptTags();
echo '<style type="text/css">';
echo '*{color:#000000;font-size:9px;font-family:Verdana, sans-serif;}';
echo '#flashcontent{background-color:#000000;'.($flash_scale_exactfit||$flash_fullscreen?'width:100%;height:100%;':'width:'.$flash_width.'px;height:'.$flash_height.'px;').($flash_fullscreen?'':'position:absolute;top:50%;left:50%;margin-left:-'.($flash_width/2).'px;margin-top:-'.($flash_height/2).'px').'}';
echo '#flashGameObject{width:100%;height:100%}';
echo 'body,html{background-color:#000000;margin:0px;padding:0px;height:100%;overflow:hidden}';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div id="flashcontent">';
echo '<div id="flashGameObject">';
echo '<p style="color: white;">Вам необходимо загрузить и установить Flash player</p>';
echo '<p style="color: white;"><a href="http://www.adobe.com/go/getflashplayer"><img src="http'.($_SERVER['HTTPS']=='on'?'s':'').'://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>';
echo '</div>';
echo '</div>';
echo '<script type="text/javascript">';
if(!$flash_fullscreen)
	{
	echo 'function setRatio(){';
	echo 'var fw='.$flash_width.',';
	echo 'fh='.$flash_height.',';
	echo 'dw=document.documentElement.clientWidth,';
	echo 'dh=document.documentElement.clientHeight-4,';
	echo 'dxr=dw/fw,';
	echo 'dyr=dh/fh,';
	echo 'nw=dw,';
	echo 'nh=dh,';
	echo 'f=document.getElementById("flashcontent").style;';
	if(!$flash_scale_exactfit&&!$flash_scale_showall)
		{
		echo 'if(dyr<dxr)nw=Math.floor(fw*dyr);';
		echo 'if(dyr>dxr)nh=Math.floor(fh*dxr);';
		}
	echo 'f.width=nw+"px";';
	echo 'f.height=nh+"px";';
	echo 'f.marginLeft="-"+(nw/2)+"px";';
	echo 'f.marginTop="-"+(nh/2)+"px";';
	echo '}';
	echo 'window.onresize=setRatio;';
	}
echo 'function setFocus(){';
if(!$flash_fullscreen)echo 'setRatio();';
echo 'try{document.getElementById("flashGameObject").focus();}catch(E){}';
echo 'try{document.getElementsByTag("embed")[0].focus();}catch(E){}';
echo '}';
echo 'document.body.onload=setFocus;setTimeout(setFocus,2000);';
echo $jscript;
if(!isset($base))$base='.';
echo 'var flashvars={'.$flashvars.'},attributes={},params={quality:"high",bgcolor:"#000000"'.($flash_wmode?',wmode:"'.$flash_wmode.'"':'').($flash_scale_exactfit?',scale:"exactfit"':($flash_scale_showall?',scale:"showall"':'')).',menu:"true",allowFullScreen:"true",base:"'.$base.'",allowScriptAccess:"always",allowFullScreenInteractive:"true"};';
echo 'swfobject.embedSWF("'.$game_swf.'", "flashGameObject", "100%", "100%", "11.2.0", "", flashvars, params, attributes);';
if(!isset($url_help))$url_help=0;
echo 'function help(){'.($url_help==0?'':'var wh=window.open("gamerules.php","rules","directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no,toolbar=no,width=500,height=420");wh.focus();').'}';
echo '</script>';
echo '</body>';
echo '</html>';
?>