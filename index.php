<?php
	ob_start();
	session_start();
	include("config.php");
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-language" content="hu">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="title" content="">
		<meta name="description" content="Magolcsay Nagy Gábor 1981-ben született Miskolcon, jelenleg Budapesten él. Költő, zeneszerző. Szövegei számos irodalmi folyóiratban és antológiában olvashatók. Ashes of Cows nevű zenei projektjével jelenleg az ambient, az indusztriális és a szimfónikus rock határterületein kísérletezik.">
		<meta name="keywords" content="Patron, Prága-Bukarest Residency, egorombolók, csoportos kiállítás, amaTÁR kiállítótér, FKSE Stúdió Galéria, Roham bár, Attention Alkotóműhely, műhely, logo-mandala, Képpel való navigáció és felderítés, A perc, Hajnalban,Ködben imbolygó, Líra meg tükör, Márcidus, cupiditati nihil est satis, Gesztenyés, Hölgyfacsordák árnyékában, Két dével, Olga, Vőlegény, Műesés, Lakatlan hold, Létrom, Pikszis, Sárga sörény, Tombola tavasz, A hiánynak nincs megoldóképlete csak komikusan homorú filozófiája van, 20090501, Miért nem felelsz, Miskolc Tiszai pu., szerelem I., Üres kerék, Ashes of Cows, Nine Days On Yggdrasil, Key and Tree, Drain, Cloud Below Zero, Dead Window (on your Forehead), Light Upset, Honeydew, Home Rolls Away, Apocalyptic Poetry, Pole Shift">
		<meta name="robots" content="all, index, follow">
		<meta name="googlebot" content="all">
		<meta name="copyright" content="Copyright 2012 Magolcsay Nagy Gábor">
		<meta name="author" content="Leszkó Márió">
		<meta name="viewport" content="width=device-width">
		<meta property="og:site_name" content="Magolcsay Nagy Gábor">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://www.magolcsay.hu/">
		<meta property="og:title" content="">
		<meta property="og:description" content="">
		<meta property="og:image" content="">
		<title>Magolcsay Nagy Gábor</title>

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="icon" type="image/x-icon" href="/favicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Titillium+Web&amp;subset=latin,latin-ext" type="text/css">
		<link rel="stylesheet" href="style/normalize.css">
		<link rel="stylesheet" href="style/main.css">
		<link rel="stylesheet" href="style/admin.css">

		<script src="script/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->

<?php include "admin/bar.php"; ?>
		<header>
			<nav>
				<ul class="menu">
					<li id="bio"><a href="#bio" title="bio"><span>bio</span></a></li>
					<li id="logo_mandala"><a href="#logo_mandala" title="logo-mandala"><span>logo-mandala</span></a></li>
					<li id="workshop"><a href="#workshop" title="workshop"><span>műhely</span></a></li>
					<li id="ashes_of_cows"><a href="#ashes_of_cows" title="ashes of cows"><span>ashes of cows</span></a></li>
					<li id="things"><a href="#things" title="things"><span>dolgok</span></a></li>
					<li id="events"><a href="#events" title="events"><span>események</span></a></li>
					<li id="contact"><a href="#contact" title="contact"><span>kapcsolat</span></a></li>
					<li id="publications"><a href="#publications" title="publications"><span>publikációk</span></a></li>
					<li id="admin"><a href="admin" title="admin"><span>admin</span></a></li>
				</ul>
			</nav>
		</header>
		<div class="content">

<? foreach ($all_menuitems as $item) {
	echo '
		<!-- '.$item.' -->
		<section id="'.$item.'_container">
		';
			include('pages/'.$item.'.php');
	echo '
		</section>
		<!-- '.$item.' -->
		';
} ?>

		</div>

		<div class="bg-image"></div>
		<div class="section-layer"></div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="script/jquery-1.8.2.min.js"><\/script>')</script>
		<script src="script/jquery.arctext.js"></script>
		<script src="script/jquery.wavetext.js"></script>
		<script src="script/jquery.jplayer.min.js"></script>
		<script src="script/jquery.jscrollpane.min.js"></script>
		<script src="script/jquery.mousewheel.js"></script>
		<script src="script/plugins.js"></script>
		<script src="script/clearbox.js"></script>
		<script src="script/main.js"></script>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			var _gaq=[['_setAccount','UA-19437589-1'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
	</body>
</html>

<?php ob_end_flush(); ?>
