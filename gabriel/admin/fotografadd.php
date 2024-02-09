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
	$x_isim = @$_POST["x_isim"];
	$x_fullview = @$_POST["x_fullview"];
	$x_seri = @$_POST["x_seri"];
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "C": // Copy record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: fotograflist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add new record
			$_SESSION[ewSessionMessage] = "Add New Record Successful";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: fotograflist.php");
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
if (EW_this.x_isim && !EW_hasValue(EW_this.x_isim, "FILE" )) {
	if (!EW_onError(EW_this, EW_this.x_isim, "FILE", "Please enter required field - isim"))
		return false;
}
if (EW_this.x_fullview && !EW_hasValue(EW_this.x_fullview, "FILE" )) {
	if (!EW_onError(EW_this, EW_this.x_fullview, "FILE", "Please enter required field - fullview"))
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
<p><span class="phpmaker">Add to TABLE: fotograf<br><br><a href="fotograflist.php">Back to List</a></span></p>
<form name="ffotografadd" id="ffotografadd" action="fotografadd.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<?php
if (@$_SESSION[ewSessionMessage] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[ewSessionMessage] ?></span></p>
<?php
	$_SESSION[ewSessionMessage] = ""; // Clear message
}
?>
<table class="ewTable">
	<tr id="r_isim">
		<td class="ewTableHeader"><span>isim<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_isim">
<?php $x_isim = ""; // Clear BLOB related fields ?>
<input type="file" id="x_isim" name="x_isim" size="30">
</span></td>
	</tr>
	<tr id="r_fullview">
		<td class="ewTableHeader"><span>fullview<span class='ewmsg'>&nbsp;*</span></span></td>
		<td class="ewTableAltRow"><span id="cb_x_fullview">
<?php $x_fullview = ""; // Clear BLOB related fields ?>
<input type="file" id="x_fullview" name="x_fullview" size="30">
</span></td>
	</tr>
	<tr id="r_seri">
		<td class="ewTableHeader"><span>seri</span></td>
		<td class="ewTableAltRow"><span id="cb_x_seri">
<?php
$x_seriList = "<select id='x_seri' name='x_seri'>";
$x_seriList .= "<option value=''>Please Select</option>";
$sSqlWrk = "SELECT `id`, `isim` FROM `seri`";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query at line " . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_seriList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["id"] == @$x_seri) {
			$x_seriList .= " selected";
		}
		$x_seriList .= ">" . $datawrk["isim"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_seriList .= "</select>";
echo $x_seriList;
?>
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
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
	global $x_id;
	global $x_isim;
	global $x_fullview;
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
		$EW_MaxFileSize = @$_POST["EW_Max_File_Size"];

		// Check the file size
		if (!empty($_FILES["x_isim"]["size"])) {
			if (!empty($EW_MaxFileSize) && $_FILES["x_isim"]["size"] > $EW_MaxFileSize) {
				die(str_replace("%s", $EW_MaxFileSize, "Max. file size (%s bytes) exceeded."));
			}
		}
		$fn_x_isim = $_FILES["x_isim"]["name"];

		// Check the file type
		if (!empty($fn_x_isim)) {
			if (!ewUploadAllowedFileExt($fn_x_isim)) {
				die("File type is not allowed.");
			}
		}
		$ct_x_isim = @$_POST["x_isim"];
		$x_isim = @$_POST[ "x_isim"];
		$wd_x_isim = @$_POST["wd_x_isim"];
		$ht_x_isim = @$_POST["ht_x_isim"];
		$a_x_isim =  @$_POST["a_x_isim"];

		// Check the file size
		if (!empty($_FILES["x_fullview"]["size"])) {
			if (!empty($EW_MaxFileSize) && $_FILES["x_fullview"]["size"] > $EW_MaxFileSize) {
				die(str_replace("%s", $EW_MaxFileSize, "Max. file size (%s bytes) exceeded."));
			}
		}
		$fn_x_fullview = $_FILES["x_fullview"]["name"];

		// Check the file type
		if (!empty($fn_x_fullview)) {
			if (!ewUploadAllowedFileExt($fn_x_fullview)) {
				die("File type is not allowed.");
			}
		}
		$ct_x_fullview = @$_POST["x_fullview"];
		$x_fullview = @$_POST[ "x_fullview"];
		$wd_x_fullview = @$_POST["wd_x_fullview"];
		$ht_x_fullview = @$_POST["ht_x_fullview"];
		$a_x_fullview =  @$_POST["a_x_fullview"];

	// Field isim
		if (is_uploaded_file($_FILES["x_isim"]["tmp_name"])) {
			$sTmpFolder = ewUploadPathEx(true, EW_UploadDestPath);
			$theName = ewUploadFileNameEx($sTmpFolder, $_FILES["x_isim"]["name"]);
			$destfile = $sTmpFolder . $theName;
			if (!move_uploaded_file($_FILES["x_isim"]["tmp_name"], $destfile)) // Move file to destination path
				die("" . $destfile);
			@chmod($destfile, defined(EW_UploadedFileMode) ? EW_UploadedFileMode : 0666);

			// File name
			$theName = (!get_magic_quotes_gpc()) ? addslashes($theName) : $theName;
			$fieldList["`isim`"] = " '" . $theName . "'";
			@unlink($_FILES["x_isim"]["tmp_name"]);
		}

	// Field fullview
		if (is_uploaded_file($_FILES["x_fullview"]["tmp_name"])) {
			$sTmpFolder = ewUploadPathEx(true, EW_UploadDestPath);
			$theName = ewUploadFileNameEx($sTmpFolder, $_FILES["x_fullview"]["name"]);
			$destfile = $sTmpFolder . $theName;
			if (!move_uploaded_file($_FILES["x_fullview"]["tmp_name"], $destfile)) // Move file to destination path
				die("" . $destfile);
			@chmod($destfile, defined(EW_UploadedFileMode) ? EW_UploadedFileMode : 0666);

			// File name
			$theName = (!get_magic_quotes_gpc()) ? addslashes($theName) : $theName;
			$fieldList["`fullview`"] = " '" . $theName . "'";
			@unlink($_FILES["x_fullview"]["tmp_name"]);
		}

	// Field seri
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_seri"]) : $GLOBALS["x_seri"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["`seri`"] = $theValue;

	// Inserting event
	if (Recordset_Inserting($fieldList)) {

		// Insert
		$sSql = "INSERT INTO `fotograf` (";
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
	$table = "fotograf";
}
?>
