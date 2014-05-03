<div class="text-content">

<?php

createFile("file");
createFile("picture");

if($_SESSION["privilege"] == "user") {
	if(isset($_POST["save"])) {
		$p = $_POST["p"];
		$date = date("Y-m-d H:i:s");
		$title = htmlspecialchars($_POST["title"]);
		$text = $_POST["text"];
		$language = htmlspecialchars($_POST["language"]);
		$published = ($p == "publications") ? "1" : "0";
		$query = "INSERT INTO mng_".$p." (date, title, text, language, published) VALUES ('$date', '$title', '$text', '$language', '$published')";
		mysql_query($query);
		header("Location: index.php?b=list&p=$p");
	} elseif(isset($_POST["cancel"])) {
		$p = $_POST["p"];
		header("Location: index.php?b=list&p=$p");
	}
?>

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
//<![CDATA[
	tinyMCE.init({
		mode : "exact",
		theme : "advanced",
		elements : "new_entry",
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
<h1>Új bejegyzés írása</h1>
<div class="admin-form">
	<form action="?b=new" method="post">
		<input type="hidden" name="p" value="<?php echo $_GET["p"]; ?>" />

<?php if (!in_array($_GET["p"], $excluded, true)) { ?>

		<div class="row">
			<label>Cím:</label>
			<input type="text" placeholder="Cím" name="title" />
		</div>

<?php } ?>

		<div class="row">
			<label>Szöveg:</label>
			<textarea name="text" id="new_entry" rows="" cols=""></textarea>
		</div>

<?php if (in_array($_GET["p"], $excluded, true)) { ?>

		<div class="row">
			<label>nyelv:</label>
			<select name="language">
				<option value="">Válassz</option>
				<option value="hu">magyar</option>
				<option value="en">angol</option>
			</select>
		</div>

<?php } ?>

		<div class="btn">
			<ul>
				<li><input type="submit" name="save" value="Mehet" /></li>
				<li><input type="submit" name="cancel" value="Mégsem" /></li>
			</ul>
		</div>
	</form>
</div>

<?php
} else {
	echo "<p>Nincs jogosultságod új bejegyzést írni!</p>";
	header("Refresh: 2 url=index.php?b=list&p=$p");
}
?>

</div>