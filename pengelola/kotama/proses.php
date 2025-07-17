<?php
session_start();

include "../../application/connect.php";



if ($_GET[aksi]=='simpan'){

		
        mysql_query("INSERT INTO t_kotam(kddept, 
										kdunit, 
										kdkotama, 
										nmkotama,
										kdkukotama) 
						VALUES( '$_POST[kddept]',
								'$_POST[kdunit]',
								'$_POST[kdkotama]', 
								'$_POST[nmkotama]',
								'$_POST[kdkukotama]')");
				
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=kotama"; ?>'</script><?		
		
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM t_kotam WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=kotama"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE t_kotam SET kddept = '$_POST[kddept]',
											kdunit = '$_POST[kdunit]',
											kdkotama = '$_POST[kdkotama]',
											nmkotama = '$_POST[nmkotama]',
											kdkukotama = '$_POST[kdkukotama]'
								
										WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=kotama"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
