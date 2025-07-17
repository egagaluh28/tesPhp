<?php
session_start();

include "../../application/connect.php";

		$data="select  count(kdkotama) as jml, count(kdsatker) as jml1 from kopstuk where kdkotama='$_POST[kdkotama]' and kdsatker='$_POST[kdsatker]'";
		$hasil=mysql_query($data);
		$row = mysql_fetch_array($hasil);
		
if ($_GET[aksi]=='simpan'){

		if (($row['jml']>=1) and ($row['jml1']>=1))   {
		echo "<script> alert('Kostuk Sudah ada.....Ngapain Input Lagi......!'); </script>";  
		?><script language="JavaScript">;
        document.location='<? print "../.././media.php?module=kopstuk"; ?>'</script><?

		} else {
		
		
        
		$idx1=$_POST['kdkotama'];
		$idx2=$_POST['kdsatker'];
       
        $saiki   = date('YmdHis');
 
		$id = $saiki."".$idx1."".$idx2;
		
        mysql_query("INSERT INTO kopstuk(id, 
										kdkotama,
										kdsatker,		
										kop1, 
										kop2, 
										panjang_kop, 
										panjang_grs) 
						VALUES('$id', 
							   '$_POST[kdkotama]', 
							   '$_POST[kdsatker]', 
						       '$_POST[kop1]', 
							   '$_POST[kop2]', 	
							   '$_POST[panjang_kop]', 
							   '$_POST[panjang_grs]')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=kopstuk"; ?>'</script><?		
		}
		
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM kopstuk WHERE id='$_GET[id]'");;
		
	    ?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=kopstuk"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE kopstuk SET kop1         = '$_POST[kop1]',
										    kop2		 = '$_POST[kop2]',
											panjang_kop  = '$_POST[panjang_kop]',
											panjang_grs  = '$_POST[panjang_grs]'
								         WHERE id        = '$_POST[id]'")
								   
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=kopstuk"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
