<?php
session_start();
include "../application/connect.php";

if (!isset($conn_status_ok) || !$conn_status_ok) {
    die("Error: Koneksi database belum terjalin di proses.php. Periksa file application/connect.php dan status database Anda.");
}

// Escape semua input POST/GET sebelum digunakan dalam kueri
function escape_data($data) {
    if (function_exists('mysql_real_escape_string')) {
        return mysql_real_escape_string($data);
    } else {
        return addslashes($data); // Fallback jika mysql_real_escape_string tidak tersedia (PHP 7+), tapi tidak seaman itu
    }
}

$jenbel = isset($_POST['kdakun']) ? substr(escape_data($_POST['kdakun']), 0, 2) : '';

if ($_GET['aksi'] == 'simpan') {

    $idx = isset($_POST['kdkotama']) ? escape_data($_POST['kdkotama']) : '';
    $idx1 = isset($_POST['kdsatker']) ? escape_data($_POST['kdsatker']) : '';

    $saiki = date('ymdHis'); // Current time: 250718134107
    $id_pagu = $saiki . "" . $idx1; // Contoh: 250718134107344453

    $insert_query = "INSERT INTO dipa
                             (id_pagu,
                              kdwasgiat,
                              thang,
                              kdkotama,
                              kdsatker,
                              kddept,
                              kdunit,
                              kdfungsi,
                              kdsfungsi,
                              kdprogram,
                              kdgiat,
                              kdoutput,
                              kdkusatker,
                              kdsa,
                              kdjd,
                              kdjenbel,
                              kdakun,
                              kdsakun,
                              noitem,
                              urutitem,
                              nmitem,
                              pagu,
                              revisi,
                              pagurevisi,
                              nmakun,
                              nmsakun,
                              pengembalian)
                          VALUES(
                              '$id_pagu',
                              '" . escape_data($_POST['kdwasgiat']) . "',
                              '" . escape_data($_POST['thang']) . "',
                              '" . $idx . "',
                              '" . $idx1 . "',
                              '" . escape_data($_POST['kddept']) . "',
                              '" . escape_data($_POST['kdunit']) . "',
                              '',
                              '',
                              '" . escape_data($_POST['kdprogram']) . "',
                              '" . escape_data($_POST['kdgiat']) . "',
                              '" . escape_data($_POST['kdoutput']) . "',
                              '" . escape_data($_POST['kdkusatker']) . "',
                              '" . escape_data($_POST['kdsa']) . "',
                              '" . escape_data($_POST['kdjd']) . "',
                              '$jenbel',
                              '" . escape_data($_POST['kdakun']) . "',
                              '" . escape_data($_POST['kdsakun']) . "',
                              '" . escape_data($_POST['noitem']) . "',
                              '" . escape_data($_POST['urutitem']) . "',
                              '" . escape_data($_POST['nmitem']) . "',
                              '" . escape_data($_POST['pagu']) . "',
                              '" . escape_data($_POST['revisi']) . "',
                              '" . escape_data($_POST['pagurevisi']) . "',
                              '" . escape_data($_POST['nmakun']) . "',
                              '" . escape_data($_POST['nmsakun']) . "',
                              '0' )"; // PERBAIKAN: Pastikan tidak ada string ekstra di sini

    $insert_result = mysql_query($insert_query);

    if (!$insert_result) {
        die("Gagal menyimpan data ke DIPA: " . mysql_error() . "<br>Kueri: " . htmlspecialchars($insert_query));
    }

    ?><script language="JavaScript">;
     document.location='<?php print "../media.php?module=pagudipa&thang=" . htmlspecialchars(escape_data($_POST['thang'])); ?>'</script><?php

} else if ($_GET['aksi'] == 'hapus') {
    $id_pagu_escaped = isset($_GET['id_pagu']) ? escape_data($_GET['id_pagu']) : '';
    $thang_redirect = isset($_GET['thang']) ? htmlspecialchars(escape_data($_GET['thang'])) : '';

    $delete_dipa = mysql_query("DELETE FROM dipa WHERE id_pagu='$id_pagu_escaped'");
    $delete_realisasi = mysql_query("DELETE FROM realisasi WHERE id_pagu='$id_pagu_escaped'");
    $delete_pengembalian = mysql_query("DELETE FROM pengembalian WHERE id_pagu='$id_pagu_escaped'");

    if (!$delete_dipa) { die("Gagal menghapus data dari DIPA: " . mysql_error()); }
    if (!$delete_realisasi) { die("Gagal menghapus data dari realisasi: " . mysql_error()); }
    if (!$delete_pengembalian) { die("Gagal menghapus data dari pengembalian: " . mysql_error()); }

    ?><script language="JavaScript">;
     document.location='<?php print "../media.php?module=pagudipa&thang=" . $thang_redirect; ?>'</script><?php

} else if ($_GET['aksi'] == 'ubah') {
    $id_pagu_escaped = isset($_POST['id_pagu']) ? escape_data($_POST['id_pagu']) : '';
    $thang_escaped = isset($_POST['thang']) ? escape_data($_POST['thang']) : '';

    $update_dipa_query = "UPDATE dipa SET
                                kdwasgiat    = '" . escape_data($_POST['kdwasgiat']) . "',
                                thang        = '" . $thang_escaped . "',
                                kdkotama     = '" . escape_data($_POST['kdkotama']) . "',
                                kdsatker     = '" . escape_data($_POST['kdsatker']) . "',
                                kddept       = '" . escape_data($_POST['kddept']) . "',
                                kdunit       = '" . escape_data($_POST['kdunit']) . "',
                                kdfungsi     = '',
                                kdsfungsi    = '',
                                kdprogram    = '" . escape_data($_POST['kdprogram']) . "',
                                kdgiat       = '" . escape_data($_POST['kdgiat']) . "',
                                kdoutput     = '" . escape_data($_POST['kdoutput']) . "',
                                kdkusatker   = '" . escape_data($_POST['kdkusatker']) . "',
                                kdsa         = '" . escape_data($_POST['kdsa']) . "',
                                kdjd         = '" . escape_data($_POST['kdjd']) . "',
                                kdjenbel     = '" . $jenbel . "',
                                kdakun       = '" . escape_data($_POST['kdakun']) . "',
                                kdsakun      = '" . escape_data($_POST['kdsakun']) . "',
                                noitem       = '" . escape_data($_POST['noitem']) . "',
                                urutitem     = '" . escape_data($_POST['urutitem']) . "',
                                nmitem       = '" . escape_data($_POST['nmitem']) . "',
                                pagu         = '" . escape_data($_POST['pagu']) . "',
                                revisi       = '" . escape_data($_POST['revisi']) . "',
                                pagurevisi   = '" . escape_data($_POST['pagurevisi']) . "',
                                nmakun       = '" . escape_data($_POST['nmakun']) . "',
                                nmsakun      = '" . escape_data($_POST['nmsakun']) . "',
                                pengembalian = '0'
                           WHERE id_pagu  = '" . $id_pagu_escaped . "'";

    $update_dipa_result = mysql_query($update_dipa_query);

    if (!$update_dipa_result) { die("Gagal mengubah data DIPA: " . mysql_error() . "<br>Kueri: " . htmlspecialchars($update_dipa_query)); }

    $update_realisasi_query = "UPDATE realisasi SET
                                thang       = '" . $thang_escaped . "',
                                kdkotama    = '" . escape_data($_POST['kdkotama']) . "',
                                kdsatker    = '" . escape_data($_POST['kdsatker']) . "',
                                kdwasgiat   = '" . escape_data($_POST['kdwasgiat']) . "',
                                kdsa        = '" . escape_data($_POST['kdsa']) . "',
                                kdjd        = '" . escape_data($_POST['kdjd']) . "',
                                kdjenbel    = '" . $jenbel . "',
                                kdprogram   = '" . escape_data($_POST['kdprogram']) . "',
                                kdgiat      = '" . escape_data($_POST['kdgiat']) . "',
                                kdoutput    = '" . escape_data($_POST['kdoutput']) . "',
                                kdakun      = '" . escape_data($_POST['kdakun']) . "',
                                kdsakun     = '" . escape_data($_POST['kdsakun']) . "',
                                uraian      = '" . escape_data($_POST['nmitem']) . "'
                               WHERE id_pagu  = '" . $id_pagu_escaped . "'";

    $update_realisasi_result = mysql_query($update_realisasi_query);

    if (!$update_realisasi_result) { die("Gagal mengubah data realisasi: " . mysql_error() . "<br>Kueri: " . htmlspecialchars($update_realisasi_query)); }

    ?><script language="JavaScript">;
    document.location='<?php print "../media.php?module=pagudipa&thang=" . htmlspecialchars($thang_escaped); ?>'</script><?php

} else {
    print "Aksi tidak dikenal.";
}
?>