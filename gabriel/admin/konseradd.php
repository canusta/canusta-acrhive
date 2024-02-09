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
<?php include ("konserinfo.php") ?>
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
$x_baslik = NULL;
$ox_baslik = NULL;
$z_baslik = NULL;
$ar_x_baslik = NULL;
$ari_x_baslik = NULL;
$x_baslikList = NULL;
$x_baslikChk = NULL;
$cbo_x_baslik_js = NULL;
$x_metin = NULL;
$ox_metin = NULL;
$z_metin = NULL;
$ar_x_metin = NULL;
$ari_x_metin = NULL;
$x_metinList = NULL;
$x_metinChk = NULL;
$cbo_x_metin_js = NULL;
$x_orders = NULL;
$ox_orders = NULL;
$z_orders = NULL;
$ar_x_orders = NULL;
$ari_x_orders = NULL;
$x_ordersList = NULL;
$x_ordersChk = NULL;
$cbo_x_orders_js = NULL;
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
	$x_baslik = @$_POST["x_baslik"];
	$x_metin = @$_POST["x_metin"];
	$x_orders = @$_POST["x_orders"];
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "C": // Copy record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: konserlist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add new record
			$_SESSION[ewSessionMessage] = "Add New Record Successful";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: konserlist.php");
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
if (EW_this.x_baslik && !EW_hasValue(EW_this.x_baslik, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_baslik, "TEXT", "Please enter required field - baslik"))
		return false;
}
if (EW_this.x_metin && !EW_hasValue(EW_this.x_metin, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_metin, "TEXT", "Please enter required field - metin"))
		return false;
}
if (EW_this.x_orders && !EW_hasValue(EW_this.x_orders, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_orders, "TEXT", "Please enter required field - orders"))
		return false;
}
if (EW_this.x_orders && !EW_checkinteger(EW_this.x_orders.value)) {
	if (!EW_onError(EW_this, EW_this.x_orders, "TEXT", "Incorrect integer - orders"))
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
<p><span class="phpmaker">Add to TABLE: konser<br><br><a href="konserlist.php">Back to List</a></span></p>
<form name="fkonseradd" id="fkonseradd" action="konseradd.php" method="post" onSubmit="return EW_checkMyForm(this);">
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
	<tr id="r_baslik">
		<td class="ewTableHeader"><span>baslik<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_baslik">
<input type="text" name="x_baslik" id="x_baslik" size="30" maxlength="30" value="<?php echo htmlspecialchars(@$x_baslik) ?>">
</span></td>
	</tr>
	<tr id="r_metin">
		<td class="ewTableHeader"><span>metin<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_metin">
<input type="text" name="x_metin" id="x_metin" size="30" maxlength="200" value="<?php echo htmlspecialchars(@$x_metin) ?>">
</span></td>
	</tr>
	<tr id="r_orders">
		<td class="ewTableHeader"><span>orders<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_orders">
<?php if (!(!is_null($x_orders)) || ($x_orders == "")) { $x_orders = 0;} // Set default value ?>
<input type="text" name="x_orders" id="x_orders" size="30" value="<?php echo htmlspecialchars(@$x_orders) ?>">
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
		$GLOBALS["x_baslik"] = $row["baslik"];
		$GLOBALS["x_metin"] = $row["metin"];
		$GLOBALS["x_orders"] = $row["orders"];
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

	// Field baslik
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_baslik"]) : $GLOBALS["x_baslik"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["`baslik`"] = $theValue;

	// Field metin
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_metin"]) : $GLOBALS["x_metin"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["`metin`"] = $theValue;

	// Field orders
	$theValue = ($GLOBALS["x_orders"] != "") ? intval($GLOBALS["x_orders"]) : "NULL";
	$fieldList["`orders`"] = $theValue;

	// Inserting event
	if (Recordset_Inserting($fieldList)) {

		// Insert
		$sSql = "INSERT INTO `konser` (";
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
	$table = "konser";
}
?>
