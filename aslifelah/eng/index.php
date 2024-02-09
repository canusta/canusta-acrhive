<!DOCTYPE HTML>
<html>
    <head>
        <title>Aslı Felah</title>
		<link rel="shortcut icon" href="../Images/ico.png" >
		<meta charset="windows-1254">
		
        <script type="text/javascript" src="swfobject/swfobject.js"></script>
        <script type="text/javascript" src="swfaddress/swfaddress.js"></script>
        <style type="text/css">
            html, body {
                height: 100%;
                overflow: hidden;
            }
            body {
                background: #CCCCCC;
                font: 86% "Helvetica Neue", Arial, sans-serif;
                margin: 0;                
            }
            #content {
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <p>In order to view this page you need JavaScript and Flash Player 9+ support!</p>
        </div>
        <script type="text/javascript">
        // <![CDATA[
            var so = new SWFObject('../aslifelah.swf?a=<? echo rand(0,999999);  ?>', 'website', '100%', '100%', '8');
            // so.useExpressInstall('swfobject/expressinstall.swf');
            so.addParam('menu', 'false');
            // so.addVariable('lang', 'eng');
            so.write('content');
        // ]]>
        </script>
    </body>
</html>