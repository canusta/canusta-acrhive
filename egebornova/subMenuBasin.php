<?php


global $commandResult;




$kurumsalkimlikClass = '';

switch ($currentSubPage)
{
	case 'kurumsal-kimlik' : 
	        $kurumsalkimlikClass = 'current';
	        break;
	case 'haberler' : 
	        $haberlerClass = 'current';
	        break;
}



$commandResult ="



<div class='subMenu'>

	<a href='".getScriptUrl().$lang."/basin/kurumsal-kimlik'><div class='subMenuItem ".$kurumsalkimlikClass."'>KURUMSAL KİMLİK</div></a>
	<a href='".getScriptUrl().$lang."/basin/haberler'><div class='subMenuItem ".$haberlerClass."'>HABERLER</div></a>

</div>





"

	
?>