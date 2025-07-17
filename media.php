<?php
session_start();
include "session.php";

include "application/connect.php";
include "library/indotgl.php";

  $satker = mysql_query("SELECT a.*, a1.nmkotama, b.nmsatkr FROM userlaplakgar a 
						left join t_kotam a1 on a.kdkotama=a1.kdkotama
						left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr 
						WHERE a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'");
 $row    = mysql_fetch_array($satker);
?>

<html>
<head>
<title>::: aplikasi Laplakgar 2024:::</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="library/style_form.css">
<link rel="stylesheet" href="library/allstyle.css">
<link rel="stylesheet" href="library/button.css">
<link rel="stylesheet" href="library/style_button_biru.css" type="text/css" media="screen" />
<link rel="stylesheet" href="library/balon.css" type="text/css" >
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />

</head>
<body>
<table width="100%" border: 1px solid white; >
  <tr>
	<td width="100" align="center"><img src="images/ad.png" height="60"></td>
	
	<td width="500" ><img src="images/duaempat.png" width="250"></td>
   
	<td height="85" align="right">	
			   <span id="timer1">Login Sbg : <?php print "$_SESSION[nama_lengkap]";?></span></td>
	<td width="110"><div class='codehim-tombol-biru'>   			
	&nbsp;&nbsp;&nbsp;<a href="logout.php" style="text-decoration:none"><input  type="button" value="Logout"/></a>
	<div></td>		   
	
	<tr>
		<td colspan="4"><?php include "nav/pecahmenu.php"; ?></td>
	</tr>
	<tr>
		<td valign="top"  colspan="4" height="460"><?php include "main.php"; ?></td>
	</tr>
	
	<tr bgcolor="#205b1d">
		<td colspan="4" height="45" class="putih_text" align="center">Copyright @2024 by Disinfolahtad</td>
	</tr>
</table>	
</body>
</html>