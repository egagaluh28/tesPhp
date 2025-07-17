<html>
<head>
<title>..::: Akun :::..</title>
<br><br>

<?
include "library/css_table.php"; 

		// Paging Langkah 1
$batas=15; 
$module=$_GET['module'];
$halaman=$_POST['halaman'];


if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
		
	print "<table  width='90%' align='center'   cellpadding='3' >";
	print  	"<tr ><td><a href='mediasatker.php?module=inputakun' class='button blue'>Tambah Data</a></td></tr></table><br>";


	$no=$posisi+1;
// -------------------------------------------------------	
	
	
	//$no=1;
	print "<table width='80%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print "<tr bgcolor='#dce9f9' height='30'>";
	print    "<td   align='center'>NO</td>";
	print    "<td   align='center'>KODE AKUN</td>";
	print    "<td   align='center'>NAMA AKUN</td>";
	print    "<td   colspan='2' align='center' valign='middle'>AKSI</td>";
	print "</tr>";

	$sql="SELECT * FROM t_akun limit $posisi, $batas";
	$tampil2="SELECT * FROM t_akun";


	$qry=mysql_query($sql);
	$hasil2=mysql_query($tampil2);
	$jmldata=mysql_num_rows($hasil2);
	$jmlhalaman=ceil($jmldata/$batas);
	
	//$sql="select * from t_akun "; 
    //$qry=mysql_query($sql);
	

	while ($row=mysql_fetch_array($qry)) {
 
	print "<tr ><td align='center'>$no</td>";	
	print "<td align='center'>$row[kdakun]</td>";
	print "<td align='left'>$row[nmakun]</td>";	
    print "<td  align='center'><a href='mediasatker.php?module=editakun&id=$row[id]'><img src='images/edit.png' width='20' title='Edit'></a></td>";
	print"<td  align='center' valign='top'><a href=\"pengelola/akun/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS AKUN ? ')\" ><img src='images/delete.png' width='20' title='Delete'></td>"; 
    $no++;
  
 	}
	  
    
	 print "</table><br>";

	 
 // ..::: --------- paging ---------  :::..
	 
$tampil2="select * from t_output ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);
$jmlhalaman=ceil($jmldata/$batas);	 


//$file="mediasatker.php?module=$module&halaman=$halaman";
$file="mediasatker.php?module=$module";
echo "<form method='post' action='$file'>
      <table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  Nomor Urut : </td><td><select name=halaman onChange='this.form.submit()' >";
      for ($i=1;$i<=$jmlhalaman;$i++){
        $awal = (($i*$batas)-$batas+1);
        $akhir = $batas*$i;
       if ($i==$halaman)
          echo "<option value=$i selected>$awal s/d $akhir</option>";
        else
          echo "<option value=$i> $awal s/d $akhir <br></option>";
       }
      echo "</select></td><td> dari <b>$jmldata</b>  File</td></tr></table></form>";
	
?>
			