<?php
session_start();
include "../application/connect.php";

$jenbel=substr($_POST[kdakun],0,2);

if ($_GET[aksi]=='simpan'){

		$idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

       $saiki   = date('ymdHis');
 
	//	$id_pagu = $saiki."".$idx."".$idx1;
		$id_pagu = $saiki."".$idx1;
		

		 mysql_query("INSERT INTO sbsn
		                         (id_pagu, 
								  kdwasgiat,
								  thang, 
								  kdkotama,
								  kdsatker,
								  kddept,
								  kdunit,
								  kdfungsi,
								  kdsfungsi,
								  kdprogram,
								  kdgiat,
								  kdoutput,
								  kdkusatker,
								  kdsa,
								  kdjd,
								  kdjenbel,
								  kdakun, 
								  kdsakun,
								  noitem, 
								  urutitem,
								  nmitem,
								  pagu,
								  revisi,
								  pagurevisi,
								  nmakun,
								  nmsakun)
                              VALUES('$id_pagu',
									 '$_POST[kdwasgiat]', 	
								     '$_POST[thang]',
							         '$_POST[kdkotama]',
									 '$_POST[kdsatker]',
									 '$_POST[kddept]',
									 '$_POST[kdunit]',
									 '$_POST[kdfungsi]',
									 '$_POST[kdsfungsi]',
									 '$_POST[kdprogram]',
									 '$_POST[kdgiat]',
									 '$_POST[kdoutput]',
									 '$_POST[kdkusatker]',
									 '$_POST[kdsa]',
									 '$_POST[kdjd]',
									 '$jenbel',
									 '$_POST[kdakun]',
									 '$_POST[kdsakun]',
									 '$_POST[noitem]', 
									 '$_POST[urutitem]',
									 '$_POST[nmitem]', 
									 '$_POST[pagu]',
									 '$_POST[revisi]',
									 '$_POST[pagurevisi]',
									 '$_POST[nmakun]',
									 '$_POST[nmsakun]')");
				
		?><script language="JavaScript">;
         document.location='<? print "../media.php?module=pagusbsn&thang=$_POST[thang]"; ?>'</script><?		
		
} else if ($_GET[aksi]=='hapus') {
  
		 mysql_query("DELETE FROM sbsn WHERE id_pagu='$_GET[id_pagu]'");
		 mysql_query("DELETE FROM realisasi_sbsn WHERE id_pagu='$_GET[id_pagu]'");	
		
		?><script language="JavaScript">;
         document.location='<? print "../media.php?module=pagusbsn&thang=$_GET[thang]"; ?>'</script><?			

} else if ($_GET[aksi]=='ubah') {
		 mysql_query("UPDATE  sbsn SET        kdwasgiat    = '$_POST[kdwasgiat]',
											  thang    = '$_POST[thang]',
											  kdkotama = '$_POST[kdkotama]',
											  kdsatker = '$_POST[kdsatker]',
											  kddept   = '$_POST[kddept]',
											
										kdunit		= '$_POST[kdunit]',
										kdfungsi	= '$_POST[kdfungsi]',
										kdsfungsi	= '$_POST[kdsfungsi]',
										kdprogram	= '$_POST[kdprogram]',
										kdgiat		= '$_POST[kdgiat]',
										kdoutput	= '$_POST[kdoutput]',
										kdkusatker	= '$_POST[kdkusatker]',
										kdsa		= '$_POST[kdsa]',
										kdjd		= '$_POST[kdjd]',
										kdjenbel	= '$jenbel',
										kdakun		= '$_POST[kdakun]',
										kdsakun		= '$_POST[kdsakun]',
										noitem		= '$_POST[noitem]',
										urutitem	= '$_POST[urutitem]',
										nmitem      = '$_POST[nmitem]',
										pagu		= '$_POST[pagu]',
										revisi		= '$_POST[revisi]',
										pagurevisi	= '$_POST[pagurevisi]',
										nmakun		= '$_POST[nmakun]',
										nmsakun		= '$_POST[nmsakun]'
								   WHERE id_pagu  = '$_POST[id_pagu]'");
								   
				mysql_query("UPDATE  realisasi_sbsn SET        
											  thang    = '$_POST[thang]',
											  kdkotama = '$_POST[kdkotama]',
											  kdsatker = '$_POST[kdsatker]',
											  kdwasgiat= '$_POST[kdwasgiat]',
											  kdsa		= '$_POST[kdsa]',
										      kdjd		= '$_POST[kdjd]',
											  kdjenbel	= '$jenbel',
										kdprogram	= '$_POST[kdprogram]',
										kdgiat		= '$_POST[kdgiat]',
										kdoutput	= '$_POST[kdoutput]',
										kdakun		= '$_POST[kdakun]',
										kdsakun		= '$_POST[kdsakun]',
										uraian		= '$_POST[nmitem]'
								   WHERE id_pagu  = '$_POST[id_pagu]'");
								   
		?><script language="JavaScript">;
        document.location='<? print "../media.php?module=pagusbsn&thang=$_POST[thang]"; ?>'</script><?	
		 
} else { print "asjku&8jhgklk"; }		
?>     