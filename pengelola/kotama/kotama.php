
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>DATA KOTAMA/BALAKPUS</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=kotama&pagination=true&keyword=$keyword";
            $result =  mysql_query("select  a.*, b.nmkukotama from t_kotam a
							  left join t_kukotama b on a.kdkukotama=b.kdkukotama 
			WHERE a.nmkotama LIKE '%$keyword%' or b.nmkukotama LIKE '%$keyword%' order by a.kdkotama");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=kotama&pagination=true";
            $result =  mysql_query("select  a.*, b.nmkukotama from t_kotam a
							  left join t_kukotama b on a.kdkukotama=b.kdkukotama order by a.kdkotama");
			
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

<table  width='75%' align='center'>
    <tr>
	   
		<td align='left'><div class='codehim-tombol-biru' ><a href='media.php?module=inputkotama' style="text-decoration:none"><input type="button" value="Tambah Data"  ></a></div></td>
		
 
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=kotama"; ?>"
			style="text-decoration:none">
			<input type="button" value="&nbsp;Reset&nbsp;"/></a>
			</form>
			</div>
			</td>
	<tr>
</table>

			
			
            <table class="bordered" width="75%" align="center">
                <thead>
                    <tr>
                      <th   align='center' height='25' width='5%' > NO</th>
					  <th   align='center'>KODE DEPT</th>
					  <th   align='center'>KODE UNIT</th>
					  <th   align='center'>KODE KOTAMA</th>
					  <th   align='center'>NAMA KOTAMA</th>	
					  <th   align='center'> KUKOTAMA</th>	
					  <th   colspan='2' align='center' valign='middle'>AKSI</th>
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
						$tanggal=tgl_indoangka($data[tanggal]);
						$norut	 = number_format(++$no_urut,0,',','.');
 ?>             
					
              
					<tr>
                        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
						
							  <?php 
							print "<td align='center'>$data[kddept]</td>";
							print "<td align='center'>$data[kdunit]</td>";
							print "<td align='center'>$data[kdkotama]</td>";
							print "<td >$data[nmkotama]</td>";
							print "<td >$data[nmkukotama]</td>";
							print "<td  align='center'><a href='media.php?module=editkotama&id=$data[id]' data-tooltip='Ubah Data' data-position='top'><img src='images/edit.png' width='20' ></a></td>";
							print"<td  align='center' valign='top'><a href=\"pengelola/kotama/proses.php?aksi=hapus&id=$data[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS KOTAMA ~ $data[nmkotama] ~? ')\" data-tooltip='Hapus Data' data-position='top'><img src='images/delete.png' width='20' ></td>"; 
			
	 
                    print "</tr>"; 
                   
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
