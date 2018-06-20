$(document).ready(function() 
{	
	$("#prathap_pop_up_background").click(function()
	{
		$("#prathap_notice_box").hide(); 
		$("#prathap_pop_up_background").fadeOut("slow");
	});
});

function shwfrm(frm)
{
	$("#prathap_pop_up_background").css({
		"opacity": "0.9"
	});
	$("#prathap_notice_box").html("<center><br><br><br><br><img src='img/loading14.gif'></center>").load(frm+".php").slideDown();
	$("#prathap_pop_up_background").fadeIn("slow");
	$("#prathap_notice_box").fadeIn('fast');

}




function prathap_hide_popup_boxes()
{
	$("#prathap_notice_box").hide(); 
	$("#prathap_pop_up_background").fadeOut("slow");
}

function pick(field)
{
var prathap=document.getElementById(field).value;
return prathap;	
}

function notify(msg,cat,time,modal)
{
	
ulak({"text":msg,"type":cat,"timeout":time,"modal":modal})
}

function dofocus(field){$("#"+field).focus();}

function doreg(fee)
{
var stuid=pick("stuid");
var passwd=pick("passwd");
var cpasswd=pick("cpasswd");
var mobnum=pick("mobnum");
var seckey=pick("seckey");
var cseckey=pick("cseckey");
var captcha=pick("captcha");

if(stuid=="" || stuid==undefined)
{
notify("Please Enter Valid University ID","error","2000","true");
dofocus("stuid");
return false;
}
else if(mobnum=="" || mobnum.length!=10 || isNaN(mobnum)==true || mobnum==undefined)
{
notify("Please Enter Valid Mobile Number","error","2000","true");
dofocus("mobnum");
return false;
}
else if(passwd=="" || passwd==undefined)
{
notify("Please Enter Password","error","2000","true");
dofocus("passwd");
return false;
}
else if(cpasswd=="" || cpasswd==undefined)
{
notify("Please Enter Confirm Password","error","2000","true");
dofocus("cpasswd");
return false;
}
else if(passwd!=cpasswd)
{
notify("Password and Confirm Passwords are not same","error","2000","true");
dofocus("cpasswd");
return false;
}
else if(seckey=="" || seckey==undefined)
{
notify("Please Enter Security Key","error","2000","true");
dofocus("seckey");
return false;
}
else if(cseckey=="" || cseckey==undefined)
{
notify("Please Enter Confirm Security Key","error","2000","true");
dofocus("cseckey");
return false;
}
else if(seckey!=cseckey)
{
notify("Security and Confirm Security key are not same","error","2000","true");
dofocus("cseckey");
return false;
}
else if(captcha==undefined || captcha=="")
{
notify("Please Enter captcha code","error","2000","true");
dofocus("captcha");
return false;
}
else
{
//confirmation
if(confirm("Are you sure to Register?")){		
paymentagree="agreed";	
var datastring="stuid="+stuid+"&passwd="+passwd+"&cpasswd="+cpasswd+"&mobnum="+mobnum+"&seckey="+seckey+"&cseckey="+cseckey+"&captcha="+captcha;
$.ajax({
type:"POST",
url:"register-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){ $("#loader").hide();if(data.indexOf("success")!=-1){notify("Registered Successfully....</big>","success","3500","true");shwfrm('login');}else{notify(data,"error","2000","true");}}
});
                        } else {
                           return false;
                        }
                
 }
}

function dolog()
{
var stuid=pick("stuid");
var passwd=pick("passwd");
var captcha=pick("captcha");

if(stuid==undefined || stuid=="")
{
notify("Please Enter University ID","error","2000","true");
dofocus("stuid");
return false;
}
else if(passwd==undefined || passwd=="")
{
notify("Please Enter Password","error","2000","true");
dofocus("passwd");
return false;
}
else if(captcha==undefined || captcha=="")
{
notify("Please Enter captcha code","error","2000","true");
dofocus("captcha");
return false;
}
else
{

var datastring="stuid="+stuid+"&passwd="+passwd+"&captcha="+captcha;
$.ajax({
type:"POST",
url:"login-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("success")!=-1){notify("Loggedin Successfully....Redirecting....","success","3500","true");setTimeout(function(){location.reload();},2000);}else{notify(data,"error","2000","true");}}
});	
}
}


function doforgot()
{
var stuid=pick("stuid");
var seckey=pick("seckey");
var mobnum=pick("mobnum");
var passwd=pick("passwd");
var cpasswd=pick("cpasswd");

if(stuid==undefined || stuid=="")
{
notify("Please Enter University ID","error","2000","true");
dofocus("stuid");
return false;
}
else if(seckey==undefined || seckey=="")
{
notify("Please Enter Security Key","error","2000","true");
dofocus("seckey");
return false;
}
else if(mobnum==undefined || mobnum=="" ||isNaN(mobnum)==true)
{
notify("Please Enter Valid Mobile Number","error","2000","true");
dofocus("mobnum");
return false;
}
else if(passwd==undefined || passwd=="")
{
notify("Please Enter New Password","error","2000","true");
dofocus("passwd");
return false;
}

else if(cpasswd==undefined || cpasswd=="")
{
notify("Please Enter Confirm Password","error","2000","true");
dofocus("cpasswd");
return false;
}
else if(passwd!=cpasswd)
{
notify("New Password and Confirm Passwords are not same","error","2000","true");
dofocus("cpasswd");
return false;
}
else
{

var datastring="stuid="+stuid+"&seckey="+seckey+"&mobnum="+mobnum+"&passwd="+passwd+"&cpasswd="+cpasswd;
$.ajax({
type:"POST",
url:"forgot-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("success")!=-1){notify("Changed Successfully....","success","3500","true");setTimeout(function(){shwfrm('login');},2000);}else{notify(data,"error","2000","true");}}
});	
}
}

function doforgottzid()
{
var stuid=pick("stuid");
var seckey=pick("seckey");
var mobnum=pick("mobnum");

if(stuid==undefined || stuid=="")
{
notify("Please Enter University ID","error","2000","true");
dofocus("stuid");
return false;
}
else if(seckey==undefined || seckey=="")
{
notify("Please Enter Security Key","error","2000","true");
dofocus("seckey");
return false;
}
else if(mobnum==undefined || mobnum=="" || isNaN(mobnum)==true)
{
notify("Please Enter Valid Mobile Number","error","2000","true");
dofocus("mobnum");
return false;
}
else
{

var datastring="stuid="+stuid+"&seckey="+seckey+"&mobnum="+mobnum;
$.ajax({
type:"POST",
url:"forgottzid-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){ $("#loader").hide();if(data.indexOf("TZN")!=-1){notify("Your TeckziteID is "+data+"","success","3500","true");$("#Regg").html("<table id='customers' style='background:#fff;font-size:18px;'><tr><th colspan='2'></th></tr><tr class='alt'><td>Teckzite ID</td><td><mark>"+data+"</mark></td></tr><tr><td colspan='2'><center><img src='img/closelabel.gif' style='cursor:pointer;' onclick='prathap_hide_popup_boxes()'></center></td></tr></table>");}else{notify(data,"error","2000","true");}}
});	
}
}


function regclosed()
{
notify("Sorry!!!! Registrations are closed.","error","2000","true");
alertify.error("Registrations are Closed.");
}


function logclosed()
{
notify("Sorry!!!! Logins are disabled.","error","2000","true");
alertify.error("Logins are disabled.");
}

function loginrequired()
{
alertify.set({ delay: 8000 });
alertify.error("Please Login to Register to this Event");
}


function forgotclosed()
{
notify("Sorry!!!! Forgot Password Option is disabled.","error","2000","true");
alertify.error("Forgot is disabled.");
}

function shwtip(msg)
{
$("#keyinp").slideUp().html("<p class='blue_alert_box'>"+msg+"<a></a></p>").slideDown();	
}

function sendchatmsg(eid)
{
var chatmsg=pick("chatmsg");	
if(chatmsg.length<1 || chatmsg==undefined)
{
alertify.error("Please Enter Something to Send.");
}
else
{
var datastring="chatmsg="+chatmsg+"&eid="+eid;
$.ajax({
type:"POST",
url:"chat-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#nooo").html("<font color='blue'>Sending.....</font>");},
success:function(data){if(data.indexOf("sent")!=-1){$("#chatmsg").val('');updno();$("#nooo").html("<font color='yellow'>Sent</font>");setTimeout(function(){$("#nooo").html("<font color='white'>Chat with Organizer</font>");},5000);}else{alertify.error(data);}}
});		
}
}

function doproupdate()
{
var mobnum=pick("mobnum");	
if(mobnum==undefined || mobnum=="" || isNaN(mobnum)==true || mobnum.length!=10)
{

notify("Please Enter Valid Mobile Number.","error","2000","true");
}
else
{
var datastring="mobnum="+mobnum;
$.ajax({
type:"POST",
url:"editprofile-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("updated")!=-1){notify("Profile Successfully Updated...","success","2000","true");}else{notify(data,"error","2000","true");}}
});		
}
}


function dopassupdate()
{
var passwd=pick("passwd");	
var cpasswd=pick("cpasswd");	
if(passwd==undefined || passwd=="")
{

notify("Please Enter Password","error","2000","true");
}
else if(cpasswd==undefined || cpasswd=="")
{

notify("Please Enter Confirm Password","error","2000","true");
}
else if(passwd!=cpasswd)
{

notify("Password and  Confirm Password are not same","error","2000","true");
}
else
{
var datastring="passwd="+passwd+"&cpasswd="+cpasswd;
$.ajax({
type:"POST",
url:"changepass-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("updated")!=-1){notify("Password Successfully Updated...","success","2000","true");}else{notify(data,"error","2000","true");}}
});		
}
}
