<?php
	function tgl_indoangka($tg){
			$tanggal = substr($tg,8,2);
			$bulan = getBulanangka(substr($tg,5,2));
			$tahun = substr($tg,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
	}	

	function getBulanangka($bulan){
				switch ($bulan){
					case 1:  
						return "01";
						break;
					case 2:
						return "02";
						break;
					case 3:
						return "03";
						break;
					case 4:
						return "04";
						break;
					case 5:
						return "05";
						break;
					case 6:
						return "06";
						break;
					case 7:
						return "07";
						break;
					case 8:
						return "08";
						break;
					case 9:
						return "09";
						break;
					case 10:
						return "10";
						break;
					case 11:
						return "11";
						break;
					case 12:
						return "12";
						break;
				}
			} 
?>
