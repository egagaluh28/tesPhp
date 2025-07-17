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
	$edit = mysql_query("SELECT * FROM tajuk_ttd WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
?>	
<br>
<center><span class="judul">EDIT TAJUK TANDA TANGAN</span></center><br>
<center><div id="bdr" ><div class="form-style-2">
<form action="pengelola/ttd/proses.php?aksi=ubah" method="POST"  name="form1">  
<input name="id" type="hidden"  size="5" class="input-field"  <? print "value='$row[id]'"; ?>/>
    <table width="80%" align="center" cellpadding="3">

			<tr>	
			
				<td valign="middle" width="40%" align="right" class="subyek1">BULAN :</td>
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
				<td  align="right" class="subyek1">JABATAN :</td>
			    <td valign="top" ><input name="an" type="text"  size="30" class="input-field"  <? print "value='$row[an]'"; ?>/></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1"></td>
				<td valign="top" ><input name="pejabat1" type="text" size="30" class="input-field"  <? print "value='$row[pejabat1]'"; ?>/></td>
		    </tr>
			<tr>
				<td height="40"></td>
				<td></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">NAMA PENANDA TANGAN :</td>
				<td valign="top" ><input name="nama" type="text" size="30" class="input-field" required="required" <? print "value='$row[nama]'"; ?>/></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">PANGKAT / CORPS / NRP :</td>
				<td valign="top" ><input name="pkt_crp" type="text" size="30" class="input-field" required="required" <? print "value='$row[pkt_crp]'"; ?>/></td>
		    </tr>
			
			
		</table><br> 
	
	<div class='codehim-tombol-biru'>
<table  width="30%" align="center"   cellpadding="3">
			<tr>
				 <td  align="center"><input type="submit"  value="Simpan" ></td>
				 <td  align="center"><input type="button"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" ></td>
			</tr></table></div><br>
	
    </div></form></center> 
	
    </form> </div></div></center>


