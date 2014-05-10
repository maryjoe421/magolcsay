<?php
include("../config.php");

$p = $_GET["p"];

if($_SESSION["privilege"] == "user") {
	if(isset($_GET["id"])) {
		$id = $_GET["id"];
		$id_check = "SELECT * FROM mng_".$p." WHERE id='$id'";
		if($is_id = mysql_query($id_check) and mysql_num_rows($is_id) > 0){
			$del_post = "DELETE FROM mng_".$p." WHERE id='$id'";
			mysql_query($del_post);
			header("location: index.php?b=list&p=$p");
		} else {
			echo "<p>HIBA: Nincs ilyen azonosító! (".$_GET["id"].")</p>";
			header("refresh: 2 url=index.php?b=list&p=$p");
		}
	} else {
		echo "<p>HIBA: Nem kaptam azonosítót!</p>";
		header("refresh: 2 url=index.php?b=list&p=$p");
	}
} else {
	header("location: index.php?b=list&p=$p");
}
?>