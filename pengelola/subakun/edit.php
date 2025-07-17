<?php 
	$edit = mysql_query("SELECT  * FROM t_sakun WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);

?>
<script>

 
//var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
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
	 
	 $("#kdakun").change(function(){
		var kdakun = $("#kdakun").val();
		var kdgiat = $("#kdgiat").val();
		$.ajax({
			url: "pengelola/subakun/ambilsubakun.php",
			data: "kdakun="+kdakun ,
			cache: false,
			success: function(msg){
				$("#kdsakun").html(msg);	
							
			}
		});
	 });     
});  
</script>

<br>
<center><span class="judul">EDIT SUB AKUN</span></center><br>
<center><div id="borderku1">
<div class="form-style-2">

<?
print "<form action='pengelola/subakun/proses.php?aksi=ubah' method='POST'  name='form1'> "; 
print "<input name='id' type='hidden'  size='5' class='input-field'  value='$row[id]'>";
print "<table width='1200' align='center' cellpadding='3'>";

		print "	<td class='subyek1' align='right'>KODE GIAT</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdgiat' id='kdgiat' class='select-field' >
						<option value='' selected> - - Pilih Giat - - </option>";
						 $sql="select kdgiat, nmgiat from t_giat  order by kdgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdgiat]==$row[kdgiat])
							echo "<option value=$data[kdgiat] selected>$data[kdgiat] | $data[nmgiat]</option>";
						 else
							echo "<option value=$data[kdgiat]>$data[kdgiat] | $data[nmgiat]</option>";
				    }  
		print "</select></td></tr>";
			
		print  	"<tr>
				 <td class='subyek1' align='right'>OUTPUT </td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdoutput' id='kdoutput' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select distinct * from t_output where kdgiat='$row[kdgiat]' order by kdoutput";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdoutput]==$row[kdoutput])
							echo "<option value=$data[kdoutput] selected>$data[kdoutput] | $data[nmoutput]</option>";
						 else
							echo "<option value=\"".$data['kdoutput']."\">".$data['kdoutput']."|".$data['nmoutput']."</option>\n";
				    }  
		print "</select></td></tr>";
		
		print "	<td class='subyek1' align='right'>KODE AKUN </td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdakun' id='kdakun' class='select-field' >
						<option value='' selected> - - Pilih Akun - - </option>";
						 $sql="select * from t_akun  order by kdakun";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdakun]==$row[kdakun])
							echo "<option value=$data[kdakun] selected>$data[kdakun] | $data[nmakun]</option>";
						 else
							echo "<option value=$data[kdakun]>$data[kdakun] | $data[nmakun]</option>";
				    }  
		print "</select></td></tr>";
		
		//print  	"<tr>
//				 <td class='subyek1'>KODE SUB AKUN</td>
//				 <td class='subyek1'>:</td>
//				 <td><select name='kdoutput' id='kdoutput' class='select-field' >
//						<option value='' selected> - - Pilih Sub Akun - - </option>";
//						 $sql="select distinct * from t_sakun where kdakun='$row[kdakun]' order by kdsakun";
//						 $qry=mysql_query($sql);
//						 while ($data=mysql_fetch_array($qry)){
//						 if ($data[kdsakun]==$row[kdsakun])
//							echo "<option value=$data[kdsakun] selected>$data[kdsakun] | $data[nmsakun]</option>";
//						 else
//							echo "<option value=\"".$data['kdsakun']."\">".$data['kdsakun']."|".$data['nmsakun']."</option>\n";
//				    }  
//		print "</select></td></tr>";
		
		print "<tr>
					<td class='subyek1' align='right'>KODE SUB AKUN</td>
					<td class='subyek1'>:</td>
			    	<td><input name='kdsakun'  type='text' size='2' class='input-field' value='$row[kdsakun]' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA SUB AKUN</td>
					<td class='subyek1'>:</td>
			    	<td><input name='nmsakun'  type='text' size='75' class='input-field' value='$row[nmsakun]' >";
						
			print "</td></tr>";		
			
					
		print  	"<tr>
				 <td class='subyek1' align='right'>DIPA</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kddipa'  class='select-field' >
				  	<option value='' selected> - - Pilih - - </option>";
						 $sql="select * from t_dipa";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kddipa]==$row[kddipa])
							echo "<option value=$data[kddipa] selected>$data[kddipa] | $data[nmdipa]</option>";
						 else
							echo "<option value=\"".$data['kddipa']."\">".$data['kddipa']."|".$data[nmdipa]."</option>\n";
				    }  
		print "</select></td></tr>";
		
			print "<tr><td class='subyek1' align='right'>WASGIAT</td> 
			 <td class='subyek1'>:</td>
				 <td  class='middle'><select name='kdwasgiat'  class='select-field' required='required'>
						<option value='' selected>- - - - Pilih - - - -</option>";
						 $sql="select kdwasgiat, nmwasgiat from t_wasgiat  order by kdwasgiat ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdwasgiat]==$row[kdwasgiat])
							echo "<option value=$data[kdwasgiat] selected>$data[kdwasgiat] | $data[nmwasgiat]</option>";
						 else
							echo "<option value=$data[kdwasgiat]>$data[kdwasgiat] | $data[nmwasgiat]</option>";
				    }  
				print "</select></td> </tr>"; 
				
				
		print "</table><br> ";
	
			 
	
print	"<table  width='300' align='center'   cellpadding='3'>";
print	"		<tr>
				 <div class='codehim-tombol-biru'><input  type='submit' value='Simpan'   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type='button' value='&nbsp;&nbsp;Batal&nbsp;&nbsp' onclick='self.history.back()' >
			</tr></table><br>";
 print "   </form>";

?>
</div></div>