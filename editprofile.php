<?php
session_start();
require_once("site-settings.php");
//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
//preventing session hijacking
if(trim($_SESSION['web'])!=$sessionweb){if($isblocked<1){mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Session Hijacking')");}echo "<script>window.location='error.php';</script>";}
}
if($isloggedin==false){header("location:index");}
if(1==1)
{

$use_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
?>
 <link rel="stylesheet" type="text/css" href="css/loginform.css" />
   
			<section class="main">>
				<form class="form-2" action="javascript:void(0);" onsubmit="doproupdate()" method="post">
					<h1><span class="log-in">EDIT PROFILE</span></h1><img src="img/closelabel.gif" style="float:right;margin-top:-30px;cursor:pointer;" onclick="prathap_hide_popup_boxes()">
	               <table border="0" width="100%">
					   <tr><td>
			
						<label for="mobnum"><i class="icon-user"></i>Mobile Number</label>
						<input type="text" name="mobnum" id="mobnum" placeholder="ex: 9010932254" value="<?php echo $use_fet['phone'];?>">
			</td></tr>
				<tr><td colspan="1" style="text-align:center;">
						<center><span id='loader' style="display:none;"><img src='img/loading8.gif'></span>
						<input type="submit" name="submit" value="Update" style="float:right;"></center>
					</td></tr>
					</table>
				</form>​​
			</section>
	
<?php } else{
echo "<h1 style='color:red;'>Logins are disabled.</h1>"; } ?>
