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
if(1==1)
{
if(isset($_POST['stuid']) && !empty($_POST['stuid']) && isset($_POST['seckey']) && !empty($_POST['seckey'])  && isset($_POST['mobnum']) && !empty($_POST['mobnum']))
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
else
{
$qu=mysql_query("SELECT * FROM users WHERE stuid='$stuid' && seckey='$seckey' && phone='$mobnum'");
if(mysql_num_rows($qu)>=1)
{

$dd=mysql_fetch_array($qu);

echo $dd['tzid'];	
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

