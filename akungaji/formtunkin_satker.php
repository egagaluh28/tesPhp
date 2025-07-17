<script type="text/javascript" src="library/jquery.js"></script>
<script language="JavaScript">

var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
  $("#kdkotama").change(function(){
    var kdkotama = $("#kdkotama").val();
    $.ajax({
        url: "pengelola/userlaplakgar/ambilsatker.php",
        data: "kdkotama="+kdkotama,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kdsatkr>
            $("#kdsatker").html(msg);
        }
    });
  });  
}); 
 
</script> 
<style>
#borderku{
		width:1100px;
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
		font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
		}
</style>		
 <br>
 <br><table  width='1200' align='center' ><tr><td class='judulcontent' align='center'>TUNKIN SATKER</td></tr></table>

 <br><center><div id="borderku" >
 <?
 print "<form name='form1' method='GET'  action='paban4/kirimparameter_tunkin.php' >";
	print "<table width='99%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1' align='center'>";

			print "KOTAMA : <select name='kdkotama'  id='kdkotama' class='rounded'  >
						<option value='00' selected>- - - - - - - Pilih - - - - - - -</option>";
						 $sql="select kdkotama, nmkotama from t_kotam  order by kdkotama asc";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 echo "<option value=\"".$data['kdkotama']."\">".$data['nmkotama']."</option>\n";
					   }
				    
			print "</select>&nbsp;&nbsp;&nbsp;";
			
			
			print "SATKER : <select name='kdsatker'  id='kdsatker' class='rounded'   >
					<option value='' selected> - - Pilih - - </option>";					
			print "</select>&nbsp;&nbsp;&nbsp;"; 
	
	print "BULAN : <select name='kdbulan'  class='rounded' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_bulan order by kdbulan";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdbulan]==$_POST[nmbulan])
							echo "<option value=$data[kdbulan] selected>$data[nmbulan]</option>";
						 else
							echo "<option value=$data[kdbulan]>$data[nmbulan]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	print "TAHUN : <select name='thang' class='rounded'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2018;$thn<=2025;$thn++){
									  if ($thn==$_POST[thang])
										echo "<option value=$thn selected>$thn</option>";
									  else
                                        echo "<option value=$thn>$thn</option>";									  
									  }
									  echo "</select>";	
	print "&nbsp;&nbsp;&nbsp;&nbsp;<input  type='submit' value='Proses' class='button green'/>"; 									
	print "</td></tr></table>";
	print "</form>";	
?>	
</div></center>