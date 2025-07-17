<link href="library/combocari/select2.min.css" rel="stylesheet" />
 <script src="library/combocari/jquery-3.4.1.js" ></script>
<script src="library/combocari/select2.min.js"></script> 
<script>

function trimNumber(s) {
  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
  return s;
}




function replaceJandes(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.jandes.value = temp;
}

function formatJandes(objek) {
jandes_awal = objek.value;
b = jandes_awal.replace(/[^\d]/g,"");
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



function replaceGaji13(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.gaji13.value = temp;
}

function formatGaji13(objek) {
gaji13_awal = objek.value;
b = gaji13_awal.replace(/[^\d]/g,"");
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



function replaceGaji14(entry) {
	out = "."; // replace this
	add = ""; // with this
	temp = "" + entry; // temporary holder

	while (temp.indexOf(out)>-1) {
	pos= temp.indexOf(out);
	temp = "" + (temp.substring(0, pos) + add + 
	temp.substring((pos + out.length), temp.length));
	}
	document.form1.gaji14.value = temp;
}

function formatGaji14(objek) {
gaji14_awal = objek.value;
b = gaji14_awal.replace(/[^\d]/g,"");
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

$(document).ready(function() {
     $('#kdakun').select2({
      placeholder: 'PILIH AKUN',
      allowClear: true
     });
 });
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
		// $qry = mysql_query("select * from t_bulan where kdbulan='$_GET[kdbulan]' ");
		// $x    = mysql_fetch_array($qry);
		 
		 $qry1 = mysql_query("select * from t_kotam where kdkotama='$_SESSION[kdkotama]' ");
		 $x1    = mysql_fetch_array($qry1);
		 
		 $nmkotama = strtoupper($x1[nmkotama]);
		 
		 
		 
		 $qry2 = mysql_query("select * from t_satkr where kdsatkr='$_SESSION[kdsatker]'");
		 $x2    = mysql_fetch_array($qry2);
		 
		
?>		 

<br>
<center><span class="judulcontent">INPUT RENBUT GAJI DAN TUNKIN</span></center><br>
<center><div id="bdr">
<div class="form-style-2">
<form action="renbut/proses.php?aksi=simpan" method="POST"  name="form1">  
<input name="kdbulan" type="hidden"  size="40" class="sendiri" value="<?php echo "$_GET[kdbulan]"; ?>"  />

    <table width="650" align="center" cellpadding="5">

			<tr>
				<td  align="right" class="subyek1">TAHUN :</td>
				<td><input name="thang" type="text"  style="width: 400px;" class="sendiri" value="<?php echo "$_GET[thang]"; ?>"  readonly /></td>
		    </tr>
			
			<tr>
				<td  align="right" class="subyek1">KOTAMA :</td>
				<td valign="top" ><input name="kdkotama" type="hidden"  size="40" class="sendiri" value="<? echo "$_SESSION[kdkotama]"; ?>"  />
				<input name="nmkotama" type="text"  style="width: 400px;" class="sendiri" value="<? echo "$nmkotama"; ?>" readonly /></td>
		    </tr>
			
			<tr>
				<td  align="right" class="subyek1">SATKER :</td>
				<td valign="top" ><input name="kdsatker" type="hidden"  size="40" class="sendiri" value="<? echo "$_SESSION[kdsatker]"; ?>"/>
				<input name="nmsatker" type="text"  style="width: 400px;" class="sendiri" value="<? echo "$x2[nmsatkr]"; ?>" readonly /></td>
		    </tr>
			
			
			
			<tr>
				<td  align="right" class="subyek1">AKUN :</td>
				<td valign="top" ><?php  $jssArray = "var isi5 = new Array();\n"; ?>
				<select name="kdakun" id="kdakun" class="sendiri" onchange='changeValue5(this.value)' required="required" style="width: 400px;"> 
                <option value="" selected="selected">- - - - - - - - - - - - PILIH - - - - - - - - - - - - - </option>
                <? 	 $sql=mysql_query("select * from t_akun_gaji order by kdakun");
			    while ($data=mysql_fetch_array($sql)){
			    if ($data[kdakun]==$_POST[kdakun]){
  			         echo "<option value=$data[kdakun] selected>$data[kdakun] | $data[nmakun]</option>";
			            }
			    else {echo "<option value=$data[kdakun]>$data[kdakun] | $data[nmakun]</option>";
    				    }
				$jssArray .= "isi5['" . $data['kdakun'] . "'] =    {name5:'" . addslashes($data['nmakun']) . "'};\n"; 		
  					    }
		        ?>
                </select></td>
			
			</tr>
			<input type="hidden" class="sendiri" name="nmakun"    id="nmakun">
			
			
			<script type="text/javascript">    
			<?php print $jssArray; ?>  
			function changeValue5(id){ 
			
				if(id=='') {
				document.getElementById('nmakun').value = '';  
				}	
			document.getElementById('nmakun').value = isi5[id].name5;  
			};  
			</script>
			<tr>
				<td  align="right" class="subyek1">JAN - DES :</td>
				<td valign="top" ><? print "<input name='jandes' type='hidden'  value='$_POST[jandes]' class='sendiri' style='text-align: right;' />
				      <input   style='width: 400px; text-align: right' type='text' name='jandes_awal'  autocomplete='off'
					  onkeyup='formatJandes(this);replaceJandes(document.form1.jandes_awal.value);' 
					   value='$_POST[jandes_awal]' class='sendiri' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">GAJI KE 13 :</td>
				<td valign="top" ><? print "<input name='gaji13' type='hidden'  value='$_POST[gaji13]' class='sendiri' style='text-align: right;' />
				      <input   style='width: 400px; text-align: right' type='text' name='gaji13_awal'  autocomplete='off'
					  onkeyup='formatGaji13(this);replaceGaji13(document.form1.gaji13_awal.value);' 
					   value='$_POST[gaji13_awal]' class='sendiri' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">GAJI KE 14 :</td>
				<td valign="top" ><? print "<input name='gaji14' type='hidden'  value='$_POST[gaji14]' class='sendiri' style='text-align: right;' />
				      <input   style='width: 400px; text-align: right' type='text' name='gaji14_awal'  autocomplete='off'
					  onkeyup='formatGaji14(this);replaceGaji14(document.form1.gaji14_awal.value);' 
					   value='$_POST[gaji14_awal]' class='sendiri' >"; ?></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">KETERANGAN :</td>
				<td valign="top" ><input name="ket" type="text" style='width: 400px'; class="sendiri" />
		    </tr>
			
			
			
			
	
		</table><br> 
	
	<div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div> 
	
    </form></div></div><br>