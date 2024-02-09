<?php 
session_start();
ob_start();
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include ("ewconfig.php") ?>
<?php include ("db.php") ?>
<?php include ("fotografinfo.php") ?>
<?php include ("advsecu.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
if (!IsLoggedIn()) {
	ob_end_clean();
	header("Location: login.php");
	exit();
}
?>
<?php

// Get key
$x_id = @$_GET["id"];
if (!is_numeric($x_id)) {
	ob_end_clean();
	header("Location: fotograflist.php");
	exit();
}
if (($x_id == "") || (is_null($x_id))) {
	ob_end_clean();
	header("Location: fotograflist.php");
	exit();
}
$x_id = (get_magic_quotes_gpc()) ? stripslashes($x_id) : $x_id;
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
$sFilter = ewSqlKeyWhere;
$sFilter = str_replace("@id", AdjustSql($x_id), $sFilter);
$sSql = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");
$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
if (phpmkr_num_rows($rs) > 0) {
	$row = phpmkr_fetch_array($rs);
	if ($row["isim"]<> "") {
		header("Content-Disposition: attachment; filename=" . $row["isim"]);
	}
	ob_clean();
	echo $row["isim"];
}
phpmkr_free_result($rs);
phpmkr_db_close($conn);
?>
