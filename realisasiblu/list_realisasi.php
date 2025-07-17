
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>LIST REALISASI</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=list_realisasi_blu&thang=$_GET[thang]&pagination=true&keyword=$keyword";
            $result =  mysql_query("select z.* from(SELECT a.*, b.nmbulan, c.nmwasgiat from realisasi_blu a 
			left join t_bulan b on a.kdbulan=b.kdbulan  
			left join t_wasgiat c on a.kdwasgiat=c.kdwasgiat where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]') as z 
			WHERE z.kdgiat LIKE '%$keyword%' or z.kdakun LIKE '%$keyword%' or z.uraian LIKE '%$keyword%' or z.nmwasgiat LIKE '%$keyword%' ORDER BY z.kdgiat,z.kdoutput,z.kdakun, z.kdsakun,z.kdbulan");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=list_realisasi_blu&thang=$_GET[thang]&pagination=true";
            $result =  mysql_query("SELECT a.*, b.nmbulan, c.nmwasgiat from realisasi_blu a 
			left join t_bulan b on a.kdbulan=b.kdbulan  
			left join t_wasgiat c on a.kdwasgiat=c.kdwasgiat 
			where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' ORDER BY a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.kdbulan");
			
        }
        
        //pagination config start
        $rpp = 100; // jumlah record per halaman
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
	    
 
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=list_realisasi_blu&thang=$_GET[thang]"; ?>"
			style="text-decoration:none">
			<input type="button" value="&nbsp;Reset&nbsp;"/></a>
			</form>
			</div>
			</td>
	<tr>
</table>

			
			
            <table class="bordered" width="98%" align="center">
                <thead>
                    <tr>
                        <th   align='center' height='30' width='40' >NO</th>	
						<th   align='center' >WASGIAT</th>
						<th   align='center' >BULAN</th>
						<th   align='center' >THANG</th>
						<th   align='center' >KODE<br>GIAT</th>
						<th   align='center' >KODE<br>OUTPUT</th>
						<th   align='center' >KODE<br>AKUN</th>
						<th   align='center' >KODE<br>SUBAKUN</th>
						<th   align='center' >NO SP2D</th>
						<th   align='center' >TGL SP2D</th>	
						<th   align='center' >URAIAN KEGIATAN</th>
						<th   align='center' >REALISASI</th>
						<th   align='center' >HAPUS</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					if ($tcount<='0') {
					print "<tr><td colspan='15' align='center'><img src='images/kosong.gif'></td></tr>";
					} else {	
					
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
						
						$tglspp=tgl_indoangka($data[tglspp]);
						$tglsp2d=tgl_indoangka($data[tglsp2d]);
						$realisasi = number_format($data[realisasi],0,',','.');
						$spp = number_format($data[nilai_spp],0,',','.');
						$tglspm=tgl_indoangka($data[tglspm]);
						$spm = number_format($data[nilai_spm],0,',','.');
						$norut	 = number_format(++$no_urut,0,',','.');
 ?>             
					
              
					<tr>
                        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
						<td valign="top" align="center"><?php print $data['nmwasgiat']?></a> </td>
						<td valign="top"><?php print $data['nmbulan']?></a> </td>
							<td valign="top" align="center"><?php print $data['thang']?></td>
							<td valign="top" align="center"><?php print $data['kdgiat']?></td>
							<td valign="top" align="center"><?php print $data['kdoutput']?></td>
							<td valign="top" align="center"><?php print $data['kdakun']?></td>
							<td valign="top" align="center"><?php print $data['kdsakun']?></td>
							<td valign="top"><?php print $data['nosp2d']?></td>
							<td valign="top" align="center"><?php print $tglsp2d?></td>
							<td valign="top"><?php print $data['uraian']?></td>
							<td valign="top" align="right"><?php print $realisasi?></td>
							
						
							<td valign="top" align="center"><?php print "<a href=\"realisasiblu/proses.php?aksi=hapusrealisasi&id_realisasi=$data[id_realisasi]&thang=$_GET[thang]\" 
						 onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $data[uraian] ~? ')\" data-tooltip='Hapus Realisasi' data-position='top' class='top' ><img src='images/delete.png' width='22' >"; ?></td>
			
	 
                    </tr>
                    <?php
                        $i++; 
                        $count++;
					}
					}
                    ?>
                </tbody>
            </table>
            <center><div>&nbsp;&nbsp;<?php echo paginate_one($reload, $page, $tpages); ?></div></center>
       
    </body>
</html>
