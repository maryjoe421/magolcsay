<?php
if($_SESSION["privilege"] == "user") {
?>

<div class="text-content">
	<h1>Fájlok feltöltése</h1>
	<p>A feltöltendő fájlok nevei csak <b>kis- és nagy-, ékezet nélküli betűket</b> ill. <b>számokat</b> tartalmazhatnak, továbbá a mérete max. 2Mb lehet!</p>
</div>
<div class="admin-form">
<?php
	if(isset($_FILES["file"])) {
		$filename = $_FILES["file"]["name"];
		$filename = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
		$filetemp_name = $_FILES["file"]["tmp_name"];
		$fileerror = $_FILES["file"]["error"];
		$filesize = $_FILES["file"]["size"];
		$filetype = $_FILES["file"]["type"];
		$allowedExts = array("gif", "jpeg", "jpg", "png", "mp3");
		$mimetypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png", "audio/mpeg", "audio/mpeg3", "audio/x-mpeg-3", "audio/mp3");
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$captcha = $_POST['captcha'];

		if($extension == "mp3") {
			$uploadPath = "../file/";
		} else {
			$uploadPath = "../picture/";
		}
		if (strtolower(trim($captcha)) != $_SESSION['captcha']) {
			echo '<p class="warning">Nem megfelelő a beírt szó!</p>';
		} else {
			if (in_array($filetype, $mimetypes) && in_array($extension, $allowedExts)) { // ($filesize < 10485760)
				if ($fileerror > 0) {
					echo '<p class="warning">Return Code: ' . $fileerror . '</p>';
				} else {
					echo '<p class="text-center">upload: ' . $filename . ', type: ' . $filetype . ', size: ' . $filesize . ' byte, temp file: ' . $filetemp_name . '</p>';
					if (file_exists($uploadPath . $filename)) {
						chmod($uploadPath . $filename, 0755);
						unlink($uploadPath . $filename);
					} else {
						move_uploaded_file($filetemp_name, $uploadPath . $filename);
					}
					if($extension == "mp3") {
						createFile("file");
					} else {
						createFile("picture");
					}
					header("location: index.php?b=file");
				}
			} else {
				echo '<p class="warning">Nem tölthetsz fel ilyen fájlt!</p>';
			}
		}
	}

	if(isset($_GET['item'])) {
		unlink($_GET['item']);
		createFile("picture");
		createFile("file");
		header("location: index.php?b=file");
	}
?>
	<form action="?b=file" method="post" enctype="multipart/form-data">
		<div class="row btn">
			<label>Feltöltendő fájl:</label>
			<input type="file" name="file" id="file" />
			<input type="submit" value="Mehet" />
		</div>
		<div class="row captcha">
			<input type="text" name="captcha" id="captcha" />
			<img src="<?php echo "captcha.php"; ?>" alt=""/>
		</div>
	</form>
</div>
<section id="file_container">
	<ul class="icons">
		<li><a href="#images" class="filelist">Feltöltött képek</a></li>
		<li><a href="#musics" class="filelist">Feltöltött dalok</a></li>
	</ul>
	<div class="holder" id="images">
		<div class="scroll-pane">
			<div class="text-content">
<?php
	$entries = array();
	if ($handle = opendir('../picture')) {
		echo '<ul class="image-list">';
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				$entries[] = $entry;
			}
		}
		natsort($entries);
		foreach ($entries as $entry) {
			echo '<li>
					<a href="../picture/'.$entry.'" rel="clearbox[gallery=Feltöltött képek,,comment='.$entry.']">'.$entry.' ('.setFileUnit(filesize('../picture/'.$entry)).')</a>
					<a href="?b=file&item=../picture/'.$entry.'" title="kép törlése">×</a>
				</li>';
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
	<div class="holder" id="musics">
		<div class="scroll-pane">
			<div class="text-content">
<?php
	$entries = array();
	if ($handle = opendir('../file')) {
		echo '<ul class="music-list">';
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				$entries[] = $entry;
			}
		}
		natsort($entries);
		foreach ($entries as $entry) {
			echo '<li>
					<a href="../file/'.$entry.'">'.$entry.' ('.setFileUnit(filesize('../file/'.$entry)).')</a>
					<a href="?b=file&item=../file/'.$entry.'" title="dal törlése">×</a>
				</li>';
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
<?php
} else {
	echo "<p>Nincs jogosultságod új fájlt feltölteni!</p>";
	header("refresh: 3 url=index.php");
}
?>