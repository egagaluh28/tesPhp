

<link href="library/combocari/select2.min.css" rel="stylesheet" />
 <script src="library/combocari/jquery-3.4.1.js" ></script>
 <script src="library/combocari/select2.min.js"></script> 
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
print "<form action='pengelola/subakun/proses.php?aksi=simpan' method='POST'  name='form1'> "; 
   
   
print   "<table width='1200' align='center' cellpadding='3'>";

		  print  	"<tr>
				 <td class='subyek1' align='right'>PROGRAM : </td>
				 <td class='subyek1' width='5'></td>
				 <td><select name='kdprogram' id='kdprogram' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdprogram, nmprogram from t_program  order by kdprogram";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdprogram']."\">".$data['kdprogram']."|".$data['nmprogram']."</option>\n";
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
							echo "<option value=\"".$data['kdgiat']."\">".$data['kdgiat']."|".$data['nmgiat']."</option>\n";
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
				 <td><select id='provinsi' name='kdakun'  id='kdakun' class='select-field' >
						<option value='' selected> - - Pilih Akun - - </option>";
						 $sql="select kdakun, nmakun from t_akun  order by kdakun";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							 echo "<option value=\"".$data['kdakun']."\">".$data['kdakun']." | ".$data['nmakun']."</option>\n";
				    }  
			print "</select></td>				  
			</tr>";	
			
			//print  	"<tr>
//				 <td class='subyek1'>KODE SUB AKUN</td>
//				 <td><select name='kdsakun' id='kdsakun' class='select-field' >
//						<option value='' selected> - - Pilih Sub Akun - - </option>";
//						 $sql="select kdsakun, nmsakun from t_sakun where kdakun='$_POST[kdakun]' order by kdsakun";
//						 $qry=mysql_query($sql);
//						 while ($data=mysql_fetch_array($qry)){
//							echo "<option value=\"".$data['kdsakun']."\">".$data['kdsakun']."|".$data['nmsakun']."</option>\n";
//				    }  
//			print "</select></td> 
//			</tr>";

						$sss="select max(kdsakun) as nomor from t_sakun where kdprogram='$_POST[kdprogram]' and kdgiat='$_POST[kdgiat]' ";
						 $z=mysql_query($sss);
						 
						 print $z[nomor]; 

			print "<tr>
					<td class='subyek1' align='right'>KODE SUB AKUN : </td>
					<td class='subyek1'></td>
			    	<td><input name='kdsakun'  id='kdsakun' type='text' size='6' value='$z[nomor]' class='input-field' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA SUB AKUN : </td>
					<td class='subyek1'></td>
			    	<td><input name='nmsakun'  id='nmsakun' type='text' size='75' class='input-field' >";
						
			print "</td></tr>";		
			
			print  	"<tr>
				 <td class='subyek1' align='right'>DIPA :</td>
				 <td class='subyek1'></td>
				 <td><select name='kddipa'  id='kddipa' class='select-field' >
						<option value='' selected> - - Pilih Giat - - </option>";
						 $sql="select * from t_dipa";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							 echo "<option value=\"".$data['kddipa']."\">".$data['kddipa']." | ".$data['nmdipa']."</option>\n";
				    }  
			print "</select></td></tr>";
			
			
          	print "<tr><td class='subyek1' align='right'>WASGIAT : </td> 
			 <td class='subyek1'></td>
				 <td  class='middle'><select name='kdwasgiat'  class='select-field' required='required'>
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
				 
				
print "</table><br>";		


         
			
		 
	
print	"<table  width='300' align='center'   cellpadding='3'>";
print	"		<tr>
				 <div class='codehim-tombol-biru'><input  type='submit' value='Simpan'   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type='button' value='&nbsp;&nbsp;Batal&nbsp;&nbsp' onclick='self.history.back()' >
			</tr></table><br>";
	
 print   "</form>";
?>
</div></div>
