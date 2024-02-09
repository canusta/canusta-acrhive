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
<?php include ("seriinfo.php") ?>
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
$ar_x_isim = NULL;
$ari_x_isim = NULL;
$x_isimList = NULL;
$x_isimChk = NULL;
$cbo_x_isim_js = NULL;
?>
<?php

// Load key from QueryString
$x_id = @$_GET["id"];

// Get action
$sAction = @$_POST["a_edit"];
if ($sAction == "") {
	$sAction = "I";	// Display record	
} else {

	// Get fields from form
	$x_id = @$_POST["x_id"];
	$x_isim = @$_POST["x_isim"];
}
if (($x_id == "") || (is_null($x_id))) {
	ob_end_clean();
	header("Location: serilist.php");
	exit();
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "I": // Display record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: serilist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($conn)) { // Update record
			$_SESSION[ewSessionMessage] = "Update Record Successful";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: serilist.php");
			exit();
		}
		break;
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
<script type="text/javascript">
<!--
EW_dateSep = "."; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_isim && !EW_hasValue(EW_this.x_isim, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_isim, "TEXT", "Please enter required field - isim"))
		return false;
}
return true;
}

//-->
</script>
<script type="text/javascript">
<!--
	var EW_DHTMLEditors = [];

//-->
</script>
<p><span class="phpmaker">Edit TABLE: seri<br><br><a href="serilist.php">Back to List</a></span></p>
<form name="fseriedit" id="fseriedit" action="seriedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
	<input type="hidden" name="a_edit" value="U">
<?php
if (@$_SESSION[ewSessionMessage] <> "") {
?>
	<p><span class="ewmsg"><?php echo $_SESSION[ewSessionMessage]; ?></span></p>
<?php
	$_SESSION[ewSessionMessage] = ""; // Clear message
}
?>
	<table class="ewTable">
		<tr id="r_id">
			<td class="ewTableHeader"><span>id</span></td>
			<td class="ewTableAltRow"><span id="cb_x_id">
<?php echo $x_id; ?><input type="hidden" id="x_id" name="x_id" value="<?php echo @$x_id; ?>">
</span></td>
		</tr>
		<tr id="r_isim">
			<td class="ewTableHeader"><span>isim<span class='ewmsg'>&nbsp;*</span></span></td>
			<td class="ewTableAltRow"><span id="cb_x_isim">
<input type="text" name="x_isim" id="x_isim" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_isim) ?>">
</span></td>
		</tr>
	</table>
	<p>
	<input type="submit" name="btnAction" id="btnAction" value="EDIT">
</form>
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
		$GLOBALS["x_isim"] = $row["isim"];
	}
	phpmkr_free_result($rs);
	return $bLoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Variables used: field variables

function EditData($conn)
{
	global $x_id;
	$sFilter = ewSqlKeyWhere;
	if (!is_numeric($x_id)) return false;
	$sTmp =  (get_magic_quotes_gpc()) ? stripslashes($x_id) : $x_id;
	$sFilter = str_replace("@id", AdjustSql($sTmp), $sFilter); // Replace key value
	$sSql = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	// Get old recordset
	$oldrs = phpmkr_fetch_array($rs);
	if (phpmkr_num_rows($rs) == 0) {
		return false; // Update Failed
	} else {
		$x_id = @$_POST["x_id"];
		$x_isim = @$_POST["x_isim"];
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_isim"]) : $GLOBALS["x_isim"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["`isim`"] = $theValue;

		// Updating event
		if (Recordset_Updating($fieldList, $oldrs)) {

			// Update
			$sSql = "UPDATE `seri` SET ";
			foreach ($fieldList as $key=>$temp) {
				$sSql .= "$key = $temp, ";
			}
			if (substr($sSql, -2) == ", ") {
				$sSql = substr($sSql, 0, strlen($sSql)-2);
			}
			$sSql .= " WHERE " . $sFilter;
			phpmkr_query($sSql,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			$result = (phpmkr_affected_rows($conn) >= 0);

			// Updated event
			if ($result) Recordset_Updated($fieldList, $oldrs);
		} else {
			$result = false; // Update Failed
		}
	}
	return $result;
}

// Updating Event
function Recordset_Updating($newrs, $oldrs)
{

	// Enter your customized codes here
	return true;
}

// Updated event
function Recordset_Updated($newrs, $oldrs)
{
	$table = "seri";
}
?>
