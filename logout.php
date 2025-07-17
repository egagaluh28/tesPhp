<?php
include "application/connect.php";

//  date_default_timezone_set('Asia/Jakarta');
//  $jam = date("H:i:s");
  
  session_start();                        
 // mysql_query("UPDATE user_log SET jamout='$jam',
 //                             status='offline'
 // WHERE username = '$_SESSION[username]' AND jamout='logged' AND status='online'");
  session_destroy();
  header('location:./index.php');

?>

  