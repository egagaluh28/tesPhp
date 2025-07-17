<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
<link rel="stylesheet" href="library/style_pencarian.css" type="text/css" media="screen" />
<meta charset='UTF-8'>
<title>duser</title>

<style>


<?php
class JinPagination {
	// fungsi pengaturan/option $this->blabla = "value nya blabla"
	function setOption($field, $value) {
		$this->$field = $value;
	}
	// fungsi paginasi generate array berupa total jumlah halaman, pagination, data dan posisi start 
	// berguna untuk diatur secara fleksible terutama untuk berbasis menggunakan template
	function build() {
		// SETUP
		$tabel = $this->tabel;
		$where = $this->where;
		$limit = $this->limit;
		$order = $this->order;
		$page = $this->page;
 
		// SETUP OPTIONAL
		if(!isset($this->web_url_page)) { $web_url_page = "?page="; } else { $web_url_page = $this->web_url_page; }
		if(!isset($this->adjacents)) { $adjacents = "3"; } else { $adjacents = $this->adjacents; }
		if(!isset($this->txt_prev)) { $txt_prev = "&laquo; prev"; } else { $txt_prev = $this->txt_prev; }
		if(!isset($this->txt_next)) { $txt_next = "next &raquo;"; } else { $txt_next = $this->txt_next; }
		if(!isset($this->txt_titik)) { $txt_titik = "..."; } else { $txt_titik = $this->txt_titik; }
 
		$query = mysql_query("select z.* from (select a.*, b.nmsatkr from laphibah a left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]') as z ".$where."");
		//$total_pages = mysql_fetch_array(mysql_query($query));
		//$total_pages = $total_pages['num'];
		$total_pages = mysql_num_rows($query);
 
		if($page) {
			$start = ($page - 1) * $limit; 			//first item to display on this page
		} else {
			$start = 0;								//if no page var is given, set start to 0
		}
		// Get data.
		$query = "select z.* from (select a.*, b.nmsatkr from laphibah a left join t_satkr b on a.kdkotama=b.kdkotama and a.kdsatker=b.kdsatkr where a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]') as z  ".$where." ".$order." LIMIT ".$start.", ".$limit."";
		$hasil = mysql_query($query);
 
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
 
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1) {
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) {
				$pagination .= "<a href=\"".$web_url_page.$prev."".$extra_href."\">" . $txt_prev . "</a>";
			} else {
				$pagination .= "<span class=\"disabled\">" . $txt_prev . "</span>";	
			}
			//pages
			if ($lastpage < 7 + ($adjacents * 2)) {
				//not enough pages to bother breaking it up
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page) {
						$pagination .= "<span class=\"current\">".$counter."</span>";
					} else {
						$pagination .= "<a href=\"".$web_url_page.$counter."".$extra_href."\">".$counter."</a>";
					}
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2)) {
				//enough pages to hide some
				if($page < 1 + ($adjacents * 2)) {
					//close to beginning; only hide later pages
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">".$counter."</span>";
						} else {
							$pagination .= "<a href=\"".$web_url_page.$counter."".$extra_href."\">$counter</a>";
						}
					}
					$pagination .= $txt_titik;
					$pagination .= "<a href=\"".$web_url_page.$lpm1."".$extra_href."\">".$lpm1."</a>";
					$pagination .= "<a href=\"".$web_url_page.$lastpage."".$extra_href."\">".$lastpage."</a>";		
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					//in middle; hide some front and some back
					$pagination .= "<a href=\"".$web_url_page."1".$extra_href."\">1</a>";
					$pagination .= "<a href=\"".$web_url_page."2".$extra_href."\">2</a>";
					$pagination .= $txt_titik;
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">".$counter."</span>";
						} else {
							$pagination .= "<a href=\"".$web_url_page.$counter."".$extra_href."\">".$counter."</a>";
						}
					}
					$pagination .= $txt_titik;
					$pagination .= "<a href=\"".$web_url_page.$lpm1."".$extra_href."\">".$lpm1."</a>";
					$pagination .= "<a href=\"".$web_url_page.$lastpage."".$extra_href."\">".$lastpage."</a>";
				} else {
					//close to end; only hide early pages
					$pagination .= "<a href=\"".$web_url_page."1".$extra_href."\">1</a>";
					$pagination .= "<a href=\"".$web_url_page."2".$extra_href."\">2</a>";
					$pagination .= $txt_titik;
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">".$counter."</span>";
						} else {
							$pagination .= "<a href=\"".$web_url_page.$counter."".$extra_href."\">".$counter."</a>";
						}
					}
				}
			}
            
		//	$txtcari=$_POST[txtcari];
			//next button
			if ($page < $counter - 1) {
				$pagination .= "<a href=\"".$web_url_page.$next."".$extra_href."\">" . $txt_next . "</a>";
			} else {
				$pagination .= "<span class=\"disabled\">" . $txt_next . "</span>";
				$pagination .= "</div>\n";
			}
		}
		// hasil dari fungsi build()
		return array(	"pagination" 	=> $pagination, 
						"total" 		=> number_format($total_pages),
						"hasil"			=> $hasil,
						"start"			=> $start
					);
	}
}
 
// Penggunaan Class
// koneksi DB
// asumsikan kita sudah terkoneksi dengan database MySQL
 
// Setting CSS
include "library/paging_cantik.php";



// optional CSS display
echo $isi;
// bikin object
$hal = new JinPagination;
// setup paginasi
//$hal->setOption("tabel", "pasien"); // nama tabel database
$hal->setOption("where", "WHERE z.uraian like '%$_POST[txtcari]%' or z.pemberi_hibah like '%$_POST[txtcari]%' or z.no_reg like '%$_POST[txtcari]%' or z.no_nph like '%$_POST[txtcari]%'"); // where kondisi, kosongkan jika tidak memakai WHERE
$hal->setOption("limit", "30"); // LIMIT tampilan per halaman
$hal->setOption("order", "ORDER BY z.tgl_nph"); // urutan, kosongkan jika tidak memakai urutan
$hal->setOption("page", $_REQUEST["page"]); // setup untuk ambil variable angka halaman (berguna jika menggunakan SEO url, ubah sesuai dgn kebutuhan)
$hal->setOption("web_url_page", "?module=$_GET[module]&page="); // setup alamat url (berguna jika menggunakan SEO url, ubah sesuai dgn kebutuhan)
// optional setup
$hal->setOption("adjacents", "5"); // tampil berapa angka ke kanan dan ke kiri nya, jika kita diposisi tengah halaman
$hal->setOption("txt_prev", "&laquo; sebelumnya"); // mengubah text "prev" menjadi "sebelumnya"
$hal->setOption("txt_next", "berikutnya &raquo;"); // mengubah text "next" menjadi "berikutnya"
// generate hasil pagination
$hal_array = $hal->build();
// setup penomoran
$no = $hal_array["start"] + 1;
// tampilkan

//echo $hal_array["pagination"]; // tampilkan pagination diatas
// data


echo "<center><br><span class='judulcontent'>LAPORAN PENERIMAAN DAN PENATAUSAHAAN HIBAH UANG</span></center><br>";
?>


<table   align="center" width="99%"  cellpadding="3" > 
	<tr>
		<td >
			<div class="button_box2">
			<form class="form-wrapper-2 cf" method="POST" action="media.php?module=user" >
			<input type="text" name="txtcari" placeholder="Ketik Kata Kunci Pencarian" >
			<button type="submit">C a r i</button>
			</form>
			</div>
		</td>
    </tr>
</table>	

<?php

include "library/indotgl_angka.php";
 
   
print" <table  align='center' width='99%'>
	<tr>
		<td align='left'><a href='media.php?module=inputlaphibah&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]&thang=$_GET[thang]' ' class='button green'>TAMBAH DATA</a></td>
	
	
		<td align='right' class='subyek1'>"; if ($_POST[txtcari]=='') { print "<span class='subyek1'>Total : " . $hal_array["total"]; 
			   } else {
			   echo "Ditemukan : " . $hal_array["total"]; print " Orang Berinitial : <span>$_POST[txtcari]</span></span>"; 
			   } 
print"  </td></tr>
	</table><br>";

if ($hal_array['total'] > 0) {

    print "<table width='99%'  cellspacing='5' cellpadding='5' align='center'  class='bordered'>";
	print "<tr>";
	print    "<th   align='center' height='30' width='5%' >NO</th>";
	print    "<th   align='center' >PENERIMA<br>HIBAH</th>";	
	print    "<th   align='center' >PEMBERI<br>HIBAH</th>";	
	print    "<th   align='center' >NOMOR &<br>TGL NPH</th>";	
	print    "<th   align='center' >URAIAN<br>KEGIATAN</th>";
	print    "<th   align='center' >NILAI<br>HIBAH</th>";	
	print    "<th   align='center' >NOMOR<br>REGISTER</th>";
	print    "<th   align='center' >BATAS<br>AKHIR<br>PENARIKAN<br>DANA</th>";	
	print    "<th   align='center' >NOMOR<br>REKENING</th>";
	print    "<th   align='center' >NOMOR<br>REVISI<br>DIPA (DS)</th>";
	print    "<th   align='center' >NILAI<br>REVISI</th>";
	print    "<th   align='center' >NOMOR &<br>TGL SPHL</th>";
	print    "<th   align='center' >NILAI<br>SPHL</th>";	
	print    "<th   align='center' >NOMOR &<br>TGL SP3HL</th>";
	print    "<th   align='center' >NILAI<br>SP3HL</th>";	
	print    "<th   align='center' >KET</th>";	
	print    "<th   align='center' colspan='2' >AKSI</th>";
  	print "</tr>";
  

while($row = mysql_fetch_array($hal_array["hasil"])){
$tgl_nph=tgl_indoangka($row[tgl_nph]);
$nilai_hibah =  number_format($row[nilai_hibah],0,',','.');
$batas=tgl_indoangka($row[batas_tarik_dana]);
$revisi =  number_format($row[nilai_revisi],0,',','.');
$tgl_sphl=tgl_indoangka($row[tgl_sphl]);
$tgl_sp3hl=tgl_indoangka($row[tgl_sp3hl]);
$nilai_sphl=  number_format($row[nilai_sphl],0,',','.');
$nilai_sp3hl=  number_format($row[nilai_sp3hl],0,',','.');	
	print"<tr><td  align='right' valign='top'>$no.</td>
			
			  <td valign='top'>$row[nmsatkr]</td>
			  <td valign='top'>$row[pemberi_hibah]</td>
			  <td valign='top'>$row[no_nph]<br>$tgl_nph</td>
			  <td valign='top'>$row[uraian]</td>
			  <td valign='top' align='right'>$nilai_hibah</td>
			  <td valign='top'>$row[no_reg]</td>
			  <td valign='top'>$batas</td>
			  <td valign='top'>$row[no_rek]</td>
			  <td valign='top'>$row[no_rev_dipa]</td>
			  <td valign='top' align='right'>$revisi</td>
			  <td valign='top'>$row[no_sphl]<br>$tgl_sphl</td>
			  <td valign='top'>$nilai_sphl</td>
			  <td valign='top'>$row[no_sp3hl]<br>$tgl_sp3hl</td>
			  <td valign='top'>$nilai_sp3hl</td>
			  <td valign='top'>$row[ket]</td>
			  <td  align='center' valign='top'><a href='media.php?module=editlaphibah&id_laphibah=$row[id_laphibah]' data-tooltip='Edit Data' data-position='top' class='top'>
			  <img src='images/edit.png' width='20' ></a></td>
			  <td  align='center' valign='top'><a href=\"laphibah/proses.php?aksi=hapus&id_laphibah=$row[id_laphibah]&thang=$row[thang]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS DATA ? ')\" data-tooltip='Hapus Data' data-position='top' class='top'><img src='images/delete.png' width='20' ></td>			  
		  </tr>";	
		  $no++;
     }
  print "</table>";
  print "<br>";
  
} else { 
    print "<table width='99%'  cellspacing='5' cellpadding='5' align='center'  class='bordered'>";
print "<tr>";
	print    "<th   align='center' height='30' width='5%' >NO</th>";
	print    "<th   align='center' >PENERIMA<br>HIBAH</th>";	
	print    "<th   align='center' >PEMBERI<br>HIBAH</th>";	
	print    "<th   align='center' >NOMOR &<br>TGL NPH</th>";	
	print    "<th   align='center' >URAIAN<br>KEGIATAN</th>";
	print    "<th   align='center' >NILAI<br>HIBAH</th>";	
	print    "<th   align='center' >NOMOR<br>REGISTER</th>";
	print    "<th   align='center' >BATAS<br>AKHIR<br>PENARIKAN<br>DANA</th>";	
	print    "<th   align='center' >NOMOR<br>REKENING</th>";
	print    "<th   align='center' >NOMOR<br>REVISI<br>DIPA (DS)</th>";
	print    "<th   align='center' >NILAI<br>REVISI</th>";
	print    "<th   align='center' >NOMOR &<br>TGL SPHL</th>";
	print    "<th   align='center' >NILAI<br>SPHL</th>";	
	print    "<th   align='center' >NOMOR &<br>TGL SP3HL</th>";
	print    "<th   align='center' >NILAI<br>SP3HL</th>";	
	print    "<th   align='center' >KET</th>";	
	print    "<th   align='center' colspan='2' >AKSI</th>";
  	print "</tr>
	
	<tr> 
        <td align='center' colspan='18'><img src='images/kosong.gif' ></td>
 	</tr>
</table>";	


}
print "<center><span class='subyek1'>";
//echo "total: " . $hal_array["total"]; // tampilkan total data */
echo $hal_array["pagination"]; // tampilkan pagination dibawah
?>
</span></center><br>

  

   

