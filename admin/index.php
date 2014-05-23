<?php
ob_start();
session_start();

include("../config.php");
include("../function.php");

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
		<meta name="title" content="">
		<title>Magolcsay Nagy Gábor - admin</title>

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="icon" type="image/x-icon" href="../favicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Titillium+Web&amp;subset=latin,latin-ext" />
		<link rel="stylesheet" href="../style/normalize.css">
		<link rel="stylesheet" href="../style/main.css">
		<link rel="stylesheet" href="../style/admin.css">

		<script src="../script/modernizr-2.6.2.min.js"></script>
	</head>
	<body class="admin">
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->

<?php include("bar.php"); ?>
		<div class="content">
<?php
if(isset($_SESSION["username"])) {
	if(isset($_GET["b"])) {
		include($_GET["b"].".php");
	} else {
		include("main.php");
	}
} else {
	include("login.php");
}
?>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../script/jquery-1.8.2.min.js"><\/script>')</script>
		<script src="../script/jquery.jscrollpane.min.js"></script>
		<script src="../script/jquery.mousewheel.js"></script>
		<script src="../script/plugins.js"></script>
		<script src="../script/cb_admin.js"></script>
		<script src="../script/admin.js"></script>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<!-- script>/*
			var _gaq=[['_setAccount','UA-19437589-1'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		*/</script -->
	</body>
</html>
<?php ob_end_flush(); ?>
