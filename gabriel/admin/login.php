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
<?php include ("advsecu.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
if (@$_POST["submit"] <> "") {
	$bValidPwd = false;

	// Setup variables
	$sUsername = @$_POST["username"];
	$sPassword = @$_POST["password"];
	if (ValidateUser($sUsername, $sPassword)) {

		// Write cookies
		$sLoginType = strtolower($_POST["rememberme"]);
		$expirytime = time() + 365*24*60*60; // change cookie expiry time here
		if ($sLoginType == "a") {
			setCookie(ewCookieAutoLogin, "autologin", $expirytime);
			setCookie(ewCookieUserName, $sUsername, $expirytime);
			setCookie(ewCookiePassword, TEAencrypt($sPassword, EW_RANDOM_KEY), $expirytime);
		} elseif ($sLoginType == "u") {
			setCookie(ewCookieAutoLogin, "rememberusername", $expirytime);
			setCookie(ewCookieUserName, $sUsername, $expirytime);
		} else {
			setCookie(ewCookieAutoLogin, "", $expirytime);
		}
		$_SESSION[ewSessionStatus] = "login";
		ob_end_clean();
		header("Location: index.php");
		exit();
	} else {
		$_SESSION[ewSessionMessage] = "Incorrect user ID or password";
	}
} else {
	if (IsLoggedIn()) {
		if ($_SESSION[ewSessionMessage] == "") {
			ob_end_clean();
			header("Location: index.php");
			exit();
		}
	} else { // Check auto login
		if (@$_COOKIE[ewCookieAutoLogin] == "autologin") {
			$sUsername = @$_COOKIE[ewCookieUserName] ;
			$sPassword = TEAdecrypt(@$_COOKIE[ewCookiePassword] , EW_RANDOM_KEY);
			if (ValidateUser($sUsername, $sPassword)) {
				ob_end_clean();
				header("Location: index.php");
				exit();
			}
		}
	}
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ewp.js"></script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
	if (!EW_hasValue(EW_this.username, "TEXT" )) {
		if  (!EW_onError(EW_this, EW_this.username, "TEXT", "Please enter user ID"))
			return false;
	}
	if (!EW_hasValue(EW_this.password, "PASSWORD" )) {
		if (!EW_onError(EW_this, EW_this.password, "PASSWORD", "Please enter password"))
			return false;
	}
	return true;
}

//-->
</script>
<p><span class="phpmaker">Login Page</span></p>
<?php
if (@$_SESSION[ewSessionMessage] <> "") {
?>
<p><span class="phpmaker" style="color: Red;"><?php echo $_SESSION[ewSessionMessage]; ?></span></p>
<?php
	$_SESSION[ewSessionMessage] = ""; // Clear message
}
?>
<form action="login.php" method="post" onSubmit="return EW_checkMyForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker">User Name</span></td>
		<td><span class="phpmaker"><input type="text" name="username" size="20" value="<?php echo @$_COOKIE[ewCookieUserName]; ?>"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker">Password</span></td>
		<td><span class="phpmaker"><input type="password" name="password" size="20"></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="phpmaker">
		<?php if (@$_COOKIE[ewCookieAutoLogin] == "autologin") { ?>
		<input type="radio" name="rememberme" value="a" checked>Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u">Save my user name<br><input type="radio" name="rememberme" value="n">Always ask for my user name and password
		<?php } elseif (@$_COOKIE[ewCookieAutoLogin] == "rememberusername") { ?>
		<input type="radio" name="rememberme" value="a">Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u" checked>Save my user name<br><input type="radio" name="rememberme" value="n">Always ask for my user name and password
		<?php } else { ?>
		<input type="radio" name="rememberme" value="a">Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u">Save my user name<br><input type="radio" name="rememberme" value="n" checked>Always ask for my user name and password
		<?php } ?>
		</span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><span class="phpmaker"><input type="submit" name="submit" value="Login"></span></td>
	</tr>
</table>
</form>
<br>
<p><span class="phpmaker">
</span></p>
<?php

// Function to validate user
function ValidateUser($Username,$Password)
{
	$ValidateUser = false;
	$CaseSensitive = false; // Modify case sensitivity here
	$AdminUsername = "gabriel";
	$AdminPassword = "gabriel";

	// Check hard coded admin first
  if ($CaseSensitive) {
		$ValidateUser = ($AdminUsername == $Username && $AdminPassword == $Password);
  } else {
    $ValidateUser = (strtolower($AdminUsername) == strtolower($Username) && strtolower($AdminPassword) == strtolower($Password));
  } 
  if ($ValidateUser) { // System admin
    $_SESSION[ewSessionStatus] = "login";
    $_SESSION[ewSessionSysAdmin] = 1;
  }
	return $ValidateUser;
}
?>
<?php include ("footer.php") ?>
