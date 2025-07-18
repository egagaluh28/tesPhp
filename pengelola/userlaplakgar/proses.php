<?php
session_start();

include "../../application/connect.php";

	date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
	
	$tgl_sekarang = date("Y-m-d");
	$jam_sekarang = date("H:i:s");
	
	$saiki= date("ymdhis");
	$aidi = $saiki.''.$_POST['kdkotama'];

		$data="select count(usernamelaplakgar) as jml from user where usernamelaplakgar='$_POST[usernamelaplakgar]'";
		$hasil=mysql_query($data);
		$row = mysql_fetch_array($hasil);

if ($_GET[aksi]=='simpan'){

		if ($row['jml']>=1)  {
		echo "<script> alert('Username sudah ada....cari username yang lain'); </script>";  
		?><script language="JavaScript">;
        document.location='<? print "../.././media.php?module=inputuser"; ?>'</script><?

		} else {
		
		$pass=md5($_POST[passwordlaplakgar]);
        mysql_query("INSERT INTO user(aidi_aidi_aidi, usernamelaplakgar,
                                passwordlaplakgar,
                                kdkotama, 
								kdsatker,
								nama_lengkap,
								telp,
								level,
								kdtingkat,
								tanggal,
								jam)
	                       VALUES('$aidi','$_POST[usernamelaplakgar]',
                                '$pass', 
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[nama_lengkap]',
								'$_POST[telp]',
								'$_POST[level]',
								'$_POST[kdtingkat]',
								'$tgl_sekarang]',
								'$jam_sekarang')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=user"; ?>'</script><?		
		}	
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM user WHERE aidi_aidi_aidi='$_GET[aidi_aidi_aidi]'");;
		
	?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=user"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
		 // Apabila password tidak diubah
		    if (empty($_POST[passwordlaplakgar])) {
			mysql_query("UPDATE user SET usernamelaplakgar      = '$_POST[usernamelaplakgar]',
												  kdkotama		= '$_POST[kdkotama]',
												  kdsatker		= '$_POST[kdsatker]',
												  nama_lengkap  = '$_POST[nama_lengkap]',
												  telp			= '$_POST[telp]',
												  level			= '$_POST[level]',
												  kdtingkat		= '$_POST[kdtingkat]',
												  tanggal       = '$tgl_sekarang',
												  jam			= '$jam_sekarang'
								   WHERE aidi_aidi_aidi            = '$_POST[id]'");
		  
		  // Apabila password diubah
		    } else {
			$pass=md5($_POST[passwordlaplakgar]);
			mysql_query("UPDATE user SET usernamelaplakgar = '$_POST[usernamelaplakgar]',
												  passwordlaplakgar = '$pass',
												  kdkotama			= '$_POST[kdkotama]',
												  kdsatker			= '$_POST[kdsatker]',
												  nama_lengkap  	= '$_POST[nama_lengkap]',
												  telp			= '$_POST[telp]',
												  level			= '$_POST[level]',
												  kdtingkat		= '$_POST[kdtingkat]',
												  tanggal       	= '$tgl_sekarang',
												  jam				= '$jam_sekarang'
								    WHERE aidi_aidi_aidi            = '$_POST[id]'");
			}
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=user"; ?>'</script><?
	
	} else if ($_GET[aksi]=='gantiuser') {
		
		   if (empty($_POST[passwordlaplakgar])) {
		   mysql_query("UPDATE user SET 
												  nama_lengkap  = '$_POST[nama_lengkap]',
												  telp			= '$_POST[telp]',
												  tanggal       = '$tgl_sekarang',
												  jam			= '$jam_sekarang'
								    WHERE aidi_aidi_aidi            = '$_POST[id]'");	 
			} else {
			$pass=md5($_POST[passwordlaplakgar]);					   
			mysql_query("UPDATE user SET 
												  passwordlaplakgar = '$pass',
												  nama_lengkap  = '$_POST[nama_lengkap]',
												  telp			= '$_POST[telp]',
												  tanggal       = '$tgl_sekarang',
												  jam			= '$jam_sekarang'
								   WHERE aidi_aidi_aidi            = '$_POST[id]'");
		  
			}
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=gantiuserberhasil"; ?>'</script><?
	
	
		 
} else { print "asjku&8jhgklk"; }		
?>     
