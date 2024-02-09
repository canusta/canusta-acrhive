
<?php
include('axial.command.php');
include('axial.urlinterpreter.php');
include('axial.commanddispatcher.php');
$urlInterpreter = new Axial_UrlInterpreter();
$command = $urlInterpreter->getCommand();
$commandDispatcher = new Axial_CommandDispatcher($command);
$noIntro;
global $commandResult;
global $headerResult;
global $currentPage;
global $currentSubPage;
global $currentSubSubPage;
global $noIntro;

$commandDispatcher->Dispatch();

global $pageTitle;

// $currentPage = 'deeme';
// $currentPage = '<b>Command:</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;'.$command.'<br/>';

// A utility function to get the url leading up to the current script.
// Used to make the example portable to other locations.
function getScriptUrl()
        {
        $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
        unset($scriptName[sizeof($scriptName)-1]);
		$scriptName = array_values($scriptName);
		// return 'http://'.$_SERVER['SERVER_NAME'].implode('/',$scriptName).'/';
/* 		return 'http://192.168.1.15:8888/ege/'; // ATADA */
/* 		return 'http://172.20.10.2:8888/ege/'; // can usta's iphone */
/* 		return 'http://192.168.1.11:8888/ege/'; // vedat */
/* 		return 'http://192.168.2.219:8888/ege/'; */
		return 'http://canusta.com/archive/egebornova/';

        }
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $pageTitle; ?></title>
  <meta name="description" content="Evim Güzel Evim EGE Bornova. Yaşamaya değer bir hayat vaadi… İzmir'in geleceğine yaraşır iş ve yaşam alanları kurmayı kendine gönüllü görev olarak seçen..."><meta name="keywords" content="inşaat, ege, ege bornova, izmir, kavuklar, evim güzel evim, bornova, bayraklı, bayraklı tower, gayrimenkul, tago mimarlık, brigitte weber mimarlık, tatsuya yamamoto">
  
  <?php
        
        include 'Mobile_Detect.php';
        $detect = new Mobile_Detect();

	        
			if ($detect->isiPad()) {
			    echo '<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />';
			}
			
			if ($detect->isiPhone()) {
			    echo '<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 0.3" />';
			}
	        
        ?>

<?php

if($lang=="")
{
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=tr/">';
}

if($currentPage=="contact" && $currentSubPage=="")
{
/* 	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=contact/contact-info">'; */
}


?>

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="<?php echo getScriptUrl(); ?>css/reset.css">
  <link rel="stylesheet" href="<?php echo getScriptUrl(); ?>css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo getScriptUrl(); ?>css/minimalist.css" />
  <!-- end CSS-->

  <script src="<?php echo getScriptUrl(); ?>js/libs/modernizr-2.0.6.min.js"></script>
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo getScriptUrl(); ?>js/libs/jquery-1.6.2.min.js"><\/script>')</script>

   <!-- include flowplayer -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   
   <script src="<?php echo getScriptUrl(); ?>/js/libs/jwplayer.js"></script>
   <script>jwplayer.key="ydi+aYMYmmOTIxCM3g7artoPX6+7TY7DsyjzhA=="</script>

  <script defer src="<?php echo getScriptUrl(); ?>js/script.js"></script>



  <script>
  currentPage="<?php echo $currentPage; ?>";
  
  </script>

</head>

<body class="bg <?php  if($currentPage=='' or $currentPage=='noIntro'){echo 'root';}else{echo 'page';}; ?>">

<div>

	<header id='#header'>
		<?php echo $headerResult; ?>
	</header>



    <div id="main" role="main">
    	<div id="mainContent">
    		<?php echo $commandResult; ?>
    		
    		
    	
    		
    	</div>
    	
	</div>
	
	
	<?php include('footer.php'); ?>
	
	
</div>	
   <!--
 
-->


  
  
  

<?php if($currentPage=='noIntro') { echo '<script type="text/javascript">

$(window).load(function() {

	skipIntro();

});


</script>
'; }else{ echo '<script type="text/javascript"> 

$(window).load(function() {
	
	if(currentPage==""){
		launchRoot();
	}else{
		launchPage();
		buttonizeGallery();
		buttonizeForm();
	}
		
});

 </script>';
	
	
	} ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36072278-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>

