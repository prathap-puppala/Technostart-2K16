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
    		<div class="box-head"><h1>Add a New Organiser to <?php echo $title;?></h1></div>
    		<div class="box-content">
			<?php
if(!isset($_SESSION['tz_webteam']))
{
?>
	  	<div class="notification error">
    				<div class="messages">Sorry!!!  This feature is available for Webteam only<div class="close"><img src="img/icon/close.png" alt="close" /></div></div>
    			</div>
				<center><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"><img src='img/hero.ico' width="80px"></center>
				<?php
}
else
{
	?>
	<div class="form">
	<form  method="post" enctype="multipart/form-data" id="orgadd">
	ORGANISER ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" id='orgid' placeholder="ex : N130950" class="text small" onkeyup="changetouppercase(this.id)" onblur="checkempty(this.id,'Organizer ID')"/><span id="orgid_error"></span><br>
    ORGANISER NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" onkeyup="changetouppercase(this.id)" id='orgname' placeholder="ex : PUPPALA PRATHAP" class="text small"  onblur="checkempty(this.id,'Organizer Name')"/><span id="orgname_error"></span><br>


							BRANCH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:	<select id="orgbranch" name="branch" class="text" style="width:27%;">
    							<option value="">Choose</option>
    							<?php
		$branch_categories=mysql_query("SELECT * FROM branch_categories");
		while($branch=mysql_fetch_array($branch_categories))
	{
		echo "<option value='".$branch['branch']."'>".$branch['branch']."</option>";
	}
	?>
    		</select> <span id="branch_error"></span><br>




	GENDER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp; : <input type="radio" name="orggender" value="M"/>Male &nbsp; <input type="radio" name="orggender" value="F"/>Female <span id="gender_error"></span><br><br>

 ORGANISER PASSWD&nbsp;&nbsp;&nbsp;: <input type="text"  id='orgpass' placeholder="*******" class="text small"  onblur="checkempty(this.id,'Organizer Password')"/><span id="orgpass_error"></span><br>

  ORGANISER MOBILE&nbsp;&nbsp;&nbsp;: <input type="text"  id='orgmob' placeholder="ex : 9010932254" class="text small"  onblur="checkempty(this.id,'Organizer Mobile Number')"/><span id="orgmob_error"></span><br>

  EVENT ID's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text"  id='orgeveids' placeholder="*******" class="text small" onfocus="showbranchandevedata()"/><span id="orgeveids_error"></span><br>

        
		
	<Br><br><br>
	<input  id="orgsubbut" onclick="addorganiser()" value="ADD ORGANISER" class="submit" name="submit"/><span id="loadh"></span>
	</form>
							</div>
							<?php
}
?>
</div></div></div></div>
