<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$sitesettingsdat=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Deleting Notices'"));
if(isset($_POST['nid']))
{
if(mysql_query("UPDATE notifications SET visibility='0' WHERE nid='".mysql_real_escape_string($_POST['nid'])."'"))
	{
	echo "success";
	}
}
?>