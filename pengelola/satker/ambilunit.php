<?php
include "../../application/connect.php";

$kddept = $_GET['kddept'];
$unit = mysql_query("select kdunit, nmunit from t_unit where kddept = '$kddept'  order by kdunit");
echo "<option value='' selected>-- Pilih Unit --</option>";
while($mk = mysql_fetch_array($unit)){ 
     echo "<option value=\"".$mk['kdunit']."\">".$mk['kdunit']." | ".$mk['nmunit']."</option>\n";
}

?>



                     