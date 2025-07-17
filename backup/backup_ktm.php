<html>
<head>
	<title>GABUNG DATA</title>
	
<style>
.button-3d {
  position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #f39c12;
  background:#e67e22;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #d35400;
  -moz-box-shadow: 0px 6px 0px #d35400;
  box-shadow: 0px 6px 0px #d35400;
}

.button-3d:active{
    -webkit-box-shadow: 0px 2px 0px #d35400;
    -moz-box-shadow: 0px 2px 0px #d35400;
    box-shadow: 0px 2px 0px #d35400;
    position:relative;
    top:4px;
}

.button-3d:hover{
   position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #47ba0f;
  background:#5e8b0f;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #377b15;
  -moz-box-shadow: 0px 6px 0px #377b15;
  box-shadow: 0px 6px 0px #377b15;
}



#border__{
width:700px;
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333; 
padding: 10px;
font-size: 16px;
color:#666;
font-family: "Montserrat", sans-serif;

}

</style>	
</head>
<body>

<br><center><span class='judulcontent'>BACKUP DATA KOTAMA </span></center><br>
<center><div id="border__">
<center><br><img src="images/backupktm.png" width="170"></center><br>
<form action="" method="post" name="postform">
	<div align="center">
	 
	 
	  <input class="button-3d" type="submit" name="backup"  onClick="return confirm('Apakah Anda yakin?')" value="Proses Backup" />
	  
  </div>
</form></div>
</p>
<?php
if(isset($_POST['backup'])){
		$nama1="$_SESSION[kdkotama]";
		//$nama2="$_SESSION[kdsatker]";
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.	
	//membuat nama file
//	$file='Backup'.'_'.date("dmY").'_'.date('His').'_'.$nama1.'.sql';
	$file='Ktm'.'_'.date("dmy").'_'.date('His').'_'.$nama1.'.sql';
//	$file=date("dmY").'_'.'watzah'.'_'.time().'.sql';
	
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables("localhost","root","","dblaplakgar2024",$file);

	//session_start();
	?>
	
	<p align="center"><img src="images/berhasil.gif" ></a></p>
    <p align="center"><a style="cursor:pointer" onclick="location.href='backup/download_backup_data1.php?nama_file=<?php echo $file;?>'" title="Download"><div class='hovergallery'><center><span class="judulsubcontent">Hasil Backup Tersimpan di c:/xampp/htdocs/laplakgar2023/adk</span></center></div></a>
	<?php
}else{
	unset($_POST['backup']);
}

/*
untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
*/
//function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*')


function backup_tables($host,$user,$pass,$name,$nama_file,$tables = 'dipa,bpjs, yanmasum,blu, hibah, kapitasi, realisasi, realisasix, realisasi_bpjs, realisasi_yanmasum, realisasi_blu, realisasi_kapitasi,  realisasi_hibah, tunkin, pengembalian, kopstuk, tajuk_ttd, lamp_laplakgar,  surat, tembusan,  sbsn, realisasi_sbsn, renbut')




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
		//$nama2="$_SESSION[kdsatker]";
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//looping dulu ah
	foreach($tables as $table)
	{
		session_start();
		$nama1="$_SESSION[kdkotama]";
		$nama2="$_SESSION[kdsatker]";		
	//	$result = mysql_query('SELECT * FROM '.$table);
	//  $result = mysql_query('SELECT * FROM '.$table.' where kdkotama='.$nama1.' and kdsatker='.$nama2.'');
		$result = mysql_query('SELECT * FROM '.$table.' where kdkotama='.$nama1.'');
		$num_fields = mysql_num_fields($result);
		//menyisipkan query drop table untuk nanti hapus table yang lama
		$return.= 'DELETE FROM '.$table.' where kdkotama='.$nama1.';'; 
		//$return.= 'DELETE TABLE '.$table.';';
		$return.= "\n\n";
		
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

</body><br>
</html>

