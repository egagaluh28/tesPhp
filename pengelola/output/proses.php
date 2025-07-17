<?php
session_start();

include  "../../application/connect.php";


if ($_GET[aksi]=='simpan'){

		
        mysql_query("INSERT INTO t_output(
										kdprogram, 
										kdgiat, 
										kdoutput, 
										nmoutput) 
						VALUES( 
								'$_POST[kdprogram]',
								'$_POST[kdgiat]', 
								'$_POST[kdoutput]',
								'$_POST[nmoutput]')");
				
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=output"; ?>'</script><?		
		
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM t_output WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=output"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE t_output SET 
											kdprogram = '$_POST[kdprogram]',
											kdgiat = '$_POST[kdgiat]',
											kdoutput= '$_POST[kdoutput]', 
											nmoutput = '$_POST[nmoutput]'
								
										WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=output"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
