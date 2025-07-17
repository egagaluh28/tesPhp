<?php
include "../application/connect.php";

$kdoutput = $_GET['kdoutput'];
$akun = mysql_query("select a.kdoutput, a.kdakun, b.nmakun from t_sakun a left join t_akun b on a.kdakun=b.kdakun 
where a.kdoutput = '$kdoutput'  group by a.kdakun order by a.kdakun");
echo "<option value='' selected>-- Pilih Akun --</option>";
while($m = mysql_fetch_array($akun)){
     echo "<option value=\"".$m['kdakun']."\">".$m['kdakun']." | ".$m['nmakun']."</option>\n";
}

?>



                     