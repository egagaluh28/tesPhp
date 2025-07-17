<link rel="stylesheet" href="library/udiwe.css" type="text/css" media="screen" />
<link rel="stylesheet" href="library/css_pencarian.css" type="text/css" media="screen" />

<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>VALIDITAS LAPLAKGAR SATKER</td></tr></table><br>	
<?	
print "<form name='form1' method='POST'  action='' >";
	print "<table width='90%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1' align='left'>";
	
/*	print "TAHUN : <select name='thang' class='rounded' onChange='this.form.submit()' >
									  <option value='' selected>- PILIH -</option>";
									  for ($thn=2017;$thn<=2025;$thn++){
									  if ($thn==$_POST[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";		
	print "</td></tr></table></form><br>"; */

// header
  //  $no=1;
	print "<table width='90%'  cellspacing='5' cellpadding='5' align='center' class='udiwe'>";
	print "<tr >";
	print    "<th   align='center'  width='5%' background='images/hover.png' rowspan='2'><span class='header'>NO</span></th>";	
	print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >SATKER</span></th>";
	print    "<th   align='center' background='images/hover.png' colspan='12'><span class='header' >BULAN</span></th>";	
	print    "<th   align='center' background='images/hover.png' rowspan='2'><span class='header' >EDIT</span></th>";
  	print "</tr>";
	
	print "<tr>";
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>JAN</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>PEB</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>MAR</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>APR</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>MEI</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>JUN</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>JUL</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>AGU</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>SEP</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>OKT</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>NOP</span></th>";	
	print    "<th   align='center'  width='5%' background='images/hover.png'><span class='header'>DES</span></th>";	
	print "</tr>";
	   
	$kode=mysql_query("select * from t_kotam where kdkotama<>'00' order by kdkotama");
	while($k=mysql_fetch_array($kode)){
  	    
	
	
    print"<tr ><td  align='center'>$no</td>
								<td  ><strong>$k[nmkotama]</strong></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								</tr>";
//	$no++;
								
	
	
	$sql="SELECT  a.nmsatkr, b.* from t_satkr a left join validitas b on a.kdkotama=b.kdkotama and a.kdsatkr=b.kdsatker
	where  a.kdkotama<>'00' and a.kdkotama='$k[kdkotama]'  order by a.kdkotama, a.kdsatkr";
    $qry=mysql_query($sql);
	
	

	$nomor=1;
	while ($row=mysql_fetch_array($qry)) {
	

	print"<tr><td class='grs' align='center'>$nomor</td>
			  <td class='grs'>$row[nmsatkr]</td>";
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
			  else  print "<td>";			

			 print "<td  align='center' valign='top'><a href='media.php?module=editvaliditassatker_utk_uo&id_validitas=$row[id_validitas]'>
			  <img src='images/edit.png' width='20' title='Edit'></a></td>	
		  </tr>";	
		  $nomor++;
     }
	}
	print"</table><br>";
	
	
