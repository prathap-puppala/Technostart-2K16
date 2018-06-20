<?php
session_start();
require_once("site-settings.php");

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
//preventing session hijacking
if(trim($_SESSION['web'])!=$sessionweb){if($isblocked<1){mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Session Hijacking')");}echo "<script>window.location='error.php';</script>";}

if($isloggedin==false){header("location:index.php");}
$isregopen="on";
$use_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
?>
<link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
								<center>
									
 <div style="margin-left:900px;">
		<table cellspacing="0" style="width:700px;" cellpadding="0">
			<tr>
				<th>Sno</th>
				<th>Event</th>
				<th>Team ID</th>
				<th>Teammates</th>
				<th>Reg Done by</th>
			</tr>
			<?php
			$e=mysql_query("SELECT * FROM event_registrations");
			$sno=0;
			while($q=mysql_fetch_array($e))
			{
			$slp=array();
			$slp=explode("~",$q['ids']);
			if(in_array($stuid,$slp))
			{
				$sno++;
			echo "<tr style='color:black;'><td>".$sno."</td><td>".$q['displayname']." - ".$q['eventname']."</td><td>".$q['teamid']."</td><td>".$q['ids']."</td><td>".$q['regdone_by']."</td></tr>";
			}	
			}
			
			?>
																							
		</table></div>
 
							</center>
<?php } ?>
