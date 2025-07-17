<?php
include "../../application/connect.php";

$kdfungsi = $_GET['kdfungsi'];
$sfung = mysql_query("select kdsfungsi, nmsfungsi from t_sfungsi where kdfungsi = '$kdfungsi'  order by kdsfungsi");
echo "<option value='' selected>-- Pilih Sub Fungsi --</option>";
while($mk = mysql_fetch_array($sfung)){ 
     echo "<option value=\"".$mk['kdsfungsi']."\">".$mk['kdsfungsi']." | ".$mk['nmsfungsi']."</option>\n";
}

?>



                     