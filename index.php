<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TestIndex</title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include("slm_include/userinfo.php");
include("slm_include/footer.php");

slm_userinfo();
?>
<a href="passwd.php" alt="passwd">Zmiana hasła SLM</a><br />
<a href="adminonly.php" alt="adminonly">Test AdminOnly</a><br />
<?php
slm_footer("slm_admin.php","Administracja SLM");
?>
</body>
</html>
