<?php

	if (file_exists('proses_cari_autosuggest.php'))
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename('proses_cari_autosuggest.php'));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: private');
		header('Pragma: private');
		header('Content-Length: ' . filesize('proses_cari_autosuggest.php'));
		ob_clean();
		flush();
		readfile('proses_cari_autosuggest.php');
		exit;
	}
?>

