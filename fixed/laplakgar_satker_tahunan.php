<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>laplakgar gaji tahunan</title>
    <link rel="stylesheet" type="text/css" href="fixed-table.css">
    <script src="fixed-table.js"></script>
	<link rel="stylesheet" href="../library/style_button.css">
    <style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 20px;
        color: #333;
        margin: 20px;
      }
	  
	.sendiri{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid #C2C2C2;
    box-shadow: 1px 1px 4px #EBEBEB;
    -moz-box-shadow: 1px 1px 4px #EBEBEB;
    -webkit-box-shadow: 1px 1px 4px #EBEBEB;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    outline: none;
	font-size: 16px;
	color:#666;
	font-family: "Geneva", sans-serif;
	}
    </style>
  </head>
  <body>
<?php


include "../application/connect.php";

$query = "select x.kdakun, x.nmakun, z.thang, z.kdkotama, z.kdsatker, z.pagurevisi, z.jan, z.feb, z.mar, z.apr, z.mei, z.jun, z.jul, z.agu, z.sep, z.okt, z.nop, z.des
from t_akun_gaji x
left join (SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
FROM dipa a 
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jan from realisasi where kdbulan='01' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as d on a.kdakun=d.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as feb from realisasi where kdbulan='02' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as e on a.kdakun=e.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mar from realisasi where kdbulan='03' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as f on a.kdakun=f.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as apr from realisasi where kdbulan='04' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as g on a.kdakun=g.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mei from realisasi where kdbulan='05' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as h on a.kdakun=h.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jun from realisasi where kdbulan='06' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as i on a.kdakun=i.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jul from realisasi where kdbulan='07' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as j on a.kdakun=j.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as agu from realisasi where kdbulan='08' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as k on a.kdakun=k.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as sep from realisasi where kdbulan='09' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as l on a.kdakun=l.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as okt from realisasi where kdbulan='10' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as m on a.kdakun=m.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as nop from realisasi where kdbulan='11' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as n on a.kdakun=n.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as des from realisasi where kdbulan='12' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as o on a.kdakun=o.kdakun  
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by   a.kdakun order by  a.kdakun) as z on x.kdakun=z.kdakun group by x.kdakun";
		$ok = mysql_query($query);
 

?>		
 <center><span class="judwas">LAPORAN PENGAWASAN GAJI TAHUN <?php print "$_GET[thang]"; ?></span></center><br> 
<?php 
 print "<table width='99%' align='center'><tr>
				<td align='right' valign='middle' align='right' ></td>
				<td align='right' valign='middle'>
				
				
	            <a href='../output_laplakgar/cetak_akungaji_satker_tahunan_kiri.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank'><input  type='button' value='CETAK SEBELAH KIRI' class='button blue'/></a>&nbsp;&nbsp;
				<a href='../output_laplakgar/cetak_akungaji_satker_tahunan_kanan.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank'><input  type='button' value='CETAK SEBELAH KANAN' class='button blue'/></a>
				</td>";
				print "</tr></table>";
?> 
 
    <br>
    <div id="fixed-table-container-1" class="fixed-table-container">
      <table>
        <thead>
			
			<tr>
				<th>AKUN / URAIAN</th>
				<th>DIPA TA <?php print "$_GET[thang]"; ?></th>
				<th>JANUARI</th>
				<th>FEBBRUARI</th>
				<th>MARET</th>
				<th>APRIL</th>
				<th>MEI</th>
				<th>JUNI</th>
				<th>JULI</th>
				<th>AGUSTUS</th>
				<th>SEPTEMBER</th>
				<th>OKTOBER</th>
				<th>NOPEMBER</th>
				<th>DESSEMBER</th>
				<th>JUMLAH</th>
				<th>%</th>
				<th>SISA</th>
			</tr>
			
        </thead>
        <tbody><?php
         //	$no=1;
while($k = mysql_fetch_array($ok)){	

	$hasil	 = number_format($k[pagurevisi],0,',','.');
	$jan  = number_format($k[jan],0,',','.');
	$feb  = number_format($k[feb],0,',','.');
	$mar  = number_format($k[mar],0,',','.');
	$apr  = number_format($k[apr],0,',','.');
	$mei  = number_format($k[mei],0,',','.');
	$jun  = number_format($k[jun],0,',','.');
	$jul  = number_format($k[jul],0,',','.');
	$agu  = number_format($k[agu],0,',','.');
	$sep  = number_format($k[sep],0,',','.');
	$okt  = number_format($k[okt],0,',','.');
	$nop  = number_format($k[nop],0,',','.');
	$des  = number_format($k[des],0,',','.');
	
	$tarik = $k[jan] + $k[feb] + $k[mar] + $k[apr] + $k[mei] + $k[jun] + $k[jul] + $k[agu] + $k[sep] + $k[okt] + $k[nop] + $k[des];
	
	$jtarik  = number_format($tarik,0,',','.');
	
	$turahanx = $k[pagurevisi] - $tarik;
	$sisax  = number_format($turahanx,0,',','.');
	
	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($tarik/$k[pagurevisi])*100);
	$prosen_des  = number_format($prosen,2,',','.');
	}


	print"<tr>";
		print "<td  valign='top' >$k[kdakun] | $k[nmakun]</td>";
		print "<td  valign='top' align='right'>$hasil</td>";
		print "<td  valign='top' align='right'>$jan</td>";
		print "<td  valign='top' align='right'>$feb</td>";
		print "<td  valign='top' align='right'>$mar</td>";
		print "<td  valign='top' align='right'>$apr</td>";
		print "<td  valign='top' align='right'>$mei</td>";
		print "<td  valign='top' align='right'>$jun</td>";
		print "<td  valign='top' align='right'>$jul</td>";
		print "<td  valign='top' align='right'>$agu</td>";
		print "<td  valign='top' align='right'>$sep</td>";
		print "<td  valign='top' align='right'>$okt</td>";
		print "<td  valign='top' align='right'>$nop</td>";
		print "<td  valign='top' align='right'>$des</td>";
		print "<td  valign='top' align='right'>$jtarik</td>";
		print "<td  valign='top' align='right'>$prosen_des</td>";
		print "<td  valign='top' align='right'>$sisax</td>";
		print "</tr>";
//	$no++;	
   }
   
		 $jml = "SELECT a.kdkotama, a.kdsatker, a.thang,  sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
FROM dipa a 
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jan from realisasi where kdbulan='01' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as feb from realisasi where kdbulan='02' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as e on a.kdkotama=e.kdkotama and a.kdsatker=e.kdsatker and a.thang=e.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mar from realisasi where kdbulan='03' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as f on a.kdkotama=f.kdkotama and a.kdsatker=f.kdsatker and a.thang=f.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as apr from realisasi where kdbulan='04' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as g on a.kdkotama=g.kdkotama and a.kdsatker=g.kdsatker and a.thang=g.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mei from realisasi where kdbulan='05' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as h on a.kdkotama=h.kdkotama and a.kdsatker=h.kdsatker and a.thang=h.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jun from realisasi where kdbulan='06' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as i on a.kdkotama=i.kdkotama and a.kdsatker=i.kdsatker and a.thang=i.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jul from realisasi where kdbulan='07' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as j on a.kdkotama=j.kdkotama and a.kdsatker=j.kdsatker and a.thang=j.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as agu from realisasi where kdbulan='08' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as k on a.kdkotama=k.kdkotama and a.kdsatker=k.kdsatker and a.thang=k.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as sep from realisasi where kdbulan='09' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as l on a.kdkotama=l.kdkotama and a.kdsatker=l.kdsatker and a.thang=l.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as okt from realisasi where kdbulan='10' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as m on a.kdkotama=m.kdkotama and a.kdsatker=m.kdsatker and a.thang=m.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as nop from realisasi where kdbulan='11' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as n on a.kdkotama=n.kdkotama and a.kdsatker=n.kdsatker and a.thang=n.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as des from realisasi where kdbulan='12' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as o on a.kdkotama=o.kdkotama and a.kdsatker=o.kdsatker and a.thang=o.thang  
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by   a.kdkotama, a.kdsatker, a.thang";
		$ketemu = mysql_query($jml);
		
		$x    = mysql_fetch_array($ketemu); 
		
		$hasilx	 = number_format($x[pagurevisi],0,',','.');
		$jan  = number_format($x[jan],0,',','.');
		$feb  = number_format($x[feb],0,',','.');
		$mar  = number_format($x[mar],0,',','.');
		$apr  = number_format($x[apr],0,',','.');
		$mei  = number_format($x[mei],0,',','.');
		$jun  = number_format($x[jun],0,',','.');
		$jul  = number_format($x[jul],0,',','.');
		$agu  = number_format($x[agu],0,',','.');
		$sep  = number_format($x[sep],0,',','.');
		$okt  = number_format($x[okt],0,',','.');
		$nop  = number_format($x[nop],0,',','.');
		$des  = number_format($x[des],0,',','.');
		
		$jmltarik = $x[jan] + $x[feb] + $x[mar] + $x[apr] + $x[mei] + $x[jun] + $x[jul] + $x[agu] + $x[sep] + $x[okt] + $x[nop] + $x[des];
	
	$tottarik  = number_format($jmltarik,0,',','.');
	
	$jturahanx = $x[pagurevisi] - $jmltarik;
	$jsisax  = number_format($jturahanx,0,',','.');
	
	if (($x[pagurevisi]=='') or ($x[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$jprosen 	= (($jmltarik/$x[pagurevisi])*100);
	$jprosen_des  = number_format($jprosen,2,',','.');
	}
		
		print"<tr>";
		print "<td  valign='top' ><b>JUMLAH</b></td>";
		print "<td  valign='top' align='right'><b>$hasilx</b></td>";
		print "<td  valign='top' align='right'><b>$jan</b></td>";
		print "<td  valign='top' align='right'><b>$feb</b></td>";
		print "<td  valign='top' align='right'><b>$mar</b></td>";
		print "<td  valign='top' align='right'><b>$apr</b></td>";
		print "<td  valign='top' align='right'><b>$mei</b></td>";
		print "<td  valign='top' align='right'><b>$jun</b></td>";
		print "<td  valign='top' align='right'><b>$jul</b></td>";
		print "<td  valign='top' align='right'><b>$agu</b></td>";
		print "<td  valign='top' align='right'><b>$sep</b></td>";
		print "<td  valign='top' align='right'><b>$okt</b></td>";
		print "<td  valign='top' align='right'><b>$nop</b></td>";
		print "<td  valign='top' align='right'><b>$des</b></td>";
		print "<td  valign='top' align='right'><b>$tottarik</b></td>";
		print "<td  valign='top' align='right'><b>$jprosen_des</b></td>";
		print "<td  valign='top' align='right'><b>$jsisax</b></td>";
		print "</tr>";
		 
		 ?> 
        </tbody> 
      </table>
    </div>
    
    <script>
      var fixedTable1 = fixTable(document.getElementById('fixed-table-container-1'));
      var fixedTable2 = fixTable(document.getElementById('fixed-table-container-2'));
    </script>
  </body>
</html>
