<?
include "../application/connect.php";

   	
	
    $tgl_pengembalian   = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	
	$jenbel=substr($_POST[kdakun],0,2);

	
if ($_GET[aksi]=='simpan'){
			
	$sql=mysql_query("INSERT INTO     pengembalian (id_pagu, 
							   id_realisasi,
							   id_pengembalian,
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
							   tgl_pengembalian,	
							   uraian, 
							   jml_pengembalian)
                           VALUES('$_POST[id_pagu]',
						          '$_POST[id_realisasi]',
								  '$_POST[id_pengembalian]',
								  '$_POST[kdbulan]',
								  '$_POST[thang]',
								  '$_POST[kdkotama]',
								  '$_POST[kdsatker]',
								  '$_POST[kdwasgiat]',
								  '$_POST[kdsa]',
								  '$_POST[kdjd]',
								  '$jenbel',
							      '$_POST[kdprogram]',
								  '$_POST[kdgiat]',
								  '$_POST[kdoutput]',
								  '$_POST[kdakun]',
								  '$_POST[kdsakun]',
						          '$tgl_pengembalian',
								  '$_POST[uraian]',
								  '$_POST[jml_pengembalian]')");
								  
					  

  			
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputpengembalian&kdbulan=$_POST[kdbulan]&thang=$_POST[thang]&id_realisasi=$_POST[id_realisasi]&id_pagu=$_POST[id_pagu]"; ?>'</script><?	
	
	} else if ($_GET[aksi]=='hapus'){
	
	mysql_query("delete from pengembalian  WHERE id_pengembalian='$_GET[id_pengembalian]'");

	
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputpengembalian&id_realisasi=$_GET[id_realisasi]&id_pagu=$_GET[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]"; ?>'</script><?
	
	 } else if ($_GET[aksi]=='ubah'){
	 
 		 mysql_query("UPDATE pengembalian  	 SET kdbulan		= '$_POST[kdbulan]',
												 tgl_pengembalian			= '$tgl_pengembalian', 
												 jml_pengembalian	    = '$_POST[jml_pengembalian]'	
                                   WHERE id_pengembalian  = '$_POST[id_pengembalian]'");
								   				   
						   
	?><script language="JavaScript">;
    document.location='<? print "../media.php?module=inputpengembalian&id_pagu=$_POST[id_pagu]&kdbulan=$_POST[kdbulan]&thang=$_POST[thang]"; ?>'</script><?	

	
		
	} else { print "proses gagal"; }
   	 
?>