<link href="meenuu/style.css" rel="stylesheet" type="text/css" />

<nav id="menu-wrap">    
	<ul id="menu">
		<li><a href="media.php?module=beranda">Home</a></li>
              
				
				<li><a href="#s1">DIPA DAERAH&nbsp;<img src="images/panahputih.png" width="10"></a>
                    <ul class="submenu">
						  <li><a href="media.php?module=formc_mon_daerah_satker_wasgiat_u_ktm">CETAK mon SATKER PER WASGIAT</a></li>
						  <li><a href="media.php?module=formc_daerah_ktm_wasgiat_u_uo">CETAK mon KOTAMA PER WASGIAT</a></li>
					</ul>
                </li>
				
				<li><a href="media.php?module=validitasktm_0cc175b9c0f1b6a831c399e269772661">Absensi Kotama</a>
						<ul>
								<li><a href="media.php?module=validitasktm_0cc175b9c0f1b6a831c399e269772661&thang=2019">TAHUN ANGGARAN 2019</a></li>
								
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

