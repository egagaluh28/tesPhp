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
<center><span class="judul">INPUT AKUN</span></center><br>

<center><div id="bdr">
<div class="form-style-2">

<form action="pengelola/akun/proses.php?aksi=simpan" method="POST"  name="form1">  
    <table width="900" align="center" cellpadding="3">

			<tr>
				<td width="200" align="right" class="subyek1">JENIS BELANJA :</td>
			    <td valign="top" ><? print "<select name='kdjenbel'  class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select * from t_jenbel   order by kdjenbel";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdjenbel]==$_POST[kdjenbel])
							echo "<option value=$data[kdjenbel] selected>$data[kdjenbel] | $data[nmjenbel]</option>";
						 else
							echo "<option value=$data[kdjenbel]>$data[kdjenbel] | $data[nmjenbel]</option>";
				    }  
			print "</select>"; ?></td>
			</tr>
			<tr>
				<td width="200" align="right" class="subyek1">KODE AKUN :</td>
			    <td valign="top" ><input name="kdakun" type="text"  size="8" class="input-field" required="required" /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">NAMA AKUN :</td>
				<td valign="top" ><input name="nmakun" type="text" size="70" class="input-field" required="required" /></td>
		    </tr>
            
			
		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr><td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></td></div>  
			</tr></table><br>
	
    </form>  


