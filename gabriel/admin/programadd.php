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

// Load key from QueryString
$bCopy = true;
$x_id = @$_GET["id"];
if (($x_id == "") || (is_null($x_id))) $bCopy = false;

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	if ($bCopy) {
		$sAction = "C"; // Copy record
	} else {
		$sAction = "I"; // Display blank record
	}
} else {

	// Get fields from form
	$x_id = @$_POST["x_id"];
	$x_gun = @$_POST["x_gun"];
	$x_mekan = @$_POST["x_mekan"];
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "C": // Copy record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: programlist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add new record
			$_SESSION[ewSessionMessage] = "Add New Record Successful";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: programlist.php");
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
if (EW_this.x_gun && !EW_hasValue(EW_this.x_gun, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_gun, "TEXT", "Please enter required field - gun"))
		return false;
}
if (EW_this.x_mekan && !EW_hasValue(EW_this.x_mekan, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_mekan, "TEXT", "Please enter required field - mekan"))
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
<p><span class="phpmaker">Add to TABLE: program<br><br><a href="programlist.php">Back to List</a></span></p>
<form name="fprogramadd" id="fprogramadd" action="programadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<?php
if (@$_SESSION[ewSessionMessage] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[ewSessionMessage] ?></span></p>
<?php
	$_SESSION[ewSessionMessage] = ""; // Clear message
}
?>
<table class="ewTable">
	<tr id="r_gun">
		<td class="ewTableHeader"><span>gun<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_gun">
<input type="text" name="x_gun" id="x_gun" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_gun) ?>">
</span></td>
	</tr>
	<tr id="r_mekan">
		<td class="ewTableHeader"><span>mekan<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_mekan">
<input type="text" name="x_mekan" id="x_mekan" size="30" maxlength="50" value="<?php echo htmlspecialchars(@$x_mekan) ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="ADD">
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
		$GLOBALS["x_gun"] = $row["gun"];
		$GLOBALS["x_mekan"] = $row["mekan"];
	}
	phpmkr_free_result($rs);
	return $bLoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
	global $x_id;
	$sFilter = ewSqlKeyWhere;

	// Check for duplicate key
	$bCheckKey = true;
	if ((@$x_id == "") || (is_null(@$x_id))) {
		$bCheckKey = false;
	} else {
		$sFilter = str_replace("@id", AdjustSql($x_id), $sFilter); // Replace key value
	}
	if ($bCheckKey) {
		$sSqlChk = ewBuildSql(ewSqlSelect, ewSqlWhere, ewSqlGroupBy, ewSqlHaving, ewSqlOrderBy, $sFilter, "");
		$rsChk = phpmkr_query($sSqlChk, $conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSqlChk);
		if (phpmkr_num_rows($rsChk) > 0) {
			$_SESSION[ewSessionMessage] = "Duplicate value for primary key";
			phpmkr_free_result($rsChk);
			return false;
		}
		phpmkr_free_result($rsChk);
	}

	// Field gun
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_gun"]) : $GLOBALS["x_gun"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["`gun`"] = $theValue;

	// Field mekan
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_mekan"]) : $GLOBALS["x_mekan"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["`mekan`"] = $theValue;

	// Inserting event
	if (Recordset_Inserting($fieldList)) {

		// Insert
		$sSql = "INSERT INTO `program` (";
		$sSql .= implode(",", array_keys($fieldList));
		$sSql .= ") VALUES (";
		$sSql .= implode(",", array_values($fieldList));
		$sSql .= ")";	
		phpmkr_query($sSql, $conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$fieldList["`id`"] = phpmkr_insert_id($conn);
		$result = (phpmkr_affected_rows($conn) > 0);

		// Inserted event
		if ($result) Recordset_Inserted($fieldList);
	} else {
		$result = false;
	}
	return $result;
}

// Inserting event
function Recordset_Inserting($newrs)
{

	// Enter your customized codes here
	return true;
}

// Inserted event
function Recordset_Inserted($newrs)
{
	$table = "program";
}
?>
