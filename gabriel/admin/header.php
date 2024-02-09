<html>
<head>
<title>GABRIEL Administration Panel | canusta.com</title>
<link href="gabriel2.css" rel="stylesheet" type="text/css" />
<meta name="generator" content="PHPMaker v4.0.0.3" />
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
	<td>&nbsp;</td>
	<td><span class="phpmaker"><b>GABRIEL Administration Panel | canusta.com</b></span></td>
</tr>
<tr>
	<!-- left column -->
	<td width="20%" height="100%" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="gabriellist.php?cmd=resetall">gabriel</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="haberlist.php?cmd=resetall">haber</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="konserlist.php?cmd=resetall">konser</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="programlist.php?cmd=resetall">program</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="serilist.php?cmd=resetall">seri</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) {?>
		<tr>
			<td><span class="phpmaker"><a href="fotograflist.php?cmd=resetall">fotograf</a></span></td>
		</tr>
		<?php } ?>
		<?php if (IsLoggedIn()) { ?>
		<tr>
			<td><span class="phpmaker"><a href="logout.php">Logout</a></span></td>
		</tr>
		<?php } elseif (substr(ewScriptFileName(), 0 - strlen("login.php")) <> "login.php") { ?>
		<tr>
			<td><span class="phpmaker"><a href="login.php">Login</a></span></td>
		</tr>
		<?php } ?>
		</table>
	</td>
	<!-- right column -->
	<td width="80%" valign="top">
