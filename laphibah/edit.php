
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


<script>

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}


function replaceNilai_hibah(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_hibah.value = temp;
}

function formatNilai_hibah(objek) {
nilai_hibah_awal = objek.value;
b = nilai_hibah_awal.replace(/[^\d]/g,"");
c = "";
panjang = b.length;
j = 0;
for (i = panjang; i > 0; i--) {
j = j + 1;
if (((j % 3) == 1) && (j != 1)) {
c = b.substr(i-1,1) + "." + c;
} else {
c = b.substr(i-1,1) + c;
}
}
objek.value = trimNumber(c);
} 


function replaceNilai_revisi(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_revisi.value = temp;
}

function formatNilai_revisi(objek) {
nilai_revisi_awal = objek.value;
b = nilai_revisi_awal.replace(/[^\d]/g,"");
c = "";
panjang = b.length;
j = 0;
for (i = panjang; i > 0; i--) {
j = j + 1;
if (((j % 3) == 1) && (j != 1)) {
c = b.substr(i-1,1) + "." + c;
} else {
c = b.substr(i-1,1) + c;
}
}
objek.value = trimNumber(c);
} 


function replaceNilai_sphl(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_sphl.value = temp;
}

function formatNilai_sphl(objek) {
nilai_sphl_awal = objek.value;
b = nilai_sphl_awal.replace(/[^\d]/g,"");
c = "";
panjang = b.length;
j = 0;
for (i = panjang; i > 0; i--) {
j = j + 1;
if (((j % 3) == 1) && (j != 1)) {
c = b.substr(i-1,1) + "." + c;
} else {
c = b.substr(i-1,1) + c;
}
}
objek.value = trimNumber(c);
} 



function replaceNilai_sp3hl(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_sp3hl.value = temp;
}

function formatNilai_sp3hl(objek) {
nilai_sp3hl_awal = objek.value;
b = nilai_sp3hl_awal.replace(/[^\d]/g,"");
c = "";
panjang = b.length;
j = 0;
for (i = panjang; i > 0; i--) {
j = j + 1;
if (((j % 3) == 1) && (j != 1)) {
c = b.substr(i-1,1) + "." + c;
} else {
c = b.substr(i-1,1) + c;
}
}
objek.value = trimNumber(c);
} 

</script>
<br>

<?
  $edit = mysql_query("SELECT a.*, b.nmsatkr from laphibah a 
  left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
  where a.id_laphibah='$_GET[id_laphibah]'");
  $row    = mysql_fetch_array($edit);
  
   if ($row[nilai_hibah]!='0') { $nilai_hibah=number_format($row[nilai_hibah],0,',','.'); }  else {  $nilai_hibah=''; }
   if ($row[batas_tarik_dana]!='0') { $batas_tarik_dana=number_format($row[batas_tarik_dana],0,',','.'); }  else {  $batas_tarik_dana=''; }
   if ($row[nilai_revisi]!='0') { $nilai_revisi=number_format($row[nilai_revisi],0,',','.'); }  else {  $nilai_revisi=''; }
   if ($row[nilai_sphl]!='0') { $nilai_sphl=number_format($row[nilai_sphl],0,',','.'); }  else {  $nilai_sphl=''; }
   if ($row[nilai_sp3hl]!='0') { $nilai_sp3hl=number_format($row[nilai_sp3hl],0,',','.'); }  else {  $nilai_sp3hl=''; }
?>  
	

<br>
<center><span class="judul">EDIT DATA</span></center><br>
<center><div id="bdr">
<div class="form-style-2">
<form action="laphibah/proses.php?aksi=ubah" method="POST"  name="form1">   
<input name="id_laphibah" type="hidden"  size="40" class="input-field" <? print "value='$row[id_laphibah]'"; ?>  />
   <table width="80%" align="center" cellpadding="2">

			<tr>
				<td  align="right" class="subyek1">PENERIMA HIBAH :</td>
			    <td valign="top" >
					<input type="hidden" name="thang"  class="input-field"  value="<? print "$row[thang]"; ?>"  />	
					<input type="hidden" name="kdsatker"  class="input-field"  value="<? print "$row[kdsatker]"; ?>"  />
					<input type="hidden" name="kdkotama"  class="input-field"  value="<? print "$row[kdkotama]"; ?>" />
				 <input type="text"  name="x"  size="40" class="input-field" readonly value="<? print "$row[nmsatkr]"; ?>" /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">PEMBERI HIBAH :</td>
				<td valign="top" ><input name="pemberi_hibah" type="text" size="40" class="input-field" 
				 value="<?php print "$row[pemberi_hibah]"; ?>" /></td>
		    </tr>
			
			
			
			<tr>
				<td  align="right" class="subyek1">NOMOR NPH :</td>
				<td valign="top" ><input name="no_nph" type="text" size="40" class="input-field" 
				value="<? print "$row[no_nph]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL NPH :</td>
				<td valign="top" ><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tgl_nph]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $panjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($panjang_karakter==1)
														$p="0".$i;
													else
														$p=$i;
												  
												  if ($tgl==$p)
													 echo "<option value=$p selected>$p</option>";
												  else
													 echo "<option value=$p>$p</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bln' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tgl_nph]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $panjang_bulan=strlen($bulan);
													if ($panjang_bulan==1)
														$b="0".$bulan;
													else
														$b=$bulan;
												  
												  
												  if ($bln==$b)
													   echo "<option value=$b selected>$nama_bln[$bulan]</option>";
												  else
													   echo "<option value=$b>$nama_bln[$bulan]</option>";
												  }
												  echo "</select> ";  

												  // Edit ComboBox Tahun
												  echo "<select name='thn' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[tgl_nph]",0,4);
												  for ($tahun=2019; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?></td>
			</tr> 
			
			<tr>
				<td  align="right" class="subyek1">URAIAN KEGIATAN :</td>
				<td valign="top" ><input name="uraian" type="text" size="40" class="input-field"  value="<? print "$row[uraian]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI HIBAH :</td>
				<td valign="top" ><? print "<input name='nilai_hibah' type='hidden'  value='$row[nilai_hibah]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_hibah_awal' onkeyup='formatNilai_hibah(this);replaceNilai_hibah(document.form1.nilai_hibah_awal.value);' 
					  style='text-align: right;' value='$nilai_hibah' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REGISTER :</td>
				<td valign="top" ><input name="no_reg" type="text" size="40" class="input-field"  value="<? print "$row[no_reg]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">BATAS AKHIR PENARIKAN DANA :</td>
				<td valign="top" ><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl1' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[batas_tarik_dana]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $panjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($panjang_karakter==1)
														$p="0".$i;
													else
														$p=$i;
												  
												  if ($tgl==$p)
													 echo "<option value=$p selected>$p</option>";
												  else
													 echo "<option value=$p>$p</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bln1' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[batas_tarik_dana]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $panjang_bulan=strlen($bulan);
													if ($panjang_bulan==1)
														$b="0".$bulan;
													else
														$b=$bulan;
												  
												  
												  if ($bln==$b)
													   echo "<option value=$b selected>$nama_bln[$bulan]</option>";
												  else
													   echo "<option value=$b>$nama_bln[$bulan]</option>";
												  }
												  echo "</select> ";  

												  // Edit ComboBox Tahun
												  echo "<select name='thn1' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[batas_tarik_dana]",0,4);
												  for ($tahun=2019; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REKENING :</td>
				<td valign="top" ><input name="no_rek" type="text" size="40" class="input-field"  value="<? print "$row[no_rek]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REVISI DIPA (DS) :</td>
				<td valign="top" ><input name="no_rev_dipa" type="text" size="40" class="input-field"  value="<? print "$row[no_rev_dipa]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI REVISI :</td>
				<td valign="top" ><? print "<input name='nilai_revisi' type='hidden'  value='$row[nilai_revisi]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_revisi_awal' onkeyup='formatNilai_revisi(this);replaceNilai_revisi(document.form1.nilai_revisi_awal.value);' 
					  style='text-align: right;' value='$nilai_revisi' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR SPHL :</td>
				<td valign="top" ><input name="no_sphl" type="text" size="40" class="input-field"  value="<? print "$row[no_sphl]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL SPHL :</td>
				<td valign="top" ><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl2' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tgl_sphl]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $panjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($panjang_karakter==1)
														$p="0".$i;
													else
														$p=$i;
												  
												  if ($tgl==$p)
													 echo "<option value=$p selected>$p</option>";
												  else
													 echo "<option value=$p>$p</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bln2' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tgl_sphl]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $panjang_bulan=strlen($bulan);
													if ($panjang_bulan==1)
														$b="0".$bulan;
													else
														$b=$bulan;
												  
												  
												  if ($bln==$b)
													   echo "<option value=$b selected>$nama_bln[$bulan]</option>";
												  else
													   echo "<option value=$b>$nama_bln[$bulan]</option>";
												  }
												  echo "</select> ";  

												  // Edit ComboBox Tahun
												  echo "<select name='thn2' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[tgl_sphl]",0,4);
												  for ($tahun=2019; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI SPHL :</td>
				<td valign="top" ><? print "<input name='nilai_sphl' type='hidden'  value='$row[nilai_sphl]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_sphl_awal' onkeyup='formatNilai_sphl(this);replaceNilai_sphl(document.form1.nilai_sphl_awal.value);' 
					  style='text-align: right;' value='$nilai_sphl' class='input-field' >"; ?></td>
			</tr>
			
			
			<tr>
				<td  align="right" class="subyek1">NOMOR SP3HL :</td>
				<td valign="top" ><input name="no_sp3hl" type="text" size="40" class="input-field"  value="<? print "$row[no_sp3hl]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL SP3HL :</td>
				<td valign="top" ><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl3' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tgl_sp3hl]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $panjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($panjang_karakter==1)
														$p="0".$i;
													else
														$p=$i;
												  
												  if ($tgl==$p)
													 echo "<option value=$p selected>$p</option>";
												  else
													 echo "<option value=$p>$p</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bln3' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tgl_sp3hl]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $panjang_bulan=strlen($bulan);
													if ($panjang_bulan==1)
														$b="0".$bulan;
													else
														$b=$bulan;
												  
												  
												  if ($bln==$b)
													   echo "<option value=$b selected>$nama_bln[$bulan]</option>";
												  else
													   echo "<option value=$b>$nama_bln[$bulan]</option>";
												  }
												  echo "</select> ";  

												  // Edit ComboBox Tahun
												  echo "<select name='thn3' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[tgl_sp3hl]",0,4);
												  for ($tahun=2019; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI SPHL :</td>
				<td valign="top" ><? print "<input name='nilai_sp3hl' type='hidden'  value='$row[nilai_sp3hl]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_sp3hl_awal' onkeyup='formatNilai_sp3hl(this);replaceNilai_sp3hl(document.form1.nilai_sp3hl_awal.value);' 
					  style='text-align: right;' value='$nilai_sp3hl' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">KETERANGAN :</td>
				<td valign="top" ><input name="ket" type="text" size="40" class="input-field"  value="<? print "$row[ket]"; ?>" /></td>
			</tr>

		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><input type="submit"  value="Simpan" class="button green"></td>
				 <td></td>
				 <td ><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button green"></td>
			</tr></table>
	
    </form></div></div></center><br>


