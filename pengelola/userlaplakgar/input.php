<script type="text/javascript" src="library/jquery.js"></script>
<script language="JavaScript">

var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kdkotama>
  $("#kdkotama").change(function(){
    var kdkotama = $("#kdkotama").val();
    $.ajax({
        url: "pengelola/userlaplakgar/ambilsatker.php",
        data: "kdkotama="+kdkotama,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kdsatkr>
            $("#kdsatker").html(msg);
        }
    });
  });  
}); 
 
</script> 
<style>
#bdr{
width:1100px;
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
<br>
<center><span class="judul">INPUT DATA USER</span></center><br>

<center><div id="bdr">
<div class="form-style-2">
<form action="pengelola/userlaplakgar/proses.php?aksi=simpan" method="POST"  name="form1">  

    <table width="650" align="center" cellpadding="3">

			<tr>
				<td width="150" align="right" class="subyek1">USERNAME :</td>
			    <td valign="top" ><input name="usernamelaplakgar" type="text"  size="40" class="input-field" required="required" /></td>
			</tr>
			<tr>
				<td width="150" align="right" class="subyek1">PASSWORD :</td>
				<td valign="top" ><input name="passwordlaplakgar" type="password" size="40" class="input-field" required="required" /></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">KOTAMA :</td>
				<td valign="top" ><?
						print "<select name='kdkotama'  id='kdkotama' class='select-field'  >
						<option value='00' selected>- - - - - - - Pilih - - - - - - -</option>";
						 $sql="select kdkotama, nmkotama from t_kotam  order by kdkotama asc";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 echo "<option value=\"".$data['kdkotama']."\">".$data['nmkotama']."</option>\n";
					   }
				    
			print "</select>"; ?></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">SATKER :</td>
				<td valign="top" ><?
									print "<select name='kdsatker'  id='kdsatker' class='select-field'   >
											<option value='000000' selected> - - Pilih - - </option>";					
									print "</select>"; ?></td>
		    </tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">NAMA LENGKAP :</td>
				<td valign="top" ><input name="nama_lengkap" type="text" size="40" class="input-field" required="required" /></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">TELP / NO HP :</td>
				<td valign="top" ><input name="telp" type="text" size="40" class="input-field" required="required" /></td>
			</tr>
			
			<tr>
				<td width="150" align="right" class="subyek1">TINGKAT :</td><td valign="top" >
					<?	print "<select name='kdtingkat'   class='select-field'  required='required'>
						<option value='00' selected>- - - - - - - Pilih - - - - - - -</option>";
						 $sql="select kdtingkat, pengguna from t_tingkat  order by kdtingkat asc";
						 $qry=mysql_query($sql);
						 while ($data=mysql_fetch_array($qry)){
						 echo "<option value=\"".$data['kdtingkat']."\">".$data['pengguna']."</option>\n";
					   }
				    
			print "</select>"; ?>
										</select></td>
				</tr>
				
				<tr>
				<td width="150" align="right" class="subyek1">LEVEL :</td><td valign="top" >
				<select name="level" class="select-field" required="required" >
										
												<?
												
												if ($_POST['level'] == "user") echo "<option value='user' selected>user</option>";
												else echo "<option value='user'>user</option>"; 
												
												if ($_POST['level'] == "admin") echo "<option value='admin' selected>admin</option>";
												else echo "<option value='admin'>admin</option>";

												?>
										</select></td>
				</tr>
	
		</table><br> 
	
	<table  width="300" align="center"   cellpadding="3">
			<tr>
				 <td><div class='codehim-tombol-biru'><input  type="submit" value="Simpan"   />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input type="button" value="&nbsp;&nbsp;Batal&nbsp;&nbsp" onclick="self.history.back()" ></div>  
				 </td>	
			</tr></table>
	
    </form></div></div></center><br>


