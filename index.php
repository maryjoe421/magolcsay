<?php
	ob_start();
	session_start();

	include("config.php");
	include("function.php");

	if(isset($_GET["p"])) {
		$p = $_GET['p'];
	} else {
		$p = '';
	}
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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="title" content="">
		<meta name="description" content="Magolcsay Nagy Gábor 1981-ben született Miskolcon. Költő, zenész. Logo-mandalákat, vizuális költeményeket és versprózákat ír, zenei és összművészeti projektekben vesz részt. A Metanoia Park vizuális költészeti projekt alapítója, alkotója és művészeti vezetője. Ashes of Cows név alatt az ambient és a pszichedelikus rock határterületein kísérletezik.">
		<meta name="keywords" content="Patron, Prága-Bukarest Residency, egorombolók, csoportos kiállítás, amaTÁR kiállítótér, FKSE Stúdió Galéria, Roham bár, Attention Alkotóműhely, műhely, logo-mandala, Képpel való navigáció és felderítés, A perc, Hajnalban,Ködben imbolygó, Líra meg tükör, Márcidus, cupiditati nihil est satis, Gesztenyés, Hölgyfacsordák árnyékában, Két dével, Olga, Vőlegény, Műesés, Lakatlan hold, Létrom, Pikszis, Sárga sörény, Tombola tavasz, A hiánynak nincs megoldóképlete csak komikusan homorú filozófiája van, 20090501, Miért nem felelsz, Miskolc Tiszai pu., szerelem I., Üres kerék, Ashes of Cows, Nine Days On Yggdrasil, Key and Tree, Drain, Cloud Below Zero, Dead Window (on your Forehead), Light Upset, Honeydew, Home Rolls Away, Apocalyptic Poetry, Pole Shift">
		<meta name="robots" content="all, index, follow">
		<meta name="googlebot" content="all">
		<meta name="copyright" content="Copyright 2012 Magolcsay Nagy Gábor">
		<meta name="author" content="Leszkó Márió">

		<meta property="og:locale" content="hu_HU">
		<meta property="og:locale:alternate" content="en_US" >
		<meta property="og:site_name" content="Magolcsay Nagy Gábor">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://www.magolcsay.hu/">
		<meta property="og:title" content="Magolcsay Nagy Gábor">
		<meta property="article:publisher" content="https://www.facebook.com/magolcsay">

		<title>Magolcsay Nagy Gábor</title>

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="icon" type="image/x-icon" href="/favicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Titillium+Web&amp;subset=latin,latin-ext" type="text/css">
		<link rel="stylesheet" href="style/normalize.css">
		<link rel="stylesheet" href="style/main.css">
		<link rel="stylesheet" href="style/admin.css">

		<script src="script/modernizr-2.6.2.min.js"></script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->

<?php
	$adminpath = 'admin/';
	include($adminpath . 'bar.php');
?>
		<header>
			<nav>
				<ul class="menu">

<?php
	$m = 0;
	foreach ($editable_menuitems as $item => $name) {
		$m++;
		echo '
					<li id="item' . $m . '"><a href="#' . $item . '" title="' . $item . '"><span>' . $name . '</span></a></li>';
} ?>

					<li id="ashes_of_cows"><a href="#ashes_of_cows" title="ashes of cows"><span>ashes of cows</span></a></li>
					<li id="admin"><a href="admin" title="admin"><span>admin</span></a></li>
				</ul>
			</nav>
		</header>
		<div class="content">

<?php
	$c = 0;
	foreach ($editable_menuitems as $item => $name) {
		$c++;
		echo '
			<!-- ' . $name . ' -->
			<section id="item' . $c . '_container" rel="' . $item . '"></section>
			<!-- ' . $name . ' -->
			';
} ?>

			<!-- ashes_of_cows -->
			<section id="ashes_of_cows_container" rel="ashes_of_cows">

<?php
	include('ashes_of_cows.php');
?>

			</section>
			<!-- ashes_of_cows -->
			<!-- div class="fb-like-box" data-href="https://www.facebook.com/magolcsay" data-width="420" data-height="540" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="false"></div -->
		</div>

		<div class="bg-image"></div>
		<div class="section-layer"></div>
		<!-- div class="fb-like" data-href="http://magolcsay.hu/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="script/jquery-1.8.2.min.js"><\/script>')</script>
		<script src="script/jquery.arctext.js"></script>
		<script src="script/jquery.jplayer.min.js"></script>
		<script src="script/jquery.jscrollpane.min.js"></script>
		<script src="script/jquery.mousewheel.js"></script>
		<script src="script/plugins.js"></script>
		<script src="script/cb_main.js"></script>
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

<?php
	ob_end_flush();
?>
