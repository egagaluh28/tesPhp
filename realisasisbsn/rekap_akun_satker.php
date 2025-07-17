
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
	
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>REKAP PER SBSN</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=rekap_akun_sbsn_satker&thang=$_GET[thang]&pagination=true&keyword=$keyword";
            $result =  mysql_query("select z.* from(SELECT  a.kdkotama, a.kdsatker, a.thang, a.kdakun, a.nmakun,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini
FROM sbsn a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as blnlalu from realisasi_sbsn where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by  kdakun) as c on   a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as  blnini from realisasi_sbsn where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by  kdakun) as d on   a.kdakun=d.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by  a.kdakun) as z 
			WHERE z.kdakun LIKE '%$keyword%' or z.nmakun LIKE '%$keyword%' ORDER BY z.kdakun");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=rekap_akun_sbsn_satker&thang=$_GET[thang]&pagination=true";
            $result =  mysql_query("SELECT  a.kdkotama, a.kdsatker, a.thang, a.kdakun, a.nmakun,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, sum(a.pagurevisi) as pagurevisi,    c.blnlalu, d.blnini
FROM sbsn a 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as blnlalu from realisasi_sbsn where kdbulan<'$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by  kdakun) as c on   a.kdakun=c.kdakun 
left join (select kdgiat, kdoutput, kdakun,  kdkotama, kdsatker, thang, sum(realisasi) as  blnini from realisasi_sbsn where kdbulan='$_GET[kdbulan]' and kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by  kdakun) as d on   a.kdakun=d.kdakun 
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by  a.kdakun order by a.kdakun");
			
        }
        
        //pagination config start
        $rpp = 200; // jumlah record per halaman
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
	    
		 <form name='form1' method='GET'  action='realisasisbsn/kirimparameter_rekapakun.php' >
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
	print "&nbsp;&nbsp;<a href='cetak/cetak_rekapakun_sbsn_satker.php?kdbulan=$_GET[kdbulan]&thang=$_GET[thang]&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]' target='_blank' style='text-decoration:none'><input  type='button' value='Cetak' class='button2'/></a>";
	?> 
										
	
		</td>
		</form>
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=rekap_akun_sbsn_satker&thang=$_GET[thang]&kdbulan=$_GET[kdbulan]"; ?>"
			style="text-decoration:none">
			<input type="button" value="&nbsp;Reset&nbsp;"/></a>
			</form>
			</div>
			</td>
	<tr>
</table>

			
			
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
	
	$jpagux 	+= $data[pagu];  		$jpagu	 = number_format($jpagux,0,',','.');
	$jrevisix 	+= $data[revisi];  		$jrevisi = number_format($jrevisix,0,',','.');
	$jhasilx	+= $data[pagurevisi];	$jhasil	 = number_format($jhasilx,0,',','.');
	
	$jblnlalux 	+= $data[blnlalu];  $jblnlalu	 = number_format($jblnlalux,0,',','.');
	$jblninix 	+= $data[blnini];  	$jblnini	 = number_format($jblninix,0,',','.');
	$jhasil1x 	+= $blnsdi;  		$jhasil1	 = number_format($jhasil1x,0,',','.');
	
	$jsisax 	+= $turahan;  		$jsisa	 = number_format($jsisax,0,',','.');
 ?>             
					
              
					<tr>
                        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
						<td valign="top" align="center"><?php print $data['kdakun']?> </td>
						<td valign="top"><?php print $data['nmakun']?></a> </td>
							<td valign="top" align="right"><?php print $pagu?></td>
							<td valign="top" align="right"><?php print $revisi?></td>
							<td valign="top" align="right"><?php print $hasil?></td>
							<td valign="top" align="right"><?php print $blnlalu?></td>
							<td valign="top" align="right"><?php print $blnini?></td>
							<td valign="top" align="right"><?php print $hasil1?></td>
							<td valign="top" align="right"><?php print $sisa?></td>
                    </tr>
                    <?php
                        $i++; 
                        $count++;
					}
					}
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
