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
    $edit = mysql_query("SELECT * from validitasktm where id_validitas='$_GET[id_validitas]'");
    $row    = mysql_fetch_array($edit);
 
    $ktm = mysql_query("SELECT * from t_kotam where kdkotama='$_SESSION[kdkotama]'");
    $k    = mysql_fetch_array($ktm);
	
	
?>	
<br>
<center><span class="judul">EDIT VALIDITAS</span></center><br>
 <center><div id="borderku1" ><div class='form-style-2'>
<form action="validitas/prosesvaliditasktm.php?aksi=ubah" method="POST"  name="form1">  

    <table width="900" align="center" cellpadding="5">

			<tr>
				<td  align="right" class="subyek1">KOTAMA :</td>
			    <td valign="top" colspan="3">
				<input name="id_validitas" type="hidden"   class="roundedisi" readonly  value="<? print "$row[id_validitas]"; ?>" />
				<input name="kdkotama" type="text"  size="4" class="input-field" readonly  value="<? print "$k[kdkotama]"; ?>" />&nbsp;
				<input name="nmkotama" type="text"  size="35" class="input-field" readonly  value="<? print "$k[nmkotama]"; ?>" /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TAHUN ANGGARAN :</td>
				<td valign="top" colspan="3"><? print "<select name='thang' class='select-field'>";
					  print "<option value='' selected>- Pilih -</option>";
					  for ($tahun=2021; $tahun<=2025; $tahun++){
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
				<td align="center" ><input id="Option1" name="b01" type="checkbox" onclick="isitanggal('b01')" value="x" 
									 <? if($row['b01']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option1"></label></td>
				<td align="center" ><input id="Option2" name="b02" type="checkbox" onclick="isitanggal('b02')" value="x"
									<? if($row['b02']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option2"></label></td>
				<td align="center" ><input id="Option3" name="b03" type="checkbox" onclick="isitanggal('b03')" value="x"
									<? if($row['b03']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option3"></label></td>
				<td align="center" ><input id="Option4" name="b04" type="checkbox" onclick="isitanggal('b04')" value="x"
									<? if($row['b04']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option4"></label></td>	
				<td align="center" ><input id="Option5" name="b05" type="checkbox" onclick="isitanggal('b05')" value="x"
									<? if($row['b05']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option5"></label></td>
				<td align="center" ><input id="Option6" name="b06" type="checkbox" onclick="isitanggal('b06')" value="x" 
									<? if($row['b06']=='x') {print "checked=checked";}?> >	
								   <label class="checkbox" for="Option6"></label></td>
				<td align="center" ><input id="Option7" name="b07" type="checkbox" onclick="isitanggal('b07')" value="x" 
									<? if($row['b07']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option7"></label></td>
				<td align="center" ><input id="Option8" name="b08" type="checkbox" onclick="isitanggal('b08')" value="x" 
									<? if($row['b08']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option8"></label></td>	
				<td align="center" ><input id="Option9" name="b09" type="checkbox" onclick="isitanggal('b09')" value="x" 
									<? if($row['b09']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option9"></label></td>
				<td align="center" ><input id="Option10" name="b10" type="checkbox" onclick="isitanggal('b10')" value="x" 
									<? if($row['b10']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option10"></label></td>
				<td align="center" ><input id="Option11" name="b11" type="checkbox" onclick="isitanggal('b11')" value="x" 
									<? if($row['b11']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option11"></label></td>
				<td align="center" ><input id="Option12" name="b12" type="checkbox" onclick="isitanggal('b12')" value="x" 
									<? if($row['b12']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option12"></label></td>					   
			</tr>	
			
			
			
			<tr>
				<td class="subyek1">KIRIM EMAIL</td>
				<td align="center" ><input id="Option13" name="e01" type="checkbox" onclick="isitanggal('e01')" value="x"
									<? if($row['e01']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option13"></label></td>
				<td align="center" ><input id="Option14" name="e02" type="checkbox" onclick="isitanggal('e02')" value="x"
									<? if($row['e02']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option14"></label></td>	
				<td align="center" ><input id="Option15" name="e03" type="checkbox" onclick="isitanggal('e03')" value="x"
									<? if($row['e03']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option15"></label></td>
				<td align="center" ><input id="Option16" name="e04" type="checkbox" onclick="isitanggal('e04')" value="x"
									<? if($row['e04']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option16"></label></td>
				<td align="center" ><input id="Option17" name="e05" type="checkbox" onclick="isitanggal('e05')" value="x"
									<? if($row['e05']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option17"></label></td>
				<td align="center" ><input id="Option18" name="e06" type="checkbox" onclick="isitanggal('e06')" value="x"
									<? if($row['e06']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option18"></label></td>	
				<td align="center" ><input id="Option19" name="e07" type="checkbox" onclick="isitanggal('e07')" value="x"
									<? if($row['e07']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option19"></label></td>
				<td align="center" ><input id="Option20" name="e08" type="checkbox" onclick="isitanggal('e08')" value="x"
									<? if($row['e08']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option20"></label></td>
				<td align="center" ><input id="Option21" name="e09" type="checkbox" onclick="isitanggal('e09')" value="x"
									<? if($row['e09']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option21"></label></td>
				<td align="center" ><input id="Option22" name="e10" type="checkbox" onclick="isitanggal('e10')" value="x"
									<? if($row['e10']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option22"></label></td>		
				<td align="center" ><input id="Option23" name="e11" type="checkbox" onclick="isitanggal('e11')" value="x"
									<? if($row['e11']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option23"></label></td>
				<td align="center" ><input id="Option24" name="e12" type="checkbox" onclick="isitanggal('e12')" value="x"
									<? if($row['e12']=='x') {print "checked=checked";}?> >
								   <label class="checkbox" for="Option24"></label></td>					
			</tr>	
			
			
			<tr>
				<td class="subyek1"></td>
				<td align="center" >
				<input type="hidden"  name="tb01"  id='tb01' class="input-field" value="<? print "$row[tb01]"; ?>" />
				<input type="hidden"  name="te01"  id='te01' class="input-field" value="<? print "$row[te01]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb02"  id='tb02' class="input-field" value="<? print "$row[tb02]"; ?>" />
				<input type="hidden"  name="te02"  id='te02' class="input-field" value="<? print "$row[te02]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb03"  id='tb03' class="input-field" value="<? print "$row[tb03]"; ?>" />
				<input type="hidden"  name="te03"  id='te03' class="input-field" value="<? print "$row[te03]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb04"  id='tb04' class="input-field" value="<? print "$row[tb04]"; ?>" />
				<input type="hidden"  name="te04"  id='te04' class="input-field" value="<? print "$row[te04]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb05"  id='tb05' class="input-field" value="<? print "$row[tb05]"; ?>" />
				<input type="hidden"  name="te05"  id='te05' class="input-field" value="<? print "$row[te05]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb06"  id='tb06' class="input-field" value="<? print "$row[tb06]"; ?>" />
				<input type="hidden"  name="te06"  id='te06' class="input-field" value="<? print "$row[te06]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb07"  id='tb07' class="input-field" value="<? print "$row[tb07]"; ?>" />
				<input type="hidden"  name="te07"  id='te07' class="input-field" value="<? print "$row[te07]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb08"  id='tb08' class="input-field" value="<? print "$row[tb08]"; ?>" />
				<input type="hidden"  name="te08"  id='te08' class="input-field" value="<? print "$row[te08]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb09"  id='tb09' class="input-field" value="<? print "$row[tb09]"; ?>" />
				<input type="hidden"  name="te09"  id='te09' class="input-field" value="<? print "$row[te09]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb10"  id='tb10' class="input-field" value="<? print "$row[tb10]"; ?>" />
				<input type="hidden"  name="te10"  id='te10' class="input-field" value="<? print "$row[te10]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb11"  id='tb11' class="input-field" value="<? print "$row[tb11]"; ?>" />
				<input type="hidden"  name="te11"  id='te11' class="input-field" value="<? print "$row[te11]"; ?>" /></td>
				
				<td align="center" >
				<input type="hidden"  name="tb12"  id='tb12' class="input-field" value="<? print "$row[tb12]"; ?>" />
				<input type="hidden"  name="te12"  id='te12' class="input-field" value="<? print "$row[te12]"; ?>" /></td>
						
			</tr>	
			
			</table><br><br>
	
	<center><div class='codehim-tombol-biru'>
        <input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" >
     </div>
	 </center> 
	
    </form>
	</div></div></center>
<br>

<script>
function isitanggal(y){
	var s = $('input[name='+y+']').attr('checked');
	if( s == 'checked' ){
	now = new Date();
const offsetMs = now.getTimezoneOffset() * 60 * 1000;
const dateLocal = new Date(now.getTime() - offsetMs);
str = dateLocal.toISOString().slice(0, 19).replace(/-/g, "-").replace("T", " ");
	document.getElementById('t'+y).value = str;	
	} else {
	document.getElementById('t'+y).value = '';	
	}
	}
</script>
