<?php
mysql_connect("localhost","root","") or die("Koneksi gagal");
mysql_select_db("dblaplakgar2024") or die("Database tidak bisa dibuka");

	
	print "<table border=1>";
	print "<tr  height='35'>";
	print    "<th   align='center'   >KODE </th>";
	print    "<th   align='center'   >URAIAN</th>";
	print "</tr>";

	$sql="select * FROM t_bulan"; 
	$qry=mysql_query($sql);
	

	$no=1;
	while ($row=mysql_fetch_array($qry)) {
	
	
 
	
	print "<td align='center'>$row[kdbulan]</td>";
	print "<td >$row[nmbulan]</td>";
	
		
    print "</tr>"; 
 
  
 	}
	

    print "</table><br>";

 
	
	
?>
			