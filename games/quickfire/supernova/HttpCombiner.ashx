/*Version 9.4.0.136629*/

.StandardText 
{
	font-size: 9pt;
	color: #FFFFFF; 
	font-family: Arial, Helvetica, sans-serif; 
	white-space: normal
}
.HeadingText  
{
	font-weight: bold;
	font-size: 15pt; 
	color: #FFFFFF; 
	font-family: Arial, Helvetica, sans-serif; 
	white-space: normal
}
body 
{
	font-size: 9pt; 
	color: #FFFFFF; 
	font-family: Arial, Helvetica, sans-serif; 
	white-space: normal; 
	background-color: #000000;
	border:0px; 
	margin:0px; 
	overflow:hidden;
}
.errortext
{
	font-size: 10pt;
	color: #CC6666;
	font-weight: bold;
}
A:link        
{
	font-size: 9pt; 
	color: #ffffff; 
	font-family: Arial, Helvetica, sans-serif; 
	text-decoration: underline
}
A:visited     
{
	font-size: 9pt; 
	color: #ffffff; 
	font-family: Arial, Helvetica, sans-serif; 
	text-decoration: underline
}
A:hover       
{
	font-size: 9pt; 
	color: #ffffff; 
	font-family: Arial, Helvetica, sans-serif; 
	text-decoration: underline
}
A:active      
{
	font-size: 9pt; 
	color: #ffffff; 
	font-family: Arial, Helvetica, sans-serif; 
	text-decoration: underline
}

html, body, #systemContent {height: 100%;}
h2 {color:#404040; font-size:1.8em; font-weight:bold;}
ul {padding-left:15px;}
ul li {margin-bottom:5px;}

.eula {color:#777777; font-size:0.9em; margin-bottom:2px; padding:0px; text-align:right; overflow:hidden;}
.eula a {color:#777777; font-size:1em; margin:0 0 0px 0; font-style:italic; overflow:hidden; }
.eula a:link {color:#777777; font-size:1em; margin:0 0 0px 0; font-style:italic; overflow:hidden;}
.eula a:hover {color:#777777; font-size:1em; margin:0 0 0px 0; font-style:italic; overflow:hidden;}
.eula a:visited {color:#777777; font-size:1em; margin:0 0 0px 0; font-style:italic; overflow:hidden;}
.eula a:active {color:#777777; font-size:1em; margin:0 0 0px 0; font-style:italic; overflow:hidden;}

.headingCell {background-color:#d9d9d9;}
.greyBackground {background-color:#d9d9d9;}
.whiteBackground {background-color:#ffffff; overflow:hidden;}
.prompt .content {padding: 25px 7px 0px 7px; overflow:hidden;}

.left {float:left;}
.right {float:right;}
.clear {clear:both;}

.prompt { text-align:center; padding:0px; z-index:10 }
.promptButton {height:30px; padding-left:15px; padding-right:15px; margin: 20px 0 5px 0;}
.promptTitle {text-align:left; margin:7px 5px 7px 5px;}
.promptText {font-size:1.2em; color:#333333; margin:0 auto; overflow:hidden; }
.promptText li {color:#333333;}

#shortcutPrompt { color:#333333; text-align:center; overflow:hidden;}
#eulaLinkDiv {margin-top:15px;}
#dontShowText {font-size:1.0em;}

#blockedPopupPrompt .content {color:#333333; text-align:left; overflow:hidden;}
#blockedPopupPromptText {font-size:1.2em; margin-bottom:0px; overflow:hidden;}
#blockedPopupPromptInstructions p {font-size:1.2em; margin-bottom:15px;}
#blockedPopupPromptInstructions {font-size:1.0em; padding-bottom:10px;}
/*Version 9.4.0.136629*/
/*
    ColorBox Core Style
    The following rules are the styles that are consistant between themes.
    Avoid changing this area to maintain compatability with future versions of ColorBox.
*/
#colorbox, #cboxOverlay, #cboxWrapper{position:absolute; top:0; left:0; z-index:9999; overflow:hidden; }
#cboxOverlay{position:fixed; width:100%; height:100%; overflow:hidden;}
#cboxMiddleLeft, #cboxBottomLeft{clear:left; overflow:hidden;}
#cboxContent{position:relative; overflow:hidden;}
#cboxLoadedContent{overflow:hidden;  }
#cboxLoadedContent iframe{display:block; width:100%; height:100%; border:0; overflow:hidden;}
#cboxTitle{margin:0; overflow:hidden;}
#cboxLoadingOverlay, #cboxLoadingGraphic{position:absolute; top:0; left:0; width:100%;}
#cboxPrevious, #cboxNext, #cboxClose, #cboxSlideshow{cursor:pointer;}

/* 
    Example user style
    The following rules are ordered and tabbed in a way that represents the
    order/nesting of the generated HTML, so that the structure easier to understand.
*/
#cboxOverlay{background:url(Resources/Images/overlay.png) 0 0 repeat;}
#colorbox{outline:0; overflow:hidden; }

	.boxTopLeft{width:9px; height:9px; background:url(Resources/Images/controls.png) -100px 0 no-repeat; overflow:hidden; }
    .boxTopRight{width:9px; height:9px; background:url(Resources/Images/controls.png) -141px 0 no-repeat; overflow:hidden; }
	.boxBottomLeft{width:9px; height:9px; background:url(Resources/Images/controls.png) -151px 0px no-repeat; overflow:hidden;}
    .boxBottomRight{width:9px; height:9px; background:url(Resources/Images/controls.png) -150px 0px no-repeat; overflow:hidden; }

    #cboxContent{overflow:hidden;}
		#cboxPrevious, #cboxNext, #cboxSlideshow, #cboxClose {border:0; padding:0; margin:0; overflow:hidden; text-indent:-9999px; width:25px; height:25px; position:absolute; top:-20px; background:url(Resources/Images/controls.png) no-repeat 0 0;}
        #cboxLoadedContent{overflow:hidden; height:auto}
        #cboxTitle{position:absolute; bottom:0px; left:0; text-align:center; width:100%; color:#949494;  overflow:hidden;}
        #cboxCurrent{position:absolute; bottom:4px; left:58px; color:#949494;  overflow:hidden;}
    	#cboxClose{top:7px; right:10px; background-position:-25px 0px;  overflow:hidden;}
        #cboxClose.hover{background-position:-25px -25px;  overflow:hidden;}

/*
  The following fixes a problem where IE7 and IE8 replace a PNG's alpha transparency with a black fill
  when an alpha filter (opacity change) is set on the element or ancestor element.  This style is not applied to or needed in IE9.
  See: http://jacklmoore.com/notes/ie-transparency-problems/
*/
.cboxIE #cboxTopLeft,
.cboxIE #cboxTopCenter,
.cboxIE #cboxTopRight,
.cboxIE #cboxBottomLeft,
.cboxIE #cboxBottomCenter,
.cboxIE #cboxBottomRight,
.cboxIE #cboxMiddleLeft,
.cboxIE #cboxMiddleRight {
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF);
}