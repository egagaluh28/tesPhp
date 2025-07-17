<?php
session_start();

include "../application/connect.php";

     
if ($_GET[aksi]=='simpan'){
        $idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('ymdHis');
 
		$id_tunkin = $saiki."".$idx1;


        mysql_query("INSERT INTO tunkin(id_tunkin,
                                kdkotama, 
								kdsatker,
								kdbulan,
								thang,
								grade,
								jumlah,
								pajak)
	                       VALUES('$id_tunkin',
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[kdbulan]',
								'$_POST[thang]',
								'$_POST[grade]',
								'$_POST[jumlah]',
								'$_POST[pajak]')");
				
		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=rekaptunkin&kdbulan=$_POST[kdbulan]&thang=$_POST[thang]"; ?>'</script><?		
			
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM tunkin WHERE id_tunkin='$_GET[id_tunkin]'");;
		
	?><script language="JavaScript">;
    document.location='<? print ".././media.php?module=rekaptunkin&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
		
			mysql_query("UPDATE tunkin SET 	grade 	= '$_POST[grade]', 
											jumlah	= '$_POST[jumlah]',
											pajak	= '$_POST[pajak]'
								   WHERE id_tunkin            = '$_POST[id_tunkin]'");

								   
			?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=rekaptunkin&kdbulan=$_POST[kdbulan]&thang=$_POST[thang]"; ?>'</script><?		
	

} else { print "asjku&8jhgklk"; }		
?>     
