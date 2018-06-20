<?php
require("../site-settings.php");
if(isset($_GET['id']) && !empty($_GET['id']))
{
$id=mysql_real_escape_string(trim(strip_tags(htmlspecialchars($_GET['id']))));
$query=mysql_query("SELECT * FROM users WHERE tzid='$id'");
if(mysql_num_rows($query)>=1)
{ 
$det=mysql_fetch_array($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="author" content="Prathap Puppala,N130950" />
<meta name="description" content="TECKZITE2K16 is an authentic annual technical fest organised by RGUKT, which whets the student's appetite with the taste of innovation." />
<meta name="keywords" content="RGUKT NUZVID,TECKZITE,TZ16,TZ,FEST,TECK,IIIT NUZVID,IIIT NUZVID FEST,SDCAC,AP FESTS" />
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />    
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jscourselite.css" type="text/css" media="screen" />
<link rel="icon" href="../img/favicon.png">
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="js/script_jcarousellite.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
</head>

<body >
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
        			<h1>Thank you for Registering</h1> 
                  	<p><strong>Teckzite ID:</strong> <mark><b><big><big><?php echo $id;?></big></big></b></mark></p>
                    <p><strong>Name:</strong> <b style='color:green;'><?php echo $det['stuname'];?></b></p>
                    <p><strong>Fee:</strong> <b style='color:green;'><?php echo $det['fees'];?></b></p>
              <center><a href="login" style="font-size:16px;font-weight:bold;color:blue;text-decoration:underline;">Click here to Login</a></center>
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
<?php }else{header("location:register");} }else{header("location:register");} ?>
