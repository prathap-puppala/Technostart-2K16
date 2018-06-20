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
if(mysql_num_rows(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".mysql_real_escape_string($_POST['eid'])."'"))>=1)
	{

   echo "already";
	}
	else
	{
		$eved=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".mysql_real_escape_string($_POST['eid'])."'"));
		
		//creating folder to store abstract files
		if(is_dir("../tzabstractsubmissions/"))
		{
		
       //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}

		}
        else
		{
			//creating main folder
			mkdir("../tzabstractsubmissions/");
			    //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}
 
		}
  $uplpath="tzabstractsubmissions/".$eved['branch']."/".$eved['eventname'];


		if(mysql_query("INSERT INTO abstract_uploads_settings(eid,branch,eventname,uploadsfolderpath,added_by_id,added_by_name,added_by_ip,time) VALUES('".mysql_real_escape_string($_POST['eid'])."','".$eved['branch']."','".$eved['eventname']."','$uplpath','".$_SESSION['tz_organizer']."','".$getuserdata['name']."','$ip','$time')") or die(mysql_error()))
		{
			echo "success";
		}
	}
}
?>
