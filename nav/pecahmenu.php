<?php
session_start();
include "application/connect.php";


$tingkat=$_SESSION['kdtingkat'];

switch ($tingkat) {
case "00"   	: include "nav/menuadmin.php";break;
case "01"   	: include "nav/menusatker.php";break;
case "02"   	: include "nav/menukotama.php";break;
case "0201"   	: include "nav/menuwasgiatkotama.php";break;
case "0202"   	: include "nav/menuwasgiatkotama.php";break;
case "0203"   	: include "nav/menuwasgiatkotama.php";break;
case "0204"   	: include "nav/menuwasgiatkotama.php";break;
case "0205"   	: include "nav/menuwasgiatkotama.php";break;
case "0207"   	: include "nav/menuwasgiatkotama.php";break;
case "03"   	: include "nav/menuuo.php";break;
case "0301"   	: include "nav/menuwasgiatuo.php";break;
case "0302"   	: include "nav/menuwasgiatuo.php";break;
case "0303"   	: include "nav/menuwasgiatuo.php";break;
case "0304"   	: include "nav/menuwasgiatuo.php";break;
case "0305"   	: include "nav/menuwasgiatuo.php";break;
case "0307"   	: include "nav/menuwasgiatuo.php";break;
}
?>