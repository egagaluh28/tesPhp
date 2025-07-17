<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<link href="tooltip/tooltip.css" rel="stylesheet" type="text/css" />
 <script src="tooltip/tooltip.js" type="text/javascript"></script>
 

<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>ABSENSI LAPLAKGAR KOTAMA TA <? print "2023"; ?></td></tr></table><br>	
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
	print "<table width='95%'  cellspacing='5' cellpadding='5' align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center'  width='5%'  rowspan='2'>NO</th>";	
	print    "<th   align='center'  rowspan='2'><span class='header' >KOTAMA</th>";
	print    "<th   align='center'  rowspan='2'><span class='header' >TAHUN</th>";
	print    "<th   align='center'  rowspan='2'><span class='header' >KET</th>";
	print    "<th   align='center'  colspan='12'><span class='header' >BULAN</th>";	
	if ($_SESSION['kdtingkat']=='03') {
	print    "<th   align='center'  rowspan='2'><span class='header' >EDIT</th>";
	} else {
	print "";	
	}
  	print "</tr>";
	
	print "<tr>";
	print    "<th   align='center'  width='5%' >JAN</th>";	
	print    "<th   align='center'  width='5%' >PEB</th>";	
	print    "<th   align='center'  width='5%' >MAR</th>";	
	print    "<th   align='center'  width='5%' >APR</th>";	
	print    "<th   align='center'  width='5%' >MEI</th>";	
	print    "<th   align='center'  width='5%' >JUN</th>";	
	print    "<th   align='center'  width='5%' >JUL</th>";	
	print    "<th   align='center'  width='5%' >AGU</th>";	
	print    "<th   align='center'  width='5%' >SEP</th>";	
	print    "<th   align='center'  width='5%' >OKT</th>";	
	print    "<th   align='center'  width='5%' >NOP</th>";	
	print    "<th   align='center'  width='5%' >DES</th>";	
	print "</tr>";
	   

	
	
	$sql="SELECT  a.nmkotama, b.* from t_kotam a left join validitasktm b on a.kdkotama=b.kdkotama
	where  a.kdkotama<>'00'  order by a.kdkotama";
    $qry=mysql_query($sql);
	
	

	$nomor=1;
	while ($row=mysql_fetch_array($qry)) {
	

	print"<tr><td  align='center'>$nomor</td>
			  <td >$row[nmkotama]</td>
			  <td >2023</td>
			  <td >RESTORE</td>";
			  if ($row[b01]=='x') {
			  print "<td  align='center' align='center'>
			  <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back01&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb01],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			 
			  
			  if ($row[b02]=='x') {
			  print "<td  align='center' align='center'>
			  <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back02&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb02],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b03]=='x') {
			  print "<td  align='center' align='center'>
			  <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back03&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb03],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b04]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back04&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb04],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b05]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back05&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb05],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b06]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back06&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb06],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b07]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back07&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb07],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b08]=='x') {
			  print "<td  align='center' align='center'>
			  <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back08&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb08],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b09]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back09&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb09],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b10]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back10&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb10],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b11]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back11&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb11],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[b12]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=back12&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[tb12],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }			
			
			if ($_SESSION['kdtingkat']=='03') {
			 print "<td  align='center' valign='top'><a href='media.php?module=editvaliditasktm_utk_uo&id_validitas=$row[id_validitas]'>
			  <img src='images/edit.png' width='20' title='Edit'></a></td>";	
			} else {
			print "";	
			}
		  print "</tr>";	
		  
		  print"<tr><td  align='center'></td>
			  <td ></td>
			  <td ></td>
			  <td >EMAIL</td>";
			  if ($row[e01]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email01&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te01],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e02]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email02&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te02],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e03]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email03&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te03],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e04]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email04&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te04],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e05]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email05&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te05],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e06]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email06&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te06],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e07]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email07&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te07],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e08]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email08&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te08],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e09]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email09&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te09],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e10]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email10&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te10],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e11]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email11&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te11],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			  
			  if ($row[e12]=='x') {
			  print "<td  align='center' align='center'>
		      <a href='#' onmouseover=tooltip.ajax(this,'info/waktu.php?pilih=email12&kdkotama=$row[kdkotama]&thang=$row[thang]') onmouseleave='tooltip.hide()'>";
			        if (substr($row[te12],8,2)<'11') {
						  print "<img src='images/cekijo.png' width='22'></td>";
					} else {  print "<img src='images/cekmerah.png' width='22'></td>"; 	}
			  } else { print "<td></td>"; }
			 
			 if ($_SESSION['kdtingkat']=='03') {
			 print "<td  align='center' valign='top'></td>";	
			 } else {
			 print "";	 
			 }
		  print "</tr>";	
		  $nomor++;
     }
	
	print"</table><br>";
	
	
