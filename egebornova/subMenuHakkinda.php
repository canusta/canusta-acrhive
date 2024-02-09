<?php


global $commandResult;




$kavuklardanClass = '';
$egehakkindaClass = '';
$egemimarikonseptClass = '';
$egedeyasamClass = '';
$conciergeClass = '';
$projeortaklarimizClass = '';

switch ($currentSubPage)
{
	case 'kavuklar-dan' : 
	        $kavuklardanClass = 'current';
	        break;
	case 'ege-hakkinda' : 
	        $egehakkindaClass = 'current';
	        break;
	case 'ege-mimari-konsept' : 
	        $egemimarikonseptClass = 'current';
	        break;
	case 'ege-de-yasam' : 
	        $egedeyasamClass = 'current';
	        break;
	case 'concierge' : 
	        $conciergeClass = 'current';
	        break;
	case 'proje-ortaklarimiz' : 
	        $projeortaklarimizClass = 'current';
	        break;
}



$commandResult ="



<div class='subMenu'>

	<a href='".getScriptUrl().$lang."/hakkinda/kavuklar-dan'><div class='subMenuItem ".$kavuklardanClass."'>KAVUKLAR'DAN</div></a>
	<a href='".getScriptUrl().$lang."/hakkinda/ege-hakkinda'><div class='subMenuItem ".$egehakkindaClass."'>EGE HAKKINDA</div></a>
	<a href='".getScriptUrl().$lang."/hakkinda/ege-mimari-konsept'><div class='subMenuItem ".$egemimarikonseptClass."'>EGE MİMARİ KONSEPT</div></a>
	<a href='".getScriptUrl().$lang."/hakkinda/ege-de-yasam'><div class='subMenuItem ".$egedeyasamClass."'>EGE'DE YAŞAM</div></a>
	<a href='".getScriptUrl().$lang."/hakkinda/concierge'><div class='subMenuItem ".$conciergeClass."'>CONCIERGE</div></a>
	<a href='".getScriptUrl().$lang."/hakkinda/proje-ortaklarimiz'><div class='subMenuItem ".$projeortaklarimizClass."'>PROJE ORTAKLARIMIZ</div></a>

</div>





"

	
?>