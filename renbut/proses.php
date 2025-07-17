<?php
session_start();
include "../application/connect.php";

     
if ($_GET[aksi]=='simpan'){
        $idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('ymdHis');
 
		$aidi = $saiki."".$idx1;


        mysql_query("INSERT INTO renbut(aidi,
                                kdkotama, 
								kdsatker,
								thang,
								kdakun,
								nmakun,
								jandes, gaji13,gaji14, ket)
	                       VALUES('$aidi',
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[thang]',
								'$_POST[kdakun]',
								'$_POST[nmakun]',
								'$_POST[jandes]',
								'$_POST[gaji13]',
								'$_POST[gaji14]',
								'$_POST[ket]')");
				
		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=renbut_gajitunkin&thang=$_POST[thang]"; ?>'</script><?		
			
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM renbut WHERE aidi='$_GET[aidi]'");;
		
	?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=renbut_gajitunkin&thang=$_GET[thang]"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
		
			mysql_query("UPDATE renbut SET 	 
								kdkotama 	='$_POST[kdkotama]',
								kdsatker	='$_POST[kdsatker]',
								thang		='$_POST[thang]',
								kdakun		='$_POST[kdakun]',
								nmakun		='$_POST[nmakun]',
								jandes		='$_POST[jandes]',
								gaji13		='$_POST[gaji13]',
								gaji14		='$_POST[gaji14]',
								ket			='$_POST[ket]'
								   WHERE aidi            = '$_POST[aidi]'");

		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=renbut_gajitunkin&thang=$_POST[thang]"; ?>'</script><?				
	

} else { print "asjku&8jhgklk"; }		
?>     
