<?php
session_start();
require_once("../site-settings.php");
$err=array();
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

$stuid=trim($_SESSION['stuid']);
$isloggedin=true;

if(!isset($_SESSION['visited'])){mysql_query("UPDATE visits SET visits950=visits950+1");$_SESSION['visited']="yes";}
$vis=mysql_fetch_array(mysql_query("SELECT * FROM visits"));

/*
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
	header('Location: ../download');
	exit();
}
*/
$eid=0;
$isvalid=0;
if(isset($_GET['eid'])){	
$eid=trim(strip_tags(htmlspecialchars(htmlentities(mysql_real_escape_string(addslashes($_GET['eid']))))));
$eid=str_replace(".php","",$eid);
$query=mysql_query("SELECT * FROM events WHERE eid='$eid' && visibility='1'");
if(mysql_num_rows($query)>=1){$isvalid=1;}
if($isvalid==1)
{
if(!isset($_SESSION['visitedeve'.$eid]))
{
mysql_query("UPDATE events SET views=views+1 WHERE eid='$eid'");	
$_SESSION['visitedeve'.$eid]="yes";
}

$query_fet=mysql_fetch_array($query);
$abstract=mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='$eid' && visibility='1'");
$isabstract=0;
if(mysql_num_rows($abstract)>0){$isabstract=1;}
$abstract_fet=mysql_fetch_array($abstract);
$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="author" content="Prathap Puppala" />
<meta name="description" content="TECKZITE2K16 is an authentic annual technical fest organised by RGUKT, which whets the student's appetite with the taste of innovation." />
<meta name="keywords" content="RGUKT NUZVID,TECKZITE,TZ16,TZ,FEST,TECK,IIIT NUZVID,IIIT NUZVID FEST,SDCAC,AP FESTS" />
<title><?php echo $title;?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />    
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jscourselite.css" type="text/css" media="screen" />
<link rel="icon" href="../img/favicon.png">
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="js/script_jcarousellite.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<link href="../tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../tablecloth/tablecloth.js"></script>
<style>
		#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#customers tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}	
.absbutton {
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
   background: -o-linear-gradient(top, #3e779d, #65a9d7);
   padding: 5px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   }
.absbutton:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.absbutton:active {
   border-top-color: #1b435e;
   background: #1b435e;
   }
</style>
<script type="text/javascript">
function shwfields(num,eid)
{
var str="<table id='customers' width='300px'>";
var f=0;
for(var i=1;i<=num;i++)
{
f++;
var clls=(f%2==0)?"alt":"";
str=str+"<tr class='"+clls+"'><td><span style='color:#000;font-weight:bold;font-family:Times New Roman'>University ID "+i+"</span> &nbsp;&nbsp; :</td><td> &nbsp;&nbsp;<input type='text' placeholder='ex : N130950' id='stuid"+i+"' style='background:#fff;'></td></tr>";	
}
str=str+"<tr><td colspan='2'><center><br><a class='absbutton' style='cursor:pointer;' onclick=doevereg("+num+","+eid+")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";		
document.getElementById("shwinp").innerHTML=str;

}

function shwf(va,eid)
{
if(isNaN(va)==true){

notify("This is Not a Number","error","2000","true");	
	}
else
{
shwfields(va,eid);	
}
}

function pick1(field){return document.getElementById(field).value;}
function notify(msg,error,time,type){alert(msg);}
function dofocus(field){$("#"+field).focus();}

function doevereg(part,eid)
{
var ids="",valid=0;
for(var i=1;i<=part;i++)
{
if(pick1("stuid"+i)=="" || pick1("stuid"+i)==undefined)
{
dofocus("stuid"+i);
notify("Please Enter University ID "+i+"","error","2000","true");
break;	
}
else
{
if(i==part){
	k=pick1("stuid"+i);
	k=k.toUpperCase();
	ids=ids+k;}
else{
	
	k=pick1("stuid"+i);
	k=k.toUpperCase();
	ids=ids+k+"~";}	
valid++;
}	
}
if(part==valid){

 $(document).ajaxError(function(e, xhr, opt){
     
      if((opt.url=="eventreg-db.php" && xhr.status!="200") || opt.url=="../uploadabstract.php" && xhr.status!="200")
        {
		$("#loader").hide();
		notify("There is no Connection to server.Please fix Connection problem.","error","3500","true");

		} 
    });
//confirmation
		if(confirm("Are you sure to Register?")) {
			
					
var datastring="eid="+eid+"&part="+part+"&ids="+ids;
$.ajax({
type:"POST",
url:"../eventreg-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("success")!=-1){notify("Registered Successfully....Please wait while changes takes place...","success","3500","true");location.reload();}else{notify(data,"error","2000","true");}}
});

					
				} else {
					return false;
				}
		
	
}	
}
		$("#chh").on("click",function(){$("#assd").slideToggle();});
		$(document).ready(function(){$("#chat").html("<br><br><br><center><img src='img/load.gif'><p style='color:black;'>Loading...</p></center>").load("chat.php?eid=<?php echo $eid;?>");});
var auto_refresh = setInterval(
function ()
	{
	$('#chat').load('chat.php?eid='+<?php echo $eid;?>);
	},10000);
	
function updno()
{
	$('#chat').load('chat.php?eid='+<?php echo $eid;?>);
}</script>

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
            <li><a href="events" class="active">Events</a></li>
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
        			<h1><?php $di=$query_fet['branch'];$realbr=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='$di'"));echo $realbr['displayname']." - ".$query_fet['eventname'];?></h1>
                      <table cellspacing="0" style="width:298px;word-wrap: break-word;word-break: break-all;" cellpadding="0">
	<tr style="cursor:pointer" class="evlink"><th>Home</th></tr>																			
	<tr  class="evmenu"><td><center>
	   <table id="customers">
				  <tr><td rowspan="6" width="78px"><img src="<?php echo "../event_images/".$query_fet['branch']."/".$query_fet['imagename'];?>" width="78px"></td><td style="background:#ddd;font-size:12px;" width="80px">Registered Teams</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php $regcou=mysql_num_rows(mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'")); echo $regcou;?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:12px;">Registrations</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php if($query_fet['areregistrationson']=="on"){echo "Open";}else{echo "Closed";}?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:12px;">Participants</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php if($query_fet['participants']==$query_fet['minparticipants']){echo $query_fet['participants'];}else{echo $query_fet['minparticipants']." - ".$query_fet['participants'];}?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:12px;">Views</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php echo $query_fet['views'];?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:12px;">Organizers</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php echo $query_fet['orgcount'];?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:12px;">Your status</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php if($isloggedin==true){$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));$ev=array();$ev=explode("~",$user_fet['eventids']);if(in_array($eid,$ev)){echo "<font color='green'>Registered</font>";}else{echo "<font color='blue'>Not Registered</font>";}}else{echo "<font color='red'>Please Login</font>";}?></font></td></tr>
				  </table></center>
				  </td></tr>
	<tr style="cursor:pointer" class="evlink"><th>About</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['description'];?></td></tr>																			
																
	<tr style="cursor:pointer" class="evlink"><th>Rules</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['instructions'];?></td></tr>
	
	<tr style="cursor:pointer" class="evlink"><th>Organizers</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['organizers'];?></td></tr>																			
															
	<tr style="cursor:pointer" class="evlink"><th>Schedule</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['schedule'];?></td></tr>																			
															
	<tr style="cursor:pointer" class="evlink"><th>Prizes</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['prizes'];?></td></tr>																			
																									
	<tr style="cursor:pointer" class="evlink"><th>Winners</th></tr>																			
	<tr  class="evmenu"><td><?php echo $query_fet['winners'];?></td></tr>																			
																					
	<tr style="cursor:pointer" class="evlink"><th>Register</th></tr>																			
	<tr  class="evmenu"><td>
	
                <?php if($isloggedin==true){
										$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
										if($user_fet['year']=="E4") //have 2 add 1==1 if payment is compulsary
										{
										$ev=array();$ev=explode("~",$user_fet['eventids']);
										if(in_array($eid,$ev)){?>
										<br><br>
										<center><span class='' style='color:green;'>Already Registered</span></center>
										
										<?php }
										else{
										$ison=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Event Registrations'"));
                                         if($ison['value']=="on")
                                         {
										 if($query_fet['areregistrationson']=="on")
                                         {
											$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
										if($query_fet['year']!="E1" &&  $query_fet['branch']=="PUC" && $user_fet['branch']!="PUC")
										{?>
										<br><br>
										<center><span class='' style='color:red;'>You are not allowed to Register to this event</span></center>
										<?php
									   }
										else if($query_fet['participants']==$query_fet['minparticipants'])
										{
										echo "<br><center><table id='customers' width='300px'>";
						$fg=0;				
for($i=1;$i<=$query_fet['participants'];$i++)
{
$fg++;
$cll=($fg%2==0)?"":"alt";
print "<tr class='".$cll."'><td><span style='color:#000;font-weight:bold;font-family:Times New Roman'>Univeristy ID ".$i."</span> &nbsp;&nbsp; : &nbsp;&nbsp;</td><td><input type='text' placeholder='ex : N130950' id='stuid".$i."' style='background:#fff;'></td></tr>";	
}
print "<tr><td colspan='2'><center><br><a class='absbutton' style='cursor:pointer;' onclick=doevereg(".$query_fet['participants'].",".$eid.")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";		


										echo "</center>";
										} 
										else
										{
									echo "<br><center><span style='color:#000;font-weight:bold;'>No.of Participants</span> &nbsp;&nbsp;: &nbsp;&nbsp;";
									echo "<span style='width:100px;'><select class='selecteve' style='padding:5px;' onchange='shwf(this.value,".$eid.")'>";
									echo "<option value=''>Select</option>";
									for($i=$query_fet['minparticipants'];$i<=$query_fet['participants'];$i++)
									{
									echo "<option value='".$i."'>".$i."</option>";	
									}
									echo "</select></span><br><br><span id='shwinp'></span></center>";										
										 }
									     }
										 else
										 {
										?><br><br>
										<center><span class='' style='color:red;'>Registration for This Event has been Closed</span></center>
										<?php	 
										 }
											 
										 }
										 else
										 {
										?><br><br>
										<center><span class=''  style='color:red;'>Registration for all Events are Closed</span></center>
										<?php	 
										 }
											}
											}
											else
											{
											?><br><br>
											<center><span class=''  style='color:red;'>E4 students are not allowed to register</span></center>
										
										<?php	
												}}
										else{
										?>
										<center><span class=''>Please <a onclick="login" style='cursor:pointer;color:red;'>Login</a> to Register to this event</span></center>
										<?php } ?>
	</td></tr>																			

 <?php
                 if($abstract_fet['uploadsopen']=="opened")
								 {?>
 								
                <tr><th>UPLOAD ABSTRACT</th></tr>
                <table><tr><td>
 <table id='customers' class="upll">
								<?php
								 if($isloggedin==true)
								 {
								 $user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'")); 	
								 $eiids=array();
								 $eiids=explode("~",$user_fet['eventids']);
								 if(in_array($eid,$eiids))
								 {	
								 $teamm=mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'");
								 $tid=0;
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
								 if($abstract_fet['uploadsopen']=="opened")
								 {?>
								<script type="text/javascript" src="../js/jquery-1.8.3.js"></script>
 								<script src="js/imageupload.js"></script>
 								<style>
 								
.absbutton {
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
   background: -o-linear-gradient(top, #3e779d, #65a9d7);
   padding: 5px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   }
.absbutton:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.absbutton:active {
   border-top-color: #1b435e;
   background: #1b435e;
   }
 								</style>
								 
								 <center>
										 <table id="customers" width="80%">
								 <tr class='hiid'><th colspan="2">
								 Abstract Uploading
								 </th></tr>
								 <tr  class='hiid' id="hiid">
								 <td>
								   <form role="form"  id="uploadImageForm"   action="javascript:void(0)" enctype= "multipart/form-data" onsubmit="uploadimage(this);">
                    <div class="form-group">
                        <label for="file">Select File</label>
                        <input type="file" name="uploadImage" class="form-control" id="uploadImage">
                        <input type="hidden" name="eid" value="<?php echo $eid;?>">
                    </div><br>
                    <button type="submit" class="absbutton" class='small_button_type_1'>Upload</button>
                </form>
								 </td>
								 </tr>
								 </center>
								 <?php
								 }
								 
								 else
								 {
								echo "<br><br><center><span  style='color:red;'>Abstract Uploading for this Event has been Closed</span></center>";	 
								 }	 
								
								 }
								 else
								 {
								echo "<br><br><center><span  style='color:red;'>Abstract Uploading for All Events has been Closed</span></center>";	 
								 }
							    
							    }
							else
							{
							echo "<br><br><center><span  style='color:green;'>Your team already submitted abstract</span></center>";	 
									
							}
							}
							  else
							    {
								echo "<br><br><center><span  style='color:red;'>You are not Registered to this Event.</span></center>";	 
								
								}
							 }
							 else
							 {
							echo "<br><br><center><span  style='color:red;'>Please Login</span></center>";	 
									 
							 }	 
									 
								?>
								</table>
							
 </td></tr><?php } ?>
		</table>

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
<?php
}else{header("location:events");}
}else{header("location:events");}?>
