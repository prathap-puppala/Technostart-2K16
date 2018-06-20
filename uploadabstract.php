<?php
session_start();
require_once("site-settings.php");
//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
//preventing session hijacking
if(trim($_SESSION['web'])!=$sessionweb){if($isblocked<1){mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Session Hijacking')");}echo "<script>window.location='error.php';</script>";}
}

if($isloggedin==true)
{
if(isset($_FILES["uploadImage"]["name"]) && !empty($_FILES["uploadImage"]["name"]) && isset($_POST['eid']) && !empty($_POST['eid']))
{
$eid=trim(strip_tags(mysql_real_escape_string($_POST['eid'])));	
$q=mysql_query("SELECT * FROM events WHERE eid='$eid'");
if(mysql_num_rows($q)>=1){
$q_fet=mysql_fetch_array($q);	
//is user registered
 $user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'")); 	
 $eiids=array();
 $eiids=explode("~",$user_fet['eventids']);
  if(in_array($eid,$eiids))
	{	
	//getting team id
	$tid=0;
	$teamm=mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'");
	while($t=mysql_fetch_array($teamm))
	{
		 $spl=array();
		 $spl=explode("~",$t['ids']);
	     if(in_array($stuid,$spl)){$tid=$t['teamid'];break;}
	 }
	if(mysql_num_rows(mysql_query("SELECT * FROM abstract_uploads WHERE eid='$eid' && teamid='$tid'"))<1)
	{
	
	$abs=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Uploading Abstracts'"));
	if($abs['value']=="on")
	 {
	$abstract=mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='$eid' && visibility='1'");
    $abstract_fet=mysql_fetch_array($abstract);
	if($abstract_fet['uploadsopen']=="opened")
	{
	//main uploading start
	
//remove
$target_dir = $abstract_fet['uploadsfolderpath'];
$upload = 1;
$target_file = $target_dir . basename($_FILES["uploadImage"]["name"]);
$uploadOk = 1;
$allowed=array("jpg","pdf","doc","ppt","zip","JPG","PDF","DOC","PPT","ZIP","txt","TXT");
$imageFileType = pathinfo($_FILES["uploadImage"]["name"], PATHINFO_EXTENSION);
if (!in_array($imageFileType,$allowed)) {
    echo "File format is not allowed to Upload";
    $upload = 0;
    exit;
    
}
echo $_FILES["uploadImage"]["size"];
if ($_FILES["uploadImage"]["size"] > 6144*6144) {
    echo "Max File size is 6MB";
    $upload = 0;
    exit;
}
	$random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);

$filename=$stuid."_".$abstract_fet['branch']."_".$abstract_fet['eventname']."_".$random.".".$imageFileType;
$filepath=$abstract_fet['uploadsfolderpath']."/".$filename;
if ($upload == '1'){
$str = "";
if(!file_exists($filepath))
{
if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"] , $abstract_fet['uploadsfolderpath']."/".$filename)) {
    mysql_query("INSERT INTO abstract_uploads(eid,teamid,branch,eventname,stuid,filepath,ip) VALUES('$eid','$tid','".$abstract_fet['branch']."','".$abstract_fet['eventname']."','$stuid','$filepath','$ip')");
    $query=mysql_query("SELECT * FROM events WHERE eid='$eid'");
    $query_fetch=mysql_fetch_array($query);
    
    $frm="Event Organizer";
	$subject="Abstract Upload ". $query_fetch['eventname']."";
	$description='<div align="left">Hi '.$stuid.',<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your Abstract has been Uploaded Successfully.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> sd/-</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TECKZITE16 Team</b><br></div>';
    mysql_query("INSERT INTO personal_msgs(stuid,subject,description,frm) VALUES('$id','$subject','$description','$frm')");
    
    
    echo "success";
}
}
else
{
echo "Please Rename file";	
}
}


									 
	}		
	else		
	{
	echo "Abstract Uploading for this Event has been Closed";	
	}							 
    }
	else
	{
	echo "Abstract Uploading for All Events has been Closed";	
	}
		
	}
	else
	{
	echo "Your team already submitted abstract";	
	}							  
	}
	else
	{
	echo "You are Not Registered to this event";	
	}
	
	}
else{	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Wrong Event ID Passed for abstract upload.')");echo "There is no Such Event";}	
	
}
else
{
echo "Invalid File";
}	
}
else
{
echo "Please Login";	
}
?>
