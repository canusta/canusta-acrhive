<?php


global $commandResult;

$commandResult.="


<div class='pageContent'>
	
	<div id='iletisimFormu'>
		<form action='https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8' method='post' name='' id='iletisimFormuForm'>
			<input type=hidden name='oid' value='00DD0000000CwlE'>
			<input type=hidden name='retURL' value='".getScriptUrl().$lang."/noIntro'>
			<input id='iletisimFormuAd' class='iletisimFormuTextField' type='text' name='first_name' placeholder='Adınız' />
			<input id='iletisimFormuSoyad' class='iletisimFormuTextField' type='text' name='last_name' placeholder='Soyadınız' />
			<input id='iletisimFormuTelefon' class='iletisimFormuTextField' type='text' name='mobile' placeholder='Telefonunuz' />
			<input id='iletisimFormuSabitTelefon' class='iletisimFormuTextField' type='text' name='phone' placeholder='Sabit Telefonunuz' />
			<input id='iletisimFormuEMail' class='iletisimFormuTextField' type='text' name='email' placeholder='E-Mailınız' />
			<input id='iletisimFormuAdres' class='iletisimFormuTextField' type='text' name='street' placeholder='Adresiniz' />
			<textarea id='iletisimFormMessage' class='iletisimFormuTextArea' name='message' placeholder='Mesajınız'></textarea>
			<div id='formSubmit' class='iletisimFormuSubmit'>GÖNDER</div>
			<span class='iletisimFormuMail'><a href='mailto:info@egebornova.com.tr' target='_blank'>info@egebornova.com.tr</a></span>
		</form>
	</div>
	
</div>




"

	
?>


