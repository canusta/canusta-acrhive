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
$x_isim = NULL;
$ox_isim = NULL;
$z_isim = NULL;
$fs_x_isim = 0;
$fn_x_isim = "";
$ct_x_isim = "";
$wd_x_isim = 0;
$ht_x_isim = 0;
$a_x_isim = "";
$ar_x_isim = NULL;
$ari_x_isim = NULL;
$x_isimList = NULL;
$x_isimChk = NULL;
$cbo_x_isim_js = NULL;
$fs_x_isim = 0;
$fn_x_isim = "";
$ct_x_isim = "";
$wd_x_isim = 0;
$ht_x_isim = 0;
$a_x_isim = "";
$x_fullview = NULL;
$ox_fullview = NULL;
$z_fullview = NULL;
$fs_x_fullview = 0;
$fn_x_fullview = "";
$ct_x_fullview = "";
$wd_x_fullview = 0;
$ht_x_fullview = 0;
$a_x_fullview = "";
$ar_x_fullview = NULL;
$ari_x_fullview = NULL;
$x_fullviewList = NULL;
$x_fullviewChk = NULL;
$cbo_x_fullview_js = NULL;
$fs_x_fullview = 0;
$fn_x_fullview = "";
$ct_x_fullview = "";
$wd_x_fullview = 0;
$ht_x_fullview = 0;
$a_x_fullview = "";
$x_seri = NULL;
$ox_seri = NULL;
$z_seri = NULL;
$ar_x_seri = NULL;
$ari_x_seri = NULL;
$x_seriList = NULL;
$x_seriChk = NULL;
$cbo_x_seri_js = NULL;
?>
<?php
$arRecKey = NULL;

// Load key parameters
$sKey = "";
$bSingleDelete = true;
$x_id = @$_GET["id"];
if (($x_id == "") || (is_null($x_id))) {
	$bSingleDelete = false;
} else {
	if ($sKey <> "") $sKey .= ",";
	$sKey .= $x_id;
	if (!is_numeric($x_id)) {
		ob_end_clean();
		header("Location: fotograflist.php");
		exit();
	}
}
if (!$bSingleDelete) $sKey = @$_POST["key_d"];
if (!is_array($sKey)) {
 if (strlen($sKey) > 0) $arRecKey = split(",", $sKey);
} else {
 $sKey = implode(",", $sKey);
 $arRecKey = split(",", $sKey);
}
if (count($arRecKey) <= 0) {
	ob_end_clean();
	header("Location: fotograflist.php");
	exit();
}
$sKey = implode(",", $arRecKey);
$i = 0;
$sDbWhere = "";
while ($i < count($arRecKey)) {
	$sDbWhere .= "(";

	// Remove spaces
	$sRecKey = trim($arRecKey[$i+0]);
	$sRecKey = (!get_magic_quotes_gpc()) ? addslashes($sRecKey) : $sRecKey ;

	// Build the SQL
	$sDbWhere .= "`id`=" . $sRecKey . " AND ";
	if (substr($sDbWhere, -5) == " AND ") { $sDbWhere = substr($sDbWhere, 0, strlen($sDbWhere)-5) . ") OR "; }
	$i += 1;
}
if (substr($sDbWhere, -4) == " OR ") { $sDbWhere = substr($sDbWhere, 0 , strlen($sDbWhere)-4); }

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display record
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: fotograflist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION[ewSessionMessage] = "Delete Successful";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: fotograflist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Delete from TABLE: fotograf<br><br><a href="fotograflist.php">Back to List</a></span></p>
<form action="fotografdelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo htmlspecialchars($sKey); ?>">
<table class="ewTable">
	<tr class="ewTableHeader">
		<td valign="top"><span>isim</span></td>
		<td valign="top"><span>seri</span></td>
	</tr>
<?php
$nRecCount = 0;
$i = 0;
while ($i < count($arRecKey)) {
	$nRecCount++;

	// Set row color
	$sItemRowClass = " class=\"ewTableRow\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " class=\"ewTableAltRow\"";
	}
	$sRecKey = trim($arRecKey[$i+0]);
	$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
	$x_id = $sRecKey;
	if (!is_numeric($x_id)) {
		ob_end_clean();
		header("Location: fotograflist.php");
		exit();
	}
	if (LoadData($conn)) {
?>
	<tr<?php echo $sItemRowClass;?>>
		<td><span>
<?php if ((!is_null($x_isim)) &&  $x_isim <> "") { ?>
<img src="<?php echo ewUploadPathEx(False, EW_UploadDestPath) . $x_isim ?>" border=0>
<?php } ?>
</span></td>
		<td><span>
<?php
if ((!is_null($x_seri)) && ($x_seri <> "")) {
	$sSqlWrk = "SELECT `isim` FROM `seri`";
	$sTmp = $x_seri;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE `id` = " . $sTmp . "";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["isim"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_seri = $x_seri; // Backup original value
$x_seri = $sTmp;
?>
<?php echo $x_seri; ?>
<?php $x_seri = $ox_seri; // Restore original value ?>
</span></td>
	</tr>
<?php
	}
	$i += 1;
}
?>
</table>
<p>
<input type="submit" name="Action" value="CONFIRM DELETE">
</form>
<?php include ("footer.php") ?>
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
		$GLOBALS["x_isim"] = $row["isim"];
		$GLOBALS["x_fullview"] = $row["fullview"];
		$GLOBALS["x_seri"] = $row["seri"];
	}
	phpmkr_free_result($rs);
	return $bLoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey, $conn)
{
	global $x_id;
	$sFilter = $sqlKey;
	$sSql = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");	
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey, $conn)
{
	global $x_id;
	$sFilter = $sqlKey;

	// Backup the record before delete
	$sSql = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");
	$query = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($temp = phpmkr_fetch_array($query)) {
		$oldrs[] = $temp;
	}

	// Delete
	$sSql = "DELETE FROM `fotograf`";
	$sWhere = "";
	if ($sFilter <> "") {
		if ($sWhere <> "") $sWhere .= " AND ";
		$sWhere .= $sFilter;
	}
	if ($sWhere <> "") {
		$sSql .= " WHERE " . $sWhere;
	}

	// Deleting event
	if (Recordset_Deleting($oldrs)) {
			foreach ($oldrs as $row) {
				@unlink(ewUploadPathEx(True, EW_UploadDestPath) . $row["isim"]);
			}
			foreach ($oldrs as $row) {
				@unlink(ewUploadPathEx(True, EW_UploadDestPath) . $row["fullview"]);
			}
		phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$result = (phpmkr_affected_rows($conn) > 0);

		// Deleted event
		if ($result) Recordset_Deleted($oldrs);
	} else {
		$result = false;
	}
	return $result;
}

// Deleting event
function Recordset_Deleting($oldrs)
{

	// Enter your customized codes here
	return true;
}

// Deleted event
function Recordset_Deleted($oldrs)
{
	$table = "fotograf";
}
?>
