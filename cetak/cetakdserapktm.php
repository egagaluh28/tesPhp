<?php error_reporting(0);
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
//$pdf->AddFont('arialnarrow','','arialnarrow.php');
//$pdf->AddFont('arialnarrowBold','','arialnarrowBold.php');
$pdf->SetFont('arial','',11);
$pdf->AddPage();
// KOP

$rowop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($rowop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); 
$z = mysql_fetch_array($lamp);
	
$rowop=$x['panjang_kop']+14;
$grs=$x['panjang_grs']+12;

$garis=$z['panjang_grs']+13;
$posisi=$z['posisi_grs'];


if ($x['kop1']=='') {
	
$pdf->Sety(18); 
$pdf->SetX(15); 
$pdf->Cell($rowop,5,'',0,1,'C');	
} else {
$pdf->Sety(18); 
$pdf->SetX(15); 
$pdf->Cell($rowop,5,$x['kop1'],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($rowop,5,$x['kop2'],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($grs,0,'                             ',0,0,'C',1); 
}


if ($z['brs1']=='') {
	
	$pdf->Sety(18); 
	$pdf->SetX(210); 
	$pdf->Cell(0,5,'',0,0,'R',0);

} else {	

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arial','',11);
$pdf->Sety(18); 
$pdf->SetX(235); 
$pdf->Cell(0,5,$z['brs1'],0,0,'R',1);
$pdf->Sety(23); 
$pdf->SetX(235); 
$pdf->Cell(0,5,$z['brs2'],0,0,'R',1);
$pdf->Sety(28); 
$pdf->SetX(235); 
$pdf->Cell(0,5,$z['brs3'],0,0,'R',1);
$pdf->Sety(33); 

$pdf->Sety(33.2); 
$pdf->SetX($posisi-10);
$pdf->Cell($garis,0,'                             ','T',0,'C',1);

$pdf->Sety(18); 
$pdf->SetX($posisi-12); 
$pdf->Cell(12,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(23); 
$pdf->SetX($posisi-12); 
$pdf->Cell(12,5,'Nomor ',0,0,'L',1);
$pdf->Sety(28); 
$pdf->SetX($posisi-12); 
$pdf->Cell(12,5,'Tanggal',0,0,'L',1);

}
   
	 $sql= mysql_query("select a.kdkotama as display,  a.nmkotama as uraian, b.pagu, b.revisi, b.pagurevisi, c.blnlalu, d.blnini from t_kotam a 
left join (select kdkotama, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where kdkotama='$_GET[kdkotama]' and thang='$_GET[thang]' group by kdkotama, thang) as b on a.kdkotama=b.kdkotama
left join (select kdkotama, sum(realisasi) as blnlalu from realisasi where kdkotama='$_GET[kdkotama]' and kdbulan<'$_GET[kdbulan]' and thang='$_GET[thang]' group by kdkotama, thang) as c on a.kdkotama=c.kdkotama
left join (select kdkotama, sum(realisasi) as blnini from realisasi where kdkotama='$_GET[kdkotama]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]' group by kdkotama, thang) as d on a.kdkotama=d.kdkotama where a.kdkotama='$_GET[kdkotama]'
union
select concat(a.kdkotama,a.kdsatkr) as display,  a.nmsatkr as uraian, b.pagu, b.revisi, b.pagurevisi,  c.blnlalu, d.blnini from t_satkr a 
left join (select kdsatker, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where kdkotama='$_GET[kdkotama]' and  thang='$_GET[thang]' group by kdsatker, thang) as b on a.kdsatkr=b.kdsatker
left join (select kdsatker, sum(realisasi) as blnlalu from realisasi where kdkotama='$_GET[kdkotama]' and kdbulan<'$_GET[kdbulan]' and thang='$_GET[thang]' group by kdsatker, thang) as c on a.kdsatkr=c.kdsatker
left join (select kdsatker, sum(realisasi) as blnini from realisasi where kdkotama='$_GET[kdkotama]' and  kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]' group by kdsatker, thang) as d on a.kdsatkr=d.kdsatker
where a.kdkotama='$_GET[kdkotama]'
order by display"); 
	
$tcount=mysql_num_rows($sql);

switch ($_GET['kdbulan']) {
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
$thang= $_GET['thang'];	
$indbul=$bulan;

	
$pdf->Ln(10); 
// header
$pdf->SetY(38);
$pdf->SetFont('arial','',11);
$pdf->Cell(0,5,'LAPORAN DAYA SERAP SATUAN JAJARAN TNI AD',0,1,'C'); 
$pdf->SetY(43); 
$pdf->Cell(0,5,'PERIODE BULAN '. $indbul.' '.' TAHUN '.' '.$thang,0,1,'C');



$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arial','',10);
$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(25); 
$pdf->Cell(80,12,'SATUAN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(105);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(105);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(135);
$pdf->Cell(90,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(135);
$pdf->Cell(30,6,'S.D. BLN LALU',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(165);
$pdf->Cell(30,6,'BLN INI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(195);
$pdf->Cell(30,6,'S.D. BLN INI',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(225);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(225);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(255);
$pdf->Cell(15,6,'%','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(255);
$pdf->Cell(15,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(270); 
$pdf->Cell(15,12,'KET',1,0,'C',1); 


	$pdf->Ln();
	$pdf->SetX(15); 
	$pdf->Cell(10,5,'1',1,0,'C',1); 
	$pdf->Cell(80,5,'2',1,0,'C',1); 
	$pdf->Cell(30,5,'3',1,0,'C',1);
	$pdf->Cell(30,5,'4',1,0,'C',1); 
	$pdf->Cell(30,5,'5',1,0,'C',1);
	$pdf->Cell(30,5,'6',1,0,'C',1);
	$pdf->Cell(30,5,'7',1,0,'C',1);
	$pdf->Cell(15,5,'8',1,0,'C',1);
	$pdf->Cell(15,5,'9',1,0,'C',1);

$pdf->Ln(5.2);


	

$hal=1;

$i = 0; 
$no=1;
$abjad='a';
$tempAbjad = null;

$romawi=1;
$tempRomawi = null;
//Set maximum rows per page ambil dari field nilai pada tajuk tanda tangan
//$brsttd=mysql_query("SELECT * from baris where id='1' "); 
//$n = mysql_fetch_array($brsttd);

$max=18;

//Set Row Height
$row_height = 6;
// data


while($row = mysql_fetch_array($sql)) {

//if (($hal) == '1') {   
 //    $max=$baris;
 //  } else {	 $max=28; }

if ($max==$i) 
  {
  $hal++;
   // Print header table show every page
   $pdf->AddPage();
   $pdf->SetFillColor(255,255,255);
   $ng = $pdf->GetY(); 
   $pdf->SetX(13); 
   
   $pdf->SetFont('arial','',11);
   $pdf->Cell(0,5,$hal,0,1,'C');
   
 $pdf->SetFillColor(255,255,255);
$pdf->SetFont('arial','',10);
$pdf->SetY(18); 
$pdf->SetX(15); 
$pdf->Cell(10,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(25); 
$pdf->Cell(80,12,'SATUAN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(105);
$pdf->Cell(30,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(105);
$pdf->Cell(30,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(135);
$pdf->Cell(90,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(135);
$pdf->Cell(30,6,'S.D. BLN LALU',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(165);
$pdf->Cell(30,6,'BLN INI',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(195);
$pdf->Cell(30,6,'S.D. BLN INI',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(225);
$pdf->Cell(30,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(225);
$pdf->Cell(30,6,'(6-9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(255);
$pdf->Cell(15,6,'%','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(255);
$pdf->Cell(15,6,'(6:9)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(270); 
$pdf->Cell(15,12,'KET',1,0,'C',1); 
 

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',10);
    $pdf->SetY(30); 
    $pdf->SetX(15); 
	$pdf->Cell(10,5,'1',1,0,'C',1); 
	$pdf->Cell(80,5,'2',1,0,'C',1); 
	$pdf->Cell(30,5,'3',1,0,'C',1);
	$pdf->Cell(30,5,'4',1,0,'C',1); 
	$pdf->Cell(30,5,'5',1,0,'C',1);
	$pdf->Cell(30,5,'6',1,0,'C',1);
	$pdf->Cell(30,5,'7',1,0,'C',1);
	$pdf->Cell(15,5,'8',1,0,'C',1);
	$pdf->Cell(15,5,'9',1,0,'C',1);

   


 
   //Go to next row
   
   
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln(5.2);
  } 

	$pagu 			= number_format($row['pagu'],0,',','.');
	$revisi 		= number_format($row['revisi'],0,',','.');
	$pagurevisi		= number_format($row['pagurevisi'],0,',','.');
	$lalu			= number_format($row['blnlalu'],0,',','.');
	$ini			= number_format($row['blnini'],0,',','.');
	$blnsdi = $row['blnlalu'] + $row['blnini'];
	$sdi			= number_format($blnsdi,0,',','.');
	
	$turahan = $row['pagurevisi'] - $blnsdi;
	$sisa			= number_format($turahan,0,',','.');
	
	//-------------------------------------------
	if (($row['pagurevisi']=='') or ($row['pagurevisi']=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($blnsdi/$row['pagurevisi'])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
	//--------------------------------------------------


	
	$uraian=strtoupper($row['uraian'],0,60);
//	$hasiluraian =ucwords($uraian);
	
	$str = $row['display'];
    $pj = strlen($str);
	$pdf->SetFont('arial','',9.5);
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetX(15);
		$ng = $pdf->GetY(); 
	if ($pj=='2') {	
	   
		$pdf->Cell(10,5,$romawi.'.','LR',1,'C',2);
		
		$tempRomawi = $romawi;
        $romawi++;		
		
	} else if ($pj=='8') {	
	    $pdf->SetFont('arial','',9.5);
		if($tempRomawi != $romawi)
		{
			$no='a';
			$tempRomawi = $romawi;
		}else{
		
		}	
		$pdf->Cell(10,5,$no.''.'.','LR',1,'R',1);
		
		$tempNo = $no;
        $no++;		
	
	   	
	} else {
	$pdf->Cell(10,5,'','LR',1,'C',2);
	}
	
	$uraian=strtoupper($row['uraian']);
	
	if ($pj =='2' ) { // jika digit kurang dari 14 dicetak tebal (sampai kode output)
		$pdf->SetFont('Arial','B',9.5);
	    $pdf->SetY($ng);
		$pdf->SetX(25);
		$pdf->Cell(80,5,$uraian,'LR',1,'L',2);
		
		
		$pdf->SetY($ng);
		$pdf->SetX(105);
		$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(135);
		$pdf->Cell(30,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(165);
		$pdf->Cell(30,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(195);
		$pdf->Cell(30,5,$sdi,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(225);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(255);	
		
		if ($prosen>='100') {		
		$pdf->Cell(15,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(15,5,$prosen_des,'LR',1,'C',2);	
		}
	    
		$pdf->SetY($ng);
		$pdf->SetX(270);
		$pdf->Cell(15,5,'','LR',1,'R',2); 
	
	
	
	} else {

		$pdf->SetY($ng);
		$pdf->SetX(25);
		$pdf->Cell(80,5,$uraian,'LR',1,'L',2);
		
		
		$pdf->SetY($ng);
		$pdf->SetX(105);
		$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(135);
		$pdf->Cell(30,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(165);
		$pdf->Cell(30,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(195);
		$pdf->Cell(30,5,$sdi,'LR',1,'R',2); 
		$pdf->SetY($ng);
		$pdf->SetX(225);
		$pdf->Cell(30,5,$sisa,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(255);	
		
		if ($prosen>='100') {		
		$pdf->Cell(15,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(15,5,$prosen_des,'LR',1,'C',2);	
		}
	    
		$pdf->SetY($ng);
		$pdf->SetX(270);
		$pdf->Cell(15,5,'','LR',1,'R',2); 
	
		
	} 
		
			 
		 /*
		$pdf->SetFont('arial','',10);
		$pdf->SetY($ng);
		$pdf->SetX(16);
	    $pdf->Cell(22,5,$row['kode'],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(38);
	    $pdf->Cell(14,5,$row['kdsatker'],'LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(52);
	    $pdf->Cell(90,5,$row['uraian'],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(142);
	    $pdf->Cell(29,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(171);
	    $pdf->Cell(29,5,$rev,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(200);
	    $pdf->Cell(29,5,$pagrev,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(229);
	    $pdf->Cell(29,5,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(258);
	    $pdf->Cell(20,5,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(278);
	    $pdf->Cell(29,5,$sisa,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(307);
	    $pdf->Cell(15,5,'','LR',1,'R',2);
		
		*/
		
	
	
		
		$i++;
		//$no++;
		
		
} 

	
    $pdf->SetX(15); 
    $pdf->Cell(10,2,'','LRB',0,'C',1); 
	$pdf->Cell(80,2,'','LRB',0,'C',1); 
	$pdf->Cell(30,2,'','LRB',0,'C',1); 
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(30,2,'','LRB',0,'C',1);
	//$pdf->Cell(30,2,'','LRB',0,'C',1);
	$pdf->Cell(15,2,'','LRB',0,'C',1);
	$pdf->Cell(15,2,'','LRB',0,'C',1);
	
	
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
