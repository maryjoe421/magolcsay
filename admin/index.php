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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Magolcsay Nagy Gábor - blog</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="hu" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Titillium+Web&amp;subset=latin,latin-ext" />
		<link rel="stylesheet" media="screen" type="text/css" href="../style/main.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="../style/admin.css" />
		<script type="text/javascript" src="../script/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="../script/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="../script/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="../script/admin.js"></script>
	</head>
	<body class="admin">
<?php
include("bar.php");
?>
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
	</body>
</html>
<?php ob_end_flush(); ?>
