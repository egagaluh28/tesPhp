<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm',array(210, 297));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
// KOP

$rowop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($rowop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$z = mysql_fetch_array($lamp);
	
$rowop=$x[panjang_kop];
$grs=$x[panjang_grs];

$garis=$z[panjang_grs];
$posisi=$z[posisi_grs];



$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($rowop,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($rowop,5,$x[kop2],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($grs,0,'                             ',0,0,'C',1); 


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

   
	 $sql= mysql_query("select a.kd_jns_pnbpum as kode, a.kd_jns_pnbpum as display, a.nm_jns_pnbpum as uraian, '' as idpnbpum, '' as vol_target, b.target_tarif, b.target_jumlah, '' as vol_realisasi, d.realisasi_tarif, d.realisasi_jumlah
from t_jns_pnbpum a   
left join (select kd_jns_pnbpum, sum(target_tarif) as target_tarif, sum(target_jumlah) as target_jumlah from pnbpum where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kd_jns_pnbpum) as b on a.kd_jns_pnbpum=b.kd_jns_pnbpum
left join (select kd_jns_pnbpum, sum(realisasi_tarif) as realisasi_tarif, sum(realisasi_jumlah) as realisasi_jumlah from realisasi_pnbpum where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdtw<='$_GET[kdtw]' group by kd_jns_pnbpum) as d on a.kd_jns_pnbpum=d.kd_jns_pnbpum
group by a.kd_jns_pnbpum
union
(select a.kdakun as kode, concat(a.kd_jns_pnbpum,a.kdakun) as display, a.nmakun as uraian, b.idpnbpum, b.vol_target, b.target_tarif, b.target_jumlah, d.vol_realisasi, d.realisasi_tarif, d.realisasi_jumlah from t_akun_pnbpum a
left join (select idpnbpum, kd_jns_pnbpum, kdakun, vol_target, target_tarif, target_jumlah from pnbpum where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kd_jns_pnbpum, kdakun) as b on a.kd_jns_pnbpum=b.kd_jns_pnbpum and a.kdakun=b.kdakun 
left join (select idpnbpum, kd_jns_pnbpum, kdakun, vol_realisasi, sum(realisasi_tarif) as realisasi_tarif, sum(realisasi_jumlah) as realisasi_jumlah from realisasi_pnbpum where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdtw<='$_GET[kdtw]' group by kd_jns_pnbpum, kdakun) as d on a.kd_jns_pnbpum=d.kd_jns_pnbpum and a.kdakun=d.kdakun) 
order by display"); 
	
switch ($_GET[kdtw]) { 
case "1" : $bulan="I";break;
case "2" : $bulan="II";break;
case "3" : $bulan="III";break;
case "4" : $bulan="IV";break;

}

$thang= $_GET[thang];	
$indbul=$bulan;
	
$pdf->Ln(10); 
// header
$pdf->SetY(35);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,'LAPORAN TARGET DAN REALISASI PNBP',0,1,'C');
$pdf->SetY(40); 
$pdf->Cell(0,5,'TRIWULAN : '. $indbul.' '.' TAHUN :'.' '.$thang,0,1,'C');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',7.8);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(12,12,'AKUN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(20); 
$pdf->Cell(100,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(120);
$pdf->Cell(72,6,'TARGET','LRT',0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(120);
$pdf->Cell(12,6,'VOL',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(132);
$pdf->Cell(30,6,'TARIF',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(162);
$pdf->Cell(30,6,'JUMLAH',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(192);
$pdf->Cell(72,6,'REALISASI','LRT',0,'C',1); 

$pdf->SetY(61); 
$pdf->SetX(192);
$pdf->Cell(12,6,'VOL',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(204);
$pdf->Cell(30,6,'TARIF',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(234);
$pdf->Cell(30,6,'JUMLAH',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(264); 
$pdf->Cell(30,12,'SELISIH',1,0,'C',1); 


$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(12,5,'1',1,0,'C',1); 
$pdf->Cell(100,5,'2',1,0,'C',1); 
$pdf->Cell(12,5,'3',1,0,'C',1);
$pdf->Cell(30,5,'4',1,0,'C',1); 
$pdf->Cell(30,5,'5',1,0,'C',1);
$pdf->Cell(12,5,'6',1,0,'C',1);
$pdf->Cell(30,5,'7',1,0,'C',1);
$pdf->Cell(30,5,'8',1,0,'C',1);
$pdf->Cell(30,5,'9',1,0,'C',1);

$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(12,2,'','LRT',0,'C',1); 
$pdf->Cell(100,2,'','LRT',0,'C',1); 
$pdf->Cell(12,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1); 
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(12,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);
$pdf->Cell(30,2,'','LRT',0,'C',1);


$hal=1;

$i = 0; 
$no=1;

//Set maximum rows per page ambil dari field nilai pada tajuk tanda tangan
$brsttd=mysql_query("SELECT * from baris where id='1' "); 
$n = mysql_fetch_array($brsttd);

$baris = 23;
//-------------------------------------------------------------
//Set Row Height
$row_height = 5;
// data
while($row = mysql_fetch_array($sql)) {

if (($hal) == '1') {   
     $max=$baris;
   } else {	 $max=27; }

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
$pdf->SetFont('Arial','',7.8);
$pdf->SetY(18); 
$pdf->SetX(8); 
$pdf->Cell(12,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(20); 
$pdf->Cell(100,12,'URAIAN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(120);
$pdf->Cell(72,6,'TARGET','LRT',0,'C',1); 

$pdf->SetY(24); 
$pdf->SetX(120);
$pdf->Cell(12,6,'VOL',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(132);
$pdf->Cell(30,6,'TARIF',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(162);
$pdf->Cell(30,6,'JUMLAH',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(192);
$pdf->Cell(72,6,'REALISASI','LRT',0,'C',1); 

$pdf->SetY(24); 
$pdf->SetX(192);
$pdf->Cell(12,6,'VOL',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(204);
$pdf->Cell(30,6,'TARIF',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(234);
$pdf->Cell(30,6,'JUMLAH',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(264); 
$pdf->Cell(30,12,'SELISIH',1,0,'C',1); 



   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',7.8);
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(12,5,'1',1,0,'C',1); 
	$pdf->Cell(100,5,'2',1,0,'C',1); 
	$pdf->Cell(12,5,'3',1,0,'C',1);
	$pdf->Cell(30,5,'4',1,0,'C',1); 
	$pdf->Cell(30,5,'5',1,0,'C',1);
	$pdf->Cell(12,5,'6',1,0,'C',1);
	$pdf->Cell(30,5,'7',1,0,'C',1);
	$pdf->Cell(30,5,'8',1,0,'C',1);
	$pdf->Cell(30,5,'9',1,0,'C',1);
	
   //Go to next row
   $y_axis = $y_axis + $row_height;
   
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

	$vol	 = number_format($row[vol_target],0,',','.');
	$tgt	 = number_format($row[target_tarif],0,',','.');
	$jumlah =  number_format($row[target_jumlah],0,',','.');
	
	$vol1	 = number_format($row[vol_realisasi],0,',','.');
	$tgt1	 = number_format($row[realisasi_tarif],0,',','.');
	$jumlah1 =  number_format($row[realisasi_jumlah],0,',','.');
	
	
	$beda = $row[target_jumlah] - $row[realisasi_jumlah];
	$selisih =  number_format($beda,0,',','.');
	
	
	
	$str = $row[display];
    $pj = strlen($str);

	    $pdf->SetX(8);
		$ng = $pdf->GetY(); 
		$pdf->Cell(12,5,$row[kode],'LR',1,'C',2);
	
	
	if ($pj =='1' ) { // jika digit kurang dari 14 dicetak tebal (sampai kode output)
		
	    $pdf->SetFont('Arial','B',7.8);
		$pdf->SetY($ng);
		$pdf->SetX(20);
		$pdf->Cell(100,5,$row[uraian],'LR',1,'L',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(120);
		$pdf->Cell(12,5,'','LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(132);
		$pdf->Cell(30,5,$tgt,'LR',1,'R',2); 
		
		
		$pdf->SetY($ng);
		$pdf->SetX(162);
		$pdf->Cell(30,5,$jumlah,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(192);
		$pdf->Cell(12,5,'','LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(204);
		$pdf->Cell(30,5,$tgt1,'LR',1,'R',2); 
		
		
		$pdf->SetY($ng);
		$pdf->SetX(234);
		$pdf->Cell(30,5,$jumlah1,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(264);
		$pdf->Cell(30,5,$selisih,'LR',1,'R',2); 
	
	
	
	} else {

		$pdf->SetFont('Arial','',7.8);
		$pdf->SetY($ng);
		$pdf->SetX(20);
	    $pdf->Cell(100,5,$row[uraian],'LR',1,'L',2);
		
		
		
		$pdf->SetY($ng);
		$pdf->SetX(324.5);
		$pdf->Cell(7,5,'','LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(132);
		$pdf->Cell(30,5,$tgt,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(162);
		$pdf->Cell(30,5,$jumlah,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(192);
		$pdf->Cell(12,5,'','LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(204);
		$pdf->Cell(30,5,$tgt1,'LR',1,'R',2); 
		
		
		$pdf->SetY($ng);
		$pdf->SetX(234);
		$pdf->Cell(30,5,$jumlah1,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(264);
		$pdf->Cell(30,5,$selisih,'LR',1,'R',2); 
		
	}
	
		$y_axis = $y_axis + $row_height;
		$i++;
		//$no++;
		
		
} // tutup while $row

//spasi

  

	
 $jml = mysql_query("select kdkotama, kdsatker, thang, sum(target_tarif) as target_tarif, sum(target_jumlah) as target_jumlah
from pnbpum a   
where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' 
group by kdkotama, kdsatker, thang");
      $p    = mysql_fetch_array($jml); 
	  
	   
	    $target_tarif	 = number_format($p[target_tarif],0,',','.');
		$target_jumlah	 = number_format($p[target_jumlah],0,',','.');

	
$jml_reals=mysql_query("select kdkotama, kdsatker, thang, sum(realisasi_tarif) as realisasi_tarif, sum(realisasi_jumlah) as realisasi_jumlah from realisasi_pnbpum a   
where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  and kdtw<='$_GET[kdtw]'
group by kdkotama, kdsatker, thang"); 
$p1 = mysql_fetch_array($jml_reals);	

	  $realisasi_tarif	 = number_format($p1[realisasi_tarif],0,',','.');
	  $realisasi_jumlah  = number_format($p1[realisasi_jumlah],0,',','.');
	
	$jbeda = $p[target_jumlah] - $p1[realisasi_jumlah];
	$jselisih =  number_format($jbeda,0,',','.');	
	

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	$pdf->SetFont('Arial','B',7.8);
    $pdf->Cell(12,6,'',1,0,'C',1); 
	$pdf->Cell(100,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(12,6,'',1,0,'C',1);
	$pdf->Cell(30,6,$target_tarif,1,0,'R',1); 
	$pdf->Cell(30,6,$target_jumlah,1,0,'R',1);
	$pdf->Cell(12,6,$pagurevisi,1,0,'R',1);
	$pdf->Cell(30,6,$realisasi_tarif,1,0,'R',1);
	$pdf->Cell(30,6,$realisasi_jumlah,1,0,'R',1);
	$pdf->Cell(30,6,$jselisih,1,0,'R',1);
	

    	
		 $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
    $pdf->Cell(12,0,'','LRB',0,'C',1); 
	$pdf->Cell(100,0,'','LRB',0,'C',1); 
	$pdf->Cell(12,0,'','LRB',0,'C',1);
	$pdf->Cell(30,0,'','LRB',0,'C',1); 
	$pdf->Cell(30,0,'','LRB',0,'C',1);
	$pdf->Cell(12,0,'','LRB',0,'C',1);
	$pdf->Cell(30,0,'','LRB',0,'C',1);
	$pdf->Cell(30,0,'','LRB',0,'C',1);
	$pdf->Cell(30,0,'','LRB',0,'C',1);
	
	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' "); ;
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
