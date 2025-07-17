<?
    $ktm = mysql_query("SELECT * from t_kotam where kdkotama='$_SESSION[kdkotama]'");
    $k    = mysql_fetch_array($ktm);
	
	$satkr = mysql_query("SELECT * from t_satkr where kdkotama='$_SESSION[kdkotama]' and kdsatkr='$_SESSION[kdsatker]'");
    $s    = mysql_fetch_array($satkr);
?>	
<br>
<center><span class="judul">INPUT VALIDITAS</span></center><br>
 <center><div id="borderku1" >
<form action="validitas/prosesvaliditassatker.php?aksi=simpan" method="POST"  name="form1">  

    <table width="800" align="center" cellpadding="5">

			<tr>
				<td width="150" align="right" class="subyek1">KOTAMA :</td>
			    <td valign="top" colspan="3">
				<input name="kdkotama" type="text"  size="4" class="roundedisi" readonly  value="<? print "$k[kdkotama]"; ?>" />&nbsp;
				<input name="nmkotama" type="text"  size="35" class="roundedisi" readonly  value="<? print "$k[nmkotama]"; ?>" /></td>
			</tr>
			<tr>
				<td width="150" align="right" class="subyek1">SATKER :</td>
			    <td valign="top" colspan="3">
				<input name="kdsatker" type="text"  size="4" class="roundedisi" readonly  value="<? print "$s[kdsatkr]"; ?>" />&nbsp;
				<input name="nmsatker" type="text"  size="35" class="roundedisi" readonly  value="<? print "$s[nmsatkr]"; ?>" /></td>
			</tr>
			<tr>
				<td width="150" align="right" class="subyek1">TAHUN ANGGARAN :</td>
				<td valign="top" colspan="3"><? print "<select name='thang' class='rounded'>";
					  print "<option value='' selected>- Pilih -</option>";
					  for ($tahun=2016; $tahun<=2025; $tahun++){
					  $thn=$_POST['thang'];
					  if ($thn==$tahun)
						   echo "<option value=$tahun selected>$tahun</option>";
					  else
						   echo "<option value=$tahun>$tahun</option>";
					  }
					  echo "</select>"; ?></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">JANUARI :</td>
				<td valign="top" ><select name="b01" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b01'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b01'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			<td width="150" align="right" class="subyek1">JULI :</td>
				<td valign="top" ><select name="b07" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b07'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b07'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">FEBRUARI :</td>
				<td valign="top" ><select name="b02" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b02'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b02'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			
				<td width="150" align="right" class="subyek1">AGUSTUS :</td>
				<td valign="top" ><select name="b08" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b08'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b08'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">MARET :</td>
				<td valign="top" ><select name="b03" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b03'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b03'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			<td width="150" align="right" class="subyek1">SEPTEMBER :</td>
				<td valign="top" ><select name="b09" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b09'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b09'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">APRIL :</td>
				<td valign="top" ><select name="b04" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b04'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b04'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			
			<td width="150" align="right" class="subyek1">OKTOBER :</td>
				<td valign="top" ><select name="b10" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b10'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b10'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>

			<tr>
				<td width="150" align="right" class="subyek1">MEI :</td>
				<td valign="top" ><select name="b05" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b05'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b05'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			<td width="150" align="right" class="subyek1">NOPEMBER :</td>
				<td valign="top" ><select name="b11" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b11'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b11'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">JUNI :</td>
				<td valign="top" ><select name="b06" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b06'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b06'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
				<td width="150" align="right" class="subyek1">DESEMBER :</td>
				<td valign="top" ><select name="b12" class="rounded"  >
										<option value="" selected>- Pilih -</option>
												<?
												if ($_POST['b12'] == "x") echo "<option value='x' selected>Selesai</option>";
												else echo "<option value='x'>Selesai</option>";
												if ($_POST['b12'] == "y") echo "<option value='user' selected>Blm Selesai</option>";
												else echo "<option value='y'>Blm Selesai</option>"; 
												?>
										</select></td>
			</tr>									
			
			
		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><input type="submit"  value="Simpan" class="button green"></td>
				 <td></td>
				 <td ><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button green"></td>
			</tr></table>
	
    </form>
	</div></center>
<br>

