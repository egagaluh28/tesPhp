<script language="javascript" src="library/jquery-1.2.6.js"></script>


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
<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>EDIT LIST DATA REALISASI</td></tr></table><br>	

<?php 


$edit = mysql_query("SELECT  a.*,  f.nmprogram, g.nmgiat, h.nmoutput,
		i.nmakun, j.nmsakun, k.nmkotama, l.nmsatkr from realisasi a 
		left join t_program f on a.kdprogram=f.kdprogram
		left join t_giat g on a.kdprogram=g.kdprogram and a.kdgiat=g.kdgiat
		left join t_output h on a.kdprogram=h.kdprogram and
			a.kdgiat=h.kdgiat and a.kdoutput=h.kdoutput
		left join t_akun i on a.kdakun=i.kdakun
		left join t_sakun j on a.kdgiat=j.kdgiat and a.kdoutput=j.kdoutput and a.kdakun=j.kdakun and a.kdsakun=j.kdsakun 
		left join t_kotam k on a.kdkotama=k.kdkotama
		left join t_satkr l on a.kdkotama=l.kdkotama and a.kdsatker=l.kdsatkr
		WHERE a.id_realisasi='$_GET[id_realisasi]' and a.id_pagu='$_GET[id_pagu]'");
    $row    = mysql_fetch_array($edit); 

	  //   $qry = mysql_query("select * from realisasi where id_realisasi='$_GET[id_realisasi]'");
		// $row    = mysql_fetch_array($qry);
		 
		  if ($row[nilai_spp]!='0') { $nilai_spp=number_format($row[nilai_spp],0,',','.'); }  else {  $nilai_spp=''; }
		  if ($row[nilai_spm]!='0') { $nilai_spm=number_format($row[nilai_spm],0,',','.'); }  else {  $nilai_spm=''; }
		  if ($row[realisasi]!='0') { $realisasi=number_format($row[realisasi],0,',','.'); }  else {  $realisasi=''; }
?>		
 
<center><div id="borderku1" > 
         <div class="form-style-2">
<form name="form1"  method="POST"  action="realisasi/proses.php?aksi=ubahlist">

			<input name="id_pagu" type="hidden" value="<?php echo "$row[id_pagu]";  ?>"  readonly class="input-field"/>
	        <input name="id_realisasi" type="hidden"    value="<?php echo "$row[id_realisasi]"; ?>" readonly class="input-field">
			<input name="kdkotama" type="hidden" value="<?php echo "$row[kdkotama]";  ?>"  readonly class="input-field"/>
			<input name="kdsatker" type="hidden" value="<?php echo "$row[kdsatker]";  ?>"  readonly class="input-field"/>
	<table align="center" width="100%"   cellpadding="3" > 	
	
	
			<tr>
			<?php	print "<td class='subyek1' valign='middle' align='right'>SUMBER ANGGARAN :</td>
				 <td  valign='middle'><select name='kdsa'  class='select-field' required='required'>
						<option value='' selected>- Pilih -</option>";
						 $sql="select kdsa, nmsa from t_sa ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsa]==$row[kdsa])
							echo "<option value=$data[kdsa] selected>$data[kdsa] | $data[nmsa]</option>";
						 else
							echo "<option value=$data[kdsa]>$data[kdsa] | $data[nmsa]</option>";
				    }  
				print "</select></td>"; ?> 
			
			</tr>
	
	
			<tr>
			 <?php	print"<td class='subyek1' valign='middle' align='right'>JENIS DANA : </td>
				 <td  valign='middle'><select name='kdjd'  class='select-field' required='required'>
						<option value='' selected>- - Pilih - -</option>";
						 $sql="select kdjd, nmjd from t_jd  order by kdjd ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdjd]==$row[kdjd])
							echo "<option value=$data[kdjd] selected>$data[kdjd] | $data[nmjd]</option>";
						 else
							echo "<option value=$data[kdjd]>$data[kdjd] | $data[nmjd]</option>";
				    }  
				print "</select></td>"; ?> 
			</tr>
	
			
			<tr>
            <?php	print"<td class='subyek1' align='right'>WASGIAT :</td> 
				 <td  valign='middle' colspan='3'><select name='kdwasgiat'  class='select-field' required='required'>
						<option value='' selected>- - - - Pilih - - - -</option>";
						 $sql="select kdwasgiat, nmwasgiat from t_wasgiat  order by kdwasgiat ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$row[kdwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[kdwasgiat] | $data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[kdwasgiat] | $data[nmwasgiat]</option>";
				    }  
				print "</select></td><td></td>"; ?>
		 </tr>		 
			
		<div id="suggest">
			
	 
		    <tr><td class="subyek1" align="right">PROGRAM :</td>
		
	        
	        <td  colspan='3'><input type="text"  name="kdprogram" onBlur="fillkdprogram();" id="kdprogram"  class="input-field" size="7" 
			readonly style="text-align: right;" <?php print "value='$row[kdprogram]'"; ?> />
	        <input type="text"  name="nmprogram" onBlur="fillnmprogram();" id="nmprogram"  class="input-field"  size="70" 
			readonly <?php print "value='$row[nmprogram]'"; ?> /></td></tr>
							
					
		    <tr><td class="subyek1" align="right">GIAT :</td>
		
	        
	        <td  colspan='3'><input type="text"  name="kdgiat" onBlur="fillkdgiat();" id="kdgiat"  class="input-field" size="7" 
			readonly style="text-align: right;" <?php print "value='$row[kdgiat]'"; ?> />
	        <input type="text"  name="nmgiat" onBlur="fillnmgiat();" id="nmgiat"  class="input-field"  size="70" readonly 
			<?php print "value='$row[nmgiat]'"; ?> /></td></tr>
		
			<tr><td class="subyek1" align="right">OUTPUT :</td> 
			
	       <td  colspan='3'><input type="text"  name="kdoutput" onBlur="fillkdoutput();" id="kdoutput"  class="input-field" size="7" readonly 
			style="text-align: right;"  <?php print "value='$row[kdoutput]'"; ?>  />
	        <input type="text"  name="nmoutput" onBlur="fillnmoutput();" id="nmoutput"  class="input-field" size="70" readonly 
			<?php print "value='$row[nmoutput]'"; ?>  /></td></tr>
	
	
			<tr><td class="subyek1" align="right">AKUN :  
			<input type="hidden"  name="id_pagu" class="input-field" <?php print "value='$row[id_pagu]'"; ?> readonly /></td>
	        <td  colspan='3'><input type="text"  name="kdakun" onBlur="fillkdakun();" id="kdakun"  class="input-field" size="7" 
			readonly style="text-align: right;" <?php print "value='$row[kdakun]'"; ?> />
			<input type="text"  name="nmakun" onBlur="fillnmakun();" id="nmakun"  class="input-field" size="70" readonly 
			<?php print "value='$row[nmakun]'"; ?> /> </td></tr>
		  
               
			<tr><td class="subyek1" align="right">SUB AKUN :</td> 
			
	        <td  colspan='3'><input type="text"  name="kdsakun" onBlur="fillkdsakun();" id="kdsakun"  class="input-field" size="7"
			readonly style="text-align: right;"  <?php print "value='$row[kdsakun]'"; ?> />
			<input type="text" onKeyUp="suggest(this.value);" name="nmsakun"  onBlur="fillnmsakun();" id="nmsakun" class="input-field" 
			 autocomplete="off" size="70" required="required" <?php print "value='$row[nmsakun]'"; ?> /></td></tr>
			
			<tr><td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="dipa/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			</div>
	        </td></tr>				  
		</div>
		
		<tr><td colspan='4'height='25'></td></tr>
   
   
	
	
	<tr>
      <?php	print"<td class='subyek1' valign='middle' align='right'>LAPLAKGAR BULAN : </td>
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
      <td  align="left"><input name="thang" size= "7" type="text"   value="<?php echo "$row[thang]";?>"  readonly class="input-field"/></td>
	
     
    </tr>
	
	<?php
	     $qryy = mysql_query("select id_pagu,  sum(pagu+revisi) as pagurevisi, nmitem from dipa where id_pagu='$_GET[id_pagu]'");
		 $data    = mysql_fetch_array($qryy);
		 
		 $revisi	 = number_format($data[pagurevisi],0,',','.');
	?>	 
	
	<tr>
     <td valign="middle"  align="right" class="subyek1">URAIAN KEGIATAN : </td>
      <td  align="left"> <input name="uraian" type="text"  class="input-field" size="40" 
	  value="<?php print "$row[uraian]";  ?>"    autocomplete="off"/></td>
   
	 <td valign="middle"  align="right" class="subyek1">PAGU SETELAH REVISI : </td>
      <td  align="left"> <input name="pagurevisi" type="text"  class="input-field"  style='text-align: right;'
	  value="<?php print "$revisi";  ?>"  readonly	  autocomplete="off"/></td>
	
     
    </tr>
	
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPP : </td>
      <td  align="left"> <input name="nospp" type="text" size="12" class="input-field" required="required" autocomplete="off" value="<?php echo "$row[nospp]";?>" /></td>
   
	   <td valign="middle"  align="right" class="subyek1">NOMOR SP2D : </td>
      <td  align="left"> <input name="nosp2d" type="text"  class="input-field" required="required" size="12" autocomplete="off" value="<?php echo "$row[nosp2d]";?>" /></td>
	
     
    </tr>
	
	
	
	
	<tr>
     
     <td valign="middle"  align="right" class="subyek1">TANGGAL SPP : </td>
      <td  align="left"> <?php
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tgl' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglspp]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $rowanjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($rowanjang_karakter==1)
														$row="0".$i;
													else
														$row=$i;
												  
												  if ($tgl==$row)
													 echo "<option value=$row selected>$row</option>";
												  else
													 echo "<option value=$row>$row</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bln' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tglspp]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $rowanjang_bulan=strlen($bulan);
													if ($rowanjang_bulan==1)
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
												  for ($tahun=2020; $tahun<=2026; $tahun++){
												  if ($thn==$tahun)
													   echo "<option value=$tahun selected>$tahun</option>";
												  else
													   echo "<option value=$tahun>$tahun</option>";
												  }
												  echo "</select>"; 
											?> </td>
									
      <td valign="middle"  align="right" class="subyek1">TANGGAL SP2D : </td>
      <td  align="left"><?php
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tg' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglsp2d]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $rowanjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($rowanjang_karakter==1)
														$row="0".$i;
													else
														$row=$i;
												  
												  if ($tgl==$row)
													 echo "<option value=$row selected>$row</option>";
												  else
													 echo "<option value=$row>$row</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='bl' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tglsp2d]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $rowanjang_bulan=strlen($bulan);
													if ($rowanjang_bulan==1)
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
												  for ($tahun=2020; $tahun<=2026; $tahun++){
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
      <td  align="left"><?php print "<input name='nilai_spp' type='text'  value='$row[nilai_spp]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spp_awal' onkeyup='formatNilai_spp(this);replaceNilai_spp(document.form1.nilai_spp_awal.value);' 
					  style='text-align: right;' value='$nilai_spp' class='input-field' >"; ?></td>
					  
	  <td valign="middle"  align="right" class="subyek1">REALISASI : </td>
      <td  align="left"><?php print "<input name='realisasi' type='text'  size='15' value='$row[realisasi]' class='input-field' style='text-align: right;' />
				      <input type='text' name='realisasi_awal' onkeyup='formatRealisasi(this);replaceRealisasi(document.form1.realisasi_awal.value);' 
					  style='text-align: right;' value='$realisasi' class='input-field' required='required'>"; ?></td>				  
    </tr>
	
		<tr>
      <td colspan="4" height="20"></td>
    </tr>
	
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPM : </td>
      <td  align="left"> <input name="nospm" type="text"  class="input-field"  value="<?php echo "$row[nospm]";?>" autocomplete="off"/></td>
   
	  <td></td> <td></td>
  
    </tr>
	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">TANGGAL SPM : </td>
      <td  align="left"><?php
												$nama_bln=array(1=> "Januari", "Pebruari", "Maret", "April", "Mei", 
																	   "Juni", "Juli", "Agustus", "September", 
																	   "Oktober", "Nopember", "Desember");

												  // Edit ComboBox Tanggal
												  echo "<select name='tglspm' class='select-field'>
												  <option value='' selected>Tgl</option>";
												  $tgl=substr("$row[tglspm]",8,2);
												  for ($i=1; $i<=31; $i++){
												  
												  $rowanjang_karakter=strlen($i);
													// Apabila panjang karakter 1 digit, maka tambahkan 0 di depannya
													if ($rowanjang_karakter==1)
														$row="0".$i;
													else
														$row=$i;
												  
												  if ($tgl==$row)
													 echo "<option value=$row selected>$row</option>";
												  else
													 echo "<option value=$row>$row</option>";
												  }
											echo "</select> ";

												  // Edit ComboBox Bulan      
												  echo "<select name='blnspm' class='select-field' >
												  <option value='' selected>Bulan</option>";
												  $bln=substr("$row[tglspm]",5,2);
												  for ($bulan=1; $bulan<=12; $bulan++){
												  
												  $rowanjang_bulan=strlen($bulan);
													if ($rowanjang_bulan==1)
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
												  for ($tahun=2020; $tahun<=2026; $tahun++){
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
	  <td><?php print "<input name='nilai_spm' type='text'  value='$row[nilai_spm]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spm_awal' onkeyup='formatNilai_spm(this);replaceNilai_spm(document.form1.nilai_spm_awal.value);' 
					  style='text-align: right;' value='$nilai_spm' class='input-field'  autocomplete='off'>"; ?></td>
	  
	  <td></td> <td></td>
    </tr>	
	

	
  </table>
  <br>
  
   			
<table align="center" >
	<tr>
		<td><input  type="submit" value="Simpan" class="button green"/>&nbsp;&nbsp;&nbsp;&nbsp; 
		    <input type="reset" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" class="button green">
			
		</td>
	</tr>
</table>	  
</form></div></div><br><br>

			
<script>
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#kodespa').addClass('load');
		$.post("realisasi/proses_cari_autosuggest.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#kodespa').removeClass('load');
			}
		});
	}
}

function fillkdsakun(thisValue) {
	$('#kdsakun').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}


function fillnmsakun(thisValue) {
	$('#nmsakun').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillkdgiat(thisValue) {
	$('#kdgiat').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillnmgiat(thisValue) {
	$('#nmgiat').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillkdoutput(thisValue) {
	$('#kdoutput').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillnmoutput(thisValue) {
	$('#nmoutput').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillkdakun(thisValue) {
	$('#kdakun').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillnmakun(thisValue) {
	$('#nmakun').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillkdprogram(thisValue) {
	$('#kdprogram').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillnmprogram(thisValue) {
	$('#nmprogram').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}


</script>