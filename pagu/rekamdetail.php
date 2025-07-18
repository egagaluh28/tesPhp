<?php
session_start();

// PERBAIKAN: Include file koneksi database
include "application/connect.php";

// PERBAIKAN: Cek status koneksi (tetap perlu memastikan koneksi berhasil)
// Logika ini masih akan mengandalkan variabel $conn_status_ok dari connect.php
if (!isset($conn_status_ok) || !$conn_status_ok) {
    die("Error: Koneksi database belum terjalin di rekamdetail.php. Periksa file application/connect.php dan status database Anda.");
}

// Fungsi escape_data tetap diperlukan karena menggunakan mysql_real_escape_string
function escape_data($data) {
    // Pastikan koneksi database sudah aktif agar mysql_real_escape_string bisa digunakan
    // Jika koneksi belum ada atau gagal, fallback ke addslashes (kurang aman)
    if (function_exists('mysql_real_escape_string') && isset($GLOBALS['conn_mysql_resource']) && is_resource($GLOBALS['conn_mysql_resource'])) {
        return mysql_real_escape_string($data, $GLOBALS['conn_mysql_resource']);
    } else {
        return addslashes($data);
    }
}

// PERBAIKAN: Amankan semua input $_GET
$get_kdprogram = isset($_GET['kdprogram']) ? escape_data($_GET['kdprogram']) : '';
$get_kdgiat = isset($_GET['kdgiat']) ? escape_data($_GET['kdgiat']) : '';
$get_kdoutput = isset($_GET['kdoutput']) ? escape_data($_GET['kdoutput']) : '';
$get_kdakun = isset($_GET['kdakun']) ? escape_data($_GET['kdakun']) : '';
$get_kdsakun = isset($_GET['kdsakun']) ? escape_data($_GET['kdsakun']) : '';
$get_kdkotama = isset($_GET['kdkotama']) ? escape_data($_GET['kdkotama']) : '';
$get_kdsatker = isset($_GET['kdsatker']) ? escape_data($_GET['kdsatker']) : '';
$get_thang = isset($_GET['thang']) ? escape_data($_GET['thang']) : date("Y"); // Tambahkan thang dari GET, dengan fallback

// PERBAIKAN: Kueri untuk mendapatkan detail KOTAMA, SATKER, KU SATKER dari t_satkr
// Ini akan memastikan data KU SATKER terisi meskipun belum ada entri di tabel dipa
$satker_query = "SELECT a.kdkotama, a.kdsatkr, a.nmsatkr, a.kdkusatker, b.nmkotama, c.nmkusatker
                 FROM t_satkr a
                 LEFT JOIN t_kotam b ON a.kdkotama=b.kdkotama
                 LEFT JOIN t_kusatker c ON a.kdkusatker=c.kdkusatker
                 WHERE a.kdkotama='$get_kdkotama' AND a.kdsatkr='$get_kdsatker' LIMIT 1";

$satker_result = mysql_query($satker_query);
if (!$satker_result) {
    die("Gagal mengambil detail satker: " . mysql_error());
}
$row_satker_detail = mysql_fetch_array($satker_result);

// PERBAIKAN: Kueri detail untuk mendapatkan nama-nama yang akan ditampilkan dari dipa (jika ada)
// Ambil data untuk dropdown dan nilai yang akan ditampilkan
$dipa_detail_query = "SELECT a.kdwasgiat, e.nmwasgiat, f.nmprogram, g.nmgiat, h.nmoutput, i.nmakun, j.nmsakun
                 FROM dipa a
                 LEFT JOIN t_wasgiat e ON a.kdwasgiat=e.kdwasgiat
                 LEFT JOIN t_program f ON a.kdprogram=f.kdprogram
                 LEFT JOIN t_giat g ON a.kdprogram=g.kdprogram AND a.kdgiat=g.kdgiat
                 LEFT JOIN t_output h ON a.kdprogram=h.kdprogram AND a.kdgiat=h.kdgiat AND a.kdoutput=h.kdoutput
                 LEFT JOIN t_akun i ON a.kdakun=i.kdakun
                 LEFT JOIN t_sakun j ON a.kdprogram=j.kdprogram AND a.kdgiat=j.kdgiat AND a.kdoutput=j.kdoutput AND a.kdakun=j.kdakun AND a.kdsakun=j.kdsakun
                 WHERE a.kdprogram ='$get_kdprogram' AND
                       a.kdgiat    ='$get_kdgiat' AND
                       a.kdoutput  ='$get_kdoutput' AND
                       a.kdakun    ='$get_kdakun' AND
                       a.kdsakun   ='$get_kdsakun' AND
                       a.kdkotama  ='$get_kdkotama' AND
                       a.kdsatker  ='$get_kdsatker' AND
                       a.thang     ='$get_thang'
                 LIMIT 1";

$dipa_detail_result = mysql_query($dipa_detail_query);
if (!$dipa_detail_result) {
    die("Gagal mengambil detail data DIPA: " . mysql_error() . "<br>Kueri: " . htmlspecialchars($dipa_detail_query));
}
$row_dipa_detail = mysql_fetch_array($dipa_detail_result);


// PERBAIKAN: Logika penentuan noitem dan urutitem
// noitem baru adalah MAX(noitem) + 1 untuk kombinasi program/giat/output/akun/sakun ini
$sql_noitem = "SELECT MAX(CAST(noitem AS UNSIGNED)) + 1 AS new_noitem FROM dipa
               WHERE kdprogram ='$get_kdprogram' AND
                     kdgiat    ='$get_kdgiat' AND
                     kdoutput  ='$get_kdoutput' AND
                     kdakun    ='$get_kdakun' AND
                     kdsakun   ='$get_kdsakun' AND
                     kdkotama  ='$get_kdkotama' AND
                     kdsatker  ='$get_kdsatker' AND
                     thang     ='$get_thang'";

$qry_noitem = mysql_query($sql_noitem);
if (!$qry_noitem) {
    die("Gagal query noitem: " . mysql_error() . "<br>Kueri: " . htmlspecialchars($sql_noitem));
}
$res_noitem = mysql_fetch_array($qry_noitem);

// Jika belum ada item dengan kriteria ini, mulai dari 1
$id_baru1 = isset($res_noitem['new_noitem']) ? (int)$res_noitem['new_noitem'] : 1;

// Format urutitem (0001, 0002, dst.)
$no_id = sprintf('%04d', $id_baru1);

// PERBAIKAN: Inisialisasi variabel untuk tampilan menggunakan data dari t_satkr dan t_dipa
$kdkotama_val = isset($row_satker_detail['kdkotama']) ? htmlspecialchars($row_satker_detail['kdkotama']) : $get_kdkotama;
$nmkotama_val = isset($row_satker_detail['nmkotama']) ? htmlspecialchars($row_satker_detail['nmkotama']) : '';
$kdsatker_val = isset($row_satker_detail['kdsatkr']) ? htmlspecialchars($row_satker_detail['kdsatkr']) : $get_kdsatker;
$nmsatkr_val = isset($row_satker_detail['nmsatkr']) ? htmlspecialchars($row_satker_detail['nmsatkr']) : '';
$kdkusatker_val = isset($row_satker_detail['kdkusatker']) ? htmlspecialchars($row_satker_detail['kdkusatker']) : '';
$nmkusatker_val = isset($row_satker_detail['nmkusatker']) ? htmlspecialchars($row_satker_detail['nmkusatker']) : '';

$kdprogram_val = isset($row_dipa_detail['kdprogram']) ? htmlspecialchars($row_dipa_detail['kdprogram']) : $get_kdprogram;
$nmprogram_val = isset($row_dipa_detail['nmprogram']) ? htmlspecialchars($row_dipa_detail['nmprogram']) : '';
$kdgiat_val = isset($row_dipa_detail['kdgiat']) ? htmlspecialchars($row_dipa_detail['kdgiat']) : $get_kdgiat;
$nmgiat_val = isset($row_dipa_detail['nmgiat']) ? htmlspecialchars($row_dipa_detail['nmgiat']) : '';
$kdoutput_val = isset($row_dipa_detail['kdoutput']) ? htmlspecialchars($row_dipa_detail['kdoutput']) : $get_kdoutput;
$nmoutput_val = isset($row_dipa_detail['nmoutput']) ? htmlspecialchars($row_dipa_detail['nmoutput']) : '';
$kdakun_val = isset($row_dipa_detail['kdakun']) ? htmlspecialchars($row_dipa_detail['kdakun']) : $get_kdakun;
$nmakun_val = isset($row_dipa_detail['nmakun']) ? htmlspecialchars($row_dipa_detail['nmakun']) : '';
$kdsakun_val = isset($row_dipa_detail['kdsakun']) ? htmlspecialchars($row_dipa_detail['kdsakun']) : $get_kdsakun;
$nmsakun_val = isset($row_dipa_detail['nmsakun']) ? htmlspecialchars($row_dipa_detail['nmsakun']) : '';
$kdwasgiat_val = isset($row_dipa_detail['kdwasgiat']) ? htmlspecialchars($row_dipa_detail['kdwasgiat']) : ''; // Tambahkan wasgiat

?>
<script>
// Fungsi JavaScript Anda (tidak ada perubahan signifikan)
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

<br><center><span class="judul">INPUT DATA PAGU </span></center><br>
 <center><div id="borderku1" >
          <div class="form-style-2">
   <form name="form1"  method="POST" action="pagu/proses.php?aksi=simpan">
            <table  width='99%' align='center'   cellpadding='4'>

            <tr>
                 <td class="subyek1" align="right">TAHUN ANGGARAN :</td>
                 <td ><input type="text"  name="thang"  size="7" class="input-field" readonly="readonly" style="text-align: center;"
                 value="<?php echo htmlspecialchars($get_thang); ?>" />
                 </td>
                <td class='subyek1' valign='middle'></td>
                <td class='subyek1' valign='middle'></td>
            </tr>

            <tr>
                 <td class="subyek1" align="right">BAG. GAR / UO :</td>
                 <td >  <input type="text"  name="kddept"  size="7" class="input-field" readonly value="012" style="text-align: center;"/>
                        <input type="text"  name="kdunit"  size="7" class="input-field" readonly value="22" style="text-align: center;"/>
                 </td>
            <?php
                echo "<td class='subyek1' align='right'>SUMBER ANGGARAN :</td>
                 <td><select name='kdsa'  class='select-field' required='required'>
                        <option value='' selected> - - Pilih - - </option>";
                         $sql="SELECT kdsa, nmsa FROM t_sa ORDER BY kdsa";
                         $qry=mysql_query($sql);
                         if (!$qry) { die("Kueri Sumber Anggaran gagal: " . mysql_error()); }
                         while ($data=mysql_fetch_array($qry)){
                         // Gunakan $row_dipa_detail jika ada data, atau biarkan tidak terpilih
                         $selected = (isset($row_dipa_detail['kdsa']) && $data['kdsa'] == $row_dipa_detail['kdsa']) ? 'selected' : '';
                            echo "<option value='".htmlspecialchars($data['kdsa'])."' {$selected}>".htmlspecialchars($data['kdsa'])." | ".htmlspecialchars($data['nmsa'])."</option>";
                    }
                echo "</select></td>";
            ?>
            </tr>

            <tr>
                 <td class="subyek1" align="right">KOTAMA :</td>
                 <td >  <input type="text"  name="kdkotama"  size="7" class="input-field" readonly="readonly" value="<?php echo $kdkotama_val; ?>"
                 style="text-align: center;" /><span class="subyek1">&nbsp;&nbsp;<?php echo htmlspecialchars($nmkotama_val); ?></span>
                 </td>

            <?php
                echo"<td class='subyek1' align='right'>JENIS DANA :</td>
                 <td><select name='kdjd'  class='select-field' required='required'>
                        <option value='' selected> - - Pilih - - </option>";
                         $sql="SELECT kdjd, nmjd FROM t_jd ORDER BY kdjd";
                         $qry=mysql_query($sql);
                         if (!$qry) { die("Kueri Jenis Dana gagal: " . mysql_error()); }
                         while ($data=mysql_fetch_array($qry)){
                            // Gunakan $row_dipa_detail jika ada data, atau biarkan tidak terpilih
                            $selected = (isset($row_dipa_detail['kdjd']) && $data['kdjd'] == $row_dipa_detail['kdjd']) ? 'selected' : '';
                            echo "<option value='".htmlspecialchars($data['kdjd'])."' {$selected}>".htmlspecialchars($data['kdjd'])." | ".htmlspecialchars($data['nmjd'])."</option>";
                    }
                echo "</select></td>";
            ?>
            </tr>

            <tr>
                 <td class="subyek1" align="right">SATKER :</td>
                 <td><input type="text"  name="kdsatker"  class="input-field" size="7" readonly style="text-align: center;"
                 value="<?php echo $kdsatker_val; ?>"  /><span class="subyek1">&nbsp;&nbsp;<?php echo htmlspecialchars($nmsatkr_val); ?></span>
                 </td>


                <div id="nominku">
                <td class="subyek1" align="right">KU SATKER :</td>
                <td><input type="text"  name="kdkusatker"   class="input-field" size="7" readonly style="text-align: center;"
                value="<?php echo $kdkusatker_val; ?>"  />
                <input type="text" name="nmpekas" class="input-field"
                value="<?php echo htmlspecialchars($nmkusatker_val); ?>" readonly /></td></tr>

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



        <table  width='97%' align='center'   cellpadding='4'>
            <tr>
            <td><input type="hidden"  name="kdprogram" style="text-align: right;" value="<?php echo $kdprogram_val; ?>" />
                <input type="hidden"  name="kdgiat"    style="text-align: right;" value="<?php echo $kdgiat_val; ?>" />
                <input type="hidden"  name="kdoutput"  style="text-align: right;" value="<?php echo $kdoutput_val; ?>" />
                <input type="hidden"  name="kdakun"    style="text-align: right;" value="<?php echo $kdakun_val; ?>" />
                <input type="hidden"  name="kdsakun"   style="text-align: right;" value="<?php echo $kdsakun_val; ?>" />
                <input type="hidden"  name="nmakun"    value="<?php echo $nmakun_val; ?>" />
                <input type="hidden"  name="nmsakun"   value="<?php echo $nmsakun_val; ?>" /></td>
            </tr>

            <tr>
                 <td class="subyek1" width="180" align="right">WASGIAT :</td>
                 <td ><?php echo "<select name='kdwasgiat'  class='select-field' required='required'>
                        <option value='' selected>- - - - Pilih - - - -</option>";
                         $sql="SELECT kdwasgiat, nmwasgiat FROM t_wasgiat ORDER BY kdwasgiat ";
                         $qry=mysql_query($sql);
                         if (!$qry) { die("Kueri Wasgiat gagal: " . mysql_error()); }
                         while ($data=mysql_fetch_array($qry)){
                         $selected = ($data['kdwasgiat'] == $kdwasgiat_val) ? 'selected' : '';
                            echo "<option value='".htmlspecialchars($data['kdwasgiat'])."' {$selected}>".htmlspecialchars($data['kdwasgiat'])." | ".htmlspecialchars($data['nmwasgiat'])."</option>";
                    }
                echo "</select>"; ?></td>
            </tr>

            <tr>
                 <td class="subyek1" width="180" align="right">URAIAN KEGIATAN :</td>
                 <td > <input type="hidden"  name="noitem"  size="7" class="input-field" readonly  style="text-align: right;" value="<?php echo $id_baru1; ?>" />

                 <input type="hidden"  name="urutitem"  size="7" class="input-field" readonly  style="text-align: right;" value="<?php echo $no_id; ?>" />

                 <input type="text"  name="nmitem"  size="50" class="input-field" required="required" maxlength="60"> </td>
            </tr>

            <tr>
                 <td class="subyek1" align="right">PAGU :</td>
                 <td ><?php echo "<input name='pagu' type='hidden'  value='' class='input-field' readonly/>"; // Kosongkan untuk input baru ?>
                      <input type='text' name='pagu_awal' onkeyup='formatPagu(this);replacePagu(document.form1.pagu_awal.value);' style='text-align: right;' value='' class='input-field' autocomplete='off' onFocus='startCalc();' onBlur='stopCalc();' ></td>
            </tr>

            <tr>
                 <td class="subyek1" align="right" >REVISI :</td>
                                 <td align="left" >
                     <?php echo "<input name='revisi' type='text' id='revisi' onkeyup=\"document.getElementById('format').innerHTML = formatCurrency(this.value);\" value='0' class='input-field' style='text-align: right;' onFocus='startCalc();' onBlur='stopCalc();' />"; // Default 0 ?>
                      &nbsp;<span id="format"></span></td>
            </tr>

            <tr>
                 <td  colspan="2" height="20"><input  type="hidden" value="0" name="pagurevisi" class='input-field'
                 onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
            </tr>

            <tr>
                 <td class="subyek1" colspan="2" height="10"> </td>
            </tr>

            <tr>
                 <td class="subyek1"></td>
                 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" > </div>
                 </td>
            </tr>
            </table>
            </form></div></div>

<br><br>
</body>
</html>