<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");

if(isset($_POST['func']) && isset($_POST['value']))
{
$func=mysql_real_escape_string($_POST['func']);
$value=mysql_real_escape_string($_POST['value']);
mysql_query("UPDATE site_settings SET value='$value' WHERE function='$func'") or die(mysql_error());
echo "success";
}
?>