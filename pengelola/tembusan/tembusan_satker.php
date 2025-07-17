<html>
<head>
<title>badan kesehatan bentuk dy4</title>
<style>
#bdr{
width:1000px;
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
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />

<script src="library/jquery.js"></script>
<link href="thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="thickbox/thickbox.js"></script>

<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>INPUT TEMBUSAN</td></tr></table><br>

<center><div id="bdr">
<div class="form-style-2">
	
<form  method="POST"  name="form1" action="pengelola/tembusan/proses.php?aksi=simpan">  

    <table width="80%" align="center" cellpadding="5">

			<tr>
				<td class='subyek1' align='right'>NO URUT :</td>
			    <td><input name='urut'  type='text' size='4' class='select-field' required >&nbsp;
				    <input name='nama'  type='text'  class='select-field' size='40' required >
					<input type="hidden"  name="kdsatker"  value=<? print "$_SESSION[kdsatker]"; ?> />
					<input type="hidden"  name="kdkotama"  value=<? print "$_SESSION[kdkotama]"; ?> />
			</tr>
		</table><br> 
	
	<center><div class='codehim-tombol-biru'>
        <input  type="submit" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" >
     </div>
	 </center> 
    </form>
	
<?php
	


	$no=1;
	
	print "<table width='50%'  cellspacing='0' cellpadding='2' align='center' class='bordered'>";
	print "<tr bgcolor='#dce9f9' height='30'>";
	print    "<td   align='center'>NO</td>";
	print    "<td   align='center'>URUT<br>TAMPIL</td>";
	print    "<td   align='center'>NAMA</td>";
	print    "<td   colspan='2' align='center' valign='middle'>AKSI</td>";
	print "</tr>";

	$sql="SELECT * FROM tembusan  where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and urut<>'99' order by urut"; 
    $qry=mysql_query($sql);
	
	

	while ($row=mysql_fetch_array($qry)) {
	
	
		
	print "<tr ><td align='center'>$no.</td>";
	
    print "<td align='center'>$row[urut]</td>";	
	print "<td >$row[nama]</td>";
    print "<td align='center'><a href='pengelola/tembusan/edit.php?&idtembusan=$row[idtembusan]&width=800&height=350' class='thickbox'><img src='images/edit.png' width='20' title='Edit'></a></td>";
	print"<td  align='center' valign='top'><a href=\"pengelola/tembusan/proses.php?aksi=hapus&idtembusan=$row[idtembusan]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS TEMBUSAN ~ $row[nama] ~ ? ')\" ><img src='images/delete.png' width='20' ></td>"; 
    $no++;

 	}
	  
    
	 print "</table><br>";
	 
	 $edit = mysql_query("SELECT count(urut) as jurut, idtembusan, kdkotama, kdsatker, urut, nama FROM tembusan  where kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and urut='99'  group by urut");
     $data    = mysql_fetch_array($edit);


if ($data[jurut]>'0') {
print "<form action='pengelola/tembusan/proses.php?aksi=ubahgaris' method='POST'  name='form1'>";  	
} else {
print "<form action='pengelola/tembusan/proses.php?aksi=simpangaris' method='POST'  name='form1'>"; 	
}	

 
?>
<input name="idtembusan" type="hidden"  size="10"   <? print "value='$data[idtembusan]'"; ?> />
<input type="hidden"  name="kdsatker"  value=<? print "$_SESSION[kdsatker]"; ?> />
<input type="hidden"  name="kdkotama"  value=<? print "$_SESSION[kdkotama]"; ?> />
    <table width="80%" align="center" cellpadding="5">
			<tr>
				<td   class="subyek1" align="center"><div class='codehim-tombol-biru'>PANJANG GARIS BAWAH UNTUK TEMBUSAN :
			    <input name="panjang" type="text"  style='text-align: center;' size="4" class="select-field"  <? print "value='$data[nama]'"; ?> maxlength="3"/>
				&nbsp;<input type="submit"  name="ganti" value="Ubah" ></div></td>
			</tr>
		</table><br> 
    </form>

</div></div>	
<br><br>