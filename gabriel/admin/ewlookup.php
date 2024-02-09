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
$sArr = explode("&", $_SERVER['QUERY_STRING']);
if (is_array($sArr)) {
	if (count($sArr) >= 0) {
		$sSql = EW_GetValue("s", $sArr);
		$sSql = TEAdecrypt($sSql, EW_RANDOM_KEY);
		$value = EW_GetValue("q", $sArr);
		if (($sSql <> "") And ($value <> ""))
			$sSql = str_replace("@FILTER_VALUE", addslashes($value), $sSql);
		ob_clean();
		EW_GetLookupValues($sSql);
	}
}
function EW_GetLookupValues($sSql)
{
	$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
	$rswrk = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $sSql);
	if ($rswrk) {
		$rowcntwrk = 0;
		while ($line = phpmkr_fetch_row($rswrk)) {
			for ($i=0; $i<count($line); $i++) {
				if (strlen($line[$i]) > 0) {
					$line[$i] = str_replace("\n", " ", $line[$i]);
					$line[$i] = str_replace("\r", " ", $line[$i]);
					$line[$i] = str_replace("\l", " ", $line[$i]);
				}
				print ewConvertToUtf8($line[$i]) . "\r";
			}
		}
	}
}
?>
