<?php
session_start();

include "../../application/connect.php";



if ($_GET[aksi]=='simpan'){

		
        mysql_query("INSERT INTO t_satkr(kddept, 
										kdunit, 
										kdkotama, 
										kdsatkr, 
										nmsatkr,
										kdkusatker) 
						VALUES( '$_POST[kddept]',
								'$_POST[kdunit]',
								'$_POST[kdkotama]', 
								'$_POST[kdsatkr]',
								'$_POST[nmsatkr]',
								'$_POST[kdkusatker]')");
				
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=satker"; ?>'</script><?		
		
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM t_satkr WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=satker"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE t_satkr SET kddept = '$_POST[kddept]',
											kdunit = '$_POST[kdunit]',
											kdkotama = '$_POST[kdkotama]',
											kdsatkr= '$_POST[kdsatkr]', 
											nmsatkr = '$_POST[nmsatkr]',
											kdkusatker = '$_POST[kdkusatker]'
								
										WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=satker"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
