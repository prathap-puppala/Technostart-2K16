<!--Script by Prathap Puppala,N130950-->
<?php
session_start();
require_once("site-settings.php");

//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){header("location:error.php");}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
if(!isset($_SESSION['visited'])){mysql_query("UPDATE visits SET visits950=visits950+1");$_SESSION['visited']="yes";}
$vis=mysql_fetch_array(mysql_query("SELECT * FROM visits"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<head>
	<meta charset="utf-8"> 
	<title><?php echo $title;?></title>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="devloper" content="Prathap Puppala,N130950">
	<link href="css/styles.css" rel="stylesheet" type="text/css" data-skrollr-stylesheet/>
	<link href="css/stars.css" rel="stylesheet" type="text/css"/>
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/html5shiv.js"></script>
	<script src="js/prathap.js"></script>
	<script src="js/ulak.js"></script>
	   <script type="text/javascript" src="js/TimeCircles.js"></script>
	    <link rel="stylesheet" href="css/TimeCircles.css" />
       <link href="css/jquery.incremental-counter.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/prathap.css" />
       <script src="js/jquery.incremental-counter.js"></script>
        <link rel="stylesheet" href="css/ulak.css" />
        <link rel="stylesheet" href="css/font-awesome.css" />
           <link href="css/vscroller.css" rel="stylesheet" type="text/css" />
    <script src="js/vscroller.js" type="text/javascript"></script>
    
		<script>
		  var mobilecheck = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))mobilecheck = true})(navigator.userAgent||navigator.vendor||window.opera);

    if(mobilecheck){
      window.location = "mobview/index";
    }
		</script>
 <script src="dist/js/Lobibox.min.js"></script>
  <link rel="stylesheet" href="demo/demo.css"/>
  <link rel="stylesheet" href="dist/css/Lobibox.min.css"/>
	<style>
	body
{
	background-color: #00B3E7;
	font-family: 'jaapokki';
	color: white;
	margin: 0;
	padding: 0;
	cursor: context-menu;
	overflow-x: hidden;
}
</style>
<script type="text/javascript">
        $(document).ready(function () {
            $('#vscroller').vscroller({ newsfeed: 'newsxml.php' });
        });
    </script>
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
</head>

<body class="no-scroll">

	<!-- LOADING -->
	<div class="loading">
		<div class="intro-stars loading center-hv"></div>
		<div class="ufo center-hv light"></div>
		<div class="ufo center-hv">
			<div class="loading-small-cloud"></div>
			<div class="loading-small-cloud reverse"></div>
			<div class="small-ghost"></div>
		</div>
		<div class="loading-text center-hv">Loading...</div>
	</div>

	<div class="pre-container">
		<div class="main-background-color"></div>
		
		<!-- INTRO STARS -->
		<div class="intro-stars moon"></div>

		<!-- MOON GLOW -->
		<div class="intro glow">
			<div class="main-moon center-hv" id="moon-intro-glow">	</div>
		</div>

		<!-- MOON -->
		<div class="intro moon">
			<div class="main-moon center-hv" id="moon-intro"></div>
		</div>
		<div class="intro">
			<div class="intro-clouds" id="intro-cloud1"><span style="position:relative;top:50px;left:50px;color:black;font-family:Black Betty;"><h2>APRIL 1,2,3,4</h2></span></div>
			<div class="intro-clouds" id="intro-cloud2"><span style="position:relative;top:50px;left:80px;color:black;"><h3 style="font-family:Black Betty;">TOTAL EVENTS<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;font-family:algerian;">24</span></h3></span></div>
		</div>
		
	</div>



	<div class="container transition-opacity-one" >

		<div class="hand-scroll-container">
			<div class="hand-scroll center-h"
				data-0="opacity: 0;"
				data-500="opacity: 1;"
				data-smooth-scrolling="off">
				<div class="hand-scroll-subtitle transition-opacity-one"></div>
			</div>
		</div>

		<!-- INTRO STARS -->
		<div class="intro-stars other"></div>
		<div class="intro-stars first"></div>
		<div class="intro-stars second"></div>
		
		<!-- BUILDINGS -->
		<div class="first-layer buildings-back">
			<div class="buildings back"></div>
		</div>
		<div class="first-layer buildings-back-night">
			<div class="buildings back night"></div>
		</div>

		<div class="first-layer buildings-day">
			<div class="buildings"></div>
		</div>
		<div class="first-layer buildings-night">
			<div class="buildings night"></div>
		</div>

    <div style="float:left;margin-top:-1%;"><table><tr><td><img src="img/rgukt.png" width="50px" style="margin-left:10px;"></td><td style="font-size:14px;font-family:Times New Roman;letter-spacing:1px;">Rajiv Gandhi University of Knowledge Technologies, Nuzvid</td></tr></table></div>
    <div style="float:right;margin-top:0%;"><table><tr><td><img src="img/cse2.png" width="50px"></td><td style="font-family:Times New Roman;letter-spacing:1px;";>Computer Science & Engineering</td></tr></table></div>
		
    <div style="position:absolute;top:30%;left:1%;opacity:1;" class="ppas">
		<a href="http://www.facebook.com" target="_blank"><img src="img/facebook.png"></a>
		<a href="http://www.twitter.com" target="_blank"><img src="img/twitter.png"></a>
		<a href="http://www.plus.google.com" target="_blank"><img src="img/googleplus.png"></a>
		<br>
		<center><a href="download" target="_blank"><img src="img/gp.png" width="70px"></a></center>
		<!---->
		</div>
		
	<div style="position:absolute;bottom:35.5%;right:14.5%;">
	<iframe src="sponsersslider/index.html" frameborder="0" class="ppas" scrolling="no" width="195px"></iframe>	
</div>
		
    <div  style="position:absolute;bottom:-4%;left:31%;"><img src="img/man.gif" style="float:left;"><div class="incremental-counter" style="float:right;margin-top:30px;" id="viscou" data-value="<?php echo $vis['visits950'];?>"></div></div>
    
   <div style="position:absolute;bottom:-1%;right:7%;padding:1px;" class="logreg" >

	   <?php
	if(!isloggedin())
	{
	$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Registrations'"));
   $isregopen=$isreg['value'];
   $islog=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Logins'"));
   $islogopen=$isreg['value'];?>
	   <?php if($islogopen=="on"){?>
	 <img src="img/login.png" style="cursor:pointer;" onclick="shwfrm('login')">
	<?php } if($isregopen=="on"){?>
	<img src="img/register.png" style="cursor:pointer;" onclick="shwfrm('register');"><?php } ?>
 <?php }else{ ?> 
 
	<img src="img/usermenu.png" style="cursor:pointer;"  onclick="shwfrm('usermenu');">
			
	 <img src="img/logout.png" style="cursor:pointer;" onclick="window.location='logout';">
 <?php } ?>	
	<a href="instructions" target="_blank"><img src="img/instructions.png" style="cursor:pointer;"></a>  </div>
		<!-- TITLE -->
		<div class="sub-intro-text center-hv">
    		<div class="text-block one">
    			<!--
    			<div class="lines-container">
    				<div class="lines-d">Rajiv Gandhi University of Knowledge Technologies</div>
					<div class="lines-d">Nuzvid</div>
    			</div>
    			-->
			</div>
    		<div class="text-block two center-v">
    			<div class="lines-container">
    		<div class="lines-a" style="font-size:28px;line-height:35px;text-shadow: 2px 2px 0px #1c4b0a;font-weight:bold;color:#00B3E7;">TECHNOSTART<br>16</div>
					<!--<span style="letter-spacing:2px;font-family:Times New Roman;color:blue;">In Association with <span style="font-size:26px;">SBH</span></span>-->
    		</div>
    		</div>
    		<!--
			<div class="text-block three">
    			<div class="lines-d bottom">
    			SDCAC
    			</div>
    		</div>
    		-->
    		<div style="position:absolute;top:70px;left:30px;">
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
if($remain>0){
?>
				
		   <div id="CountDownTimer" data-timer="<?php echo $remain;?>" style="letter-spacing:0px;width: 400px; height: 130px;"></div>
			<?php } ?></div>
				<!-- <img src="img/welcome.gif" style="position:absolute;top:10%;right:13%;">	-->		
		<ul class="starbursts" style="position:absolute;top:6%;right:2%;">

	<?php if($qq['value']=='off'){?>
	<li>
		<a href="#" class="starburst1" style="letter-spacing:0px;"><span><br>Sorry!<br />Registrations<br>are closed!</span></a>
	</li>
	<?php } else { ?>
	<li>
		<a href="#" class="starburst2" style="letter-spacing:0px;"><span><span><span><br>HURRY UP!<br />Registrations<br>are opened</span></span></span></a>
	</li><?php } ?>
</ul>

<div style="position:absolute;left:20px;bottom:40px;box-shadow:none;font-family:arial;" class="news-wrapper" id="vscroller">
    </div>
    
    
		</div>
  	
		
<div id="prathap_pop_up_background"></div>



<div id="prathap_notice_box">
</div>

		<div class="intro">

			<!-- Interactive Resume by Bia Costa -->
			<div class="intro-clouds-text-container right">
				<div class="ic-desc">Technology is anything that wasn’t around when you were born.</div>
			</div>
			<div class="intro-small-clouds first" id="intro-small-cloud-1"></div>


			<!-- Starring Bia Costa as Ghost Boo -->
			<div class="intro-clouds-text-container left">
				<div class="ic-desc">The great myth of our times is that technology is communication.</div>
			</div>
			<div class="intro-small-clouds second" id="intro-small-cloud-2"></div>


			<!-- Mom's quote -->
			<div class="intro-clouds-text-container center">
				<div class="ic-desc">The art challenges the technology, and the technology inspires the art.</div>
			</div>
			<div class="intro-small-clouds third" id="intro-small-cloud-2"></div>
			<div class="intro-small-clouds fourth" id="intro-small-cloud-1"></div>
		</div>


		<div class="ground-container">
			<div class="grass"></div>
			<div class="ground-top transition-one"></div>
			<div class="ground-bottom transition-one"></div>
		</div>

		<div class="second-layer">
			<div class="main-clouds-container">
				<div class="main-clouds cloud-5 back bottom"></div>
				<div class="main-clouds cloud-6 back top"></div>
				<div class="main-clouds cloud-7 back middle"></div>
				<div class="main-clouds cloud-8 back top"></div>
				<div class="main-clouds cloud-9 back bottom"></div>
				<div class="main-clouds cloud-10 back middle"></div>
				<div class="main-clouds cloud-11 back top"></div>
				<div class="main-clouds cloud-12 back bottom"></div>
				<div class="main-clouds cloud-13 back middle"></div>
				<div class="main-clouds cloud-14 back top"></div>
			</div>
		</div>
		

		<div class="ufo-light-big center-h">
		</div>
		
		<div class="ufo-big center-h"></div>


		<!-- main moving layer -->
		<div class="main-layer">

			<div class="highlightes-experience" id="highlightes">

				<div class="sign-container">
					<div class="sign yellow">
						<div class="sign-text">HIGHLITES</div>
					</div>
				</div>
				
				<div class="museum-interior-container transition-six">
					<div id="museum-1-interior">
						<div class="plate-container" id="platesec">
							<div class="plate transition-three">
								<div class="line">TECHNICAL QUIZ</div>
							</div>
							<div class="plate-hover transition-three">
								<div class="line">TECHNICAL QUIZ</div>
							</div>
						</div>
						<div class="plate-container" id="platebachelor">
							<div class="plate transition-three">
								<div class="line">TREASURE HUNT</div>
							</div>
							<div class="plate-hover transition-three">
								<div class="line">TREASURE HUNT</div>
							</div>
						</div>
						<div class="plate-container" id="platemaster">
							<div class="plate transition-three">
								<div class="line">TOP CODER</div>
							</div>
							<div class="plate-hover transition-three">TOP CODER</div>
						</div>
						<div class="museum-guarder one"></div>
						<div class="museum-guarder two"></div>
						<div class="museum-guarder four"></div>
					</div>
					<div id="museum-3-interior">
						<div class="plate-container" id="plateer">
							<div class="plate transition-three">
								<div class="line">COUNTER STRIKE</div>
								
							</div>
							<div class="plate-hover transition-three">
								<div class="line">COUNTER STRIKE</div>
							</div>
						</div>
						<div class="plate-container" id="plateid">
							<div class="plate transition-three">
								<div class="line">MOTO GP</div>
							</div>
							<div class="plate-hover transition-three">
								<div class="line">MOTO GP</div>
							</div>
						</div>
						<div class="plate-container" id="plateshift">
							<div class="plate transition-three">
								<div class="line">HACKATHON</div>
							</div>
							<div class="plate-hover transition-three">
								<div class="line">HACKATHON</div>
							</div>
						</div>
						<div class="plate-container" id="plateqm">
							<div class="plate transition-three">
								<div class="line">SHERLOCK HOLMES</div>
							</div>
							<div class="plate-hover transition-three">
								<div class="line">SHERLOCK HOLMES</div>
							</div>
						</div>
						<div class="museum-guarder three"></div>
						<div class="museum-guarder five"></div>
						<div class="museum-guarder six"></div>
					</div>
				</div>

			</div>


			<div class="events" id="events">
				
				<div class="sign-container">
					<div class="sign yellow supermarket">
						<div class="sign-text">EVENTS</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">HIGHLITES</div>
						</div>
					</div>
					<div class="sign blue">
						<div class="sign-text">UPDATES</div>
					</div>
					<div class="sign blue">
						<div class="sign-text">ABOUT</div>
					</div>
				</div>

				<!-- SUPERMARKET INTERIOR -->
				<div class="supermarket-interior-container transition-six">
					<div class="supermarket-wall-interior"></div>
				
				<?php 
				$brn=mysql_query("SELECT * FROM branch_categories");
				$eveco=0;
				while($branch=mysql_fetch_array($brn)){
				$eveco++;
				?>	
				
				
					<div class="events-container <?php echo $branch['branch'];?>">
						<div class="events-bottom center-h"></div>
						<div class="events-bg center-h">
							<div class="events-middle-bg-container">
								<div class="events-middle-bg green"></div>
								<div class="events-middle-bg yellow"></div>
								<div class="events-middle-bg orange"></div>
								<div class="events-middle-bg red"></div>
							</div>
							<div class="events-middle-bars-container">
								<div class="events-middle-bar"></div>
								<div class="events-middle-bar"></div>
								<div class="events-middle-bar"></div>
								<div class="events-middle-bar"></div>
							</div>
							<?php
									$bran=$branch['branch'];
									$eve=mysql_query("SELECT * FROM events WHERE visibility='1' && branch='$bran'");
									$s=0;
									while($events=mysql_fetch_array($eve))
									{
									$s++;
									$img=$events['imagename'];?>
							<div class="events-columns <?php echo $branch['branch'];?>">
								<div class="events-column <?php echo $branch['branch'];?>">
									<div class="skills-subtitle"><?php if($s<5){echo "<br>";}?></div>
									<div class="supermarket-cereal-boxes" onclick=shwfrm("eventview.php?eid=<?php echo $events['eid'];?>") style="cursor:pointer;background-image: url('event_images/<?php echo $bran;?>/<?php echo $img;?>'); background-size: 100px 65px;background-repeat: no-repeat;<?php if($s>8 && $eveco<1){echo 'margin-top:2px;';} if($s>2 && $eveco>1){echo 'margin-top:-2px;';}?>"></div>
									<div class="supermarket-price-tag green" onclick=shwfrm("eventview.php?eid=<?php echo $events['eid'];?>") style="cursor:pointer;font-size:13px;padding:3px;letter-spacing:1px;width:170px;"><?php echo $events['eventname'];?></div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="events-title center-h <?php echo $branch['branch'];?>"><?php echo $branch['displayname'];?> events</div>
					</div>
				     <?php } ?>
                </div></div>

			<div class="updates" id="updates">
				
				<div class="sign-container">
					<div class="sign yellow">
						<div class="sign-text">UPDATES</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink supermarket">
							<div class="sign-text left">EVENTS</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink supermarket">
							<div class="sign-text left">HIGHLIGHTES</div>
						</div>
					</div>
					<div class="sign blue">
						<div class="sign-text">ABOUT</div>
					</div>
				</div>

				<div class="party-container">
					<div class="party-bg">
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
					</div>

					<div class="party-banner">
						UPDATES
					</div>

					<div class="big-speakers-container transition-five">
						<div class="big-speaker" id="big-speaker-1"></div>
						<div class="big-speaker" id="big-speaker-2"></div>
					</div>

					<div class="small-speakers-container transition-five">
						<div class="small-speaker" id="small-speaker-1"></div>
						<div class="small-speaker" id="small-speaker-2"></div>
					</div>

					<div class="notes-container left">
						
              <div style="position:absolute;z-index:999999;top:-400px;height:400px;left:20px;width:860px;overflow-x:hidden;">
              <table id="customers" style="width:100%;">
							<tr>
								<th  style="text-align:center;" width="60%">subject</th>
								<th  style="text-align:center;" width="14%">To</th>
								<th  style="text-align:center;" width="14%">Time</th>
							</tr>

	<?php

	// Your SQL query go here. This query will display all record by setting the Limit.

	$sql = "SELECT * FROM notifications where visibility='1' ORDER BY nid DESC";
	$query = mysql_query($sql);
$sno=0;
while ($rec = mysql_fetch_array($query)) {
		            $sno++;
			        $new="";
			        $color="";
			        $a=array("1","2","3","4","5");
                    $random_keys=array_rand($a,3);
                    if($sno%2==0){$color="";}
                    else{$color="#FFF8DC";}
                    $nto="ALL";
                    if($rec['eid']!="ALL"){
						$eer=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$rec['eid']."'"));
						$nto="".$eer['branch']." - ".$eer['eventname']."";
                    }
if($rec['added_date']==date("m-d-Y")){$new="<img src='img/".$a[$random_keys[0]].".gif'>";}?>
								
  							<tr onclick=shwfrm("<?php echo "nview.php?nid=".$rec['nid']."";?>") style="cursor:pointer;background:#eee;color:black;font-family:andlso;font-weight:bold;background:<?php echo $color;?>">
								<td  width="60%" style="text-align:justify;">
									<?php echo $rec['title']." ".$new; 
									
									?>
									</td>
								<td  width="14%" style="text-align:center;">
									<?php echo $nto;?>
								</td>
								<td  width="14%" style="text-align:center;">
									<?php echo $rec['time'];?>
								</td>
								
							</tr>
	<?php }	?>
	
						</table>
              </div>
						<div class="note left first"></div>
						<div class="note left second"></div>
						<div class="note left third"></div>
					</div>

					<div class="notes-container right">
						<div class="note right first"></div>
						<div class="note right second"></div>
						<div class="note right third"></div>
					</div>
					
					<div class="guitar-amp transition-one">
						<div class="guitar-on-btn transition-six"></div>
					</div>
					<div class="party-bottom"></div>
					<div class="hidden-party-collision"></div>

				</div>

			</div>

			<!-- ABOUT -->
			<div class="about" id="about">
				
				<div class="sign-container">
					<div class="sign yellow">
						<div class="sign-text">ABOUT</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">EVENTS</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">UPDATES</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">HIGHLIGHTES</div>
						</div>
					</div>
					<div class="sign blue">
						<div class="sign-text">CONTACT</div>
					</div>
				</div>

				<div class="party-container">

					<div class="party-bg">
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
					</div>

					<div class="party-banner">
						ABOUT
					</div>

					<div class="big-speakers-container transition-five">
						<div class="big-speaker" id="big-speaker-1"></div>
						<div class="big-speaker" id="big-speaker-2"></div>
					</div>

					<div class="small-speakers-container transition-five">
						<div class="small-speaker" id="small-speaker-1"></div>
						<div class="small-speaker" id="small-speaker-2"></div>
					</div>

					<div class="notes-container left">
						
              <div style="position:absolute;z-index:999999;top:-400px;height:400px;left:20px;width:860px;overflow-x:hidden;">
              <table id="customers" style="width:100%;letter-spacing:1px;">
				  <tr class="alt"><td><center><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:20px;text-align:left;">TECHNOSTART'16</font></center></td></tr>
				  <tr style="background:#eee;color:black;letter-spacing:2px;line-height:30px;text-align:justify;"><td><p><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:20px;text-align:left;">TECHNOSTART'16</font>
					Technostart is a mega event for the Computer Science discipline and provides an elagant platform for the enthusiastic participants.It is amalgamation of both the technical and non-technical events which invokes creativity and fun.Technostart promises you a blissful journey.
                     </p></td></tr>
				 
				  </table></div>
						<div class="note left first"></div>
						<div class="note left second"></div>
						<div class="note left third"></div>
					</div>

					<div class="notes-container right">
						<div class="note right first"></div>
						<div class="note right second"></div>
						<div class="note right third"></div>
					</div>
					
					<div class="guitar-amp transition-one">
						<div class="guitar-on-btn transition-six"></div>
					</div>
					<div class="party-bottom"></div>
					<div class="hidden-party-collision"></div>

				</div>

			</div>

			<div class="contact" id="contact">

				<div class="sign-container">
					<div class="sign yellow">
						<div class="sign-text">CONTACT</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">EVENTS</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">UPDATES</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">HIGHLIGHTES</div>
						</div>
					</div>
				</div>

				<div class="sign-container after-house">
					<div class="sign yellow">
						<div class="sign-text">SCHEDULE</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">EVENTS</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">UPDATES</div>
						</div>
					</div>
					<div class="sign-left-container">
						<div class="sign pink">
							<div class="sign-text left">ABOUT</div>
						</div>
					</div>
				</div>
				
				<div class="house">
					<div class="house-front"></div>
					<div class="house-hidden-door"></div>
					<div class="house-fence" id="house-fence-left"></div>
					<div class="house-fence" id="house-fence-right"></div>
					<div class="house-roof"></div>
				</div>
				

				<div class="postcard-container">
					<div class="postcard-bg">
						<div class="postcard-left-container">
							<div class="postcard-sub-container message">
								<div class="postcard-date"><?php echo date("M")." ".date("d").",".date("Y");?></div>
								<div class="postcard-message">
									<textarea class="transition-six" id="postcard-message" placeholder="MESSAGE" required></textarea>
								</div>
								<div class="postcard-final">
									<div class="postcard-bye">Best regards,</div>
									<textarea class="transition-six" id="postcard-final"  placeholder="University ID" required><?php if(isloggedin()){echo $_SESSION['stuid'];}else{echo "GUEST";}?></textarea>
								</div>
							</div>
							<div class="postcard-sub-container after-message transition-three">
								<div class="postcard-sent-message">THANK YOU <?php if(isloggedin()){echo $_SESSION['stuid'];}?>,<br>YOUR MESSAGE HAS BEEN SENT!</div>
							</div>
						</div>
						<div class="postcard-middle-line"></div>
						<div class="postcard-right-container">
							<div class="postcard-sub-container">
								<div class="postcard-stamps-container">
									<a href="mailto:admin@teckzite.in" class="postcard-stamp transition-three" id="email-stamp" target="_blank"></a>
								</div>
								<div class="postcard-address-container">
									<ul>
										<li>Hello! I'm Admin and I want to</li>
										<li>help you in Technical Problems.</li>
										<li> so feel free to</li>
										<li>send me an email or a message.</li>
									</ul>
								</div>
								<center><span id="loader" style="display:none;"><img src="img/loading8.gif"></span></center><div class="postcard-submit">Send</div>
							</div>
						</div>
					</div>
				</div>
						<div class="mailbox">
					<div class="mailbox-arrow transition-six"></div>
					<div class="mailbox-arrow-base"></div>
					<div class="mailbox-lid transition-six"></div>

					<div class="mailbox-title">A3 Block</div>
					<div class="mailbox-subtitle">RGUKT NUZVID</div>
				</div>
			</div>

		</div>


		<div class="credits" id="credits">

					<div class="party-bg">
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
						<div class="party-light transition-three"></div>
					</div>

					<div class="party-banner">
						SCHEDULE
					</div>

					<div class="big-speakers-container transition-five">
						<div class="big-speaker" id="big-speaker-1"></div>
						<div class="big-speaker" id="big-speaker-2"></div>
					</div>

					<div class="small-speakers-container transition-five">
						<div class="small-speaker" id="small-speaker-1"></div>
						<div class="small-speaker" id="small-speaker-2"></div>
					</div>

					<div class="notes-container left">
						
              <div style="position:absolute;z-index:999999;top:-400px;height:400px;left:20px;width:860px;overflow-x:hidden;">
              <table id="customers" style="width:100%;letter-spacing:1px;">
				  <tr class="alt"><td><center><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:20px;text-align:left;">Schedule</font></center></td></tr>
				  <tr style="background:#eee;color:black;letter-spacing:2px;line-height:30px;text-align:justify;"><td>
				  </td></tr>
				  </table></div>
						<div class="note left first"></div>
						<div class="note left second"></div>
						<div class="note left third"></div>
					</div>

					<div class="notes-container right">
						<div class="note right first"></div>
						<div class="note right second"></div>
						<div class="note right third"></div>
					</div>
					
					<div class="guitar-amp transition-one">
						<div class="guitar-on-btn transition-six"></div>
					</div>
					<div class="party-bottom"></div>
					<div class="hidden-party-collision"></div>

				</div>

    	</div>

		<div class="ghost"
			data-0="opacity: 0;"
			data-12500=""
			data-13500="opacity: 1;"
			data-69000=""
			data-70000="opacity: 1"
			data-70500="opacity: 0.5"
			data-72000="bottom: 300px; opacity: 0;"
			data-smooth-scrolling="off"
			>
			<div class="flashlight"></div>
			<div class="guitar transition-six"></div>
		</div>
		
		<div class="shopping-cart-container transition-opacity-one">
			<div class="products-container transition-opacity-one">
				<div class="product cereal-red"></div>
				<div class="product icecream-yellow"></div>
				<div class="product juice-orange"></div>
				<div class="product cookie-box"></div>
			</div>
			<div class="shopping-cart"></div>
		</div>
		<br>
		<br>
		<div class="navigation-links">
			<ul>
				<li>
					<a class="nav-tip" href="#intro" data-menu-top="0">
						<span class="nav-dot" id="d-home"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">Home</div>
						</div>
					</a>
				</li>
				<li>
					<a class="nav-tip" href="#highlightes" data-menu-top="17300">
						<span class="nav-dot" id="d-highlightes"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">highlightes</div>
						</div>
					</a>
				</li>
				<li>
					<a class="nav-tip" href="#events" data-menu-top="27000">
						<span class="nav-dot" id="d-events"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">Events</div>
						</div>
					</a>
				</li>
				<li>
					<a class="nav-tip" href="#updates" data-menu-top="43600">
						<span class="nav-dot" id="d-updates"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">updates</div>
						</div>
					</a>
				</li>
				<li>
					<a class="nav-tip" href="#about" data-menu-top="58300">
						<span class="nav-dot" id="d-about"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">About</div>
						</div>
					</a>
				</li>
				<li>
					<a class="nav-tip" href="#contact" data-menu-top="63100">
						<span class="nav-dot" id="d-contact"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">Contact</div>
						</div>
					</a>
				</li>
				<!--<li>
					<a class="nav-tip" style="cursor:pointer;" href="team" target="_blank" data-menu-top="68900">
						<span class="nav-dot" id="d-events"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">Team</div>
						</div>
					</a>
				</li>-->
				<li>
					<a class="nav-tip" href="#credits" data-menu-top="68900">
						<span class="nav-dot" id="d-credits"></span>
						<div class="nav-img transition-three"></div>
						<div class="nav-text transition-three">
							<div class="transition-three">Schedule</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	
	<script src="js/skrollr.stylesheets.min.js"></script>
	<script src="js/skrollr.min.js"></script>
	<script src="js/skrollr.menu.min.js"></script>
		<script src='js/snowfall.jquery.js'></script>
		<script src="js/script.js"></script>
	<script type='text/javascript'> 
	$(document).ready(function(){
   //snowfall
   $(document).snowfall({deviceorientation : true, round : true, minSize: 1, maxSize:8,  flakeCount : 45});
   //countdown
   $("#CountDownTimer").TimeCircles({ time: { Days: { show: true }, Hours: { show: true } }});
   //visit counter
   $(".incremental-counter").incrementalCounter();
   });
   </script>
	<script src="js/main.js"></script>
   	
</body>
</html>

