<style>
.roundd  {
    
	border: 1px solid #ccc;
	
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 4px;
	-moz-box-shadow: 2px 2px 3px #666;
	-webkit-box-shadow: 2px 2px 3px #666;
	box-shadow: 2px 2px 3px #666;
	Geneva, sans-serif;
	color:#999;
	font-size: 35px;
	padding: 14px 17px;
	outline: 0;
	-webkit-appearance: none;
	
}

input#round{
width:100px; /*same as the height*/
height:100px; /*same as the width*/
background-color:#ff0000;
border:1px solid #ff0000; /*same colour as the background*/
color:#fff;
font-size:1.6em;
/*set the border-radius at half the size of the width and height*/
-webkit-border-radius: 50px;
-moz-border-radius: 50px;
border-radius: 50px;
/*give the button a small drop shadow*/
-webkit-box-shadow: 0 0 10px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 10px rgba(0,0,0, .75);
box-shadow: 2px 2px 15px rgba(0,0,0, .75);
cursor : pointer;
}
/***NOW STYLE THE BUTTON'S HOVER STATE***/
input#round:hover{
background:#c20b0b;
border:1px solid #c20b0b;
/*reduce the size of the shadow to give a pushed effect*/
-webkit-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
-moz-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
box-shadow: 0px 0px 5px rgba(0,0,0, .75);
cursor : pointer;
}

#borderku5{
width:700px;
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
font-family: "Geneva", sans-serif;

}


</style>
<?php
//Set maximum rows per page ambil dari field nilai pada tajuk tanda tangan
$brsttd=mysql_query("SELECT * from baris where id='1' "); 
$n = mysql_fetch_array($brsttd);
?>
<center>
<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>RAPIKAN TAJUK TANDA TANGAN</td></tr></table><br><br>
<div id="borderku5" >
<form name="form1"  method="POST" action="pengelola/ttd/proses.php?aksi=rapikanttd">
<br><input name="baris" type="text" size="6" class="roundd"  style="text-align: center;"  <? print "value='$n[baris]'" ?> /><br><br><br><br>
<input  type="submit" value="Save" id="round"/>
</form>
</center>
</div>
