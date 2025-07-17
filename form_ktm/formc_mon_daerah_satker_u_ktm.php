
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
 <center><br><span class='judulcontent'>CETAK MONITORING DIPA DAERAH TINGKAT SATKER </span></center><br><br>
 
 <center>
 <?
  print "<div id='borderku' ><div class='form-style-2'>";
 print "<div class='codehim-tombol-biru'><form name='form1' method='GET'  action='cetak/cetak_prog_daerah_satker.php' target='_blank'>";
   
  print "<input type='hidden' name='kdkotama'  value='$_SESSION[kdkotama]' class='input-field' />";	
   print "<input type='hidden' name='kdsatker'  value='$_SESSION[kdsatker]' class='input-field' />";	
	print "SATKER : <select name='kdsatker'  class='select-field' required='required'>";
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
	
	print "BULAN : <select name='kdbulan'  class='select-field' required='required'>";
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
	
	print "TAHUN : <select name='thang' class='select-field' required='required' >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>&nbsp;&nbsp;";

	print "LAMPIRAN : <input type='text' name='lamp'  size='2' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp;<input  type='submit' value='Cetak' />";			
	
	
	print "</form></div></div></div><br>";
	
	?>