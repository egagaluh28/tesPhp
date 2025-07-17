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
   
	 $sql= mysql_query("select a.kdakun, a.nmakun, b.aidi, b.kdkotama, b.kdsatker, b.thang, b.jandes, b.gaji13, b.gaji14, b.ket
from t_akun_gaji a 
left join (select * from renbut where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]') as b on a.kdakun=b.kdakun order by a.kdakun"); 



$indbul=$bulan.' '.$_GET[thang];
$sasi = substr($bulan,3,30);


	
$pdf->Ln(10); 
// header
$pdf->SetY(40);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,'RENCANA KEBUTUHAN GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA TA '.$_GET[thang],0,1,'C'); 

//$pdf->SetY(42); 
//$pdf->SetX(8); 
//$pdf->Cell(0,5,'',0,1,'C');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',11);
$pdf->SetY(55); 
$pdf->SetX(12); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(22); 
$pdf->Cell(20,6,'KODE','LRT',0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(22); 
$pdf->Cell(20,6,'SATKER','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(42); 
$pdf->Cell(20,12,'AKUN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(62);
$pdf->Cell(80,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(142);
$pdf->Cell(102,6,'RENCANA KEBUTUHAN TA '.' '.$_GET[thang],1,0,'C',0); 

 

$pdf->SetY(61); 
$pdf->SetX(142);
$pdf->Cell(38,6,'JAN S.D. DES',1,0,'C',0); 

$pdf->SetY(61); 
$pdf->SetX(180);
$pdf->Cell(32,6,'GAJI 13',1,0,'C',0); 

$pdf->SetY(61); 
$pdf->SetX(212);
$pdf->Cell(32,6,'GAJI 14',1,0,'C',0); 


$pdf->SetY(55); 
$pdf->SetX(244);
$pdf->Cell(38,6,'JUMLAH','LRT',0,'C',0);

$pdf->SetY(61); 
$pdf->SetX(244);
$pdf->Cell(38,6,'(5+6+7)','LRB',0,'C',0);

$pdf->SetY(55); 
$pdf->SetX(282);
$pdf->Cell(10,12,'KET',1,0,'C',0); 




$pdf->Ln(12);
$pdf->SetX(12); 
$pdf->Cell(10,6,'1',1,0,'C',0); 
$pdf->Cell(20,6,'2',1,0,'C',0); 
$pdf->Cell(20,6,'3',1,0,'C',0); 
$pdf->Cell(80,6,'4',1,0,'C',0);
$pdf->Cell(38,6,'5',1,0,'C',0); 
$pdf->Cell(32,6,'6',1,0,'C',0);
$pdf->Cell(32,6,'7',1,0,'C',0);
$pdf->Cell(38,6,'8',1,0,'C',0);
$pdf->Cell(10,6,'9',1,0,'C',0);

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
$pdf->SetX(12); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(22); 
$pdf->Cell(20,6,'KODE','LRT',0,'C',1); 

$pdf->SetY(24); 
$pdf->SetX(22); 
$pdf->Cell(20,6,'SATKER','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(42); 
$pdf->Cell(20,12,'AKUN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(62);
$pdf->Cell(80,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(142);
$pdf->Cell(102,6,'RENCANA KEBUTUHAN TA '.' '.$_GET[thang],1,0,'C',0); 

 

$pdf->SetY(24); 
$pdf->SetX(142);
$pdf->Cell(38,6,'JAN S.D. DES',1,0,'C',0); 

$pdf->SetY(24); 
$pdf->SetX(180);
$pdf->Cell(32,6,'GAJI 13',1,0,'C',0); 

$pdf->SetY(24); 
$pdf->SetX(212);
$pdf->Cell(32,6,'GAJI 14',1,0,'C',0); 


$pdf->SetY(18); 
$pdf->SetX(244);
$pdf->Cell(38,6,'JUMLAH','LRT',0,'C',0);

$pdf->SetY(24); 
$pdf->SetX(244);
$pdf->Cell(38,6,'(5+6+7)','LRB',0,'C',0);

$pdf->SetY(18); 
$pdf->SetX(282);
$pdf->Cell(10,12,'KET',1,0,'C',0); 
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',11);
    $pdf->SetY(30); 
    $pdf->SetX(12); 
$pdf->Cell(10,6,'1',1,0,'C',0); 
$pdf->Cell(20,6,'2',1,0,'C',0); 
$pdf->Cell(20,6,'3',1,0,'C',0); 
$pdf->Cell(80,6,'4',1,0,'C',0);
$pdf->Cell(38,6,'5',1,0,'C',0); 
$pdf->Cell(32,6,'6',1,0,'C',0);
$pdf->Cell(32,6,'7',1,0,'C',0);
$pdf->Cell(38,6,'8',1,0,'C',0);
$pdf->Cell(10,6,'9',1,0,'C',0);
	

   //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln(6.2);
  } 

	$jandes	 = number_format($row[jandes],0,',','.');
	$g13  = number_format($row[gaji13],0,',','.');
	$g14  = number_format($row[gaji14],0,',','.');
	
	
	
	
	$jmlx = $row[jandes] + $row[gaji13] + $row[gaji14];
	$jml  = number_format($jmlx,0,',','.');
	
	$jtotx += $jmlx;
	$jtot  = number_format($jtotx,0,',','.');
	
	$jjandesx += $row[jandes];
	$jjandes	 = number_format($jjandesx,0,',','.');
	
	$jg13x += $row[gaji13];
	$jg13	 = number_format($jg13x,0,',','.');
	
	$jg14x += $row[gaji14];
	$jg14	 = number_format($jg14x,0,',','.');
	
	

	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetFont('Arial','',11);
		$pdf->SetX(12); 
		$ng = $pdf->GetY(); 
	    $pdf->Cell(10,6,$no,'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(22);
		if ($row[kdakun]=='511161') {
		$pdf->Cell(20,6,$row[kdsatker],'LR',1,'C',2);
		} else {
		$pdf->Cell(20,6,'','LR',1,'C',2);
		}	
		$pdf->SetY($ng);
		$pdf->SetX(42);
		$pdf->Cell(20,6,$row[kdakun],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(62);
		$pdf->Cell(80,6,$row[nmakun],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(142);
		$pdf->Cell(38,6,$jandes,'LR',1,'R',2);
		
	    
		$pdf->SetY($ng);
		$pdf->SetX(180);
		$pdf->Cell(32,6,$g13,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(212);
		$pdf->Cell(32,6,$g14,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(244);
		$pdf->Cell(38,6,$jml,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(282);
		$pdf->Cell(10,6,'','LR',1,'R',2); 
		
		
		
	
	$i++;
	$no++;
		
	}
		
		
	 

	$ng = $pdf->GetY(); 
    $pdf->SetX(12); 
	$pdf->SetFont('Arial','B',11);
    $pdf->Cell(10,6,'',1,0,'C',1); 
	$pdf->Cell(120,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(38,6,$jjandes,1,0,'R',1);
	$pdf->Cell(32,6,$jg13,1,0,'R',1);
	$pdf->Cell(32,6,$jg14,1,0,'R',1);
	$pdf->Cell(38,6,$jtot,1,0,'R',1);
	$pdf->Cell(10,6,'',1,0,'C',1);


	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'  and thang='$thang' order by kdbulan limit 1"); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('Arial','',11);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');
$pdf->Ln(10);	
//$pdf->SetY($ng);
$pdf->SetX(190); 
$pdf->Cell(0,6,$row['an'],0,1,'C');
$pdf->Ln(-1);
$pdf->SetX(190); 
$pdf->Cell(0,6,$row['pejabat1'],0,1,'C');
$pdf->Ln(8);
$pdf->SetX(190); 
$pdf->Cell(0,6,$row['nama'],0,1,'C');
$pdf->Ln(-1);
$pdf->SetX(190); 
$pdf->Cell(0,6,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
