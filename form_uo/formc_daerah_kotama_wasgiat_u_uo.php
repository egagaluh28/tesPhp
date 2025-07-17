
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
}
$indbul=$bidang;
?>


 <center><br><span class='judulcontent'>
 <? if ($_SESSION['kdtingkat']=='02') {
	 print "CETAK MONITORING DIPA DAERAH TINGKAT KOTAMA PER WASGIAT"; 
	} else {
	 print "CETAK MONITORING DIPA DAERAH TINGKAT KOTAMA BIDANG $indbul";
	}
 ?>
 </span></center><br><br>
 
 <center>
 <?
  print "<div id='borderku' ><div class='form-style-2'>";
 print "<form name='form1' method='GET'  action='cetak/cetak_mon_daerah_ktm_wasgiat.php' target='_blank'>";
    
	
	print "<table width='90%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1' align='center'>";
	
	print "<input name='kdwasgiat' type='hidden'  value='$_SESSION[kdwasgiat]'  readonly class='rounded'/>";
	
	print "KOTAMA : 
	      <select name='kdkotama'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_kotam order by kdkotama";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdkotama]==$_POST[kdkotama])
							echo "<option value=$data[kdkotama] selected>$data[nmkotama]</option>";
						 else
							echo "<option value=$data[kdkotama]>$data[nmkotama]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	
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
									  for ($thn=2018;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>&nbsp;&nbsp&nbsp";	

			
	print "LAMPIRAN : <input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp&nbsp<input  type='submit' value='Cetak' class='button blue'/>";		
	print "</form></div></div><br>";
	
	
	?>