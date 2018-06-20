<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$eventdat=mysql_fetch_array(mysql_query("SELECT * FROM events ORDER BY eid DESC LIMIT 1"));
$lastid=$eventdat['eid'];
?>
<style>
#rest {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
	text-align:center;
}

#rest td, #rest th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#rest th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#rest tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
	text-align:center;
}
</style>
<script>
function getinputdata(field)
{
return document.getElementById(field).value;
}

function shwerror(field,msg,inpfie)
{
document.getElementById(field).innerHTML="<font color=red>"+msg+"</font>";
$("#"+inpfie).focus();
}
function eventvalidation()
{
var branch=getinputdata("branch");
var eventname=getinputdata("eventname");
var participants=getinputdata("participants");
var minparticipants=getinputdata("minparticipants");
var file=getinputdata("file");
var yearrestrictions=$("input['name=yearrestrictions']:checked").val();

if(branch=="")
	{
    shwerror("branch_error","Please Enter Branch","branch");
	return false;
	}
else if(eventname=="")
	{
    shwerror("eventname_error","Please Enter EventName","eventname");
	return false;
	}
else if(participants=="")
	{
    shwerror("participants_error","Please Enter Num of Participants","participants");
	return false;
	}
else if(minparticipants=="")
	{
    shwerror("minparticipants_error","Please Enter Minimum Num of Participants","minparticipants");
	return false;
	}
else if(yearrestrictions==undefined)
	{

    shwerror("yearrestrictions_error","Please Select Year Restrictions option","yearrestrictions");
	return false;
	}
	else if(file=="")
	{

    shwerror("file_error","Please Select Event Image","file");
	return false;
	}
	else
	{
    document.getElementById("evesubbut").innerHTML="adding.........";
	
    return true;
	}
}
</script>
    <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1>Add a New Event to <?php echo $title;?></h1></div>
    		<div class="box-content">
			<?php
if(!isset($_SESSION['tz_webteam']))
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  This feature is available for Webteam only<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
    			</div>
				<center><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"></center>
				<?php
}
else
{
	?>
	<script>
	$(document).ready(function(){
		new nicEditor({fullPanel : true}).panelInstance('description');
		new nicEditor({fullPanel : true}).panelInstance('instructions');
		new nicEditor({fullPanel : true}).panelInstance('organizers');
		new nicEditor({fullPanel : true}).panelInstance('schedule');
		new nicEditor({fullPanel : true}).panelInstance('prizes');
		});
	</script>
	<div class="form" onload="maked()">
	<form action="addeventtodb.php" method="post" onsubmit="return eventvalidation()" enctype="multipart/form-data">
	EVENT ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" value="<?php echo $lastid+1;?>" class="text small"  readonly disabled /><br>


							BRANCH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp;:	<select id="branch" name="branch" class="text" style="width:27%;">
    							<option value="">Choose</option>
    							<?php
		$branch_categories=mysql_query("SELECT * FROM branch_categories");
		while($branch=mysql_fetch_array($branch_categories))
	{
		echo "<option value='".$branch['branch']."'>".$branch['displayname']."</option>";
	}
	?>
    		</select> <span id="branch_error"></span><br>



    						NAME OF THE EVENT  : <input type="text" class="text small" id="eventname" name="eventname" onblur="checkeventname()" onkeyup="changetouppercase(this.id)" /> <span id="eventname_error"></span><br>


    						PARTICIPANTS &nbsp;&nbsp&nbsp&nbsp&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp;&nbsp; : <input type="text" class="text small" name="participants" id="participants" onkeyup="numvalid(this.id,'participants_error');addminauto(this.value);"  /> <span id="participants_error"></span><br>

	MIN PARTICIPANTS &nbsp;&nbsp;&nbsp; : <input type="text" class="text small" id="minparticipants" name="minparticipants" onkeyup="numvalid(this.id,'minparticipants_error');" onblur="minparticipantscheck()"  /> <span id="minparticipants_error"></span><br>

	
	YEAR RESTRICTIONS &nbsp; : <input type="radio" name="yearrestrictions" value="yes" onchange="yearrestri('yes')"/>Yes &nbsp; <input type="radio" name="yearrestrictions" value="no" onchange="yearrestri('no')"/>No <span id="yearrestrictions_error"></span><br><br>

          <div id="year_restri_div" style="display:none;">
		  <script>
	var titles="";var field="";var years=new Array("P1","P2","E1","E2","E3","E4");
	for(var i=0;i<years.length;i++){
	var titles=titles+"<td  style='color: #000000; background-color: #EAF2D3;'>"+years[i]+"</td>";

	var field=field+"<td><input type='text' value='0' style='text-align:center;' id='restriarea"+years[i]+"' name='resar"+years[i]+"' onblur=validrestcount() onkeyup=numvalid(this.id,'"+years[i]+"_error')><span id='"+years[i]+"_error'></span></td>";}
	document.getElementById("year_restri_div").innerHTML="<table id='rest'><tr>"+titles+"</tr><tr>"+field+"</tr></table>";</script></div>
	<br>

	
	<span style='margin-top:90px;'>DESCRIPTION &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Characters Typed : <span id="descriptioncou" style="color:#008B8B;">0</span></span> <br><textarea  rows=8 cols=5 class="text big" id="description" name="description" onkeyup="shwcharcount(this.id)" onblur="checkempty(this.id,'Description')"  /> <span id="description_error"></span><br><br>

<span style='margin-top:90px;'>INSTRUCTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Characters Typed : <span id="instructionscou" style="color:#008B8B;">0</span></span> <br><textarea  rows=8 cols=5 class="text big" id="instructions" name="instructions" onkeyup="shwcharcount(this.id)" onblur="checkempty(this.id,'Instructions')"  /> <span id="instruction_error"></span><br><br>


<span style='margin-top:90px;'>ORGANIZERS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Characters Typed : <span id="organizerscou" style="color:#008B8B;">0</span></span> <br><textarea  rows=8 cols=5 class="text big" id="organizers" name="organizers" onkeyup="shwcharcount(this.id)" onblur="checkempty(this.id,'Organizers details')"  /> <span id="organizers_error"></span><br><br>

	<span style='margin-top:90px;'>SCHEDULE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Characters Typed : <span id="schedulecou" style="color:#008B8B;">0</span></span> <br><textarea  rows=8 cols=5 class="text big" id="schedule" name="schedule" onkeyup="shwcharcount(this.id)" onblur="checkempty(this.id,'Schedule')"  /> <span id="schedule_error"></span><br><br>


<span style='margin-top:90px;'>PRIZES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Characters Typed : <span id="prizescou" style="color:#008B8B;">0</span></span> <br><textarea  rows=8 cols=5 class="text big" id="prizes" name="prizes" onkeyup="shwcharcount(this.id)" onblur="checkempty(this.id,'Prizes Details')"  /> <span id="prizes_error"></span><br><br>

	Event Image <input type="file" class="file" id="file" name="file" onchange="checkempty(this.id,'Event Image')"/>&nbsp;&nbsp;&nbsp;(Only jpg,png,jpeg,gif are allowed)(<mark>width=111px</mark> and height=<mark>78px</mark>)<br><span id="file_error"></span>
	<Br><br><br>
	<input type="submit" id="evesubbut" value="ADD EVENT" class="submit" name="submit"/>
	</form>
							</div>
							<?php
}
?>
</div></div></div></div>
