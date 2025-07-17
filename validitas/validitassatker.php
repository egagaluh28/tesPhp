<link rel="stylesheet" href="library/udiwe.css" type="text/css" media="screen" />
<br><table  width='1200' align='center' ><tr><td class='judulcontent' align='center'>VALIDITAS LAPLAKGAR SATKER</td></tr></table><br>	
<?	
include "library/indotgl_angka.php";

	print" <table  align='center' width='95%'>
	<tr>
		<td align='left'><a href='media.php?module=inputvaliditassatker' class='button green'>TAMBAH TAHUN ANGGARAN</a></td>";	
print "</tr></table><br>";

// header
	print "<table width='95%'  cellspacing='5' cellpadding='5' align='center' class='udiwe'>";
	print "<tr >";
	print    "<th   align='center'  width='5%' background='images/hover.png' rowspan='2'><span class='header'>NO</span></th>";	
	print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >SATKER</span></th>";
	print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >TAHUN</span></th>";
	print    "<th   align='center' background='images/hover.png' colspan='12'><span class='header' >BULAN</span></th>";	
	print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >TANGGAL</span></th>";
    print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >JAM</span></th>";		
	print    "<th   align='center' background='images/hover.png' rowspan='2' colspan='2'><span class='header' >AKSI</span></th>";
  	print "</tr>";
	
	print "<tr>";
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>JAN</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>PEB</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>MAR</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>APR</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>MEI</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>JUN</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>JUL</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>AGU</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>SEP</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>OKT</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>NOP</span></th>";	
	print    "<th   align='center'  width='4%' background='images/hover.png'><span class='header'>DES</span></th>";	
	print "</tr>";
	   
	$sql="SELECT a.*, b.nmsatkr from validitas a left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr  where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' order by a.thang";
    $qry=mysql_query($sql);

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	$tgl=tgl_indoangka($row[tanggal]);	
	
	
	print"<tr><td class='grs' align='center' valign='top'>$no</td>
			  <td class='grs' valign='top'> $row[nmsatkr]</td>
			  <td class='grs'  valign='top' align='center'>$row[thang]</td>";
			  
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
			  print "<td  align='center' valign='top'>$tgl</td>";
			  print "<td  align='center' valign='top'>$row[jam]</td>";
			  print "<td  align='center' valign='top'><a href='media.php?module=editvaliditassatker&id_validitas=$row[id_validitas]'>
			  <img src='images/edit.png' width='20' title='Edit'></a></td>
			  <td  align='center' valign='top'><a href=\"validitas/prosesvaliditassatker.php?aksi=hapus&id_validitas=$row[id_validitas]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $row[thang] ~? ')\" ><img src='images/delete.png' width='20' title='Delete'></td>				  
		  </tr>";	
		  $no++;
     }
	print"</table><br>";
