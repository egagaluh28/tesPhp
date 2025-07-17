<?php
include "../application/connect.php";

$kdprogram = $_GET['kdprogram'];
$giat = mysql_query("select kdgiat, nmgiat from t_giat where kdprogram = '$kdprogram'  order by kdgiat");
echo "<option value='' selected>-- Pilih Giat --</option>";
while($m = mysql_fetch_array($giat)){
     echo "<option value=\"".$m['kdgiat']."\">".$m['kdgiat']." | ".$m['nmgiat']."</option>\n";
}

?>



                     