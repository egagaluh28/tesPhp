<?php
include "../application/connect.php";

$kdkotama = $_GET['kdkotama'];
$skr = mysql_query("select kdsatkr, nmsatkr from t_satkr where kdkotama = '$kdkotama'  order by kdsatkr");
echo "<option value='' selected>-- Pilih Satker --</option>";
while($m = mysql_fetch_array($skr)){
     echo "<option value=\"".$m['kdsatkr']."\">".$m['kdsatkr']." | ".$m['nmsatkr']."</option>\n";
}

?>



                     