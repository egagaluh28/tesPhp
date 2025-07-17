<link href="menut/style.css" rel="stylesheet" type="text/css" />

<nav id="menu-wrap">    
	<ul id="menu">
		<li><a href="media.php?module=beranda" class="first">Home</a></li>
		<li><a href="#">DIPA PUSAT &nbsp;&nbsp;&nbsp;<img src="images/panahputih.png" width="10"></li>
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

