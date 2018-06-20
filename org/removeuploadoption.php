<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
?>
  <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1>Remove Upload Option</h1></div>
    		<div class="box-content">
			<?php
			
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$sitesettingsdat=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Remove Upload Option'"));
	if($getuserdata['role']!="Webteam")
				{
					if($sitesettingsdat['value']=="off")
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  Webteam Stopped Removing Upload Option....Please Contact webteam<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
    			</div>
				<center><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"></center>
				<?php
}
else
{
	
	?>
	
		<center>
		<div class="form"><table id="customers" style="width:80%;">
		<th>Branch</th>	<th>Event Name</th><th>Current Status</th><th>Action</th>
	<?php
			 $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
				for($i=0;$i<count($user_eve_data);$i++)
	{
	  $settings=mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$user_eve_data[$i]."' && visibility='1'");
  while($branch_cat=mysql_fetch_array($settings)){

	
       $curstatus="";
	   $proopt="";

	  
	  ?>
			<tr id="id<?php echo $branch_cat['eid'];?>"><td><?php echo $branch_cat['branch'];?></td><td><?php echo $branch_cat['eventname'];?></td> <td id="chn<?php echo $branch_cat['eid'];?>"><?php echo "Remove Upload Option"; ?></td><td ><?php echo "<input type='submit' style='cursor:pointer;color:green;' value='Remove Upload Option' onclick=\"removeuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>"; ?></td> </tr>
			 <?php
		   
		   }
	}
  ?>
		
		</table>
		</form>
		</div></center>
		<br><br>

<?php
}
				}
else
	{
	?>
		<center>
		<div class="form"><table id="customers" style="width:80%;">
		<th>Branch</th>	<th>Event Name</th><th>Current Status</th><th>Action</th>
	<?php
			
	  $settings=mysql_query("SELECT * FROM abstract_uploads_settings  WHERE visibility='1'");
  while($branch_cat=mysql_fetch_array($settings)){

	  
       $curstatus="";
	   $proopt="";

	  
	  ?>
			<tr id="id<?php echo $branch_cat['eid'];?>"><td><?php echo $branch_cat['branch'];?></td><td><?php echo $branch_cat['eventname'];?></td> <td id="chn<?php echo $branch_cat['eid'];?>"><?php echo "Remove Upload Option"; ?></td><td ><?php echo "<input type='submit' style='cursor:pointer;color:green;' value='Remove Upload Option' onclick=\"removeuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>"; ?></td> </tr>
			 <?php
		   
		   }
  ?>
		
		</table>
		</form>
		</div></center>
		<br><br>
	<?php
	}

?>
</div></div></div>
