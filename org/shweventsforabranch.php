<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
if(isset($_POST['value']))
{

$bran=mysql_query("SELECT * FROM events WHERE branch='".$_POST['value']."'");
if(mysql_num_rows($bran)>=1)
	{
echo "<select id='evenids' class='text' onchange='addeveids(this.value)'><option value=''>Choose</option>";
while($eves=mysql_fetch_array($bran))
	{
  echo "<option value='".$eves['eid']."'>".$eves['eventname']."</option>";
	}
	echo "</select>";

	}

	else
	{
echo "<font color='red'>No Events available for ".$_POST['value']."</font>";
	}
}
?>