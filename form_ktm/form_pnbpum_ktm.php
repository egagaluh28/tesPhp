<style>
#borderku{
		width:900px;
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

 <br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>LAPORAN TARGET DAN REALISASI PNBP</td></tr></table>

 <br><center><div id="borderku" >
  <div class="form-style-2">
 <?
 print "<form name='form1' method='GET'  action='realisasipnbpum/kirimparameter_ktm.php' >";
	print "<table width='55%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1'>TRIWULAN : ";
	print "<select name='kdtw'  class='select-field' >";
						print "<option value='' selected>- - Pilih - -</option>";
						 $sql="select * from t_tw order by kdtw";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdtw]==$_POST[nmtw])
							echo "<option value=$data[kdtw] selected>$data[nmtw]</option>";
						 else
							echo "<option value=$data[kdtw]>$data[nmtw]</option>";
				    }  
	print "</select>&nbsp;&nbsp;&nbsp;";
	print "TAHUN : <select name='thang' class='select-field'  >
									  <option value='' selected>- - Pilih - -</option>";
									  for ($thn=2020;$thn<=2025;$thn++){
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
</div></div></center>