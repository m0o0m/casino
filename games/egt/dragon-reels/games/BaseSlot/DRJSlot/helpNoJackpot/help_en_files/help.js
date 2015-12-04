/**
 * ...
 * @author Georgi Dimov gvdimvo@yahoo.com
 */

function getParameterByName(name) 
{
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(decodeURIComponent(location.search));

	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function start()
{
	var qBets = document.getElementById("qBets");
	if(qBets)
		qBets.innerHTML = getParameterByName("qBets");
		
	var rtpValue = getParameterByName("rtp");
	if(rtpValue != "")
		document.getElementById("rtp").innerHTML = rtpValue + "%";
	else
	{
		var rtpLink = document.getElementById("rtp_link");
		rtpLink.parentNode.removeChild(rtpLink);
		document.body.removeChild(document.getElementById("return_to_player"));
		document.body.removeChild(document.getElementById("rtp_paragraph"));
	}
}