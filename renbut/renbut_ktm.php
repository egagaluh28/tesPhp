

<html>
<head>

<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />


<?php  error_reporting(0);
		 $satkr = mysql_query("select * from t_satkr   where kdkotama='$_GET[kdkotama]' and kdsatkr='$_GET[kdsatker]'");
		 $y   = mysql_fetch_array($satkr);
		
     
		 
	 
   
print "<br><table  width='1100' align='center' ><tr><td class='judulsubcontent' align='center'>RENCANA KEBUTUHAN GAJI DAN TUNJANGAN SERTA TUNJANGAN KINERJA TA $_GET[thang]</td></tr></table>";	


$query = "select a.kdsatkr as display, a.kdsatkr as kdsatker, '' as kdakun, a.nmsatkr as nmakun, b.jandes, b.gaji13, b.gaji14 from t_satkr a 
left join (select kdkotama, kdsatker, sum(jandes) as jandes, sum(gaji13) as gaji13, sum(gaji14) as gaji14 from renbut where kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' group by kdkotama, kdsatker, thang)  as b on a.kdsatkr=b.kdsatker
where a.kdkotama='$_SESSION[kdkotama]'
union
select concat(a.kdsatker,a.kdakun) as display, '' as kdsatker, a.kdakun, a.nmakun, b.jandes, b.gaji13, b.gaji14 from t_akun_gaji_satker a 
left join (select * from renbut where kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' ) as b on a.kdsatker=b.kdsatker and a.kdakun=b.kdakun where a.kdkotama='$_SESSION[kdkotama]'
order by display";
		$ok = mysql_query($query);
 
print "<div class='codehim-tombol-biru'><table width='85%' align='center'  ><tr>
	
				<td class='subyek1'>
				<form name='form1' method='GET'  action='renbut/kirimparameter_ktm.php' >
				<input type='hidden'  name='kdkotama'   class='roundedisi'  value='$_SESSION[kdkotama]' />";
			
				
	print "TAHUN : <select name='thang' class='sendiri'  onchange='this.form.submit();'>
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2024;$thn<=2030;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	
	
	print "</form>
				</td>
				<td align='right' valign='middle'>
				<form name='formX'  method='GET' action='cetak/cetak_renbutgaji_ktm.php' target='_blank'>
				
				<input type='hidden' name='kdkotama' value='$_SESSION[kdkotama]' />
				<input type='hidden' name='kdsatker' value='$_SESSION[kdsatker]' />
				<input type='hidden' name='thang' value='$_GET[thang]' />
				<div class='form-style-2'>LAMPIRAN : <input type='text'  name='lamp' class='input-field'  size='3' style='text-align: center;' />
				&nbsp;&nbsp;<input  type='submit' value='Cetak' /> &nbsp;&nbsp
				<a href='renbut/renbut_ktm_spr.php?kdkotama=$_SESSION[kdkotama]&thang=$_GET[thang]'><input  type='button' value='Export Excel' /></a></div></td>";
				print "</tr></table></div>";

	print "<table width='85%'  align='center' class='bordered'>";
	print "<tr >";
	print    "<th   align='center' rowspan='2' >NO</th>";
	print    "<th   align='center' rowspan='2' width='30'>KODE<br>SATKER</th>";
	print    "<th   align='center' rowspan='2' width='30'>AKUN</th>";
	print    "<th   align='center' rowspan='2'>URAIAN</th>";
	print    "<th   align='center' colspan='3'>RENCANA KEBUTUHAN TA $_GET[thang]</th>";
	print    "<th   align='center' rowspan='2'>JUMLAH<br>(5+6+7)</th>";
	print    "<th   align='center' rowspan='2'>KET</th>";
	
  	print "</tr>";
	
	
	print "<tr >";
	print    "<th   align='center' >JAN SD DES</th>";
	print    "<th   align='center' >GAJI 13</th>";
	print    "<th   align='center' >GAJI 14</th>";
  	print "</tr>";
	
	
	
	print "<tr >";
	print    "<td   align='center' bgcolor='e8e8e8'>1</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>2</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>3</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>4</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>5</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>6</td>";
    print    "<td   align='center' bgcolor='e8e8e8'>7</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>8</td>";
	print    "<td   align='center' bgcolor='e8e8e8'>9</td>";
	

  	print "</tr>";
	
				$no=1;
				$tempNo = null;
				
				$romawi='A';
				$tempRomawi = null;
while($k = mysql_fetch_array($ok)){	

	$jandes	 = number_format($k[jandes],0,',','.');
	$g13  = number_format($k[gaji13],0,',','.');
	$g14  = number_format($k[gaji14],0,',','.');
	
	
	
	
	$jmlx = $k[jandes] + $k[gaji13] + $k[gaji14];
	$jml  = number_format($jmlx,0,',','.');
	/*
	$jtotx += $jmlx;
	$jtot  = number_format($jtotx,0,',','.');
	
	$jjandesx += $k[jandes];
	$jjandes	 = number_format($jjandesx,0,',','.');
	
	$jg13x += $k[gaji13];
	$jg13	 = number_format($jg13x,0,',','.');
	
	$jg14x += $k[gaji14];
	$jg14	 = number_format($jg14x,0,',','.'); */
	
	
		$str = $k['display'];
		$pj = strlen($str);
	
	if ($pj=='6') {	print"<tr bgcolor='#ffffcc'>"; } else { print "<tr>"; }
	
				
	if ($pj=='6') {	
		print "<td  valign='top' align='center'><b>$romawi</b></td>";
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj>'6') {	
		if($tempRomawi != $romawi)
		{
			$no='1';
			$tempRomawi = $romawi;
		}else{
		
		}	
		print "<td  valign='top' align='right'>$no.</td>";
		
		$tempNo = $no;
        $no++;		
	
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
	
		 if ($pj=='6') {	
	
		print "<td  valign='top' align='center'><b>$k[kdsatker]</b></td>";
		print "<td  valign='top' align='center'><b>$k[kdakun]</b></td>";
		print "<td  valign='top' ><b>$k[nmakun]</b></td>";
		print "<td  valign='top' align='right'><b>$jandes</b></td>";
		print "<td  valign='top' align='right'><b>$g13</b></td>";
		print "<td  valign='top' align='right'><b>$g14</b></td>";
		print "<td  valign='top' align='right'><b>$jml</b></td>";		
		print "<td  valign='top' align='right'></td>";	

		} else {
		print "<td  valign='top' align='center'>$k[kdsatker]</td>";
		print "<td  valign='top' align='center'>$k[kdakun]</td>";
		print "<td  valign='top' >$k[nmakun]</td>";
		print "<td  valign='top' align='right'>$jandes</td>";
		print "<td  valign='top' align='right'>$g13</td>";
		print "<td  valign='top' align='right'>$g14</td>";
		print "<td  valign='top' align='right'>$jml</td>";		
		print "<td  valign='top' align='right'>$k[ket]</td>";	
		}		
		
	//$no++;	
   }
   
	    $qry = mysql_query("select sum(jandes) as jandes, sum(gaji13) as gaji13, sum(gaji14) as gaji14 from renbut where kdkotama='$_SESSION[kdkotama]' and thang='$_GET[thang]' group by kdkotama");
		$x    = mysql_fetch_array($qry);
		 
		$jjandes	 = number_format($x[jandes],0,',','.');
		$jg13  = number_format($x[gaji13],0,',','.');
		$jg14  = number_format($x[gaji14],0,',','.');
		
		$jtotx = $x[jandes] + $x[gaji13] + $x[gaji14];
		$jtot  = number_format($jtotx,0,',','.'); 
		
   print"<tr>";
		print "<td  valign='top' align='right'></td>
			  
			   <td  valign='top' colspan='3'><b>Jumlah</b></td>
		       <td  valign='top' align='right'><b>$jjandes</b></td>";
		print "<td  valign='top' align='right'><b>$jg13</b></td>";
		print "<td  valign='top' align='center'><b>$jg14</b></td>";
		print "<td  valign='top' align='right'><b>$jtot</b></td>";	
		print "<td  valign='top' align='right'></td>";		
		
		print "</tr>";
	print "</table><br>"; 

?>

