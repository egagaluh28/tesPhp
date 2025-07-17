<?php
session_start();

include "../application/connect.php";

	
    $tgl   = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$tgl1  = $_POST['thn1']."-".$_POST['bln1']."-".$_POST['tgl1'];
	$tgl2  = $_POST['thn2']."-".$_POST['bln2']."-".$_POST['tgl2'];
	$tgl3  = $_POST['thn3']."-".$_POST['bln3']."-".$_POST['tgl3'];

if ($_GET[aksi]=='simpan'){
		
		$idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('ymdHis');
 
		$id_laphibah = $saiki."".$idx1;
	
        mysql_query("INSERT INTO laphibah(id_laphibah,
							    thang,
                                kdkotama, 
								kdsatker,
								pemberi_hibah,
								no_nph,
								tgl_nph,
								uraian,
								nilai_hibah,
								no_reg,
								batas_tarik_dana,
								no_rek,
								no_rev_dipa,
								nilai_revisi,
								no_sphl,
								tgl_sphl,
								nilai_sphl,
								no_sp3hl,
								tgl_sp3hl,
								nilai_sp3hl,
								ket)
	                       VALUES('$id_laphibah',
                                '$_POST[thang]', 
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[pemberi_hibah]',
								'$_POST[no_nph]',
								'$tgl',
								'$_POST[uraian]',
								'$_POST[nilai_hibah]',
								'$_POST[no_reg]',
								'$tgl1',
								'$_POST[no_rek]',
								'$_POST[no_rev_dipa]',
								'$_POST[nilai_revisi]',
								'$_POST[no_sphl]',
								'$tgl2',
								'$_POST[nilai_sphl]',
								'$_POST[no_sp3hl]',
								'$tgl3',
								'$_POST[nilai_sp3hl]',
								'$_POST[ket]')");
				
		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=laphibah&thang=$_POST[thang]"; ?>'</script><?		
		
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM laphibah WHERE id_laphibah='$_GET[id_laphibah]'");;
		
	?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=laphibah&thang=$_GET[thang]"; ?>'</script><?		

} else if ($_GET[aksi]=='ubah') {
		
			mysql_query("UPDATE laphibah SET thang      		= '$_POST[thang]',
												  kdkotama			= '$_POST[kdkotama]',
												  kdsatker			= '$_POST[kdsatker]',
												  pemberi_hibah 	= '$_POST[pemberi_hibah]',
												  no_nph			= '$_POST[no_nph]',
												  tgl_nph			= '$tgl',
												  uraian			= '$_POST[uraian]', 
												  nilai_hibah		= '$_POST[nilai_hibah]',
												  no_reg			= '$_POST[no_reg]',
												  batas_tarik_dana 	= '$tgl1',
												  no_rek			= '$_POST[no_rek]',
												  no_rev_dipa		= '$_POST[no_rev_dipa]',
												  nilai_revisi		= '$_POST[nilai_revisi]',
												  no_sphl 			= '$_POST[no_sphl]',
												  tgl_sphl			= '$tgl2',
												  nilai_sphl		= '$_POST[nilai_sphl]',
												  no_sp3hl 			= '$_POST[no_sp3hl]',
												  tgl_sp3hl			= '$tgl3',
												  nilai_sp3hl		= '$_POST[nilai_sp3hl]',
												  ket				= '$_POST[ket]'
								   WHERE id_laphibah            	= '$_POST[id_laphibah]'");
		  
								   
		?><script language="JavaScript">;
		document.location='<? print ".././media.php?module=laphibah&thang=$_POST[thang]"; ?>'</script><?	
	
		 
} else { print "asjku&8jhgklk"; }		
?>     
