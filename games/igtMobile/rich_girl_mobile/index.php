<?
    session_start();

    $_SESSION['start_game'] = 'rich_girl_mobile';
    $_SESSION['start_publisher'] = 'igtMobile';
?>

<!DOCTYPE html>


<html>
<head>
<!-- meta-viewport.4-v3.html for autoscaling V3 (and V1 if needed) games -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="com.igt.game.AUTOSCALE" content="yes" />

<script>
if (navigator.userAgent.match(/\s+[789]_[\d_]+\s+like Mac OS X/)) {
    document.write('<meta name=\"com.igt.game.RESIZEKICKER\" content=\"yes\" \/>');
}
if (navigator.userAgent.match(/\s+[9]_[\d_]+\s+like Mac OS X/) && !navigator.userAgent.match(/\sCriOS\//)) {
    document.write('<meta name=\"com.igt.game.IOS9FIX\" content=\"yes\" \/>');
}

(function()
{
		var windowWidth = window.screen.width < window.outerWidth  || window.outerWidth == 0  ? //iOS8 returns 0 for outer sizes on ipad mini :(
			window.screen.width : window.outerWidth;
		var windowHeight = window.screen.height < window.outerHeight  || window.outerHeight == 0  ?
			window.screen.height : window.outerHeight;
        var scale = 1;

        var mobile = (windowWidth>windowHeight?windowHeight:windowWidth) < 570;

        if(!mobile) scale =2;
 
		/**
		 * UA Check for iOS 7.1, which introduces minimal-ui. From the release notes:
		 * A property, minimal-ui, has been added for the viewport meta tag key that allows minimizing the top and bottom bars on the iPhone as the page loads. While on a page usingminimal-ui, tapping the top bar brings the bars back. Tapping back in the content dismisses them again.
		 * For example, use <meta name="viewport" content="width=1024, minimal-ui”>.
		 */
		 
		if(navigator.userAgent.match(/\s+[789]_[\d_]+\s+like Mac OS X/)
		&& navigator.userAgent.indexOf('7_0') == -1
		&& /(iPod|iPhone)/.test(navigator.userAgent)){
			document.write('<meta name="viewport" content="width=device-width, initial-scale='+scale+', minimum-scale='+scale+', maximum-scale='+scale+', user-scalable=no, minimal-ui" />');
		} else {
			document.write('<meta name="viewport" content="width=device-width; initial-scale='+scale+'; minimum-scale='+scale+'; maximum-scale='+scale+'; user-scalable=no" />');
		}
})();
</script>

<style type="text/css" charset="utf-8">
html {
	width: 100%;
	height: 100%;
	width: 100vw;
	height: 100vh;
}
body {
	width: inherit;
	height: inherit;
}
.portrait #Loader {
	width: 320px;
	height: 440px;
}
.landscape #Loader {
	width: 480px;
	height: 300px;
}
._Loading #game {
	position: absolute;
}
#game {
	position: relative;
	top: 0px;
}
.portrait #game {
	width: 320px;
}
.landscape #game {
	height: 300px;
	width: 480px;
}
</style>
<script>
/* force percentage units for html tag on buggy iOS, including CriOS */
if (navigator.userAgent.match(/\s+[67]_[\d_]+\s+like Mac OS X/)){
	document.write('\n\
<style type="text/css" charset="utf-8">\
html {\
	width: 100%;\
	height: 100%;\
}\
</style>');
}
</script>


	<script type="text/javascript">
(function()
{
	var softwareid = location.search.match(/(?:\?|&)(softwareid=\d{3}-\d{4}-\d{3})/);
	if(softwareid = softwareid && softwareid[1])
	{
		document.write('<link rel="apple-touch-startup-image"	href="assets/apple-touch-startup-image.png?' + softwareid + '"/>');
		document.write('<link rel="apple-touch-icon-precomposed" href="assets/apple-touch-icon-57x57.png?' + softwareid + '"/>');
		document.write('<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/apple-touch-icon-72x72.png?' + softwareid + '"/>');
		document.write('<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/apple-touch-icon-114x114.png?' + softwareid + '"/>');
	}

})();
	</script>
	<meta generator="" name="com.igt.mproxy.PARAM" content="{&quot;post&quot;:[],&quot;get&quot;:[&quot;nscode&quot;,&quot;softwareid&quot;,&quot;denomamount&quot;,&quot;language&quot;,&quot;skincode&quot;,&quot;cKEY&quot;,&quot;currencycode&quot;,&quot;cVAL&quot;,&quot;minbet&quot;],&quot;method&quot;:&quot;GET&quot;,&quot;params&quot;:{&quot;nscode&quot;:&quot;CSEU&quot;,&quot;softwareid&quot;:&quot;200-1195-003&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;denomamount&quot;:&quot;1.0&quot;,&quot;language&quot;:&quot;en&quot;,&quot;skincode&quot;:&quot;CE01&quot;,&quot;cKEY&quot;:&quot;Skinid&quot;,&quot;currencycode&quot;:&quot;USD&quot;,&quot;cVAL&quot;:&quot;8&quot;,&quot;minbet&quot;:&quot;1.0&quot;}}"/>
	<meta name="com.igt.mproxy.MESSAGE" content="{&quot;CancelSubmitMobileNumber.message&quot;:&quot;Gaming regulations only allow this game to be played in valid jurisdictions.\nYour location must be verified in order to play this game.&quot;,&quot;CancelSubmitMobileNumber.title&quot;:&quot;Location Check Cancelled&quot;,&quot;SubmitMobileNumber.labelRegionCode&quot;:&quot;Select your region&quot;,&quot;Buttons.Cancel&quot;:&quot;Cancel&quot;,&quot;SubmitMobileNumber.title&quot;:&quot;Location Check&quot;,&quot;PromotionalFreeSpin.consoleBalance&quot;:&quot;Free Spins&quot;,&quot;SubmitMobileNumber.message&quot;:&quot;Please enter device phone number to verify you are in a legal jurisdiction.&quot;,&quot;Buttons.Close&quot;:&quot;Close&quot;,&quot;Error.networkOffLine&quot;:&quot;There is no network connection. Please try again when you are connected.&quot;,&quot;Error.payloadError&quot;:&quot;A system error has occurred.&quot;,&quot;SubmitMobileNumber.buttonCancel&quot;:&quot;Cancel&quot;,&quot;Error.connectionLost&quot;:&quot;Data not received.&quot;,&quot;SubmitMobileNumber.labelDeviceNumber&quot;:&quot;Mobile Number&quot;,&quot;SubmitMobileNumber.buttonValidate&quot;:&quot;OK&quot;,&quot;Buttons.OK&quot;:&quot;OK&quot;,&quot;Error.loadFailed&quot;:&quot;Connection lost! Click here to reload&quot;,&quot;Error.RGSid&quot;:&quot;Error ID:&quot;,&quot;Buttons.Retry&quot;:&quot;Retry&quot;,&quot;Error.networkError&quot;:&quot;A system error has occurred.&quot;}"/>
	<meta name="com.igt.mproxy.CONFIG" content="{&quot;RGS&quot;:{&quot;proxyUrl&quot;:&quot;tc&quot;,&quot;requestTimeout&quot;:15000,&quot;requestRetries&quot;:0},&quot;geoLocation&quot;:{&quot;enableHighAccuracy&quot;:true,&quot;maximumAge&quot;:300000,&quot;timeout&quot;:600000},&quot;console&quot;:{&quot;url&quot;:&quot;skin.html&quot;,&quot;urlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;countrycode&quot;,&quot;currencycode&quot;,&quot;nscode&quot;,&quot;skincode&quot;,&quot;uniqueid&quot;,&quot;cKEY&quot;,&quot;cVAL&quot;],&quot;lobbyURL&quot;:&quot;http://www.casinoeuro.com/igt/MobileServlet.jsp?skinid=undefined&amp;type=1&quot;},&quot;loader&quot;:{&quot;assetBaseUrlMap&quot;:{&quot;audio/*&quot;:&quot;&quot;},&quot;assetUrlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;currencycode&quot;,&quot;countrycode&quot;]}}"/>
	<meta name="com.igt.mproxy.CLIENTCONFIG" content="{&quot;ScreenInchesDiagonal&quot;:&quot;Unknown&quot;,&quot;ScreenInchesHeight&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsHeight&quot;:&quot;0&quot;,&quot;gameType&quot;:&quot;S&quot;,&quot;Popularity&quot;:&quot;12017561243&quot;,&quot;PlatformVersion&quot;:&quot;Unknown&quot;,&quot;gleVersion&quot;:&quot;1.2&quot;,&quot;ScreenInchesWidth&quot;:&quot;Unknown&quot;,&quot;HardwareVendor&quot;:&quot;Unknown&quot;,&quot;HardwareModel&quot;:&quot;Unknown&quot;,&quot;IsCrawler&quot;:&quot;N&quot;,&quot;HardwareFamily&quot;:&quot;Emulator&quot;,&quot;PlatformVendor&quot;:&quot;Linux&quot;,&quot;HardwareName&quot;:&quot;Desktop&quot;,&quot;BrowserVendor&quot;:&quot;Google&quot;,&quot;OEM&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsWidth&quot;:&quot;0&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;BrowserName&quot;:&quot;Chrome&quot;,&quot;PlatformName&quot;:&quot;Unknown&quot;,&quot;BrowserVersion&quot;:&quot;38&quot;}"/>
	<meta name="com.igt.game.TAG" content="dc3d22ed8a264eadd55e61a609b5dc71"/>
	<meta name="com.igt.game.version" content="1.9"/>

	<style type="text/css" charset="utf-8">
.xu{z-index:9999;text-align:left;margin:0 auto;visibility:hidden;display:inline-block}.gW{position:absolute;top:0;left:0;height:100%;width:100%;z-index:9999;text-align:center;visibility:hidden}.hN{display:box;box-align:center;box-pack:center;height:inherit;width:inherit}.gW .xu{position:relative;visibility:inherit}.xu .y8{visibility:inherit;display:box;box-pack:center}.uh{position:relative;font-size:.75em}.uh>*{text-align:start;margin:5px}.uh>p{margin-bottom:.7em}.uh>p.lV{font-size:.9em}.uh>h1{margin:10px 5px 5px;font-size:1.167em;text-align:center}.uh>h2{font-size:1.167em;text-align:center}.uh>ul,.uh>ol,.uh>dl{list-style-position:inside;margin-bottom:.7em}*{margin:0;padding:0;border:0;z-index:0;user-select:none;tap-highlight-color:rgba(0,0,0,0);touch-callout:none}input{user-select:text}body{font-family:arial,helvetica,sans-serif;font-size:100%;text-size-adjust:none;margin:0 auto;position:relative;overflow:visible}.Pl{overflow:hidden}.Pl #Tw,.Pl #game{visibility:hidden}#Tw{position:absolute;top:0;height:35px;width:inherit;overflow:hidden;z-index:1}#Tw>iframe{visibility:inherit;width:inherit;height:100%}#mW{visibility:hidden;position:relative;margin-top:20px}#zK{white-space:pre-line;font-size:.625em}.S6 #zK{min-height:5.3em}.HO #zK{min-height:4.0em}.Lp,.KV{min-height:32px;min-width:70px}.qo{max-width:16.563em;min-width:12.500em}.HO .qo{max-width:18.438em}.qo .y8{margin:.313em 0}.qo .TM{margin:0 .375em .25em .375em;font-weight:bold;color:#fff;border:.063em solid #EEE;background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#4b4b4b),color-stop(50%,#131313),color-stop(100%,#010101));background:-webkit-linear-gradient(top,#4b4b4b 0,#131313 50%,#010101 100%);background:linear-gradient(to bottom,#4b4b4b 0,#131313 50%,#010101 100%);border-top-left-radius:.313em;border-top-right-radius:.313em;border-bottom-left-radius:.313em;border-bottom-right-radius:.313em}.qo .TM.Jv{color:#999}.qo .TM.YV{background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#919191),color-stop(48%,#7f7f7f),color-stop(50%,#666),color-stop(100%,#6c6c6c));background:-webkit-linear-gradient(top,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%);background:linear-gradient(to bottom,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%)}.qo .TM>.TT{min-width:2.375em;padding:.5em .875em}.qo .uh{margin:.667em 1em;font-size:.938em;white-space:pre-line;text-align:center}.qo .uh>p{margin-bottom:1.2em}.qo .uh address{font-style:normal;text-align:center;white-space:pre-line;margin-top:.267em}.AW{border:.125em solid #EEE;border-top-left-radius:.938em;border-top-right-radius:.938em;border-bottom-right-radius:.938em;border-bottom-left-radius:.938em;background-clip:border;background-color:#000}.AW .Ka{display:block;position:absolute;background:transparent;top:-1.5em;right:-1.5em;border:0;margin:0;padding:0}.AW .Ka>.TT{display:block;background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNTZweCIgaGVpZ2h0PSI1NnB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDU2IDU2IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnIG9wYWNpdHk9IjAuNSI+DQoJPGNpcmNsZSBjeD0iMjgiIGN5PSIzMCIgcj0iMjQiLz4NCjwvZz4NCjxnPg0KCTxjaXJjbGUgZmlsbD0iI0ZGRkZGRiIgY3g9IjI4IiBjeT0iMjgiIHI9IjI0Ii8+DQo8L2c+DQo8bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzFfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjI4LjAwMDUiIHkxPSI0OCIgeDI9IjI4LjAwMDUiIHkyPSI4LjAwMSI+DQoJPHN0b3AgIG9mZnNldD0iMCIgc3R5bGU9InN0b3AtY29sb3I6I0E0MDAxNyIvPg0KCTxzdG9wICBvZmZzZXQ9IjAuNDkiIHN0eWxlPSJzdG9wLWNvbG9yOiNBQjEzMjkiLz4NCgk8c3RvcCAgb2Zmc2V0PSIwLjUxIiBzdHlsZT0ic3RvcC1jb2xvcjojQkQ0NDU1Ii8+DQoJPHN0b3AgIG9mZnNldD0iMSIgc3R5bGU9InN0b3AtY29sb3I6I0Q3OEY5OSIvPg0KPC9saW5lYXJHcmFkaWVudD4NCjxjaXJjbGUgZmlsbD0idXJsKCNTVkdJRF8xXykiIGN4PSIyOCIgY3k9IjI4IiByPSIyMCIvPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIxLjYzNiwzNy4xOTNjLTAuNzgsMC43OC0yLjA0NywwLjc4LTIuODI4LDBsMCwwYy0wLjc4MS0wLjc4MS0wLjc4MS0yLjA0OCwwLTIuODI5bDE1LjU1Ny0xNS41NTYNCgljMC43OC0wLjc4MSwyLjA0Ny0wLjc4MSwyLjgyOCwwbDAsMGMwLjc4MSwwLjc4MSwwLjc4MSwyLjA0NywwLDIuODI5TDIxLjYzNiwzNy4xOTN6Ii8+DQo8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTguODA4LDIxLjYzNmMtMC43OC0wLjc4LTAuNzgtMi4wNDcsMC0yLjgyOGwwLDBjMC43OC0wLjc4MSwyLjA0OC0wLjc4MSwyLjgyOSwwbDE1LjU1NiwxNS41NTcNCgljMC43OCwwLjc3OSwwLjc4LDIuMDQ3LDAsMi44MjhsMCwwYy0wLjc4MSwwLjc4MS0yLjA0OCwwLjc4MS0yLjgyOSwwTDE4LjgwOCwyMS42MzZ6Ii8+DQo8L3N2Zz4NCg==);background-position:center;background-size:62%;background-repeat:no-repeat;width:3em;height:3em;padding:0}.AW .TM.Ka>.TT{padding:0}.Ka.YV,.Ka.Jv{background:none!important}#Gn .ZA{text-align:left}#Gn .xm{text-align:right;font-size:.75em;margin:0 .833em .417em}#SI .uh>p{text-align:center}#SI .uh>form{margin:.4em .8em 1.2em;display:box;box-orient:vertical}#SI .uh label{display:box;margin:.6em 0}#SI .uh input[type=text],#SI .uh input[type=tel]{text-indent:.4em;font:inherit;margin:.1em;font-size:1.2em;line-height:1.8em}#SI .uh input[type=text],#SI .uh input[type=tel],#SI .uh select{margin:.1em;font:inherit;font-size:1.2em;height:1.8em}.HU{position:absolute;top:0;left:0;height:inherit;width:inherit;z-index:9999;text-align:center;visibility:hidden;overflow:hidden}.nJ{display:box;box-align:center;box-pack:center;height:inherit;width:inherit}.gs{position:relative;z-index:2}.o7{opacity:0;position:absolute;top:0;left:0;height:inherit;width:inherit;background-color:#000}.kB{z-index:9999;background-color:#0000a0;width:inherit;height:inherit}.kB .gs{background-color:#00015b;width:100%;text-align:center;height:10%}.kB .gs>.YX{position:absolute;text-align:center;font-family:"Arial",sans-serif;font-weight:bold;font-size:1.2em;color:#fff;margin-left:auto;margin-right:auto;margin-top:4px;width:100%}.S6 .kB>.gs>.YX{margin-top:11px}.kB .gs>.aE{background-color:#000;background-size:65px 27px;width:65px;height:27px;font-family:"Arial Black",sans-serif;font-weight:bold;font-size:.73em;color:#FFF;margin-left:auto;margin-right:5px;top:1px}.S6 .kB>.gs>.aE{top:9px}.kB .oZ{background-color:#0000a0;width:inherit;height:90%}.kB .oZ>.uJ{margin:5px;background-color:#fff;color:#a0a0a0;padding:5px;position:relative}.kB .oZ>.uJ>*{text-align:start;margin:5px}.kB .oZ>.uJ>p{margin-bottom:.7em}.kB .oZ>.uJ>p.lV{font-size:.9em}.kB .oZ>.uJ>h1{margin:10px 0 5px;font-size:1.167em;text-align:left}.kB .oZ>.uJ>h2{font-size:1.167em;text-align:left}.OZ .oZ>.uJ>ul,.OZ .oZ>.uJ>ol,.OZ .oZ>.uJ>dl{list-style-position:inside;margin-bottom:.7em}body{color:#fff}body.Pl,.portrait body{background:#000!important}#bV{top:18px}#SV{background-color:#353532}#TF{background-color:#128da2}.Lp,.KV{min-height:31px;min-width:87px}#Loader .tF{width:87px;height:31px;background-size:87px 31px;position:absolute;bottom:0;right:0}#Loader .f2{width:301px;height:199px;background-size:301px 199px}.portrait #Loader .f2{margin-top:47px}#zK{font-size:.55em}.portrait body.Pl .gW{display:block}
	</style>
</head>
<body class="Pl">
	<div id="Fk" class="gW">
		<div class="hN">
			<div id="mW" class="AW qo xu">
				<div id="Bg" class="uh"></div>
				<div id="xJ" class="Ka">
					<div class="TT"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="Loader" style="z-index:1;overflow:hidden;text-align:center;">
		<div style="position:absolute;width:inherit;height:inherit;text-align:center">
			<div style="position:absolute;width:inherit">
	<img class="f2" src="mainImage.jpg"/>
	<div style="position: relative; top: -17px; font-weight:bold;">
        <span id="MO" style="font-size: 11px;"></span></br><span style="font-size:15px; text-shadow: 1px 0px 3px  #00CCF7;"></span>
	</div>
</div>
<img class="tF" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAK4AAAA+CAYAAACyaiCtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6REMyMTJFMEEwNUFBMTFFM0E3RjhGRjI1M0I1OUNFQTIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6REMyMTJFMEIwNUFBMTFFM0E3RjhGRjI1M0I1OUNFQTIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpEQzIxMkUwODA1QUExMUUzQTdGOEZGMjUzQjU5Q0VBMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpEQzIxMkUwOTA1QUExMUUzQTdGOEZGMjUzQjU5Q0VBMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PkQX5AoAABmmSURBVHja7F15kFzF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"/>
		</div>
		<div style="position:absolute;bottom:0.25em;width:inherit">
			<div style="position:relative;display:-webkit-box;-webkit-box-align:center">
				<div class="Lp" style="-webkit-box-flex:1"></div>
				<div id="SV" style="-webkit-box-flex:3;width:auto;height:6px">
					<div id="TF" style="width:0;height:100%"></div>
				</div>
				<div class="KV" style="-webkit-box-flex:1"></div>
			</div>
			<div id="zK"> </div>
		</div>
	</div>
<script type="text/javascript">
if (!this.JSON) {
    this.JSON = {}
}(function() {
    function f(n) {
        return n < 10 ? "0" + n : n
    }
    if (typeof Date.prototype.toJSON !== "function") {
        Date.prototype.toJSON = function(key) {
            return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z" : null
        };
        String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(key) {
            return this.valueOf()
        }
    }
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap, indent, meta = {
            "\b": "\\b",
            "\t": "\\t",
            "\n": "\\n",
            "\f": "\\f",
            "\r": "\\r",
            '"': '\\"',
            "\\": "\\\\"
        },
        rep;

    function quote(string) {
        escapable.lastIndex = 0;
        return escapable.test(string) ? '"' + string.replace(escapable, function(a) {
            var c = meta[a];
            return typeof c === "string" ? c : "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4)
        }) + '"' : '"' + string + '"'
    }

    function str(key, holder) {
        var i, k, v, length, mind = gap,
            partial, value = holder[key];
        if (value && typeof value === "object" && typeof value.toJSON === "function") {
            value = value.toJSON(key)
        }
        if (typeof rep === "function") {
            value = rep.call(holder, key, value)
        }
        switch (typeof value) {
            case "string":
                return quote(value);
            case "number":
                return isFinite(value) ? String(value) : "null";
            case "boolean":
            case "null":
                return String(value);
            case "object":
                if (!value) {
                    return "null"
                }
                gap += indent;
                partial = [];
                if (Object.prototype.toString.apply(value) === "[object Array]") {
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || "null"
                    }
                    v = partial.length === 0 ? "[]" : gap ? "[\n" + gap + partial.join(",\n" + gap) + "\n" + mind + "]" : "[" + partial.join(",") + "]";
                    gap = mind;
                    return v
                }
                if (rep && typeof rep === "object") {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        k = rep[i];
                        if (typeof k === "string") {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ": " : ":") + v)
                            }
                        }
                    }
                } else {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ": " : ":") + v)
                            }
                        }
                    }
                }
                v = partial.length === 0 ? "{}" : gap ? "{\n" + gap + partial.join(",\n" + gap) + "\n" + mind + "}" : "{" + partial.join(",") + "}";
                gap = mind;
                return v
        }
    }
    if (typeof JSON.stringify !== "function") {
        JSON.stringify = function(value, replacer, space) {
            var i;
            gap = "";
            indent = "";
            if (typeof space === "number") {
                for (i = 0; i < space; i += 1) {
                    indent += " "
                }
            } else {
                if (typeof space === "string") {
                    indent = space
                }
            }
            rep = replacer;
            if (replacer && typeof replacer !== "function" && (typeof replacer !== "object" || typeof replacer.length !== "number")) {
                throw new Error("JSON.stringify")
            }
            return str("", {
                "": value
            })
        }
    }
    if (typeof JSON.parse !== "function") {
        JSON.parse = function(text, reviver) {
            var j;

            function walk(holder, key) {
                var k, v, value = holder[key];
                if (value && typeof value === "object") {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v
                            } else {
                                delete value[k]
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value)
            }
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function(a) {
                    return "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4)
                })
            }
            if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) {
                j = eval("(" + text + ")");
                return typeof reviver === "function" ? walk({
                    "": j
                }, "") : j
            }
            throw new SyntaxError("JSON.parse")
        }
    }
}());
GH = window.GH || {};
GH.bJ = function(cJ) {
    if (cJ instanceof Object) {
        GH.FV(cJ, function(Ba, cc) {
            var dF, xz;
            xz = cc.split(".");
            dF = xz.shift();
            xz = xz.join(".");
            if (xz) {
                cJ[dF] = cJ[dF] || {};
                cJ[dF][xz] = Ba;
                delete cJ[cc]
            }
        });
        cJ = GH.zZ(cJ, GH.bJ)
    }
    return cJ
};
GH.d6 = function(r4, UC) {
    for (var gA in (UC || {})) {
        r4[gA] = UC[gA]
    }
    return r4
};
GH.q6 = function(r4, UC) {
    for (var gA in (UC || {})) {
        r4[gA] = (gA in r4) ? r4[gA] : UC[gA]
    }
    return r4
};
GH.d6(GH, {
    FV: function(r4, Ro, Po) {
        for (var gA in r4) {
            r4.hasOwnProperty(gA) && Ro.call(Po, r4[gA], gA, r4)
        }
    },
    zC: function(r4, P6) {
        return "?".concat(GH.Lw.apply(this, arguments))
    },
    Lw: function(r4, P6) {
        var aI = [];
        GH.FV(r4, function(o3, W7) {
            (!P6 || P6.indexOf(W7) >= 0) && aI.push(encodeURIComponent(W7).concat("=", encodeURIComponent(o3)))
        });
        return aI.join("&")
    },
    jY: function(r4, P6) {
        var aI = [],
            W7 = -1,
            eQ = P6.length;
        while (++W7 < eQ) {
            aI[W7] = encodeURIComponent(r4[P6[W7]])
        }
        return aI.join("/")
    },
    sc: function(W7) {
        return Array.prototype.slice.call(W7)
    },
    ZL: function(qG, J0) {
        var vG = function() {};
        vG.prototype = qG.prototype;
        var cG = new vG();
        qG.apply(cG, J0);
        return cG
    },
    h4: function(r4, Ro, Po) {
        var aI = [];
        for (var AZ in r4) {
            r4.hasOwnProperty(AZ) && aI.push(Ro ? Ro.call(Po, r4[AZ], AZ, r4) : r4[AZ])
        }
        return aI
    },
    Vk: function(r4, LN, Po) {
        var vO = "";
        for (var AZ in r4) {
            r4.hasOwnProperty(AZ) && (vO += LN.call(Po, r4[AZ], AZ, r4))
        }
        return vO
    },
    zZ: function(r4, Ro, Po) {
        var vO = {};
        for (var gA in r4) {
            if (r4.hasOwnProperty(gA)) {
                vO[gA] = Ro.call(Po, r4[gA], gA, r4)
            }
        }
        return vO
    }
});
var Yv = function(h7, Sr) {
    this.h7 = h7;
    this.Sr = Sr
};
GH.d6(Yv, {
    tq: function(pB, mG, L5) {
        return (!mG || pB.source === mG) && (!L5 || pB.origin === L5) && pB.data.indexOf("com.igt.game:") === 0 && GH.ZL(Yv, JSON.parse(pB.data.substr("com.igt.game:".length)))
    },
    ec: function(u3, L5, h7, Sr) {
        (new Yv(h7, Sr)).ec(u3, L5)
    },
    F5: function(u3, h7, Sr) {
        Yv.ec(u3, "*", h7, Sr)
    },
    V3: function(h7, Sr) {
        Yv.ec(window.parent, "*", h7, Sr)
    },
    UY: function(h7, Sr) {
        Yv.ec(window, Yv.L5(document.location.href), h7, Sr)
    },
    L5: function(xV) {
        var ur = document.createElement("A");
        ur.setAttribute("href", xV);
        return [ur.protocol, "//", ur.hostname, ur.port > 0 ? ":".concat(ur.port) : ""].join("")
    }
});
GH.d6(Yv.prototype, {
    toString: function() {
        return "com.igt.game:" + JSON.stringify([this.h7, this.Sr])
    },
    ec: function(u3, L5) {
        try {
            u3.postMessage(this.toString(), L5)
        } catch (RL) {}
    }
});
fe = function(mG, L5) {
    var Jr = {},
        tJ = 0,
        FO = function(pB) {
            var Iy = Yv.tq(pB, mG, L5);
            Iy && Iy.h7 && Jr[Iy.h7] && Jr[Iy.h7].forEach(function(HW) {
                HW.call(void 0, Iy.Sr)
            })
        },
        u1 = function(HW, h7) {
            this.AN(h7, HW)
        },
        L5 = L5 && Yv.L5(L5);
    var AN = this.AN = function(h7, HW) {
        var Ge = Jr[h7];
        if (!Ge) {
            Ge = Jr[h7] = [];
            tJ++ || window.addEventListener("message", FO, true)
        }
        Ge.indexOf(HW) >= 0 || Ge.push(HW);
        return this
    };
    var rj = this.rj = function(h7, HW) {
        var gA, Ge = Jr[h7];
        if (Ge) {
            gA = Ge.indexOf(HW);
            gA >= 0 && Ge.splice(gA, 1);
            if (0 == Ge.length) {
                delete Jr[h7];
                tJ--
            }
            tJ || window.removeEventListener("message", FO, true)
        }
        return this
    };
    this.Oh = function(Jr) {
        GH.FV(Jr, u1, this);
        return this
    };
    this.qF = function(Jr) {
        Jr = {};
        window.removeEventListener("message", FO, true);
        return this
    };
    this.RW = function(Iy, Sr) {
        Yv.ec(mG, L5, Iy, Sr);
        return this
    };
    this.bj = function(Pt, Z0) {
        var ik = Pt.length;
        Pt.forEach(function(pB) {
            AN(pB, function HW() {
                rj(pB, HW);
                --ik || Z0.apply(void 0, arguments)
            })
        })
    }
};
var aO = aO || {};
var xN = (function() {
    var Gk, DY, E6, Q_, df, he = function() {
            Yv.F5(window.parent, "loaderror")
        },
        qr = function(Aq, Fe) {
            Fe = Fe.split(";")[0];
            return Aq === Fe || Aq === Fe.split("/").concat("/*")
        },
        yS = function(fD, h7) {
            return fD[h7] || fD[h7.replace(/\/.*$/, "/*")] || fD["*/*"]
        },
        He = function(UV) {
            var Ll = this,
                Q_ = new XMLHttpRequest();
            Q_.onreadystatechange = function() {
                if (this.readyState == 4 || this.readyState == 0) {
                    if (this.status === 200 && qr(Ll.h7, this.getResponseHeader("Content-Type"))) {
                        yS(Sx, Ll.h7).call(Ll, this.responseText);
                        delete this.onreadystatechange
                    } else {
                        delete this.onreadystatechange;
                        Ll.VH()
                    }
                }
            };
            Q_.open("GET", Ll.xV, true);
            Q_.send(null)
        },
        Xl = {
            "text/javascript": function(UV) {
                var aJ = document.createElement("SCRIPT"),
                    Ll = this;
                aJ.type = this.h7;
                document.head.appendChild(aJ);
                aJ.onload = function() {
                    delete aJ.onload;
                    Ll.eN();
                    document.head.removeChild(aJ)
                };
                aJ.onerror = Ll.VH;
                this.xV = UV + this.xV;
                aJ.src = this.xV
            },
            "application/json": He,
            "*/*": function(UV) {
                console.error("Loader: No load handler for type " + this.h7);
                this.eN()
            }
        },
        bo = {},
        Sx = {
            "application/json": function(mc) {
                this.EI = JSON.parse(mc);
                this.eN()
            }
        },
        gI = function(Pp) {
            var Ce = {},
                SQ = 0,
                Bt = 6,
                QO = function(fD, h7) {
                    var zO = h7 && h7.replace(/\/.*$/, "/*");
                    return h7 in fD ? h7 : zO in fD ? zO : "*/*"
                },
                f1 = function(Ll) {
                    if (df) {
                        return
                    }
                    var DY = Ll.DY && Ll.DY.split(",") || [];
                    ++SQ;
                    Ll.eN = function() {
                        --SQ;
                        if (!Ce[Ll.UF]) {
                            Yv.F5(window.top, "progress");
                            Yv.UY("load", Ll);
                            Ce[Ll.UF] = 1;
                            GI(Ll.h7)
                        } else {
                            console.warn("Loader: bG reloaded " + Ll.UF)
                        }
                    };
                    Ll.VH = he;
                    Ll.xV = Ll.xV.concat(dW);
                    yS(Xl, Ll.h7).call(Ll, yS(Gk.assetBaseUrlMap, Ll.h7) || "", He);
                    GI(Ll.h7)
                },
                GI = function(Jn) {
                    var Ll, r7 = bo[QO(Xl, Jn)];
                    if (Pp.length == 0 && SQ == 0) {
                        Yv.F5(window.parent, "loaded")
                    } else {
                        if (SQ == 0 || r7 && SQ < Bt && r7.indexOf(QO(Xl, Pp[0].h7)) >= 0) {
                            f1(Pp.shift())
                        }
                    }
                };
            Yv.F5(window.top, "queue", Pp.length);
            Gz.AN("start", function() {
                Gz.rj("start", GI);
                GI()
            })
        },
        bX = function() {
            Q_ && Q_.abort();
            df = true;
            Pp = []
        },
        Hn = function(Iy) {
            Gk = Iy.loader;
            dW = GH.zC(DY, Gk.assetUrlParameterWhitelist).concat("&tag=", E6);
            kJ = Gk.assetBaseUrlMap
        },
        FN = function(Iy) {
            var tag = document.getElementsByName("com.igt.game.TAG")[0];
            E6 = tag.content;
            tag.parentNode.removeChild(tag);
            DY = JSON.parse(JSON.stringify(Iy.params))
        };
    document.head = document.head || document.getElementsByTagName("head")[0];
    var Gz = new fe(window, window.location.href);
    Gz.Oh({
        manifest: gI,
        abortLoading: bX,
        loaderror: bX,
        "mproxy.config": Hn,
        "mproxy.param": FN
    });

    function C9(h7, HW, Vu) {
        Xl[h7] = HW;
        bo[h7] = Vu
    }
    return {
        C9: C9,
        kp: function(h7, HW, Vu) {
            C9(h7, He, Vu);
            Sx[h7] = HW
        }
    }
})();
(function() {
    if (!window.addEventListener) {
        return
    }
    var self = window.StyleFix = {
        link: function(link) {
            try {
                if (link.rel !== "stylesheet" || link.hasAttribute("data-noprefix")) {
                    return
                }
            } catch (e) {
                return
            }
            var url = link.href || link.getAttribute("data-href"),
                base = url.replace(/[^\/]+$/, ""),
                base_scheme = (/^[a-z]{3,10}:/.exec(base) || [""])[0],
                base_domain = (/^[a-z]{3,10}:\/\/[^\/]+/.exec(base) || [""])[0],
                base_query = /^([^?]*)\??/.exec(url)[1],
                parent = link.parentNode,
                xhr = new XMLHttpRequest(),
                process;
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    process()
                }
            };
            process = function() {
                var css = xhr.responseText;
                if (css && link.parentNode && (!xhr.status || xhr.status < 400 || xhr.status > 600)) {
                    css = self.fix(css, true, link);
                    if (base) {
                        css = css.replace(/url\(\s*?((?:"|')?)(.+?)\1\s*?\)/gi, function($0, quote, url) {
                            if (/^([a-z]{3,10}:|#)/i.test(url)) {
                                return $0
                            } else {
                                if (/^\/\//.test(url)) {
                                    return 'url("' + base_scheme + url + '")'
                                } else {
                                    if (/^\//.test(url)) {
                                        return 'url("' + base_domain + url + '")'
                                    } else {
                                        if (/^\?/.test(url)) {
                                            return 'url("' + base_query + url + '")'
                                        } else {
                                            return 'url("' + base + url + '")'
                                        }
                                    }
                                }
                            }
                        });
                        var escaped_base = base.replace(/([\\\^\$*+[\]?{}.=!:(|)])/g, "\\$1");
                        css = css.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)" + escaped_base, "gi"), "$1")
                    }
                    var style = document.createElement("style");
                    style.textContent = css;
                    style.media = link.media;
                    style.disabled = link.disabled;
                    style.setAttribute("data-href", link.getAttribute("href"));
                    parent.insertBefore(style, link);
                    parent.removeChild(link);
                    style.media = link.media
                }
            };
            try {
                xhr.open("GET", url);
                xhr.send(null)
            } catch (e) {
                if (typeof XDomainRequest != "undefined") {
                    xhr = new XDomainRequest();
                    xhr.onerror = xhr.onprogress = function() {};
                    xhr.onload = process;
                    xhr.open("GET", url);
                    xhr.send(null)
                }
            }
            link.setAttribute("data-inprogress", "")
        },
        styleElement: function(style) {
            if (style.hasAttribute("data-noprefix")) {
                return
            }
            var disabled = style.disabled;
            style.textContent = self.fix(style.textContent, true, style);
            style.disabled = disabled
        },
        styleAttribute: function(element) {
            var css = element.getAttribute("style");
            css = self.fix(css, false, element);
            element.setAttribute("style", css)
        },
        process: function() {
            $('link[rel="stylesheet"]:not([data-inprogress])').forEach(StyleFix.link);
            $("style").forEach(StyleFix.styleElement);
            $("[style]").forEach(StyleFix.styleAttribute)
        },
        register: function(fixer, index) {
            (self.fixers = self.fixers || []).splice(index === undefined ? self.fixers.length : index, 0, fixer)
        },
        fix: function(css, raw, element) {
            for (var i = 0; i < self.fixers.length; i++) {
                css = self.fixers[i](css, raw, element) || css
            }
            return css
        },
        camelCase: function(str) {
            return str.replace(/-([a-z])/g, function($0, $1) {
                return $1.toUpperCase()
            }).replace("-", "")
        },
        deCamelCase: function(str) {
            return str.replace(/[A-Z]/g, function($0) {
                return "-" + $0.toLowerCase()
            })
        }
    };
    (function() {
        setTimeout(function() {
            $('link[rel="stylesheet"]').forEach(StyleFix.link)
        }, 10);
        document.addEventListener("DOMContentLoaded", StyleFix.process, false)
    })();

    function $(expr, con) {
        return [].slice.call((con || document).querySelectorAll(expr))
    }
})();
(function(root) {
    if (!window.StyleFix || !window.getComputedStyle) {
        return
    }

    function fix(what, before, after, replacement, css) {
        what = self[what];
        if (what.length) {
            var regex = RegExp(before + "(" + what.join("|") + ")" + after, "gi");
            css = css.replace(regex, replacement)
        }
        return css
    }
    var self = window.PrefixFree = {
        prefixCSS: function(css, raw, element) {
            var prefix = self.prefix;
            if (self.functions.indexOf("linear-gradient") > -1) {
                css = css.replace(/(\s|:|,)(repeating-)?linear-gradient\(\s*(-?\d*\.?\d*)deg/ig, function($0, delim, repeating, deg) {
                    return delim + (repeating || "") + "linear-gradient(" + (90 - deg) + "deg"
                })
            }
            css = fix("functions", "(\\s|:|,)", "\\s*\\(", "$1" + prefix + "$2(", css);
            css = fix("keywords", "(\\s|:)", "(\\s|;|\\}|$)", "$1" + prefix + "$2$3", css);
            css = fix("properties", "(^|\\{|\\s|;)", "\\s*:", "$1" + prefix + "$2:", css);
            if (self.properties.length) {
                var regex = RegExp("\\b(" + self.properties.join("|") + ")(?!:)", "gi");
                css = fix("valueProperties", "\\b", ":(.+?);", function($0) {
                    return $0.replace(regex, prefix + "$1")
                }, css)
            }
            if (raw) {
                css = fix("selectors", "", "\\b", self.prefixSelector, css);
                css = fix("atrules", "@", "\\b", "@" + prefix + "$1", css)
            }
            css = css.replace(RegExp("-" + prefix, "g"), "-");
            css = css.replace(/-\*-(?=[a-z]+)/gi, self.prefix);
            return css
        },
        property: function(property) {
            return (self.properties.indexOf(property) >= 0 ? self.prefix : "") + property
        },
        value: function(value, property) {
            value = fix("functions", "(^|\\s|,)", "\\s*\\(", "$1" + self.prefix + "$2(", value);
            value = fix("keywords", "(^|\\s)", "(\\s|$)", "$1" + self.prefix + "$2$3", value);
            if (self.valueProperties.indexOf(property) >= 0) {
                value = fix("properties", "(^|\\s|,)", "($|\\s|,)", "$1" + self.prefix + "$2$3", value)
            }
            return value
        },
        prefixSelector: function(selector) {
            return selector.replace(/^:{1,2}/, function($0) {
                return $0 + self.prefix
            })
        },
        prefixProperty: function(property, camelCase) {
            var prefixed = self.prefix + property;
            return camelCase ? StyleFix.camelCase(prefixed) : prefixed
        }
    };
    (function() {
        var prefixes = {},
            properties = [],
            shorthands = {},
            style = getComputedStyle(document.documentElement, null),
            dummy = document.createElement("div").style;
        var iterate = function(property) {
                if (property.charAt(0) === "-") {
                    properties.push(property);
                    var parts = property.split("-"),
                        prefix = parts[1];
                    prefixes[prefix] = ++prefixes[prefix] || 1;
                    while (parts.length > 3) {
                        parts.pop();
                        var shorthand = parts.join("-");
                        if (supported(shorthand) && properties.indexOf(shorthand) === -1) {
                            properties.push(shorthand)
                        }
                    }
                }
            },
            supported = function(property) {
                return StyleFix.camelCase(property) in dummy
            };
        if (style.length > 0) {
            for (var i = 0; i < style.length; i++) {
                iterate(style[i])
            }
        } else {
            for (var property in style) {
                iterate(StyleFix.deCamelCase(property))
            }
        }
        var highest = {
            uses: 0
        };
        for (var prefix in prefixes) {
            var uses = prefixes[prefix];
            if (highest.uses < uses) {
                highest = {
                    prefix: prefix,
                    uses: uses
                }
            }
        }
        self.prefix = "-" + highest.prefix + "-";
        self.Prefix = StyleFix.camelCase(self.prefix);
        self.properties = [];
        for (var i = 0; i < properties.length; i++) {
            var property = properties[i];
            if (property.indexOf(self.prefix) === 0) {
                var unprefixed = property.slice(self.prefix.length);
                if (!supported(unprefixed)) {
                    self.properties.push(unprefixed)
                }
            }
        }
        if (self.Prefix == "Ms" && !("transform" in dummy) && !("MsTransform" in dummy) && ("msTransform" in dummy)) {
            self.properties.push("transform", "transform-origin")
        }
        self.properties.sort()
    })();
    (function() {
        var functions = {
            "linear-gradient": {
                property: "backgroundImage",
                params: "red, teal"
            },
            calc: {
                property: "width",
                params: "1px + 5%"
            },
            element: {
                property: "backgroundImage",
                params: "#foo"
            },
            "cross-fade": {
                property: "backgroundImage",
                params: "url(a.png), url(b.png), 50%"
            }
        };
        functions["repeating-linear-gradient"] = functions["repeating-radial-gradient"] = functions["radial-gradient"] = functions["linear-gradient"];
        var keywords = {
            initial: "color",
            "zoom-in": "cursor",
            "zoom-out": "cursor",
            box: "display",
            flexbox: "display",
            "inline-flexbox": "display",
            flex: "display",
            "inline-flex": "display",
            grid: "display",
            "inline-grid": "display",
            "min-content": "width"
        };
        self.functions = [];
        self.keywords = [];
        var style = document.createElement("div").style;

        function supported(value, property) {
            style[property] = "";
            style[property] = value;
            return !!style[property]
        }
        for (var func in functions) {
            var test = functions[func],
                property = test.property,
                value = func + "(" + test.params + ")";
            if (!supported(value, property) && supported(self.prefix + value, property)) {
                self.functions.push(func)
            }
        }
        for (var keyword in keywords) {
            var property = keywords[keyword];
            if (!supported(keyword, property) && supported(self.prefix + keyword, property)) {
                self.keywords.push(keyword)
            }
        }
    })();
    (function() {
        var selectors = {
                ":read-only": null,
                ":read-write": null,
                ":any-link": null,
                "::selection": null
            },
            atrules = {
                keyframes: "name",
                viewport: null,
                document: 'regexp(".")'
            };
        self.selectors = [];
        self.atrules = [];
        var style = root.appendChild(document.createElement("style"));

        function supported(selector) {
            style.textContent = selector + "{}";
            return !!style.sheet.cssRules.length
        }
        for (var selector in selectors) {
            var test = selector + (selectors[selector] ? "(" + selectors[selector] + ")" : "");
            if (!supported(test) && supported(self.prefixSelector(test))) {
                self.selectors.push(selector)
            }
        }
        for (var atrule in atrules) {
            var test = atrule + " " + (atrules[atrule] || "");
            if (!supported("@" + test) && supported("@" + self.prefix + test)) {
                self.atrules.push(atrule)
            }
        }
        root.removeChild(style)
    })();
    self.valueProperties = ["transition", "transition-property"];
    root.className += " " + self.prefix;
    StyleFix.register(self.prefixCSS)
})(document.documentElement);
xN.kp("text/css", function(mc) {
    var Ei = document.createElement("STYLE");
    mc = mc.replace(/plate\(([^)]+)\)/g, function(A8, UF) {
        return ["url(", aO.GZ[UF].src, ")"].join("")
    });
    mc = PrefixFree.prefixCSS(mc, 1);
    mc = mc.replace(/(^|;|{)\s*border-radius\s*:\s*([^;}]+)/gm, function(match, before, values) {
        var values = values.split(/\s+/);
        values[1] = values[1] || values[0];
        values[2] = values[2] || values[1];
        values[3] = values[3] || values[1];
        return before + ["border-top-left-radius:" + values[0], "border-top-right-radius:" + values[1], "border-bottom-right-radius:" + values[2], "border-bottom-left-radius:" + values[3]].join(";")
    });
    mc = mc.replace(/((?:(?!;base64))[{};])/gm, "$1\n");
    Ei.h7 = this.h7;
    Ei.appendChild(Ei.ownerDocument.createTextNode(mc));
    document.head.appendChild(Ei);
    this.eN()
});
BW = {};
var pj = (function() {
    var Wo = [Date.prototype.getDate, Date.prototype.getMonth, Date.prototype.getFullYear],
        Eq = "/",
        Uz = [Date.prototype.getHours, Date.prototype.getMinutes],
        Zo = ":",
        Wa = {},
        jX = {},
        W6 = function(UF) {
            var AZ, Iy = Wa,
                Ef = UF.split(".");
            while ((AZ = Ef.shift()) && (Iy = Iy[AZ])) {}
            return jX[UF] = Iy
        },
        bO = function(BN, D3) {
            var W7 = D3.length,
                qY;
            while (W7--) {
                qY = String(D3[W7].call(BN));
                D3[W7] = qY.length < 2 ? "0" + qY : qY
            }
            return D3
        };
    rO = function(UF) {
        var Iy = jX[UF] || W6(UF);
        Iy || console.warn("No message with id " + UF);
        return Iy || UF
    };
    vF = function(UF) {
        return rO(UF).substitute([].slice.call(arguments, 1))
    };
    Zg = function(BN) {
        return bO(BN, Wo.slice(0)).join(Eq)
    };
    fT = function(BN) {
        return bO(BN, Uz.slice(0)).join(Zo)
    };
    var Q8 = function(nD, cc) {
        Wa[cc] = nD
    };
    var I6 = function(nD) {
        for (var cc in nD) {
            Q8(nD[cc], cc)
        }
    };
    var j_ = function(UF, nD) {
        jX[UF] = nD
    };
    return {
        I6: I6,
        Q8: Q8,
        j_: j_,
        kD: function(UF) {
            return jX[UF] || W6(UF)
        }
    }
})();
bg = (function() {
    var QH, oO = new fe(window);
    uT = function(UF) {
        return pj.kD(UF + "." + QH) || pj.kD(UF + ".default") || pj.kD(UF) || console.warn("No message with id " + UF)
    };
    oO.AN("mproxy.param", function(Iy) {
        QH = Iy.params.countrycode;
        oO = void 0
    })
})();

function nU() {
    window.scrollTo(0, navigator.userAgent.indexOf("Android") > -1 || navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/) ? 1 : 0)
}

function fl(pB) {
    if (document.activeElement && document.activeElement.hasClass("s0")) {
        return
    }
    if (!event.target.form) {
        document.activeElement && document.activeElement.blur();
        pB.preventDefault()
    }
    pB.type == "touchstart" && nU()
}
document.body.addEventListener("touchstart", fl);
document.body.addEventListener("touchmove", fl);
document.addEventListener("touchstart", fl);
document.addEventListener("touchmove", fl);
var x8 = (function() {
    function Fo() {
        if (Mv) {
            return
        }
        var isInFullScreen = (document.fullScreenElement && document.fullScreenElement !== null) || (document.mozFullScreen || document.webkitIsFullScreen);
        var docElm = document.documentElement;
        if (!isInFullScreen) {
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen()
            } else {
                if (docElm.mozRequestFullScreen) {
                    docElm.mozRequestFullScreen()
                } else {
                    if (docElm.webkitRequestFullScreen) {
                        docElm.webkitRequestFullScreen()
                    }
                }
            }
        }
        if (lD) {
            setTimeout(l5, 500);
            lD = false;
            Mv = true
        }
    }

    function l5() {
        Co()
    }

    function Co() {
        if (document.exitFullscreen) {
            document.exitFullscreen()
        } else {
            if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen()
            } else {
                if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen()
                }
            }
        }
    }

    function LK() {
        var pB = document.createEvent("HTMLEvents");
        pB.initEvent("orientationchange", 1, 1);
        document.dispatchEvent(pB)
    }

    function wa() {
        var pB = document.createEvent("HTMLEvents");
        pB.initEvent("resize", 1, 1);
        document.dispatchEvent(pB)
    }
    var bx = navigator.userAgent.match(/\s+7_[\d_]+\s+like Mac OS X/);
    var zm = navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/);
    var AY = navigator.userAgent.match(/\s+9_[\d_]+\s+like Mac OS X/);
    var sF = navigator.userAgent.indexOf("like Mac OS X") >= 0;
    var hq = navigator.userAgent.indexOf("Android") > 0;
    var rV = 0;
    if (navigator.userAgent.indexOf("Chrome/") > -1) {
        rV = navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome/") + 7);
        rV = parseInt(rV.substring(0, rV.indexOf(".")))
    }
    var SE = hq && !rV;
    var jZ = zm || (!sF && !SE);
    var T1 = "orientationchange",
        tM = "resize",
        bU = ["S6 portrait", "HO landscape"],
        bI = NaN,
        HC = NaN,
        y3 = NaN,
        G2 = NaN,
        eg = NaN,
        k4 = null,
        eC = 1,
        hO = 0,
        BE = null,
        oO = new fe(window),
        lD = false,
        Mv = false,
        oq = function(rp, x9) {
            var eH = rp.className;
            var Oa = new RegExp("(?:^|\\s+)" + bU[0] + "(?=\\s+|$)", "gi");
            var S9 = new RegExp("(?:^|\\s+)" + bU[1] + "(?=\\s+|$)", "gi");
            var Go = new RegExp("(?:^|\\s+)" + x9 + "(?=\\s+|$)", "gi");
            x9 = " ".concat(x9);
            rp.className = eH.replace(Oa, "").replace(S9, "").replace(Go, "").concat(x9)
        },
        F8 = function() {
            return eC
        },
        Dv = function(eJ) {
            hO = eJ
        },
        VD = function() {
            if (HC != bI) {
                G2 = bU[HC == 90 ? 1 : 0];
                window.tK && tK.NR();
                oq(document.documentElement, G2)
            }
            document.body.offsetWidth;
            var pB = document.createEvent("Event");
            pB.initEvent("com.igt.events.orientationchange", false, false, null);
            pB.orientation = HC;
            window.dispatchEvent(pB);
            setTimeout(function() {
                k4 && xM()
            }, 0)
        },
        BQ = (function() {
            if (navigator.userAgent.indexOf("like Mac OS X") >= 0) {
                return function() {
                    HC = Math.abs(window.orientation);
                    VD(HC)
                }
            } else {
                if (navigator.userAgent.indexOf("Android") >= 0) {
                    return function() {
                        var e7 = screen.width,
                            hS = screen.height;
                        HC = bI;
                        if (window.hasOwnProperty("orientation")) {
                            HC = Math.abs((window.orientation) % 180)
                        } else {
                            if (eg != e7) {
                                HC = hS >= e7 ? 0 : 90
                            }
                        }
                        VD(HC);
                        eg = e7
                    }
                } else {
                    return function() {
                        var e7 = window.innerWidth;
                        HC = eg == e7 ? bI : window.innerHeight >= e7 ? 0 : 90;
                        VD(HC)
                    }
                }
            }
        })(),
        y5 = function() {
            if (navigator.userAgent.indexOf("Android") >= 0) {
                var e7 = screen.width;
                var hS = screen.height;
                HC = eg == e7 ? bI : hS >= e7 ? 0 : 90;
                VD(HC)
            } else {
                BQ()
            }
        },
        s2 = function() {
            if (navigator.userAgent.match(/Android/)) {
                var a5 = screen.width;
                var uB = screen.height;
                if (document.documentElement.offsetWidth != screen.width && screen.width != (document.documentElement.offsetWidth * window.devicePixelRatio)) {
                    HC = (a5 >= uB) ? 0 : 90
                } else {
                    HC = (uB >= a5) ? 0 : 90
                }
                VD(HC);
                bI = HC;
                y3 = G2;
                k4 && xM()
            } else {
                LK()
            }
        },
        kC = function() {
            var hS;
            if (document.querySelector("meta[name='com.igt.game.AUTOSCALE'][content='yes']")) {
                k4 = document.createElement("div");
                hS = Math.floor(document.documentElement.clientHeight / 4);
                if (bx || zm) {
                    k4.style.position = "fixed"
                } else {
                    k4.style.position = "absolute"
                }
                k4.style.bottom = -hS + "px";
                k4.style.right = "0";
                k4.style.width = "1px";
                k4.style.height = hS + "px";
                document.body.appendChild(k4)
            }
        },
        Ua = (function() {
            var I3 = document.createElement("div").style,
                QY = "transform",
                HX = "transformOrigin";
            lR = "transitionDuration";
            ["WebkitTransform", "msTransform", "MozTransform", "oTransform"].forEach(function(AZ) {
                QY = AZ in I3 ? AZ : QY
            });
            ["WebkitTransformOrigin", "msTransformOrigin", "MozTransformOrigin", "oTransformOrigin"].forEach(function(AZ) {
                HX = AZ in I3 ? AZ : HX
            });
            ["WebkitTransitionDuration", "msTransitionDuration", "MozTransitionDuration", "oTransitionDuration"].forEach(function(AZ) {
                lR = AZ in I3 ? AZ : lR
            });
            return function(JM, rK, Ur) {
                JM.style[QY] = rK;
                JM.style[HX] = "0% 0%";
                if (Ur) {
                    JM.style[lR] = "1ms"
                }
            }
        })(),
        ZY = function() {
            return ["body", "iframe"].indexOf(document.activeElement && document.activeElement.tagName) >= 0
        },
        xM = function() {
            if (ZY()) {
                return
            }
            var Ky = document.getElementById("Loader") || document.getElementById("game");
            if (!Ky) {
                return
            }
            if (Ky && k4) {
                var mR = k4.offsetLeft + k4.offsetWidth;
                var UQ = k4.offsetTop;
                if (zm || AY || jZ) {
                    mR = window.innerWidth;
                    UQ = window.innerHeight
                }
                if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && !bx && !zm && !AY) {
                    if (UQ > mR) {
                        if (UQ < 360) {
                            UQ = UQ + 60
                        }
                    } else {
                        if (UQ < 250) {
                            UQ = 268
                        }
                    }
                }
                var xi = 0,
                    f6 = 0;
                if (Ky.offsetWidth) {
                    var Ct = Ky.offsetWidth;
                    var pM = Ky.offsetHeight + Ky.offsetTop;
                    var mB = UQ / pM;
                    xi = Math.floor((mR - (Ct * mB)) / 2);
                    if (Ct * mB > mR) {
                        mB = mR / Ct;
                        xi = 0
                    }
                    var mB = (mR - 2 * xi) / Ct;
                    if (!!x8 && x8.IK) {
                        f6 = Math.floor((UQ - (pM * mB)) / 2)
                    }
                    if (hO > 0 && mB > hO) {
                        mB = hO
                    }
                    eC = mB;
                    var hz = document.getElementById("game");
                    var qU = document.getElementById("uU");
                    var rK = "translate(" + xi + "px, " + f6 + "px) scale(" + mB + ")";
                    Ua(Ky, rK, navigator.userAgent.indexOf("Android") == -1 && navigator.userAgent.indexOf("like Mac OS X") == -1);
                    hz && Ky != hz && Ua(hz, rK);
                    qU && qU.parentElement == document.body && Ua(qU, rK)
                }
            }
        },
        qS = function() {
            window.tK && tK.Ko();
            document.body.offsetWidth;
            BE = BE || document.getElementById("Tw");
            if (BE && BE.offsetHeight < document.body.clientHeight / 2) {
                setTimeout(nU, 0)
            }
            e7 = screen.width;
            bI = HC;
            y3 = G2
        },
        g_ = function() {
            if (HC != bI) {
                window.tK && tK.Ko();
                document.body.offsetWidth;
                setTimeout(nU, 0);
                e7 = screen.width
            }
            bI = HC;
            y3 = G2;
            k4 && xM()
        };
    window.hasOwnProperty("orientation") || (window.orientation = 0);
    window.addEventListener(T1, BQ, true);
    window.addEventListener(tM, y5, true);
    oO.AN("initialised", s2);
    window.addEventListener(T1, g_, false);
    window.addEventListener(tM, qS, false);
    if (document.querySelector("meta[name='com.igt.game.RESIZEKICKER'][content='yes']")) {
        window.setInterval(wa, 500)
    }
    if (navigator.userAgent.indexOf("SAMSUNG") != -1) {
        lD = true
    }
    document.addEventListener("touchstart", Fo);
    document.body.addEventListener("touchstart", Fo);
    kC();
    s2();
    return {
        F8: F8,
        Dv: Dv,
        LK: LK,
        wa: wa
    }
})();
(function() {
    var iB = 1,
        Rh = 0,
        Gz = new fe(),
        UF = function(UF) {
            return document.getElementById(UF)
        };
    Gz.AN("progress", function() {
        var bE = UF("TF"),
            dd = UF("AJ"),
            vZ = Math.max(0, Math.min(100, Math.round(100 * ++Rh / iB))) + "%";
        bE && (bE.style.width = vZ);
        dd && (dd.innerHTML = vZ);
        if (Rh >= iB) {
            Yv.UY("initialise")
        }
    });
    Gz.AN("loaderror", function(Iy) {
        var v4 = UF("Bg");
        v4.firstChild || v4.appendChild(document.createTextNode(rO("mproxy.Error.loadFailed")));
        v4.parentNode.style.visibility = "visible"
    });
    Gz.AN("splashMessage", function(Iy) {
        var iD = UF("zK");
        iD.firstChild.insertData(0, Iy + "\n")
    });
    Gz.AN("initialised", function() {
        var m7 = UF("Loader"),
            Uk = UF("Fk"),
            Ay = UF("game");
        m7 && document.body.removeChild(m7);
        Uk && document.body.removeChild(Uk);
        document.body.className = document.body.className.replace("Pl", "");
        document.body.offsetWidth;
        delete Gz;
        Yv.UY("visible")
    });
    Gz.AN("queue", function(Sr) {
        nU();
        iB += Sr
    })
})();
var M8 = function(nm) {
    var bM, A7 = function() {
            try {
                window.localStorage && localStorage.setItem(nm, JSON.stringify(bM))
            } catch (e) {}
        },
        iE = function() {
            bM = JSON.parse(window.localStorage && localStorage[nm] || "{}")
        };
    iE();
    return {
        L8: function(r4) {
            bM = $merge(bM, r4);
            A7();
            return this
        },
        tp: function() {
            return $merge(bM)
        },
        q6: function(r4) {
            bM = $merge(r4, bM);
            A7();
            return this
        }
    }
};
(function() {
    var o_, I0, bP, Oq, Ay, oO = new fe(window),
        UF = function(UF) {
            return document.getElementById(UF)
        },
        Vt = function(Iy) {
            var Ti = document.createElement("title"),
                iD = UF("zK");
            pj.I6(Iy.EI);
            Ti.appendChild(document.createTextNode(uT("title")));
            document.head.appendChild(Ti);
            var m = I0.loader.splashMessage || "";
            if (m) {
                m = m[bP.params.countrycode.toLowerCase()] || m["default"] || "";
                m = m[bP.params.language.toLowerCase()] || m["default"] || ""
            }
            iD.firstChild.insertData(0, uT("splashScreen.footer") + (m && "\n") + m)
        },
        XH = function(Iy) {
            SJ(I0, bP, Oq, oO)
        },
        D1 = {
            Qr: Vt,
            Ay: XH
        },
        eh = function(Iy) {
            D1[Iy.UF] && D1[Iy.UF](Iy)
        },
        Hn = function(Iy) {
            I0 = Object.freeze(Iy)
        },
        FN = function(Iy) {
            bP = Object.freeze(Iy)
        },
        KJ = function(Iy) {
            Oq = Object.freeze(Iy)
        },
        Ke = function(Iy) {
            if (Iy) {
                GH.bJ(Iy);
                pj.Q8(Iy, "mproxy")
            } else {
                Yv.F5(window.parent, "loaderror")
            }
        };
    oO.Oh({
        load: eh,
        "mproxy.param": FN,
        "mproxy.config": Hn,
        "mproxy.clientConfig": KJ,
        "mproxy.message": Ke
    })
})();
(function() {
    var oO = new fe(window),
        MM = {};
    aO.gz = function(DY) {
        function h5(Ba, U3) {
            var Ew = document.createElement("input");
            Ew.type = "hidden";
            Ew.name = U3;
            Ew.value = Ba;
            UO.appendChild(Ew)
        }
        var UO = document.createElement("form"),
            DY = DY || {};
        DY.playMode = DY.playMode || MM.PARAM.params.playMode || "real";
        UO.method = MM.PARAM.method;
        UO.style.display = "none";
        MM.PARAM[MM.PARAM.method].forEach(function(ZX) {
            var Ba = DY.hasOwnProperty(ZX) ? DY[ZX] : MM.PARAM.params[ZX];
            h5(Ba, ZX);
            delete DY[ZX]
        });
        if (MM.PARAM.method == "post") {
            UO.action = "?" + MM.PARAM.get.map(function(ZX) {
                var value = encodeURIComponent(ZX) + "=" + encodeURIComponent(DY.hasOwnProperty(ZX) ? DY[ZX] : MM.PARAM.params[ZX]);
                delete DY[ZX];
                return value
            }).join("&")
        }
        GH.FV(DY, h5);
        UO.submit()
    };
    oO.AN("boot", function() {
        ["PARAM", "MESSAGE", "CONFIG", "CLIENTCONFIG"].forEach(function(U3) {
            var JM = document.getElementsByName("com.igt.mproxy." + U3)[0];
            if (JM && JM.content) {
                try {
                    MM[U3] = JSON.parse(JM.content)
                } catch (e) {
                    console.error("Failed to parse injected data from " + U3);
                    Yv.F5(window.parent, "loaderror")
                }
            } else {
                MM[U3] = {}
            }
            JM.parentNode.removeChild(JM)
        });
        MM.PARAM.method = MM.PARAM.method.toLowerCase();
        Yv.UY("mproxy.param", MM.PARAM);
        Yv.UY("mproxy.config", MM.CONFIG);
        Yv.UY("mproxy.message", MM.MESSAGE);
        Yv.UY("mproxy.clientConfig", MM.CLIENTCONFIG);
        Yv.UY("manifest", [{
            h7: "application/json",
            UF: "Qr",
            xV: "assets/strings.json"
        }, {
            h7: "text/javascript",
            UF: "yT",
            xV: "../MXF/MXF.js"
        }, {
            h7: "text/javascript",
            UF: "Ay",
            xV: "main.js"
        }, ].concat([{
            "UF": "eB",
            "h7": "image/png",
            "xV": "assets/reelsFrame.png",
            "xj": {
                "eB": [0, 0, 866, 470, 1, 1, 2]
            }
        }, {
            "UF": "HL",
            "h7": "image/png",
            "xV": "assets/reelsFrameFreeSpins.png",
            "xj": {
                "oU": [0, 0, 866, 470, 1, 1, 2]
            }
        }, {
            "UF": "Zv",
            "h7": "image/png",
            "xV": "assets/arrow.png",
            "xj": {
                "mA": [0, 0, 104, 104, 1, 1, 2],
                "Kd": [0, 108, 104, 104, 1, 1, 2],
                "iK": [0, 216, 104, 104, 1, 1, 2],
                "sJ": [0, 324, 52, 56, 1, 1, 2]
            }
        }, {
            "UF": "KI",
            "h7": "image/png",
            "xV": "assets/skipButton.png",
            "xj": {
                "KI": [0, 0, 140, 140, 1, 1, 2]
            }
        }, {
            "UF": "vS",
            "h7": "image/png",
            "xV": "assets/networkActivity.png",
            "xj": {
                "vS": [0, 0, 1170, 130, 1, 1, 2]
            }
        }, {
            "UF": "W_",
            "h7": "image/png",
            "xV": "assets/button.png",
            "xj": {
                "W_": [0, 0, 140, 140, 1, 1, 2]
            }
        }, {
            "UF": "eZ",
            "h7": "image/png",
            "xV": "assets/backgroundBaseGame.png",
            "xj": {
                "ZQ": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "Bw",
            "h7": "image/png",
            "xV": "assets/backgroundTransition.png",
            "xj": {
                "Bw": [0, 0, 8, 8, 1, 1, 2]
            }
        }, {
            "UF": "aG",
            "h7": "image/png",
            "xV": "assets/backgroundFreeSpin.png",
            "xj": {
                "ws": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "QL",
            "h7": "image/png",
            "xV": "assets/logo.png",
            "xj": {
                "QL": [0, 0, 288, 48, 1, 1, 2]
            }
        }, {
            "UF": "zj",
            "h7": "image/png",
            "xV": "assets/B01.png",
            "xj": {
                "zj": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "Ck",
            "h7": "image/png",
            "xV": "assets/S01.png",
            "xj": {
                "Ck": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "RC",
            "h7": "image/png",
            "xV": "assets/S02.png",
            "xj": {
                "RC": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "xX",
            "h7": "image/png",
            "xV": "assets/S03.png",
            "xj": {
                "xX": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "qT",
            "h7": "image/png",
            "xV": "assets/S04.png",
            "xj": {
                "qT": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "jI",
            "h7": "image/png",
            "xV": "assets/S05.png",
            "xj": {
                "jI": [0, 0, 152, 148, 1, 1, 2]
            }
        }, {
            "UF": "D2",
            "h7": "image/png",
            "xV": "assets/S06.png",
            "xj": {
                "D2": [0, 0, 152, 148, 1, 1, 2]
            }
        }, {
            "UF": "KK",
            "h7": "image/png",
            "xV": "assets/S07.png",
            "xj": {
                "KK": [0, 0, 152, 148, 1, 1, 2]
            }
        }, {
            "UF": "yI",
            "h7": "image/png",
            "xV": "assets/S08.png",
            "xj": {
                "yI": [0, 0, 152, 148, 1, 1, 2]
            }
        }, {
            "UF": "E2",
            "h7": "image/png",
            "xV": "assets/S09.png",
            "xj": {
                "E2": [0, 0, 152, 148, 1, 1, 2]
            }
        }, {
            "UF": "bQ",
            "h7": "image/png",
            "xV": "assets/S10.png",
            "xj": {
                "bQ": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "CR",
            "h7": "image/png",
            "xV": "assets/S11.png",
            "xj": {
                "CR": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "ij",
            "h7": "image/png",
            "xV": "assets/S12.png",
            "xj": {
                "ij": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "vl",
            "h7": "image/png",
            "xV": "assets/S13.png",
            "xj": {
                "vl": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "Ey",
            "h7": "image/png",
            "xV": "assets/S14.png",
            "xj": {
                "Ey": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "Jc",
            "h7": "image/png",
            "xV": "assets/W01.png",
            "xj": {
                "Jc": [0, 0, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "YJ",
            "h7": "image/png",
            "xV": "assets/W02.png",
            "xj": {
                "YJ": [0, 0, 1520, 148, 10, 1, 2],
                "LT": [0, 152, 1520, 148, 10, 1, 2]
            }
        }, {
            "UF": "ah",
            "h7": "image/png",
            "xV": "assets/meters.png",
            "xj": {
                "zs": [0, 0, 228, 70, 1, 1, 2],
                "o2": [0, 74, 228, 70, 1, 1, 2],
                "nK": [0, 148, 228, 70, 1, 1, 2]
            }
        }, {
            "UF": "Sj",
            "h7": "image/png",
            "xV": "assets/bigDiamond.png",
            "xj": {
                "g1": [0, 0, 208, 158, 1, 1, 2]
            }
        }, {
            "UF": "oz",
            "h7": "image/png",
            "xV": "assets/patternSlider.png",
            "xj": {
                "Zu": [0, 0, 146, 146, 1, 1, 2],
                "Lm": [0, 150, 146, 146, 1, 1, 2],
                "Hs": [0, 300, 146, 146, 1, 1, 2],
                "XI": [0, 450, 146, 146, 1, 1, 2],
                "X6": [0, 600, 146, 146, 1, 1, 2],
                "pY": [0, 750, 146, 146, 1, 1, 2],
                "Fr": [0, 900, 146, 146, 1, 1, 2],
                "wj": [0, 1050, 90, 128, 1, 1, 2]
            }
        }, {
            "UF": "Mc",
            "h7": "image/png",
            "xV": "assets/statusBar.png",
            "xj": {
                "Mc": [0, 0, 938, 52, 1, 1, 2]
            }
        }, {
            "UF": "OJ",
            "h7": "image/png",
            "xV": "assets/speechBubbleArrow.png",
            "xj": {
                "OJ": [0, 0, 64, 64, 1, 1, 2]
            }
        }, {
            "UF": "Ai",
            "h7": "image/png",
            "xV": "assets/transitionImage1.png",
            "xj": {
                "Tk": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "nh",
            "h7": "image/png",
            "xV": "assets/transitionImage2.png",
            "xj": {
                "Bb": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "kH",
            "h7": "image/png",
            "xV": "assets/transitionImage3.png",
            "xj": {
                "NX": [0, 0, 364, 356, 1, 1, 2]
            }
        }, {
            "UF": "CG",
            "h7": "image/png",
            "xV": "assets/transitionImage4.png",
            "xj": {
                "cW": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "sR",
            "h7": "image/png",
            "xV": "assets/transitionImage5.png",
            "xj": {
                "uq": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "JD",
            "h7": "image/png",
            "xV": "assets/transitionImage6.png",
            "xj": {
                "WY": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "VK",
            "h7": "image/png",
            "xV": "assets/transitionImage7.png",
            "xj": {
                "V0": [0, 0, 960, 600, 1, 1, 2]
            }
        }, {
            "UF": "F2",
            "h7": "image/png",
            "xV": "assets/bonusPlusOne.png",
            "xj": {
                "dK": [0, 0, 284, 262, 1, 1, 2]
            }
        }, {
            "UF": "F4",
            "h7": "image/png",
            "xV": "assets/rotateMessage.png",
            "xj": {
                "ba": [0, 0, 122, 218, 1, 1, 2],
                "jp": [0, 222, 218, 122, 1, 1, 2]
            }
        }, {
            "UF": "t5",
            "h7": "image/png",
            "xV": "assets/winLineIndicators.png",
            "xj": {
                "vJ": [0, 0, 60, 46, 1, 1, 2],
                "Gg": [0, 50, 60, 46, 1, 1, 2],
                "OA": [0, 100, 60, 46, 1, 1, 2],
                "D4": [0, 150, 60, 46, 1, 1, 2],
                "Dm": [0, 200, 60, 46, 1, 1, 2],
                "dJ": [0, 250, 60, 46, 1, 1, 2],
                "g9": [0, 300, 60, 46, 1, 1, 2],
                "fI": [0, 350, 60, 46, 1, 1, 2],
                "hY": [0, 400, 60, 46, 1, 1, 2]
            }
        }], [{
            h7: "text/css",
            UF: "lg",
            xV: "main.css"
        }], [{
            "BT": "0",
            "UF": "DM",
            "h7": "audio/*",
            "xV": "assets/audio",
            "Sq": "audio/mp4,audio/ogg,audio/mpeg",
            "Sa": {
                "i_": [1, 2.972245],
                "BL": [4.972245, 2.321814],
                "v3": [8.294059, 90.000000],
                "WR": [99.294059, 8.198367],
                "jy": [108.49242600000001, 60.000000],
                "Dx": [169.49242600000002, 1.046259],
                "vT": [171.53868500000002, 1.519093],
                "Iz": [174.057778, 0.512744],
                "U0": [175.570522, 1.215964],
                "Ml": [177.78648600000002, 3.407075],
                "qH": [182.19356100000002, 3.535238],
                "rx": [186.728799, 4.954286],
                "Tk": [192.683085, 5.015873],
                "Bb": [198.698958, 4.736780],
                "cW": [204.43573800000001, 10.533152],
                "vC": [215.96889000000002, 4.760091],
                "uq": [221.728981, 2.896599],
                "WY": [225.62558, 0.378776],
                "V0": [227.004356, 5.201179],
                "TH": [233.205535, 1.088345]
            },
            "Nw": {
                "i_": "GameStart11",
                "BL": "diamondrun11",
                "v3": "BaseGameMusic11",
                "WR": "BigWin11",
                "jy": "BonusMusic11",
                "Dx": "cat11",
                "vT": "DiamondRing11",
                "Iz": "dog11",
                "U0": "Grapes11",
                "Ml": "logo11",
                "qH": "moneyclip11",
                "rx": "Scatter11",
                "Tk": "comic111",
                "Bb": "comic211",
                "cW": "comic311",
                "vC": "bonusgame4",
                "uq": "comic411",
                "WY": "comic511",
                "V0": "comic611",
                "TH": "excellentwin211"
            }
        }]));
        document.getElementById("xJ").addEventListener("ontouchstart" in window ? "touchstart" : "mousedown", function() {
            aO.gz()
        });
        Yv.UY("start")
    })
})();
document.addEventListener("DOMContentLoaded", function() {
    var boot = function() {
        Yv.UY("boot")
    };
    eval("boot();")
}, false);
(function() {
    var Gz = new fe(),
        UF = function(UF) {
            return document.getElementById(UF)
        };
    Gz.AN("load", function(Iy) {
        if (Iy.UF == "Qr") {
            var FM = UF("MO");
            if (FM) {
                FM.appendChild(document.createTextNode(Iy.EI.splashScreen.caption));
                FM.parentElement.style.opacity = 1
            }
            Gz = null
        }
    })
})();
</script>
<div>

</div>
</body>
</html>

