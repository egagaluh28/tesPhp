<style type="text/css"> 
a {	text-decoration: none;} 
</style>

<link href="thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="library/jquery-1.2.6.js"></script>
<script language="javascript" src="thickbox/thickbox.js"></script>


 
 
<html>
<head>

<script language="JavaScript">


 
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
<br>
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

<center><span class="judul">INPUT SATKER</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<?
print "<form action='pengelola/satker/proses.php?aksi=simpan' method='POST'  name='form1'> "; 
   
   
print   "<table width='1000' align='center' cellpadding='3'>";

			print  	"<tr>
				 <td class='subyek1'align='right'>DEPARTEMEN</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kddept'  id='kddept' class='select-field' >
						<option value='' selected> - - Pilih Departemen- - </option>";
						 $sql="select kddept, nmdept from t_dept  where kddept='012'";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							 echo "<option value=\"".$data['kddept']."\">".$data['kddept']." | ".$data['nmdept']."</option>\n";
				    }  
			print "</select></td>				  
			</tr>";		

            print  	"<tr>
				 <td class='subyek1' align='right'>UNIT</td>
				 <td class='subyek1'>:</td>
				 <td><select name='kdunit' id='kdunit' class='select-field' >
				 
						<option value='' selected> - - Pilih Unit- - </option>";
						 $sql="select kdunit, nmunit from t_unit where kddept='$_POST[kddept]' order by kdunit";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdunit']."\">".$data['kdunit']."|".$data['nmunit']."</option>\n";
				    }  
			print "</select></td>				  
			</tr>";		
 
            print  	"<tr>
				 <td class='subyek1' align='right'>KOTAMA</td>
				 <td class='subyek1'>:</td>
				
				 <td><select name='kdkotama' id='kdkotama' class='select-field' >
						<option value='' selected> - - Pilih Kotama - - </option>";
						 $sql="select kdkotama, nmkotama from t_kotam order by kdkotama";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdkotama']."\">".$data['kdkotama']."|".$data['nmkotama']."</option>\n";
				    }  
			print "</select></td> 
			</tr>";					

			
			print "<tr>
					<td class='subyek1' align='right'>KODE SATKER</td>
					<td class='subyek1'>:</td>
			    	<td><input name='kdsatkr'  id='kdsatkr' type='text' size='6' class='input-field' >";
						
			print "</td></tr>";	
			
			print "<tr>
					<td class='subyek1' align='right'>NAMA SATKER</td>
					<td class='subyek1'>:</td>
			    	<td><input name='nmsatkr'  id='nmsatkr' type='text' size='50' class='input-field' >";
						
			print "</td></tr>";		
			
			print  	"<tr>
				 <td class='subyek1' align='right'>LAYANAN</td>
				 <td class='subyek1'>:</td>
				
				 <td><select name='kdkusatker' id='cari_layanan_pekas' class='select-field' >
						<option value='' selected> - - Pilih Layanan - - </option>";
						 $sql="SELECT a.*, b.nmkukotama, c.kdkotama FROM t_kusatker a 
							   left join t_kukotama b on a.kdkukotama=b.kdkukotama
							   left join t_kotam c on b.kdkukotama=c.kdkukotama
							   where c.kdkotama ='$_SESSION[kdkotama]'  order by a.kdkusatker ";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdkukotama'].$data['kdkusatker']."\">".$data['kdkukotama']." | ".$data['kdkusatker']."|".$data['nmkusatker']."</option>\n";
				    }  
			print "</select></td> 
			</tr>";				
			

 						
print "</table><br>";		


         
			
		 
	
print	"<table  width='300' align='center'   cellpadding='3'>";
print	"		<tr>
				<td  align='center'><div class='codehim-tombol-biru'><input type='submit'  value='Simpan' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type='button'  value='&nbsp;&nbsp;Batal&nbsp;&nbsp;' onclick='self.history.back()' ></div></td>
			</tr></table><br>";
	
 print   "</form>";
?>
</div></div>
