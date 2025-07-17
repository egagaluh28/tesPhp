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
<?php 

	$ambil=mysql_query("SELECT * FROM tajuk_ttd where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'");
    $row    = mysql_fetch_array($ambil);
	
?>	
<br>
<center><span class="judulcontent">TAJUK TANDA TANGAN</span></center><br>
	<center><div id="bdr" ><div class="form-style-2">
    <?php
	print "<div class='codehim-tombol-biru'>";
	print "<table  width='80%' align='center'   cellpadding='3' >";
	print  	"<tr ><td>
				<a href='media.php?module=inputttd' style='text-decoration:none'><input  type='button' value='Tambah' /></a>&nbsp;&nbsp;
				<a href='media.php?module=editttd&id=$row[id]'style='text-decoration:none'><input  type='button' value='Ubah' /></a>&nbsp;&nbsp;
				<a href=\"pengelola/ttd/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS KOPSTUK ? ')\" style='text-decoration:none'><input  type='button' value='Hapus' /></a>
		</td></tr></table></div><br>";
	?>	

    <table width="80%" align="center" cellpadding="3">

			<tr>
				<td align="right" class="subyek1">TEMPAT :</td>
			    <td valign="top" ><input name="tempat" type="text"  size="30" class="input-field" required="required" <? print "value='$row[tempat]'"; ?> readonly /></td>
			</tr>
			
			<tr>
				<td  align="right" class="subyek1">TANGGAL :</td>
				<td valign="top" ><input name="tanggal" type="text" size="30" class="input-field" required="required" <? print "value='$row[tanggal]'"; ?> readonly /></td>
		    </tr>
			
			
			<tr>
				<td  align="right" class="subyek1">ATAS NAMA :</td>
			    <td valign="top" ><input name="an" type="text"  size="30" class="input-field"  <? print "value='$row[an]'"; ?> readonly /></td>
			</tr>
			<tr>
				<td  align="right" class="subyek1"></td>
				<td valign="top" ><input name="pejabat1" type="text" size="30" class="input-field"  <? print "value='$row[pejabat1]'"; ?> readonly /></td>
		    </tr>
			<tr>
				<td height="40"></td>
				<td></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">NAMA PENANDA TANGAN :</td>
				<td valign="top" ><input name="nama" type="text" size="30" class="input-field" required="required" <? print "value='$row[nama]'"; ?> readonly /></td>
		    </tr>
			<tr>
				<td  align="right" class="subyek1">PANGKAT / CORPS / NRP :</td>
				<td valign="top" ><input name="pkt_crp" type="text" size="30" class="input-field" required="required" <? print "value='$row[pkt_crp]'"; ?> readonly /></td>
		    </tr>
			
			
		</table></div></div><center><br> 
	
	


