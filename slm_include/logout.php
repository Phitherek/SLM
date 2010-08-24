<?php
function slm_logout($redirect="index.php") {
	session_start();
	if (!isset($_SESSION['started'])) {
	session_regenerate_id();
	$_SESSION['started'] = true;
}
	if($_SESSION['slm_loggedin'] == 1) {
	$_SESSION['slm_loggedin'] = 0;
	$_SESSION['slm_username'] = NULL;
	$_SESSION['slm_type'] = NULL;
	$_SESSION['slm_userfile_type'] = NULL;
?>
<p class="slm_success">Logged out from SLM system!</p><br /><br />
<a class="slm_link" href="<?php echo $redirect; ?>" alt="redirect">Click here if automatic redirection fails</a><br /><br />
<script type="text/javascript">
window.location.href = "<?php echo $redirect; ?>";
</script>
<?php
	} else {
	?>
<p class="slm_success">You are not logged in!</p><br /><br />
<a class="slm_link" href="<?php echo $redirect; ?>" alt="redirect">Click here if automatic redirection fails</a><br /><br />
<script type="text/javascript">
window.location.href = "<?php echo $redirect; ?>";
</script>
<?php	
}
}
?>
