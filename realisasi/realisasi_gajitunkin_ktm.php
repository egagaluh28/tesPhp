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
		 
print "<br><table  width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>REALISASI GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA S.D 
$nmbulan $_GET[thang]</td></tr></table><br>";	

$query= "SELECT a.kdsatker as display, b.nmsatkr as uraian, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
left join (select  kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', '511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by kdkotama, kdsatker, thang) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245', '512411') group by a.kdkotama, a.kdsatker, a.thang
union
SELECT concat(a.kdsatker,'1') as display, 'Gaji dan Tunjangan' as uraian, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', '511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by kdkotama, kdsatker, thang) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by a.kdkotama, a.kdsatker, a.thang
union
SELECT concat(a.kdsatker,'2') as display, 'Tunjangan Kinerja' as uraian, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' and kdakun='512411' group by kdkotama, kdsatker, thang) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun='512411' group by a.kdkotama, a.kdsatker, a.thang

order by display";



		$ok = mysql_query($query);
		
		
	print "<div class='codehim-tombol-biru'>";	
	print "<form name='form1' method='GET'  action='realisasi/kirimparameter_gajitunkinktm.php' >";
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
				<div class='form-style-2'><form name='form1' action='cetak/cetak_realisasi_gajitunkin_ktm.php' method='GET' target='_blank'>";
	print " <input name='kdkotama' type='hidden' value='$_SESSION[kdkotama]'  />";
	print " <input name='kdsatker' type='hidden' value='$_SESSION[kdsatker]'  />		
			<input name='thang' type='hidden' value='$_GET[thang]'  />
			<input name='kdbulan' type='hidden' value='$_GET[kdbulan]' />
			LAMPIRAN : <input name='lamp' type='text' class='input-field' size='3' style='text-align: center;'/>
				&nbsp;&nbsp;<input  type='submit' value='&nbsp;Cetak&nbsp;' /></form></div>
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
	
	
	
	$no='a';
	$tempNo = null;
	
	$romawi='1';
    $tempRomawi = null;
	
while($k = mysql_fetch_array($ok)){

	$stlhrevisi	 = $k[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	$penarikan	 = number_format($k[penarikan],0,',','.');
	$turah = $k[pagurevisi] - $k[penarikan];
	$sisa	 = number_format($turah,0,',','.');
	
//	$jstlhrevisi += $k[pagurevisi];
//	$jhasil	 = number_format($jstlhrevisi,0,',','.');
	
//	$jpenarikanx += $k[penarikan];
//	$jpenarikan	 = number_format($jpenarikanx,0,',','.');
	
//	$jturahx += $turah;
 //   $jturah	 = number_format($jturahx,0,',','.');	
	
	$str = $k['display'];
    $pj = strlen($str);
	
	print"<tr>";
	if ($pj=='6') {	
		
		print "<td  valign='top' align='center'><b>$romawi.</b></td>";
        
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj=='7')  {	
		if($tempRomawi != $romawi)
		{
			$no='a';
			$tempRomawi = $romawi;
		}else{
		
		}	
		print "<td  valign='top' align='right'>$no.</td>";
		
		$tempNo = $no;
        $no++;		
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
	
	
		if ($pj=='6') {	
			print "<td  valign='top' ><b>$k[uraian]</b></td>";
			print "<td  valign='top' align='right'><b>$hasil</b></td>";
			print "<td  valign='top' align='right'><b>$penarikan</b></td>";
			print "<td  valign='top' align='right'><b>$sisa</b></td>";
		} else {
			print "<td  valign='top' >$k[uraian]</td>";
			print "<td  valign='top' align='right'>$hasil</td>";
			print "<td  valign='top' align='right'>$penarikan</td>";
			print "<td  valign='top' align='right'>$sisa</td>";
			
		}	
		print "<td  valign='top' align='right'></td>";	
	
						
		print "</tr>";
		$no++;
   }
   
   $jml=mysql_query("select z.kdkotama, z.thang, sum(z.pagurevisi) as pagurevisi , sum(z.penarikan) as penarikan from(SELECT a.thang, a.kdkotama,  a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdkotama,  thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411') group by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411') group by a.kdakun) as z where z.kdkotama='$_SESSION[kdkotama]'  and z.thang='$_GET[thang]'"); 
$x = mysql_fetch_array($jml);

		$jhasil	 = number_format($x[pagurevisi],0,',','.');
	    $jpenarikan  = number_format($x[penarikan],0,',','.');
	
	    $turahanx = $x[pagurevisi] - $x[penarikan];
	    $jturahan  = number_format($turahanx,0,',','.');
   
   print"<tr>";
		print "<td  valign='top' align='right'></td>";
		print "<td  valign='top' ><b>JUMLAH</b></td>";
		print "<td  valign='top' align='right'><b>$jhasil</b></td>";
		print "<td  valign='top' align='right'><b>$jpenarikan</b></td>";
		print "<td  valign='top' align='right'><b>$jturahan</b></td>";
		print "<td  valign='top' align='right'></td>";		
  print "</tr>";
  
  
  
$jml="SELECT concat(a.kdkotama,'1') as display, 'Gaji dan Tunjangan' as uraian, a.thang, a.kdkotama, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama,  thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', '511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by kdkotama, thang) as c on  a.kdkotama=c.kdkotama and  a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222','511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245') group by a.kdkotama,  a.thang
union
SELECT concat(a.kdkotama,'2') as display, 'Tunjangan Kinerja' as uraian, a.thang, a.kdkotama,  sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select  kdkotama,  thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' and kdakun='512411' group by kdkotama,  thang) as c on  a.kdkotama=c.kdkotama and  a.thang=c.thang 
where  a.kdkotama='$_SESSION[kdkotama]'  and a.thang='$_GET[thang]' and a.kdakun='512411' group by a.kdkotama,  a.thang order by display";

		$hasil = mysql_query($jml);

 $noo='a';
 while($data = mysql_fetch_array($hasil)){  
 
	$stlhrevisi1	 = $data[pagurevisi];
	$hasil1	 = number_format($stlhrevisi1,0,',','.');
	$penarikan1	 = number_format($data[penarikan],0,',','.');
	$turah1 = $data[pagurevisi] - $data[penarikan];
	$sisa1	 = number_format($turah1,0,',','.');
		
		print"<tr>";
			print "<td  valign='top' align='right'>$noo.</td>";
			print "<td  valign='top' >$data[uraian]</td>";
			print "<td  valign='top' align='right'>$hasil1</td>";
			print "<td  valign='top' align='right'>$penarikan1</td>";
			print "<td  valign='top' align='right'>$sisa1</td>";
			print "<td  valign='top' align='right'></td>";
		print"</tr>";
		$noo++;
 }
 
 //-------------------------------------------jumlah bawah--------------------------------
 
 
 
	print "</table><br>"; 
?>