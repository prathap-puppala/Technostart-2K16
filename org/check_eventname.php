<?php
session_start();
require_once("../site-settings.php");
if(isset($_SESSION['tz_webteam']))
{
if(isset($_POST['branch']) && isset($_POST['eventname']))
{
$branch=strip_tags(htmlspecialchars(addslashes(strtoupper($_POST['branch']))));
$eventname=strip_tags(htmlspecialchars(addslashes(strtoupper($_POST['eventname']))));

$dup=mysql_query("SELECT * FROM events WHERE branch='$branch' AND eventname='$eventname'");
if(mysql_num_rows($dup)<1)
{

echo "available";
}
else
{
echo "already";
}
}
}
else
{
header("location:index.php");
}
?>
