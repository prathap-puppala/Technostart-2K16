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
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Logins'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['stuid']) && !empty($_POST['stuid']) && isset($_POST['passwd']) && !empty($_POST['passwd']) && isset($_POST['captcha']) && !empty($_POST['captcha']))
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
$captcha=prathap("captcha");

$data=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");
if(mysql_num_rows($data)>=1)
{

if(mysql_num_rows(mysql_query("SELECT * FROM data WHERE id='$stuid'"))<1)
{
echo "Please Enter Valid University ID";
}
elseif($passwd=="")
{
echo "Please Enter Password";	
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
$passwd=md5($passwd);


//checking whether already registered	
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid' && passwd='$passwd'"))>=1)
{

mysql_query("UPDATE users SET logins=logins+1,lastip='$ip',lasttime=NOW() WHERE stuid='$stuid'");
$_SESSION['stuid']=$stuid;
$_SESSION['web']=$sessionweb;
echo "success";	
}	
else
{
	
echo "Invalid Login";	
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
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Login Page Values Passing')");
}
}
else
{
echo "Logins are Disabled";	
}
?>

