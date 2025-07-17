<?php
include "../../application/connect.php";

$kdgiat = $_GET['kdgiat'];
$kdakun = $_GET['kdakun'];
//$kdoutput = $_GET['kdgiat']; 




$sakun = mysql_query("select kdsakun, nmsakun from t_sakun where kdakun = '$kdakun'   order by kdsakun");
echo "<option value='' selected>-- Pilih Sub Akun --</option>";
while($m = mysql_fetch_array($sakun)){
     echo "<option value=\"".$m['kdsakun']."\">".$m['kdsakun']." | ".$m['nmsakun']."</option>\n";
}

?>



                     