<?php 
include "../application/connect.php";

define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

ini_set("max_execution_time",0);

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

$lamp= mysql_query("select * from lamp_laplakgar where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); 
$z = mysql_fetch_array($lamp);
	
$kop=$x[panjang_kop];
$grs=$x[panjang_grs];

$garis=$z[panjang_grs];
$posisi=$z[posisi_grs];




$pdf->Sety(15); 
$pdf->SetX(20); 
$pdf->Cell($kop+5,5,$x[kop1],0,1,'C');
$pdf->SetX(20); 
$pdf->Cell($kop+5,5,$x[kop2],0,1,'C');
$pdf->SetX(20); 
$pdf->Cell($grs+5,0.08,'                             ',0,0,'L',1); 

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);



$pdf->Sety(15); 
$pdf->SetX(246); 
$pdf->Cell(0,5,$z[brs1],0,0,'R',1);

$pdf->Sety(20); 
$pdf->SetX(246); 
$pdf->Cell(0,5,$z[brs2],0,0,'R',1);
$pdf->Sety(25); 
$pdf->SetX(246); 
$pdf->Cell(0,5,$z[brs3],0,0,'R',1);
$pdf->Sety(30.2); 
$pdf->SetX($posisi-4);
$pdf->Cell($garis+7,0.08,'                             ','T',0,'C',1);

$pdf->Sety(15); 
$pdf->SetX($posisi-5); 
$pdf->Cell(18,5,'Lampiran'.' '.$_GET['lamp'],0,0,'L',1);
$pdf->Sety(20); 
$pdf->SetX($posisi-5); 
$pdf->Cell(18,5,'Nomor ',0,0,'L',1);
$pdf->Sety(25); 
$pdf->SetX($posisi-5); 
$pdf->Cell(18,5,'Tanggal',0,0,'L',1);

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


	
$pdf->Ln(10); 
// header
$pdf->SetY(36);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'PELAKSANAAN ANGGARAN DIPA PETIKAN SATKER',0,1,'C');
$pdf->SetY(41); 
//$pdf->Cell(0,5,'BULAN : '. $indbul,0,1,'C');
$pdf->Cell(0,5,'BULAN '.' '.$bulan. '  TAHUN '.' '.$_GET[thang],0,1,'C');

$nmkotama= mysql_query("select * from t_kotam where kdkotama='$_GET[kdkotama]'"); 
$x = mysql_fetch_array($nmkotama);
$kotama = strtoupper($x[nmkotama]);

$nmsatkr= mysql_query("select * from t_satkr where kdkotama='$_GET[kdkotama]' and kdsatkr='$_GET[kdsatker]'"); 
$y = mysql_fetch_array($nmsatkr);
$satkr = strtoupper($y[nmsatkr]);

/*
$pdf->Sety(44); 
$pdf->SetX(20); 
$pdf->Cell(50,5,'UNIT ORGANISASI ',0,1,'L');
$pdf->Sety(49); 
$pdf->SetX(20); 
$pdf->Cell(50,5,'KOTAMA ',0,1,'L');
*/
$pdf->Sety(54); 
$pdf->SetX(20); 
$pdf->Cell(50,5,'SATKER ',0,1,'L');

/*
$pdf->Sety(44); 
$pdf->SetX(55); 
$pdf->Cell(50,5,': TNI AD',0,1,'L');
$pdf->Sety(49); 
$pdf->SetX(55); 
$pdf->Cell(50,5,':'.' '.$kotama,0,1,'L');
*/
$pdf->Sety(54); 
$pdf->SetX(35); 
$pdf->Cell(50,5,':'.'   '.$satkr,0,1,'L');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);
$pdf->SetY(60); 
$pdf->SetX(20); 
$pdf->Cell(10,15,'NO',1,0,'C',1); 


$pdf->SetY(60); 
$pdf->SetX(30);
$pdf->Cell(40,15,'URAIAN',1,0,'C',1); 

$pdf->SetY(60); 
$pdf->SetX(70);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(70);
$pdf->Cell(37,4.5,'PAGU','LR',0,'C',1); 
$pdf->SetY(67.5); 
$pdf->SetX(70);
$pdf->Cell(37,4.5,'AWAL','LR',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(70);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(107);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(107);
$pdf->Cell(37,4.5,'REVISI','LR',0,'C',1); 
$pdf->SetY(67.5); 
$pdf->SetX(107);
$pdf->Cell(37,4.5,'(+/-)','LR',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(107);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(144);
$pdf->Cell(37,5,'PAGU','LRT',0,'C',1); 
$pdf->SetY(65); 
$pdf->SetX(144);
$pdf->Cell(37,5,'SETELAH','LR',0,'C',1); 
$pdf->SetY(70); 
$pdf->SetX(144);
$pdf->Cell(37,5,'REVISI','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(181);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(181);
$pdf->Cell(37,4.5,'REALISASI','LR',0,'C',1); 
$pdf->SetY(67.5); 
$pdf->SetX(181);
$pdf->Cell(37,4.5,'(WABKU)','LR',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(181);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(218);
$pdf->Cell(13,3,'','LRT',0,'C',1); 
$pdf->SetY(63); 
$pdf->SetX(218);
$pdf->Cell(13,4.5,'%','LR',0,'C',1); 
$pdf->SetY(67.5); 
$pdf->SetX(218);
$pdf->Cell(13,4.5,'(5:6)','LR',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(218);
$pdf->Cell(13,3,'','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(231);
$pdf->Cell(37,5,'SISA','LRT',0,'C',1); 
$pdf->SetY(65); 
$pdf->SetX(231);
$pdf->Cell(37,5,'ANGGARAN','LR',0,'C',1); 
$pdf->SetY(70); 
$pdf->SetX(231);
$pdf->Cell(37,5,'(5-6)','LRB',0,'C',1);

$pdf->SetY(60); 
$pdf->SetX(268); 
$pdf->Cell(15,15,'KET',1,0,'C',1); 

$pdf->Ln();
$pdf->SetX(20); 
$pdf->Cell(10,6,'1',1,0,'C',1); 
$pdf->Cell(40,6,'2',1,0,'C',1); 
$pdf->Cell(37,6,'3',1,0,'C',1);
$pdf->Cell(37,6,'4',1,0,'C',1); 
$pdf->Cell(37,6,'5',1,0,'C',1); 
$pdf->Cell(37,6,'6',1,0,'C',1);
$pdf->Cell(13,6,'7',1,0,'C',1);
$pdf->Cell(37,6,'8',1,0,'C',1);
$pdf->Cell(15,6,'9',1,0,'C',1);

//---------------------------- dipa daerah ---------------------------------------
$jml_daerah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from dipa a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil = mysql_fetch_array($jml_daerah);	

	$pagu 			= number_format($hasil[pagu],0,',','.');
	$revisi 		= number_format($hasil[revisi],0,',','.');
	$pagurevisi		= number_format($hasil[pagurevisi],0,',','.');
	$realisasi		= number_format($hasil[realisasi],0,',','.');
	
	if (($hasil[pagurevisi]=='') or ($hasil[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($hasil[realisasi]/$hasil[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $hasil[pagurevisi] - $hasil[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->Ln();
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LRT',0,'C',1); 
	$pdf->Cell(40,6,'RUPIAH MURNI','LRT',0,'L',1); 
	$pdf->Cell(37,6,$pagu,'LRT',0,'R',1);
	$pdf->Cell(37,6,$revisi,'LRT',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi,'LRT',0,'R',1); 
	$pdf->Cell(37,6,$realisasi,'LRT',0,'R',1);
	$pdf->Cell(13,6,$prosen_des,'LRT',0,'R',1);
	$pdf->Cell(37,6,$sisa_des,'LRT',0,'R',1);
	$pdf->Cell(15,6,'','LRT',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel dipa daerah----------------------------	
$perjenbel_daerah=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from dipa where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$no=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_daerah)) {

	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	
	
		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$no,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);	
		$no++;			
}
	
		//$y_axis = $y_axis + $row_tinggi;
		// $j++;	
			
//-------------------------------------------- Yanmasum -----------------------------

$jml_yanmasum=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from yanmasum a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_yanmasum  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil1 = mysql_fetch_array($jml_yanmasum);	

	$pagu1 			= number_format($hasil1[pagu],0,',','.');
	$revisi1 		= number_format($hasil1[revisi],0,',','.');
	$pagurevisi1	= number_format($hasil1[pagurevisi],0,',','.');
	$realisasi1		= number_format($hasil1[realisasi],0,',','.');
	
	if (($hasil1[pagurevisi]=='') OR ($hasil1[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen1 	= (($hasil1[realisasi]/$hasil1[pagurevisi])*100);
	}
	$prosen_des1	= number_format($prosen1,2,',','.');
	
	$sisa1 = $hasil1[pagurevisi] - $hasil1[realisasi];
	$sisa_des1 = number_format($sisa1,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LR',0,'C',1); 
	$pdf->Cell(40,6,'YANMASUM','LR',0,'L',1); 
	$pdf->Cell(37,6,$pagu1,'LR',0,'R',1);
	$pdf->Cell(37,6,$revisi1,'LR',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi1,'LR',0,'R',1); 
	$pdf->Cell(37,6,$realisasi1,'LR',0,'R',1);
	$pdf->Cell(13,6,$prosen_des1,'LR',0,'R',1);
	$pdf->Cell(37,6,$sisa_des1,'LR',0,'R',1);
	$pdf->Cell(15,6,'','LR',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel----------------------------	
$perjenbel_yanmasum=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from yanmasum where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_yanmasum where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_yanmasum)) {


	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;		
}
//-------------------------------------------- bpjs -----------------------------

$jml_bpjs=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from bpjs a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_bpjs where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil2 = mysql_fetch_array($jml_bpjs);	

	$pagu2 			= number_format($hasil2[pagu],0,',','.');
	$revisi2 		= number_format($hasil2[revisi],0,',','.');
	$pagurevisi2	= number_format($hasil2[pagurevisi],0,',','.');
	$realisasi2		= number_format($hasil2[realisasi],0,',','.');
	
	if (($hasil2[pagurevisi]=='') OR ($hasil2[pagurevisi]=='0')) {
	$prosen2     = 0; 
    } else { 
	$prosen2 	= (($hasil2[realisasi]/$hasil2[pagurevisi])*100);
	}
	$prosen_des2	= number_format($prosen2,2,',','.');
	
	$sisa2 = $hasil2[pagurevisi] - $hasil2[realisasi];
	$sisa_des2 = number_format($sisa2,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LR',0,'C',1); 
	$pdf->Cell(40,6,'BPJS','LR',0,'L',1); 
	$pdf->Cell(37,6,$pagu2,'LR',0,'R',1);
	$pdf->Cell(37,6,$revisi2,'LR',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi2,'LR',0,'R',1); 
	$pdf->Cell(37,6,$realisasi2,'LR',0,'R',1);
	$pdf->Cell(13,6,$prosen_des2,'LR',0,'R',1);
	$pdf->Cell(37,6,$sisa_des2,'LR',0,'R',1);
	$pdf->Cell(15,6,'','LR',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel----------------------------	
$perjenbel_bpjs=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from bpjs where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_bpjs  where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_bpjs)) {


	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;		
}
//-----------------------------------------end bpjs---------------------------------------				

	$pdf->SetFont('Arial','',10);		
    $ng = $pdf->GetY(); 
    $pdf->SetX(20); 
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(10,1,'','LRB',0,'C',1); 
	$pdf->Cell(40,1,'','LRB',0,'C',1); 
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1); 
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(13,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(15,1,'','LRB',0,'C',1);
	$pdf->Ln();		

// --------------------halaman baru----------------------------------------------------------------------------
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
$pdf->SetY(10);  
$pdf->Cell(0,6,'2',0,0,'C',1);

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);
$pdf->SetY(25); 
$pdf->SetX(20); 
$pdf->Cell(10,15,'NO',1,0,'C',1); 

$pdf->SetY(25); 
$pdf->SetX(30);
$pdf->Cell(40,15,'URAIAN',1,0,'C',1); 

$pdf->SetY(25); 
$pdf->SetX(70);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(28); 
$pdf->SetX(70);
$pdf->Cell(37,4.5,'PAGU','LR',0,'C',1); 
$pdf->SetY(32.5); 
$pdf->SetX(70);
$pdf->Cell(37,4.5,'AWAL','LR',0,'C',1); 
$pdf->SetY(37); 
$pdf->SetX(70);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(107);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(28); 
$pdf->SetX(107);
$pdf->Cell(37,4.5,'REVISI','LR',0,'C',1); 
$pdf->SetY(32.5); 
$pdf->SetX(107);
$pdf->Cell(37,4.5,'(+/-)','LR',0,'C',1); 
$pdf->SetY(37); 
$pdf->SetX(107);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(144);
$pdf->Cell(37,5,'PAGU','LRT',0,'C',1); 
$pdf->SetY(30); 
$pdf->SetX(144);
$pdf->Cell(37,5,'SETELAH','LR',0,'C',1); 
$pdf->SetY(35); 
$pdf->SetX(144);
$pdf->Cell(37,5,'REVISI','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(181);
$pdf->Cell(37,3,'','LRT',0,'C',1); 
$pdf->SetY(28); 
$pdf->SetX(181);
$pdf->Cell(37,4.5,'REALISASI','LR',0,'C',1); 
$pdf->SetY(32.5); 
$pdf->SetX(181);
$pdf->Cell(37,4.5,'(WABKU)','LR',0,'C',1); 
$pdf->SetY(37); 
$pdf->SetX(181);
$pdf->Cell(37,3,'','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(218);
$pdf->Cell(13,3,'','LRT',0,'C',1); 
$pdf->SetY(27); 
$pdf->SetX(218);
$pdf->Cell(13,4.5,'%','LR',0,'C',1); 
$pdf->SetY(32.5); 
$pdf->SetX(218);
$pdf->Cell(13,4.5,'(5:6)','LR',0,'C',1); 
$pdf->SetY(37); 
$pdf->SetX(218);
$pdf->Cell(13,3,'','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(231);
$pdf->Cell(37,5,'SISA','LRT',0,'C',1); 
$pdf->SetY(30); 
$pdf->SetX(231);
$pdf->Cell(37,5,'ANGGARAN','LR',0,'C',1); 
$pdf->SetY(35); 
$pdf->SetX(231);
$pdf->Cell(37,5,'(5-6)','LRB',0,'C',1);

$pdf->SetY(25); 
$pdf->SetX(268); 
$pdf->Cell(15,15,'KET',1,0,'C',1); 

$pdf->Ln();
$pdf->SetX(20); 
$pdf->Cell(10,6,'1',1,0,'C',1); 
$pdf->Cell(40,6,'2',1,0,'C',1); 
$pdf->Cell(37,6,'3',1,0,'C',1);
$pdf->Cell(37,6,'4',1,0,'C',1); 
$pdf->Cell(37,6,'5',1,0,'C',1); 
$pdf->Cell(37,6,'6',1,0,'C',1);
$pdf->Cell(13,6,'7',1,0,'C',1);
$pdf->Cell(37,6,'8',1,0,'C',1);
$pdf->Cell(15,6,'9',1,0,'C',1);
$pdf->Ln();
//-------------------------------------------- blu -----------------------------

$jml_blu=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from blu a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_blu  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil3 = mysql_fetch_array($jml_blu);	

	$pagu3 			= number_format($hasil3[pagu],0,',','.');
	$revisi3 		= number_format($hasil3[revisi],0,',','.');
	$pagurevisi3	= number_format($hasil3[pagurevisi],0,',','.');
	$realisasi3		= number_format($hasil3[realisasi],0,',','.');
	
	if (($hasil3[pagurevisi]=='') OR ($hasil3[pagurevisi]=='0')) {
	$prosen3     = 0; 
    } else { 
	$prosen3 	= (($hasil3[realisasi]/$hasil3[pagurevisi])*100);
	}
	$prosen_des3	= number_format($prosen3,2,',','.');
	
	$sisa3 = $hasil3[pagurevisi] - $hasil3[realisasi];
	$sisa_des3 = number_format($sisa3,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LRT',0,'C',1); 
	$pdf->Cell(40,6,'BLU','LRT',0,'L',1); 
	$pdf->Cell(37,6,$pagu3,'LRT',0,'R',1);
	$pdf->Cell(37,6,$revisi3,'LRT',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi3,'LRT',0,'R',1); 
	$pdf->Cell(37,6,$realisasi3,'LRT',0,'R',1);
	$pdf->Cell(13,6,$prosen_des3,'LRT',0,'R',1);
	$pdf->Cell(37,6,$sisa_des3,'LRT',0,'R',1);
	$pdf->Cell(15,6,'','LRT',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel----------------------------	
$perjenbel_blu=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from blu where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_blu  where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_blu)) {
	
	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;
			
}
//-------------------------------------------- HIBAH -----------------------------

$jml_hibah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagu+a.revisi)  as pagurevisi, b.realisasi
from hibah a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from  realisasi_hibah where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil4 = mysql_fetch_array($jml_hibah);	

	$pagu4 			= number_format($hasil4[pagu],0,',','.');
	$revisi4 		= number_format($hasil4[revisi],0,',','.');
	$pagurevisi4	= number_format($hasil4[pagurevisi],0,',','.');
	$realisasi4		= number_format($hasil4[realisasi],0,',','.');
	
	if (($hasil4[pagurevisi]=='') OR ($hasil4[pagurevisi]=='0')) {
	$prosen4     = 0; 
    } else { 
	$prosen4 	= (($hasil4[realisasi]/$hasil4[pagurevisi])*100);
	}
	$prosen_des4	= number_format($prosen4,2,',','.');
	
	$sisa4 = $hasil4[pagurevisi] - $hasil4[realisasi];
	$sisa_des4 = number_format($sisa4,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LR',0,'C',1); 
	$pdf->Cell(40,6,'HIBAH','LR',0,'L',1); 
	$pdf->Cell(37,6,$pagu4,'LR',0,'R',1);
	$pdf->Cell(37,6,$revisi4,'LR',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi4,'LR',0,'R',1); 
	$pdf->Cell(37,6,$realisasi4,'LR',0,'R',1);
	$pdf->Cell(13,6,$prosen_des4,'LR',0,'R',1);
	$pdf->Cell(37,6,$sisa_des4,'LR',0,'R',1);
	$pdf->Cell(15,6,'','LR',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel----------------------------	
$perjenbel_hibah=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from hibah where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_hibah  where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_hibah)) {

	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;		
}

//-------------------------------------------- KAPITASI -----------------------------

$jml_kapitasi=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from kapitasi a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_kapitasi where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil5 = mysql_fetch_array($jml_kapitasi);	

	$pagu5 			= number_format($hasil5[pagu],0,',','.');
	$revisi5 		= number_format($hasil5[revisi],0,',','.');
	$pagurevisi5	= number_format($hasil5[pagurevisi],0,',','.');
	$realisasi5		= number_format($hasil5[realisasi],0,',','.');
	
	if (($hasil5[pagurevisi]=='') OR ($hasil5[pagurevisi]=='0')) {
	$prosen5     = 0; 
    } else { 
	$prosen5 	= (($hasil5[realisasi]/$hasil5[pagurevisi])*100);
	}
	$prosen_des5	= number_format($prosen5,2,',','.');
	
	$sisa5 = $hasil5[pagurevisi] - $hasil5[realisasi];
	$sisa_des5 = number_format($sisa5,0,',','.');	

    $pdf->SetFont('Arial','B',10);
	$pdf->SetX(20); 
	$pdf->Cell(10,6,'','LR',0,'C',1); 
	$pdf->Cell(40,6,'KAPITASI','LR',0,'L',1); 
	$pdf->Cell(37,6,$pagu5,'LR',0,'R',1);
	$pdf->Cell(37,6,$revisi5,'LR',0,'R',1);
	$pdf->Cell(37,6,$pagurevisi5,'LR',0,'R',1); 
	$pdf->Cell(37,6,$realisasi5,'LR',0,'R',1);
	$pdf->Cell(13,6,$prosen_des5,'LR',0,'R',1);
	$pdf->Cell(37,6,$sisa_des5,'LR',0,'R',1);
	$pdf->Cell(15,6,'','LR',0,'R',1);

$i = 0; 
$row_height = 6;
// data

	$pdf->Ln();
	
//-------------------------------------------global per jenbel----------------------------	
$perjenbel_kapitasi=mysql_query("select a.kdjenbel, a.nmjenbel,
b.pagu,  b.revisi, b.pagurevisi, c.realisasi  from t_jenbel a 
left join (select  kdjenbel, kdkotama, kdsatker, thang, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi  from kapitasi where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by  kdjenbel)  as b on   a.kdjenbel=b.kdjenbel
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi_kapitasi where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as c on a.kdjenbel=c.kdjenbel
group by a.kdjenbel order by a.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_kapitasi)) {

	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;		
}








//----------------------------------------------------------------------------------------
    $jpagu = $hasil[pagu] + $hasil1[pagu] + $hasil2[pagu] + $hasil3[pagu] + $hasil4[pagu] + $hasil5[pagu];	
    $jpagu_des = number_format($jpagu,0,',','.');	

	$jrevisi = $hasil[revisi] + $hasil1[revisi] + $hasil2[revisi] + $hasil3[revisi] + $hasil4[revisi] + $hasil5[revisi];	
    $jrevisi_des = number_format($jrevisi,0,',','.');	

$jpagurevisi = $hasil[pagurevisi] + $hasil1[pagurevisi] + $hasil2[pagurevisi] + $hasil3[pagurevisi] + $hasil4[pagurevisi] + $hasil5[pagurevisi];	
    $jpagurevisi_des = number_format($jpagurevisi,0,',','.');	

	$jrealisisi = $hasil[realisasi] + $hasil1[realisasi] + $hasil2[realisasi] + $hasil3[realisasi] + $hasil4[realisasi] + $hasil5[realisasi];	
    $jrealisisi_des = number_format($jrealisisi,0,',','.');		
	
	$sisa_dipa = $jpagu - $jrealisisi;
	//$jsisa= $sisa + $sisa1 + $sisa2 + $sisa3 + $sisa4;
	$jsisa= $jpagurevisi - $jrealisisi;
	$jsisa_des = number_format($jsisa,0,',','.');	
	
	if (($jpagurevisi=='') or ($jpagurevisi=='0')) {
	$prosen     = 0; 
    } else { 
	$jprosen 	= (($jrealisisi/$jpagurevisi)*100);
	}
	$jprosen_des	= number_format($jprosen,2,',','.');

	$ng = $pdf->GetY(); 
    $pdf->SetX(20); 
    $pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,6,'',1,0,'C',1); 
	$pdf->Cell(40,6,'J U M L A H',1,0,'L',1); 
	$pdf->Cell(37,6,$jpagu_des,1,0,'R',1);
	$pdf->Cell(37,6,$jrevisi_des,1,0,'R',1);
	$pdf->Cell(37,6,$jpagurevisi_des,1,0,'R',1); 
	$pdf->Cell(37,6,$jrealisisi_des,1,0,'R',1);
	$pdf->Cell(13,6,$jprosen_des,1,0,'R',1);
	$pdf->Cell(37,6,$jsisa_des,1,0,'R',1);
	$pdf->Cell(15,6,'',1,0,'C',1);
	$pdf->Ln(6.2);
	
	
	
	
	// rekap per jenbel -----------------------------------------

$perjenbel_global=mysql_query("select w.kdjenbel, w.nmjenbel, z.kdkotama, z.kdsatker, z.thang, z.pagu, z.revisi, z.pagurevisi, z.realisasi from t_jenbel w left join 

(select z.kdkotama, z.kdsatker, z.thang, z.kdjenbel, sum(z.pagu) as pagu, sum(z.revisi) as revisi, sum(z.pagurevisi) as pagurevisi, sum(z.realisasi) as realisasi from 

(select  'dipa' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from dipa a 
left join (select id_pagu, kdjd, kdjenbel, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from realisasi  where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' and kdbulan<='$_GET[kdbulan]' group by kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel

union
(select  'yanmasum' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from yanmasum a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from yanmasum a left join realisasi_yanmasum b on a.id_pagu=b.id_pagu where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and b.kdbulan<='$_GET[kdbulan]' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)

union
(select  'bpjs' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from bpjs a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from bpjs a left join realisasi_bpjs b on a.id_pagu=b.id_pagu where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and b.kdbulan<='$_GET[kdbulan]' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)

union
(select  'blu' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from blu a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from blu a left join realisasi_blu b on a.id_pagu=b.id_pagu where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and b.kdbulan<='$_GET[kdbulan]' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)

union
(select  'hibah' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from hibah a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from hibah a left join realisasi_hibah b on a.id_pagu=b.id_pagu where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and b.kdbulan<='$_GET[kdbulan]' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)

union
(select  'kapitasi' as lap, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, b.realisasi  from kapitasi a 
left join (select a.id_pagu, a.kdjd, a.kdjenbel, a.kdkotama, a.kdsatker, a.thang, sum(b.realisasi) as realisasi from kapitasi a left join realisasi_kapitasi b on a.id_pagu=b.id_pagu where a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' and b.kdbulan<='$_GET[kdbulan]' group by a.kdjenbel) as b on   a.kdjenbel=b.kdjenbel
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)) as z group by z.kdjenbel order by z.kdjenbel) as z on w.kdjenbel=z.kdjenbel"); 	
	
$noo=1;
$j = 0; 
$row_tinggi = 6;
// data
while($data = mysql_fetch_array($perjenbel_global)) {

	$pagu 			= number_format($data[pagu],0,',','.');
	$revisi 		= number_format($data[revisi],0,',','.');
	$pagurevisi		= number_format($data[pagurevisi],0,',','.');
	$realisasi		= number_format($data[realisasi],0,',','.');
	
	if (($data[pagurevisi]=='') OR ($data[pagurevisi]=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($data[realisasi]/$data[pagurevisi])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	
	$sisa = $data[pagurevisi] - $data[realisasi];
	$sisa_des = number_format($sisa,0,',','.');	

		$pdf->SetFont('Arial','',10);	
		$ng = $pdf->GetY(); 
		$pdf->SetX(20);
	    $pdf->Cell(10,6,$noo,'LR',1,'C',2);	
		$pdf->SetY($ng);
		$pdf->SetX(30);
		$pdf->Cell(40,6,$data[nmjenbel],'LR',1,'L',2);
		$pdf->SetY($ng);
		$pdf->SetX(70);
		$pdf->Cell(37,6,$pagu,'LR',1,'R',2);
		
		$pdf->SetY($ng);
		$pdf->SetX(107);
		$pdf->Cell(37,6,$revisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(144);
		$pdf->Cell(37,6,$pagurevisi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(181);
		$pdf->Cell(37,6,$realisasi,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(218);
		$pdf->Cell(13,6,$prosen_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(231);
		$pdf->Cell(37,6,$sisa_des,'LR',1,'R',2);
		$pdf->SetY($ng);
		$pdf->SetX(268);
		$pdf->Cell(15,6,'','LR',1,'R',2);
		
		$noo++;		
}
//---------------------------------------------------------------------------------------------	

	$pdf->SetX(20); 
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(10,1,'','LRB',0,'C',1); 
	$pdf->Cell(40,1,'','LRB',0,'C',1); 
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1); 
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(13,1,'','LRB',0,'C',1);
	$pdf->Cell(37,1,'','LRB',0,'C',1);
	$pdf->Cell(15,1,'','LRB',0,'C',1);
	//$pdf->Ln();

$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'"); ;
$row = mysql_fetch_array($sql);

//$pdf->Ln();
$pdf->SetFont('Arial','',10);
$ng = $pdf->GetY();
//$pdf->SetY($ng);
//$pdf->SetX(170); 
//$pdf->Cell(0,10,$row['tempat'].",          ".$row['tanggal'],0,1,'C');
$pdf->SetY($ng-3);
$pdf->SetX(130); 
$pdf->Cell(0,20,$row['an'],0,1,'C');
$pdf->SetY($ng-3);
$pdf->SetX(130); 
$pdf->Cell(0,30,$row['pejabat1'],0,1,'C');
$pdf->SetY($ng-3);
$pdf->SetX(130); 
$pdf->Cell(0,60,$row['nama'],0,1,'C');
$pdf->SetY($ng-3);
$pdf->SetX(130); 
$pdf->Cell(0,70,$row['pkt_crp'],0,1,'C');

$pdf->Output();
?> 