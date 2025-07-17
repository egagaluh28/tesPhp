<?php
session_start();

include "../../application/connect.php";

	    $idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('ymdHis');
 
		$idtembusan = $saiki."".$idx1;
		$idtembusanktm = $saiki."".$idx;
		
if ($_GET[aksi]=='simpan'){
  
mysql_query("INSERT INTO tembusan (idtembusan, kdkotama, kdsatker, urut, nama) 
						VALUES ('$idtembusan', 
								'$_POST[kdkotama]',  
								'$_POST[kdsatker]', 
								'$_POST[urut]',
								'$_POST[nama]')");
			  
?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_satker"; ?>'</script><?	
			
	
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM tembusan WHERE idtembusan='$_GET[idtembusan]'");
		
	   ?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_satker"; ?>'</script><?	

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE tembusan SET 	
												urut        = '$_POST[urut]',
												nama		= '$_POST[nama]'
								         WHERE idtembusan        = '$_POST[idtembusan]'")
								   
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_satker"; ?>'</script><?	

} else if ($_GET[aksi]=='simpangaris'){
  
mysql_query("INSERT INTO tembusan (idtembusan, kdkotama, kdsatker, urut, nama) 
						VALUES ('$idtembusanktm', 
								'$_POST[kdkotama]',  
								'$_POST[kdsatker]', 
								'99',
								'$_POST[panjang]')");
			  
?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_satker"; ?>'</script><?			

} else if ($_GET[aksi]=='ubahgaris') {
		
			mysql_query("UPDATE tembusan set nama = '$_POST[panjang]' WHERE idtembusan = '$_POST[idtembusan]'")
								   
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_satker"; ?>'</script><?			
		
//------------------------tembusan kotama -------------------------------

} else if ($_GET[aksi]=='simpanktm'){
  
mysql_query("INSERT INTO tembusan (idtembusan, kdkotama, kdsatker, urut, nama) 
						VALUES ('$idtembusanktm', 
								'$_POST[kdkotama]',  
								'$_POST[kdsatker]', 
								'$_POST[urut]',
								'$_POST[nama]')");
			  
?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?	
		
} else if ($_GET[aksi]=='simpangarisktm'){
  
mysql_query("INSERT INTO tembusan (idtembusan, kdkotama, kdsatker, urut, nama) 
						VALUES ('$idtembusanktm', 
								'$_POST[kdkotama]',  
								'$_POST[kdsatker]', 
								'99',
								'$_POST[panjang]')");
		
	   ?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?	
		
} else if ($_GET[aksi]=='hapusktm') {
  
		mysql_query("DELETE FROM tembusan WHERE idtembusan='$_GET[idtembusan]'");	

		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?			
		
} else if ($_GET[aksi]=='ubahktm') {
		
			mysql_query("UPDATE tembusan SET 	
												urut        = '$_POST[urut]',
												nama		= '$_POST[nama]'
								         WHERE idtembusan        = '$_POST[idtembusan]'")
								   
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?		
								
			  
?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?			

} else if ($_GET[aksi]=='ubahgarisktm') {
		
			mysql_query("UPDATE tembusan set nama = '$_POST[panjang]' WHERE idtembusan = '$_POST[idtembusan]'")
								   
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=tembusan_ktm"; ?>'</script><?				
										 
		 
} else { print "asjku&8jhgklk"; }		
?>     
