<style>
ul {
  list-style: none; 
  padding: 0;
  margin: 0;
  background: #0a5a74;
  font-family: 'montserrat', sans-serif;
}
ul li {
  display: block;
  position: relative;
  float: right;
  background: #0a5a74;
}
/* This hides the dropdowns */
li ul {
  display: none;
}
ul li a {
  display: block;
  padding: 1em;
  text-decoration: none;
  white-space: nowrap;
  color: #fff;
}
ul li a:hover {
  background: #2c3e50;
}
/* Display the dropdown */
li:hover > ul {
  display: block; 
  position: absolute;
}
/* Remove float from dropdown lists */
li:hover li {
    float: none;
}
li:hover a {
  background: #0a5a74;
}
li:hover li a:hover {
  background: #2c3e50;
}
.main-navigation li ul li {
  border-top: 0;
}
/* Displays second level dropdowns to the right of the first level dropdown */
ul ul ul {
  left: 100%;
  top: 0; 
}


/* Simple clearfix */

ul:before,
ul:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

ul:after {
    clear: both;
}
</style>
<ul class="main-navigation">
  <li><a href="logout.php" class="first">Keluar</a></li>
		 
		<li><a href="#s2">Utility&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
            <ul>
				<li><a href="media.php?module=backup_satker">Backup Data</a></li>
				<li><a href="media.php?module=restore_satker">Restore Data</a></li>
				<li><a href="media.php?module=perbaikan">Perbaiki Data</a></li>
				<li><a href="media.php?module=gantiuser">Ganti Password</a></li>
            </ul>
        </li>
				
		<li><a href="#">Referansi&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
            <ul>
                <li><a href="media.php?module=kopstuk">KOPSTUK</a></li>
                <li><a href="media.php?module=ttd">TANDA TANGAN</a></li>
				<li><a href="media.php?module=lampiran">LAMPIRAN LAPLAKGAR</a></li>
				<li><a href="media.php?module=rapikanttd">RAPIKAN TANDA TANGAN</a></li>
				<li><a href="media.php?module=surat_satker">PEMBUATAN SURAT PENGANTAR</a></li>
				<li><a href="media.php?module=tembusan_satker">TEMBUSAN SURAT</a></li>
            </ul>
        </li>		
				
		<li><a href="#s1">HIBAH&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
            <ul>
                <li><a href="media.php?module=paguhibah&thang=2023">DATA PAGU/PROGJA</a></li>
                <li><a href="media.php?module=realisasihibah">REALISASI ANGGARAN</a></li>
				<li><a href="media.php?module=list_realisasi_hibah&thang=2023">LIST REALISASI</a></li>	
				<li><a href="media.php?module=formc_hibah_satker">CETAK MONITORING</a></li>
				<li><a href="media.php?module=realisasi_akuncovid_hibah">REALISASI AKUN COVID</a></li>
				<li><a href="media.php?module=laphibah&thang=2023">LAPORAN PENERIMAAN HIBAH</a></li>
            </ul>
        </li>
				
		<li><a href="#s1">SBSN&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
            <ul >
                <li><a href="media.php?module=pagusbsn&thang=2023">DATA PAGU/PROGJA</a></li>
                <li><a href="media.php?module=realisasisbsn">REALISASI ANGGARAN</a></li>
				<li><a href="media.php?module=list_realisasi_sbsn&thang=2023">LIST REALISASI</a></li>	
				<li><a href="media.php?module=formc_sbsn_satker">CETAK MONITORING</a></li>
            </ul>
         </li>
				
				
		<li><a href="#s1">KESEHATAN&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
			<ul>
				<li><a href="#s1">PNBP BPJS<img src="images/plus1.png" width="15" align="right"></a>
					<ul >
						<li><a href="media.php?module=pagubpjs&thang=2023">DATA PAGU/PROGJA</a></li>
						<li><a href="media.php?module=realisasibpjs">REALISASI ANGGARAN</a></li>
						<li><a href="media.php?module=list_realisasi_bpjs&thang=2023">LIST REALISASI</a></li>	
						<li><a href="media.php?module=formc_bpjs_satker">CETAK MONITORING BPJS</a></li>
						<li><a href="media.php?module=wasgar_bpjs_satker">WASGAR PER AKUN </a></li>
						<li><a href="media.php?module=realisasi_akuncovid_bpjs">REALISASI AKUN COVID</a></li>
					</ul>
				</li>
				 
				<li><a href="#s1">PNBP YANMASUM<img src="images/plus1.png" width="15" align="right"></a>
					<ul >
						<li><a href="media.php?module=paguyanmasum&thang=2023">DATA PAGU/PROGJA</a></li>
						<li><a href="media.php?module=realisasiyanmasum">REALISASI ANGGARAN</a></li>
						<li><a href="media.php?module=list_realisasi_yanmasum&thang=2023">LIST REALISASI</a></li>	
						<li><a href="media.php?module=formc_yanmasum_satker">CETAK MONITORING YANMASUM</a></li>
						<li><a href="media.php?module=wasgar_yanmasum_satker">WASGAR PER AKUN </a></li>
						<li><a href="media.php?module=realisasi_akuncovid_yanmasum">REALISASI AKUN COVID</a></li>
					</ul>
				</li>
				
				<li><a href="#s1">BLU<img src="images/plus1.png" width="15" align="right"></a>
					<ul >
						<li><a href="media.php?module=pagublu&thang=2023">DATA PAGU/PROGJA</a></li>
						<li><a href="media.php?module=realisasiblu">REALISASI ANGGARAN</a></li>
						<li><a href="media.php?module=list_realisasi_blu&thang=2023">LIST REALISASI</a></li>	
						<li><a href="media.php?module=formc_blu_satker">CETAK MONITORING BLU</a></li>
						<li><a href="media.php?module=wasgar_blu_satker">WASGAR PER AKUN </a></li>
						<li><a href="media.php?module=realisasi_akuncovid_blu">REALISASI AKUN COVID</a></li>
					</ul>
				</li>
				
				<li><a href="#s1">KAPITASI<img src="images/plus1.png" width="15" align="right"></a>
					<ul >
                <li><a href="media.php?module=pagukapitasi&thang=2023">DATA PAGU/PROGJA</a></li>
					<li><a href="media.php?module=realisasikapitasi">REALISASI ANGGARAN</a></li>
					<li><a href="media.php?module=list_realisasi_kapitasi&thang=2023">LIST REALISASI</a></li>	
					<li><a href="media.php?module=formc_kapitasi_satker">CETAK MONITORING</a></li>
					<li><a href="media.php?module=wasgar_kapitasi_satker">WASGAR PER AKUN </a></li>
					<li><a href="media.php?module=realisasi_akuncovid_kapitasi">REALISASI AKUN COVID</a></li>
					</ul>
				</li>
				
			</ul>
		 </li>
				
				
				
		<li><a href="#s1">RUPIAH MURNI&nbsp;&nbsp;<img src="images/plus1.png" width="15"></a>
            <ul >
                <li><a href="media.php?module=pagudipa&thang=2023">DATA PAGU/PROGJA</a></li>
                <li><a href="media.php?module=realisasi">REALISASI ANGGARAN</a></li>
				<li><a href="media.php?module=realisasi_wasgiat">REALISASI PER WASGIAT</a></li>
				<li><a href="media.php?module=list_realisasi&thang=2023">LIST REALISASI</a></li>	
				<li><a href="media.php?module=progrealisasi">PAGU DAN REALISASI PER PROGRAM/JENIS BELANJA</a></li>
			<li><a href="media.php?module=formc_daerah_satker_jenbel">CETAK DIPA DAERAH SATKER</a></li>
			<!--	<li><a href="media.php?module=formc_laplakgar_log_satker">CETAK LAPLAKGAR BID LOGISTIK (ST 151/2019)</a></li> -->
				
				<li><a href="media.php?module=pengembalian">PENGEMBALIAN</a></li>
				<li><a href="media.php?module=rekap_akun_satker">REKAP PER AKUN </a></li>
				<li><a href="media.php?module=wasgar_daerah_satker">WASGAR PER AKUN </a></li>
				<li><a href="media.php?module=akungaji_satker">LAP PENGAWASAN GAJI & TUNKIN</a></li>
				<li><a href="media.php?module=realisasi_gajitunkin">REALISASI GAJI & TUNKIN</a></li>
				<li><a href="media.php?module=setahun&thang=2023&kdkotama=<?php print $_SESSION['kdkotama'];?>&kdsatker=<?php print $_SESSION['kdsatker'];?>">REALISASI GAJI & TUNKIN SETAHUN</a></li>
				<li><a href="media.php?module=realisasi_akuncovid">REALISASI AKUN COVID</a></li>
			<!--	<li><a href="media.php?module=rekaptunkin">TUNKIN PER GREDE</a></li>-->
            </ul>
         </li>
				
		<li><a href="media.php?module=dashboard" class="first">Home</a></li>
</ul>
