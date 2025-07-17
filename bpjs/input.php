<script language="javascript" src="library/jquery.js"></script>

<?php include "library/indotgl_angka.php";

$id_baru1=1;

    $edit = mysql_query("SELECT a.kdkotama,  a.kdsatkr, a.nmsatkr, a.kdkusatker, b.nmkotama, c.nmkusatker from t_satkr a 
  left join t_kotam b on a.kdkotama=b.kdkotama 
  left join t_kusatker c on a.kdkusatker=c.kdkusatker
  where a.kdkotama='$_GET[kdkotama]' and a.kdsatkr='$_GET[kdsatker]'");
  $row    = mysql_fetch_array($edit);
  
 
 print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>INPUT DATA PAGU</td></tr></table><br>";
?>

   <center><div id="borderku1" >
   <div class="form-style-2">
   <form  name="form1" method="POST"  action="bpjs/proses.php?aksi=simpan" >
   
			<table  width='97%' align='center'   cellpadding='3'  >
			
			<tr>
				 <td  valign="middle" class="subyek1" align="right" >TAHUN ANGGARAN : </td>
				 <td  valign="middle"><?php print "<select name='thang' class='select-field'>";
					  print "<option value='$_GET[thang]' selected>$_GET[thang]</option>";
					  for ($tahun=2022; $tahun<=2025; $tahun++){
					  $thn=$_POST['thang'];
					  if ($thn==$tahun)
						   echo "<option value=$tahun selected>$tahun</option>";
					  else
						   echo "<option value=$tahun>$tahun</option>";
					  }
					  echo "</select>"; ?>  
				 </td>		

				<td class='subyek1' valign='middle'></td>
				<td class='subyek1' valign='middle'></td>	
				 
			</tr>	
					
			<tr>
				 <td  valign="middle" class="subyek1" align="right" >BAG. GAR / UO : </td>
				 <td  valign="middle">  <input type="text"  name="kddept"  size="7" class="input-field" readonly value="012" style="text-align: center;"/>
						<input type="text"  name="kdunit"  size="7" class="input-field" readonly value="22" style="text-align: center;"/>
				 </td>	

			<?php	print "<td class='subyek1' align='right' >SUMBER ANGGARAN :</td>
				 <td class='middle'><select name='kdsa'  class='select-field' required='required'>
						<option value='1' selected>1 | APBN</option>";
						 $sql="select kdsa, nmsa from t_sa  where kdsa>='2'";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsa]==$_POST[kdsa])
							echo "<option value=$data[kdsa] selected>$data[kdsa] | $data[nmsa]</option>";
						 else
							echo "<option value=$data[kdsa]>$data[kdsa] | $data[nmsa]</option>";
				    }  
				print "</select></td>"; ?>	
			</tr>		
	
			<tr>
				 <td  valign="middle" class="subyek1" align="right" >KOTAMA :</td>
				 <td  valign="middle" >  <input type="text"  name="kdkotama"  size="7" class="input-field" readonly value=<?php print "$row[kdkotama]"; ?> 
				 style="text-align: center;"/><span class="subyek1">&nbsp;&nbsp;<?php print "$row[nmkotama]"; ?></span>
				 </td>	

			<?php	print"<td class='subyek1' align='right' >JENIS DANA : </td>
				 <td class='middle'><select name='kdjd'  class='select-field' required='required'>
						<option value='' selected>- - Pilih - -</option>";
						 $sql="select kdjd, nmjd from t_jd  order by kdjd ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdjd]==$_POST[kdjd])
							echo "<option value=$data[kdjd] selected>$data[kdjd] | $data[nmjd]</option>";
						 else
							echo "<option value=$data[kdjd]>$data[kdjd] | $data[nmjd]</option>";
				    }  
				print "</select></td>"; ?>	
			</tr>		
			<tr>
				 <td  valign="middle" class="subyek1" align="right" >SATKER :</td>
				 <td   >  <input type="text"  name="kdsatker"  size="7" class="input-field" readonly value=<?php print "$row[kdsatkr]"; ?> 
				 style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><?php print "$row[nmsatkr]"; ?></span>
				 </td>	

				
				<td  valign="middle" class="subyek1" align="right" >KU SATKER :</td>  
				<td  valign="middle" ><input type="text"  name="kdkusatker"  class="input-field" size="7" readonly style="text-align: center;" value=<?php print "$row[kdkusatker]"; ?> />&nbsp;&nbsp;<span class="subyek1"><?php print "$row[nmkusatker]"; ?></span></td></tr>
				
			</tr>	
			
			<tr>
				 <td  colspan="2" height="20"> </td>			  
			</tr>	
			</table>

			<table  width='83%' align='center'   cellpadding="3"><br><br>	
			
			 
			
			<div id="suggest">
			<tr><td  align="right" class='subyek1'>WASGIAT :</td>
		    
	        <td><input type="text"  name="kdwasgiat" onBlur="fillkdwasgiat();" id="kdwasgiat"  class="input-field" size="7"  style="text-align: right;" required="required"/>
	        <input type="text"  name="nmwasgiat" onBlur="fillnmwasgiat();" id="nmwasgiat"  class="input-field"  size="50" readonly /></td></tr>
			
		    <tr><td  align="right" class="subyek1">PROGRAM :</td>
		    
	        <td><input type="text"  name="kdprogram" onBlur="fillkdprogram();" id="kdprogram"  class="input-field" size="7"  style="text-align: right;" required="required"/>
	        <input type="text"  name="nmprogram" onBlur="fillnmprogram();" id="nmprogram"  class="input-field"  size="50" readonly /></td></tr>
			
		    <tr><td  align="right" class="subyek1">GIAT :</td>
		    
	        <td ><input type="text"  name="kdgiat" onBlur="fillkdgiat();" id="kdgiat"  class="input-field" size="7"  style="text-align: right;" required="required"/>
	        <input type="text"  name="nmgiat" onBlur="fillnmgiat();" id="nmgiat"  class="input-field"  size="50" readonly /></td></tr>
           
	
			<tr><td  align="right" class="subyek1">OUTPUT :</td> 
			
	        <td><input type="text"  name="kdoutput" onBlur="fillkdoutput();" id="kdoutput"  class="input-field" size="7" readonly style="text-align: right;"/>
	        <input type="text"  name="nmoutput" onBlur="fillnmoutput();" id="nmoutput"  class="input-field" size="50" readonly /></td></tr>
	
			<tr><td  align="right" class="subyek1">AKUN :</td> 
			
	        <td><input type="text"  name="kdakun" onBlur="fillkdakun();" id="kdakun"  class="input-field" size="7" readonly style="text-align: right;"/>
			<input type="text"  name="nmakun" onBlur="fillnmakun();" id="nmakun"  class="input-field" size="50" readonly /> </td></tr>
		  
               
			<tr><td  align="right" class="subyek1">SUB AKUN :</td> 
			
	        <td><input type="text"  name="kdsakun" onBlur="fillkdsakun();" id="kdsakun"  class="input-field" size="7"
			readonly style="text-align: right;"  />
			<input type="text" onKeyUp="suggest(this.value);" name="nmsakun"  onBlur="fillnmsakun();" id="nmsakun" class="input-field" 
			 autocomplete="off" size="50" required="required"/></td></tr>
			
			<tr><td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="bpjs/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			</div>
	        </td></td></tr>
			</div>
						
			<tr>
				 <td  align="right" class="subyek1">URAIAN KEGIATAN :</td>
				 
				 <td > <input type="hidden"  name="noitem"  size="7" class="input-field" readonly  style="text-align: right;" value="1" /> 
				 <input type="hidden"  name="urutitem"  size="7" class="input-field" readonly  style="text-align: right;" value="0001" />
				 <input type="text"  name="nmitem"  size="50" class="input-field" required="required" maxlength="70"> </td>				  
			</tr>	


			<tr>
				 <td  align="right" class="subyek1">PAGU :</td>
				 
				 <td ><?php print "<input name='pagu' type='hidden'  value='$_POST[pagu]' class='input-field' readonly/>
				      <input type='text' name='pagu_awal' onkeyup='formatPagu(this);replacePagu(document.form1.pagu_awal.value);' style='text-align: right;' value='$_POST[pagu_awal]' class='input-field' autocomplete='off' onFocus='startCalc();' onBlur='stopCalc();' >"; ?></td>				  
			</tr>	
			
			<tr>
				 <td  align="right" class="subyek1">REVISI :</td>
				 
				 <td align="left" >
				     <?php print "<input name='revisi' type='text'   id='revisi' onkeyup=\"document.getElementById('format').innerHTML = formatCurrency(this.value);\" value='$_POST[revisi]' class='input-field' style='text-align: right;' onFocus='startCalc();' onBlur='stopCalc();'/>
				      "; ?>&nbsp;<span id="format"></span></td>				  
			</tr>		
		
			<tr>
				 <td  colspan="3" height="20"><input  type="hidden" value="0" name="pagurevisi" class='input-field' 
				 onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>			  
			</tr>
			
			<tr>
				 <td ></td>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>  
				 </td>				  
			</tr>		
			</table>
			</form></div></div></center>
			
<br><br>
			
<script>
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#kodespa').addClass('load');
		$.post("bpjs/proses_cari_autosuggest.php", {queryString: ""+inputString+""}, function(data){
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



function fillkdwasgiat(thisValue) {
	$('#kdwasgiat').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fillnmwasgiat(thisValue) {
	$('#nmwasgiat').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}


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

