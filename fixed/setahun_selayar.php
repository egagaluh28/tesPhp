<link href="../library/allstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../library/style_button_biru.css" type="text/css" media="screen" />
<style>
html {
  box-sizing: border-box;
}
*,
*:before,
*:after {
  box-sizing: inherit;
}
.intro {
  max-width: 1280px;
  margin: 1em auto;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 450px;
}
.table-scroll table {
  width: 100%;
  min-width: 1680px;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 5px;
  border: 1px solid #333;
  background: #fff;
  vertical-align: top;
   font-family: 'Montserrat',sans-serif;;
  font-size:12px;
}
.table-scroll thead th {
  background: #dce9f9;
  color: #333;
  position: -webkit-sticky;
  position: sticky;
  font-family: 'Montserrat',sans-serif;;
  font-size:12px;
  top: 0;
   vertical-align: middle;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #dce9f9;
  color: #333333;
  z-index:4;
  font-family: 'Montserrat',sans-serif;;
  font-size:12px;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #d8d8d8;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}


</style>
<br><center><span class='judulsubcontent'>REALISASI GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA</span></center><br>
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
		
		

 print "<table width='100%' align='center'><tr>
				
				<td valign='middle'><div class='codehim-tombol-biru'>
				<a href='../cetak/cetak_akungaji_satker_tahunan_kiri.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak Sebelah Kiri' /></a>&nbsp;&nbsp;
				<a href='../cetak/cetak_akungaji_satker_tahunan_kanan.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak Sebelah Kanan' /></a>&nbsp;&nbsp;
				
	            <a href='../cetak/cetak_akungaji_satker_tahunan.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak Satu Layar' /></a>&nbsp;&nbsp;
				<input  type='button' value='Export Ke Excel' />
				</div></td>";
				print "</tr></table><br>";
?> 		


<div id="table-scroll" class="table-scroll">
  <table id="main-table" class="main-table">
    <thead>
      <tr>		
				<th height="35">AKUN / URAIAN</th>
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
				<th>DESEMBER</th>
				<th>JUMLAH</th>
				<th>%</th>
				<th>SISA</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$no=1;
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

	?>
      <tr>
	
        <th align="left"><?php print "$k[kdakun] | $k[nmakun]"; ?></th>
		<?php   
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
		print "<td  valign='top' align='right'>$sisax</td>"; ?>
      </tr>
    <?php $no ++; } ?>
    </tbody>
   
   <tfoot>
<?php      $jml = "SELECT a.kdkotama, a.kdsatker, a.thang,  sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
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
	//	print "<th  valign='top' ></th>";
		print "<th  valign='top' ><b>JUMLAH</b></th>";
		print "<th  valign='top' align='right'><b>$hasilx</b></th>";
		print "<th  valign='top' align='right'><b>$jan</b></th>";
		print "<th  valign='top' align='right'><b>$feb</b></th>";
		print "<th  valign='top' align='right'><b>$mar</b></th>";
		print "<th  valign='top' align='right'><b>$apr</b></th>";
		print "<th  valign='top' align='right'><b>$mei</b></th>";
		print "<th  valign='top' align='right'><b>$jun</b></th>";
		print "<th  valign='top' align='right'><b>$jul</b></th>";
		print "<th  valign='top' align='right'><b>$agu</b></th>";
		print "<th  valign='top' align='right'><b>$sep</b></th>";
		print "<th  valign='top' align='right'><b>$okt</b></th>";
		print "<th  valign='top' align='right'><b>$nop</b></th>";
		print "<th  valign='top' align='right'><b>$des</b></th>";
		print "<th  valign='top' align='right'><b>$tottarik</b></th>";
		print "<th  valign='top' align='right'><b>$jprosen_des</b></th>";
		print "<th  valign='top' align='right'><b>$jsisax</b></th>";
		print "</tr>";
?>		 
    </tfoot> 
  </table>
</div>
