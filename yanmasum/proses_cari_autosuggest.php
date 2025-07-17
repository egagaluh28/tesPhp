
<style>
#result {
	height:20px;
	font-size:12px;
	font-family:"Geneva", sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#kodespa{
	padding:3px;
	border:1px #CCC solid;
	font-size:12px;
}
.suggestionsBox {
	position: absolute;
	left: 420px;
	top:685px;
	margin: 26px 0px 0px 0px;
	width: 600px;
	padding:0px;
	background-color:#ffffcc;
	border-top: 3px solid #666;
	border-bottom: 1px solid #666;
	border-left: 1px solid #666;
	border-right: 1px solid #666;
	color: #666;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:"Geneva", sans-serif;
	font-size:14px;
	color:#333333;
	padding:0;
	margin:0;
}

.load{
background-image:url(pagu/loading.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
</style>
<?

	  $db = new mysqli('localhost', 'root' ,'', 'dblaplakgar2024');
	
	if(!$db) {
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $db->query("select z.*  from (select a.*, b.nmgiat, c.nmoutput,  d.nmakun, e.nmprogram, f.nmwasgiat, h.nmdipa from t_sakun a
left join t_giat b on a.kdgiat=b.kdgiat
left join t_output c on a.kdgiat=c.kdgiat and a.kdoutput=c.kdoutput
left join t_akun d on a.kdakun=d.kdakun 
left join t_program e on b.kdprogram=e.kdprogram
left join t_wasgiat f on a.kdwasgiat=f.kdwasgiat
left join t_dipa h on a.kddipa=h.kddipa where a.kddipa='3') as z
WHERE  z.nmsakun like'%" .$queryString . "%' or z.kdgiat like'%" .$queryString . "%'
									 or z.kdakun like'%" .$queryString . "%' or z.nmgiat like'%" .$queryString . "%'
									 order by z.kdprogram, z.kdgiat, z.kdoutput, z.kdakun, z.kdsakun");
				
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fillnmwasgiat(\''.addslashes($result->nmwasgiat).'\');
										   fillkdwasgiat(\''.addslashes($result->kdwasgiat).'\');
										   fillnmprogram(\''.addslashes($result->nmprogram).'\');
										   fillkdprogram(\''.addslashes($result->kdprogram).'\'); 
										   fillnmsakun(\''.addslashes($result->nmsakun).'\');
										   fillkdsakun(\''.addslashes($result->kdsakun).'\'); 
										   fillkdoutput(\''.addslashes($result->kdoutput).'\'); 
										   fillnmoutput(\''.addslashes($result->nmoutput).'\'); 
										   fillkdakun(\''.addslashes($result->kdakun).'\'); 
										   fillnmakun(\''.addslashes($result->nmakun).'\');
										   fillnmgiat(\''.addslashes($result->nmgiat).'\'); 
						                   fillkdgiat(\''.addslashes($result->kdgiat).'\');">'
						.$result->kdprogram.' | '.$result->kdgiat.' | '.$result->kdoutput.' | '.$result->kdakun.' | '.$result->nmsakun.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}