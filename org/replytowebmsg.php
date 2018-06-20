<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");

if(isset($_POST['sno']) && isset($_POST['c'])  && isset($_POST['eid']))
{
$func=mysql_real_escape_string($_POST['sno']);
$value=mysql_real_escape_string($_POST['c']);
$eid=mysql_real_escape_string($_POST['eid']);
$re=mysql_fetch_array(mysql_query("SELECT * FROM webteammsg WHERE sno='$func'"));
$rec=$re['sender'];
if($value!="")
{
mysql_query("INSERT INTO webteammsg(sender,receiver,subject,seen,ip) VALUES('".$_SESSION['tz_organizer']."','$rec','$value','1','$ip')") or die(mysql_error());
mysql_query("UPDATE webteammsg SET seen='1' WHERE sno='$func'");
}
else
{
mysql_query("UPDATE webteammsg SET seen='1' WHERE sno='$func'");	
}
echo "success";
}
?>
