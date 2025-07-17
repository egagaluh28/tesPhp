<?php 
include "../application/connect.php";


define('FPDF_FONTPATH','fpdf16/font/');
require('fpdf16/fpdf.php');


// new
$pdf=new FPDF('P','mm','A4');
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();

//-----------------------isi surat---------------------------------------------------------
 $kueri=mysql_query("select  a.*, b.nmbulan from surat a
					left join t_bulan b on a.kdbulan=b.kdbulan	
					where a.kdbulan='$_GET[kdbulan]' and a.thang='$_$_GET[thang]' and a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]'");
 $row    = mysql_fetch_array($kueri);
 



// jml rm
$jml_daerah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from dipa a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil = mysql_fetch_array($jml_daerah);
 

$jml_yanmasum=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from yanmasum a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_yanmasum  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil1 = mysql_fetch_array($jml_yanmasum);	


$jml_bpjs=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from bpjs a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_bpjs  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil2 = mysql_fetch_array($jml_bpjs);	 


$jml_blu=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from blu a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_blu  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil3 = mysql_fetch_array($jml_blu);	


$jml_kapitasi=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from kapitasi a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_kapitasi  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil4 = mysql_fetch_array($jml_kapitasi);	


$jml_hibah=mysql_query("select a.kdkotama, a.kdsatker, a.thang, sum(a.pagu) as pagu,  sum(a.revisi) as revisi, sum(a.pagurevisi)  as pagurevisi, b.realisasi
from hibah a
left join (select kdkotama, kdsatker, thang, sum(realisasi) as realisasi  from realisasi_hibah  where kdbulan<='$_GET[kdbulan]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang) as b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatker and a.thang=b.thang
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdkotama, a.kdsatker, a.thang"); 
$hasil5 = mysql_fetch_array($jml_hibah);	 

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
	$hsserap	= number_format($jprosen,2,',','.');

 
// KOP
$kop= mysql_query("select * from kopstuk where  kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' "); 
$x = mysql_fetch_array($kop);
	
$kop=$x[panjang_kop];
$grs=$x[panjang_grs];

$kopsrt=$kop+8;
$grssrt=$kop+7;


$pdf->Sety(20); 
$pdf->SetX(20); 
$pdf->Cell($kopsrt,5.5,$x[kop1],0,1,'C');
$pdf->SetX(20); 
$pdf->Cell($kopsrt,5.5,$x[kop2],0,1,'C');
$pdf->SetX(20); 
$pdf->Cell($grssrt,0,'                                      ',0,0,'L',1);




$pdf->SetFont('Arial','',12);

$pdf->SetXY(135,30); 
$pdf->Cell(40,5.5,$row[tempat_tanggal],0,1,'L'); 

 
$pdf->SetXY(20,33); 
$pdf->Cell(40,5.5,'Nomor',0,1,'L');
$pdf->SetXY(20,38.5);
$pdf->Cell(40,5.5,'Klasifikasi',0,1,'L');
$pdf->SetXY(20,44); 
$pdf->Cell(40,5.5,'Lampiran',0,1,'L');
$pdf->SetXY(20,49.5); 
$pdf->Cell(40,5.5,'Perihal',0,1,'L');

$pdf->SetXY(46,33); 
$pdf->Cell(40,5.5,':'.' '.$row[nomor],0,1,'L');
$pdf->SetXY(46,38.5); 
$pdf->Cell(40,5.5,':'.' '.$row[klasifikasi],0,1,'L');
$pdf->SetXY(46,44); 
$pdf->Cell(200,5.5,':'.' '.$row[lampiran],0,1,'L');
$pdf->SetXY(46,49.5); 
$pdf->Cell(200,5.5,':'.' '.$row[perihal],0,1,'L');
$pdf->SetXY(46,55); 
$pdf->Cell(200,5.5,' '.' '.'Bulan'.' '.$row[nmbulan].' TA'.' '.$row[thang],0,1,'L');
$pdf->SetXY(49,60.5); 
$pdf->Cell($row[garis],0,'                                      ',0,0,'L',1);


$pdf->SetXY(135,55); 
$pdf->Cell(200,5.5,'Kepada',0,1,'L');

$pdf->SetXY(125,61); 
$pdf->Cell(200,10,'Yth.',0,1,'L');

$pdf->SetXY(135,61); 
$pdf->Cell(200,10,$row[tujuan_surat],0,1,'L');
$pdf->SetXY(135,71); 
$pdf->Cell(200,10,'di',0,1,'L');
$pdf->SetXY(135,81); 
$pdf->Cell(200,10,$row[kota_penerima],0,1,'L');


$pdf->SetFillColor(255,255,255);

$pdf->Ln(5); 

$pdf->SetX(20);  
$pdf->Cell(40,5.5,'u.p'.' '.$row[up],0,1,'L');
$pdf->Ln(2);     

$space= str_replace("$row[spasi]", "									", $row[spasi]);       

$pdf->SetX(20);
$pdf->Cell(20,5,'1.'.$space.''.'Dasar :',0,0,'L',1); 
//$pdf->SetX(35);
//$pdf->Cell(20,5,'Dasar :',0,0,'L',1); 




$pdf->Ln(10); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'a.'.$space.''.$row['dasar_a']);

$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'b.'.$space.''.$row['dasar_b']);

$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'c.'.$space.''.$row['dasar_c']);



$pdf->Ln(); 
$pdf->SetX(20);
$pdf->MultiCell(0,5,'2.'.$space.'Sesuai hal tersebut diatas, bersama ini kami sampaikan Laporan Pelaksanaan Anggaran Periode bulan'.' '.$row[nmbulan].' '.'Tahun'.' '.$row[thang].' sebagai berikut:');

$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'a.'.$space.''.'Pagu Anggaran Setelah Revisi Sebesar Rp. '.$jpagurevisi_des.',-'.' dengan rincian:');

$pdf->Ln(); 
$pdf->SetX(49);
$pdf->Cell(90,5,'1)'.$space.''.'Pagu Anggaran',0,0,'L',1); 
$pdf->Cell(10,5,'Rp.',0,0,'L',1); 
$pdf->Cell(0,5,$jpagu_des.',-'.' ',0,0,'R',1); 

$pdf->Ln(); 
$pdf->SetX(49);
$pdf->Cell(90,5,'2)'.$space.''.'Revisi Anggaran (+/-)',0,0,'L',1); 
$pdf->Cell(10,5,'Rp.',0,0,'L',1); 
$pdf->Cell(0,5,$jrevisi_des.',-'.' ',0,0,'R',1); 

$pdf->Ln(7); 
$pdf->SetX(140);
$pdf->Cell(58,2,'   ','T',0,'L',1);

$pdf->Ln(2); 
$pdf->SetX(49);
$pdf->Cell(90,5,'   '.$space.''.'Pagu Anggaran setelah Revisi',0,0,'L',1);
$pdf->Cell(10,5,'Rp.',0,0,'L',1); 
$pdf->Cell(0,5,$jpagurevisi_des.',-'.' ',0,0,'R',1); 



//------------------------------

$pdf->Ln(10); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'b.'.$space.'Pelaksanaan Anggaran',0,'J',FALSE);

$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'  '.$space.'Wabku Bagian Anggaran DIPA Petikan Satker Rp. '.$jrealisisi_des.',-'.' ('.$hsserap.'  %) dari Pagu Anggaran setelah Revisi sebesar Rp.'.$jpagurevisi_des.',-'.' dengan rincian:',0,'J',FALSE);

// query perjenbel
/*
$pagu51=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='51' group by kdjenbel");
$x51    = mysql_fetch_array($pagu51);



$reals51=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='51' and kdbulan<='$row[kdbulan]' group by kdjenbel");
$y51    = mysql_fetch_array($reals51);

 $jpagu51 =  number_format($x51[pagurevisi],0,',','.');
 $jreals51 =  number_format($y51[realisasi],0,',','.');

 if (($x51[pagurevisi]=='') OR ($x51[pagurevisi]=='0')) {
	$serap51     = 0; 
    } else { 
	$serap51 = ($y51[realisasi]/$x51[pagurevisi]) * 100;
	}
	$hsserap51 = number_format($serap51,2,',','.');

$pagu52=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='52' group by kdjenbel");
$x52    = mysql_fetch_array($pagu52);

$reals52=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='52' and kdbulan<='$row[kdbulan]' group by kdjenbel");
$y52    = mysql_fetch_array($reals52);

 $jpagu52  =  number_format($x52[pagurevisi],0,',','.');
 $jreals52 =  number_format($y52[realisasi],0,',','.');

   if (($x52[pagurevisi]=='') OR ($x52[pagurevisi]=='0')) {
	$serap52     = 0; 
    } else { 
	$serap52 = ($y52[realisasi]/$x52[pagurevisi]) * 100;
	}
	$hsserap52 = number_format($serap52,2,',','.');

$pagu53=mysql_query("select sum(pagurevisi) as pagurevisi from dipa where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='53' group by kdjenbel");
$x53    = mysql_fetch_array($pagu53);

$reals53=mysql_query("select sum(realisasi) as realisasi from realisasi where thang='$_$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdjenbel='53' and kdbulan<='$row[kdbulan]' group by kdjenbel");
$y53    = mysql_fetch_array($reals53);

 $jpagu53  =  number_format($x53[pagurevisi],0,',','.');
 $jreals53 =  number_format($y53[realisasi],0,',','.');
 
	if (($x53[pagurevisi]=='') OR ($x53[pagurevisi]=='0')) {
	$serap53     = 0; 
    } else { 
	$serap53 = ($y53[realisasi]/$x53[pagurevisi]) * 100;
	}
	$hsserap53 = number_format($serap53,2,',','.');

*/
//------------------------belpeg------------------------------------------
$pagu51=mysql_query("select w.kdjenbel, w.nmjenbel, z.kdkotama, z.kdsatker, z.thang, z.pagu, z.revisi, z.pagurevisi, z.realisasi from t_jenbel w left join 

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
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)) as z group by z.kdjenbel order by z.kdjenbel) as z   on w.kdjenbel=z.kdjenbel where z.kdjenbel='51'");  
 
  $x51    = mysql_fetch_array($pagu51);
 
  $jpagu51 =  number_format($x51[pagurevisi],0,',','.');
  $jreals51 =  number_format($x51[realisasi],0,',','.');
  
  if (($x51[pagurevisi]=='') OR ($x51[pagurevisi]=='0')) {
	$serap51     = 0; 
    } else { 
	$serap51 = ($x51[realisasi]/$x51[pagurevisi]) * 100;
	}
	$hsserap51 = number_format($serap51,2,',','.');
	
	
//------------------------belbar------------------------------------------
$pagu52=mysql_query("select w.kdjenbel, w.nmjenbel, z.kdkotama, z.kdsatker, z.thang, z.pagu, z.revisi, z.pagurevisi, z.realisasi from t_jenbel w left join 

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
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)) as z group by z.kdjenbel order by z.kdjenbel) as z   on w.kdjenbel=z.kdjenbel where z.kdjenbel='52'");  
 
  $x52    = mysql_fetch_array($pagu52);
 
  $jpagu52 =  number_format($x52[pagurevisi],0,',','.');
  $jreals52 =  number_format($x52[realisasi],0,',','.');
  
  if (($x52[pagurevisi]=='') OR ($x52[pagurevisi]=='0')) {
	$serap52     = 0; 
    } else { 
	$serap52 = ($x52[realisasi]/$x52[pagurevisi]) * 100;
	}
	$hsserap52 = number_format($serap52,2,',','.');	
	
	
//--------------- belmod-------------
$pagu53=mysql_query("select w.kdjenbel, w.nmjenbel, z.kdkotama, z.kdsatker, z.thang, z.pagu, z.revisi, z.pagurevisi, z.realisasi from t_jenbel w left join 

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
where  a.kdkotama='$_GET[kdkotama]' and a.kdsatker='$_GET[kdsatker]' and a.thang='$_GET[thang]' group by  a.kdjenbel)) as z group by z.kdjenbel order by z.kdjenbel) as z   on w.kdjenbel=z.kdjenbel where z.kdjenbel='53'");  
 
  $x53    = mysql_fetch_array($pagu53);
 
  $jpagu53 =  number_format($x53[pagurevisi],0,',','.');
  $jreals53 =  number_format($x53[realisasi],0,',','.');
  
  if (($x53[pagurevisi]=='') OR ($x53[pagurevisi]=='0')) {
	$serap53     = 0; 
    } else { 
	$serap53 = ($x53[realisasi]/$x53[pagurevisi]) * 100;
	}
	$hsserap53 = number_format($serap53,2,',','.');		

$pdf->Ln(); 
$pdf->SetX(50);
$pdf->MultiCell(0,5,'1)'.$space.''.'Belanja Pegawai Rp. '.$jreals51.',-'.' ('.$hsserap51.' %) dari Pagu Anggaran setelah Revisi sebesar Rp.'.$jpagu51.',-');

$pdf->Ln(); 
$pdf->SetX(50);
$pdf->MultiCell(0,5,'2)'.$space.''.'Belanja Barang Rp. '.$jreals52.',-'.' ('.$hsserap52.' %) dari Pagu Anggaran setelah Revisi sebesar Rp.'.$jpagu52.',-');

//buat halaman baru (no halaman)----------------------------------------------
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,'2',0,1,'C');

$pdf->Ln(10); 
$pdf->SetX(50);
$pdf->MultiCell(0,5,'3)'.$space.''.'Belanja Modal Rp. '.$jreals53.',-'.' ('.$hsserap53.' %) dari Pagu Anggaran setelah Revisi sebesar Rp.'.$jpagu53.',-');

$pdf->Ln(); 
$pdf->SetX(50);
$pdf->MultiCell(0,5,'4)'.$space.''.'Belanja Lain-lain Rp. 0,-'.' (0 %) dari Pagu Anggaran setelah Revisi sebesar Rp. 0,-');





$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'c.'.$space.'Hambatan yang dihadapi. Tidak ada',0,'J',FALSE);

$pdf->Ln(); 
$pdf->SetX(35);
$pdf->MultiCell(0,5,'d.'.$space.'Langkah-langkah yang dilakukan. Tidak Ada',0,'J',FALSE);

$pdf->Ln(); 
$pdf->SetX(20);
$pdf->MultiCell(0,5,'3.'.$space.'Saran. Tidak Ada',0,'J',FALSE);

$pdf->Ln(); 
$pdf->SetX(20);
$pdf->MultiCell(0,5,'4.'.$space.'Demikian mohon menjadi maklum',0,'J',FALSE);






$ses=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$uhuy = mysql_fetch_array($ses);

$pdf->SetFont('Arial','',12);
$pdf->Ln(); 


$pdf->SetX(93); 
$pdf->Cell(0,5,$uhuy['an'],0,1,'C');
$pdf->Ln(1);
$pdf->SetX(93); 
$pdf->Cell(0,5,$uhuy['pejabat1'],0,1,'C');
$pdf->Ln(15);
$pdf->SetX(93); 
$pdf->Cell(0,5,$uhuy['nama'],0,1,'C');
$pdf->Ln(1);
$pdf->SetX(93); 
$pdf->Cell(0,5,$uhuy['pkt_crp'],0,1,'C');






// --------------------- Tembusan --------------------------------------------


 
	


$result=mysql_query("select * from tembusan  where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'  and  urut<>'99' order by urut");


$norec=1;
$tempNorec = null;




	
$pdf->Ln(-5); 
$pdf->SetX(20); 	
$pdf->SetFont('Arial','',12);
$pdf->Cell(70,5,'Tembusan :',0,1,'L');	



while($temb = mysql_fetch_array($result)) {

$pdf->Ln(); 
$pdf->SetX(20); 
$pdf->SetFillColor(255,255,255);


   
	
	$pdf->Cell(14,5,$norec.''.'.','',0,'L',1); 
    $pdf->Cell(80,5,$temb['nama'].'.','',0,'L',1);
	$norec++;
			
}

    $edit = mysql_query("SELECT nama FROM tembusan where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'  and urut='99' ");
    $data    = mysql_fetch_array($edit);

	$pdf->Ln(6); 
	$pdf->SetX(21);
	$pdf->Cell($data['nama'],5,'         ','T',0,'L',1);



$pdf->Output();


?> 
