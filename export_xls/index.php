<?php
mysql_connect("localhost","root","") or die("Koneksi gagal");
mysql_select_db("dblaplakgar2024") or die("Database tidak bisa dibuka");


$sql = "select b.kdsatker, a.kdakun, a.nmakun,    b.jandes, b.gaji13, b.gaji14, b.ket
from t_akun_gaji a 
left join (select * from renbut where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]') as b on a.kdakun=b.kdakun order by a.kdakun";  
$setRec = mysql_query($sql);  
$columnHeader = '';  
$columnHeader = "KD SATKER" . "\t" . 
				"KD AKUN" . "\t" . 
				"URAIAN" . "\t" . 
				"JAN - DES" . "\t" .
				"GAJI 13" . "\t" .
				"GAJI 14" . "\t" .
				"KET" . "\t";  
$setData = '';  
  while ($rec = mysql_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?> 