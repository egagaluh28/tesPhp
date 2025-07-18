<?php
// PERBAIKAN: Cek apakah sesi sudah dimulai sebelum memanggil session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// PERBAIKAN: Gunakan tanda kutip untuk kunci array string
$module=$_GET['module'];

switch ($module) {
case "dashboard"   				: include "dashboard/depan_satker_v2.php";break;
case "dashboard_ktm"   			: include "dashboard/depan_ktm_v2.php";break;
case "dashboard_uo"   			: include "dashboard/depan_uo_v2.php";break;


//pagu daerah
case "pagudipa"	 				: include "pagu/pagu.php";break;
case "inputpagudipa"	 		: include "pagu/input.php";break;
case "editpagudipa"	 			: include "pagu/edit.php";break;

case "pagukotama"	 			: include "pagu/pagukotama.php";break;
case "realisasi_ktm"	 		: include "realisasi/realisasi_ktm.php";break;

case "paguuo"	 				: include "pagu/paguuo.php";break;
case "realisasi_uo"	 			: include "realisasi/realisasi_uo.php";break;
case "realisasi_uo_wasgiat"		: include "realisasi/realisasi_uo_wasgiat.php";break;

case "formcetak_perwasgiat_daerah_satker"	 : include "realisasi/formcetak_perwasgiat_daerah_satker.php";break;

case "rekamdetaildipa"	 		: include "pagu/rekamdetail.php";break;

case "realisasi"	 			: include "realisasi/realisasi.php";break;
case "inputrealisasi"	 		: include "realisasi/input.php";break;
case "editrealisasi"	 		: include "realisasi/edit.php";break;
case "editlistrealisasi"	 	: include "realisasi/editlist.php";break;
case "realisasi_wasgiat"	 	: include "realisasi/realisasi_wasgiat.php";break; // realisasi satker
case "realisasi_ktm_wasgiat"	: include "realisasi/realisasi_ktm_wasgiat.php";break;

case "progrealisasi"	 		: include "realisasi/progrealisasi.php";break;
case "progrealisasi_ktm"	 	: include "realisasi/progrealisasi_ktm.php";break;
case "progrealisasi_uo"	 		: include "realisasi/progrealisasi_uo.php";break;

case "list_realisasi"	 		: include "realisasi/list_realisasi.php";break;
case "list_realisasi_bpjs"	 	: include "realisasibpjs/list_realisasi.php";break;
case "list_realisasi_yanmasum"	: include "realisasiyanmasum/list_realisasi.php";break;
case "list_realisasi_kapitasi"	: include "realisasikapitasi/list_realisasi.php";break;
case "list_realisasi_blu"	 	: include "realisasiblu/list_realisasi.php";break;
case "list_realisasi_hibah"	 	: include "realisasihibah/list_realisasi.php";break;
case "list_realisasi_sbsn"	 	: include "realisasisbsn/list_realisasi.php";break;

//PNBP BPJS
case "pagubpjs"	 				: include "bpjs/pagu.php";break;
case "inputpagubpjs"	 		: include "bpjs/input.php";break;
case "editpagubpjs"	 			: include "bpjs/edit.php";break;
case "rekamdetailbpjs"	 		: include "bpjs/rekamdetail.php";break;

case "realisasibpjs"	 		: include "realisasibpjs/realisasi.php";break;
case "inputrealisasibpjs"	 	: include "realisasibpjs/input.php";break;
case "editrealisasibpjs"	 	: include "realisasibpjs/edit.php";break;

//bpjs kotama
case "pagukotamabpjs"	 		: include "bpjs/pagukotamabpjs.php";break;
case "realisasi_ktm_bpjs"	 	: include "realisasibpjs/realisasi_ktm.php";break;

//bpjs uo
case "paguuobpjs"	 			: include "bpjs/paguuo.php";break;
case "realisasi_uo_bpjs"	 	: include "realisasibpjs/realisasi_uo.php";break;



//SBSN
case "pagusbsn"	 				: include "sbsn/pagu.php";break;
case "inputpagusbsn"	 		: include "sbsn/input.php";break;
case "editpagusbsn"	 			: include "sbsn/edit.php";break;
case "rekamdetailsbsn"	 		: include "sbsn/rekamdetail.php";break;

case "realisasisbsn"	 		: include "realisasisbsn/realisasi.php";break;
case "inputrealisasisbsn"	 	: include "realisasisbsn/input.php";break;
case "editrealisasisbsn"	 	: include "realisasisbsn/edit.php";break;

case "pagukotamasbsn"	 		: include "sbsn/pagukotama.php";break;
case "realisasi_ktm_sbsn"	 	: include "realisasisbsn/realisasi_ktm.php";break;

case "paguuosbsn"	 			: include "sbsn/paguuo.php";break;
case "realisasi_uo_sbsn"	 	: include "realisasisbsn/realisasi_uo.php";break;

//---------------------------------------------------------------------------------------------


//PNBP Yanmasum
case "paguyanmasum"	 				: include "yanmasum/pagu.php";break;
case "inputpaguyanmasum"	 		: include "yanmasum/input.php";break;
case "editpaguyanmasum"	 			: include "yanmasum/edit.php";break;
case "rekamdetailyanmasum"	 		: include "yanmasum/rekamdetail.php";break;

case "realisasiyanmasum"	 		: include "realisasiyanmasum/realisasi.php";break;
case "inputrealisasiyanmasum"	 	: include "realisasiyanmasum/input.php";break;
case "editrealisasiyanmasum"	 	: include "realisasiyanmasum/edit.php";break;

//yanmasum kotama
case "pagukotamayanmasum"	 		: include "yanmasum/pagukotama.php";break;
case "realisasi_ktm_yanmasum"	 	: include "realisasiyanmasum/realisasi_ktm.php";break;


//yanmasum uo
case "paguuoyanmasum"	 			: include "yanmasum/paguuo.php";break;
case "realisasi_uo_yanmasum"	 	: include "realisasiyanmasum/realisasi_uo.php";break;

//--------------------------------------------------------------------------------------------------

//BLU
case "pagublu"	 				: include "blu/pagu.php";break;
case "inputpagublu"	 		    : include "blu/input.php";break;
case "editpagublu"	 			: include "blu/edit.php";break;
case "rekamdetailblu"	 		: include "blu/rekamdetail.php";break;

case "realisasiblu"	 		    : include "realisasiblu/realisasi.php";break;
case "inputrealisasiblu"	 	: include "realisasiblu/input.php";break;
case "editrealisasiblu"	 	    : include "realisasiblu/edit.php";break;

//blu kotama
case "pagukotamablu"	 		: include "blu/pagukotama.php";break;
case "realisasi_ktm_blu"	 	: include "realisasiblu/realisasi_ktm.php";break;

case "paguuoblu"	 			: include "blu/paguuo.php";break;
case "realisasi_uo_blu"	 		: include "realisasiblu/realisasi_uo.php";break;
//----------------------------------------------------------------------------------------------------

//HIBAH
case "paguhibah"	 				: include "hibah/pagu.php";break;
case "inputpaguhibah"	 		    : include "hibah/input.php";break;
case "editpaguhibah"	 			: include "hibah/edit.php";break;
case "rekamdetailhibah"	 			: include "hibah/rekamdetail.php";break;

case "realisasihibah"	 		    : include "realisasihibah/realisasi.php";break;
case "inputrealisasihibah"	 		: include "realisasihibah/input.php";break;
case "editrealisasihibah"	 	    : include "realisasihibah/edit.php";break;

//hibah
case "pagukotamahibah"	 		: include "hibah/pagukotama.php";break;
case "realisasi_ktm_hibah"	 	: include "realisasihibah/realisasi_ktm.php";break;

case "paguuohibah"	 			: include "hibah/paguuo.php";break;
case "realisasi_uo_hibah"	 	: include "hibah/realisasi_uo.php";break;

//-----------------------------
//kapitasi
case "pagukapitasi"	 				: include "kapitasi/pagu.php";break;
case "inputpagukapitasi"	 		: include "kapitasi/input.php";break;
case "editpagukapitasi"	 			: include "kapitasi/edit.php";break;
case "rekamdetailkapitasi"	 		: include "kapitasi/rekamdetail.php";break;

case "realisasikapitasi"	 		: include "realisasikapitasi/realisasi.php";break;
case "inputrealisasikapitasi"	 	: include "realisasikapitasi/input.php";break;
case "editrealisasikapitasi"	 	: include "realisasikapitasi/edit.php";break;

//kaitasi kotama
case "pagukotamakapitasi"	 		: include "kapitasi/pagukotama.php";break;
case "realisasi_ktm_kapitasi"	 	: include "realisasikapitasi/realisasi_ktm.php";break;

case "paguuokapitasi"	 			: include "kapitasi/paguuo.php";break;
case "realisasi_uo_kapitasi"	 	: include "realisasikapitasi/realisasi_uo.php";break;

//-----------------------------




//punta kotama

case "formc_mon_pusat_satker_u_ktm"	: include "form/formc_mon_pusat_satker_u_ktm.php";break;

case "validitassatker"	 		: include "validitas/validitassatker.php";break;
case "validitassatker_front"	: include "validitas/validitassatker_front.php";break;
case "inputvaliditassatker"	 	: include "validitas/inputvaliditassatker.php";break;
case "editvaliditassatker"	 	: include "validitas/editvaliditassatker.php";break;

case "validitassatker_0cc175b9c0f1b6a831c399e269772661"	: include "validitas/validitassatker_utk_uo.php";break;
case "editvaliditassatker_utk_uo" : include "validitas/editvaliditassatker_utk_uo.php";break;
//------------------------------
case "validitasktm_0cc175b9c0f1b6a831c399e269772661"	: include "validitas/validitasktm_utk_uo.php";break;
case "editvaliditasktm_utk_uo" : include "validitas/editvaliditasktm_utk_uo.php";break;
//-------------------------------

case "validitasktm_input"	 	: include "validitas/validitasktm_input.php";break;
case "inputvaliditasktm"	 	: include "validitas/inputvaliditasktm.php";break;
case "editvaliditasktm"	 		: include "validitas/editvaliditasktm.php";break;

// kelengkapan surat
case "validitasktm"	 			: include "validitas/validitasktm.php";break;

case "kopstuk"	 				: include "pengelola/kopstuk/kopstuk.php";break;
case "inputkopstuk"	 			: include "pengelola/kopstuk/input.php";break;
case "editkopstuk"	 			: include "pengelola/kopstuk/edit.php";break;

case "ttd"	 					: include "pengelola/ttd/ttd.php";break;
case "inputttd"	 				: include "pengelola/ttd/input.php";break;
case "editttd"	 				: include "pengelola/ttd/edit.php";break;
case "rapikanttd"	 			: include "pengelola/ttd/rapikanttd.php";break;

case "lampiran"	 				: include "pengelola/lampiran/lampiran.php";break;
case "inputlampiran"	 		: include "pengelola/lampiran/input.php";break;
case "editlampiran"	 			: include "pengelola/lampiran/edit.php";break;



//case "backup"	 				: include "amankan/index.php";break;
//case "restore"	 				: include "amankan/recovery_data.php";break;



case "formtunkin_satker"		: include "akungaji/formtunkin_satker.php";break;
case "tunkin_satker"			: include "akungaji/tunkin_satker.php";break;


case "pengembalian"				: include "pengembalian/pengembalian.php";break;
case "inputpengembalian"		: include "pengembalian/input.php";break;
case "editpengembalian"			: include "pengembalian/edit.php";break;

case "pengembalian_satker_u_ktm": include "pengembalian/pengembalian_satker_u_ktm.php";break;
case "pengembalian_ktm"			: include "pengembalian/pengembalian_ktm.php";break;



// otentikasi tabel pendukung
case "kotama"	 				: include "pengelola/kotama/kotama.php";break;
case "inputkotama"	 			: include "pengelola/kotama/input.php";break;
case "editkotama"	 			: include "pengelola/kotama/edit.php";break;
case "satker"	 				: include "pengelola/satker/satker.php";break;

case "inputsatker"	 			: include "pengelola/satker/input.php";break;
case "editsatker"	 			: include "pengelola/satker/edit.php";break;

case "user"	 					: include "pengelola/userlaplakgar/userlaplakgar.php";break;
case "inputuser"	 			: include "pengelola/userlaplakgar/input.php";break;
case "edituser"	 				: include "pengelola/userlaplakgar/edit.php";break;
case "gantiuser"	 			: include "pengelola/userlaplakgar/gantiuser.php";break;
case "gantiuserberhasil"	 	: include "pengelola/userlaplakgar/berhasil.php";break;

case "giat"	 					: include "pengelola/giat/giat.php";break;
case "inputgiat"	 			: include "pengelola/giat/input.php";break;
case "editgiat"	 				: include "pengelola/giat/edit.php";break;
case "program"	 					: include "pengelola/giat/program.php";break;

case "output"	 				: include "pengelola/output/output.php";break;
case "inputoutput"	 			: include "pengelola/output/input.php";break;
case "editoutput"	 			: include "pengelola/output/edit.php";break;

case "akun"	 					: include "pengelola/akun/akun.php";break;
case "inputakun"	 			: include "pengelola/akun/input.php";break;
case "editakun"	 				: include "pengelola/akun/edit.php";break;

case "subakun"	 				: include "pengelola/subakun/subakun.php";break;
case "inputsubakun"	 			: include "pengelola/subakun/input.php";break;
case "inputsubakun1"	 		: include "pengelola/subakun/input1.php";break;
case "editsubakun"	 			: include "pengelola/subakun/edit.php";break;

case "rekaptunkin"	 			: include "tunkin/tunkin.php";break;
case "inputtunkin"	 			: include "tunkin/input.php";break;
case "edittunkin"	 			: include "tunkin/edit.php";break;


//adk
case "adksatker"	 			: include "backup/adksatker.php";break;
case "kirim_adksatker"	 		: include "backup/kirim_adksatker.php";break;
case "backup_satker"	 		: include "backup/backup_satker.php";break;
case "backup_subsatker"	 		: include "backup/backup_subsatker.php";break;
case "restore_satker"	 		: include "backup/restore_satker.php";break;

case "backup_ktm"	 			: include "backup/backup_ktm.php";break;
case "restore_ktm"	 			: include "backup/restore_ktm.php";break;

case "backup_uo"	 			: include "backup/backup_uo.php";break;
case "restore_uo"	 			: include "backup/restore_uo.php";break;

case "backup_subakun"	 		: include "backup/backup_subakun.php";break;
case "restore_subakun"	 		: include "backup/restore_subakun.php";break;


//form harus disini
case "form_daerah_satker"			: include "form/form_daerah_satker.php";break;
case "form_daerah_satker_progjenbel" : include "form/form_daerah_satker_progjenbel.php";break;
case "form_daerah_satker_wasgiat"	: include "form/form_daerah_satker_wasgiat.php";break;

case "form_daerah_satker_reals_pengembalian" : include "form/form_daerah_satker_reals_pengembalian.php";break;


case "formc_daerah_ktm_wasgiat_u_uo"		: include "form_uo/formc_daerah_kotama_wasgiat_u_uo.php";break;




//case "formc_pusat_satker"			: include "form/formc_pusat_satker.php";break;
case "formc_mon_pusat_satker"		: include "form/formc_mon_pusat_satker.php";break;
case "formc_pusat_satker_jenbel"	: include "form/formc_pusat_satker_jenbel.php";break;
case "formc_pusat_satker_jenbel_u_ktm"	: include "form/formc_pusat_satker_jenbel_u_ktm.php";break;

case "formc_mon_daerah_satker"				: include "form/formc_mon_daerah_satker.php";break;
case "formc_prog_daerah_satker"				: include "form/formc_prog_daerah_satker.php";break;
case "formc_prog_daerah_satker_wasgiat"		: include "form/formc_prog_daerah_satker_wasgiat.php";break;

case "formc_laplakgar_log_satker"			: include "form/formc_laplakgar_log_satker.php";break;
case "formc_laplakgar_log_ktm"				: include "form_ktm/formc_laplakgar_log_ktm.php";break;
case "formc_laplakgar_log_satker_u_ktm"		: include "form_ktm/formc_laplakgar_log_satker_u_ktm.php";break;



//---------------------form kotama baru---------------------------------------------------------------------------------
case "formc_mon_daerah_satker_u_ktm"			: include "form_ktm/formc_mon_daerah_satker_u_ktm.php";break;
case "formc_mon_daerah_satker_wasgiat_u_ktm"	: include "form_ktm/formc_mon_daerah_satker_wasgiat_u_ktm.php";break;
case "formc_daerah_satker_jenbel_u_ktm"			: include "form_ktm/formc_daerah_satker_jenbel_u_ktm.php";break;
case "form_daerah_ktm"							: include "form_ktm/form_daerah_ktm.php";break;
case "form_daerah_ktm_wasgiat"					: include "form_ktm/form_daerah_ktm_wasgiat.php";break;
case "formc_daerah_ktm"							: include "form_ktm/formc_daerah_ktm.php";break;
case "formc_daerah_ktm_wasgiat"					: include "form_ktm/formc_daerah_ktm_wasgiat.php";break;
case "formc_daerah_ktm_jenbel"					: include "form_ktm/formc_daerah_ktm_jenbel.php";break;

case "form_bpjs_ktm"							: include "form_ktm/form_bpjs_ktm.php";break;
case "formc_bpjs_ktm"							: include "form_ktm/formc_bpjs_ktm.php";break;
case "formc_bpjs_satker_u_ktm"					: include "form_ktm/formc_bpjs_satker_u_ktm.php";break;

case "form_yanmasum_ktm"						: include "form_ktm/form_yanmasum_ktm.php";break;
case "formc_yanmasum_ktm"						: include "form_ktm/formc_yanmasum_ktm.php";break;
case "formc_yanmasum_satker_u_ktm"				: include "form_ktm/formc_yanmasum_satker_u_ktm.php";break;

case "form_blu_ktm"								: include "form_ktm/form_blu_ktm.php";break;
case "formc_blu_ktm"							: include "form_ktm/formc_blu_ktm.php";break;
case "formc_blu_satker_u_ktm"					: include "form_ktm/formc_blu_satker_u_ktm.php";break;

case "form_kapitasi_ktm"						: include "form_ktm/form_kapitasi_ktm.php";break;
case "formc_kapitasi_ktm"						: include "form_ktm/formc_kapitasi_ktm.php";break;
case "formc_kapitasi_satker_u_ktm"				: include "form_ktm/formc_kapitasi_satker_u_ktm.php";break;


case "form_sbsn_ktm"							: include "form_ktm/form_sbsn_ktm.php";break;
case "formc_sbsn_ktm"							: include "form_ktm/formc_sbsn_ktm.php";break;
case "formc_sbsn_satker_u_ktm"					: include "form_ktm/formc_sbsn_satker_u_ktm.php";break;

case "form_hibah_ktm"							: include "form_ktm/form_hibah_ktm.php";break;
case "formc_hibah_ktm"							: include "form_ktm/formc_hibah_ktm.php";break;

case "formc_prog_daerah_ktm"					: include "form_ktm/formc_prog_daerah_ktm.php";break;
case "formc_prog_daerah_ktm_wasgiat"			: include "form_ktm/formc_prog_daerah_ktm_wasgiat.php";break;

case "formc_pnbpum_satker_u_ktm"				: include "form_ktm/formc_pnbpum_satker_u_ktm.php";break;
case "formc_pnbpum_ktm"							: include "form_ktm/formc_pnbpum_ktm.php";break;

case "form_daerah_ktm_progjenbel" 				: include "form_ktm/form_daerah_ktm_progjenbel.php";break;
//---------------------end form kotama baru-------------------------------------------------------------

//---------------------form uo baru----------------------------------------------------------

case "formc_daerah_satker_jenbel_u_uo"			: include "form_uo/formc_daerah_satker_jenbel_u_uo.php";break;
case "formc_daerah_ktm_jenbel_u_uo"				: include "form_uo/formc_daerah_ktm_jenbel_u_uo.php";break;

case "formc_daerah_satker_u_uo"					: include "form_uo/formc_daerah_satker_u_uo.php";break;
case "formc_daerah_ktm_u_uo"					: include "form_uo/formc_daerah_ktm_u_uo.php";break;

case "form_daerah_uo"							: include "form_uo/form_daerah_uo.php";break;
case "formc_mon_daerah_uo"						: include "form_uo/formc_mon_daerah_uo.php";break;
case "formc_daerah_uo"							: include "form_uo/formc_daerah_uo.php";break;

case "form_daerah_uo_wasgiat"					: include "form_uo/form_daerah_uo_wasgiat.php";break;
case "formc_mon_daerah_uo_wasgiat"				: include "form_uo/formc_mon_daerah_uo_wasgiat.php";break;


case "form_bpjs_uo"								: include "form_uo/form_bpjs_uo.php";break;
case "formc_bpjs_uo"							: include "form_uo/formc_bpjs_uo.php";break;
case "formc_bpjs_ktm_u_uo"						: include "form_uo/formc_bpjs_ktm_u_uo.php";break;
case "formc_bpjs_satker_u_uo"					: include "form_uo/formc_bpjs_satker_u_uo.php";break;

case "form_yanmasum_uo"							: include "form_uo/form_yanmasum_uo.php";break;
case "formc_yanmasum_uo"						: include "form_uo/formc_yanmasum_uo.php";break;
case "formc_yanmasum_ktm_u_uo"					: include "form_uo/formc_yanmasum_ktm_u_uo.php";break;
case "formc_yanmasum_satker_u_uo"			    : include "form_uo/formc_yanmasum_satker_u_uo.php";break;


case "form_blu_uo"								: include "form_uo/form_blu_uo.php";break;
case "formc_blu_uo"							    : include "form_uo/formc_blu_uo.php";break;
case "formc_blu_ktm_u_uo"						: include "form_uo/formc_blu_ktm_u_uo.php";break;
case "formc_blu_satker_u_uo"					: include "form_uo/formc_blu_satker_u_uo.php";break;


case "form_kapitasi_uo"							: include "form_uo/form_kapitasi_uo.php";break;
case "formc_kapitasi_uo"						: include "form_uo/formc_kapitasi_uo.php";break;
case "formc_kapitasi_ktm_u_uo"					: include "form_uo/formc_kapitasi_ktm_u_uo.php";break;
case "formc_kapitasi_satker_u_uo"				: include "form_uo/formc_kapitasi_satker_u_uo.php";break;


case "form_hibah_uo"							: include "form_uo/form_hibah_uo.php";break;
case "formc_hibah_uo"							: include "form_uo/formc_hibah_uo.php";break;

case "formc_pnbpum_uo"							: include "form_uo/formc_pnbpum_uo.php";break;
case "formc_pnbpum_ktm_u_uo"					: include "form_uo/formc_pnbpum_ktm_u_uo.php";break;
case "formc_pnbpum_satker_u_uo"					: include "form_uo/formc_pnbpum_satker_u_uo.php";break;

case "form_daerah_uo_progjenbel" 				: include "form_uo/form_daerah_uo_progjenbel.php";break;

case "form_sbsn_uo"							: include "form_uo/form_sbsn_uo.php";break;
case "formc_sbsn_uo"							: include "form_uo/formc_sbsn_uo.php";break;

//---------------------end form uo baru------------------------------------------------------------





case "formc_mon_daerah_satker_wasgiat"  : include "form/formc_mon_daerah_satker_wasgiat.php";break;



case "formc_daerah_satker_jenbel"	: include "form/formc_daerah_satker_jenbel.php";break;















case "formc_mon_pusat_ktm"				: include "form/formc_mon_pusat_ktm.php";break;
case "formc_pusat_ktm_jenbel"		: include "form/formc_pusat_ktm_jenbel.php";break;
case "formc_pusat_uo"				: include "form/formc_pusat_uo.php";break;
case "formc_pusat_uo_wasgiat"		: include "form/formc_pusat_uo_wasgiat.php";break;
case "formc_pusat_uo_jenbel"		: include "form/formc_pusat_uo_jenbel.php";break;
//case "formc_pusat_uo_baru"			: include "form/formc_pusat_uo_baru.php";break;
//case "formc_daerah_uo_baru"			: include "form/formc_daerah_uo_baru.php";break;
case "formc_mon_pusat_ktm_wasgiat"		: include "form/formc_mon_pusat_ktm_wasgiat.php";break;
case "formc_pusat_satker_wasgiat"	: include "form/formc_pusat_satker_wasgiat.php";break;
case "formc_mon_pusat_satker_wasgiat_u_ktm"	: include "form/formc_mon_pusat_satker_wasgiat_u_ktm.php";break;



//--------------cetakan kotama peruntukan uo-------------------------




//form bpjs
case "form_bpjs_satker"			: include "form/form_bpjs_satker.php";break;
case "formc_bpjs_satker"		: include "form/formc_bpjs_satker.php";break;



//----------------------------------------------------------------------------
case "form_yanmasum_satker"		: include "form/form_yanmasum_satker.php";break;
case "formc_yanmasum_satker"	: include "form/formc_yanmasum_satker.php";break;




//----------------------------------------------------------------------------
case "form_blu_satker"			: include "form/form_blu_satker.php";break;
case "formc_blu_satker"			: include "form/formc_blu_satker.php";break;

//----------------------------------------------------------------------------
case "form_hibah_satker"			: include "form/form_hibah_satker.php";break;
case "formc_hibah_satker"			: include "form/formc_hibah_satker.php";break;
case "formc_hibah_satker_u_ktm"		: include "form/formc_blu_hibah_u_ktm.php";break;



//----------------------------------------------------------------------------

case "form_kapitasi_satker"				: include "form/form_kapitasi_satker.php";break;
case "formc_kapitasi_satker"			: include "form/formc_kapitasi_satker.php";break;

case "form_sbsn_satker"				: include "form/form_sbsn_satker.php";break;
case "formc_sbsn_satker"			: include "form/formc_sbsn_satker.php";break;



case "form_pengembalian_satker"		: include "form/form_pengembalian_satker.php";break;
case "form_pengembalian_ktm"		: include "form_ktm/form_pengembalian_ktm.php";break;

//------------------kosongkan data ---------------
case "kosong"				: include "kosong.php";break;
case "berhasilkosong"		: print "<br><br><br><br><center><img src='images/kosongberhasil.png'</center>";break;

case "mapping"				: include "mappingreals.php";break;
case "berhasilmapping"		: print "<br><br><br><br><center><img src='images/mapping.gif'</center>";break;



case "perbaikan"			: include "perbaikan.php";break;
case "perbaikanberhasil"	: print "<br><br><br><br><center><img src='images/perbaikanberhasil.png'</center>";break;

//-------------------------wasgar---------------------------

//case "wasgar_pusat_satker"	 			: include "wasgar/wasgar_pusat_satker.php";break;
case "wasgar_daerah_satker"	 			: include "wasgar/wasgar_daerah_satker.php";break;
case "wasgar_bpjs_satker"	 			: include "wasgar/wasgar_bpjs_satker.php";break;
case "wasgar_yanmasum_satker"	 		: include "wasgar/wasgar_yanmasum_satker.php";break;
case "wasgar_blu_satker"	 			: include "wasgar/wasgar_blu_satker.php";break;
case "wasgar_kapitasi_satker"	 		: include "wasgar/wasgar_kapitasi_satker.php";break;

case "wasgar_bpjs_ktm"	 			: include "wasgar/wasgar_bpjs_ktm.php";break;
case "wasgar_yanmasum_ktm"	 		: include "wasgar/wasgar_yanmasum_ktm.php";break;
case "wasgar_blu_ktm"	 			: include "wasgar/wasgar_blu_ktm.php";break;
case "wasgar_kapitasi_ktm"	 		: include "wasgar/wasgar_kapitasi_ktm.php";break;

//case "wasgar_pusat_ktm"	 			: include "wasgar/wasgar_pusat_ktm.php";break;
case "wasgar_daerah_ktm"	 			: include "wasgar/wasgar_daerah_ktm.php";break;



//--------------------------------------- SE YANMASUM -----------------------------------------

//1.pendapatan yanmasum
case "target_dptyanmasum"	 			: include "se_dptyanmasum/terget.php";break;
case "inputtarget_dptyanmasum"	 		: include "se_dptyanmasum/input.php";break;
case "edittarget_dptyanmasum"	 		: include "se_dptyanmasum/edit.php";break;

case "target_dptyanmasum_ktm"	 		: include "se_dptyanmasum/targetktm.php";break;



case "form_dptyanmasum_satker"	 		: include "form/form_dptyanmasum_satker.php";break;
case "form_dptyanmasum_ktm"	 			: include "form/form_dptyanmasum_ktm.php";break;


case "realisasidptyanmasum"	 			: include "se_realisasidptyanmasum/realisasi.php";break;
case "inputrealisasi_dptyanmasum"	 	: include "se_realisasidptyanmasum/input.php";break;
case "editrealisasi_dptyanmasum"	 	: include "se_realisasidptyanmasum/edit.php";break;

case "realisasidptyanmasum_ktm"	 		: include "se_realisasidptyanmasum/realisasi_ktm.php";break;

//2.pendapatan bpjs
case "target_dptbpjs"	 			: include "se_dptbpjs/terget.php";break;
case "inputtarget_dptbpjs"	 		: include "se_dptbpjs/input.php";break;
case "edittarget_dptbpjs"	 		: include "se_dptbpjs/edit.php";break;

case "target_dptbpjs_ktm"	 		: include "se_dptbpjs/targetktm.php";break;



case "form_dptbpjs_satker"	 		: include "form/form_dptbpjs_satker.php";break;
case "form_dptbpjs_ktm"	 			: include "form/form_dptbpjs_ktm.php";break;


case "realisasidptbpjs"	 			: include "se_realisasidptbpjs/realisasi.php";break;
case "inputrealisasi_dptbpjs"	 	: include "se_realisasidptyanmasum/input.php";break;
case "editrealisasi_dptbpjs"	 	: include "se_realisasidptyanmasum/edit.php";break;

case "realisasidptbpjs_ktm"	 		: include "se_realisasidptyanmasum/realisasi_ktm.php";break;

//3.Yanmasum se
case "paguyanmasum_se"	 			: include "se_yanmasum/pagu.php";break;


// cetakan lama---------------------------------------------------------------

//case "formc_daerah_kotama_wasgiat_u_ktm"	: include "form/formc_daerah_kotama_wasgiat_u_ktm.php";break;

case "formc_daerah_ktm_lama"			: include "cetaklama/formc_daerah_ktm.php";break;
case "formc_daerah_ktm_wasgiat_lama"	: include "cetaklama/formc_daerah_ktm_wasgiat.php";break;

case "formc_pusat_ktm_lama"				: include "cetaklama/formc_pusat_ktm.php";break;
case "formc_pusat_ktm_wasgiat_lama"		: include "cetaklama/formc_pusat_ktm_wasgiat.php";break;


case "laphibah"	 					: include "laphibah/laphibah.php";break;
case "inputlaphibah"	 			: include "laphibah/input.php";break;
case "editlaphibah"	 				: include "laphibah/edit.php";break;

case "laphibah_ktm"	 				: include "laphibah/laphibah_ktm.php";break;

case "pnbpum"	 					: include "target_pnbpum/terget.php";break;
case "inputpnbpum"	 				: include "target_pnbpum/input.php";break;
case "editpnbpum"	 				: include "target_pnbpum/edit.php";break;

case "form_pnbpum_satker"			: include "form/form_pnbpum_satker.php";break;
case "form_pnbpum_ktm"				: include "form_ktm/form_pnbpum_ktm.php";break;
case "form_pnbpum_uo"				: include "form_uo/form_pnbpum_uo.php";break;

case "formc_pnbpum_satker"			: include "form/formc_pnbpum_satker.php";break;

case "realisasipnbpum"	 			: include "realisasipnbpum/realisasi.php";break;
case "inputrealisasipnbpum"	 		: include "realisasipnbpum/input.php";break;
case "editrealisasipnbpum"	 		: include "realisasipnbpum/edit.php";break;


case "realisasipnbpum_ktm"	 		: include "realisasipnbpum/realisasi_ktm.php";break;
case "realisasipnbpum_uo"	 		: include "realisasipnbpum/realisasi_uo.php";break;

case "perbaikan_tabel_pnbpumum"	 	: include "target_pnbpum/perbaikan_tabel_pnbpumum.php";break;
case "perbaikan_tabel_akungaji"	 	: include "akungaji/perbaikan_tabel_akungaji.php";break;


// akun gaji
case "form_akungaji_satker"	 		: include "form/form_akungaji_satker.php";break;
case "akungaji_satker"			    : include "akungaji/realisasi.php";break;
case "akungaji_ktm"					: include "akungaji/realisasi_ktm.php";break;
case "akungaji_uo"					: include "akungaji/realisasi_uo.php";break;

case "formc_akungaji_satker_u_ktm"	: include "form_ktm/formc_akungaji_satker_u_ktm.php";break;
case "form_akungaji_ktm"	 		: include "form_ktm/form_akungaji_ktm.php";break;

case "formc_akungaji_satker_u_uo"	: include "form_uo/formc_akungaji_satker_u_uo.php";break;
case "formc_akungaji_ktm_u_uo"		: include "form_uo/formc_akungaji_ktm_u_uo.php";break;
case "form_akungaji_uo"				: include "form_uo/form_akungaji_uo.php";break;

case "realisasi_gajitunkin"			: include "realisasi/realisasi_gajitunkin.php";break;
case "realisasi_gajitunkin_ktm"		: include "realisasi/realisasi_gajitunkin_ktm.php";break;


case "formc_progjenbel_satker_u_uo"	: include "form_uo/formc_progjenbel_satker_u_uo.php";break;
case "formc_progjenbel_ktm_u_uo"	: include "form_uo/formc_progjenbel_ktm_u_uo.php";break;





// paban 4============blm ada di menu
case "formrealisasi_gaji_satker": include "akungaji/formrealisasi.php";break;

//case "akungaji_satker"			: include "realisasi/akungaji_satker.php";break;

case "formrealisasi_gaji_ktm"   : include "akungaji/formrealisasi_ktm.php";break;


//surat
case "surat_satker"   		: include "pengelola/surat/surat_satker.php";break;
case "detailsurat"    		: include "pengelola/surat/detailsurat.php";break;
case "inputsurat"    		: include "pengelola/surat/input.php";break;
case "editsurat"    		: include "pengelola/surat/edit.php";break;
case "editsuratdetail"    	: include "pengelola/surat/editdetail.php";break;
case "tembusan_satker"      : include "pengelola/tembusan/tembusan_satker.php";break;

case "surat_ktm"   			: include "pengelola/surat/surat_ktm.php";break;
case "detailsurat_ktm"   	: include "pengelola/surat/detailsurat_ktm.php";break;
case "inputsurat_ktm"    	: include "pengelola/surat/inputktm.php";break;
case "editsurat_ktm"    	: include "pengelola/surat/editktm.php";break;
case "editsuratdetail_ktm"  : include "pengelola/surat/editdetailktm.php";break;
case "tembusan_ktm"    	    : include "pengelola/tembusan/tembusan_ktm.php";break;


case "rekap_akun_satker"	 : include "realisasi/rekap_akun_satker.php";break;
case "rekap_akun_ktm"	 	 : include "realisasi/rekap_akun_ktm.php";break;
case "realisasi_akuncovid"	 : include "realisasi/realisasi_akuncovid.php";break;
case "realisasi_akuncovid_bpjs"	 : include "realisasibpjs/realisasi_akuncovid_bpjs.php";break;
case "realisasi_akuncovid_yanmasum"	 : include "realisasiyanmasum/realisasi_akuncovid_yanmasum.php";break;
case "realisasi_akuncovid_blu"	 : include "realisasiblu/realisasi_akuncovid_blu.php";break;
case "realisasi_akuncovid_kapitasi"	 : include "realisasikapitasi/realisasi_akuncovid_kapitasi.php";break;
case "realisasi_akuncovid_hibah"	 : include "realisasihibah/realisasi_akuncovid_hibah.php";break;


case "realisasi_akuncovid_ktm"	 : include "realisasi/realisasi_akuncovid_ktm.php";break;
case "realisasi_akuncovid_bpjs_ktm"	 : include "realisasibpjs/realisasi_akuncovid_bpjs_ktm.php";break;
case "realisasi_akuncovid_yanmasum_ktm"	 : include "realisasiyanmasum/realisasi_akuncovid_yanmasum_ktm.php";break;
case "realisasi_akuncovid_kapitasi_ktm"	 : include "realisasikapitasi/realisasi_akuncovid_kapitasi_ktm.php";break;
case "realisasi_akuncovid_blu_ktm"	 : include "realisasiblu/realisasi_akuncovid_blu_ktm.php";break;
case "realisasi_akuncovid_hibah_ktm"	 : include "realisasihibah/realisasi_akuncovid_hibah_ktm.php";break;

case "setahun"	 	 : include "fixed/setahu.php";break;
case "setahun_ktm"	 : include "fixed/setahu_ktm.php";break;


//ta 2023
case "rekap_akun_bpjs_satker"	 		: include "realisasibpjs/rekap_akun_satker.php";break;
case "rekap_akun_yanmasum_satker"	 	: include "realisasiyanmasum/rekap_akun_satker.php";break;
case "rekap_akun_blu_satker"	 		: include "realisasiblu/rekap_akun_satker.php";break;
case "rekap_akun_kapitasi_satker"	 	: include "realisasikapitasi/rekap_akun_satker.php";break;
case "rekap_akun_hibah_satker"	 		: include "realisasihibah/rekap_akun_satker.php";break;
case "rekap_akun_sbsn_satker"	 		: include "realisasisbsn/rekap_akun_satker.php";break;

case "rekap_akun_bpjs_ktm"	 		    : include "realisasibpjs/rekap_akun_ktm.php";break;
case "rekap_akun_yanmasum_ktm"	 		: include "realisasiyanmasum/rekap_akun_ktm.php";break;
case "rekap_akun_blu_ktm"	 			: include "realisasiblu/rekap_akun_ktm.php";break;
case "rekap_akun_kapitasi_ktm"	 		: include "realisasikapitasi/rekap_akun_ktm.php";break;
case "rekap_akun_hibah_ktm"	 			: include "realisasihibah/rekap_akun_ktm.php";break;
case "rekap_akun_sbsn_ktm"	 			: include "realisasisbsn/rekap_akun_ktm.php";break;

//-------------new
case "renbut_gajitunkin"	 	: include "renbut/renbut.php";break;
case "inputrenbut"	 			: include "renbut/input.php";break;
case "editrenbut"	 			: include "renbut/edit.php";break;

case "renbut_gajitunkin_ktm"	 : include "renbut/renbut_ktm.php";break;

case "aktifkan"	 				: include "renbut/aktifkan.php";break;

case "dayaserapktm"	 			: include "realisasi/dserapktm.php";break;
case "dayaserapuo"	 			: include "realisasi/dserapuo.php";break;

case "rincian_akun_satker"		: include "fixed/setahu_akun.php";break;
}


?>