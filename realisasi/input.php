<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?php 
include "library/indotgl_angka.php";

        $idx=$_SESSION['kdkotama'];
        $idx1=$_SESSION['kdsatker'];
		$idx2=$_GET['thang'];

        $saiki   = date('ymdHis');
 
		$id_realisasi = $saiki."".$idx1;
		

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
<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>PEREKAMAN DATA SPP / SPM / REALISASI</td></tr></table><br>	
 
<?php
		
	     $qryy = mysql_query("select id_pagu, kdwasgiat, kdsa, kdjd, kdjenbel, kdprogram, kdgiat, kdoutput, kdakun, kdsakun,  sum(pagurevisi) as pagurevisi, nmitem from dipa where id_pagu='$_GET[id_pagu]'");
		 $hasil    = mysql_fetch_array($qryy);
		 
		 $revisi	 = number_format($hasil[pagurevisi],0,',','.');
?>	  
 
<center><div id="borderku1" > 
<div class="form-style-2">
<form name="form1"  method="POST"  action="realisasi/proses.php?aksi=simpan">
  <table align="center" width="100%"   cellpadding="3" >
 	 
    <tr> <td valign="middle"  align="right" class="subyek1"></td>
		<td  align="left" colspan="2"> 
		  
			<input name="id_pagu" type="hidden" value="<? echo "$_GET[id_pagu]";  ?>"  readonly class="input-field"/>
	        <input name="id_realisasi" type="hidden"    value="<? echo "$id_realisasi"; ?>" readonly class="input-field">
			<input name="kdkotama" type="hidden" value="<? echo "$idx";  ?>"  readonly class="input-field"/>
			<input name="kdsatker" type="hidden" value="<? echo "$idx1";  ?>"  readonly class="input-field"/>
			
			<input name="xkdbulan" type="hidden" value="<? echo "$_GET[kdbulan]";  ?>"  readonly class="input-field"/>
			
			<input name="kdwasgiat" type="hidden" value="<? echo "$hasil[kdwasgiat]";  ?>" />
			<input name="kdsa" type="hidden" value="<? echo "$hasil[kdsa]";  ?>" />
			<input name="kdjd" type="hidden" value="<? echo "$hasil[kdjd]";  ?>" />
			<input name="kdprogram" type="hidden" value="<? echo "$hasil[kdprogram]";  ?>" />
			<input name="kdgiat" type="hidden" value="<? echo "$hasil[kdgiat]";  ?>" />
			<input name="kdoutput" type="hidden" value="<? echo "$hasil[kdoutput]";  ?>" />
			<input name="kdakun" type="hidden" value="<? echo "$hasil[kdakun]";  ?>" />
			<input name="kdsakun" type="hidden" value="<? echo "$hasil[kdsakun]";  ?>" />
			<input name="kdjenbel" type="hidden" value="<? echo "$hasil[kdjenbel]";  ?>" />
		</td>
	  
  
    </tr>
	
	
	<tr>
      <?	print"<td class='subyek1' valign='middle' align='right'>LAPLAKGAR BULAN : </td>
				 <td  valign='middle'> <select name='kdbulan'  class='select-field' required='required'>
						<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan  order by kdbulan ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[kdbulan] | $data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[kdbulan] | $data[nmbulan]</option>";
				    }  
				print "</select></td>"; ?> 
   
	   <td valign="middle"  align="right" class="subyek1">TAHUN : </td>
      <td  align="left"><input name="thang" type="text" size= "7"   value="<? echo "$idx2";?>"  readonly class="input-field"/></td>
	
     
    </tr>
	

	<tr>
      <td valign="middle"  align="right" class="subyek1">URAIAN KEGIATAN : </td>
      <td  align="left"> <input name="uraian" type="text"  class="input-field" size="40" 
	  value="<?php print "$hasil[nmitem]";  ?>"    autocomplete="off"/></td>
   
      <td valign="middle"  align="right" class="subyek1">PAGU SETELAH REVISI : </td>
      <td  align="left"> <input name="pagurevisi" type="text"  class="input-field"  style='text-align: right;'
	  value="<? print "$revisi";  ?>"  readonly	  autocomplete="off"/></td>
    </tr>
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPP : </td>
      <td  align="left"> <input name="nospp" type="text"  class="input-field"  autocomplete="off"/></td>
   
	   <td valign="middle"  align="right" class="subyek1">NOMOR SP2D : </td>
      <td  align="left"> <input name="nosp2d" type="text"  class="input-field"  autocomplete="off"/></td>
	
     
    </tr>
	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">TANGGAL SPP : </td>
      <td  align="left"><?
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
									  for ($thn=2020;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
									
      <td valign="middle"  align="right" class="subyek1">TANGGAL SP2D : </td>
      <td  align="left"><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tg' class='select-field'>
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
										  
								echo "<select name='bl' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='th' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2020;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
									
    </tr>
	
	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">NILAI SPP : </td>
	  <td><? print "<input name='nilai_spp' type='hidden'  value='$_POST[nilai_spp]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spp_awal' onkeyup='formatNilai_spp(this);replaceNilai_spp(document.form1.nilai_spp_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_spp_awal]' class='input-field'  autocomplete='off'>"; ?></td>
	  
	  <td valign="middle"  align="right" class="subyek1">REALISASI : </td>
      <td  align="left"><? print "<input name='realisasi' type='hidden' size='15' class='input-field'  value='$_POST[realisasi]'  style='text-align: right;' />
				      <input type='text' name='realisasi_awal' onkeyup='formatRealisasi(this);replaceRealisasi(document.form1.realisasi_awal.value);' 
					  style='text-align: right;' value='$_POST[realisasi_awal]' class='input-field' required='required'  autocomplete='off'>"; ?></td>
    </tr>	
	
	<tr>
      <td colspan="4" height="20"></td>
    </tr>
	
	
	<tr>
      <td valign="middle"  align="right" class="subyek1">NOMOR SPM : </td>
      <td  align="left"> <input name="nospm" type="text"  class="input-field"  autocomplete="off"/></td>
   
	  <td></td> <td></td>
  
    </tr>
	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">TANGGAL SPM : </td>
      <td  align="left"><?
			$nama_bln=array(1=>"Januari", "Pebruari", "Maret", "April", "Mei", 
							   "Juni", "Juli", "Agustus", "September", 
			 				   "Oktober", "Nopember", "Desember");

								echo "<select name='tglspm' class='select-field'>
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
										  
								echo "<select name='blnspm' class='select-field'>
									  <option value=0 selected>Bulan</option>";
									  for ($bln=1; $bln<=12; $bln++){
									  echo "<option value=$bln>$nama_bln[$bln]</option>";
									  }   
									  echo "</select> ";
									  

								echo "<select name='thnspm' class='select-field'>
									  <option value=0 selected>Tahun</option>";
									  for ($thn=2020;$thn<=2026;$thn++){
									  echo "<option value=$thn>$thn</option>";
									  }
									  echo "</select>";
												  
									?></td>
									
		 <td></td> <td></td>
  
    </tr>	

	
	<tr>
     
      <td valign="middle"  align="right" class="subyek1">NILAI SPM : </td>
	  <td><? print "<input name='nilai_spm' type='hidden'  value='$_POST[nilai_spm]' class='input-field' style='text-align: right;' />
				      <input type='text' name='nilai_spm_awal' onkeyup='formatNilai_spm(this);replaceNilai_spm(document.form1.nilai_spm_awal.value);' 
					  style='text-align: right;' value='$_POST[nilai_spm_awal]' class='input-field'  autocomplete='off'>"; ?></td>
	  
	  <td></td> <td></td>
    </tr>	
		
	
	
	  

  </table>
  <br>
  
   			
<table align="center" >
	<tr>
		<td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		    <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  
			<? print "<a href='media.php?module=realisasi&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' style='text-decoration:none'><input type='button' value='Keluar'  ></a>"; ?></div>
			
		</td>
	</tr>
</table>	  
</form></div></div><br><br>

<?
	
// header
	print "<table width='97%'   align='center' class='bordered'>";
	print "<tr  >";
	print    "<th   align='center' height='30' width='10' >NO</th>";
    print    "<th   align='center' >M A</th>";	
	print    "<th   align='center' >BULAN</th>";
	print    "<th   align='center' >THANG</th>";
	print    "<th   align='center' >NO SPP</th>";
	print    "<th   align='center' >TGL SPP</th>";
	print    "<th   align='center' >NILAI SPP</th>";
	print    "<th   align='center' >NO SPM</th>";
	print    "<th   align='center' >TGL SPM</th>";
	print    "<th   align='center' >NILAI SPM</th>";	
	print    "<th   align='center' >NO SP2D</th>";
	print    "<th   align='center' >TGL SP2D</th>";	
		
	print    "<th   align='center' >URAIAN KEGIATAN</th>";
//	print    "<th   align='center' >NILAI SP2D</th>";
	print    "<th   align='center' >REALISASI</th>";
	print    "<th   align='center' colspan='2' >AKSI</th>";
  	print "</tr>";
	
	$sql="SELECT a.*, b.nmbulan from realisasi a left join t_bulan b on a.kdbulan=b.kdbulan  where a.id_pagu='$_GET[id_pagu]' order by a.kdbulan, a.tglsp2d";
    $qry=mysql_query($sql);

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	$tglspp=tgl_indoangka($row[tglspp]);
	$tglsp2d=tgl_indoangka($row[tglsp2d]);
	$realisasi = number_format($row[realisasi],0,',','.');
	$spp = number_format($row[nilai_spp],0,',','.');
	$tglspm=tgl_indoangka($row[tglspm]);
	$spm = number_format($row[nilai_spm],0,',','.');

	print"<tr><td  align='center' valign='top'>$no</td>
	          <td  valign='top'><b>$row[kdgiat].$row[kdoutput].$row[kdakun].$row[kdsakun]</b></td>  
	          <td  valign='top'>$row[nmbulan]</td>
			  <td  valign='top'>$row[thang]</td>
			  <td  valign='top'>$row[nospp]</td>
			  <td  valign='top'>$tglspp</td>
			  <td  valign='top' align='right'>$spp</td>
			  <td  valign='top'>$row[nospm]</td>
			  <td  valign='top'>$tglspm</td>
			  <td  valign='top' align='right'>$spm</td>
			  <td  valign='top'>$row[nosp2d]</td>
			  <td  valign='top'>$tglsp2d</td>
			  <td  valign='top'>$row[uraian]</td>
			  <td  align='right' valign='top'>$realisasi</td>
			  <td  align='center' valign='top'><a href='media.php?module=editrealisasi&id_realisasi=$row[id_realisasi]&id_pagu=$row[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' data-tooltip='Edit Realisasi' data-position='top' class='top'><img src='images/edit.png' width='20' ></a></td>
			  <td  align='center' valign='top'><a href=\"realisasi/proses.php?aksi=hapus&id_realisasi=$row[id_realisasi]&id_pagu=$row[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $row[uraian] ~? ')\" data-tooltip='Hapus Realisasi' data-position='top' class='top'><img src='images/delete.png' width='20' ></td>			  
		  </tr>";	
		  $no++;
     }
	 
	 $jml = mysql_query("SELECT sum(realisasi) as jumlah from realisasi	 where  id_pagu ='$_GET[id_pagu]' ");						   
     $data1    = mysql_fetch_array($jml);
	 
	 $jumlah = number_format($data1[jumlah],0,',','.');
	  
		print"<tr><td  align='center'></td>
			  <td   colspan='12'>&nbsp;&nbsp;&nbsp;&nbsp;<span>J U M L A H</span></td>
			  <td   align='right'><span>$jumlah</span></td>
			  <td   ></td>
			  <td   ></td>		
			 		  
		  </tr>";	
		  
	print"</table><br>";
