<?php
session_start();
require_once("site-settings.php");


//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){echo "Your Ip has been blocked";}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
//checking whether loggedin or not
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Forgot Password'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['stuid']) && !empty($_POST['stuid']) && isset($_POST['seckey']) && !empty($_POST['seckey'])  && isset($_POST['mobnum']) && !empty($_POST['mobnum']) && isset($_POST['passwd']) && !empty($_POST['passwd'])  && isset($_POST['cpasswd']) && !empty($_POST['cpasswd']))
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
$seckey=prathap("seckey");
$mobnum=prathap("mobnum");
$passwd=prathap("passwd");
$cpasswd=prathap("cpasswd");

$data=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");
if(mysql_num_rows($data)>=1)
{

if(mysql_num_rows(mysql_query("SELECT * FROM data WHERE id='$stuid'"))<1)
{
echo "Please Enter Valid University ID";
}
elseif($seckey=="")
{
echo "Please Enter Security Key";	
}
elseif($mobnum=="" || !is_numeric($mobnum) || strlen($mobnum)!=10)
{
echo "Please Enter Valid Mobile Number";	
}
elseif($passwd=="")
{
echo "Please Enter New Password";	
}
elseif($cpasswd=="")
{
echo "Please Enter Confirm Password";	
}
elseif($passwd!=$cpasswd)
{
echo "New Password and Confirm Password are not same";	
}
else
{
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid' && seckey='$seckey' && phone='$mobnum'"))>=1)
{

mysql_query("UPDATE users SET passwd='$passwd',lastip='$ip',lasttime='$time' WHERE stuid='$stuid'");

echo "success";	
}	
else
{
	
echo "Invalid Details";	
	}

		
	

}
}
else
{
echo "You are not Registered";
}
}
else
{
	//blocking User ips
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Forgot Page Values Passing')");
}
}
else
{
echo "Forgot Option is Disabled";	
}
?>

