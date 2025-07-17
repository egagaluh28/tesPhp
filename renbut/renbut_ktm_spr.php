<?php
include "../application/connect.php";

$sql = "select z.kdsatker, z.kdakun, z.nmakun, z.jandes, z.gaji13, z.gaji14 from(select a.kdsatkr as display, a.kdsatkr as kdsatker, '' as kdakun, a.nmsatkr as nmakun, b.jandes, b.gaji13, b.gaji14 from t_satkr a 
left join (select kdkotama, kdsatker, sum(jandes) as jandes, sum(gaji13) as gaji13, sum(gaji14) as gaji14 from renbut where kdkotama='$_GET[kdkotama]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang)  as b on a.kdsatkr=b.kdsatker
where a.kdkotama='$_GET[kdkotama]'
union
select concat(a.kdsatker,a.kdakun) as display, '' as kdsatker, a.kdakun, a.nmakun, b.jandes, b.gaji13, b.gaji14 from t_akun_gaji_satker a 
left join (select * from renbut where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' ) as b on a.kdsatker=b.kdsatker and a.kdakun=b.kdakun where a.kdkotama='$_GET[kdkotama]'
order by display) as z";  
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
header("Content-Disposition: attachment; filename=Renbut_Gaji_Tunkin_Ktm.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?> 