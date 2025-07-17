<style>
 
/**
Button 1
*/
 
.button1 {
 
    font-family:  Raleway;
    font-size: 24px;
    color: #FFF;
    padding: 15px 20px 15px 20px;
    border: solid 1px #CCC;
 
    background: #ba4742;
    text-shadow: 0px 1px 0px #000;
 
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
 
    box-shadow: 0 1px 3px #111;
    -moz-box-shadow: 3px 3px 1px #999;
    -webkit-box-shadow: 3px 3px 1px #999;
 
    cursor: pointer;
 
}
.button1:hover {
    background: #a33f3a;
}
</style>
 
<br><br>
<?php

print "<center><span class='judul'>PENAMBAHAN TABEL PENGAWASAN GAJI DAN TUNKIN</center><br><br>";
?>
<br>
<center>
<form action="" method="POST"  name="form1">  
<input type="submit"  name="btperbaiki" value="PERBAIKI TABEL" class="button1">
</form>
</center>
<?
session_start();


if(isset($_POST['btperbaiki'])) {

$sql=mysql_query("DROP TABLE t_akun_gaji");	
$sql=mysql_query("CREATE TABLE IF NOT EXISTS t_akun_gaji (
  `kdakun` char(6) DEFAULT NULL,
  `nmakun` varchar(100) DEFAULT NULL 
) ENGINE=MyISAM DEFAULT CHARSET=latin1");

$sql=mysql_query("INSERT INTO `t_akun_gaji` (`kdakun`, `nmakun`) VALUES
('511161', 'Bel. Gaji Pokok PNS TNI/Polri'),
('511169', 'Bel. Pembulatan Gaji PNS TNI/Polri'),
('511171', 'Bel. Tunj. Suami/Istri PNS TNI/Polri'),
('511172', 'Bel. Tunj. Anak PNS TNI/Polri'),
('511173', 'Bel. Tunj. Struktural PNS TNI/Polri'),
('511174', 'Bel. Tunj. Fungsional PNS TNI/Polri'),
('511175', 'Bel. Tunj. PPh PNS TNI/Polri'),
('511176', 'Bel. Tunj. Beras PNS TNI/Polri'),
('511179', 'Bel. Uang Makan PNS TNI/Polri'),
('511185', 'Bel. Tunj. Daerah Terpenci PNS TNI/Polri'),
('511189', 'Bel. Tunj Khusus Papua PNS TNI/Polri'),
('511191', 'Bel. Tunj Medis PNS TNI/POLRI'),
('511192', 'Bel. Tunj. Uang Duka PNS TNI/POLRI'),
('511193', 'Bel. Tunj. Umum PNS TNI/Polri'),
('511194', 'Bel. Tunj. Komp Kerja Sandi PNS TNI/Polri'),
('511195', 'Bel. Tunj. Ops Pamtas PNS TNI'),
('511211', 'Bel. Gaji Pokok TNI/POLRI'),
('511219', 'Pembulatan Gaji TNI/POLRI'),
('511221', 'Bel. Tunj. Suami/Istri TNI/POLRI'),
('511222', 'Bel. Tunj. Anak TNI/POLRI'),
('511223', 'Bel. Tunj. Struktural TNI/POLRI'),
('511224', 'Bel. Tunj. Fungsional TNI/POLRI'),
('511225', 'Bel. Tunj. PPh TNI/POLRI'),
('511226', 'Bel. Tunj. Beras TNI/POLRI'),
('511227', 'Bel. Tunj. Kemahalan TNI/POLRI'),
('511228', 'Tunj. Lauk pauk TNI/POLRI'),
('511232', 'Bel. Tunj. Kowan/Polwan TNI TNI/POLRI'),
('511233', 'Bel. Tunj. Babinkamtibmas TNI/POLRI'),
('511234', 'Bel. Tunj. Khusus Papua untuk TNI/ POLRI'),
('511235', 'Bel. Tunj. Komp. Kerja Sandi TNI/POLRI'),
('511238', 'Bel. Tunj. Keterampilan Khusus TNI/POLRI'),
('511239', 'Bel. Tunj. Ops Pamtas TNI'),
('511241', 'Bel. Tunj. Medis TNI/POLRI'),
('511242', 'Bel. Tunj. uang duka TNI/POLRI'),
('511243', 'Bel. Tunjangan Terpencil TNI/Polri'),
('511244', 'Bel. Tunjangan Umum TNI/Polri'),
('511245', 'Bel. Tunjangan Cacat dan Santunan TNI/Polri'),
('512411', 'Tunjangan Kineja');");
print "<br><br><center><img src='images/perbaikanberhasil.gif'></center>";
}

?>