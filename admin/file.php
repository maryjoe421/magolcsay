<div class="text-content">
<?php
if($_SESSION["privilege"] == "user") {
	if(isset($_GET['pic'])) {
		unlink('../picture/' . $_GET['pic']);
		header("location: index.php?b=file");
	}
?>
	<h1>Fájlok feltöltése</h1>
	<p>A feltöltendő fájlokat hozd a következő formába <b>more_than_one_word.mp3, tukor_meg_lira.png, stb.</b>, vagyis az elnevezés során ügyelj arra, hogy <b>szóköz</b> illetve <b>ékezetes- és speciális karakter</b> (&amp;, @, #, &lt;, &gt;, $, /, =, stb.) ne legyen benne! Ezek alapján nevezd át kérlek!</p>
<?php
	require_once "fileupload/class.FlashUploader.php";
	IAF_display_js();
	$uploader = new FlashUploader("uploader", "fileupload/uploader", "http://" . $_SERVER["SERVER_NAME"] . "/" . getFilePath("index.php") . "fileupload/upload.php");
	$uploader->display();
} else {
	echo "<p>Nincs jogosultságod új fájlt feltölteni!</p>";
	header("refresh: 3 url=index.php");
}
?>
</div>
<section id="image_container">
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">
				<h2>Feltöltött képek</h2>
<?php
	if ($handle = opendir('../picture')) {
		echo '<ul class="image-list">';
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo '<li>
						<a href="../picture/'.$entry.'" target="_blank">'.$entry.'</a>
						<a href="?b=file&pic='.$entry.'" title="kép törlése">×</a>
					</li>';
			}
		}
		echo '</ul>';
		closedir($handle);
	} else {
		echo '<p>Empty directory!</p>';
	}
?>
			</div>
		</div>
	</div>
</section>