<link href="menut/style.css" rel="stylesheet" type="text/css" />

<nav id="menu-wrap">    
	<ul id="menu">
		<li><a href="media.php?module=beranda">Home</a></li> 
                <li><a href="#">GAJI DAN TUNJANGAN</a>
                    <ul class="submenu">
                        <li><a href="media.php?module=formrealisasi_gaji_satker">TINGKAT SATKER</a></li>
                        <li><a href="media.php?module=formrealisasi_gaji_ktm">TINGKAT KOTAMA</a></li>
                        <li><a href="media.php?module=formrealisasi_gaji_uo">TINGKAT UO</a></li>
                    </ul>
                </li>
				
				   <li><a href="#">TUNJANGAN KINERJA</a>
                    <ul class="submenu">
                        <li><a href="media.php?module=formtunkin_satker">TINGKAT SATKER</a></li>
                        <li><a href="media.php?module=tunkin_ktm">TINGKAT KOTAMA</a></li>
                        <li><a href="media.php?module=tunkin_uo">TINGKAT UO</a></li>
                    </ul>
                </li>
                <li><a href="./logout.php">KELUAR</a></li>
	</ul>
	
</nav>


<script type="text/javascript" src="menut/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
		if ($.browser.msie && $.browser.version.substr(0,1)<7)
		{
		$('li').has('ul').mouseover(function(){
			$(this).children('ul').css('visibility','visible');
			}).mouseout(function(){
			$(this).children('ul').css('visibility','hidden');
			})
		}

		/* Mobile */
		$('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');		
		$("#menu-trigger").on("click", function(){
			$("#menu").slideToggle();
		});

		// iPad
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		if (isiPad) $('#menu ul').addClass('no-transition');      
    });          
</script>

