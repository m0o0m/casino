<?
    session_start();

    $_SESSION['start_game'] = 'cleopatra_mobile';
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
	<meta generator="" name="com.igt.mproxy.PARAM" content="{&quot;post&quot;:[],&quot;get&quot;:[&quot;nscode&quot;,&quot;softwareid&quot;,&quot;countrycode&quot;,&quot;denomamount&quot;,&quot;language&quot;,&quot;skincode&quot;,&quot;currencycode&quot;,&quot;minbet&quot;],&quot;method&quot;:&quot;GET&quot;,&quot;params&quot;:{&quot;nscode&quot;:&quot;MRGR&quot;,&quot;softwareid&quot;:&quot;200-1177-001&quot;,&quot;countrycode&quot;:&quot;&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;denomamount&quot;:&quot;1.0&quot;,&quot;language&quot;:&quot;en&quot;,&quot;skincode&quot;:&quot;MRGR&quot;,&quot;currencycode&quot;:&quot;FPY&quot;,&quot;minbet&quot;:&quot;1.0&quot;}}"/>
	<meta name="com.igt.mproxy.MESSAGE" content="{&quot;CancelSubmitMobileNumber.message&quot;:&quot;Gaming regulations only allow this game to be played in valid jurisdictions.\nYour location must be verified in order to play this game.&quot;,&quot;CancelSubmitMobileNumber.title&quot;:&quot;Location Check Cancelled&quot;,&quot;SubmitMobileNumber.labelRegionCode&quot;:&quot;Select your region&quot;,&quot;Buttons.Cancel&quot;:&quot;Cancel&quot;,&quot;SubmitMobileNumber.title&quot;:&quot;Location Check&quot;,&quot;PromotionalFreeSpin.consoleBalance&quot;:&quot;Free Spins&quot;,&quot;SubmitMobileNumber.message&quot;:&quot;Please enter device phone number to verify you are in a legal jurisdiction.&quot;,&quot;Buttons.Close&quot;:&quot;Close&quot;,&quot;Error.networkOffLine&quot;:&quot;There is no network connection. Please try again when you are connected.&quot;,&quot;Error.payloadError&quot;:&quot;A system error has occurred.&quot;,&quot;SubmitMobileNumber.buttonCancel&quot;:&quot;Cancel&quot;,&quot;Error.connectionLost&quot;:&quot;Data not received.&quot;,&quot;SubmitMobileNumber.labelDeviceNumber&quot;:&quot;Mobile Number&quot;,&quot;SubmitMobileNumber.buttonValidate&quot;:&quot;OK&quot;,&quot;Buttons.OK&quot;:&quot;OK&quot;,&quot;Error.loadFailed&quot;:&quot;Connection lost! Click here to reload&quot;,&quot;Error.RGSid&quot;:&quot;Error ID:&quot;,&quot;Buttons.Retry&quot;:&quot;Retry&quot;,&quot;Error.networkError&quot;:&quot;A system error has occurred.&quot;}"/>
	<meta name="com.igt.mproxy.CONFIG" content="{&quot;RGS&quot;:{&quot;proxyUrl&quot;:&quot;../mobile/game&quot;,&quot;requestTimeout&quot;:15000,&quot;requestRetries&quot;:0},&quot;geoLocation&quot;:{&quot;enableHighAccuracy&quot;:true,&quot;maximumAge&quot;:300000,&quot;timeout&quot;:600000},&quot;console&quot;:{&quot;url&quot;:&quot;skin.html&quot;,&quot;urlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;countrycode&quot;,&quot;currencycode&quot;,&quot;nscode&quot;,&quot;skincode&quot;,&quot;uniqueid&quot;,&quot;presenttype&quot;,&quot;channel&quot;],&quot;lobbyURL&quot;:&quot;https://m.mrgreen.com&quot;},&quot;loader&quot;:{&quot;assetBaseUrlMap&quot;:{&quot;audio/*&quot;:&quot;http://m.rgsgames.com/games/&quot;},&quot;assetUrlParameterWhitelist&quot;:[&quot;softwareid&quot;,&quot;language&quot;,&quot;currencycode&quot;,&quot;countrycode&quot;,&quot;presenttype&quot;,&quot;channel&quot;]}}"/>
	<meta name="com.igt.mproxy.CLIENTCONFIG" content="{&quot;ScreenInchesDiagonal&quot;:&quot;Unknown&quot;,&quot;ScreenInchesHeight&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsHeight&quot;:&quot;0&quot;,&quot;gameType&quot;:&quot;S&quot;,&quot;Popularity&quot;:&quot;12017561243&quot;,&quot;PlatformVersion&quot;:&quot;Unknown&quot;,&quot;gleVersion&quot;:&quot;1.0&quot;,&quot;ScreenInchesWidth&quot;:&quot;Unknown&quot;,&quot;HardwareVendor&quot;:&quot;Unknown&quot;,&quot;HardwareModel&quot;:&quot;Unknown&quot;,&quot;IsCrawler&quot;:&quot;N&quot;,&quot;HardwareFamily&quot;:&quot;Emulator&quot;,&quot;PlatformVendor&quot;:&quot;Linux&quot;,&quot;HardwareName&quot;:&quot;Desktop&quot;,&quot;BrowserVendor&quot;:&quot;Google&quot;,&quot;OEM&quot;:&quot;Unknown&quot;,&quot;ScreenPixelsWidth&quot;:&quot;0&quot;,&quot;presenttype&quot;:&quot;HTML&quot;,&quot;BrowserName&quot;:&quot;Chrome&quot;,&quot;PlatformName&quot;:&quot;Unknown&quot;,&quot;BrowserVersion&quot;:&quot;38&quot;}"/>
	<meta name="com.igt.game.TAG" content="3a5032b3cf5b7e2336a0971a9b46d505"/>
	<meta name="com.igt.game.version" content="1.9"/>

	<style type="text/css" charset="utf-8">
.Pn{z-index:9999;text-align:left;margin:0 auto;visibility:hidden;display:inline-block}.fE{position:absolute;top:0;left:0;height:100%;width:100%;z-index:9999;text-align:center;visibility:hidden}.Rx{display:box;box-align:center;box-pack:center;height:inherit;width:inherit}.fE .Pn{position:relative;visibility:inherit}.Pn .JB{visibility:inherit;display:box;box-pack:center}.tL{position:relative;font-size:.75em}.tL>*{text-align:start;margin:5px}.tL>p{margin-bottom:.7em}.tL>p.W5{font-size:.9em}.tL>h1{margin:10px 5px 5px;font-size:1.167em;text-align:center}.tL>h2{font-size:1.167em;text-align:center}.tL>ul,.tL>ol,.tL>dl{list-style-position:inside;margin-bottom:.7em}*{margin:0;padding:0;border:0;z-index:0;user-select:none;tap-highlight-color:rgba(0,0,0,0);touch-callout:none}input{user-select:text}body{font-family:arial,helvetica,sans-serif;font-size:100%;text-size-adjust:none;margin:0 auto;position:relative;overflow:visible}.LT{overflow:hidden}.LT #zk,.LT #game{visibility:hidden}#zk{position:absolute;top:0;height:35px;width:inherit;overflow:hidden;z-index:1}#zk>iframe{visibility:inherit;width:inherit;height:100%}#FS{visibility:hidden;position:relative;margin-top:20px}#vv{white-space:pre-line;font-size:.625em}.Y3 #vv{min-height:5.3em}.HC #vv{min-height:4.0em}.y1,.uT{min-height:32px;min-width:70px}.uf{max-width:16.563em;min-width:12.500em}.HC .uf{max-width:18.438em}.uf .JB{margin:.313em 0}.uf .m9{margin:0 .375em .25em .375em;font-weight:bold;color:#fff;border:.063em solid #EEE;background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#4b4b4b),color-stop(50%,#131313),color-stop(100%,#010101));background:-webkit-linear-gradient(top,#4b4b4b 0,#131313 50%,#010101 100%);background:linear-gradient(to bottom,#4b4b4b 0,#131313 50%,#010101 100%);border-top-left-radius:.313em;border-top-right-radius:.313em;border-bottom-left-radius:.313em;border-bottom-right-radius:.313em}.uf .m9.vm{color:#999}.uf .m9.Mq{background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#919191),color-stop(48%,#7f7f7f),color-stop(50%,#666),color-stop(100%,#6c6c6c));background:-webkit-linear-gradient(top,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%);background:linear-gradient(to bottom,#919191 0,#7f7f7f 48%,#666 50%,#6c6c6c 100%)}.uf .m9>.vH{min-width:2.375em;padding:.5em .875em}.uf .tL{margin:.667em 1em;font-size:.938em;white-space:pre-line;text-align:center}.uf .tL>p{margin-bottom:1.2em}.uf .tL address{font-style:normal;text-align:center;white-space:pre-line;margin-top:.267em}.LI{border:.125em solid #EEE;border-top-left-radius:.938em;border-top-right-radius:.938em;border-bottom-right-radius:.938em;border-bottom-left-radius:.938em;background-clip:border;background-color:#000}.LI .Sp{display:block;position:absolute;background:transparent;top:-1.5em;right:-1.5em;border:0;margin:0;padding:0}.LI .Sp>.vH{display:block;background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNTZweCIgaGVpZ2h0PSI1NnB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDU2IDU2IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnIG9wYWNpdHk9IjAuNSI+DQoJPGNpcmNsZSBjeD0iMjgiIGN5PSIzMCIgcj0iMjQiLz4NCjwvZz4NCjxnPg0KCTxjaXJjbGUgZmlsbD0iI0ZGRkZGRiIgY3g9IjI4IiBjeT0iMjgiIHI9IjI0Ii8+DQo8L2c+DQo8bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzFfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjI4LjAwMDUiIHkxPSI0OCIgeDI9IjI4LjAwMDUiIHkyPSI4LjAwMSI+DQoJPHN0b3AgIG9mZnNldD0iMCIgc3R5bGU9InN0b3AtY29sb3I6I0E0MDAxNyIvPg0KCTxzdG9wICBvZmZzZXQ9IjAuNDkiIHN0eWxlPSJzdG9wLWNvbG9yOiNBQjEzMjkiLz4NCgk8c3RvcCAgb2Zmc2V0PSIwLjUxIiBzdHlsZT0ic3RvcC1jb2xvcjojQkQ0NDU1Ii8+DQoJPHN0b3AgIG9mZnNldD0iMSIgc3R5bGU9InN0b3AtY29sb3I6I0Q3OEY5OSIvPg0KPC9saW5lYXJHcmFkaWVudD4NCjxjaXJjbGUgZmlsbD0idXJsKCNTVkdJRF8xXykiIGN4PSIyOCIgY3k9IjI4IiByPSIyMCIvPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTIxLjYzNiwzNy4xOTNjLTAuNzgsMC43OC0yLjA0NywwLjc4LTIuODI4LDBsMCwwYy0wLjc4MS0wLjc4MS0wLjc4MS0yLjA0OCwwLTIuODI5bDE1LjU1Ny0xNS41NTYNCgljMC43OC0wLjc4MSwyLjA0Ny0wLjc4MSwyLjgyOCwwbDAsMGMwLjc4MSwwLjc4MSwwLjc4MSwyLjA0NywwLDIuODI5TDIxLjYzNiwzNy4xOTN6Ii8+DQo8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTguODA4LDIxLjYzNmMtMC43OC0wLjc4LTAuNzgtMi4wNDcsMC0yLjgyOGwwLDBjMC43OC0wLjc4MSwyLjA0OC0wLjc4MSwyLjgyOSwwbDE1LjU1NiwxNS41NTcNCgljMC43OCwwLjc3OSwwLjc4LDIuMDQ3LDAsMi44MjhsMCwwYy0wLjc4MSwwLjc4MS0yLjA0OCwwLjc4MS0yLjgyOSwwTDE4LjgwOCwyMS42MzZ6Ii8+DQo8L3N2Zz4NCg==);background-position:center;background-size:62%;background-repeat:no-repeat;width:3em;height:3em;padding:0}.LI .m9.Sp>.vH{padding:0}.Sp.Mq,.Sp.vm{background:none!important}#NP .jj{text-align:left}#NP .P1{text-align:right;font-size:.75em;margin:0 .833em .417em}#Wd .tL>p{text-align:center}#Wd .tL>form{margin:.4em .8em 1.2em;display:box;box-orient:vertical}#Wd .tL label{display:box;margin:.6em 0}#Wd .tL input[type=text],#Wd .tL input[type=tel]{text-indent:.4em;font:inherit;margin:.1em;font-size:1.2em;line-height:1.8em}#Wd .tL input[type=text],#Wd .tL input[type=tel],#Wd .tL select{margin:.1em;font:inherit;font-size:1.2em;height:1.8em}body,#rl,#game{color:#fff;background-color:#c15397;background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,#3b1150),color-stop(0.33,#562c87),color-stop(0.66,#a7398b),color-stop(1,#c15397));background-image:-moz-linear-gradient(center top,#3b1150 0,#562c87 33%,#a7398b 66%,#c15397 100%);background-repeat:no-repeat;background-size:100% 100%}#iW{position:absolute;top:0;background:#111;width:100%;height:30px}.portrait #game{height:386px;width:320px}.landscape #game{height:238px;width:480px}#Mm{background-color:#464646}#hW{background-color:#aec5dc}.y1:after{content:spriteImage(HY)}.uT:after{content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAgCAYAAACRpmGNAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAB7NJREFUeNrEWAlwVdUZ/u7bV7IZEiWRBFLCYmMx4IIsZesUNNZq1Kk6Kqh0VFwG0FaqqG2ZabG4DCjVqa0jM3GAWhxRdBikIuCSZiBqkMgStmAWIHvyXt7q95/cl7z78hJTq+XMfHl59917znf/5fv/c7RoNIohjFQdmcRYIo3IJuyEh9CSPCMTtxMBoo5oIqqJM0QL0fpti1oGuD6cmEVMJSYRowhvly/oaG7rRncwjFAoglA4gnBk4JczmzRYLCZYzCY47RakDrPLp48/dRCHib3EbmIH0Zj4vJZguTHEcqIkEo2ml39ejx3lJ1BT24qTde04eqoVbR0BBEkqohOLDELORHJC0ExyVpIc5rFjVE4KcrO9yOfnzMm5mPzjbLlHrPoOsZL4Khm5RcSqg8ebU8rePoAtO2vw5ZGz8PuCXKVvAZOmQYs5UUvuz3i/Qp9eluELIxgKIxxWX+B0WlGYn4750/Jx89XjMGF0hrj6UWJdPLnFxJq/vFqBlS9/ipYWH6x0g91qIhENP9SQtQPBCALdIXi9diy9fRIe+/XlNIS2hD8/K+RyxJTPvrbXtWTldjh5k8TI/3uINbva/Fjx4FQ8dd8USaJxwuK2M80+1zOvVcDhtp0TYip5zBqcTJi1ZftwvK7NxkulwqT4BIP9dFMXM8uMcznEMC3t3fiqplm+5omUhFXwMbbEtJFoBDZrf5ISzD5fKBbfKilcDoshJoOUlwBlJpbBkq0ylySS3BXidZ8/NHgc+gNKqmRJpXOcQ2VlVqYH56U5sP/wWS5sVaZWd3FSL10+b2p+b6bKi+zae4qLBZWkdAfCSiYuLhyOzHSnIlN/tgufVTeKm2AxmZB1nguXFV3Qk8IDKJAQu2C4p0+EfYEQfnrZhXjhsdnIGzEMr7xRhcfX7gFFF05aRywiD2x6psQw0YRrXkX1UR/SUx3q2dK5Y9RLxI/Wjm5s3n4Yi/+wHaNz07Bx9dVDd7P8GT8qA1vXXaeIyLj/lomYOG44blv+LiQeRUgl7cWC4ir1Qkx/EWOHzYwNq0sw69LcpAukUHjvuHaCIr1uQ+V/F4NqAq+93w9TLxmBbS+XYv49/8KhY01JH+6kZZcumGQg1kw5eG79Xga3hgdvLWZV6LHk9XN/hEYm3fufnGAciovdGDMyrfe5RoZANdeRGL6oIANpwxwYVDcKLkxF2aqrKMbmfmVKYi4rw427ri8yXH98zR78fvVOrPjzB/jTK+X95ptz5yZM/1UZVr70ieG3rbuOYgavT7+lDB9X1g1a+HvHpAlZeIjK/c9tBw3XpQyNzUtDTpan95pk6s6KWpi9DoT5/9/e+ALHv25T1qytb1eW89C9HZ0BmC2mfk0CaAQTLR4LHctQfP/Iwsk4UHNWLe6wW3rJjaf5YxPJ8DMOTzf5UMx4feLeK1QidVE6JMOt1NCvT3fgd8/vjpXl/kMD4qvlkMilpzgwrThHyUWMnJRkDwt34giRdHamG/Onj+r32zF2NT3khtRDYsi1amx+mmFKsVhtY4fhHrvNAhcJd1GsRembWv2GWO36FgEelNzBY83YTWGVJjJxdHQFEd/62eimLw6dUa7sI2fG3CtGYvuuGuTMfgklizerUPiuo5dcbUMH/vFmldIvKb4GYpSMrR8e5eJ972Jl8MrL7Cg/abh31dIZeGDBZPxiZgHWLJ/dGwbfqdbKn/oznZi1cCMepmaJvi16YhukHb92doFy0QpWi1Mk77D1LdQTuFH8hrJxedH5Ki5lZLBaPP/bmd9LI6BMcfhEi5KEu0uLVK//4oo5+CN16MpbX8ecuzZhx0fHqfBWQ2bKfVJ/q1g7b1yyRc2RbJRX1WPz+4fU/x6XtbdFtiZIicyXmCfKFFK2MtNdWPb0TtV9yIOFeemoOdVC6THDRW1qoII/+twu3WKa2uCIfrmpaR9UnFQvUjJzNCaOzYTXZYOfmV1J4mXvVKsK9J+qBjS1+Hpik+tV7G9QmStlUarCfm4J7HazId6lE96470DjDZeUru9hrvVArCIlKPYyknWdTIp4TXLTEiZdmKRi+LqZNBGjX9ycJ9ZuabS8WE8ekfbcH5e9FpY0acGkJG5Zex3mTct7wRLTQzvNqvouLWGDEicdXo9t0E7W47INEDvGZ6O6W60J88l1gd6qaeL4/dnss1J4YzgSOaedsHjHTZ3MH5EiXxuE3Ibz2WQu+OVF8DFDh3YA8MOMTor2TT8vRMFIOVzAW0LugOwTn7x3Cu6++Sf0eUAJ7mA7+e/bWhJn7WxKbywZj6eXzZA4+zt/qoztWyXH/0oslNblxdcr8fHndWhiFyE9vMTH/yKmsT2IiimSkSZVsl021ulpThSz81lEGSv9mRw4YL2+wfcnHkfcSSyTUipHD2/9+wj2UQ6OUMNOsuWRN5Tib9jIRAfYD2g9Sh2/yZHyJjElxxHS2xWNycQ1lJ/RucqN0pOtJt4j5sl5jZbklEmkfgpxFTGRuFiaZRZycyuLubhcSpxUFdE5KfBByoIhyzmnEBJ9y0hxsil1wUGZEBmRtj3Vaw/pp0yfEft0Qnuk+487GjFpQzgCy9CPvuSzUD+BStGPxBw6km14w/pifuneiTaplLqFpO8/rX8mGy7C/Y0AAwDoxzsHpntd3QAAAABJRU5ErkJggg==)}.portrait #Loader .Ge{margin:90px auto 0}.landscape #Loader .Ge{margin:36px auto 0}
	</style>
</head>
<body class="LT">
	<div id="Wa" class="fE">
		<div class="Rx">
			<div id="FS" class="LI uf Pn">
				<div id="GF" class="tL"></div>
				<div id="tN" class="Sp">
					<div class="vH"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="Loader" style="z-index:1;overflow:hidden;text-align:center;">
		<div style="position:absolute;width:inherit;height:inherit;text-align:center">
			<div style="position:absolute;width:inherit">
	<img class="Ge" src="mainImage.png"/>
</div>

		</div>
		<div style="position:absolute;bottom:0.25em;width:inherit">
			<div style="position:relative;display:-webkit-box;-webkit-box-align:center">
				<div class="y1" style="-webkit-box-flex:1"></div>
				<div id="Mm" style="-webkit-box-flex:3;width:auto;height:6px">
					<div id="hW" style="width:0;height:100%"></div>
				</div>
				<div class="uT" style="-webkit-box-flex:1"></div>
			</div>
			<div id="vv"> </div>
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
xt = window.xt || {};
xt.DS = function(fQ) {
    if (fQ instanceof Object) {
        xt.XK(fQ, function(yI, tZ) {
            var DJ, TJ;
            TJ = tZ.split(".");
            DJ = TJ.shift();
            TJ = TJ.join(".");
            if (TJ) {
                fQ[DJ] = fQ[DJ] || {};
                fQ[DJ][TJ] = yI;
                delete fQ[tZ]
            }
        });
        fQ = xt.dB(fQ, xt.DS)
    }
    return fQ
};
xt.qE = function(P3, bp) {
    for (var fe in (bp || {})) {
        P3[fe] = bp[fe]
    }
    return P3
};
xt.Nl = function(P3, bp) {
    for (var fe in (bp || {})) {
        P3[fe] = (fe in P3) ? P3[fe] : bp[fe]
    }
    return P3
};
xt.qE(xt, {
    XK: function(P3, p1, ZA) {
        for (var fe in P3) {
            P3.hasOwnProperty(fe) && p1.call(ZA, P3[fe], fe, P3)
        }
    },
    Hk: function(P3, Ss) {
        return "?".concat(xt.OH.apply(this, arguments))
    },
    OH: function(P3, Ss) {
        var jH = [];
        xt.XK(P3, function(GZ, iE) {
            (!Ss || Ss.indexOf(iE) >= 0) && jH.push(encodeURIComponent(iE).concat("=", encodeURIComponent(GZ)))
        });
        return jH.join("&")
    },
    MD: function(P3, Ss) {
        var jH = [],
            iE = -1,
            bg = Ss.length;
        while (++iE < bg) {
            jH[iE] = encodeURIComponent(P3[Ss[iE]])
        }
        return jH.join("/")
    },
    qB: function(iE) {
        return Array.prototype.slice.call(iE)
    },
    EC: function(Cs, N8) {
        var J6 = function() {};
        J6.prototype = Cs.prototype;
        var wz = new J6();
        Cs.apply(wz, N8);
        return wz
    },
    lY: function(P3, p1, ZA) {
        var jH = [];
        for (var cg in P3) {
            P3.hasOwnProperty(cg) && jH.push(p1 ? p1.call(ZA, P3[cg], cg, P3) : P3[cg])
        }
        return jH
    },
    i5: function(P3, Hd, ZA) {
        var dq = "";
        for (var cg in P3) {
            P3.hasOwnProperty(cg) && (dq += Hd.call(ZA, P3[cg], cg, P3))
        }
        return dq
    },
    dB: function(P3, p1, ZA) {
        var dq = {};
        for (var fe in P3) {
            if (P3.hasOwnProperty(fe)) {
                dq[fe] = p1.call(ZA, P3[fe], fe, P3)
            }
        }
        return dq
    }
});
var Z0 = function(hz, eO) {
    this.hz = hz;
    this.eO = eO
};
xt.qE(Z0, {
    IL: function(JY, Jg, yT) {
        return (!Jg || JY.source === Jg) && (!yT || JY.origin === yT) && JY.data.indexOf("com.igt.game:") === 0 && xt.EC(Z0, JSON.parse(JY.data.substr("com.igt.game:".length)))
    },
    L_: function(X9, yT, hz, eO) {
        (new Z0(hz, eO)).L_(X9, yT)
    },
    Tu: function(X9, hz, eO) {
        Z0.L_(X9, "*", hz, eO)
    },
    vD: function(hz, eO) {
        Z0.L_(window.parent, "*", hz, eO)
    },
    rp: function(hz, eO) {
        Z0.L_(window, Z0.yT(document.location.href), hz, eO)
    },
    yT: function(Lg) {
        var ey = document.createElement("A");
        ey.setAttribute("href", Lg);
        return [ey.protocol, "//", ey.hostname, ey.port > 0 ? ":".concat(ey.port) : ""].join("")
    }
});
xt.qE(Z0.prototype, {
    toString: function() {
        return "com.igt.game:" + JSON.stringify([this.hz, this.eO])
    },
    L_: function(X9, yT) {
        try {
            X9.postMessage(this.toString(), yT)
        } catch (iL) {}
    }
});
bB = function(Jg, yT) {
    var JL = {},
        UQ = 0,
        AA = function(JY) {
            var UD = Z0.IL(JY, Jg, yT);
            UD && UD.hz && JL[UD.hz] && JL[UD.hz].forEach(function(Lf) {
                Lf.call(void 0, UD.eO)
            })
        },
        UL = function(Lf, hz) {
            this.LZ(hz, Lf)
        },
        yT = yT && Z0.yT(yT);
    var LZ = this.LZ = function(hz, Lf) {
        var Qd = JL[hz];
        if (!Qd) {
            Qd = JL[hz] = [];
            UQ++ || window.addEventListener("message", AA, true)
        }
        Qd.indexOf(Lf) >= 0 || Qd.push(Lf);
        return this
    };
    var UP = this.UP = function(hz, Lf) {
        var fe, Qd = JL[hz];
        if (Qd) {
            fe = Qd.indexOf(Lf);
            fe >= 0 && Qd.splice(fe, 1);
            if (0 == Qd.length) {
                delete JL[hz];
                UQ--
            }
            UQ || window.removeEventListener("message", AA, true)
        }
        return this
    };
    this.d7 = function(JL) {
        xt.XK(JL, UL, this);
        return this
    };
    this.v4 = function(JL) {
        JL = {};
        window.removeEventListener("message", AA, true);
        return this
    };
    this.JH = function(UD, eO) {
        Z0.L_(Jg, yT, UD, eO);
        return this
    };
    this.jm = function(kT, Z9) {
        var FK = kT.length;
        kT.forEach(function(JY) {
            LZ(JY, function Lf() {
                UP(JY, Lf);
                --FK || Z9.apply(void 0, arguments)
            })
        })
    }
};
var z3 = z3 || {};
var TA = (function() {
    var nk, uQ, T6, Aw, K9, vN = function() {
            Z0.Tu(window.parent, "loaderror")
        },
        b_ = function(H1, k7) {
            k7 = k7.split(";")[0];
            return H1 === k7 || H1 === k7.split("/").concat("/*")
        },
        Xj = function(kp, hz) {
            return kp[hz] || kp[hz.replace(/\/.*$/, "/*")] || kp["*/*"]
        },
        t5 = function(Ij) {
            var JG = this,
                Aw = new XMLHttpRequest();
            Aw.onreadystatechange = function() {
                if (this.readyState == 4 || this.readyState == 0) {
                    if (this.status === 200 && b_(JG.hz, this.getResponseHeader("Content-Type"))) {
                        Xj(HR, JG.hz).call(JG, this.responseText);
                        delete this.onreadystatechange
                    } else {
                        delete this.onreadystatechange;
                        JG.l6()
                    }
                }
            };
            Aw.open("GET", JG.Lg, true);
            Aw.send(null)
        },
        nC = {
            "text/javascript": function(Ij) {
                var yY = document.createElement("SCRIPT"),
                    JG = this;
                yY.type = this.hz;
                document.head.appendChild(yY);
                yY.onload = function() {
                    delete yY.onload;
                    JG.Rd();
                    document.head.removeChild(yY)
                };
                yY.onerror = JG.l6;
                this.Lg = Ij + this.Lg;
                yY.src = this.Lg
            },
            "application/json": t5,
            "*/*": function(Ij) {
                console.error("Loader: No load handler for type " + this.hz);
                this.Rd()
            }
        },
        xv = {},
        HR = {
            "application/json": function(Cf) {
                this.L6 = JSON.parse(Cf);
                this.Rd()
            }
        },
        I3 = function(lh) {
            var gI = {},
                iA = 0,
                ql = 6,
                KU = function(kp, hz) {
                    var ec = hz && hz.replace(/\/.*$/, "/*");
                    return hz in kp ? hz : ec in kp ? ec : "*/*"
                },
                jg = function(JG) {
                    if (K9) {
                        return
                    }
                    var uQ = JG.uQ && JG.uQ.split(",") || [];
                    ++iA;
                    JG.Rd = function() {
                        --iA;
                        if (!gI[JG.OU]) {
                            Z0.Tu(window.top, "progress");
                            Z0.rp("load", JG);
                            gI[JG.OU] = 1;
                            VT(JG.hz)
                        } else {
                            console.warn("Loader: Dw reloaded " + JG.OU)
                        }
                    };
                    JG.l6 = vN;
                    JG.Lg = JG.Lg.concat(s8);
                    Xj(nC, JG.hz).call(JG, Xj(nk.assetBaseUrlMap, JG.hz) || "", t5);
                    VT(JG.hz)
                },
                VT = function(QA) {
                    var JG, pw = xv[KU(nC, QA)];
                    if (lh.length == 0 && iA == 0) {
                        Z0.Tu(window.parent, "loaded")
                    } else {
                        if (iA == 0 || pw && iA < ql && pw.indexOf(KU(nC, lh[0].hz)) >= 0) {
                            jg(lh.shift())
                        }
                    }
                };
            Z0.Tu(window.top, "queue", lh.length);
            P5.LZ("start", function() {
                P5.UP("start", VT);
                VT()
            })
        },
        dj = function() {
            Aw && Aw.abort();
            K9 = true;
            lh = []
        },
        Gn = function(UD) {
            nk = UD.loader;
            s8 = xt.Hk(uQ, nk.assetUrlParameterWhitelist).concat("&tag=", T6);
            Qs = nk.assetBaseUrlMap
        },
        Ay = function(UD) {
            var tag = document.getElementsByName("com.igt.game.TAG")[0];
            T6 = tag.content;
            tag.parentNode.removeChild(tag);
            uQ = JSON.parse(JSON.stringify(UD.params))
        };
    document.head = document.head || document.getElementsByTagName("head")[0];
    var P5 = new bB(window, window.location.href);
    P5.d7({
        manifest: I3,
        abortLoading: dj,
        loaderror: dj,
        "mproxy.config": Gn,
        "mproxy.param": Ay
    });

    function Dq(hz, Lf, hQ) {
        nC[hz] = Lf;
        xv[hz] = hQ
    }
    return {
        Dq: Dq,
        Qr: function(hz, Lf, hQ) {
            Dq(hz, t5, hQ);
            HR[hz] = Lf
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
TA.Qr("text/css", function(Cf) {
    var N0 = document.createElement("STYLE");
    Cf = Cf.replace(/plate\(([^)]+)\)/g, function(ch, OU) {
        return ["url(", z3.OG[OU].src, ")"].join("")
    });
    Cf = PrefixFree.prefixCSS(Cf, 1);
    Cf = Cf.replace(/(^|;|{)\s*border-radius\s*:\s*([^;}]+)/gm, function(match, before, values) {
        var values = values.split(/\s+/);
        values[1] = values[1] || values[0];
        values[2] = values[2] || values[1];
        values[3] = values[3] || values[1];
        return before + ["border-top-left-radius:" + values[0], "border-top-right-radius:" + values[1], "border-bottom-right-radius:" + values[2], "border-bottom-left-radius:" + values[3]].join(";")
    });
    Cf = Cf.replace(/((?:(?!;base64))[{};])/gm, "$1\n");
    N0.hz = this.hz;
    N0.appendChild(N0.ownerDocument.createTextNode(Cf));
    document.head.appendChild(N0);
    this.Rd()
});
Xe = {};
var K_ = (function() {
    var F2 = [Date.prototype.getDate, Date.prototype.getMonth, Date.prototype.getFullYear],
        P8 = "/",
        LE = [Date.prototype.getHours, Date.prototype.getMinutes],
        ag = ":",
        jq = {},
        Pc = {},
        tT = function(OU) {
            var cg, UD = jq,
                Af = OU.split(".");
            while ((cg = Af.shift()) && (UD = UD[cg])) {}
            return Pc[OU] = UD
        },
        Ck = function(tw, hV) {
            var iE = hV.length,
                fI;
            while (iE--) {
                fI = String(hV[iE].call(tw));
                hV[iE] = fI.length < 2 ? "0" + fI : fI
            }
            return hV
        };
    i6 = function(OU) {
        var UD = Pc[OU] || tT(OU);
        UD || console.warn("No message with id " + OU);
        return UD || OU
    };
    uM = function(OU) {
        return i6(OU).substitute([].slice.call(arguments, 1))
    };
    fh = function(tw) {
        return Ck(tw, F2.slice(0)).join(P8)
    };
    cv = function(tw) {
        return Ck(tw, LE.slice(0)).join(ag)
    };
    var Ro = function(ez, tZ) {
        jq[tZ] = ez
    };
    var c0 = function(ez) {
        for (var tZ in ez) {
            Ro(ez[tZ], tZ)
        }
    };
    var ur = function(OU, ez) {
        Pc[OU] = ez
    };
    return {
        c0: c0,
        Ro: Ro,
        ur: ur,
        Fg: function(OU) {
            return Pc[OU] || tT(OU)
        }
    }
})();
O5 = (function() {
    var IG, Vc = new bB(window);
    HG = function(OU) {
        return K_.Fg(OU + "." + IG) || K_.Fg(OU + ".default") || K_.Fg(OU) || console.warn("No message with id " + OU)
    };
    Vc.LZ("mproxy.param", function(UD) {
        IG = UD.params.countrycode.toLowerCase();
        Vc = void 0
    })
})();

function X6() {
    window.scrollTo(0, navigator.userAgent.indexOf("Android") > -1 || navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/) ? 1 : 0)
}

function cF(JY) {
    if (document.activeElement && document.activeElement.hasClass("SR")) {
        return
    }
    if (!event.target.form) {
        document.activeElement && document.activeElement.blur();
        JY.preventDefault()
    }
    JY.type == "touchstart" && X6()
}
document.body.addEventListener("touchstart", cF);
document.body.addEventListener("touchmove", cF);
document.addEventListener("touchstart", cF);
document.addEventListener("touchmove", cF);
var cW = (function() {
    function Zv() {
        if (PV) {
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
        if (gl) {
            setTimeout(Vk, 500);
            gl = false;
            PV = true
        }
    }

    function Vk() {
        Ls()
    }

    function Ls() {
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

    function Rr() {
        var JY = document.createEvent("HTMLEvents");
        JY.initEvent("orientationchange", 1, 1);
        document.dispatchEvent(JY)
    }

    function xf() {
        var JY = document.createEvent("HTMLEvents");
        JY.initEvent("resize", 1, 1);
        document.dispatchEvent(JY)
    }
    var qa = navigator.userAgent.match(/\s+7_[\d_]+\s+like Mac OS X/);
    var bI = navigator.userAgent.match(/\s+8_[\d_]+\s+like Mac OS X/);
    var va = navigator.userAgent.match(/\s+9_[\d_]+\s+like Mac OS X/);
    var kn = navigator.userAgent.indexOf("like Mac OS X") >= 0;
    var QS = navigator.userAgent.indexOf("Android") > 0;
    var f9 = 0;
    if (navigator.userAgent.indexOf("Chrome/") > -1) {
        f9 = navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome/") + 7);
        f9 = parseInt(f9.substring(0, f9.indexOf(".")))
    }
    var Sr = QS && !f9;
    var mS = bI || (!kn && !Sr);
    var nX = "orientationchange",
        AQ = "resize",
        l7 = ["Y3 portrait", "HC landscape"],
        B9 = NaN,
        GD = NaN,
        o7 = NaN,
        RF = NaN,
        kN = NaN,
        m6 = null,
        k9 = 1,
        uN = 0,
        mg = null,
        Vc = new bB(window),
        gl = false,
        PV = false,
        yC = function(Ut, Pq) {
            var Oz = Ut.className;
            var rB = new RegExp("(?:^|\\s+)" + l7[0] + "(?=\\s+|$)", "gi");
            var ui = new RegExp("(?:^|\\s+)" + l7[1] + "(?=\\s+|$)", "gi");
            var HQ = new RegExp("(?:^|\\s+)" + Pq + "(?=\\s+|$)", "gi");
            Pq = " ".concat(Pq);
            Ut.className = Oz.replace(rB, "").replace(ui, "").replace(HQ, "").concat(Pq)
        },
        ZD = function() {
            return k9
        },
        s6 = function(io) {
            uN = io
        },
        Fz = function() {
            if (GD != B9) {
                RF = l7[GD == 90 ? 1 : 0];
                window.oI && oI.W_();
                yC(document.documentElement, RF)
            }
            document.body.offsetWidth;
            var JY = document.createEvent("Event");
            JY.initEvent("com.igt.events.orientationchange", false, false, null);
            JY.orientation = GD;
            window.dispatchEvent(JY);
            setTimeout(function() {
                m6 && Fp()
            }, 0)
        },
        DA = (function() {
            if (navigator.userAgent.indexOf("like Mac OS X") >= 0) {
                return function() {
                    GD = Math.abs(window.orientation);
                    Fz(GD)
                }
            } else {
                if (navigator.userAgent.indexOf("Android") >= 0) {
                    return function() {
                        var bc = screen.width,
                            Ef = screen.height;
                        GD = B9;
                        if (window.hasOwnProperty("orientation")) {
                            GD = Math.abs((window.orientation) % 180)
                        } else {
                            if (kN != bc) {
                                GD = Ef >= bc ? 0 : 90
                            }
                        }
                        Fz(GD);
                        kN = bc
                    }
                } else {
                    return function() {
                        var bc = window.innerWidth;
                        GD = kN == bc ? B9 : window.innerHeight >= bc ? 0 : 90;
                        Fz(GD)
                    }
                }
            }
        })(),
        qM = function() {
            if (navigator.userAgent.indexOf("Android") >= 0) {
                var bc = screen.width;
                var Ef = screen.height;
                GD = kN == bc ? B9 : Ef >= bc ? 0 : 90;
                Fz(GD)
            } else {
                DA()
            }
        },
        MU = function() {
            if (navigator.userAgent.match(/Android/)) {
                var x8 = screen.width;
                var xG = screen.height;
                if (document.documentElement.offsetWidth != screen.width && screen.width != (document.documentElement.offsetWidth * window.devicePixelRatio)) {
                    GD = (x8 >= xG) ? 0 : 90
                } else {
                    GD = (xG >= x8) ? 0 : 90
                }
                Fz(GD);
                B9 = GD;
                o7 = RF;
                m6 && Fp()
            } else {
                Rr()
            }
        },
        X2 = function() {
            var Ef;
            if (document.querySelector("meta[name='com.igt.game.AUTOSCALE'][content='yes']")) {
                m6 = document.createElement("div");
                Ef = Math.floor(document.documentElement.clientHeight / 4);
                if (qa || bI) {
                    m6.style.position = "fixed"
                } else {
                    m6.style.position = "absolute"
                }
                m6.style.bottom = -Ef + "px";
                m6.style.right = "0";
                m6.style.width = "1px";
                m6.style.height = Ef + "px";
                document.body.appendChild(m6)
            }
        },
        jW = (function() {
            var Z2 = document.createElement("div").style,
                S_ = "transform",
                H0 = "transformOrigin";
            E4 = "transitionDuration";
            ["WebkitTransform", "msTransform", "MozTransform", "oTransform"].forEach(function(cg) {
                S_ = cg in Z2 ? cg : S_
            });
            ["WebkitTransformOrigin", "msTransformOrigin", "MozTransformOrigin", "oTransformOrigin"].forEach(function(cg) {
                H0 = cg in Z2 ? cg : H0
            });
            ["WebkitTransitionDuration", "msTransitionDuration", "MozTransitionDuration", "oTransitionDuration"].forEach(function(cg) {
                E4 = cg in Z2 ? cg : E4
            });
            return function(v6, Q7, Jn) {
                v6.style[S_] = Q7;
                v6.style[H0] = "0% 0%";
                if (Jn) {
                    v6.style[E4] = "1ms"
                }
            }
        })(),
        z0 = function() {
            return ["body", "iframe"].indexOf(document.activeElement && document.activeElement.tagName) >= 0
        },
        Fp = function() {
            if (z0()) {
                return
            }
            var Zu = document.getElementById("Loader") || document.getElementById("game");
            if (!Zu) {
                return
            }
            if (Zu && m6) {
                var X8 = m6.offsetLeft + m6.offsetWidth;
                var cw = m6.offsetTop;
                if (bI || va || mS) {
                    X8 = window.innerWidth;
                    cw = window.innerHeight
                }
                if (navigator.userAgent.indexOf("like Mac OS X") >= 0 && !qa && !bI && !va) {
                    if (cw > X8) {
                        if (cw < 360) {
                            cw = cw + 60
                        }
                    } else {
                        if (cw < 250) {
                            cw = 268
                        }
                    }
                }
                var Qe = 0,
                    Kk = 0;
                if (Zu.offsetWidth) {
                    var W8 = Zu.offsetWidth;
                    var ZK = Zu.offsetHeight + Zu.offsetTop;
                    var gj = cw / ZK;
                    Qe = Math.floor((X8 - (W8 * gj)) / 2);
                    if (W8 * gj > X8) {
                        gj = X8 / W8;
                        Qe = 0
                    }
                    var gj = (X8 - 2 * Qe) / W8;
                    if (!!cW && cW.Df) {
                        Kk = Math.floor((cw - (ZK * gj)) / 2)
                    }
                    if (uN > 0 && gj > uN) {
                        gj = uN
                    }
                    k9 = gj;
                    var H8 = document.getElementById("game");
                    var c5 = document.getElementById("AI");
                    var Q7 = "translate(" + Qe + "px, " + Kk + "px) scale(" + gj + ")";
                    jW(Zu, Q7, navigator.userAgent.indexOf("Android") == -1 && navigator.userAgent.indexOf("like Mac OS X") == -1);
                    H8 && Zu != H8 && jW(H8, Q7);
                    c5 && c5.parentElement == document.body && jW(c5, Q7)
                }
            }
        },
        zZ = function() {
            window.oI && oI.D7();
            document.body.offsetWidth;
            mg = mg || document.getElementById("zk");
            if (mg && mg.offsetHeight < document.body.clientHeight / 2) {
                setTimeout(X6, 0)
            }
            bc = screen.width;
            B9 = GD;
            o7 = RF
        },
        Mw = function() {
            if (GD != B9) {
                window.oI && oI.D7();
                document.body.offsetWidth;
                setTimeout(X6, 0);
                bc = screen.width
            }
            B9 = GD;
            o7 = RF;
            m6 && Fp()
        };
    window.hasOwnProperty("orientation") || (window.orientation = 0);
    window.addEventListener(nX, DA, true);
    window.addEventListener(AQ, qM, true);
    Vc.LZ("initialised", MU);
    window.addEventListener(nX, Mw, false);
    window.addEventListener(AQ, zZ, false);
    if (document.querySelector("meta[name='com.igt.game.RESIZEKICKER'][content='yes']")) {
        window.setInterval(xf, 500)
    }
    if (navigator.userAgent.indexOf("SAMSUNG") != -1) {
        gl = true
    }
    document.addEventListener("touchstart", Zv);
    document.body.addEventListener("touchstart", Zv);
    X2();
    MU();
    return {
        ZD: ZD,
        s6: s6,
        Rr: Rr,
        xf: xf
    }
})();
(function() {
    var fH = 1,
        mt = 0,
        P5 = new bB(),
        OU = function(OU) {
            return document.getElementById(OU)
        };
    P5.LZ("progress", function() {
        var YW = OU("hW"),
            FB = OU("bt"),
            jr = Math.max(0, Math.min(100, Math.round(100 * ++mt / fH))) + "%";
        YW && (YW.style.width = jr);
        FB && (FB.innerHTML = jr);
        if (mt >= fH) {
            Z0.rp("initialise")
        }
    });
    P5.LZ("loaderror", function(UD) {
        var q1 = OU("GF");
        q1.firstChild || q1.appendChild(document.createTextNode(i6("mproxy.Error.loadFailed")));
        q1.parentNode.style.visibility = "visible"
    });
    P5.LZ("splashMessage", function(UD) {
        var Kn = OU("vv");
        Kn.firstChild.insertData(0, UD + "\n")
    });
    P5.LZ("initialised", function() {
        var rl = OU("Loader"),
            Lb = OU("Wa"),
            Sg = OU("game");
        rl && document.body.removeChild(rl);
        Lb && document.body.removeChild(Lb);
        document.body.className = document.body.className.replace("LT", "");
        document.body.offsetWidth;
        delete P5;
        Z0.rp("visible")
    });
    P5.LZ("queue", function(eO) {
        X6();
        fH += eO
    })
})();
var k2 = function(A1) {
    var oW, O2 = function() {
            try {
                window.localStorage && localStorage.setItem(A1, JSON.stringify(oW))
            } catch (e) {}
        },
        yz = function() {
            oW = JSON.parse(window.localStorage && localStorage[A1] || "{}")
        };
    yz();
    return {
        zO: function(P3) {
            oW = $merge(oW, P3);
            O2();
            return this
        },
        ZO: function() {
            return $merge(oW)
        },
        Nl: function(P3) {
            oW = $merge(P3, oW);
            O2();
            return this
        }
    }
};
(function() {
    var pI, t1, Ga, fG, Sg, Vc = new bB(window),
        OU = function(OU) {
            return document.getElementById(OU)
        },
        sG = function(UD) {
            var FY = document.createElement("title"),
                Kn = OU("vv");
            K_.c0(UD.L6);
            FY.appendChild(document.createTextNode(HG("title")));
            document.head.appendChild(FY);
            var m = t1.loader.splashMessage || "";
            if (m) {
                m = m[Ga.params.countrycode.toLowerCase()] || m["default"] || "";
                m = m[Ga.params.language.toLowerCase()] || m["default"] || ""
            }
            Kn.firstChild.insertData(0, HG("splashScreen.footer") + (m && "\n") + m)
        },
        gX = function(UD) {
            p8(t1, Ga, fG, Vc)
        },
        Cv = {
            u9: sG,
            Sg: gX
        },
        e2 = function(UD) {
            Cv[UD.OU] && Cv[UD.OU](UD)
        },
        Gn = function(UD) {
            t1 = Object.freeze(UD)
        },
        Ay = function(UD) {
            Ga = Object.freeze(UD)
        },
        Pt = function(UD) {
            fG = Object.freeze(UD)
        },
        x3 = function(UD) {
            if (UD) {
                xt.DS(UD);
                K_.Ro(UD, "mproxy")
            } else {
                Z0.Tu(window.parent, "loaderror")
            }
        };
    Vc.d7({
        load: e2,
        "mproxy.param": Ay,
        "mproxy.config": Gn,
        "mproxy.clientConfig": Pt,
        "mproxy.message": x3
    })
})();
(function() {
    var Vc = new bB(window),
        Vg = {};
    z3.KA = function(uQ) {
        function FT(yI, T_) {
            var qU = document.createElement("input");
            qU.type = "hidden";
            qU.name = T_;
            qU.value = yI;
            hd.appendChild(qU)
        }
        var hd = document.createElement("form"),
            uQ = uQ || {};
        uQ.playMode = uQ.playMode || Vg.PARAM.params.playMode || "real";
        hd.method = Vg.PARAM.method;
        hd.style.display = "none";
        Vg.PARAM[Vg.PARAM.method].forEach(function(vr) {
            var yI = uQ.hasOwnProperty(vr) ? uQ[vr] : Vg.PARAM.params[vr];
            FT(yI, vr);
            delete uQ[vr]
        });
        if (Vg.PARAM.method == "post") {
            hd.action = "?" + Vg.PARAM.get.map(function(vr) {
                var value = encodeURIComponent(vr) + "=" + encodeURIComponent(uQ.hasOwnProperty(vr) ? uQ[vr] : Vg.PARAM.params[vr]);
                delete uQ[vr];
                return value
            }).join("&")
        }
        xt.XK(uQ, FT);
        hd.submit()
    };
    Vc.LZ("boot", function() {
        ["PARAM", "MESSAGE", "CONFIG", "CLIENTCONFIG"].forEach(function(T_) {
            var v6 = document.getElementsByName("com.igt.mproxy." + T_)[0];
            if (v6 && v6.content) {
                try {
                    Vg[T_] = JSON.parse(v6.content)
                } catch (e) {
                    console.error("Failed to parse injected data from " + T_);
                    Z0.Tu(window.parent, "loaderror")
                }
            } else {
                Vg[T_] = {}
            }
            v6.parentNode.removeChild(v6)
        });
        Vg.PARAM.method = Vg.PARAM.method.toLowerCase();
        Z0.rp("mproxy.param", Vg.PARAM);
        Z0.rp("mproxy.config", Vg.CONFIG);
        Z0.rp("mproxy.message", Vg.MESSAGE);
        Z0.rp("mproxy.clientConfig", Vg.CLIENTCONFIG);
        Z0.rp("manifest", [{
            hz: "application/json",
            OU: "u9",
            Lg: "assets/strings.json"
        }, {
            hz: "text/javascript",
            OU: "AC",
            Lg: "../MXF/MXF.js"
        }, {
            hz: "text/javascript",
            OU: "Sg",
            Lg: "main.js"
        }, ].concat([{
            "OU": "zT",
            "hz": "image/png",
            "Lg": "assets/reelsFrame.png",
            "KS": {
                "NM": [0, 0, 316, 3, 1, 1, 1],
                "zT": [0, 5, 316, 174, 1, 1, 1],
                "VI": [0, 181, 316, 32, 1, 1, 1]
            }
        }, {
            "OU": "vf",
            "hz": "image/png",
            "Lg": "assets/reelsChrome.png",
            "KS": {
                "Ge": [0, 0, 316, 41, 1, 1, 1],
                "nQ": [0, 43, 318, 34, 1, 1, 1],
                "M7": [0, 79, 318, 9, 1, 1, 1],
                "GL": [0, 90, 316, 23, 1, 1, 1],
                "RJ": [0, 115, 316, 23, 1, 1, 1]
            }
        }, {
            "OU": "Dd",
            "hz": "image/png",
            "Lg": "assets/symbolW01.png",
            "KS": {
                "UJ": [0, 0, 616, 56, 1, 1, 1]
            }
        }, {
            "OU": "NU",
            "hz": "image/png",
            "Lg": "assets/symbolBaseGame.png",
            "KS": {
                "Fw": [0, 0, 56, 56, 1, 1, 1],
                "Va": [0, 58, 56, 56, 1, 1, 1],
                "zG": [0, 116, 56, 56, 1, 1, 1],
                "K7": [0, 174, 56, 56, 1, 1, 1],
                "oa": [0, 232, 56, 56, 1, 1, 1],
                "ug": [0, 290, 56, 56, 1, 1, 1],
                "UE": [0, 348, 56, 56, 1, 1, 1],
                "aI": [0, 406, 56, 56, 1, 1, 1],
                "wK": [0, 464, 56, 56, 1, 1, 1],
                "tE": [0, 522, 56, 56, 1, 1, 1],
                "oe": [0, 580, 56, 56, 1, 1, 1]
            }
        }, {
            "OU": "fL",
            "hz": "image/png",
            "Lg": "assets/symbolB01.png",
            "KS": {
                "cs": [0, 0, 616, 56, 1, 1, 1]
            }
        }, {
            "OU": "qI",
            "hz": "image/png",
            "Lg": "assets/reelBlur.png",
            "KS": {
                "Jx": [0, 0, 292, 168, 1, 1, 1]
            }
        }, {
            "OU": "CU",
            "hz": "image/png",
            "Lg": "assets/symbolW01FreeSpin.png",
            "KS": {
                "CU": [0, 0, 616, 56, 1, 1, 1]
            }
        }, {
            "OU": "F3",
            "hz": "image/png",
            "Lg": "assets/symbolFreeSpin.png",
            "KS": {
                "Yg": [0, 0, 56, 56, 1, 1, 1],
                "ux": [0, 58, 56, 56, 1, 1, 1],
                "b0": [0, 116, 56, 56, 1, 1, 1],
                "p4": [0, 174, 56, 56, 1, 1, 1],
                "hU": [0, 232, 56, 56, 1, 1, 1],
                "oL": [0, 290, 56, 56, 1, 1, 1],
                "mW": [0, 348, 56, 56, 1, 1, 1],
                "Vz": [0, 406, 56, 56, 1, 1, 1],
                "mu": [0, 464, 56, 56, 1, 1, 1],
                "VM": [0, 522, 56, 56, 1, 1, 1],
                "m4": [0, 580, 56, 56, 1, 1, 1]
            }
        }, {
            "OU": "rX",
            "hz": "image/png",
            "Lg": "assets/symbolB01FreeSpin.png",
            "KS": {
                "rX": [0, 0, 616, 56, 1, 1, 1]
            }
        }, {
            "OU": "S8",
            "hz": "image/png",
            "Lg": "assets/reelBlurFreeSpin.png",
            "KS": {
                "S8": [0, 0, 292, 168, 1, 1, 1]
            }
        }, {
            "OU": "IH",
            "hz": "image/png",
            "Lg": "assets/buttonInactive.png",
            "KS": {
                "jw": [0, 0, 148, 50, 1, 1, 1],
                "wZ": [0, 52, 104, 62, 1, 1, 1],
                "wU": [0, 116, 50, 50, 1, 1, 1],
                "kf": [0, 168, 50, 50, 1, 1, 1],
                "NE": [0, 220, 57, 29, 1, 1, 1]
            }
        }, {
            "OU": "cJ",
            "hz": "image/png",
            "Lg": "assets/buttonSpin.png",
            "KS": {
                "Y9": [0, 0, 148, 50, 1, 1, 1],
                "iV": [0, 52, 148, 50, 1, 1, 1],
                "ba": [0, 104, 104, 62, 1, 1, 1],
                "rE": [0, 168, 104, 62, 1, 1, 1],
                "iy": [0, 232, 52, 52, 1, 1, 1],
                "vO": [0, 286, 52, 52, 1, 1, 1],
                "uV": [0, 340, 33, 29, 1, 1, 1],
                "EA": [0, 371, 33, 29, 1, 1, 1]
            }
        }, {
            "OU": "t0",
            "hz": "image/png",
            "Lg": "assets/buttonSkip.png",
            "KS": {
                "CG": [0, 0, 148, 50, 1, 1, 1],
                "n1": [0, 52, 148, 50, 1, 1, 1],
                "u0": [0, 104, 104, 62, 1, 1, 1],
                "rN": [0, 168, 104, 62, 1, 1, 1]
            }
        }, {
            "OU": "Yz",
            "hz": "image/png",
            "Lg": "assets/buttonStake.png",
            "KS": {
                "K5": [0, 0, 148, 50, 1, 1, 1],
                "S5": [0, 52, 148, 50, 1, 1, 1],
                "ED": [0, 104, 104, 62, 1, 1, 1],
                "jF": [0, 168, 104, 62, 1, 1, 1],
                "ss": [0, 232, 50, 50, 1, 1, 1],
                "fJ": [0, 284, 50, 50, 1, 1, 1],
                "nA": [0, 336, 50, 50, 1, 1, 1],
                "l8": [0, 388, 50, 50, 1, 1, 1],
                "uj": [0, 440, 57, 29, 1, 1, 1],
                "aP": [0, 471, 57, 29, 1, 1, 1]
            }
        }, {
            "OU": "f0",
            "hz": "image/png",
            "Lg": "assets/doors.png",
            "KS": {
                "Nv": [0, 0, 146, 168, 1, 1, 1],
                "sf": [0, 170, 146, 168, 1, 1, 1]
            }
        }, {
            "OU": "Vf",
            "hz": "image/png",
            "Lg": "assets/flames1.png",
            "KS": {
                "NJ": [0, 0, 146, 84, 1, 1, 1],
                "fT": [0, 86, 146, 84, 1, 1, 1],
                "U8": [0, 172, 146, 84, 1, 1, 1]
            }
        }, {
            "OU": "VB",
            "hz": "image/png",
            "Lg": "assets/flames2.png",
            "KS": {
                "n0": [0, 0, 146, 84, 1, 1, 1],
                "z1": [0, 86, 146, 84, 1, 1, 1],
                "lE": [0, 172, 146, 84, 1, 1, 1]
            }
        }], [{
            hz: "text/css",
            OU: "eV",
            Lg: "main.css"
        }], []));
        document.getElementById("tN").addEventListener("ontouchstart" in window ? "touchstart" : "mousedown", function() {
            z3.KA()
        });
        Z0.rp("start")
    })
})();
document.addEventListener("DOMContentLoaded", function() {
    var boot = function() {
        Z0.rp("boot")
    };
    eval("boot();")
}, false);
(function() {
    var P5 = new bB(),
        OU = function(OU) {
            return document.getElementById(OU)
        };
    P5.LZ("load", function(UD) {
        if (UD.OU == "u9") {
            var hu = OU("hu");
            if (hu) {
                hu.appendChild(document.createTextNode(UD.L6.splashScreen.caption));
                hu.parentElement.style.opacity = 1
            }
            P5 = null
        }
    })
})();
</script>
<div>

</div>
</body>
</html>


