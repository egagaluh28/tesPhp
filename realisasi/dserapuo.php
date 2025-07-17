<?php error_reporting(0); ?>

<link rel="stylesheet" href="l1br4ry/balon1.css" type="text/css" media="screen" />
<link rel="stylesheet" href="l1br4ry/style_table.css" type="text/css" media="screen" />
	 
<?php 
  $bln = mysql_query("select nmbulan from t_bulan where kdbulan='$_GET[kdbulan]'");
		 $x    = mysql_fetch_array($bln);
		 $nmbulan = strtoupper($x['nmbulan']);
?>		

<br><center><span class='judulcontent'>DAYA SERAP ANGGARAN S.D. <?php print $nmbulan;?> TAHUN <?php print $_GET['thang'];?></center></span><br>

<?php
print "<form name='form1' method='GET'  action='realisasi/kirimparameter_dayaserapuo.php' >";
	
	print "<div class='codehim-tombol-biru'><table width='98%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1'>BULAN : ";
	print "<select name='kdbulan'  class='sendiri' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_GET[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;";
	print "TAHUN : <select name='thang' class='sendiri'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;<input  type='submit' value='Proses' />";
//	print "&nbsp;<a href='c3t4k/cetakdserapuo.php?kdbulan=$_GET[kdbulan]&tahun=$_GET[thang]'><input  type='button' value='&nbsp;Cetak&nbsp;' /></a>";
	print "</td></form>"; 									
	
	print "<form name='form1' method='GET'  action='cetak/cetakdserapuo.php' target='_Blank'>"; 
	 print "<td class='subyek1' align='right'>";
	 print "<input type='hidden'  name='kdbulan'  readonly value='$_GET[kdbulan]'>"; 
	 print "<input type='hidden'  name='thang'  readonly value='$_GET[thang]'>"; 
	  print "<input type='hidden'  name='kdkotama'  readonly value='00'>"; 
	 print "<input type='hidden'  name='kdsatker'  readonly value='000000'>"; 
		
	print "LAMPIRAN : <input type='text' name='lamp'  size='3' class='sendiri' style='text-align:center;'/>";
	print "&nbsp;&nbsp;<input  type='submit' value='&nbsp;Cetak&nbsp;' />"; 									
	print "</td>";
	print "</form>"; 
	
	
	print "</tr></table></div><br>";
	
?>	



    <table align="center" width="99%" class="bordered">
        <tr>
				<th>NO</th>
				<th>SATUAN</th>
				<th>PAGU<br>ANGGARAN</th>
				<th>REVISI<br>+ / -</th>
				<th>PAGU<br>STLH REVISI</th>
				<th>BLN LALU</th>
				<th>BLN INI</th>
				<th>S.D. BLN INI</th>
				<th>SISA</th>
				<th>DAYA<br>SERAP</th>
				
      </tr>
	<?php
	   
	
	$query = mysql_query("select a.kdkotama as display,  a.nmkotama as uraian, b.pagu, b.revisi, b.pagurevisi, c.blnlalu, d.blnini from t_kotam a 
left join (select kdkotama, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where thang='$_GET[thang]' group by kdkotama, thang) as b on a.kdkotama=b.kdkotama
left join (select kdkotama, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and thang='$_GET[thang]' group by kdkotama, thang) as c on a.kdkotama=c.kdkotama
left join (select kdkotama, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]' group by kdkotama, thang) as d on a.kdkotama=d.kdkotama
union
select concat(a.kdkotama,a.kdsatkr) as display,  a.nmsatkr as uraian, b.pagu, b.revisi, b.pagurevisi,  c.blnlalu, d.blnini from t_satkr a 
left join (select kdsatker, sum(pagu) as pagu, sum(revisi) as revisi, sum(pagurevisi) as pagurevisi from dipa where thang='$_GET[thang]' group by kdsatker, thang) as b on a.kdsatkr=b.kdsatker
left join (select kdsatker, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' and thang='$_GET[thang]' group by kdsatker, thang) as c on a.kdsatkr=c.kdsatker
left join (select kdsatker, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' and thang='$_GET[thang]' group by kdsatker, thang) as d on a.kdsatkr=d.kdsatker
order by display");
	
	$no=1;
	$tempNo = null;
	
	
	$romawi=1;
    $tempRomawi = null;
	
	
	while($k = mysql_fetch_array($query)){	
	
	$uraian = strtoupper($k['uraian']);
	
	$pagu 			= number_format($k['pagu'],0,',','.');
	$revisi 		= number_format($k['revisi'],0,',','.');
	$pagurevisi		= number_format($k['pagurevisi'],0,',','.');
	$lalu			= number_format($k['blnlalu'],0,',','.');
	$ini			= number_format($k['blnini'],0,',','.');
	$blnsdi = $k['blnlalu'] + $k['blnini'];
	$sdi			= number_format($blnsdi,0,',','.');
	
	$turahan = $k['pagurevisi'] - $blnsdi;
	$sisa			= number_format($turahan,0,',','.');
	
	//-------------------------------------------
	if (($k['pagurevisi']=='') or ($k['pagurevisi']=='0')) {
	$prosen     = 0; 
    } else { 
	$prosen 	= (($blnsdi/$k['pagurevisi'])*100);
	}
	$prosen_des	= number_format($prosen,2,',','.');
	$prosen_des0= number_format($prosen,0,',','.');
	//--------------------------------------------------
	
	$str = $k['display'];
    $pj = strlen($str);
	
	if ($pj=='2') print"<tr bgcolor='#ffffcc'>"; else print"<tr>";
	
	if ($pj=='2') {	
		
		print "<td  valign='top' ><b>$romawi.</b></td>";
        
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj=='8') {	
		if($tempRomawi != $romawi)
		{
			$no='a';
			$tempRomawi = $romawi;
		}else{
		
		}	
		print "<td  valign='top' align='right'>$no.</td>";
		
		$tempNo = $no;
        $no++;		
		
	
	   
	} else {
	 print "<td  valign='top' align='right'></td>";
	}
	
	if ($pj<='2') {	
	
	
		print "<td  valign='top' ><b>$uraian</b></td>";
		print "<td  valign='top' align='right'><b>$pagu</b></td>";
		print "<td  valign='top' align='right'><b>$revisi</b></td>";
		print "<td  valign='top' align='right'><b>$pagurevisi</b></td>";
		print "<td  valign='top' align='right'><b>$lalu</b></td>";
		print "<td  valign='top' align='right'><b>$ini</b></td>";
		print "<td  valign='top' align='right'><b>$sdi</b></td>";
			print "<td  valign='top' align='right'><b>$sisa</b></td>";
		print "<td  valign='top' align='center'><b>$prosen_des</b></td>";
	
		
	} else {
		print "<td  valign='top' >$uraian</td>";
		
		
		print "<td  valign='top' align='right'>$pagu</td>";
		print "<td  valign='top' align='right'>$revisi</td>";
		print "<td  valign='top' align='right'>$pagurevisi</td>";
		print "<td  valign='top' align='right'>$lalu</td>";
		print "<td  valign='top' align='right'>$ini</td>";
		print "<td  valign='top' align='right'>$sdi</td>";
		print "<td  valign='top' align='right'>$sisa</td>";
		print "<td  valign='top' align='center'>$prosen_des</td>";
		
	
		print "</td>";
			
	}		
		
	
		?>
        
      </tr>
    <?php  } ?>
  
     
  </table>
<br>


			