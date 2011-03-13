<?php
function slm_adminonly($link="index.php",$footerlinkpage="index.php", $footerlinktext="Index") {
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
	if($_SESSION[$prefix.'slm_type'] != "admin") {
		?>
		<p class="slm_error">This page is available only for user with administrative privileges. If you should have access to this page, contact with the administrator.<br /><br /><a class="slm_link" href="<?php echo $link; ?>" alt="link">Go to main page</a></p><br /><br />
		<?php
		?>
<hr />
<p class="slm_footer">Powered by SLM | &copy; 2010-2011 by Phitherek_<br /><br />
<a class="slm_link" href="<?php echo $footerlinkpage; ?>" alt="link"><?php echo $footerlinktext; ?></a></p>
<?php
		die();
	}
}
?>
