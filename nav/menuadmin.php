<link href="nav/style.css" rel="stylesheet" type="text/css" />
<link href='library/boxicons/css/boxicons.min.css' rel='stylesheet'>
<nav id="menu-wrap">    
	<ul id="menu">
		<li><a href="media.php?module=beranda"><i class='bx bx-home' ></i> Home</a></li>
                <li><a href="media.php?module=user"><i class='bx bx-user' ></i> Data User</a></li>
				<li><a href="#"><i class='bx bx-server' ></i> Kode Program</a>
                    <ul class="submenu">
						 <li><a href="media.php?module=program">program</a></li>
                        <li><a href="media.php?module=giat">Giat</a></li>
                        <li><a href="media.php?module=output">Output</a></li>
                        <li><a href="media.php?module=akun">Akun</a></li>
				    	<li><a href="media.php?module=subakun">Sub Akun</a></li> 
						<li><a href="media.php?module=backup_subakun">Backup Sub Akun</a></li>
						<li><a href="media.php?module=restore_subakun">Restore Sub Akun</a></li>
                    </ul>
                </li>
				<li><a href="#"><i class='bx bx-building' ></i> Kotama/Satker</a>
                    <ul class="submenu">
                        <li><a href="media.php?module=kotama">Kotama / Balakpus</a></li>
						<li><a href="media.php?module=satker">Satker</a></li>
                    </ul>
                </li>
                <li class="active"><a href="#"><i class='bx bx-server' ></i> Utility</a>
                    <ul class="submenu">
                        <li><a href="media.php?module=validitassatker_0cc175b9c0f1b6a831c399e269772661">Cek validitas Satker</a></li> 
                        <li><a href="media.php?module=validitasktm_0cc175b9c0f1b6a831c399e269772661">Cek validitas Kotama</a></li>
						
						
                    </ul>
                </li>

             
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

