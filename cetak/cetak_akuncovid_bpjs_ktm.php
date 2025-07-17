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
//$pdf->SetFont('Arial','',10);
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

if ($x['kop1']=='') {
	
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop,5,'',0,1,'C');	
} else {
$pdf->Sety(18); 
$pdf->SetX(10); 
$pdf->Cell($kop,5,$x[kop1],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($kop,5,$x[kop2],0,1,'C');
$pdf->SetX(10); 
$pdf->Cell($grs,0,'                             ',0,0,'C',1); 
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

}
   
	 $sql= mysql_query("SELECT  a.kdsatker as display,  '' as kdkotama, a.kdsatker, '' as thang, '' as kdakun, '' as nmakun, b.nmsatkr as nmitem, 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM bpjs a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
left join (select  id_pagu, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as blnlalu from realisasi_bpjs where kdbulan<'$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdsatker) as c on   a.kdsatker=c.kdsatker 
left join (select  id_pagu, kdakun,  kdkotama, kdsatker,  thang, sum(realisasi) as  blnini from realisasi_bpjs where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdsatker) as d on   a.kdsatker=d.kdsatker 
where  a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.kdsatker

union
SELECT  concat(a.kdsatker,a.id_pagu) as display,  a.kdkotama, a.kdsatker, a.thang, a.kdakun, a.nmakun, a.nmitem, 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM bpjs a 
left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as blnlalu from realisasi_bpjs where kdbulan<'$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as c on   a.id_pagu=c.id_pagu 
left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as  blnini from realisasi_bpjs where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as d on   a.id_pagu=d.id_pagu 
where  a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.id_pagu
order by display"); 

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
$pdf->Cell(0,5,'LAPORAN PELAKSANAAN ANGGARAN COVID-19 (BPJS)',0,1,'C');
$pdf->SetY(43); 
$pdf->Cell(0,5,'BULAN '. $indbul.' '.' TAHUN'.' '.$thang,0,1,'C');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',10);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15); 
$pdf->Cell(86,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(101);
$pdf->Cell(16,12,'AKUN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(117);
$pdf->Cell(29,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(55); 
$pdf->SetX(146);
$pdf->Cell(27,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(146);
$pdf->Cell(27,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(173);
$pdf->Cell(29,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(173);
$pdf->Cell(29,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(202);
$pdf->Cell(85,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(202);
$pdf->Cell(29,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(231);
$pdf->Cell(27,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(258);
$pdf->Cell(29,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(287);
$pdf->Cell(29,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(287);
$pdf->Cell(29,6,'(6-9)','LRB',0,'C',1); 

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
 $pdf->Cell(7,5,'1',1,0,'C',0); 
	$pdf->Cell(86,5,'2',1,0,'C',0); 
	$pdf->Cell(16,5,'3',1,0,'C',0);
	$pdf->Cell(29,5,'4',1,0,'C',0); 
	$pdf->Cell(27,5,'5',1,0,'C',0);
	$pdf->Cell(29,5,'6',1,0,'C',0);
	$pdf->Cell(29,5,'7',1,0,'C',0);
	$pdf->Cell(27,5,'8',1,0,'C',0);
	$pdf->Cell(29,5,'9',1,0,'C',0);
	$pdf->Cell(29,5,'10',1,0,'C',0);
	$pdf->Cell(8.5,5,'11',1,0,'C',0);
	$pdf->Cell(7,5,'12',1,0,'C',0);


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


$hal=1;

$i = 0; 
$no=1;
$tempNo = null;
$abjad='a';
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
   } else {	 $max=27; }

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
   
   
   $pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',10);
$pdf->SetY(18); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(15); 
$pdf->Cell(86,12,'URAIAN',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(101);
$pdf->Cell(16,12,'AKUN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(117);
$pdf->Cell(29,12,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(18); 
$pdf->SetX(146);
$pdf->Cell(27,6,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(146);
$pdf->Cell(27,6,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(173);
$pdf->Cell(29,6,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(173);
$pdf->Cell(29,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(202);
$pdf->Cell(85,6,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(202);
$pdf->Cell(29,6,'S.D. BULAN LALU',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(231);
$pdf->Cell(27,6,'BULAN INI',1,0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(258);
$pdf->Cell(29,6,'S.D. BULAN INI',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(287);
$pdf->Cell(29,6,'SISA','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(287);
$pdf->Cell(29,6,'(6-9)','LRB',0,'C',1); 

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
    $pdf->SetFont('arialnarrow','',10);
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(7,5,'1',1,0,'C',0); 
	$pdf->Cell(86,5,'2',1,0,'C',0); 
	$pdf->Cell(16,5,'3',1,0,'C',0);
	$pdf->Cell(29,5,'4',1,0,'C',0); 
	$pdf->Cell(27,5,'5',1,0,'C',0);
	$pdf->Cell(29,5,'6',1,0,'C',0);
	$pdf->Cell(29,5,'7',1,0,'C',0);
	$pdf->Cell(27,5,'8',1,0,'C',0);
	$pdf->Cell(29,5,'9',1,0,'C',0);
	$pdf->Cell(29,5,'10',1,0,'C',0);
	$pdf->Cell(8.5,5,'11',1,0,'C',0);
	$pdf->Cell(7,5,'12',1,0,'C',0);
  

 
   //Go to next row
   $y_axis = $y_axis + $row_height;
   
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln(5.2);
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
//	$prosen_des0= number_format($prosen,0,',','.');

	
	$uraian=substr($row[nmitem],0,60);
//	$hasiluraian =ucwords($uraian);
	
	$str = $row['display'];
    $pj = strlen($str);
	
// memberikan nomor urut berupa romawi, norut dan abjad	
		$pdf->SetFont('arialnarrow','',10);
		$pdf->SetX(8);
		$ng = $pdf->GetY(); 
	
	if ($pj=='6') {	
	   $pdf->SetFont('arialnarrowBold','',10);
		$pdf->Cell(7,6,$romawi.''.'.','LR',1,'C',2);
      
		$tempRomawi = $romawi;
        $romawi++;		
		
	} else if ($pj>'6') {	
		if($tempRomawi != $romawi)
		{
			$abjad='a';
			$tempRomawi = $romawi;
		}else{
		
		}	
		//$pdf->SetFont('Arial','',11);
		$pdf->SetFont('arialnarrow','',10);
		$pdf->Cell(7,6,$abjad.''.'.','LR',1,'R',1);
		
		$tempAbjad = $abjad;
        $abjad++;		
 	
	} else {
	$pdf->Cell(7,6,'','LR',1,'C',2);
	}
	
	

		
		$pdf->SetY($ng);
		$pdf->SetX(15);
	    $pdf->Cell(86,5,$uraian,'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(101);
		$pdf->Cell(16,5,$row[kdakun],'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(117);
		$pdf->Cell(29,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(146);
		$pdf->Cell(27,5,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(173);
		$pdf->Cell(29,5,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(202);
		$pdf->Cell(29,5,$lalu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(27,5,$ini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(258);
		$pdf->Cell(29,5,$sdi,'LR',1,'R',2);  
		
		$pdf->SetY($ng);
		$pdf->SetX(287);
		$pdf->Cell(29,5,$sisa,'LR',1,'R',2); 
		
		
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
		
	
	
		$y_axis = $y_axis + $row_height;
		$i++;
		$no++;
		
		
} // tutup while $row


	
$jml=mysql_query("SELECT  a.kdkotama, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM bpjs a 

left join (select  kdkotama,  thang, sum(realisasi) as blnlalu from realisasi_bpjs where kdbulan<'$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdkotama) as c on   a.kdkotama=c.kdkotama 
left join (select kdkotama,  thang, sum(realisasi) as  blnini from realisasi_bpjs where kdbulan='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdkotama) as d on   a.kdkotama=d.kdkotama 
where  a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.kdkotama"); 
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
//	$pros 		= (($blnsdi/$hasil[pagurevisi])*100);
//	$pros_des	= number_format($pros,2,',','.');
//	$pros_des0	= number_format($pros,0,',','.');

//	$pdf->Ln(); 
    $pdf->SetX(8); 
	 $pdf->SetFont('arialnarrow','',10);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(86,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(16,6,'',1,0,'C',1);
	$pdf->Cell(29,6,$pagu,1,0,'R',1); 
	$pdf->Cell(27,6,$revisi,1,0,'R',1);
	$pdf->Cell(29,6,$pagurevisi,1,0,'R',1);
	$pdf->Cell(29,6,$lalu,1,0,'R',1);
	$pdf->Cell(27,6,$ini,1,0,'R',1);
	$pdf->Cell(29,6,$sdi,1,0,'R',1);
	$pdf->Cell(29,6,$sisa,1,0,'R',1);
	if ($jmlpros>='100') {	
	$pdf->Cell(8.5,6,$jmlpros_des0,1,0,'C',1);
	} else {
	$pdf->Cell(8.5,6,$jmlpros_des,1,0,'C',1);	
	}
	$pdf->Cell(7,6,'',1,0,'C',1);

	//$y_axis1= $y_axis1 + $row_height;
		
	
		
	
$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
$row = mysql_fetch_array($sql);


$pdf->Ln(10);
$pdf->SetFont('arialnarrow','',11);
//$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,6,$row['tempat'].",          ".$row['tanggal'],0,1,'C');


$pdf->SetX(190); 
$pdf->Cell(0,5,$row['an'],0,1,'C');
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['pejabat1'],0,1,'C');
$pdf->Ln(10);
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['nama'],0,1,'C');
$pdf->SetX(190); 
$pdf->Cell(0,5,$row['pkt_crp'],0,1,'C');

$pdf->Output();

?> 
