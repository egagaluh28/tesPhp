<html>
<head>
<title>badan kesehatan bentuk dy4</title>
<br><br>
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
 
	$edit = mysql_query("SELECT * FROM kopstuk WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);



	echo"<center><span class='judul'>EDIT KOPSTUK</span></center><br>";
?>
<center><form action="pengelola/kopstuk/proses.php?aksi=ubah" method="POST"  name="form1">  
<input name="id" type="hidden"  size="5" class="input-field"  <? print "value='$row[id]'"; ?>/>
<div class="form-style-2">
<?	
	
	print "<table width='60%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print    "<tr><td>BARIS PERTAMA</td>
				   <td><input name='kop1' type='text'  size='50' class='input-field' value='$row[kop1]' required='required' /></td>
			  </tr>";
	print    "<tr><td>BARIS KEDUA</td>
				  <td><input name='kop2' type='text'  size='50' class='input-field'  value='$row[kop2]' required='required' /></td>
			  </tr>";
	
	print    "<tr bgcolor='#dce9f9'><td colspan='2'>Tentukan Panjang Kopstuk dan Panjang Garis Untuk Lembar Pengesahan</td></tr>";		  
	print    "<tr><td>PJG KOP</td>
				  <td ><input name='panjang_kop' type='text'  size='6' class='input-field' value='$row[panjang_kop]' required='required' /></td>
		     </tr>";
	print    "<tr>
				  <td>PJG GARIS</td>
				  <td ><input name='panjang_grs' type='text'  size='6' class='input-field' value='$row[panjang_grs]' required='required' /></td>
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

	

			