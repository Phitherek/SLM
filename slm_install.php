<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SLM Installation</title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
if($_POST['step'] == "end") {
	if($_POST['adminpass'] == $_POST['adminpchk']) {
$path="slm_users/".$_POST['adminname'].".php";
$f=fopen($path, 'w');
flock($f, LOCK_EX);
fputs($f, '<?php'."\n");
fputs($f, '$pass="'.$_POST['adminpass'].'";'."\n");
fputs($f, '$type="admin";'."\n");
fputs($f, '?>');
flock($f, LOCK_UN);
fclose($f);
echo("Installation completed successfully!");
$step="none";
	} else {
	echo("Passwords do not match!");
	$step="setadmin";
	}
} else if($_POST['step'] == "setadmin" OR $step == "setadmin") {
mkdir("slm_users");
mkdir("slm_bans");
?>
<h1>Creating administrator account</h1><br />
A script will now create an account for administrator.<br /><br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Username: <input type="text" name="adminname" value="admin" /><br />
Password: <input type="password" name="adminpass" /><br />
Repeat password: <input type="password" name="adminpchk" /><br />
<input type="hidden" name="step" value="end" />
<input type="submit" value="Create and end" />
</form>
<?php
} else if($_POST['step'] == "setfolders") {
?>
<h1>Creating data directories</h1><br />
A script will now create directories for SLM data - &quot;slm_users&quot; and &quot;slm_bans&quot;. Click on &quot;Continue&quot;.<br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="hidden" name="step" value="setadmin" />
<input type="submit" value="Continue" />
</form>
<?php
} else {
?>
<h1>SLM Installation</h1><br />
Welcome to Phitherek_' s SLM Installation Script. Before you start, make sure that directory of SLM have privileges for *all* to write (the best are 777 (rwxrwxrwx)). If you are sure, click on &quot;Continue&quot;.<br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="hidden" name="step" value="setfolders" />
<input type="submit" value="Continue" />
</form>
<?php
}
?>
</body>
</html>
