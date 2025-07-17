<?php
session_start();

include "../application/connect.php";

	date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
	
	$tgl_sekarang = date("Y-m-d");
	$jam_sekarang = date("H:i:s");

		$idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('YmdHis');
 
		$id_validitas = $saiki."".$idx."".$idx1;

if ($_GET[aksi]=='simpan'){

        mysql_query("INSERT INTO validitas(
								id_validitas,
                                kdkotama, 
								kdsatker,
								thang,
								b01,b02,b03,b04,b05,b06,b07,b08,b09,b10,b11,b12,tanggal,jam)
	                       VALUES('$id_validitas', 
								  '$_POST[kdkotama]',
								  '$_POST[kdsatker]',
								  '$_POST[thang]',
								  '$_POST[b01]',
								  '$_POST[b02]',
								  '$_POST[b03]',
								  '$_POST[b04]',
								  '$_POST[b05]',
								  '$_POST[b06]',
								  '$_POST[b07]',
								  '$_POST[b08]',
								  '$_POST[b09]',
								  '$_POST[b10]',
								  '$_POST[b11]',
								  '$_POST[b12]',
								  '$tgl_sekarang',
								  '$tgl_sekarang')");
				
		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=validitassatker"; ?>'</script><?		
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM validitas WHERE id_validitas='$_GET[id_validitas]'");;
		
	?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitassatker"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
		
			mysql_query("UPDATE validitas SET 	  thang = '$_POST[thang]',
												  b01	= '$_POST[b01]',
												  b02	= '$_POST[b02]',
												  b03	= '$_POST[b03]',
												  b04	= '$_POST[b04]',
												  b05	= '$_POST[b05]',
												  b06	= '$_POST[b06]',
												  b07	= '$_POST[b07]',
												  b08	= '$_POST[b08]',
												  b09	= '$_POST[b09]',
												  b10	= '$_POST[b10]',
												  b11	= '$_POST[b11]',
												  b12	= '$_POST[b12]',
												  tanggal       	= '$tgl_sekarang',
												  jam				= '$jam_sekarang'
								   WHERE id_validitas            = '$_POST[id_validitas]'");
			
								   
			?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitassatker"; ?>'</script><?
	
	} else if ($_GET[aksi]=='ubah_utk_uo') {
		
		
			mysql_query("UPDATE validitas SET 	  thang = '$_POST[thang]',
												  b01	= '$_POST[b01]',
												  b02	= '$_POST[b02]',
												  b03	= '$_POST[b03]',
												  b04	= '$_POST[b04]',
												  b05	= '$_POST[b05]',
												  b06	= '$_POST[b06]',
												  b07	= '$_POST[b07]',
												  b08	= '$_POST[b08]',
												  b09	= '$_POST[b09]',
												  b10	= '$_POST[b10]',
												  b11	= '$_POST[b11]',
												  b12	= '$_POST[b12]',
												  tanggal       	= '$tgl_sekarang',
												  jam				= '$jam_sekarang'
								   WHERE id_validitas            = '$_POST[id_validitas]'");
			
								   
			?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitassatker_0cc175b9c0f1b6a831c399e269772661"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
