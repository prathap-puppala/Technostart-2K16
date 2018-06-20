<?php
session_start();
require_once("site-settings.php");

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
<style>

#main {
  background-color: #fff;
  padding: 30px 0; }
  .note {
          position:relative;
          width:480px;
          padding:1em 1.5em;
          margin:2em auto;
          color:#fff;
          background:#97C02F;
          overflow:hidden;
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
 
      .note:before {
          content:"";
          position:absolute;
          top:0;
          right:0;
          border-width:0 16px 16px 0; /* This trick side-steps a webkit bug */
          border-style:solid;
          border-color:#fff #fff #658E15 #658E15; /* A bit more verbose to work with .rounded too */
          background:#658E15; /* For when also applying a border-radius */
          display:block; width:0; /* Only for Firefox 3.0 damage limitation */
          /* Optional: shadow */
          -webkit-box-shadow:0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
          -moz-box-shadow:0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
          box-shadow:0 1px 1px rgba(0,0,0,0.3), -1px 1px 1px rgba(0,0,0,0.2);
      }

      .note.red {background:#C93213;}
      .note.red:before {border-color:#fff #fff #97010A #97010A; background:#97010A;}

      .note.blue {background:#53A3B4;}
      .note.blue:before {border-color:#fff #fff transparent transparent; background:transparent;}

      .note.taupe {background:#999868;}
      .note.taupe:before {border-color:#fff #fff #BDBB8B #BDBB8B; background:#BDBB8B;}

    
      .note.rounded {
          -webkit-border-radius:5px 0 5px 5px;
          -moz-border-radius:5px 0 5px 5px;
          border-radius:5px 0 5px 5px;
      }

      .note.rounded:before {
          border-width:8px; /* Triggers a 1px 'step' along the diagonal in Safari 5 (and Chrome 10) */
          border-color:#fff #fff transparent transparent; /* Avoids the 1px 'step' in webkit. Background colour shows through */
          -webkit-border-bottom-left-radius:5px;
          -moz-border-radius:0 0 0 5px;
          border-radius:0 0 0 5px;
      }

      .note p {margin:0;}
      .note p + p {margin:1.5em 0 0;}



ul#tabs {
  list-style-type: none;
  margin: 0 0 30px 0;
  padding: 0;
  text-align: center; }
  ul#tabs li {
    display: inline-block;
    background-color: #32c896;
    border-bottom: solid 5px #238b68;
    padding: 5px 20px;
    margin-bottom: 4px;
    color: #fff;
    cursor: pointer; }
    ul#tabs li:hover {
      background-color: #238b68; }
    ul#tabs li.active {
      background-color: #238b68; }

ul#tab {
  list-style-type: none;
  margin: 0;
  padding: 0; }
  ul#tab li {
    display: none;
    padding: 30px;
    border: solid 20px #d2f4e9; }
    ul#tab li.active {
      display: block; }
    ul#tab li h2 {
      font-weight: 400;
      margin-bottom: 30px;
      padding-bottom: 5px;
      border-bottom: solid 5px #32c896; }
span.all-labs,
span.back-to-tutorial {
  display: block;
  width: 50%; }

span.all-labs {
  float: left;
  text-align: left; }

span.back-to-tutorial {
  float: right;
  text-align: right; }

#title {
  text-align: center; }

#title h1 {
  color: #fff;
  font-size: 30px;
  margin-bottom: 10px; }

#title h2 {
  color: #95e5ca;
  font-size: 20px; }

.clearfix:after {
  visibility: hidden;
  display: block;
  content: "";
  clear: both;
  height: 0; }

@media all and (max-width: 600px) {

  #top-bar a {
    display: block; }

  span.all-labs,
  span.back-to-tutorial {
    width: 100%; }

  span.all-labs,
  span.back-to-tutorial {
    float: none;
    text-align: center; }

  span.all-labs {
    border-bottom: solid 1px #238b68; }

  #title h1 {
    font-size: 20px; }

  #title h2 {
    font-size: 16px; } 
}
.info{width:280px;font-family:Verdana, Geneva, sans-serif; font-size:11px; padding:10px; background:#FFFFB7; border:1px solid #F1F1F1;box-shadow: 0 0 20px #cbcbcb;-moz-box-shadow: 0 0 20px #cbcbcb;-webkit-box-shadow: 0 0 20px #cbcbcb;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; line-height:20px; margin-bottom:5px; margin-top:20px;}
.prathap_input{width:120px; padding-top:11px; float:left;}

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
str=str+"<tr><td colspan='2'><center><a class='absbutton' style='cursor:pointer;' onclick=doevereg("+num+","+eid+")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";		
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
     
      if((opt.url=="eventreg-db.php" && xhr.status!="200") || opt.url=="uploadabstract.php" && xhr.status!="200")
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
url:"eventreg-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("success")!=-1){notify("Registered Successfully....Please wait while changes takes place...","success","3500","true");shwfrm("eventview.php?eid="+<?php echo $eid;?>);}else{notify(data,"error","2000","true");}}
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

<center>
<table id="customers" style="margin-rop:0px;width:1200px;margin-left:38%;">
<tr><th  style="height:30px;"><center><h3><?php $di=$query_fet['branch'];$realbr=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='$di'"));echo $realbr['displayname']." - ".$query_fet['eventname'];?></h3><a href="javascript:void(0);" style="float:right;margin-top:-37px;" onClick="prathap_hide_popup_boxes();"><img src="img/closelabel.gif"></a></center></th></tr>
<tr class="alt"><td style="font-family:Times New Roman;font-weight:normal;letter-spacing:2px;font-size:12px;"><marquee behavior="scroll" scrolldelay="100">
&nbsp;&nbsp;&nbsp;<img src='img/icon_arrow.png'>&nbsp;&nbsp;&nbsp;<b><big>You cannot cancel Event Registration,to do that you have to contact Admin.</big></b>
<!--&nbsp;&nbsp;&nbsp;<img src='img/icon_arrow.png'>&nbsp;&nbsp;&nbsp;<b><big>For Technical Problems,Contact Prathap(9010932254)</big></b>-->
</marquee></td></tr>
<tr style="background:#fff;color:black;letter-spacing:2px;line-height:30px;text-align:justify;font-size:13px;">
<td>

<div id="main">
	<img src="<?php echo "event_images/".$query_fet['branch']."/".$query_fet['imagename'];?>" width="111px" height="78px" style="float:left;margin-top:-18px;">
        <ul id="tabs">
            <li class="active">Home</li>
            <li>About</li>
            <li>Rules</li>	
            <li>Organizers</li>
            <li>Schedule</li>
            <li>Prizes</li>
            <li>Winners</li>
            <li>Register</li>
            <li>Teams</li>
            <?php if($isabstract==1){?><li>Upload</li><?php } ?>
        </ul>
        <ul id="tab">
            <li class="active">
                <h2>HOME</h2>
              <center><table id="customers">
				  <tr><td rowspan="6" width="178px"><img src="<?php echo "event_images/".$query_fet['branch']."/".$query_fet['imagename'];?>" width="178px"></td><td style="background:#ddd;font-size:15px;" width="160px">Registered Teams</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php $regcou=mysql_num_rows(mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'")); echo $regcou;?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:15px;">Registrations</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php if($query_fet['areregistrationson']=="on"){echo "Open";}else{echo "Closed";}?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:15px;">Participants</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;"><?php if($query_fet['participants']==$query_fet['minparticipants']){echo $query_fet['participants'];}else{echo $query_fet['minparticipants']." - ".$query_fet['participants'];}?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:15px;">Views</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php echo $query_fet['views'];?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:15px;">Organizers</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php echo $query_fet['orgcount'];?></font></td></tr>
				  <tr><td style="background:#ddd;font-size:15px;">Your status</td><td><font style="color:#0080C0;font-family:Adobe Gothic Std;font-weight:bold;font-size:16px;text-align:left;text-transform:lowercase;"><?php if($isloggedin==true){$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));$ev=array();$ev=explode("~",$user_fet['eventids']);if(in_array($eid,$ev)){echo "<font color='green'>Registered</font>";}else{echo "<font color='blue'>Not Registered</font>";}}else{echo "<font color='red'>Please Login</font>";}?></font></td></tr>
				  </table></center>
				  
              </li>
            <li>
                <h2>ABOUT</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['description'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
          <li>
                <h2>RULES</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['instructions'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>ORGANIZERS</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['organizers'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>SCHEDULE</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['schedule'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>PRIZES</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['prizes'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>WINNERS</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php echo $query_fet['winners'];?>
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>REGISTER</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                
                <?php if($isloggedin==true){
										$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
									
										if($user_fet['year']!="E4")
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
print "<tr class='".$cll."'><td><span style='color:#000;font-weight:bold;font-family:Times New Roman'>University ID ".$i."</span> &nbsp;&nbsp; : &nbsp;&nbsp;</td><td><input type='text' placeholder='ex : N130950' id='stuid".$i."' style='background:#fff;'></td></tr>";	
}
print "<tr><td colspan='2'><center><a class='absbutton' style='cursor:pointer;' onclick=doevereg(".$query_fet['participants'].",".$eid.")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";		


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
										
										<?php  }
									
										}
										else{
										?>
										<center><span class=''>Please <a onclick="shwfrm('login')" style='cursor:pointer;color:red;'>Login</a> to Register to this event</span></center>
										<?php } ?>


                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
        <li>
                <h2>TEAMS</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
                 <?php
//teams
     echo "<center><br>";
	$kt=mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'") or die(mysql_error());
	echo "<table border=1 cellpadding='10' style='text-align:center;'><tr>";
    
	if(mysql_num_rows($kt)>0)
	{
	    $kkg=0;
	while($fkt=mysql_fetch_array($kt))
		{
		$mt=array();
		$mt=$fkt['ids'];
		$super=explode("~",$mt);
		
		if($kkg%10==0)
			echo "</tr><td style='background-color:white'>";
		else
			echo "<td style='background-color:white'>";
		$kkg++;
		$colors=array("660066","990000","6600CC","9900CC","FF0000","FF00CC","CC00CC","003399","006600");
		shuffle($colors);
		echo "&nbsp;<u><b><FONT COLOR=YELLOW style='background-color:black;'>Team :".$fkt['teamid']."</FONT></u></B><br>";
                $keka=count($super);
		for($y=0;$y<$keka;$y++)
			echo "<font color=".$colors[0].">".$super[$y]."</font><br>";
		}
		echo "</td>";
		
		
	}
	else
		echo "<center><span class='' style='color:red;'>No Teams Registered</span></center>";
        echo "</tr></table></center>";


?>

                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:red;">Updates</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
					<marquee bgcolor="#fff" scrolldelay="100" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);" direction="up" scrolldelay="100" scrollamount="3" direction="up">
                <?php
                
$result = mysql_query("SELECT * FROM notifications WHERE visibility='1' and eid='$eid' ORDER BY nid DESC") or die(mysql_error());
while ($row = mysql_fetch_array($result)) 
	{
	$n=$row['nid'];
	$a="<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;' onclick=shwno(\"$n\")>";
	$new=($row['added_date']==date("m-d-Y"))?"<img src='img/1.gif'>":"";
	$notification=$row['title'];
	echo "".$a.$notification."  ".$new."";
	echo "<hr>";
	}
	?></marquee>
                </div>
                </td></tr></table>
                </li>
                
                <?php
                 if($abstract_fet['uploadsopen']=="opened")
								 {?>
 								
                <li>
					
								 <script src="js/imageupload.js"></script>
                <h2>UPLOAD ABSTRACT</h2>
                <table><tr><td>
                <div style="height:217px;word-wrap:break-word;width:800px;overflow-x:hidden;">
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
								<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
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
							
 
                </div>
                </td><td style="padding:0px;margin:0px;"><center><span style="font-size:18px;color:blue;">Instructions</span></center><hr>
                <div style="width:230px;height:160px;word-wrap:break-word;overflow-x:hidden;">
	            <?php
                
	echo "<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;'><font color='red'>jpg,pdf,doc,ppt,zip</font> formats are allowed</a><br><hr>";
	echo "<a href=\"javascript:void(0)\" style='color:black;text-decoration:none;'>Max file size is<font color='red'> <mark><big>6MB</big></mark></font></a><br><hr>";
		?>
                </div>
                </td></tr></table>
                </li><?php } ?>
        </ul>
</div><!-- #main -->
</td>
</tr>
</table>
</center>
		<!--event chating-->
							<?php
							$status="<img src='img/inactive.png' width='20px'>";
							$org=mysql_query("SELECT * FROM organizers WHERE role!='Webteam'");
							while($o=mysql_fetch_array($org))
							{
							$on=array();
							$on=explode("~",$o['eids']);
							if(in_array($eid,$on)){
								if($o['status']=="online"){
								$status="<img src='img/active.png' width='20px'>";break;
							}
								}
								
							}
							?>
							<div style="position:fixed;width:18%;z-index:9999999;bottom:0%;right:40%;">
							<table id="customers">
							<tr><th style="cursor:pointer;" id="chh"><span id='nooo'>chat with Organizer</span>(<?php echo $status;?>)</th></tr>
							<tr style="display:none;" id="assd"><td>
							<div style="height:270px;width:255px;background:#eee;overflow:scroll;text-align:left;word-wrap:break-word;border:1px solid black;" id='chat'></div>
							<div style="width:100%;height:27px;overflow:hidden;border:1px solid blue;">
							<form method="post" action="javascript:void(0);" onsubmit="sendchatmsg('<?php echo $eid;?>')">
							<input type="text" style="float:left;"  id='chatmsg' placeholder="Enter Message Here">
							<a onclick="sendchatmsg('<?php echo $eid;?>')" type="button" style="background:#999868;height:100%;color:yellow;cursor:pointer;padding:12px;font-weight:bold;width:100%;text-align:center;">Send</a>
							</form>
							</div>
						
							</td></tr>
							</table>
							</div>
							
							<!--evvent chating-->
					
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("ul#tabs li").click(function(e){
        if (!$(this).hasClass("active")) {
            var tabNum = $(this).index();
            var nthChild = tabNum+1;
            $("ul#tabs li.active").removeClass("active");
            $(this).addClass("active");
            $("ul#tab li.active").removeClass("active");
            $("ul#tab li:nth-child("+nthChild+")").addClass("active");
        }
    });
});
</script>
<?php
}
else{header("location:index.php");}
}
else{header("location:index.php");}

 ?>
