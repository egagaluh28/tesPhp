<script language="javascript" src="library/jquery.js"></script>
<style>
#borderku{
		width:800px;
		background-image: url(../images/buku.png);
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

 <br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>CETAK PNBP UMUM TINGKAT SATKER</td></tr></table>

 <br><center><div id="borderku" >
  <div class="form-style-2">
 <?
 print "<form name='form1' method='GET'  action='cetak/cetak_pnbpum_satker.php' target='_Blank'>";
    print "<input type='hidden'  name='kdkotama'  size='5' class='rounded' readonly value='$_SESSION[kdkotama]'>"; 
 //  print "<input type='hidden'  name='kdsatker'  size='5' class='rounded' readonly value='$_SESSION[kdsatker]'>"; 
	print "<table width='60%'  cellspacing='0' cellpadding='3' align='center'>";
	
	print "<tr><td class='subyek1'  align='right'>";
	print "KOTAMA : </td><td><select name='kdkotama' id='kdkotama' class='select-field' required='required' >
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
	
	print "<tr><td class='subyek1' align='right'>";
	print "TRIWULAN : </td><td><select name='kdtw'  class='select-field' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_tw order by kdtw";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdtw]==$_POST[nmtw])
							echo "<option value=$data[kdtw] selected>$data[nmtw]</option>";
						 else
							echo "<option value=$data[kdtw]>$data[nmtw]</option>";
				    }  
	print "</select></td></tr>";
	print "<tr><td class='subyek1'  align='right'>";
	print "TAHUN : </td><td><select name='thang' class='select-field'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2020;$thn<=2025;$thn++){
									  if ($thn==$_POST[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select></td></tr>";	
	print "<tr><td class='subyek1'  align='right'>";								  
	print "LAMPIRAN : </td><td><input type='text' name='lamp'  size='5' class='input-field' style='text-align:center;'/></td></tr>";
	print "<tr><td class='subyek1' >";
	print "</td><td><input  type='submit' value='Proses' class='button green'/>";									
	print "</td></tr></table>";
	print "</form>";	
?>	
</div></div></center>