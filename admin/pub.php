<?php
session_start();
include("../config.php");
$p = $_GET["p"];
if($_SESSION["privilege"] == "user") {
	if(isset($_GET["id"])) {
		$id = $_GET["id"];
		$id_check = "SELECT * FROM mng_".$p." WHERE id='$id'";
		if($is_id = mysql_query($id_check) and mysql_num_rows($is_id) > 0){
			$pub_post = "UPDATE mng_".$p." SET published='1' WHERE id='$id'";
			mysql_query($pub_post);
			header("Location: index.php?b=list&p=$p");
		} else {
			echo "<p>HIBA: Nincs ilyen azonosító! ($id)</p>";
			header("Refresh: 2 url=index.php?b=list&p=$p");
		}
	} else {
		echo "<p>HIBA: Nem kaptam azonosítót!</p>";
		header("Refresh: 2 url=index.php?b=list&p=$p");
	}
} else {
	header("Location: index.php?b=list&p=$p");
}
?>