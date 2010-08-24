<?php
function slm_adminonly($link="index.php",$footerlinkpage="index.php", $footerlinktext="Indeks") {
	session_start();
	if (!isset($_SESSION['started'])) {
	session_regenerate_id();
	$_SESSION['started'] = true;
}
	if($_SESSION['slm_type'] != "admin") {
		?>
		<p class="slm_error">This page is available only for user with administrative privileges. If you should have access to this page, contact with the administrator.<br /><br /><a class="slm_link" href="<?php echo $link; ?>" alt="link">Go to main page</a></p><br /><br />
		<?php
		?>
<hr />
<p class="slm_footer">Powered by SLM | &copy; 2010 by Phitherek_<br /><br />
<a class="slm_link" href="<?php echo $footerlinkpage; ?>" alt="link"><?php echo $footerlinktext; ?></a></p>
<?php
		die();
	}
}
?>
