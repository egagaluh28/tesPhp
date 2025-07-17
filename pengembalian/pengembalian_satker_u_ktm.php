<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<link href="tooltip/tooltip.css" rel="stylesheet" type="text/css" />
 <script src="tooltip/tooltip.js" type="text/javascript"></script>
<style>
a:link {
color:#666;
}
</style>
<?
        
         $bln = mysql_query("select nmbulan from t_bulan where kdbulan='$_GET[kdbulan]'");
		 $x    = mysql_fetch_array($bln);
		 
		 $sasi = strtoupper($x[nmbulan]);
		 
   
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>LAPORAN PENGEMBALIAN BELANJA<br>BULAN $sasi $_GET[thang]</td></tr></table>";	

$query= "SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, '' as kode, '1' as display,  'RUPIAH MURNI' as uraian, sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c1 on a.kdkotama=c1.kdkotama and a.kdsatker=c1.kdsatker and a.thang=c1.thang 
left join(select kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama,kdsatker,thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.pengembalian='x' 
group by a.kdkotama, a.kdsatker, a.thang
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdprogram) as display, b.nmprogram as uraian,  sum(a.pagurevisi) as pagurevisi, '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c on a.kdprogram=c.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c1 on a.kdprogram=c1.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram) as d on a.kdprogram=d.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.pengembalian='x' group by a.kdprogram)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdgiat as kode, concat('1',a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram,kdgiat) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdoutput as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput
left join (select kdprogram, kdgiat, kdoutput, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram,kdgiat,kdoutput) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat,a.kdoutput)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, a.nmakun as uraian,   sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, a.nmsakun as uraian,  
sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun and a.kdsakun=c1.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun,kdsakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)
union (SELECT a.pengembalian, a.id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, '' as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display, concat('-',' ', a.nmitem) as uraian,  sum(a.pagurevisi) as pagurevisi,  c.id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa  a
left join (select  id_pagu, id_realisasi, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]'  and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select  id_pagu, id_realisasi, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]'  and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by id_pagu) as c1 on a.id_pagu=c1.id_pagu
left join (select  id_pagu, id_realisasi, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]'  and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x'  group by a.id_pagu order by a.noitem) order by display";

		$ok = mysql_query($query);
		
	print  	"<table width='97%'  cellspacing='0' cellpadding='2' align='center' ><tr>";
			
			
			print "<form name='form1' method='GET'  action='pengembalian/kirimparameter_satker_u_ktm.php' >";
 print "<input type='hidden'  name='kdkotama'   class='roundedisi'  value='$_SESSION[kdkotama]' />";

	print "<td class='subyek1' align='left'>";
	

	

				print "<div class='form-style-2'>";
				print "SATKER : <select name='kdsatker'  class='select-field' >";
						print "<option value='' selected>- - Pilih Satker - -</option>";
						 $sql="select * from t_satkr where kdkotama='$_SESSION[kdkotama]' order by kdsatkr";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsatkr]==$_GET[kdsatker])
							echo "<option value=$data[kdsatkr] selected>$data[nmsatkr]</option>";
						 else
							echo "<option value=$data[kdsatkr]>$data[nmsatkr]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	
						print "BULAN : <select name='kdbulan'  class='select-field' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_GET[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	print "TAHUN : <select name='thang' class='select-field'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2020;$thn<=2025;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses' class='button green'/>"; 									
	
	print "</form> 
			
			</div>
			</td>";
	
	
		print	"<td align='right' class='subyek1'>
		<div class='form-style-2'>
			<form name='form1' action='cetak/cetak_pengembalian_satker.php' method='GET' target='_blank'>";
	print " <input name='kdkotama' type='hidden' value='$_SESSION[kdkotama]'  />
			<input name='kdsatker' type='hidden' value='$_GET[kdsatker]' />
			<input name='thang' type='hidden' value='$_GET[thang]'  />
			<input name='kdbulan' type='hidden' value='$_GET[kdbulan]' />
			LAMPIRAN : <input name='lamp' type='text' class='input-field' size='3' style='text-align: center;'/>
				&nbsp;&nbsp;<input  type='submit' value='CETAK' class='button green' /></form></div>
			</tr>
			</table></center>";		

	print "<table width='97%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center' >NO</th>";
	print    "<th   align='center'  >URAIAN</th>";
	print    "<th   align='center'  width='30'>KODE</th>";
	print    "<th   align='center'  >PAGU STLH REVISI</th>";
	print    "<th   align='center'  >REALISASI</th>";
	print    "<th   align='center'  >SISA DANA</th>";
	print    "<th   align='center'  >JML PENGEMBALIAN</th>";
	print    "<th   align='center'  >SISA STLH PENGEMBALIAN</th>";
  	print "</tr>";
	
	
	
	
	$no=1;
	$tempNo = null;
while($k = mysql_fetch_array($ok)){

  // $pagu	 = number_format($k[pagu],0,',','.');
	//$revisi	 = number_format($k[revisi],0,',','.');
	$stlhrevisi	 = $k[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$realisasi = number_format($k[realisasi],0,',','.');
	$realisasi2 = number_format($k[realisasi2],0,',','.');
	$jml_pengembalian = number_format($k[jml_pengembalian],0,',','.');
	
//	$netto = $k[realisasi2] - $k[jml_pengembalian];
//	$netto_rb = number_format($netto,0,',','.');
	
//	if (($netto=='') or ($netto=='0')) {
//	$prosen     = 0; 
 //   } else { 
//	$prosen 	= (($netto/$k[pagurevisi])*100);
//	}
//	$prosen_des	= number_format($prosen,2,',','.');
//	$prosen_des0= number_format($prosen,0,',','.');

	$turahan = $stlhrevisi - $k[realisasi2];
	$sisa  = number_format($turahan,0,',','.');
	
	
	//$turahan = $stlhrevisi - $netto;
	//$sisa  = number_format($turahan,0,',','.');
	
	$akhir = $turahan - $k[jml_pengembalian];
	$saldo =number_format($akhir,0,',','.');

	$str = $k[display];
    $pj = strlen($str);
	
	$romawi=1;
    $tempRomawi = null;
	
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
		
		 print "<td  valign='top' >"; 
				 if ($pj<'19') print "<b>$k[uraian]</b>"; else 
				print "<a href='#' onmouseover=tooltip.ajax(this,'info/wasgiat.php?kdwasgiat=$k[kdwasgiat]') onmouseleave='tooltip.hide()' style='text-decoration:none'>$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$hasil</b>"; else print "$hasil"; print"</td>
				
				
				<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$realisasi2</b>"; else print "$realisasi2"; print"</td>";
				
				print "<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$sisa</b>"; else print "$sisa"; print"</td>";
								
				print "<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$jml_pengembalian</b>"; else print "$jml_pengembalian"; print"</td>";
				
				print "<td  valign='top' align='right'>"; if ($pj<'19') print "<b>$saldo</b>"; else print "$saldo"; print"</td>";
				
				
				
				
		
		print "</tr>";
   }
	print "</table><br>"; 
?>