<?php
session_start();

include  "../../application/connect.php";


if ($_GET[aksi]=='simpan'){

		
        mysql_query("INSERT INTO t_akun(kdakun, nmakun, kdjenbel) 
						VALUES('$_POST[kdakun]', '$_POST[nmakun]', '$_POST[kdjenbel]') ");
				
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=akun"; ?>'</script><?		
		
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM t_akun WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=akun"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE t_akun SET  kdakun = '$_POST[kdakun]',
											nmakun= '$_POST[nmakun]', 
											kdjenbel = '$_POST[kdjenbel]'
								
										WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=akun"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
