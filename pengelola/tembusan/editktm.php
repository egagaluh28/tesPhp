<html>
<head>
<title>badan kesehatan bentuk dy4</title>
<br><br>
<style>
#bdr{
width:600px;
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
    include "../../application/connect.php";
	
	$edit = mysql_query("SELECT * FROM tembusan WHERE   idtembusan='$_GET[idtembusan]'");
    $x    = mysql_fetch_array($edit);
?>	
<table  width='40%' align='center' ><tr><td class='judulcontent' align='center'>EDIT TEMBUSAN</td></tr></table><br>

<center><div id="bdr">
<div class="form-style-2">
<form action="pengelola/tembusan/proses.php?aksi=ubahktm" method="POST"  name="form1">  

    <table width="40%" align="center" cellpadding="5">
<input name="idtembusan" type="hidden"  size="1" class="roundedisi"  <? print "value='$x[idtembusan]'"; ?> />
			
		<? print "<tr>
			<td><input type='text' name='urut'  size='4'  style='text-align: center;' class='input-field' value='$x[urut]'></td>
			<td><input type='text' name='nama' size='35'  class='input-field' value='$x[nama]'></td>
	    </tr></table>"; ?><br>
		
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td width="150" align="center"><input type="submit"  value="Simpan" class="button blue"></td>
				 <td width="150" align="center"><input type="reset"  value="&nbsp;&nbsp;Batal&nbsp;&nbsp;" onclick="self.history.back()" class="button blue"></td>
			</tr></table><br>
	
    </form></div></div></center>
