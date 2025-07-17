

<html>
<head>


<script language="javascript" src="library/jquery-1.2.6.js"></script>
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />


<?  
include "library/indotgl_angka.php";

print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>INPUT PENGEMBALIAN</td></tr></table><br>";


    $edit = mysql_query("SELECT  a.*,  f.nmprogram, g.nmgiat, h.nmoutput,
						 i.nmakun, j.nmsakun, k.nmkotama, l.nmsatkr,  nmkusatker from dipa a 
						 left join t_program f on  a.kdprogram=f.kdprogram
						 left join t_giat g on  a.kdprogram=g.kdprogram and
						 a.kdgiat=g.kdgiat
						 left join t_output h on  a.kdprogram=h.kdprogram and
						 a.kdgiat=h.kdgiat and a.kdoutput=h.kdoutput
						 left join t_akun i on a.kdakun=i.kdakun
						 left join t_sakun j on a.kdprogram=j.kdprogram and a.kdgiat=j.kdgiat and a.kdoutput=j.kdoutput and a.kdakun=j.kdakun and a.kdsakun=j.kdsakun 
						 left join t_kotam k on a.kdkotama=k.kdkotama
						 left join t_satkr l on a.kdkotama=l.kdkotama and a.kdsatker=l.kdsatkr
						 left join t_kusatker m on a.kdkusatker=m.kdkusatker
						 WHERE a.id_pagu='$_GET[id_pagu]'");
    $p    = mysql_fetch_array($edit); 
	
	$nmkotama = strtoupper($p[nmkotama]);
	
	
	
	 
	 $revisi=number_format($p[revisi],0,',','.');
	 $pagu=number_format($p[pagu],0,',','.');
	 $pagurevisi=number_format($p[pagurevisi],0,',','.');
	 
	  if ($p[jml_pengembalian]!='0')    { $jml_pengembalian=number_format($p[jml_pengembalian],0,',','.'); }  else {  $jml_pengembalian=''; }
	  
		$saiki   = date('ymdHis');
		$idx1=$_SESSION['kdsatker'];
 
		$id_pengembalian = $saiki."".$idx1;
		
		
	
?>
   <center><div id="borderku1" >
   <div class="form-style-2">
   <form  name="form1" method="POST"  action="pengembalian/proses.php?aksi=simpan" >
            <input type="hidden"  name="id_pagu"  <? print "value='$p[id_pagu]'"; ?>  />
			<input type="hidden"  name="id_realisasi"  <? print "value='$_GET[id_realisasi]'"; ?>  /> 
			 <input type="hidden"  name="id_pengembalian"  <? print "value='$id_pengembalian'"; ?>  />
			<table  width='97%' align='center'    cellpadding='3'>	

			<tr>	
				<?	print"<td class='subyek1' valign='middle' align='right'>PENGEMBALIAN BULAN : </td>
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
				 <td class='subyek1' valign='middle' align="right">TAHUN :</td>
				 <td valign='middle'> <input type="text"  name="thang"  size="7" class="input-field" readonly 
				 value="<? print "$p[thang]"; ?>" /></td> 	
			
			</tr>		
			
				 
			<tr>				
			
				  <td class="subyek1" valign="middle" align="right">BAG. GAR / UO :</td>
				 <td  valign="middle">  <input type="text"  name="kddept"  size="7" class="input-field" readonly value="012" style="text-align: center;"/>
						<input type="text"  name="kdunit"  size="7" class="input-field" readonly value="22" 
						style="text-align: center;"/>
				 </td>	
						
				 <?	print "<td class='subyek1' valign='middle' align='right'>SUMBER ANGGARAN :</td>
				 <td  valign='middle'><select name='kdsa'  class='select-field' required='required'>
						<option value='' selected>- Pilih -</option>";
						 $sql="select kdsa, nmsa from t_sa ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsa]==$p[kdsa])
							echo "<option value=$data[kdsa] selected>$data[kdsa] | $data[nmsa]</option>";
						 else
							echo "<option value=$data[kdsa]>$data[kdsa] | $data[nmsa]</option>";
				    }  
				print "</select></td>"; ?> 
				
				
				 	
			</tr>

			
				 
			<tr>				
				 
				<td class='subyek1' valign='middle' align="right">KOTAMA :</td>
				 <td  valign='middle'><input type="text"  name="kdkotama"  size="7" class="input-field" readonly 
				 value="<? print "$p[kdkotama]"; ?>" style="text-align: center;"/>&nbsp;&nbsp;<span class="subyek1"><? print "$nmkotama"; ?></span></td> 	
				
				 <?	print"<td class='subyek1' valign='middle' align='right'>JENIS DANA : </td>
				 <td  valign='middle'><select name='kdjd'  class='select-field' required='required'>
						<option value='' selected>- - Pilih - -</option>";
						 $sql="select kdjd, nmjd from t_jd  order by kdjd ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdjd]==$p[kdjd])
							echo "<option value=$data[kdjd] selected>$data[kdjd] | $data[nmjd]</option>";
						 else
							echo "<option value=$data[kdjd]>$data[kdjd] | $data[nmjd]</option>";
				    }  
				print "</select></td>"; ?> 
							
				
			</tr>
			<tr>				 
				 
				
				 <td class='subyek1' valign='middle' align="right">SATKER : </td>
				 <td  valign='middle'><input type="text"  name="kdsatker"  size="7" class="input-field" readonly 
				 value="<? print "$p[kdsatker]"; ?>" style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><? print "$p[nmsatkr]"; ?></span></td>
				 
				 <td class='subyek1' valign='middle' align="right">KU SATKER : </td>
				 <td  valign='middle'><input type="text"  name="kdkusatker"  size="7" class="input-field" readonly 
				 value="<? print "$p[kdkusatker]"; ?>" style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><? print "$p[nmkusatker]"; ?></span></td>
			</tr>	
			
			
			</table>		
	
			<table  width='83%' align='center'   cellpadding="3"><br><br>	
			<tr>
            <?	print"<td class='subyek1' align='right'>WASGIAT :</td> 
				 <td  valign='middle'><select name='kdwasgiat'  class='select-field' required='required'>
						<option value='' selected>- - - - Pilih - - - -</option>";
						 $sql="select kdwasgiat, nmwasgiat from t_wasgiat  order by kdwasgiat ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$p[kdwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[kdwasgiat] | $data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[kdwasgiat] | $data[nmwasgiat]</option>";
				    }  
				print "</select></td><td></td>"; ?>
		 </tr>		 
			
		<div id="suggest">
			
			
		    <tr><td class="subyek1" align="right">PROGRAM :</td>
		
	        
	        <td><input type="text"  name="kdprogram" onBlur="fillkdprogram();" id="kdprogram"  class="input-field" size="7" 
			readonly style="text-align: right;" <? print "value='$p[kdprogram]'"; ?> />
	        <input type="text"  name="nmprogram" onBlur="fillnmprogram();" id="nmprogram"  class="input-field"  size="50" 
			readonly <? print "value='$p[nmprogram]'"; ?> /></td></tr>
							
					
		    <tr><td class="subyek1" align="right">GIAT :</td>
		
	        
	        <td ><input type="text"  name="kdgiat" onBlur="fillkdgiat();" id="kdgiat"  class="input-field" size="7" 
			readonly style="text-align: right;" <? print "value='$p[kdgiat]'"; ?> />
	        <input type="text"  name="nmgiat" onBlur="fillnmgiat();" id="nmgiat"  class="input-field"  size="50" readonly 
			<? print "value='$p[nmgiat]'"; ?> /></td></tr>
		
			<tr><td class="subyek1" align="right">OUTPUT :</td> 
			
	       <td><input type="text"  name="kdoutput" onBlur="fillkdoutput();" id="kdoutput"  class="input-field" size="7" readonly 
			style="text-align: right;"  <? print "value='$p[kdoutput]'"; ?>  />
	        <input type="text"  name="nmoutput" onBlur="fillnmoutput();" id="nmoutput"  class="input-field" size="50" readonly 
			<? print "value='$p[nmoutput]'"; ?>  /></td></tr>
	
	
			<tr><td class="subyek1" align="right">AKUN :  
			</td>
	        <td><input type="text"  name="kdakun" onBlur="fillkdakun();" id="kdakun"  class="input-field" size="7" 
			readonly style="text-align: right;" <? print "value='$p[kdakun]'"; ?> />
			<input type="text"  name="nmakun" onBlur="fillnmakun();" id="nmakun"  class="input-field" size="50" readonly 
			<? print "value='$p[nmakun]'"; ?> /> </td></tr>
		  
               
			<tr><td class="subyek1" align="right">SUB AKUN :</td> 
			
	        <td><input type="text"  name="kdsakun" onBlur="fillkdsakun();" id="kdsakun"  class="input-field" size="7"
			readonly style="text-align: right;"  <? print "value='$p[kdsakun]'"; ?> />
			<input type="text" onKeyUp="suggest(this.value);" name="nmsakun"  onBlur="fillnmsakun();" id="nmsakun" class="input-field" 
			 autocomplete="off" size="50" required="required" <? print "value='$p[nmsakun]'"; ?> readonly /></td></tr>
			
			<tr><td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="dipa/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			</div>
	        </td></tr>				  
		</div>
						
			<tr>
				 <td class="subyek1" align="right">URAIAN KEGIATAN :</td>
				 
				 <td >
				 <input type="text"  name="uraian"  size="50" class="input-field" required="required" maxlength="70" 
				 <? print "value='$p[nmitem]'"; ?> readonly /> </td>				  
			</tr>	
			
			<tr>
				 <td class="subyek1" align="right" >PAGU :</td>
				 
				 <td ><input  type="text" <? print "value='$pagu'"; ?> name="pagu" class='input-field' style='text-align: right;' readonly></td>				  
			</tr>	
			
			<tr>
				 <td class="subyek1" align='right'>REVISI :</td>
				 
				<td align="left" ><input  type="text" <? print "value='$revisi'"; ?> name="revisi" class='input-field' style='text-align: right;' readonly></td>					  
			</tr>		
			
			<tr>
				  <td class="subyek1" align='right'>PAGU SETELAH REVISI :</td>
				 <td  colspan="3" height="20"><input  type="text" <? print "value='$pagurevisi'"; ?> name="pagurevisi" class='input-field' style='text-align: right;' readonly></td>			  
			</tr>
			
			<?php
			$reals = mysql_query("select id_pagu, sum(realisasi) as realisasi  from realisasi where kdbulan<='12' and id_pagu='$_GET[id_pagu]' group by id_pagu");
			
			$q    = mysql_fetch_array($reals); 
	

	        $realisasi=number_format($q[realisasi],0,',','.');
			
			$sisa = $p[pagurevisi] - $q[realisasi];
			$sisa_rb =number_format($sisa,0,',','.');
			?>
			
			<tr>
				  <td class="subyek1" align='right'>REALISASI :</td>
				 <td  colspan="3" height="20"><input  type="text" <? print "value='$realisasi'"; ?> name="pagurevisi" class='input-field' style='text-align: right;' readonly></td>			  
			</tr>
			
			<tr>
				  <td class="subyek1" align='right'>SISA :</td>
				 <td  colspan="3" height="20"><input  type="text" <? print "value='$sisa_rb'"; ?> name="pagurevisi" class='input-field' style='text-align: right;' readonly></td>			  
			</tr>
			
			<tr>
				  <td class="subyek1" align='right'>TGL PENGEMBALIAN :</td>
				 <td  colspan="3" height="20"><?
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
			</tr>
	
			<tr>
				  <td class="subyek1" align='right'>JUMLAH PENGEMBALIAN :</td>
				 <td  colspan="3" height="20"><? print "<input name='jml_pengembalian' type='hidden'  value='$_POST[jml_pengembalian]' class='input-field' readonly/>
				      <input type='text' name='jml_pengembalian_awal' onkeyup='formatJml_pengembalian(this);replaceJml_pengembalian(document.form1.jml_pengembalian_awal.value);' style='text-align: right;' value='$_POST[jml_pengembalian]' class='input-field' autocomplete='off'  >"; ?></td>			  
			</tr>
			<tr>
				 <td class="subyek1" colspan="2" height="20"></td>			  
			</tr>
			
			<tr>
				 <td class="subyek1"></td>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"  id="simpan" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					<? print "<a href='media.php?module=pengembalian&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' style='text-decoration:none'><input type='button' value='Keluar'></a>"; ?>
				 </div></td>				  
			</tr>		
			</table>
			</form></div></div></center>
			
<br><br>
<?php

// header
	print "<table width='80%'  cellspacing='5' cellpadding='5' align='center' class='bordered'>";
	print "<tr  >";
	print    "<th   align='center' height='30' width='5%' >NO</th>";	
	print    "<th   align='center' >BULAN</th>";
	print    "<th   align='center' >THANG</th>";
	print    "<th   align='center' >KODE PROGRAM</th>";
	print    "<th   align='center' >URAIAN</th>";
	print    "<th   align='center' >TGL PENGEMBALIAN</th>";
    print    "<th   align='center' >JML PENGEMBALIAN</th>";
	print    "<th   align='center' colspan='2' >AKSI</th>";
  	print "</tr>";
	
$sql="SELECT a.*, b.nmbulan from pengembalian a left join t_bulan b on a.kdbulan=b.kdbulan  where a.id_pagu='$_GET[id_pagu]' order by a.kdbulan, a.tgl_pengembalian";
    $qry=mysql_query($sql);

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	$tgl_pengembalian=tgl_indoangka($row[tgl_pengembalian]);
	$jml_pengembalian = number_format($row[jml_pengembalian],0,',','.');
	

	print"<tr><td  align='center' valign='top'>$no</td>
	          <td  valign='top'>$row[nmbulan]</td>
			  <td  valign='top'>$row[thang]</td>
			  <td  valign='top'>012.22.$row[kdprogram].$row[kdgiat].$row[kdoutput].$row[kdakun]</td>
			  <td  valign='top'>$row[uraian]</td>
			  <td  valign='top'>$tgl_pengembalian</td>
			  
			  <td  valign='top' align='right'>$jml_pengembalian</td>
			  <td  align='center' valign='top'><a href='media.php?module=editpengembalian&id_pengembalian=$row[id_pengembalian]&id_realisasi=$row[id_realisasi]&id_pagu=$row[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]' data-tooltip='Edit Pengembalian' data-position='top' class='top'><img src='images/edit.png' width='20' ></a></td>
			  <td  align='center' valign='top'><a href=\"pengembalian/proses.php?aksi=hapus&id_pengembalian=$row[id_pengembalian]&id_realisasi=$row[id_realisasi]&id_pagu=$row[id_pagu]&kdbulan=$_GET[kdbulan]&thang=$_GET[thang]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $row[uraian] ~? ')\" data-tooltip='Hapus Pengembalian' data-position='top' class='top'><img src='images/delete.png' width='20' ></td>			  
		  </tr>";	
		  $no++;
     }
	 
	 $jml = mysql_query("SELECT sum(jml_pengembalian) as jumlah from pengembalian	 where  id_pagu ='$_GET[id_pagu]' ");						   
     $data1    = mysql_fetch_array($jml);
	 
	 $jumlah = number_format($data1[jumlah],0,',','.');
	  
		print"<tr><td  align='center'></td>
			  <td   colspan='5'>&nbsp;&nbsp;&nbsp;&nbsp;<span>J U M L A H</span></td>
			  <td   align='right'><span>$jumlah</span></td>
			  <td   ></td>
			  <td   ></td>		
			 		  
		  </tr>";	
		  
	print"</table><br>";

?>			
<script>



function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}


function replaceJml_pengembalian(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.jml_pengembalian.value = temp;
}

function formatJml_pengembalian(objek) {
jml_pengembalian_awal = objek.value;
b = jml_pengembalian_awal.replace(/[^\d]/g,"");
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

