<?php error_reporting(0) // tambahkan untuk menghilangkan notice... hehe ?>
<!doctype html>
<html>
    <head>
        <title>Paginasi - Harviacode.com</title>
        <link rel="stylesheet" href="pagingcari/bootstrap.min.css"/>
    </head>
    <body>
        <?php 
//        includekan fungsi paginasi
        include 'pagingcari/pagination1.php';
//        koneksi ke database
  //  $login = mysql_query($connect, "SELECT * FROM userppp WHERE usernameppp = '$username' AND passwordppp='$pass'");
        
//        mengatur variabel reload dan sql
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
//        jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
//        pakai ini
            $keyword=$_REQUEST['keyword'];
            $reload = "media.php?module=rohaniwan&pagination=true&keyword=$keyword";
            $result =  mysql_query($connect, "SELECT * FROM dai WHERE nama LIKE '%$keyword%' ORDER BY nama");
        }else{
//            jika tidak ada pencarian pakai ini
            $reload = "media.php?module=rohaniwan&pagination=true";
                       $result =  mysql_query($connect, "SELECT * FROM dai ORDER BY nama");
        }
        
        //pagination config start
        $rpp = 10; // jumlah record per halaman
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysqli_num_rows($result);
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
                        <a class="btn btn-default btn-outline" href="media.php?module=rohaniwan"> Reset Pencarian</a>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-4 text-right">
                    <form method="post" action="">
                        <div class="form-group input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search..." value="<?php echo $_REQUEST['keyword']; ?>">
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
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysqli_data_seek($result,$i);
                        $data = mysqli_fetch_array($result);
                    ?>
                    <tr>
                        <td width="80px">
                            <?php echo ++$no_urut;?> 
                        </td>

                        <td>
                            <?php echo $data ['nama']; ?> 
                        </td>
                        <td width="120px" class="text-center">
                            <a href="#"> Edit</a> |
                            <a href="#">Delete</a>
                        </td>
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