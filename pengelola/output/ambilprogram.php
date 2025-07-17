<?php
include "../../application/connect.php";

$kdsfungsi = $_GET['kdsfungsi'];
$program = mysql_query("select kdprogram, nmprogram from t_program where kdsfungsi = '$kdsfungsi'  order by kdprogram");
echo "<option value='' selected>-- Pilih Program --</option>";
while($m = mysql_fetch_array($program)){
     echo "<option value=\"".$m['kdprogram']."\">".$m['kdprogram']." | ".$m['nmprogram']."</option>\n";
}

?>



                     