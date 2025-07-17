
 <link rel="stylesheet" href="library/style_pencarian.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="library/style_table.css" type="text/css" media="screen" />
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
 
		$query = mysql_query("select a.*, b.nmkotama, c.nmkusatker from t_satkr  a left join t_kotam b on a.kdkotama=b.kdkotama 
		left join t_kusatker c on a.kdkusatker=c.kdkusatker ".$where."");
		//$total_pages = mysql_fetch_array(mysql_query($query));
		//$total_pages = $total_pages['num'];
		$total_pages = mysql_num_rows($query);
 
		if($page) {
			$start = ($page - 1) * $limit; 			//first item to display on this page
		} else {
			$start = 0;								//if no page var is given, set start to 0
		}
		// Get data.
		$query = "select a.*, b.nmkotama, c.nmkusatker from t_satkr  a left join t_kotam b on a.kdkotama=b.kdkotama 
		left join t_kusatker c on a.kdkusatker=c.kdkusatker ".$where." ".$order." LIMIT ".$start.", ".$limit."";
		
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
$hal->setOption("where", "WHERE kdsatkr like '%$_POST[txtcari]%' or nmsatkr like '%$_POST[txtcari]%' or nmkotama like '%$_POST[txtcari]%'"); // where kondisi, kosongkan jika tidak memakai WHERE
$hal->setOption("limit", "75"); // LIMIT tampilan per halaman
$hal->setOption("order", "ORDER BY kdkotama, kdsatkr"); // urutan, kosongkan jika tidak memakai urutan
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


echo "<center><br><span class='judul'>TABEL SATKER</span></center><br>";
?>

<table   align="center" width="98%"  cellpadding="3" > 
	<tr>
		<td >
			<div class="button_box2">
			<form class="form-wrapper-2 cf" method="POST" action="media.php?module=satker" >
			<input type="text" name="txtcari" placeholder="Ketik Kata Kunci Pencarian" >
			<button type="submit">C a r i</button>
			</form>
			</div>
		</td>
    </tr>
</table>	



<?php

   
print" <table  align='center' width='98%'>
	<tr>
		<td align='left'><a href='media.php?module=inputsatker' class='button blue'>TAMBAH DATA</a></td>
	
	
		<td align='right' class='subyek1'>"; if ($_POST[txtcari]=='') { print "<span class='subyek1'>Total : " . $hal_array["total"] ." Record"; 
			   } else {
			   echo "Ditemukan : " . $hal_array["total"]; print " record dengan kata kunci : <strong>$_POST[txtcari]</strong></span>"; 
			   } 
print"  </td></tr>
	</table><br>";


  
if ($hal_array['total'] > 0) {

print "<table width='98%'  cellspacing='5' cellpadding='5' align='center'  class='bordered'>";
	print "<tr bgcolor='#dce9f9' >";
	print    "<th   align='center' height='25' width='5%' > NO</th>";
	print    "<th   align='center'>KODE DEPT</th>";
	print    "<th   align='center'>KODE UNIT</th>";
	print    "<th   align='center'>KODE KOTAMA</th>";
	print    "<th   align='center'>KODE SATKER</th>";
	print    "<th   align='center'>KOTAMA</th>";
	print    "<th   align='center'>SATKER</th>";
	print    "<th   align='center'>KU SATKER</th>";		
	print    "<th   colspan='2' align='center' valign='middle'>AKSI</th>";
	print "</tr>";

//	$sql="select * from t_satkr"; 
//    $qry=mysql_query($sql);
	

	while($row = mysql_fetch_array($hal_array["hasil"])){
 
	print "<tr ><td align='center'>$no</td>";
	print "<td align='center'>$row[kddept]</td>";
	print "<td align='center'>$row[kdunit]</td>";
	print "<td align='center'>$row[kdkotama]</td>";
	print "<td align='center'>$row[kdsatkr]</td>";
	print "<td >$row[nmkotama]</td>";
	print "<td >$row[nmsatkr]</td>";
	print "<td >$row[nmkusatker]</td>";	
   // print "<td  align='center'><a href='media.php?module=editsatker&id=$row[id]'><img src='images/edit.png' width='20' title='Edit'></a></td>";
   if ($_SESSION[kdsatker]> '00'){
	
	}else
	{
    print "<td  align='center'><a href='media.php?module=editsatker&id=$row[id]&kdkotama=$row[kdkotama]'><img src='images/edit.png' width='20' title='Edit'></a></td>";
	print"<td  align='center' valign='top'><a href=\"pengelola/satker/proses.php?aksi=hapus&id=$row[id]\" onClick=\"return confirm('APAKAH ANDA AKAN MENGHAPUS SATKER ~ $row[nmsatkr] ~? ')\" ><img src='images/delete.png' width='20' title='Delete'></td>"; 
   }
    $no++;
     }
  print "</table>";
  print "<br><center>";
  


} else {

print "<table width='98%'  cellspacing='5' cellpadding='5' align='center'  class='bordered'>";
	print "<tr bgcolor='#dce9f9' >";
	print    "<th   align='center' height='25' width='5%' > NO</th>";
	print    "<th   align='center'>KODE DEPT</th>";
	print    "<th   align='center'>KODE UNIT</th>";
	print    "<th   align='center'>KODE KOTAMA</th>";
	print    "<th   align='center'>KODE SATKER</th>";
	print    "<th   align='center'>KOTAMA</th>";
	print    "<th   align='center'>SATKER</th>";
	print    "<th   align='center'>KU SATKER</th>";		
	print    "<th   colspan='2' align='center' valign='middle'>AKSI</th>";
	print "</tr>
	
	<tr> 
        <td align='center' colspan='9'><img src='images/kosong.gif' ></td>
 	</tr>
	</table>";	
}
print "<center><span class='subyek1'>";
//echo "total: " . $hal_array["total"]; // tampilkan total data */
echo          $hal_array["pagination"]; // tampilkan pagination dibawah
?>
<br></span></center><br>

  

   

