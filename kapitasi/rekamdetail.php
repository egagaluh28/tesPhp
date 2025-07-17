<?php
session_start();

?>


<script>


function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}

function replacePagu(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.pagu.value = temp;
}

function formatPagu(objek) {
pagu_awal = objek.value;
b = pagu_awal.replace(/[^\d]/g,"");
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
<html>
<head>

<?


  $detail = mysql_query("SELECT a.*, b.nmkotama, c.nmsatkr, d.nmkusatker from kapitasi a left join t_kotam b on a.kdkotama=b.kdkotama
                         left join t_satkr c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatkr 
						 left join t_kusatker d on a.kdkusatker=d.kdkusatker
												 where a.kdprogram ='$_GET[kdprogram]' and
													   a.kdgiat    ='$_GET[kdgiat]' and
													   a.kdoutput  ='$_GET[kdoutput]' and
													   a.kdakun    ='$_GET[kdakun]' and
													   a.kdsakun   ='$_GET[kdsakun]' and
													   a.kdkotama  ='$_GET[kdkotama]' and
													   a.kdsatker  ='$_GET[kdsatker]'"); 									   
  $row    = mysql_fetch_array($detail);
  


$id_baru1=1;
if($id_baru1 > 1){

$sql_rec="SELECT MAX(noitem) + 1 AS id_baru1 FROM kapitasi where kdprogram ='$_GET[kdprogram]' and
																	kdgiat    ='$_GET[kdgiat]' and
																    kdoutput  ='$_GET[kdoutput]' and
																    kdakun    ='$_GET[kdakun]' and
																    kdsakun   ='$_GET[kdsakun]' and
																    kdkotama  ='$_GET[kdkotama]' and
																    kdsatker  ='$_GET[kdsatker]'  ";
$qry_rec=@mysql_query($sql_rec) or die ("Gagal query".mysql_error());
$hs_rec=mysql_fetch_array($qry_rec) or die ("Hasil pemakai tidak ada");
$id_baru1=$hs_rec[id_baru1];
}else{
$sql_rec="SELECT MAX(noitem) + 1 AS id_baru1 FROM kapitasi where kdprogram ='$_GET[kdprogram]' and
																	kdgiat    ='$_GET[kdgiat]' and
																    kdoutput  ='$_GET[kdoutput]' and
																    kdakun    ='$_GET[kdakun]' and
																    kdsakun   ='$_GET[kdsakun]' and
																    kdkotama  ='$_GET[kdkotama]' and
																    kdsatker  ='$_GET[kdsatker]'  ";
$qry_rec=@mysql_query($sql_rec) or die ("Gagal query".mysql_error());
$hs_rec=mysql_fetch_array($qry_rec) or die ("Hasil pemakai tidak ada");
$id_baru1=$hs_rec[id_baru1];
} 


$sql_norut="SELECT MAX(noitem) + 1 AS norut_baru FROM kapitasi where kdprogram ='$_GET[kdprogram]' and
																	kdgiat    ='$_GET[kdgiat]' and
																    kdoutput  ='$_GET[kdoutput]' and
																    kdakun    ='$_GET[kdakun]' and
																    kdsakun   ='$_GET[kdsakun]' and
																    kdkotama  ='$_GET[kdkotama]' and
																    kdsatker  ='$_GET[kdsatker]'  ";
$qry_norut=@mysql_query($sql_norut) or die ("Gagal query".mysql_error());
$result=mysql_fetch_array($qry_norut) or die ("Hasil pemakai tidak ada");
$norut_baru=$result[norut_baru];

if ($norut_baru < 10 ) {
	$no_id="000".$norut_baru;
}
elseif ($norut_baru < 100) {
	$no_id="00".$norut_baru;
}
elseif ($norut_baru < 1000) {
	$no_id="0".$norut_baru;
}


?>
<br><center><span class="judul">INPUT DATA PAGU </span></center><br>
 <center><div id="borderku1" >
          <div class="form-style-2">
   <form name="form1"  method="POST" action="kapitasi/proses.php?aksi=simpan">
			<table  width='99%' align='center'   cellpadding='3'>
			
			<tr>
				 <td class="subyek1" align="right">TAHUN ANGGARAN :</td>
				 <td ><input type="text"  name="thang"  size="7" class="input-field" readonly="readonly" style="text-align: center;"
				 value="<? print "$_GET[thang]"; ?>" />   
				 </td>				  
				<td class='subyek1' valign='middle'></td>
				<td class='subyek1' valign='middle'></td>	
			</tr>	
					
			<tr>
				 <td class="subyek1" align="right">BAG. GAR / UO :</td>
				 <td >  <input type="text"  name="kddept"  size="7" class="input-field" readonly value="012" style="text-align: center;"/>
						<input type="text"  name="kdunit"  size="7" class="input-field" readonly value="22" style="text-align: center;"/>
				 </td>	

			<?	print "<td class='subyek1' align='right'>SUMBER ANGGARAN :</td>
				 <td><select name='kdsa'  class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdsa, nmsa from t_sa  order by kdsa";
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
				 <td class="subyek1" align="right">KOTAMA :</td>
				 <td >  <input type="text"  name="kdkotama"  size="7" class="input-field" readonly="readonly" value=<? print "$row[kdkotama]"; ?> 
				 style="text-align: center;" /><span class="subyek1">&nbsp;&nbsp;<? print "$row[nmkotama]"; ?></span>
				 </td>	
				
			<?	print"<td class='subyek1' align='right'>JENIS DANA :</td>
				 <td colspan='3'><select name='kdjd'  class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdjd, nmjd from t_jd  order by kdjd";
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
				 <td class="subyek1" align="right">SATKER :</td>
				 <td><input type="text"  name="kdsatker"  class="input-field" size="7" readonly style="text-align: center;"
			     value=<? print "$row[kdsatker]"; ?>  /><span class="subyek1">&nbsp;&nbsp;<? print "$row[nmsatkr]"; ?></span>
				 </td>	

				<div id="nominku">	
				<td class="subyek1" align="right">KU SATKER :</td>  
				<td><input type="text"  name="kdkusatker"   class="input-field" size="7" readonly style="text-align: center;"
			    value=<? print "$row[kdkusatker]"; ?>  />
				<input type="text" name="nmpekas" class="input-field"  
				value="<? print "$row[nmkusatker]"; ?>" readonly /></td></tr>
				
				<tr><td><div class="pencarianBox" id="pencarian" style="display: none;"> <img src="pagu/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="pencarianList"> &nbsp; </div>
				</div>
				</td>				  
				</div>	
			</tr>	
			
			<tr>
				 <td class="subyek1" colspan="2" height="20"> </td>			  
			</tr>	
			</table>
			
		
		
		<table  width='97%' align='center'   cellpadding='3'>	
			<tr>		
	        <td><input type="hidden" name="kdfungsi"   style="text-align: right;" value=<? print "$row[kdfungsi]"; ?> />
	            <input type="hidden"  name="kdsfungsi" style="text-align: right;" value=<? print "$row[kdsfungsi]"; ?> />
	            <input type="hidden"  name="kdprogram" style="text-align: right;" value=<? print "$row[kdprogram]"; ?> />  
			    <input type="hidden"  name="kdgiat"    style="text-align: right;" value=<? print "$row[kdgiat]"; ?> />
	            <input type="hidden"  name="kdoutput"  style="text-align: right;" value=<? print "$row[kdoutput]"; ?> />
	            <input type="hidden"  name="kdakun"    style="text-align: right;" value=<? print "$row[kdakun]"; ?> />
			    <input type="hidden"  name="kdsakun"   style="text-align: right;" value=<? print "$row[kdsakun]"; ?> />
				<input type="hidden"  name="kdwasgiat" style="text-align: right;" value=<? print "$row[kdwasgiat]"; ?> />
			    <input type="hidden"  name="nmakun"    value="<? print "$row[nmakun]"; ?>" />
				<input type="hidden"  name="nmsakun"   value="<? print "$row[nmsakun]"; ?>" />
			</tr>
			
			<tr>
				 <td class="subyek1" width="180" align="right">URAIAN KEGIATAN :</td>
				 <td > <input type="hidden"  name="noitem"  size="7" class="input-field" readonly  style="text-align: right;" value=<? print "$id_baru1"; ?> /> 
				 
				 <input type="hidden"  name="urutitem"  size="7" class="input-field" readonly  style="text-align: right;" value=<? print "$no_id"; ?> />
				 
				 <input type="text"  name="nmitem"  size="50" class="input-field" maxlength="60"> </td>				  
			</tr>	

			<tr>
				 <td class="subyek1" align="right">PAGU :</td>
				 <td ><? print "<input name='pagu' type='hidden'  value='$_POST[pagu]' class='input-field' readonly/>
				      <input type='text' name='pagu_awal' onkeyup='formatPagu(this);replacePagu(document.form1.pagu_awal.value);' style='text-align: right;' value='$_POST[pagu_awal]' class='input-field' autocomplete='off' onFocus='startCalc();' onBlur='stopCalc();' >"; ?></td>				  
			</tr>	

			<tr>
				 <td class="subyek1" align="right" >REVISI :</td>
								 <td align="left" >
				     <? print "<input name='revisi' type='text'   id='revisi' onkeyup=\"document.getElementById('format').innerHTML = formatCurrency(this.value);\" value='$_POST[revisi]' class='input-field' style='text-align: right;'onFocus='startCalc();' onBlur='stopCalc();' />
				      "; ?>&nbsp;<span id="format"></span></td>				  			  
			</tr>		
			
			<tr>
				 <td  colspan="2" height="20"><input  type="hidden" value="0" name="pagurevisi" class='input-field' 
				 onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>			  
			</tr>
		
			<tr>
				 <td class="subyek1" colspan="2" height="20"> </td>			  
			</tr>
			
			<tr>
				 <td class="subyek1"></td>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>  
				 </td>			  
			</tr>		
			</table>	
			</form></div></div>
			
<br><br>
			
<script>



function formatCurrency(revisi) {
    revisi = revisi.toString().replace(/\$|\,/g,'');
    if(isNaN(revisi))
    revisi = "0";
    sign = (revisi == (revisi = Math.abs(revisi)));
    revisi = Math.floor(revisi*100+0.50000000001);
    cents = revisi%100;
    revisi = Math.floor(revisi/100).toString();
    if(cents<10)
    cents = "0" + cents;
    for (var i = 0; i < Math.floor((revisi.length-(1+i))/3); i++)
    revisi = revisi.substring(0,revisi.length-(4*i+3))+'.'+
    revisi.substring(revisi.length-(4*i+3));
    return (((sign)?'':'-') + revisi );
    }
	
//penjumlahan pagu revisi otomatis	
function startCalc(){
	interval = setInterval("calc()",1);}
	function calc(){
	one = document.form1.pagu.value;
	two = document.form1.revisi.value; 
	document.form1.pagurevisi.value = (one * 1) + (two * 1);}
	function stopCalc(){
	clearInterval(interval);}	
</script> 

