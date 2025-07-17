<?php
session_start();
if ($_SESSION['kdtingkat']=='01') {
?><script language="JavaScript">; document.location='media.php?module=dashboard'</script><?php 
} else if ($_SESSION['kdtingkat']=='02') {	
?><script language="JavaScript">; document.location='media.php?module=dashboard_ktm'</script><?php 
} else {
?><script language="JavaScript">; document.location='media.php?module=dashboard_uo'</script><?php 	
}
?>
