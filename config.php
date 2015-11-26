<?php
header("content-type: text/html; charset=utf-8");
// Itt állítsd be a MySQL-hez való kapcsolódást!

$sql_host = "localhost";    // MySQL szerver ***Ez általában localhost!***
$sql_felhasznalo = "magolcsay";  // MySQL felhasználónév
$sql_jelszo = "D74B8F6468";    // MySQL jelszó
$sql_adatbazis = "880_blog";    // MySQL adatbázis

// kapcsolódás a MYSQL szerverhez... Ezt a részt ne változtasd meg!
// mysql_connect("$sql_host", "$sql_felhasznalo", "$sql_jelszo") or die("Nem lehet csatlakozni a MySQL kiszolgálóhoz!");
// mysql_select_db("$sql_adatbazis") or die("Nem tudtam kiválasztani az adatbázist! (<b>$sql_adatbazis</b>)");

mysql_connect("$sql_host", "$sql_felhasznalo", "$sql_jelszo") or die('<div class="holder"><div class="scroll-pane"><div class="text-content"><h2>MySql hiba</h2><p>Nem lehet csatlakozni a MySQL kiszolgálóhoz!</p></div></div></div>');
mysql_select_db("$sql_adatbazis") or die('<div class="holder"><div class="scroll-pane"><div class="text-content"><h2>Adatbázis hiba</h2><p>Nem tudtam kiválasztani az adatbázist!</p></div></div></div>');
mysql_query('SET NAMES utf8');


// gyakran változó tartalmak
$included = array("publications", "reception", "events");

// ritkán változó tartalmak
$excluded = array("bio", "books", "contact");

// menüelemek
$editable_menuitems = array(
	"bio" => "bio",
	"books" => "könyvek",
	"publications" => "publikációk",
	"reception" => "recepció",
	"events" => "események",
	"contact" => "kapcsolat"
);

$languages = array(
	"hu" => "magyar",
	"en" => "english"
);

// nincs dátum szerinti rendezés
$orderbynone = array("publications");

?>