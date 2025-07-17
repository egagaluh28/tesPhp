<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm',array(215, 335));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
// KOP

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($kop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); 
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
$pdf->SetX($posisi); 
$pdf->Cell(40,5,'Lampiran',0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi); 
$pdf->Cell(40,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi); 
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
$pdf->SetX($posisi+1);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);




	

   
	 $sql= mysql_query("select '' as kode, concat(a.kdsa,a.kdjd) as display, b.nmsajd as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_sajd b on concat(a.kdsa,a.kdjd)=b.kdsajd
left join (select a.kdsa, a.kdjd, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd
left join (select a.kdsa, a.kdjd, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd
union
(select concat('012.','22.',a.kdprogram) as kode, concat(a.kdsa,a.kdjd,a.kdprogram) as display, b.nmprogram as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram)
union
(select a.kdgiat as kode, concat(a.kdsa,a.kdjd,a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram and a.kdgiat=d.kdgiat
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat)
union
(select a.kdjenbel as kode, concat(a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel) as display, b.nmjenbel as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_jenbel b on a.kdjenbel=b.kdjenbel
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdjenbel=c.kdjenbel
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram and a.kdgiat=d.kdgiat and a.kdjenbel=d.kdjenbel
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel)
union
(select a.kdakun as kode, concat(a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun) as display, b.nmakun as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_akun b on a.kdakun=b.kdakun

left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdakun, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdjenbel=c.kdjenbel and a.kdakun=c.kdakun
left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdakun, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram and a.kdgiat=d.kdgiat and a.kdjenbel=d.kdjenbel and a.kdakun=d.kdakun
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun)
union
(select a.kdakun as kode, concat(a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun,a.kdsakun,a.kdoutput) as display, concat('- ',b.nmsakun) as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 
left join t_sakun b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput and a.kdakun=b.kdakun and a.kdsakun=b.kdsakun

left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdakun, a.kdsakun, a.kdkotama, a.kdsatker, a.thang,a.kdoutput, sum(b.realisasi) as blnlalu from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel, a.kdoutput, a.kdakun,a.kdsakun) as c on  a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdsa=c.kdsa and a.kdjd=c.kdjd and a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdjenbel=c.kdjenbel and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun and a.kdoutput=c.kdoutput

left join (select a.kdsa, a.kdjd, a.kdprogram, a.kdgiat, a.kdjenbel, a.kdakun, a.kdsakun, a.kdkotama, a.kdsatker, a.thang, a.kdoutput,sum(b.realisasi) as blnini from bpjs a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel, a.kdoutput, a.kdakun,a.kdsakun) as d on  a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdsa=d.kdsa and a.kdjd=d.kdjd and a.kdprogram=d.kdprogram and a.kdgiat=d.kdgiat and a.kdjenbel=d.kdjenbel and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun and a.kdoutput=d.kdoutput
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdsa,a.kdjd,a.kdprogram,a.kdgiat,a.kdjenbel,a.kdakun, a.kdsakun,a.kdoutput)
order by display"); 
	


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
$pdf->SetY(35);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,'LAPORAN PELAKSANAAN ANGGARAN PNBP BPJS KESEHATAN',0,1,'C'); 
//$pdf->SetY(40); 
//$pdf->SetX(125); 
//$pdf->Cell(0,5,'(ANGGARAN BELANJA NEGARA PELAYANAN KPPN)',0,1,'L');
$pdf->SetY(40); 
$pdf->SetX(130); 
$pdf->Cell(0,5,'PERIODE : 1 JANUARI S.D '. $indbul,0,1,'L');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(80,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(95);
$pdf->Cell(15,12,'AKUN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(110);
$pdf->Cell(30,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(140);
$pdf->Cell(28,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(140);
$pdf->Cell(28,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(168);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(168);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(198);
$pdf->Cell(88,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(198);
$pdf->Cell(30,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(228);
$pdf->Cell(28,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(256);
$pdf->Cell(30,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(286);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(286);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(316);
$pdf->Cell(8.5,6,'%','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(316);
$pdf->Cell(8.5,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(324.5); 
$pdf->Cell(7,12,'KET',1,0,'C',1); 


$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(80,5,'2',1,0,'C',1); 
$pdf->Cell(15,5,'3',1,0,'C',1);
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
$pdf->Cell(7,2,'','LRT',0,'C',1); 
$pdf->Cell(80,2,'','LRT',0,'C',1); 
$pdf->Cell(15,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1); 
$pdf->Cell(28,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(28,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(8.5,2,'','LRT',0,'C',1);
$pdf->Cell(7,2,'','LRT',0,'C',1);


$hal=1;

$i = 0; 
$no=1;
$abjad='A';
$tempAbjad = null;

$romawi=1;
$tempRomawi = null;
//Set maximum rows per page
$max = 19;
//Set Row Height
$row_height = 6;
// data
while($row = mysql_fetch_array($sql)) {

if (($hal) == '1') {   
     $max=19;
   } else {	 $max=23; }

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
$pdf->Cell(80,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(95);
$pdf->Cell(15,12,'AKUN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(110);
$pdf->Cell(30,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(140);
$pdf->Cell(28,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(140);
$pdf->Cell(28,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(168);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(168);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(198);
$pdf->Cell(88,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(198);
$pdf->Cell(30,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(228);
$pdf->Cell(28,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(256);
$pdf->Cell(30,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(286);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(286);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(316);
$pdf->Cell(8.5,6,'%','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(316);
$pdf->Cell(8.5,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(324.5); 
$pdf->Cell(7,12,'KET',1,0,'C',1); 
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',7);
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(7,5,'1',1,0,'C',1); 
	$pdf->Cell(80,5,'2',1,0,'C',1); 
	$pdf->Cell(15,5,'3',1,0,'C',1);
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

	//-------------------------------------------
	if (($row[pagurevisi]=='') or ($row[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($blnsdi/$row[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
	//--------------------------------------------------
	
//	$prosen 	= (($blnsdi/$row[pagurevisi])*100);
//	$prosen_des	= number_format($prosen,2,',','.');
//	$prosen_des0	= number_format($prosen,0,',','.');

	
	$uraian = strtolower($row[uraian]);
	$hasiluraian =ucwords($uraian);
	
	$str = $row[display];
    $pj = strlen($str);
	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetX(8);
		$ng = $pdf->GetY(); 
	if ($pj=='2') {	
	    $pdf->SetFont('Arial','',8);
		if ($romawi=='1') {
		$pdf->Cell(7,5,'I','LR',1,'C',2);
        } else if ($romawi=='2') {
		$pdf->Cell(7,5,'II','LR',1,'C',2);			
		} else {
		$pdf->Cell(7,5,'III','LR',1,'C',2);
		}
		$tempRomawi = $romawi;
        $romawi++;		
	} else if ($pj=='4') {	
	    $pdf->SetFont('Arial','',8);
		if($tempRomawi != $romawi)
		{
			$abjad='A';
			$tempRomawi = $romawi;
		}else{
		
		}
		$pdf->Cell(7,5,$abjad,'LR',1,'C',2);
			$tempAbjad = $abjad;
		$abjad++;
	} else if ($pj=='8') {	
	    $pdf->SetFont('Arial','',8);
		if($tempAbjad != $abjad)
		{
			$no=1;
			
			$tempAbjad = $abjad;
		}else if($tempRomawi != $romawi){
		
		$no=1;
			
		}else{
			
			$no++;	
		}
	    $pdf->Cell(7,5,$no,'LR',1,'C',2);
	   	
	} else {
	$pdf->Cell(7,5,'','LR',1,'C',2);
	}
	
	if ($pj <'17' ) { // jika digit kurang dari 14 dicetak tebal (sampai kode output)
	    $pdf->SetFont('Arial','B',8);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(80,5,$row[uraian],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(95);
		$pdf->Cell(15,5,$row[kode],'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(110);
		$pdf->Cell(30,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(140);
		$pdf->Cell(28,5,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(168);
		$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(198);
		$pdf->Cell(30,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(228);
		$pdf->Cell(28,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(256);
		$pdf->Cell(30,5,$sdi,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(286);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(316);	
		
		if ($prosen>='100') {		
		$pdf->Cell(8.5,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(8.5,5,$prosen_des,'LR',1,'C',2);	
		}
	    
		$pdf->SetY($ng);
		$pdf->SetX(324.5);
		$pdf->Cell(7,5,'','LR',1,'R',2); 
	
	
	
	} else {

		$pdf->SetFont('Arial','',8);
		$pdf->SetY($ng);
		$pdf->SetX(15);
	    $pdf->Cell(80,5,$hasiluraian,'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(95);
		$pdf->Cell(15,5,$row[kode],'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(110);
		$pdf->Cell(30,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(140);
		$pdf->Cell(28,5,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(168);
		$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(198);
		$pdf->Cell(30,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(228);
		$pdf->Cell(28,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(256);
		$pdf->Cell(30,5,$sdi,'LR',1,'R',2);  
		
		$pdf->SetY($ng);
		$pdf->SetX(286);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2); 
		
		
		$pdf->SetY($ng);
		$pdf->SetX(316);
		if ($prosen>='100') {		
		$pdf->Cell(8.5,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(8.5,5,$prosen_des,'LR',1,'C',2);	
		}
		
		$pdf->SetY($ng);
		$pdf->SetX(324.5);
		$pdf->Cell(7,5,'','LR',1,'R',2); 
		
	}
	
		$y_axis = $y_axis + $row_height;
		$i++;
		//$no++;
		
		
} // tutup while $row

//spasi

    $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
    $pdf->Cell(7,2,'','LRB',0,'C',1); 
	$pdf->Cell(80,2,'','LRB',0,'C',1); 
	$pdf->Cell(15,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1); 
	$pdf->Cell(28,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(28,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(8.5,2,'','LRB',0,'C',1);
	$pdf->Cell(7,2,'','LRB',0,'C',1);
	
$jml=mysql_query("select sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, c.blnlalu, d.blnini
from bpjs a 

left join (select a.id_pagu,a.kdkotama, a.kdsatker,  a.thang, sum(b.realisasi) as blnlalu from bpjs a
left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.thang) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 

left join (select a.id_pagu,a.kdkotama, a.kdsatker,  a.thang, sum(b.realisasi) as blnini from bpjs a
left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang 

where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker,a.thang"); 
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
	
	
	//-------------------------------------------
	if (($hasil[pagurevisi]=='') or ($hasil[pagurevisi]=='0')) {
	$jmlpros     = 0; 
    } else { 
	$jmlpros 	= (($blnsdi/$hasil[pagurevisi])*100);
	}
	$jmlpros_des	= number_format($jmlpros,2,',','.');
	$jmlpros_des0= number_format($jmlpros,0,',','.');
	//--------------------------------------------------	
	
	//$pros 		= (($blnsdi/$hasil[pagurevisi])*100);
	//$pros_des	= number_format($pros,2,',','.');
	//$pros_des0	= number_format($pros,0,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('Arial','B',8);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(80,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(15,6,'',1,0,'C',1);
	$pdf->Cell(30,6,$pagu,1,0,'R',1); 
	$pdf->Cell(28,6,$revisi,1,0,'R',1);
	$pdf->Cell(30,6,$pagurevisi,1,0,'R',1);
	$pdf->Cell(30,6,$lalu,1,0,'R',1);
	$pdf->Cell(28,6,$ini,1,0,'R',1);
	$pdf->Cell(30,6,$sdi,1,0,'R',1);
	$pdf->Cell(30,6,$sisa,1,0,'R',1);
	if ($jmlpros>='100') {	
	$pdf->Cell(8.5,6,$jmlpros_des0,1,0,'C',1);
	} else {
	$pdf->Cell(8.5,6,$jmlpros_des,1,0,'C',1);	
	}
	$pdf->Cell(7,6,'',1,0,'C',1);

// per jenbel	
/*
	$jmljenbel=mysql_query("select a.kdjenbel, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagu+a.revisi) as pagurevisi, b.nmjenbel, c.blnlalu, d.blnini
from dipa a 
left join t_jenbel b on a.kdjenbel=b.kdjenbel
left join (select a.kdkotama, a.kdsatker, a.thang, sum(a.realisasi) as blnlalu, b.kdjenbel from realisasi a left join dipa b on a.id_pagu=b.id_pagu where a.kdbulan<'$_GET[kdbulan]' group by a.kdkotama, a.kdsatker, a.thang, b.kdjenbel) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang and a.kdjenbel=c.kdjenbel
left join (select a.kdkotama, a.kdsatker, a.thang, sum(a.realisasi) as blnini, b.kdjenbel from realisasi a left join dipa b on a.id_pagu=b.id_pagu where a.kdbulan='$_GET[kdbulan]' group by a.kdkotama, a.kdsatker, a.thang, b.kdjenbel) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang and a.kdjenbel=d.kdjenbel
where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdkotama,a.kdsatker,a.thang, a.kdjenbel"); 
*/

$jmljenbel=mysql_query("select a.*, b.pagu,  b.revisi, b.pagurevisi, c.blnlalu, d.blnini from t_jenbel a 
left join (select kdkotama, kdsatker, thang, kdjenbel, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagu+revisi) as pagurevisi  from bpjs where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama,kdsatker,thang,kdjenbel) as b on a.kdjenbel=b.kdjenbel 
left join (select a.kdkotama, a.kdsatker, a.thang, sum(a.realisasi) as blnlalu, b.kdjenbel from realisasi a left join bpjs b on a.id_pagu=b.id_pagu where a.kdbulan<'$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.thang, b.kdjenbel) as c on b.kdkotama=c.kdkotama and b.kdsatker=c.kdsatker and b.thang=c.thang and b.kdjenbel=c.kdjenbel 
left join (select a.kdkotama, a.kdsatker, a.thang, sum(a.realisasi) as blnini, b.kdjenbel from realisasi a left join bpjs b on a.id_pagu=b.id_pagu where a.kdbulan='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by a.kdkotama, a.kdsatker, a.thang, b.kdjenbel) as d on b.kdkotama=d.kdkotama and b.kdsatker=d.kdsatker and b.thang=d.thang and b.kdjenbel=d.kdjenbel 
where a.kdjenbel<'54'
order by a.kdjenbel"); 
$pdf->Ln(); 
 $k=1;
 while($ok = mysql_fetch_array($jmljenbel)) {
 
    $pagu1 			= number_format($ok[pagu],0,',','.');
	$revisi1 		= number_format($ok[revisi],0,',','.');
	$pagurevisi1	= number_format($ok[pagurevisi],0,',','.');
	$lalu1			= number_format($ok[blnlalu],0,',','.');
	$ini1			= number_format($ok[blnini],0,',','.');
	$blnsdi1 = $ok[blnlalu] + $ok[blnini];
	$sdi1			= number_format($blnsdi1,0,',','.');
	
	$turahan1 = $ok[pagurevisi] - $blnsdi1;
	$sisa1			= number_format($turahan1,0,',','.');
	
	if (($ok[pagurevisi]=='') or  ($ok[pagurevisi]=='0')){
	$prosen     = 0; 
    } else { 
	$prosen 	= (($blnsdi1/$ok[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0	= number_format($prosen,0,',','.');
 
        $ng = $pdf->GetY(); 
    	$pdf->SetFont('Arial','B',8);
		$pdf->SetY($ng);
		$pdf->SetX(8);
		$pdf->Cell(7,5,'','LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(80,5,$ok[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(95);
		$pdf->Cell(15,5,$ok[kdjenbel],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(110);
		$pdf->Cell(30,5,$pagu1,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(140);
		$pdf->Cell(28,5,$revisi1,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(168);
		$pdf->Cell(30,5,$pagurevisi1,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(198);
		$pdf->Cell(30,5,$lalu1,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(228);
		$pdf->Cell(28,5,$ini1,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(256);
		$pdf->Cell(30,5,$sdi1,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(286);
		$pdf->Cell(30,5,$sisa1,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(316);
		 if ($prosen>='100') {	
		$pdf->Cell(8.5,5,$prosen_des0,'LR',1,'C',2); 
		 } else {
		$pdf->Cell(8.5,5,$prosen_des,'LR',1,'C',2); 	 
		 }
		$pdf->SetY($ng);
		$pdf->SetX(324.5);
		$pdf->Cell(7,5,'','LR',1,'R',2); 
	

	
	}
	$y_axis1= $y_axis1 + $row_height;
		$k++;
		 $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
    $pdf->Cell(7,1,'','LRB',0,'C',1); 
	$pdf->Cell(80,1,'','LRB',0,'C',1); 
	$pdf->Cell(15,1,'','LRB',0,'C',1);
	$pdf->Cell(30,1,'','LRB',0,'C',1); 
	$pdf->Cell(28,1,'','LRB',0,'C',1);
	$pdf->Cell(30,1,'','LRB',0,'C',1);
	$pdf->Cell(30,1,'','LRB',0,'C',1);
	$pdf->Cell(28,1,'','LRB',0,'C',1);
	$pdf->Cell(30,1,'','LRB',0,'C',1);
	$pdf->Cell(30,1,'','LRB',0,'C',1);
	$pdf->Cell(8.5,1,'','LRB',0,'C',1);
	$pdf->Cell(7,1,'','LRB',0,'C',1);
	
	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
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
