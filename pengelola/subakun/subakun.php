
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>TABEL SUB AKUN</span></center><br>
	
        <?php 
	

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=subakun&pagination=true&keyword=$keyword";
            $result =  mysql_query("select a.*, b.nmdipa, c.nmwasgiat from t_sakun a 
		left join t_dipa b on a.kddipa=b.kddipa 
		left join t_wasgiat c on a.kdwasgiat=c.kdwasgiat
			WHERE a.kdakun LIKE '%$keyword%' or a.nmsakun LIKE '%$keyword%' or b.nmdipa LIKE '%$keyword%'  or a.kdgiat LIKE '%$keyword%'  or a.kdsakun LIKE '%$keyword%' ORDER BY  kddipa, kdprogram, kdgiat, kdsakun, kdakun, kdsakun");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=subakun&pagination=true";
            $result =  mysql_query("select a.*, b.nmdipa, c.nmwasgiat from t_sakun a 
		left join t_dipa b on a.kddipa=b.kddipa 
		left join t_wasgiat c on a.kdwasgiat=c.kdwasgiat ORDER BY kddipa, kdprogram, kdgiat, kdoutput, kdakun, kdsakun");
			
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
	    
		<td align='left'><div class='codehim-tombol-biru' ><a href='media.php?module=inputsubakun' style="text-decoration:none"><input type="button" value="Tambah Sub Akun"  ></a>&nbsp;&nbsp;&nbsp;<a href='media.php?module=inputsubakun1' style="text-decoration:none"><input type="button" value="Tambah Sub Auto"</div></td>
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=subakun"; ?>"
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
						<th   align='center' width="70">KODE 	PROG</th>
						<th   align='center'  width="70">KODE 	GIAT</th>
						<th   align='center'  width="70">KODE 	KRO</th>
						<th   align='center'  width="70">KODE 	AKUN</th>
						<th   align='center'  width="70">KODE 	SUB AKUN</th>
						<th   align='center' >URAIAN</th>
						<th   align='center' width="110">DIPA</th>
						<th   align='center' width="120">WASGIAT</th>
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
						
					
						$norut	 = number_format(++$no_urut,0,',','.');
 ?>             
					
              
					<tr>
                        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
						<td valign="top" align="center"><?php print $data['kdprogram']?></a> </td>
						<td valign="top" align="center"><?php print $data['kdgiat']?></a> </td>
						<td valign="top" align="center"><?php print $data['kdoutput']?></a> </td>
						<td valign="top" align="center"><?php print $data['kdakun']?></a> </td>
						<td valign="top" align="center"><?php print $data['kdsakun']?></td>
						<td valign="top" ><?php print $data['nmsakun']?></td>
						<td valign="top" ><?php print $data['nmdipa']?></td>
						<td valign="top" ><?php print $data['nmwasgiat']?></td>
						<?php print "<td  align='center' valign='top'><a href='media.php?module=editsubakun&id=$data[id]' data-tooltip='Ubah Data' data-position='top' >
			  <img src='images/edit.png' width='20' ></a></td>
			  <td  align='center' valign='top'><a href=\"pengelola/sakun/proses.php?aksi=hapus&id=$data[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $data[kdsakun] ~? ')\" data-tooltip='Hapus Data' data-position='top'><img src='images/delete.png' width='20' ></td>";?>	
							
				
			
	 
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
