

<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />


<?
         $bln = mysql_query("select nmbulan from t_bulan where kdbulan='$_GET[kdbulan]'");
		 $x    = mysql_fetch_array($bln);
		 $nmbulan = strtoupper($x[nmbulan]);
		 
  
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>REALISASI ANGGARAN S.D 
$nmbulan $_GET[thang]</td></tr></table><br>";	

$query= "SELECT '' as id_pagu,  a.kdwasgiat, a.kdkotama,  a.thang, '' as kode, '1' as display,  'SBSN' as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join(select a.kdkotama, a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.thang) as c on a.thang=c.thang 
left join(select a.kdkotama, a.thang, sum(b.realisasi) as blnini  from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]'  and a.thang='$_GET[thang]' group by a.thang) as d on a.thang=d.thang 
where a.thang='$_GET[thang]' 
group by a.thang

union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,  a.thang, '' as kode, concat('1',a.kdkotama) as display, b.nmkotama as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join t_kotam b on a.kdkotama=b.kdkotama
left join (select a.kdsatker, a.kdkotama,  a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama) as c on  a.kdkotama=c.kdkotama and a.thang=c.thang 
left join (select a.kdsatker, a.kdkotama,  a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama) as d on  a.kdkotama=d.kdkotama and a.thang=d.thang 
where   a.thang='$_GET[thang]' 
group by a.kdkotama)

union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,  a.thang, '' as kode, concat('1',a.kdkotama,a.kdsatker) as display, b.nmsatkr as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
left join (select a.kdsatker, a.kdkotama,  a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama,a.kdsatker) as c on  a.kdkotama=c.kdkotama and a.thang=c.thang and  a.kdsatker=c.kdsatker
left join (select a.kdsatker, a.kdkotama,  a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama,a.kdsatker) as d on  a.kdkotama=d.kdkotama and a.thang=d.thang and  a.kdsatker=d.kdsatker
where  a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker)

union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama,  a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdkotama,a.kdsatker, a.kdprogram) as display, b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select a.kdprogram, a.kdkotama,  a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]'  and a.thang='$_GET[thang]' group by a.kdsatker, a.kdprogram) as c on  a.kdprogram=c.kdprogram and a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker
left join (select a.kdprogram, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]'  and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.kdprogram) as d on  a.kdprogram=d.kdprogram and a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker
where  a.thang='$_GET[thang]' 
group by a.kdkotama, a.kdsatker, a.kdprogram)

union (SELECT '' as id_pagu, a.kdwasgiat, a.kdkotama, a.thang, a.kdgiat as kode, concat('1',a.kdkotama,a.kdsatker,a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select a.kdprogram, a.kdgiat, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama,a.kdsatker, a.kdprogram,a.kdgiat) as c on  a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat and a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker
left join (select a.kdprogram, a.kdgiat, a.kdkotama,  a.kdsatker, a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama,a.kdsatker, a.kdprogram,a.kdgiat) as d on  a.kdprogram=d.kdprogram and  a.kdgiat=d.kdgiat and a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker
where a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker, a.kdprogram,a.kdgiat)

union (SELECT '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.thang, concat(a.kdoutput,'.',a.kdakun) as kode, concat('1',a.kdkotama, a.kdsatker, a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, concat('> ',a.nmakun) as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 
left join (select a.kdgiat, a.kdoutput, a.kdakun,  a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.kdgiat,a.kdoutput, a.kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker
left join (select a.kdgiat, a.kdoutput, a.kdakun,  a.kdkotama,  a.kdsatker, a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]'   
and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.kdgiat,a.kdoutput, a.kdakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker
where   a.thang='$_GET[thang]' group by  a.kdkotama, a.kdsatker,a.kdgiat,a.kdoutput,a.kdakun)

union (SELECT '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.thang, '' as kode, concat('1',a.kdkotama,a.kdsatker,a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, concat('- ',a.nmsakun) as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM sbsn a 

left join (select a.kdgiat, a.kdoutput, a.kdakun, a.kdsakun, a.kdkotama, a.kdsatker,  a.thang, sum(b.realisasi) as blnlalu from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and  a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker,a.kdgiat,a.kdoutput, a.kdakun,a.kdsakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun and a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker

left join (select a.kdgiat, a.kdoutput, a.kdakun, a.kdsakun, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from sbsn a left join realisasi_sbsn b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and  a.thang='$_GET[thang]' group by a.kdkotama,a.kdsatker,a.kdgiat,a.kdoutput, a.kdakun,a.kdsakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun  and a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker

where  a.thang='$_GET[thang]' 
group by  a.kdkotama, a.kdsatker,a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun) order by display";

		$ok = mysql_query($query);

	print "<table width='97%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'  rowspan='2' >NO</th>";
	print    "<th   align='center'  rowspan='2' >URAIAN</th>";
	print    "<th   align='center'  rowspan='2'  width='30'>KODE</th>";
	print    "<th   align='center'  rowspan='2'  width='125'>PAGU</th>";
	print    "<th   align='center'  rowspan='2' width='125'>REVISI (+/-)</th>";
	print    "<th   align='center'   rowspan='2'  width='125'>PAGU STLH REVISI</th>";
	print    "<th   align='center' valign='middle'  colspan='3'>REALISASI</th>";
    print    "<th   align='center'  rowspan='2' >SISA</th>";
  	print "</tr>";
	print "<tr>";
	print    "<th   align='center'   >S.D. BLN LALU</th>";
	print    "<th   align='center'    >BLN INI</th>";
	print    "<th   align='center'   >S.D. BLN INI</th>";
    print "</tr>";
	
	$no=1;
	$tempNo = null;


while($k = mysql_fetch_array($ok)){

    $pagu	 = number_format($k[pagu],0,',','.');
	$revisi	 = number_format($k[revisi],0,',','.');
	$stlhrevisi	 = $k[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$blnlalu = number_format($k[blnlalu],0,',','.');
	$blnini	 = number_format($k[blnini],0,',','.');
	$blnsdi	 = $k[blnlalu] + $k[blnini];
	$hasil1  = number_format($blnsdi,0,',','.');
	
	$turahan = $stlhrevisi - $blnsdi;
	$sisa  = number_format($turahan,0,',','.');

	$str = $k[display];
    $pj = strlen($str);
	
	 
	
	
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
		
		$uraian = strtoupper($k[uraian]);
		 
		 print "
				<td  valign='top'>"; if ($pj<'25') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$hasil</b>"; else print "$hasil"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$blnlalu</b>"; else print "$blnlalu"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$blnini</b>"; else print "$blnini"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$hasil1</b>"; else print "$hasil1"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'25') print "<b>$sisa</b>"; else print "$sisa"; print"</td>";

		print "</tr>";
		
	//$no++;	
	
	
   }
	print "</table><br>"; 
  

?>

