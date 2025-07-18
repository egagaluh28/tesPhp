<!DOCTYPE html>
<html>
<head>
 <title>maribelajarcoding.com</title>
 <link href="select2.min.css" rel="stylesheet" />
 <script src="jquery-3.4.1.js" ></script>
 <script src="select2.min.js"></script> 
 

 
</head>
<body>
<?php
include "../../application/connect.php";

?>


<form method="POST" name="form1">
<?php  $jssArray = "var isi5 = new Array();\n"; ?>
 <select id="provinsi" name="nip" class="sendiri" onchange='changeValue5(this.value)'>
 <option></option>
   <?php 	 $sql=mysql_query($connect, "select * from hrm_t_gaji_rek order by kd_jab, kd_dep, norut");
			    while ($data=mysqli_fetch_array($sql)){
					$tunjab	 = number_format($data[tunjab],0,',','.');
					$gapok	 = number_format($data[gapok],0,',','.');
  			         if ($data['nip']==$_GET['nip']){
  			         print "<option value='$data[nip]' selected >$data[nama_lengkap]</option>";
  					    } 
			    else {echo "<option value=$data[nip]>$data[nama_lengkap]</option>";
    				    }
$jssArray .= "isi5['" . $data['nip'] . "'] ={name1:'" . addslashes($data['kd_jab']) . "',
										name2:'" . addslashes($data['kd_dep']) . "',
										name4:'" . addslashes($data['norek']) . "',
										name5:'" . addslashes($data['bank']) . "',
										name6:'" . addslashes($data['cabang']) . "',
										name7:'" . addslashes($data['tunjab']) . "',
										name8:'" . addslashes($tunjab) . "',
										name9:'" . addslashes($data['gapok']) . "',
										name10:'" . addslashes($gapok) . "',
										name3:'".addslashes($data['norut'])."'};\n"; 
						}
		        ?>
				
                </select>
				
				<input type="text" class="sendiri" name="kd_jab" id="kd_jab" size="3">
		        <input type="text" class="sendiri" name="kd_dep" id="kd_dep"  size="3">
				<input type="text" class="sendiri" name="norut"  id="norut"  size="3">
				
				<input type="text" class="sendiri" name="norek"  id="norek"  size="9">
				<input type="text" class="sendiri" name="bank"  id="bank"  size="5">
				<input type="text" class="sendiri" name="cabang"  id="cabang" size="5"> <br>
				
				<input type="text" class="sendiri" name="tunjab"  id="tunjab"  style='text-align: right;'>
		        <input type="text" class="sendiri" name="tunjab1"  id="tunjab1"  style='text-align: right;'>
				
				<input type="text" class="sendiri" name="gapok"  id="gapok"  style='text-align: right;'>
		        <input type="text" class="sendiri" name="gapok1"  id="gapok1"  style='text-align: right;'>
</form>
<script type="text/javascript">
 $(document).ready(function() {
     $('#provinsi').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true
     });
 });
 

  
    <?php print $jssArray; ?>  
    function changeValue5(id){ 
	
		if(id=='') {
		document.getElementById('kd_jab').value = '';  
		document.getElementById('kd_dep').value = '';	
		document.getElementById('norut').value = '';	
		document.getElementById('norek').value = '';  
		document.getElementById('bank').value = '';	
		document.getElementById('cabang').value = '';	
		document.getElementById('tunjab').value = '';	
		document.getElementById('tunjab1').value = '';
		document.getElementById('gapok').value = '';	
		document.getElementById('gapok1').value = '';
		}	
    document.getElementById('kd_jab').value = isi5[id].name1;  
	document.getElementById('kd_dep').value = isi5[id].name2; 
	document.getElementById('norut').value = isi5[id].name3;
	document.getElementById('norek').value = isi5[id].name4;  
	document.getElementById('bank').value = isi5[id].name5; 
	document.getElementById('cabang').value = isi5[id].name6;
	document.getElementById('tunjab').value = isi5[id].name7; 
	document.getElementById('tunjab1').value = isi5[id].name8;
	document.getElementById('gapok').value = isi5[id].name9; 
	document.getElementById('gapok1').value = isi5[id].name10;
    };  
	
	
    </script>
</body>
</html>