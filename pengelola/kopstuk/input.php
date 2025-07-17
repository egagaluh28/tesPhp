<html>
<head>
<title>badan kesehatan bentuk dy4</title>
<br><br>
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
   


	echo"<center><span class='judul'>INPUT KOPSTUK</span></center><br>";
?>
<center><form action="pengelola/kopstuk/proses.php?aksi=simpan" method="POST"  name="form1">
<div class="form-style-2">  
<input name="kdkotama" type="hidden"  size="5" class="input-field"  <? print "value='$_SESSION[kdkotama]'"; ?>/>	
<input name="kdsatker" type="hidden"  size="5" class="input-field"  <? print "value='$_SESSION[kdsatker]'"; ?>/>	

<?	

	
	print "<table width='60%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print    "<tr><td>BARIS PERTAMA</td>
				   <td><input name='kop1' type='text'  size='50' class='input-field' required='required' /></td>
			  </tr>";
	print    "<tr><td>BARIS KEDUA</td>
				  <td><input name='kop2' type='text'  size='50' class='input-field' required='required' /></td>
			  </tr>";
	
	print    "<tr bgcolor='#dce9f9'><td colspan='2'>Tentukan Panjang Kopstuk dan Panjang Garis Untuk Lembar Pengesahan</td></tr>";		  
	print    "<tr><td>PJG KOP</td>
				  <td ><input name='panjang_kop' type='text'  size='6' class='input-field' required='required' /></td>
		     </tr>";
	print    "<tr>
				  <td>PJG GARIS</td>
				  <td ><input name='panjang_grs' type='text'  size='6' class='input-field' required='required' /></td>
			 </tr>";
			 
	
			 
    print "</table><br>";
?>
<div class='codehim-tombol-biru'>
<table  width="30%" align="center"   cellpadding="3">
			<tr>
				 <td  align="center"><input type="submit"  value="Simpan" ></td>
				 <td  align="center"><input type="button"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" ></td>
			</tr></table></div><br>
	
    </div></form></center> 

	

			