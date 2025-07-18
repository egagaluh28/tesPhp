<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
    </head>
    <body>

    <br><center><span class='judulcontent'>DATA USER</span></center><br>

        <?php
        // Mulai sesi jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // --- Bagian Koneksi Database ---
        // Include file koneksi.php. Ini akan mencoba membuat koneksi database.
        include "application/connect.php";

        // Cek apakah koneksi berhasil (berdasarkan variabel $conn_status_ok dari connect.php)
        // Seharusnya `die()` di `connect.php` sudah menangani kegagalan koneksi utama,
        // tapi ini adalah pengecekan tambahan jika ada masalah lain setelah include.
        if (!isset($conn_status_ok) || !$conn_status_ok) {
            die("Error: Koneksi database belum terjalin atau gagal di pagu.php. Periksa file application/connect.php dan status database Anda.");
        }
        // --- Akhir Bagian Koneksi Database ---


        include "library/indotgl_angka.php";

        // Menggunakan mysql_real_escape_string (meskipun deprecated, ini sesuai permintaan Anda)
        $thang_escaped = isset($_GET['thang']) ? mysql_real_escape_string($_GET['thang']) : '';
        $session_kdkotama = isset($_SESSION['kdkotama']) ? mysql_real_escape_string($_SESSION['kdkotama']) : '';
        $session_kdsatker = isset($_SESSION['kdsatker']) ? mysql_real_escape_string($_SESSION['kdsatker']) : '';

        echo "<br><table width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>PEREKAMAN DATA DIPA PETIKAN SATKER TA " . htmlspecialchars($thang_escaped) . "</td></tr></table>";

        // Kueri SQL dengan perbaikan GROUP BY
        $query_sql = "
        SELECT
            '' as id_pagu,
            '' as kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            '' as kode,
            '1' as display,
            'RUPIAH MURNI' as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            '' as id_pagu,
            a.kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            concat('012.','22.',a.kdprogram) as kode,
            concat('1',a.kdprogram) as display,
            b.nmprogram as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        LEFT JOIN t_program b ON a.kdprogram=b.kdprogram
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdprogram, b.nmprogram, a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            '' as id_pagu,
            a.kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            a.kdgiat as kode,
            concat('1',a.kdprogram,a.kdgiat) as display,
            b.nmgiat as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        LEFT JOIN t_giat b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdprogram, a.kdgiat, b.nmgiat, a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            '' as id_pagu,
            a.kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            a.kdoutput as kode,
            concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display,
            b.nmoutput as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        LEFT JOIN t_output b ON a.kdprogram=b.kdprogram AND a.kdgiat=b.kdgiat AND a.kdoutput=b.kdoutput
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdprogram, a.kdgiat, a.kdoutput, b.nmoutput, a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            '' as id_pagu,
            '' as kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            a.kdakun as kode,
            concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display,
            a.nmakun as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdprogram, a.kdgiat, a.kdoutput, a.kdakun, a.nmakun, a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            '' as id_pagu,
            a.kdprogram,
            MAX(a.kdwasgiat) as kdwasgiat,
            '' as nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            a.kdakun as kode,
            concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display,
            concat('> ',a.nmsakun) as uraian,
            sum(a.pagu) as pagu,
            sum(a.revisi) as revisi,
            sum(a.pagurevisi) as pagurevisi
        FROM dipa a
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.kdprogram, a.kdgiat, a.kdoutput, a.kdakun, a.kdsakun, a.nmsakun, a.kdkotama, a.kdsatker, a.thang

        UNION ALL

        SELECT
            a.id_pagu,
            a.kdprogram,
            a.kdwasgiat,
            b.nmwasgiat,
            a.kdkotama,
            a.kdsatker,
            a.thang,
            '' as kode,
            concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display,
            concat('-',' ', a.nmitem) as uraian,
            a.pagu,
            a.revisi,
            a.pagurevisi
        FROM dipa a
        LEFT JOIN t_wasgiat b ON a.kdwasgiat=b.kdwasgiat
        WHERE a.kdkotama='$session_kdkotama' AND a.kdsatker='$session_kdsatker' AND a.thang='$thang_escaped'
        GROUP BY a.id_pagu, a.kdprogram, a.kdwasgiat, b.nmwasgiat, a.kdkotama, a.kdsatker, a.thang, a.urutitem, a.nmitem, a.pagu, a.revisi, a.pagurevisi
        ";
        // Final ORDER BY untuk seluruh UNION
        $final_query = $query_sql . " ORDER BY display";

        // Eksekusi kueri menggunakan mysql_query
        $ok = mysql_query($final_query);
        if (!$ok) {
            die('Kueri utama gagal (pagu.php): ' . mysql_error()); // Menampilkan error MySQL spesifik
        }

        echo "<table width='90%' align='center'><tr><td><a href='media.php?module=inputpagudipa&kdkotama=".htmlspecialchars($session_kdkotama)."&kdsatker=".htmlspecialchars($session_kdsatker)."&thang=".htmlspecialchars($thang_escaped)."' style='text-decoration:none'><div class='codehim-tombol-biru'><input type='button' value='Tambah Data' ></div></td></tr></table><br>";

        echo "<table width='90%' align='center' class='bordered'>";
        echo "<tr height='40' >";
        echo     "<th align='center'>NO</th>";
        echo     "<th align='center'>URAIAN</th>";
        echo     "<th align='center' width='30'>KODE PROGRAM</th>";
        echo     "<th align='center' width='125'>PAGU</th>";
        echo     "<th align='center' width='125'>REVISI (+/-)</th>";
        echo     "<th align='center' width='125'>PAGU STLH REVISI</th>";
        echo     "<th align='center' width='100'>WASGIAT</th>";
        echo     "<th colspan='2' align='center' valign='middle' >AKSI</th>";
        echo "</tr>";

        // Ambil hasil kueri menggunakan mysql_fetch_array
        while($k = mysql_fetch_array($ok)){

            $pagu_val = isset($k['pagu']) ? $k['pagu'] : 0;
            $revisi_val = isset($k['revisi']) ? $k['revisi'] : 0;
            $pagurevisi_val = isset($k['pagurevisi']) ? $k['pagurevisi'] : 0;
            $uraian_val = isset($k['uraian']) ? $k['uraian'] : '';
            $kode_val = isset($k['kode']) ? $k['kode'] : '';
            $nmwasgiat_val = isset($k['nmwasgiat']) ? $k['nmwasgiat'] : '';
            $id_pagu_val = isset($k['id_pagu']) ? $k['id_pagu'] : '';
            $thang_k_val = isset($k['thang']) ? $k['thang'] : '';
            $display_val = isset($k['display']) ? $k['display'] : '';

            $pagu   = number_format($pagu_val,0,',','.');
            $revisi = number_format($revisi_val,0,',','.');
            $hasil  = number_format($pagurevisi_val,0,',','.');

            $uraian = strtoupper($uraian_val);

            $str = $display_val;
            $pj = strlen($str);

            if ($pj == '19') { echo "<tr bgcolor='#fcfcc0'>"; } else { echo "<tr>"; }

            echo "<td valign='top'>";
            if ($pj == '1') {
                $romawi_char = '';
                if ($romawi_counter == 1) $romawi_char = 'A';
                else if ($romawi_counter == 2) $romawi_char = 'B';
                else if ($romawi_counter == 3) $romawi_char = 'C';
                else if ($romawi_counter == 4) $romawi_char = 'D';
                else if ($romawi_counter == 5) $romawi_char = 'E';
                else $romawi_char = 'F';
                echo "<b>".$romawi_char.".</b>";
                $romawi_counter++;
                $no = 1;
                $abjad_counter = 1;
                $nomor_counter = 1;
            } else if ($pj == '3') {
                echo "&nbsp;&nbsp;<b>".$no.".</b>";
                $no++;
                $abjad_counter = 1;
                $nomor_counter = 1;
            } else if ($pj == '7') {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>".chr(ord('a') + ($abjad_counter - 1)).".</b>";
                $abjad_counter++;
                $nomor_counter = 1;
            } else if ($pj == '10') {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$nomor_counter.")</b>";
                $nomor_counter++;
            } else {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            echo "</td>";

            echo "<td valign='top'>";
            if ($pj == '1') echo "<b>".htmlspecialchars($uraian)."</b>";
            else if ($pj == '3') echo "<b>".htmlspecialchars($uraian)."</b>";
            else if ($pj == '7') echo "<b>".htmlspecialchars($uraian)."</b>";
            else if ($pj == '10') echo "<b>".htmlspecialchars($uraian)."</b>";
            else if ($pj == '16') echo "<b>".htmlspecialchars($uraian)."</b>";
            else if ($pj == '19') echo "<i>".htmlspecialchars($uraian)."</i>";
            else echo htmlspecialchars($uraian);
            echo "</td>";

            echo "<td valign='top' align='right'>";
            echo htmlspecialchars($kode_val);
            echo "</td>";

            echo "<td valign='top' align='right'>";
            echo $pagu;
            echo "</td>";

            echo "<td valign='top' align='right'>";
            echo $revisi;
            echo "</td>";

            echo "<td valign='top' align='right'>";
            echo $hasil;
            echo "</td>";

            echo "<td valign='top' >";
            echo htmlspecialchars($nmwasgiat_val);
            echo "</td>";

            echo "<td colspan='2' align='center'>";
            if ($pj == '19' ) {
                echo "<a href='media.php?module=editpagudipa&id_pagu=".htmlspecialchars($id_pagu_val)."&thang=".htmlspecialchars($thang_k_val)."' data-tooltip='Edit Pagu' data-position='top' class='top'><img src='images/edit.png' width='20' ></a>";
                echo "&nbsp;&nbsp;";
                echo "<a href=\"pagu/proses.php?aksi=hapus&id_pagu=".htmlspecialchars($id_pagu_val)."&thang=".htmlspecialchars($thang_k_val)."\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS ~ ".htmlspecialchars($uraian_val)." ~? ')\" data-tooltip='Hapus Pagu' data-position='top' class='top'><img src='images/delete.png' width='20' ></a>";// No change needed here, this line is already correct for deletion.
            }
            else if ($pj == '16' || $pj == '10' || $pj == '7' || $pj == '3' ) {
                echo "<a href='media.php?module=rekamdetaildipa&kdprogram=".(isset($k['kdprogram']) ? htmlspecialchars($k['kdprogram']) : '')."&kdgiat=".(isset($k['kdgiat']) ? htmlspecialchars($k['kdgiat']) : '')."&kdoutput=".(isset($k['kdoutput']) ? htmlspecialchars($k['kdoutput']) : '')."&kdakun=".(isset($k['kdakun']) ? htmlspecialchars($k['kdakun']) : '')."&kdsakun=".(isset($k['kdsakun']) ? htmlspecialchars($k['kdsakun']) : '')."&kdkotama=".htmlspecialchars($session_kdkotama)."&kdsatker=".htmlspecialchars($session_kdsatker)."&thang=".htmlspecialchars($thang_escaped)."' data-tooltip='Tambah Uraian' data-position='top' class='top'><img src='images/add.png' width='20' ></a>";
                echo "&nbsp;&nbsp;";
            }
            else {
                echo "&nbsp;";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
        ?>
        <br></span></center><br>
    </body>
</html>