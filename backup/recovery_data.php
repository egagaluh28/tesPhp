<html>
<head>

</title>
</title>
<body>
<style>
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



</style>	
</style>

<br><center><span class='judulcontent'>RESTORE DATA </span></center><br>

<!--<form enctype="multipart/form-data" action="backuprestore3/recovery_data.php" method="post">-->
<form enctype="multipart/form-data" action="media.php?module=restore" method="post">
	<table align="center">
	<tr><td class="subyek1">CARI LOKASI FILE : <input type="file" name="datafile" size="30" id="gambar" class="rounded"/></td></tr><br>
	<tr><td><br><input type="submit" onclick="return confirm('Apakah Anda yakin akan Gabung Data?')" name="restore"  align="center" value="Gabung Data" class="button blue"/></td>
	</tr>
	</table>
</form>


<?php
if(isset($_POST['restore'])){
	$koneksi=mysql_connect("localhost","root","");
	mysql_select_db("agendasrenad",$koneksi);
	
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($nama_file=="")
	{
		echo "Fatal Error";
	}else{
		//definisikan variabel file dan alamat file
		$uploaddir='restore/';
		$alamatfile=$uploaddir.$nama_file;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			
			$filename = 'restore/'.$nama_file.'';
			
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					//mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					mysql_query($templine)or print('  ');
					// Reset temp variable to empty
					$templine = '';
				}
			}
			echo "<center>Berhasil Restore Database, silahkan di cek.</center>";
		
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}	
	}

}else{
	unset($_POST['restore']);
}
?>

</body>
</head>

	