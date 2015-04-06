var gameSWF;

/**
 *
 * @return
 */
function getGPELauncher()
{
     // return the gameSWF if we have a reference already
     if (gameSWF != null)
     {
	    return gameSWF;
     }
     try
     {
        gameSWF= swfobject.getObjectById("gameSwf");

        return gameSWF;

     }
     catch (swfObjectError)
     {
        try
        {
            gameSWF = getFlashObject();
            return gameSWF;
        }
        catch (flashObjectError)
		{
		   //alert("flashObjectError = "+flashObjectError);
		}
     }

     return gameSWF;
}

/**
 *
 * @param name
 * @param doc
 * @return
 */
function getObject(name, doc)
{
	if(doc.getElementById)
		return doc.getElementById(name);
	else if(doc.all)
		return doc.all[name];
	else
		return null;
}

/**
 *
 * @return
 */
function getFlashObject()
{
	var movieName = "shell";
  if (navigator.appName.indexOf("Microsoft") != -1) {
		return window[movieName];
	}else{

		if(document[movieName].length != undefined){
			return document[movieName][1];
		}
		return document[movieName];

	}
}


/**
 *
 * @param amount
 * @return
 */
function addFunds(amount)
{
	var flashObject = getGPELauncher();
	flashObject.FH2F_addFunds(amount);
	overlayClose();
}

/**
 *
 * @param amount
 * @return
 */
function removeFunds(amount)
{
	var flashObject = getGPELauncher();
	flashObject.FH2F_removeFunds(amount);
	overlayClose();
}

/**
 *
 * @return
 */
function cancelCashier()
{
	var flashObject = getGPELauncher();
	flashObject.FH2F_cancelCashier();
}

/**
 *
 * @return An XMLHTTPRequest object
 */
function createXMLHTTPRequest()
{
	if (window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}

	return null;
}


/**
 *
 * @param arg The js test to execute
 * @return
 */
function doJS(arg)
{
	eval(unescape(arg));
}

/**
 *
 * @param url
 * @param bgColor
 * @return
 */
function fixMovie(url, bgColor)
{
			var objectStr = "<object id='shell' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='100%' height='100%'>\n"
			+ "<param name='movie' value='" + url + "' />\n"
			+ "<param name='menu' value='false' />\n"
			+ "<param name='allowScriptAccess' value='always' />\n"
			+ "<param name='quality' value='high'/>\n"
			+ "<param name='bgcolor' value='" + bgColor + "' />\n"
			+ "<param name='wmode' value='transparent' />\n"
			+ "<embed name='shell' src='" + url + "' menu='false' allowScriptAccess='always' quality='high' bgcolor='"+ bgColor + "' width='100%' height='100%' type='application/x-shockwave-flash' wmode='transparent'>\n"
			+ "</embed>\n</object>";
			document.write(objectStr);
}

/**
 *
 * @param params
 * @return
 */
function loadGame(params)
{
	var frm = getObject("frmGameLoader", document);
	var softwareid = null;
	var oldSoftwareId = null;
	for (var i = 0; i < params.length; i++)
	{
	    var param = params[i];

	    if("softwareid" == param[0]){
	    	softwareid = new SoftwareId(param[1]);
	    	oldSoftwareId = new SoftwareId(frm.elements[param[0]].value);
	    }
	    frm.elements[param[0]].value = param[1];
	}
	if(!(oldSoftwareId.isGLEGame() == softwareid.isGLEGame())){
		// Its switch between new and old game
		frm.target = "_parent";
		if(softwareid.isGLEGame()){
			//New game
			frm.action = "../../tc/game";
		}else{
			//Old game
			frm.action = "../game.do";
		}
	}
	frm.submit();
}

/**
 *
 * @param params
 * @return
 */
function gameInProgressReload(params)
{
	var frm = getObject("gipGameLoader", document);
	var softwareid = null;
	var oldSoftwareId = null;
	for (var i = 0; i < params.length; i++)
	{
	    var param = params[i];

	    if("softwareid" == param[0]){
	    	softwareid = new SoftwareId(param[1]);
	    	oldSoftwareId = new SoftwareId(frm.elements[param[0]].value);
	    }
	    frm.elements[param[0]].value = param[1];
	}
	if(!(oldSoftwareId.isGLEGame() == softwareid.isGLEGame())){
		// Its switch between new and old game
		frm.target = "_parent";
		if(softwareid.isGLEGame()){
			//New game
			frm.action = "../../tc/game";
		}else{
			//Old game
			frm.action = "../game.do";
		}
	}
	frm.submit();
}


var myWidth;
var myHeight;

/**
 *
 * @deprecated
 * @return
 */
function reportSize()
{
	myWidth = 0, myHeight = 0;

	if(typeof( window.innerWidth ) == 'number')
	{
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	}
	else
	{
		if(document.documentElement &&
				(document.documentElement.clientWidth ||
					document.documentElement.clientHeight))
		{
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
		}
		else
		{
			if(document.body && (document.body.clientWidth || document.body.clientHeight))
			{
				//IE 4 compatible
				myWidth = document.body.clientWidth;
				myHeight = document.body.clientHeight;
			}
		}
	}
}

/**
 *
 * @deprecated
 * @param w
 * @param h
 * @return
 */
function setInnerWidth(w,h)
{
	window.resizeTo(w,h);
	reportSize();
	var oX = w - myWidth;
	var oY = h - myHeight;
	window.resizeTo( (w+oX) , (h+oY) );
}

/**
 *
 * @param name
 * @param value
 * @param expires
 * @param path
 * @param domain
 * @param secure
 * @return
 */
function setCookie( name, value, expires, path, domain, secure )
{
	// set time, it's in milliseconds
	var today = new Date();
	today.setTime( today.getTime() );

	/*
	if the expires variable is set, make the correct
	expires time, the current script below will set
	it for x number of days, to make it for hours,
	delete * 24, for minutes, delete * 60 * 24
	*/
	if ( expires )
	{
		expires = expires * 1000 * 60 * 60 * 24;
	}

	var expires_date = new Date( today.getTime() + (expires) );

	document.cookie = name + "=" +escape( value ) +
		( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
		( ( path ) ? ";path=" + path : "" ) +
		( ( domain ) ? ";domain=" + domain : "" ) +
		( ( secure ) ? ";secure" : "" );
}

/**
 *
 * @param name
 * @return
 */
function getCookie( name )
{
	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	if ( ( !start ) &&
		( name != document.cookie.substring( 0, name.length ) ) )
	{
		return null;
	}

	if ( start == -1 ) return null;

	var end = document.cookie.indexOf( ";", len );

	if ( end == -1 ) end = document.cookie.length;

	return unescape( document.cookie.substring( len, end ) );
}

/**
 *
 * @param url
 * @param width
 * @param height
 * @param label
 * @return
 */
function openGame(url, width, height, label, presentationType)
{
	if (presentationType==null||presentationType==""){
		presentationType = "FLSH";
	}
	window.open(url, presentationType, "status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=0,height=" + height + ",width=" + width);
}

/**
 *
 * @return
 */
function checkFlash()
{
	if(!DetectFlashVer(9,0,0))
	{
		if(confirm("In order to play games, your browser must have the latest Flash Player installed. Do you want to upgrade now?"))
		{
			wind = window.open(
					'http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash',
					'FlashUpgrade',
					'toolbar=yes,scrollbars=yes,status=yes,menubar=yes,resizable=yes');
			wind.focus();
		}
		else
		{
			window.close();
		}

		return false;
	}

	return true;
}

/**
 * This is a basic close function that can be used for error messages and exiting the game that only closes the window if the game is in a pop up.
 */
function closeWin() {
	//if (parent.parent && parent.parent.frames.length>0){
	if (top.frames.length==0) {
		//alert('this is not a modal it is a pop up');
		top.window.close();
	}
	else if (window.top.frames[0].name != 'content') {
		//alert('this is a modal');
		top.location.href=top.location.href;
	}
	else if (top.opener != null) {
		//alert('this is not a modal it is a pop up');
		top.window.close();
	}
	else {
		//alert('I am confused');
	}

}

/**
 *
 * @return
 */
function reloadGame()
{
	window.location.reload();
}

function insufficientFundsNotification(){
	closeGame();
}

function insufficientFundsCallBack(){
	reloadGame();
}


/**
 *
 * @param servlet
 * @param softwareid
 * @return
 */
function F2FH_CallServlet(servlet, softwareId)
{
	try
	{
		var sId = new SoftwareId(softwareId);

		var url = servlet + sId.toString();

		if(sId.isGLEGame())
			url = "/tc" + url;

		window.open(url);
	}
	catch(e)
	{
		alert(e);
	}
}

/**
GPE change the call name with prefix 'igt.'.
for backward compatibility, add corresponding prefix 'igt.'.
*/
window.igt=window.igt||{};

window.igt.closeGame=function(){
    closeGame();
}

window.igt.reloadGame = function(){
    reloadGame();
};

window.igt.gameInProgressReload = function(params){
    gameInProgressReload(params);
};

window.igt.closeCashier=function(){
    closeCashier();
}

window.igt.queue=function(){
    queue();
}

window.igt.insufficientFundsNotification = function(){
    insufficientFundsNotification();
};

window.igt.insufficientFundsCallBack = function(){
    insufficientFundsCallBack();
};
