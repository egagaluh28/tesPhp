<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";

define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');

// new
// ukuran a4 = 210 x 297 mm
$pdf=new FPDF('L','mm','A4');
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
// KOP

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($kop);

//$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
//$z = mysql_fetch_array($lamp);
	
$kop=$x[panjang_kop];
$grs=$x[panjang_grs];

//$garis=$z[panjang_grs];
//$posisi=$z[posisi_grs];
/*
$pdf->Sety(18); 
$pdf->SetX(15); 
$pdf->Cell($kop,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($kop,5,$x[kop2],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($grs,0,'                             ',0,0,'C',1); 



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
*/



/*
$pdf->SetFont('Arial','',11);
$pdf->Sety(18); 
$pdf->SetX($posisi); 
$pdf->Cell(10,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi); 
$pdf->Cell(10,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi); 
$pdf->Cell(10,5,'Tanggal',0,0,'L',1);

$pdf->Sety(33); 
$pdf->SetX($posisi+1);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);
 */  
	 $sql= mysql_query("select x.kdakun, x.nmakun, z.thang, z.kdkotama, z.kdsatker, z.pagurevisi, z.jan, z.feb, z.mar, z.apr, z.mei, z.jun, z.jul, z.agu, z.sep, z.okt, z.nop, z.des
from t_akun_gaji x
left join (SELECT a.thang, a.kdkotama, a.kdsatker, a.kdakun, a.nmakun, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
FROM dipa a 
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jan from realisasi where kdbulan='01' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as d on a.kdakun=d.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as feb from realisasi where kdbulan='02' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as e on a.kdakun=e.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mar from realisasi where kdbulan='03' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as f on a.kdakun=f.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as apr from realisasi where kdbulan='04' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as g on a.kdakun=g.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mei from realisasi where kdbulan='05' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as h on a.kdakun=h.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jun from realisasi where kdbulan='06' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as i on a.kdakun=i.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jul from realisasi where kdbulan='07' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as j on a.kdakun=j.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as agu from realisasi where kdbulan='08' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as k on a.kdakun=k.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as sep from realisasi where kdbulan='09' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as l on a.kdakun=l.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as okt from realisasi where kdbulan='10' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as m on a.kdakun=m.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as nop from realisasi where kdbulan='11' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as n on a.kdakun=n.kdakun  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as des from realisasi where kdbulan='12' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdakun) as o on a.kdakun=o.kdakun  
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by   a.kdakun order by  a.kdakun) as z on x.kdakun=z.kdakun group by x.kdakun"); 
	

	
	
$pdf->Ln(10); 
// header
$pdf->SetY(37);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'LAPORAN PENGAWASAN GAJI DAN TUNJANGAN KINERJA',0,1,'C'); 

$pdf->SetY(42); 
$pdf->SetX(8); 
$pdf->Cell(0,5,'TAHUN '. $_GET[thang],0,1,'C');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->SetY(55); 
$pdf->SetX(10); 
$pdf->Cell(8,10,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(18); 
$pdf->Cell(13,10,'AKUN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(31);
$pdf->Cell(60,10,'URAIAN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(91);
$pdf->Cell(125,5,'PENARIKAN','LRTB',0,'C',1); 



$pdf->SetY(60); 
$pdf->SetX(91);
$pdf->Cell(25,5,'AGUSTUS','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(116);
$pdf->Cell(25,5,'SEPTEMBER','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(141);
$pdf->Cell(25,5,'OKTOBER','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(166);
$pdf->Cell(25,5,'NOPEMBER','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(191);
$pdf->Cell(25,5,'DESEMBER','LRB',0,'C',1);

$pdf->SetY(55); 
$pdf->SetX(216);
$pdf->Cell(28,10,'JUMLAH',1,0,'C',1);

$pdf->SetY(55); 
$pdf->SetX(244);
$pdf->Cell(15,5,'DAYA','LRT',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(244);
$pdf->Cell(15,5,'SERAP','LRB',0,'C',1);

$pdf->SetY(55); 
$pdf->SetX(259);
$pdf->Cell(28,10,'SISA','LRTB',0,'C',1);

$pdf->Ln();
$pdf->SetX(10); 
$pdf->Cell(8,5,'1',1,0,'C',1); 
$pdf->Cell(13,5,'2',1,0,'C',1); 
$pdf->Cell(60,5,'3',1,0,'C',1);
$pdf->Cell(25,5,'11',1,0,'C',1); 
$pdf->Cell(25,5,'12',1,0,'C',1); 
$pdf->Cell(25,5,'13',1,0,'C',1); 
$pdf->Cell(25,5,'14',1,0,'C',1); 
$pdf->Cell(25,5,'15',1,0,'C',1); 
$pdf->Cell(28,5,'16',1,0,'C',1); 
$pdf->Cell(15,5,'17',1,0,'C',1); 
$pdf->Cell(28,5,'18',1,0,'C',1); 


$pdf->Ln();

$hal=1;

$i = 0; 
$no=1;


//Set maximum rows per page
//$max = 18;
//Set Row Height
$row_height = 5;
// data
while($k = mysql_fetch_array($sql)) {

  
     
     $max=22;
  
 

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
    $pdf->SetFont('Arial','',8);
   $pdf->SetFillColor(255,255,255);

$pdf->SetY(20); 
$pdf->SetX(10); 
$pdf->Cell(8,10,'NO',1,0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(18); 
$pdf->Cell(13,10,'AKUN',1,0,'C',1); 


$pdf->SetY(20); 
$pdf->SetX(31);
$pdf->Cell(60,10,'URAIAN',1,0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(91);
$pdf->Cell(125,5,'PENARIKAN','LRTB',0,'C',1); 



$pdf->SetY(25); 
$pdf->SetX(91);
$pdf->Cell(25,5,'AGUSTUS',1,0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(116);
$pdf->Cell(25,5,'SEPTEMBER',1,0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(141);
$pdf->Cell(25,5,'OKTOBER',1,0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(166);
$pdf->Cell(25,5,'NOPEMBER',1,0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(191);
$pdf->Cell(25,5,'DESEMBER',1,0,'C',1);

$pdf->SetY(20); 
$pdf->SetX(216);
$pdf->Cell(28,10,'JUMLAH',1,0,'C',1);

$pdf->SetY(20); 
$pdf->SetX(244);
$pdf->Cell(15,5,'DAYA','LRT',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(244);
$pdf->Cell(15,5,'SERAP','LRB',0,'C',1);

$pdf->SetY(20); 
$pdf->SetX(259);
$pdf->Cell(28,10,'SISA','LRTB',0,'C',1);
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    
    $pdf->SetY(30); 
    $pdf->SetX(10); 
    $pdf->Cell(8,5,'1',1,0,'C',1); 
	$pdf->Cell(13,5,'2',1,0,'C',1); 
	$pdf->Cell(60,5,'3',1,0,'C',1);
	$pdf->Cell(25,5,'4',1,0,'C',1); 
	$pdf->Cell(25,5,'5',1,0,'C',1); 
	$pdf->Cell(25,5,'6',1,0,'C',1); 
	$pdf->Cell(25,5,'7',1,0,'C',1); 
	$pdf->Cell(25,5,'8',1,0,'C',1); 
	$pdf->Cell(28,5,'9',1,0,'C',1); 
	$pdf->Cell(15,5,'10',1,0,'C',1); 
	$pdf->Cell(28,5,'11',1,0,'C',1); 
	

   //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

	$hasil	 = number_format($k[pagurevisi],0,',','.');
	$jan  = number_format($k[jan],0,',','.');
	$feb  = number_format($k[feb],0,',','.');
	$mar  = number_format($k[mar],0,',','.');
	$apr  = number_format($k[apr],0,',','.');
	$mei  = number_format($k[mei],0,',','.');
	$jun  = number_format($k[jun],0,',','.');
	$jul  = number_format($k[jul],0,',','.');
	$agu  = number_format($k[agu],0,',','.');
	$sep  = number_format($k[sep],0,',','.');
	$okt  = number_format($k[okt],0,',','.');
	$nop  = number_format($k[nop],0,',','.');
	$des  = number_format($k[des],0,',','.');
	
	$tarik = $k[jan] + $k[feb] + $k[mar] + $k[apr] + $k[mei] + $k[jun] + $k[jul] + $k[agu] + $k[sep] + $k[okt] + $k[nop] + $k[des];
	
	$jtarik  = number_format($tarik,0,',','.');
	
	$turahanx = $k[pagurevisi] - $tarik;
	$sisax  = number_format($turahanx,0,',','.');
	
	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($tarik/$k[pagurevisi])*100);
	$prosen_des  = number_format($prosen,2,',','.');
	}


	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(10); 
		$ng = $pdf->GetY(); 
	    $pdf->Cell(8,5,$no,'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(18);
		$pdf->Cell(13,5,$k[kdakun],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(31);
		$pdf->Cell(60,5,$k[nmakun],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(91);
		$pdf->Cell(25,5,$agu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(116);
		$pdf->Cell(25,5,$sep,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(141);
		$pdf->Cell(25,5,$okt,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(166);
		$pdf->Cell(25,5,$nop,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(191);
		$pdf->Cell(25,5,$des,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(216);
		$pdf->Cell(28,5,$jtarik,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(244);
		$pdf->Cell(15,5,$prosen_des,'LR',1,'C',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(259);
		$pdf->Cell(28,5,$sisax,'LR',1,'R',2); 
		
		
	
		
	
	$i++;
	$no++;
		
	}
		
		
		



$jml=mysql_query("SELECT a.kdkotama, a.kdsatker, a.thang,  sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  d.jan, e.feb, f.mar, g.apr, h.mei, i.jun, j.jul, k.agu, l.sep, m.okt, n.nop, o.des
FROM dipa a 
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jan from realisasi where kdbulan='01' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as d on a.kdkotama=d.kdkotama and a.kdsatker=d.kdsatker and a.thang=d.thang
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as feb from realisasi where kdbulan='02' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as e on a.kdkotama=e.kdkotama and a.kdsatker=e.kdsatker and a.thang=e.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mar from realisasi where kdbulan='03' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as f on a.kdkotama=f.kdkotama and a.kdsatker=f.kdsatker and a.thang=f.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as apr from realisasi where kdbulan='04' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as g on a.kdkotama=g.kdkotama and a.kdsatker=g.kdsatker and a.thang=g.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as mei from realisasi where kdbulan='05' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as h on a.kdkotama=h.kdkotama and a.kdsatker=h.kdsatker and a.thang=h.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jun from realisasi where kdbulan='06' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as i on a.kdkotama=i.kdkotama and a.kdsatker=i.kdsatker and a.thang=i.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as jul from realisasi where kdbulan='07' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as j on a.kdkotama=j.kdkotama and a.kdsatker=j.kdsatker and a.thang=j.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as agu from realisasi where kdbulan='08' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as k on a.kdkotama=k.kdkotama and a.kdsatker=k.kdsatker and a.thang=k.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as sep from realisasi where kdbulan='09' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as l on a.kdkotama=l.kdkotama and a.kdsatker=l.kdsatker and a.thang=l.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as okt from realisasi where kdbulan='10' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as m on a.kdkotama=m.kdkotama and a.kdsatker=m.kdsatker and a.thang=m.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as nop from realisasi where kdbulan='11' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as n on a.kdkotama=n.kdkotama and a.kdsatker=n.kdsatker and a.thang=n.thang  
left join (select  kdakun, kdkotama, kdsatker, thang, sum(realisasi) as des from realisasi where kdbulan='12' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]'  group by kdkotama,kdsatker,thang) as o on a.kdkotama=o.kdkotama and a.kdsatker=o.kdsatker and a.thang=o.thang  
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' 
group by   a.kdkotama, a.kdsatker, a.thang "); 
$x = mysql_fetch_array($jml);	

	
		
		$hasilx	 = number_format($x[pagurevisi],0,',','.');
		$jan  = number_format($x[jan],0,',','.');
		$feb  = number_format($x[feb],0,',','.');
		$mar  = number_format($x[mar],0,',','.');
		$apr  = number_format($x[apr],0,',','.');
		$mei  = number_format($x[mei],0,',','.');
		$jun  = number_format($x[jun],0,',','.');
		$jul  = number_format($x[jul],0,',','.');
		$agu  = number_format($x[agu],0,',','.');
		$sep  = number_format($x[sep],0,',','.');
		$okt  = number_format($x[okt],0,',','.');
		$nop  = number_format($x[nop],0,',','.');
		$des  = number_format($x[des],0,',','.');
		
		$jmltarik = $x[jan] + $x[feb] + $x[mar] + $x[apr] + $x[mei] + $x[jun] + $x[jul] + $x[agu] + $x[sep] + $x[okt] + $x[nop] + $x[des];
	
	$tottarik  = number_format($jmltarik,0,',','.');
	
	$jturahanx = $x[pagurevisi] - $jmltarik;
	$jsisax  = number_format($jturahanx,0,',','.');
	
	if (($x[pagurevisi]=='') or ($x[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$jprosen 	= (($jmltarik/$x[pagurevisi])*100);
	$jprosen_des  = number_format($jprosen,2,',','.');
	}

	$ng = $pdf->GetY(); 
    $pdf->SetX(10); 
	$pdf->SetFont('Arial','B',8);
    $pdf->Cell(8,6,'',1,0,'C',1); 
	$pdf->Cell(73,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(25,6,$agu,1,0,'R',1);
	$pdf->Cell(25,6,$sep,1,0,'R',1);
	$pdf->Cell(25,6,$okt,1,0,'R',1);
	$pdf->Cell(25,6,$nop,1,0,'R',1);
	$pdf->Cell(25,6,$des,1,0,'R',1);
	$pdf->Cell(28,6,$jun,1,0,'R',1);
	$pdf->Cell(15,6,$jprosen_des,1,0,'C',1);
	$pdf->Cell(28,6,$jsisax,1,0,'R',1);

	
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' "); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('Arial','',10);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');

$pdf->SetY($ng+10);
$pdf->SetX(190); 
$pdf->Cell(0,20,$row['an'],0,1,'C');
$pdf->SetY($ng+10);
$pdf->SetX(190); 
$pdf->Cell(0,30,$row['pejabat1'],0,1,'C');
$pdf->SetY($ng+10);
$pdf->SetX(190); 
$pdf->Cell(0,60,$row['nama'],0,1,'C');
$pdf->SetY($ng+10);
$pdf->SetX(190); 
$pdf->Cell(0,70,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
