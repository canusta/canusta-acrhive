<html>
<head>
<META http-equiv="content-type" content="text/html; charset=windows-iso-8859">
<META http-equiv="content-type" content="text/html; charset=ISO-8859-9">
<META http-equiv="content-language" content="TR">
<title>Untitled Document</title>
</head>

<body>

<?
	$username="canusta_canusta";
	$password="pricrithow";
	$database="canusta_gabriel2";

	mysql_connect(localhost,$username,$password) or die(mysql_error());
	@mysql_select_db($database) or die( "Unable to select database");
	@mysql_query("SET NAMES 'latin5'");
	
	$query  = "SELECT * FROM haber ORDER BY id DESC";
	$result = mysql_query($query);
	$result2 = mysql_query($query);
	
	$i = 0;
	
	print "&haberler=";
	while ($row = mysql_fetch_assoc($result)) {
		//$row['email']
		print htmlspecialchars($row['metin']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
		$i++;
	}
	
	$i--;
	print "&habersayisi=".$i;
	
	$i2 = 0;
	
	print "&tarihler=";
	while ($row2 = mysql_fetch_assoc($result2)) {
		//$row['email']
		print $row2['tarih'].",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
		$i2++;
	}
	
	
	
	
	
	$query2  = "SELECT * FROM gabriel ORDER BY orders ASC";
	$result3 = mysql_query($query2);
	
	print "&kisiler=";
	while ($row3 = mysql_fetch_assoc($result3)) {
		//$row['email']
		print htmlspecialchars($row3['isim']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}

	$result4 = mysql_query($query2);
	
	print "&gabrielmetin=";
	while ($row4 = mysql_fetch_assoc($result4)) {
		//$row['email']
		print htmlspecialchars($row4['metin']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}
	
	
	
	
	$query3  = "SELECT * FROM konser ORDER BY orders ASC";
	$result5 = mysql_query($query3);
	
	print "&konserbaslik=";
	while ($row5 = mysql_fetch_assoc($result5)) {
		//$row['email']
		print htmlspecialchars($row5['baslik']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}

	$result6 = mysql_query($query3);
	
	print "&konsermetin=";
	while ($row6 = mysql_fetch_assoc($result6)) {
		//$row['email']
		print htmlspecialchars($row6['metin']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}
	
	
	
	
	$query4  = "SELECT * FROM program ORDER BY id ASC";
	$result7 = mysql_query($query4);
	
	print "&mekan=";
	while ($row7 = mysql_fetch_assoc($result7)) {
		//$row['email']
		print htmlspecialchars($row7['mekan']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}
	
	
	
	
	$query5  = "SELECT * FROM seri ORDER BY id DESC";
	$result8 = mysql_query($query5);
	
	print "&seriler=";
	while ($row8 = mysql_fetch_assoc($result8)) {
		//$row['email']
		print htmlspecialchars($row8['isim']).",_";
		//echo "&habertarihi[".$i."]=".$row['tarih'];
	}
	
	
	
	
	$query7  = "SELECT * FROM seri ORDER BY id DESC";
	$result10 = mysql_query($query7);
	
	$o = 1;
	
	while ($row10 = mysql_fetch_assoc($result10)) {
		//$row['email']
		echo "&seri".$o."=";
		$siradaki = $row10['id'];
		$query6  = "SELECT * FROM fotograf WHERE seri='$siradaki' ORDER BY id DESC";
		$result9 = mysql_query($query6);
		
		while ($row9 = mysql_fetch_assoc($result9)) {
			print htmlspecialchars($row9['isim']).",_";
		}	

		$o++;
		
	}
	
	$query8  = "SELECT * FROM seri ORDER BY id DESC";
	$result11 = mysql_query($query8);
	
	$o = 1;
	
	while ($row11 = mysql_fetch_assoc($result11)) {
		//$row['email']
		echo "&full".$o."=";
		$siradaki2 = $row11['id'];
		$query9  = "SELECT * FROM fotograf WHERE seri='$siradaki2' ORDER BY id DESC";
		$result12 = mysql_query($query9);
		
		while ($row12 = mysql_fetch_assoc($result12)) {
			print htmlspecialchars($row12['fullview']).",_";
		}	

		$o++;
		
	}


?>