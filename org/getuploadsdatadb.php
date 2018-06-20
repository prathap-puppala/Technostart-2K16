<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");

$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));

if(isset($_GET['eid']))
{
$eid=mysql_real_escape_string(strip_tags($_GET['eid']));
$evedata=mysql_query("SELECT * FROM events WHERE eid='".$eid."'");
$eve_set=mysql_fetch_array($evedata);

?>

  <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1> <?php echo $eve_set['branch']." - ".$eve_set['eventname'];?> Uploads data</h1></div>
    		<div class="box-content">

<center>
<table id="customers">
<th>Event</th><th>Student ID</th><th>Uploaded time</th><th>Action</th>
<?php
	$absdata=mysql_query("SELECT * FROM abstract_uploads WHERE eid='".$eid."'");
 while($abs_set=mysql_fetch_array($absdata))
	{
	 ?>
<tr><td><?php echo $abs_set['branch']." ~ ".$abs_set['eventname'];?></td><td><?php echo $abs_set['stuid'];?></td><td><?php echo $abs_set['time'];?><td><a href="../<?php echo $abs_set['filepath'];?>" target="_blank">Download</a></td></tr>
	 <?php
	}
	?>
</table>

</center></div></div></div>
			<?php
}
?>