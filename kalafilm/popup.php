<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>kala</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F1F2ED;
}
-->
</style>
<script language="javascript">
var nSizeWidth;
var nSizeHeight;
var nWinWidth;
var nWinHeight;
function GetWindowSize()
{
        nSizeWidth = 0;
	nSizeHeight = 0;
	
	nSizeWidth = screen.width;
	nSizeHeight = screen.height;
	
	if (navigator.appName=="Netscape")
	{
		nWinWidth = window.outerWidth;
		nWinHeight = window.outerHeight;
	}
	else
	{
		nWinWidth = document.body.offsetWidth;
		nWinHeight = document.body.offsetHeight;
	}

	window.moveTo(((nSizeWidth-nWinWidth)/2),((nSizeHeight-nWinHeight)/2));
}
</script>

</head>

<body>

<table width="540" height="540" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="540" height="540" valign="middle" align="center" bgcolor="#F1F2ED"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="500" height="50">
      <param name="movie" value="head.swf">
      <param name="quality" value="high">
      <embed src="head.swf?dirInput=<? echo $HTTP_GET_VARS['dir']; ?>&badgeInput=<? echo $HTTP_GET_VARS['badge']; ?>&agencyInput=<? echo $HTTP_GET_VARS['agency']; ?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="50"></embed>
    </object>
    <br>
    <object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" align="top" width="500" height="416">
        <param name="kioskmode" value="false">
        <param name="src" value="<? echo $HTTP_GET_VARS['film']; ?>">
        <param name="autoplay" value="true">
        <param name="controller" value="true">
        <param name="cache" value="true">
        <embed pluginspage="http://www.apple.com/quicktime/download/" src="<? echo $HTTP_GET_VARS['film']; ?>" type="video/quicktime" cache="true" controller="true" autoplay="true" kioskmode="false" align="top" width="500" height="416"> 
	</object>
    </td>
  </tr>
</table>
</body>
</html>
