

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


$query = "select x.kdakun, x.nmakun, z.thang, z.kdkotama,   z.pagurevisi, z.penarikan
from t_akun_gaji x
left join (SELECT a.thang, a.kdkotama,  a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdkotama,  thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'   and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by kdakun order by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where  a.kdkotama='$_GET[kdkotama]'   and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by a.kdakun) as z on x.kdakun=z.kdakun group by x.kdakun";
		$ok = mysql_query($query);
 
print "<table width='85%' align='center'  ><tr><td>
				<td align='right' valign='middle'>
				<div class='codehim-tombol-biru'><form name='formX'  method='GET' action='cetak/cetak_akungaji_ktm.php' target='_blank'>
				<input type='hidden' name='kdkotama' value='$_GET[kdkotama]' />
				<input type='hidden' name='thang' value='$_GET[thang]' />
				<input type='hidden' name='kdbulan' value='$_GET[kdbulan]' />
				<div class='form-style-2'>LAMPIRAN : <input type='text'  name='lamp' class='input-field'  size='3' style='text-align: center;' />
	            &nbsp;<input  type='submit' value='C E T A K' /></div></div></td>";
				print "</tr></table>";

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
   
   $jml = "select z.kdkotama,  z.thang, sum(z.pagurevisi) as pagurevisi , sum(z.penarikan) as penarikan from(SELECT a.thang, a.kdkotama,   a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdkotama,   thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'   and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where  a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by a.kdakun) as z where z.kdkotama='$_GET[kdkotama]'  and z.thang='$_GET[thang]'";
		$ketemu = mysql_query($jml);
		
		$x    = mysql_fetch_array($ketemu); 
		
		$hasilx	 = number_format($x[pagurevisi],0,',','.');
	    $hasil1x  = number_format($x[penarikan],0,',','.');
	
	    $turahanx = $x[pagurevisi] - $x[penarikan];
	    $sisax  = number_format($turahanx,0,',','.');
		
		$prosenx 	= (($x[penarikan]/$x[pagurevisi])*100);
		$prosen_desx  = number_format($prosenx,2,',','.');
		
		
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

