<?php
function slm_passwd() {
	global $prefixexists;
	if(!$prefixexists) {
	include("slm_include/prefixinclude.php");
	prefixinclude("../slm_prefix.php");
	}
	session_start();
	if (!isset($_SESSION[$prefix.'started'])) {
	session_regenerate_id();
	$_SESSION[$prefix.'started'] = true;
}
	if($_SESSION[$prefix.'slm_loggedin'] == 1) {
		if($_POST['change'] == 1) {
		$error=0;
		if(file_exists("slm_users/".$_SESSION[$prefix.'slm_username'].".php")) {
		include("slm_users/".$_SESSION[$prefix.'slm_username'].".php");
		if($_POST['oldpass'] == $pass) {
			if($_POST['newpass'] == $_POST['newpasschk']) {
			$fn="slm_users/".$_SESSION[$prefix.'slm_username'].".php";
			unlink($fn);
			$f = fopen($fn, 'w');
			flock($f, LOCK_EX);
			fputs($f, '<?php'."\n");
			fputs($f, '$pass="'.$_POST['newpass'].'";'."\n");	
			fputs($f, '$type="'.$type.'";'."\n");
			fputs($f, '?>');
			flock($f, LOCK_UN);
			fclose($f);
			?>
			<p class="slm_success">SLM: Password changed successfully!</p>
			<?php
			} else {
			$error = 1;	
			?>
			<p class="slm_error">SLM Error: Passwords do not match!</p><br /><br />
			<?php
			}
		} else {
		$error = 1;
		?>
		<p class="slm_error">SLM Error: Bad password!</p><br /><br />
		<?php
		}
		}
		} else if($error == 1 OR $_POST['change'] == 0) {
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Old password: <input type="password" name="oldpass" /><br />
New password: <input type="password" name="newpass" /><br />
Repeat new password: <input type="password" name="newpasschk" /><br />
<input type="hidden" name="change" value="1" />
<input type="submit" value="Change password" />
</form>
<?php	
		}
	}
}
?>
