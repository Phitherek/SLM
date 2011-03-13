<?php
function slm_userinfo($showlink=1,$showunlogged=1,$loginpage="login.php",$logoutpage="logout.php") {
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
?>
<p class="slm_text">You are logged in with the SLM system as: <?php echo $_SESSION[$prefix.'slm_username']; ?>!<br />
<?php
if($showlink == 1) {
?>
<a class="slm_link" href="<?php echo $logoutpage; ?>" alt="Logout">Click here to logout</a></p><br /><br />
<?php
} else {
?>
<br />
<?php
}
} else if($showunlogged == 1) {
?>
<p class="slm_text">You are not logged in with the SLM system.<br />
<?php
if($showlink == 1) {
?>
<a class="slm_link" href="<?php echo $loginpage; ?>" alt="Login">Click here to login</a></p><br /><br />
<?php
} else {
?>
<br />
<?php
}
}
}
?>
