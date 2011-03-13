<?php
function slm_loginpage_main($banmode=1,$register=1,$registerpage="register.php",$redirect="index.php")
{
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
if($_SESSION[$prefix.'slm_loggedin'] == 0) {
if($_POST['login'] == 1) {
	$error=4;
if(file_exists("slm_bans/".$_POST['username'].".php")) {
	if($banmode == 1) {
		include("slm_bans/".$_POST['username'].".php");
		?>
		<p class="slm_baninfo">Your SLM account is banned!<br />
		<?php
		if($reason == "no") {
		?>
		Administrator didn' t give any reason.</p>
		<?php
		} else {
		?>
		Reason of the ban: <?php echo $reason; ?></p>
		<?php
		}
		$error=3;
	}	
	} else if($banmode == 0 OR $error == 4) {
	if(file_exists("slm_users/".$_POST['username'].".php")) {
		include("slm_users/".$_POST['username'].".php");
		if($pass == $_POST['password']) {
		$error = 0;
		session_regenerate_id;
		$_SESSION[$prefix.'slm_loggedin'] = 1;
		$_SESSION[$prefix.'slm_username'] = $_POST['username'];
		$_SESSION[$prefix.'slm_type'] = $type;
		} else {
		$error = 2;	
		}
	} else {
	$error = 1;	
	}
	}
} else {
$error = 3;	
}
if($error == 0) {
?>
<p class="slm_success">Correctly logged in as: <?php echo $_POST['username']; ?>!</p><br />
<script type="text/javascript">
window.location.href = "<?php echo $redirect; ?>";
</script>
<a class="slm_link" href="<?php echo $redirect; ?>" alt="Index">Click here if automatic redirection fails</a>
<?php
} else {
	if($error == 1) {
	?>
	<p class="slm_error">SLM Error: User doesn' t exist!</p><br />
	<?php	
	} else if($error == 2) {
	?>
	<p class="slm_error">SLM Error: Bad password!</p><br />
	<?php	
	}
?>
<h1 class="slm_header">Login to SLM system</h1><br /><br />
<p class="slm_text">After login you will gain access to additional functions of the page. <?php if($register == 1) { ?>If you don' t have an account yet, <a href="<?php echo $registerpage; ?>" alt="Register">register</a>.<?php } ?></p><br /><br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
<input type="hidden" name="login" value="1" />
<input type="submit" value="Login" /><br /><br />
</form>
<?php
}
} else {
?>
<p class="slm_success">You are logged in as <?php echo $_POST['username']; ?>yet!</p><br />
<script type="text/javascript">
window.location.href = "<?php echo $redirect; ?>";
</script>
<a class="slm_link" href="<?php echo $redirect; ?>" alt="Index">Click here, if automatic redirection fails</a>
<?php	
}
}
function slm_loginpage_sub($banmode=1,$register=1,$registerpage="register.php")
{
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
if($_SESSION[$prefix.'slm_loggedin'] == 0) {
	if($_POST['login'] == 1) {
	$error=4;
if(file_exists("slm_bans/".$_POST['username'].".php")) {
	if($banmode == 1) {
		include("slm_bans/".$_POST['username'].".php");
		?>
		<p class="slm_baninfo">Your SLM account is banned!<br />
		<?php
		if($reason == "no") {
		?>
		Administrator didn' t give any reason.</p>
		<?php
		} else {
		?>
		Reason of the ban: <?php echo $reason; ?></p>
		<?php
		}
		$error=3;
	}
		} else if($banmode == 0 OR $error == 4)  {
	if(file_exists("slm_users/".$_POST['username'].".php")) {
		include("slm_users/".$_POST['username'].".php");
		if($pass == $_POST['password']) {
		$error = 0;
		session_regenerate_id();
		$_SESSION[$prefix.'slm_loggedin'] = 1;
		$_SESSION[$prefix.'slm_username'] = $_POST['username'];
		$_SESSION[$prefix.'slm_type'] = $type;
		} else {
		$error = 2;	
		}
	} else {
	$error = 1;	
	}
		}
} else {
$error = 3;	
}
if($error == 0) {
?>
<p class="slm_success">Correctly logged in as: <?php echo $_POST['username']; ?>!</p>
<?php
return(0);	
} else {
	if($error == 1) {
	?>
	<p class="slm_error">SLM Error: Given user doesn' t exist!</p><br />
	<?php	
	} else if($error == 2) {
	?>
	<p class="slm_error">SLM Error: Bad password!</p><br />
	<?php	
	}
?>
<h1 class="slm_header">Login to SLM system</h1><br /><br />
<p class="slm_text">To gain access to this page, you must be logged in by the SLM system. <?php if($register == 1) { ?>If you doesn' t have an account yet, <a href="<?php echo $registerpage; ?>" alt="Register">register</a>.<?php } ?></p><br /><br />
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
<input type="hidden" name="login" value="1" />
<input type="submit" value="Login" /><br /><br />
</form>
<?php
die();
}
}
}
?>
