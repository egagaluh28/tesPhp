
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>PEMBUATAN SURAT PENGANTAR</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=surat_satker&pagination=true&keyword=$keyword";
            $result =  mysql_query("select z.* from(select  a.*, b.nmbulan from surat a
							  left join t_bulan b on a.kdbulan=b.kdbulan
							  where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]') as z 
			WHERE z.nmbulan LIKE '%$keyword%' or z.nomor LIKE '%$keyword%' ORDER BY z.nmbulan, z.thang");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=surat_satker&pagination=true";
            $result =  mysql_query("select  a.*, b.nmbulan from surat a
							  left join t_bulan b on a.kdbulan=b.kdbulan
							  where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' order by kdbulan, thang");
			
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
	    <td><a href='media.php?module=inputsurat' style='text-decoration:none'><div class='codehim-tombol-biru'><input  type='button' value='Tambah Surat' /></div></a>
		</td>
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=surat_satker"; ?>"
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
						<th   align='center' >NO SURAT</th>
						<th   align='center' >TEMPAT/TGL SURAT</th>
						<th   align='center' >KLASIFIKASI</th>
						<th   align='center' >LAMPIRAN</th>
						<th   align='center' >PERIHAL</th>
						<th   align='center' >PJG<br>GRS</th>	
						<th   align='center' >TUJUAN SURAT</th>
						<th   align='center' >KOTA</th>
						<th   align='center' >UP</th>
						<th   align='center' colspan="2">AKSI</th>
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
						
						$tglsurat=tgl_indoangka($data[tglsurat]);
						$norut	 = number_format(++$no_urut,0,',','.');
 ?>             
					
              
					<tr>
					<?php 
                        print "<td  align='right' valign='top'>$norut</td>
			
			  <td valign='top'>$data[nmbulan]</td>
			  <td valign='top'>$data[thang]</td>
			  <td valign='top'><a href='media.php?module=detailsurat&idsurat=$data[idsurat]' data-tooltip='Detail Surat' data-position='top' class='top' style='text-decoration:none'>$data[nomor]</a></td>
			   <td valign='top'>$data[tempat_tanggal]</td>
			  <td valign='top'>$data[klasifikasi]</td>
			 
			  <td valign='top'>$data[lampiran]</td>
			  <td valign='top'>$data[perihal]</td>
			  <td valign='top'>$data[garis]</td>
			  <td valign='top'>$data[tujuan_surat]</td>
			  <td valign='top'>$data[kota_penerima]</td>
			  <td valign='top'>$data[up]</td>
			  <td  align='center' valign='top'><a href='media.php?module=editsurat&idsurat=$data[idsurat]' data-tooltip='Edit Surat' data-position='top' class='top'>
			  <img src='images/edit.png' width='20' ></a></td>
			  <td  align='center' valign='top'><a href=\"pengelola/surat/proses.php?aksi=hapus&idsurat=$data[idsurat]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS SURAT ~ $data[nomor] ~? ')\" data-tooltip='Hapus Surat' data-position='top' class='top'><img src='images/delete.png' width='20' ></td>			  
		
                    </tr>";
                   
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
