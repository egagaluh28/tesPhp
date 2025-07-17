<?php 

include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm','A4');
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();
// KOP

$rowop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($rowop);

$thang = $_GET[thang] - 1;

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'   and thang='$thang' order by kdbulan limit 1"); 
$z = mysql_fetch_array($lamp);
	
$rowop=$x[panjang_kop];
$grs=$x[panjang_grs];

$garis=$z[panjang_grs];
$posisi=$z[posisi_grs];

$pdf->Sety(18); 
$pdf->SetX(12); 
$pdf->Cell($rowop+10,5,$x[kop1],0,1,'C');
$pdf->SetX(12); 
$pdf->Cell($rowop+10,5,$x[kop2],0,1,'C');
$pdf->SetX(12); 
$pdf->Cell($grs+10,0,'                             ',0,0,'C',1); 



$pdf->SetFillColor(255,255,255);
$pdf->Sety(18); 
$pdf->SetX(246); 
$pdf->Cell(40,5,$z[brs1],0,0,'R',1);

$pdf->Sety(23); 
$pdf->SetX(246); 
$pdf->Cell(40,5,$z[brs2],0,0,'R',1);
$pdf->Sety(28); 
$pdf->SetX(246); 
$pdf->Cell(40,5,$z[brs3],0,0,'R',1);
$pdf->Sety(33); 





$pdf->SetFont('Arial','',11);
$pdf->Sety(18); 
$pdf->SetX($posisi-10); 
$pdf->Cell(10,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi-10); 
$pdf->Cell(10,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi-10); 
$pdf->Cell(10,5,'Tanggal',0,0,'L',1);

$pdf->Sety(33); 
$pdf->SetX($posisi-8);
$pdf->Cell($garis+9,0,'                             ','T',0,'C',1);
   
	 $sql= mysql_query("select x.kdakun, x.nmakun, z.thang, z.kdkotama, z.kdsatker, z.pagurevisi, z.penarikan
from t_akun_gaji x
left join (SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by kdakun order by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by a.kdakun)
as z on x.kdakun=z.kdakun group by x.kdakun"); 
	
switch ($_GET[kdbulan]) {
case "01" : $bulan="31 JANUARI";break;
case "02" : $bulan="28 FEBRUARI";break;
case "03" : $bulan="31 MARET";break;
case "04" : $bulan="30 APRIL";break;
case "05" : $bulan="31 MEI";break;
case "06" : $bulan="30 JUNI";break;
case "07" : $bulan="31 JULI";break;
case "08" : $bulan="31 AGUSTUS";break;
case "09" : $bulan="30 SEPTEMBER"; break;
case "10" : $bulan="31 OKTOBER";break;
case "11" : $bulan="30 NOVEMBER";break;
case "12" : $bulan="31 DESEMBER";break;
}


$indbul=$bulan.' '.$_GET[thang];
$sasi = substr($bulan,3,30);


	
$pdf->Ln(10); 
// header
$pdf->SetY(37);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,'LAPORAN PENGAWASAN GAJI DAN TUNJANGAN KINERJA',0,1,'C'); 

$pdf->SetY(42); 
$pdf->SetX(8); 
$pdf->Cell(0,5,'PERIODE 1 JANUARI S.D '. $indbul,0,1,'C');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',11);
$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(25); 
$pdf->Cell(20,12,'AKUN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(45);
$pdf->Cell(100,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(145);
$pdf->Cell(38,12,'DIPA TA'.' '.$_GET[thang],1,0,'C',0); 

$pdf->SetY(55); 
$pdf->SetX(183);
$pdf->Cell(38,6,'PENARIKAN S.D','LRT',0,'C',0); 
$pdf->SetY(61); 
$pdf->SetX(183);
$pdf->Cell(38,6,$sasi.' '.$_GET[thang],'LRB',0,'C',0); 

$pdf->SetY(55); 
$pdf->SetX(221);
$pdf->Cell(18,6,'%','LRT',0,'C',0); 
$pdf->SetY(61); 
$pdf->SetX(221);
$pdf->Cell(18,6,'5/4','LRB',0,'C',0); 

$pdf->SetY(55); 
$pdf->SetX(239);
$pdf->Cell(38,6,'SISA','LRT',0,'C',0); 
$pdf->SetY(61); 
$pdf->SetX(239);
$pdf->Cell(38,6,'(4-5)','LRB',0,'C',0); 


$pdf->SetY(55); 
$pdf->SetX(277);
$pdf->Cell(12,12,'KET',1,0,'C',0); 




$pdf->Ln(12);
$pdf->SetX(15); 
$pdf->Cell(10,6,'1',1,0,'C',0); 
$pdf->Cell(20,6,'2',1,0,'C',0); 
$pdf->Cell(100,6,'3',1,0,'C',0);
$pdf->Cell(38,6,'4',1,0,'C',0); 
$pdf->Cell(38,6,'5',1,0,'C',0);
$pdf->Cell(18,6,'6',1,0,'C',0);
$pdf->Cell(38,6,'7',1,0,'C',0);
$pdf->Cell(12,6,'8',1,0,'C',0);

/*
$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,1,'','LRT',0,'C',1); 
$pdf->Cell(78,1,'','LRT',0,'C',1); 
$pdf->Cell(11,1,'','LRT',0,'C',1);
$pdf->Cell(30,1,'','LRT',0,'C',1); 
$pdf->Cell(28,1,'','LRT',0,'C',1);
$pdf->Cell(30,1,'','LRT',0,'C',1);
$pdf->Cell(30,1,'','LRT',0,'C',1);
$pdf->Cell(28,1,'','LRT',0,'C',1);
$pdf->Cell(30,1,'','LRT',0,'C',1);
$pdf->Cell(30,1,'','LRT',0,'C',1);
$pdf->Cell(8.5,1,'','LRT',0,'C',1);
$pdf->Cell(7,1,'','LRT',0,'C',1);
*/
$pdf->Ln(6.2);

$hal=1;

$i = 0; 
$no=1;


//Set maximum rows per page
//$max = 18;
//Set Row Height
$row_height = 6;
// data
while($row = mysql_fetch_array($sql)) {

  
    if (($hal) == '1') {   
     $max=20;
   } else {	 $max=21; }
 

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   $pdf->SetFont('Arial','',11);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
   
   $pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',11);
$pdf->SetY(18); 
$pdf->SetX(15); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(25); 
$pdf->Cell(20,12,'AKUN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(45);
$pdf->Cell(100,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(145);
$pdf->Cell(38,12,'DIPA TA'.' '.$_GET[thang],1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(183);
$pdf->Cell(38,6,'PENARIKAN S.D','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(183);
$pdf->Cell(38,6,$sasi.' '.$_GET[thang],'LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(221);
$pdf->Cell(18,6,'%','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(221);
$pdf->Cell(18,6,'5/4','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(239);
$pdf->Cell(38,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(239);
$pdf->Cell(38,6,'(4-5)','LRB',0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(277);
$pdf->Cell(12,12,'KET',1,0,'C',1); 
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',11);
    $pdf->SetY(30); 
    $pdf->SetX(15); 
    $pdf->Cell(10,6,'1',1,0,'C',1); 
	$pdf->Cell(20,6,'2',1,0,'C',1); 
	$pdf->Cell(100,6,'3',1,0,'C',1);
	$pdf->Cell(38,6,'4',1,0,'C',1); 
	$pdf->Cell(38,6,'5',1,0,'C',1);
	$pdf->Cell(18,6,'6',1,0,'C',1);
	$pdf->Cell(38,6,'7',1,0,'C',1);
	$pdf->Cell(12,6,'8',1,0,'C',1);
	

   //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln(6.2);
  } 

	$hasil	 = number_format($row[pagurevisi],0,',','.');
	$hasil1  = number_format($row[penarikan],0,',','.');
	
	$turahan = $row[pagurevisi] - $row[penarikan];
	$sisa  = number_format($turahan,0,',','.');
	
	if (($row[pagurevisi]=='') or ($row[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($row[penarikan]/$row[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	//$prosen_des0	= number_format($prosen,0,',','.');

	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetFont('Arial','',11);
		$pdf->SetX(15); 
		$ng = $pdf->GetY(); 
	    $pdf->Cell(10,6,$no,'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(25);
		$pdf->Cell(20,6,$row[kdakun],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(45);
		$pdf->Cell(100,6,$row[nmakun],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(145);
		$pdf->Cell(38,6,$hasil,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(183);
		$pdf->Cell(38,6,$hasil1,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(221);	
		
		//if ($prosen>='100') {		
		//$pdf->Cell(18,6,$prosen_des0,'LR',1,'C',2); 
		//} else {
		$pdf->Cell(18,6,$prosen_des,'LR',1,'C',2);	
		//}
	    
		$pdf->SetY($ng);
		$pdf->SetX(239);
		$pdf->Cell(38,6,$sisa,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(277);
		$pdf->Cell(12,6,'','LR',1,'R',2); 
		
	
	$i++;
	$no++;
		
	}
		
		
		


//spasi
/*
    $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
    $pdf->Cell(7,2,'','LRB',0,'C',1); 
	$pdf->Cell(78,2,'','LRB',0,'C',1); 
	$pdf->Cell(11,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1); 
	$pdf->Cell(28,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(28,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(8.5,2,'','LRB',0,'C',1);
	$pdf->Cell(7,2,'','LRB',0,'C',1);
*/	
$jml=mysql_query("select z.kdkotama, z.kdsatker, z.thang, sum(z.pagurevisi) as pagurevisi , sum(z.penarikan) as penarikan from(SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagurevisi) as pagurevisi, c.penarikan
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdkotama, kdsatker, thang, sum(realisasi) as penarikan from  realisasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.kdakun in ('511161', '511169', '511171', '511172', '511173', '511174', '511175', '511176', '511179', '511185', 
'511189', '511191', '511192', '511193', '511194', '511195', '511211', '511219', '511221', '511222',
'511223', '511224', '511225', '511226', '511227', '511228', '511232', '511233', '511234', '511235',
'511236', '511237', '511238', '511239', '511241', '511242', '511243', '511244', '511245','512211','512411','511619', '511611', '511621', '511622', '511623', '511624', '511625', '511626', '511627', '511628','511629', '511630', '511631', '511632','511633', '512414') group by a.kdakun) as z where z.kdkotama='$_GET[kdkotama]' and z.kdsatker='$_GET[kdsatker]' and z.thang='$_GET[thang]'"); 
$x = mysql_fetch_array($jml);	

		$hasilx	 = number_format($x[pagurevisi],0,',','.');
	    $hasil1x  = number_format($x[penarikan],0,',','.');
	
	    $turahanx = $x[pagurevisi] - $x[penarikan];
	    $sisax  = number_format($turahanx,0,',','.');
	
		$prosenx 	= (($x[penarikan]/$x[pagurevisi])*100);
		$prosen_desx  = number_format($prosenx,2,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(15); 
	$pdf->SetFont('Arial','B',11);
    $pdf->Cell(10,6,'',1,0,'C',1); 
	$pdf->Cell(120,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(38,6,$hasilx,1,0,'R',1);
	$pdf->Cell(38,6,$hasil1x,1,0,'R',1);
	$pdf->Cell(18,6,$prosen_desx,1,0,'C',1);
	$pdf->Cell(38,6,$sisax,1,0,'R',1);
	$pdf->Cell(12,6,'',1,0,'C',1);

	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'  and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('Arial','',11);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');

$pdf->SetY($ng);
$pdf->SetX(190); 
$pdf->Cell(0,20,$row['an'],0,1,'C');
$pdf->SetY($ng);
$pdf->SetX(190); 
$pdf->Cell(0,30,$row['pejabat1'],0,1,'C');
$pdf->SetY($ng);
$pdf->SetX(190); 
$pdf->Cell(0,60,$row['nama'],0,1,'C');
$pdf->SetY($ng);
$pdf->SetX(190); 
$pdf->Cell(0,70,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
