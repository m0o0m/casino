<?
    session_start();

    $_SESSION['start_game'] = 'wolf_run_mobile';
    $_SESSION['start_publisher'] = 'igtMobile';
    
    //require_once('../game.php');
?>

<!DOCTYPE html>


<html>
<head>
<!-- meta-viewport.4-v1.html for autoscaling V3 (and V1 if needed) games -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="com.igt.game.AUTOSCALE" content="yes" />

<script>
//Uncomment to disable webapp-capable in ios8 (also remove the apple-mobile-web-app-capable metatag near the top of this file)
/* if (navigator.userAgent.match(/\s+[8]_[\d_]+\s+like Mac OS X/)) {
        document.write('<meta name=\"apple-mobile-web-app-capable\" content=\"no\" \/>')
} else {
        document.write('<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" \/>')
}
*/

if (navigator.userAgent.match(/\s+[789]_[\d_]+\s+like Mac OS X/)) {
    document.write('<meta name=\"com.igt.game.AUTOSCALE\" content=\"yes\" \/>');
    document.write('<meta name=\"com.igt.game.RESIZEKICKER\" content=\"yes\" \/>');
}

if (navigator.userAgent.match(/\s+[9]_[\d_]+\s+like Mac OS X/) && !navigator.userAgent.match(/\sCriOS\//)) {
    document.write('<meta name=\"com.igt.game.IOS9FIX\" content=\"yes\" \/>');
}

(function()
{
	//double the size on the iPad
	var scale = navigator.userAgent.indexOf('iPad;') >=0 ? 2: 1;

    /**
     * UA Check for iOS 7.1, which introduces minimal-ui. From the release notes:
     * A property, minimal-ui, has been added for the viewport meta tag key that allows minimizing the top and bottom bars on the iPhone as the page loads. While on a page usingminimal-ui, tapping the top bar brings the bars back. Tapping back in the content dismisses them again.
     * For example, use <meta name="viewport" content="width=1024, minimal-ui”>.
     */
    if (navigator.userAgent.match(/\s+[789]_[\d_]+\s+like Mac OS X/)
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
	width:100vw;
	height:100vh;
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
	position: absolute;
	left:0;
	top: 30px; /* allow space for operator console */
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
	<meta generator="" name="com.igt.mproxy.PARAM" content="{&quot;post&quot;:[],&quot;get&quot;:[&quot;nscode&quot;,&quot;softwareid&quot;,&quot;countrycode&quot;,&quot;denomamount&quot;,&quot;language&quot;,&quot;skincode&quot;,&quot;currencycode&quot;,&quot;minbet&quot;],&quot;method&quot;:&quot;GET&quot;,&quot;params&quot;:{&quot;nscode&quot;:&quot;MRGR&quot;,&quot;softwareid&quot;:&quot;200-1196-001&quot;,&quot;countrycode&quot;:&quot;&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;denomamount&quot;:&quot;1.0&quot;,&quot;language&quot;:&quot;en&quot;,&quot;skincode&quot;:&quot;MRGR&quot;,&quot;currencycode&quot;:&quot;FPY&quot;,&quot;minbet&quot;:&quot;1.0&quot;}}"/>
	<meta name="com.igt.mproxy.MESSAGE" content="{&quot;CancelSubmitMobileNumber.message&quot;:&quot;Gaming regulations only allow this game to be played in valid jurisdictions.\nYour location must be verified in order to play this game.&quot;,&quot;CancelSubmitMobileNumber.title&quot;:&quot;Location Check Cancelled&quot;,&quot;SubmitMobileNumber.labelRegionCode&quot;:&quot;Select your region&quot;,&quot;Buttons.Cancel&quot;:&quot;Cancel&quot;,&quot;SubmitMobileNumber.title&quot;:&quot;Location Check&quot;,&quot;PromotionalFreeSpin.consoleBalance&quot;:&quot;Free Spins&quot;,&quot;SubmitMobileNumber.message&quot;:&quot;Please enter device phone number to verify you are in a legal jurisdiction.&quot;,&quot;Buttons.Close&quot;:&quot;Close&quot;,&quot;Error.networkOffLine&quot;:&quot;There is no network connection. Please try again when you are connected.&quot;,&quot;Error.payloadError&quot;:&quot;A system error has occurred.&quot;,&quot;SubmitMobileNumber.buttonCancel&quot;:&quot;Cancel&quot;,&quot;Error.connectionLost&quot;:&quot;Data not received.&quot;,&quot;SubmitMobileNumber.labelDeviceNumber&quot;:&quot;Mobile Number&quot;,&quot;SubmitMobileNumber.buttonValidate&quot;:&quot;OK&quot;,&quot;Buttons.OK&quot;:&quot;OK&quot;,&quot;Error.loadFailed&quot;:&quot;Connection lost! Click here to reload&quot;,&quot;Error.RGSid&quot;:&quot;Error ID:&quot;,&quot;Buttons.Retry&quot;:&quot;Retry&quot;,&quot;Error.networkError&quot;:&quot;A system error has occurred.&quot;}"/>
	<meta name="com.igt.mproxy.CONFIG" content="{&quot;RGS&quot;:{&quot;proxyUrl&quot;:&quot;../mobile/game&quot;,&quot;requestTimeout&quot;:15000,&quot;requestRetries&quot;:0},&quot;geoLocation&quot;:{&quot;enableHighAccuracy&quot;:true,&quot;maximumAge&quot;:300000,&quot;timeout&quot;:600000},&quot;console&quot;:{&quot;url&quot;:&quot;skin.html&quot;,&quot;urlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;countrycode&quot;,&quot;currencycode&quot;,&quot;nscode&quot;,&quot;skincode&quot;,&quot;uniqueid&quot;,&quot;presenttype&quot;,&quot;channel&quot;],&quot;lobbyURL&quot;:&quot;https://m.mrgreen.com&quot;},&quot;loader&quot;:{&quot;assetBaseUrlMap&quot;:{&quot;audio/*&quot;:&quot;&quot;},&quot;assetUrlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;currencycode&quot;,&quot;countrycode&quot;,&quot;presenttype&quot;,&quot;channel&quot;]}}"/>
	<meta name="com.igt.mproxy.CLIENTCONFIG" content="{&quot;ScreenInchesDiagonal&quot;:&quot;Unknown&quot;,&quot;ScreenInchesHeight&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsHeight&quot;:&quot;0&quot;,&quot;gameType&quot;:&quot;S&quot;,&quot;Popularity&quot;:&quot;12017561243&quot;,&quot;PlatformVersion&quot;:&quot;Unknown&quot;,&quot;gleVersion&quot;:&quot;1.1&quot;,&quot;ScreenInchesWidth&quot;:&quot;Unknown&quot;,&quot;HardwareVendor&quot;:&quot;Unknown&quot;,&quot;HardwareModel&quot;:&quot;Unknown&quot;,&quot;IsCrawler&quot;:&quot;N&quot;,&quot;HardwareFamily&quot;:&quot;Emulator&quot;,&quot;PlatformVendor&quot;:&quot;Linux&quot;,&quot;HardwareName&quot;:&quot;Desktop&quot;,&quot;BrowserVendor&quot;:&quot;Google&quot;,&quot;OEM&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsWidth&quot;:&quot;0&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;BrowserName&quot;:&quot;Chrome&quot;,&quot;PlatformName&quot;:&quot;Unknown&quot;,&quot;BrowserVersion&quot;:&quot;38&quot;}"/>
	<meta name="com.igt.game.TAG" content="79cf0b4c7e1193e93d8ddf36ffba1357"/>
	<meta name="com.igt.game.version" content="1.9"/>

	<style type="text/css" charset="utf-8">
.Lu{z-index:9999;text-align:left;margin:0 auto;visibility:hidden;display:inline-block}.FY{position:absolute;top:0;left:0;height:100%;width:100%;z-index:9999;text-align:center;visibility:hidden}.eh{display:box;box-align:center;box-pack:center;height:inherit;width:inherit}.FY .Lu{position:relative;visibility:inherit}.Lu .cS{visibility:inherit;display:box;box-pack:center}.Tn{position:relative;font-size:.75em}.Tn>*{text-align:start;margin:5px}.Tn>p{margin-bottom:.7em}.Tn>p.jv{font-size:.9em}.Tn>h1{margin:10px 5px 5px;font-size:1.167em;text-align:center}.Tn>h2{font-size:1.167em;text-align:center}.Tn>ul,.Tn>ol,.Tn>dl{list-style-position:inside;margin-bottom:.7em}*{margin:0;padding:0;border:0;z-index:0;user-select:none;tap-highlight-color:rgba(0,0,0,0);touch-callout:none}input{user-select:text}body{font-family:arial,helvetica,sans-serif;font-size:100%;text-size-adjust:none;margin:0 auto;position:relative;overflow:visible}.Fz{overflow:hidden}.Fz #V6,.Fz #game{visibility:hidden}#V6{position:absolute;top:0;height:35px;width:inherit;overflow:hidden;z-index:1}#V6>iframe{visibility:inherit;width:inherit;height:100%}#dY{visibility:hidden;position:relative;margin-top:20px}#l4{white-space:pre-line;font-size:.625em}.LU #l4{min-height:5.3em}.Oj #l4{min-height:4.0em}.w0,.Um{min-height:32px;min-width:70px}.iT{max-width:16.563em;min-width:12.500em}.Oj .iT{max-width:18.438em}.iT .cS{margin:.313em 0}.iT .C6{margin:0 .375em .25em .375em;font-weight:bold;color:#fff;border:.063em solid #EEE;background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#4b4b4b),color-stop(50%,#131313),color-stop(100%,#010101));background:-webkit-linear-gradient(top,#4b4b4b 0,#131313 50%,#010101 100%);background:linear-gradient(to bottom,#4b4b4b 0,#131313 50%,#010101 100%);border-top-left-radius:.313em;border-top-right-radius:.313em;border-bottom-left-radius:.313em;border-bottom-right-radius:.313em}.iT .C6.rc{color:#999}.iT .C6.Y0{background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#919191),color-stop(48%,#7f7f7f),color-stop(50%,#666),color-stop(100%,#6c6c6c));background:-webkit-linear-gradient(top,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%);background:linear-gradient(to bottom,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%)}.iT .C6>.pR{min-width:2.375em;padding:.5em .875em}.iT .Tn{margin:.667em 1em;font-size:.938em;white-space:pre-line;text-align:center}.iT .Tn>p{margin-bottom:1.2em}.iT .Tn address{font-style:normal;text-align:center;white-space:pre-line;margin-top:.267em}.hK{border:.125em solid #EEE;border-top-left-radius:.938em;border-top-right-radius:.938em;border-bottom-right-radius:.938em;border-bottom-left-radius:.938em;background-clip:border;background-color:#000}.hK .Fj{display:block;position:absolute;background:transparent;top:-1.5em;right:-1.5em;border:0;margin:0;padding:0}.hK .Fj>.pR{display:block;background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNTZweCIgaGVpZ2h0PSI1NnB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDU2IDU2IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnIG9wYWNpdHk9IjAuNSI+DQoJPGNpcmNsZSBjeD0iMjgiIGN5PSIzMCIgcj0iMjQiLz4NCjwvZz4NCjxnPg0KCTxjaXJjbGUgZmlsbD0iI0ZGRkZGRiIgY3g9IjI4IiBjeT0iMjgiIHI9IjI0Ii8+DQo8L2c+DQo8bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzFfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjI4LjAwMDUiIHkxPSI0OCIgeDI9IjI4LjAwMDUiIHkyPSI4LjAwMSI+DQoJPHN0b3AgIG9mZnNldD0iMCIgc3R5bGU9InN0b3AtY29sb3I6I0E0MDAxNyIvPg0KCTxzdG9wICBvZmZzZXQ9IjAuNDkiIHN0eWxlPSJzdG9wLWNvbG9yOiNBQjEzMjkiLz4NCgk8c3RvcCAgb2Zmc2V0PSIwLjUxIiBzdHlsZT0ic3RvcC1jb2xvcjojQkQ0NDU1Ii8+DQoJPHN0b3AgIG9mZnNldD0iMSIgc3R5bGU9InN0b3AtY29sb3I6I0Q3OEY5OSIvPg0KPC9saW5lYXJHcmFkaWVudD4NCjxjaXJjbGUgZmlsbD0idXJsKCNTVkdJRF8xXykiIGN4PSIyOCIgY3k9IjI4IiByPSIyMCIvPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIxLjYzNiwzNy4xOTNjLTAuNzgsMC43OC0yLjA0NywwLjc4LTIuODI4LDBsMCwwYy0wLjc4MS0wLjc4MS0wLjc4MS0yLjA0OCwwLTIuODI5bDE1LjU1Ny0xNS41NTYNCgljMC43OC0wLjc4MSwyLjA0Ny0wLjc4MSwyLjgyOCwwbDAsMGMwLjc4MSwwLjc4MSwwLjc4MSwyLjA0NywwLDIuODI5TDIxLjYzNiwzNy4xOTN6Ii8+DQo8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTguODA4LDIxLjYzNmMtMC43OC0wLjc4LTAuNzgtMi4wNDcsMC0yLjgyOGwwLDBjMC43OC0wLjc4MSwyLjA0OC0wLjc4MSwyLjgyOSwwbDE1LjU1NiwxNS41NTcNCgljMC43OCwwLjc3OSwwLjc4LDIuMDQ3LDAsMi44MjhsMCwwYy0wLjc4MSwwLjc4MS0yLjA0OCwwLjc4MS0yLjgyOSwwTDE4LjgwOCwyMS42MzZ6Ii8+DQo8L3N2Zz4NCg==);background-position:center;background-size:62%;background-repeat:no-repeat;width:3em;height:3em;padding:0}.hK .C6.Fj>.pR{padding:0}.Fj.Y0,.Fj.rc{background:none!important}#vZ .ky{text-align:left}#vZ .qE{text-align:right;font-size:.75em;margin:0 .833em .417em}#Cy .Tn>p{text-align:center}#Cy .Tn>form{margin:.4em .8em 1.2em;display:box;box-orient:vertical}#Cy .Tn label{display:box;margin:.6em 0}#Cy .Tn input[type=text],#Cy .Tn input[type=tel]{text-indent:.4em;font:inherit;margin:.1em;font-size:1.2em;line-height:1.8em}#Cy .Tn input[type=text],#Cy .Tn input[type=tel],#Cy .Tn select{margin:.1em;font:inherit;font-size:1.2em;height:1.8em}body,#Ob,#game{color:#fff;background-color:#090909;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAiCAIAAAC8zjzvAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAo1JREFUeNrsldly2zAMRQGCpETKkh05nizTvvT/P6vTZjoTL7G1U2ApO/akbpvEejZe5IWHICHgXjTGwD6893AMqzDRuKx8zx4R4d24FCSl1OGTlniXqqYPqyGfTe7v57pvipbZf5D1UvA1ZTjpLLWPM22JAXB+k2orI+oSKcqOw16n25ztMgIUh0f4lhgtpgs22WMmbCTAl2S6ZKZyqwIjBXy7jaymt2UcBx5TIpCOeg9CoFcxN7UXs7rRZR3qBkbhYhpn8/xhqsLKt1lHgOLwCC870KHK8SSlbN6jbIsd1d74/qVy1sSL+4XXFgWlEb3tmhFgqDvG0ncMy+WLibVyJbl6U7pf2y6moSN2rX/IU4riqqx6EEbBthnI0aCcTe3djWHnNuvt0/cnKbxzrnRI4DvEznHYLp1OmqLEZmeId+FufniHo0HZeaI0l57nJlHL1Y9l1TJ+yXCaJSTIs2t7X29Wbd1a0dXOryqGfe+NBklKyhJVVzXFVgdZaJuZlfndguwEtfDRjLtW1i8R8aqGH5uu52O7ez8OJEThmSUwFmvZ7paFs4mN0ilADbwJ/4o4odhIQg3uueT9XAzhgsCMAgcpKOsupCXgpy1HEvM8Q6nQ/URwwBX3PaJGKkJL9A7LUL7jUI8D5QF+3rXPQboIvz6mqCgs8d1wqt4JrmpDpQPZdlA5PlOvEaA8TvSQ33nYFsWkd0Cx20EEQgkPBIWDddWuK984PhO8ESCenOQw3QLw9iaZaEbXBaV2oetcmCd+31IuAv9IeeI1DbKyL8Y/pPydxJ8B5d8/hXVBU/yr9Xwq2UWgeHvGUxgJiyQINZz5xv8udxF4teirRV8t+mrRV4u+WvTVoj8GfwswACqX1W3QT5FOAAAAAElFTkSuQmCC)}.portrait #game{background-position:0 -30px;background-size:320px 416px}.landscape #game{background-position:0 -30px;background-size:480px 268px}#KP{background-color:#464646}#rr{background-color:#ff8d1f}.w0:after{content:spriteImage(U6)}.Um:after{content:url(data:image/png;base64,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)}.portrait #Loader .Tb{margin:50px auto 0}.landscape #Loader .Tb{margin:6px auto 0;padding:6px 0 0 0}#Tz{background:-webkit-gradient(linear,left top,left bottom,from(#00033a),color-stop(0.66,#000564),color-stop(0.67,#090909),to(#090909));position:absolute;width:inherit;height:inherit}#nw{background-image:url(data:image/png;base64,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);background-repeat:no-repeat;background-position:center 55px;position:absolute;width:inherit;height:inherit}.portrait #nw{background-position:center 150px}#OA{font-size:16px;font-weight:bold;margin:0 10% 0 10%;color:#ff4242;text-shadow:#000 0 1px,#000 1px 0,#000 0 0 2px,#000 0 0 2px,#000 0 0 2px,#000 0 0 2px}#OA em{font-style:normal;font-size:82%;position:relative;top:-2px}.portrait #OA{margin:0 5% 0 5%}
	</style>
</head>
<body class="Fz">
	<div id="mn" class="FY">
		<div class="eh">
			<div id="dY" class="hK iT Lu">
				<div id="Hz" class="Tn"></div>
				<div id="JO" class="Fj">
					<div class="pR"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="Loader" style="z-index:1;overflow:hidden;text-align:center;">
		<div style="position:absolute;width:inherit;height:inherit;text-align:center">
			<div id='Tz'>
	<div id='nw'>
		<img class="Tb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPkAAAA2CAYAAAAF8T/xAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkJDNzk3NjhGNTNEMjExRTE5RDQ4RjgzMDYwNjk0QkMxIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkJDNzk3NjkwNTNEMjExRTE5RDQ4RjgzMDYwNjk0QkMxIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QkM3OTc2OEQ1M0QyMTFFMTlENDhGODMwNjA2OTRCQzEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QkM3OTc2OEU1M0QyMTFFMTlENDhGODMwNjA2OTRCQzEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7o6Qg9AABeoUlEQVR42uy9B5xU1Rk2/tx7p8/ulO29L7uwlAUWWECq0kUERSlqTNQkdhJLTIwlGjX2biwxNqQqFjrSe2eXLWzvvc/u9HLv9547LC5VMMnv+//zZcxkhtmZc+45533e93nLOZebO/fX+N/j//7D6bRBqzPc6pO46ZKENIETj0AS776c33o9biiUqtOvang8TqhUGjgcPdBqDewrMyVw2RIg0hMc/Y8HyiWIn0OSrug6e/viOA493e3y67kPidoMNATLr5f7cLsccLsdZ7XH0VXq9CbWYu8nsFk7oQ8wy5+5aM7UGr38F0FQ4vD+b6BQKK947r1eD0aOmQufzwubrQv6Pn2yvzkd3TSfOqjU2p9sy0Pzo6T5ufSDg536kSTxrDlT0pqp1bozn/Ud37mPNWs+uOzxKf4Hr//LDxJqEuaFPk7199zCE8ZJEe2I0vZgXeuQ4Qmxid+QIGz5GU0yGD/jhfL+1q4uU3tHC5LULTBqOEj0R56epzo10AclfBZkCv6cPj0ByffGv3dY/Bhwku98DQAfKZyxBKEgHlI3je/V/wnBf/ah+B/GuGACxAwycdmEjW4S9j/Tx6IgKPw277IekmwFrrxz4Z32ro57u9ursTC+Cp/OlRBpJBurUqJzXRFKnFGb9RoVx/NCn2u5VF+kMHh+usip/pJfXDDyruQSjE0UMSjEg4DUTL/RbioH57bB5uWwtrQCayqDb6u0G2+LjBvyjELBDxV4vvzSfbE+BJov/n6XqJghXeQ6GsuLZYUC6dyZAkKVFsQHenCkzYC01CFXiaIU7pY8o53i2eKoEASoOcUGHuIRnsNBao2uDaX/g+2/EeSkjVNI695Ob9tJ7j8lKen8L4O43mq3tZVXlyI71ILSHiOik4YnCBwWHdizWqaAl/Pw+TwYPW7+lQGd429pqs2/d0n/Mtw0zQev2gzftX/A4foedK5djtem1iHji3IMGTBk0YFdK5fxguISfcnAWyRyeK+ovNg4MrAKL0/tQXpCMFyjb4E0cArsRDt7QcaoISkDzCvajgV7/olWSz1u+roh0Jhy7bYje75KuFhf1Mdi6uNd1ke2kRRTrBWxRsjKg7Un03N6Mp8gM4pDwIVYq3iaotL3Vxa0YlVJ2/X9DR2IM0gYkkQ/F+XG5PZqujnsqVfO7BJNMw+3mqDXamA2hTDluJyD+Ft60/0/CP9ckDMNzCm+rGuoWaR2VZNGVcAX2O+1YJNpMa3Csv+sZeVH+2VRKiWhaf8PdUJOF/+gD8r7Wsp/QNlvrNSdgA2l3Xg2P3RhXGzSPeTbdV0uyHuBdgUPQYRwXxaB8absEFizbgH6XwXO60DH3uXYVcNjGoFkXGgjmpz9nhAUimXsWhiIRNF7rrKYJnLKVUXlJYbJ5mJ8NMOJiLQMuIbOgSttDJw9PSjYtA7GIC1DEL2GwhwVD4H5l4OnYPmuTsxVrsKvhoj4os0WLyiUOmIx9nPHRevyUEVl0SvjTGX4aKYLkZHB8AxYANFHjFxvRPmevUgb1h8+QSVfp4/AapPOYkxy/2LcYFkR8NY2jBG/xk3XGKmNUPqcmIbogxieCjSXgWupQlZ7JeantZJ7QZfDN6LBKmBvtYg388IXcoaUhQHULymeB+l3b/0PypcBclqEVJr6W0XwQzu62q/1dhTi94NacPMgv9b957FG/LNu9JfhoWFlPM8f/mmhvnwKS32bqO8HXV7f0zU1RPOobb1Wh+iouHcgeu//N6KbCcWyts72hegqxmhTDZ6fo4Xvlvdx4uQpiNUfwOV2oqYy708k1H9icZf/kIswqrWlYdRv0txwjZkPXvgEPCbiyI6NcDvsEHg2fRzSjXY0+oQA+lcKPcsYwMdOWAA3XaPfGgpv1zbU3ZetzcVHs9yICDPCOeMpuGIzSDFz2Lx8M/JWLMWvMi3QGLSocgcg3xgHryoY1vxq9ItWQFVUhYY44IXDBqT2VxdRq7fRcyM9q8/498yqQxiSZajBWwuC4MhaCHvCcIi8gs0oXFYLFJwZ+4pzkTzxWricToRHhZDYkEVmgTCyzI01jWThJUREh4L3R8oQTErGcTo4x+IE9RU1iKTfSfGZ8mc2qxMSuRcBkZGwdTvg3vIZbhgRjGuS9uGDY/uhIel9vzj1zYFpg0bTZSz8H5wvAXIS6OFt7c1Hxe5yDA3qws1Rbswe54E6bTQcmdeitWwPgnJ2wOw+RbIX+YeDe1bf0Evp/lUKy3HCX5pbm58UHNXINtfj63k+aFQStlXweOxw631xKVnBks+z6N8BcK9Pqqwo3JPwZFYTbvrtSHj73wqkXYXcPTvx3cfvI4Gsj4pFjkUnozJX0482X1SFnbaqTEbZWM9zPi89aK/F2o0Z/Tiydp3gJS+aTr6P5lo7NBrF2UaUeCn9fz/qr4zN5Zn55ISFNfX19z2adgw39RfhTBkHx6yH4LX2YONHa9C07TtMi++GI0KBrypU+EWmhIHaHsRZ8nG8yosZ6QpZmZhiJdy4Pg6p6RntRXk7X+P9CxvOQM4A7nBY5fF5oZg7wGSHqIxGQ1UjbE1H0e+q0fCRG7D970/BSePx8gE4uXon7p6fAM/i17Dlyw2wrX8fKWaPrLgzqS8xbgj2nuyGjVykcaOi0YxQ2N0cGk4cx5irh8B249NoOHoQ/SZOgLWrhVjJEDl+p9d4oL/tMTioHd/IX+LWje8jRmrA9aWluG6zckH/1Iz1dM1L/wfpC4Gc40ZYne7DZkcevr2FFtGngjd5HDyjF8FjCEfNvi/QWnEELQF6DAzsQq7LOYHkYCbR2Q3/MoXl+Oy6xron74w/hruGk+UPjIFr2kNwRKZBtex93Nv8LV4sUS/snzoojSz6cEEQLtLmT7KG0eCVb5QV7ErYeWMDgoZPgm3qEvAE0sojB/HtB2/D61aj3OZAUHBUU8Hx9bk0vv4XAzkDuMfjIqt6M/Xr+xmBNy5YC5tMWyXdCMD6MTTePWSYx0DkJBkQJNlgfqhocDbLSO9rxTnO2GHpXDY//ChuShdhp/XC9CXoamjAW7c/gt+PtyFskhIfHxbwftVIGA1my/dfHzDOTenGbZkCJg/yO8urTvrwYm4comLSDhfl7/zY43ESyeC76E8n/eMEtNoAOY1EJnnt+grdwt91ViC6tgj8VYuQt2MdGgqOwuO0Q6nWoL3Zgf4RQFFhBRKevxYxzRyGZVNfvAp2l4SiDgmD24pwTTSNLyYQdqcFnQ2djCgiJSUQwbZy+D5aiCDSLpZ9r0NwEH9IS8G6Q92Y+fp7ED1u+aJ0Sh4B82m8Hgn5Tz2CUYGlaPOm3839DJD/6AJJ/70gtzud2yO6t+Pv1/ngNKfDN+9JRgMh0YRK9m405W6EQqNHejrRsgYb9vf0BBuMYRk2a/tuEgjrvzJxJMzT+mmqCeA87LHpEGe/CLhs4KpfwejsnVDw/fDY2jKsqW8epoqbtuXgrhVTL8QgWF9jxi+Q88MX7IdTvGer2JD5yRQrjIufhTMmE5zbDrvdijUfvAOVTgeDzQmHliMqKbhI0hnHPHmxsXm9Lurv5h9p85VLFllKAqeXg1BzAgjhmWVGXWUnro63ol7vlqeOsQqv29nCtIKfMZzOSHGKd4W2I/jDNGojcTzE6Q9AI/jwydN/x0MTHfDwaly/TIV23VDolc4Pq4t2HhiQOfW5r7ucUX9fmocBZgcsLqCFT0BUdPiRk8c2vUW+eCCtp4VaX372pfa+8T3BhY9ZOGfFIXx3I1BeWY783EIoFTxaWkWYg3lSkEoczbPjV3ti8buBtZiQwGFVvoj15QIOWZJhDDTJzKCvCQgKjpAlwWazIchTTArAggA1hyH0cZyRg6qrDrOnDodESqSpqg5hMeHM5UJT4XGUH9iEIqsaV8V4sazDMYyU3wJqbMWVLMXZLhD33wlyh9MZ8OAIH1SRKagZfg2k/LUQlBoERZLv5lXLPhWzLCy/bw5Wga8vQXxy5oL841u+ERRc2YUmRhR9GDfpFrgIsJey8m6PbzHnc8DnItob2gG+4k6IkS9BiSrYO0hw0AhDrAExdV0otbRPIUGEcAGQS5IC+3evQPZVN17QovokzjUtzoGRw9JhV34LrjUHqqg7sfz1v8nBoPZW4MEBEpbsD4NbZ8ljKOq1ZucCnNHTwcOnyUD/uQ9q59PQuKH/fP1ADffowGZ444bSQlRDxbcjwm3BtZG2PgJ3drUJS/k1tzQsvn8w+agpYyGOvx4KovsHthxDqu0EQs16vLTLC2fYNIunuYR89pIKouC64we/mZ097sbjgWkjl1hcrtE+rytW0dGw9+TxzYU0ryZqt5KavwQ7k8qNAQFTChoifmizV9D15kMgX7vfuOloWX8MIzWtaCYZaTYJ6JeQjC2udKzL98r+t9akyY/gmw86HZ1tegXH6Bh/eixcRcHWk8yvDw6PTxJDh0zZ6tHF+5y+4JUdXnVLWzMmmYrw8h1ubHnsYYSPGo+IhGhY2xqxd+lrUBHwJURicDiHz1o9GtYVPcPo2XL5a9FHef63WnKdRoePj4t4N6kFutytKHPWk9ng0FHkht7khKotCFwEq2DgYVOpsCixBSu6vcNCwmIHdbQ1lHH8+SBned09O5ZeFHS9KaTm2uOpH8/qhmv8nZDS0wHLNigEO3Ysd+PoYR0y0pSIIZ8yOkyFErccjSInGqw4pPkcwac+L5nXFlm01yeoacQxUHR+gbKSCtSWVUCtU8Jks8NkBGq8keDbag7ynNyYcL4Fd2NQ5mQZ6JJS+y9Mu0TjVB5QShjDdTVC1AyGQXscEyeFYVfdKJTsO4THxvWA56QfPfMfB5ti6bHg5sECHEG7IDSVoE39PDa88ApemK9DXaeEldXxiE3kuhvri0vJ7WA5qe9pTerknIXoe0PgpDfycraaBYUqXqFQJNPf97LA3k+xMVLeW5PikjBjVSu+ndeDWf2ioZ9xC6JTh6Nk/16cWr8JIxM5rO/icOrExptoTfLpZyxwOIxjVIUDqVOwz0roaWbDoutjC8u1NVd1hIbGPaXiRRw7vDaaxpkwYNDESYX8pCdvf2eXciXJiX3qU1AoFVj96lsw9ADqaFIy8Qb4fkzssvhF3OWC/P8Fqi7jUadRLz7mGYnfrrYgorkUgaJA/pUCKekO2MQhUHd0IdNhQ6DHQ5+pEKvh4GvPR2hk6iNin7K8KwQdrQa/KCOgERFaH8Rhs+hKIiGF/AZtxUehFS0oqnDh8zUWLFvbDcFLdM7aAY0mQE8LE32li0U+ZarXR9canQ5JPxnKoAlY/00ZVBolGuu8WJzF4ZX9IqIiYh2tzZXVpLiUfRVJrw/OKDorW5Skf4tQCL1xa8k0l3zWAOSXpaGtrB63DvQzoMJOHfVnb6b57P4xxMEluLw+Od8stkaAcxWhvrIFNw1xwydyqO0WERiahFM5254WBCUBjNtOP6o7l0XxgtDJ83wOvf/6XID3pbHnKmmNWq3TRmTiZJMX+sSB8jWtf/EvqNi7HRUdCgTwp6PlvIKl4rT0PELPD6i/90jRrKbnKXr66NlG/bfRVLaQJW0mBeIJNIbIQxwzYUH9yNFz9xnNEQ2k0JRzUtxwJ40Gp9aiurgWXSdLsXgIh1kmO0aTDPW4pb6SdtmLc7Ex/teBXJLEZdER0TcXa6bg8R0CMhxAxjArtAS+8hOFaHIHQiArmGa1YqjXipBQBa5PaAGv1BPYpDE/t2O73TZjTLQHntBkVhAtxwCF+gfBt78Pr6jEXQuNiI0i4l7vRZLBh267g6zT4EmSKEZfzD1grxfIuz9bXlkUcvtgEe7hc6DQxGL7wUGw2QVIxEKCXG4kk/+3qTEeTmvbdzzHzD1Xer4w3Hza5/9pGfJXqF22qNE1KmA1PENvbVCb9Kho8Pfj4gLgcnQzq2RhQuwlRetye5/PNlZCZPnosX+DGPsxho8NhW/kjXA4fdhVRUBUqZucLvL4OY7VGdT/nGDUWZH8s//mMJlCG4/XixCIBdYXFKCz3QsPGQeTTjpXr3Pnt+uRA3nsyRgRU56M8WWNuo7olj9bQcZjkUfkuvJLTn38aMpBLBgowDtmEbxOJ/7xh5dw/3Q9nF6O5d3Q3d6IRw4kwBAQUHsu+/q5Y/yvTKFJkm+VOTBg5f4SL1w9XeC1t5G8fYiMDC3cqRyO2j2Iip8Da04pkmPqsbeqmxbHEySKYj+el46RMF2Rg0rfD7LaujEwhViBTHvZytoh2fOhNxvh9VNz3DQjEHuPWtHY5cHNsUXY750+h5TSx+eu5aXcAx/4mTPCShBl4GBT6+GxdeHgpm+g7fHC65Dw+6s5vLrXB3N4KmpK9m/neF7NKOW5KbLLFQYWM9i3cznGTlz4U7/h/EVHgh8KvAoDRowmELtQ2dQgG19OVij+SnT2wjZK0FIkPTmcwBGSAi7QhKaCMhxe+hRcganQ2mlByZKSFXXQ14XTtPiMZ8+yE+cV01wkc3DRQCav2FxTeijyhUleiPFDsOPvm1BTT5a0xQe3hxhX6sVosU+eR7/l9J1RAU67Ve6HfcYrlItETilX7U02FeOjmU6EDhoJ58yHoNbr8dbvXsYdg1qgVatonCKO1Ppw86Z4DErLKDyVu+1NkgN1r79/oVTnlQRr/+tAftprfVARM+2lNw+tVz8ypAVi/0i0NQkICXchfSRhOCwEyrgBqMj9DJ1WHzpbTgYMyZqx5OTRTWsIGK4LWdeLWr3TfuXYeBKKwFA5+AVeD+gyoXKXYtT1HXCTwLqsHsSM/TW278qFqfAYNnd2qs3BUUmWrmZ5h9LlZceRc7A9chgkYqw562GPHgqR6G4jkYdHBnqgI/djeVU8QsPc61xk/QikHhKM2gulyC604+pCPfKXUfdOAC7t9mAkX5cHrvIYeuwcSnKOEhI5FJW1AUnchX9F/3lFNmWiDNye5hqotFpaq1rwJp5lkc+C5I+KkJTPrpVEhW/2p8QuSWEvnDmgOU+tb6iZ+vGECqRdR5Y1Ig1RqacgeAZjqFCIDouIhi4R54ZpWJvZ4+YTK7GRInChL+JkOeH40+AuMU4OKsFH0+2IyL4azrTJ8MQOJGVsxwcE8Fmq/UiJVONQnYjf7QwG+QvISDUdyTm89g1BoTLQ+rDswJG+4GbrdpZi6cPq/18A+Nkgh/SWTqNZoJb40cqiLbA0GKBQiGhr0UCrNyDE9T7KjodArRagD/PgblM9Pm6KHpKSNmKIQqHZcy6g2TY6URQvYi240aGKLhb2hhQ7SAa5oOChDL2WLMIrUAgi1AFmGNNvQH1HP5ijquAtImpm7YIxMHhgZ0djf57nTp2x1rSQ5MfBc55gcrA7HL+aG9cIb9QASIOnwSR58cf3P8XO77/Ca599h2C1F6HRA6TKU7u+Jx9RS9Zms9ze+AU/P0V2ORafk45saEhY/FdVDSzbl6IjZTpiU9JQX12OIImlmZSXUXDAyf+xuWZKT7o0e4JSqcZ+AnpW9hx5zuSac86vANjfL4PCzu0iBWtTh8MyZD40Licm3DyD1u46cn0E7H/vHTgO7jzLP/a3SVbc629XwfNnrofA/bSPUz2VX1yAqSHlZLk9iFC74Vz4MpwxA+S8YXVRNVY9/RIWp7cgiQBe2urDPTvjEBM3IL+htmB5XuWhBgK4uTc7cD64vf/Rdfz/GciZiyPWbK8zjM6otOOaeJtcCGFMsiIq1g6nU4XoWDe0Gjceeb4fXry9jBh2CwJjBn1h7W7tR5PsPtsXlYM7tLjiBbxQGKIDfLI1AllyRiMLD+7D1x/8nShbMNIyh2P6rb9Ad2sDTuz6niyVBiVOIzJ0tbAGTVzQ1lqzzh/AkQOzfgoqXSiAzy9ubyzE/XN9cGUvgkDfO/TDJuTt3yMDQxeoRE65G6oEodrptLlJ7jzZV80vZ7Tyglqe43PcomKIwIKKvGIZJO891JDl50w8QeozQRf6Rn5TJVInDULQ5Ok4tvV71Fe0IVAjnAvwrovTaxGBCUNRUX8c4bGnN4xfInDAybTfIltW9i029/t2rZDdDAb6s8pmz6fdLyWnDH14f/Ha0DFvzYbzobUQaZ4YM9r18aeoLKlHOVF33ngG4CaWahw2ctYZN4GUESs4X9LW0fp0d0ctFsaW45aZXkSOmQJnUjZc5ALwKg02f7IGkbZTaDl6CE9crcOhKgU+/sGDNfX9kBKXdCTnyLo3WGBRUChYddBW6qvuf+C+DJBzkvgEFzkh84k9e9OmJ/cgKcICdTwLkPBQqXxISOwhAxME0XQrYibsxsTd67Gt2h0fHNX/BYWgeIiou1yocMbCEi3MHne+n0xicG28ppmEgyhweDJ8bjc2fvkJ9IH+DfOlufswIGswaopz/RaGLP74O36BAStewTMFOcGJKVl/sPW0baquzIMf6NIF8+TUzwN6Tz10UQmwRveX/VUG8I7WZrkev7LchQo+DSH27kLqR0XUcbOPBIUYyBgSRiakB3u5Jf17VmlF0ZA3RxWi3Qb87aB2kSE+e5HZaF4kib7lPyON1qXV6mCx+yASJeXI2jVWlMm7r8IMZ8GUgbz7QmD1zzUPXYAOiZwTwQYOgWrSVBZ3uFwyd4Gg16DMq2Wf2x/k8n/G5o1tgNm366eGIZHVVpbxIkea2e+S8AoFDi5bBVtHJzE/Qa5BP/1dWl63jmUkunva2WEWMiWvaaw3eu2tWBBbiT9M8cA7ZA7coxfBpdbC7XBi3TvENAaFwfnDpxgxTovWAVo8sI7HAfswhIeEOmLCOr4/eXzjeoVCZTxNz1ecXYH4P3BfEuRs55dKIaw06tVPFrV0ImHgOBL47fJiKom6v/jXAAg+LcbOK8X82yfDVLUDkroNebzq+tyjGx6iiT/Lb/WnmrgLUGh7YmwA0fnhc2StXXBgN/mJtDguJbQBHEtqI3HAABhYEI4WLz5tINR6Hb7csRNPanLwVl3aRLJgeurKxp2OS52bsmOft3e2jVzYn6xyFIGIWIO1x4Lm+lq5rfpiJ+4ZDzxeFIfCvB8+Jz86KCwiwen2eCsrq0sSWBsxkfHQaNQGGkgPEeIRmcY2TJqYSb7oAFwzqwG/f2M7Ttmzl0VFRtPl+FZc6eSzU1bYpg2odP5kOM/JhUfhhr7j6Jsn96eKBN7PXlqr9sPhzqN/m5G84HY0H/oQwyIFrOzw6PuqiR9z/FfLr+c+/IqRkwOYzKpfsr6BaRXmRw+ZyuI48jWzcXA8f1YSixS8LS3jqmlun3ijR1LOri4vCWL+9stjXOgf5IW3/9WwEbviAoKgUvLYt+kQdr/xMh6+hoO2mENPghbzVmlRJfYjcIc7NY6GD/KOrD1C7FBPConV0Zykce3rtd7/affqSjgazUU/ehPElquvofj/CMhlBfy2JiLr1vt+2Jm4dZQEuyoUcDSRICZCH6GHSa9H3pZt2P76R3jyVg3e/lQDIdzbzPn3nX/6U7lrjlcca6g+Gjp7tleujydCj+riQhYFxzClA3qTAp5x1yLAYIJWH4geSwfa29qgtmuROGUWIrYcR1NLPUICNC9Sc0twsZ1iHDe6vaMVv50mwpY4igRJgU9eeQE8+aXuRieemCjhYKMkV22RRVQRStuT07LvLC86kLBjTg2Nk8eMlY1wRU84rlEK19E3o+wuD8TuDjjHj4duTDSmLt2MGPEINjZgeVxUzBiyXQ9cQYphTHdPF8YlcPKWzO72Ftkyi6cDivsrJRgCzeSylLI8OcdouUqlJd8X+KYYGBleho4TXyFl7G8RGJyA6rJ6/OMlD6aOEM6LbDNFOWLsPJBb9RMBQU6m7ex5ycwAk1lD2I9re05A0kt/HzDs2k8amuuMRtsm3BjXg2un+xAVFQJn5mLYUkaCN4SS8Iloa+7AP//wMubSeP44S401hRJWFhG4pVRER8ZVqRqKlxXmbGS5dT2xiACain292Y++1pu992tEjlacf94ncR5SmYLASRtJpt+ga+243EgtsUO2IcggEXujWbjFJSpSOEkBFbkZ1Nabl3KFiNpUV9ZUxHm8XnmeYohF6rSaBfT+AGH+LjIWAaLEjXZLilHec4KBkqhoF6Aso2s+xHPSMWrx8/8MyCG1qRVcUpd5mLR/zxEMS50OUXcU7rDnce1tFajLO4WegDZUFNViT5GEfIsZQyIUIxP7jaioLj++juOEtr6FBn21K6O8JeWnhn0zuwFh8QlwE0VUkgWoLjqF5koPZsymZfe5URoeLAftero6cOirfyJRbJWFX+eV5F1aI0O70ID0ZFoIlqfffZGxOWS7R/4iFz8Y1YUn0dbYgLY6Du9cDxxr8OG5E3EIi/DtZFEuaiu/x2Z9d2pYFYIzx+H47uN4e4oVj23dklLJpxV6RA5/6tcObxR12doIL/nNqbfPxKCjhRjacBCPn0i7f0C/QaQRz97yKJ88A64/gXTvuQZUlqjTWTKvm1yHwg4M7clBcroOBa0+KFUqdFuaW4ilcEyQVRqy+D7pler20Id9QSRAkx+CTm1ET2cXLMd34XfTVDjZdoF0GAGB1Yz3BtouneNXXI41Bzrrz6PyoijB7SNF0ZGDoeY246fTJUSaNfAkjYdn6BzYQuLo+mkcaiU2Ld8Crr0OtuNb8cfhEnbVqnDzP4MRmTgUmlA+X9dRvyP30Hey5VYolCzPuBX+k2HOKk7qlS+Su6mWHsvmJnLFwqUqzIy3opNwv7c9JksbNvgJrUZlpB/+1CETvwCn/LSipgIujxchQhfGBNfjhkEcdlUDqxuz3oiOiikll2TDjwyod6GFBzp7et4UOo5i+dUWpIWwueDx0NZy7GnNWME4mgltCFXZMSKkE7ERQLxBPGPjmW7PaeaDrS4p+Fi7eVSOJRQJcSmfUbtPE5repC+eF5fZunXronPkbfnpfy+fMmXKsh9++EH+u+JiuVK9RoP9VTaMWbca1llPylTOaunEupX/RObESbQQJpjRirzbGvDI1kah2TAly+v1tCkEnE3dzgq48dMGBDSin5mo8+TfEoX2obu7E431bbgpnTSOQmaACAtUyjS2JOcQ3FojLDThkZ5WcBolqlqNJEwc263F8kBsn/XuC7MG4UPR1eW3OGQFXS4n47mIFDz49aYA5Nj7IzoupLAob9cK5o8HGsI83d2WkNkZJEADJuNUcThmOdbgm1euw9fvf4WIUBWyR2XCMflucA3vA2UPISNZAz5rIix7puFXLf/AilrdgqSEfozNbJbD3sRa6hpqhsouR3xqLQ0ujh3YqNHozkmLcQgwBWHJq0/i2V8+irF8PXaQJddqtNbT9fIiU5jd3e1Q60xBWskKQRdHTCcUbpo/t6NHdkl2bf8GQaG8v6DE53WSv21jNNZ7TtrqtMIdS99qo/aLz7VGP2nNaT6lflfJVXfsiCd2cITb4UJIfCxm8414axC5YjET5So1e3I2JFbnz9J2LgcUBPC3H3wBE6X9GJyig22QAq8fkvB5TX+kpCUUFOXteN3lsvvo+rRkuT10PQzcZefn8XuLk6AkBrShvLrimtlhhfjTDS6aNw18g8kVbCmDp/YUZn1tgzt6fC4zXiTH0sWOt5JIUYhN+7F5th2hWrpeQzgkYwYkXRCyqg9gz7JcwlzSfQd3Ld/AUpm9W6npWqfWN9a9eUPIYdw9mxhXXAbcw2dh/7qdeHvWSeyuyEOSwYuYQFE++can1EEMTYQUO9i/+v4UB7KqToCjMSnouhvs7ViaV4z1NTFPw5D6dLDZ/DZN9BJ/3Nr/YECmFwbmtfR+NvuM3jOQL6RX9CqAi24KD9Bpn/2sYsATccZTuCHgbTiT/oF+mcPx/Krv5IkWHlShuagIR//2MPoH61Da7UwbOWbeQ3Zr56tFhXsvaBGIQmWPCLFAZikKtXyGV+6+3fB0+HD1eBXsbpkqoaG2BgX138Ha3iSfvikmDkOPgoO7/BjGRTXisxwvNLqABLoOoW/FW++GGMYYKqpLR3x7bS1cCTPBkktNtdWyuhwSDawrDYFOJ76fc2T9PvLvDNROW1r/0YHFlaUYHSfBVl+BeffexNK3qKwuR2nDaszNEuAozwWayyGZbgZnOwTR0wypfTdGj6lFc+31mLh9E8o8ySslUTSRZXmypvzQ0A8m1MCslTB/Y3dsQsrwt+jaHvBHsiWfvA9dwYOvPQm3MRJ7vv8KgZEGHK+qkQNYgkIlBhpCgvUBZqfXJz7thfKBrvZO80iDnebSD9r2xiaseuFvqKnj8er1apxoYhYEGDhiznPUj8PhEXuoE84jSWanqEjrVSyN5UVEI/XsYI6tEL1Trsias77lU0UlWWgjUpMx4fZb5SyIxN8HN/kU7U2VsJK1dxz9FgZjODR6EwLMUcQ6rLhh8XhE2CLQdXQbHKTAPyhLQ0ZKYsnxA9/8RanSBNOasGr0L+np+ak8PgEku7qm7JrXsvIxeVAQ7FkLYCUlLXCi7AIW//VuLL+uA7O+zU2ITx215MCuFa9f7Hgrks+U6fE2hIy6Btbh88EHhqCjpQU7Nm5CSo0Svxjsxjt1bTNI+QTR+nWc3lZgcvnEzeruPDxyTzpsWYvgix+Iwt27sGJDEUxDfciOVcI3bC6s0RngwpPIWOllcLM17iAW1lBJ82S3IvuWRXK60U4wNtfk4jc527GkeDvWVjbgbzlx98cmDye/Tbyf53+yRuSMRb+oJfcra9+T/ZLSTX8tUN0fS3R9SBstGgsQkRY3GMOQt28POltboJn7e0zb/Qap0+1Y0z76Fa1K8S1NQDnPX7B+nRgdJwsGF5FMQtCCDV+uxMQYHqy0nJ2X4PEJGFKzGRVeMwpDMjFm1lwEGoNkG+0cPg5bv/sGUdK3qHDaBhqN4UFWa9t5FW/Uelasogn9wjWwjb2FnW2L4mNH5JQeOz/UDT011tNFv2ObJ76jxa7nFcosOVBICyuNmAvJbUd9ZSFyDu5EjJmXqSiUGnBLfw/pgZUQo2nMtayUlkdZqYjG7hZMi/dhV36FMX3Q+Kda2lsevymuBsMGJ6InfBDuLPoay1qj7zebzO/t27mi6KrJiyYrOAnLcjjcGFEGbtBM1JaVI8VagcwEHoIWWLW/zBAWmZSh0pgsbVUH+FnRDRibzCGCLt/j9sgz67LZ5LTZqBRe3m4aGajArMCd5AZJyf4D3U77BiQXkwb6KTX7/vAocmxbgN/sbL0mMSVrGTW26LKtOeOWLVVASAqLoSNj0gQU5xTQM488mRZiF+2YnE5sUAXYzNFotHXJNF0iVyyh/3iEZo6El8tGd/RkSOtex/TgAhxtNfRLSR89rbzk8JukCPN6Xf3eHH5f/SLKhUBc78Xu0QUGQ8P74Jh4D61LBvlebnK39mDNF6sxz9COkAwFPOS29XS3DTh/J+PZlbdMDi02EUqdmdrxYu0/P0I7AVHb4QWv43qLaphSXHl6Lj4UWvZg8wMRsN/4krw9myflse2zz2AMJPNCFtv3m2fAq9QyqHu6rCg9mgtHewu6S3NQdfAQ4iNUOOAIwQ/fbCQMCLhu8TwkpKVAOTMdZbFTkPrty/jj0Fq8XZN0n+Tpvr+i5Ch1/O5FEd5r4Xst+yWPd2GBpNiomJErSvJHDdz+NqoHTYeKNGTOoUY0lXZgwQMPEX3hsYcsaejX74AFErq62iNoAcp/ql5bOG3Fu5uBmVcp0EYTe/d6Ee/OFBBC/q6DtP9V196AgECDXEjBpFVDNGzY3GmoL6nCpm2lXFhU0sieohYNaWbnWQqFE6ZbrOSDpo6GgqjxqtdfQGtTAxzE3j1BxFICTGiuyalkaTKyDPWMCnu8njS1aCWQE72nRWIuR86erfL4vAkJyLF6MVhVD2+AWa46Y+eblzSNQ1mliv2LXIFOJBvZ9lkPXXPCH201O5T3XOWGI2UcNGNugOqzHTA6C+naxq0h5TKA54SXwiITX7Q4ioDsG6DWajHr9rtQcPQgNuzZjsGaOrLkaii15l/aqrfjh4VuKMMT4BU0EBVaSFctlq2VMSwMv3rxOYQmJOHA2y8jS7kDj44Qzg+vMdofRrgnRS3TbbKqaVFdeNGViwf2qRcO6p95iL715mVZc1KqXN4WogvT5J1yG75Yha8+/AKCUgmvKOD2DCUybKQIekihtJbBTtfbENUfHUGxqCrag1RNALQBwQiPC4frzucxx/IMhtfsw99rxtyRPe4mDZGcW/rm8P1A95cvswBkt6X1nH0KCv/hj8fXgY8dhCM7tmLLN9+QC6RFdSuH2hyap4h01FXnl5AVHE4/OHax2BmzkoFVe9HecysaW+vRRpZcqdXJhVtVJD9qlbaCvmfoO7OtPR5oLBWwFe8H5OIuovJzrsOQyZOgNZpkcL/92HsIKFiLGUOUGGUW/ClQHRHRKUpZtueS65tPFvs7MUOm7swV4uBFVEIY7t3oxhe/4PF0bitCjfq7iOl8dAHLfaH38r9/8khmjUr5ztbatFF/qixAcnwbDhR7cHDvNjz23seoryhFVXEeWV8rVhRooYsz0OQ0TQKLTErSxvNrMjivrIXJWrJA0/7N65EZwqGw1YdbN0UgJmkYFn27HTtvsSFl1EQIRjPaW8tl9zbQGIGG+hw4nBYY0qIRuyUXbv3QieS7Z9KUHOzja44gqp79/kQbPOSzesiKl+SegMqlxO8zfXj3BDvtRO9wOq1MMXT3VniRdes3wEx0n2UT4K+1HjXtOqhIsZhCI8ApFNjw/pcYr8lHgEqJnJ0bcGRrF9K4TugSI9DZWAtFhCCDv6Jon/rog4EQhy+GL2EYRIcNpn4ZuDvwAJ4rae0fm5Dx2707l72fOmgqhkawsv0e2U3Z+fWXBBQFStsExJtIyAkc3oa9MsCFjInwzPq9fDoKE/7KUyWoPrgVp46cQEK/JMy6NQrD7rqf+O2DlwocU5skYGTJeKUKJ597BFNSBMyrLkOOI+3PJHdv9rXmF9lJ6F9UreFMo8EmHWZfPwmNjW3YvbMcVw9T4oWtXuR0h2GooRn3Z7uRVH0cAZYWVCcNR0XeNqRkzoCawK6mLiY88yKOvPMa7pd2460acXFcdMw6lpLszeH7o/6MrX2JzOHT5TTgeSXGDDRe8mdVKjgcDsy/804MHD0aK2+4FnUWFfnp+vJuS3ObQqG6KNclhVV6qks7ko+MR4AhAG6b/kw/coGePH+qs8+ZlsQ/aSNH3PTHHbvxrPdluO5fgdpTBcS0JOxauQFG2FH0w2YsGiwibLoBp8id+j5HQreTZXYkHG4LhJKsfICvGc9OEvB4nA2OYDIc7Fy8sjIcWrMGsYkh4NVN8kXYrF3pLIRDPVv77IZcdpH38r9/ktzTZC9NjE22/PWgCubj32NEyzpkXk0WXaNG0cH92Pvmahx4/TtMDvNB1bQL0fGDn9XqDDad3kgWLahvmiWgtbVh7OAQD8TZj6Lk6AE0VtkxOpXHDetjER+fcbC9vvApZcQYPLZVgmHfJ6jL24CWljK0tZfj6w9exfEde6FUq6EJ0GI8UVqrtTvIaAqfxBRHb+CNOMIzgzWnMCqGqFVYCgrpGhk9szPwkDLZ1JQAeJ3bWFiBhMXOAlOnLZU/oKEPlK0Cq8YLDo8kgIfDSy4GK9yLHpaFnPwm5B07iG3r9mOqlI/xoS0Y3p2LOwZ24oMTEo05BLclN4Cf/wR8qWNJKlRyW9MfXQJ7J1l5Xz2IXk7nGeVlQStWXt5cJmtvVqAi0KvD5c+FM0vy4XQ7FMOm41jQDHz23D9Rw86je+qvOPrso9Dv+QyOtibydY3yoY22umpZWbDfsifP/fhk/3Y5nPjmraX44qa5+OLaKdC0nJL7nd+fI+VpZ2cdz7mMjEwYOxuO8zjQWxDTRW6bzmTG5BuuQ0Igh/JmH1a3ZKFbO3DPTt8MaeJSPcq7OUT11COh8hh8RJnLcjbIfStJibKYydiH/wzT4ClYkngQdQ11yzleWNgbwWZgZz54b7CNCXHfpx+grGxXia8+/hgh4eFYTa9P/fpBWTlzvRjmOF9vbftFQH74RGeIfKwek6mImBj5lfUgXjTTLZUHBhoer7KbIMSkyfOhoOvI2boRG1duxHjnZvx6ooAqqwLzVqjxiz1Z+M46DbvEayt2iNdWW/SZO5r51O+r9dMco1bE4YstZNTs7fLcNNd1oDK/GmF8D9aekMvBSfkEx9MbFa7gcVk3V1CrhHt+qEz4srizEkkGCWlBarD92RpzADJ/eQ0GZo8n+l6FmM/fxRulezBw2PTHmuqLdleWnehDoRU79fYCzByghTt2IHI+e5zAxmFjBbWXPKDh5LF15ItxusDA4Lc22TIfmFuTiwGKdai7+i5oSdPptMHI3bmHLJkCHa3tCFNI5Cu1wGgOj+3qbEwkyl3J9npbeqzTFiR5yYJ7IOlD0G9oKjZ8LsFoFPBNngSdMRrlxQdXh4THJZnNkXZSDlnE0USSAFuOJRzF+w+QwsmGN34oO1AU7973DO5LzJGDONo2HiPiiZIeeguhehfiIpTy3hpOyWH1SR/WtgyAy12DxdOpf40ZnMsh08vCwwdwfN8x9DcrEN3jRZ2kUJASvMbrdjMWiF7fWWcwkmvilqeMfc5uHWRxC7Ad2Uo0fDNGaEj8jgMpQaQQRqkJaC6wos6QAWko2XEAwV//DoXNPMqaJUSZuLMEk5OjxxymR6sQeJVSFsRVOT48tyYAHkkBfZB8CEbw6YxF2SVq7vdtrjMnPdRCwrjrU4hjF2Lc/JtQfPgYLJ12xJlE7K0REWIy2wpObHhHow1YOnDYzLvnbSrM/EX8KTw6rh6syrwqcTgKdq3CgW9PoKawDJ3tboyYORHJA8Ygu/EAjrUql4WHhLH6gGV9i3YCDSFyOvBsP13oymuFKba4AIkTpmDwqFGoIitYvGU75mYp8doBVkLt0xFgG/qWVYg+7zmlhdJ+N6f3Zzd7i7lO2+0hZDRqKsWLAV3FyzkSctxIqfR0dCJ79my4Nx1HVVshPswXsKVjCKIiI6r4hqJlp04cLKLrV/sDixzbSswTc3w8bejMPIWiEvyepfAtHob0UZkI8TQhtYEUosjjWEsejimuG0uqzftvBzlN0LKUpLS/Pra9IfGbG2xIJF/K5/Vh9LTrZUFi5alR8Sko2leAR4z78GJJ5QzC4CCan9MBFH5URXXZ8BWTO+HMvgOM8Fg62mEIUaGtwwFR5zOSv8U+bid/7MHk+JTUP++rmvFDRBvig5PAaQMx6YYwRMQlYMK8+Sg6uh/f//VtjArtQpWYHk+CkOQTfZUer7e6teEUl5FFNHfSbVDFpGLjB2/KFNjS6EKjQ4QuSN8QFpk8SK0zPdzS2Ymmjm65AlRF1iWcaNr9PzRhre6vUA+cjJ70mQhwEk0iWslOyxmYKOHDw168mBePgYZOBGr882NxSP7z0iLDcbX0DcLm3A0n+eaMYh7etlGOgKdlpqOn5qTsz4uS6A0OjZ/Z2tmKcWwnXuxgKLkfg0CspD8rQUKQKQT3/eDAM+Ms0CmEPsUmPEZFkHW77s/ITB6GhpJ8OBUd+KAqEb9Ob0WGvINNOi2/3HlM2+URcft3PCqFMTAYtAdEj6uzva7gMLELJniJlwI5CXKZi52yFDMA0qgb5TSozWLBye27cOpwDjEsDV46aYQpRirgBYWeFFWVwEtD+yen3be+K/Tt3cv2Y80NtRBobNsLWxEc2AVzlgkRyelQBSeivd2HaQNjoCg6hJyeSV8aAwP2kQBW902hac65P5iKU3yypdrwu7tmRcFMAHcRXZ95803YRy6dSlGPOcRUVvxQFT5g4IRppNC3cqfbMQaFn7upSTjXxfRYnGQ4BPjCz/rLhasNSEHn7NiF3Us/g1qrRl25F+Y4oNphRrBBvyXn0Defkz9tVCiU9adP43H/WDjmk13YBDMnB305kp2O+io0Skocs12FbMsPaHAGwqd2NdJvwy5U6vwvgVy25gp+cltAVuUHR3fijriD8Ay6Bus/WIbpw7UQ+18t+74Tb78JRS8fgbunAdrg2GdJoNnBek6ipAuiFCToZh9cmdPx9Xuvo6WxE8m8D+o4DnktPj38xdY1BECW1723lYuvqO9pR1BLhXwOt8EUjIxR2djy5T/gsHeTNghEsNCBBpU+nh30RUpiZE1tWdznUxqQ3n8AfCPnYg31U3T0ICqKRXxIrt20ryKgFb01Wp05JQZF2H4fixLXy9SoqBVYmp+Lde5EDPxcgfcm78WU0t34dZZSptVN3SIeWcejgh+DgakhTZygjLCcXnUhiCyn6GkqryqJuP8mHdyZs8mK2+ByEdW0KDB7xhTYQ9OxYtk6v3SQJtNojfEjdOVyXT6XPAIntn0HZtk5gZFFzu88SD6EJY/3PF/ao5TtxOkMb1ltJWpvL4WHnb9HglWae1TeU1pjVYMn7Rr6RggigkOQqGmBQfOjC8nLPqAZaqWAqIg4p6+14tXC0uISUsIaAngTx3OswqXh0tXr4GN1pJhH3k4DV8rR9aDISNz23NP49p13weXshF0dA66z8QA7EJNod/nBPauYb/1OsNG01qOffnLYl8cMb447jqxILba7JMxc8gSBvD+bFtm6Ohzz4HviYRroDuRaJ1UZAwISSZFXXfyaJItKpfTfnIEYJnN5tn29A54mC1g2J8EoyVNgt3e1V1eePLNN+WJ7K/wOOCezqTGqZoREmhHPtvFWy9t72Y+bL5hxaK1AQ8UWzF2yBD1tzSh/eSmM8vZfidUSeHheYSM5Xdm3SrPvngKrS/S7IMYI2e3atfJLNFWXo6ndgAXX89i9KQahAY17aF7HXEoR/2yQU+dVIeagt94tjHrgF0MOg//+RUQWHYQ0bsmZ1IbAOXHEFoyrI5tRqB42lHzR4TQrFV3WniVTQ5rhDUqAh5gQi6oH9XC4c46Au77SQh2gKpBLsnmB37dzGdshVRlkDsa+Og4zKw+hlic1QQtobbegu6OD/HIlIuLNqM4jpWbigmla+M62+sPm4GgUtZcgw9opR5Ar8/PYQQTIjHThse08NBFZKM3b9n5c8tDpNQQ+9JuAsuEjEekoQZjShBs3rsGd3aewZGcA7tgRj8w8JwxqSQbHkVYTYmKSYG9vgthcEhGqtqO/ySaDjv2t3G6KaCW6KkT3k08s4TVafPD4K3gw9gBcy3gCvITfjFFiw+pgcMQAlDrj4DhfM0R2l5ZljyHh6nvgslnRXF6O+ECXfHMFRkmb6k+91Fhf8jQJppeE+JaI6NR0s173uN9SS6e3mkoYMnYiju//Uhb5cAJ4qFH3iZVL0jp4lbnXIWAB6tCArjKvz+WoLNpbxfbPk1XR9q0m+0k58BeNgDuwCpj3LA2V2MrG73Hkhw20jjr0NHJsSzw76JIVLShoDHVnAnhkkUm/GNP6j/ryoeMVi26JysWvrhsIQ7+BWP/Ga+hqbsKMe+6F3mzG+Gdfhu/Re3H8yE5YoiZWGgICEvpa9AvEFP0v8g5WAZGeWrw5u4tYjwrfnpIQFhaLktxNjWRJh9A15crg4rznG2V5kz4x6NZqiKGxGPn7Z/DN2+9jRIQbJ9uUEAPZ6bmc+4Ib/YjdzvjzC3B3NuPUpi9hCFSgvlnsW2XYciGADxwyWQ4mSr2HoUiyUsC0O36L6sJ8rHz3azQ2kXusUrB5ddA3mv7tdL0PbX8wPjnrF3dubDMuVR3GkFAHfLFDZH7JctANlaWIyYiF5UgjjjmscSHhCaNcXnGPrnU7/niLCo6ZD9PclcPWTb4hkcJfrAAaA8ehu6nse1nrcyyDoZDnz2QwLn/lmHnhTUMPkGYLh50ou6CT5PZZX5GpkThxsAqtrqqI5H4jRuqNYQ9Xl+eQInFBypojHym9cMnD+ORvz8BGAOuBGV6n9TuX2yHaetqrbV4TqXYLIgdHkTUMhZpWIn3JUFTknsLz/Gs4VFWOd2vGkpWOsjvtPSdiY/mxaD6ITdf2IDwA8vZKthAs1SYIFlr3DhyqEzD0iWas8r6NhNhw8sHtqLeqEG5SIEwvYXWuFy1cIln35pPBOtPgIGZlmfXJng+jOUg2BqVHK3FzYgf63J5IQ8rPRK9tHp93aULysMyC4oLH/dLsPzuGWT9zRBR0dn8xELuDqVNICy0q2MXSdatO+9miP2juN1P0YEq1hj7rYWzrQlWPFz03z3/MzJlrZN/Q6PWyKyLoVVDRdXCKQBYBZqB09Z5K478JhZyaXZwSl7T3wyLbew8rrag8mYOCffsRmZSA2sJC9L9qHNFsCf3vfQqvfvIovijeidyeiVWmwICL3KaL88klzJYmGeB1pUVYcySPOtfh+jQPMUUJapWqksbMlE5nbz3/qLHz0NXZBIMxtPc2whKbHntbm1yg5CG5W/3dRhyt8ODOQWT5FWZGqWUf+mKVoizd21RSAI/DLnvpVhcHjWSDQq1mFNt07qYhBnC57v507WO329+4HJPpboGvLR+G8BRyDU/2LVpsvhLc8riiB/Nd+ZsLXP1xsMYDbtp9pCb8eT4GvNaGegRHmWDkRLR3NCM+KesFR8127qu5bjim/B7KiETsJ63Pgj5lHRLK+VFwWBrfaGooLSV0Mw/35I/bXn136yIy8eEhDxLyt0IlKBAcnMyOg4ZKq4TOpMddT9wIV00BgsMT7y0oOjFo5dQKLPrNQkgZV6O1vhYVRQXQGwLRRCJc1El+utfezgIe+gDTFpVKhbqTJ/2FH6ej0Sw9lTAgBclP/RPDZt6IO4K3o7GxVucVpaHqpu347oZuGAUPbNpI2CeR3/27dXDO/QvKpVjYZ/4ZaVnDsO12Ab99eQ8e/9tqGGxFCDEK6HKIuGetB8/lDUBIkPloY13xKYXAa/LaBDmNwpkj4Oi2oKWuGh0uJQwXOAi2t9LL6/VMCFF0+ulhd7MsLCmDs+QIfkq/MLhJzxu1/lJZFucQBIWNnrn0zKPnSfoslx3gSONmueLWCwG8796Dnzr2SiJFl33tPCx+5EmkpySinMTvquB6mIJjrhFPJ7N7T6VRKjV9AOFbERkcjNver4F35ZOYGi8ifuhwGIN9aKk8BoVKg3hS5LrbX8KifhIGi7vQZbV9SeM+U6vNwMGA4vG4Z6kISJLGILtJTPEy5lfYxfb9i6hyhcFp62K71hSkaGpYhH40m0v6PVt/lnf336sNBpVKjY+OkbIit5GdcNPa0AD16bvaSGc468X36zNlkTB8DBKm/goGyYOQQHa7KxsxSk24/wikH+d3zPib2D3p5Xu5s6fRGLo/p0Fi2/xkPWrrbEFTaR40lkIEaAUZ+PrAoMQr3dR2hSCXB7E5IT71yIsHiWZ315+ujRDQ0dJEE2mVq9lUwUFI0rShsbVJ9c413eDDk8H1G41Nn3+EsrxcqGmoEUZApVahpjL3MM8aALeOaf0+ms4STO7BmzmhQFcbkgzRCApJhD4gSL5sFvgLSQrErwZ5UEPgyDT3IDVMI9/Fs722Gp+98DTWfroaUnUHtIIP2uAktLfU5pPAqcuKD283mELlI5nZgcD7N3yLDV98iPK8Y7ICEsk3Tp+/EON+9xekOg/A2nhCt3YxCXt4Krzzn4F026tE9ceBa1sPKawfIn77NyA2A6Ux16Gw0oHddwr4HVHzbZUCBr8nYezqOJRrpnSZA7Ufnb6RgclmaX67GKOwh2yp4vDXcLpciElOx9jp6Xj3WCBZDOmszSS954OLkhQUEyhX9YHrapEj5jrixyeXvoPm5gZUtJ61CeVn3S3gSg45ZDn3o6s/wZY3n4attRE6NY/pyV50dLYNCAqOSvSfWnP6VJrdK85Um1EfncEhEbd1R849NH9TAsw68qXb96CmYC82vb8af5s7Ry5+YUCPuOdlPDzEikE+ou422zJqcLoccCNF4LD3wGbrGbW4vx0igdzq9MLa3Y07H34IEUOvlnHF5kOpVoeazZEdo8beIOfemYLoTb/JhSn+HWTPGh3FePAqFbxRA+XiK5ZC05pUMqwVIllklW4gO1n2wsebsW2mOpLxOqx/5FE8OsGOoAC/by9JkM6tDGbryebnx1SgJDCA88lZbN8+QpMGYvLdL8AUocCqIxKuNufTOIzzpPNO3/03g9z/I+89JZ5E2MpOylVOrXW12LfhazmKzWxImScI/XStsNhdSAulb7fWynnM/RvXoblewmPZPthEyAMhGspoeumFfELmHoTHDcYXZN8VdSflWVIoNHItdO+dM2MCeQQ5c7FkaCdciSPBSkU3Lf2EfH8JibRAj1zDY2t7NIGZ29Ftae6kvqxs4dQqdVdhlxLd699FZ2e7HOgoy8/Bdx++h5Nff4Xu/MPISDWT383BzOi4MQ6+m18AwpLkjRYy+XWwUAIJQM8R+aiiutxcjF04DzRshCodeHyMG4X3Qi4IUanVbWVFB3eRT0h2llVcSS+pyMdillxS62AICsGwCVORNWkKNEaDP+UlyWe6iWftDe/dps++QYBh9LRq32Y4rRYSSuFfvgdI34McLwvkLP9u64ZAgGO+ehyt96R+RFOJspOVSqX2Qs4tle2zwF/wojs7KXX4shvWxyG4pQ2tzXZY2tsw6bbbWRaCaK8TeqMe1RP+iD+N8iDWvhMer7TC4/bbA+YGMKbQ4WAlo51Y9dFHSB4wQK5UK6U1rG+j7/gcqGloHGOOTF/lFcXXqN3hJHdDyKfocYmC5BSVUkNLi3TgyJ7s56cr4CTWKdEcMBAOzh6DxIRIGo+EP412oK6pLiE9Y9zE/hnjzt/SR3PAlUxEqvlV/PqNKdhjTZNvD3Ula6JQ8Gg/sh6rHp2HjqoinNy01H9baGrl9kyeZW0UuMIbcfI/TxJwNDg4HCfzKyC4rSgtLkLPYb/PwCLE/TKjaKF8uC48j7QYgSDrOnDsML+pM6Aj+tJEmNlUpYNa4PP9aQvoL9aRyWBYuqbCDGVDvjyJdqtDpn2Sv4gZTaIZn14HjAhzw3fVLWiprkBNWTEaqn345VgO937vRVjMIDsBbDkJg5ZoUgGjvXqN+svXc8LhKTwAE0danYSvoZbYQNkuZDZ/i4DNr4Bb+QeU+AKg1ZogMarJdlOx/Jbk9y0563Zw3URAbMdJ4agw/VeL4BmcAPH+5fDd8Bc4J/8adocXdw1xoKOrMyUxZbiJFMyHXp/nWGhYPJigMkYijZgn39QvZ992HNm+AWpHJwRSBYyWG40RmYxm9mXS/nul8fLBlGwe0mYsQEjKAEQNGCRH5E9H4kX8jLsGnH389AVh7RZ7CetpX7vZFowwVydCeSd4FvBsJh+YFD4pi26ybYPOLZU97y445KNHJQyufHm3D9N9dcgyO9F/4kSZIX7951fw/s334eg/vsDneSF4fhIp06YaIy8oXmE/1enNCAw0HaztBtSdtbjxzjuhVquRSz6+zsjJewM+n9mFgsX5+G3UDhTm7f1dcXnJ0aKyopyGkl0Br2bswN/St+Gl/jvR8OFQZP31C3CpI+A/WUxAoqEdEYoSHCv3ygZrorkEgjrwbmag2Km8Z8bC5oPdLoIseVdTMw5sbcWGI42objvDyH5qLXjCt+frKjJgnAqJIyah34Tr0HvzEhlbP6bp51wRyJ1OK6706XB0s4lsL+hSQ/Xp/dAf24KZGSKSyDccPeMGRMaFIS0zGc+McsA14Zfgxi5EK1HoYzu2weUiH8gt4rAlAd0d9dv99x27+B0vyFP+osodAdQXQjiwAsXff4Xg0CT5b26nA1Ofeha7jlogDpgonzJSfaqAVb1hqNEHF83M7u6BcNnbl7ndDh/1xe6Ue1SmSaLvvsS00VW3rdNhXM9RpHkbYPb1IDRIyUoXoQ1Q4e4NKmyqDcGNyR1kPU5jhhaAb3oafOV1ctySa/8QnG03uM7VEOuegOBthiB6wEUPJut/AL6ZbsTqOES7TyAoLOEF8gkD2Y45n+jzHxqRyAI6GjlKbu0kcJNlNgzNwPEiD+IMrNxWLnwI7zMjqWrYZB9cGjkfkteDgNAIeKwcZtxxKw5X+JCibYZSox3ad1viv4mmhzgcjucSdZ0yNVaqtKgrPIiyA8dxVZgNWcpmPDBBxB3rtYiKjHO2NFVUkJCaLrTx5Vxlrha4a+p04zFnbTj21fmgaiggWXMgKiMY8SOC5VsiuTt6sINYXTJficbagofsTvmuCqE8J+3+oTYQurhkGEJCZYbYSXOZOXIE7lm59P+wd93hTZ3n/neGZMmWZMuWZdnGG8ww22ZDICSQm4TsUkjSpEkvGU9DEnJ7k/Q2aYCmaW97S5pJ9mQ2KSkjjIRlMMsL29jGG1u28ZAHsmzJ1jrnvt+RoUAZJqH5J5znEbYfdL4zvnf93gnnxAfhSpqBu9PDUPZAA0oWNaH0VxJylw3G6DsWIP3O+Ziw+EX45yzGjrXbsPKJZbAWlcNWfgB+by/Gz7sXhslzSWhJeGG6BFtbk5EsqNuFM2m/nE8RvCILfrrh6E0De4WhRr3yvyyMR8IzWCGeizecmNzZfnK6ytsFZ/pCTP7pE2hpaILNHgwPH0IMfg58U12Rd12j0X0nZR7EibXba4SI4VEeTIpqhWfazzFk1HgiPh5TxlUgSteFXOczmDBsOnx9Tqxd8Uf4EYQ5kW58ViojflBy77HczTlkvobjAnPHzjocKpYIIoqQ6wox7uE/Mu7G8BFzlZAD57PCs/in8GfcQ8zlR135caWAwqL3Kw6U2Oh4qezo1j2sPJBVnJ1NWCqRS5JjZ9amf3o48aGhx7FkCkELMm6+KvViRb4RXR4en89txo2D3OiLSQtocWZ4sJwRThvoma4YIj6IjtVE9F5s2XMTdM71GD1FhEHfiVADj/xIP2ZE92K716cnnDk1a+/qb6ZctyCQ2ibhnA4rjNHM0XpkHw+HRu6BGKQxn0nBChBM6ogwZ8AbHJmoYE7WLDP1rgXY+tTjmDdOhV8f1KHdXseca0wfBZ3t6xiImX4xLU7LDW1qrsXWhRI6SWPlffginLZ6mAZpcaxXhCYiBnH2etj4ZDgby/+XOf4CJsdAyljlEwbmcNFPWrrlZMzT2uUrMH+uCbwuEpFD1Vj4f28o2qxox6v4S2kWRJcLL2Q2odE30xam171+Sp2KnKM5GNT9a+TrRxIu74a93QHmSPNmzFNuw0fq2c/z/RX8ciB9uV/4WMvq8Nq4eVg0DfiPIfROI+9CZasXX31QgVvvi8XqLY14gyx0C4ks1vXF3tk8nc7bzLbQ6/X+XPTTnhgFiIPo+vt7kJ5QAFtHD9EYMJsE+fYSN9tH8yU6Bfk7HA4UP+SEJ86CI98cRt7bKxRrNCSF1h0q4KM8n1KefRU6wwywe5Hse8Mbf/dHB60bVJPNpBkz7oTcxxpnasiq7UHCkFGEz2aQ+eZHVeFROHsc6GiQccM8Di+XJUDna15DRKBhcdTTmT8Xob5Kgz4MWSckTLhnHLyEhxvKi+HxeJE0xAx181NIHP8mmdsqZU5WXcVxwtsiWto8mDOUYEFxH8+ok824p9UazwnnENWoBS5paNqMZTu6HUs//1uTsvFRUYOgGwQ8atyJOayxwZzngMSx9LK8kJgW4vW0hqyAHVkhXA7FZXHYt0bAguGvwkSMLW3nUNnCo9erhYVIvVnrCyQxcoghQo+n3yaqZdcZe4X5BPynCy/kAI5LMzrR4NGwxvSMOEpPF/mwckjm1caZEJcMnSEYVWTx3Bpah/wOE/Shhtb+JjHGy8VVL9CI4WLfPGgKj8KnhZX4iZxNexGi4PCkIeGIX/B77Fi5HqmGeiQF2eDWDc1oba5uppM2D7wphUwmgm9JXGxc9ac1rjfHHy9DKGnf3hATyDhSUqlHksXIJftQU0sYuVeFd4r2o7h7xsNxsQmVi3dXpWbFVGNweyOqtWbs3pyNG/py0ZkyBz29AQeczUGauJuD0+EE6ouhc9QGvPGkGF6/L4hoKNBNSLDmYs1qO56Z3o3wzi2YOivQ2OGDbC/CQ41oqS+y0nkjiLQMzS3WwZ/c3AN/yE+wfRvB0T0bkDylG48n80oV48e5XqhVqsuZ7IF4KFNcnSex5p3deGeOgD4//c3LdM8S3iyJQWyclEnPIf4gTE7HKgG+hVWO4FtEgQCRvQGc/T1wvcWAJpUk4a8g8t3oaG3FjjWfordPxOPpbryXRzjbPAQNlYdyuUAaZd6FemX9MzeZ6xRVajJjWadQERXlpajMPURKVYMhOsKkKgt47Qj02Btx7OA++Ij5xSA1OggWJBB5OxydpBmTh3bYrBtOV1adq0mYa8u/jBh4WXJc8syO9vqMurL99tjBUz5MI93vnakGZyJ44i/Fx68dxZjwHoy/KxyHMjkEu3klrZc1G2kpb8fT0wR46L58ckDBD4kDCRElXIT7dpmQmOLNCWg2WeuXuVuuizxJ5/MKg9usVjTUNilZZEazBu2NnQg2K4ygYbJIiVnTK7F3tU8dnUJmdcpkIH4URNkLl5ONKfJg7NxZ8NZ/jB5/EHTymVrMUwPF4ZdrhMiEQUS4KeuFw1EzFo1rxY2GEGSHjcDU+U9jz6uPIKitD64gHkP0p1ChDkk8Hem60hZTsuR7a2jKsClPZrbdtzXGhpq4YOx8/X6ERCQhOlZCXAyH5AQOx0b68DyZ5o/v3m/wBN9qMMRNxLJ9u/DHuV4MD21EvUZGDBnJMY0bGN+e0do8G5luppdp4RWBzYR1nlXCYzs0yGqPUzIp35y5E7+MJ4FvVCm5mOuLJKwnMXtSHAuLKSSvrs/JNBpLTDGwzLluLw9zwVckVGTwkwQcaiT4RbA0q17CxpOpSIj1ZfZPtWFxxL7zcwfo5VaHGULx5wMcnuPeVRicpS8x2llxQMIX9QlIHDzac/TIpg9EUWX4oZic7lhaf6DNckvlKdLcBz+Ef8jRAFzoOw51y5MobrwHG9/7K+HbENiavEgez+FnuyJY//av+9wuL0lzZkY2nE1EjDa77LZzxvlwtKaLJJpYtgdqj4GePZYYqJKEiAcSaZKOyg/wyRv70ed0Ky2ifH4OcRoJVjuU7idtDUyjcOGX1iQsjCHto2/sc7td7HsfCkrb43ao7SuwY7WEdJsGox9dSXjtCRT8XY3Fc0k0SAFUNiqBHtt/On2UbGRi/F7i9r+X+fG7IyakjpiOqrKD64ihVUooDLwhOsSvCAkWodi2fhMSag5j7mgVqlsjMHIq4UqCnFtK3WZJ8usYjicm/FmLrQnXXS9DMiWQdhCw64s9aF7zKkbHixhz6x3IqQOmGWvQHDL7IXqfhwZmqg90fC9n6nLYp7NhFVLiREjz/gdT/B60Hj+IIJUEbbIeG0764HZ2QVYj8mI+gYG0mGIJMylDJ897atN2w98eqIPVIkAfXwGTya34ixlyGjcR+KzAi3dvUuGOjZmwpF6PPa0T8NudOQjT8CjrCkFNTxi6e5z0HbvSf+50Lk9RKynyLh/q3VFKDoUqOIoEWESJua/+m/DI9Jt/kWUdMcdUqexPoT0KCBsKXbSmRNPZmHns6Ld5dO9hdO9NRDO18XEpDQu2u+JujmmAka5b0OJDtThDGeekDdK0RRrbNpcU7s5i55zOSzhf0LHuRGaT5b5NbVPWlm3KxSiThJy2UBQ5zEiKHwxTpHNrwZFN64jBw+n9Zf5gTE4PuCpt6Ogl929pG783uBTCsHjanGZWbEc3Ttj2vbcRzDKh6K2OMUrYfYI0Qcxw1FbnsVG6TKJlna9Rps4MTA4927IhkzD/xQOG9F6vDWPGhyEtfSZh+tnw6jJImCxBxYGt8El6OFw8Xh7tRpiOU1Toz7+QYYwIdzdU9bgI+xsHokmY5GTSlfBh/suHuPTNaUE42qwCV+PG2KVL4eQbsHalBktmywrGkP/ZLkyJuauZVifT6pUDPHbakhEfl4ykwVJuaeG3HzBNyVL6OE6qIEE2Y2wKp9QN9/RJEIuzceM0rTLIL1Hsgpq0zNGGgKUREhI6aP+e1Zh03cIHbouuQ4jIwZ06Cd/+fS8K338dv7nLqGgqvnIXpqWpkN/pQYtbmQvWiat4EHGlkpDhdj5IAsxIZgoJQ5mVRJbtQ1GJDzeP5eEmZmcYdKXNHdXvS7jgvPDLN4xUfCaj28Om1606vB+L5vLo5FgTSB5bNnKYli4hhLTxzXcSE34AbFvgxL2b9kIXORHFwfNZkozNr+mt5eWemqhI/b3Plni5s9MGVILKqVKr2zxee4k+tK+9w1ZX2lSb3cmKdOprix7OmHpX2gkM+6nX5xmrhqOg6WTJzhN2WxftH0fMyjroBgQo23eBj09IGb88t3f405ybl1SRqm5dT3t2ZcmujRwvaFkCFlNo9POrS9XrE+2ti4o02+24/eW9Pr/Rb+i1R8qth2qO7zuujPAiPErnbcQVxsnF77vxJHHTjYlT5dUlO/Cf0wWl8wrDqDmH68GzhnX9DJAUJuNv1azNsvqQu8/pEQJzqUsuliBwLljx/0RlHldr0uxB1LTbYLIQcfVUKKmVvLcaJ1u1GB/hRyyZcJ+RMbFoKvDYP4iyQm+Eo6niLwQLmFez63KahF3XEjMElthU5r1e0GWaWX3Hh/uxOEPGjXfOwhdfVwHZG/DMFJkkNB/IVjtdJ0pP802lDJYkZFcPQUx0XG+0v2VNReH2PXT9YBJqWiIQkvzyrkDduKAUJIisjPaNu/DAFJXSoDJYJaO8XVLWOXYqEnFJIZ4W1otUEJRUi/puEjhaGa6Pn0NMGzDvHoNy+TanhANWGV9WaNAkpiNIbPuInpNNgB1Dn6Krw+ZyQUSEBW9lleCRW0fDzxJN6NXareVIG66FWe7DsCg/XiDEptUEu/oF9QWZfCDjreldWSOMxmXvlMct+9noJohaEa+t8SO1m4du1Cz4uWzS7C5opnjRXq/GlntcWL5vJ76pSYCgjTSrRdGsCw4Z7urp+HNV2ZG/iioV84WMOZ3iy5JP6IeD7oX1728gLcnmUzUQHRDzSjmiIH+Sl7PRQApiEu2djv6/6nyaPSunY6mKl5cW5m2NJbq6jk0UEgJzCNZeIUNtFwV+e17OV2zgxRw6n4QE30ZrNp5t9f6gTK5oGq3mtb1NoUsea2mB1xQY1unyCHg4xYPSHgE5nSJK2rj+QXu8pb8MKO9ipty/Dhbk6lhtFsPkwpa/kJlIe+WvBNf1Jbr6CK83C7CE+3Gim8O4wSKONXtRI0yB2NXEUmZriEEIeAXKXi+sSfxnWRNnfq8J1ekGezRz1/93fmPG4lP78chkuu3JAprtHLZV+fBFhRYVniScnkIWZghDWGJ4nbfNurk4ZzNrJxzMGkXS8+T2E4fnjLXi8731h4K4xfqgRsxNFeEkLJdlDayZ50hEfGyCzSja95Yf25vp8fax/kaRJOwetYdNPTF25WEcfYQWI7HFSl9zWoNxpCsRlsgYaCNVpVJrzeba2ooqekYWOum9HM6+1Gz3c77LCQd6OmoRphjigQGQrk4mzAUlyFvAhUDd6ITVHUEP6jzQ71nXXNwyOA+XXtBh4F9ujh2+7O3cejyrVWF+FGHf2T74ErNZgztiUw7T6e9upwcnCmU8NdeAl7oqUdNVQfCJxzvHtIbGkOufnz77/leOZH3BZqXnDtx0UejEQefsHDCEFYST9P1139NmUujzSq77b2ZyZYbajgKHeQnX7ARGBzwcrBLp3eogTDL78GRqHzwJAmoIu/+u0pvcL77zL7TpLI/4Qpsucip8XSWh1anC3JIu+EcFKdcoLNKg3MkhUs/hOrMfFtJyu6tlaAgPnSgtYiG6EFp56/naZGCaRKqB5J0wOCHp3jXtoWtf/7xNcZKpVGqER0Qp/cGNHY27fKwQGJxot1XbrJWt7fSdILJUCNJzu8/P5DtjrUi+pxNS0uXlpTFP/irbodwPSzDSherqItC8uzh/ayYbKEDysI4+zXRWG53cZggOSeSTJtaNXdsMg8GEYK3OpdbxtZFye3ZV8bfMatCwD+vUSveUdbmSxAv1x7+Y8O041T7+xfENuDMFcMaNgSh5sHfnMdhK3TAlqRAaLioOp9TgFtj5CUP7BcdFiykG1uNdhk4bdP/6hlFrSjefwNs3uUmDk/UidYInAiguJmvRMx5JoxKRtHAUwQcTZHUUUklHN1Q24raXFuE35RUI1U14iRZ7Fj/CQ7xK63QFiYHqMdTTz3ifkq+7dGQfWn088ho4TIzxY2O5ALVa1dfPWfr+CqhzJFhYuAWBlMXzpqSC+92Bnjkvnardj1tHuuAPRDRQVycqfcK+JUPqJKHu25Ik7LUSXtMG97J+6vQpwQDLKC9RfbcuIixsXWR4xKQ2mzXN3ecaXVm4o6A/JZdBgXa69xzigx4xAEPcZ8ODi/EXacOnos1Rb+m1QakMo3ecPN55wt7aRkJCTcJJ7MdwbecJHmtIiJ4fmkIqvTq/pqGq/nbWkJIlFdE5zOw8dr7VcunkF/+AnG70/uM5IcidVS8HzYvzKGm8nW12HPx4Ff5wN8EeyYX9tTxL8oXn3Nx5+6UEx0AmtrDuMIlxSR02b+Kax77eHrH6Dhd6g1UQUn0oLnJhjnAEuqZDkLf50QIT+DAzbERZp8qOITVJA11jBBqsJSxtgCUIFVxj8u9msVcFa7XIaZQwxkA0niQrWnYlafI0vhe3jALu/9qCDs0oOO0n32dljnTWMJzXb0uZxZW57iKSXV4aptd5C06Evsy7Tym1eGyVLkcAHmhDeCSr3Oii03a3pyLU2M20mupCIZzzzcWzPfmXNmulbDonu7mxQt9fh83hCsv+LrBuJf2obGos+5Z5X0Wlqu8yQkJWjoMM9ZA2/IKEgjwAoXIBLe5HxqTblSYclztY5DjeuQfL7x8Ezy1LlBHWHy17F0/fwClmMbNQZsVLyIiSMGOtGdGDHKUBMYzgfxXmV6rNA4VRGhU/94QwIf+9o0ewiCVKDvch9zCPh+5S+tiTRSkimQ1J8XYhkey3oxYt7tmoR+qI2M7C3K1Foihe92Nkcv6q8LgsdcTGJOQ/sUuPINZNqS1UiR27SN1uO86uIqOwMwxkzi5vqDtWyKZjfBdnDCdL612ihYQJkZxtOOFAP07ZeQX5eXxQppY+v0eDyNhhdceL967tj8M7LkdgvHAlso4JFb67vzdX69V4f4EKb95DH1v/e7kShrV/FwY/3XKIpSh7PL2X/bj6evHMBC+0cx6GGJuCT/60GterC2EhE10rSggOkpBL+zJ/ow7xgyd01FbnbWLhwgF47C+S6npBk+ooWT5vvl8eh5pOH4RNQVh5jxqt3RJ+8XUQkj6Kx4M7IvDgdhMyVsXjiewMDB05q768OPPXAmt9e1723TVNfuUZcNeHWMY43svPwqO8GxLJb1evjMFGWanrEDkJgQw3JaTw+ncUJtWx0XEkTKzpuSktqOwhE4E/SYRKCMHVC30S4TB+JLim8rW0qcF0HRZCqhoYgXE/qo1nDJ4+ad6ZhgWXz4kQ8MoRHZ4T/gRLQjJSGmsxdbga0z8iKRM0nNS1A4I2Cua46Pryol2/Z5lzJLScAxGEA56/FoBOT8UkjLrz/h1y3KzoTmg4Jw62x0JjHmOLl1v/0cIPimPtDfQGV2u3w1ZXmJ1j5f9JC+uuMfn3Mzu7I4zhy94usSx7aFwbhtkE9IX1Yd50AV8WemG2xKGh4iDrznHq+1xHLYqzVKa07uzabIzprcH1MWpkV/qxMANYuEVDBBhlLcw5Uk5mL0s8+GwgBHYocz1GjbvxR7XxTJOzGm9uoMqN4yb1Rs1+6/Gs+glhWW1ICDXg+dxgmJPTgI76FSq1OaK7y1ZflJ1TR0zFwj7Mq79hYEtf3gl6NjaE5IuPTxn/QJXM3+f3+4cFRfScrDm+bzWLJdMX9jEYSGuGKBPcRWU6Xz0uUQR1jcmvzEG1nKTsfy3assewar6EQaEydlb48OeiBERG+zL7WHxcEL3fExr0hBvDa36/z5fy21kiplrcmJ0ALN7gh2yejEZr0fsCr5hmpZfC4+drc+YP+LEdV9RgRJZzOMk7MTE+eTAw5JbG7o6bQo0+T1Xpvm8Zc7HpysRUW4ipWON69t6t/8Y7Z7S2SiVwq/IPKfHkCbR/g2gfHf1+HgeuHf8eJldi5hrNDXU9Gbl3fn4InbDAG5xIDK7PLC3c9RGLGQ/U83tpbc6/44m/7ZfPHutO7twXaN1jibTA73Z82GGrbxYEgV3nwIChBjF40dFvMH7CvGsUcVlBLlULAv9G2bG9b5C1FE0aO4aYi+vfV/fV8lMM1D/SH0/OxSWGJlxj8quuHaS8SJP5VpjufsUE+Yj1RIHt+ImcOtZvmpiRVUPlXYWLrCCtssJkNEIN7/yens6MlobSU44uWydJdH1/KynPwB1fXECTc9w1ihgwc7GOLAKrMmu+9j5+ZEzeL+7ZyIdtjHnaW+umiqy7ADgWKmq4yhKF/fMlMeeX3Q6bIeBBVbSJ/drWXjuuHYHj/wUYAHXuysHUbVI2AAAAAElFTkSuQmCC"/>
		<p id='OA'></p>
	</div>
</div>

		</div>
		<div style="position:absolute;bottom:0.25em;width:inherit">
			<div style="position:relative;display:-webkit-box;-webkit-box-align:center">
				<div class="w0" style="-webkit-box-flex:1"></div>
				<div id="KP" style="-webkit-box-flex:3;width:auto;height:6px">
					<div id="rr" style="width:0;height:100%"></div>
				</div>
				<div class="Um" style="-webkit-box-flex:1"></div>
			</div>
			<div id="l4"> </div>
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
Zz = window.Zz || {};
Zz.s4 = function(Jw) {
    if (Jw instanceof Object) {
        Zz.ZP(Jw, function(wT, lO) {
            var eH, Zc;
            Zc = lO.split(".");
            eH = Zc.shift();
            Zc = Zc.join(".");
            if (Zc) {
                Jw[eH] = Jw[eH] || {};
                Jw[eH][Zc] = wT;
                delete Jw[lO]
            }
        });
        Jw = Zz.Ev(Jw, Zz.s4)
    }
    return Jw
};
Zz.BZ = function(DG, G2) {
    for (var tZ in (G2 || {})) {
        DG[tZ] = G2[tZ]
    }
    return DG
};
Zz.I9 = function(DG, G2) {
    for (var tZ in (G2 || {})) {
        DG[tZ] = (tZ in DG) ? DG[tZ] : G2[tZ]
    }
    return DG
};
Zz.BZ(Zz, {
    ZP: function(DG, H6, Nf) {
        for (var tZ in DG) {
            DG.hasOwnProperty(tZ) && H6.call(Nf, DG[tZ], tZ, DG)
        }
    },
    R5: function(DG, bo) {
        return "?".concat(Zz.oT.apply(this, arguments))
    },
    oT: function(DG, bo) {
        var q9 = [];
        Zz.ZP(DG, function(iP, pY) {
            (!bo || bo.indexOf(pY) >= 0) && q9.push(encodeURIComponent(pY).concat("=", encodeURIComponent(iP)))
        });
        return q9.join("&")
    },
    a7: function(DG, bo) {
        var q9 = [],
            pY = -1,
            O4 = bo.length;
        while (++pY < O4) {
            q9[pY] = encodeURIComponent(DG[bo[pY]])
        }
        return q9.join("/")
    },
    FM: function(pY) {
        return Array.prototype.slice.call(pY)
    },
    TF: function(cP, Wl) {
        var bJ = function() {};
        bJ.prototype = cP.prototype;
        var q8 = new bJ();
        cP.apply(q8, Wl);
        return q8
    },
    Rr: function(DG, H6, Nf) {
        var q9 = [];
        for (var YI in DG) {
            DG.hasOwnProperty(YI) && q9.push(H6 ? H6.call(Nf, DG[YI], YI, DG) : DG[YI])
        }
        return q9
    },
    y4: function(DG, zc, Nf) {
        var nh = "";
        for (var YI in DG) {
            DG.hasOwnProperty(YI) && (nh += zc.call(Nf, DG[YI], YI, DG))
        }
        return nh
    },
    Ev: function(DG, H6, Nf) {
        var nh = {};
        for (var tZ in DG) {
            if (DG.hasOwnProperty(tZ)) {
                nh[tZ] = H6.call(Nf, DG[tZ], tZ, DG)
            }
        }
        return nh
    }
});
var xb = function(Ht, cj) {
    this.Ht = Ht;
    this.cj = cj
};
Zz.BZ(xb, {
    xv: function(WR, j0, M0) {
        return (!j0 || WR.source === j0) && (!M0 || WR.origin === M0) && WR.data.indexOf("com.igt.game:") === 0 && Zz.TF(xb, JSON.parse(WR.data.substr("com.igt.game:".length)))
    },
    jn: function(O3, M0, Ht, cj) {
        (new xb(Ht, cj)).jn(O3, M0)
    },
    IF: function(O3, Ht, cj) {
        xb.jn(O3, "*", Ht, cj)
    },
    N_: function(Ht, cj) {
        xb.jn(window.parent, "*", Ht, cj)
    },
    m7: function(Ht, cj) {
        xb.jn(window, xb.M0(document.location.href), Ht, cj)
    },
    M0: function(VF) {
        var Zv = document.createElement("A");
        Zv.setAttribute("href", VF);
        return [Zv.protocol, "//", Zv.hostname, Zv.port > 0 ? ":".concat(Zv.port) : ""].join("")
    }
});
Zz.BZ(xb.prototype, {
    toString: function() {
        return "com.igt.game:" + JSON.stringify([this.Ht, this.cj])
    },
    jn: function(O3, M0) {
        try {
            O3.postMessage(this.toString(), M0)
        } catch (dR) {}
    }
});
wS = function(j0, M0) {
    var hq = {},
        bP = 0,
        ai = function(WR) {
            var UT = xb.xv(WR, j0, M0);
            UT && UT.Ht && hq[UT.Ht] && hq[UT.Ht].forEach(function(oU) {
                oU.call(void 0, UT.cj)
            })
        },
        EQ = function(oU, Ht) {
            this.TW(Ht, oU)
        },
        M0 = M0 && xb.M0(M0);
    var TW = this.TW = function(Ht, oU) {
        var t5 = hq[Ht];
        if (!t5) {
            t5 = hq[Ht] = [];
            bP++ || window.addEventListener("message", ai, true)
        }
        t5.indexOf(oU) >= 0 || t5.push(oU);
        return this
    };
    var v8 = this.v8 = function(Ht, oU) {
        var tZ, t5 = hq[Ht];
        if (t5) {
            tZ = t5.indexOf(oU);
            tZ >= 0 && t5.splice(tZ, 1);
            if (0 == t5.length) {
                delete hq[Ht];
                bP--
            }
            bP || window.removeEventListener("message", ai, true)
        }
        return this
    };
    this.gU = function(hq) {
        Zz.ZP(hq, EQ, this);
        return this
    };
    this.fz = function(hq) {
        hq = {};
        window.removeEventListener("message", ai, true);
        return this
    };
    this.bi = function(UT, cj) {
        xb.jn(j0, M0, UT, cj);
        return this
    };
    this.qU = function(UC, TA) {
        var i2 = UC.length;
        UC.forEach(function(WR) {
            TW(WR, function oU() {
                v8(WR, oU);
                --i2 || TA.apply(void 0, arguments)
            })
        })
    }
};
var Zh = Zh || {};
var xU = (function() {
    var Cx, Nv, zr, Q4, f7, fY = function() {
            xb.IF(window.parent, "loaderror")
        },
        K8 = function(jl, JN) {
            JN = JN.split(";")[0];
            return jl === JN || jl === JN.split("/").concat("/*")
        },
        Va = function(XA, Ht) {
            return XA[Ht] || XA[Ht.replace(/\/.*$/, "/*")] || XA["*/*"]
        },
        LN = function(VR) {
            var ZW = this,
                Q4 = new XMLHttpRequest();
            Q4.onreadystatechange = function() {
                if (this.readyState == 4 || this.readyState == 0) {
                    if (this.status === 200 && K8(ZW.Ht, this.getResponseHeader("Content-Type"))) {
                        Va(pB, ZW.Ht).call(ZW, this.responseText);
                        delete this.onreadystatechange
                    } else {
                        delete this.onreadystatechange;
                        ZW.Jm()
                    }
                }
            };
            Q4.open("GET", ZW.VF, true);
            Q4.send(null)
        },
        pX = {
            "text/javascript": function(VR) {
                var KH = document.createElement("SCRIPT"),
                    ZW = this;
                KH.type = this.Ht;
                document.head.appendChild(KH);
                KH.onload = function() {
                    delete KH.onload;
                    ZW.Lv();
                    document.head.removeChild(KH)
                };
                KH.onerror = ZW.Jm;
                this.VF = VR + this.VF;
                KH.src = this.VF
            },
            "application/json": LN,
            "*/*": function(VR) {
                console.error("Loader: No load handler for type " + this.Ht);
                this.Lv()
            }
        },
        CX = {},
        pB = {
            "application/json": function(Xh) {
                this.gC = JSON.parse(Xh);
                this.Lv()
            }
        },
        LF = function(Mk) {
            var Jv = {},
                Rx = 0,
                JJ = 6,
                mG = function(XA, Ht) {
                    var g_ = Ht && Ht.replace(/\/.*$/, "/*");
                    return Ht in XA ? Ht : g_ in XA ? g_ : "*/*"
                },
                KW = function(ZW) {
                    if (f7) {
                        return
                    }
                    var Nv = ZW.Nv && ZW.Nv.split(",") || [];
                    ++Rx;
                    ZW.Lv = function() {
                        --Rx;
                        if (!Jv[ZW.qZ]) {
                            xb.IF(window.top, "progress");
                            xb.m7("load", ZW);
                            Jv[ZW.qZ] = 1;
                            Ku(ZW.Ht)
                        } else {
                            console.warn("Loader: n8 reloaded " + ZW.qZ)
                        }
                    };
                    ZW.Jm = fY;
                    ZW.VF = ZW.VF.concat(X8);
                    Va(pX, ZW.Ht).call(ZW, Va(Cx.assetBaseUrlMap, ZW.Ht) || "", LN);
                    Ku(ZW.Ht)
                },
                Ku = function(Ah) {
                    var ZW, SQ = CX[mG(pX, Ah)];
                    if (Mk.length == 0 && Rx == 0) {
                        xb.IF(window.parent, "loaded")
                    } else {
                        if (Rx == 0 || SQ && Rx < JJ && SQ.indexOf(mG(pX, Mk[0].Ht)) >= 0) {
                            KW(Mk.shift())
                        }
                    }
                };
            xb.IF(window.top, "queue", Mk.length);
            Dg.TW("start", function() {
                Dg.v8("start", Ku);
                Ku()
            })
        },
        EO = function() {
            Q4 && Q4.abort();
            f7 = true;
            Mk = []
        },
        mt = function(UT) {
            Cx = UT.loader;
            X8 = Zz.R5(Nv, Cx.assetUrlParameterWhitelist).concat("&tag=", zr);
            tV = Cx.assetBaseUrlMap
        },
        vh = function(UT) {
            var tag = document.getElementsByName("com.igt.game.TAG")[0];
            zr = tag.content;
            tag.parentNode.removeChild(tag);
            Nv = JSON.parse(JSON.stringify(UT.params))
        };
    document.head = document.head || document.getElementsByTagName("head")[0];
    var Dg = new wS(window, window.location.href);
    Dg.gU({
        manifest: LF,
        abortLoading: EO,
        loaderror: EO,
        "mproxy.config": mt,
        "mproxy.param": vh
    });

    function qo(Ht, oU, dN) {
        pX[Ht] = oU;
        CX[Ht] = dN
    }
    return {
        qo: qo,
        Y7: function(Ht, oU, dN) {
            qo(Ht, LN, dN);
            pB[Ht] = oU
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
xU.Y7("text/css", function(Xh) {
    var Ih = document.createElement("STYLE");
    Xh = Xh.replace(/plate\(([^)]+)\)/g, function(E7, qZ) {
        return ["url(", Zh.wG[qZ].src, ")"].join("")
    });
    Xh = PrefixFree.prefixCSS(Xh, 1);
    Xh = Xh.replace(/(^|;|{)\s*border-radius\s*:\s*([^;}]+)/gm, function(match, before, values) {
        var values = values.split(/\s+/);
        values[1] = values[1] || values[0];
        values[2] = values[2] || values[1];
        values[3] = values[3] || values[1];
        return before + ["border-top-left-radius:" + values[0], "border-top-right-radius:" + values[1], "border-bottom-right-radius:" + values[2], "border-bottom-left-radius:" + values[3]].join(";")
    });
    Xh = Xh.replace(/((?:(?!;base64))[{};])/gm, "$1\n");
    Ih.Ht = this.Ht;
    Ih.appendChild(Ih.ownerDocument.createTextNode(Xh));
    document.head.appendChild(Ih);
    this.Lv()
});
RW = {};
var Jr = (function() {
    var bs = [Date.prototype.getDate, Date.prototype.getMonth, Date.prototype.getFullYear],
        Ez = "/",
        tH = [Date.prototype.getHours, Date.prototype.getMinutes],
        IW = ":",
        Ci = {},
        ZL = {},
        YW = function(qZ) {
            var YI, UT = Ci,
                NP = qZ.split(".");
            while ((YI = NP.shift()) && (UT = UT[YI])) {}
            return ZL[qZ] = UT
        },
        Bv = function(Zr, nl) {
            var pY = nl.length,
                HT;
            while (pY--) {
                HT = String(nl[pY].call(Zr));
                nl[pY] = HT.length < 2 ? "0" + HT : HT
            }
            return nl
        };
    iJ = function(qZ) {
        var UT = ZL[qZ] || YW(qZ);
        UT || console.warn("No message with id " + qZ);
        return UT || qZ
    };
    gQ = function(qZ) {
        return iJ(qZ).substitute([].slice.call(arguments, 1))
    };
    rh = function(Zr) {
        return Bv(Zr, bs.slice(0)).join(Ez)
    };
    Ix = function(Zr) {
        return Bv(Zr, tH.slice(0)).join(IW)
    };
    var Xy = function(vB, lO) {
        Ci[lO] = vB
    };
    var W7 = function(vB) {
        for (var lO in vB) {
            Xy(vB[lO], lO)
        }
    };
    var rY = function(qZ, vB) {
        ZL[qZ] = vB
    };
    return {
        W7: W7,
        Xy: Xy,
        rY: rY,
        fZ: function(qZ) {
            return ZL[qZ] || YW(qZ)
        }
    }
})();
F9 = (function() {
    var EG, fb = new wS(window);
    bp = function(qZ) {
        return Jr.fZ(qZ + "." + EG) || Jr.fZ(qZ + ".default") || Jr.fZ(qZ) || console.warn("No message with id " + qZ)
    };
    fb.TW("mproxy.param", function(UT) {
        EG = UT.params.countrycode.toLowerCase();
        fb = void 0
    })
})();

function iG() {
    window.scrollTo(0, navigator.userAgent.indexOf("Android") > -1 || navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/) ? 1 : 0)
}

function IA(WR) {
    if (document.activeElement && document.activeElement.hasClass("xM")) {
        return
    }
    if (!event.target.form) {
        document.activeElement && document.activeElement.blur();
        WR.preventDefault()
    }
    WR.type == "touchstart" && iG()
}
document.body.addEventListener("touchstart", IA);
document.body.addEventListener("touchmove", IA);
document.addEventListener("touchstart", IA);
document.addEventListener("touchmove", IA);
var OE = (function() {
    function hD() {
        if (cK) {
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
        if (F7) {
            setTimeout(xH, 500);
            F7 = false;
            cK = true
        }
    }

    function xH() {
        ZX()
    }

    function ZX() {
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

    function Ge() {
        var WR = document.createEvent("HTMLEvents");
        WR.initEvent("orientationchange", 1, 1);
        document.dispatchEvent(WR)
    }

    function LH() {
        var WR = document.createEvent("HTMLEvents");
        WR.initEvent("resize", 1, 1);
        document.dispatchEvent(WR)
    }
    var SR = navigator.userAgent.match(/\s+7_[\d_]+\s+like Mac OS X/);
    var wn = navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/);
    var va = navigator.userAgent.match(/\s+9_[\d_]+\s+like Mac OS X/);
    var E4 = navigator.userAgent.indexOf("like Mac OS X") >= 0;
    var Ry = navigator.userAgent.indexOf("Android") > 0;
    var H7 = 0;
    if (navigator.userAgent.indexOf("Chrome/") > -1) {
        H7 = navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome/") + 7);
        H7 = parseInt(H7.substring(0, H7.indexOf(".")))
    }
    var Lr = Ry && !H7;
    var SF = wn || (!E4 && !Lr);
    var oE = "orientationchange",
        Nh = "resize",
        K_ = ["LU portrait", "Oj landscape"],
        SP = NaN,
        Mv = NaN,
        RM = NaN,
        e_ = NaN,
        Ir = NaN,
        Ab = null,
        mq = 1,
        P6 = 0,
        Ti = null,
        fb = new wS(window),
        F7 = false,
        cK = false,
        tO = function(HB, k7) {
            var iM = HB.className;
            var qr = new RegExp("(?:^|\\s+)" + K_[0] + "(?=\\s+|$)", "gi");
            var TS = new RegExp("(?:^|\\s+)" + K_[1] + "(?=\\s+|$)", "gi");
            var lM = new RegExp("(?:^|\\s+)" + k7 + "(?=\\s+|$)", "gi");
            k7 = " ".concat(k7);
            HB.className = iM.replace(qr, "").replace(TS, "").replace(lM, "").concat(k7)
        },
        Iz = function() {
            return mq
        },
        qY = function(Dj) {
            P6 = Dj
        },
        vq = function() {
            if (Mv != SP) {
                e_ = K_[Mv == 90 ? 1 : 0];
                window.ZQ && ZQ.hS();
                tO(document.documentElement, e_)
            }
            document.body.offsetWidth;
            var WR = document.createEvent("Event");
            WR.initEvent("com.igt.events.orientationchange", false, false, null);
            WR.orientation = Mv;
            window.dispatchEvent(WR);
            setTimeout(function() {
                Ab && PP()
            }, 0)
        },
        d6 = (function() {
            if (navigator.userAgent.indexOf("like Mac OS X") >= 0) {
                return function() {
                    Mv = Math.abs(window.orientation);
                    vq(Mv)
                }
            } else {
                if (navigator.userAgent.indexOf("Android") >= 0) {
                    return function() {
                        var iX = screen.width,
                            Dy = screen.height;
                        Mv = SP;
                        if (window.hasOwnProperty("orientation")) {
                            Mv = Math.abs((window.orientation) % 180)
                        } else {
                            if (Ir != iX) {
                                Mv = Dy >= iX ? 0 : 90
                            }
                        }
                        vq(Mv);
                        Ir = iX
                    }
                } else {
                    return function() {
                        var iX = window.innerWidth;
                        Mv = Ir == iX ? SP : window.innerHeight >= iX ? 0 : 90;
                        vq(Mv)
                    }
                }
            }
        })(),
        aX = function() {
            if (navigator.userAgent.indexOf("Android") >= 0) {
                var iX = screen.width;
                var Dy = screen.height;
                Mv = Ir == iX ? SP : Dy >= iX ? 0 : 90;
                vq(Mv)
            } else {
                d6()
            }
        },
        pf = function() {
            if (navigator.userAgent.match(/Android/)) {
                var hR = screen.width;
                var ES = screen.height;
                if (document.documentElement.offsetWidth != screen.width && screen.width != (document.documentElement.offsetWidth * window.devicePixelRatio)) {
                    Mv = (hR >= ES) ? 0 : 90
                } else {
                    Mv = (ES >= hR) ? 0 : 90
                }
                vq(Mv);
                SP = Mv;
                RM = e_;
                Ab && PP()
            } else {
                Ge()
            }
        },
        ed = function() {
            var Dy;
            if (document.querySelector("meta[name='com.igt.game.AUTOSCALE'][content='yes']")) {
                Ab = document.createElement("div");
                Dy = Math.floor(document.documentElement.clientHeight / 4);
                if (SR || wn) {
                    Ab.style.position = "fixed"
                } else {
                    Ab.style.position = "absolute"
                }
                Ab.style.bottom = -Dy + "px";
                Ab.style.right = "0";
                Ab.style.width = "1px";
                Ab.style.height = Dy + "px";
                document.body.appendChild(Ab)
            }
        },
        r_ = (function() {
            var qv = document.createElement("div").style,
                Af = "transform",
                p0 = "transformOrigin";
            iI = "transitionDuration";
            ["WebkitTransform", "msTransform", "MozTransform", "oTransform"].forEach(function(YI) {
                Af = YI in qv ? YI : Af
            });
            ["WebkitTransformOrigin", "msTransformOrigin", "MozTransformOrigin", "oTransformOrigin"].forEach(function(YI) {
                p0 = YI in qv ? YI : p0
            });
            ["WebkitTransitionDuration", "msTransitionDuration", "MozTransitionDuration", "oTransitionDuration"].forEach(function(YI) {
                iI = YI in qv ? YI : iI
            });
            return function(hE, iN, NQ) {
                hE.style[Af] = iN;
                hE.style[p0] = "0% 0%";
                if (NQ) {
                    hE.style[iI] = "1ms"
                }
            }
        })(),
        TD = function() {
            return ["body", "iframe"].indexOf(document.activeElement && document.activeElement.tagName) >= 0
        },
        PP = function() {
            if (TD()) {
                return
            }
            var YZ = document.getElementById("Loader") || document.getElementById("game");
            if (!YZ) {
                return
            }
            if (YZ && Ab) {
                var Oa = Ab.offsetLeft + Ab.offsetWidth;
                var bQ = Ab.offsetTop;
                if (wn || va || SF) {
                    Oa = window.innerWidth;
                    bQ = window.innerHeight
                }
                if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && !SR && !wn && !va) {
                    if (bQ > Oa) {
                        if (bQ < 360) {
                            bQ = bQ + 60
                        }
                    } else {
                        if (bQ < 250) {
                            bQ = 268
                        }
                    }
                }
                var nM = 0,
                    M7 = 0;
                if (YZ.offsetWidth) {
                    var oo = YZ.offsetWidth;
                    var m6 = YZ.offsetHeight + YZ.offsetTop;
                    var gX = bQ / m6;
                    nM = Math.floor((Oa - (oo * gX)) / 2);
                    if (oo * gX > Oa) {
                        gX = Oa / oo;
                        nM = 0
                    }
                    var gX = (Oa - 2 * nM) / oo;
                    if (!!OE && OE.iR) {
                        M7 = Math.floor((bQ - (m6 * gX)) / 2)
                    }
                    if (P6 > 0 && gX > P6) {
                        gX = P6
                    }
                    mq = gX;
                    var vA = document.getElementById("game");
                    var VQ = document.getElementById("g5");
                    var iN = "translate(" + nM + "px, " + M7 + "px) scale(" + gX + ")";
                    r_(YZ, iN, navigator.userAgent.indexOf("Android") == -1 && navigator.userAgent.indexOf("like Mac OS X") == -1);
                    vA && YZ != vA && r_(vA, iN);
                    VQ && VQ.parentElement == document.body && r_(VQ, iN)
                }
            }
        },
        pL = function() {
            window.ZQ && ZQ.e4();
            document.body.offsetWidth;
            Ti = Ti || document.getElementById("V6");
            if (Ti && Ti.offsetHeight < document.body.clientHeight / 2) {
                setTimeout(iG, 0)
            }
            iX = screen.width;
            SP = Mv;
            RM = e_
        },
        W2 = function() {
            if (Mv != SP) {
                window.ZQ && ZQ.e4();
                document.body.offsetWidth;
                setTimeout(iG, 0);
                iX = screen.width
            }
            SP = Mv;
            RM = e_;
            Ab && PP()
        };
    window.hasOwnProperty("orientation") || (window.orientation = 0);
    window.addEventListener(oE, d6, true);
    window.addEventListener(Nh, aX, true);
    fb.TW("initialised", pf);
    window.addEventListener(oE, W2, false);
    window.addEventListener(Nh, pL, false);
    if (document.querySelector("meta[name='com.igt.game.RESIZEKICKER'][content='yes']")) {
        window.setInterval(LH, 500)
    }
    if (navigator.userAgent.indexOf("SAMSUNG") != -1) {
        F7 = true
    }
    document.addEventListener("touchstart", hD);
    document.body.addEventListener("touchstart", hD);
    ed();
    pf();
    return {
        Iz: Iz,
        qY: qY,
        Ge: Ge,
        LH: LH
    }
})();
(function() {
    var v4 = 1,
        mI = 0,
        Dg = new wS(),
        qZ = function(qZ) {
            return document.getElementById(qZ)
        };
    Dg.TW("progress", function() {
        var hM = qZ("rr"),
            Uw = qZ("U5"),
            X5 = Math.max(0, Math.min(100, Math.round(100 * ++mI / v4))) + "%";
        hM && (hM.style.width = X5);
        Uw && (Uw.innerHTML = X5);
        if (mI >= v4) {
            xb.m7("initialise")
        }
    });
    Dg.TW("loaderror", function(UT) {
        var Kr = qZ("Hz");
        Kr.firstChild || Kr.appendChild(document.createTextNode(iJ("mproxy.Error.loadFailed")));
        Kr.parentNode.style.visibility = "visible"
    });
    Dg.TW("splashMessage", function(UT) {
        var NM = qZ("l4");
        NM.firstChild.insertData(0, UT + "\n")
    });
    Dg.TW("initialised", function() {
        var Ob = qZ("Loader"),
            ML = qZ("mn"),
            h5 = qZ("game");
        Ob && document.body.removeChild(Ob);
        ML && document.body.removeChild(ML);
        document.body.className = document.body.className.replace("Fz", "");
        document.body.offsetWidth;
        delete Dg;
        xb.m7("visible")
    });
    Dg.TW("queue", function(cj) {
        iG();
        v4 += cj
    })
})();
var qO = function(E3) {
    var vL, G6 = function() {
            try {
                window.localStorage && localStorage.setItem(E3, JSON.stringify(vL))
            } catch (e) {}
        },
        UR = function() {
            vL = JSON.parse(window.localStorage && localStorage[E3] || "{}")
        };
    UR();
    return {
        xC: function(DG) {
            vL = $merge(vL, DG);
            G6();
            return this
        },
        Xv: function() {
            return $merge(vL)
        },
        I9: function(DG) {
            vL = $merge(DG, vL);
            G6();
            return this
        }
    }
};
(function() {
    var B9, MJ, LB, GA, h5, fb = new wS(window),
        qZ = function(qZ) {
            return document.getElementById(qZ)
        },
        gv = function(UT) {
            var Ky = document.createElement("title"),
                NM = qZ("l4");
            Jr.W7(UT.gC);
            Ky.appendChild(document.createTextNode(bp("title")));
            document.head.appendChild(Ky);
            var m = MJ.loader.splashMessage || "";
            if (m) {
                m = m[LB.params.countrycode.toLowerCase()] || m["default"] || "";
                m = m[LB.params.language.toLowerCase()] || m["default"] || ""
            }
            NM.firstChild.insertData(0, bp("splashScreen.footer") + (m && "\n") + m)
        },
        cM = function(UT) {
            Ue(MJ, LB, GA, fb)
        },
        Gu = {
            Qc: gv,
            h5: cM
        },
        VA = function(UT) {
            Gu[UT.qZ] && Gu[UT.qZ](UT)
        },
        mt = function(UT) {
            MJ = Object.freeze(UT)
        },
        vh = function(UT) {
            LB = Object.freeze(UT)
        },
        Gh = function(UT) {
            GA = Object.freeze(UT)
        },
        F1 = function(UT) {
            if (UT) {
                Zz.s4(UT);
                Jr.Xy(UT, "mproxy")
            } else {
                xb.IF(window.parent, "loaderror")
            }
        };
    fb.gU({
        load: VA,
        "mproxy.param": vh,
        "mproxy.config": mt,
        "mproxy.clientConfig": Gh,
        "mproxy.message": F1
    })
})();
(function() {
    var fb = new wS(window),
        Vu = {};
    Zh.SG = function(Nv) {
        function pz(wT, Y8) {
            var CM = document.createElement("input");
            CM.type = "hidden";
            CM.name = Y8;
            CM.value = wT;
            gq.appendChild(CM)
        }
        var gq = document.createElement("form"),
            Nv = Nv || {};
        Nv.playMode = Nv.playMode || Vu.PARAM.params.playMode || "real";
        gq.method = Vu.PARAM.method;
        gq.style.display = "none";
        Vu.PARAM[Vu.PARAM.method].forEach(function(bj) {
            var wT = Nv.hasOwnProperty(bj) ? Nv[bj] : Vu.PARAM.params[bj];
            pz(wT, bj);
            delete Nv[bj]
        });
        if (Vu.PARAM.method == "post") {
            gq.action = "?" + Vu.PARAM.get.map(function(bj) {
                var value = encodeURIComponent(bj) + "=" + encodeURIComponent(Nv.hasOwnProperty(bj) ? Nv[bj] : Vu.PARAM.params[bj]);
                delete Nv[bj];
                return value
            }).join("&")
        }
        Zz.ZP(Nv, pz);
        gq.submit()
    };
    fb.TW("boot", function() {
        ["PARAM", "MESSAGE", "CONFIG", "CLIENTCONFIG"].forEach(function(Y8) {
            var hE = document.getElementsByName("com.igt.mproxy." + Y8)[0];
            if (hE && hE.content) {
                try {
                    Vu[Y8] = JSON.parse(hE.content)
                } catch (e) {
                    console.error("Failed to parse injected data from " + Y8);
                    xb.IF(window.parent, "loaderror")
                }
            } else {
                Vu[Y8] = {}
            }
            hE.parentNode.removeChild(hE)
        });
        Vu.PARAM.method = Vu.PARAM.method.toLowerCase();
        xb.m7("mproxy.param", Vu.PARAM);
        xb.m7("mproxy.config", Vu.CONFIG);
        xb.m7("mproxy.message", Vu.MESSAGE);
        xb.m7("mproxy.clientConfig", Vu.CLIENTCONFIG);
        xb.m7("manifest", [{
            Ht: "application/json",
            qZ: "Qc",
            VF: "assets/strings.json"
        }, {
            Ht: "text/javascript",
            qZ: "DT",
            VF: "../MXF/MXF.js"
        }, {
            Ht: "text/javascript",
            qZ: "h5",
            VF: "main.js"
        }, ].concat([{
            "qZ": "S1",
            "Ht": "image/png",
            "VF": "assets/reelsFrameEdges.png",
            "q1": {
                "h0": [0, 0, 316, 3, 1, 1, 1],
                "Nb": [0, 5, 316, 32, 1, 1, 1]
            }
        }, {
            "qZ": "NZ",
            "Ht": "image/png",
            "VF": "assets/reelsFrameSides.png",
            "q1": {
                "gE": [0, 0, 3, 168, 1, 1, 1],
                "Ve": [0, 170, 3, 168, 1, 1, 1]
            }
        }, {
            "qZ": "Ql",
            "Ht": "image/png",
            "VF": "assets/reelsChrome.png",
            "q1": {
                "Tb": [0, 0, 155, 33, 1, 1, 1],
                "xR": [0, 35, 227, 59, 1, 1, 1],
                "WQ": [0, 96, 131, 22, 1, 1, 1]
            }
        }, {
            "qZ": "ZM",
            "Ht": "image/png",
            "VF": "assets/B01BaseGame.png",
            "q1": {
                "ZM": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "d2",
            "Ht": "image/png",
            "VF": "assets/B01FreeSpin.png",
            "q1": {
                "d2": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "JM",
            "Ht": "image/png",
            "VF": "assets/S01BaseGame.png",
            "q1": {
                "JM": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "Bq",
            "Ht": "image/png",
            "VF": "assets/S01FreeSpin.png",
            "q1": {
                "Bq": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "Pu",
            "Ht": "image/png",
            "VF": "assets/S02BaseGame.png",
            "q1": {
                "Pu": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "Bo",
            "Ht": "image/png",
            "VF": "assets/S02FreeSpin.png",
            "q1": {
                "Bo": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "X9",
            "Ht": "image/png",
            "VF": "assets/S03BaseGame.png",
            "q1": {
                "X9": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "SU",
            "Ht": "image/png",
            "VF": "assets/S03FreeSpin.png",
            "q1": {
                "SU": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "rB",
            "Ht": "image/png",
            "VF": "assets/S04BaseGame.png",
            "q1": {
                "rB": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "zR",
            "Ht": "image/png",
            "VF": "assets/S04FreeSpin.png",
            "q1": {
                "zR": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "s_",
            "Ht": "image/png",
            "VF": "assets/SBaseGame.png",
            "q1": {
                "dA": [0, 0, 56, 42, 1, 1, 1],
                "PJ": [0, 44, 56, 42, 1, 1, 1],
                "Wg": [0, 88, 56, 42, 1, 1, 1],
                "Fl": [0, 132, 56, 42, 1, 1, 1],
                "JB": [0, 176, 56, 42, 1, 1, 1],
                "YU": [0, 220, 56, 42, 1, 1, 1]
            }
        }, {
            "qZ": "dk",
            "Ht": "image/png",
            "VF": "assets/SFreeSpin.png",
            "q1": {
                "pN": [0, 0, 56, 42, 1, 1, 1],
                "x6": [0, 44, 56, 42, 1, 1, 1],
                "vv": [0, 88, 56, 42, 1, 1, 1],
                "o2": [0, 132, 56, 42, 1, 1, 1],
                "F3": [0, 176, 56, 42, 1, 1, 1],
                "Zu": [0, 220, 56, 42, 1, 1, 1]
            }
        }, {
            "qZ": "tJ",
            "Ht": "image/png",
            "VF": "assets/W01BaseGame.png",
            "q1": {
                "tJ": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "Kd",
            "Ht": "image/png",
            "VF": "assets/W01FreeSpin.png",
            "q1": {
                "Kd": [0, 0, 616, 42, 11, 1, 1]
            }
        }, {
            "qZ": "V_",
            "Ht": "image/png",
            "VF": "assets/BGBaseGame.png",
            "q1": {
                "n4": [0, 0, 480, 239, 1, 1, 1],
                "Ch": [0, 241, 320, 386, 1, 1, 1]
            }
        }, {
            "qZ": "QB",
            "Ht": "image/png",
            "VF": "assets/BGFreeSpin.png",
            "q1": {
                "R_": [0, 0, 480, 239, 1, 1, 1],
                "Kp": [0, 241, 320, 386, 1, 1, 1]
            }
        }, {
            "qZ": "ws",
            "Ht": "image/png",
            "VF": "assets/buttons.png",
            "q1": {
                "cG": [0, 0, 148, 50, 1, 1, 1],
                "n2": [0, 52, 104, 61, 1, 1, 1],
                "Dk": [0, 115, 50, 50, 1, 1, 1],
                "zv": [0, 167, 50, 50, 1, 1, 1],
                "BU": [0, 219, 57, 29, 1, 1, 1],
                "cJ": [0, 250, 148, 50, 1, 1, 1],
                "Qn": [0, 302, 148, 50, 1, 1, 1],
                "RR": [0, 354, 104, 61, 1, 1, 1],
                "xe": [0, 417, 104, 61, 1, 1, 1],
                "oz": [0, 480, 52, 52, 1, 1, 1],
                "bH": [0, 534, 52, 52, 1, 1, 1],
                "Ii": [0, 588, 33, 29, 1, 1, 1],
                "WM": [0, 619, 33, 29, 1, 1, 1],
                "Th": [0, 650, 148, 50, 1, 1, 1],
                "WZ": [0, 702, 148, 50, 1, 1, 1],
                "N9": [0, 754, 104, 61, 1, 1, 1],
                "HW": [0, 817, 104, 61, 1, 1, 1],
                "ui": [0, 880, 148, 50, 1, 1, 1],
                "vb": [0, 932, 148, 50, 1, 1, 1],
                "kI": [0, 984, 104, 61, 1, 1, 1],
                "BW": [0, 1047, 104, 61, 1, 1, 1],
                "zI": [0, 1110, 50, 50, 1, 1, 1],
                "Yo": [0, 1162, 50, 50, 1, 1, 1],
                "JK": [0, 1214, 50, 50, 1, 1, 1],
                "Wa": [0, 1266, 50, 50, 1, 1, 1],
                "J1": [0, 1318, 57, 29, 1, 1, 1],
                "DY": [0, 1349, 57, 29, 1, 1, 1]
            }
        }, {
            "qZ": "bR",
            "Ht": "image/png",
            "VF": "assets/winMeter.png",
            "q1": {
                "cZ": [0, 0, 148, 48, 1, 1, 1],
                "qC": [0, 50, 104, 61, 1, 1, 1]
            }
        }, {
            "qZ": "CZ",
            "Ht": "image/png",
            "VF": "assets/bonusMoon.png",
            "q1": {
                "CZ": [0, 0, 256, 256, 1, 1, 1]
            }
        }, {
            "qZ": "hW",
            "Ht": "image/png",
            "VF": "assets/bigWinWolf.png",
            "q1": {
                "hW": [0, 0, 151, 127, 1, 1, 1]
            }
        }, {
            "qZ": "LZ",
            "Ht": "image/png",
            "VF": "assets/bonusStars.png",
            "q1": {
                "LZ": [0, 0, 124, 124, 1, 1, 1]
            }
        }, {
            "qZ": "Sg",
            "Ht": "image/png",
            "VF": "assets/bonusMountains.png",
            "q1": {
                "Sg": [0, 0, 480, 91, 1, 1, 1]
            }
        }, {
            "qZ": "sm",
            "Ht": "image/png",
            "VF": "assets/fireworksBlue.png",
            "q1": {
                "sm": [0, 0, 1100, 79, 10, 1, 1]
            }
        }, {
            "qZ": "tx",
            "Ht": "image/png",
            "VF": "assets/fireworksGreen.png",
            "q1": {
                "tx": [0, 0, 1100, 79, 10, 1, 1]
            }
        }, {
            "qZ": "ku",
            "Ht": "image/png",
            "VF": "assets/fireworksMagenta.png",
            "q1": {
                "ku": [0, 0, 1100, 79, 10, 1, 1]
            }
        }, {
            "qZ": "PQ",
            "Ht": "image/png",
            "VF": "assets/fireworksOrange.png",
            "q1": {
                "PQ": [0, 0, 1100, 79, 10, 1, 1]
            }
        }, {
            "qZ": "Q7",
            "Ht": "image/png",
            "VF": "assets/fireworksWhite.png",
            "q1": {
                "Q7": [0, 0, 1100, 79, 10, 1, 1]
            }
        }, {
            "qZ": "Q2",
            "Ht": "image/png",
            "VF": "assets/bigWinFeathers.png",
            "q1": {
                "Q2": [0, 0, 192, 66, 1, 1, 1]
            }
        }, {
            "qZ": "fJ",
            "Ht": "image/png",
            "VF": "assets/bigWinGradient.png",
            "q1": {
                "fJ": [0, 0, 116, 42, 1, 1, 1]
            }
        }], [{
            Ht: "text/css",
            qZ: "WK",
            VF: "main.css"
        }], [{
            "AK": "0",
            "qZ": "rQ",
            "Ht": "audio/*",
            "VF": "assets/audio",
            "CO": "audio/mp4,audio/ogg,audio/mpeg",
            "Uc": {
                "zd": [1, 5.426032],
                "h_": [7.426032, 3.818322],
                "lX": [12.244354000000001, 3.816961],
                "e8": [17.061315, 3.810249],
                "T3": [21.871564, 3.818957],
                "hm": [26.690521, 19.493243],
                "pP": [47.183764, 0.978685],
                "uC": [49.162448999999995, 1.844989],
                "QX": [52.00743799999999, 7.302676],
                "CT": [60.31011399999999, 4.040000],
                "BI": [65.35011399999999, 4.781678],
                "LO": [71.13179199999999, 4.200000],
                "x2": [76.331792, 4.086712],
                "y0": [81.418504, 4.804989],
                "dV": [87.223493, 5.426395]
            },
            "u2": {
                "zd": "WWHowlMusicMix",
                "h_": "JLspin01",
                "lX": "JLspin02",
                "e8": "JLspin03",
                "T3": "JLspin04",
                "hm": "WWBonusMusicLoop",
                "pP": "Terminator02",
                "uC": "WRBonusRollUpEnd",
                "QX": "fireworks01",
                "CT": "M1",
                "BI": "M2",
                "LO": "M3",
                "x2": "M4",
                "y0": "SC",
                "dV": "WWhowling"
            }
        }]));
        document.getElementById("JO").addEventListener("ontouchstart" in window ? "touchstart" : "mousedown", function() {
            Zh.SG()
        });
        xb.m7("start")
    })
})();
document.addEventListener("DOMContentLoaded", function() {
    var boot = function() {
        xb.m7("boot")
    };
    eval("boot();")
}, false);
(function() {
    var Dg = new wS();
    Dg.TW("load", function(UT) {
        if (UT.qZ == "Qc") {
            var Qb = document.getElementById("OA"),
                xs = UT.gC.splashScreen.caption;
            if (Qb) {
                xs = xs.replace("™", "<em>™</em>");
                Qb.innerHTML = xs;
                Qb.parentElement.style.opacity = 1
            }
            Dg = null
        }
    })
})();
</script>
<div>

</div>
</body>
</html>

