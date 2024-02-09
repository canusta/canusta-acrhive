<?php
ob_start();
$page = !empty( $_GET['page'] ) ? $_GET['page'] : 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>G U S T A</title>
<script language="JavaScript" type="text/javascript">
<!--
function showWarn(){
	displayRule = document.getElementById( 'warning' ).style.display == 'none' ? 'block' : 'none';
	document.getElementById( 'warning' ).style.display = displayRule;
}
-->
</script>
<style type="text/css">
<!--
body {
	margin : 0;
	padding : 0;
	background : #DEC171 url(gustaPics/back.gif) top left no-repeat;
}
#header {
	height : 85px;
}
#header img {
	border-right : 1px dashed #584234;
	float : left;
}
#container {
	margin : 0;
	padding : 20px 25px 25px 25px;
	border-top : 1px dashed #584234;
}
.title {
	display : block;
	height : 20px;
	margin-top : 8px;
	border-bottom : 1px solid #8E8773;
	text-decoration : none;
	color : #554e35;
	font : bold 16px/16px "Times New Roman", Times, serif;
}
.title:hover {
	color : #FFFFFF;
}
form {
	margin : 0;
	padding : 0;
}
font, .link {
	font : normal 10px/18px Arial, Helvetica, sans-serif;
	color : #584234;
}

.link {
	float : right;
	height : 20px;
	margin : 0;
	padding : 65px 10px 0 10px;
	border-left : 1px dashed #584234;
	text-decoration : none;
}
.link:hover {
	color : #000000;
}

input, textarea {
	margin-bottom : 5px;
	border : 1px solid #584234;
	background : none;
	color : #584234;
}
.button {
	margin-top : 10px;
	padding : 0 10px 0 10px;
	background-color : #e5cc7a;
}
p, h2 {
	margin : 0;
	padding : 0;
	font : normal 12px/18px Arial, Helvetica, sans-serif;
	color : #584234;
}
h2 {
	padding-top :10px;
	text-align : right;
}
#navi {
	border-top : 1px dashed #584234;
	padding-top : 5px;
	text-align : center;
}
#navi a, font{
	font : normal 12px/18px Arial, Helvetica, sans-serif;
	color : #584234;
	text-decoration : none;
	padding : 3px;
}
#navi a:hover {
	font-weight : bold;
	color : #000000;
}
#warning {
	position : absolute;
	z-index : 10;
	width : 300px;
	height : 60px;
	background-color : #e5cc7a;
	top : 175px;
	left : 150px;
	text-align : center;
	padding : 10px;
}

	
-->
</style>
</head>
<body>
<?php
switch( $page ) {
	case 0: // LOGIN PAGE
?>
<div id="header"><img src="gustaPics/gusta.gif" alt="GUSTA" /><a href="?page=1" class="link">KAYIT OL</a></div>
<div id="container">
	<form id="form1" name="form1" method="post" action="gustaActions.php">
		<input name="action" type="hidden" value="2" />
		<font>KULLANICI ADINIZ</font>
		<br />
		<input name="user" type="text" size="25" maxlength="15" />
		<br />
		<font>&#350;&#304;FREN&#304;Z</font>
		<br />
		<input name="pass" type="password" id="pass" size="25" maxlength="15" />
		<br />
	    <input type="submit" name="Submit" value="Gir" class="button" />
	</form>
</div>

<?php
	break;
	case 1: // REGISTER PAGE
?>
<div id="header"><img src="gustaPics/gusta.gif" alt="GUSTA" /><a href="?page=" class="link">G&#304;R&#304;&#350; SAYFASI</a></div>
<div id="container">
	<form id="form1" name="form1" method="post" action="gustaActions.php">
		<input name="action" type="hidden" value="1" />
		<font>KULLANICI ADINIZ</font>
		<br />
		<input name="user" type="text" size="25" maxlength="15" />
		<br />
		<font>&#350;&#304;FREN&#304;Z</font>
		<br />
		<input name="pass" type="password" id="pass" size="25" maxlength="15" />
		<br />
		<font>&#350;&#304;FREN&#304;Z TEKRAR</font>
		<br />
		<input name="check" type="password" id="check" size="25" maxlength="15" />
		<br />
		<font>ADINIZ</font>
		<br />
		<input name="name" type="text" size="25" maxlength="25" />
		<br />
		<font>SOYADINIZ</font>
		<br />
		<input name="surname" type="text" size="25" maxlength="25" />
		<br />
		<font>CEP TELEFONU NUMARANIZ</font>
		<br />
		<input name="tel" type="text" size="25" maxlength="11" />
		<br />
		<font>E-POSTA ADRES&#304;N&#304;Z</font>
		<br />
		<input name="email" type="text" size="25" maxlength="50" />
		<br />
	    <input name="Submit2" type="submit" class="button" value="Kay&#305;t Ol" />
	</form>
</div>

<?php
	break;
	case 2: // ADD COMMENT PAGE
		include "gustaUser.php";
?>
<div id="header"><img src="gustaPics/gusta.gif" alt="GUSTA" /><a href="?page=3" class="link">YORUMLARI OKU</a></div>
<div id="container">
	<form id="form1" name="form1" method="post" action="gustaActions.php">
  		<input name="action" type="hidden" value="3" />
  		<font>YORUMUNUZ</font>
		<br />
    	<textarea name="comment" cols="25" rows="5"></textarea>
		<br />
	    <input type="submit" name="Submit" value="Yazd&#305;r" class="button" />
  </form>
</div>
<?php
	break;
	case 3: // VIEWING COMMENT
		mysql_connect( 'localhost','canusta_gusta','gustam' ) or die( 'olmuyor abicim' );
		mysql_select_db( 'canusta_gusta' );
		
		$queryPaginate = "SELECT commentId FROM gustaComments WHERE commentCon=1";
		$resultPaginate = mysql_query( $queryPaginate );
		$noRecord = mysql_num_rows( $resultPaginate );
		$limit = 5;
		$start = !empty( $_GET['start'] ) ? $_GET['start'] : 0;
		
		if( $noRecord > $limit ) {
			if( $start == 0 ) {
				$previous = '<font>&gt;</font>';
			}
			else {
				$preLevel = $start - $limit;
				$previous = '<a class="pagination" href="?page=3&start=' . $preLevel . '">&gt;</a>';
			}
			if ( ( $start + $limit ) < $noRecord ) {
				$postLevel = $start + $limit;
				$after = '<a href="?page=2&start=' . $PostLevel . '">&lt;</a>';
			}
			else {
				$after = '<font>&lt;</font>';
			}
			$curIndex = ( $start / $limit ) + 1;
			$totalIndex = ( ( $noRecord - 1 ) / $limit ) + 1;
			$pagination = '';
			for ( $i = 1; $i <= $totalIndex; $i++ ) {
				$startLevel = ( $i-1 ) * $limit;
				if ( $i == $curIndex ) {
					$pagination .= '<font>' . $i . '</font>';
				}
				else {
					$pagination .= '<a href="?page=3&start=' . $startLevel . '">' . $i . '</a>';
				}
			}
		}
		else {
			$after = '';
			$previous = '';
			$pagination = '';
		}
		$pagLine = '<div id="navi">' . $after . $pagination . $previous . '</div>';
?>
<div id="header"><img src="gustaPics/gusta.gif" alt="GUSTA" /><a href="?page=2" class="link">YORUM YAZ</a></div>
<?php
		
		$queryView = "SELECT gc.comment,gc.commentDate,gu.userName FROM gustaComments AS gc, gustaUsers AS gu WHERE gc.userId=gu.userId AND gc.commentCon=1 ORDER BY gc.commentDate DESC LIMIT " . $start . "," . $limit;
		$resultView = mysql_query( $queryView );
		$comments = '';
		while( $viewLine = mysql_fetch_array( $resultView ) ) {
			$comments .= '<div id="container"><p>' . stripslashes( $viewLine['comment'] ) . '</p><h2>' . $viewLine['userName'] . ' | ' . date( "d.m.Y H:i", $viewLine['commentDate'] ) . '</h2></div>' . "\n";
		}
		echo $comments;
		echo $pagLine;
	break;
}
?>
<?php
$warn = "Kay&#305;t oldu&#287;unuz i&ccedil;in te&#351;ekk&uuml;r ederiz. &Uuml;yelik aktivasyonu i&ccedil;in size g&ouml;nderilen e-postay&#305; okuyunuz.";

if( !empty( $_GET['warn'] ) ) {
	echo '<div id="warning" style="display:block;"><p>' . $warn . '<br /><a href="javascript:showWarn()" style="text-decoration:none;color:#666666;">&#304;letiyi Kapat</a></p></div>';
}
?>
</body>
</html>