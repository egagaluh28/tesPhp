<script>

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}


function replaceJumlah(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.jumlah.value = temp;
}

function formatJumlah(objek) {
jumlah_awal = objek.value;
b = jumlah_awal.replace(/[^\d]/g,"");
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


function replacePajak(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.pajak.value = temp;
}

function formatPajak(objek) {
pajak_awal = objek.value;
b = pajak_awal.replace(/[^\d]/g,"");
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
<style>
#bdr{
width:800px;
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

<?
		 $qry = mysql_query("select * from t_bulan where kdbulan='$_GET[kdbulan]' ");
		 $x    = mysql_fetch_array($qry);
		 
		 $qry1 = mysql_query("select nmkotama from t_kotam where kdkotama='$_SESSION[kdkotama]' ");
		 $x1    = mysql_fetch_array($qry1);
		 
		 $qry2 = mysql_query("select nmsatkr from t_satkr where kdkotama='$_SESSION[kdkotama]' and kdsatkr='$_SESSION[kdsatker]'");
		 $x2    = mysql_fetch_array($qry2);
?>		 

<br>
<center><span class="judul">INPUT REKAP TUNKIN</span></center><br>
<center><div id="bdr">
<div class="form-style-2">
<form action="tunkin/proses.php?aksi=simpan" method="POST"  name="form1">  

    <table width="650" align="center" cellpadding="5">

			<tr>
				<td width="150" align="right" class="subyek1">BULAN :</td>
			    <td valign="top" ><input name="kdbulan" type="hidden"  size="2" class="input-field" value="<? echo "$_GET[kdbulan]"; ?>"/>
				<input name="nmbulan" type="text"   class="input-field" value="<? echo "$x[nmbulan]"; ?>" readonly /></td>
			</tr>
			<tr>
				<td width="150" align="right" class="subyek1">TAHUN ANGARAN :</td>
				<td valign="top" ><input name="thang" type="text" size="6" class="input-field"value="<? echo "$_GET[thang]"; ?>" readonly /></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">KOTAMA :</td>
				<td valign="top" ><input name="kdkotama" type="hidden"  size="40" class="input-field" value="<? echo "$_SESSION[kdkotama]"; ?>"  />
				<input name="nmkotama" type="text"  size="40" class="input-field" value="<? echo "$x1[nmkotama]"; ?>" readonly /></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">SATKER :</td>
				<td valign="top" ><input name="kdsatker" type="hidden"  size="40" class="input-field" value="<? echo "$_SESSION[kdsatker]"; ?>"/>
				<input name="nmsatkr" type="text"  size="40" class="input-field" value="<? echo "$x2[nmsatkr]"; ?>" readonly /></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">GRADE :</td>
				<td valign="top" ><?
						print "<select name='grade' class='select-field'  required='required'>
						<option value='' selected>- - - - - - - Pilih - - - - - - -</option>";
						 $sql="select * from t_grade order by grade desc";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 $indeks	 = number_format($data[indeks],0,',','.');
						 echo "<option value=\"".$data['grade']."\">".$data['grade']." | ".$indeks."</option>\n";
					   }
				    
			print "</select>"; ?></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">JUMLAH PERS :</td>
				<td valign="top" ><? print "<input name='jumlah' type='hidden'  value='$_POST[jumlah]' class='rounded' style='text-align: right;' />
				      <input size='10' type='text' name='jumlah_awal' autocomplete='off'
					  onkeyup='formatJumlah(this);replaceJumlah(document.form1.jumlah_awal.value);' 
					  style='text-align: right;' value='$_POST[jumlah_awal]' class='input-field' required='required'>"; ?></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">PAJAK :</td>
				<td valign="top" ><? print "<input name='pajak' type='hidden'  value='$_POST[pajak]' class='rounded' style='text-align: right;' />
				      <input  size='10' type='text' name='pajak_awal'  autocomplete='off'
					  onkeyup='formatPajak(this);replacePajak(document.form1.pajak_awal.value);' 
					  style='text-align: right;' value='$_POST[pajak_awal]' class='input-field' required='required'>"; ?></td>
			</tr>
			
			
	
		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><input type="submit"  value="Simpan" class="button green"></td>
				 <td></td>
				 <td ><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button green"></td>
			</tr></table><br>
	
    </form></div></div>


