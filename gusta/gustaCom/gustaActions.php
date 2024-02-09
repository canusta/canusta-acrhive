<?php

ob_start();

$action = !empty( $_POST['action'] ) ? $_POST['action'] : $_GET['action'];

mysql_connect( 'localhost','canusta_gusta','gustam' ) or die( 'olmuyor abicim' );
mysql_select_db( 'canusta_gusta' );

switch( $action ) {
	case 1: // REGISTERATION PROCESS
		$queryCheck = "SELECT userID FROM gustaUsers WHERE userName='" . $_POST['user'] . "'";
		$resultCheck = mysql_query( $queryCheck );
		$checkNoline = mysql_num_rows( $resultCheck );
		if( $checkNoline > 0 ) {
			header( "Location: index.php?page=1" );
		}
		else {
			$userName = $_POST['user'];
			$userPass = md5( $_POST['pass'] );
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$tel = $_POST['tel'];
			$email = $_POST['email'];
			$regDate = time();
			$queryInsert = "INSERT INTO gustaUsers (userName,userPass,name,surname,tel,email,regDate,userCon) VALUES ('" . $userName . "','" . $userPass . "','" . $name . "','" . $surname . "','" . $tel ."','" . $email . "'," . $regDate . ",0)";
			$resultInsert = mysql_query( $queryInsert );
			if( $resultInsert ) {
				$mailSubject = 'Gusta | Üyelik Aktivasyonu';
				$mailText = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" /><title>GUSTA</title></head><body marginheight="0" marginwidth="0" bgcolor="#DEC171"><table width="600" height="450" border="0" align="center" cellpadding="0" cellspacing="0" background="http://www.canusta.com/gusta/gustaCom/gustaPics/back.gif" style="border:1px dashed #584234;"><tr><td height="85"><img src="http://www.canusta.com/gusta/gustaCom/gustaPics/gusta.gif" alt="gusta" style="border-right:1px dashed #584234;"></td></tr><tr><td valign="top" style="border-top:1px dashed #584234;"><p style="padding:25px;color:#584234;font:normal 12px/18px Arial, Helvetica, sans-serif;">';
				$mailText .= 'Gusta\'ya &uuml;ye oldu&#287;unuz i&ccedil;in te&#351;ekk&uuml;r ederiz.<br />L&uuml;tfen a&#351;a&#287;&#305;daki linke t&#305;klayarak &uuml;yeli&#287;inizi aktif hale getiriniz.<br /><br />';
				$mailText .= '<a href="http://www.canusta.com/gusta/gustaCom/gustaActions.php?action=4&activate=' . md5( $userName ) . '" style="color:#584234;font : normal 12px/18px Arial, Helvetica, sans-serif;">Aktive Et</a>';
				$mailText .= '</td></tr></table></body></html>';
				$headers .= "X-Sender: Gusta Müsteri Hizmetleri<subliminal@canusta.com>\n";
				$headers .= "X-Mailer: PHP\n";
				$headers .= "X-Priority: 3\n";
				$headers .= "Return-Path: <subliminal@canusta.com>\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				//$MailExtra = "From: Gusta Müsteri Hizmetleri<subliminal@canusta.com>\n X-Mailer: PHP\n X-Priority: 1\n Content-Type:text/html; charset=\"windows-1254\"\n Content-Transfer-Encoding: 8bit\n";
				if( mail( $email, $mailSubject, $mailText, $headers ) ) {
					header( "Location: index.php?warn=1" );
				}
				else {
					header( "Location: index.php?page=1" );
				}
			}
			else {
				header( "Location: index.php?page=1" );
			}
		}
	break;
	
	case 2: // LOGIN PROCESS
		session_start();
		$userName = $_POST['user'];
		$userPass = md5( $_POST['pass'] );
		function SecureSql( $value ) {
    		if ( get_magic_quotes_gpc() ) {
        		$value = stripslashes( $value );
    		}
    		if ( !is_numeric( $value ) ) {
				$value = "'" . mysql_real_escape_string($value) . "'";
    		}
			return $value;
		}
		$queryCheck = sprintf( "SELECT * FROM gustaUsers WHERE userName=%s AND userPass=%s", SecureSql( $userName ), SecureSql( $userPass ) );
		$resultCheck = mysql_query( $queryCheck );
		$resultNo = mysql_num_rows( $resultCheck );
		$resultLine = mysql_fetch_array( $resultCheck );
		if( $resultNo == 1 AND $resultLine['userCon'] == 1 ) {
			$_SESSION['login'] = array( $resultLine['userID'], $userName );
			header( "Location: index.php?page=3" );
		}
		else{
			header( "Location: index.php?page=" );
		}
	break;
	case 3: // ADDING COMMENT
		include "gustaUser.php";
		$comment = addslashes( $_POST['comment'] );
		$commentDate = time();
		$queryAdd = "INSERT INTO gustaComments (userID,comment,commentDate,commentCon) VALUES (" . $userArr[0] . ",'" . $comment . "'," . $commentDate . ",1)";
		$resultAdd = mysql_query( $queryAdd );
		if( $resultAdd ) {
			header( "Location: index.php?page=3" );
		}
	break;
	case 4: // ACTIVATE USER
		$queryAct = "UPDATE gustaUsers SET userCon=1 WHERE MD5(userName)='" . $_GET['activate'] . "'";
		$resultAct = mysql_query( $queryAct );
		header( "Location: index.html" );
	break;
}
mysql_close();
?>