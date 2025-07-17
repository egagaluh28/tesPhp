
<style>
#borderku{
		width:900px;
		
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
 <br>
 <br><table  width='1200' align='center' ><tr><td class='judulcontent' align='center'>LAPORAN PENGAWASAN GAJI DAN TUNKIN</td></tr></table>

 <br><center><div id="borderku" >  <div class="form-style-2">
 <?
 print "<form name='form1' method='GET'  action='akungaji/kirimparameter_uo.php' >";
 print "<input type='hidden'  name='kdkotama'   class='roundedisi'  value='$_SESSION[kdkotama]' />";
	print "<table width='99%'  cellspacing='0' cellpadding='2' align='center'><tr><td class='subyek1' align='center'>";

				print "BULAN : <select name='kdbulan'  class='select-field' >";
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