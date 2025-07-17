<?php 


include "../application/connect.php";

define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/fpdf.php');



// NEW
$pdf=new FPDF('P','mm','A4');
$pdf->Open(); 
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();

$kop= mysql_query("select * from kopstuk where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]'"); 
$x = mysql_fetch_array($kop);

$kop=$x[panjang_kop]+6;
$grs=$x[panjang_grs]+7;

$pdf->Sety(15); 
$pdf->SetX(15); 
$pdf->Cell($kop+5,5,$x[kop1],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($kop+5,5,$x[kop2],0,1,'C');
$pdf->SetX(15); 
$pdf->Cell($grs+5,0.2,'                             ',0,0,'L',1);  

         $qry = mysql_query("select * from t_bulan where kdbulan='$_GET[kdbulan]' ");
		 $x    = mysql_fetch_array($qry);
		 $nmbulan=strtoupper($x[nmbulan]);



$pdf->Ln(10); 

// JUDUL
$pdf->SetY(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'REKAP TUNKIN'.' '.$nmbulan.' '.$_GET[thang],0,1,'C');
$pdf->SetFillColor(255,255,255);  
$pdf->SetFont('Arial','',11);
$pdf->SetY(50); 
$pdf->SetX(15); 
$pdf->Cell(10,8,'NO',1,0,'C',1); 
$pdf->Cell(16,8,'GRADE',1,0,'C',1);
$pdf->Cell(30,8,'INDEX',1,0,'C',1); 
$pdf->Cell(22,8,'JML PERS',1,0,'C',1);
$pdf->Cell(35,8,'JML TUNKIN',1,0,'C',1);
$pdf->Cell(30,8,'PAJAK',1,0,'C',1);
$pdf->Cell(35,8,'REALISASI',1,0,'C',1);

    $sql="select a.*, b.id_tunkin, b.jumlah, b.pajak from t_grade a  join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	thang='$_GET[thang]' and kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' order by a.grade desc"; 
	$qry=mysql_query($sql);
 
$pdf->Ln(8.2);
//initialize counter
$i = 0; 
$no=1;


$row_height = 6;

// Ambil data dari database
while($row = mysql_fetch_array($qry)) {

    $indeks	 = number_format($row[indeks],0,',','.');
	$jumlah	 = number_format($row[jumlah],0,',','.');
	$pajak	 = number_format($row[pajak],0,',','.');
	$total	 = $row[indeks]*$row[jumlah];
	$total_rb	 = number_format($total,0,',','.');
	
	$realisasi = $total + $row[pajak];
	$realisasi_rb	 = number_format($realisasi,0,',','.');



// looping 
$pdf->SetFillColor(255,255,255);  
$pdf->SetFont('Arial','',11);
$ng = $pdf->GetY(); 
$pdf->SetX(15);
$pdf->Cell(10,6,$no,'LR',1,'R',2);
$pdf->SetY($ng);
$pdf->SetX(25);
$pdf->Cell(16,6,$row['grade'],'LR',1,'C',2);
$pdf->SetY($ng);
$pdf->SetX(41);
$pdf->Cell(30,6,$indeks,'LR',1,'R',2);
$pdf->SetY($ng);
$pdf->SetX(71);
$pdf->Cell(22,6,$jumlah,'LR',1,'R',2);
$pdf->SetY($ng);
$pdf->SetX(93);
$pdf->Cell(35,6,$total_rb,'LR',1,'R',2);
$pdf->SetY($ng);
$pdf->SetX(128);
$pdf->Cell(30,6,$pajak,'LR',1,'R',2);
$pdf->SetY($ng);
$pdf->SetX(158);
$pdf->Cell(35,6,$realisasi_rb,'LR',1,'R',2);
$y_axis = $y_axis + $row_height;
$i++;$no++;

} 

    $jml="select sum(a.indeks*b.jumlah) as total_tunkin, sum(b.jumlah) as total_pers, sum(b.pajak) as total_pajak from t_grade a  join tunkin b on a.grade=b.grade where b.kdbulan='$_GET[kdbulan]' and 
	b.thang='$_GET[thang]' and b.kdkotama='$_GET[kdkotama]' and b.kdsatker='$_GET[kdsatker]' group by b.kdkotama,b.kdsatker,b.kdbulan,b.thang"; 
	$oke=mysql_query($jml);
	$hasil    = mysql_fetch_array($oke); 
	
	$total_tunkin	 = number_format($hasil[total_tunkin],0,',','.');
	$total_pers	     = number_format($hasil[total_pers],0,',','.');
	$total_pajak	 = number_format($hasil[total_pajak],0,',','.');
	
	$realisasi = $hasil[total_tunkin] + $hasil[total_pajak]; 
	$total_realisasi	 = number_format($realisasi,0,',','.');
 
	$pdf->SetX(15);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(10,6,'','LRTB',0,'C',1); 
	$pdf->Cell(46,6,'JUMLAH','LRTB',0,'C',1);
	$pdf->Cell(22,6,$total_pers,'LRTB',0,'R',1);
	$pdf->Cell(35,6,$total_tunkin,'LRTB',0,'R',1);	 
	$pdf->Cell(30,6,$total_pajak,'LRTB',0,'R',1);	 
	$pdf->Cell(35,6,$total_realisasi,'LRTB',0,'R',1);	 


	 
// tanda tangan
		$sql=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_GET[kdkotama]' and kdsatker='$_GET[kdsatker]' and kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]'");


		while($row = mysql_fetch_array($sql))
		{
		if ($row['an']=='') {
		$pdf->SetFont('Arial','',11.5);
		$ng = $pdf->GetY();
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,30,$row['tempat'].",          ".$row['tanggal'],0,1,'C');

		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,50,$row['pejabat'],0,1,'C');
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,100,$row['nama'],0,1,'C');
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,110,$row['pkt_crp'],0,1,'C');

		} else {
        $pdf->SetFont('Arial','',11); 
		$ng = $pdf->GetY();
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,30,$row['tempat'].",          ".$row['tanggal'],0,1,'C');

		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,40,$row['an'],0,1,'C');

		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,50,$row['pejabat'],0,1,'C');
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,90,$row['nama'],0,1,'C');
		$pdf->SetY($ng);
		$pdf->SetX(110); 
		$pdf->Cell(0,100,$row['pkt_crp'],0,1,'C');
		
		}
}


$pdf->Output();

?>
