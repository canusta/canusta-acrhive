<?php



global $headerResult;



/* $pageTitle = 'Ege Bornova'; */



/* include('menuRoot.php'); */


$hakkindaClass = '';
$galeriClass = '';
$basinClass = '';
$iletisimClass = '';

switch ($currentPage)
{
	case 'hakkinda' : 
	        $hakkindaClass = 'mainMenuCurrent';
	        break;
	case 'galeri' : 
	        $galeriClass = 'mainMenuCurrent';
	        break;
	case 'basin' : 
	        $basinClass = 'mainMenuCurrent';
	        break;
	case 'iletisim' : 
	        $iletisimClass = 'mainMenuCurrent';
	        break;
}

if ($lang!='tr-noIntro' or $lang!='eng-noIntro' ) { $logoLink = $lang.'no-Intro'; }


$headerResult .= '

        	
        	
        	<div id="pageHeaderBg">
        		<img src="'.getScriptUrl().'img/_static/pageHeaderBg.png">
        	</div>
        	
        	<div id="pageHeaderImage">
        		<img src="'.getScriptUrl().'img/_static/pageHeaderImage.png">
        	</div>
        	
        	
        	
        	<div id="rootMenuContainer">
        		<div>
        			<a id="rootMainHakkinda" href="'.getScriptUrl().$lang.'/hakkinda/kavuklar-dan">HAKKINDA</a>
        			<a id="rootMainGaleri" href="'.getScriptUrl().$lang.'/galeri/fotograflar">GALERİ</a>
        			<a id="rootMainBasin" href="'.getScriptUrl().$lang.'/basin/haberler">BASIN</a>
        			<a id="rootMainIletisim" href="'.getScriptUrl().$lang.'/iletisim/iletisim-adresleri">İLETİŞİM</a>
        		</div>
        	</div>
        	
        	
        	<div id="rootMenuHakkindaRollOverContainer" class="rootMenuRollOverContainer">
	        	<div class="rootMenuRollOverLeft"><img src="'.getScriptUrl().'img/_static/mainMenuSubLeft.png"></div>
	        	<div class="rootMenuRollOver">
					<a href="'.getScriptUrl().$lang.'/hakkinda/kavuklar-dan"><div>KAVUKLAR\'DAN</div></a>
					<a href="'.getScriptUrl().$lang.'/hakkinda/ege-hakkinda"><div>EGE HAKKINDA</div></a>
					<a href="'.getScriptUrl().$lang.'/hakkinda/ege-mimari-konsept"><div>EGE MİMARİ KONSEPT</div></a>
					<a href="'.getScriptUrl().$lang.'/hakkinda/ege-de-yasam"><div>EGE\'DE YAŞAM</div></a>
					<a href="'.getScriptUrl().$lang.'/hakkinda/concierge"><div>CONCIERGE</div></a>
					<a href="'.getScriptUrl().$lang.'/hakkinda/proje-ortaklarimiz"><div>PROJE ORTAKLARIMIZ</div></a>
	        	</div>
        	</div>
        	
        	
        	
        	<div id="rootMenuGaleriRollOverContainer" class="rootMenuRollOverContainer">
	        	<div class="rootMenuRollOverLeft"><img src="'.getScriptUrl().'img/_static/mainMenuSubLeft.png"></div>
	        	<div class="rootMenuRollOver">
					<a href="'.getScriptUrl().$lang.'/galeri/fotograflar"><div>FOTOĞRAFLAR</div></a>
					<a href="'.getScriptUrl().$lang.'/galeri/videolar"><div>VIDEOLAR</div></a>
	        	</div>
        	</div>
        	
        	
        	
        	<div id="rootMenuBasinRollOverContainer" class="rootMenuRollOverContainer">
	        	<div class="rootMenuRollOverLeft"><img src="'.getScriptUrl().'img/_static/mainMenuSubLeft.png"></div>
	        	<div class="rootMenuRollOver">
					<a href="'.getScriptUrl().$lang.'/basin/haberler"><div>HABERLER</div></a>
					<a href="'.getScriptUrl().$lang.'/basin/kurumsal-kimlik"><div>KURUMSAL KİMLİK</div></a>
	        	</div>
        	</div>
        	
        	
        	
        	
        	<div id="rootMenuIletisimRollOverContainer" class="rootMenuRollOverContainer">
	        	<div class="rootMenuRollOverLeft"><img src="'.getScriptUrl().'img/_static/mainMenuSubLeft.png"></div>
	        	<div class="rootMenuRollOver">
					<a href="'.getScriptUrl().$lang.'/iletisim/iletisim-adresleri"><div>İLETİŞİM ADRESLERİ</div></a>
					<a href="'.getScriptUrl().$lang.'/iletisim/iletisim-formu"><div>İLETİŞİM FORMU</div></a>
					<a href="'.getScriptUrl().$lang.'/iletisim/google-maps"><div>GOOGLE MAPS</div></a>
	        	</div>
        	</div>
        	
        	
        	
        	<div id="rootEgeLogo">
        		<a href="'.getScriptUrl().$lang.'/noIntro"><img src="'.getScriptUrl().'img/_static/ege-logo.png"></a>
        	</div>
        	
        	
        	
        	
        	<div id="rootLangButton">
        		<!-- ENGLISH -->
        	</div>
        	
        	
        	
        	
        	<div id="rootKavuklarLogo">
        		<img src="'.getScriptUrl().'img/_static/kavuklar-logo.png">
        	</div>
        	
        	
        	
        	
        	';


?>