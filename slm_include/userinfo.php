<?php
function slm_userinfo($showlink=1,$showunlogged=1,$loginpage="login.php",$logoutpage="logout.php") {
session_start();
if($_SESSION['slm_loggedin'] == 1) {
?>
<p class="slm_text">Jesteś zalogowany/a za pomocą systemu SLM jako: <?php echo $_SESSION['slm_username']; ?>!<br />
<?php
if($showlink == 1) {
?>
<a class="slm_link" href="<?php echo $logoutpage; ?>" alt="Logout">Kliknij tutaj, aby się wylogować</a></p><br /><br />
<?php
} else {
?>
<br />
<?php
}
?>
<p class="slm_footer">Powered by SLM | &copy; 2010 by Phitherek_</p>
<?php
} else if($showunlogged == 1) {
?>
<p class="slm_text">Nie jesteś zalogowany/a za pomocą systemu SLM<br />
<?php
if($showlink == 1) {
?>
<a class="slm_link" href="<?php echo $loginpage; ?>" alt="Logout">Kliknij tutaj, aby się zalogować</a></p><br /><br />
<?php
} else {
?>
<br />
<?php
}
?>
<p class="slm_footer">Powered by SLM | &copy; 2010 by Phitherek_</p><?php
}
}
?>
