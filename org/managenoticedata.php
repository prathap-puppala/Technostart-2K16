<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");

$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));

if(isset($_GET['nid']))
{
$eid=mysql_real_escape_string(strip_tags($_GET['nid']));
$evedata=mysql_query("SELECT * FROM notifications WHERE nid='".$eid."'");
$eve_set=mysql_fetch_array($evedata);
if($eve_set['eid']!="ALL")
	{
$notevedata=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$eve_set['eid']."'"));
	}
?>
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
    		<div class="box-head"><h1>Manage <?php echo $eve_set['title'];?> Notice details</h1></div>
    		<div class="box-content">

<center><div class='form'><form onsubmit="return filevalid()" action="updatenoticetodb.php" method="post"  enctype="multipart/form-data"><table id="customers"><tr><td>Event Name</td><td><select id='evename' name='evename' class='text'><option value="<?php
	if($eve_set['eid']!="ALL")
	{
$notevedata=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$eve_set['eid']."'"));
	}
	if($eve_set['eid']!="ALL")
	{
$notevedata=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$eve_set['eid']."'"));
	}
	if($eve_set['eid']!="ALL"){
	echo $noteevedata['eid'];
	} else { echo "ALL"; }?>">
	<?php
		if($eve_set['eid']!="ALL")
	{
$notevedata=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$eve_set['eid']."'"));
	}
	if($eve_set['eid']!="ALL")
	{
$noteevedata=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$eve_set['eid']."'"));
	} if($eve_set['eid']!="ALL"){
	echo "".$noteevedata['branch']." ~ ".$noteevedata['eventname']."";
	} else { echo "ALL";}?></option>
		<?php
										
	if(!$getuserdata['role']=="Webteam")
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
	
		  while($branch_cat=mysql_fetch_array($settings)){
			 echo "<option value='".$branch_cat['eid']."'>".$branch_cat['branch']."~".$branch_cat['eventname']."</option>"; 
		   }
		   
	}
	?>
	</select><br><span id='evenameselection_error'></span></td></tr>
	<input type="hidden" id='noteid' value="<?php echo $eid;?>" class='text big' name='noteid'>
	<tr><td>Notice Title</td><td><input type="text" id='notetitle' value="<?php echo $eve_set['title'];?>" class='text big' name='notetitle'><br><span id='notetitle_error'></span></td></tr>
	
	<tr><td>Notice</td><td><textarea id='catego' class='text' name='catego' rows="8" cols="100"><?php echo $eve_set['description'];?></textarea><br><span id='whereadd_error'></span></td></tr>
	<tr><td>Sd/-</td><td><input type="text" value="<?php echo $eve_set['sd'];?>" id='notesd' class='text' value="Event Organizer" name='notesd'><br><span id='notesd_error'></span></td></tr>
	
	<tr><td colspan="2"><center></center>	<input type="submit" id="evesubbut" value="UPDATE NOTICE" class="submit" name="submit"/></td></tr>
	</table></form></div></center></div></div></div>
			<script>
	$(document).ready(function(){
		new nicEditor({fullPanel : true}).panelInstance('catego');
		});
	</script>

			<?php
}
?>
