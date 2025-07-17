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


.button-3d {
  position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #f39c12;
  background:#e67e22;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #d35400;
  -moz-box-shadow: 0px 6px 0px #d35400;
  box-shadow: 0px 6px 0px #d35400;
}

.button-3d:active{
    -webkit-box-shadow: 0px 2px 0px #d35400;
    -moz-box-shadow: 0px 2px 0px #d35400;
    box-shadow: 0px 2px 0px #d35400;
    position:relative;
    top:4px;
}

.button-3d:hover{
   position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #47ba0f;
  background:#5e8b0f;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #377b15;
  -moz-box-shadow: 0px 6px 0px #377b15;
  box-shadow: 0px 6px 0px #377b15;
}


</style>

<head>
<title>Perekaman Sah</title>

<? 
  
	$ambil=mysql_query("select  a.*, b.nmbulan from surat a
							  left join t_bulan b on a.kdbulan=b.kdbulan	where  idsurat='$_GET[idsurat]'");
	$isi   = mysql_fetch_array($ambil);

?>

</head>
<body>

<br>
<table width="50%" align="center" >
			<tr><td align="center">
			<? print "<a href='cetak/cetak_surat_ktm_sbsn.php?idsurat=$_GET[idsurat]&kdbulan=$isi[kdbulan]&thang=$isi[thang]&kdkotama=$isi[kdkotama]&kdsatker=$isi[kdsatker]' target='_blank'>"; ?>
			<input class="button-3d" type="submit" name="backup"  value="CETAK SURAT" /></a></td>
			
			<td align="center">
			<? print "<a href='media.php?module=editsuratdetail_ktm&idsurat=$_GET[idsurat]' >"; ?>
			<input class="button-3d" type="submit" name="backup"  value="UBAH SURAT" /></a></td>
			
			<td align="center">
			<? print "<a href='media.php?module=surat_ktm' >"; ?>
			<input class="button-3d" type="submit" name="backup"  value="&nbsp;&nbsp;&nbsp;KEMBALI&nbsp;&nbsp;&nbsp;" /></a></td>
			</tr> 
</table> <br>
<center><div id="borderku1" > 
 <div class="form-style-2">
  <table cellpadding="5"> 
  <tr>
		<td valign="middle"  align="right" class="subyek1">LAPLAKGAR BULAN :</td>
		<td><? print "<select name='kdbulan'  class='select-field' disabled >";
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
		<td><? print "<select name='thang' class='select-field' disabled >
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
		<td><input name="tempat_tanggal" type="text"  <? print "value='$isi[tempat_tanggal]'"; ?>  class="input-field" size="50" readonly /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">NOMOR SURAT :</td>
		<td><input name="nomor" type="text"  <? print "value='$isi[nomor]'"; ?>  class="input-field" size="50" readonly />
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">KLASIFIKASI :</td>
		<td><input name="klasifikasi" type="text"  <? print "value='$isi[klasifikasi]'"; ?>  class="input-field" size="50"readonly />
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">LAMPIRAN :</td>
		<td><input name="lampiran" type="text"  <? print "value='$isi[lampiran]'"; ?>  class="input-field" size="50" readonly />
		</td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">PERIHAL :</td>
		<td><input name="perihal" type="text" size="70" <? print "value='$isi[perihal]'"; ?> class="input-field"  readonly /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">PANJANG GARIS BAWAH :</td>
		<td><input name="garis" type="grs" size="7" <? print "value='$isi[garis]'"; ?> class="input-field"  style="text-align: center;" readonly /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">KEPADA :</td>
		<td><input name="tujuan_surat" type="text" size="50"  <? print "value='$isi[tujuan_surat]'"; ?> class="input-field"  /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">DI :</td>
		<td><input name="kota_penerima" type="text" size="50"  <? print "value='$isi[kota_penerima]'"; ?> class="input-field"  readonly /></td>
	</tr>
	
	<tr>
		<td valign="middle"  align="right" class="subyek1">UP  :</td>
		<td><input name="up" type="text" size="50" <? print "value='$isi[up]'"; ?> class="input-field"  readonly /></td>
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
 </form></div></div><br><br>
</body>







