<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
   
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>REKAP PAGU - SBSN $_GET[thang]</td></tr></table><br>";	

$query= "SELECT '' as id_pagu,  kdwasgiat, kdkotama,  thang, '' as kode, '1' as display,  'SBSN' as uraian, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi
FROM sbsn where  thang='$_GET[thang]' 
group by  thang
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, '' as kode, concat('1',a.kdkotama) as display, b.nmkotama as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM sbsn a 
left join t_kotam b on a.kdkotama=b.kdkotama
where  a.thang='$_GET[thang]' 
group by a.kdkotama)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, a.kdsatker as kode, concat('1',a.kdkotama,a.kdsatker) as display, b.nmsatkr as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM sbsn a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
where  a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdkotama,a.kdsatker,a.kdprogram) as display, b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM sbsn a 
left join t_program b on a.kdprogram=b.kdprogram
where  a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker, a.kdprogram)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, a.kdgiat as kode, concat('1',a.kdkotama,a.kdsatker,a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM sbsn a 
left join t_giat b on a.kdgiat=b.kdgiat
where  a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker, a.kdprogram,a.kdgiat)
union (SELECT '' as id_pagu,  kdwasgiat, kdkotama, thang, concat(kdoutput,'.',kdakun) as kode, concat('1',kdkotama,kdsatker,kdprogram,kdgiat,kdoutput,kdakun) as display, concat('> ',nmakun) as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM sbsn 
where  thang='$_GET[thang]' 
group by  kdkotama, kdsatker, kdprogram, kdgiat,kdoutput,kdakun)
union (SELECT '' as id_pagu,  kdwasgiat, kdkotama, thang, kdakun as kode, concat('1',kdkotama,kdsatker,kdprogram,kdgiat,kdoutput,kdakun, kdsakun) as display, concat('- ',nmsakun) as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM sbsn 
where thang='$_GET[thang]' 
group by  kdkotama, kdsatker, kdprogram, kdgiat,kdoutput,kdakun,kdsakun) order by display";


		$ok = mysql_query($query);
 


	print "<table width='80%'  align='center' class='bordered'>";
	print "<tr height='40' >";
	print    "<th align='center'>NO</th>";
	print    "<th align='center'>URAIAN</th>";
	print    "<th align='center' width='30'>KODE PROGRAM</th>";
	print    "<th align='center' width='125'>PAGU</th>";
	print    "<th align='center' width='125'>REVISI (+/-)</th>";
	print    "<th align='center' width='125'>PAGU STLH REVISI</th>";
//	print    "<th   colspan='2' align='center' valign='middle' >AKSI</th>";
  	print "</tr>";
	
	$no=1;
	$tempNo = null;
		
while($k = mysql_fetch_array($ok)){

    $pagu	 = number_format($k[pagu],0,',','.');
	$revisi	 = number_format($k[revisi],0,',','.');
	$hasil	 = number_format($k[pagurevisi],0,',','.');
	
	$uraian = strtoupper($k[uraian]);
		
	$str = $k[display];
    $pj = strlen($str);
	
	//--------------------

   if ($pj=='3') print"<tr bgcolor='#fcfcc0'>"; else print"<tr>";
	
	//print"<tr>";
	
	if ($pj=='3') {	
	   
		print "<td  valign='top' ><b>$no.</b></td>";
		
		$tempNo = $no;
        $no++;		
	} else if ($pj=='9') {	
		if($tempNo != $no)
		{
			$abjad='a';
			$tempNo = $no;
		}else{
		
		}
		
		print "<td  valign='top' align='center'><b>$abjad.</b></td>";
		$tempAbjad = $abjad;
		$abjad++;
	} else if ($pj=='11') {	
		if($tempAbjad != $abjad)
		{
			$nomor=1;
			$tempAbjad = $abjad;
		}else{
			$nomor++;	
		}
	    print "<td  valign='top' align='right'><b>$nomor)</b></td>";
		$tempNomor = $nomor;
		$nomor++;
		} else if ($pj=='15') {	
		if($tempNomor != $nomor)
		{
			$nomorabjad=a;
			$tempNomor = $nomor;
		}else{
			$nomorabjad++;	
		}
	    print "<td  valign='top' align='right'><b>$nomorabjad)</b></td>";
		
		
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
		
		
		 print "<td  valign='top'>";              if ($pj<'25') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$hasil</b>"; else print "$hasil"; print"</td>";
		
		print "</tr>";	
	//$no++;	
   }
	print "</table><br>"; 
?>