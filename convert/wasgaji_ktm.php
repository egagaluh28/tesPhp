<?php
include "../application/connect.php";


error_reporting(E_ALL);

require_once 'plugins/PHPExcel.php';

ini_set("memory_limit", -1);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="select x.kdakun, x.nmakun, z.thang, z.kdkotama, z.kdsatker, z.pagurevisi, z.jan, z.feb, z.mar, z.apr, z.mei, z.jun, z.jul, z.agu, z.sep, z.okt, z.nop, z.des
from t_akun_gaji x
left join (SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
FROM dipa a 
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jan from realisasi where kdbulan='01' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as d on a.kdakun=d.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as feb from realisasi where kdbulan='02' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as e on a.kdakun=e.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mar from realisasi where kdbulan='03' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as f on a.kdakun=f.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as apr from realisasi where kdbulan='04' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as g on a.kdakun=g.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mei from realisasi where kdbulan='05' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as h on a.kdakun=h.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jun from realisasi where kdbulan='06' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as i on a.kdakun=i.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jul from realisasi where kdbulan='07' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as j on a.kdakun=j.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as agu from realisasi where kdbulan='08' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as k on a.kdakun=k.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as sep from realisasi where kdbulan='09' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as l on a.kdakun=l.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as okt from realisasi where kdbulan='10' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as m on a.kdakun=m.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as nop from realisasi where kdbulan='11' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as n on a.kdakun=n.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as des from realisasi where kdbulan='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  group by kdakun) as o on a.kdakun=o.kdakun  
where  a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' 
group by   a.kdakun order by  a.kdakun) as z on x.kdakun=z.kdakun group by x.kdakun";
$hasil = mysql_query($query);

/* Set properties
$objPHPExcel->getProperties()->setCreator("Candra Adi Putra")
      ->setLastModifiedBy("Candra Adi Putra")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan transaksi .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("UMR 2013");
*/ 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'NO')
       ->setCellValue('B1', 'AKUN')
       ->setCellValue('C1', 'URAIAN')
	   ->setCellValue('D1', 'DIPA 2022')
       ->setCellValue('E1', 'JANUARI')
       ->setCellValue('F1', 'FEBRUARI')
	   ->setCellValue('G1', 'MARET')
	   ->setCellValue('H1', 'APRIL')
       ->setCellValue('I1', 'MEI')
	   ->setCellValue('J1', 'JUNI')
       ->setCellValue('K1', 'JULI')
       ->setCellValue('L1', 'AGUSTUS')
	   ->setCellValue('M1', 'SEPTEMBER')
	   ->setCellValue('N1', 'OKTOBER')
       ->setCellValue('O1', 'NOVEMBER')
	   ->setCellValue('P1', 'DESEMBER')
	   ->setCellValue('Q1', 'JUMLAH')
       ->setCellValue('R1', '%')
	   ->setCellValue('S1', 'SISA')
       ->setCellValue('C40', 'JUMLAH');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
	
	$tarik = $row['jan'] + $row['feb'] + $row['mar'] + $row['apr'] + $row['mei'] + $row['jun'] + $row['jul'] + $row['agu'] + $row['sep'] + $row['okt'] + $row['nop'] + $row['des'];
	
	$sisax = $row['pagurevisi'] - $tarik;
	
	if (($row['pagurevisi']=='') or ($row['pagurevisi']=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($tarik/$row['pagurevisi'])*100);
	}
	

	
	
	

$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $no)
     ->setCellValue("B$baris", $row['kdakun'])
     ->setCellValue("C$baris", $row['nmakun'])
	 ->setCellValue("D$baris", $row['pagurevisi'])
	 ->setCellValue("E$baris", $row['jan'])
     ->setCellValue("F$baris", $row['feb'])
	 ->setCellValue("G$baris", $row['mar'])
     ->setCellValue("H$baris", $row['apr'])
     ->setCellValue("I$baris", $row['mei'])
     ->setCellValue("J$baris", $row['jun'])
	 ->setCellValue("K$baris", $row['jul'])
	 ->setCellValue("L$baris", $row['agu'])
	 ->setCellValue("M$baris", $row['sep'])
     ->setCellValue("N$baris", $row['okt'])
	 ->setCellValue("O$baris", $row['nop'])
	 ->setCellValue("P$baris", $row['des'])
	 ->setCellValue("Q$baris", $tarik)
	 ->setCellValue("R$baris", $prosen)
	 ->setCellValue("S$baris", $sisax);
$baris = $baris + 1;
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('realisasi_gaji');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="wasgaji.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 