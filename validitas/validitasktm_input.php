<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />

<br><table  width='1200' align='center' ><tr><td class='judulcontent' align='center'>ABSENSI LAPLAKGAR KOTAMA</td></tr></table><br>	
<?	
include "library/indotgl_angka.php";

//	print" <table  align='center' width='85%'>
//	<tr>
//		<td align='left'><a href='media.php?module=inputvaliditasktm' class='button green'>TAMBAH TAHUN ANGGARAN</a></td>";	
//print "</tr></table><br>";

// header
	print "<table width='85%'  cellspacing='5' cellpadding='5' align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'  width='5%'  rowspan='2'>NO</th>";	
	print    "<th   align='center'  rowspan='2'><span class='header' >KOTAMA</th>";
	print    "<th   align='center'  rowspan='2'><span class='header' >TAHUN</th>";
	print    "<th   align='center'  rowspan='2'><span class='header' >KET</th>";
	print    "<th   align='center'  colspan='12'><span class='header' >BULAN</th>";	
	//print    "<th   align='center'  rowspan='2'><span class='header' >TANGGAL</th>";
    //print    "<th   align='center'  rowspan='2'><span class='header' >JAM</th>";		
	print    "<th   align='center'  rowspan='2' ><span class='header' >AKSI</th>";
  	print "</tr>";
	
	print "<tr>";
	print    "<th   align='center'  width='4%' >JAN</th>";	
	print    "<th   align='center'  width='4%' >PEB</th>";	
	print    "<th   align='center'  width='4%' >MAR</th>";	
	print    "<th   align='center'  width='4%' >APR</th>";	
	print    "<th   align='center'  width='4%' >MEI</th>";	
	print    "<th   align='center'  width='4%' >JUN</th>";	
	print    "<th   align='center'  width='4%' >JUL</th>";	
	print    "<th   align='center'  width='4%' >AGU</th>";	
	print    "<th   align='center'  width='4%' >SEP</th>";	
	print    "<th   align='center'  width='4%' >OKT</th>";	
	print    "<th   align='center'  width='4%' >NOP</th>";	
	print    "<th   align='center'  width='4%' >DES</th>";	
	print "</tr>";
	   
	$sql="SELECT a.*, b.nmkotama from validitasktm a left join t_kotam b on a.kdkotama=b.kdkotama  where a.kdkotama='$_SESSION[kdkotama]'  order by a.thang";
    $qry=mysql_query($sql);

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	$tgl=tgl_indoangka($row[tanggal]);	
	
	
	print"<tr><td class='grs' align='center' valign='top'>$no</td>
			  <td class='grs' valign='top'> $row[nmkotama]</td>
			  <td class='grs'  valign='top' align='center'>$row[thang]</td>
			  <td class='grs'  valign='top' >RESTORE</td>";
			  
			  if ($row[b01]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b02]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b03]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b04]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b05]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b06]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b07]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b08]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b09]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b10]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b11]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[b12]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			//  print "<td  align='center' valign='top'>$tgl</td>";
			 // print "<td  align='center' valign='top'>$row[jam]</td>";
			  print "<td  align='center' valign='top'><a href='media.php?module=editvaliditasktm&id_validitas=$row[id_validitas]' data-tooltip='Absensi Kotama' data-position='top' class='top'>
			  <img src='images/edit.png' width='20'></a></td>
			  			  
		  </tr>";	
		  
		  print "<tr><td class='grs' align='center' valign='top'></td>
			  <td class='grs' valign='top'></td>
			  <td class='grs'  valign='top' align='center'></td>
			  <td class='grs'  valign='top' >EMAIL</td>";
			  
			  if ($row[e01]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e02]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e03]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e04]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e05]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e06]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e07]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e08]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e09]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e10]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e11]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			  
			  if ($row[e12]=='x') 
			  print "<td class='grs' align='center' align='center'><img src='images/cekijo.png' width='22'></td>"; 
			  else  print "<td></td>";
			//  print "<td  align='center' valign='top'>$tgl</td>";
			//  print "<td  align='center' valign='top'>$row[jam]</td>";
			  print "<td  align='center' valign='top'></td>
			 				  
		  </tr>";	
		  $no++;
     }
	print"</table><br>";
