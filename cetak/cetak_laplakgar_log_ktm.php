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
$pdf->AddFont('arialnarrow','','arialnarrow.php');
$pdf->AddFont('arialnarrowBold','','arialnarrowBold.php');
$pdf->SetFont('arialnarrow','',11);
$pdf->AddPage();
// KOP

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='000000'"); 
$x = mysql_fetch_array($kop);

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='000000'"); 
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

	 $sql= mysql_query("select concat('012.','22.',a.kdprogram) as kode, concat(a.kdprogram) as display, '' as kdsatker, b.nmprogram as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join t_program b on a.kdprogram=b.kdprogram
left join (select kdprogram, kdkotama, kdsatker, thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from realisasix where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram) as c on a.kdprogram=c.kdprogram
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram
union
(select a.kdgiat as kode, concat(a.kdprogram,a.kdgiat) as display, '' as kdsatker, b.nmgiat as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,  c.sppini, c.spmini, c.realsini
from dipa a 
left join t_giat b on a.kdgiat=b.kdgiat
left join (select kdprogram, kdgiat, kdkotama, kdsatker, thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini  from realisasix  where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat) as c on  a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram,a.kdgiat)
union
(select a.kdoutput as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput) as display,  '' as kdsatker, b.nmoutput as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join t_output b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select kdprogram, kdgiat, kdoutput, kdkotama, kdsatker, thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from realisasix  where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat,kdoutput) as c on  a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput 
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram,a.kdgiat,a.kdoutput)
union
(select a.kdakun as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display,  '' as kdsatker, b.nmakun as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join t_akun b on a.kdakun=b.kdakun
left join (select kdprogram, kdgiat, kdoutput, kdakun, kdkotama, kdsatker, thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from realisasix  where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat,kdoutput,kdakun) as c on  a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun 
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun)
union
(select '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun,a.kdsatker) as display,  a.kdsatker, b.nmsatkr as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join t_satkr b on a.kdsatker=b.kdsatkr
left join (select kdprogram, kdgiat, kdoutput, kdakun, kdkotama, kdsatker, thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from realisasix  where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat,kdoutput,kdakun,kdsatker) as c on  a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsatker=c.kdsatker
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun,kdsatker)
union
(select '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun,a.kdsatker, a.kdsakun) as display,  '' as kdsatker, concat('- ',a.nmsakun) as uraian,
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join (select  kdprogram, kdgiat, kdoutput, kdakun, kdsakun, kdkotama, kdsatker, thang,sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from realisasix  where kdbulan<='12' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]'  and kdwasgiat='$_GET[kdwasgiat]' group by kdprogram,kdgiat, kdoutput, kdakun,kdsakun,kdsatker) as c on  a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput and a.kdakun=c.kdakun and a.kdsakun=c.kdsakun and a.kdsatker=c.kdsatker
where a.kdkotama='$_GET[kdkotama]'  and a.thang='$_GET[thang]'  and a.kdwasgiat='$_GET[kdwasgiat]'
group by a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun, a.kdsatker)
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
$pdf->Cell(0,5,'LAPORAN PELAKSANAAN ANGGARAN BIDANG LOGISTIK',0,1,'C'); 
$pdf->SetY(43); 
$pdf->Cell(0,5,'PERIODE BULAN '. $indbul.' '.' TA '.' '.$thang,0,1,'C');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('arialnarrow','',9.5);
$pdf->SetY(55); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(15);
$pdf->Cell(15,6,'KODE','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(15);
$pdf->Cell(15,6,'AKUN','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(30);
$pdf->Cell(11,6,'KODE','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(30);
$pdf->Cell(11,6,'SKR','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(41); 
$pdf->Cell(80,12,'PROGRAM/KEGIATAN/OUTPUT/JENIS PEKERJAAN',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(121);
$pdf->Cell(25,12,'DIPA',1,0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(146);
$pdf->Cell(25,6,'DIPA SETELAH','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(146);
$pdf->Cell(25,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(171);
$pdf->Cell(24,6,'SPP','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(171);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(195);
$pdf->Cell(24,6,'SPM','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(195);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(219);
$pdf->Cell(24,6,'SP2D','LRT',0,'C',1); 
$pdf->SetY(61); 
$pdf->SetX(219);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(243);
$pdf->Cell(11,4,'DAYA','LRT',0,'C',1); 
$pdf->SetY(59); 
$pdf->SetX(243);
$pdf->Cell(11,4,'SERAP','LR',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(243);
$pdf->Cell(11,4,'(%)','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(254);
$pdf->Cell(72,4,'SISA ANGGARAN','LRT',0,'C',1); 

$pdf->SetY(59); 
$pdf->SetX(254);
$pdf->Cell(24,4,'BELUM SPP','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(254);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1);

$pdf->SetY(59); 
$pdf->SetX(278);
$pdf->Cell(24,4,'BELUM SPM','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(278);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(59); 
$pdf->SetX(302);
$pdf->Cell(24,4,'BELUM SP2D','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(302);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(55); 
$pdf->SetX(326);
$pdf->Cell(5,4,'K','LRT',0,'C',1); 
$pdf->SetY(59); 
$pdf->SetX(326);
$pdf->Cell(5,4,'E','LR',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(326);
$pdf->Cell(5,4,'T','LRB',0,'C',1); 

$pdf->Ln();
$pdf->SetX(8); 
$pdf->Cell(7,5,'1',1,0,'C',1); 
$pdf->Cell(15,5,'2',1,0,'C',1); 
$pdf->Cell(11,5,'3',1,0,'C',1);
$pdf->Cell(80,5,'4',1,0,'C',1); 
$pdf->Cell(25,5,'5',1,0,'C',1);
$pdf->Cell(25,5,'6',1,0,'C',1);
$pdf->Cell(24,5,'7',1,0,'C',1);
$pdf->Cell(24,5,'8',1,0,'C',1);
$pdf->Cell(24,5,'9',1,0,'C',1);
$pdf->Cell(11,5,'10',1,0,'C',1);
$pdf->Cell(24,5,'11',1,0,'C',1);
$pdf->Cell(24,5,'12',1,0,'C',1);
$pdf->Cell(24,5,'13',1,0,'C',1);
$pdf->Cell(5,5,'14',1,0,'C',1);

$pdf->Ln();

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
$pdf->SetFont('arialnarrow','',9.5);
$pdf->SetY(18); 
$pdf->SetX(8); 
$pdf->Cell(7,12,'NO',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(15);
$pdf->Cell(15,6,'KODE','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(15);
$pdf->Cell(15,6,'AKUN','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(30);
$pdf->Cell(11,6,'KODE','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(30);
$pdf->Cell(11,6,'SKR','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(41); 
$pdf->Cell(80,12,'PROGRAM/KEGIATAN/OUTPUT/JENIS PEKERJAAN',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(121);
$pdf->Cell(25,12,'DIPA',1,0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(146);
$pdf->Cell(25,6,'DIPA SETELAH','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(146);
$pdf->Cell(25,6,'REVISI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(171);
$pdf->Cell(24,6,'SPP','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(171);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(195);
$pdf->Cell(24,6,'SPM','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(195);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(219);
$pdf->Cell(24,6,'SP2D','LRT',0,'C',1); 
$pdf->SetY(24); 
$pdf->SetX(219);
$pdf->Cell(24,6,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(243);
$pdf->Cell(11,4,'DAYA','LRT',0,'C',1); 
$pdf->SetY(22); 
$pdf->SetX(243);
$pdf->Cell(11,4,'SERAP','LR',0,'C',1); 
$pdf->SetY(26); 
$pdf->SetX(243);
$pdf->Cell(11,4,'(%)','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(254);
$pdf->Cell(72,4,'SISA ANGGARAN','LRT',0,'C',1); 

$pdf->SetY(22); 
$pdf->SetX(254);
$pdf->Cell(24,4,'BELUM SPP','LRT',0,'C',1); 
$pdf->SetY(26); 
$pdf->SetX(254);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1);

$pdf->SetY(22); 
$pdf->SetX(278);
$pdf->Cell(24,4,'BELUM SPM','LRT',0,'C',1); 
$pdf->SetY(26); 
$pdf->SetX(278);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(22); 
$pdf->SetX(302);
$pdf->Cell(24,4,'BELUM SP2D','LRT',0,'C',1); 
$pdf->SetY(26); 
$pdf->SetX(302);
$pdf->Cell(24,4,'S.D. BULAN INI','LRB',0,'C',1); 

$pdf->SetY(18); 
$pdf->SetX(326);
$pdf->Cell(5,4,'K','LRT',0,'C',1); 
$pdf->SetY(22); 
$pdf->SetX(326);
$pdf->Cell(5,4,'E','LR',0,'C',1); 
$pdf->SetY(26); 
$pdf->SetX(326);
$pdf->Cell(5,4,'T','LRB',0,'C',1);  

   //    $pdf->SetFillColor(255,255,255);
    $pdf->SetFillColor(255,255,255);
     $pdf->SetFont('arialnarrow','',9.5);
    $pdf->SetY(30); 
    $pdf->SetX(8); 
    $pdf->Cell(7,5,'1',1,0,'C',1); 
	$pdf->Cell(15,5,'2',1,0,'C',1); 
	$pdf->Cell(11,5,'3',1,0,'C',1);
	$pdf->Cell(80,5,'4',1,0,'C',1); 
	$pdf->Cell(25,5,'5',1,0,'C',1);
	$pdf->Cell(25,5,'6',1,0,'C',1);
	$pdf->Cell(24,5,'7',1,0,'C',1);
	$pdf->Cell(24,5,'8',1,0,'C',1);
	$pdf->Cell(24,5,'9',1,0,'C',1);
	$pdf->Cell(11,5,'10',1,0,'C',1);
	$pdf->Cell(24,5,'11',1,0,'C',1);
	$pdf->Cell(24,5,'12',1,0,'C',1);
	$pdf->Cell(24,5,'13',1,0,'C',1);
	$pdf->Cell(5,5,'14',1,0,'C',1);
   
   //Go to next row
   $y_axis = $y_axis + $row_height;
   
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

	$pagu 			= number_format($row[pagu],0,',','.');
	$pagurevisi		= number_format($row[pagurevisi],0,',','.');
	$sppini			= number_format($row[sppini],0,',','.');
	$spmini			= number_format($row[spmini],0,',','.');
	$realsini		= number_format($row[realsini],0,',','.');
	
	$sisa_spp    = $row[pagurevisi] - $row[sppini];
	$sisa_spp_rb = number_format($sisa_spp,0,',','.');
	
	$sisa_spm    = $row[pagurevisi] - $row[spmini];
	$sisa_spm_rb = number_format($sisa_spm,0,',','.');
	
	$sisa_reals    = $row[pagurevisi] - $row[realsini];
	$sisa_reals_rb = number_format($sisa_reals,0,',','.');
		
	//-------------------------------------------
	if (($row[pagurevisi]=='') or ($row[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($row[realsini]/$row[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
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
	if ($pj=='2') {	
	   $pdf->SetFont('arialnarrow','',9.5);
		if ($romawi=='1') {
		$pdf->Cell(7,5,'A.','LR',1,'L',2);
        } else if ($romawi=='2') {
		$pdf->Cell(7,5,'B.','LR',1,'L',2);	
		} else if ($romawi=='3') {
		$pdf->Cell(7,5,'C.','LR',1,'L',2);		
		} else if ($romawi=='4') {
		$pdf->Cell(7,5,'D.','LR',1,'L',2);	
		} else if ($romawi=='5') {
		$pdf->Cell(7,5,'E.','LR',1,'L',2);			
		} else {
		$pdf->Cell(7,5,'F.','LR',1,'L',2);
		}
		$tempRomawi = $romawi;
        $romawi++;		
		
	} else if ($pj=='6') {	
	    $pdf->SetFont('arialnarrow','',9.5);
		if($tempRomawi != $romawi)
		{
			$no='1';
			$tempRomawi = $romawi;
		}else{
		
		}	
		$pdf->Cell(7,5,$no.''.'.','LR',1,'L',1);
		
		$tempNo = $no;
        $no++;		
		
	} else if ($pj=='9') {	
	    $pdf->SetFont('arialnarrow','',9.5);
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
	} else if ($pj=='15') {	
	    $pdf->SetFont('arialnarrow','',9.5);
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
	
	if ($pj <'23' ) { // jika digit kurang dari 14 dicetak tebal (sampai kode output)
	  $pdf->SetFont('arialnarrow','',9.5);
	
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(15,5,$row[kode],'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$LastKdsatker = $row[kdsatker];
		if ($LastKdsatker != $row[kdsatker]) {
		$pdf->Cell(11,5,'','LR',1,'C',2);
		} else {
		$pdf->Cell(11,5,$LastKdsatker,'LR',1,'C',2);	
		}
		
		$pdf->SetY($ng);
		$pdf->SetX(41);
		$pdf->Cell(80,5,$uraian,'LR',1,'L',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(121);
		$pdf->Cell(25,5,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(146);
		$pdf->Cell(25,5,$pagurevisi,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(171);
		$pdf->Cell(24,5,$sppini,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(195);
		$pdf->Cell(24,5,$spmini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(219);
		$pdf->Cell(24,5,$realsini,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(243);	
		
		if ($prosen>='100') {		
		$pdf->Cell(11,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(11,5,$prosen_des,'LR',1,'C',2);	
		}
		
		$pdf->SetY($ng);
		$pdf->SetX(254);
		$pdf->Cell(24,5,$sisa_spp_rb,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(278);
		$pdf->Cell(24,5,$sisa_spm_rb,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(302);
		$pdf->Cell(24,5,$sisa_reals_rb,'LR',1,'R',2); 
	    	    
		$pdf->SetY($ng);
		$pdf->SetX(326);
		$pdf->Cell(5,5,'','LR',1,'R',2); 	
	} else {
		 $pdf->SetFont('arialnarrow','',9.5);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(15,5,$row[kode],'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(11,5,$row[kdsatker],'LR',1,'C',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(41);
		$pdf->Cell(80,5,$uraian,'LR',1,'L',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(121);
		$pdf->Cell(25,5,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(146);
		$pdf->Cell(25,5,$pagurevisi,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(171);
		$pdf->Cell(24,5,$sppini,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(195);
		$pdf->Cell(24,5,$spmini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(219);
		$pdf->Cell(24,5,$realsini,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(243);	
		
		if ($prosen>='100') {		
		$pdf->Cell(11,5,$prosen_des0,'LR',1,'C',2); 
		} else {
		$pdf->Cell(11,5,$prosen_des,'LR',1,'C',2);	
		}
		
		$pdf->SetY($ng);
		$pdf->SetX(219);
		$pdf->Cell(24,5,$realsini,'LR',1,'R',2); 
	    
		$pdf->SetY($ng);
		$pdf->SetX(254);
		$pdf->Cell(24,5,$sisa_spm_rb,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(278);
		$pdf->Cell(24,5,$sisa_spp_rb,'LR',1,'R',2); 
	
		$pdf->SetY($ng);
		$pdf->SetX(302);
		$pdf->Cell(24,5,$sisa_reals_rb,'LR',1,'R',2); 
		
		$pdf->SetY($ng);
		$pdf->SetX(326);
		$pdf->Cell(5,5,'','LR',1,'R',2); 
		
	}
	
		$y_axis = $y_axis + $row_height;
		$i++;
		//$no++;
		
		
} // tutup while $row

$jml=mysql_query("select sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, c.sppini, c.spmini, c.realsini
from dipa a 
left join (select id_pagu,kdkotama,   thang, kdwasgiat, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini from  realisasix  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdkotama, thang,kdwasgiat) as c on a.kdkotama=c.kdkotama  and a.thang=c.thang and a.kdwasgiat=c.kdwasgiat
where a.kdkotama='$_GET[kdkotama]' and a.thang='$_GET[thang]' and a.kdwasgiat='$_GET[kdwasgiat]' group by a.kdkotama,a.thang,a.kdwasgiat"); 
$hasil = mysql_fetch_array($jml);	

	$pagu 			= number_format($hasil[pagu],0,',','.');
	$pagurevisi		= number_format($hasil[pagurevisi],0,',','.');
	$sppini			= number_format($hasil[sppini],0,',','.');
	$spmini			= number_format($hasil[spmini],0,',','.');
	$realsini		= number_format($hasil[realsini],0,',','.');
	
	$sisa_spp    = $hasil[pagurevisi] - $hasil[sppini];
	$sisa_spp_rb = number_format($sisa_spp,0,',','.');
	
	$sisa_spm    = $hasil[pagurevisi] - $hasil[spmini];
	$sisa_spm_rb = number_format($sisa_spm,0,',','.');
	
	$sisa_reals    = $hasil[pagurevisi] - $hasil[realsini];
	$sisa_reals_rb = number_format($sisa_reals,0,',','.');
	
	//-------------------------------------------
	if (($hasil[pagurevisi]=='') or ($hasil[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($hasil[realsini]/$hasil[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(8); 
	 $pdf->SetFont('arialnarrow','',9.5);
    $pdf->Cell(7,6,'',1,0,'C',1); 
	$pdf->Cell(15,6,'',1,0,'C',1);
	$pdf->Cell(11,6,'',1,0,'C',1);
	$pdf->Cell(80,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(25,6,$pagu,1,0,'R',1); 
	$pdf->Cell(25,6,$pagurevisi,1,0,'R',1);
	$pdf->Cell(24,6,$sppini,1,0,'R',1);
	$pdf->Cell(24,6,$spmini,1,0,'R',1);
	$pdf->Cell(24,6,$realsini,1,0,'R',1);
	
	if ($jmlpros>='100') {	
	$pdf->Cell(11,6,$prosen_des0,1,0,'C',1);
	} else {
	$pdf->Cell(11,6,$prosen_des,1,0,'C',1);	
	}
	
	$pdf->Cell(24,6,$sisa_spp_rb,1,0,'R',1);
	$pdf->Cell(24,6,$sisa_spm_rb,1,0,'R',1);
	$pdf->Cell(24,6,$sisa_reals_rb,1,0,'R',1);
	$pdf->Cell(5,6,'',1,0,'C',1);

$jmljenbel=mysql_query("select a.*, b.pagu,  b.revisi, b.pagurevisi, c.sppini, c.spmini, c.realsini from t_jenbel a 
left join (select kdkotama,   thang, kdjenbel, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from dipa where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdjenbel) as b on a.kdjenbel=b.kdjenbel 
left join (select kdkotama,   thang, sum(nilai_spp) as sppini, sum(nilai_spm) as spmini, sum(realisasi) as realsini, kdjenbel from realisasix  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' and kdwasgiat='$_GET[kdwasgiat]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel 
where a.kdjenbel<'54' order by a.kdjenbel"); 
$pdf->Ln(); 
 $k=1;
 while($ok = mysql_fetch_array($jmljenbel)) {
 
    $pagu 			= number_format($ok[pagu],0,',','.');
	$pagurevisi		= number_format($ok[pagurevisi],0,',','.');
	$sppini			= number_format($ok[sppini],0,',','.');
	$spmini			= number_format($ok[spmini],0,',','.');
	$realsini		= number_format($ok[realsini],0,',','.');
	
	$sisa_spp    = $ok[pagurevisi] - $ok[sppini];
	$sisa_spp_rb = number_format($sisa_spp,0,',','.');
	
	$sisa_spm    = $ok[pagurevisi] - $ok[spmini];
	$sisa_spm_rb = number_format($sisa_spm,0,',','.');
	
	$sisa_reals    = $ok[pagurevisi] - $ok[realsini];
	$sisa_reals_rb = number_format($sisa_reals,0,',','.');
	
	//-------------------------------------------
	if (($ok[pagurevisi]=='') or ($ok[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($ok[realsini]/$ok[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
 
        $ng = $pdf->GetY(); 
    	 $pdf->SetFont('arialnarrow','',9.5);
		$pdf->SetY($ng);
		$pdf->SetX(8);
		$pdf->Cell(7,5,'','LR',1,'C',2);
		$pdf->SetY($ng);
		$pdf->SetX(15);
		$pdf->Cell(15,5,$ok[kdjenbel],'LR',1,'C',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(11,5,'','LR',1,'C',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(41);
		$pdf->Cell(80,5,$ok[nmjenbel],'LR',1,'L',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(121);
		$pdf->Cell(25,5,$pagu,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(146);
		$pdf->Cell(25,5,$pagurevisi,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(171);
		$pdf->Cell(24,5,$sppini,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(195);
		$pdf->Cell(24,5,$spmini,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(219);
		$pdf->Cell(24,5,$realsini,'LR',1,'R',2);
			
		$pdf->SetY($ng);
		$pdf->SetX(243);
		 if ($prosen>='100') {	
		$pdf->Cell(11,5,$prosen_des0,'LR',1,'C',2); 
		 } else {
		$pdf->Cell(11,5,$prosen_des,'LR',1,'C',2); 	 
		 }
		 
		$pdf->SetY($ng);
		$pdf->SetX(254);
		$pdf->Cell(24,5,$sisa_spp_rb,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(278);
		$pdf->Cell(24,5,$sisa_spm_rb,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(302);
		$pdf->Cell(24,5,$sisa_reals_rb,'LR',1,'R',2);
 
		$pdf->SetY($ng);
		$pdf->SetX(326);
		$pdf->Cell(5,5,'','LR',1,'R',2); 
	
	}
	$y_axis1= $y_axis1 + $row_height;
		$k++;
		 $ng = $pdf->GetY(); 
    $pdf->SetX(8); 
    $pdf->Cell(7,1,'','LRB',0,'C',1); 
	$pdf->Cell(15,1,'','LRB',0,'C',1); 
	$pdf->Cell(11,1,'','LRB',0,'C',1);
	$pdf->Cell(80,1,'','LRB',0,'C',1); 
	$pdf->Cell(25,1,'','LRB',0,'C',1);
	$pdf->Cell(25,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(11,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(24,1,'','LRB',0,'C',1);
	$pdf->Cell(5,1,'','LRB',0,'C',1);
	

$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='000000' "); ;
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
