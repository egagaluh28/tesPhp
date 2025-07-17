<script type="text/javascript" src="library/jquery.js"></script>
<?php 
	$edit = mysql_query("SELECT distinct * FROM t_output WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
	
	
	//$edit2 	= mysql_query("SELECT t_sakun.*, t_giat.* from t_sakun left join t_giat on t_sakun.kdgiat=t_giat.kdgiat WHERE id='$_GET[id]' ");
	//$row2   = mysql_fetch_array($edit2);
	//$edit1 = mysql_query("SELECT distinct kddipa FROM t_output WHERE id='$_GET[id]' ");
//    $row1    = mysql_fetch_array($edit1);
//	$dipa = $row1[kddipa];
//	
//	if ( $dipa==1){	
//	
//		$urdipa=" Otorisasi Berjenjang";
//	
//	}
//	else{
//								
//		$urdipa="Dipa Sbg Otorisasi";
//	}
	
?>
<script>


 
//var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
	
     
	$("#kdprogram").change(function(){
    	var kdprogram = $("#kdprogram").val();
    	$.ajax({
			url: "pengelola/output/ambilgiat.php",
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
			url: "pengelola/output/ambiloutput.php",
			data: "kdgiat="+kdgiat,
			cache: false,
			success: function(msg){
				$("#kdoutput").html(msg);				
			}
		});
	 });     
	 
	 
});  
</script>
<style>
#bdr{
width:1000px;
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333; 
padding: 16px;
font-size: 16px;
color:#666;
font-family: 'arial',  sans-serif;
}
</style>
<center><br><span class="judul">EDIT OUTPUT</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<?
print "<form action='pengelola/output/proses.php?aksi=ubah' method='POST'  name='form1'> "; 
print "<input name='id' type='hidden'  size='5' class='input-field'  value='$row[id]'>";
print "<table width='1000' align='center' cellpadding='3'>";

			


            print  	"<tr>
				 <td class='subyek1' align='right'>PROGRAM</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdprogram' id='kdprogram' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdprogram, nmprogram from t_program  order by kdprogram";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdprogram]==$row[kdprogram])
							echo "<option value=$data[kdprogram] selected>$data[kdprogram] | $data[nmprogram]</option>";
						 else		
							echo "<option value=\"".$data['kdprogram']."\">".$data['kdprogram']."|".$data['nmprogram']."</option>\n";
				    }  
			print "</select></td></tr>";					

			print  	"<tr>
				 <td class='subyek1' align='right'>KEGIATAN</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdgiat' id='kdgiat' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdgiat, nmgiat from t_giat where  kdprogram='$row[kdprogram]' order by kdgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdgiat]==$row[kdgiat])
							echo "<option value=$data[kdgiat] selected>$data[kdgiat] | $data[nmgiat]</option>";
						 else
							echo "<option value=\"".$data['kdgiat']."\">".$data['kdgiat']."|".$data['nmgiat']."</option>\n";
				    }  
			print "</select></td></tr>";			

 			print "<tr>
					<td class='subyek1' align='right'>KODE OUTPUT</td>
					<td class='subyek1'>:</td>
			    	<td><input name='kdoutput'  id='kdoutput' type='text' size='3' class='input-field' value='$row[kdoutput]' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA OUTPUT</td>
					<td class='subyek1'>:</td>
			    	<td><input name='nmoutput'  id='nmoutput' type='text' size='75' class='input-field' value='$row[nmoutput]' >";
						
			print "</td></tr>";				
				
				
		print "</table><br> ";
	
	print "<table  width='300' align='center'   cellpadding='3'>";
	print "		<tr>
				 <td width='150' align='center'><div class='codehim-tombol-biru'><input  type='submit' value='Simpan'   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type='button' value='&nbsp;&nbsp;Batal&nbsp;&nbsp' onclick='self.history.back()' ></td>
			</tr></table><br>";
	
 print "   </form>";

?>
</div></div>