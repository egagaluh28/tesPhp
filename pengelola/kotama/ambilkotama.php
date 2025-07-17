<?php
include "../../gar_config/koneksi.php";

$kdunit = $_GET['kdunit'];
$kotam = mysql_query("select kdkotama, nmkotama from t_kotam where kdunit = '$kdunit'  order by kdkotama");
echo "<option value='' selected>-- Pilih Kotama --</option>";
while($m = mysql_fetch_array($kotam)){
     echo "<option value=\"".$m['kdkotama']."\">".$m['kdkotama']." | ".$m['nmkotama']."</option>\n";
}

?>



                     