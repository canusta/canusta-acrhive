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
<?php include ("programinfo.php") ?>
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
$x_gun = NULL;
$ox_gun = NULL;
$z_gun = NULL;
$ar_x_gun = NULL;
$ari_x_gun = NULL;
$x_gunList = NULL;
$x_gunChk = NULL;
$cbo_x_gun_js = NULL;
$x_mekan = NULL;
$ox_mekan = NULL;
$z_mekan = NULL;
$ar_x_mekan = NULL;
$ari_x_mekan = NULL;
$x_mekanList = NULL;
$x_mekanChk = NULL;
$cbo_x_mekan_js = NULL;
?>
<?php

// Get key
$x_id = @$_GET["id"];
if (($x_id == "") || (is_null($x_id))) {
	ob_end_clean();
	header("Location: programlist.php");
	exit();
}
if (!is_numeric($x_id)) {
	ob_end_clean();
	header("Location: programlist.php");
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
			header("Location: programlist.php");
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
<p><span class="phpmaker">View TABLE: program<br><br>
<a href="programlist.php">Back to List</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "programedit.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Edit</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "programadd.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Copy</a>&nbsp;
<a href="<?php if ($x_id <> "") {echo "programdelete.php?id=" . urlencode($x_id); } else { echo "javascript:alert('Invalid Record! Key is null');";} ?>">Delete</a>&nbsp;
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
		<td class="ewTableHeader"><span>gun</span></td>
		<td class="ewTableAltRow"><span>
<?php echo $x_gun; ?>
</span></td>
	</tr>
	<tr>
		<td class="ewTableHeader"><span>mekan</span></td>
		<td class="ewTableAltRow"><span>
<?php echo $x_mekan; ?>
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
		$GLOBALS["x_gun"] = $row["gun"];
		$GLOBALS["x_mekan"] = $row["mekan"];
	}
	phpmkr_free_result($rs);
	return $bLoadData;
}
?>
