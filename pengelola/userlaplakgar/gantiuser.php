

<style>
#bdr{
width:800px;
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
	$edit = mysql_query("SELECT * FROM userlaplakgar where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]'");
    $row    = mysql_fetch_array($edit);
?>	

<br>
<center><span class="judulcontent">GANTI PASSWORD</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<form action="pengelola/userlaplakgar/proses.php?aksi=gantiuser" method="POST"  name="form1">  

    <table width="650" align="center" cellpadding="2">

			
			<tr>
				<td width="250" align="right" class="subyek1">PASSWORD BARU :</td>
				<td valign="top" ><input name="passwordlaplakgar" type="password" size="40" class="input-field" /></td>
		    </tr>
			<tr>
				<td width="250" align="right" class="subyek1"><input name="id" type="hidden" class="rounded" 
				<? print "value='$row[id]'"; ?>/></td>
				<td valign="top" class="subyek1"></td>
		    </tr>
			
		    </tr>
			
			<tr>
				<td width="250" align="right" class="subyek1">NAMA LENGKAP :</td>
				<td valign="top" ><input name="nama_lengkap" type="text" size="40" class="input-field" <? print "value='$row[nama_lengkap]'"; ?>/></td>
			</tr>
			
			<tr>
				<td width="250" align="right" class="subyek1">TELP / NO HP :</td>
				<td valign="top" ><input name="telp" type="text" size="40" class="input-field" <? print "value='$row[telp]'"; ?>/></td>
			</tr>
			
			

		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>  
			</tr></table>
    </form>
</div></div></center>

