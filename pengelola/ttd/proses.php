<?php
session_start();

include "../../application/connect.php";

		$data="select  count(kdkotama) as jml, count(kdsatker) as jml1, count(kdbulan) as jml2, count(thang) as jml3 from tajuk_ttd where kdkotama='$_POST[kdkotama]' and kdsatker='$_POST[kdsatker]' and kdbulan='$_POST[kdbulan]' and thang='$_POST[thang]'";
		$hasil=mysql_query($data);
		$row = mysql_fetch_array($hasil);
		
		$tcount = mysql_num_rows($data);
		
if ($_GET[aksi]=='simpan'){
  
		if ($tcount>=1) {
		echo "<script> alert('Pejabat Penenda Tangan Cukup 1 Orang Saja Untuk tiap Satker'); </script>";  
		?><script language="JavaScript">;
        document.location='<? print "../.././media.php?module=ttd"; ?>'</script><?

		} else {
		
		
		$idx1=$_POST['kdkotama'];
		$idx2=$_POST['kdsatker'];
       
        $saiki   = date('YmdHis');
 
		$id = $saiki."".$idx1."".$idx2;
		
        mysql_query("INSERT INTO tajuk_ttd (id,  kdbulan, thang, kdkotama, kdsatker,  tempat, tanggal, an, pejabat1, nama, pkt_crp) 
						VALUES('$id', '$_POST[kdbulan]', 
							   '$_POST[thang]',
							   '$_POST[kdkotama]', 
						       '$_POST[kdsatker]', 
						       '', 
							   '', 
							   '$_POST[an]',	
							   '$_POST[pejabat1]',
							   '$_POST[nama]', 
							   '$_POST[pkt_crp]')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=ttd"; ?>'</script><?		
				
		}
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM tajuk_ttd WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=ttd"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE tajuk_ttd SET 	kdbulan      = '$_POST[kdbulan]',
												thang		= '$_POST[thang]',
												an  		= '$_POST[an]',
												pejabat1  	= '$_POST[pejabat1]',
												nama  		= '$_POST[nama]',
												pkt_crp  	= '$_POST[pkt_crp]'
								         WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=ttd"; ?>'</script><?
		
} else if ($_GET[aksi]=='rapikanttd') {
		
			mysql_query("UPDATE baris SET 	baris = '$_POST[baris]' WHERE id = '1'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=rapikanttd"; ?>'</script><?
		 		
		 
} else { print "asjku&8jhgklk"; }		
?>     
