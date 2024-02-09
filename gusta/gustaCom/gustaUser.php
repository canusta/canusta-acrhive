<?php
session_start();
if( !empty( $_SESSION['login'] ) ) {
	$userArr = $_SESSION['login'];
}
else {
	header( "Location: index.php" );
}
