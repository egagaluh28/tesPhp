

<html>
<head>


<script language="javascript" src="library/jquery-1.2.6.js"></script>



<?  
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>EDIT DATA PAGU</td></tr></table><br>";


    $edit = mysql_query("SELECT  a.*,  d.nmwasgiat,  f.nmprogram, g.nmgiat, h.nmoutput,
						 i.nmakun, j.nmsakun, k.nmkotama, l.nmsatkr,  nmkusatker from hibah a 
						 left join t_wasgiat d on a.kdwasgiat=d.kdwasgiat
						 left join t_program f on a.kdprogram=f.kdprogram
						 left join t_giat g on a.kdprogram=g.kdprogram and
						 a.kdgiat=g.kdgiat
						 left join t_output h on a.kdprogram=h.kdprogram and
						 a.kdgiat=h.kdgiat and a.kdoutput=h.kdoutput
						 left join t_akun i on a.kdakun=i.kdakun
						 left join t_sakun j on a.kdprogram=j.kdprogram and a.kdgiat=j.kdgiat and a.kdoutput=j.kdoutput and a.kdakun=j.kdakun and a.kdsakun=j.kdsakun 
						 left join t_kotam k on a.kdkotama=k.kdkotama
						 left join t_satkr l on a.kdkotama=l.kdkotama and a.kdsatker=l.kdsatkr
						 left join t_kusatker m on a.kdkusatker=m.kdkusatker
						 WHERE a.id_pagu='$_GET[id_pagu]'");
    $p    = mysql_fetch_array($edit); 
	
	
	 if ($p[pagu]!='0')    { $pagu=number_format($p[pagu],0,',','.'); }  else {  $pagu=''; }
	
?>
   <center><div id="borderku1" >
   <div class="form-style-2">
   <form  name="form1" method="POST"  action="hibah/proses.php?aksi=ubah" >
   
			<table  width='97%' align='center'    cellpadding='3'>	

			<tr>				 
				 <td class='subyek1' valign='middle' align="right">TAHUN :</td>
				 <td valign='middle'> <input type="text"  name="thang"  size="7" class="input-field" readonly 
				 value="<? print "$p[thang]"; ?>" /></td> 	
				
				<td class='subyek1' valign='middle'></td>
				<td class='subyek1' valign='middle'></td>	
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
				 value="<? print "$p[kdkotama]"; ?>" style="text-align: center;"/>&nbsp;&nbsp;<span class="subyek1"><? print "$p[nmkotama]"; ?></span></td> 	
				
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
			<input type="hidden"  name="id_pagu" class="input-field" <? print "value='$p[id_pagu]'"; ?> readonly /></td>
	        <td><input type="text"  name="kdakun" onBlur="fillkdakun();" id="kdakun"  class="input-field" size="7" 
			readonly style="text-align: right;" <? print "value='$p[kdakun]'"; ?> />
			<input type="text"  name="nmakun" onBlur="fillnmakun();" id="nmakun"  class="input-field" size="50" readonly 
			<? print "value='$p[nmakun]'"; ?> /> </td></tr>
		  
               
			<tr><td class="subyek1" align="right">SUB AKUN :</td> 
			
	        <td><input type="text"  name="kdsakun" onBlur="fillkdsakun();" id="kdsakun"  class="input-field" size="7"
			readonly style="text-align: right;"  <? print "value='$p[kdsakun]'"; ?> />
			<input type="text" onKeyUp="suggest(this.value);" name="nmsakun"  onBlur="fillnmsakun();" id="nmsakun" class="input-field" 
			 autocomplete="off" size="50" required="required" <? print "value='$p[nmsakun]'"; ?> /></td></tr>
			
			<tr><td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="hibah/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			</div>
	        </td></tr>				  
		</div>
						
			<tr>
				 <td class="subyek1" align="right">URAIAN KEGIATAN :</td>
				 
				 <td > <input type="hidden"  name="noitem"  size="7" class="input-field" readonly  style="text-align: right;" 
				 <? print "value='$p[noitem]'"; ?> /> 
				 <input type="hidden"  name="urutitem"  size="7" class="input-field" readonly  style="text-align: right;" 
				 <? print "value='$p[urutitem]'"; ?> />
				 <input type="text"  name="nmitem"  size="50" class="input-field" required="required" maxlength="70" 
				 <? print "value='$p[nmitem]'"; ?> /> </td>				  
			</tr>	
			
			<tr>
				 <td class="subyek1" align="right" >PAGU :</td>
				 
				 <td ><? print "<input name='pagu' type='hidden'  value='$p[pagu]' class='input-field' readonly/>
				      <input type='text' name='pagu_awal' onkeyup='formatPagu(this);replacePagu(document.form1.pagu_awal.value);' style='text-align: right;' value='$pagu' class='input-field' autocomplete='off' onFocus='startCalc();' onBlur='stopCalc();'>"; ?></td>				  
			</tr>	
			
			<tr>
				 <td class="subyek1" align='right'>REVISI :</td>
				 
				<td align="left" >
				     <? print "<input name='revisi' type='text'   value='$p[revisi]' id='revisi' onkeyup=\"document.getElementById('format').innerHTML = formatCurrency(this.value);\" value='$p[revisi]' class='input-field' style='text-align: right;' onFocus='startCalc();' onBlur='stopCalc();' />
				      "; ?>&nbsp;<span id="format"></span></td>					  
			</tr>		
			
			<tr>
				 <td  colspan="3" height="20"><input  type="hidden" <? print "value='$p[pagurevisi]'"; ?> name="pagurevisi" class='input-field' 
				 onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>			  
			</tr>
	
		
			<tr>
				 <td class="subyek1" colspan="2" height="20"></td>			  
			</tr>
			
			<tr>
				 <td class="subyek1"></td>
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
		$.post("hibah/proses_cari_autosuggest.php", {queryString: ""+inputString+""}, function(data){
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

