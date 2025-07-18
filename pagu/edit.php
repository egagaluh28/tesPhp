<html>
<head>
<script language="javascript" src="library/jquery-1.2.6.js"></script>

<?php // PERBAIKAN: Selalu mulai dengan <?php
// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// PERBAIKAN: Include connect.php di awal
include "application/connect.php";

// PERBAIKAN: Pengecekan koneksi
if (!isset($conn_status_ok) || !$conn_status_ok) {
    die("Error: Koneksi database belum terjalin atau gagal di edit.php. Pastikan application/connect.php sudah benar dan database berjalan.");
}

print "<br><table width='1100' align='center' ><tr><td class='judulcontent' align='center'>EDIT DATA PAGU</td></tr></table><br>";

// PERBAIKAN: Escape $_GET['id_pagu'] untuk mencegah SQL Injection
$get_id_pagu = isset($_GET['id_pagu']) ? mysql_real_escape_string($_GET['id_pagu']) : '';

$edit_query = "SELECT a.*, d.nmwasgiat, f.nmprogram, g.nmgiat, h.nmoutput,
                         i.nmakun, j.nmsakun, k.nmkotama, l.nmsatkr, m.nmkusatker 
                FROM dipa a
                LEFT JOIN t_wasgiat d ON a.kdwasgiat=d.kdwasgiat
                LEFT JOIN t_program f ON a.kdprogram=f.kdprogram
                LEFT JOIN t_giat g ON a.kdprogram=g.kdprogram AND a.kdgiat=g.kdgiat
                LEFT JOIN t_output h ON a.kdprogram=h.kdprogram AND a.kdgiat=h.kdgiat AND a.kdoutput=h.kdoutput
                LEFT JOIN t_akun i ON a.kdakun=i.kdakun
                LEFT JOIN t_sakun j ON a.kdprogram=j.kdprogram AND a.kdgiat=j.kdgiat AND a.kdoutput=j.kdoutput AND a.kdakun=j.kdakun AND a.kdsakun=j.kdsakun
                LEFT JOIN t_kotam k ON a.kdkotama=k.kdkotama
                LEFT JOIN t_satkr l ON a.kdkotama=l.kdkotama AND a.kdsatker=l.kdsatkr
                LEFT JOIN t_kusatker m ON a.kdkusatker=m.kdkusatker
                WHERE a.id_pagu='$get_id_pagu'";

$edit = mysql_query($edit_query);
if (!$edit) { // PERBAIKAN: Cek error kueri
    die("Kueri edit data pagu gagal: " . mysql_error());
}

$p = mysql_fetch_array($edit);

// PERBAIKAN: Pastikan $p ada sebelum mengakses elemennya
if ($p && isset($p['pagu']) && $p['pagu'] != '0') {
    $pagu_formatted = number_format($p['pagu'], 0, ',', '.');
} else {
    $pagu_formatted = '';
}

// PERBAIKAN: Inisialisasi variabel untuk menghindari warning jika data tidak ada
$p_thang = isset($p['thang']) ? htmlspecialchars($p['thang']) : '';
$p_kdkotama = isset($p['kdkotama']) ? htmlspecialchars($p['kdkotama']) : '';
$p_nmkotama = isset($p['nmkotama']) ? htmlspecialchars($p['nmkotama']) : '';
$p_kdsa = isset($p['kdsa']) ? htmlspecialchars($p['kdsa']) : '';
$p_kdjd = isset($p['kdjd']) ? htmlspecialchars($p['kdjd']) : '';
$p_kdsatker = isset($p['kdsatker']) ? htmlspecialchars($p['kdsatker']) : '';
$p_nmsatkr = isset($p['nmsatkr']) ? htmlspecialchars($p['nmsatkr']) : '';
$p_kdkusatker = isset($p['kdkusatker']) ? htmlspecialchars($p['kdkusatker']) : '';
$p_nmkusatker = isset($p['nmkusatker']) ? htmlspecialchars($p['nmkusatker']) : '';
$p_kdwasgiat = isset($p['kdwasgiat']) ? htmlspecialchars($p['kdwasgiat']) : '';
$p_kdprogram = isset($p['kdprogram']) ? htmlspecialchars($p['kdprogram']) : '';
$p_nmprogram = isset($p['nmprogram']) ? htmlspecialchars($p['nmprogram']) : '';
$p_kdgiat = isset($p['kdgiat']) ? htmlspecialchars($p['kdgiat']) : '';
$p_nmgiat = isset($p['nmgiat']) ? htmlspecialchars($p['nmgiat']) : '';
$p_kdoutput = isset($p['kdoutput']) ? htmlspecialchars($p['kdoutput']) : '';
$p_nmoutput = isset($p['nmoutput']) ? htmlspecialchars($p['nmoutput']) : '';
$p_id_pagu = isset($p['id_pagu']) ? htmlspecialchars($p['id_pagu']) : '';
$p_kdakun = isset($p['kdakun']) ? htmlspecialchars($p['kdakun']) : '';
$p_nmakun = isset($p['nmakun']) ? htmlspecialchars($p['nmakun']) : '';
$p_kdsakun = isset($p['kdsakun']) ? htmlspecialchars($p['kdsakun']) : '';
$p_nmsakun = isset($p['nmsakun']) ? htmlspecialchars($p['nmsakun']) : '';
$p_noitem = isset($p['noitem']) ? htmlspecialchars($p['noitem']) : '';
$p_urutitem = isset($p['urutitem']) ? htmlspecialchars($p['urutitem']) : '';
$p_nmitem = isset($p['nmitem']) ? htmlspecialchars($p['nmitem']) : '';
$p_pagu_raw = isset($p['pagu']) ? htmlspecialchars($p['pagu']) : ''; // Pagu raw untuk perhitungan JS
$p_revisi = isset($p['revisi']) ? htmlspecialchars($p['revisi']) : '';
$p_pagurevisi = isset($p['pagurevisi']) ? htmlspecialchars($p['pagurevisi']) : '';

?>
   <center><div id="borderku1" >
   <div class="form-style-2">
   <form name="form1" method="POST" action="pagu/proses.php?aksi=ubah" >

			<table width='97%' align='center' cellpadding='3'>

			<tr>
				 <td class='subyek1' valign='middle' align="right">TAHUN :</td>
				 <td valign='middle'> <input type="text" name="thang" size="7" class="input-field" readonly
				 value="<?php echo $p_thang; ?>" /></td>

				<td class='subyek1' valign='middle'></td>
				<td class='subyek1' valign='middle'></td>
			</tr>


			<tr>
				  <td class="subyek1" valign="middle" align="right">BAG. GAR / UO :</td>
				 <td valign="middle">  <input type="text" name="kddept" size="7" class="input-field" readonly value="012" style="text-align: center;"/>
						<input type="text" name="kdunit" size="7" class="input-field" readonly value="22"
						style="text-align: center;"/>
				 </td>

				 <?php
                    echo "<td class='subyek1' valign='middle' align='right'>SUMBER ANGGARAN :</td>
                     <td valign='middle'><select name='kdsa' class='select-field' required='required'>
                            <option value='' selected>- Pilih -</option>";
                    $sql_sa = "SELECT kdsa, nmsa FROM t_sa";
                    $qry_sa = mysql_query($sql_sa);
                    if (!$qry_sa) { die("Kueri sumber anggaran gagal: " . mysql_error()); }
                    while ($data_sa = mysql_fetch_array($qry_sa)){
                        $selected = ($data_sa['kdsa'] == $p_kdsa) ? 'selected' : '';
                        echo "<option value='".htmlspecialchars($data_sa['kdsa'])."' {$selected}>".htmlspecialchars($data_sa['kdsa'])." | ".htmlspecialchars($data_sa['nmsa'])."</option>";
                    }
                    echo "</select></td>";
                 ?>

			</tr>


			<tr>
				<td class='subyek1' valign='middle' align="right">KOTAMA :</td>
				 <td valign='middle'><input type="text" name="kdkotama" size="7" class="input-field" readonly
				 value="<?php echo $p_kdkotama; ?>" style="text-align: center;"/>&nbsp;&nbsp;<span class="subyek1"><?php echo $p_nmkotama; ?></span></td>

				 <?php
                    echo "<td class='subyek1' valign='middle' align='right'>JENIS DANA : </td>
                     <td valign='middle'><select name='kdjd' class='select-field' required='required'>
                            <option value='' selected>- - Pilih - -</option>";
                    $sql_jd = "SELECT kdjd, nmjd FROM t_jd ORDER BY kdjd";
                    $qry_jd = mysql_query($sql_jd);
                    if (!$qry_jd) { die("Kueri jenis dana gagal: " . mysql_error()); }
                    while ($data_jd = mysql_fetch_array($qry_jd)){
                        $selected = ($data_jd['kdjd'] == $p_kdjd) ? 'selected' : '';
                        echo "<option value='".htmlspecialchars($data_jd['kdjd'])."' {$selected}>".htmlspecialchars($data_jd['kdjd'])." | ".htmlspecialchars($data_jd['nmjd'])."</option>";
                    }
                    echo "</select></td>";
                 ?>


			</tr>
			<tr>
				 <td class='subyek1' valign='middle' align="right">SATKER : </td>
				 <td valign='middle'><input type="text" name="kdsatker" size="7" class="input-field" readonly
				 value="<?php echo $p_kdsatker; ?>" style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><?php echo $p_nmsatkr; ?></span></td>

				 <td class='subyek1' valign='middle' align="right">KU SATKER : </td>
				 <td valign='middle'><input type="text" name="kdkusatker" size="7" class="input-field" readonly
				 value="<?php echo $p_kdkusatker; ?>" style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><?php echo $p_nmkusatker; ?></span></td>
			</tr>


			</table>

			<table width='83%' align='center' cellpadding="3"><br><br>
			<tr>
            <?php
                echo "<td class='subyek1' align='right'>WASGIAT :</td>
                 <td valign='middle'><select name='kdwasgiat' class='select-field' required='required'>
                        <option value='' selected>- - - - Pilih - - - -</option>";
                $sql_wasgiat = "SELECT kdwasgiat, nmwasgiat FROM t_wasgiat ORDER BY kdwasgiat";
                $qry_wasgiat = mysql_query($sql_wasgiat);
                if (!$qry_wasgiat) { die("Kueri Wasgiat gagal: " . mysql_error()); }
                while ($data_wasgiat = mysql_fetch_array($qry_wasgiat)){
                    $selected = ($data_wasgiat['kdwasgiat'] == $p_kdwasgiat) ? 'selected' : '';
                    echo "<option value='".htmlspecialchars($data_wasgiat['kdwasgiat'])."' {$selected}>".htmlspecialchars($data_wasgiat['kdwasgiat'])." | ".htmlspecialchars($data_wasgiat['nmwasgiat'])."</option>";
                }
                echo "</select></td><td></td>";
            ?>
		 </tr>

		<div id="suggest">

		    <tr><td class="subyek1" align="right">PROGRAM :</td>


	        <td><input type="text" name="kdprogram" onBlur="fillkdprogram();" id="kdprogram" class="input-field" size="7"
			readonly style="text-align: right;" value="<?php echo $p_kdprogram; ?>" />
	        <input type="text" name="nmprogram" onBlur="fillnmprogram();" id="nmprogram" class="input-field" size="50"
			readonly value="<?php echo $p_nmprogram; ?>" /></td></tr>


		    <tr><td class="subyek1" align="right">GIAT :</td>


	        <td ><input type="text" name="kdgiat" onBlur="fillkdgiat();" id="kdgiat" class="input-field" size="7"
			readonly style="text-align: right;" value="<?php echo $p_kdgiat; ?>" />
	        <input type="text" name="nmgiat" onBlur="fillnmgiat();" id="nmgiat" class="input-field" size="50" readonly
			value="<?php echo $p_nmgiat; ?>" /></td></tr>

			<tr><td class="subyek1" align="right">KRO :</td>

	       <td><input type="text" name="kdoutput" onBlur="fillkdoutput();" id="kdoutput" class="input-field" size="7" readonly
			style="text-align: right;"  value="<?php echo $p_kdoutput; ?>"  />
	        <input type="text" name="nmoutput" onBlur="fillnmoutput();" id="nmoutput" class="input-field" size="50" readonly
			value="<?php echo $p_nmoutput; ?>"  /></td></tr>


			<tr><td class="subyek1" align="right">AKUN :
			<input type="hidden" name="id_pagu" class="input-field" value="<?php echo $p_id_pagu; ?>" readonly /></td>
	        <td><input type="text" name="kdakun" onBlur="fillkdakun();" id="kdakun" class="input-field" size="7"
			readonly style="text-align: right;" value="<?php echo $p_kdakun; ?>" />
			<input type="text" name="nmakun" onBlur="fillnmakun();" id="nmakun" class="input-field" size="50" readonly
			value="<?php echo $p_nmakun; ?>" /> </td></tr>


			<tr><td class="subyek1" align="right">SUB AKUN :</td>

	        <td><input type="text" name="kdsakun" onBlur="fillkdsakun();" id="kdsakun" class="input-field" size="7"
			readonly style="text-align: right;"  value="<?php echo $p_kdsakun; ?>" />
			<input type="text" onKeyUp="suggest(this.value);" name="nmsakun" onBlur="fillnmsakun();" id="nmsakun" class="input-field"
			 autocomplete="off" size="50" required="required" value="<?php echo $p_nmsakun; ?>" /></td></tr>

			<tr><td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="pagu/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			</div>
	        </td></tr>
		</div>

			<tr>
				 <td class="subyek1" align="right">URAIAN KEGIATAN :</td>

				 <td > <input type="hidden" name="noitem" size="7" class="input-field" readonly style="text-align: right;"
				 value="<?php echo $p_noitem; ?>" />
				 <input type="hidden" name="urutitem" size="7" class="input-field" readonly style="text-align: right;"
				 value="<?php echo $p_urutitem; ?>" />
				 <input type="text" name="nmitem" size="50" class="input-field" required="required" maxlength="70"
				 value="<?php echo $p_nmitem; ?>" /> </td>
			</tr>

			<tr>
				 <td class="subyek1" align="right" >PAGU :</td>

				 <td ><input name='pagu' type='hidden' value='<?php echo $p_pagu_raw; ?>' class='input-field' readonly/>
				      <input type='text' name='pagu_awal' onkeyup='formatPagu(this);replacePagu(document.form1.pagu_awal.value);' style='text-align: right;' value='<?php echo $pagu_formatted; ?>' class='input-field' autocomplete='off' onFocus='startCalc();' onBlur='stopCalc();'></td>
			</tr>

			<tr>
				 <td class="subyek1" align='right'>REVISI :</td>

				<td align="left" >
				     <input name='revisi' type='text' value='<?php echo $p_revisi; ?>' id='revisi' onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);" class='input-field' style='text-align: right;' onFocus='startCalc();' onBlur='stopCalc();' />
				      &nbsp;<span id="format"></span></td>
			</tr>

			<tr>
				 <td colspan="3" height="20"><input  type="hidden" value="<?php echo $p_pagurevisi; ?>" name="pagurevisi" class='input-field'
				 onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
			</tr>


			<tr>
				 <td class="subyek1" colspan="2" height="20"></td>
			</tr>

			<tr>
				 <td ></td>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>
				 </td>
			</tr>
			</table>
			</form></div></div></center>

<br><br>

<script>
// Fungsi JavaScript Anda (tidak ada perubahan signifikan)
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#kodespa').addClass('load');
		$.post("pagu/proses_cari_autosuggest.php", {queryString: ""+inputString+""}, function(data){
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

</head>
<body>
</body>
</html>