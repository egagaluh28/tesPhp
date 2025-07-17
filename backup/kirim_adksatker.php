<html>
<head>

<body>
<br><center><span class='judul'>KIRIM ADK KE KOTAMA</span></center>

<form enctype="multipart/form-data" action="media.php?module=kirim_adksatker" method="post">
	
	<br>
	<br>
	<table align="center">
	<tr><td class="subyek1">File Backup  (*.sql) <input type="file" name="datafile" size="30" id="gambar" class="roundedisi"/></td></tr>
	<tr><td><input type="submit" onclick="return confirm('Apakah Anda yakin akan restore database?')" name="restore" value="Gabung Data" class="button blue" /></td>
	</tr>
	</table>
</form>


<?php
if(isset($_POST['restore'])){
//	$koneksi=mysql_connect("localhost","root","");
//	mysql_select_db("dbwatzah",$koneksi);
	
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($nama_file=="")
	{
		echo "Belum ada file yang di pilih";
	}else{
		//definisikan variabel file dan alamat file
		$uploaddir='sampah/';
		$alamatfile=$uploaddir.$nama_file;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			
			$filename = 'sampah/'.$nama_file.'';
			
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
					mysql_query($templine) ;
					// Reset temp variable to empty
					$templine = '';
				}
			}
			echo "<center><img src='images/gabungberhasil.gif' height='250'></center>";
		
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

	