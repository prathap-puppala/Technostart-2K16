<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title><?php echo "".$_SESSION['tz_organizer']." - Organizer[".$title."]";?></title>

<?php require_once("file_includes.php"); ?>
<script>

setInterval(function()
{

	$.post("noticeupd.php",function(data){
		if(data.indexOf("not")==-1){ulak({"text":data,"type":"warning","timeout":5000});}
		});
},20000);
</script>
</head>
<body>
<div class="shadow"></div>
<!-- .shadow -->
<!-- BEGIN HEADER -->
<div id="header">
	<p class="logo"><a href="" title="<?php echo $title;?> Organizer"><?php echo $title;?> Organizer</a></p>
	<p class="user"><span>Hello, <?php echo $getuserdata['name'];?></span> <a href="#" title="settings">View Teckzite Website</a>  - <a href="logout.php" title="settings">Logout</a></p>
</div><!-- end div #header -->
<!-- END HEADER -->
<!-- BEGIN SLIDEBAR -->
<div id="slidebar">
    <div id="menu">
	<?php
		if($getuserdata['role']=="Webteam")
				{
					?>
			<div class="menu-item">
				<h3 class="close"><img src="img/icon/m-close.png" alt="" />Organizers</h3>
				<div class="menu-overflow">
					<div class="menu-content">
						<ul>
							
							<li><a id="addorganizer" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_add.png" alt="" />Add Organizer</a></li>
							<li><a id="manageorganizerdetails" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_edit.png" alt="" />Manage Organizer Details</a></li>
						</ul>
					</div><!-- end div .menu-content -->
				</div><!-- end div .menu-overflow -->
			</div><!-- end div .menu-item -->

			<?php
				}
			?>

			<?php
	if($getuserdata['role']=="Webteam")
			{
				?>
		<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Settings</h3>
    		<div class="menu-overflow">
    			<div class="menu-content">
    				<ul>
					   
    					<li><a id="site-settings" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_edit.png" alt="" />Manage Site Settings</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->

		<?php
			}
		?>
    	<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Event Details</h3>
    		<div class="menu-overflow">
    			<div class="menu-content">
    				<ul>
					   <?php
	if($getuserdata['role']=="Webteam")
			{
				?> 
    					<li><a id="addevent" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_add.png" alt="" />Add Event</a></li>
						<?php } ?>
    				<!--	<li><a id="manageeventdetails" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_edit.png" alt="" />Manage Event Details</a></li>-->
						<li><a id="addfilestoeventdetails" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/page_edit.png" alt="" />Add files to event</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->

		<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Event Registrations</h3>
    		<div class="menu-overflow">
    			<div class="menu-content">
    				<ul>
					   
    					<li><a id="eventregistrations" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/chart_bar.png" alt="" />Get Event Registration Data</a></li>
						<li><a id="stopeventregistrations" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/chart_bar.png" alt="" />Stop Event Registrations</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->
    	
    	<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Notices</h3>
    		<div class="menu-overflow" >
    			<div class="menu-content">
    				<ul>
    					<li><a id="addnotice" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper_add.png" alt="" />Add Notice</a></li>
    					<li><a id="managenotices" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper.png" alt="" />Manage Notice</a></li>
    					<li><a id="deletenotices" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper_delete.png" alt="" />Delete Notice</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->
    	
    	
    	<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />User Messages</h3>
    		<div class="menu-overflow" >
    			<div class="menu-content">
    				<ul>
    					<li><a id="evemessages" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper_add.png" alt="" />Event Messages</a></li>
    			 <?php
	if($getuserdata['role']=="Webteam")
			{
				?> 
    					<li><a id="webteammsgs" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper.png" alt="" />Webteam Messages</a></li>
    					<?php } ?>
    					</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->

			<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Uploading</h3>
    		<div class="menu-overflow" >
    			<div class="menu-content">
    				<ul>
    					<li><a id="adduploadoption" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper_add.png" alt="" />Provide Uploads Option</a></li>
    					<li><a id="removeuploadoption" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper.png" alt="" />Remove Uploads Option</a></li>
    					<li><a id="getuploadsdata" style='cursor:pointer;' onclick='load_page(this.id)'><img src="img/icon/famfamfam/newspaper_delete.png" alt="" />Get Uploads Data</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->


    	<div class="menu-item">
    		<h3 class="close"><img src="img/icon/m-close.png" alt="" />Account</h3>
    		<div class="menu-overflow" >
    			<div class="menu-content">
    				<ul>
    					<li><a href="logout.php"><img src="img/icon/famfamfam/image_add.png" alt="" />Logout</a></li>
    				</ul>
    			</div><!-- end div .menu-content -->
    		</div><!-- end div .menu-overflow -->
    	</div><!-- end div .menu-item -->
    </div><!-- end div #menu -->
</div><!-- end div #slidebar -->
<!-- END SLIDEBAR -->
<!-- BEGIN CONTENT -->
<div id="content">
<div id="loadingcontent" style="background:#fff;">
    <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1>Welcome  <?php echo $getuserdata['name'];?></h1></div>
    		<div class="box-content">
				<center>
			<img src='img/nuz.png'  width="80px">
			<img src='img/sdcac.png'  width="80px">
			<img src='img/tz.jpg'  width="100px">
			</center>
			<?php
			if($getuserdata['role']!="Webteam")
			{
			$user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
             $evedataemp="";
			 $eventfields=array();
			$eventfields=array("participants","minparticipants","description","organizers","schedule","winners");
		for($i=0;$i<count($user_eve_data);$i++)
			{
			
			$evedataemp=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'"));
			if($evedataemp['participants'] == 0 || $evedataemp['minparticipants'] == 0 || $evedataemp['description'] == "" || $evedataemp['organizers'] == "" || $evedataemp['schedule'] == "" || $evedataemp['winners'] == "")
				{
                 $error="yes";
				}
				else
				{
					$error="no";

				}
				if($error=="yes")
				{
			?>
			
<div class="notification warning">
    				<div class="messages">Following Fields are missing for the event <span style='font-size:15px;'><?php echo $evedataemp['displayname']."~".$evedataemp['eventname'] ;?></span><div class="close"></div>				
</div></div>
<?php } else {?>

<div class="notification success" >
    				<div class="messages">Required data for the event <span style='font-size:15px;'><?php echo $evedataemp['eventname'] ;?> </span>has been provided...Thank You</span><div class="close"></div></div></div>
				
<?php
}
?>

	<table border="0" style="margin-top:-6px;" id="customers">
<tr>
					<?php
if($evedataemp['participants'] == 0){echo "<td> Participants</td>";}
if($evedataemp['minparticipants'] == 0){echo "<td> Minimumm Participants</td>";}
if($evedataemp['description'] == ""){echo "<td> Description</td>";}
if($evedataemp['organizers'] == ""){echo "<td> Organizers</td>";}
if($evedataemp['schedule'] == ""){echo "<td> Schedule</td>";}
if($evedataemp['winners'] == ""){echo "<td> Winners</td>";}
?>
			</tr>	</table><br><br>
<!-- end div .notification error -->
				<?php

			}
			}
			else
			{

       $branches=mysql_query("SELECT * FROM branch_categories");
	   $branches_count=mysql_num_rows($branches);
        ?>
		<Br>

		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Branches</th>
		<tr><?php while($branch_cat=mysql_fetch_array($branches)){ echo "<td>".$branch_cat['displayname']."</td>"; }?></tr>
		
		</table></center>
		<br><br>
		
		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Events</th>
		<tr><?php
			$branches=mysql_query("SELECT * FROM branch_categories");
	  while( $branch_fet=mysql_fetch_array($branches))
				{
	   
             
	  echo "<td>".$branch_fet['displayname']."</td>";
				
				}
echo "</tr><tr>";
	            $branches=mysql_query("SELECT * FROM branch_categories");
				  while( $event_fet=mysql_fetch_array($branches))
				{
             
	  echo "<td>".mysql_num_rows(mysql_query("SELECT * FROM events WHERE visibility='1' && branch='".$event_fet['branch']."'"))."</td>";
				
				}
	   
	  ?></tr>
		
		</table></center>
		<br><br>



		
		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Organizers</th>
		<tr><?php
			$branches=mysql_query("SELECT * FROM branch_categories");
	  while( $branch_fet=mysql_fetch_array($branches))
				{
	   
             
	  echo "<td>".$branch_fet['displayname']."</td>";
				
				}
echo "</tr><tr>";
	            $branches=mysql_query("SELECT * FROM branch_categories");
				  while( $event_fet=mysql_fetch_array($branches))
				{
             
	  echo "<td>".mysql_num_rows(mysql_query("SELECT * FROM organizers WHERE role='Organizer' && branch='".$event_fet['branch']."'"))."</td>";
				
				}
	   
	  ?></tr>
		
		</table></center>
		<br><br>


<?php
	      $settings=mysql_query("SELECT * FROM site_settings");
	   $settings_count=mysql_num_rows($settings);     
	   ?>
		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $settings_count;?>">Website Settings</th>
		<tr><?php while($branch_cat=mysql_fetch_array($settings)){ echo "<td>".$branch_cat['function']."</td>"; }?></tr>
		
		<tr><?php 
			$settings=mysql_query("SELECT * FROM site_settings"); 
		while($branch_cat=mysql_fetch_array($settings)){ echo "<td>".$branch_cat['value']."</td>"; }?></tr>
		
		</table></center>
		<br><br>






		
		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">User Registraions</th>
		<tr><?php
			$branches=mysql_query("SELECT * FROM year_categories");
	  while( $branch_fet=mysql_fetch_array($branches))
				{
	   
             
	  echo "<td>".$branch_fet['year']."</td>";
				
				}
echo "</tr><tr>";
	            $branches=mysql_query("SELECT * FROM year_categories");
				  while( $event_fet=mysql_fetch_array($branches))
				{
             
	  echo "<td>".mysql_num_rows(mysql_query("SELECT * FROM users WHERE year='".$event_fet['year']."'"))."</td>";
				
				}
	   
	  ?></tr>
		
		</table></center>
		<br><br>





		<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Users Paid</th>
		<tr><?php
			$branches=mysql_query("SELECT * FROM year_categories");
	  while( $branch_fet=mysql_fetch_array($branches))
				{
	   
             
	  echo "<td>".$branch_fet['year']."</td>";
				
				}
echo "</tr><tr>";
	            $branches=mysql_query("SELECT * FROM year_categories");
				  while( $event_fet=mysql_fetch_array($branches))
				{
             
	  echo "<td>".mysql_num_rows(mysql_query("SELECT * FROM users WHERE year='".$event_fet['year']."' && paid='yes'"))."</td>";
				
				}
	   
	  ?></tr>
		
		</table></center>
		<br><br>




<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Notifications</th>



		<tr><td>Total Notices</td><td>Active Notices</td><td>Deleted Notices</td><td>Webteam Posted(Active)</td><td>Organizers Posted(Active)</td><td>Webteam Posted(Deleted)</td><td>Organizers Posted(Deleted)</td></tr>
		<tr>
		<td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications"));?></td>
		<td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='1'"));?></td>
        <td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='0'"));?></td>
		<td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='1' && role='Webteam'"));?></td>
        <td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='1' && role='Organizer'"));?></td>
			<td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='0' && role='Webteam'"));?></td>
        <td><?php echo mysql_num_rows(mysql_query("SELECT * FROM notifications WHERE visibility='0' && role='Organizer'"));?></td>

		</tr>
				
			
		
		</table></center>
		<br><br>



<center><table id="customers" style="width:100%;">
		<th colspan="<?php echo $branches_count;?>">Events having Upload option</th>
		<tr><td style='font-weight:bold;'>Event</td><td style='font-weight:bold;'>Uploads state</td><td style='font-weight:bold;'>Uploads</td><td style='font-weight:bold;'>Activity By</td><td style='font-weight:bold;'>Activity time</td></tr>
	<?php $upls=mysql_query("SELECT * FROM abstract_uploads_settings WHERE visibility='1'");
	while($upl_cat=mysql_fetch_array($upls)){ echo "	<tr><td>".$upl_cat['branch']." ~ ".$upl_cat['eventname']."</td><td> <i>".$upl_cat['uploadsopen']."</i></td><td>".$upl_cat['uploads']."</td><td title='".$upl_cat['added_by_name']."'>".$upl_cat['added_by_id']."</td><td>".$upl_cat['added_by_time']."</td></tr>"; }?>
		
		</table></center>
		<br><br>





		<?php
			}
			
			?>
    		
    		</div><!-- end div .box-content -->
		
    	</div><!-- end div .box-in -->
    </div><!-- end div .box-out -->
   
    	<center><p style='color:black;'>&copy;Prathap Puppala,N130950</p></center>
	</div>
</div><!-- end div #content -->
<!-- END CONTENT -->
</html>
