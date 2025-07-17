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
		 $nmbulan = strtoupper($x[nmbulan]);
		 
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>REALISASI ANGGARAN S.D 
$nmbulan $_GET[thang]</td></tr></table><br>";	

$query= "select a.kdprogram, a.nmprogram, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from t_program a
left join (select kdprogram, sum(pagurevisi) as pagu51 from dipa where  thang='$_GET[thang]' and kdjenbel='51' group by kdprogram) as b on a.kdprogram=b.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='51' group by a.kdprogram) as b1 on a.kdprogram=b1.kdprogram
left join (select kdprogram, sum(pagurevisi) as pagu52 from dipa where  thang='$_GET[thang]' and kdjenbel='52' group by kdprogram) as c on a.kdprogram=c.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='52' group by a.kdprogram) as c1 on a.kdprogram=c1.kdprogram
left join (select kdprogram, sum(pagurevisi) as pagu53 from dipa where  thang='$_GET[thang]' and kdjenbel='53' group by kdprogram) as d on a.kdprogram=d.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='53' group by a.kdprogram) as d1 on a.kdprogram=d1.kdprogram
where a.kdprogram<>'12' group by a.kdprogram";

		$ok = mysql_query($query);
		
	print  	"<table width='97%'   align='center'><tr >
				<td align='right' class='subyek1'>
				<div class='form-style-2'><form name='form1' action='cetak/cetak_progrealisasi_uo.php' method='GET' target='_blank'>";
	print " <input name='thang' type='hidden' value='$_GET[thang]'  />
			<input name='kdbulan' type='hidden' value='$_GET[kdbulan]' />
			LAMPIRAN : <input name='lamp' type='text' class='input-field' size='3' style='text-align: center;'/>
				&nbsp;&nbsp;<input  type='submit' value='CETAK' class='button green' /></form></div>
			</tr>
			</table></center>";	

	print "<table width='97%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'  rowspan='3' >NO</th>";
	print    "<th   align='center'  rowspan='3' >PROGRAM</th>";
	print    "<th   align='center'  colspan='8' >PAGU DAN REALISASI PER JENIS BELANJA</th>";
	
  	print "</tr>";
	
	print "<tr>";
	print    "<th   align='center'  colspan='2'>51 BELANJA PEGAWAI</th>";
	print    "<th   align='center'  colspan='2'>52 BELANJA BARANG</th>";
	print    "<th   align='center'  colspan='2'>53 BELANJA MODAL</th>";
	print    "<th   align='center'  colspan='2'>57 BELANJA BANTUAN SOSIAL</th>";
    print "</tr>";
	
	
	print "<tr>";
	print    "<th   align='center' >PAGU DIPA</th>";
	print    "<th   align='center' >REALISASI</th>";
	print    "<th   align='center' >PAGU DIPA</th>";
	print    "<th   align='center' >REALISASI</th>";
	print    "<th   align='center' >PAGU DIPA</th>";
	print    "<th   align='center' >REALISASI</th>";
	print    "<th   align='center' >PAGU DIPA</th>";
	print    "<th   align='center' >REALISASI</th>";
    print "</tr>";
	
	$no=1;
while($k = mysql_fetch_array($ok)){

    $pagu51	 = number_format($k[pagu51],0,',','.');
	$real51	 = number_format($k[real51],0,',','.');
	
	$pagu52	 = number_format($k[pagu52],0,',','.');
	$real52	 = number_format($k[real52],0,',','.');
	
	$pagu53	 = number_format($k[pagu53],0,',','.');
	$real53	 = number_format($k[real53],0,',','.');
	
	
	print"<tr>";
		print "<td  valign='top' align='right'>$no.</td>";
		print "<td  valign='top' >$k[nmprogram]</td>";
		print "<td  valign='top' align='right'>$pagu51</td>";
		print "<td  valign='top' align='right'>$real51</td>";
		print "<td  valign='top' align='right'>$pagu52</td>";
		print "<td  valign='top' align='right'>$real52</td>";
		print "<td  valign='top' align='right'>$pagu53</td>";
		print "<td  valign='top' align='right'>$real53</td>";
		print "<td  valign='top' align='right'>0</td>";
		print "<td  valign='top' align='right'>0</td>";
	
						
		print "</tr>";
		$no++;
   }
   
   $jml= "select   a.thang, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from dipa a

left join (select  thang, sum(pagurevisi) as pagu51 from dipa  where  thang='$_GET[thang]' and kdjenbel='51' group by  thang) as b on  a.thang=b.thang

left join (select  a.thang, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]'  and a.thang='$_GET[thang]' and a.kdjenbel='51' group by   a.thang) as b1 on  a.thang=b1.thang

left join (select   thang, sum(pagurevisi) as pagu52 from dipa  where  thang='$_GET[thang]' and kdjenbel='52' group by   thang) as c on  a.thang=c.thang

left join (select   a.thang, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'  and a.thang='$_GET[thang]' and a.kdjenbel='52' group by    a.thang) as c1 on  a.thang=c1.thang

left join (select   thang, sum(pagurevisi) as pagu53 from dipa  where  thang='$_GET[thang]' and kdjenbel='53' group by   thang) as d on   a.thang=d.thang

left join (select   a.thang, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='53' group by   a.thang) as d1 on  a.thang=d1.thang

where   a.thang='$_GET[thang]'
group by   a.thang";

		$hasil = mysql_query($jml);
		
		$row    = mysql_fetch_array($hasil);
		
	$jpagu51	 = number_format($row[pagu51],0,',','.');
	$jreal51	 = number_format($row[real51],0,',','.');
	
	$jpagu52	 = number_format($row[pagu52],0,',','.');
	$jreal52	 = number_format($row[real52],0,',','.');
	
	$jpagu53	 = number_format($row[pagu53],0,',','.');
	$jreal53	 = number_format($row[real53],0,',','.');
   
   print"<tr>";
		print "<td  valign='top' align='right'></td>";
		print "<td  valign='top' >Jumlah</td>";
		print "<td  valign='top' align='right'>$jpagu51</td>";
		print "<td  valign='top' align='right'>$jreal51</td>";
		print "<td  valign='top' align='right'>$jpagu52</td>";
		print "<td  valign='top' align='right'>$jreal52</td>";
		print "<td  valign='top' align='right'>$jpagu53</td>";
		print "<td  valign='top' align='right'>$jreal53</td>";
		print "<td  valign='top' align='right'>0</td>";
		print "<td  valign='top' align='right'>0</td>";
	
						
		print "</tr>";
   
	print "</table><br>"; 
?>