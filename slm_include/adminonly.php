<?php
function slm_adminonly() {
	session_start();
	if($_SESSION['slm_type'] != "admin") {
		?>
		<p class="slm_error">Ta strona dostępna jest tylko dla użytkownika SLM ze statusem administratora! Jeżeli powinieneś mieć do niej dostęp, skontaktuj się z administratorem.</p><br /><br />
		<?php
		include("footer.php");
		slm_footer();
		die();
	}
}
?>
