<?php
session_start();

include "../../application/connect.php";

		$data="select  count(kdkotama) as jml1, count(kdsatker) as jml2, , count(kdbulan) as jml3, count(thang) as jml4 from lamp_laplakgar where kdkotama='$_POST[kdkotama]' and kdsatker='$_POST[kdsatker]' and kdbulan='$_POST[kdbulan]' and thang='$_POST[thang]'";
		$hasil=mysql_query($data);
		$row = mysql_fetch_array($hasil);
		
		$tcount = mysql_num_rows($data);
		
if ($_GET[aksi]=='simpan'){

		if ($tcount>=1) {
		echo "<script> alert('Lampiran Sudah ada.....Ngapain Input Lagi......!'); </script>";  
		?><script language="JavaScript">;
        document.location='<? print "../.././media.php?module=lampiran"; ?>'</script><?

		} else {
		
		
		$idx1=$_POST['kdkotama'];
        $idx2=$_POST['kdsatker'];

        $saiki   = date('YmdHis');
 
		$id = $saiki."".$idx1."".$idx2;
		
        mysql_query("INSERT INTO lamp_laplakgar(id,  kdbulan, thang, kdkotama, kdsatker, brs1, brs2, brs3, panjang_grs, posisi_grs) 
						VALUES('$id', 
							   '$_POST[kdbulan]', 
							   '$_POST[thang]', 
							   '$_POST[kdkotama]', 
							   '$_POST[kdsatker]', 
						       '$_POST[brs1]', 
							   '$_POST[brs2]', 	
							   '$_POST[brs3]',
							   '$_POST[panjang_grs]',
							   '$_POST[posisi_grs]')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=lampiran"; ?>'</script><?		
		}
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM lamp_laplakgar WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=lampiran"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE lamp_laplakgar SET kdbulan  = '$_POST[kdbulan]',
											thang  		 = '$_POST[thang]',
											brs1         = '$_POST[brs1]',
										    brs2		 = '$_POST[brs2]',
											brs3  		 = '$_POST[brs3]',
											panjang_grs  = '$_POST[panjang_grs]',
											posisi_grs   = '$_POST[posisi_grs]'
								         WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=lampiran"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
