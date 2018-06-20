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
}
if($isloggedin==true){header("location:index");}
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Forgot Password'"));
$isregopen=$isreg['value'];
if($isregopen=='on')
{
?>
 <link rel="stylesheet" type="text/css" href="css/loginform.css" />
   
			<section class="main" id="Regg">
				<form class="form-2" action="javascript:void(0);" onsubmit="doforgottzid()" method="post">
					<h1><span class="log-in">FORGOT TECKZITE ID</span></h1><img src="img/closelabel.gif" style="float:right;margin-top:-30px;cursor:pointer;" onclick="prathap_hide_popup_boxes()">
	               <table border="0" width="100%">
					   <tr><td>
			
						<label for="stuid"><i class="icon-user"></i>University ID</label>
						<input type="text" name="stuid" id="stuid" placeholder="ex: N130950">
			</td>
				<td style="padding-left:30px;padding-right:20px;">
			<label for="mobnum"><i class="icon-phone"></i>Mobile</label>
						<input type="text" name="mobnum" id="mobnum" placeholder="ex: 9010932254">
			</td></tr>
			 <tr><td>
						<label for="seckey"><i class="icon-user"></i>Enter Sec Key</label>
						<input type="password" name="seckey" id="seckey" placeholder="ex: *****">
			</td>
				</tr>
			<tr><td>
			
						<span>Captcha <img src="captcha.php" style="float:right;"></span>
			</td>
					<td style="padding-left:30px;padding-right:20px;">
						<input type="text" id="captcha" placeholder="">
			</td></tr>
				<tr><td colspan="2" style="text-align:center;">
						<center><span id='loader' style="display:none;"><img src='img/loading8.gif'></span>
						<input type="submit" name="submit" value="Recover" style="float:right;"></center>
					</td></tr>
					<tr><td colspan="2"><hr><a style="cursor:pointer;color:green;font-size:13px;" onclick="shwfrm('register')">Register</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor:pointer;color:magenta;font-size:13px;" onclick="shwfrm('forgot')">Forgot Password?</a>&nbsp;&nbsp;<a style="cursor:pointer;color:green;float:right;font-size:13px;" onclick="shwfrm('login')">Login</a></td></tr>
					<tr><td colspan="2"><hr><marquee scrolldelay="150" style="color:blue;">If captcha doesn't loaded correctly,reopen Register Box.</marquee></td></tr>
					<tr><td colspan="2"><hr><center>For TZ ID Problems Contact <b>Prathap (9010932254)</b></center></td></tr>
					</table>
				</form>​​
			</section>
	
<?php } else{?>
<img src='img/regclosed.png'>
<?php } ?>
