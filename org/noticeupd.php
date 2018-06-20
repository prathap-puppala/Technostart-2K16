<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));

$count=0;
			
if($getuserdata['role']!="Webteam")
			{
			$user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
            for($i=0;$i<count($user_eve_data);$i++)
			{
			$su=mysql_num_rows(mysql_query("SELECT * FROM partoorgmsg WHERE eid='".$user_eve_data[$i]."' and seen='0'"));
			$count=$count+(int)$su;
			}
	}
	
    else
  {  
        $count=mysql_num_rows(mysql_query("SELECT * FROM webteammsg WHERE seen='0'"));
		}

if($count>0){echo "You have <sup><b style='background:red' width='5' height='2'>&nbsp;<font color='white'>$count</font>&nbsp;</b></sup> New Queries.Please Reply them..";}
else{echo "not";}
?>
