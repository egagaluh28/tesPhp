<?php
session_start();

include "../application/connect.php";

	date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
	
	$tgl_sekarang = date("Y-m-d");
	$jam_sekarang = date("H:i:s");

		$idx=$_POST['kdkotama'];
      

        $saiki   = date('ymdHis');
 
		$id_validitas = $saiki."".$idx;

if ($_GET[aksi]=='simpan'){

        mysql_query("INSERT INTO validitasktm(
								id_validitas,
                                kdkotama, 
								thang,
								b01,b02,b03,b04,b05,b06,b07,b08,b09,b10,b11,b12,
								e01,e02,e03,e04,e05,e06,e07,e08,e09,e10,e11,e12,
								tb01,tb02,tb03,tb04,tb05,tb06,tb07,tb08,tb09,tb10,tb11,tb12,
								te01,te02,te03,te04,te05,te06,te07,te08,te09,te10,te11,te12)
	                       VALUES('$id_validitas', 
								  '$_POST[kdkotama]',
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
								  '$_POST[e01]',
								  '$_POST[e02]',
								  '$_POST[e03]',
								  '$_POST[e04]',
								  '$_POST[e05]',
								  '$_POST[e06]',
								  '$_POST[e07]',
								  '$_POST[e08]',
								  '$_POST[e09]',
								  '$_POST[e10]',
								  '$_POST[e11]',
								  '$_POST[e12]',
								  '$_POST[tb01]',
								  '$_POST[tb02]',
								  '$_POST[tb03]',
								  '$_POST[tb04]',
								  '$_POST[tb05]',
								  '$_POST[tb06]',
								  '$_POST[tb07]',
								  '$_POST[tb08]',
								  '$_POST[tb09]',
								  '$_POST[tb10]',
								  '$_POST[tb11]',
								  '$_POST[tb12]',
								  '$_POST[te01]',
								  '$_POST[te02]',
								  '$_POST[te03]',
								  '$_POST[te04]',
								  '$_POST[te05]',
								  '$_POST[te06]',
								  '$_POST[te07]',
								  '$_POST[te08]',
								  '$_POST[te09]',
								  '$_POST[te10]',
								  '$_POST[te11]',
								  '$_POST[te12]')");
				
		
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM validitasktm WHERE id_validitas='$_GET[id_validitas]'");;
		
	?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitasktm_input"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
		
			mysql_query("UPDATE validitasktm SET 	  thang = '$_POST[thang]',
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
												  e01	= '$_POST[e01]',
												  e02	= '$_POST[e02]',
												  e03	= '$_POST[e03]',
												  e04	= '$_POST[e04]',
												  e05	= '$_POST[e05]',
												  e06	= '$_POST[e06]',
												  e07	= '$_POST[e07]',
												  e08	= '$_POST[e08]',
												  e09	= '$_POST[e09]',
												  e10	= '$_POST[e10]',
												  e11	= '$_POST[e11]',
												  e12	= '$_POST[e12]',
												  tb01	= '$_POST[tb01]',
												  tb02	= '$_POST[tb02]',
												  tb03	= '$_POST[tb03]',
												  tb04	= '$_POST[tb04]',
												  tb05	= '$_POST[tb05]',
												  tb06	= '$_POST[tb06]',
												  tb07	= '$_POST[tb07]',
												  tb08	= '$_POST[tb08]',
												  tb09	= '$_POST[tb09]',
												  tb10	= '$_POST[tb10]',
												  tb11	= '$_POST[tb11]',
												  tb12	= '$_POST[tb12]',
												  te01	= '$_POST[te01]',
												  te02	= '$_POST[te02]',
												  te03	= '$_POST[te03]',
												  te04	= '$_POST[te04]',
												  te05	= '$_POST[te05]',
												  te06	= '$_POST[te06]',
												  te07	= '$_POST[te07]',
												  te08	= '$_POST[te08]',
												  te09	= '$_POST[te09]',
												  te10	= '$_POST[te10]',
												  te11	= '$_POST[te11]',
												  te12	= '$_POST[te12]'
								   WHERE id_validitas   = '$_POST[id_validitas]'");
			
								   
			?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitasktm_input"; ?>'</script><?
	
	} else if ($_GET[aksi]=='ubah_utk_uo') {
		
		
			mysql_query("UPDATE validitasktm SET 	  thang = '$_POST[thang]',
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
												  e01	= '$_POST[e01]',
												  e02	= '$_POST[e02]',
												  e03	= '$_POST[e03]',
												  e04	= '$_POST[e04]',
												  e05	= '$_POST[e05]',
												  e06	= '$_POST[e06]',
												  e07	= '$_POST[e07]',
												  e08	= '$_POST[e08]',
												  e09	= '$_POST[e09]',
												  e10	= '$_POST[e10]',
												  e11	= '$_POST[e11]',
												  e12	= '$_POST[e12]',
												  tb01	= '$_POST[tb01]',
												  tb02	= '$_POST[tb02]',
												  tb03	= '$_POST[tb03]',
												  tb04	= '$_POST[tb04]',
												  tb05	= '$_POST[tb05]',
												  tb06	= '$_POST[tb06]',
												  tb07	= '$_POST[tb07]',
												  tb08	= '$_POST[tb08]',
												  tb09	= '$_POST[tb09]',
												  tb10	= '$_POST[tb10]',
												  tb11	= '$_POST[tb11]',
												  tb12	= '$_POST[tb12]',
												  te01	= '$_POST[te01]',
												  te02	= '$_POST[te02]',
												  te03	= '$_POST[te03]',
												  te04	= '$_POST[te04]',
												  te05	= '$_POST[te05]',
												  te06	= '$_POST[te06]',
												  te07	= '$_POST[te07]',
												  te08	= '$_POST[te08]',
												  te09	= '$_POST[te09]',
												  te10	= '$_POST[te10]',
												  te11	= '$_POST[te11]',
												  te12	= '$_POST[te12]'
								   WHERE id_validitas   = '$_POST[id_validitas]'");
			
								   
			?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=validitasktm_0cc175b9c0f1b6a831c399e269772661"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
