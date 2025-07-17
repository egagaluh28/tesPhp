<?php 
include "../application/connect.php";
include "../library/indotgl_angka.php";
include "../library/indotgl.php";
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');

// new
$pdf=new FPDF('L','mm',array(215, 327));
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='000000'"); 
$x = mysql_fetch_array($kop);

$kop=$x[panjang_kop];
$grs=$x[panjang_grs];

$pdf->Sety(15); 
$pdf->SetX(15); 
$pdf->Cell($kop+10,5,$x[kop1],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($kop+10,5,$x[kop2],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($grs+10,0.2,'                             ',0,0,'C',1); 

	

    //------------------------sisa kas-----------------------------------------
	// $sql= mysql_query("SELECT nmsatkr from t_satkr where kdkotama = '$_GET[kdkotama]' and kdsatkr = '$_GET[kdsatker]'"); 
	// $row = mysql_fetch_array($sql);
	 
	 $ambilkode = mysql_query("SELECT a.thang, a.kdkotama, a.kdsatker, a.kdsa, a.kdprogram, a.kdgiat, a.kdoutput, a.kdakun, a.nmakun, b.nmprogram, c.nmgiat, d.nmoutput, f.nmsa from dipa a
							left join t_program b on a.kdprogram=b.kdprogram
							left join t_giat c on a.kdprogram=c.kdprogram and a.kdgiat=c.kdgiat
							left join t_output d on a.kdprogram=d.kdprogram and a.kdgiat=d.kdgiat and a.kdoutput=d.kdoutput
							left join t_sa f on a.kdsa=f.kdsa
							where a.kdsa		= '$_GET[kdsa]' and
								  a.kdprogram	= '$_GET[kdprogram]' and
								  a.kdgiat   	= '$_GET[kdgiat]' and
								  a.kdoutput   	= '$_GET[kdoutput]' and
								  a.kdakun   	= '$_GET[kdakun]' and
								  a.kdkotama 	= '$_GET[kdkotama]' and 
								  a.thang    	= '$_GET[thang]'"); 
     $data      = mysql_fetch_array($ambilkode);
	 
	
	$program=strtoupper($data[nmprogram]);
	$giat=strtoupper($data[nmgiat]);
	$output=strtoupper($data[nmoutput]);
	$akun=strtoupper($data[nmakun]);
	$thang= $_GET[thang];
	
	
$pdf->Ln(10); 
$pdf->SetFont('Arial','',10);
// header
$pdf->SetY(25);
$pdf->SetX(110); 
$pdf->Cell(60,5,'KARTU PENGAWASAN ANGGARAN TNI AD'.' '.$thang,0,1,'L');
$pdf->SetY(30); 
$pdf->SetX(110); 
$pdf->Cell(60,5,"SUMBER ANGGARAN",0,1,'L');
$pdf->SetY(35); 
$pdf->SetX(110); 
$pdf->Cell(65,5,"PROGRAM",0,1,'L');
$pdf->SetY(40); 
$pdf->SetX(110); 
$pdf->Cell(70,5,"KEGIATAN",0,1,'L');
$pdf->SetY(45); 
$pdf->SetX(110); 
$pdf->Cell(75,5,"OUTPUT",0,1,'L');
$pdf->SetY(50); 
$pdf->SetX(110); 
$pdf->Cell(80,5,"AKUN",0,1,'L');
$pdf->SetY(55); 
$pdf->SetX(110); 
$pdf->Cell(65,5,"TAHUN ANGGARAN",0,1,'L');

$pdf->SetY(30); 
$pdf->SetX(150); 
if ($_GET[kdsa]=='1') {
$pdf->Cell(60,5,':'.'  '.$data[nmsa].' ( ANGGARAN PENDAPATAN BELANJA NEGARA )',0,1,'L');
} else if ($_GET[kdsa]=='2') {
$pdf->Cell(60,5,':'.'  '.$data[nmsa].' ( ANGGARAN PENDAPATAN BELANJA NEGARA PERUBAHAN )',0,1,'L');
} else {
$pdf->Cell(60,5,':',0,1,'L');	
}
$pdf->SetY(35); 
$pdf->SetX(150); 
$pdf->Cell(60,5,':'.'  '.$program.' ( '. $data[kdprogram].' )',0,1,'L');
$pdf->SetY(40); 
$pdf->SetX(150); 
$pdf->Cell(60,5,':'.'  '.$giat.' ( '. $data[kdgiat].' )',0,1,'L');
$pdf->SetY(45); 
$pdf->SetX(150); 
$pdf->Cell(60,5,':'.'  '.$output.' ( '. $data[kdoutput].' )',0,1,'L');
$pdf->SetY(50); 
$pdf->SetX(150); 
$pdf->Cell(60,5,':'.'  '.$akun.' ( '. $data[kdakun].' )',0,1,'L');

$pdf->SetY(55); 
$pdf->SetX(150); 
$pdf->Cell(60,5,':  '.$data[thang],0,1,'L');

     $tgl  = date("d");
     $sasi = date("m");
	 $thn =  date("Y");
	 
	switch ($sasi) {
	case "01" : $bulan="Januari";break;
	case "02" : $bulan="Februari";break;
	case "03" : $bulan="Maret";break;
	case "04" : $bulan="April";break;
	case "05" : $bulan="Mei";break;
	case "06" : $bulan="Juni";break;
	case "07" : $bulan="Juli";break;
	case "08" : $bulan="Agustus";break;
	case "09" : $bulan="September"; break;
	case "10" : $bulan="Oktober";break;
	case "11" : $bulan="Nopember";break;
	case "12" : $bulan="Desember";break;
	}
	$urbulan = $bulan;

//  $pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',10);
$pdf->SetY(60); 
$pdf->SetX(15); 
$pdf->Cell(0,5,'Periode : 1 Januari S.D '.' '.$tgl.' '.$urbulan.' '.$thn,0,1,'L');

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',9);
$pdf->SetY(67); 
$pdf->SetX(15); 
$pdf->Cell(7,10,'NO',1,0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(22); 
$pdf->Cell(95,10,'URAIAN',1,0,'C',1); 


 

$pdf->SetY(67); 
$pdf->SetX(117);
$pdf->Cell(30,10,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(67); 
$pdf->SetX(147);
$pdf->Cell(28,5,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(147);
$pdf->Cell(28,5,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(175);
$pdf->Cell(30,5,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(175);
$pdf->Cell(30,5,'REVISI','LRB',0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(205);
$pdf->Cell(43,5,'S P M','LRT',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(205);
$pdf->Cell(43,5,'NOMOR / TANGGAL','LRB',0,'C',1); 


$pdf->SetY(67); 
$pdf->SetX(248);
$pdf->Cell(30,5,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(248);
$pdf->Cell(30,5,'WABKU','LRB',0,'C',1); 

$pdf->SetY(67); 
$pdf->SetX(278);
$pdf->Cell(30,5,'SISA','LRT',0,'C',1); 
$pdf->SetY(72); 
$pdf->SetX(278);
$pdf->Cell(30,5,'(5-7)','LRB',0,'C',1); 


$pdf->SetY(67); 
$pdf->SetX(308); 
$pdf->Cell(8,10,'KET',1,0,'C',1); 


$pdf->Ln();
$pdf->SetX(15); 
$pdf->Cell(7,5,'1','LRTB',0,'C',1); 
$pdf->Cell(95,5,'2','LRTB',0,'C',1); 
$pdf->Cell(30,5,'3','LRTB',0,'C',1);
$pdf->Cell(28,5,'4','LRTB',0,'C',1); 
$pdf->Cell(30,5,'5','LRTB',0,'C',1); 
$pdf->Cell(43,5,'6','LRTB',0,'C',1);
$pdf->Cell(30,5,'7','LRTB',0,'C',1); 
$pdf->Cell(30,5,'8','LRTB',0,'C',1);
$pdf->Cell(8,5,'9','LRTB',0,'C',1);

$pdf->Ln();

$hal=1;

$i = 0; 
$no=1;
//Set maximum rows per page
$max = 31;
//Set Row Height
$row_height = 5;
		  
$sql= mysql_query("

select a.kdsatker as kdakun, a.kdsatker as display, b.nmsatkr as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, '' as nospm, '' as tglspm, sum(a1.realisasi) as realisasi from dipa a
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
left join (select id_pagu, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from  realisasi where 
kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' group by id_pagu) as a1 on  a.id_pagu=a1.id_pagu
where a.kdsa		='$_GET[kdsa]' and
	  a.kdprogram	='$_GET[kdprogram]' and
	  a.kdgiat   	='$_GET[kdgiat]' and
	  a.kdoutput   	='$_GET[kdoutput]' and
	  a.kdakun   	='$_GET[kdakun]' and
	  a.kdkotama 	='$_GET[kdkotama]' and 
	  a.thang    	='$_GET[thang]' 
group by a.kdsatker

union (SELECT a.kdakun, concat(a.kdsatker,a.kdsakun) as display, a.nmsakun as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, '' as nospm, '' as tglspm, sum(realisasi) as realisasi
from dipa a 
left join (select id_pagu, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from  realisasi where 
kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' group by id_pagu) as b on  a.id_pagu=b.id_pagu
where a.kdsa		='$_GET[kdsa]' and
	  a.kdprogram	='$_GET[kdprogram]' and
	  a.kdgiat   	='$_GET[kdgiat]' and
	  a.kdoutput   	='$_GET[kdoutput]' and
	  a.kdakun   	='$_GET[kdakun]' and
	  a.kdkotama 	='$_GET[kdkotama]' and 
	  a.thang    	='$_GET[thang]' 
	  group by a.kdsatker, a.kdsa, a.kdprogram, a.kdgiat, a.kdoutput,a.kdakun, a.kdsakun) 
union (select a.kdakun, concat(a.kdsatker, a.kdsakun,a.urutitem,a.id_pagu) as display, concat('- ',a.nmitem) as uraian, a.pagu, a.revisi, a.pagurevisi, '' as nospm, '' as tglspm, x.realisasi from dipa a
	  left join (select id_pagu, kdkotama, kdsatker, thang,  sum(realisasi) as realisasi from   realisasi where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' group by id_pagu) as x on  a.id_pagu=x.id_pagu
where a.kdsa		='$_GET[kdsa]' and
	  a.kdprogram	='$_GET[kdprogram]' and
	  a.kdgiat   	='$_GET[kdgiat]' and
	  a.kdoutput   	='$_GET[kdoutput]' and
	  a.kdakun   	='$_GET[kdakun]' and
	  a.kdkotama 	='$_GET[kdkotama]' and 
	  a.thang    	='$_GET[thang]' 
	  group by a.id_pagu) 	 
union(select a.kdakun, concat(a.kdsatker, a.kdsakun,a.urutitem,a.id_pagu,y.id_realisasi) as display, '' as uraian, ''as pagu, '' as revisi, '' as pagurevisi, y.nospm, y.tglspm, y.realisasi from dipa a
	  left join (select id_pagu, id_realisasi, kdkotama, kdsatker, thang, nospm, tglspm, realisasi from   realisasi where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' ) as y on  a.id_pagu=y.id_pagu
where a.kdsa		='$_GET[kdsa]' and
	  a.kdprogram	='$_GET[kdprogram]' and
	  a.kdgiat   	='$_GET[kdgiat]' and
	  a.kdoutput   	='$_GET[kdoutput]' and
	  a.kdakun   	='$_GET[kdakun]' and
	  a.kdkotama 	='$_GET[kdkotama]' and 
	  a.thang    	='$_GET[thang]' 
	  group by y.id_realisasi)	  order by display "); 

while($row = mysql_fetch_array($sql)) {

if (($hal) == '1') {   
     $max=17;
   } else {	 $max=27; }

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
   
   //    $pdf->SetFillColor(255,255,255);
   $pdf->SetFillColor(255,255,255);
   $pdf->SetFont('Arial','',9);
   
   $pdf->SetY(20); 
$pdf->SetX(15); 
$pdf->Cell(7,10,'NO',1,0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(22); 
$pdf->Cell(95,10,'URAIAN',1,0,'C',1); 


 

$pdf->SetY(20); 
$pdf->SetX(117);
$pdf->Cell(30,10,'PAGU AWAL',1,0,'C',1); 


$pdf->SetY(20); 
$pdf->SetX(147);
$pdf->Cell(28,5,'REVISI PAGU','LRT',0,'C',1); 
$pdf->SetY(25); 
$pdf->SetX(147);
$pdf->Cell(28,5,'(+/-)','LRB',0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(175);
$pdf->Cell(30,5,'PAGU SETELAH','LRT',0,'C',1); 
$pdf->SetY(25); 
$pdf->SetX(175);
$pdf->Cell(30,5,'REVISI','LRB',0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(205);
$pdf->Cell(43,5,'S P M','LRT',0,'C',1); 
$pdf->SetY(25); 
$pdf->SetX(205);
$pdf->Cell(43,5,'NOMOR / TANGGAL','LRB',0,'C',1); 


$pdf->SetY(20); 
$pdf->SetX(248);
$pdf->Cell(30,5,'REALISASI','LRT',0,'C',1); 
$pdf->SetY(25); 
$pdf->SetX(248);
$pdf->Cell(30,5,'WABKU','LRB',0,'C',1); 

$pdf->SetY(20); 
$pdf->SetX(278);
$pdf->Cell(30,5,'SISA','LRT',0,'C',1); 
$pdf->SetY(25); 
$pdf->SetX(278);
$pdf->Cell(30,5,'(5-7)','LRB',0,'C',1); 


$pdf->SetY(20); 
$pdf->SetX(308); 
$pdf->Cell(8,10,'KET',1,0,'C',1); 
   
   $pdf->SetY(30); 
   $pdf->SetX(15); 
   $pdf->Cell(7,5,'1','LRTB',0,'C',1); 
   $pdf->Cell(95,5,'2','LRTB',0,'C',1); 
   $pdf->Cell(30,5,'3','LRTB',0,'C',1);
   $pdf->Cell(28,5,'4','LRTB',0,'C',1); 
   $pdf->Cell(30,5,'5','LRTB',0,'C',1); 
   $pdf->Cell(43,5,'6','LRTB',0,'C',1);
   $pdf->Cell(30,5,'7','LRTB',0,'C',1);
   $pdf->Cell(30,5,'8','LRTB',0,'C',1); 
   $pdf->Cell(8,5,'9','LRTB',0,'C',1); 
  

 //Go to next row
   $y_axis = $y_axis + $row_height;
   //Set $i variable to 0 (first row)
   $i=0;
   $pdf->Ln();
  } 

    $pagu 			= number_format($row[pagu],0,',','.');
	$revisi 		= number_format($row[revisi],0,',','.');
	$pagurevisi		= number_format($row[pagurevisi],0,',','.');
	$realisasi		= number_format($row[realisasi],0,',','.');
	$sisa			= $row[pagurevisi]-$row[realisasi];
	$sisa_rb		= number_format($sisa,0,',','.');
	
	
	
	$tglspm=tgl_indoangka($row[tglspm]);
	
	
	$str = $row[display];
    $pj = strlen($str);
  
    $pdf->SetX(15);
	$ng = $pdf->GetY(); 
	if ($pj=='2') {	
	    $pdf->SetFont('Arial','',9);
	    $pdf->Cell(7,5,$no,'LR',1,'C',2);
	    $no++;		
	} else {
	$pdf->Cell(7,5,'','LR',1,'C',2);
	}
  
  //  $ng = $pdf->GetY(); 
	$pdf->SetY($ng);
	$pdf->SetX(22);
	if ($pj<'24') {	
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(95,5,$row[uraian],'LR',1,'L',2);
	} else {
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,5,$row[uraian],'LR',1,'L',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(117);
	if ($row[pagu]=='') {
	$pdf->Cell(30,5,'','LR',1,'R',2);
	} else {
	$pdf->Cell(30,5,$pagu,'LR',1,'R',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(147);
	if ($row[revisi]=='') {
	$pdf->Cell(28,5,'','LR',1,'R',2);
	} else {
	$pdf->Cell(28,5,$revisi,'LR',1,'R',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(175);
	if ($row[pagurevisi]=='') {
	$pdf->Cell(30,5,'','LR',1,'R',2);
	} else {
	$pdf->Cell(30,5,$pagurevisi,'LR',1,'R',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(205);
	$pdf->Cell(25,5,$row[nospm],'L',1,'L',2);
	
	$pdf->SetY($ng);
	$pdf->SetX(230);
	if ($row[tglspm]=='') {
	$pdf->Cell(18,5,'','R',1,'R',2);
	} else {
	$pdf->Cell(18,5,$tglspm,'R',1,'R',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(248);
	$pdf->Cell(30,5,$realisasi,'LR',1,'R',2);
	
	$pdf->SetY($ng);
	$pdf->SetX(278);
	if ($pj>'24') {	
	$pdf->Cell(30,5,'','LR',1,'R',2);
	} else {
	$pdf->Cell(30,5,$sisa_rb,'LR',1,'R',2);	
	}
	
	$pdf->SetY($ng);
	$pdf->SetX(308);
	$pdf->Cell(8,5,'','LR',1,'R',2);
	
    $y_axis = $y_axis + $row_height;
	$i++;  
  
//------------------------------- 
}

$jml= mysql_query("SELECT  sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi, sum(b.realisasi) as realisasi from dipa a 
left join (select id_pagu, kdkotama, kdsatker, thang, sum(realisasi) as realisasi from  realisasi where kdkotama='$_GET[kdkotama]'  and thang='$_GET[thang]' group by id_pagu) as b on  a.id_pagu=b.id_pagu
where a.kdsa	='$_GET[kdsa]' and
	  a.kdprogram	='$_GET[kdprogram]' and
	  a.kdgiat   	='$_GET[kdgiat]' and
	  a.kdoutput   	='$_GET[kdoutput]' and
	  a.kdakun   	='$_GET[kdakun]' and
	  a.kdkotama 	='$_GET[kdkotama]' and 
	  a.thang    	='$_GET[thang]' 
	  group by a.kdsa, a.kdprogram, a.kdgiat, a.kdoutput,a.kdakun");

$hasil = mysql_fetch_array($jml);	

	$pagu 			= number_format($hasil[pagu],0,',','.');
	$revisi 		= number_format($hasil[revisi],0,',','.');
	$pagurevisi		= number_format($hasil[pagurevisi],0,',','.');
	$realisasi		= number_format($hasil[realisasi],0,',','.');
	$sisa			= $hasil[pagurevisi]-$hasil[realisasi];
	$sisa_rb		= number_format($sisa,0,',','.');
	  
	  
   $ng = $pdf->GetY(); 
   $pdf->SetX(15);
   $pdf->SetFont('Arial','B',9);
   $pdf->Cell(7,6,'','LRTB',0,'C',1); 
   $pdf->Cell(95,6,'J U M L A H','LRTB',0,'C',1); 
   $pdf->Cell(30,6,$pagu,'LRTB',0,'R',1);
   $pdf->Cell(28,6,$revisi,'LRTB',0,'R',1); 
   $pdf->Cell(30,6,$pagurevisi,'LRTB',0,'R',1); 
   $pdf->Cell(43,6,'','LRTB',0,'C',1);
   $pdf->Cell(30,6,$realisasi,'LRTB',0,'R',1);
   $pdf->Cell(30,6,$sisa_rb,'LRTB',0,'R',1);
   $pdf->Cell(8,6,'','LRTB',0,'C',1); 
   
   $sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' order by thang desc, kdbulan desc limit 1"); ;
$row = mysql_fetch_array($sql);


//$pdf->Ln();
$pdf->SetFont('Arial','',11);
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
