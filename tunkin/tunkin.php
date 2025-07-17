<html>
<head>
<title>..::: Sub Akun :::..</title>
<br><br>
<style>
.combo{
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
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
	     $qry = mysql_query("select * from t_bulan where kdbulan='$_GET[kdbulan]' ");
		 $x    = mysql_fetch_array($qry);
		 
		 $bln=strtoupper($x[nmbulan]);

echo "<center><span class='judul'>REKAP TUNKIN PER GRADE $bln $_GET[thang]</span></center><br>";
	
	print "<div class='codehim-tombol-biru'><table  width='60%'   align='center'>";
	
	print "<form name='form1' method='GET'  action='tunkin/kirimvariabel.php' >";
	print  	"<tr >
				<td class='subyek1' >BULAN : <select name='kdbulan'  class='combo' >";
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
	print "TAHUN : <select name='thang' class='combo'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2025;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses' />
				</td>
			</tr></form></table><br>";
	
	print  	"<table width='60%'   align='center'><tr >
				<td>"; if (($_GET[kdbulan]=='') or ($_GET[thang]=='')) { print "";  } else {
				print "<a href='media.php?module=inputtunkin&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' style='text-decoration:none'><input  type='button' value='Tambah' /></a>"; }
				print "</td>
				<td align='right'><a href='cetak/cetaktunkin_satker.php?kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' target='_blank'  style='text-decoration:none'><input  type='button' value='Cetak' /></a>
			</tr>
			</table></div></center><br>";
	
	
// -------------------------------------------------------	
		
	
	print "<table width='60%'   align='center' class='bordered'>";
	print "<tr  height='35'>";
	print    "<th   align='center'   >NO</th>";
	print    "<th   align='center'   >GREDE</th>";
	print    "<th   align='center'  >INDEX</th>";	
	print    "<th   align='center'  >JLM PERS</th>";
	print    "<th   align='center'  >JML TUNKIN</th>";
	print    "<th   align='center'  >PAJAK</th>";
	print    "<th   align='center'  >REALISASI</th>";
	
	print    "<th   colspan='2' align='center' valign='middle'  >AKSI</th>";
	print "</tr>";

	$sql="select a.*, b.id_tunkin, b.jumlah, b.pajak from t_grade a  left join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	thang='$_GET[thang]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'  order by a.grade desc"; 
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
		
    print "<td  align='center'><a href='media.php?module=edittunkin&id_tunkin=$row[id_tunkin]'><img src='images/edit.png' width='20' title='Edit'></a></td>";
	print"<td  align='center' valign='top'><a href=\"tunkin/proses.php?aksi=hapus&id_tunkin=$row[id_tunkin]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS GRADE $row[grade] ? ')\" ><img src='images/delete.png' width='20' title='Delete'></td></tr>"; 
    $no++;
  
 	}
	
	$jml="select sum(a.indeks*b.jumlah) as total_tunkin, sum(b.jumlah) as total_pers, sum(b.pajak) as total_pajak from t_grade a  join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	b.thang='$_GET[thang]' and b.kdkotama='$_SESSION[kdkotama]' and b.kdsatker='$_SESSION[kdsatker]' group by b.kdkotama,b.kdsatker,b.kdbulan,b.thang"; 
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
	print "<td align='right'></td>";
	print "<td align='right'></td>";  
    print "</table><br>";

 
	
	
?>
			