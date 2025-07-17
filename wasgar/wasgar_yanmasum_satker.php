<script type="text/javascript" src="library/jquery.js"></script>
<script language="JavaScript">

var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
  
	$("#kdprogram").change(function(){
    	var kdprogram = $("#kdprogram").val();
    	$.ajax({
			url: "wasgar/ambilgiat.php",
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
			url: "wasgar/ambiloutput.php",
			data: "kdgiat="+kdgiat,
			cache: false,
			success: function(msg){
				$("#kdoutput").html(msg);				
			}
		});
	 });     


$("#kdoutput").change(function(){
    	var kdoutput = $("#kdoutput").val();
    	$.ajax({
			url: "wasgar/ambilakun_bpjs.php",
			data: "kdoutput="+kdoutput,
			cache: false,
			success: function(msg){
				$("#kdakun").html(msg);
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
<?
 $edit = mysql_query("SELECT a.kdkotama,  a.kdsatkr, a.nmsatkr, a.kdkusatker, b.nmkotama from t_satkr a 
  left join t_kotam b on a.kdkotama=b.kdkotama 
  where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatkr='$_SESSION[kdsatker]'");
  $row    = mysql_fetch_array($edit);
  $kotama=strtoupper($row[nmkotama]);
  
  print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>KARTU WASGAR YANMASUM SATKER</td></tr></table><br>";
  
  ?>  
	<center><div id="borderku" >
				<div class="form-style-2">	
   <form name="form1"  method="GET" action="wasgar/cetakwasgar_yanmasum_satker.php" target="_blank">
			<table  width='95%' align='center'   cellpadding='3'>
			<tr>
				<td class="subyek1" align="right">TAHUN ANGGARAN :</td>
				<td  valign="middle"><? print "<select name='thang' class='select-field' onChange='getSatuan(this.form)'>";
					  print "<option value=' ' selected>PILIH</option>";
					  for ($tahun=2021; $tahun<=2025; $tahun++){
					  $thn=$_POST['thang'];
					  if ($thn==$tahun)
						   echo "<option value=$tahun selected>$tahun</option>";
					  else
						   echo "<option value=$tahun>$tahun</option>";
					  }
					  echo "</select>"; ?>  
				 </td>		  
			</tr>	
					
			

			<?	print "<td class='subyek1' align='right'>SUMBER ANGGARAN :</td>
				 <td><select name='kdsa'  class='select-field' required='required'>
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdsa, nmsa from t_sa where kdsa<'3' order by kdsa";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdsa]==$_POST[kdsa])
							echo "<option value=$data[kdsa] selected>$data[kdsa] | $data[nmsa]</option>";
						 else
							echo "<option value=$data[kdsa]>$data[kdsa] | $data[nmsa]</option>";
				    }  
				print "</select></td>"; ?>	
			</tr>		
	
			<tr>
				 <td class="subyek1" align="right">KOTAMA :</td>
				 <td >  <input type="text"  name="kdkotama"  size="5" class="input-field" readonly value=<? print "$row[kdkotama]"; ?> 
				 style="text-align: center;"/><span class="subyek1">&nbsp;&nbsp;<? print "$kotama"; ?></span>
				 </td>	
			</tr>
			
			<tr>
				 <td class="subyek1" align="right">SATKER :</td>
				 <td >  <input type="text"  name="kdsatker"  size="5" class="input-field" readonly value=<? print "$row[kdsatkr]"; ?> 
				 style="text-align: center;" />&nbsp;&nbsp;<span class="subyek1"><? print "$row[nmsatkr]"; ?></span>
				 </td>
			</tr>	
			
			<tr>
			<?	print "<td class='subyek1' align='right'>PROGRAM :</td>
				 <td><select name='kdprogram'  id='kdprogram' class='select-field' required='required'>
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdprogram, nmprogram from t_program  where kdprogram <>'12' order by kdprogram";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 if ($data[kdprogram]==$_POST[kdprogram])
							echo "<option value=$data[kdprogram] selected>$data[kdprogram] | $data[nmprogram]</option>";
						 else
							echo "<option value=$data[kdprogram]>$data[kdprogram] | $data[nmprogram]</option>";
				    }  
				print "</select></td>"; ?>	
			</tr>		
		
			
			<tr>
			<?	print "<td class='subyek1' align='right'>GIAT :</td>
				 <td><select name='kdgiat' id='kdgiat' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";
						 $sql="select kdgiat, nmgiat from t_giat where  and kdprogram='$_POST[kdprogram]' order by kdgiat";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
							echo "<option value=\"".$data['kdgiat']."\">".$data['kdgiat']."|".$data['nmgiat']."</option>\n";
				    }  
			print "</select></td>"; ?>	
			</tr>	

			<tr>
			<?	print "<td class='subyek1' align='right'>OUTPUT :</td>
				 <td><select name='kdoutput' id='kdoutput' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";			 
			print "</select></td>"; ?>	
			</tr>		

				
			
			<tr>
			<?	print "<td class='subyek1' align='right'>AKUN :</td>
				 <td><select name='kdakun' id='kdakun' class='select-field' >
						<option value='' selected> - - Pilih - - </option>";			 
			print "</select></td>"; ?>	
			</tr>		
			
			<tr>
				 <td class="subyek1" colspan="2" height="20"> </td>			  
			</tr>	
			
		
			<tr><td></td>
				 <td class="subyek1" colspan="2" height="20"><input  type="submit" value="Proses" class="button blue"/> </td>			  
			</tr>
			
			</table>
			</form>
			
</div></div></center><br>