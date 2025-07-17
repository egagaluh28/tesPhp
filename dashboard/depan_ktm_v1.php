<link rel="stylesheet" href="library/style_table_depan.css" type="text/css" media="screen" />
	  <style>
#borderku{
width:245px;
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
font-family: "MS Sans Serif", Geneva, sans-serif;
font-size: 24px;
color:#333;

}
#bdrdas{
width:1200px;

float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333; 
padding: 10px;
font-family: "MS Sans Serif", Geneva, sans-serif;
font-size: 24px;
color:#333;

}
</style>
<?php
// query belanja pegawai

$pagu51=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdjenbel='51' group by kdjenbel");
$x51    = mysql_fetch_array($pagu51);

$reals51=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdjenbel='51' and kdbulan<='12' group by kdjenbel");
$y51    = mysql_fetch_array($reals51);

 $jpagu51 =  number_format($x51[pagurevisi],0,',','.');
 $jreals51 =  number_format($y51[realisasi],0,',','.');

 if (($x51[pagurevisi]=='') OR ($x51[pagurevisi]=='0')) {
	$serap51     = 0; 
    } else { 
	$serap51 = ($y51[realisasi]/$x51[pagurevisi]) * 100;
	}
	$hsserap51 = number_format($serap51,2,',','.');

// query belanja barang	
	
$pagu52=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdjenbel='52' group by kdjenbel");
$x52    = mysql_fetch_array($pagu52);

$reals52=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='2020' and kdkotama='$_SESSION[kdkotama]' and kdjenbel='52' and kdbulan<='12' group by kdjenbel");
$y52    = mysql_fetch_array($reals52);

 $jpagu52  =  number_format($x52[pagurevisi],0,',','.');
 $jreals52 =  number_format($y52[realisasi],0,',','.');

   if (($x52[pagurevisi]=='') OR ($x52[pagurevisi]=='0')) {
	$serap52     = 0; 
    } else { 
	$serap52 = ($y52[realisasi]/$x52[pagurevisi]) * 100;
	}
	$hsserap52 = number_format($serap52,2,',','.');
	
// query belanja modal	

$pagu53=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdjenbel='53' group by kdjenbel");
$x53    = mysql_fetch_array($pagu53);

$reals53=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdjenbel='53' and kdbulan<='12' group by kdjenbel");
$y53    = mysql_fetch_array($reals53);

 $jpagu53  =  number_format($x53[pagurevisi],0,',','.');
 $jreals53 =  number_format($y53[realisasi],0,',','.');
 
	if (($x53[pagurevisi]=='') OR ($x53[pagurevisi]=='0')) {
	$serap53     = 0; 
    } else { 
	$serap53 = ($y53[realisasi]/$x53[pagurevisi]) * 100;
	}
	$hsserap53 = number_format($serap53,2,',','.');
	
	

// pagu dan realisasi--------------------------------------
$pg=mysql_query("select sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where thang='2020' and kdkotama='$_SESSION[kdkotama]'  group by kdkotama,thang");
 $row1    = mysql_fetch_array($pg);
 
 $reals=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='2020' and kdkotama='$_SESSION[kdkotama]'  and kdbulan<='12' group by kdkotama,thang");
 $row2    = mysql_fetch_array($reals);
 
 $pagu	 		= number_format($row1[pagu],0,',','.');
 $revisi	 	= number_format($row1[revisi],0,',','.');
 $pagurevisi	= number_format($row1[pagurevisi],0,',','.');
 
 $realisasi	= number_format($row2[realisasi],0,',','.');
 
  if (($row1[pagurevisi]=='') OR ($row1[pagurevisi]=='0')) {
	$serap     = 0; 
    } else { 
	 $serap = ($row2[realisasi]/$row1[pagurevisi]) * 100;
	}
	$hsserap = number_format($serap,2,',','.');	
?>	
<br><br>
<center><div id="bdrdas">
<br>
<table width="900" align="center" cellpadding="5">
	<tr>
		<td align="center" width="300" class="judulcontent">PAGU STLH REVISI</td>
		<td align="center" width="300" class="judulcontent">REALISASI</td>
		<td align="center" width="300" class="judulcontent">DAYA SERAP</td>
	</tr>
	<tr>
		<td align="center" width="300" class="judulcontent"><div id="borderku"><?php print "$pagurevisi"; ?></div></td>
		<td align="center" width="300" class="judulcontent"><div id="borderku"><?php print "$realisasi"; ?></div></td>
		<td align="center" width="300" class="judulcontent"><div id="borderku"><?php print "$hsserap"; ?> %</div></td>
	</tr>
</table>	
	
<br><br>		
<table width="1150" align="center" cellpadding="5" class="bordered">
	<tr>
		<td colspan="3" align="center" bgcolor="#eaa3bb"><img src="images/51.png"></td>
		<td colspan="3" align="center" bgcolor="#ffffcc"><img src="images/52.png"></td>
		<td colspan="3" align="center" bgcolor="#83ceee"><img src="images/53.png"></td>
	</tr>
	
	<tr>
		<td align="center" width="150" bgcolor="#eaa3bb">PAGU</td>
		<td align="center" width="150" bgcolor="#eaa3bb">REALISASI</td>
		<td align="center" bgcolor="#eaa3bb">%</td>
		
		<td align="center" width="150" bgcolor="#ffffcc">PAGU</td>
		<td align="center" width="150" bgcolor="#ffffcc">REALISASI</td>
		<td align="center" bgcolor="#ffffcc">%</td>
		
		<td align="center" width="150" bgcolor="#83ceee">PAGU</td>
		<td align="center" width="150" bgcolor="#83ceee">REALISASI</td>
		<td align="center" bgcolor="#83ceee">%</td>
	</tr>
	
	<tr>
		<td align="center" bgcolor="#eaa3bb" ><?php print "$jpagu51"; ?></td>
		<td align="center" bgcolor="#eaa3bb"><?php print "$jreals51"; ?></td>
		<td align="center" bgcolor="#eaa3bb"><?php print "$hsserap51"; ?></td>
		
		<td align="center" bgcolor="#ffffcc"><?php print "$jpagu52"; ?></td>
		<td align="center" bgcolor="#ffffcc"><?php print "$jreals52"; ?></td>
		<td align="center" bgcolor="#ffffcc"><?php print "$hsserap52"; ?></td>
		
		
		<td align="center" bgcolor="#83ceee"><?php print "$jpagu53"; ?></td>
		<td align="center" bgcolor="#83ceee"><?php print "$jreals53"; ?></td>
		<td align="center" bgcolor="#83ceee"><?php print "$hsserap53"; ?></td>
		
	</tr>
</table><br></div><br><br>	