<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

// new
// ukuran a4 = 210.5 x 297 mm
//$pdf=new FPDF('L','mm',array(215, 335));
$pdf=new FPDF('L','mm','A4');
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->AddFont('arialnarrow','','arialnarrow.php');
$pdf->AddFont('arialnarrowBold','','arialnarrowBold.php');
$pdf->SetFont('arialnarrow','',10.5);
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

if ($x['kop1']=='') {
	
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop,5,'',0,1,'C');	
} else {
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop-3,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($kop-3,5,$x[kop2],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($grs-3,0,'                             ',0,0,'C',1); 
}


if ($z['brs1']=='') {
	
	$pdf->Sety(18); 
	$pdf->SetX(285); 
	$pdf->Cell(0,5,'',0,0,'R',0);

} else {	

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
$pdf->SetX($posisi+4);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);

$pdf->Sety(18); 
$pdf->SetX($posisi+3); 
$pdf->Cell(12,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi+3); 
$pdf->Cell(12,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi+3); 
$pdf->Cell(12,5,'Tanggal',0,0,'L',1);

}
   
   
	 $sql= mysql_query("select a.kdprogram, a.nmprogram, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from t_program a

left join (select kdprogram, sum(pagurevisi) as pagu51 from dipa where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdjenbel='51' group by kdprogram) as b on a.kdprogram=b.kdprogram

left join( select a.kdprogram, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' and a.kdjenbel='51' group by a.kdprogram) as b1 on a.kdprogram=b1.kdprogram

left join (select kdprogram, sum(pagurevisi) as pagu52 from dipa where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdjenbel='52' group by kdprogram) as c on a.kdprogram=c.kdprogram

left join( select a.kdprogram, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' and a.kdjenbel='52' group by a.kdprogram) as c1 on a.kdprogram=c1.kdprogram

left join (select kdprogram, sum(pagurevisi) as pagu53 from dipa where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdjenbel='53' group by kdprogram) as d on a.kdprogram=d.kdprogram

left join( select a.kdprogram, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' and a.kdjenbel='53' group by a.kdprogram) as d1 on a.kdprogram=d1.kdprogram group by a.kdprogram"); 
	

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

$thang= $_GET[thang];	
$indbul=$bulan;

$thang= $_GET[thang];	
$indbul=$bulan;
	
$pdf->Ln(10); 
// header
$pdf->SetY(35);
$pdf->SetFont('arialnarrow','',10.5);
$pdf->Cell(0,5,'PAGU DAN REALISASI PER PROGRAM PER JENIS BELANJA',0,1,'C');
$pdf->SetY(40); 
$pdf->Cell(0,5,'S.D '. $indbul.' '.' TAHUN '.' '.$thang,0,1,'C');

$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,18,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(94,18,'PROGRAM',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(109);
$pdf->Cell(180,6,'PAGU DAN REALISASI PER JENIS BELANJA','LRT',0,'C',1); 


$pdf->SetY(61); 
$pdf->SetX(109);
$pdf->Cell(60,6,'51 BELANJA PEGAWAI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(169);
$pdf->Cell(60,6,'52 BELANJA BARANG',1,0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(229);
$pdf->Cell(60,6,'53 BELANJA MODAL',1,0,'C',1); 


$pdf->SetY(67); 
$pdf->SetX(109);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(139);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(169);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(199);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(229);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(259);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,6,'1',1,0,'C',1); 
$pdf->Cell(94,6,'2',1,0,'C',1); 
$pdf->Cell(30,6,'3',1,0,'C',1);
$pdf->Cell(30,6,'4',1,0,'C',1); 
$pdf->Cell(30,6,'5',1,0,'C',1);
$pdf->Cell(30,6,'6',1,0,'C',1);
$pdf->Cell(30,6,'7',1,0,'C',1);
$pdf->Cell(30,6,'8',1,0,'C',1);

//$pdf->Ln(6.2);

$no=1;
while($row = mysql_fetch_array($sql)) {


  //  $i=0;
   $pdf->Ln();

	$pagu51	 = number_format($row[pagu51],0,',','.');
	$real51	 = number_format($row[real51],0,',','.');
	
	$pagu52	 = number_format($row[pagu52],0,',','.');
	$real52	 = number_format($row[real52],0,',','.');
	
	$pagu53	 = number_format($row[pagu53],0,',','.');
	$real53	 = number_format($row[real53],0,',','.');
	
	 $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('arialnarrow','',10.5);
    $pdf->Cell(7,6,$no,1,0,'C',1); 
	$pdf->Cell(94,6,$row[nmprogram],1,0,'L',1); 
	$pdf->Cell(30,6,$pagu51,1,0,'R',1);
	$pdf->Cell(30,6,$real51,1,0,'R',1); 
	$pdf->Cell(30,6,$pagu52,1,0,'R',1);
	$pdf->Cell(30,6,$real52,1,0,'R',1);
	$pdf->Cell(30,6,$pagu53,1,0,'R',1);
	$pdf->Cell(30,6,$real53,1,0,'R',1);

		
		$no++;
		
		
} // tutup while $row

//spasi

  
$pdf->Ln();
	
 $jml = mysql_query("select a.kdkotama,  a.thang, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from dipa a

left join (select kdkotama, thang, sum(pagurevisi) as pagu51 from dipa  where kdkotama='$_GET[kdkotama]' and thang='$_GET[thang]' and kdjenbel='51' group by kdkotama,  thang) as b on a.kdkotama=b.kdkotama  and a.thang=b.thang

left join (select a.kdkotama,  a.thang, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdjenbel='51' group by a.kdkotama, a.thang) as b1 on a.kdkotama=b1.kdkotama  and a.thang=b1.thang

left join (select kdkotama,  thang, sum(pagurevisi) as pagu52 from dipa  where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdjenbel='52' group by kdkotama,  thang) as c on a.kdkotama=c.kdkotama  and a.thang=c.thang

left join (select a.kdkotama, a.thang, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' and a.kdjenbel='52' group by a.kdkotama,  a.thang) as c1 on a.kdkotama=c1.kdkotama  and a.thang=c1.thang

left join (select kdkotama, thang, sum(pagurevisi) as pagu53 from dipa  where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdjenbel='53' group by kdkotama, thang) as d on a.kdkotama=d.kdkotama and a.thang=d.thang

left join (select a.kdkotama, a.thang, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]' and a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdjenbel='53' group by a.kdkotama, a.thang) as d1 on a.kdkotama=d1.kdkotama and a.thang=d1.thang

where  a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'
group by a.kdkotama,  a.thang");
      $p    = mysql_fetch_array($jml); 
	  
	   
    $pagu51	 = number_format($p[pagu51],0,',','.');
	$real51	 = number_format($p[real51],0,',','.');
	
	$pagu52	 = number_format($p[pagu52],0,',','.');
	$real52	 = number_format($p[real52],0,',','.');
	
	$pagu53	 = number_format($p[pagu53],0,',','.');
	$real53	 = number_format($p[real53],0,',','.');	  


	

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('arialnarrowBold','',10.5);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(94,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(30,6,$pagu51,1,0,'R',1);
	$pdf->Cell(30,6,$real51,1,0,'R',1); 
	$pdf->Cell(30,6,$pagu52,1,0,'R',1);
	$pdf->Cell(30,6,$real52,1,0,'R',1);
	$pdf->Cell(30,6,$pagu53,1,0,'R',1);
	$pdf->Cell(30,6,$real53,1,0,'R',1);
//	$pdf->Cell(30,6,'0',1,0,'R',1);
//	$pdf->Cell(30,6,'0',1,0,'R',1);
	

   
	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
$row = mysql_fetch_array($sql);



$pdf->SetFont('arialnarrow','',10.5);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');

$pdf->SetY($ng+5);
$pdf->SetX(190); 
$pdf->Cell(0,15,$row['an'],0,1,'C');
$pdf->SetY($ng+5);
$pdf->SetX(190); 
$pdf->Cell(0,25,$row['pejabat1'],0,1,'C');
$pdf->SetY($ng+5);
$pdf->SetX(190); 
$pdf->Cell(0,55,$row['nama'],0,1,'C');
$pdf->SetY($ng+5);
$pdf->SetX(190); 
$pdf->Cell(0,65,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
