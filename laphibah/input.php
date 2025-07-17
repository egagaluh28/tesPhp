
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
 $edit = mysql_query("SELECT a.kdkotama,  a.kdsatkr, a.nmsatkr, a.kdkusatker, b.nmkotama, c.nmkusatker from t_satkr a 
  left join t_kotam b on a.kdkotama=b.kdkotama 
  left join t_kusatker c on a.kdkusatker=c.kdkusatker
  where a.kdkotama='$_GET[kdkotama]' and a.kdsatkr='$_GET[kdsatker]'");
  $row    = mysql_fetch_array($edit);
?>  
<center><span class="judul">INPUT DATA</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<form action="laphibah/proses.php?aksi=simpan" method="POST"  name="form1">  

    <table width="80%" align="center" cellpadding="2">

			<tr>
				<td  align="right" class="subyek1">PENERIMA HIBAH :</td>
			    <td valign="top" >
					<input type="hidden" name="thang"  class="input-field"  value=<? print "$_GET[thang]"; ?>  />	
					<input type="hidden" name="kdsatker"  class="input-field"  value=<? print "$row[kdsatkr]"; ?>  />
					<input type="hidden" name="kdkotama"  class="input-field"  value=<? print "$row[kdkotama]"; ?> />
				 <input type="text"  name="x"  size="40" class="input-field" readonly value=<? print "$row[nmsatkr]"; ?> /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">PEMBERI HIBAH :</td>
				<td valign="top" ><input name="pemberi_hibah" type="text" size="40" class="input-field" required="required" /></td>
		    </tr>
			
			
			
			<tr>
				<td  align="right" class="subyek1">NOMOR NPH :</td>
				<td valign="top" ><input name="no_nph" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL NPH :</td>
				<td valign="top" ><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tgl' class='select-field'>
									  <option value=0 selected>Tgl</option>";
									  for ($tgl=1; $tgl<=31; $tgl++){
										 // Hitung panjang karakter     
									  $panjang_karakter=strlen($tgl);
										// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
									  if ($panjang_karakter==1)
											$i="0".$tgl;
									  else
											$i=$tgl;
											 
									  echo "<option value=$i>$i</option>";
									  }
									  echo "</select> ";  
										  
								echo "<select name='bln' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='thn' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2019;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">URAIAN KEGIATAN :</td>
				<td valign="top" ><input name="uraian" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI HIBAH :</td>
				<td valign="top" ><? print "<input name='nilai_hibah' type='hidden'  value='$_POST[nilai_hibah]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_hibah_awal' onkeyup='formatNilai_hibah(this);replaceNilai_hibah(document.form1.nilai_hibah_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_hibah_awal]' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REGISTER :</td>
				<td valign="top" ><input name="no_reg" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">BATAS AKHIR PENARIKAN DANA :</td>
				<td valign="top" ><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tgl1' class='select-field'>
									  <option value=0 selected>Tgl</option>";
									  for ($tgl=1; $tgl<=31; $tgl++){
										 // Hitung panjang karakter     
									  $panjang_karakter=strlen($tgl);
										// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
									  if ($panjang_karakter==1)
											$i="0".$tgl;
									  else
											$i=$tgl;
											 
									  echo "<option value=$i>$i</option>";
									  }
									  echo "</select> ";  
										  
								echo "<select name='bln1' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='thn1' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2019;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REKENING :</td>
				<td valign="top" ><input name="no_rek" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR REVISI DIPA (DS) :</td>
				<td valign="top" ><input name="no_rev_dipa" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI REVISI :</td>
				<td valign="top" ><? print "<input name='nilai_revisi' type='hidden'  value='$_POST[nilai_revisi]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_revisi_awal' onkeyup='formatNilai_revisi(this);replaceNilai_revisi(document.form1.nilai_revisi_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_revisi_awal]' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR SPHL :</td>
				<td valign="top" ><input name="no_sphl" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL SPHL :</td>
				<td valign="top" ><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tgl2' class='select-field'>
									  <option value=0 selected>Tgl</option>";
									  for ($tgl=1; $tgl<=31; $tgl++){
										 // Hitung panjang karakter     
									  $panjang_karakter=strlen($tgl);
										// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
									  if ($panjang_karakter==1)
											$i="0".$tgl;
									  else
											$i=$tgl;
											 
									  echo "<option value=$i>$i</option>";
									  }
									  echo "</select> ";  
										  
								echo "<select name='bln2' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='thn2' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2019;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI SPHL :</td>
				<td valign="top" ><? print "<input name='nilai_sphl' type='hidden'  value='$_POST[nilai_sphl]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_sphl_awal' onkeyup='formatNilai_sphl(this);replaceNilai_sphl(document.form1.nilai_sphl_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_sphl_awal]' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NOMOR SP3HL :</td>
				<td valign="top" ><input name="no_sp3hl" type="text" size="40" class="input-field"  /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL SP3HL :</td>
				<td valign="top" ><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tgl3' class='select-field'>
									  <option value=0 selected>Tgl</option>";
									  for ($tgl=1; $tgl<=31; $tgl++){
										 // Hitung panjang karakter     
									  $panjang_karakter=strlen($tgl);
										// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
									  if ($panjang_karakter==1)
											$i="0".$tgl;
									  else
											$i=$tgl;
											 
									  echo "<option value=$i>$i</option>";
									  }
									  echo "</select> ";  
										  
								echo "<select name='bln3' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='thn3' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2019;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">NILAI SP3HL :</td>
				<td valign="top" ><? print "<input name='nilai_sp3hl' type='hidden'  value='$_POST[nilai_sp3hl]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_sp3hl_awal' onkeyup='formatNilai_sp3hl(this);replaceNilai_sp3hl(document.form1.nilai_sp3hl_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_sp3hl_awal]' class='input-field' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">	KETERANGAN :</td>
				<td valign="top" ><input name="ket" type="text" size="40" class="input-field"  /></td>
			</tr>
	
		</table><br> 
	
	<table  width="300" align="center"   >
			<tr>
				 <td><input type="submit"  value="Simpan" class="button green"></td>
				 <td></td>
				 <td ><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button green"></td>
			</tr></table>
	
    </form></div></div></center><br>


