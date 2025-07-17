<html>
<head>
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

<body>
<br><center><span class='judul'>RESTORE DATA SATKER</span></center><br>

<center><div id="border__">
<img src="images/restore.png" width="220"><br>
<form enctype="multipart/form-data" action="media.php?module=restore_satker" method="post">
	
	
	<table align="center">
	<tr><td class="bbb">File Backup  (*.sql) : <input type="file" name="datafile" size="30" id="gambar" class="sendiri"/></td></tr>
	<tr><td><input type="submit" onclick="return confirm('Apakah Anda yakin akan restore database?')" name="restore" value="Restore Data" class="button-3d" /></td>
	</tr>
	</table>
</form>
</div></center>


<?php
if(isset($_POST['restore'])){
		
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
			echo "<br><center><img src='images/restoreberhasil.gif' height='250'></center>";
		
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}	
	}

}else{
	unset($_POST['restore']);
}
?>

</body><br>
</head>

	