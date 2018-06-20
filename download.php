<?php
require_once("site-settings.php");
    $filename ="Teckzite2k16.apk"; //Get the fileid from the URL
   
    if(file_exists("apk/".$filename)){
      mysql_query("UPDATE appdownloads SET downloads=downloads+1");
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");
      header("Content-Disposition: attachment; filename=".$filename.";");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: ".filesize("apk/".$filename));
      @readfile("apk/".$filename);
 }
?>
