<style>
#borderku{
width:800px;
background-image: url(images/bg.jpg);
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333;  
padding: 6px;
font-size: 16px;
color:#666;
font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
}

</style>
<?

switch ($_SESSION['kdwasgiat']) {
case "01" : $bidang="INTELIJEN";break;
case "02" : $bidang="OPERASI";break;
case "03" : $bidang="PERSONEL";break;
case "04" : $bidang="LOGISTIK";break;
case "05" : $bidang="TERITORIAL";break;
case "06" : $bidang="PERENCANAAN";break;
case "07" : $bidang="LATIHAN";break;
}
$indbul=$bidang;
?>


 <center><br><span class='judulcontent'>
 <? if ($_SESSION['kdtingkat']=='02') {
	 print "CETAK MONITORING DIPA DAERAH TINGKAT SATKER PER WASGIAT"; 
	} else {
	 print "CETAK MONITORING DIPA DAERAH TINGKAT SATKER BIDANG $indbul";
	}
 ?>
 </span></center><br><br>
 
 <center>
 <?
  print "<div id='borderku' ><div class='form-style-2'>";
  print "<form name='form1' method='GET'  action='cetak/cetak_prog_daerah_satker_wasgiat.php' target='_blank'>";
       
	if ($_SESSION['kdtingkat']=='02') {
	
	print "<div class='codehim-tombol-biru'><table width='80%' align='center' cellpadding='3' >";
    print "<tr>";	
    print "<td class='subyek1' align='right' width='40%'><input name='kdkotama' type='hidden'  value='$_SESSION[kdkotama]'  readonly class='rounded'/>WASGIAT : </td>";
	print "<td><select name='kdwasgiat'  class='select-field' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_wasgiat order by kdwasgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$_POST[nmwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[nmwasgiat]</option>";
				    }  
	print "</select></td>";
	print "<tr>";	
    print "<td class='subyek1' align='right' width='40%'>SATKER : </td>
	      <td><select name='kdsatker'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih Satker - -</option>";
						 $sql="select * from t_satkr where kdkotama='$_SESSION[kdkotama]' order by kdsatkr";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsatkr]==$_POST[kdsatkr])
							echo "<option value=$data[kdsatkr] selected>$data[nmsatkr]</option>";
						 else
							echo "<option value=$data[kdsatkr]>$data[nmsatkr]</option>";
				    }  
	print "</select></td>";
	
	print "<tr>";	
    print "<td class='subyek1' align='right' width='40%'>BULAN : </td>
	      <td><select name='kdbulan'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select></td>";
	
	print "<tr>";	
    print "<td class='subyek1' align='right' width='40%'>TAHUN : </td>
		   <td><select name='thang' class='select-field' required='required' >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select></td>";

	print "<tr>";
	print "<td class='subyek1' align='right'>LAMPIRAN : </td>
		   <td><input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp&nbsp<input  type='submit' value='Cetak' /></td>";
    print "<tr></table>";	
	
	
	} else {
	
	print "<input name='kdkotama' type='hidden'  value='$_SESSION[kdkotama]'  readonly class='rounded'/>";
	print "<input name='kdwasgiat' type='hidden'  value='$_SESSION[kdwasgiat]'  readonly class='rounded'/>";
	print "SATKER : 
	      <select name='kdsatker'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih Satker - -</option>";
						 $sql="select * from t_satkr where kdkotama='$_SESSION[kdkotama]' order by kdsatkr";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsatkr]==$_POST[kdsatkr])
							echo "<option value=$data[kdsatkr] selected>$data[nmsatkr]</option>";
						 else
							echo "<option value=$data[kdsatkr]>$data[nmsatkr]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	
	print "BULAN : 
	      <select name='kdbulan'  class='select-field' required='required' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	
	print "TAHUN : <select name='thang' class='select-field'  required='required'>
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>&nbsp;&nbsp&nbsp";	
	print "LAMPIRAN : <input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp&nbsp<input  type='submit' value='Cetak' />";								  
	}
			
									  
				
	print "</form></div></div></div><br>";
	
	?>