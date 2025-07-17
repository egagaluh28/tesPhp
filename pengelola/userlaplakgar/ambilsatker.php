<?php
include "../../application/connect.php";

$kdkotama = $_GET['kdkotama'];
$rumkit = mysql_query("select kdsatkr, nmsatkr from t_satkr where kdkotama = '$kdkotama' order by kdsatkr");
echo "<option value='000000' selected>-- Pilih Satker --</option>";
while($k = mysql_fetch_array($rumkit)){
    echo "<option value=\"".$k['kdsatkr']."\">".$k['kdsatkr']." | ".$k['nmsatkr']."</option>\n";
}
?>


                     