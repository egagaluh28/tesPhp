<?php error_reporting(0) // tambahkan untuk menghilangkan notice... hehe ?>
<!doctype html>
<html>
    <head>
        <title>Paginasi - Harviacode.com</title>
        <link rel="stylesheet" href="bootstrap.min.css"/>
    </head>
    <body>
        <?php 
//        includekan fungsi paginasi
        include 'pagination1.php';
//        koneksi ke database
        $koneksi = mysql_connect('localhost', 'root', '');
        $db = mysql_select_db('dbajaxlib');
        
//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini
            $keyword=$_REQUEST['keyword'];
            $reload = "index.php?pagination=true&keyword=$keyword";
            $sql =  "SELECT * FROM d_tni WHERE nama LIKE '%$keyword%' OR nip LIKE '%$keyword%' ORDER BY nama";
            $result = mysql_query($sql);
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "index.php?pagination=true";
            $sql =  "SELECT * FROM d_tni ORDER BY nama";
            $result = mysql_query($sql);
        }
        
        //pagination config start
        $rpp = 10; // jumlah record per halaman
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysql_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
        //pagination config end
        ?>
        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-lg-8">
                    <!--muncul jika ada pencarian (tombol reset pencarian)-->
                    <?php
                    if($_REQUEST['keyword']<>""){
                    ?>
                        <a class="btn btn-default btn-outline" href="index.php"> Reset Pencarian</a>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-4 text-right">
                    <form method="POST" action="index.php">
                        <div class="form-group input-group">
                            <input type="text" name="keyword" class="form-control" 
							placeholder="Search..." value="<?php echo $_REQUEST['keyword']; ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Cari
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th align="center">NO</th>
                        <th>NIP</th>
                        <th>NAMA</th>
						<th>JABATAN</th>
						<th>ALAMAT</th>
						<th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
                    ?>
                    <tr>
						<td align="right"> <?php echo ++$no_urut;?></td>
						<td> <?php echo $data ['nip']; ?> </td>
						<td> <?php echo $data ['nama']; ?> </td>
						<td> <?php echo $data ['jabatan_struk']; ?> </td>
						<td> <?php echo $data ['alamat']; ?> </td>
                        <td width="120px" class="text-center"><a href="#"> Edit</a> | <a href="#">Delete</a></td>
                    </tr>
                    <?php
                        $i++; 
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
            <div><?php echo paginate_one($reload, $page, $tpages); ?></div>
        </div>
    </body>
</html>

<!--harviacode.com-->