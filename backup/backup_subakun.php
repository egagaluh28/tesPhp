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
  font-family: 'BebasNeueRegular', 'Arial Narrow', Arial, sans-serif;
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

<br><center><span class='judulcontent'>BACKUP SUB AKUN </span></center><br>
<form action="" method="post" name="postform">
	<div align="center">
	 
	 
	  <input class="button-3d" type="submit" name="backup"  onClick="return confirm('Apakah Anda yakin?')" value="Proses Backup" />
	  
  </div>
</form>
</p>
<?php
if(isset($_POST['backup'])){
	
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.	
	
	$file='subakun'.'_'.date("dmy").'_'.date('His').'.sql';

	
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables("localhost","root","","dblaplakgar2024",$file);

	//session_start();
	?>
	
	<p align="center"><img src="images/berhasil.gif" ></a></p>
    <p align="center"><a style="cursor:pointer" onclick="location.href='backup/download_backup_data1.php?nama_file=<?php echo $file;?>'" title="Download"><div class='hovergallery'><center></center></div></a>
	<?php
}else{
	unset($_POST['backup']);
}


function backup_tables($host,$user,$pass,$name,$nama_file,$tables = 't_sakun, t_akun, t_output')

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
	
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//looping dulu ah
	foreach($tables as $table)
	{
		session_start();
	
		$result = mysql_query('SELECT * FROM '.$table.'');
		$num_fields = mysql_num_fields($result);
		//menyisipkan query drop table untuk nanti hapus table yang lama
		$return.= 'DELETE FROM '.$table.';'; 
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

</body>
</html>

