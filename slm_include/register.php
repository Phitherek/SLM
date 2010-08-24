<?php
function slm_register($redirect=1,$redirectpage="login.php") {
?>
<h1>Registration in SLM system</h1><br />
<?php
if($_POST['action'] == "register") {
	$action = NULL;
	if($_POST['regpass'] == $_POST['regpasscheck']) {
	$file = "slm_users/".$_POST['username'].".php";
	$f=fopen($file, 'w');
	flock($f, LOCK_EX);
	fputs($f, '<?php'."\n");
	fputs($f, '$pass="'.$_POST['regpass'].'";'."\n");	
	fputs($f, '$type="user";'."\n");
	fputs($f, '?>');
	flock($f, LOCK_UN);
	fclose($f);
	?>
	<p class="slm_success">Registration completed!</p><br />
	<a class="slm_link" href="<?php echo $redirectpage; ?>" alt="redirect">Click here if automatic redirection fails</a><br /><br />
	<script type="text/javascript">
	window.location.href = "<?php echo $redirectpage; ?>";
	</script>
	<?php
	} else {
	?>
	<p class="slm_error">Passwords do not match!</p><br />
	<?php
	$action = "second";	
	}
} if($_POST['action'] == "checkusername" OR $action == "second") {
	$action = NULL;
	if(file_exists("slm_users/".$_POST['username'].".php")) {
		?>
		<p class="slm_error">SLM Error: User already exists!</p><br /><br />
		<?php
		$action = "first";
	} else {
	?>
	<p class="slm_text">Now type your password and click on &quot;Register!&quot;</p><br /><br />
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Username: <?php echo $_POST['username']; ?><br />
Password: <input type="password" name="regpass" /><br />
Type password again: <input type="password" name="regpasscheck" /><br />
<input type="hidden" name="username" value="<?php echo $_POST['username']; ?>" />
<input type="hidden" name="action" value="register" />
<input type="submit" value="Register!" />
</form>
	<?php	
	}
} if($action == "first" OR $_POST['action'] == NULL)  {
?>
<p class="slm_text">Type your preffered username and click on &quot;Check availability!&quot;</p><br /><br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Username: <input type="text" name="username" /><br />
<input type="hidden" name="action" value="checkusername" />
<input type="submit" value="Check availability!" />
</form>
<?php
}
}
?>
