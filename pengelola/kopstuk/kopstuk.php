<html>
<head>
<title>kopstuk</title>
<br>
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
    $sql="select * from kopstuk where kdkotama = '$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'"; 
    $qry=mysql_query($sql);
	

	$row=mysql_fetch_array($qry);


	echo"<center><span class='judulcontent'>KOPSTUK</span></center><br>";
	print "<div class='codehim-tombol-biru'><table  width='60%' align='center'   cellpadding='3'>";
	print  	"<tr ><td>
				<a href='media.php?module=inputkopstuk' style='text-decoration:none'><input  type='button' value='Tambah' /></a>&nbsp;&nbsp;
				<a href='media.php?module=editkopstuk&id=$row[id]' style='text-decoration:none'><input  type='button' value='Ubah' /></a>&nbsp;&nbsp;
				<a href=\"pengelola/kopstuk/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS KOPSTUK ? ')\" style='text-decoration:none'><input  type='button' value='Hapus' /></a>
		</td></tr></table></div><br>";

	
	
	print "<table width='60%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print    "<tr><td width='150'>BARIS PERTAMA</td>
				   <td>$row[kop1]</td>
			  </tr>";
	print    "<tr><td>BARIS KEDUA</td>
				  <td>$row[kop2]</td>
			  </tr>";
	
	print    "<tr bgcolor='#dce9f9'><td colspan='2'>Tentukan Panjang Kopstuk dan Panjang Garis Untuk Lembar Pengesahan</td></tr>";		  
	print    "<tr><td>PJG KOP</td>
				  <td >$row[panjang_kop]</td>
		     </tr>";
	print    "<tr>
				  <td>PJG GARIS</td>
				  <td >$row[panjang_grs]</td>
			 </tr>";
			 
	
    print "</table><br>";
 

	
?>
			