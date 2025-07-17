<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm',array(215, 335));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
// KOP

$rowop= mysql_query("select * from kopstuk where kdkotama='00' and kdsatker='000000'"); 
$x = mysql_fetch_array($rowop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='00' and kdsatker='000000'"); 
$z = mysql_fetch_array($lamp);
	
$rowop=$x[panjang_kop];
$grs=$x[panjang_grs];

$garis=$z[panjang_grs];
$posisi=$z[posisi_grs];



$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell(60,5,'TENTARA NASIONAL INDONESIA',0,1,'C');
$pdf->SetX(10); 
$pdf->Cell(60,5,'MARKAS BESAR ANGKATAN DARAT',0,1,'C');
$pdf->SetX(10); 
$pdf->Cell(60,0,'                             ',0,0,'C',1); 


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);

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
$pdf->SetX($posisi+41);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);

$pdf->Sety(18); 
$pdf->SetX($posisi+40); 
$pdf->Cell(12,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi+40); 
$pdf->Cell(12,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi+40); 
$pdf->Cell(12,5,'Tanggal',0,0,'L',1);

   
	 $sql= mysql_query("select a.kdprogram, a.nmprogram, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from t_program a
left join (select kdprogram, sum(pagurevisi) as pagu51 from dipa where  thang='$_GET[thang]' and kdjenbel='51' group by kdprogram) as b on a.kdprogram=b.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='51' group by a.kdprogram) as b1 on a.kdprogram=b1.kdprogram
left join (select kdprogram, sum(pagurevisi) as pagu52 from dipa where  thang='$_GET[thang]' and kdjenbel='52' group by kdprogram) as c on a.kdprogram=c.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='52' group by a.kdprogram) as c1 on a.kdprogram=c1.kdprogram
left join (select kdprogram, sum(pagurevisi) as pagu53 from dipa where  thang='$_GET[thang]' and kdjenbel='53' group by kdprogram) as d on a.kdprogram=d.kdprogram
left join( select a.kdprogram, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='53' group by a.kdprogram) as d1 on a.kdprogram=d1.kdprogram
where a.kdprogram<>'12' group by a.kdprogram"); 
	

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
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,'PAGU DAN REALISASI PER JENIS BELANJA',0,1,'C');
$pdf->SetY(40); 
$pdf->Cell(0,5,'S.D '. $indbul.' '.' TAHUN '.' '.$thang,0,1,'C');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',9);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,18,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(70,18,'PROGRAM',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(85);
$pdf->Cell(240,6,'PAGU DAN REALISASI PER JENIS BELANJA','LRT',0,'C',1); 


$pdf->SetY(61); 
$pdf->SetX(85);
$pdf->Cell(60,6,'51 BELANJA PEGAWAI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(145);
$pdf->Cell(60,6,'52 BELANJA BARANG',1,0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(205);
$pdf->Cell(60,6,'53 BELANJA MODAL',1,0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(265);
$pdf->Cell(60,6,'57 BELANJA BANTUAN SOSIAL',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(85);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(115);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(145);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(175);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(205);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(235);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(265);
$pdf->Cell(30,6,'PAGU DIPA',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(295);
$pdf->Cell(30,6,'REALISASI',1,0,'C',1); 





$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(70,5,'2',1,0,'C',1); 
$pdf->Cell(30,5,'3',1,0,'C',1);
$pdf->Cell(30,5,'4',1,0,'C',1); 
$pdf->Cell(30,5,'5',1,0,'C',1);
$pdf->Cell(30,5,'6',1,0,'C',1);
$pdf->Cell(30,5,'7',1,0,'C',1);
$pdf->Cell(30,5,'8',1,0,'C',1);
$pdf->Cell(30,5,'9',1,0,'C',1);
$pdf->Cell(30,5,'10',1,0,'C',1);

$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,2,'','LRT',0,'C',1); 
$pdf->Cell(70,2,'','LRT',0,'C',1); 
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1); 
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);

$no=1;
while($row = mysql_fetch_array($sql)) {


  //  $i=0;
 //  $pdf->Ln();

	$pagu51	 = number_format($row[pagu51],0,',','.');
	$real51	 = number_format($row[real51],0,',','.');
	
	$pagu52	 = number_format($row[pagu52],0,',','.');
	$real52	 = number_format($row[real52],0,',','.');
	
	$pagu53	 = number_format($row[pagu53],0,',','.');
	$real53	 = number_format($row[real53],0,',','.');
	
	    $pdf->SetFont('Arial','',9);
	    $pdf->SetX(8);
		$ng = $pdf->GetY(); 
		$pdf->Cell(7,6,$no.''.'.','LR',1,'C',2);
	
		$pdf->SetY($ng);
		$pdf->SetX(15);
	    $pdf->Cell(70,6,$row[nmprogram],'LR',1,'L',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(85);
	    $pdf->Cell(30,6,$pagu51,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(115);
	    $pdf->Cell(30,6,$real51,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(145);
	    $pdf->Cell(30,6,$pagu52,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(175);
	    $pdf->Cell(30,6,$real52,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(205);
	    $pdf->Cell(30,6,$pagu53,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(235);
	    $pdf->Cell(30,6,$real53,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(265);
	    $pdf->Cell(30,6,'0','LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(295);
	    $pdf->Cell(30,6,'0','LR',1,'R',2);
		
		
		
		
		
		$no++;
		
		
} // tutup while $row

//spasi

  

	
 $jml = mysql_query("select   a.thang, b.pagu51, b1.real51, c.pagu52, c1.real52, d.pagu53, d1.real53 from dipa a

left join (select  thang, sum(pagurevisi) as pagu51 from dipa  where  thang='$_GET[thang]' and kdjenbel='51' group by  thang) as b on  a.thang=b.thang

left join (select  a.thang, sum(b.realisasi) as real51 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]'  and a.thang='$_GET[thang]' and a.kdjenbel='51' group by   a.thang) as b1 on  a.thang=b1.thang

left join (select   thang, sum(pagurevisi) as pagu52 from dipa  where  thang='$_GET[thang]' and kdjenbel='52' group by   thang) as c on  a.thang=c.thang

left join (select   a.thang, sum(b.realisasi) as real52 from dipa a left join realisasi b on a.id_pagu=b.id_pagu where b.kdbulan<='$_GET[kdbulan]'  and a.thang='$_GET[thang]' and a.kdjenbel='52' group by    a.thang) as c1 on  a.thang=c1.thang

left join (select   thang, sum(pagurevisi) as pagu53 from dipa  where  thang='$_GET[thang]' and kdjenbel='53' group by   thang) as d on   a.thang=d.thang

left join (select   a.thang, sum(b.realisasi) as real53 from dipa a left join realisasi b on a.id_pagu= b.id_pagu where b.kdbulan<='$_GET[kdbulan]'   and a.thang='$_GET[thang]' and a.kdjenbel='53' group by   a.thang) as d1 on  a.thang=d1.thang

where   a.thang='$_GET[thang]'
group by   a.thang");
      $p    = mysql_fetch_array($jml); 
	  
	   
    $pagu51	 = number_format($p[pagu51],0,',','.');
	$real51	 = number_format($p[real51],0,',','.');
	
	$pagu52	 = number_format($p[pagu52],0,',','.');
	$real52	 = number_format($p[real52],0,',','.');
	
	$pagu53	 = number_format($p[pagu53],0,',','.');
	$real53	 = number_format($p[real53],0,',','.');	  


	

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(70,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(30,6,$pagu51,1,0,'R',1);
	$pdf->Cell(30,6,$real51,1,0,'R',1); 
	$pdf->Cell(30,6,$pagu52,1,0,'R',1);
	$pdf->Cell(30,6,$real52,1,0,'R',1);
	$pdf->Cell(30,6,$pagu53,1,0,'R',1);
	$pdf->Cell(30,6,$real53,1,0,'R',1);
	$pdf->Cell(30,6,'0',1,0,'R',1);
	$pdf->Cell(30,6,'0',1,0,'R',1);
	

   
	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='00' and kdsatker='000000' "); ;
$row = mysql_fetch_array($sql);



$pdf->SetFont('Arial','',10);
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
