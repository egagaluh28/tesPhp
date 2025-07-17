
<style>
#borderku{
width:1100px;
background-image: url(images/bg.jpg);
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333;  
padding: 16px;
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
	 print "CETAK DIPA DAERAH TINGKAT KOTAMA PER PROGRAM PER WASGIAT"; 
	} else {
	 print "CETAK DIPA DAERAH TINGKAT KOTAMA BIDANG $indbul";
	}
 ?>
 </span></center><br><br>
 
 <center>
 <?
  print "<div id='borderku' ><div class='form-style-2'>";
 print "<div class='codehim-tombol-biru'><form name='form1' method='GET'  action='cetak/cetak_prog_daerah_ktm_wasgiat.php' target='_blank'>";
    
	if ($_SESSION['kdtingkat']=='02') {
	
	print "<input name='kdkotama' type='hidden'  value='$_SESSION[kdkotama]'  />
	<input name='kdsatker' type='hidden'  value='$_SESSION[kdsatker]'  />WASGIAT : ";
	print "<select name='kdwasgiat'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_wasgiat order by kdwasgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$_POST[nmwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[nmwasgiat]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	
	
	print "BULAN : 
	      <select name='kdbulan'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	
	print "TAHUN : <select name='thang' class='select-field'  required='required'>
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>&nbsp;&nbsp&nbsp";		
	
	} else {
	
	print "<input name='kdkotama' type='hidden'  value='$_SESSION[kdkotama]'  readonly class='rounded'/>";
	print "<input name='kdwasgiat' type='hidden'  value='$_SESSION[kdwasgiat]'  readonly class='rounded'/>";
	
	print "BULAN : 
	      <select name='kdbulan'  class='select-field' required='required'>";
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
	}
			
	print "LAMPIRAN : <input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp&nbsp<input  type='submit' value='Cetak' />";		
	print "</form></div></div></div><br>";
	
	
	?>