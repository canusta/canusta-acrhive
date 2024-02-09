<?php


global $commandResult;

global $asd
;


$parameters = $this->command->getParameters();


// $commandResult = $parameters[0];


if($parameters[0]=='recentwork')
{
	$videoName = 'Samsung "Smart Freezer"';
	$thumbnailName = 'ei-samsung-smartfreezer';
	$vimeoID = 32213904;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Sek Günlük Süt "İnek"';
	$thumbnailName = 'fk-sekgunluksut-inek';
	$vimeoID = 32210704;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel="" title="Sek Günlük Süt / İnek<br>Yönetmen Adı"><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Sek Günlük Süt "Heidi"';
	$thumbnailName = 'fk-sekgunluksut-heidi';
	$vimeoID = 32209948;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Sek Günlük Süt "Sütçü"';
	$thumbnailName = 'fk-sekgunluksut-sutcu';
	$vimeoID = 32209272;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Fiat "Zaman Makinesi"';
	$thumbnailName = 'tbk-fiat-zamanmakinesi';
	$vimeoID = 28496577;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Trakya Birlik "Birma"';
	$thumbnailName = 'ea-trakyabirlik-birma';
	$vimeoID = 28509174;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';

	$videoName = 'Trakya Birlik "Biryağ"';
	$thumbnailName = 'ea-trakyabirlik-biryag';
	$vimeoID = 28508350;
	$commandResult .= '<div class="movieThumbnail"><a href="http://player.vimeo.com/video/'.$vimeoID.'?title=0&amp;byline=0&amp;portrait=0" rel=""><div class="imgContainer"><img src="'.getScriptUrl().'img/movies/'.$thumbnailName.'.png" alt="" /></div></a><div class="label">'.$videoName.'</div></div>';
	
}



	
?>