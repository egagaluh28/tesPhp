<?php
include "../application/connect.php";

$sql = "SELECT  a.kdsatker, a.kdprogram, a.kdgiat, a.kdoutput, a.kdakun, a.kdsakun, a.nmitem as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  b.realisasi
FROM dipa a 
left join (select id_pagu, sum(realisasi) as realisasi  from realisasi where kdbulan<='12'   and thang='2023' group by id_pagu) as b on a.id_pagu=b.id_pagu
where   a.thang='2023' group by a.id_pagu order by a.kdkotama, a.kdsatker";  
$setRec = mysql_query($sql);  
$columnHeader = '';  
$columnHeader = "KD SATKER" . "\t" . 
				"KD PROGRAM" . "\t" . 
				"KD GIAT" . "\t" . 
				"KD OUTPUT" . "\t" . 
				"KD AKUN" . "\t" . 
				"KD SUB AKUN" . "\t" . 
				"URAIAN" . "\t" . 
				"PAGU" . "\t" .
				"REVISI" . "\t" .
				"PAGU SETELAH REV" . "\t" .
				"REALISASI" . "\t";  
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