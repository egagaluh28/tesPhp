<?php
include  "../../application/connect.php";

$kdprogram  = $_GET['kdprogram'];
$kdgiat 	= $_GET['kdgiat'];

$output = mysql_query("select * from t_output where  kdgiat = '$kdgiat'  order by kdoutput");
echo "<option value='' selected>-- Pilih Output --</option>";
while($m = mysql_fetch_array($output)){
     echo "<option value=\"".$m['kdoutput']."\">".$m['kdoutput']." | ".$m['nmoutput']."</option>\n";
}

?>



                     