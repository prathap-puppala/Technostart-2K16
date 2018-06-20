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
$isregopen="on";
$use_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
?>

<link href="css3-gmail-style.css" media="all" rel="stylesheet" type="text/css" />
<style>
div#mail { width:90%; margin:20px auto; }
.mailinbox tbody tr td { background: #fafafa; }
.mailinbox tbody tr.unread td { background: #fff;  }
.mailinbox tbody tr.selected td { background:#FFFFD2; }
.mailinbox thead th, .mailinbox tfoot th { border: 1px solid #ccc; border-right: 0; }
.mailinbox tfoot th { border-bottom: 1px solid #ccc !important; }
.mailinbox a.title { font-weight: normal; text-decoration:none; }
.mailinbox tbody tr.unread a.title { font-weight: bold; }
.mailinbox td.star, .mailinbox td.attachment { text-align: center; }
.msgstar { 
	display: inline-block; width: 16px; height: 16px; background: url(images/unstar.png) no-repeat 0 0; 
	cursor: pointer; opacity: 0.5; 
}
.msgstar:hover { opacity: 1; }
.starred { background-image: url(images/star.png); opacity: 1; }



.table-bordered caption + thead tr:first-child th:first-child, .table-bordered caption + tbody tr:first-child td:first-child, .table-bordered colgroup + thead tr:first-child th:first-child, .table-bordered colgroup + tbody tr:first-child td:first-child { border-top-left-radius: 0; }

.table-bordered caption + thead tr:first-child th:last-child, .table-bordered caption + tbody tr:first-child td:last-child, .table-bordered colgroup + thead tr:first-child th:last-child, .table-bordered colgroup + tbody tr:first-child td:last-child { border-top-right-radius: 0; }

.table-bordered thead:first-child tr:first-child th:first-child, 
.table-bordered tbody:first-child tr:first-child td:first-child,
.table-bordered thead:first-child tr:first-child th:last-child, 
.table-bordered tbody:first-child tr:first-child td:last-child,
.table-bordered thead:last-child tr:last-child th:first-child, 
.table-bordered tbody:last-child tr:last-child td:first-child, 
.table-bordered tfoot:last-child tr:last-child td:first-child { -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0; }


.table { margin-bottom: 0; width:100%; font-size:14px }
.table th { background: #fcfcfc; }
.table tfoot th { border-bottom: 1px solid #ddd; }
.table th.aligncenter, .table td.aligncenter { text-align: center; }
.table tr { padding:5px; height:28px}
table td.center, table th.center { text-align: center; }

.clearall { clear: both; }

.mailinbox thead th, .mailinbox tfoot th {
	background: rgb(237,237,237);
	background: -moz-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(222,222,222,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(237,237,237,1)), color-stop(100%,rgba(222,222,222,1)));
	background: -webkit-linear-gradient(top, rgba(237,237,237,1) 0%,rgba(222,222,222,1) 100%);
	background: -o-linear-gradient(top, rgba(237,237,237,1) 0%,rgba(222,222,222,1) 100%);
	background: -ms-linear-gradient(top, rgba(237,237,237,1) 0%,rgba(222,222,222,1) 100%);
	background: linear-gradient(to bottom, rgba(237,237,237,1) 0%,rgba(222,222,222,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#dedede',GradientType=0 );
}
</style>
	<script>function shwmsg(ii){$(".pra").slideUp();$("#msg"+ii).slideDown();}</script>
									<center>
									
									<div id="mail" style="margin-left:30%;">

                           
        
                        
                        <table class="table table-bordered mailinbox" id="mai" style="width:800px;color:black;border-collapse:collapse; margin-top:10px;" border="0" cellpadding="5" cellspacing="3">

                            <thead>
                            <tr>
                                <th class="head1">sno</th>
                                <th class="head0">Subject</th>
                                <th class="head0">Time</th>
                            </tr>
                            </thead>
                            <tbody>
								<?php
							
								$qu=mysql_query("SELECT * FROM personal_msgs WHERE stuid='$stuid' ORDER BY sno DESC");
	                            $sno=mysql_num_rows($qu);						
								while($q=mysql_fetch_array($qu))
								{   
									$cls="read";
												        $new="";
			                                       $a=array("1","2","3","4","5");
                                                      $random_keys=array_rand($a,3);

				                      if($note['added_date']==date("Y-m-d")){$new="<img src='images/loaders/".$a[$random_keys[0]].".gif'>";}

									if($sno%2==0){$cls="unread";}
								?>
                                <tr class="<?php echo $cls;?>">
                                    <td><?php echo $sno;?></td>
                                    <td><a href="javascript:void(0)" onclick="shwmsg(<?php echo $sno;?>)" class="title"><?php echo $q['subject'];?></a><br><span id="msg<?php echo $sno;?>" class='pra' style='display:none;'><p><?php echo $q['description'];?></p></span></td>
                                  
                                    <td class="date"><?php echo $q['time'];?></td>
                                </tr>
                                   <?php $sno--;} ?>   
                                   <tr><td colspan="3"><br><center><img src="img/closelabel.gif" style="cursor:pointer;" onclick="prathap_hide_popup_boxes()"></center></td></tr> 
                            </tbody>
                        </table>             
 </div>
 
 
							</center>
			
<?php } ?>
