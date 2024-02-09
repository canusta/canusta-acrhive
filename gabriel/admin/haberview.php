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
<?php include ("haberinfo.php") ?>
<?php include ("advsecu.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include ("ewupload.php") ?>
<?php
if (!IsLoggedIn()) {
	ob_end_clean();
	header("Location: login.php");
	exit();
}
?>
<?php

// Initialize common variables
$x_id = NULL;
$ox_id = NULL;
$z_id = NULL;
$ar_x_id = NULL;
$ari_x_id = NULL;
$x_idList = NULL;
$x_idChk = NULL;
$cbo_x_id_js = NULL;
$x_tarih = NULL;
$ox_tarih = NULL;
$z_tarih = NULL;
$ar_x_tarih = NULL;
$ari_x_tarih = NULL;
$x_tarihList = NULL;
$x_tarihChk = NULL;
$cbo_x_tarih_js = NULL;
$x_metin = NULL;
$ox_metin = NULL;
$z_metin = NULL;
$ar_x_metin = NULL;
$ari_x_metin = NULL;
$x_metinList = NULL;
$x_metinChk = NULL;
$cbo_x_metin_js = NULL;
?>
<?php

// Get key
$x_id = @$_GET["id"];
if (($x_id == "") || (is_null($x_id))) {
	ob_end_clean();
	header("Location: haberlist.php");
	exit();
}
if (!is_numeric($x_id)) {
	ob_end_clean();
	header("Location: haberlist.php");
	exit();
}

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display record
}

// Open connection to the database
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction)
{
	case "I": // Display record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: haberlist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<script type="text/javascript">
<!--
EW_LookupFn = "ewlookup.php"; // ewlookup file name
EW_AddOptFn = "ewaddopt.php"; // ewaddopt.php file name
EW_MultiPagePage = "Page"; // multi-page Page Text
EW_MultiPageOf = "of"; // multi-page Of Text

//-->
</script>
<script type="text/javascript" src="ewp.js"></script>
<p><span class="phpmaker">View TABLE: haber<br><br>
<a href="haberlist.php">Back to List</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "haberedit.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Edit</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "haberadd.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Copy</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "haberdelete.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Delete</a>&nbsp;
</span></p>
<p>
<form>
<table class="ewTable">
	<tr>
		<td class="ewTableHeader"><span>id</span></td>
		<td class="ewTableAltRow"><span>
<?php echo $x_id; ?>
</span></td>
	</tr>
	<tr>
		<td class="ewTableHeader"><span>tarih</span></td>
		<td class="ewTableAltRow"><span>
<?php echo $x_tarih; ?>
</span></td>
	</tr>
	<tr>
		<td class="ewTableHeader"><span>metin</span></td>
		<td class="ewTableAltRow"><span>
<?php echo $x_metin; ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Variables setup: field variables

function LoadData($conn)
{
	global $x_id;
	$sFilter = ewSqlKeyWhere;
	if (!is_numeric($x_id)) return false;
	$x_id =  (get_magic_quotes_gpc()) ? stripslashes($x_id) : $x_id;
	$sFilter = str_replace("@id", AdjustSql($x_id), $sFilter); // Replace key value
	$sSql = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$bLoadData = false;
	} else {
		$bLoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_id"] = $row["id"];
		$GLOBALS["x_tarih"] = $row["tarih"];
		$GLOBALS["x_metin"] = $row["metin"];
	}
	phpmkr_free_result($rs);
	return $bLoadData;
}
?>
