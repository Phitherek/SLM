<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Profile</title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['started'])) {
session_regenerate_id();
$_SESSION['started'] == 1;
}
include("slm_include/loginform.php");
include("slm_include/userfile.php");
include("slm_include/footer.php");
slm_loginpage_sub();
if($_GET['action'] == "edit") {
	if($_POST['sent'] == 1) {
		$r2=slm_userfile_winit($_SESSION['slm_username']);
	if($r2 == 0) {
		$r3=slm_userfile_puts("additional", $_POST['additional']);
		$r4=slm_userfile_wclose();
		if($r3 != 0 OR $r4 != 0) {
			echo("Błąd!");
		}
	} else {
	echo("Błąd!");	
	}
	} else {
	?>
	<h1>Edycja danych profilu</h1><br /><br />
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>?action=edit" method="post">
	Dodatkowe informacje: <input type="text" name="additional" /><br />
	<input type="hidden" name="sent" value=1 />
	<input type="submit" value="Zatwierdź" />
	</form>
	<?php	
	}
} else {
$r1=slm_userfile_read($_SESSION['slm_username']);
if($r1 == 0) {
?>
<h1><?php echo $_SESSION['slm_username']; ?></h1><br />
Typ konta: <?php echo $_SESSION['slm_userfile_type']; ?><br />
Dodatkowe info: <?php echo $additional; ?><br /><br />
<?php
} else {
	echo("Nie można odczytać pliku użytkownika!<br /><br />");	
}
?>
<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?action=edit" alt="edit">Edycja danych profilu</a>
<?php
}
slm_footer();
?>
</body>
</html>
