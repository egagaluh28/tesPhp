<? 
	$edit = mysql_query("SELECT * FROM t_kotam WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
	

	
?>
<script>

 
//var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
	$("#kddept").change(function(){
		var kddept = $("#kddept").val();
		$.ajax({
			url: "pengelola/satker/ambilunit.php",
			data: "kddept="+kddept,
			cache: false,
			success: function(msg){
				//jika data sukses diambil dari server kita tampilkan
				//di <select id=kdpekas>
				$("#kdunit").html(msg);
			}
		});
	  });
  
	 $("#kdunit").change(function(){
		var kdunit = $("#kdunit").val();
		$.ajax({
			url: "pengelola/satker/ambilkotama.php",
			data: "kdunit="+kdunit,
			cache: false,
			success: function(msg){
				$("#kdkotama").html(msg);
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
<br><center><span class="judul">EDIT KOTAMA / BALAKPUS</span></center><br>


<center><div id="bdr">
<div class="form-style-2">
<?
print "<form action='pengelola/kotama/proses.php?aksi=ubah' method='POST'  name='form1'> "; 
print "<input name='id' type='hidden'  size='5' class='input-field'  value='$row[id]'>";
print "<table width='700' align='center' cellpadding='3'>";

		print  	"<tr>
				 <td class='subyek1' align='right'>DEPARTEMEN :</td>
				 
				  <td><select name='kddept'  id='kddept' class='select-field' >
						<option value='' selected> - - Pilih Departemen- - </option>";
						 $sql="select kddept, nmdept from t_dept  where kddept='012' order by kddept";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kddept]==$row[kddept])
							echo "<option value=$data[kddept] selected>$data[kddept] | $data[nmdept]</option>";
						 else							
							echo "<option value=\"".$data['kdkddept']."\">".$data['kddept']." | ".$data['nmdept']."</option>\n";
				    }  
			print "</select></td></tr>";				
			
            print  	"<tr>
				 <td class='subyek1' align='right'>UNIT :</td>
				
				 <td><select name='kdunit' id='kdunit' class='select-field' >
						<option value='' selected> - - Pilih Unit - - </option>";
						 $sql="select kdunit, nmunit from t_unit where kddept='$row[kddept]' order by kdunit";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdunit]==$row[kdunit])
							echo "<option value=$data[kdunit] selected>$data[kdunit] | $data[nmunit]</option>";
						 else					
							echo "<option value=\"".$data['kdunit']."\">".$data['kdunit']."|".$data['nmunit']."</option>\n";
				    }  
			print "</select></td></tr>";		
					

			print "<tr>
					<td class='subyek1' align='right'>KODE KOTAMA :</td>
					
			    	<td><input name='kdkotama'  id='kdkotama' type='text' size='6' class='input-field' value='$row[kdkotama]' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA KOTAMA :</td>
					
			    	<td><input name='nmkotama'  id='nmkotama' type='text' size='50' class='input-field' value='$row[nmkotama]' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>KODE KUKOTAMA :</td>
					
			    	<td><select name='kdkukotama'  class='select-field' >
						<option value='' selected> - - Pilih KuKotama - - </option>";
						 $sql="select *  from t_kukotama  order by kdkukotama";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdkukotama]==$row[kdkukotama])
							echo "<option value=$data[kdkukotama] selected>$data[kdkukotama] | $data[nmkukotama]</option>";
						 else					
							echo "<option value=\"".$data['kdkukotama']."\">".$data['kdkukotama']."|".$data['nmkukotama']."</option>\n";
				    }  
			print "</select>";
						
			print "</td></tr>";				
				
				
		print "</table><br> ";
	
	print "<table  width='300' align='center'   cellpadding='3'>";
	print "		<tr>
				 <td  align='center'><div class='codehim-tombol-biru'><input type='submit'  value='Simpan' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type='button'  value='&nbsp;&nbsp;Batal&nbsp;&nbsp;' onclick='self.history.back()' ></div></td>
			</tr></table><br>";
	
 print "   </form>";

?>
</div></div>