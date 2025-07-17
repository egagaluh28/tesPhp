<html>
<head>
	<title>GABUNG DATA</title>
	
<style>

.hovergallery img{
-webkit-transform:scale(1.0); /*Webkit: Scale down image to 0.8x original size*/
-moz-transform:scale(1.0); /*Mozilla scale version*/
-o-transform:scale(1.0); /*Opera scale version*/
-webkit-transition-duration: 0.5s; /*Webkit: Animation duration*/
-moz-transition-duration: 0.5s; /*Mozilla duration version*/
-o-transition-duration: 0.5s; /*Opera duration version*/
opacity: 0.9; /*initial opacity of images*/
margin: 0 10px 5px 0; /*margin between images*/
cursor:pointer;
}

.hovergallery img:hover{
-webkit-transform:scale(1.1); /*Webkit: Scale up image to 1.2x original size*/
-moz-transform:scale(1.1); /*Mozilla scale version*/
-o-transform:scale(1.1); /*Opera scale version*/

opacity: 1;
cursor:pointer; 

</style>	
</head>
<body>

<br><center><span class='judulcontent'>BUAT ADK SATKER </span></center><br>
<form action="" method="post" name="postform">
	<div align="center">
	 <?
	 print "<span class='subyek1'>BULAN : </span> 
	      <select name='kdbulan'  class='rounded' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	print "<span class='subyek1'>TAHUN : </span><select name='thang' class='rounded'  required='required'>
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2018;$thn<=2030;$thn++){
									  if ($thn==$_POST[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>"; ?>&nbsp;&nbsp;&nbsp;
	  <input type="submit" name="backup"  onClick="return confirm('Apakah Anda yakin?')" value="Proses ADK" class="button blue"/>
	  
  </div>
</form>
</p>
<?php
if(isset($_POST['backup'])){
		$nama1="$_SESSION[kdkotama]";
		$nama2="$_SESSION[kdsatker]";
		$bl="$_POST[kdbulan]";
		$th="$_POST[thang]";
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.	
	//membuat nama file
	$file='ADK'.'_'.$bl.'_'.$th.'_'.date("dmY").'_'.date('His').'_'.$nama1.'_'.$nama2.'.sql';
//	$file=date("dmY").'_'.'watzah'.'_'.time().'.sql';
	
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables("localhost","root","","dblaplakgar2021",$file);
	//session_start();
	?>
	
	<p align="center"><img src="images/adkberhasil.gif" height="200"></a></p>
    <p align="center"><a style="cursor:pointer" onclick="location.href='backup/download_backup_data.php?nama_file=<?php echo $file;?>'" title="Download"><div class='hovergallery'><center><img src="images/donlod.png" width="200"></center></div></a>
	<?php
}else{
	unset($_POST['backup']);
}

/*
untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
*/
//function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*')


function backup_tables($host,$user,$pass,$name,$nama_file,$tables = 'realisasi,p3,npb,spp,tunkin')

{
	//untuk koneksi database
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	

	if($tables == '*')
	{
	
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}else{
		//jika hanya table-table tertentu
		//session_start();
		$nama1="$_SESSION[kdkotama]";
		$nama2="$_SESSION[kdsatker]";
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//looping dulu ah
	foreach($tables as $table)
	{
		session_start();
		$nama1="$_SESSION[kdkotama]";
		$nama2="$_SESSION[kdsatker]";
		$bl="$_POST[kdbulan]";
		$th="$_POST[thang]";
	//	$result = mysql_query('SELECT * FROM '.$table);
	//  $result = mysql_query('SELECT * FROM '.$table.' where kdkotama='.$nama1.' and kdsatker='.$nama2.'');
		$result = mysql_query('SELECT * FROM '.$table.' where kdkotama='.$nama1.' and kdsatker='.$nama2.' and kdbulan='.$bl.' 
		and thang='.$th.'');
		$num_fields = mysql_num_fields($result);
		//menyisipkan query drop table untuk nanti hapus table yang lama
		//$return.= 'DELETE TABLE '.$table.' where kdkotama='.$nama1.';';
		//$return.= 'DELETE TABLE '.$table.';';
		
		//$return.= "\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					//akan menelusuri setiap baris query didalam
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//simpan file di folder yang anda tentukan sendiri. kalo saya sech folder "DATA"
	$nama_file;
	
	$handle = fopen('adk/'.$nama_file,'w+');
	fwrite($handle,$return);
	fclose($handle);
}
	

?>

</body>
</html>

