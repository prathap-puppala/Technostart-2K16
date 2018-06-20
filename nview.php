<?php
session_start();
require_once("site-settings.php");

if(isset($_GET['nid']) && !empty($_GET['nid']))
{
$nid=mysql_real_escape_string(trim(strip_tags(htmlspecialchars($_GET['nid']))));
$nid=str_replace(".php","",$nid);
$query=mysql_query("SELECT * FROM notifications WHERE nid='$nid'");
if(mysql_num_rows($query)>=1){
mysql_query("UPDATE notifications SET views=views+1 WHERE nid='$nid'");
$notif=mysql_fetch_array($query);
$notetoid=$notif['eid'];

if($notetoid!="ALL"){
$noteto=mysql_query("SELECT * FROM events WHERE eid='$notetoid'");
$noot=mysql_fetch_array($noteto);
$noticeto=$noot['eventname'];
$noticebranch=$noot['branch'];
}
?>
<style>
.sd{
	border: solid 1px #000;
	background-color: #fff;
	box-shadow: 0 0 20px #000;
	-moz-box-shadow: 0 0 20px #000;
	-webkit-box-shadow: 0 0 20px #000;
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	top: 20%;
	}</style>
<center><table id="customers" class="sd" width="400px" style="font-size:14px;margin-left:30%;">
<tr><th colspan="3"  style="text-align:center;max-width:400px;font-size:16px;"><?php echo $notif['title'];?></th></tr>
<tr class="alt"><td>Notice ID: <big><?php echo $nid;?></big></td><td>Posted :<big> <?php echo $notif['time'];?></big></td><td>Visits :<mark><big> <?php echo $notif['views'];?></big></mark></td></tr>
<tr style="background:#fff;color:black;text-align:center;width:100%;border:1px dotted #999999;word-wrap:break-word;word-break: break-all;"><td colspan="3"><br><div style="height:250px;overflow-x:hidden;"><?php echo $notif['description'];?></div><br><span style="text-decoration:none;text-align:left;"><?php if($notif['attachments']==""){}else{echo $notif['attachments'];}?></span><br><br></td></tr>
<tr class="alt"><td>Sent to: <big><?php if($notetoid=="ALL")
					{echo "ALL";} else {echo $noticebranch." ~ ".$noticeto;} ?> </big></td><td>Sent by: <big><?php echo $notif['sd'];?></td><td><a href="javascript:void(0);" onClick="prathap_hide_popup_boxes();"><img src="img/closelabel.gif"></a></td></tr>
</table>
</center>
<?php
}	
}
?>
