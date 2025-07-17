<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm',array(215, 330));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
// KOP

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($kop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$z = mysql_fetch_array($lamp);
	
$kop=$x[panjang_kop];
$grs=$x[panjang_grs];

$garis=$z[panjang_grs];
$posisi=$z[posisi_grs];

$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($kop,5,$x[kop2],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($grs,0,'                             ',0,0,'C',1); 


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);
$pdf->Sety(18); 
$pdf->SetX($posisi+40); 
$pdf->Cell(40,5,'Lampiran'.' '.$_POST['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi+40); 
$pdf->Cell(40,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi+40); 
$pdf->Cell(40,5,'Tanggal',0,0,'L',1);


$pdf->Sety(18); 
$pdf->SetX(285); 
$pdf->Cell(40,5,$z[brs1],0,0,'R',1);

$pdf->Sety(23); 
$pdf->SetX(285); 
$pdf->Cell(40,5,$z[brs2],0,0,'R',1);
$pdf->Sety(28); 
$pdf->SetX(285); 
$pdf->Cell(40,5,$z[brs3],0,0,'R',1);
$pdf->Sety(33); 

$pdf->Sety(33); 
$pdf->SetX($posisi+41);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);


   
	 $sql= mysql_query("SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.blnlalu, d.blnini
FROM dipa a 
left join (select a.kdgiat, a.kdoutput, a.kdakun, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdakun) as c on  a.kdakun=c.kdakun
left join (select a.kdgiat, a.kdoutput, a.kdakun, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and 
a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdakun) as d on a.kdakun=d.kdakun
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and substr(a.kdakun,1,3)='511'
group by   a.kdakun order by a.kdakun"); 
	


switch ($_GET[kdbulan]) {
case "01" : $bulan="31 JANUARI";break;
case "02" : $bulan=" 28 FEBRUARI";break;
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


	
$pdf->Ln(10); 
// header
$pdf->SetY(37);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,'AKUN GAJI',0,1,'C'); 

$pdf->SetY(42); 
$pdf->SetX(130); 
$pdf->Cell(0,5,'PERIODE : 1 JANUARI S.D '. $indbul,0,1,'L');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(78,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(93);
$pdf->Cell(11,12,'AKUN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(104);
$pdf->Cell(30,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(134);
$pdf->Cell(28,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(134);
$pdf->Cell(28,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(162);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(162);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(192);
$pdf->Cell(88,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(192);
$pdf->Cell(30,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(222);
$pdf->Cell(28,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(250);
$pdf->Cell(30,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(280);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(280);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(310);
$pdf->Cell(8.5,6,'%','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(310);
$pdf->Cell(8.5,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(318.5); 
$pdf->Cell(7,12,'KET',1,0,'C',1); 


$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(78,5,'2',1,0,'C',1); 
$pdf->Cell(11,5,'3',1,0,'C',1);
$pdf->Cell(30,5,'4',1,0,'C',1); 
$pdf->Cell(28,5,'5',1,0,'C',1);
$pdf->Cell(30,5,'6',1,0,'C',1);
$pdf->Cell(30,5,'7',1,0,'C',1);
$pdf->Cell(28,5,'8',1,0,'C',1);
$pdf->Cell(30,5,'9',1,0,'C',1);
$pdf->Cell(30,5,'10',1,0,'C',1);
$pdf->Cell(8.5,5,'11',1,0,'C',1);
$pdf->Cell(7,5,'12',1,0,'C',1);

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
$pdf->Ln();

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
     $max=19;
   } else {	 $max=26; }

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   $pdf->SetFont('Arial','',8);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
   
   $pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->SetY(18); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(15); 
$pdf->Cell(78,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(93);
$pdf->Cell(11,12,'AKUN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(104);
$pdf->Cell(30,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(134);
$pdf->Cell(28,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(134);
$pdf->Cell(28,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(162);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(162);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(192);
$pdf->Cell(88,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(192);
$pdf->Cell(30,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(222);
$pdf->Cell(28,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(250);
$pdf->Cell(30,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(280);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(280);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(310);
$pdf->Cell(8.5,6,'%','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(310);
$pdf->Cell(8.5,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(318.5); 
$pdf->Cell(7,12,'KET',1,0,'C',1); 
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',7);
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(7,5,'1',1,0,'C',1); 
	$pdf->Cell(78,5,'2',1,0,'C',1); 
	$pdf->Cell(11,5,'3',1,0,'C',1);
	$pdf->Cell(30,5,'4',1,0,'C',1); 
	$pdf->Cell(28,5,'5',1,0,'C',1);
	$pdf->Cell(30,5,'6',1,0,'C',1);
	$pdf->Cell(30,5,'7',1,0,'C',1);
	$pdf->Cell(28,5,'8',1,0,'C',1);
	$pdf->Cell(30,5,'9',1,0,'C',1);
	$pdf->Cell(30,5,'10',1,0,'C',1);
	$pdf->Cell(8.5,5,'11',1,0,'C',1);
	$pdf->Cell(7,5,'12',1,0,'C',1);

   //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

	$pagu 			= number_format($row[pagu],0,',','.');
	$revisi 		= number_format($row[revisi],0,',','.');
	$pagurevisi		= number_format($row[pagurevisi],0,',','.');
	$lalu			= number_format($row[blnlalu],0,',','.');
	$ini			= number_format($row[blnini],0,',','.');
	$blnsdi = $row[blnlalu] + $row[blnini];
	$sdi			= number_format($blnsdi,0,',','.');
	
	$turahan = $row[pagurevisi] - $blnsdi;
	$sisa			= number_format($turahan,0,',','.');
	
	if (($row[pagurevisi]=='') or ($row[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($blnsdi/$row[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0	= number_format($prosen,0,',','.');

	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(8); 
		$ng = $pdf->GetY(); 
	    $pdf->Cell(7,5,$no,'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(78,5,$row[nmakun],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(93);
		$pdf->Cell(11,5,$row[kdakun],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(104);
		$pdf->Cell(30,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(134);
		$pdf->Cell(28,5,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(162);
		$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(192);
		$pdf->Cell(30,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(222);
		$pdf->Cell(28,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(250);
		$pdf->Cell(30,5,$sdi,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(280);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(310);	
		
		if ($prosen>='100') {		
		$pdf->Cell(8.5,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(8.5,5,$prosen_des,'LR',1,'C',2);	
		}
	    
		$pdf->SetY($ng);
		$pdf->SetX(318.5);
		$pdf->Cell(7,5,'','LR',1,'R',2); 
	
	$i++;
	$no++;
		
	}
		
		
		


//spasi

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
	
$jml=mysql_query("select 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and substr(a.kdakun,1,3)='511' 
group by a.kdsa,a.kdjd,a.kdprogram"); 
$hasil = mysql_fetch_array($jml);	

	$pagu 			= number_format($hasil[pagu],0,',','.');
	$revisi 		= number_format($hasil[revisi],0,',','.');
	$pagurevisi		= number_format($hasil[pagurevisi],0,',','.');
	$lalu			= number_format($hasil[blnlalu],0,',','.');
	$ini			= number_format($hasil[blnini],0,',','.');
	$blnsdi = $hasil[blnlalu] + $hasil[blnini];
	$sdi			= number_format($blnsdi,0,',','.');
	
	$turahan = $hasil[pagurevisi] - $blnsdi;
	$sisa			= number_format($turahan,0,',','.');
	
	if (($hasil[pagurevisi]=='') or ($hasil[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$pros 		= (($blnsdi/$hasil[pagurevisi])*100);
	}
	$pros_des	= number_format($pros,2,',','.');
	$pros_des0	= number_format($pros,0,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('Arial','B',8);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(78,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(11,6,'',1,0,'C',1);
	$pdf->Cell(30,6,$pagu,1,0,'R',1); 
	$pdf->Cell(28,6,$revisi,1,0,'R',1);
	$pdf->Cell(30,6,$pagurevisi,1,0,'R',1);
	$pdf->Cell(30,6,$lalu,1,0,'R',1);
	$pdf->Cell(28,6,$ini,1,0,'R',1);
	$pdf->Cell(30,6,$sdi,1,0,'R',1);
	$pdf->Cell(30,6,$sisa,1,0,'R',1);
	if ($prosen>='100') {	
	$pdf->Cell(8.5,6,$pros_des0,1,0,'C',1);
	} else {
	$pdf->Cell(8.5,6,$pros_des,1,0,'C',1);	
	}
	$pdf->Cell(7,6,'',1,0,'C',1);

	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' "); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('Arial','',10);
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
