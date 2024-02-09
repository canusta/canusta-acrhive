<?php


global $commandResult;


/* $gonder_isim=$_POST["adsoyad"]; */
$gonder_mail=$_POST["email"];
$alan_isim='Can Usta';
$alan_mail='eda.sahin@kavuklar.com.tr';
/* $alan_mail='canusta@gmail.com'; */
$baslik='Ege Bornova mail listesine yeni kayıt';
$email=$_POST["mesaj"];


$mailtanim = "MIME-Version: 1.0\r\n"; // bu kısım tanımlama kısmı
$mailtanim .= "Content-type: text/plain; charset=utf-8\r\n";
$mailtanim .= "From: $name <$gonder_mail>\r\n";
$mailtanim .= "Reply-To: $name <$gonder_mail>\r\n";


mail($alan_mail,$baslik,stripslashes($mesaj),$mailtanim);



$commandResult.="


<div class='pageContent'>
	
	<div id='iletisimFormuSent'>
		Teşekkürler
	</div>
	
</div>




"

	
?>


