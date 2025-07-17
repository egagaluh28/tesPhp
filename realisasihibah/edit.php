
<? 

	     $qry = mysql_query("select * from realisasi_hibah where id_realisasi='$_GET[id_realisasi]' and id_pagu='$_GET[id_pagu]' ");
		 $row    = mysql_fetch_array($qry);
		 
	  	  if ($row[nilai_spp]!='0') { $nilai_spp=number_format($row[nilai_spp],0,',','.'); }  else {  $nilai_spp=''; }
		  if ($row[realisasi]!='0') { $realisasi=number_format($row[realisasi],0,',','.'); }  else {  $realisasi=''; }
		  if ($row[nilai_spm]!='0') { $nilai_spm=number_format($row[nilai_spm],0,',','.'); }  else {  $nilai_spm=''; }
?>		

<script>

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}


function replaceNilai_spp(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_spp.value = temp;
}

function formatNilai_spp(objek) {
nilai_spp_awal = objek.value;
b = nilai_spp_awal.replace(/[^\d]/g,"");
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




function replaceRealisasi(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.realisasi.value = temp;
}

function formatRealisasi(objek) {
realisasi_awal = objek.value;
b = realisasi_awal.replace(/[^\d]/g,"");
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


function replaceNilai_spm(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.nilai_spm.value = temp;
}

function formatNilai_spm(objek) {
nilai_spm_awal = objek.value;
b = nilai_spm_awal.replace(/[^\d]/g,"");
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
<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>EDIT DATA REALISASI</td></tr></table><br>	
 
<center><div id="borderku1" > 
        <div class="form-style-2">
<form name="form1"  method="POST"  action="realisasihibah/proses.php?aksi=ubah">
  <table align="center" width="100%"   cellpadding="3" >
 	 
    <tr> <td valign="middle"  align="right" class="subyek1"></td>
		<td  align="left" colspan="2"> 
		  
			<input name="id_pagu" type="hidden" value="<? echo "$row[id_pagu]";  ?>"  readonly class="rounded"/>
	        <input name="id_realisasi" type="hidden"    value="<? echo "$row[id_realisasi]"; ?>" readonly class="rounded">
			<input name="kdkotama" type="hidden" value="<? echo "$row[kdkotama]";  ?>"  readonly class="rounded"/>
			<input name="kdsatker" type="hidden" value="<? echo "$row[kdsatker]";  ?>"  readonly class="rounded"/>
			
			<input name="xkdbulan" type="hidden" value="<? echo "$_GET[kdbulan]";  ?>"  readonly class="rounded"/>
		</td>
	  
  
    </tr>
	
	
	<tr>
      <?	print"<td class='subyek1' valign='middle' align='right'>LAPLAKGAR BULAN : </td>
				 <td   valign='middle'>  <select name='kdbulan'  class='select-field' required='required'>
						<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan  order by kdbulan ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$row[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[kdbulan] | $data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[kdbulan] | $data[nmbulan]</option>";
				    }  
				print "</select></td>"; ?> 
   
	   <td valign="middle"  align="right" class="subyek1">TAHUN : </td>
      <td  align="left"><input name="thang" size= "7" type="text"   value="<? echo "$row[thang]";?>"  readonly class="input-field"/></td>
	
     
    </tr>
	
	<?
	     $qryy = mysql_query("select id_pagu,  pagurevisi, nmitem from hibah where id_pagu='$_GET[id_pagu]'");
		 $data    = mysql_fetch_array($qryy);
		 
		 $revisi	 = number_format($data[pagurevisi],0,',','.');
	?>	 
	
	<tr>
     <td valign="middle"  align="right" class="subyek1">URAIAN KEGIATAN : </td>
      <td  align="left"> <input name="uraian" type="text"  class="input-field" size="40" 
	  value="<? print "$row[uraian]";  ?>"    autocomplete="off"/></td>
   
	 <td valign="middle"  align="right" class="subyek1">PAGU SETELAH REVISI : </td>
      <td  align="left"> <input name="pagurevisi" type="text"  class="input-field"  style='text-align: right;'
	  value="<? print "$revisi";  ?>"  readonly	  autocomplete="off"/></td>
	
     
    </tr>
	
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPP : </td>
      <td  align="left"> <input name="nospp" type="text" size="12" class="input-field" required="required" autocomplete="off" value="<? echo "$row[nospp]";?>" /></td>
   
	   <td valign="middle"  align="right" class="subyek1">NOMOR SP2D : </td>
      <td  align="left"> <input name="nosp2d" type="text"  class="input-field" required="required" size="12" autocomplete="off" value="<? echo "$row[nosp2d]";?>" /></td>
	
     
    </tr>
	
	
	
	
	<tr>
     
     <td valign="middle"  align="right" class="subyek1">TANGGAL SPP : </td>
      <td  align="left"> <?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglspp]",8,2);
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
												  $bln=substr("$row[tglspp]",5,2);
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
												  $thn      = substr("$row[tglspp]",0,4);
												  for ($tahun=2022; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?> </td>
									
      <td valign="middle"  align="right" class="subyek1">TANGGAL SP2D : </td>
      <td  align="left"><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tg' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglsp2d]",8,2);
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
												  echo "<select name='bl' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tglsp2d]",5,2);
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
												  echo "<select name='th' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[tglsp2d]",0,4);
												  for ($tahun=2022; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?> </td>
    </tr>
	
	
	
	<tr>
   
   
      <td valign="middle"  align="right" class="subyek1">NILAI SPP :</td>
      <td  align="left"><? print "<input name='nilai_spp' type='hidden'  value='$row[nilai_spp]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spp_awal' onkeyup='formatNilai_spp(this);replaceNilai_spp(document.form1.nilai_spp_awal.value);' 
					  style='text-align: right;' value='$nilai_spp' class='input-field' >"; ?></td>
					  
	  <td valign="middle"  align="right" class="subyek1">REALISASI : </td>
      <td  align="left"><? print "<input name='realisasi' type='hidden'  size='15' value='$row[realisasi]' class='input-field' style='text-align: right;' />
				      <input type='text' name='realisasi_awal' onkeyup='formatRealisasi(this);replaceRealisasi(document.form1.realisasi_awal.value);' 
					  style='text-align: right;' value='$realisasi' class='input-field' required='required'>"; ?></td>				  
    </tr>
	
	  </tr>
	
		<tr>
      <td colspan="4" height="20"></td>
    </tr>
	
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPM : </td>
      <td  align="left"> <input name="nospm" type="text"  class="input-field" required="required"  value="<? echo "$row[nospm]";?>" autocomplete="off"/></td>
   
	  <td></td> <td></td>
  
    </tr>
	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">TANGGAL SPM : </td>
      <td  align="left"><?
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tglspm' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglspm]",8,2);
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
												  echo "<select name='blnspm' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tglspm]",5,2);
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
												  echo "<select name='thnspm' class='select-field'>
												  <option value='' selected>Tahun</option>";     
												  $thn      = substr("$row[tglspm]",0,4);
												  for ($tahun=2022; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?> </td>
									
		 <td></td> <td></td>
	
		 </tr>	

	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">NILAI SPM : </td>
	  <td><? print "<input name='nilai_spm' type='hidden'  value='$row[nilai_spm]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spm_awal' onkeyup='formatNilai_spm(this);replaceNilai_spm(document.form1.nilai_spm_awal.value);' 
					  style='text-align: right;' value='$nilai_spm' class='input-field'  autocomplete='off'>"; ?></td>
	  
	  <td></td> <td></td>
    </tr>	

	
  </table>
  <br>
  
   			
<table align="center" >
	<tr>
		<td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		    <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>
			
		</td>
	</tr>
</table>	  
</form></div></div><br><br>
