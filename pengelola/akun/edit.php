<? 
	$edit = mysql_query("SELECT * FROM t_akun WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
?>	
<br>
<style>
#bdr{
width:1000px;
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
font-family: 'arial',  sans-serif;
}
</style>
<br>
<center><span class="judul">EDIT AKUN</span></center><br>

<center><div id="bdr">
<div class="form-style-2">

<form action="pengelola/akun/proses.php?aksi=ubah" method="POST"  name="form1">  
<input name="id" type="hidden"  size="5" class="roundedisi"  <? print "value='$row[id]'"; ?>/>
    <table width="900" align="center" cellpadding="3">
	
		    <tr>
				<td width="200" align="right" class="subyek1">JENIS BELANJA :</td>
			    <td valign="top" ><? print "<select name='kdjenbel'  class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select * from t_jenbel   order by kdjenbel";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdjenbel]==$row[kdjenbel])
							echo "<option value=$data[kdjenbel] selected>$data[kdjenbel] | $data[nmjenbel]</option>";
						 else
							echo "<option value=$data[kdjenbel]>$data[kdjenbel] | $data[nmjenbel]</option>";
				    }  
			print "</select>"; ?></td>
			</tr>

			<tr>
				<td width="200" align="right" class="subyek1">KODE AKUN :</td>
			    <td valign="top" ><input name="kdakun" type="text"  size="8" class="input-field" required="required" 
				<? print "value='$row[kdakun]'"; ?> /></td>
	 		</tr>
			<tr>
				<td  align="right" class="subyek1">NAMA AKUN :</td>
				<td valign="top" ><input name="nmakun" type="text" size="70" class="input-field" required="required" 
				<? print "value='$row[nmakun]'"; ?> /></td>
		    </tr>
			
			
			
		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>  
			</tr></table><br>
	
    </form> </div> </div>


