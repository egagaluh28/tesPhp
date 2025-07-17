

<link href="library/combocari/select2.min.css" rel="stylesheet" />
 <script src="library/combocari/jquery-3.4.1.js" ></script>
 <script src="library/combocari/select2.min.js"></script> 
 
 <script type="text/javascript" src="library/jquery.min.js"></script>
<script>


 $(document).ready(function() {
     $('#provinsi').select2({
      placeholder: 'PILIH AKUN',
      allowClear: true
     });
 });
 
 
//var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
	  
$("#kdprogram").change(function(){
    	var kdprogram = $("#kdprogram").val();
    	$.ajax({
			url: "pengelola/subakun/ambilgiat.php",
			data: "kdprogram="+kdprogram,
			cache: false,
			success: function(msg){
				$("#kdgiat").html(msg);
			}
		});
	  });
	  
	$("#kdgiat").change(function(){
		var kdgiat = $("#kdgiat").val();
		$.ajax({
			url: "pengelola/subakun/ambiloutput.php",
			data: "kdgiat="+kdgiat,
			cache: false,
			success: function(msg){
				$("#kdoutput").html(msg);				
			}
		});
	 });     
});  





</script>

<br>
<center><span class="judul">INPUT SUB AKUN</span></center><br>
<center><div id="borderku1">
<div class="form-style-2">

<?php

						 
						

print "<form action='pengelola/subakun/kirimparameter.php' method='GET'  name='form1'> "; 
   
   
print   "<table width='1200' align='center' cellpadding='3'>";

		  print  	"<tr>
				 <td class='subyek1' align='right'>PROGRAM : </td>
				 <td class='subyek1' width='5'></td>
				 <td><select name='kdprogram' id='kdprogram' class='select-field' >
						<option value='' selected> - - Pilih Giat - - </option>";
						 $sql="select * from t_program  order by kdprogram";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdprogram]=='$_GET[kdprogram]')
							echo "<option value=$data[kdprogram] selected>$data[kdprogram] | $data[nmprogram]</option>";
						 else
							echo "<option value=$data[kdprogram]>$data[kdprogram] | $data[nmprogram]</option>";
				    }  
		print "</select></td> 
			</tr>";					

			print  	"<tr>
				 <td class='subyek1' align='right'>KEGIATAN : </td>
				 <td class='subyek1'></td>
				 <td><select name='kdgiat' id='kdgiat' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdgiat, nmgiat from t_giat where  kdprogram='$_POST[kdprogram]' order by kdgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdgiat]==$row[kdgiat])
							echo "<option value=$data[kdgiat] selected>$data[kdgiat] | $data[nmgiat]</option>";
						 else
							echo "<option value=$data[kdgiat]>$data[kdgiat] | $data[nmgiat]</option>";
				    }  
				     
			print "</select></td>   
			</tr>";	

		 print  	"<tr>
				 <td class='subyek1' align='right'>OUTPUT : </td>
				 <td class='subyek1'></td>
				 <td><select name='kdoutput' id='kdoutput' class='select-field' >
						<option value='' selected> - - Pilih Output - - </option>";
						 $sql="select kdoutput, nmoutput from t_output where kdprogram='$_POST[kdprogram]' and kdgiat='$_POST[kdgiat]' order by kdoutput";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdoutput']."\">".$data['kdoutput']."|".$data['nmoutput']."</option>\n";
				    }  
			print "</select></td> 
			</tr>";	
			
			print  	"<tr>
				 <td class='subyek1' align='right'>KODE AKUN : </td>
				 <td class='subyek1'></td>
				 <td><select id='provinsi' name='kdakun'   class='select-field' >
						<option value='' selected> - - Pilih Akun - - </option>";
						 $sql="select kdakun, nmakun from t_akun  order by kdakun";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							 echo "<option value=\"".$data['kdakun']."\">".$data['kdakun']." | ".$data['nmakun']."</option>\n";
				    }  
			print "</select></td>				  
			</tr>";	
			
	
print "</table><br>";		
	 
	
print	"<table  width='300' align='center'   cellpadding='3'>";
print	"		<tr>
				 <center><div class='codehim-tombol-biru'><input  type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'   /></div></center
				     
			</tr></table>";
	
 print   "</form></div></div>";
 
//----------------------------------------------------------------------		


$sss=mysql_query("select max(kdsakun) + 1 as nomor from t_sakun where kdprogram='$_GET[kdprogram]' and kdgiat='$_GET[kdgiat]' and kdoutput='$_GET[kdoutput]' and kdakun='$_GET[kdakun]'");
 $row    = mysql_fetch_array($sss);
 
 if (($row['nomor']<'1') or ($row['nomor'] =='NULL'))  $nextno='001';
 else if ($row['nomor']<'10') $nextno='00'.$row['nomor'];
 else if ($row['nomor']<'100') $nextno='0'.$row['nomor'];
 else $nextno = $row['nomor'];
 
 
 $prog=mysql_query("select nmprogram  from t_program where kdprogram='$_GET[kdprogram]'");
 $x1    = mysql_fetch_array($prog);
 
 $giat=mysql_query("select nmgiat  from t_giat where kdgiat='$_GET[kdgiat]'");
 $x2    = mysql_fetch_array($giat);
 
 $output=mysql_query("select nmoutput  from t_output where kdoutput='$_GET[kdoutput]'");
 $x3    = mysql_fetch_array($output);
 
 $akun=mysql_query("select nmakun  from t_akun where kdakun='$_GET[kdakun]'");
 $x4    = mysql_fetch_array($akun);
 

print "<br><br><center><div id='borderku1'><br><form action='pengelola/subakun/proses.php?aksi=simpan' method='POST'  name='form1'> "; 
   
   
print   "<table width='1200' align='center' cellpadding='3'>";

		  print  	"<tr>
				 <td class='subyek1' align='right'>PROGRAM : </td>
				 <td><input name='kdprogram'  type='text' value='$_GET[kdprogram]' class='sendiri' size='3'> <input name='x'  type='text' value='$x1[nmprogram]' class='sendiri' size='50'></td> 
			</tr>";					

			print  	"<tr>
				 <td class='subyek1' align='right'>KEGIATAN : </td>
				 <td><input name='kdgiat'  type='text' value='$_GET[kdgiat]' class='sendiri' size='3'>  <input name='x'  type='text' value='$x2[nmgiat]' class='sendiri' size='50'></td>   
			</tr>";	

		 print  	"<tr>
				 <td class='subyek1' align='right'>OUTPUT : </td>
				 <td><input name='kdoutput'  type='text' value='$_GET[kdoutput]' class='sendiri' size='3'>  <input name='x'  type='text' value='$x3[nmoutput]' class='sendiri' size='50'></td> 
			</tr>";	
			
			print  	"<tr>
				 <td class='subyek1' align='right'>KODE AKUN : </td>	
				<td><input name='kdakun'  type='text' value='$_GET[kdakun]' class='sendiri' size='3'>  <input name='x'  type='text' value='$x4[nmakun]' class='sendiri' size='50'></td>				 
			</tr>";	
			
			
			print "<tr>
					<td class='subyek1' align='right'>KODE SUB AKUN : </td>
			    	<td><input name='kdsakun' type='text' size='3' value='$nextno' class='sendiri' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA SUB AKUN : </td>
			    	<td><input name='nmsakun'   type='text' size='75' class='sendiri' >";
						
			print "</td></tr>";		
			
			print  	"<tr>
				 <td class='subyek1' align='right'>DIPA :</td>
				 <td><select name='kddipa'  id='kddipa' class='sendiri' >
						<option value='' selected> - - Pilih Giat - - </option>";
						 $sql="select * from t_dipa";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							 echo "<option value=\"".$data['kddipa']."\">".$data['kddipa']." | ".$data['nmdipa']."</option>\n";
				    }  
			print "</select></td></tr>";
			
			
          	print "<tr><td class='subyek1' align='right'>WASGIAT : </td> 
				 <td  class='middle'><select name='kdwasgiat'  class='sendiri' required='required'>
						<option value='' selected>- - - - Pilih - - - -</option>";
						 $sql="select kdwasgiat, nmwasgiat from t_wasgiat  order by kdwasgiat ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$_POST[kdwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[kdwasgiat] | $data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[kdwasgiat] | $data[nmwasgiat]</option>";
				    }  
				print "</select></td> </tr>"; 
				 
				
print "</table><br>

<div class='codehim-tombol-biru'><input  type='submit' value='Simpan'   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type='button' value='&nbsp;&nbsp;Batal&nbsp;&nbsp' onclick='self.history.back()' >";

print "</form></div></center>"



?>