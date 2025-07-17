<?php error_reporting(0) // tambahkan untuk menghilangkan notice... hehe ?>
<!doctype html>
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/balon1.css" type="text/css" media="screen" />
		
		
		
    </head>
    <body>
	
        <?php 
		
			
//        includekan fungsi paginasi
        include '../pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=lampiran&pagination=true&keyword=$keyword";
            $result =  mysql_query("select z.* from (SELECT a.*, b.nmbulan FROM lamp_laplakgar a left join t_bulan b on a.kdbulan=b.kdbulan 
			where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]') as z
			WHERE z.nmbulan LIKE '%$keyword%' or z.thang LIKE '%$keyword%' ORDER BY z.kdbulan, z.thang");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=lampiran&pagination=true";
            $result =  mysql_query("SELECT a.*, b.nmbulan FROM lamp_laplakgar a left join t_bulan b on a.kdbulan=b.kdbulan 
			where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]'	order by a.kdbulan, a.thang");
			
        }
        
        //pagination config start
        $rpp = 50; // jumlah record per halaman
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysql_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
        //pagination config end
        ?>	
		<br>
<center><span class="judulcontent">LAMPIRAN SURAT</span></center>		

<table  width='99%' align='center'>
    <tr>
	   
        <td >
		<div class='codehim-tombol-biru'>
		<a href="<?php print "media.php?module=inputlampiran"; ?>"  style="text-decoration:none">
		&nbsp;<input type="button" value="Tambah Data" /></a>
		</div>
		</td>
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			
			<a href="<?php print "media.php?module=lampiran"; ?>" style="text-decoration:none">
			<input type="button" value="&nbsp;Reset&nbsp;"/></a>
			</form>
			</div>
			</td>
	<tr>
</table><br>

<table class="bordered" width="99%" align="center">
    <thead>
    <tr>
		<th align="center" height="30" width="5%" >NO</th>
		<th align="center" >BULAN</th>
		<th align="center" >TAHUN</th>
		<th align="center" >BARIS 1</th>
		<th align="center" >BARIS 2</th>
		<th align="center" >BARIS 3</th>
		<th align="center" >PJG GRS</th>
		<th align="center" >POSISI GRS</th>
		<th align="center" colspan="2" >AKSI</th>
    </tr>
    </thead>
    <tbody>
	<?php 
	if ($tcount<='0') {
	print "<tr><td colspan='13' align='center'><img src='images/kosong.gif'></td></tr>";
	} else {	
					
    while(($count<$rpp) && ($i<$tcount)) {
    mysql_data_seek($result,$i);
    $data = mysql_fetch_array($result);
						
						
	$norut	 = number_format(++$no_urut,0,',','.');
                    
		
	?>
					
    <tr>
        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
        <td  valign="top"><?php echo $data['nmbulan']; ?></td>
		<td  valign="top"><?php echo $data['thang']; ?></td>
		<td  valign="top"><?php echo $data['brs1']; ?></td>
		<td  valign="top"><?php echo $data['brs2']; ?></td>
		<td  valign="top"><?php echo $data['brs3']; ?></td>				
		<td  valign="top" align="center"><?php echo $data['panjang_grs']; ?></td>
		<td  valign="top" align="center"><?php echo $data['posisi_grs']; ?></td>		
						
        <td valign="top" align="center">
		<?php print "<a href='media.php?module=editlampiran&id=$data[id]' class='top'>"; ?>
		<span tooltip='Ubah Data'><img src="images/edit.png" width="22" ></span></a></td>
		<td valign="top" align="center"><?php print "<a href=\"pengelola/lampiran/proses.php?aksi=hapus&id=$data[id]\" 
     onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $data[nmtenant] ~? ')\" >
	 <span tooltip='Hapus Data'><img src='images/delete.png' width='22' ></span></a>"; ?></td>
	
	 
                    </tr>
                    <?php
                        $i++; 
                        $count++;
					}
					}
                    ?>
                </tbody>
            </table>
            <div><center><?php echo paginate_one($reload, $page, $tpages); ?></center></div>
       
    </body>
</html>
