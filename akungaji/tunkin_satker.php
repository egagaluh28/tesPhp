<html>
<head>
<title>..::: Sub Akun :::..</title>
<br><br>
<link rel="stylesheet" href="library/udiwe.css" type="text/css" media="screen" />
<?
	     $qry = mysql_query("select * from t_bulan where kdbulan='$_GET[kdbulan]' ");
		 $x    = mysql_fetch_array($qry);

echo "<center><span class='judul'>REKAP TUNKIN PER GRADE $x[nmbulan] $_GET[thang]</span></center><br>";
		
	print "<table  width='60%' align='center'   cellpadding='3' >";
	
	
	print  	"<tr >
				
				<td align='right'><a href='cetak/cetaktunkin_satker.php?kdkotama=$_GET[kdkotama]&kdsatker=$_GET[kdsatker]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' target='_blank' class='button yellow'>C e t a k</a>
			</tr>
			</table><br>";
	
	
// -------------------------------------------------------	
		
	
	print "<table width='60%'  cellspacing='0' cellpadding='2' align='center' class='udiwe'>";
	print "<tr  height='30'>";
	print    "<td   align='center' class='header' background='images/hover.png' >NO</td>";
	print    "<td   align='center' class='header' background='images/hover.png' >GREDE</td>";
	print    "<td   align='center' class='header' background='images/hover.png'>INDEX</td>";	
	print    "<td   align='center' class='header' background='images/hover.png'>JLM PERS</td>";
	print    "<td   align='center' class='header' background='images/hover.png'>JML TUNKIN</td>";
	print    "<td   align='center' class='header' background='images/hover.png'>PAJAK</td>";
	print    "<td   align='center' class='header' background='images/hover.png'>REALISASI</td>";
	print "</tr>";

	$sql="select a.*, b.id_tunkin, b.jumlah, b.pajak from t_grade a  left join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	thang='$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'  order by a.grade desc"; 
	$qry=mysql_query($sql);
	

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	
	$indeks	 = number_format($row[indeks],0,',','.');
	$jumlah	 = number_format($row[jumlah],0,',','.');
	$pajak	 = number_format($row[pajak],0,',','.');
	$total	 = $row[indeks]*$row[jumlah];
	$total_rb	 = number_format($total,0,',','.');
	
	$realisasi = $total + $row[pajak];
	$realisasi_rb	 = number_format($realisasi,0,',','.');
 
	print "<tr ><td align='center'>$no</td>";
	print "<td align='center'>$row[grade]</td>";
	print "<td align='right'>$indeks</td>";
	print "<td align='right'>$jumlah</td>";
	print "<td align='right'>$total_rb</td>";	
	print "<td align='right'>$pajak</td>";	
	print "<td align='right'>$realisasi_rb</td>";	
		
  
    $no++;
  
 	}
	
	$jml="select sum(a.indeks*b.jumlah) as total_tunkin, sum(b.jumlah) as total_pers, sum(b.pajak) as total_pajak from t_grade a  join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	b.thang='$_GET[thang]' and b.kdkotama='$_GET[kdkotama]' and b.kdsatker='$_GET[kdsatker]' group by b.kdkotama,b.kdsatker,b.kdbulan,b.thang"; 
	$oke=mysql_query($jml);
	$hasil    = mysql_fetch_array($oke); 
	
	$total_tunkin	 = number_format($hasil[total_tunkin],0,',','.');
	$total_pers	     = number_format($hasil[total_pers],0,',','.');
	$total_pajak	 = number_format($hasil[total_pajak],0,',','.');
	
	$realisasi = $hasil[total_tunkin] + $hasil[total_pajak]; 
	$total_realisasi	 = number_format($realisasi,0,',','.');
	
	print "<tr ><td align='center'></td>";
	print "<td align='center' colspan='2'>JUMLAH</td>";
	print "<td align='right'>$total_pers</td>";
	print "<td align='right'>$total_tunkin</td>";	
	print "<td align='right'>$total_pajak</td>";	
	print "<td align='right'>$total_realisasi</td>";
    print "</table><br>";

 
	
	
?>
			