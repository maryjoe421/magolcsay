<div class="text-content">

<?php

if($_SESSION["privilege"] == "user") {
?>

	<h1>Fájlok feltöltése</h1>
	<p>A feltöltendő fájlokat hozd a következő formába <b>more_than_one_word.mp3, tukor_meg_lira.png, stb.</b>, vagyis az elnevezés során ügyelj arra, hogy <b>szóköz</b> illetve <b>ékezetes- és speciális karakter</b> (&amp;, @, #, &lt;, &gt;, $, /, =, stb.) ne legyen benne!<br />Ezek alapján nevezd át kérlek!</p>

<?php
	require_once "fileupload/class.FlashUploader.php";
	IAF_display_js();
	$uploader = new FlashUploader("uploader", "fileupload/uploader", "http://" . $_SERVER["SERVER_NAME"] . "/" . getFilePath("index.php") . "fileupload/upload.php");
	$uploader->display();
} else {
	echo "<p>Nincs jogosultságod új fájlt feltölteni!</p>";
	header("Refresh: 3 url=index.php");
}
?>

</div>