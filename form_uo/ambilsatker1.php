<?php
include "../application/connect.php";

$kdkotama1 = $_GET['kdkotama1'];
$skr = mysql_query("select kdsatkr, nmsatkr from t_satkr where kdkotama = '$kdkotama1'  order by kdsatkr");
echo "<option value='' selected>-- Pilih Satker --</option>";
while($m = mysql_fetch_array($skr)){
     echo "<option value=\"".$m['kdsatkr']."\">".$m['kdsatkr']." | ".$m['nmsatkr']."</option>\n";
}

?>



                     