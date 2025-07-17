<style>


textarea
{
width: 650px;
height: 60px;
border-radius: 3px;
border: 1px solid #999999;
padding: 8px;
font-weight: 200;
font-size: 15px;
font-family: Verdana;
box-shadow: 1px 1px 5px #999999;
color:#666666;
}
textarea:hover
{
width: 650px;
height: 60px;
border-radius: 3px;
border: 1px solid #aaa;
padding: 8px;
font-weight: 200;
font-size: 15px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
}
.rp
{
font-family: Verdana;
color:#
}



</style>

<head>
<title>Perekaman Sah</title>

<? 
  
	$ambil=mysql_query("select * from surat where  idsurat='$_GET[idsurat]'");
	$isi   = mysql_fetch_array($ambil);

?>

</head>
<body>

<br>
<center><span class="judulcontent">EDIT SURAT</span></center><br>
<center><div id="borderku1" > 
 <div class="form-style-2">
  <form  name="form1" method="post" action="pengelola/surat/proses.php?aksi=ubahktm"> 
  <table  width="95%" border="0" cellspacing="2" cellpadding="2" align="center"> 
  <input name="kdkotama" type="hidden"  <? print "value='$_SESSION[kdkotama]'"; ?>  class="input-field" size="50"/>
  <input name="kdsatker" type="hidden"  <? print "value='$_SESSION[kdsatker]'"; ?>  class="input-field" size="50"/>
  <input name="idsurat" type="hidden"  <? print "value='$_GET[idsurat]'"; ?>  class="input-field" size="50"/>
    <tr>
		<td valign="middle"  align="right" class="subyek1">LAPLAKGAR BULAN :</td>
		<td><? print "<select name='kdbulan'  class='select-field' required='required'>";
						print "<option value='' selected> Pilih </option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$isi[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>"; ?>
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">TAHUN :</td>
		<td><? print "<select name='thang' class='select-field' required='required'>
									  <option value='' selected>Tahun</option>";
									  for ($thn=2020;$thn<=2025;$thn++){
									  if ($thn==$isi[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>"; ?>
		</td>
	</tr>
		
    
	<tr>
		<td valign="middle"  align="right" class="subyek1">TEMPAT/TANGGAL SURAT :</td>
		<td><input name="tempat_tanggal" type="text"  <? print "value='$isi[tempat_tanggal]'"; ?>  class="input-field" size="50"/></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">NOMOR SURAT :</td>
		<td><input name="nomor" type="text"  <? print "value='$isi[nomor]'"; ?>  class="input-field" size="50"/>
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">KLASIFIKASI :</td>
		<td><input name="klasifikasi" type="text"  <? print "value='$isi[klasifikasi]'"; ?>  class="input-field" size="50"/>
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">LAMPIRAN :</td>
		<td><input name="lampiran" type="text"  <? print "value='$isi[lampiran]'"; ?>  class="input-field" size="50"/>
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">PERIHAL :</td>
		<td><input name="perihal" type="text" size="70" <? print "value='$isi[perihal]'"; ?> class="input-field"  /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">PANJANG GARIS BAWAH :</td>
		<td><input name="garis" type="grs" size="7" <? print "value='$isi[garis]'"; ?> class="input-field"  style="text-align: center;"/></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">KEPADA :</td>
		<td><input name="tujuan_surat" type="text" size="50"  <? print "value='$isi[tujuan_surat]'"; ?> class="input-field"  /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">DI :</td>
		<td><input name="kota_penerima" type="text" size="50"  <? print "value='$isi[kota_penerima]'"; ?> class="input-field"  /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">UP  :</td>
		<td><input name="up" type="text" size="50" <? print "value='$isi[up]'"; ?> class="input-field"  /></td>
	</tr>
	

   
	<tr>
      <td valign="top" align="right" class="subyek1">DASAR :</td>
      <td><textarea   name="dasar_a"  ><? print "$isi[dasar_a]"; ?></textarea></td>
    </tr>
	
	
	
	<tr>
      <td valign="top" align="right" class="subyek1"></td>
      <td><textarea   name="dasar_b"   ><? print "$isi[dasar_b]"; ?></textarea></td>
    </tr>
	
	<tr>
      <td valign="top" align="right" class="subyek1"></td>
      <td><textarea   name="dasar_c"   ><? print "$isi[dasar_c]"; ?></textarea></td>
    </tr>
	
</table><br>
<center><div class='codehim-tombol-biru'>
        <input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" >
     </div>
	 </center> 
 </form></div></div><br><br>
</body>







