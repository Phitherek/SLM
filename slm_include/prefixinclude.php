<?php
function prefixinclude($prefixflie="slm_prefix.php") {
global $prefixexists;
if($_POST['setprefix'] == 1) {
$prefixfile=fopen($prefixflie,"w");
flock($prefixfile, LOCK_EX);
fputs($prefixfile, '<?php'."\n");
fputs($prefixfile, '$prefix="'.$_POST['prefix'].'";'."\n");
fputs($prefixfile, '?>');
flock($prefixfile, LOCK_UN);
fclose($prefixfile);
if(file_exists($prefixflie)) {
echo("A prefix was saved successfully!<br />");	
} else {
echo("Could not save the file with prefix. Check directory privileges and try again!<br />");	
}
}
if(file_exists($prefixflie)) {
include($prefixflie);
$prefixexists = true;
} else {
$prefixexists = false;	
}
if($prefixexists == false) {
echo("For security reasons you must set a prefix for this installation of SLM. NEVER install two systems with the same prefix! If it is your first and only installation of SMPBNS, it is recommended to leave the default prefix.<br />");
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="text" name="prefix" value="slm_" /><br />
<input type="hidden" name="setprefix" value="1" />
<input type="submit" value="Set prefix and continue" />
</form>
<?php
die();
}
}
?>
