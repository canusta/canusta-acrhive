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
$x_id = @$_GET["id"];

// Get action
$sAction = @$_POST["a_edit"];
if ($sAction == "") {
	$sAction = "I";	// Display record	
} else {

	// Get fields from form
	$x_id = @$_POST["x_id"];
	$x_isim = @$_POST["x_isim"];
	$x_fullview = @$_POST["x_fullview"];
	$x_seri = @$_POST["x_seri"];
}
if (($x_id == "") || (is_null($x_id))) {
	ob_end_clean();
	header("Location: fotograflist.php");
	exit();
}
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
switch ($sAction) {
	case "I": // Display record
		if (!LoadData($conn)) { // Load record
			$_SESSION[ewSessionMessage] = "No records found";
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: fotograflist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($conn)) { // Update record
			$_SESSION[ewSessionMessage] = "Update Record Successful";
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
return true;
}

//-->
</script>
<script type="text/javascript">
<!--
	var EW_DHTMLEditors = [];

//-->
</script>
<p><span class="phpmaker">Edit TABLE: fotograf<br><br><a href="fotograflist.php">Back to List</a></span></p>
<form name="ffotografedit" id="ffotografedit" action="fotografedit.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
	<input type="hidden" name="a_edit" value="U">
	<input type="hidden" name="EW_Max_File_Size" value="2000000">
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
<?php if ((!is_null($x_isim)) && $x_isim <> "") {  ?>
<input type="radio" name="a_x_isim" value="1" checked>Keep&nbsp;
<input type="radio" name="a_x_isim" value="2" disabled>Remove&nbsp;
<input type="radio" name="a_x_isim" value="3">Replace<br>
<?php } else {?>
<input type="hidden" name="a_x_isim" value="3">
<?php } ?>
<input type="file" id="x_isim" name="x_isim" size="30" onChange="if (this.form.a_x_isim[2]) this.form.a_x_isim[2].checked=true;">
</span></td>
		</tr>
		<tr id="r_fullview">
			<td class="ewTableHeader"><span>fullview<span class='ewmsg'>&nbsp;*</span></span></td>
			<td class="ewTableAltRow"><span id="cb_x_fullview">
<?php if ((!is_null($x_fullview)) && $x_fullview <> "") {  ?>
<input type="radio" name="a_x_fullview" value="1" checked>Keep&nbsp;
<input type="radio" name="a_x_fullview" value="2" disabled>Remove&nbsp;
<input type="radio" name="a_x_fullview" value="3">Replace<br>
<?php } else {?>
<input type="hidden" name="a_x_fullview" value="3">
<?php } ?>
<input type="file" id="x_fullview" name="x_fullview" size="30" onChange="if (this.form.a_x_fullview[2]) this.form.a_x_fullview[2].checked=true;">
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
		$GLOBALS["x_fullview"] = $row["fullview"];
		$GLOBALS["x_seri"] = $row["seri"];
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

		// Check file size
		$EW_MaxFileSize = @$_POST["EW_Max_File_Size"];
		$x_id = @$_POST["x_id"];

		// Check the file size
		if (!empty($_FILES["x_isim"]["size"])) {
			if (!empty($EW_MaxFileSize) && $_FILES["x_isim"]["size"] > $EW_MaxFileSize) {
				die(str_replace("%s", $EW_MaxFileSize, "Max. file size (%s bytes) exceeded."));
			}
		}
		$fn_x_isim = @$_FILES["x_isim"]["name"];

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
		$fn_x_fullview = @$_FILES["x_fullview"]["name"];

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
		$x_seri = @$_POST["x_seri"];
		if ($a_x_isim == "2") { // Remove
			$fieldList["`isim`"] = "NULL";
			$ox_isim = $oldrs["isim"];
			$sTmpFolder = ewUploadPathEx(True, EW_UploadDestPath);
			if ($ox_isim <> "") { @unlink($sTmpFolder . $ox_isim); }
		} else if ($a_x_isim == "3") { // Update
			if (is_uploaded_file($_FILES["x_isim"]["tmp_name"])) {
				$sTmpFolder = ewUploadPathEx(true, EW_UploadDestPath);
				$ox_isim = $oldrs["isim"];	
				if ($ox_isim <> "")
					@unlink($sTmpFolder . $ox_isim);
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
		}
		if ($a_x_fullview == "2") { // Remove
			$fieldList["`fullview`"] = "NULL";
			$ox_fullview = $oldrs["fullview"];
			$sTmpFolder = ewUploadPathEx(True, EW_UploadDestPath);
			if ($ox_fullview <> "") { @unlink($sTmpFolder . $ox_fullview); }
		} else if ($a_x_fullview == "3") { // Update
			if (is_uploaded_file($_FILES["x_fullview"]["tmp_name"])) {
				$sTmpFolder = ewUploadPathEx(true, EW_UploadDestPath);
				$ox_fullview = $oldrs["fullview"];	
				if ($ox_fullview <> "")
					@unlink($sTmpFolder . $ox_fullview);
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
		}
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_seri"]) : $GLOBALS["x_seri"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["`seri`"] = $theValue;

		// Updating event
		if (Recordset_Updating($fieldList, $oldrs)) {

			// Update
			$sSql = "UPDATE `fotograf` SET ";
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
	$table = "fotograf";
}
?>
