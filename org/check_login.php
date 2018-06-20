<?php
session_start();
require_once("../site-settings.php");
if(isset($_POST['orgid']) && isset($_POST['orgpass']))
{
$orgid=strip_tags(htmlspecialchars(addslashes(strtoupper($_POST['orgid']))));
$orgpass=strip_tags(htmlspecialchars(addslashes($_POST['orgpass'])));
$orgpass=md5($orgpass);
$dup=mysql_query("SELECT * FROM organizers WHERE orgid='$orgid' AND orgpass='$orgpass'");
if(mysql_num_rows($dup)==1)
{
$_SESSION['tz_organizer']=$orgid;
$q=mysql_fetch_array($dup);
if($q['role']=="Webteam" )
	{
   $_SESSION['tz_webteam']=$orgid;
	}

mysql_query("UPDATE organizers SET status='online' WHERE orgid='".$_SESSION['tz_organizer']."'");
echo "success";
}
else
{
echo "invalid";
}
}

else
{
header("location:index.php");
}
?>
