<?php
function phpmkr_db_connect($HOST, $USER, $PASS, $DB, $PORT)
{
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
	return $conn;
}
function phpmkr_db_close($conn)
{
	mysql_close($conn);
}
function phpmkr_query($strsql, $conn)
{
	$rs = mysql_query($strsql, $conn);
	return $rs;
}
function phpmkr_num_rows($rs)
{
	return @mysql_num_rows($rs); 
}
function phpmkr_fetch_array($rs)
{
	return mysql_fetch_array($rs);
}
function phpmkr_fetch_row($rs)
{
	return mysql_fetch_row($rs);
}
function phpmkr_free_result($rs)
{
	@mysql_free_result($rs);
}
function phpmkr_data_seek($rs, $cnt)
{
	@mysql_data_seek($rs, $cnt);
}
function phpmkr_error($conn)
{
	return mysql_error($conn);
}
function phpmkr_insert_id($conn)
{
	return @mysql_insert_id($conn);
}
function phpmkr_affected_rows($conn)
{
	return @mysql_affected_rows($conn);
}
?>
<?php
define("HOST", "localhost");
define("PORT", 2082);
define("USER", "canusta_canusta");
define("PASS", "pricrithow");
define("DB", "canusta_gabriel2");
function AdjustSql($str) {
	$sWrk = trim($str);
	$sWrk = addslashes($sWrk);
	return $sWrk;
}
function ewBuildSql($sSelect, $sWhere, $sGroupBy, $sHaving, $sOrderBy, $sFilter, $sSort) {
	$sDbWhere = $sWhere;
	if ($sDbWhere <> "") {
		$sDbWhere = "(" . $sDbWhere . ")";
	}
	if ($sFilter <> "") {
		if ($sDbWhere <> "") $sDbWhere .= " AND ";
		$sDbWhere .= "(" . $sFilter . ")";
	}
	$sDbOrderBy = $sOrderBy;
	if ($sSort <> "") {
		$sDbOrderBy = $sSort;
	}
	$sSql = $sSelect;
	if ($sDbWhere <> "") {
		$sSql .= " WHERE " . $sDbWhere;
	}
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	If ($sDbOrderBy <> "") {
		$sSql .= " ORDER BY " . $sDbOrderBy;
	}
	return $sSql;
}
?>
