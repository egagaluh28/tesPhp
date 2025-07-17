

<html>
<head>

<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />


<?
		 $satkr = mysql_query("select * from t_kotam   where kdkotama='$_GET[kdkotama]'");
		 $y   = mysql_fetch_array($satkr);
		 
		 $ktm = strtoupper($y['nmkotama']);
		
         $bln = mysql_query("select nmbulan from t_bulan where kdbulan='$_GET[kdbulan]'");
		 $x    = mysql_fetch_array($bln);
		 
		 $bln=strtoupper($x[nmbulan]);
		 

switch ($_GET[kdbulan]) {
case "01" : $bulan="31 JANUARI";break;
case "02" : $bulan=" 28 FEBRUARI";break;
case "03" : $bulan="31 MARET";break;
case "04" : $bulan="30 APRIL";break;
case "05" : $bulan="31 MEI";break;
case "06" : $bulan="30 JUNI";break;
case "07" : $bulan="31 JULI";break;
case "08" : $bulan="31 AGUSTUS";break;
case "09" : $bulan="30 SEPTEMBER"; break;
case "10" : $bulan="31 OKTOBER";break;
case "11" : $bulan="30 NOVEMBER";break;
case "12" : $bulan="31 DESEMBER";break;
}

$indbul=$bulan.' '.$_GET[thang];		 
   
print "<br><table  width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>LAPORAN PENGAWAN GAJI DAN TUNKIN $ktm <br> PERIODE 1 JANUARI S.D. $indbul</td></tr></table>";	


$query = "select x.kdakun, x.nmakun, z.thang,    z.pagurevisi, z.penarikan
from t_akun_gaji x
left join (SELECT a.thang,    a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,    thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]'     and thang='$_GET[thang]' and substr(kdakun,1,3)='511' group by kdakun order by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where    a.thang='$_GET[thang]' and substr(a.kdakun,1,3)='511' group by a.kdakun
union
(SELECT a.thang,    a.kdakun, 'Belanja Uang Lembur' as nmakun,  sum(a.pagurevisi) as pagurevisi, c.penarikan FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,    thang, sum(realisasi) as penarikan from realisasi  where kdbulan<='$_GET[kdbulan]'  and   thang='$_GET[thang]' and kdakun='512211' group by  kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where    a.thang='$_GET[thang]' and a.kdakun='512211') 
union
(SELECT a.thang,     a.kdakun, 'Tunjangan Kinerja' as nmakun,  sum(a.pagurevisi) as pagurevisi, c.penarikan FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,   thang, sum(realisasi) as penarikan from realisasi  where kdbulan<='$_GET[kdbulan]'   and thang='$_GET[thang]' and kdakun='512411' group by  kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where    a.thang='$_GET[thang]' and a.kdakun='512411')) as z on x.kdakun=z.kdakun group by x.kdakun";
		$ok = mysql_query($query);
 
print "<div class='codehim-tombol-biru'><table width='85%' align='center'  ><tr>";
				print "<form name='form1' method='GET'  action='akungaji/kirimparameter_uo.php' >";
				print "<td class='subyek1' >";

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
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses'/>"; 									
	print "</td></form>
				
				
				<td align='right' valign='middle' class='subyek1'>
				<form name='formX'  method='GET' action='cetak/cetak_akungaji_uo.php' target='_blank'>
				<input type='hidden' name='thang' value='$_GET[thang]' />
				<input type='hidden' name='kdbulan' value='$_GET[kdbulan]' />
				LAMPIRAN : <input type='text'  name='lamp' class='sendiri'  size='3' style='text-align: center;' />
	            &nbsp;<input  type='submit' value='Cetak' /></form></td>";
				print "</tr></table></div>";

	print "<table width='85%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'   >NO</th>";
	print    "<th   align='center'   width='30'>AKUN</th>";
	print    "<th   align='center'   >URAIAN</th>";
	print    "<th   align='center' width='145'>DIPA TA $_GET[thang]</th>";
	print    "<th   align='center' width='145'  >PENARIKAN S.D <br> $bln $_GET[thang]</th>";
	print    "<th   align='center' >%<br>5/4</th>";
    print    "<th   align='center' width='145'>SISA<br>(4-5)</th>";
	print    "<th   align='center' >KET</th>";

  	print "</tr>";
	
	print "<tr >";
	print    "<th   align='center'   >1</th>";
	print    "<th   align='center'   width='30'>2</th>";
	print    "<th   align='center'   >3</th>";
	print    "<th   align='center' width='145'>4</th>";
	print    "<th   align='center' width='145'  >5</th>";
	print    "<th   align='center' br>6</th>";
    print    "<th   align='center' width='145'>7</th>";
	print    "<th   align='center' >8</th>";

  	print "</tr>";
	
	$no=1;
while($k = mysql_fetch_array($ok)){	

	$hasil	 = number_format($k[pagurevisi],0,',','.');
	$hasil1  = number_format($k[penarikan],0,',','.');
	
	$turahan = $k[pagurevisi] - $k[penarikan];
	$sisa  = number_format($turahan,0,',','.');
	
	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($k[penarikan]/$k[pagurevisi])*100);
	}

	print"<tr>";
		print "<td  valign='top' align='right'>$no</td>
			   <td  valign='top' align='center'>$k[kdakun]</td>
			   <td  valign='top' >$k[nmakun]</td>
		       <td  valign='top' align='right'>$hasil</td>";
		print "<td  valign='top' align='right'>$hasil1</td>";
		print "<td  valign='top' align='center'>";
			if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
				print "0"; 
				} else { 
				$prosen 	= (($k[penarikan]/$k[pagurevisi])*100);
				$prosen_des  = number_format($prosen,2,',','.');
				print "$prosen_des";
				}	
		print "</td>";
		print "<td  valign='top' align='right'>$sisa</td>";		
		print "<td  valign='top' align='right'></td>";		
		print "</tr>";
	$no++;	
   }
   
   $jml = "select  z.thang, sum(z.pagurevisi) as pagurevisi , sum(z.penarikan) as penarikan from(SELECT a.thang,    a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,   thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]'    and thang='$_GET[thang]' and substr(kdakun,1,3)='511' group by kdakun order by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where    a.thang='$_GET[thang]' and substr(a.kdakun,1,3)='511' group by a.kdakun
union
(SELECT a.thang,   a.kdakun, 'Belanja Uang Lembur' as nmakun,  sum(a.pagurevisi) as pagurevisi, c.penarikan FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,    thang, sum(realisasi) as penarikan from realisasi  where kdbulan<='$_GET[kdbulan]'    and thang='$_GET[thang]' and kdakun='512211' group by  kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where   a.thang='$_GET[thang]' and a.kdakun='512211') 
union
(SELECT a.thang,  a.kdakun, 'Tunjangan Kinerja' as nmakun,  sum(a.pagurevisi) as pagurevisi, c.penarikan FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,   thang, sum(realisasi) as penarikan from realisasi  where kdbulan<='$_GET[kdbulan]'   and thang='$_GET[thang]' and kdakun='512411' group by  kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where   a.thang='$_GET[thang]' and a.kdakun='512411')) as z where z.thang='$_GET[thang]' ";
		$ketemu = mysql_query($jml);
		
		$x    = mysql_fetch_array($ketemu); 
		
		$hasilx	 = number_format($x[pagurevisi],0,',','.');
	    $hasil1x  = number_format($x[penarikan],0,',','.');
	
	    $turahanx = $x[pagurevisi] - $x[penarikan];
	    $sisax  = number_format($turahanx,0,',','.');
		
		$prosenx 	= (($x[penarikan]/$x[pagurevisi])*100);
		$prosen_desx  = number_format($prosen,2,',','.');
		
		
   print"<tr>";
		print "<td  valign='top' align='right'></td>
			   <td  valign='top' align='center'></td>
			   <td  valign='top' ><b>Jumlah</b></td>
		       <td  valign='top' align='right'><b>$hasilx</b></td>";
		print "<td  valign='top' align='right'><b>$hasil1x</b></td>";
		print "<td  valign='top' align='center'><b>$prosen_desx</b></td>";
		print "<td  valign='top' align='right'><b>$sisax</b></td>";	
		print "<td  valign='top' align='right'></td>";		
		print "</tr>";
	print "</table><br>"; 

?>

