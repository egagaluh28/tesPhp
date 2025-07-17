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
<center><span class="judulcontent">INPUT TAJUK TANDA TANGAN</span></center><br>
<center><div id="bdr" ><div class="form-style-2">
<form action="pengelola/ttd/proses.php?aksi=simpan" method="POST"  name="form1">  
<input name="kdkotama" type="hidden"  size="5" class="select-field"  <? print "value='$_SESSION[kdkotama]'"; ?>/>	
<input name="kdsatker" type="hidden"  size="5" class="select-field"  <? print "value='$_SESSION[kdsatker]'"; ?>/>	
    <table width="85%" align="center" cellpadding="3">

		<tr>	
			
				<td valign="middle" width="40%" align="right" class="subyek1">BULAN :</td>
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
				<td  align="right" class="subyek1">ATAS NAMA :</td>
			    <td valign="top" ><input name="an" type="text"  style='width:80%' class="select-field"  /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1"></td>
				<td valign="top" ><input name="pejabat1" type="text" style='width:80%' class="select-field"  /></td>
		    </tr>
			<tr>
				<td height="40"></td>
				<td></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">NAMA PENANDA TANGAN :</td>
				<td valign="top" ><input name="nama" type="text" style='width:80%' class="select-field" required="required" /></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">PANGKAT / CORPS / NRP :</td>
				<td valign="top" ><input name="pkt_crp" type="text" style='width:80%' class="select-field" required="required" /></td>
		    </tr>
			
		</table><br> 
	
	<div class='codehim-tombol-biru'>
<table  width="30%" align="center"   cellpadding="3">
			<tr>
				 <td  align="center"><input type="submit"  value="Simpan" ></td>
				 <td  align="center"><input type="button"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" ></td>
			</tr></table></div>
	
    </div></form></center> 
	
    </form>
    </div></div></center><br>
