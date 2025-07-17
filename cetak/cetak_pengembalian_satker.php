<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
//$pdf=new FPDF('L','mm',array(215, 335));
$pdf=new FPDF('L','mm',array(210,297));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->AddFont('arialnarrow','','arialnarrow.php');
$pdf->AddFont('arialnarrowBold','','arialnarrowBold.php');
$pdf->SetFont('arialnarrow','',11);
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
$pdf->SetFont('arialnarrow','',11);
$pdf->Sety(18); 
$pdf->SetX(285); 
$pdf->Cell(0,5,$z[brs1],0,0,'R',1);
$pdf->Sety(23); 
$pdf->SetX(285); 
$pdf->Cell(0,5,$z[brs2],0,0,'R',1);
$pdf->Sety(28); 
$pdf->SetX(285); 
$pdf->Cell(0,5,$z[brs3],0,0,'R',1);
$pdf->Sety(33); 

$pdf->Sety(33.2); 
$pdf->SetX($posisi+1);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);

$pdf->Sety(18); 
$pdf->SetX($posisi); 
$pdf->Cell(12,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi); 
$pdf->Cell(12,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi); 
$pdf->Cell(12,5,'Tanggal',0,0,'L',1);


	 $sql= mysql_query("SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, '' as kode, '1' as display,  'RUPIAH MURNI' as uraian, sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c1 on a.kdkotama=c1.kdkotama and a.kdsatker=c1.kdsatker and a.thang=c1.thang 
left join(select kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama,kdsatker,thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.pengembalian='x' 
group by a.kdkotama, a.kdsatker, a.thang
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker,  a.thang, concat('012.','22.',a.kdprogram) as kode, concat('1',a.kdprogram) as display, b.nmprogram as uraian,  sum(a.pagurevisi) as pagurevisi, '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c on a.kdprogram=c.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram) as c1 on a.kdprogram=c1.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram) as d on a.kdprogram=d.kdprogram
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.pengembalian='x' group by a.kdprogram)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdgiat as kode, concat('1',a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram,kdgiat) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat)
union (SELECT '' as pengembalian, '' as id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdoutput as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput) as display, b.nmoutput as uraian,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,  c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi 
where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c on a.kdprogram=c.kdprogram and  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput
left join (select kdprogram, kdgiat, kdoutput, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi 
where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdprogram,kdgiat,kdoutput) as c1 on a.kdprogram=c1.kdprogram and  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput
left join (select kdprogram, kdgiat,  kdoutput, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdprogram,kdgiat,kdoutput) as d on a.kdprogram=d.kdprogram and  d.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by a.kdprogram,a.kdgiat,a.kdoutput)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, a.nmakun as uraian,   sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun)
union (SELECT '' as pengembalian, '' as id_pagu,  a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, a.kdakun as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, a.nmsakun as uraian,  
sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi,   c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa a 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c on  a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdgiat,kdoutput, kdakun,kdsakun) as c1 on  a.kdgiat=c1.kdgiat and a.kdoutput=c1.kdoutput and a.kdakun=c1.kdakun and a.kdsakun=c1.kdsakun 
left join (select kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdgiat,kdoutput, kdakun,kdsakun) as d on  a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput and a.kdakun=d.kdakun and a.kdsakun=d.kdsakun 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x' group by  a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)
union (SELECT a.pengembalian, a.id_pagu, a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, '' as kode, concat('1',a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display, concat('-',' ', a.nmitem) as uraian,  sum(a.pagurevisi) as pagurevisi,  c.id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian 
FROM dipa  a
left join (select  id_pagu, id_realisasi, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]'  and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select  id_pagu, id_realisasi, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]'  and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by id_pagu) as c1 on a.id_pagu=c1.id_pagu
left join (select  id_pagu, id_realisasi, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]'  and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'  and a.pengembalian='x'  group by a.id_pagu order by a.noitem) order by display"); 
	


switch ($_GET[kdbulan]) {
case "01" : $bulan="JANUARI";break;
case "02" : $bulan="FEBRUARI";break;
case "03" : $bulan="MARET";break;
case "04" : $bulan="APRIL";break;
case "05" : $bulan="MEI";break;
case "06" : $bulan="JUNI";break;
case "07" : $bulan="JULI";break;
case "08" : $bulan="AGUSTUS";break;
case "09" : $bulan="SEPTEMBER"; break;
case "10" : $bulan="OKTOBER";break;
case "11" : $bulan="NOVEMBER";break;
case "12" : $bulan="DESEMBER";break;
}


// $indbul=$bulan.' '.$_GET[thang];
$thang= $_GET[thang];	
$indbul=$bulan;

	
$pdf->Ln(10); 
// header
$pdf->SetY(38);
$pdf->SetFont('arialnarrow','',11);
$pdf->Cell(0,5,'LAPORAN PENGEMBALIAN BELANJA',0,1,'C'); 
$pdf->SetY(43); 
$pdf->Cell(0,5,'BULAN  '. $indbul.' '.' TAHUN '.' '.$thang,0,1,'C');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',9);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,15,'NO',1,0,'C',1); 
$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(85,15,'URAIAN',1,0,'C',1); 
$pdf->SetY(55); 
$pdf->SetX(100);
$pdf->Cell(15,15,'AKUN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(115);
$pdf->Cell(30,5,'PAGU','LRT',0,'C',1); 

$pdf->SetY(60); 
$pdf->SetX(115);
$pdf->Cell(30,5,'SETELAH','LR',0,'C',1); 

$pdf->SetY(65); 
$pdf->SetX(115);
$pdf->Cell(30,5,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(145);
$pdf->Cell(28,15,'REALISASI',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(173);
$pdf->Cell(30,15,'SISA DANA',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(203);
$pdf->Cell(30,15,'JML PENGEMBALIAN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(233);
$pdf->Cell(28,5,'SISA','LRT',0,'C',1); 

$pdf->SetY(60); 
$pdf->SetX(233);
$pdf->Cell(28,5,'SETELAH','LR',0,'C',1); 

$pdf->SetY(65); 
$pdf->SetX(233);
$pdf->Cell(28,5,'PENGEMBALIAN','LRB',0,'C',1); 



$pdf->SetY(55); 
$pdf->SetX(261);
$pdf->Cell(28,15,'KETERANGAN','LRTB',0,'C',1); 



$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(85,5,'2',1,0,'C',1); 
$pdf->Cell(15,5,'3',1,0,'C',1);
$pdf->Cell(30,5,'4',1,0,'C',1); 
$pdf->Cell(28,5,'5',1,0,'C',1);
$pdf->Cell(30,5,'6',1,0,'C',1);
$pdf->Cell(30,5,'7',1,0,'C',1);
$pdf->Cell(28,5,'8',1,0,'C',1);
$pdf->Cell(28,5,'9',1,0,'C',1);


$pdf->Ln(5.2);




$hal=1;

$i = 0; 
$no=1;
$abjad='a';
$nomor=1;
$tempAbjad = null;

$romawi=1;
$tempRomawi = null;

//Set maximum rows per page ambil dari field nilai pada tajuk tanda tangan
$brsttd=mysql_query("SELECT * from baris where id='1' "); 
$n = mysql_fetch_array($brsttd);

$baris = $n[baris];

//Set Row Height
$row_height = 6;
// data
while($row = mysql_fetch_array($sql)) {

if (($hal) == '1') {   
     $max=$baris;
	 // $max=5;
   } else {	 $max=27; }

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   $pdf->SetFont('arialnarrow','',9);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
   
   $pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',9);
$pdf->SetY(18); 
$pdf->SetX(8); 
$pdf->Cell(7,15,'NO',1,0,'C',1); 
$pdf->SetY(18); 
$pdf->SetX(15); 
$pdf->Cell(85,15,'URAIAN',1,0,'C',1); 
$pdf->SetY(18); 
$pdf->SetX(100);
$pdf->Cell(15,15,'AKUN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(115);
$pdf->Cell(30,5,'PAGU','LRT',0,'C',1); 

$pdf->SetY(23); 
$pdf->SetX(115);
$pdf->Cell(30,5,'SETELAH','LR',0,'C',1); 

$pdf->SetY(28); 
$pdf->SetX(115);
$pdf->Cell(30,5,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(145);
$pdf->Cell(28,15,'REALISASI',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(173);
$pdf->Cell(30,15,'SISA DANA',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(203);
$pdf->Cell(30,15,'JML PENGEMBALIAN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(233);
$pdf->Cell(28,5,'SISA','LRT',0,'C',1); 

$pdf->SetY(23); 
$pdf->SetX(233);
$pdf->Cell(28,5,'SETELAH','LR',0,'C',1); 

$pdf->SetY(28); 
$pdf->SetX(233);
$pdf->Cell(28,5,'PENGEMBALIAN','LRB',0,'C',1); 



$pdf->SetY(18); 
$pdf->SetX(261);
$pdf->Cell(28,15,'KETERANGAN','LRTB',0,'C',1); 
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('arialnarrow','',9);
    $pdf->SetY(32); 
    $pdf->SetX(8); 
    $pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(85,5,'2',1,0,'C',1); 
$pdf->Cell(15,5,'3',1,0,'C',1);
$pdf->Cell(30,5,'4',1,0,'C',1); 
$pdf->Cell(28,5,'5',1,0,'C',1);
$pdf->Cell(30,5,'6',1,0,'C',1);
$pdf->Cell(30,5,'7',1,0,'C',1);
$pdf->Cell(28,5,'8',1,0,'C',1);
$pdf->Cell(28,5,'9',1,0,'C',1);
   

  

  

 
   //Go to next row
   $y_axis = $y_axis + $row_height;
   
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

	$stlhrevisi	 = $row[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$realisasi = number_format($row[realisasi],0,',','.');
	$realisasi2 = number_format($row[realisasi2],0,',','.');
	$jml_pengembalian = number_format($row[jml_pengembalian],0,',','.');
	
//	$netto = $row[realisasi2] - $row[jml_pengembalian];
//	$netto_rb = number_format($netto,0,',','.');
	
	if (($row[pagurevisi]=='') or ($row[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($netto/$row[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
	
	
	$turahan = $stlhrevisi - $row[realisasi2];
	$sisa  = number_format($turahan,0,',','.');
	
	$akhir = $turahan - $row[jml_pengembalian];
	$saldo =number_format($akhir,0,',','.');
	//--------------------------------------------------
	
//	$prosen 	= (($blnsdi/$row[pagurevisi])*100);
//	$prosen_des	= number_format($prosen,2,',','.');
//	$prosen_des0= number_format($prosen,0,',','.');

	
	//$uraian = strtolower($row[uraian]);
	//$hasiluraian =ucwords($uraian);
	
	$str = $row[display];
    $pj = strlen($str);
	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetX(8);
		$ng = $pdf->GetY(); 
	if ($pj=='3') {	
	    $pdf->SetFont('arialnarrow','',9);
		if ($romawi=='1') {
		$pdf->Cell(7,5,'A.','LR',1,'L',2);
        } else if ($romawi=='2') {
		$pdf->Cell(7,5,'B.','LR',1,'L',2);	
		} else if ($romawi=='3') {
		$pdf->Cell(7,5,'C.','LR',1,'L',2);			
		} else {
		$pdf->Cell(7,5,'D.','LR',1,'L',2);
		}
		$tempRomawi = $romawi;
        $romawi++;		
		
	} else if ($pj=='7') {	
	    $pdf->SetFont('arialnarrow','',9);
		if($tempRomawi != $romawi)
		{
			$no='1';
			$tempRomawi = $romawi;
		}else{
		
		}	
		$pdf->Cell(7,5,$no.''.'.','LR',1,'L',1);
		
		$tempNo = $no;
        $no++;		
		
	} else if ($pj=='10') {	
	    $pdf->SetFont('arialnarrow','',9);
		if ($tempNo != $no) 
		{
			$abjad='a';
			$tempNo = $no;
			$tempRomawi = $romawi;
		}else{
		
		}
		$pdf->Cell(7,5,$abjad.''.'.','LR',1,'C',2);
			$tempAbjad = $abjad;
		    $abjad++;
	} else if ($pj=='16') {	
	    $pdf->SetFont('arialnarrow','',9);
		if($tempAbjad != $abjad)
		{
			$nomor=1;
			$tempNo = $no;
			$tempRomawi = $romawi;
			$tempAbjad = $abjad;
			
		}else if($tempRomawi != $romawi){
		
		$nomor=1;
			
		}else{
			
			$nomor++;	
		}
	    $pdf->Cell(7,5,$nomor.''.')','LR',1,'R',2);
	   	
	} else {
	$pdf->Cell(7,5,'','LR',1,'C',2);
	}
	
	$uraian=substr($row[uraian],0,54);
	
	
	    $pdf->SetFont('arialnarrow','',9);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(85,5,$uraian,'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(100);
		$pdf->Cell(15,5,$row[kode],'LR',1,'R',2);
		
		
		$pdf->SetY($ng);
		$pdf->SetX(115);
		$pdf->Cell(30,5,$hasil,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(145);
		$pdf->Cell(28,5,$realisasi2,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(173);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(203);
		$pdf->Cell(30,5,$jml_pengembalian,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(233);
		$pdf->Cell(28,5,$saldo,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(261);
		$pdf->Cell(28,5,'','LR',1,'R',2);
		
		
	
	
	
	
		$y_axis = $y_axis + $row_height;
		$i++;
		//$no++;
		
		
} // tutup while $row

//spasi

    

	
$jml=mysql_query("SELECT   a.kdwasgiat, a.kdkotama, a.kdsatker, a.thang, '' as kode, '1' as display,  sum(a.pagurevisi) as pagurevisi,  '' as id_realisasi, c.realisasi, c1.realisasi2, d.jml_pengembalian
FROM dipa a 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatker and a.thang=c.thang 
left join(select kdkotama, kdsatker, thang, sum(realisasi) as realisasi2 from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and pengembalian='x' group by kdkotama,kdsatker,thang) as c1 on a.kdkotama=c1.kdkotama and a.kdsatker=c1.kdsatker and a.thang=c1.thang 
left join(select kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian from pengembalian where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama,kdsatker,thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang 
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and a.pengembalian='x' 
group by a.kdkotama, a.kdsatker, a.thang");

$last = mysql_fetch_array($jml);	

	$stlhrevisi	 = $last[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$realisasi = number_format($last[realisasi],0,',','.');
	$realisasi2 = number_format($last[realisasi2],0,',','.');
	$jml_pengembalian = number_format($last[jml_pengembalian],0,',','.');
	
	$jturahan = $last[pagurevisi] - $last[realisasi2];
	$jsisa = number_format($jturahan,0,',','.');
	
	if (($netto=='') or ($netto=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($netto/$last[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
	
	
	$jakhir = $stlhrevisi - $last[realisasi2] - $last[jml_pengembalian];
	$jsaldo  = number_format($jakhir,0,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('arialnarrow','',9);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(85,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(15,6,'',1,0,'C',1);
	$pdf->Cell(30,6,$hasil,1,0,'R',1); 
	$pdf->Cell(28,6,$realisasi2,1,0,'R',1);
	$pdf->Cell(30,6,$jsisa,1,0,'R',1);
	$pdf->Cell(30,6,$jml_pengembalian,1,0,'R',1);
	$pdf->Cell(28,6,$jsaldo,1,0,'R',1);
	$pdf->Cell(28,6,'',1,0,'R',1);
	
	
	
	
	
/*

$jmljenbel=mysql_query("select a.*, b.pagu,  b.revisi, b.pagurevisi,  c.realisasi, d.jml_pengembalian from t_jenbel a 

left join (select kdkotama, kdsatker, thang, kdjenbel, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where kdkotama='04' and kdsatker='685152' and thang='2020' and pengembalian='x' group by kdkotama,kdsatker,thang,kdjenbel) as b on a.kdjenbel=b.kdjenbel 

left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi, kdjenbel from realisasi where kdbulan<='12' and kdkotama='04' and kdsatker='685152' and thang='2020' and pengembalian='x' group by kdkotama, kdsatker, thang, kdjenbel) as c on a.kdjenbel=c.kdjenbel

left join (select kdkotama, kdsatker, thang, sum(jml_pengembalian) as jml_pengembalian, kdjenbel from pengembalian where kdbulan<='12' and kdkotama='04' and kdsatker='685152' and thang='2020' group by kdkotama, kdsatker, thang, kdjenbel) as d on a.kdjenbel=d.kdjenbel

where a.kdjenbel<'54' order by a.kdjenbel"); 
$pdf->Ln(); 
 $k=1;
 while($ok = mysql_fetch_array($jmljenbel)) {
 
    $pagu1 			= number_format($ok[pagu],0,',','.');
	$revisi1 		= number_format($ok[revisi],0,',','.');
	$pagurevisi1	= number_format($ok[pagurevisi],0,',','.');
	$realisasi1		= number_format($ok[realisasi],0,',','.');
	
	
	$turahan1 = $ok[pagurevisi] - $ok[realisasi];
	$sisa1			= number_format($turahan1,0,',','.');
	
	$jml_pengembalian1 = number_format($ok[jml_pengembalian],0,',','.');
	
	//-----------------------------------------------------
	if (($ok[pagurevisi]=='') or  ($ok[pagurevisi]=='0')){
	$prosen     = 0; 
    } else { 
	$prosen 	= (($ok[realisasi]/$ok[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0	= number_format($prosen,0,',','.');
	//------------------------------------------------------
 
        $ng = $pdf->GetY(); 
    	$pdf->SetFont('Arial','',8);
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
		$pdf->Cell(30,5,$realisasi1,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(228);
		$pdf->Cell(28,5,$sisa1,'LR',1,'R',2);
		
		
		$pdf->SetY($ng);
		$pdf->SetX(256);
		 if ($prosen>='100') {	
		$pdf->Cell(8.5,5,$prosen_des0,'LR',1,'C',2); 
		 } else {
		$pdf->Cell(8.5,5,$prosen_des,'LR',1,'C',2); 	 
		 }
		$pdf->SetY($ng);
		$pdf->SetX(264.5);
		$pdf->Cell(28,5,$jml_pengembalian1,'LR',1,'R',2); 
	

	
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
	
	$pdf->Cell(8.5,1,'','LRB',0,'C',1);
	$pdf->Cell(28,1,'','LRB',0,'C',1);
*/	
	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('arialnarrow','',11);
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
