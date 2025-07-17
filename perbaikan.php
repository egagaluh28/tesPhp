<style>
.button-3d {
  position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #f39c12;
  background:#e67e22;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #d35400;
  -moz-box-shadow: 0px 6px 0px #d35400;
  box-shadow: 0px 6px 0px #d35400;
}

.button-3d:active{
    -webkit-box-shadow: 0px 2px 0px #d35400;
    -moz-box-shadow: 0px 2px 0px #d35400;
    box-shadow: 0px 2px 0px #d35400;
    position:relative;
    top:4px;
}

.button-3d:hover{
   position:relative;
  width: auto;
  display:inline-block;
  color:#ecf0f1;
  text-decoration:none;
  border-radius:5px;
  border:solid 1px #47ba0f;
  background:#5e8b0f;
  text-align:center;
  padding:16px 18px 14px;
  margin: 12px;
  cursor:pointer;
 font-family: "Geneva", sans-serif;
	font-size: 25px;
  
  -webkit-transition: all 0.1s;
	-moz-transition: all 0.1s;
	transition: all 0.1s;
	
  -webkit-box-shadow: 0px 6px 0px #377b15;
  -moz-box-shadow: 0px 6px 0px #377b15;
  box-shadow: 0px 6px 0px #377b15;
}



#border__{
width:700px;
float: center;
border:  solid #999 1px;
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 1px 1px #ccc; 
-moz-box-shadow: 0 1px 1px #ccc; 
box-shadow: 0 5px 1px #333; 
padding: 10px;
font-size: 16px;
color:#666;
font-family: "Montserrat", sans-serif;

}

</style>
 
<br>
<?

//print "$_SESSION[kdkotama] $_SESSION[kdsatker]";


//$sql= mysql_query("select * from t_satkr where kdkotama='$_SESSION[kdkotama]' and kdsatkr='$_SESSION[kdsatker]' ");
//$x = mysql_fetch_array($sql);

//$satker=strtoupper($x[nmsatkr]);

print "<center><span class='judulcontent'>APAKAH ANDA AKAN MEMPERBAIKI DATA </center><br><br>";
?>
<center><div id="border__">
<img src="images/copy1.gif" width="300"><br>
<form action="" method="POST"  name="form1">  
<input class="button-3d" type="submit"  name="btkosong" value="PERBAIKI DATA" >
</form>
</center>
<?
session_start();


if(isset($_POST['btkosong'])) {

$sql= mysql_query("delete from dipa where kdgiat='' or kdoutput='' or kdakun='' or kdsakun='' ");


?><script language="JavaScript">;
document.location='<? print "media.php?module=perbaikanberhasil"; ?>'</script><?
}

?>