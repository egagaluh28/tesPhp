<script type="text/javascript" src="library/jquery.js"></script>
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
<br>
<center><span class="judul">INPUT OUTPUT</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<?
print "<form action='pengelola/output/proses.php?aksi=simpan' method='POST'  name='form1'> "; 
   
   
print   "<table width='1000' align='center' cellpadding='3'>";

		

            print  	"<tr>
				 <td class='subyek1' align='right'>PROGRAM</td>
				 <td class='subyek1'>:</td>
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
				 <td class='subyek1' align='right'>KEGIATAN</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdgiat' id='kdgiat' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdgiat, nmgiat from t_giat where  kdprogram='$_POST[kdprogram]' order by kdgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdgiat']."\">".$data['kdgiat']."|".$data['nmgiat']."</option>\n";
				    }  
			print "</select></td>   
			</tr>";	

			print "<tr>
					<td class='subyek1' align='right'>KODE OUTPUT</td>
					<td class='subyek1'>:</td>
			    	<td><input name='kdoutput'  id='kdoutput' type='text' size='6' class='input-field' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA OUTPUT</td>
					<td class='subyek1'>:</td>
			    	<td><input name='nmoutput'  id='nmoutput' type='text' size='70' class='input-field' >";
						
			print "</td></tr>";		
			
							
print "</table><br>";		


         
			
		 
	
print	"<table  width='300' align='center'   cellpadding='3'>";
print	"		<tr>
				 <td><div class='codehim-tombol-biru'><input  type='submit' value='Simpan'   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type='button' value='&nbsp;&nbsp;Batal&nbsp;&nbsp' onclick='self.history.back()' ></td>
			</tr></table><br>";
	
 print   "</form>";
?>
</div></div>
