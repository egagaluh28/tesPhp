<html>
<head>
<title>..::: Satker :::..</title>
<br><br>

<?
include "../buku2014/library/css_table.php"; 
		
	print "<table  width='90%' align='center'   cellpadding='3' >";
	print  	"<tr ><td><a href='media.php?module=inputsatker' class='button blue'>Tambah Data</a></td></tr></table><br>";

	
	$no=1;
	print "<table width='80%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print "<tr bgcolor='#dce9f9' height='30'>";
	print    "<td   align='center'>NO</td>";
	print    "<td   align='center'>KODE DEPT</td>";
	print    "<td   align='center'>KODE UNIT</td>";
	print    "<td   align='center'>KODE KOTAMA</td>";
	print    "<td   align='center'>KODE SATKER</td>";
	print    "<td   align='center'>NAMA SATKER</td>";
	print    "<td   align='center'>KODE PEKAS</td>";		
	print    "<td   colspan='2' align='center' valign='middle'>AKSI</td>";
	print "</tr>";

	$sql="select * from t_satkr"; 
    $qry=mysql_query($sql);
	

	while ($row=mysql_fetch_array($qry)) {
 
	print "<tr ><td align='center'>$no</td>";
	print "<td align='center'>$row[kddept]</td>";
	print "<td align='center'>$row[kdunit]</td>";
	print "<td align='center'>$row[kdkotama]</td>";
	print "<td align='center'>$row[kdsatkr]</td>";
	print "<td >$row[nmsatkr]</td>";
	print "<td align='center'>$row[layanan]</td>";	
    print "<td  align='center'><a href='media.php?module=editsatker&id=$row[id]'><img src='images/edit.png' width='20' title='Edit'></a></td>";
	print"<td  align='center' valign='top'><a href=\"pengelola/satker/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS SATKER ? ')\" ><img src='images/delete.png' width='20' title='Delete'></td>"; 
    $no++;
  
 	}
	  
    
	 print "</table><br>";
	
?>
			