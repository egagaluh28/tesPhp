<link rel="stylesheet" href="library/style_table_depan.css" type="text/css" media="screen" />
<?php
$jml_daerah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from dipa a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil = mysql_fetch_array($jml_daerah);	

	$pagu 			= number_format($hasil[pagu],0,',','.');
	$revisi 		= number_format($hasil[revisi],0,',','.');
	$pagurevisi		= number_format($hasil[pagurevisi],0,',','.');
	$realisasi		= number_format($hasil[realisasi],0,',','.');
	
	if (($hasil[pagurevisi]=='') or ($hasil[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($hasil[realisasi]/$hasil[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $hasil[pagurevisi] - $hasil[realisasi];
	$sisa_des = number_format($sisa,0,',','.');

?>

<br>
<table width="800" align="center" cellpadding="5" class="bordered">
	<tr bgcolor="#1899c4">
		<td align="center" width="200" >URAIAN</td>
		<td align="center" width="150" >PAGU STLH REVISI</td>
		<td align="center" width="150" >REALISASI</td>
		<td align="center"  >DAYA SERAP</td>
		<td align="center" width="150" >SISA</td>
	</tr>
	
	<tr>
		<td ><b>RUPIAH MURNI</b></td>
		<td align="right"><?php print "<b>$pagurevisi</b>";?></td>
		<td align="right"><?php print "<b>$realisasi</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des</b>";?></td>
	</tr>
	
<?php
$perjenbel_daerah=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from dipa where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel  order by a.kdjenbel"); 	

$no=1;
while($data = mysql_fetch_array($perjenbel_daerah)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$no. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $no++; } 

$jml_yanmasum=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from yanmasum a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_yanmasum  where kdbulan<='12' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
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

	
	<tr>
		<td ><b>YANMASUM</b></td>
		<td align="right"><?php print "<b>$pagurevisi1</b>";?></td>
		<td align="right"><?php print "<b>$realisasi1</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des1</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des1</b>";?></td>
	</tr>

	
<?php
$perjenbel_yanmasum=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from yanmasum where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_yanmasum where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel order by a.kdjenbel"); 	

$noo=1;
while($data = mysql_fetch_array($perjenbel_yanmasum)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$noo. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $noo++; } 


$jml_bpjs=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from bpjs a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_bpjs  where kdbulan<='12' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
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

	
	<tr>
		<td ><b>BPJS</b></td>
		<td align="right"><?php print "<b>$pagurevisi2</b>";?></td>
		<td align="right"><?php print "<b>$realisasi2</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des2</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des2</b>";?></td>
	</tr>

	
<?php
$perjenbel_bpjs=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from bpjs where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_bpjs where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel order by a.kdjenbel"); 	

$nooo=1;
while($data = mysql_fetch_array($perjenbel_bpjs)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$nooo. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $nooo++; } 


$jml_blu=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from blu a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_blu  where kdbulan<='12' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
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

	
	<tr>
		<td ><b>BLU</b></td>
		<td align="right"><?php print "<b>$pagurevisi3</b>";?></td>
		<td align="right"><?php print "<b>$realisasi3</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des3</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des3</b>";?></td>
	</tr>

	
<?php
$perjenbel_blu=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from blu where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_blu where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel order by a.kdjenbel"); 	

$noooo=1;
while($data = mysql_fetch_array($perjenbel_blu)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$noooo. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $noooo++; } 


$jml_kapitasi=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from kapitasi a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_kapitasi  where kdbulan<='12' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
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

	
	<tr>
		<td ><b>KAPITASI</b></td>
		<td align="right"><?php print "<b>$pagurevisi4</b>";?></td>
		<td align="right"><?php print "<b>$realisasi4</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des4</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des4</b>";?></td>
	</tr>

	
<?php
$perjenbel_kapitasi=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from kapitasi where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_kapitasi where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel order by a.kdjenbel"); 	

$nm=1;
while($data = mysql_fetch_array($perjenbel_kapitasi)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$nm. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $nm++; } 



$jml_hibah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from hibah a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_hibah  where kdbulan<='12' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021'
group by a.kdkotama, a.kdsatker, a.thang"); 
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

	
	<tr>
		<td ><b>HIBAH</b></td>
		<td align="right"><?php print "<b>$pagurevisi5</b>";?></td>
		<td align="right"><?php print "<b>$realisasi5</b>";?></td>
		<td align="right"><?php print "<b>$prosen_des5</b>";?> %</td>
		<td align="right"><?php print "<b>$sisa_des5</b>";?></td>
	</tr>

	
<?php
$perjenbel_hibah=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from hibah where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_hibah where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel where a.kdjenbel<'54' group by a.kdjenbel order by a.kdjenbel"); 	

$nom=1;
while($data = mysql_fetch_array($perjenbel_hibah)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
?>	

	<tr>
		<td  ><?php print "$nom. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>
	
<?php $nom++; }  


	$jpagu = $hasil[pagu] + $hasil1[pagu] + $hasil2[pagu] + $hasil3[pagu] + $hasil4[pagu] + $hasil5[pagu];	
    $jpagu_des = number_format($jpagu,0,',','.');	

	$jrevisi = $hasil[revisi] + $hasil1[revisi] + $hasil2[revisi] + $hasil3[revisi] + $hasil4[revisi] + $hasil5[revisi];	
    $jrevisi_des = number_format($jrevisi,0,',','.');	

	$jpagurevisi = $hasil[pagurevisi] + $hasil1[pagurevisi] + $hasil2[pagurevisi] + $hasil3[pagurevisi] + $hasil4[pagurevisi] + $hasil5[pagurevisi];	
    $jpagurevisi_des = number_format($jpagurevisi,0,',','.');	
	
	
	$jrealisisi = $hasil[realisasi] + $hasil1[realisasi] + $hasil2[realisasi] + $hasil3[realisasi] + $hasil4[realisasi] + $hasil5[realisasi];	
    $jrealisisi_des = number_format($jrealisisi,0,',','.');		
	
	$sisa_dipa = $jpagu - $jrealisisi;
	//$jsisa= $sisa + $sisa1 + $sisa2 + $sisa3 + $sisa4;
	$jsisa= $jpagurevisi - $jrealisisi;
	$jsisa_des = number_format($jsisa,0,',','.');	
?>	
	
	<tr>
		<td ><b>JUMLAH</b></td>
		<td align="right"><?php print "<b>$jpagurevisi_des</b>";?></td>
		<td align="right"><?php print "<b>$jrealisisi_des</b>";?></td>
		<td align="right"><?php print "<b></b>";?> %</td>
		<td align="right"><?php print "<b>$jsisa_des</b>";?></td>
	</tr>

<?php

$perjenbel_global=mysql_query("select w.kdjenbel, w.nmjenbel, z.kdkotama, z.kdsatker, z.thang, z.pagu, z.revisi, z.pagurevisi, z.realisasi from t_jenbel w left join 

(select z.kdkotama, z.kdsatker, z.thang, z.kdjenbel, sum(z.pagu) as pagu, sum(z.revisi) as revisi, sum(z.pagurevisi) as pagurevisi, sum(z.realisasi) as realisasi from 

(select  'dipa' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from dipa a 
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi  where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='2021' and kdbulan<='12' group by kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel

union
(select  'yanmasum' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from yanmasum a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from yanmasum a left join realisasi_yanmasum b on a.id_pagu=b.id_pagu where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' and b.kdbulan<='12' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel)

union
(select  'bpjs' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from bpjs a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from bpjs a left join realisasi_bpjs b on a.id_pagu=b.id_pagu where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' and b.kdbulan<='12' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel)

union
(select  'blu' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from blu a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from blu a left join realisasi_blu b on a.id_pagu=b.id_pagu where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' and b.kdbulan<='12' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel)

union
(select  'hibah' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from hibah a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from hibah a left join realisasi_hibah b on a.id_pagu=b.id_pagu where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' and b.kdbulan<='12' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel)

union
(select  'kapitasi' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from kapitasi a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from kapitasi a left join realisasi_kapitasi b on a.id_pagu=b.id_pagu where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' and b.kdbulan<='12' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='2021' group by  a.kdjenbel)) as z group by z.kdjenbel order by z.kdjenbel) as z   on w.kdjenbel=z.kdjenbel where z.kdjenbel<'54'"); 

$noglob=1;
while($data = mysql_fetch_array($perjenbel_global)) {

	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');		
	
?>	
	<tr>
		<td  ><?php print "$noglob. $data[nmjenbel]";?></td>
		<td  align="right"><?php  print "$pagurevisi";?></td>
		<td  align="right"><?php print "$realisasi";?></td>
		<td  align="right"><?php print "$prosen_des";?> %</td>
		<td  align="right"><?php print "$sisa_des";?></td>
	</tr>	
<?php  $noglob++; }   ?>
	
</table>	<br>