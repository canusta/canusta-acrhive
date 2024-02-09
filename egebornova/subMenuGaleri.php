<?php


global $commandResult;




$fotograflarClass = '';


switch ($currentSubPage)
{
	case 'fotograflar' : 
	        $fotograflarClass = 'current';
	        break;
	case 'videolar' : 
	        $videolarClass = 'current';
	        break;

}



$commandResult ="



<div class='subMenu'>

	<a href='".getScriptUrl().$lang."/galeri/fotograflar'><div class='subMenuItem ".$fotograflarClass."'>FOTOĞRAFLAR</div></a>
	<a href='".getScriptUrl().$lang."/galeri/videolar'><div class='subMenuItem ".$videolarClass."'>VİDEOLAR</div></a>
	
</div>





"

	
?>