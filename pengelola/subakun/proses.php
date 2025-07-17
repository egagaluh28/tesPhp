<?php
session_start();

include  "../../application/connect.php";


if ($_GET[aksi]=='simpan'){

		
        mysql_query("INSERT INTO t_sakun(kdprogram, kdgiat, 
										kdoutput, 
										kdakun, 
										kdsakun, 
										nmsakun, 
										kddipa, kdwasgiat) 
						VALUES( '$_POST[kdprogram]', '$_POST[kdgiat]',
								'$_POST[kdoutput]',
								'$_POST[kdakun]',
								'$_POST[kdsakun]', 
								'$_POST[nmsakun]',
								'$_POST[kddipa]',
								'$_POST[kdwasgiat]')");
				
		?><script language="JavaScript">;				
		document.location='<? print "../.././media.php?module=subakun"; ?>'</script><?		
		
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM t_sakun WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=subakun"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE t_sakun SET kdgiat = '$_POST[kdgiat]',
			kdprogram = '$_POST[kdprogram]',
											kdoutput = '$_POST[kdoutput]',
											kdakun = '$_POST[kdakun]',
											kdsakun = '$_POST[kdsakun]',
											nmsakun= '$_POST[nmsakun]', 
											kddipa = '$_POST[kddipa]',
											kdwasgiat = '$_POST[kdwasgiat]'
								
										WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=subakun"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
