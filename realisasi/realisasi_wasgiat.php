<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
         $bln = mysql_query("select nmbulan from t_bulan where kdbulan='$_GET[kdbulan]'");
		 $x    = mysql_fetch_array($bln);
		 $nmbulan = strtoupper($x[nmbulan]);
		 
		  switch ($_GET['kdwasgiat']) {
case "01" : $bidang="INTELIJEN";break;
case "02" : $bidang="OPERASI";break;
case "03" : $bidang="PERSONEL";break;
case "04" : $bidang="LOGISTIK";break;
case "05" : $bidang="TERITORIAL";break;
case "06" : $bidang="PERENCANAAN";break;
case "07" : $bidang="LATIHAN";break;
}
		    
print "<br><table  width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>REALISASI ANGGARAN DIPA PETIKAN SATKER BIDANG $bidang<br> 
BULAN $nmbulan TAHUN $_GET[thang]</td></tr></table><br>";	

$query= "SELECT  a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, '' as kode, '1' as display,  'RUPIAH MURNI' as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join(select kdkotama, kdsatker,  kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdkotama, kdsatker, thang, kdwasgiat) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker  and a.thang=c.thang and a.kdwasgiat=c.kdwasgiat
left join(select kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnini  from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdkotama, kdsatker, thang, kdwasgiat) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdwasgiat=d.kdwasgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]' group by a.kdkotama, a.kdsatker, a.thang, a.kdwasgiat
union (SELECT a.kdwasgiat, a.kdkotama, a.kdsatker,   a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdprogram) as display, b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select kdprogram, kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram) as c on  a.kdprogram=c.kdprogram
left join (select kdprogram, kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnini from  realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram) as d on  a.kdprogram=d.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]'  
group by a.kdprogram)
union (SELECT a.kdwasgiat, a.kdkotama, a.kdsatker,   a.thang, a.kdgiat as kode, concat('1',a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat) as c on  a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, kdwasgiat,  thang, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat) as d on  a.kdprogram=d.kdprogram and  a.kdgiat=d.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]' 
group by a.kdprogram,a.kdgiat)
union (SELECT  a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, a.kdoutput as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join t_output b on a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput

left join (select kdprogram, kdgiat, kdoutput, kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram, kdgiat,kdoutput) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput

left join (select kdprogram, kdgiat, kdoutput, kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'   
and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram, kdgiat,kdoutput) as d on  a.kdprogram=d.kdprogram  and a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput 

where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]' group by  a.kdprogram, a.kdgiat,a.kdoutput)

union (SELECT  a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, a.nmakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdgiat,kdoutput, kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'   
and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdgiat,kdoutput, kdakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]' group by  a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun)
union (SELECT  a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, concat('> ',a.nmsakun) as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker,kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and  thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdgiat,kdoutput, kdakun,kdsakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama,  kdsatker,kdwasgiat, thang, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and  thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdgiat,kdoutput, kdakun,kdsakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]' group by  a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun) 
union (SELECT  a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, '' kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display, concat('- ',a.nmitem) as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join (select  id_pagu,  kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and  thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by id_pagu) as c on  a.id_pagu=c.id_pagu
left join (select  id_pagu,  kdkotama, kdsatker, kdwasgiat, thang, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  and  thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by id_pagu) as d on  a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'  and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]' group by a.id_pagu order by a.noitem) 
order by display";

		$ok = mysql_query($query);
		
		
		 
		 
print "<form name='form1' method='GET'  action='realisasi/kirimparameter_wasgiat.php' >";
	
	print "<div class='codehim-tombol-biru'><table width='97%'  cellspacing='0' cellpadding='2' align='center'><tr>";
	
	print "<td class='subyek1'>WASGIAT : <select name='kdwasgiat'  class='sendiri' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_wasgiat order by kdwasgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$_GET[kdwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[nmwasgiat]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	
	
	print "BULAN : <select name='kdbulan'  class='sendiri' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_GET[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	print "TAHUN : <select name='thang' class='sendiri'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2025;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;<input  type='submit' value='Proses' />"; 							
	print "</td>";
	print "</form>"; 
	
	print "<form name='form1' method='GET'  action='cetak/cetak_prog_daerah_satker_wasgiat.php' target='_Blank'>"; 
	 print "<td class='subyek1' align='right'>";
	 print "<input type='hidden'  name='kdkotama'  readonly value='$_SESSION[kdkotama]'>"; 
     print "<input type='hidden'  name='kdsatker'  readonly value='$_SESSION[kdsatker]'>"; 
	 print "<input type='hidden'  name='kdwasgiat'  readonly value='$_GET[kdwasgiat]'>"; 
	 print "<input type='hidden'  name='kdbulan'  readonly value='$_GET[kdbulan]'>"; 
	 print "<input type='hidden'  name='thang'  readonly value='$_GET[thang]'>"; 
		
	print "LAMPIRAN : <input type='text' name='lamp'  size='3' class='sendiri' style='text-align:center;'/>";
	print "&nbsp;&nbsp;<input  type='submit' value='&nbsp;Cetak&nbsp;' />"; 									
	print "</td>";
	print "</form>";
	
	print "</tr></table></div><br>";
			 
	
//print "<table width='97%' align='center' ><tr><td class='judulsubcontent'>&nbsp;WASGIAT : $nmwasgiat</td></tr></table><br>";

	print "<table width='97%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'  rowspan='2' >NO</th>";
	print    "<th   align='center'  rowspan='2' >URAIAN</th>";
	print    "<th   align='center'  rowspan='2'  width='30'>KODE</th>";
	print    "<th   align='center'  rowspan='2' >PAGU</th>";
	print    "<th   align='center'  rowspan='2' >REVISI (+/-)</th>";
	print    "<th   align='center'   rowspan='2'  >PAGU STLH<br>REVISI</th>";
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
	
	$romawi=1;
    $tempRomawi = null;

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
	
	if ($pj=='16') print"<tr bgcolor='#fcfcc0'>"; else print"<tr>";
	
	if ($pj=='3') {	
		if ($romawi=='1') {
		print "<td  valign='top' ><b>A.</b></td>";
        } else if ($romawi=='2') {
		print "<td  valign='top' ><b>B.</b></td>";
		} else if ($romawi=='3') {
		print "<td  valign='top' ><b>C.</b></td>";			
		} else {
		print "<td  valign='top' ><b>D.</b></td>";
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
		
		
		 print "<td  valign='top'>"; 
				if ($pj=='20') print "<i>$uraian</i>"; else if ($pj<'20') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$hasil</b>"; else print "$hasil"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$blnlalu</b>"; else print "$blnlalu"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$blnini</b>"; else print "$blnini"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$hasil1</b>"; else print "$hasil1"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'20') print "<b>$sisa</b>"; else print "$sisa"; print"</td>";
		print "</tr>";	
   }
	print "</table><br>"; 
?>