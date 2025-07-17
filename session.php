<?php
session_start();
if (!session_is_registered("usernamelaplakgar")) {
	header('location:index.php'); 
	exit;
	}
?> 
