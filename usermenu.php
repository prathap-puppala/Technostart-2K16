<?php
session_start();
require("site-settings.php");
if(isloggedin())
{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
.readers-list{line-height:18px;text-align:left;overflow:hidden;_zoom:1;width:400px;margin:20px auto;}
.readers-list li{width:175px;float:left;}
.readers-list a,.readers-list a:hover strong{background-color:#f2f2f2;background-image:-webkit-linear-gradient(#f8f8f8,#f2f2f2);background-image:-moz-linear-gradient(#f8f8f8,#f2f2f2);background-image:-ms-linear-gradient(#f8f8f8,#f2f2f2);background-image:-o-linear-gradient(#f8f8f8,#f2f2f2);background-image:linear-gradient(#f8f8f8,#f2f2f2)}
.readers-list a{font-size:12px;position:relative;display:block;height:36px;margin:4px;padding:4px 4px 4px 44px;color:#999;overflow:hidden;border:#ccc 1px solid;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;-webkit-box-shadow:#eee 0 0 2px;-moz-box-shadow:#eee 0 0 2px;box-shadow:#eee 0 0 2px}
.readers-list img,.readers-list em,.readers-list strong{-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-ms-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out}
.readers-list img{width:36px;height:36px;float:left;margin:0 8px 0 -40px;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}
.readers-list em{color:#666;font-style:normal;margin-right:10px}
.readers-list strong{color:#ddd;width:40px;text-align:right;position:absolute;right:6px;top:4px;font-weight:bold;font-size:14px;line-height:16px}
.readers-list a:hover{text-decoration:none;border-color:#bbb;-webkit-box-shadow:#ccc 0 0 2px;-moz-box-shadow:#ccc 0 0 2px;box-shadow:#ccc 0 0 2px;background-color:#fff;background-image:none}
.readers-list a:hover img{opacity:.6;margin-left:0}
.readers-list a:hover em{color:#EE8B17;line-height:36px;font-weight:bold}
.readers-list a:hover strong{color:#EE8B17;right:125px;top:0;text-align:center;border-right:#ccc 1px solid;height:44px;line-height:40px}
</style>
<div style="">
<ul class="readers-list">
<li><a style="cursor:pointer;" onclick="shwfrm('editprofile')"><img alt="Edit Profile" src="images/01.gif" class="" height="36" width="36"><em>Edit Profile</em></a></li>
<li><a style="cursor:pointer;" onclick="shwfrm('changepass')"><img alt="Change Password" src="images/02.gif" class="avatar avatar-36 photo" height="36" width="36"><em>Change Password</em></a></li>
<li><a style="cursor:pointer;" onclick="shwfrm('adminmsgs')"><img alt="Admin Messages" src="images/03.gif" class="avatar avatar-36 photo" height="36" width="36"><em>Messages</em></a></li>
<li><a style="cursor:pointer;" onclick="shwfrm('regdoneeve')"><img alt="Registered Events" src="images/04.gif" class="avatar avatar-36 photo" height="36" width="36"><em>Registered Events</em></a></li>
</ul>
<center><img src="img/closelabel.gif" style="cursor:pointer;" onClick="prathap_hide_popup_boxes();"></center>
</div>
<?php } ?>
