<?php
session_start();
require_once("../site-settings.php");

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
$stuid=$_SESSION['stuid'];
$query=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");

$det=mysql_fetch_array($query);
}
if(!isset($_SESSION['visited'])){mysql_query("UPDATE visits SET visits950=visits950+1");$_SESSION['visited']="yes";}
$vis=mysql_fetch_array(mysql_query("SELECT * FROM visits"));


/*
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
	header('Location: ../download');
	exit();
}
*/

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
<title><?php echo $title;?> | Home</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />    
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jscourselite.css" type="text/css" media="screen" />
<link rel="icon" href="../img/favicon.png">
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="js/countdown.js"></script>
<script type="text/javascript" src="js/script_jcarousellite.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>


<script type="text/javascript">
var $j = jQuery.noConflict();
$j(function() {
    $j(".jcarousellite").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
		visible: 3,		
		speed: 200
    });
	
});
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
        	<li><a href="index" class="active">Home</a></li>
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
    <div style="background:#fff;">
	<marquee behavior="scroll" width="100%"  scrolldelay="200" style="border-bottom:1px solid black;">Welcome to Technostart16 Mobile View.&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;College ID Card is mandatory.&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;For better view,you can download android app.</marquee>
    </div>
    <!--CONTENT START-->
    <div id="content">
    	<div class="contentbg">
        	<div class="contenttop">
        		<div class="contentbottom">
					<h1><small>Welcome</small> <?php echo $det['stuname'];?></h1>
					<center style="padding-bottom:5px;">
					<?php
					
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
  echo "<a href='download'><img src='images/download.png' width='45%' style='padding-left:5%;'></a><br>";
}
	if(!isloggedin())
	{
	$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Registrations'"));
   $isregopen=$isreg['value'];
   $islog=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Logins'"));
   $islogopen=$isreg['value'];
    if($isregopen=="on"){
	   echo "<a href='register'><img src='images/regbtn.png' width='45%'></a>";
   }
   if($islogopen=="on"){
	   echo "<a href='login'><img src='images/login-button.png' width='45%' style='padding-left:5%;'></a>";
	    }}
	    else{
	   echo "<a href='profile'><img src='images/myprofile.jpg' width='45%'></a>";
	   echo "<a href='logout'><img src='images/logout.jpg' width='45%'></a>";
	   }?>
	   </center><br>
	   <?php
function timeDiff($firstTime,$lastTime)
{

// convert to unix timestamps
$firstTime=strtotime($firstTime);
$lastTime=strtotime($lastTime);

// perform subtraction to get the difference (in seconds) between times
$timeDiff=$lastTime-$firstTime;

// return the difference
return $timeDiff;
}
$date = date('Y-m-d H:i:s', time());
$remain=timeDiff($date,$endat);
$qq=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Event Registrations'"));
if($remain>0){?>
        			<center><h1>FEST STARTS IN</h1>
        			<script type="application/javascript">
var myCountdown4 = new Countdown({
								 	time: <?php echo $remain;?>, // 86400 seconds = 1 day
									rangeHi:"month",
									width:230, 
									height:40, 
									padding : 1.0, // Sets the text size to a percentage of the overall height. (I probably should have nemed this better.)
									numbers		: 	{
													font 	: "Arial",
													color	: "#FFFFFF",
													bkgd	: "#365D8B",
													fontSize : 200,
													rounded	: 0.15,				// percentage of size 
													shadow	: {
																x : 0,			// x offset (in pixels)
																y : 3,			// y offset (in pixels)
																s : 4,			// spread
																c : "#000000",	// color
																a : 0.4			// alpha	// <- no comma on last item!
																}
													},
									
									labels : {
												textScale : 0.8,
												offset : 5
											} // <- no comma on last item!
									
									});

</script>
<?php 
} ?><br>
        			</center>
                    <p style="text-align:justify;font-family:arial;"><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:20px;text-align:left;">TECHNOSTART</font>
            is a mega event for the Computer Science discipline and provides an elagant platform for the enthusiastic participants.It is amalgamation of both the technical and non-technical events which invokes creativity and fun.Technostart promises you a blissful journey.</p>
					<center><h1 style="margin-bottom:5px;">HIGHLITES</h1></center>
                    <div class="gallerybg">
                    	<div class="galleryleft">
                    		<div class="galleryright">                    		
                                <div id="jcarousellite_holder_wrapper">
                                    <div id="jcarousellite_holder">
                                        <div class="jcarousellite">
                                            <ul id="sliderlite">
												<?php
												$spon=scandir("../sponsersslider/images");
												for($i=2;$i<count($spon);$i++)
												{
                                                echo "<li><img src='../sponsersslider/images/".$spon[$i]."'  width='78px' height='80px'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>";
											    }?>
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="#" class="prev"></a> <a href="#" class="next"></a> 
                                 </div>  
                    		</div>
                    	</div>
                    </div>
        		</div>
        	</div>
        </div>
    </div>
    <!--CONTENT END-->  
    <!--FOOTER START-->
   <?php include("footer.php");?>
    <!--FOOTER END-->
</div>
<script>
$("#CountDownTimer").TimeCircles({ time: { Days: { show: true }, Hours: { show: true } }});
</script>
</body>
</html>
