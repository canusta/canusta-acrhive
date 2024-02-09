<?php




global $commandResult;
global $pageTitle;



$pageTitle = 'Ege Bornova';



include('menuRoot.php');



$commandResult .= "



<div class='rootSide' id='rootLeftSide'>
	
	
	
	<div id='rootPageSectionKatalog' class='rootPageSection'>
		<div class='rootPageColumnHeader'>
			TANITIM KATALOĞU 
		</div>
		
		<div id='katalogContent' class='rootPageColumnContentWhite'>
			6MB PDF <a href='".getScriptUrl()."files/ege-bornova.pdf'><span class='downloadButton'>İNDİR</span></a> <span id='katalogImage'><img src='".getScriptUrl()."img/_static/ege-tanitim-katalogu.png'></span>
		</div>
	</div>
	
	
	
	<div id='rootPageSectionKatalog' class='rootPageSection'>
		<div class='rootPageColumnHeader'>
			KAT PLANLARI
		</div>
		
		<div id='katalogContent' class='rootPageColumnContentWhite'>
			1MB PDF <a href='".getScriptUrl()."files/ege-bornova-kat-planlari.pdf'><span class='downloadButton'>İNDİR</span></a> <span id='katPlanlariImage'><img src='".getScriptUrl()."img/_static/rootKatPlanlari.png'></span>
		</div>
	</div>
	
	
	

	
	
	
	
	<div id='rootPageSectionHaber' class='rootPageSection'>
		<div class='rootPageColumnHeader'>
			HABERLER <span class='rootPageColumnHeaderRight'>Tüm Haberler <img class='rootPageColumnHeaderRightArrow' src='".getScriptUrl()."img/_static/rootPageColumnHeaderRightArrow.png'></span>
		</div>
		<div class='rootPageHaber'>
			<a href='".getScriptUrl().$lang."/basin/haberler/yeni-ekonomi-20121105' class='rootHaber'><div class='haberContent'>Yeni Ekonomi 05.11.2012</br><span class='haberDate'>05.11.2012</span></div>
			<div class='haberButton'></div></a>
		</div>
		<div class='rootPageHaber'>
			<a href='".getScriptUrl().$lang."/basin/haberler/aksam-20121105' class='rootHaber'><div class='haberContent'>Akşam 05.11.2012</br><span class='haberDate'>05.11.2012</span></div>
			<div class='haberButton'></div></a>
		</div>
		<div class='rootPageHaber'>
			<a href='".getScriptUrl().$lang."/basin/haberler/aksam-ege-20121105' class='rootHaber'><div class='haberContent'>Akşam Ege 05.11.2012</br><span class='haberDate'>05.11.2012</span></div>
			<div class='haberButton'></div></a>
		</div>
	</div>
	
	
	
	

	
	
</div>






<div class='rootSide' id='rootRightSide'>



	
	<div class='rootPageSection'>
		<img src='".getScriptUrl()."img/rootMap.jpg'>
	</div>
	
	
	
	
	
	<div>
		<a href='http://www.facebook.com/Kavuklar' target='_blank'><div id='rootButtonFacebook'></div></a>
		<a href='https://twitter.com/kavuklar' target='_blank'><div id='rootButtonTwitter'></div></a>
		<!--<div id='rootButtonFoursquare'></div>-->
	</div>
	
	
	
	
	<div id='rootPageSectionMedya' class='rootPageSection'>
		<div class='rootPageColumnHeader'>
			MEDYA <span class='rootPageColumnHeaderRight'>Tüm Medya Haberleri <img class='rootPageColumnHeaderRightArrow' src='".getScriptUrl()."img/_static/rootPageColumnHeaderRightArrow.png'></span>
		</div>
		<div class='rootPageMedya'>
			<div class='medyaContent'>
				<div class='medyaImage'><img src='".getScriptUrl()."img/medyaHaber-1.png'></div>
				</br>Sed nisi tortor, tristique sed imperdiet non, varius a leo. Nam egestas ligula et ipsum fermentum auctor.
				</br><div class='medyaDate'>LAKE&COUNTRY 2012 ARALIK</div>
			</div>
			<div class='medyaContent'>
				<div class='medyaImage'><img src='".getScriptUrl()."img/medyaHaber-2.png'></div>
				</br>Nam egestas ligula et ipsum fermentum auctor.
				</br><div class='medyaDate'>LAKE&COUNTRY 2012 ARALIK</div>
			</div>
		</div>
	</div>
	
	
	
</div>



";


?>






