<?php
session_start();
if(isset($_SESSION['tz_organizer']))
{
	header("location:index.php");
}
require_once("../site-settings.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title><?php echo $title;?> Organizer</title>
<?php require_once("file_includes.php"); ?>
</head>
<body>
<div class="shadow-login"></div><!-- end div .shadow-login -->
<!-- BEGIN LOGIN -->
<div id="login">
    <p class="logo"><a href="" title="<?php echo $title;?> Organizer"><?php echo $title;?> Organizer</a></p>
    <div class="box-out">
    	<div class="box-in">
    		<div id="log_status"></div>
    		<form method="post" action="#" onsubmit="check_login()">
    			<fieldset>
    				<label>Username</label><input type="text" class="text" autofocus tabindex="1"  id="orgid" onkeyup="changetouppercase(this.id)" maxlength="7"/>
    				<label>Password <a href="javascript:alert('Please Contact Webteam for password....')" class="forget-password" >(Forgot password?)</a></label><input tabindex="2" type="password" class="text" id="orgpass" />
    				<center><input  class="submit" onclick="check_login()" value="SIGN IN" /></center>
    			</fieldset>
    		</form>
    	
    	</div><!-- end div .box-in -->
    	<center><p style='color:white;'>&copy;Prathap Puppala,N130950</p></center>
    </div><!-- end div .box-out -->
</div><!-- end div #login -->
<!-- END LOGIN -->

</body>
</html>
