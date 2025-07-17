<?php 
//$con = mysqli_connect("localhost","DB_USER","DB_PASSWORD","DB_NAME");
mysql_connect("localhost","root","") or die("Koneksi gagal");
mysql_select_db("dblaplakgar2024") or die("Database tidak bisa dibuka");


if(isset($_POST['restore'])){
    $sql = '';
    $error = '';
    if (file_exists('Ktm_111023_074336_41.sql')) {
        // Deleting starts here
        $query_disable_checks = 'SET foreign_key_checks = 0';
        mysql_query($query_disable_checks);
        $show_query = 'Show tables';
        $query_result = mysql_query($show_query);
        $row = mysql_fetch_array($query_result);
        while ($row) {
            $query = 'DROP TABLE IF EXISTS ' . $row[0];
            $query_result = mysql_query($query);
            $show_query = 'Show tables';
            $query_result = mysql_query($show_query);
            $row = mysql_fetch_array($query_result);
        }
        $query_enable_checks = 'SET foreign_key_checks = 1';
        mysql_query($query_enable_checks);
        // Deleting ends here
        $lines = file('Ktm_111023_074336_41.sql.sql');
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $sql .= $line;
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysql_query($sql);
                if (! $result) {
                    $error .= mysql_error() . "\n";
                }
                $sql = '';
            }
        }
        if ($error) {
            $message = $error;
        } else {
            $message = "Database restored successfully";
        }
    }else{
        $message = "Uh Oh! No backup file found on the current directory!";
    }
}
?>