<? 
	$edit = mysql_query("SELECT distinct * FROM t_satkr WHERE id='$_GET[id]'");
    $row    = mysql_fetch_array($edit);
	
	//$edit = mysql_query("SELECT a.id, a.kddept, a.kdunit, a.kdkotama, a.kdsatkr, a.nmsatkr, a.layanan, left(a.layanan,2) as br_kukotama, b.kdkukotama, right(a.layanan,2) as br_kusatker, b.nmkukotama, c.kdkusatker, c.nmkusatker FROM t_satkr a left join t_kukotama b on left(a.layanan,2)=b.kdkukotama left join t_kusatker c on left(a.layanan,2)=c.kdkukotama and right(a.layanan,2)=c.kdkusatker WHERE a.id='$_GET[id]'");
    //$row    = mysql_fetch_array($edit);
	
	
	
	$edit2 = mysql_query("SELECT a.*,b.kdkusatker, b.nmkusatker, b.kdkusatker as kode_layanan FROM t_kotam a  left join t_kusatker b on a.kdkukotama=b.kdkukotama  WHERE b.id='$_GET[id]'");
    $row1    = mysql_fetch_array($edit2);
	
	
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

     
	$("#kdkotama").change(function(){
    	var kdkotama = $("#kdkotama").val();
    	$.ajax({
			url: "pengelola/satker/ambilsatker.php",
			data: "kdkotama="+kdkotama,
			cache: false,
			success: function(msg){
				$("#kdsatkr").html(msg);
			}
		});
	  });     
	
	$("#kdkotama").change(function(){
		var kdkotama = $("#kdkotama").val();
		$.ajax({
			url: "pengelola/satker/ambillayanan_pekas.php",
			data: "kdkotama="+kdkotama,
			cache: false,
			success: function(msg){
				$("#cari_layanan_pekas").html(msg);
			}
		});
	  });    
	 
});  
</script>
<?
		session_start();
		$kotama='$_SESSION[kdkotama]';
		?>
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
<center><span class="judul">EDIT SATKER</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<?
print "<form action='pengelola/satker/proses.php?aksi=ubah' method='POST'  name='form1'> "; 
print "<input name='id' type='hidden'  size='5' class='input-field'  value='$row[id]'>";
print "<table width='1000' align='center' cellpadding='3'>";

		print  	"<tr>
				 <td class='subyek1' align='right'>DEPARTEMEN</td>
				 <td class='subyek1'>:</td>
				  <td><select name='kddept'  id='kddept' class='select-field' >
						<option value='' selected> - - Pilih Departemen- - </option>";
						 $sql="select kddept, nmdept from t_dept  order by kddept";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kddept]==$row[kddept])
							echo "<option value=$data[kddept] selected>$data[kddept] | $data[nmdept]</option>";
						 else							
							echo "<option value=\"".$data['kdkddept']."\">".$data['kddept']." | ".$data['nmdept']."</option>\n";
				    }  
			print "</select></td></tr>";				
			
            print  	"<tr>
				 <td class='subyek1' align='right'>UNIT</td>
				 <td class='subyek1'>:</td>
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

            print  	"<tr>
				 <td class='subyek1' align='right'>KOTAMA</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdkotama' id='kdkotama' class='select-field' >
						<option value='' selected> - - Pilih Kotama - - </option>";
						 $sql="select kdkotama, nmkotama from t_kotam where kddept='$row[kddept]' 
						 and kdunit='$row[kdunit]' order by kdkotama";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdkotama]==$row[kdkotama])
							echo "<option value=$data[kdkotama] selected>$data[kdkotama] | $data[nmkotama]</option>";
						 else		
							echo "<option value=\"".$data['kdkotama']."\">".$data['kdkotama']."|".$data['nmkotama']."</option>\n";
				    }  
			print "</select></td></tr>";					

			print "<tr>
					<td class='subyek1' align='right'>KODE SATKER</td>
					<td class='subyek1'>:</td>
			    	<td><input name='kdsatkr'  id='kdsatkr' type='text' size='6' class='input-field' value='$row[kdsatkr]' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA SATKER</td>
					<td class='subyek1'>:</td>
			    	<td><input name='nmsatkr'  id='nmsatkr' type='text' size='50' class='input-field' value='$row[nmsatkr]' >";
						
			print "</td></tr>";	
			
			//print "<tr>
					//<td class='subyek1'>Layanan</td>
					//<td class='subyek1'>:</td>
			    	//<td><input name='layanan'  id='layanan' type='text' size='50' class='input-field' value='$row[layanan]' >";
						
			//print "</td></tr>";	
			
			print  	"<tr>
				 <td class='subyek1' align='right'>LAYANAN</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdkusatker' id='cari_layanan_pekas' class='select-field' >
						<option value='' selected> - - Pilih Layanan - - </option>";
						 $sql="SELECT a.*, b.nmkukotama, c.kdkotama FROM t_kusatker a 
							   left join t_kukotama b on a.kdkukotama=b.kdkukotama
							   left join t_kotam c on b.kdkukotama=c.kdkukotama
							   where c.kdkotama ='$_GET[kdkotama]'  order by a.kdkusatker";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdkusatker]==$row[kdkusatker])
							echo "<option value=$data[kdkusatker] selected>$data[kdkusatker] | $data[nmkusatker]</option>";
						 else		
							echo "<option value=\"".$data['kdkusatker']."\">".$data['kdkusatker']."|".$data['nmkusatker']."</option>\n";
				    }  
			print "</select></td></tr>";							
				
				
		print "</table><br> ";
	
	print "<table  width='300' align='center'   cellpadding='3'>";
	print "		<tr>
				<td  align='center'><div class='codehim-tombol-biru'><input type='submit'  value='Simpan' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type='button'  value='&nbsp;&nbsp;Batal&nbsp;&nbsp;' onclick='self.history.back()' ></div></td>
			</tr></table><br>";
			
	
 print "   </form>";

?>
</div></div>