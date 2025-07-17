<style>
#bdr{
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
font-family: 'arial',  sans-serif;
}
</style>	
<? 
	$edit = mysql_query("SELECT * FROM lamp_laplakgar where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'");
    $row    = mysql_fetch_array($edit);
?>	
<br>
<center><span class="judulcontent">LAMPIRAN LAPLAKGAR</span></center><br>
<center><div id="bdr" ><div class="form-style-2">
    <?php
	print "<div class='codehim-tombol-biru'>";
	print "<table  width='80%' align='center'   cellpadding='3' >";
	print  	"<tr ><td>
				<a href='media.php?module=inputlampiran' style='text-decoration:none'><input  type='button' value='Tambah' /></a>&nbsp;&nbsp;
				<a href='media.php?module=editlampiran&id=$row[id]' style='text-decoration:none'><input  type='button' value='Ubah' /></a>&nbsp;&nbsp;
				<a href=\"pengelola/lampiran/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS KOPSTUK ? ')\" style='text-decoration:none'><input  type='button' value='Hapus' /></a>
		</td></tr></table></div><br>";
	?>	

    <table width="80%" align="center" cellpadding="3">

			<tr>
				<td width="200" align="right" class="subyek1">Lampiran :</td>
			    <td valign="top" ><input name="brs1" type="text"  size="50" class="input-field"  readonly
				<? print "value='$row[brs1]'"; ?> /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1">Nomor :</td>
				<td valign="top" ><input name="brs2" type="text" size="50" class="input-field" readonly
				<? print "value='$row[brs2]'"; ?> /></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">Tanggal :</td>
			    <td valign="top" ><input name="brs3" type="text"  size="50" class="input-field" readonly
				<? print "value='$row[brs3]'"; ?> /></td>
				
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">Panjang Garis :</td>
				<td valign="top" ><input name="panjang_grs" type="text" size="5" class="input-field" readonly
				<? print "value='$row[panjang_grs]'"; ?> /></td>
		    </tr>
			
			<tr>
				<td  align="right" class="subyek1">Posisi Text :</td>
				<td valign="top" ><input name="posisi_grs" type="text" size="5" class="input-field" readonly
				<? print "value='$row[posisi_grs]'"; ?> /></td>
		    </tr>
			
			
		</table> </div></div></center>
<br> 
	
	


