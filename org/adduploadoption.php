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
    		<div class="box-head"><h1>Add Upload Option</h1></div>
    		<div class="box-content">
			<?php
			
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$sitesettingsdat=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Adding Upload Option'"));
	if($getuserdata['role']!="Webteam")
				{
					if($sitesettingsdat['value']=="off")
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  Webteam Stopped Adding Upload Option....Please Contact webteam<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
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
			
	  $settings=mysql_query("SELECT * FROM events WHERE visibility='1'");
  while($branch_cat=mysql_fetch_array($settings)){

	   $uploads_sett=mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'");
	  
       $curstatus="";
	   $proopt="";
	   if(mysql_num_rows($uploads_sett)>=1)
	  {
	 $upl_set=mysql_fetch_array($uploads_sett);

	 if($upl_set['uploadsopen']=="opened")
		  {
		 $color="blue";
		  }
		  else
		  {
			  $color="red";
		  }

	    if($upl_set['uploadsopen']=="opened")
		  {
			 $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
	 $curstatus="<big><b><font color='".$color."'>Upload Option is provided by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are <i><u>".$upl_set['uploadsopen']."</u></i></font></b></big>";
		  }
		  }
		  else
		  {
			   $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
			   $curstatus="<big><b><font color='".$color."'>Upload Option is closed by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are <i><u>".$upl_set['uploadsopen']."</u></i></font></b></big>";
			   }
		  }

	 if($upl_set['uploadsopen']=="opened")
		  {
		  $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
		  $option="closed";
		   $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Close Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		  }
		 else
			  {
			 
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			  }
		  }
		  else
		  {
			   $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
	     $option="opened";
		  $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Open Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		  }
		 else
			  {
			 
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			  }
		  }
	  }
	  else
	  {

       $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="0")
		  {
		   
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
  }
  else
		  {
	  
        $curstatus="Upload Option Not Provided";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Add Upload Option' onclick=\"appuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
		 
		  }



		   }
	  
	  ?>
			<tr><td><?php echo $branch_cat['branch'];?></td><td><?php echo $branch_cat['eventname'];?></td> <td id="chn<?php echo $branch_cat['eid'];?>"><?php echo $curstatus; ?></td><td id="id<?php echo $branch_cat['eid'];?>"><?php echo $proopt; ?></td> </tr>
			 <?php
		   
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
			
	  $settings=mysql_query("SELECT * FROM events WHERE visibility='1'");
  while($branch_cat=mysql_fetch_array($settings)){

	   $uploads_sett=mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'");
	  
       $curstatus="";
	   $proopt="";
	   if(mysql_num_rows($uploads_sett)>=1)
	  {
	 $upl_set=mysql_fetch_array($uploads_sett);

	 if($upl_set['uploadsopen']=="opened")
		  {
		 $color="blue";
		  }
		  else
		  {
			  $color="red";
		  }

	    if($upl_set['uploadsopen']=="opened")
		  {
			 $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
	 $curstatus="<big><b><font color='".$color."'>Upload Option is provided by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are <i><u>".$upl_set['uploadsopen']."</u></i></font></b></big>";
		  }
		  }
		  else
		  {
			   $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
			   $curstatus="<big><b><font color='".$color."'>Upload Option is closed by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are <i><u>".$upl_set['uploadsopen']."</u></i></font></b></big>";
			   }
		  }

	 if($upl_set['uploadsopen']=="opened")
		  {
		  $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
		  $option="closed";
		   $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Close Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		  }
		 else
			  {
			 
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			  }
		  }
		  else
		  {
			   $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="1")
		  {
	     $option="opened";
		  $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Open Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		  }
		 else
			  {
			 
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			  }
		  }
	  }
	  else
	  {

       $exis=mysql_fetch_array(mysql_query("SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"));
       if($exis['visibility']=="0")
		  {
		   
 $curstatus="Upload Option Provided but Cancelled";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
  }
  else
		  {
	  
        $curstatus="Upload Option Not Provided";
		$proopt="<input type='submit' style='cursor:pointer;color:green;' value='Add Upload Option' onclick=\"appuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
		 
		  }



		   }
	  
	  ?>
			<tr><td><?php echo $branch_cat['branch'];?></td><td><?php echo $branch_cat['eventname'];?></td> <td id="chn<?php echo $branch_cat['eid'];?>"><?php echo $curstatus; ?></td><td id="id<?php echo $branch_cat['eid'];?>"><?php echo $proopt; ?></td> </tr>
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