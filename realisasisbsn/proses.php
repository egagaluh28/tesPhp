<?php
include "../application/connect.php";

   	
	
 
    $tglspp   = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$tglspm   = $_POST['thnspm']."-".$_POST['blnspm']."-".$_POST['tglspm'];
	$tglsp2d  = $_POST['th']."-".$_POST['bl']."-".$_POST['tg'];
	

	
if ($_GET[aksi]=='simpan'){
			
	$sql=mysql_query("INSERT INTO     realisasi_sbsn (id_pagu, 
							   id_realisasi,
							   kdbulan,
							   thang, 
							   kdkotama, 
							   kdsatker, 	
							   kdwasgiat,
							   kdsa,
							   kdjd,
							   kdjenbel,
							   kdprogram,
							   kdgiat,
							   kdoutput,
							   kdakun,
							   kdsakun,
	                           nospp, 
							   tglspp, 
							   nilai_spp,
							   nospm, 
							   tglspm, 
							   nilai_spm,
							   nosp2d, 
							   tglsp2d,  
							   uraian, 
							   realisasi)
                           VALUES('$_POST[id_pagu]',
						          '$_POST[id_realisasi]',
								  '$_POST[kdbulan]',
								  '$_POST[thang]',
								  '$_POST[kdkotama]',
								  '$_POST[kdsatker]',
								  '$_POST[kdwasgiat]',
								  '$_POST[kdsa]',
								  '$_POST[kdjd]',
								  '$_POST[kdjenbel]',
							      '$_POST[kdprogram]',
								  '$_POST[kdgiat]',
								  '$_POST[kdoutput]',
								  '$_POST[kdakun]',
								  '$_POST[kdsakun]',
						          '$_POST[nospp]',
								  '$tglspp',
								  '$_POST[nilai_spp]',
								  '$_POST[nospm]',
								  '$tglspm',
								  '$_POST[nilai_spm]',
								  '$_POST[nosp2d]',
								  '$tglsp2d',
								  '$_POST[uraian]',
								  '$_POST[realisasi]')");
								  
					  
  			
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputrealisasisbsn&id_pagu=$_POST[id_pagu]&kdbulan=$_POST[xkdbulan]&thang=$_POST[thang]"; ?>'</script><?	
	
	} else if ($_GET[aksi]=='hapus'){
	
	mysql_query("DELETE FROM realisasi_sbsn WHERE id_realisasi='$_GET[id_realisasi]'");

	
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputrealisasisbsn&id_realisasi=$_GET[id_realisasi]&id_pagu=$_GET[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]"; ?>'</script><?
	
	} else if ($_GET[aksi]=='hapusrealisasi'){
	
	mysql_query("DELETE FROM realisasi_sbsn WHERE id_realisasi='$_GET[id_realisasi]'");

	
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=list_realisasi_sbsn&thang=$_GET[thang]"; ?>'</script><?
	
	
	 } else if ($_GET[aksi]=='ubah'){
	 
 		 mysql_query("UPDATE realisasi_sbsn 	 SET kdbulan		= '$_POST[kdbulan]',
												 nospp			= '$_POST[nospp]', 
												 tglspp			= '$tglspp',
												 nilai_spp		= '$_POST[nilai_spp]',
												 nospm			= '$_POST[nospm]', 
												 tglspm			= '$tglspm',
												 nilai_spm		= '$_POST[nilai_spm]',
												 nosp2d			= '$_POST[nosp2d]',
												 tglsp2d		= '$tglsp2d',
												 uraian   		= '$_POST[uraian]',
												 realisasi	    = '$_POST[realisasi]'	
                                   WHERE id_realisasi  = '$_POST[id_realisasi]'");
								   				   
								   				   
						   
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputrealisasisbsn&id_pagu=$_POST[id_pagu]&kdbulan=$_POST[xkdbulan]&thang=$_POST[thang]"; ?>'</script><?			   
		
	} else { print "proses gagal"; }
   	 
?>