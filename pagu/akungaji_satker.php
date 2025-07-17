

<html>
<head>
<link rel="stylesheet" href="library/css_pencarian.css" type="text/css" media="screen" />
<link rel="stylesheet" href="library/udiwe.css" type="text/css" media="screen" />


<?
   
print "<br><table  width='1100' align='center' ><tr><td class='judulcontent' align='center'>PEREKAMAN DATA PAGU</td></tr></table>";	

   
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
 
		$query = mysql_query("select z.* from (SELECT '' as id_pagu, a.thang, a.kdprogram as kode, a.kdprogram as display,  b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi
FROM pagu a 
left join t_program b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram

union (SELECT '' as id_pagu, a.thang, a.kdgiat as kode, concat(a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a 
left join t_giat b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat)

union (SELECT '' as id_pagu, a.thang, a.kdoutput as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput) as display,  b.nmoutput as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a 
left join t_output b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput)

union (SELECT '' as id_pagu, a.thang, a.kdakun as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, b.nmakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a left join t_akun b on a.kdakun=b.kdakun
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun)

union (SELECT '' as id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, b.nmsakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a left join t_sakun b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput and a.kdakun=b.kdakun and a.kdsakun=b.kdsakun
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)

union (SELECT id_pagu, thang, '' as kode, concat(kdprogram,kdgiat,kdoutput,kdakun, kdsakun,urutitem) as display, concat('-',' ', nmitem) as uraian, sum(pagu) as pagu, sum(revisi) as revisi FROM dipa  where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by id_pagu order by noitem, id_pagu)) as z  ".$where."");
		//$total_pages = mysql_fetch_array(mysql_query($query));
		//$total_pages = $total_pages['num'];
		$total_pages = mysql_num_rows($query);
 
		if($page) {
			$start = ($page - 1) * $limit; 			//first item to display on this page
		} else {
			$start = 0;								//if no page var is given, set start to 0
		}
		// Get data.
		$query = "select z.* from (SELECT '' as id_pagu, a.thang, a.kdprogram as kode, a.kdprogram as display,  b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi
FROM dipa a 
left join t_program b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram

union (SELECT '' as id_pagu, a.thang, a.kdgiat as kode, concat(a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a 
left join t_giat b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat)

union (SELECT '' as id_pagu, a.thang, a.kdoutput as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput) as display,  b.nmoutput as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a 
left join t_output b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput)

union (SELECT '' as id_pagu, a.thang, a.kdakun as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, b.nmakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a left join t_akun b on a.kdakun=b.kdakun
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]'
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun)

union (SELECT '' as id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, b.nmsakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi 
FROM dipa a left join t_sakun b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput and a.kdakun=b.kdakun and a.kdsakun=b.kdsakun
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_GET[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)

union (SELECT id_pagu, thang, '' as kode, concat(kdprogram,kdgiat,kdoutput,kdakun, kdsakun,urutitem) as display, concat('-',' ', nmitem) as uraian, sum(pagu) as pagu, sum(revisi) as revisi FROM dipa  where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_GET[thang]' group by id_pagu order by noitem, id_pagu)) as z  ".$where." ".$order." LIMIT ".$start.", ".$limit."";
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
$hal->setOption("where", "WHERE z.uraian like '%$_POST[txtcari]%'  or z.kode like '%$_POST[txtcari]%' or z.display like '%$_POST[txtcari]%'"); // where kondisi, kosongkan jika tidak memakai WHERE
$hal->setOption("limit", "350"); // LIMIT tampilan per halaman
$hal->setOption("order", "ORDER BY  z.display"); // urutan, kosongkan jika tidak memakai urutan
$hal->setOption("page", $_REQUEST["page"]); // setup untuk ambil variable angka halaman (berguna jika menggunakan SEO url, ubah sesuai dgn kebutuhan)
$hal->setOption("web_url_page", "?module=$_GET[module]&page="); // setup alamat url (berguna jika menggunakan SEO url, ubah sesuai dgn kebutuhan)
// optional setup
$hal->setOption("adjacents", "5"); // tampil berapa angka ke kanan dan ke kiri nya, jika kita diposisi tengah halaman
$hal->setOption("txt_prev", "&laquo; sebelumnya"); // mengubah text "prev" menjadi "sebelumnya"
$hal->setOption("txt_next", "berikutnya &raquo;"); // mengubah text "next" menjadi "berikutnya"
// generate hasil pagination
$hal_array = $hal->build();
// setup penomoran
//$no = $hal_array["start"] + 1;
// tampilkan

//echo $hal_array["pagination"]; // tampilkan pagination diatas
// data

?>

<br>
<table width="80%" align="center"><tr><td>
<form class="form-wrapper" method="POST" <? print "action='media.php?module=pagudipa&thang=$_GET[thang]'"; ?>" >
	<input type="text" id="search" name="txtcari"  placeholder="Masukkan Kode / Uraian"  >
	<input type="submit" value="cari" id="submit">
</form></td></tr></table><br>

<?php


print "<table width='80%' align='center'><tr><td><a href='media.php?module=inputpagudipa&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]&thang=$_GET[thang]' class='button blue'>Tambah Kegiatan Baru </a></td></tr></table><br>";

if ($hal_array['total'] > 0) {
	
	print "<table width='80%'  align='center' class='udiwe'>";
	print "<tr height='40'>";
	print    "<td   align='center' background='images/hover.png'><span class='header'>NO<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='30'><span class='header'>KODE<span></td>";
	print    "<td   align='center'  background='images/hover.png'><span class='header'>URAIAN<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>PAGU<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>REVISI (+/-)<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>PAGU STLH REVISI<span></td>";
	print    "<td   colspan='2' align='center' valign='middle' background='images/hover.png'><span class='header'>AKSI</td>";
  	print "</tr>";
	
	
  
  
	
while($k = mysql_fetch_array($hal_array["hasil"])){

    $pagu	 = number_format($k[pagu],0,',','.');
	$revisi	 = number_format($k[revisi],0,',','.');
	$stlhrevisi	 = $k[pagu] + $k[revisi];
	$hasil	 = number_format($stlhrevisi,0,',','.');
	
	$uraian = strtoupper($k[uraian]);
	$kd1 = substr($k[display],0,2);
	$kd2 = substr($k[display],2,4);
	$kd3 = substr($k[display],6,3);
	$kd4 = substr($k[display],9,6);
	$kd5 = substr($k[display],15,2);
	
	$str = $k[display];
    $pj = strlen($str);
	
	 if ($pj=='6')  {
		 
		  
		   $no++;
		   $no_urut = $no.".";
	} else { $no_urut=''; }
	
	
	
	
	print"<tr>";
		
			
		 
		 print "<td  valign='top' align='right'>$no_urut</td>
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$k[kode]</b>"; else print "$k[kode]"; print"</td>
				<td  valign='top'>"; 
				if ($pj=='17') print "<i>$uraian</i>"; else if ($pj<'17') print "<b>$k[uraian]</b>"; else print "$k[uraian]"; print"</td>
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$pagu</b>"; else print "$pagu"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$revisi</b>"; else print "$revisi"; print"</td>	
				<td  valign='top' align='right'>"; if ($pj<'17') print "<b>$hasil</b>"; else print "$hasil"; print"</td>";

		if ($pj=='17') { print "<td colspan='2' align='center'><a href='media.php?module=rekamdetaildipa&kdprogram=$kd1&kdgiat=$kd2&kdoutput=$kd3&kdakun=$kd4&kdsakun=$kd5&kdkotama=$_SESSION[kdkotama]&kdsatker=$_SESSION[kdsatker]'>
		<img src='images/add.png' width='20' title='tambah urai'></a></td>"; 
		
		} else { 
		
		print	"<td  valign='top' align='center'>"; if ($pj>'17') print "<a href='media.php?module=editpagudipa&id_pagu=$k[id_pagu]&thang=$_GET[thang]'>
		<img src='images/edit.png' width='20' title='Edit'></a>"; else print ""; print "</td>"; 
		print"<td  valign='top' align='center'>"; if ($pj>'17') print "<a href=\"dipa/proses.php?aksi=hapus&id_pagu=$k[id_pagu]&thang=$_GET[thang]\" 
					onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS  ~ $k[uraian] ~? ')\" >
				<img src='images/delete.png' width='20' title='Delete'></a>"; else print ""; print "</td>"; 
		
		}		
							
		print "</tr>";
		
	//$no++;	
	
	
   }
	print "</table><br>"; 
  
} else { 
print "<table width='80%'  cellspacing='5' cellpadding='5' align='center'  class='udiwe'>";
	print "<tr height='40'>";
	print    "<td   align='center' background='images/hover.png'><span class='header'>NO<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='30'><span class='header'>KODE<span></td>";
	print    "<td   align='center'  background='images/hover.png'><span class='header'>URAIAN<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>PAGU<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>REVISI (+/-)<span></td>";
	print    "<td   align='center'  background='images/hover.png' width='125'><span class='header'>PAGU STLH REVISI<span></td>";
	print    "<td   align='center' valign='middle' background='images/hover.png'><span class='header'>AKSI</td>";
  	print "</tr>
	
	<tr> 
        <td align='center' colspan='7'><img src='images/kosong.gif' ></td>
 	</tr>
</table>";	

}
print "<center><span class='komeng'>";
//echo "total: " . $hal_array["total"]; // tampilkan total data */
echo $hal_array["pagination"]; // tampilkan pagination dibawah
?>
</span></center><br>
