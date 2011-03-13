<?php
function slm_logout($redirect="index.php") {
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
	$_SESSION[$prefix.'slm_loggedin'] = 0;
	$_SESSION[$prefix.'slm_username'] = NULL;
	$_SESSION[$prefix.'slm_type'] = NULL;
	$_SESSION[$prefix.'slm_userfile_type'] = NULL;
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
