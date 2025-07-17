<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>e-Wabku</title>
<style>
body {
 
  font-size: 14px;
  line-height: 32px;
  color: #333;
  margin: 0;
  padding: 0;
  word-wrap: break-word !important;
  font-family: 'montserrat', sans-serif;
}


a { color: #FFF; }


#container {
  margin: 0 auto;
  max-width: 890px;
}

p { text-align: center; }
 .toggle, [id^=drop] {
 display: none;
}

nav {
  margin: 0;
  padding: 0;
  background-color: #083303;
}

#logo {
  display: block;
  padding: 0 30px;
  float: left;
  font-size: 20px;
  line-height: 60px;
  color:#ffffff;
}

nav:after {
  content: "";
  display: table;
  clear: both;
}

nav ul {
  float: right;
  padding: 0;
  margin: 0;
  list-style: none;
  position: relative;
}

nav ul li {
  margin: 0px;
  display: inline-block;
  float: left;
  background-color: #083303;
  
}

nav a {
  display: block;
  padding: 0 20px;
  color: #FFF;
  font-size: 18px;
  line-height: 60px;
  text-decoration: none;
}

nav ul li ul li:hover { background: #000000; }

nav a:hover { background-color: #000000; }

nav ul ul {
  display: none;
  position: absolute;
  top: 60px;
}

nav ul li:hover > ul { display: inherit; }

nav ul ul li {
  width: 170px;
  float: none;
  display: list-item;
  position: relative;
}

nav ul ul ul li {
  position: relative;
  top: -60px;
  left: 170px;
}

li > a:after { content: ' +'; }

li > a:only-child:after { content: ''; }


/* Media Queries
--------------------------------------------- */

@media all and (max-width : 768px) {

#logo {
  display: block;
  padding: 0;
  width: 100%;
  text-align: center;
  float: none;
}

nav { margin: 0; }

.toggle + a,
 .menu { display: none; }

.toggle {
  display: block;
  background-color: #254441;
  padding: 0 20px;
  color: #FFF;
  font-size: 20px;
  line-height: 60px;
  text-decoration: none;
  border: none;
}

.toggle:hover { background-color: #000000; }

[id^=drop]:checked + ul { display: block; }

nav ul li {
  display: block;
  width: 100%;
}

nav ul ul .toggle,
 nav ul ul a { padding: 0 40px; }

nav ul ul ul a { padding: 0 80px; }

nav a:hover,
 nav ul ul ul a { background-color: #000000; position: relative;}

nav ul li ul li .toggle,
 nav ul ul a { background-color: #212121; }

nav ul ul {
  float: none;
  position: static;
  color: #ffffff;
}

nav ul ul li:hover > ul,
nav ul li:hover > ul { display: none; }

nav ul ul li {
  display: block;
  width: 100%;
}

nav ul ul ul li { position: static;

}
}

@media all and (max-width : 330px) {

nav ul li {
  display: block;
  width: 94%;
}

}
</style>
</head>

<body>
<nav>
  <div id="logo">&nbsp;&nbsp;&nbsp;E-WABKU</div>
  <label for="drop" class="toggle">Menu</label>
  <input type="checkbox" id="drop" />
  <ul class="menu">
    <li><a href="amatunamalah.php?content=awalu">Home </a></li>
    <li> 
      <!-- First Tier Drop Down -->
    <label for="drop-6" class="toggle">Laporan BK +</label>
      <a href="#">Laporan BK</a>
      <input type="checkbox" id="drop-6"/>
      <ul>
        <li><a href="#">Service 1</a></li>
        <li><a href="#">Service 2</a></li>
        <li><a href="#">Service 3</a></li>
      </ul>
    </li>
    <li> 
      
      <!-- First Tier Drop Down -->
      <label for="drop-2" class="toggle">Portfolio +</label>
      <a href="#">Portfolio</a>
      <input type="checkbox" id="drop-2"/>
      <ul>
        <li><a href="#">Portfolio 1</a></li>
        <li><a href="#">Portfolio 2</a></li>
        <li> 
          
          <!-- Second Tier Drop Down -->
          <label for="drop-3" class="toggle">Works +</label>
          <a href="#">Works</a>
          <input type="checkbox" id="drop-3"/>
          <ul>
            <li><a href="#">HTML/CSS</a></li>
            <li><a href="#">jQuery</a></li>
            <li><a href="#">Python</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
	<!-- First Tier Drop Down -->
      <label for="drop-4" class="toggle">Referensi +</label>
      <a href="#">Referensi</a>
      <input type="checkbox" id="drop-4"/>
	 <ul>
		<li><a href="amatunamalah.php?content=user">Data User</a></li>
        <li><a href="#">Ku Kotama</a></li>
        <li><a href="#">Ku Satker</a></li>
        
      </ul>
	</li>
    <li><a href="#">Submit</a></li>
    <li><a href="#">Contact</a></li>
    <li><a href="#">About</a></li>
  </ul>
</nav>

<div class="css-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* CSSScript Demo Page */
google_ad_slot = "3025259193";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script> 
      <script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');

</script>
</body>
</html>
