<?php
include "../application/connect.php";

$kdgiat = $_GET['kdgiat'];
$output = mysql_query("select kdoutput, nmoutput from t_output where kdgiat = '$kdgiat'  order by kdoutput");
echo "<option value='' selected>-- Pilih Output --</option>";
while($m = mysql_fetch_array($output)){
     echo "<option value=\"".$m['kdoutput']."\">".$m['kdoutput']." | ".$m['nmoutput']."</option>\n";
}

?>



                     