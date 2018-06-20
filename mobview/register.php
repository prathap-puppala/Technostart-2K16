<?php
session_start();
require_once("../site-settings.php");
$err=array();
//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
header("location:index");
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}

if(!isset($_SESSION['visited'])){mysql_query("UPDATE visits SET visits950=visits950+1");$_SESSION['visited']="yes";}
$vis=mysql_fetch_array(mysql_query("SELECT * FROM visits"));

if(isset($_POST['submit']))
{
//checking whether loggedin or not
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Registrations'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['stuid']) &&   isset($_POST['passwd'])  && isset($_POST['cpasswd']) && isset($_POST['mobnum'])  && isset($_POST['seckey'])  && isset($_POST['cseckey'])  && isset($_POST['captcha']))
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
array_push($err,"Please Enter Password");	
}
elseif($cpasswd=="")
{
array_push($err,"Please Enter Confirm Password");	
}
elseif($passwd!=$cpasswd)
{
array_push($err,"Password and Confirm Password are not same");	
}
elseif($mobnum=="" && is_numeric($mobnum)==false && strlen($mobnum)!=10)
{
array_push($err,"Please Enter Valid Mobile Number");	
}
elseif($seckey=="")
{
array_push($err,"Please Enter Security Key");	
}
elseif($cseckey=="")
{
array_push($err,"Please Enter Confirm Security Key");	
}
elseif($seckey!=$cseckey)
{
array_push($err,"Security Key and Confirm Security Key  are not same");	
}
elseif($captcha=="")
{
array_push($err,"Please Enter Captcha");	
}
elseif($captcha!=$_SESSION['cap_code'])
{
array_push($err,"Invalid Captcha");
}
else
{
//checking whether already registered	
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"))>=1)
{
array_push($err,"Already Registered");	
}	
else
{
	$passwd=md5($passwd);
    $curtzid=$stuid;		
	$frm="TECHNOSTART16 Team";
	$subject="Thanks for Registering";
	$description='<div align="left">Hi '.$dbname.',<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thank you for Registering to TECHNOSTART16.Please pay <b>'.$fee.'/-</b> to Complete registration process so that you can register to any event.If any problem persists,please contact us.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> sd/-</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TECHNOSTART16 Team</b><br></div>';
	
		 if(mysql_query("INSERT INTO `users`(stuid,tzid,stuname,passwd,seckey,gender,year,branch,class,phone,fees,lastip,regfrom) VALUES('$stuid','$curtzid','$dbname','$passwd','$seckey','$dbgender','$dbyear','$branch','$dbclass','$mobnum','$fee','$ip','mobile')") or die(mysql_error()))
	 {
		
if(mysql_query("INSERT INTO personal_msgs(stuid,subject,description,frm) VALUES('$stuid','$subject','$description','$frm')") or die(mysql_error()))  
		  {header("location:tzid.php?id=$curtzid");}
	  
	 }	
}
}
}
else
{
array_push($err,"Invalid University ID");
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
array_push($err,"Registrations are closed");	
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="author" content="Prathap Puppala,N130950" />
<title><?php echo $title;?> | Register</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />    
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jscourselite.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css.css" type="text/css" media="screen" />
<link rel="icon" href="../img/favicon.png">
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="js/script_jcarousellite.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
function pick(field)
{
var prathap=document.getElementById(field).value;
return prathap;	
}

function notify(msg,cat,time,modal)
{
$("#msg").html(msg);
}

function dofocus(field){$("#"+field).focus();}

function checkform()
{
var stuid=pick("stuid");
var passwd=pick("passwd");
var cpasswd=pick("cpasswd");
var mobnum=pick("mobnum");
var seckey=pick("seckey");
var cseckey=pick("cseckey");
var captcha=pick("captcha");

if(stuid=="" || stuid==undefined)
{
notify("Please Enter University ID","error","2000","true");
dofocus("stuid");
return false;
}
else if(passwd=="" || passwd==undefined)
{
notify("Please Enter Password","error","2000","true");
dofocus("passwd");
return false;
}
else if(cpasswd=="" || cpasswd==undefined)
{
notify("Please Enter Confirm Password","error","2000","true");
dofocus("cpasswd");
return false;
}
else if(passwd!=cpasswd)
{
notify("Password and Confirm Passwords are not same","error","2000","true");
dofocus("cpasswd");
return false;
}
else if(mobnum=="" || mobnum.length!=10 || isNaN(mobnum)==true || mobnum==undefined)
{
notify("Please Enter Valid Mobile Number","error","2000","true");
dofocus("mobnum");
return false;
}
else if(seckey=="" || seckey==undefined)
{
notify("Please Enter Security Key","error","2000","true");
dofocus("seckey");
return false;
}
else if(cseckey=="" || cseckey==undefined)
{
notify("Please Enter Confirm Security Key","error","2000","true");
dofocus("cseckey");
return false;
}
else if(seckey!=cseckey)
{
notify("Security and Confirm Security key are not same","error","2000","true");
dofocus("cseckey");
return false;
}
else if(captcha==undefined || captcha=="")
{
notify("Please Enter captcha code","error","2000","true");
dofocus("captcha");
return false;
}

else
{
//confirmation
if(confirm("Are you sure to Register?"))
{
return true;
}
else
{
return false;	
}
}
}
</script>
</head>

<body>
<div id="container">
	<!--HEADER START-->
	<div id="header">
    	<!--TOP START-->
    	<div id="top">
            <div class="logo l"><a href="index" title="<?php echo $title;?>"><br /><big><?php echo $title;?></big></a></div>
            <div class="search-or-call r">
            	<div><h2><span>RGUKT NUZVID</span></h2></div>
               <!--Search box for optional<div class="sbox l"><input name="search" type="text" class="searchbox" /></div>
               <div class="sbtn l"><input name="searchbtn" type="image" src="images/searchbtn.png"  /></div> 
               <div class="c"></div>-->
            </div>
            <div class="c"></div>
        </div>
        <!--TOP END-->
        <!--NAV START-->
        <div id="nav">
		<ul>
        	<li><a href="index">Home</a></li>
            <li><a href="about">About</a></li>
            <li><a href="events">Events</a></li>
            <li><a href="updates">Updates</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>
        <div class="c"></div>
		</div>
        <!--NAV END-->
  	</div>
   	<!--HEADER END-->
   <!--CONTENT START-->
    <div id="content">
    	<div class="contentbg">
        	<div class="contenttop">
        		<div class="contentbottom">
        			<h1>Register</h1>
                    <div style="display:block;padding:10px;">
						    <b><font  id="msg" color="#FF0000"><?php 
						    for($i=0;$i<count($err);$i++)
						    {
							echo $err[$i]."<br>";	
							}
						    ?></font></b>											
					</div>
                    <form method="post" action="" id="inquiry2" name="business" style="padding-left:7px;" onSubmit="return checkform();">
                      <p>            
                        <label for="stuid">University ID: <span>*</span></label>            
                        <input type="text" tabindex="1"  placeholder="ex: N130950" value="<?php echo $_POST['stuid'];?>" name="stuid" id="stuid" />                        
                      </p>
                      <p>
                        <label for="passwd">Password:<span>*</span></label>
                        <input type="password" tabindex="2"  value="" id="passwd" name="passwd" />
                      </p>
                      <p>
                        <label for="cpasswd">Re-type Password:<span>*</span></label>
                        <input type="password" tabindex="3"  value="" id="cpasswd" name="cpasswd" />
                      </p>
                      <p>
                        <label for="mobnum">Mobile:<span>*</span></label>
                        <input type="text" tabindex="4"  value="<?php echo $_POST['mobnum'];?>" id="mobnum" name="mobnum" placeholder="ex: 9010932254"/>
                      </p>
                      <p>
                        <label for="seckey">Security Key:<span>*</span></label>
                        <input type="password" tabindex="5"  value="<?php echo $_POST['seckey'];?>" id="seckey" name="seckey" />
                      </p>
                      <p>
                        <label for="cseckey">Re-type Security Key:<span>*</span></label>
                        <input type="password" tabindex="6"  value="<?php echo $_POST['cseckey'];?>" id="cseckey" name="cseckey" />
                      </p>
                      <p>
                        <label for="captcha">Captcha:<span>*</span></label><br>
                        <img src="../captcha.php" style="float:left;"><input style="float:right;width:210px;" type="text" tabindex="7"  value="" id="captcha" name="captcha" />
                      </p><br><br>
                      <p class="submit">
                        <input type="submit" tabindex="8" class="button blue" id="submit" name="submit" value="Register"/>                        
                      </p>
                   </form>
                      
                  <a href="forgotpass" style="color:red;font-size:13px;">forgot password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                  <a href="login" style="color:green;font-size:13px;">Login</a>    


       		  </div>
        	</div>
        </div>
    </div>
    <!--CONTENT END-->  
    <!--FOOTER START-->
   <?php include("footer.php");?>
    <!--FOOTER END-->
</div> 
</body>
</html>
