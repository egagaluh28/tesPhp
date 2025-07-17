<?php error_reporting(0);
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
$pdf->AddFont('arialnarrow','','arialnarrow.php');
$pdf->AddFont('arialnarrowBold','','arialnarrowBold.php');
$pdf->SetFont('arialnarrow','',10);
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

if ($x['kop1']=='') {
	
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop,5,'',0,1,'C');	
} else {
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop-5,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($kop-5,5,$x[kop2],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($grs-5,0,'                             ',0,0,'C',1); 
}


if ($z['brs1']=='') {
	
	$pdf->Sety(18); 
	$pdf->SetX(285); 
	$pdf->Cell(0,5,'',0,0,'R',0);

} else {	

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',10);
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
$pdf->SetX($posisi+51);
$pdf->Cell($garis-10,0,'                             ','T',0,'C',1);

$pdf->Sety(18); 
$pdf->SetX($posisi+50); 
$pdf->Cell(12,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi+50); 
$pdf->Cell(12,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi+50); 
$pdf->Cell(12,5,'Tanggal',0,0,'L',1);

}
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
$pdf->SetFont('arialnarrow','',10);
$pdf->Cell(0,5,'REALISASI GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA',0,1,'C'); 

$pdf->SetY(42); 
$pdf->SetX(8); 
$pdf->Cell(0,5,'TAHUN '. $_GET[thang],0,1,'C');


$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',7);
$pdf->SetY(55); 
$pdf->SetX(8);
$pdf->Cell(5,10,'NO',1,0,'C',1); 
$pdf->Cell(10,10,'AKUN',1,0,'C',1); 
$pdf->Cell(40,10,'URAIAN',1,0,'C',1); 
$pdf->Cell(18,10,'DIPA TA'.' '.$_GET[thang],1,0,'C',1);
$pdf->Cell(204,5,'PENARIKAN',1,0,'C',1); 
$pdf->Cell(18,10,'JUMLAH',1,0,'C',1); 
$pdf->Cell(7,10,'%',1,0,'C',1); 
$pdf->Cell(18,10,'SISA',1,0,'C',1); 

$pdf->SetY(60); 
$pdf->SetX(81);
$pdf->Cell(17,5,'JANUARI',1,0,'C',1); 
$pdf->Cell(17,5,'FEBRUARI',1,0,'C',1);
$pdf->Cell(17,5,'MARET',1,0,'C',1);
$pdf->Cell(17,5,'APRIL',1,0,'C',1);
$pdf->Cell(17,5,'MEI',1,0,'C',1);
$pdf->Cell(17,5,'JUNI',1,0,'C',1);
$pdf->Cell(17,5,'JULI',1,0,'C',1);
$pdf->Cell(17,5,'AGUSTUS',1,0,'C',1);
$pdf->Cell(17,5,'SEPTEMBER',1,0,'C',1);
$pdf->Cell(17,5,'OKTOBER',1,0,'C',1);
$pdf->Cell(17,5,'NOVEMBER',1,0,'C',1);
$pdf->Cell(17,5,'DESEMBER',1,0,'C',1);





	$pdf->Ln();
	$pdf->SetX(8);
	$pdf->Cell(5,5,'1',1,0,'C',1); 
	$pdf->Cell(10,5,'2',1,0,'C',1); 
	$pdf->Cell(40,5,'3',1,0,'C',1);
	$pdf->Cell(18,5,'4',1,0,'C',1); 
	$pdf->Cell(17,5,'5',1,0,'C',1); 
	$pdf->Cell(17,5,'6',1,0,'C',1); 
	$pdf->Cell(17,5,'7',1,0,'C',1); 
	$pdf->Cell(17,5,'8',1,0,'C',1); 
	$pdf->Cell(17,5,'9',1,0,'C',1); 
	$pdf->Cell(17,5,'10',1,0,'C',1); 
	$pdf->Cell(17,5,'11',1,0,'C',1);
	$pdf->Cell(17,5,'12',1,0,'C',1); 
	$pdf->Cell(17,5,'13',1,0,'C',1); 
	$pdf->Cell(17,5,'14',1,0,'C',1); 
	$pdf->Cell(17,5,'15',1,0,'C',1); 
	$pdf->Cell(17,5,'16',1,0,'C',1); 
	$pdf->Cell(18,5,'17',1,0,'C',1);
	$pdf->Cell(7,5,'18',1,0,'C',1);
	$pdf->Cell(18,5,'19',1,0,'C',1);
	


//$pdf->Ln(5.2);

$hal=1;

$i = 0; 
$no=1;


//Set maximum rows per page
//$max = 17;
//Set Row Height
$row_height = 5;
// data
while($k = mysql_fetch_array($sql)) {

  
     
     $max=25;
  
 

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   $pdf->SetFont('arialnarrow','',10);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
    $pdf->SetFont('arialnarrow','',7);
   $pdf->SetFillColor(255,255,255);

$pdf->SetY(20); 
$pdf->SetX(8);
$pdf->Cell(5,10,'NO',1,0,'C',1); 
$pdf->Cell(10,10,'AKUN',1,0,'C',1); 
$pdf->Cell(40,10,'URAIAN',1,0,'C',1); 
$pdf->Cell(18,10,'DIPA TA'.' '.$_GET[thang],1,0,'C',1);
$pdf->Cell(204,5,'PENARIKAN',1,0,'C',1); 
$pdf->Cell(18,10,'JUMLAH',1,0,'C',1); 
$pdf->Cell(7,10,'%',1,0,'C',1); 
$pdf->Cell(18,10,'SISA',1,0,'C',1); 

$pdf->SetY(25); 
$pdf->SetX(81);
$pdf->Cell(17,5,'JANUARI',1,0,'C',1); 
$pdf->Cell(17,5,'FEBRUARI',1,0,'C',1);
$pdf->Cell(17,5,'MARET',1,0,'C',1);
$pdf->Cell(17,5,'APRIL',1,0,'C',1);
$pdf->Cell(17,5,'MEI',1,0,'C',1);
$pdf->Cell(17,5,'JUNI',1,0,'C',1);
$pdf->Cell(17,5,'JULI',1,0,'C',1);
$pdf->Cell(17,5,'AGUSTUS',1,0,'C',1);
$pdf->Cell(17,5,'SEPTEMBER',1,0,'C',1);
$pdf->Cell(17,5,'OKTOBER',1,0,'C',1);
$pdf->Cell(17,5,'NOVEMBER',1,0,'C',1);
$pdf->Cell(17,5,'DESEMBER',1,0,'C',1);
   

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(5,5,'1',1,0,'C',1); 
	$pdf->Cell(10,5,'2',1,0,'C',1); 
	$pdf->Cell(40,5,'3',1,0,'C',1);
	$pdf->Cell(18,5,'4',1,0,'C',1); 
	$pdf->Cell(17,5,'5',1,0,'C',1); 
	$pdf->Cell(17,5,'6',1,0,'C',1); 
	$pdf->Cell(17,5,'7',1,0,'C',1); 
	$pdf->Cell(17,5,'8',1,0,'C',1); 
	$pdf->Cell(17,5,'9',1,0,'C',1); 
	$pdf->Cell(17,5,'10',1,0,'C',1); 
	$pdf->Cell(17,5,'11',1,0,'C',1);
	$pdf->Cell(17,5,'12',1,0,'C',1); 
	$pdf->Cell(17,5,'13',1,0,'C',1); 
	$pdf->Cell(17,5,'14',1,0,'C',1); 
	$pdf->Cell(17,5,'15',1,0,'C',1); 
	$pdf->Cell(17,5,'16',1,0,'C',1); 
	$pdf->Cell(18,5,'17',1,0,'C',1);
	$pdf->Cell(7,5,'18',1,0,'C',1);
	$pdf->Cell(18,5,'19',1,0,'C',1);
	

   //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
  // $pdf->Ln(5.2);
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
	
	$jhasilx += $k[pagurevisi];
	$jhasil	 = number_format($jhasilx,0,',','.');
	
	$jjanx += $k[jan];
	$jjan	 = number_format($jjanx,0,',','.');
	
	$jfebx += $k[feb];
	$jfeb	 = number_format($jfebx,0,',','.');
	
	$jmarx += $k[mar];
	$jmar	 = number_format($jmarx,0,',','.');
	
	$japrx += $k[apr];
	$japr	 = number_format($japrx,0,',','.');
	
	$jmeix += $k[mei];
	$jmei	 = number_format($jmeix,0,',','.');
	
	$jjunx += $k[jun];
	$jjun	 = number_format($jjunx,0,',','.');
	
	$jjulx += $k[jul];
	$jjul	 = number_format($jjulx,0,',','.');
	
	$jagux += $k[agu];
	$jagu	 = number_format($jagux,0,',','.');
	
	$jsepx += $k[sep];
	$jsep	 = number_format($jsepx,0,',','.');
	
	$joktx += $k[okt];
	$jokt	 = number_format($joktx,0,',','.');
	
	$jnopx += $k[nop];
	$jnop	 = number_format($jnopx,0,',','.');
	
	$jdesx += $k[des];
	$jdes	 = number_format($jdesx,0,',','.');
	
	$tarik = $k[jan] + $k[feb] + $k[mar] + $k[apr] + $k[mei] + $k[jun] + $k[jul] + $k[agu] + $k[sep] + $k[okt] + $k[nop] + $k[des];
	
	$serap  = number_format($tarik,0,',','.');
	
	$jtarikx += $tarik;
	$jtarik	 = number_format($jtarikx,0,',','.');
	
	
	
	$sisax = $k[pagurevisi] - $tarik;
	$sisa  = number_format($sisax,0,',','.');
	
	$jsisax += $sisax;
	$jsisa	 = number_format($jsisax,0,',','.');
	
	if (($k[pagurevisi]=='') or ($k[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($tarik/$k[pagurevisi])*100);
	$prosen_des  = number_format($prosen,2,',','.');
	}
	
	$jprosenx = $jtarikx / $jhasilx * 100;
	$jprosen  = number_format($jprosenx,2,',','.');

	$pdf->SetFont('arialnarrow','',6.5);
	$pdf->Ln(5); 
    $pdf->SetX(8); 
    $pdf->Cell(5,5,$no,1,0,'C',1); 
	$pdf->Cell(10,5,$k[kdakun],1,0,'C',1); 
	$pdf->Cell(40,5,$k[nmakun],1,0,'L',1);
	$pdf->Cell(18,5,$hasil,1,0,'R',1);
	$pdf->Cell(17,5,$jan,1,0,'R',1);
	$pdf->Cell(17,5,$feb,1,0,'R',1);
	$pdf->Cell(17,5,$mar,1,0,'R',1);
	$pdf->Cell(17,5,$apr,1,0,'R',1);
	$pdf->Cell(17,5,$mei,1,0,'R',1);
	$pdf->Cell(17,5,$jun,1,0,'R',1);
	$pdf->Cell(17,5,$jul,1,0,'R',1);
	$pdf->Cell(17,5,$agu,1,0,'R',1);
	$pdf->Cell(17,5,$sep,1,0,'R',1);
	$pdf->Cell(17,5,$okt,1,0,'R',1);
	$pdf->Cell(17,5,$nop,1,0,'R',1);
	$pdf->Cell(17,5,$des,1,0,'R',1);
	$pdf->Cell(18,5,$serap,1,0,'R',1);
	$pdf->Cell(7,5,$prosen_des,1,0,'C',1);
	$pdf->Cell(18,5,$sisa,1,0,'R',1);

	
	$i++;
	$no++;
		
	}
		


	$pdf->Ln(); 
    $pdf->SetX(8); 
    $pdf->Cell(5,5,$no,1,0,'C',1); 
	$pdf->Cell(50,5,'Jumlah',1,0,'L',1); 
	$pdf->Cell(18,5,$jhasil,1,0,'R',1);
	$pdf->Cell(17,5,$jjan,1,0,'R',1);
	$pdf->Cell(17,5,$jfeb,1,0,'R',1);
	$pdf->Cell(17,5,$jmar,1,0,'R',1);
	$pdf->Cell(17,5,$japr,1,0,'R',1);
	$pdf->Cell(17,5,$jmei,1,0,'R',1);
	$pdf->Cell(17,5,$jjun,1,0,'R',1);
	$pdf->Cell(17,5,$jjul,1,0,'R',1);
	$pdf->Cell(17,5,$jagu,1,0,'R',1);
	$pdf->Cell(17,5,$jsep,1,0,'R',1);
	$pdf->Cell(17,5,$jokt,1,0,'R',1);
	$pdf->Cell(17,5,$jnop,1,0,'R',1);
	$pdf->Cell(17,5,$jdes,1,0,'R',1);
	$pdf->Cell(18,5,$jtarik,1,0,'R',1);
	$pdf->Cell(7,5,$jprosen,1,0,'C',1);
	$pdf->Cell(18,5,$jsisa,1,0,'R',1);

	

$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' "); ;
$row = mysql_fetch_array($sql);


$pdf->Ln(10);
$pdf->SetFont('arialnarrow','',10);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');


$pdf->SetX(190); 
$pdf->Cell(0,5,$row['an'],0,1,'C');
$pdf->Ln(-1);
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['pejabat1'],0,1,'C');
$pdf->Ln(10);
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['nama'],0,1,'C');
$pdf->Ln(-1);
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
