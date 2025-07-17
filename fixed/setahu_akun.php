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
  width:1280px;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 400px;
  
}
.table-scroll table {
   width:100%;
  min-width: 1500px;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
  font-family: 'Montserrat',sans-serif;;
  font-size:12px;
}
.table-scroll thead th {
  background: #dce9f9;
  color: #000000;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  font-family: 'Montserrat',sans-serif;;
  font-size:12px;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #dce9f9;
  color: #000000;
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
  left: 3;
  z-index: 2;
  background: #d8d8d8;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}

</style>
<br><center><span class='judulsubcontent'>RINCIAN PER AKUN</span></center><br>

<?php error_reporting(0);


//include "../application/connect.php";

$query = "select a.kdakun, a.nmakun, d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des, a.thang, a.kdkotama, a.kdsatker, sum(a.pagurevisi) as pagurevisi
from dipa a
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
group by   a.kdakun order by  a.kdakun";
		$ok = mysql_query($query);
		
		

 print "<table width='97%' align='center'><tr>
				
				<td valign='middle'><div class='codehim-tombol-biru'>";
				/*<a href='cetak/cetak_akungaji_satker_tahunan_kiri.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak Sebelah Kiri' /></a>&nbsp;&nbsp;
				<a href='cetak/cetak_akungaji_satker_tahunan_kanan.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak Sebelah Kanan' /></a>&nbsp;&nbsp;
				
	            print "<a href='cetak/cetak_akungaji_satker_tahunan.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='&nbsp;&nbsp;Cetak&nbsp;&nbsp;' /></a>&nbsp;&nbsp;*/
				print "<a href='convert/rincianakun.php?thang=$_GET[thang]&kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Export Ke Excel' /></a>
				</div></td>";
				print "</tr></table><br>";
?> 		


<div id="table-scroll" class="table-scroll">
  <table id="main-table" class="main-table">
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
	
	$jhasilx += $k[pagurevisi];
	$jhasil	 = number_format($jhasilx,0,',','.');
	
	$jjanx += $k[jan];
	$jjan	 = number_format($jjanx,0,',','.');
	
	$jfebx += $k[feb];
	$jfeb	 = number_format($jfebx,0,',','.');
	
	$jmarx += $k[mar];
	$jmar	 = number_format($jmarx,0,',','.');
	
	$japrx += $k[apr];
	$japr	 = number_format($japrx,0,',','.');
	
	$jmeix += $k[mei];
	$jmei	 = number_format($jmeix,0,',','.');
	
	$jjunx += $k[jun];
	$jjun	 = number_format($jjunx,0,',','.');
	
	$jjulx += $k[jul];
	$jjul	 = number_format($jjulx,0,',','.');
	
	$jagux += $k[agu];
	$jagu	 = number_format($jagux,0,',','.');
	
	$jsepx += $k[sep];
	$jsep	 = number_format($jsepx,0,',','.');
	
	$joktx += $k[okt];
	$jokt	 = number_format($joktx,0,',','.');
	
	$jnopx += $k[nop];
	$jnop	 = number_format($jnopx,0,',','.');
	
	$jdesx += $k[des];
	$jdes	 = number_format($jdesx,0,',','.');
	
	$tarik = $k[jan] + $k[feb] + $k[mar] + $k[apr] + $k[mei] + $k[jun] + $k[jul] + $k[agu] + $k[sep] + $k[okt] + $k[nop] + $k[des];
	
	$serap  = number_format($tarik,0,',','.');
	
	$jtarikx += $tarik;
	$jtarik	 = number_format($jtarikx,0,',','.');
	
	
	
	$sisax = $k[pagurevisi] - $tarik;
	$sisa  = number_format($sisax,0,',','.');
	
	$jsisax += $sisax;
	$jsisa	 = number_format($jsisax,0,',','.');
	
	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($tarik/$k[pagurevisi])*100);
	$prosen_des  = number_format($prosen,2,',','.');
	}
	
	$jprosenx = $jtarikx / $jhasilx * 100;
	$jprosen  = number_format($jprosenx,2,',','.');

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
		print "<td  valign='top' align='right'>$serap</td>";
		print "<td  valign='top' align='right'>$prosen_des</td>";
		print "<td  valign='top' align='right'>$sisa</td>"; ?>
      </tr>
    <?php $no ++; } ?>
    </tbody>
	
	
   
   <tfoot>

	<?php	
		print"<tr>";
		print "<th  valign='top' ><b>JUMLAH</b></th>";
		print "<th  valign='top' align='right'><b>$jhasil</b></th>";
		print "<th  valign='top' align='right'><b>$jjan</b></th>";
		print "<th  valign='top' align='right'><b>$jfeb</b></th>";
		print "<th  valign='top' align='right'><b>$jmar</b></th>";
		print "<th  valign='top' align='right'><b>$japr</b></th>";
		print "<th  valign='top' align='right'><b>$jmei</b></th>";
		print "<th  valign='top' align='right'><b>$jjun</b></th>";
		print "<th  valign='top' align='right'><b>$jjul</b></th>";
		print "<th  valign='top' align='right'><b>$jagu</b></th>";
		print "<th  valign='top' align='right'><b>$jsep</b></th>";
		print "<th  valign='top' align='right'><b>$jokt</b></th>";
		print "<th  valign='top' align='right'><b>$jnop</b></th>";
		print "<th  valign='top' align='right'><b>$jdes</b></th>";
		print "<th  valign='top' align='right'><b>$jtarik</b></th>";
		print "<th  valign='top' align='right'><b>$jprosen</b></th>";
		print "<th  valign='top' align='right'><b>$jsisa</b></th>";
		print "</tr>";
?>		 
    </tfoot> 
  </table>
</div>
