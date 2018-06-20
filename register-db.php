<?php
session_start();
require_once("site-settings.php");

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
//checking whether loggedin or not
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Registrations'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['stuid']) && !empty($_POST['stuid']) &&  isset($_POST['passwd']) && !empty($_POST['passwd']) && isset($_POST['cpasswd']) && !empty($_POST['cpasswd']) && isset($_POST['mobnum']) && !empty($_POST['mobnum']) && isset($_POST['seckey']) && !empty($_POST['seckey']) && isset($_POST['cseckey']) && !empty($_POST['cseckey']) && isset($_POST['captcha']) && !empty($_POST['captcha']))
{
//function for sanitizing variable values
function prathap($field)
{
$prathap=trim($_POST[$field]);	
$prathap=strip_tags($prathap);	
$prathap=htmlspecialchars($prathap);	
$prathap=mysql_real_escape_string($prathap);	
return $prathap;
}

//variables
$stuid=prathap("stuid");
$stuid=strtoupper($stuid);
$passwd=prathap("passwd");
$cpasswd=prathap("cpasswd");
$mobnum=prathap("mobnum");
$seckey=prathap("seckey");
$cseckey=prathap("cseckey");
$captcha=prathap("captcha");
$data=mysql_query("SELECT * FROM data WHERE id='$stuid'");
if(mysql_num_rows($data)>=1)
{
$data_f=mysql_fetch_array($data);
$dbgender=$data_f['gender'];
$dbclass=$data_f['class'];
$dbname=$data_f['name'];
$dbyear=$data_f['year'];
$branch="CSE";
$valid=true;

if($passwd=="")
{
echo "Please Enter Password";	
}
elseif($cpasswd=="")
{
echo "Please Enter Confirm Password";	
}
elseif($passwd!=$cpasswd)
{
echo "Password and Confirm Password are not same";	
}
elseif($mobnum=="" && is_numeric($mobnum)==false && strlen($mobnum)!=10)
{
echo "Please Enter Valid Mobile Number";	
}
elseif($seckey=="")
{
echo "Please Enter Security Key";	
}
elseif($cseckey=="")
{
echo "Please Enter Confirm Security Key";	
}
elseif($seckey!=$cseckey)
{
echo "Security Key and Confirm Security Key  are not same";	
}
elseif($captcha=="")
{
echo "Please Enter Captcha";	
}
elseif($captcha!=$_SESSION['cap_code'])
{
echo "Invalid Captcha";
}
else
{
//checking whether already registered	
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"))>=1)
{
echo "Already Registered";	
}	
else
{
	$passwd=md5($passwd);
    $curtzid=$stuid;		
	$frm="TECHNOSTART16 Team";
	$subject="Thanks for Registering";
	$description='<div align="left">Hi '.$dbname.',<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thank you for Registering to TECHNOSTART16.Please pay <b>'.$fee.'/-</b> to Complete registration process so that you can register to any event.If any problem persists,please contact us.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> sd/-</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TECHNOSTART16 Team</b><br></div>';
	
		 if(mysql_query("INSERT INTO `users`(stuid,tzid,stuname,passwd,seckey,gender,year,branch,class,phone,fees,lastip) VALUES('$stuid','$curtzid','$dbname','$passwd','$seckey','$dbgender','$dbyear','$branch','$dbclass','$mobnum','$fee','$ip')") or die(mysql_error()))
	 {
		
if(mysql_query("INSERT INTO personal_msgs(stuid,subject,description,frm) VALUES('$stuid','$subject','$description','$frm')") or die(mysql_error()))  
		  {echo "success";}
	  
	 }

		
	
}
}
}
else
{
echo "Invalid University ID";
}
}
else
{
	//blocking User ips
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Registration Page Values Passing')");
}
}
else
{
echo "Registrations are closed";	
}
?>

