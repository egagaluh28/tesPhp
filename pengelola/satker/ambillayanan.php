<?php
include "../../application/connect.php";
session_start();
$kdsatkr = $_GET['kdsatkr'];
$kdkotama = $_GET['kdkotama'];

$rumkit = mysql_query("select distinct b.layanan from t_subsatkr a 
left join t_satkr b on a.kdsatkr=b.kdsatkr and a.kdkotama=b.kdkotama   where a.kdsatkr = '$kdsatkr'  order by layanan");
//echo "<option value='' selected>-- Pilih layanan --</option>";
while($k = mysql_fetch_array($rumkit)){
    echo "<option value=\"".$k['layanan']."\">".$k['layanan']."</option>\n";
}
?>


                     