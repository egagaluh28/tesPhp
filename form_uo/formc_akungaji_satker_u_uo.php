<script language="javascript" src="library/jquery.js"></script>
<style>
#borderku{
width:800px;
background-image: url(images/bg.jpg);
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333;  
padding: 6px;
font-size: 16px;
color:#666;
font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
}

</style>
<script language="JavaScript">
 
//var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
	  
	 $("#kdkotama").change(function(){
		var kdkotama = $("#kdkotama").val();
		$.ajax({
			url: "form_uo/ambilsatker.php",
			data: "kdkotama="+kdkotama,
			cache: false,
			success: function(msg){
				$("#kdsatkr").html(msg);
			}
		});
	  });   
		 
});  
</script>
 <center><br><span class='judulcontent'>CETAK LAP PENGAWASAN GAJI & TUNKIN TINGKAT SATKER</span></center><br><br>
 
 <center>
 <?
  print "<div id='borderku' ><div class='form-style-2'>";
 print "<form name='form1' method='GET'  action='cetak/cetak_akungaji_satker.php' target='_blank'>";
    print "<table width='80%' align='center' cellpadding='3'  >";
	 print  	"<tr>
				 <td class='subyek1' align='right'>KOTAMA : </td>
				
				 <td><select name='kdkotama' id='kdkotama' class='select-field' required='required' >
						<option value='' selected> - - Pilih Kotama - - </option>";
						 $sql="select kdkotama, nmkotama from t_kotam order by kdkotama";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdkotama']."\">".$data['kdkotama']."  | ".$data['nmkotama']."</option>\n";
				    }  
			print "</select></td> 
			</tr>";				
	
	
	
	print "<tr>";
	print "<td class='subyek1' align='right' width='40%'>";
	print "SATKER :</td> 
	      <td><select name='kdsatker'  id='kdsatkr'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih Satker - -</option>";
						
	print "</select></td>";
	
	print "<tr>";
	print "<td class='subyek1' align='right'>BULAN :</td> 
	      <td><select name='kdbulan'  class='select-field' required='required'>";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[kdbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select></td>";
	
	print "<tr>";
	print "<td class='subyek1' align='right'>TAHUN : </td>
		   <td><select name='thang' class='select-field'  required='required'>
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2022;$thn<=2030;$thn++){
									  if ($thn==$_POST[tahun])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select></td>";
									  
	print "<tr>";
	print "<td class='subyek1' align='right'>LAMPIRAN : </td>
		   <td><div class='codehim-tombol-biru'><input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/>";	
	print "&nbsp;&nbsp&nbsp<input  type='submit' value='Cetak'/></div></td>";
	
	print "</tr></table>";
	
	
	print "</form></div></div><br>";
	
	?>