<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}

require_once("../site-settings.php");

$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
if(isset($_POST['eid']))
{
if(mysql_query("UPDATE abstract_uploads_settings SET visibility='1',added_by_id='".$_SESSION['tz_organizer']."',added_by_name='".$getuserdata['name']."',added_by_ip='$ip',added_by_time=NOW(),time='$time' WHERE eid='".mysql_real_escape_string($_POST['eid'])."'"))
	{
	echo "success";
	}
}
?>