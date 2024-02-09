<?php
//------------------------------------------------------------------------------
//
// PHP Connection Script for PHPMaker 4.0
// (C) 2006 e.World Technology Ltd. All rights reserved.
//
// IMPORTANT NOTE:
// For security reasons, you should remove this script from your site after use.
//
// How to use:
//	1. Upload this script to your site,
//	2. Browse to this script using IE,
//	3. Enter the connection info,
//	4. Click "Get Database List", select your database, the encoding and
//     quote character and then click "View Schema", check if you can view
//     the schema in XML properly,
//	5. If OK, enter the same connection info and the URL of this script in
//     PHPMaker.
//
//------------------------------------------------------------------------------

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

// PHP5 with register_long_arrays off
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = &$_POST;
	$HTTP_GET_VARS = &$_GET;
}

$host = @$HTTP_GET_VARS["host"];
$uid = @$HTTP_GET_VARS["user"];
$pwd = @$HTTP_GET_VARS["password"];
$port = @$HTTP_GET_VARS["port"];
$dbname = @$HTTP_GET_VARS["db"];
if (!get_magic_quotes_gpc()) $dbname = addslashes($dbname);
$encoding = @$HTTP_GET_VARS["encoding"];
$quotechr = @$HTTP_GET_VARS["quotechr"];
if (!get_magic_quotes_gpc()) $quotechr = addslashes($quotechr);
$cmd = @$HTTP_GET_VARS["cmd"]; // "db|tbl|cv|test|exec"

$cvname = @$HTTP_POST_VARS["cv"];

$sql = (strtolower($cmd) == "cv") ? @$HTTP_POST_VARS["sql"] : @$HTTP_GET_VARS["sql"];	

if (get_magic_quotes_gpc()) $sql = stripslashes($sql); // 3.0.3

function listDatabases() {
	global $mysqlHandle;
	echo "<databases>";
	$pDB = mysql_query("SHOW DATABASES") or die(mysql_error());
	if ($pDB) {
		$num = mysql_num_rows($pDB);
		for( $i = 0; $i < $num; $i++ ) {
			$row = mysql_fetch_array($pDB);			
			echo "<database>". htmlspecialchars($row[0]) . "</database>";
		}
	}
	echo "</databases>";
}

function listDatabases2() {
	global $mysqlHandle;
	$pDB = mysql_query("SHOW DATABASES") or die(mysql_error());
	if ($pDB) {
		$num = mysql_num_rows($pDB);
		$result = "";
		for( $i = 0; $i < $num; $i++ ) {
			$row = mysql_fetch_array($pDB);
			$result .= "<option value=\"" . $row[0] . "\">". $row[0] . "</option>";
		}
		$result = "<select name=\"db\">" . $result . "</select>";
	} else {
		$result = "<input type=\"text\" name=\"db\">";
	}
	return $result;
}

function listTables($viewschema) {
	global $mysqlHandle, $dbname, $mysqlversion;
	echo "<tables>";	
	mysql_select_db($dbname) or die(mysql_error());
	$match = explode('.', $mysqlversion);
	$isMySQL5 = (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])) >= 50002; // 3.1
	$pTable = mysql_query($isMySQL5 ? "SHOW FULL TABLES" : "SHOW TABLES") or die(mysql_error());
	if ($pTable) {
		$num = mysql_num_rows($pTable);
		for ($i = 0; $i < $num; $i++) {
			$row = mysql_fetch_array($pTable);
			echo "<table name=\"" . htmlspecialchars($row[0]) . "\"";
			if ($isMySQL5) {
				$tableType = $row[1];
				if ($tableType == "BASE TABLE" || $tableType == "SYSTEM VIEW") // 3.2
					$tableType = "TABLE";
				echo " tabletype=\"" . $tableType . "\"";
			}
			echo ">";
			if ($viewschema) viewSchema($row[0], "");
			echo "</table>";
		}
	}
	echo "</tables>";
}

function getMySQLVersion() {
	global $mysqlHandle;
	$pResult = mysql_query("SHOW VARIABLES LIKE 'version'") or die(mysql_error());
	$version = "unknown";
	if ($field = mysql_fetch_array($pResult)) {
		$version = $field["Value"];
	}
	return $version;
}

function viewSchema($tablename, $sql) {
	global $mysqlHandle, $dbname, $quotechr;
	if ($sql == "") { // table
		$result1 = mysql_query("SHOW fields FROM " . $quotechr . $tablename . $quotechr) or die(mysql_error());
		$result2 = mysql_query("SELECT * FROM " . $quotechr . $tablename . $quotechr) or die(mysql_error());
		echo "<fields>";
		if ($result1) { // table
			$num = mysql_num_rows($result1);
			for( $i = 0; $i < $num; $i++ ) {
				// get field info
				$valuelist = "";
				$M = "";
				$D = "";
				$field = mysql_fetch_array($result1);
				$fieldtype = @$field["Type"];
				$fieldkey = @$field["Key"];
				$fieldextra = @$field["Extra"];
				$fieldnull = @$field["Null"];
				$fielddefault = @$field["Default"];
				// parse field info
				$type = strtok( $fieldtype, " (,)\n" );
				if( substr_count( $fieldtype, "(" ) ) {
					if( $type == "enum" | $type == "set" ) {
						$valuelist = strtok( " ()\n" );
					} else {
						$M = strtok( " (,)\n" );
						if( substr_count( $fieldtype, "," ) )
							$D = strtok( " (,)\n" );
					}
				}
				// write field info
				echo "<field";
				echo " name=\"". htmlspecialchars($field["Field"]) . "\"";
				echo " type=\"". $type . "\"";
				echo " precision=\"" . (is_numeric($D) ? $D : 0) . "\"";
				echo " unsigned=\"" . (substr_count($fieldtype, "unsigned") ? 1 : 0) . "\"";
				echo " zerofill=\"" . (substr_count($fieldtype, "zerofill") ? 1 : 0) . "\"";
				echo " binary=\"" . (substr_count($fieldtype, "binary") ? 1 : 0) . "\"";
				echo " valuelist=\"" . htmlspecialchars($valuelist) . "\"";	
				echo " null=\"" . (($fieldnull == "YES") ? 1 : 0) . "\"";
				echo " primarykey=\"" . (($fieldkey == "PRI") ? 1 : 0) . "\"";
				echo " default=\"" . htmlspecialchars($fielddefault) . "\"";
				echo " autoincrement=\"" . (($fieldextra == "auto_increment") ? 1 : 0) . "\"";
				// other info
				if ($type == 'varchar' || $type == 'char') { // 3.1
					echo " size=\"". (is_numeric($M) ? $M : 0) . "\"";
				} else {
					$len = mysql_field_len($result2, $i);
					echo " size=\"". $len . "\"";
				}
	    	$flags = mysql_field_flags($result2, $i);
				echo " uniquekey=\"" . (substr_count($flags, "unique_key") ? 1 : 0) . "\"";			
	//		echo " unsigned=\"" . (strpos($flags, "unsigned") ? 1 : 0) . "\"";
	//		echo " zerofill=\"" . (strpos($flags, "zerofill") ? 1 : 0) . "\"";
	//		echo " blob=\"" . (strpos($flags, "blob") ? 1 : 0) . "\"";
	//		echo " enum=\"" . (strpos($flags, "enum") ? 1 : 0) . "\"";
	//		echo " set=\"" . (strpos($flags, "set") ? 1 : 0) . "\"";
	//		echo " timestamp=\"" . (strpos($flags, "timestamp") ? 1 : 0) . "\"";
	//		echo " binary=\"" . (strpos($flags, "binary") ? 1 : 0) . "\"";
	//		echo " not_null=\"" . (strpos($flags, "not_null") ? 1 : 0) . "\"";
	//		echo " primary_key=\"" . (strpos($flags, "primary_key") ? 1 : 0) . "\"";			
	//		echo " multiple_key=\"" . (strpos($flags, "multiple_key") ? 1 : 0) . "\"";
	//		echo " autoincrement=\"" . (strpos($flags, "auto_increment") ? 1 : 0) . "\"";
				$table = mysql_field_table($result2, $i);
				echo " table=\"" . htmlspecialchars($table) . "\"";
				echo " />";
			}	
		}
		echo "</fields>";
	} else { // view
		$result2 = mysql_query($sql) or die(mysql_error());
		echo "<fields>";
		if ($result2) {
			$i = 0;
			while ($i < mysql_num_fields($result2)) {
				// write field info
				echo "<field";
				$name = mysql_field_name($result2, $i);
				echo " name=\"". htmlspecialchars($name) . "\"";
				$len = mysql_field_len($result2, $i);
				echo " size=\"". $len . "\"";				
				$type = mysql_field_type($result2, $i);
				echo " type=\"". $type . "\"";
				echo " precision=\"0\"";
				echo " valuelist=\"\"";
				echo " default=\"\"";
				// other info
				$flags = mysql_field_flags($result2, $i);
				echo " binary=\"" . (substr_count($flags, "binary") ? 1 : 0) . "\"";
				echo " uniquekey=\"" . (substr_count($flags, "unique_key") ? 1 : 0) . "\"";
				echo " unsigned=\"" . (substr_count($flags, "unsigned") ? 1 : 0) . "\"";
				echo " zerofill=\"" . (substr_count($flags, "zerofill") ? 1 : 0) . "\"";
	//		echo " blob=\"" . (strpos($flags, "blob") ? 1 : 0) . "\"";
	//		echo " enum=\"" . (strpos($flags, "enum") ? 1 : 0) . "\"";
	//		echo " set=\"" . (strpos($flags, "set") ? 1 : 0) . "\"";
	//		echo " timestamp=\"" . (strpos($flags, "timestamp") ? 1 : 0) . "\"";
				echo " null=\"" . (substr_count($flags, "not_null") ? 0 : 1) . "\"";
				echo " primarykey=\"" . (substr_count($flags, "primary_key") ? 1 : 0) . "\"";
	//		echo " multiple_key=\"" . (strpos($flags, "multiple_key") ? 1 : 0) . "\"";
				echo " autoincrement=\"" . (substr_count($flags, "auto_increment") ? 1 : 0) . "\"";
				$table = mysql_field_table($result2, $i);
				if (!empty($table)) echo " table=\"" . htmlspecialchars($table) . "\""; // 3.0.3
				echo " />";
				$i++;
			}	
		}
		echo "</fields>";
	}
}

if (!empty($cmd)) {
	if (is_numeric($port)) {
		$mysqlHandle = mysql_connect($host . ":" . intval($port), $uid, $pwd) or die(mysql_error());
	} else {
		$mysqlHandle = mysql_connect($host, $uid, $pwd) or die(mysql_error());
	}
	if (strtolower($cmd) == "db2") {
		$dblist = listDatabases2();
	} else {
		$mysqlversion = getMySQLVersion();
		header("Content-type: text/xml");
		echo  "<?xml version=\"1.0\"";
		if (!empty($encoding)) { echo  " encoding=\"" . $encoding . "\""; }
		echo " standalone=\"yes\"?>";
		echo "<phpmaker>";
		echo "<phpversion>". phpversion() ."</phpversion>";
		echo "<mysqlversion>". $mysqlversion ."</mysqlversion>";
		if (strtolower($cmd) == "db") {
			listDatabases();
		} elseif (strtolower($cmd) == "test") {
			if (!empty($dbname)) listTables(false);
		} elseif (strtolower($cmd) == "tbl") {
			if (!empty($dbname)) listTables(true);
		} elseif (strtolower($cmd) == "cv") {
			if (!empty($dbname)) mysql_select_db($dbname) or die(mysql_error());
			echo "<tables>";
			echo "<table tabletype=\"CUSTOMVIEW\" name=\"" . htmlspecialchars($cvname) . "\">";
			if (!empty($sql)) viewSchema($cvname, $sql);
			echo "</table>";
			echo "</tables>";
		} elseif (strtolower($cmd) == "exec") {
			if (!empty($dbname)) mysql_select_db($dbname) or die(mysql_error());
			echo "<result>";
			$rs = mysql_query($sql);
			if ($rs) {
				$stmt = strtoupper(substr($sql, 0, 7));
				if ($stmt == "SELECT ") {
					echo mysql_num_rows($rs);
				} elseif ($stmt == "INSERT " || $stmt == "UPDATE ") {
					echo mysql_affected_rows();
				} else {
					echo "1";
				}
			} else {
				echo mysql_error();
			}
			echo "</result>";
		}
		echo"</phpmaker>";
		exit();
	}
} ?>
<html>
<head>
<title>PHPMaker 4.0 Connection Script</title>
</head>
<body>
<p><b>PHPMaker 4.0 Connection Script</b></p>
<form>
  <input type="hidden" name="cmd" value="">
  <table cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td nowrap> Host/Server name (or IP) </td>
      <td><input type="text" name="host" value="<?php echo (!empty($host)) ? $host : "localhost" ?>">
      </td>
    </tr>
    <tr>
      <td>User</td>
      <td><input type="text" name="user" value="<?php echo @$uid ?>">
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="text" name="password" value="<?php echo @$pwd ?>">
      </td>
    </tr>
    <tr>
      <td>Port (if not 3306)</td>
      <td><input type="text" name="port" value="<?php echo @$port ?>">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="btndb" value="Get Database List" onClick="this.form.cmd.value='db2';this.form.submit();">
      </td>
    </tr>
    <?php if (!empty($dblist)) { ?>
    <tr>
      <td>Database</td>
      <td><?php echo $dblist ?></td>
    </tr>
    <tr>
      <td>SQL Identifier Quote Character</td>
      <td><select name="quotechr">
          <option value="`" selected>Backquote (MySQL 3.23.6 or later)</option>
          <option value="&quot;">Double Quote (ANSI mode)</option>
          <option value="">None</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Encoding</td>
      <td><select name="encoding">
          <option value=""></option>
          <option value="iso-8859-6">Arabic (ISO)</option>
          <option value="iso-8859-4">Baltic (ISO)</option>
          <option value="iso-8859-2">Central European (ISO)</option>
          <option value="gb2312">Chinese Simplified (GB2312)</option>
          <option value="big5">Chinese Traditional (Big5)</option>
          <option value="iso-8859-5">Cyrillic (ISO)</option>
          <option value="iso-8859-7">Greek (ISO)</option>
          <option value="iso-8859-8">Hebrew (ISO-Visual)</option>
          <option value="euc-jp">Japanese (EUC)</option>
          <option value="iso-2022-jp">Japanese (JIS)</option>
          <option value="shift_jis">Japanese (Shift-JIS)</option>
          <option value="euc-kr">Korean (EUC)</option>
          <option value="iso-8859-3">Latin 3 (ISO)</option>
          <option value="iso-8859-15">Latin 9 (ISO)</option>
          <option value="iso-8859-9">Turkish (ISO)</option>
          <option value="utf-16">Unicode</option>
          <option value="utf-7">Unicode (UTF-7)</option>
          <option value="utf-8">Unicode (UTF-8)</option>
          <option value="us-ascii">US-ASCII</option>
          <option value="iso-8859-1">Western European (ISO)</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="btntbl" value="View Schema" onClick="this.form.cmd.value='tbl';this.form.submit();">
      </td>
    </tr>
    <?php } ?>
  </table>
</form>
<p><font size="-1">(C) 2006 e.World Technology Ltd.</font></p>
</body>
</html>
