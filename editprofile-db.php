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
if($isloggedin==true)
{
if(isset($_POST['mobnum']) && !empty($_POST['mobnum']))
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
$mobnum=prathap("mobnum");
$data=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");
if(mysql_num_rows($data)>=1)
{

if(strlen($mobnum)!=10 || is_numeric($mobnum)==false)
{
echo "Please Enter Valid Mobile Number";
}
else
{
//checking whether already registered	
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"))>=1)
{

mysql_query("UPDATE users SET phone='$mobnum',edits=edits+1,lastip='$ip',lasttime=NOW() WHERE stuid='$stuid'");
echo "updated";	
}	
else
{
	
echo "Update Failed";	
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
echo "Please Login";	
}
?>

