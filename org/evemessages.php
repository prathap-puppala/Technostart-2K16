<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("../site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));

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
    <div class="box-out">
    	<div class="box-in">
    		<div class="box-head"><h1>Event Messages</h1></div>
    		<div class="box-content">
			<?php
			if($getuserdata['role']!="Webteam")
				{
if(1!=1)
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  Webteam Stopped Editing Of events...Please Contact webteam<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
    			</div>
				<center><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"></center>
				<?php
}
else
{
	?>
		<div class="table">
    				<form action="#" method="post">
    					<table>
    						<thead>
    							<tr>
    								<td><div>Event Name</div></td>

    								<td><div>ID Number</div></td>
    								<td><div>Message</div></td>
									<td><div>Action</div></td>
    							</tr>
    						</thead>
    						<tbody>	<?php
										
	if($getuserdata['role']!="Webteam")
				{
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++)
	{
				
	  $settings=mysql_query("SELECT * FROM partoorgmsg WHERE eid='".$user_eve_data[$i]."' && seen='0'");
  while($branch_cat=mysql_fetch_array($settings)){
		 $b=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE  eid='".$branch_cat['eid']."'"));
			  $sno=$branch_cat['sno'];
			   echo "<tr><td class='id".$sno."'><div class='even'>".$b['eventname']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['sender']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['subject']."</div></td><td class='id".$sno."'><div class='even'><a   style='cursor:pointer;' onclick='managepatrqueries(".$sno.",".$branch_cat['eid'].")'>Reply</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   style='cursor:pointer;' onclick='skippatrqueries(".$sno.",".$branch_cat['eid'].")'>Skip</a></div></td></tr>"; 
		   
		
		 }
		   }
				}
				else
	{
			$sno=0; 
	  $settings=mysql_query("SELECT * FROM partoorgmsg WHERE seen='0'");
	
		
		  while($branch_cat=mysql_fetch_array($settings)){
			 $b=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE  eid='".$branch_cat['eid']."'"));
			  $sno=$branch_cat['sno'];
			   echo "<tr><td class='id".$sno."'><div class='even'>".$b['eventname']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['sender']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['subject']."</div></td><td class='id".$sno."'><div class='even'><a   style='cursor:pointer;' onclick='managepatrqueries(".$sno.",".$branch_cat['eid'].")'>Reply</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   style='cursor:pointer;' onclick='skippatrqueries(".$sno.",".$branch_cat['eid'].")'>Skip</a></div></td></tr>"; 
		   
			
			 }
		   
	}?>
		
	
								</tbody>
							</table>
							</form>
							</div>
							<?php
}
				}
				else
				{
					?>
					<div class="table">
    				<form action="#" method="post">
    					<table>
    						<thead>
    							<tr>
    								<td><div>Event Name</div></td>

    								<td><div>ID Number</div></td>
    								<td><div>Message</div></td>
									<td><div>Action</div></td>
    							</tr>
    						</thead>
    						<tbody>	<?php
										
	if($getuserdata['role']!="Webteam")
				{
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++)
	{
				
	  $settings=mysql_query("SELECT * FROM partoorgmsg WHERE eid='".$user_eve_data[$i]."' && seen='0'");
  while($branch_cat=mysql_fetch_array($settings)){
			  
			   $b=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE  eid='".$branch_cat['eid']."'"));
			  $sno=$branch_cat['sno'];
			   echo "<tr><td class='id".$sno."'><div class='even'>".$b['eventname']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['sender']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['subject']."</div></td><td class='id".$sno."'><div class='even'><a   style='cursor:pointer;' onclick='managepatrqueries(".$sno.",".$branch_cat['eid'].")'>Reply</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   style='cursor:pointer;' onclick='skippatrqueries(".$sno.",".$branch_cat['eid'].")'>Skip</a></div></td></tr>"; 
		   
			  }
		   }
				}
				else
	{
	  $settings=mysql_query("SELECT * FROM partoorgmsg WHERE seen='0'");
	
		
		  while($branch_cat=mysql_fetch_array($settings)){
			  $b=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE  eid='".$branch_cat['eid']."'"));
			  $sno=$branch_cat['sno'];
			   echo "<tr><td class='id".$sno."'><div class='even'>".$b['eventname']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['sender']."</div></td><td class='id".$sno."'><div class='even'>".$branch_cat['subject']."</div></td><td class='id".$sno."'><div class='even'><a   style='cursor:pointer;' onclick='managepatrqueries(".$sno.",".$branch_cat['eid'].")'>Reply</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   style='cursor:pointer;' onclick='skippatrqueries(".$sno.",".$branch_cat['eid'].")'>Skip</a></div></td></tr>"; 
		   }
		   
	}?>
		
	
								</tbody>
							</table>
							</form>
							</div>
							<?php
				}
?>
</div></div></div></div>
