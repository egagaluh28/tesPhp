<?php
include "../../application/connect.php";

$kdkotama = $_GET['kdkotama'];
$pekas = mysql_query("SELECT a.*, b.nmkukotama, c.kdkotama FROM t_kusatker a 
					  left join t_kukotama b on a.kdkukotama=b.kdkukotama
					  left join t_kotam c on b.kdkukotama=c.kdkukotama
					  where c.kdkotama ='$kdkotama'  order by a.kdkusatker");
echo "<option value='' selected>-- Pilih Ku Satker --</option>";
while($m = mysql_fetch_array($pekas)){
     echo "<option value=\"".$m['kdkukotama'].$m['kdkusatker']."\">".$m['kdkukotama']." | ".$m['kdkusatker']." | ".$m['nmkusatker']."</option>\n";
}

?>



                     