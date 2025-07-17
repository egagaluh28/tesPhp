<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<link href="tooltip/tooltip.css" rel="stylesheet" type="text/css" />
 <script src="tooltip/tooltip.js" type="text/javascript"></script>
<style>
a:link {
color:#666;
}
</style>
<?
         $bln = mysql_query("select nmbulan from t_bulan where kdbulan='01'");
		 $x    = mysql_fetch_array($bln);
		 $nmbulan = strtoupper($x[nmbulan]);
		 
print "<br><table  width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>REALISASI GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA S.D 
$nmbulan $_GET[thang]</td></tr></table><br>";	

$query= "SELECT 'Gaji dan Tunjangan' as uraian, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by kdkotama, kdsatker, thang) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by a.kdkotama, a.kdsatker, a.thang
union
SELECT 'Tunjangan Kinerja' as uraian, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' and kdakun='512411' group by kdkotama, kdsatker, thang) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' and a.kdakun='512411' group by a.kdkotama, a.kdsatker, a.thang
";



		$ok = mysql_query($query);
		
		
	print "<div class='codehim-tombol-biru'>";	
	print "<form name='form1' method='GET'  action='realisasi/kirimparameter_gajitunkinsatker.php' >";
	print  	"<table width='75%'   align='center'><tr >
	
			<td class='subyek1'>BULAN : ";
	print "<select name='kdbulan'  class='sendiri' >";
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
	print "TAHUN : <select name='thang' class='sendiri'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2025;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses' /></form>"; 									
	print "</td>

				<td align='right' class='subyek1'>
				<div class='form-style-2'><form name='form1' action='cetak/cetak_realisasi_gajitunkin.php' method='GET' target='_blank'>";
	print " <input name='kdkotama' type='hidden' value='$_SESSION[kdkotama]'  />
			<input name='kdsatker' type='hidden' value='$_SESSION[kdsatker]' />
			<input name='thang' type='hidden' value='$_GET[thang]'  />
			<input name='kdbulan' type='hidden' value='$_GET[kdbulan]' />
			LAMPIRAN : <input name='lamp' type='text' class='input-field' size='3' style='text-align: center;'/>
				&nbsp;&nbsp;<input  type='submit' value='CETAK' /></form></div>
			</tr>
			</table></center></div>";	

	print "<table width='75%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'   >NO</th>";
	print    "<th   align='center'   >URAIAN</th>";
	print    "<th   align='center'   >PAGU SETELAH<br>REVISI</th>";
	print    "<th   align='center'   >REALISASI<br>S.D $nmbulan $_GET[thang]</th>";
	print    "<th   align='center'   >SISA</th>";
	print    "<th   align='center'   >KET</th>";
  	print "</tr>";
	
	
	
	$no=1;
while($k = mysql_fetch_array($ok)){

	$stlhrevisi	 = $k[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	$penarikan	 = number_format($k[penarikan],0,',','.');
	$turah = $k[pagurevisi] - $k[penarikan];
	$sisa	 = number_format($turah,0,',','.');
	
	$jstlhrevisi += $k[pagurevisi];
	$jhasil	 = number_format($jstlhrevisi,0,',','.');
	
	$jpenarikanx += $k[penarikan];
	$jpenarikan	 = number_format($jpenarikanx,0,',','.');
	
	$jturahx += $turah;
    $jturah	 = number_format($jturahx,0,',','.');	
	
	print"<tr>";
		print "<td  valign='top' align='right'>$no.</td>";
		print "<td  valign='top' >$k[uraian]</td>";
		print "<td  valign='top' align='right'>$hasil</td>";
		print "<td  valign='top' align='right'>$penarikan</td>";
		print "<td  valign='top' align='right'>$sisa</td>";
		print "<td  valign='top' align='right'></td>";
		
	
						
		print "</tr>";
		$no++;
   }
   
  
   
   print"<tr>";
		print "<td  valign='top' align='right'></td>";
		print "<td  valign='top' ><b>Jumlah</b></td>";
		print "<td  valign='top' align='right'><b>$jhasil</b></td>";
		print "<td  valign='top' align='right'><b>$jpenarikan</b></td>";
		print "<td  valign='top' align='right'><b>$jturah</b></td>";
		print "<td  valign='top' align='right'></td>";
		
	
						
		print "</tr>";
   
	print "</table><br>"; 
?>