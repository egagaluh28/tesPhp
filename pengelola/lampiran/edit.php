<style>
#bdr{
width:900px;
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
<? 
	$edit = mysql_query("SELECT * FROM lamp_laplakgar WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
?>	
<br>
<center><span class="judul">EDIT LAMPIRAN LAPLAKGAR</span></center><br>
<center><div id="bdr" ><div class="form-style-2">
<form action="pengelola/lampiran/proses.php?aksi=ubah" method="POST"  name="form1">  
<input name="kdkotama" type="hidden"  size="5" class="input-field"  <? print "value='$row[kdkotama]'"; ?>/>
<input name="kdsatker" type="hidden"  size="5" class="input-field"  <? print "value='$row[kdsatker]'"; ?>/>
<input name="id" type="hidden"  size="5" class="input-field"  <? print "value='$row[id]'"; ?>/>
    <table width="800" align="center" cellpadding="3">
	
					<tr>	
			
				<td valign="middle" align="right" class="subyek1">BULAN :</td>
		<td><?php print "<select name='kdbulan'  class='select-field' required='required' style='width:80%'>";
						print "<option value='' selected> Pilih </option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$row[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>"; ?>
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">TAHUN :</td>
		<td><?php print "<select name='thang' class='select-field' required='required' style='width:80%'>
									  <option value='' selected>Pilih</option>";
									  for ($thn=2023;$thn<=2035;$thn++){
									  if ($thn==$row[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>"; ?>
		</td>
	</tr>

			<tr>
				<td width="250" align="right" class="subyek1">Lampiran :</td>
			    <td valign="top" ><input name="brs1" type="text"  style='width:80%' class="input-field"  
				<? print "value='$row[brs1]'"; ?> /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">Nomor :</td>
				<td valign="top" ><input name="brs2" type="text" style='width:80%' class="input-field" 
				<? print "value='$row[brs2]'"; ?> /></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">Tanggal :</td>
			    <td valign="top" ><input name="brs3" type="text"  style='width:80%' class="input-field" 
				<? print "value='$row[brs3]'"; ?> /></td>
				
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">Panjang Garis :</td>
				<td valign="top" ><input name="panjang_grs" type="text" size="5" class="input-field" required="required" 
				<? print "value='$row[panjang_grs]'"; ?> /></td>
		    </tr>
			
			<tr>
				<td  align="right" class="subyek1">Posisi Text :</td>
				<td valign="top" ><input name="posisi_grs" type="text" size="5" class="input-field" 
				<? print "value='$row[posisi_grs]'"; ?> /></td>
		    </tr>
			
			
		</table><br> 
	
	<div class='codehim-tombol-biru'>
<table  width="30%" align="center"   cellpadding="3">
			<tr>
				 <td  align="center"><input type="submit"  value="Simpan" ></td>
				 <td  align="center"><input type="button"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" ></td>
			</tr></table></div><br>
	
    </form></div></div></center>


