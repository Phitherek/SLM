<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SLM Administration</title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include("slm_include/prefixinclude.php");
prefixinclude("slm_prefix.php");
include("slm_include/loginform.php");
include("slm_include/adminonly.php");
include("slm_include/footer.php");
slm_loginpage_sub();
slm_adminonly("index.php", "slm_admin.php", "SLM Administration panel index");
if(file_exists("slm_install.php")) {
?>
<p class="slm_error">Serious security risk - you haven' t deleted slm_install.php!</p><br /><br />
<?php
}
if($_POST['auth'] == 1) {
	include("slm_users/".$_SESSION[$prefix.'slm_username'].".php");
	if($_POST['authpass'] == $pass) {
	$_SESSION[$prefix.'slm_adminpanel'] = 1;	
	} else {
	?>
	<p class="slm_error">Error: Bad password!</p>
	<?php	
	}
}
if($_GET['action'] == "unauth") {
$_SESSION[$prefix.'slm_modifyuser'] = NULL;
$_SESSION[$prefix.'slm_adminpanel'] = 0;
}
if($_SESSION[$prefix.'slm_adminpanel'] == 1) {
	if($_GET['action'] == "unmoduser") {
	$_SESSION[$prefix.'slm_modifyuser'] = NULL;	
	}
	if($_POST['choice'] == 1) {
		if(file_exists("slm_users/".$_POST['modusername'].".php")) {
	$_SESSION[$prefix.'slm_modifyuser'] = $_POST['modusername'];	
		} else {
		?>
		<p class="slm_error">Error: User doesn' t exist!</p><br />
		<?php
		}
	}
	if($_SESSION[$prefix.'slm_modifyuser'] != NULL) {
		?>
		<h3 class="slm_header">Actions:</h3><br />
		<a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=change" alt="change">Change user data</a><br />
		<a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=ban" alt="ban">Ban/Unban user</a><br />
		<a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=delete" alt="delete">Delete user</a><hr />
		<p class="slm_adminpanel_info">Selected user: <?php echo $_SESSION[$prefix.'slm_modifyuser']; ?> (<a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=unmoduser" alt="unmoduser">change</a>)(<a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=unauth" alt="unauth">exit</a>)</p><hr />
		<?php
		if($_GET['action'] == "change") {
			if($_POST['changed'] == 1) {
			if($_POST['newpass'] == $_POST['newpasschk']) {
			$fn="slm_users/".$_SESSION[$prefix.'slm_modifyuser'].".php";
			unlink($fn);
			$f = fopen($fn, 'w');
			flock($f, LOCK_EX);
			fputs($f, '<?php'."\n");
			fputs($f, '$pass="'.$_POST['newpass'].'";'."\n");	
			fputs($f, '$type="'.$_POST['newtype'].'";'."\n");
			fputs($f, '?>');
			flock($f, LOCK_UN);
			fclose($f);
			?>
			<p class="slm_success">SLM: Data changed successfully!</p>
			<?php
			} else {
			$error = 1;	
			?>
			<p class="slm_error">SLM Error: Passwords do not match!</p><br /><br />

			<?php
			}
			} else {
		include("slm_users/".$_SESSION[$prefix.'slm_modifyuser'].".php");
		if($type == "admin") {
		?>
		This is account of the administrator. You do not have privileges to change it. The only way to change it is to change data file on the server (the main administrator can do this).
		<?php
		} else {
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>?action=change" method="post">
		New password (leave default, if you doesn' t want to change): <input type="password" name="newpass" value="<?php echo $pass; ?>" /><br />
		Repeat password: <input type="password" name="newpasschk" value="<?php echo $pass; ?>" /><br />
		Account type (basic types: admin/user): <input type="text" name="newtype" value="<?php echo $type; ?>" /><br />
		<input type="hidden" name="changed" value=1 />
		<input type="submit" value="Change" />
		</form>
		<?php
		}
		}
		} else if($_GET['action'] == "ban") {
			if($_POST['banaction'] == "ban") {
			$fn="slm_bans/".$_SESSION[$prefix.'slm_modifyuser'].".php";
			$f=fopen($fn,'w');
			flock($f,LOCK_EX);
			fputs($f,'<?php'."\n");
			fputs($f,'$reason="'.$_POST['banreason'].'";'."\n");
			fputs($f,'?>'."\n");
			flock($f,LOCK_UN);
			fclose($f);
			?>
			<p class="slm_success">SLM: Ban added successfully.</p>
			<?php
			} else if($_POST['banaction'] == "unban") {
				unlink("slm_bans/".$_SESSION[$prefix.'slm_modifyuser'].".php");
				?>
			<p class="slm_success">SLM: Ban deleted successfully.</p>
			<?php
			} else {
		if(file_exists("slm_bans/".$_SESSION[$prefix.'slm_modifyuser'].".php")) {
		include("slm_bans/".$_SESSION[$prefix.'slm_modifyuser'].".php");
		?>
		<p class="slm_baninfo">This user is banned.<br />
		<?php
		if($reason == "no") {
		?>
		No reason.</p><br />
		<?php
		} else {
		?>
		Reason of ban: <?php echo $reason; ?></p><br />
		<?php
		}
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>?action=ban" method="post">
		<input type="hidden" name="banaction" value="unban" />
		<input type="submit" value="Unban">
		</form>
		<?php
		} else {
		include("slm_users/".$_SESSION[$prefix.'slm_modifyuser'].".php");
		if($type == "admin") {
		?>
		This is account of the administrator. You do not have privileges to ban it. The only way to ban it is to change data file on the server (the main administrator can do this).
		<?php
		} else {
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>?action=ban" method="post">
		Reason of ban (type &quot;no&quot; for no reason): <input type="text" name="banreason" value="no"><br />
		<input type="hidden" name="banaction" value="ban" />
		<input type="submit" value="Ban">
		</form>
		<?php
		}
		}
		}
		} else if($_GET['action'] == "delete") {
			if($_POST['delete'] == 1) {
			unlink("slm_users/".$_SESSION[$prefix.'slm_modifyuser'].".php");
			$_SESSION[$prefix.'slm_modifyuser'] = NULL;
			} else {
		include("slm_users/".$_SESSION[$prefix.'slm_modifyuser'].".php");
		if($type == "admin") {
		?>
		This is account of the administrator. You do not have privileges to delete it. The only way to delete it is to delete data file from the server (the main administrator can do this).
		<?php
		} else {
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>?action=delete" method="post">
		<input type="hidden" name="delete" value=1 />
		<input type="submit" value="Delete">
		</form>
		<?php
		}
		}
		}
	} else {
	?>
	<p class="slm_text">Type name of the user, which you want to control, or <a class="slm_link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=unauth" alt="unauth">leave Administration panel</a>.</p><br /><br />
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<input type="text" name="modusername" /><br />
	<input type="hidden" name="choice" value=1 />
	<input type="submit" value="Choose" /><br />
	</form>
	<?php
	}
} else {
?>
<p class="slm_text">To enter SLM Administration panel, you must type your password again</p><br /><br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="password" name="authpass" /><br />
<input type="hidden" name="auth" value=1 />
<input type="submit" value="Authorize" /><br />
</form>
<?php
}
slm_footer("index.php", "Index");
?>
</body>
</html>
