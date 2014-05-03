<div class="text-content">

<?php

createFile("file");
createFile("picture");

if($_SESSION["privilege"] == "user") {
	if(isset($_POST["save"])) {
		$p = $_POST["p"];
		$id = $_POST["id"];
		$date = ($_POST["date"] != '') ? $_POST["date"] : date("Y-m-d H:i:s");
		$title = htmlspecialchars($_POST["title"]);
		$text = $_POST["text"];
		$language = htmlspecialchars($_POST["language"]);
		$published = ($p == "publications") ? "1" : "0";
		$id_check = "SELECT * FROM mng_".$p." WHERE id='$id'";
		if($is_id = mysql_query($id_check) and mysql_num_rows($is_id) > 0){
			$query = "UPDATE mng_".$p." SET date='$date', title='$title', text='$text', language='$language', published='$published' WHERE id='$id'";
			mysql_query($query);
			header("Location: index.php?b=list&p=$p");
		} else {
			echo "<p>HIBA: Nincs ilyen azonosító! ($id)</p>";
			header("Refresh: 2 url=index.php?b=list&p=$p");
		}
	} elseif(isset($_POST["cancel"])) {
		$p = $_POST["p"];
		header("Location: index.php?b=list&p=$p");
	} else {
		if(isset($_GET["id"])) {
			$p = $_GET["p"];
			$id = $_GET["id"];
			$query = "SELECT * FROM mng_".$p." WHERE id='$id'";
			$result = mysql_query($query);
			$result_row = mysql_fetch_array($result);
?>

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
//<![CDATA[
	tinyMCE.init({
		mode : "exact",
		theme : "advanced",
		elements : "mod_entry",
		skin : "default",
		skin_variant : "black",
		plugins : "contextmenu, table",
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,|,outdent,indent,|,undo,redo,|,link,unlink,|,image,|,table,|,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		external_link_list_url : "file_list.js",
		external_image_list_url : "picture_list.js"
	});
//]]>
</script>
<h1>Bejegyzés módosítása</h1>
<div class="admin-form">
	<form action="?b=mod" method="post">
		<input type="hidden" name="p" value="<?php echo $_GET["p"]; ?>" />
		<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />

<?php if (!in_array($_GET["p"], $excluded, true)) { ?>

		<div class="row">
			<label>Cím:</label>
			<input type="text" name="title" placeholder="Cím" value="<?php echo $result_row["title"]?>" />
		</div>
		<div class="row">
			<label>Dátum:</label>
			<input type="text" name="date" placeholder="Dátum" value="<?php echo $result_row["date"]?>" />
		</div>

<?php } ?>

		<div class="row">
			<label>Szöveg:</label>
			<textarea name="text" id="mod_entry" rows="" cols=""><?php echo $result_row["text"]?></textarea>
		</div>

<?php if (in_array($_GET["p"], $excluded, true)) { ?>

		<div class="row">
			<label>nyelv:</label>
			<select name="language">
				<option value="">Válassz</option>
				<option value="hu"<?php if ($result_row["language"] == "hu") { echo ' selected="selected"'; } ?>>magyar</option>
				<option value="en"<?php if ($result_row["language"] == "en") { echo ' selected="selected"'; } ?>>angol</option>
			</select>
		</div>

<?php } ?>

		<div class="btn">
			<ul>
				<li><input type="submit" name="save" value="Módosítás" /></li>
				<li><input type="submit" name="cancel" value="Mégsem" /></li>
			</ul>
		</div>
	</form>
</div>

<?php
		} else {
			echo "<p>HIBA: Nincs ilyen azonosító! ($id)</p>";
			header("Refresh: 2 url=index.php?b=list&p=$p");
		}
	}
} else {
	echo "<p>Nincs jogosultságod új bejegyzést írni!</p>";
	header("Refresh: 2 url=index.php?b=list&p=$p");
}
?>

</div>