<?php 
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
<?php include ("phpmkrfn.php") ?>
<?php
define("LeftQuote", "`", true);
define("RightQuote", "`", true);
$QS = explode("&", $_SERVER['QUERY_STRING']);
if (is_array($QS)) {
	if (count($QS) >= 0 ) {
		$LookupTableName = EW_GetValue("ltn", $QS);
		$LinkFieldName = EW_GetValue("lfn", $QS);
		$DisplayFieldName = EW_GetValue("dfn", $QS);
		$DisplayField2Name = EW_GetValue("df2n", $QS);
		$LinkField = EW_GetValue("lf", $QS);
		if ($DisplayFieldName == $LinkFieldName) {
			$DisplayField = $LinkField;
		} else {
			$DisplayField = EW_GetValue("df", $QS);
		}
		if ($DisplayField2Name == $LinkFieldName) {
			$DisplayField2 = $LinkField;
		} elseif ($DisplayField2Name == $DisplayFieldName) {
			$DisplayField2 = $DisplayField;
		} else {
			$DisplayField2 = EW_GetValue("df2", $QS);
		}
		$LinkFieldQuote = str_replace("\'","'",EW_GetValue("lfq", $QS));
		$DisplayFieldQuote = str_replace("\'","'",EW_GetValue("dfq", $QS));
		$DisplayField2Quote = str_replace("\'","'",EW_GetValue("df2q", $QS));
	} else {
		ob_end_clean();
		print "Invalid Parameter";
		exit();
	}
} else {
	ob_end_clean();
	print "Invalid Parameter";
	exit();
}
if ($LookupTableName == "") {
	ob_end_clean();
	print "Missing lookup table name";
	exit();
}
if ($DisplayFieldName == "") {
	ob_end_clean();
	print "Missing display field name";
	exit();
}
$bUseLinkField = (($LinkFieldName <> "") And ($LinkField <> ""));
$bUseDisplayField = (($DisplayFieldName <> "") And ($DisplayFieldName <> $LinkFieldName) And ($DisplayField <> ""));
$bUseDisplayField2 = (($DisplayField2Name <> "") And ($DisplayField2Name <> $LinkFieldName) And ( $DisplayField2Name <> $DisplayFieldName) And ($DisplayField2 <> ""));
$sSql = "";
if ($bUseLinkField) {
	$sSql .= LeftQuote . $LinkFieldName . RightQuote;
}
if ($bUseDisplayField) {
	if ($sSql <> "") $sSql .= ", ";
	$sSql .= LeftQuote . $DisplayFieldName . RightQuote;
}
if ($bUseDisplayField2) {
	if ($sSql <> "") $sSql .= ", ";
	$sSql .= LeftQuote . $DisplayField2Name . RightQuote;
}
$sSql = "SELECT DISTINCT " . $sSql .""; 
$sSql .= " FROM " . LeftQuote . $LookupTableName . RightQuote;
$Where = "";
if ($bUseLinkField) {
	$Where = LeftQuote . $LinkFieldName . RightQuote . "=" . $LinkFieldQuote . $LinkField . $LinkFieldQuote;
}
if ($bUseDisplayField) {
	if ($Where <> "") $Where .= " AND ";
	$Where .= LeftQuote . $DisplayFieldName . RightQuote . "=" . $DisplayFieldQuote . AdjustSql($DisplayField) . $DisplayFieldQuote;
}
if ($bUseDisplayField2) {
	if ($Where <> "") $Where .= " AND ";
	$Where .= LeftQuote . $DisplayField2Name . RightQuote . "=" . $DisplayField2Quote . AdjustSql($DisplayField2) . $DisplayField2Quote;
}
$sSql .= " WHERE " . $Where;
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $sSql);
if (phpmkr_num_rows($rs) == 0 ) { // Add new option
	$FieldList = "";
	$ValueList = "";
	if ($bUseLinkField) {
		$FieldList .= LeftQuote . $LinkFieldName . RightQuote;
		$tmpValue = (!get_magic_quotes_gpc()) ? addslashes($LinkField) : $LinkField; 
		$tmpValue = ($tmpValue != "") ? $LinkFieldQuote . AdjustSql($tmpValue) . $LinkFieldQuote : "NULL";
		$ValueList .= $tmpValue;
	}
	if ($bUseDisplayField) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= LeftQuote . $DisplayFieldName . RightQuote;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = (!get_magic_quotes_gpc()) ? addslashes($DisplayField) : $DisplayField; 
		$tmpValue = ($tmpValue != "") ? $DisplayFieldQuote . $tmpValue . $DisplayFieldQuote : "NULL";
		$ValueList .= $tmpValue;
	}
	if ($bUseDisplayField2) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= LeftQuote . $DisplayField2Name . RightQuote;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = (!get_magic_quotes_gpc()) ? addslashes($DisplayField2) : $DisplayField2; 
		$tmpValue = ($tmpValue != "") ? $DisplayField2Quote . $tmpValue . $DisplayField2Quote : "NULL";
		$ValueList .=  $tmpValue;
	}
	$insertSql = "INSERT INTO " . LeftQuote . $LookupTableName . RightQuote . " (" . $FieldList . ") VALUES (" . $ValueList . ")";
	$result = phpmkr_query($insertSql, $conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $insertSql);
} else {
	@phpmkr_free_result($rs);
	@phpmkr_db_close($conn);
	ob_end_clean();
	print "Option already exists";
	exit();
}
phpmkr_free_result($rs);
$rs = NULL;
if ($LinkField == "") { // Get new link field value
	$sSql = "SELECT " . LeftQuote . $LinkFieldName . RightQuote . " FROM " . LeftQuote . $LookupTableName . RightQuote . " WHERE " . $Where;
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $sSql);
	if ($line = phpmkr_fetch_row($rs)) {
		$LinkField = $line[0];
		if ($DisplayFieldName == $LinkFieldName) $DisplayField = $LinkField;
		if ($DisplayField2Name == $LinkFieldName) $DisplayField2 = $LinkField;
	}
	@phpmkr_free_result($rs);
}
@phpmkr_db_close($conn);
ob_end_clean();
print "OK\r";
print ewConvertToUtf8($LinkField) . "\r";
print ewConvertToUtf8($DisplayField) . "\r";
print ewConvertToUtf8($DisplayField2);
exit();
?>
