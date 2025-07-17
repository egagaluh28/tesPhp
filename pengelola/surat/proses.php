<?php
session_start();

include "../../application/connect.php";

	 
	    $idx=$_POST['kdkotama'];
        $idx1=$_POST['kdsatker'];

        $saiki   = date('ymdHis');
 
		$idsurat = $saiki."".$idx1;

if ($_GET[aksi]=='simpan'){

	
        mysql_query("INSERT INTO surat(idsurat,
                                kdkotama, 
								kdsatker,
								kdbulan,
								thang,
								nomor,
								klasifikasi,
								lampiran,
								perihal,
								tujuan_surat,
								tempat_tanggal,
								kota_penerima,
								up,
								dasar_a,
								dasar_b,
								dasar_c,
								garis,
								spasi)
	                       VALUES('$idsurat',
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[kdbulan]',
								'$_POST[thang]',
								'$_POST[nomor]',
								'$_POST[klasifikasi]',
								'$_POST[lampiran]',
								'$_POST[perihal]',
								'$_POST[tujuan_surat]',
								'$_POST[tempat_tanggal]',
								'$_POST[kota_penerima]',
								'$_POST[up]',
								'$_POST[dasar_a]',
								'$_POST[dasar_b]',
								'$_POST[dasar_c]',
								'$_POST[garis]',
								'~~~~~')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=surat_satker"; ?>'</script><?		
		
	
} else if ($_GET[aksi]=='hapus') {
  
		mysql_query("DELETE FROM surat WHERE idsurat='$_GET[idsurat]'");;
		
	?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=surat_satker"; ?>'</script><?

} else if ($_GET[aksi]=='ubah') {
		
	
			mysql_query("UPDATE surat SET 
												kdkotama		=   '$_POST[kdkotama]',
												kdsatker		=   '$_POST[kdsatker]',
												kdbulan			=	'$_POST[kdbulan]',
												thang			=	'$_POST[thang]',
												nomor			=	'$_POST[nomor]',
												klasifikasi		=	'$_POST[klasifikasi]',
												lampiran		=	'$_POST[lampiran]',
												perihal			=	'$_POST[perihal]',
												tujuan_surat	=	'$_POST[tujuan_surat]',
												tempat_tanggal	=	'$_POST[tempat_tanggal]',
												kota_penerima	=	'$_POST[kota_penerima]',
												up				=	'$_POST[up]',
												dasar_a			=	'$_POST[dasar_a]',
												dasar_b			=	'$_POST[dasar_b]',
												dasar_c			=	'$_POST[dasar_c]',
												garis			=	'$_POST[garis]'
											WHERE idsurat       = '$_POST[idsurat]'");
		  
		 
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=surat_satker"; ?>'</script><?
	
	} else if ($_GET[aksi]=='ubahdetail') {
		
	
			mysql_query("UPDATE surat SET 
												kdkotama		=   '$_POST[kdkotama]',
												kdsatker		=   '$_POST[kdsatker]',
												kdbulan			=	'$_POST[kdbulan]',
												thang			=	'$_POST[thang]',
												nomor			=	'$_POST[nomor]',
												klasifikasi		=	'$_POST[klasifikasi]',
												lampiran		=	'$_POST[lampiran]',
												perihal			=	'$_POST[perihal]',
												tujuan_surat	=	'$_POST[tujuan_surat]',
												tempat_tanggal	=	'$_POST[tempat_tanggal]',
												kota_penerima	=	'$_POST[kota_penerima]',
												up				=	'$_POST[up]',
												dasar_a			=	'$_POST[dasar_a]',
												dasar_b			=	'$_POST[dasar_b]',
												dasar_c			=	'$_POST[dasar_c]',
												garis			=	'$_POST[garis]'
											WHERE idsurat       = '$_POST[idsurat]'");
		  
		 
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=detailsurat&idsurat=$_POST[idsurat]"; ?>'</script><?
	
//    proses kotama

} else if ($_GET[aksi]=='simpanktm'){

	
        mysql_query("INSERT INTO surat(idsurat,
                                kdkotama, 
								kdsatker,
								kdbulan,
								thang,
								nomor,
								klasifikasi,
								lampiran,
								perihal,
								tujuan_surat,
								tempat_tanggal,
								kota_penerima,
								up,
								dasar_a,
								dasar_b,
								dasar_c,
								garis,
								spasi)
	                       VALUES('$idsurat',
								'$_POST[kdkotama]',
								'$_POST[kdsatker]',
								'$_POST[kdbulan]',
								'$_POST[thang]',
								'$_POST[nomor]',
								'$_POST[klasifikasi]',
								'$_POST[lampiran]',
								'$_POST[perihal]',
								'$_POST[tujuan_surat]',
								'$_POST[tempat_tanggal]',
								'$_POST[kota_penerima]',
								'$_POST[up]',
								'$_POST[dasar_a]',
								'$_POST[dasar_b]',
								'$_POST[dasar_c]',
								'$_POST[garis]',
								'~~~~~')");
				
		?><script language="JavaScript">;
		document.location='<? print "../.././media.php?module=surat_ktm"; ?>'</script><?		

} else if ($_GET[aksi]=='hapusktm') {
  
		mysql_query("DELETE FROM surat WHERE idsurat='$_GET[idsurat]'");;
		
	?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=surat_ktm"; ?>'</script><?		
	
} else if ($_GET[aksi]=='ubahktm') {
		
	
			mysql_query("UPDATE surat SET 
												kdkotama		=   '$_POST[kdkotama]',
												kdsatker		=   '$_POST[kdsatker]',
												kdbulan			=	'$_POST[kdbulan]',
												thang			=	'$_POST[thang]',
												nomor			=	'$_POST[nomor]',
												klasifikasi		=	'$_POST[klasifikasi]',
												lampiran		=	'$_POST[lampiran]',
												perihal			=	'$_POST[perihal]',
												tujuan_surat	=	'$_POST[tujuan_surat]',
												tempat_tanggal	=	'$_POST[tempat_tanggal]',
												kota_penerima	=	'$_POST[kota_penerima]',
												up				=	'$_POST[up]',
												dasar_a			=	'$_POST[dasar_a]',
												dasar_b			=	'$_POST[dasar_b]',
												dasar_c			=	'$_POST[dasar_c]',
												garis			=	'$_POST[garis]'
											WHERE idsurat       = '$_POST[idsurat]'");
		  
		 
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=surat_ktm"; ?>'</script><?	
	
		} else if ($_GET[aksi]=='ubahdetailktm') {
		
	
			mysql_query("UPDATE surat SET 
												kdkotama		=   '$_POST[kdkotama]',
												kdsatker		=   '$_POST[kdsatker]',
												kdbulan			=	'$_POST[kdbulan]',
												thang			=	'$_POST[thang]',
												nomor			=	'$_POST[nomor]',
												klasifikasi		=	'$_POST[klasifikasi]',
												lampiran		=	'$_POST[lampiran]',
												perihal			=	'$_POST[perihal]',
												tujuan_surat	=	'$_POST[tujuan_surat]',
												tempat_tanggal	=	'$_POST[tempat_tanggal]',
												kota_penerima	=	'$_POST[kota_penerima]',
												up				=	'$_POST[up]',
												dasar_a			=	'$_POST[dasar_a]',
												dasar_b			=	'$_POST[dasar_b]',
												dasar_c			=	'$_POST[dasar_c]',
												garis			=	'$_POST[garis]'
											WHERE idsurat       = '$_POST[idsurat]'");
		  
		 
								   
			?><script language="JavaScript">;
    document.location='<? print "../.././media.php?module=detailsurat_ktm&idsurat=$_POST[idsurat]"; ?>'</script><?
		 
} else { print "asjku&8jhgklk"; }		
?>     
