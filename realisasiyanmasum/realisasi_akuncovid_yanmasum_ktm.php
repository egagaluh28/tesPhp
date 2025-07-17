
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
	
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>REALISASI AKUN COVID</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=realisasi_akuncovid_ktm&thang=$_GET[thang]&pagination=true&keyword=$keyword";
            $result =  mysql_query("select z.* from(SELECT  a.id_pagu, a.kdkotama,a.thang, a.kdakun, a.nmakun, a.nmitem, 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM yanmasum a 

left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as blnlalu from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as c on   a.id_pagu=c.id_pagu 

left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as  blnini from realisasi where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as d on   a.id_pagu=d.id_pagu 

where  a.kdkotama='$_SESSION[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.id_pagu) as z 
			WHERE z.kdakun LIKE '%$keyword%' or z.nmitem LIKE '%$keyword%' ORDER BY z.id_pagu");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=realisasi_akuncovid_ktm&thang=$_GET[thang]&pagination=true";
            $result =  mysql_query("SELECT  a.kdsatker as display,  '' as kdkotama, a.kdsatker, '' as thang, '' as kdakun, '' as nmakun, b.nmsatkr as nmitem, 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM yanmasum a 
left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr
left join (select  id_pagu, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as blnlalu from realisasi_yanmasum where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdsatker) as c on   a.kdsatker=c.kdsatker 
left join (select  id_pagu, kdakun,  kdkotama, kdsatker,  thang, sum(realisasi) as  blnini from realisasi_yanmasum where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdsatker) as d on   a.kdsatker=d.kdsatker 
where  a.kdkotama='$_SESSION[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.kdsatker

union
SELECT  concat(a.kdsatker,a.id_pagu) as display,  a.kdkotama, a.kdsatker, a.thang, a.kdakun, a.nmakun, a.nmitem, 
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM yanmasum a 
left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as blnlalu from realisasi_yanmasum where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as c on   a.id_pagu=c.id_pagu 
left join (select  id_pagu, kdakun,  kdkotama,  thang, sum(realisasi) as  blnini from realisasi_yanmasum where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by id_pagu) as d on   a.id_pagu=d.id_pagu 
where  a.kdkotama='$_SESSION[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.id_pagu
order by display");
			
        }
        
        //pagination config start
        $rpp = 2000; // jumlah record per halaman
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysql_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
        //pagination config end
        ?>			

<table  width='98%' align='center'>
    <tr>
	    
		 <form name='form1' method='GET'  action='realisasiyanmasum/kirimparameter_akuncovid_yanmasum_ktm.php' >
		<td class="subyek1">PILIH :
		<?php print "<select name='kdbulan'  class='sendiri' required>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_GET[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	print "<select name='thang' class='sendiri'  required >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2025;$thn++){
									  if ($thn==$_GET[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses' class='button2'/>";
	print "&nbsp;&nbsp;<a href='cetak/cetak_akuncovid_yanmasum_ktm.php?kdbulan=$_GET[kdbulan]&thang=$_GET[thang]&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak' class='button2'/></a>";
	?> 
										
	
		</td>
		</form>
	<!--	<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=realisasi_akuncovid_ktm&thang=$_GET[thang]&kdbulan=$_GET[kdbulan]"; ?>"
			style="text-decoration:none">
			<input type="button" value="&nbsp;Reset&nbsp;"/></a>
			</form>
			</div>
			</td> -->
	<tr>
</table><br>

			
			
            <table class="bordered" width="98%" align="center">
                <thead> <?php
                   print "<table width='98%'  align='center' class='bordered'>";
					print "<tr >";
					print    "<th   align='center' rowspan='2' >NO</th>";
					print    "<th   align='center' rowspan='2' >KODE</th>";
					print    "<th   align='center' rowspan='2' >URAIAN</th>";
					print    "<th   align='center' rowspan='2' >PAGU</th>";
					print    "<th   align='center' rowspan='2' >REVISI (+/-)</th>";
					print    "<th   align='center' rowspan='2' >PAGU STLH<br>REVISI</th>";
					print    "<th   align='center' valign='middle'  colspan='3'>REALISASI</th>";
					print    "<th   align='center' rowspan='2' >SISA</th>";
					print "</tr>";
					print "<tr>";
					print    "<th   align='center'   >S.D BLN LALU</th>";
					print    "<th   align='center'    >BLN INI</th>";
					print    "<th   align='center'   >S.D BLN INI</th>";
					print "</tr>"; ?>
                </thead>
                <tbody>
				<?php
				
				$no='a';
				$tempNo = null;
	
				$romawi='1';
				$tempRomawi = null;
	
					if ($tcount<='0') {
					print "<tr><td colspan='15' align='center'><img src='images/kosong.gif'></td></tr>";
					} else {	
					
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
						
	$pagu	 = number_format($data[pagu],0,',','.');
	$revisi	 = number_format($data[revisi],0,',','.');
	$stlhrevisi	 = $data[pagurevisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$blnlalu = number_format($data[blnlalu],0,',','.');
	$blnini	 = number_format($data[blnini],0,',','.');
	$blnsdi	 = $data[blnlalu] + $data[blnini];
	$hasil1  = number_format($blnsdi,0,',','.');
	
	$turahan = ($stlhrevisi - $blnsdi);
	$sisa  = number_format($turahan,0,',','.');
	$norut	 = number_format(++$no_urut,0,',','.');
	
	$str = $data[display];
    $pj = strlen($str);
	

	print"<tr>";
	if ($pj=='6') {	
		
		print "<td  valign='top' align='center'><b>$romawi.</b></td>";
        
		$tempRomawi = $romawi;
        $romawi++;			
	   
	
	} else if ($pj>'6')  {	
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
	
 ?>             
					
              
					
				<?php	if ($pj=='6') {	 ?>
						
						<td valign="top" align="center"><?php print $data['kdakun']?> </td>
						<td valign="top"><b><?php print $data['nmitem']?></b> </td>
						<td valign="top" align="right"><b><?php print $pagu?></b></td>
						<td valign="top" align="right"><b><?php print $revisi?></b></td>
						<td valign="top" align="right"><b><?php print $hasil?></b></td>
						<td valign="top" align="right"><b><?php print $blnlalu?></b></td>
						<td valign="top" align="right"><b><?php print $blnini?></b></td>
						<td valign="top" align="right"><b><?php print $hasil1?></b></td>
						<td valign="top" align="right"><b><?php print $sisa?></b></td>
						
				<?php	} else  {	 ?>	
				
						<td valign="top" align="center"><?php print $data['kdakun']?> </td>
						<td valign="top"><?php print $data['nmitem']?></a> </td>
						<td valign="top" align="right"><?php print $pagu?></td>
						<td valign="top" align="right"><?php print $revisi?></td>
						<td valign="top" align="right"><?php print $hasil?></td>
						<td valign="top" align="right"><?php print $blnlalu?></td>
						<td valign="top" align="right"><?php print $blnini?></td>
						<td valign="top" align="right"><?php print $hasil1?></td>
						<td valign="top" align="right"><?php print $sisa?></td>
				
				<?php	} ?>
                    </tr>
                    <?php
                        $i++; 
                        $count++;
					}
					}
					
					 $jml=mysql_query("SELECT  a.kdkotama, sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini FROM yanmasum a 

left join (select  kdkotama,  thang, sum(realisasi) as blnlalu from realisasi_yanmasum where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdkotama) as c on   a.kdkotama=c.kdkotama 
left join (select kdkotama,  thang, sum(realisasi) as  blnini from realisasi_yanmasum where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]'  and thang='$_GET[thang]' and kdakun='521131' group by kdkotama) as d on   a.kdkotama=d.kdkotama 
where  a.kdkotama='$_SESSION[kdkotama]' and a.thang='$_GET[thang]' and a.kdakun='521131'  group by a.kdkotama"); 
$x = mysql_fetch_array($jml);

	$jpagu	 = number_format($x[pagu],0,',','.');
	$jrevisi	 = number_format($x[revisi],0,',','.');
	$jstlhrevisi	 = $x[pagurevisi];
	$jhasil	 = number_format($jstlhrevisi,0,',','.');
	
	$jblnlalu = number_format($x[blnlalu],0,',','.');
	$jblnini	 = number_format($x[blnini],0,',','.');
	$jblnsdi	 = $x[blnlalu] + $x[blnini];
	$jhasil1  = number_format($jblnsdi,0,',','.');
	
	$jturahan = ($jstlhrevisi - $jblnsdi);
	$jsisa  = number_format($jturahan,0,',','.');
                    ?>
					<tr>
                        <td width="30px" align="right" valign="top"></td>
						<td valign="top" colspan='2'><b>JUMLAH</b></td>
							<td valign="top" align="right"><b><?php print $jpagu?></b></td>
							<td valign="top" align="right"><b><?php print $jrevisi?></b></td>
							<td valign="top" align="right"><b><?php print $jhasil?></b></td>
							<td valign="top" align="right"><b><?php print $jblnlalu?></b></td>
							<td valign="top" align="right"><b><?php print $jblnini?></b></td>
							<td valign="top" align="right"><b><?php print $jhasil1?></b></td>
							<td valign="top" align="right"><b><?php print $jsisa?></b></td>
                    </tr>
                </tbody>
            </table>
            <center><div>&nbsp;&nbsp;<?php echo paginate_one($reload, $page, $tpages); ?></div></center>
       
    </body>
</html>
