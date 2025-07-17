<style>

.checkbox {
		display: inline-block;
		cursor: pointer;
		font-size: 16px; margin-right:10px; line-height:18px;
		font-family:  Arial;
	}
	input[type=checkbox] {
		display:none; 
	}
	.checkbox:before {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		vertical-align:middle;
		background-color: #d8d8d8;
		color: #000;
		text-align: center;
		box-shadow: inset 0px 2px 3px 0px #333; 
		border-radius: 3px;
	}
	input[type=checkbox]:checked + .checkbox:before {
		content: "\2713";
		text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
		font-size: 25px;
	}
</style>	
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<?
    $edit = mysql_query("SELECT a.*, b.nmkotama from validitasktm a left join t_kotam b on a.kdkotama=b.kdkotama where a.id_validitas='$_GET[id_validitas]'");
    $row    = mysql_fetch_array($edit);
 
 //   $ktm = mysql_query("SELECT * from t_kotam where kdkotama='$_SESSION[kdkotama]'");
 //   $k    = mysql_fetch_array($ktm);
	
	
?>	
<br>
<center><span class="judul">EDIT VALIDITAS</span></center><br>
 <center><div id="borderku1" ><div class='form-style-2'>
<form action="validitas/prosesvaliditasktm.php?aksi=ubah_utk_uo" method="POST"  name="form1">  

    <table width="900" align="center" cellpadding="5">

			<tr>
				<td  align="right" class="subyek1">KOTAMA :</td>
			    <td valign="top" colspan="3">
				<input name="id_validitas" type="hidden"   class="roundedisi" readonly  value="<? print "$row[id_validitas]"; ?>" />
				<input name="kdkotama" type="text"  size="4" class="input-field" readonly  value="<? print "$row[kdkotama]"; ?>" />&nbsp;
				<input name="nmkotama" type="text"  size="35" class="input-field" readonly  value="<? print "$row[nmkotama]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TAHUN ANGGARAN :</td>
				<td valign="top" colspan="3"><? print "<select name='thang' class='select-field'>";
					  print "<option value='' selected>- Pilih -</option>";
					  for ($tahun=2016; $tahun<=2025; $tahun++){
					  $thn=$row['thang'];
					  if ($thn==$tahun)
						   echo "<option value=$tahun selected>$tahun</option>";
					  else
						   echo "<option value=$tahun>$tahun</option>";
					  }
					  echo "</select>"; ?></td>
		    </tr>
		</table><br> 
		
		 <table width="900" align="center" cellpadding="5" class="bordered" >
			<tr>
				<th class="subyek1" >B U L A N</th>
				<th class="subyek1" align="center" >JAN</th>
				<th class="subyek1" align="center" >PEB</th>
				<th class="subyek1" align="center" >MER</th>
				<th class="subyek1" align="center" >APR</th>
				<th class="subyek1" align="center" >MEI</th>
				<th class="subyek1" align="center" >JUN</th>
				<th class="subyek1" align="center" >JUL</th>
				<th class="subyek1" align="center" >AGU</th>
				<th class="subyek1" align="center" >SEP</th>
				<th class="subyek1" align="center" >OKT</th>
				<th class="subyek1" align="center" >NOP</th>
				<th class="subyek1" align="center" >DES</th>
			</tr>	
			<tr>
				<td class="subyek1">RESTORE DATA</td>
				<td align="center" ><input id="Option1" name="b01" type="checkbox" value="x" 
									 <? if($row['b01']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option1"></label></td>
				<td align="center" ><input id="Option2" name="b02" type="checkbox" value="x"
									<? if($row['b02']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option2"></label></td>
				<td align="center" ><input id="Option3" name="b03" type="checkbox" value="x"
									<? if($row['b03']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option3"></label></td>
				<td align="center" ><input id="Option4" name="b04" type="checkbox" value="x"
									<? if($row['b04']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option4"></label></td>	
				<td align="center" ><input id="Option5" name="b05" type="checkbox" value="x"
									<? if($row['b05']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option5"></label></td>
				<td align="center" ><input id="Option6" name="b06" type="checkbox" value="x" 
									<? if($row['b06']=='x') {print "checked=checked";}?> >	
								   <label class="checkbox" for="Option6"></label></td>
				<td align="center" ><input id="Option7" name="b07" type="checkbox" value="x" 
									<? if($row['b07']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option7"></label></td>
				<td align="center" ><input id="Option8" name="b08" type="checkbox" value="x" 
									<? if($row['b08']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option8"></label></td>	
				<td align="center" ><input id="Option9" name="b09" type="checkbox" value="x" 
									<? if($row['b09']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option9"></label></td>
				<td align="center" ><input id="Option10" name="b10" type="checkbox" value="x" 
									<? if($row['b10']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option10"></label></td>
				<td align="center" ><input id="Option11" name="b11" type="checkbox" value="x" 
									<? if($row['b11']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option11"></label></td>
				<td align="center" ><input id="Option12" name="b12" type="checkbox" value="x" 
									<? if($row['b12']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option12"></label></td>					   
			</tr>	
			
			<tr>
				<td class="subyek1">KIRIM EMAIL</td>
				<td align="center" ><input id="Option13" name="e01" type="checkbox" value="x"
									<? if($row['e01']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option13"></label></td>
				<td align="center" ><input id="Option14" name="e02" type="checkbox" value="x"
									<? if($row['e02']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option14"></label></td>	
				<td align="center" ><input id="Option15" name="e03" type="checkbox" value="x"
									<? if($row['e03']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option15"></label></td>
				<td align="center" ><input id="Option16" name="e04" type="checkbox" value="x"
									<? if($row['e04']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option16"></label></td>
				<td align="center" ><input id="Option17" name="e05" type="checkbox" value="x"
									<? if($row['e05']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option17"></label></td>
				<td align="center" ><input id="Option18" name="e06" type="checkbox" value="x"
									<? if($row['e06']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option18"></label></td>	
				<td align="center" ><input id="Option19" name="e07" type="checkbox" value="x"
									<? if($row['e07']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option19"></label></td>
				<td align="center" ><input id="Option20" name="e08" type="checkbox" value="x"
									<? if($row['e08']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option20"></label></td>
				<td align="center" ><input id="Option21" name="e09" type="checkbox" value="x"
									<? if($row['e09']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option21"></label></td>
				<td align="center" ><input id="Option22" name="e10" type="checkbox" value="x"
									<? if($row['e10']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option22"></label></td>		
				<td align="center" ><input id="Option23" name="e11" type="checkbox" value="x"
									<? if($row['e11']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option23"></label></td>
				<td align="center" ><input id="Option24" name="e12" type="checkbox" value="x"
									<? if($row['e12']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option24"></label></td>					
			</tr>	
			</table><br><br>
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><input type="submit"  value="Simpan" class="button green"></td>
				 <td></td>
				 <td ><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button green"></td>
			</tr></table>
	
    </form>
	</div></div></center>
<br>

