<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
   
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>PEREKAMAN DATA PAGU - BLU $_GET[thang]</td></tr></table>";	

$query= "SELECT '' as id_pagu,  '' as kdprogram, kdwasgiat, kdkotama, kdsatker, thang, '' as kode, '1' as display,  'BLU' as uraian, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi
FROM blu where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' 
group by kdkotama, kdsatker, thang
union (SELECT '' as id_pagu, '' as kdprogram, a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdprogram) as display, b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM blu a 
left join t_program b on a.kdprogram=b.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdprogram)
union (SELECT '' as id_pagu, '' as kdprogram, a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, a.kdgiat as kode, concat('1',a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM blu a 
left join t_giat b on a.kdgiat=b.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdprogram,a.kdgiat)
union (SELECT '' as id_pagu, '' as kdprogram, a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, a.kdoutput as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM blu a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdprogram,a.kdgiat,a.kdoutput)
union (SELECT '' as id_pagu,  '' as kdprogram, kdwasgiat, kdkotama, kdsatker, thang, kdakun as kode, concat('1',kdprogram,kdgiat,kdoutput,kdakun) as display, nmakun as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM blu 
where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' 
group by  kdprogram, kdgiat,kdoutput,kdakun)
union (SELECT '' as id_pagu,  kdprogram,kdwasgiat, kdkotama, kdsatker, thang, kdakun as kode, concat('1',kdprogram,kdgiat,kdoutput,kdakun, kdsakun) as display, concat('>',' ',nmsakun) as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM blu 
where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' 
group by  kdprogram, kdgiat,kdoutput,kdakun,kdsakun)
union (SELECT id_pagu, '' as kdprogram, kdwasgiat, kdkotama, kdsatker, thang, '' as kode, concat('1',kdprogram,kdgiat,kdoutput,kdakun, kdsakun,urutitem) as display, concat('-',' ', nmitem) as uraian, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  FROM blu  where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by id_pagu order by noitem, id_pagu) order by display";


		$ok = mysql_query($query);
 
print "<table width='80%' align='center'><tr><td><a href='media.php?module=inputpagublu&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]&thang=$_GET[thang]'  style='text-decoration:none'><div class='codehim-tombol-biru'><input  type='button' value='Tambah Kegiatan'/> </div></a></td></tr></table><br>";

	print "<table width='80%'  align='center' class='bordered'>";
	print "<tr height='40' >";
	print    "<th align='center'>NO</th>";
	print    "<th align='center'>URAIAN</th>";
	print    "<th align='center' width='30'>KODE PROGRAM</th>";
	print    "<th align='center' width='125'>PAGU</th>";
	print    "<th align='center' width='125'>REVISI (+/-)</th>";
	print    "<th align='center' width='125'>PAGU STLH REVISI</th>";
	print    "<th   colspan='2' align='center' valign='middle' >AKSI</th>";
  	print "</tr>";
	
	$no=1;
	$tempNo = null;
	
	
	$romawi=1;
    $tempRomawi = null;
		
while($k = mysql_fetch_array($ok)){

    $pagu	 = number_format($k[pagu],0,',','.');
	$revisi	 = number_format($k[revisi],0,',','.');
	$hasil	 = number_format($k[pagurevisi],0,',','.');
	
	$uraian = strtoupper($k[uraian]);
//	$kd1 = substr($k[display],3,2);
	$kd2 = substr($k[display],3,4);
	$kd3 = substr($k[display],7,3);
	$kd4 = substr($k[display],10,6);
	$kd5 = substr($k[display],16,3);
	
	$str = $k[display];
    $pj = strlen($str);
	
	if ($pj=='16') print"<tr bgcolor='#fcfcc0'>"; else print"<tr>";
	
	if ($pj=='3') {	
		if ($romawi=='1') {
		print "<td  valign='top' ><b>A.</b></td>";
        } else if ($romawi=='2') {
		print "<td  valign='top' ><b>B.</b></td>";
		} else if ($romawi=='3') {
		print "<td  valign='top' ><b>C.</b></td>";	
		} else if ($romawi=='4') {
		print "<td  valign='top' ><b>D.</b></td>";	
		} else if ($romawi=='5') {
		print "<td  valign='top' ><b>E.</b></td>";			
		} else {
		print "<td  valign='top' ><b>F.</b></td>";
		}
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj=='7') {	
		if($tempRomawi != $romawi)
		{
			$no='1';
			$tempRomawi = $romawi;
		}else{
		
		}	
		print "<td  valign='top' align='center'><b>$no.</b></td>";
		
		$tempNo = $no;
        $no++;		
		
	} else if ($pj=='10') {	
		if ($tempNo != $no) 
		{
			$abjad='a';
			$tempNo = $no;
			$tempRomawi = $romawi;
		}else{
		
		}
		print "<td  valign='top' align='center'><b>$abjad.</b></td>";
			$tempAbjad = $abjad;
		    $abjad++;
	
	
	
	} else if ($pj=='16') {	
		if($tempAbjad != $abjad)
		{
			$nomor=1;
			$tempAbjad = $abjad;
		}else{
			$nomor++;	
		}
	    print "<td  valign='top' align='right'><b>$nomor)</b></td>";
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
		
		
		 print "
				<td  valign='top'>"; 
				if ($pj<'20') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$hasil</b>"; else print "$hasil"; print"</td>";

		if ($pj=='19') { print "<td colspan='2' align='center'><a href='media.php?module=rekamdetailblu&kdprogram=$k[kdprogram]&kdgiat=$kd2&kdoutput=$kd3&kdakun=$kd4&kdsakun=$kd5&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]&thang=$_GET[thang]' data-tooltip='Tambah Uraian' data-position='top' class='top'>
		<img src='images/add.png' width='20' ></a></td>"; 
		
		} else { 
	
		print	"<td  valign='top' align='center'>"; if ($pj>'20') print "<a href='media.php?module=editpagublu&id_pagu=$k[id_pagu]&thang=$k[thang]' data-tooltip='Edit Pagu' data-position='top' class='top'>
		<img src='images/edit.png' width='20' ></a>"; else print ""; print "</td>"; 
		print"<td  valign='top' align='center'>"; if ($pj>'20') print "<a href=\"blu/proses.php?aksi=hapus&id_pagu=$k[id_pagu]&thang=$k[thang]\" 
					onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $k[uraian] ~? ')\" data-tooltip='Hapus Pagu' data-position='top' class='top'>
				<img src='images/delete.png' width='20'  ></a>"; else print ""; print "</td>"; 
		}							
		print "</tr>";	
	//$no++;	
   }
	print "</table><br>"; 
?>