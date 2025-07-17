<?php
session_start();
include "application/connect.php";

$pass   = md5($_POST[passwordlaplakgar]);
$login  = mysql_query("SELECT a.*, b.kdwasgiat FROM userlaplakgar  a left join t_tingkat b on a.kdtingkat=b.kdtingkat WHERE a.usernamelaplakgar='$_POST[usernamelaplakgar]' AND a.passwordlaplakgar='$pass'");
$ketemu = mysql_num_rows($login);
$r      = mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
 

  $_SESSION['usernamelaplakgar']=$r['usernamelaplakgar'];
  $_SESSION['passwordlaplakgar']=$r['passwordlaplakgar'];
  $_SESSION['nama_lengkap']=$r['nama_lengkap'];
  $_SESSION['level']=$r['level'];
  $_SESSION['kdtingkat']=$r['kdtingkat'];
  $_SESSION['kdkotama']=$r['kdkotama'];
  $_SESSION['kdsatker']=$r['kdsatker'];
  $_SESSION['kdwasgiat']=$r['kdwasgiat'];
  $_SESSION['telp']=$r['telp'];
  header('location:redirect.php');  //fungsi autentikasi
}
else{
  ?><script language="JavaScript">alert('USERNAME ATAU PASSWORD SALAH');
document.location='index.php'</script><?
}
?>
