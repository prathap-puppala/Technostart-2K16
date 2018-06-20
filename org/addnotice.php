<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$sitesettingsdat=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Adding Notices'"));

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

function filevalid()
{
var evename=getinputdata("evename");
var notetitle=getinputdata("notetitle");
var catego=getinputdata("catego");
var notesd=getinputdata("notesd");

	if(evename=="")
	{
		shwerror("evenameselection_error","Please Select Event","evename");
    return false;
	}
	else if(notetitle=="")
	{
		shwerror("notetitle_error","Please Enter Notice Title","notetitile");
    return false;
	}
	else if(catego=="")
	{
		shwerror("whereadd_error","Please Enter Notice to post","catego");
    return false;
	}
	else if(notesd=="")
	{
		shwerror("notesd_error","Please Enter Notice Title","notesd");
    return false;
	}

	else
	{
	return true;
	}
}
</script>
    <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1>Adding Notice</h1></div>
    		<div class="box-content">
			<?php
if($getuserdata['role']!="Webteam")
				{
if($sitesettingsdat['value']=="off")
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  Webteam Stopped Adding Notice....Please Contact webteam<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
    			</div>
				<center><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"></center>
				<?php
}
else
{
	
		?>
		<center><div class='form'><form onsubmit="return filevalid()" action="addnoticetodb.php" method="post"  enctype="multipart/form-data"><table id="customers"><tr><td>Event Name</td><td><select id='evename' name='evename' class='text'><option value=''>Choose</option>
		<?php
										
	if($getuserdata['role']!="Webteam")
				{
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++)
	{
				
	  $settings=mysql_query("SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'");
  while($branch_cat=mysql_fetch_array($settings)){
			 echo "<option value='".$branch_cat['eid']."'>".$branch_cat['branch']."~".$branch_cat['eventname']."</option>"; 
		   }
		   }
				}
				else
	{
			$sno=0; 
	  $settings=mysql_query("SELECT * FROM events");
	
		echo "<option value='ALL'>ALL</option>";
		  while($branch_cat=mysql_fetch_array($settings)){
			  $fg=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='".$branch_cat['branch']."'"));
			 echo "<option value='".$branch_cat['eid']."'>".$fg['displayname']."~".$branch_cat['eventname']."</option>"; 
		   }
		   
	}
	?>
	</select><br><span id='evenameselection_error'></span></td></tr>
	<tr><td>Notice Title</td><td><input type="text" id='notetitle' class='text big' name='notetitle'><br><span id='notetitle_error'></span></td></tr>
	
	<tr><td>Notice</td><td><textarea id='catego' class='text' name='catego' rows="8" cols="100"></textarea><br><span id='whereadd_error'></span></td></tr>
	<tr><td>Sd/-</td><td><input type="text" id='notesd' class='text' value="Event Organizer" name='notesd'><br><span id='notesd_error'></span></td></tr>
	
	<tr><td>Select file</td><td> <input type="file" class="file" id="file" name="file" onchange="checkempty(this.id,'Event Image')"/><br>(Only zip,doc,pdf,ppt are allowed)<br><span id='file_error'></span></td></tr>
	<tr><td colspan="2"><center></center>	<input type="submit" id="evesubbut" value="	" class="submit" name="submit"/></td></tr>
	</table></form></div></center>

							<?php
}
				}
				else
				{
					?>
						<center><div class='form'><form onsubmit="return filevalid()" action="addnoticetodb.php" method="post"  enctype="multipart/form-data"><table id="customers"><tr><td>Event Name</td><td><select id='evename' name='evename' class='text'><option value=''>Choose</option>
		<?php
										
	if($getuserdata['role']!="Webteam")
				{
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++)
	{
				
	  $settings=mysql_query("SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'");
  while($branch_cat=mysql_fetch_array($settings)){
			  $fg=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='".$branch_cat['branch']."'"));
			 echo "<option value='".$branch_cat['eid']."'>".$fg['displayname']."~".$branch_cat['eventname']."</option>"; 
		   }
		   }
				}
				else
	{
			$sno=0; 
	  $settings=mysql_query("SELECT * FROM events");
	
		echo "<option value='ALL'>ALL</option>";
		  while($branch_cat=mysql_fetch_array($settings)){
			  $fg=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='".$branch_cat['branch']."'"));
			 echo "<option value='".$branch_cat['eid']."'>".$fg['displayname']."~".$branch_cat['eventname']."</option>"; 
		   }
		   
	}
	?>
	</select><br><span id='evenameselection_error'></span></td></tr>
	<tr><td>Notice Title</td><td><input type="text" id='notetitle' class='text big' name='notetitle'><br><span id='notetitle_error'></span></td></tr>
	
	<tr><td>Notice</td><td><textarea id='catego' class='text' name='catego' rows="8" cols="100"></textarea><br><span id='whereadd_error'></span></td></tr>
	<tr><td>Sd/-</td><td><input type="text" id='notesd' class='text' value="Event Organizer" name='notesd'><br><span id='notesd_error'></span></td></tr>
	
	<tr><td>Select file</td><td> <input type="file" class="file" id="file" name="file" onchange="checkempty(this.id,'Event Image')"/><br>(Only zip,doc,pdf,ppt are allowed)<br><span id='file_error'></span></td></tr>
	<tr><td colspan="2"><center></center>	<input type="submit" id="evesubbut" value="ADD NOTICE" class="submit" name="submit"/></td></tr>
	</table></form></div></center>
		

	<?php
				}
?>
</div></div></div></div>

		<script>
	$(document).ready(function(){
		new nicEditor({fullPanel : true}).panelInstance('catego');
		});
	</script>
