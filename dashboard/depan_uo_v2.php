<link rel="stylesheet" href="library/style_table_depan.css" type="text/css" media="screen" />
<style>
#borderdash{
width:1000px;
background-image: url(images/buku.png);
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333; 
padding: 10px;
font-size: 16px;
color:#666;


}
</style>
 <br> <br>
<center><div id="borderdash" > 
 <center><span class='judul'>REALISASI ANGGARAN</span></center>
<?php
$jml_daerah=mysql_query("select   a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from dipa a
left join (select  thang, sum(realisasi) as realisasi  from realisasix where  thang='2024' group by   thang) as b on a.thang=b.thang
where  a.thang='2024'
group by   a.thang"); 
$hasil = mysql_fetch_array($jml_daerah);	

	$pagu       = number_format($hasil['pagu'], 0, ',', '.');
$revisi     = number_format($hasil['revisi'], 0, ',', '.');
$pagurevisi = number_format($hasil['pagurevisi'], 0, ',', '.');
$realisasi  = number_format($hasil['realisasi'], 0, ',', '.');

if (($hasil['pagurevisi'] == '') || ($hasil['pagurevisi'] == '0')) {
    $prosen = 0; 
} else {
    $prosen = (($hasil['realisasi'] / $hasil['pagurevisi']) * 100);
}

$prosen_des = number_format($prosen, 2, ',', '.');

$sisa = $hasil['pagurevisi'] - $hasil['realisasi'];
$sisa_des = number_format($sisa, 0, ',', '.');


?>

<br>
<table width="800" align="center" cellpadding="5" class="bordered">
	<tr >
		<th align="center"  >NO</th>
		<th align="center" >URAIAN</th>
		<th align="center" >PAGU STLH REVISI</th>
		<th align="center"  >REALISASI</th>
		<th align="center"  >DAYA SERAP</th>
		<th align="center"  >SISA</th>
	</tr>
	
	<tr>
		<td align="center">1</td>
		<td >RUPIAH MURNI</td>
		<td align="right"><?php print ".$pagurevisi";?></td>
		<td align="right"><?php print ".$realisasi";?></td>
		<td align="right"><?php print ".$prosen_des";?> %</td>
		<td align="right"><?php print ".$sisa_des";?></td>
	</tr>
<?php

$jml_yanmasum=mysql_query("select a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from yanmasum a
left join (select   thang, sum(realisasi) as realisasi  from realisasi_yanmasum where kdbulan<='12' and thang='2024' group by  thang) as b on a.thang=b.thang
where  a.thang='2024'
group by a.thang"); 
$hasil1 = mysql_fetch_array($jml_yanmasum);	

	$pagu1 			= number_format($hasil1[pagu],0,',','.');
	$revisi1 		= number_format($hasil1[revisi],0,',','.');
	$pagurevisi1	= number_format($hasil1[pagurevisi],0,',','.');
	$realisasi1		= number_format($hasil1[realisasi],0,',','.');
	
	if (($hasil1[pagurevisi]=='') OR ($hasil1[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen1 	= (($hasil1[realisasi]/$hasil1[pagurevisi])*100);
	}
	$prosen_des1	= number_format($prosen1,2,',','.');
	
	$sisa1 = $hasil1[pagurevisi] - $hasil1[realisasi];
	$sisa_des1 = number_format($sisa1,0,',','.');	


?>

	
	<tr><td align="center">2</td>
		<td >YANMASUM</td>
		<td align="right"><?php print "$pagurevisi1";?></td>
		<td align="right"><?php print "$realisasi1";?></td>
		<td align="right"><?php print "$prosen_des1";?> %</td>
		<td align="right"><?php print "$sisa_des1";?></td>
	</tr>


	
<?php 


$jml_bpjs=mysql_query("select a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from bpjs a
left join (select   thang, sum(realisasi) as realisasi  from realisasi_bpjs where kdbulan<='12' and thang='2024' group by  thang) as b on  a.thang=b.thang
where   a.thang='2024'
group by  a.thang"); 
$hasil2 = mysql_fetch_array($jml_bpjs);	

	$pagu2 			= number_format($hasil2[pagu],0,',','.');
	$revisi2 		= number_format($hasil2[revisi],0,',','.');
	$pagurevisi2	= number_format($hasil2[pagurevisi],0,',','.');
	$realisasi2		= number_format($hasil2[realisasi],0,',','.');
	
	if (($hasil2[pagurevisi]=='') OR ($hasil2[pagurevisi]=='0')) {
	$prosen2     = 0; 
    } else { 
	$prosen2 	= (($hasil2[realisasi]/$hasil2[pagurevisi])*100);
	}
	$prosen_des2	= number_format($prosen2,2,',','.');
	
	$sisa2 = $hasil2[pagurevisi] - $hasil2[realisasi];
	$sisa_des2 = number_format($sisa2,0,',','.');	


?>

	
	<tr><td align="center">3</td>
		<td >BPJS</td>
		<td align="right"><?php print ".$pagurevisi2";?></td>
		<td align="right"><?php print ".$realisasi2";?></td>
		<td align="right"><?php print ".$prosen_des2";?> %</td>
		<td align="right"><?php print ".$sisa_des2";?></td>
	</tr>


	
<?php 


$jml_blu=mysql_query("select  a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from blu a
left join (select   thang, sum(realisasi) as realisasi  from realisasi_blu where kdbulan<='12' and thang='2024' group by thang) as b on  a.thang=b.thang
where   a.thang='2024'
group by  a.thang"); 
$hasil3 = mysql_fetch_array($jml_blu);	

	$pagu3 			= number_format($hasil3[pagu],0,',','.');
	$revisi3 		= number_format($hasil3[revisi],0,',','.');
	$pagurevisi3	= number_format($hasil3[pagurevisi],0,',','.');
	$realisasi3		= number_format($hasil3[realisasi],0,',','.');
	
	if (($hasil3[pagurevisi]=='') OR ($hasil3[pagurevisi]=='0')) {
	$prosen3     = 0; 
    } else { 
	$prosen3 	= (($hasil3[realisasi]/$hasil3[pagurevisi])*100);
	}
	$prosen_des3	= number_format($prosen3,2,',','.');
	
	$sisa3 = $hasil3[pagurevisi] - $hasil3[realisasi];
	$sisa_des3 = number_format($sisa3,0,',','.');	


?>

	
	<tr><td align="center">4</td>
		<td >BLU</td>
		<td align="right"><?php print "$pagurevisi3";?></td>
		<td align="right"><?php print "$realisasi3";?></td>
		<td align="right"><?php print "$prosen_des3";?> %</td>
		<td align="right"><?php print "$sisa_des3";?></td>
	</tr>


<?php


$jml_kapitasi=mysql_query("select  a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from kapitasi a
left join (select   thang, sum(realisasi) as realisasi  from realisasi_kapitasi where kdbulan<='12'  and thang='2024' group by  thang) as b on a.thang=b.thang
where   a.thang='2024'
group by  a.thang"); 
$hasil4 = mysql_fetch_array($jml_kapitasi);	

	$pagu4 			= number_format($hasil4[pagu],0,',','.');
	$revisi4 		= number_format($hasil4[revisi],0,',','.');
	$pagurevisi4	= number_format($hasil4[pagurevisi],0,',','.');
	$realisasi4		= number_format($hasil4[realisasi],0,',','.');
	
	if (($hasil4[pagurevisi]=='') OR ($hasil4[pagurevisi]=='0')) {
	$prosen4     = 0; 
    } else { 
	$prosen4 	= (($hasil4[realisasi]/$hasil4[pagurevisi])*100);
	}
	$prosen_des4	= number_format($prosen4,2,',','.');
	
	$sisa4 = $hasil4[pagurevisi] - $hasil4[realisasi];
	$sisa_des4 = number_format($sisa4,0,',','.');	


?>

	
	<tr><td align="center">5</td>
		<td >KAPITASI</td>
		<td align="right"><?php print "$pagurevisi4";?></td>
		<td align="right"><?php print "$realisasi4";?></td>
		<td align="right"><?php print "$prosen_des4";?> %</td>
		<td align="right"><?php print "$sisa_des4";?></td>
	</tr>


	
<?php 



$jml_hibah=mysql_query("select  a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from hibah a
left join (select   thang, sum(realisasi) as realisasi  from realisasi_hibah where kdbulan<='12' and thang='2024' group by  thang) as b on a.thang=b.thang
where   a.thang='2024'
group by  a.thang"); 
$hasil5 = mysql_fetch_array($jml_hibah);	

	$pagu5 			= number_format($hasil5[pagu],0,',','.');
	$revisi5 		= number_format($hasil5[revisi],0,',','.');
	$pagurevisi5	= number_format($hasil5[pagurevisi],0,',','.');
	$realisasi5		= number_format($hasil5[realisasi],0,',','.');
	
	if (($hasil5[pagurevisi]=='') OR ($hasil5[pagurevisi]=='0')) {
	$prosen5     = 0; 
    } else { 
	$prosen5 	= (($hasil5[realisasi]/$hasil5[pagurevisi])*100);
	}
	$prosen_des5	= number_format($prosen5,2,',','.');
	
	$sisa5 = $hasil5[pagurevisi] - $hasil5[realisasi];
	$sisa_des5 = number_format($sisa5,0,',','.');	


?>

	
	<tr><td align="center">6</td>
		<td >HIBAH</td>
		<td align="right"><?php print "$pagurevisi5";?></td>
		<td align="right"><?php print "$realisasi5";?></td>
		<td align="right"><?php print "$prosen_des5";?> %</td>
		<td align="right"><?php print "$sisa_des5";?></td>
	</tr>


	
<?php 



$jml_sbsn=mysql_query("select a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from sbsn a
left join (select  thang, sum(realisasi) as realisasi  from realisasi_sbsn where kdbulan<='12'   and thang='2024' group by   thang) as b on   a.thang=b.thang
where   a.thang='2024'
group by   a.thang"); 
$hasil6 = mysql_fetch_array($jml_sbsn);	

	$pagu6 			= number_format($hasil6[pagu],0,',','.');
	$revisi6 		= number_format($hasil6[revisi],0,',','.');
	$pagurevisi6	= number_format($hasil6[pagurevisi],0,',','.');
	$realisasi6		= number_format($hasil6[realisasi],0,',','.');
	
	if (($hasil6[pagurevisi]=='') OR ($hasil6[pagurevisi]=='0')) {
	$prosen6     = 0; 
    } else { 
	$prosen6 	= (($hasil6[realisasi]/$hasil6[pagurevisi])*100);
	}
	$prosen_des6	= number_format($prosen6,2,',','.');
	
	$sisa6 = $hasil6[pagurevisi] - $hasil6[realisasi];
	$sisa_des6 = number_format($sisa6,0,',','.');	


?>

	
	<tr><td align="center">7</td>
		<td >SBSN</td>
		<td align="right"><?php print "$pagurevisi6";?></td>
		<td align="right"><?php print "$realisasi6";?></td>
		<td align="right"><?php print "$prosen_des6";?> %</td>
		<td align="right"><?php print "$sisa_des6";?></td>
	</tr>

	
	
<?php 


	$jpagu = $hasil[pagu] + $hasil1[pagu] + $hasil2[pagu] + $hasil3[pagu] + $hasil4[pagu] + $hasil5[pagu] + $hasil6[pagu];	
    $jpagu_des = number_format($jpagu,0,',','.');	

	$jrevisi = $hasil[revisi] + $hasil1[revisi] + $hasil2[revisi] + $hasil3[revisi] + $hasil4[revisi] + $hasil5[revisi] + $hasil6[revisi];	
    $jrevisi_des = number_format($jrevisi,0,',','.');	

	$jpagurevisi = $hasil[pagurevisi] + $hasil1[pagurevisi] + $hasil2[pagurevisi] + $hasil3[pagurevisi] + $hasil4[pagurevisi] + $hasil5[pagurevisi] + $hasil6[pagurevisi];	
    $jpagurevisi_des = number_format($jpagurevisi,0,',','.');	
	
	
	$jrealisisi = $hasil[realisasi] + $hasil1[realisasi] + $hasil2[realisasi] + $hasil3[realisasi] + $hasil4[realisasi] + $hasil5[realisasi] + $hasil6[realisasi];	
    $jrealisisi_des = number_format($jrealisisi,0,',','.');		
	
	$sisa_dipa = $jpagu - $jrealisisi;
	//$jsisa= $sisa + $sisa1 + $sisa2 + $sisa3 + $sisa4;
	$jsisa= $jpagurevisi - $jrealisisi;
	$jsisa_des = number_format($jsisa,0,',','.');	
	
	if (($jpagurevisi=='') or ($jpagurevisi=='0')) {
	$prosen     = 0; 
    } else { 
	$jprosen 	= (($jrealisisi/$jpagurevisi)*100);
	}
	$jprosen_des	= number_format($jprosen,2,',','.');
?>	
	
	<tr><td align="center"></td>
		<td >JUMLAH</td>
		<td align="right"><b><?php print "$jpagurevisi_des";?></b></td>
		<td align="right"><b><?php print "$jrealisisi_des";?></b></td>
		<td align="right"><b><?php print "$jprosen_des";?> %</b></td>
		<td align="right"><b><?php print "$jsisa_des";?></b></td>
	</tr>

	
</table>	<br>