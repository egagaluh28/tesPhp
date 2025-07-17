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
<br>
<center><span class="judul">INPUT LAMPIRAN LAPLAKGAR</span></center><br>
<center><div id="bdr" ><div class="form-style-2">

<form action="pengelola/lampiran/proses.php?aksi=simpan" method="POST"  name="form1">  
<input name="kdkotama" type="hidden"  size="5" class="input-field"  <? print "value='$_SESSION[kdkotama]'"; ?>/>
<input name="kdsatker" type="hidden"  size="5" class="input-field"  <? print "value='$_SESSION[kdsatker]'"; ?>/>
    <table width="800" align="center" cellpadding="3"  >
	
	<tr>	
			
				<td valign="middle" align="right" class="subyek1">BULAN :</td>
		<td><?php print "<select name='kdbulan'  class='select-field' required='required' style='width:80%'>";
						print "<option value='' selected> Pilih </option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
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
									  if ($thn==$isi[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>"; ?>
		</td>
	</tr>

			<tr>
				<td width="250" align="right" class="subyek1">Lampiran :</td>
			    <td valign="top" ><input name="brs1" type="text"  style='width:80%' class="input-field" required="required"/></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">Nomor :</td>
				<td valign="top" ><input name="brs2" type="text" style='width:80%' class="input-field" required="required"/></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">Tanggal :</td>
			    <td valign="top" ><input name="brs3" type="text"  style='width:80%' class="input-field"  required="required"/></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">Panjang Garis :</td>
				<td valign="top" ><input name="panjang_grs" type="text" size="5" class="input-field" required="required" value="60"/></td>
		    </tr>
			
			<tr>
				<td  align="right" class="subyek1">Posisi Text :</td>
				<td valign="top" ><input name="posisi_grs" type="text" size="5" class="input-field" required="required" value="210"/></td>
		    </tr>
			
			
		</table><br> 
	
	<div class='codehim-tombol-biru'>
<table  width="30%" align="center"   cellpadding="3">
			<tr>
				 <td  align="center"><input type="submit"  value="Simpan" ></td>
				 <td  align="center"><input type="button"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" ></td>
			</tr></table></div>
	
    </form></div></div></center><br>


