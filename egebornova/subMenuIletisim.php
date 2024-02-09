<?php


global $commandResult;




$iletisimAdresleriClass = '';
$iletisimFormuClass = '';
$googleMapsClass = '';


switch ($currentSubPage)
{
	case 'iletisim-adresleri' : 
	        $iletisimAdresleriClass = 'current';
	        break;
	case 'iletisim-formu' : 
	        $iletisimFormuClass = 'current';
	        break;
	case 'iletisim-formu-send' : 
	        $iletisimFormuClass = 'current';
	        break;
	case 'google-maps' : 
	        $googleMapsClass = 'current';
	        break;
}



$commandResult ="



<div class='subMenu'>

	<a href='".getScriptUrl().$lang."/iletisim/iletisim-adresleri'><div class='subMenuItem ".$iletisimAdresleriClass."'>İLETİŞİM ADRESLERİ</div></a>
	<a href='".getScriptUrl().$lang."/iletisim/iletisim-formu'><div class='subMenuItem ".$iletisimFormuClass."'>İLETİŞİM FORMU</div></a>
	<a href='".getScriptUrl().$lang."/iletisim/google-maps'><div class='subMenuItem ".$googleMapsClass."'>GOOGLE MAPS</div></a>
	
</div>





"

	
?>