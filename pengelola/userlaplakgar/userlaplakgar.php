
<html>
    <head>
        <title>DAI</title>
        <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_pencarian1.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="library/style_paging.css" type="text/css" media="screen" />
		
		
    </head>
    <body>
	
	
	
	<br><center><span class='judulcontent'>DATA USER</span></center><br>
	
        <?php 
		include "library/indotgl_angka.php";

//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';

//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini

            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=user&pagination=true&keyword=$keyword";
            $result =  mysql_query("select  a.*, b.nmkotama, c.nmsatkr, d.pengguna, d.kdwasgiat from user a
							  left join t_kotam b on a.kdkotama=b.kdkotama
							  left join t_satkr  c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatkr  
							  left join t_tingkat d on a.kdtingkat=d.kdtingkat where usernamelaplakgar LIKE '%$keyword%' or nmkotama LIKE '%$keyword%' ORDER BY usernamelaplakgar");
			
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=user&pagination=true";
            $result =  mysql_query("select  a.*, b.nmkotama, c.nmsatkr, d.pengguna, d.kdwasgiat from user a
							  left join t_kotam b on a.kdkotama=b.kdkotama
							  left join t_satkr  c on a.kdkotama=c.kdkotama and a.kdsatker=c.kdsatkr  
							  left join t_tingkat d on a.kdtingkat=d.kdtingkat");
			
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
	   
		<td align='left'><div class='codehim-tombol-biru' ><a href='media.php?module=inputuser' style="text-decoration:none"><input type="button" value="Tambah User"  ></a></div></td>
		
 
		
		<td align="right">
			<div class='codehim-search-bar'>
			<form action="" target="_top" method="post">                          
			<input type='text' id="TypeNow" autocomplete="off" oninput="undisableBtn()" name="keyword" placeholder="Search here..." value="<?php echo $_REQUEST['keyword']; ?>">
			<input type="submit" value="Search" /> 
			<a href="<?php print "media.php?module=user"; ?>"
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
						<th   align='center' >TINGKAT</th>
						<th   align='center' >USERNAME</th>
						<th   align='center' >PASSWORD</th>
						<th   align='center' >KOTAMA</th>
						<th   align='center' >SATKER</th>
						<th   align='center' >NAMA LENGKAP</th>
						<th   align='center' >TELP/HP</th>
						<th   align='center' >TANGGAL</th>
						<th   align='center' >JAM</th>	
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
						$tanggal=tgl_indoangka($data[tanggal]);
						$norut	 = number_format(++$no_urut,0,',','.');
 ?>             
					
              
					<tr>
                        <td width="30px" align="right" valign="top"><?php echo $norut;?>.</td>
						
							  <?php print "<td valign='top'>$data[pengguna]</td>
							  <td valign='top'>$data[usernamelaplakgar]</td>
							  <td valign='top'>$data[passwordlaplakgar]</td>
							  <td valign='top'>$data[nmkotama]</td>
							  <td valign='top'>$data[nmsatkr]</td>
							  <td valign='top'>$data[nama_lengkap]</td>
							  <td valign='top'>$data[telp]</td>
							  <td valign='top'>$tanggal</td>
							  <td valign='top'>$data[jam]</td>
							  <td  align='center' valign='top'><a href='media.php?module=edituser&id=$data[aidi_aidi_aidi]' data-tooltip='Edit User' data-position='top' class='top'>
							  <img src='images/edit.png' width='20' ></a></td>
							  <td  align='center' valign='top'><a href=\"pengelola/user/proses.php?aksi=hapus&aidi_aidi_aidi=$data[aidi_aidi_aidi]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $data[usernamelaplakgar] ~? ')\" data-tooltip='Hapus User' data-position='top' class='top'><img src='images/delete.png' width='20' ></td>	
			
	 
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
