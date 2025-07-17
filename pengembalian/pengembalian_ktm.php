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

$query= "SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama,  a.thang, '' as kode, '1' as display,  'RUPIAH MURNI' as uraian, sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join(select kdkotama,  thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,thang) as c on a.kdkotama=c.kdkotama   and a.thang=c.thang 
left join(select kdkotama,  thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,thang) as c1 on a.kdkotama=c1.kdkotama and   a.thang=c1.thang 
left join(select kdkotama,  thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' group by kdkotama,thang) as d on a.kdkotama=d.kdkotama and   a.thang=d.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.pengembalian='x' 
group by a.kdkotama,  a.thang
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama,   a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdprogram) as display, b.nmprogram as uraian,  sum(a.pagurevisi) as pagurevisi, '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select kdprogram, kdkotama,  thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c on a.kdprogram=c.kdprogram
left join (select kdprogram, kdkotama, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c1 on a.kdprogram=c1.kdprogram
left join (select kdprogram, kdkotama, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' group by kdprogram) as d on a.kdprogram=d.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.pengembalian='x' group by a.kdprogram)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama,  a.thang, a.kdgiat as kode, concat('1',a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select kdprogram, kdgiat, kdkotama, thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat
left join (select kdprogram, kdgiat, kdkotama,  thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat
left join (select kdprogram, kdgiat, kdkotama,  thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' group by kdprogram,kdgiat) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama,  a.thang, a.kdoutput as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama,  thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput
left join (select kdprogram, kdgiat, kdoutput, kdkotama,  thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' group by kdprogram,kdgiat,kdoutput) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]'   and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat,a.kdoutput)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama,   a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, a.nmakun as uraian,   sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama,   thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama,   thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun
left join (select kdgiat, kdoutput, kdakun,  kdkotama,   thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]' and   a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama,  a.thang, '' as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, concat('-',' ', a.nmsakun) as uraian,  
sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama,   thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun and a.kdsakun=c1.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'   and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun,kdsakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun) order by display";

		$ok = mysql_query($query);
		
	print  	"<table width='97%'  cellspacing='0' cellpadding='2' align='center' ><tr>";
			
			
			print "<form name='form1' method='GET'  action='pengembalian/kirimparameter_ktm.php' >";
 print "<input type='hidden'  name='kdkotama'   class='roundedisi'  value='$_SESSION[kdkotama]' />";
 print "<input type='hidden'  name='kdsatker'   class='roundedisi'  value='000000' />";
	print "<td class='subyek1' align='left'>";

				print "<div class='form-style-2'>
						BULAN : <select name='kdbulan'  class='select-field' >";
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
			<form name='form1' action='cetak/cetak_pengembalian_ktm.php' method='GET' target='_blank'>";
	print " <input name='kdkotama' type='hidden' value='$_SESSION[kdkotama]'  />
	       <input type='hidden'  name='kdsatker'   value='000000' />
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
//	
//	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
//	$prosen     = 0; 
 //   } else { 
//	$prosen 	= (($netto/$k[pagurevisi])*100);
//	}
//	$prosen_des	= number_format($prosen,2,',','.');
//	$prosen_des0= number_format($prosen,0,',','.');
	
	
	$turahan = $stlhrevisi - $k[realisasi2];
	$sisa  = number_format($turahan,0,',','.');
	
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
				 if ($pj<'17') print "<b>$k[uraian]</b>"; else 	print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$hasil</b>"; else print "$hasil"; print"</td>";
				
			
				
				print "<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$realisasi2</b>"; else print "$realisasi2"; print"</td>";
				
				print "<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$sisa</b>"; else print "$sisa"; print"</td>";
				
								
				print "<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$jml_pengembalian</b>"; else print "$jml_pengembalian"; print"</td>";
				
			
				
				
				print "<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$saldo</b>"; else print "$saldo"; print"</td>";
				 	
				

	
		
		print "</tr>";
   }
	print "</table><br>"; 
?>