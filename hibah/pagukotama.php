<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
   
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>REKAP PAGU - HIBAH $_GET[thang]</td></tr></table><br>";	

$query= "SELECT '' as id_pagu,  kdwasgiat, kdkotama,  thang, '' as kode, '1' as display,  'HIBAH' as uraian, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi
FROM hibah where  kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' 
group by kdkotama
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, a.kdsatker as kode, concat('1',a.kdsatker) as display, b.nmsatkr as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM hibah a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdsatker,a.kdprogram) as display, b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM hibah a 
left join t_program b on a.kdprogram=b.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker, a.kdprogram)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, a.kdgiat as kode, concat('1',a.kdsatker,a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM hibah a 
left join t_giat b on a.kdgiat=b.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker, a.kdprogram,a.kdgiat)
union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, a.kdoutput as kode, concat('1',a.kdsatker,a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi 
FROM hibah a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker, a.kdprogram,a.kdgiat,a.kdoutput)
union (SELECT '' as id_pagu,  kdwasgiat, kdkotama, thang, kdakun as kode, concat('1',kdsatker,kdprogram,kdgiat,kdoutput,kdakun) as display, concat('> ',nmakun) as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM hibah 
where  kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' 
group by  kdkotama, kdsatker, kdprogram, kdgiat,kdoutput,kdakun)
union (SELECT '' as id_pagu,  kdwasgiat, kdkotama, thang, '' as kode, concat('1',kdsatker,kdprogram,kdgiat,kdoutput,kdakun, kdsakun) as display, concat('- ',nmsakun) as uraian,  
sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi 
FROM hibah 
where  kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' 
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
	
	$romawi=1;
    $tempRomawi = null;
		
while($k = mysql_fetch_array($ok)){

    $pagu	 = number_format($k[pagu],0,',','.');
	$revisi	 = number_format($k[revisi],0,',','.');
	$hasil	 = number_format($k[pagurevisi],0,',','.');
	
	$uraian = strtoupper($k[uraian]);
		
	$str = $k[display];
    $pj = strlen($str);
	
	//--------------------


	
	if ($pj=='7') print"<tr bgcolor='#fcfcc0'>"; else print"<tr>";
	
	if ($pj=='7') {	
		
		print "<td  valign='top' ><b>$romawi.</b></td>";
       
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj=='9') {	
		if($tempRomawi != $romawi)
		{
			$no='a';
			$tempRomawi = $romawi;
		}else{
		
		}	
		print "<td  valign='top' align='center'><b>$no.</b></td>";
		
		$tempNo = $no;
        $no++;		
		
	} else if ($pj=='13') {	
		if ($tempNo != $no) 
		{
			$abjad='1';
			$tempNo = $no;
			$tempRomawi = $romawi;
		}else{
		
		}
		print "<td  valign='top' align='center'><b>$abjad)</b></td>";
			$tempAbjad = $abjad;
		    $abjad++;
	
	
	
	} else if ($pj=='16') {	
		if($tempAbjad != $abjad)
		{
			$nomor='a';
			$tempAbjad = $abjad;
		}else{
			$nomor++;	
		}
	    print "<td  valign='top' align='right'><b>$nomor)</b></td>";
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
		
		
		 print "<td  valign='top'>";              if ($pj<'23') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'23') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'23') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'23') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'23') print "<b>$hasil</b>"; else print "$hasil"; print"</td>";
		
		print "</tr>";	
	//$no++;	
   }
	print "</table><br>"; 
?>