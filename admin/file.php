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
					<a href="../picture/'.$entry.'" rel="clearbox[gallery=Feltöltött képek,,comment='.$entry.']">'.$entry.'</a>
					<a href="?b=file&pic='.$entry.'" title="kép törlése">×</a>
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
					<a href="../file/'.$entry.'">'.$entry.'</a>
					<a href="?b=file&pic='.$entry.'" title="dal törlése">×</a>
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
<div class="text-content">
<?php
if($_SESSION["privilege"] == "user") {
	if(isset($_FILES["file"])) {
		$filename = $_FILES["file"]["name"];
		$filename = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
		$filetemp_name = $_FILES["file"]["tmp_name"];
		$fileerror = $_FILES["file"]["error"];
		$filesize = $_FILES["file"]["size"];
		$filetype = $_FILES["file"]["type"];
		$allowedExts = array("gif", "jpeg", "jpg", "png", "mp3");
		$mimetypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png");
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		if($extension == "mp3") {
			$uploadPath = "../file/";
		} else {
			$uploadPath = "../picture/";
		}
		if (in_array($filetype, $mimetypes) && ($filesize < 2097152) && in_array($extension, $allowedExts)) {
			if ($fileerror > 0) {
				echo '<p>Return Code: ' . $fileerror . '</p>';
			} else {
				/* echo '<p>Upload: ' . $filename . '<br>';
				echo 'Type: ' . $filetype . '<br>';
				echo 'Size: ' . $filesize . ' byte<br>';
				echo 'Temp file: ' . $filetemp_name . '</p>'; */
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
			echo '<p>Nem tölthetsz fel ilyen fájlt!</p>';
		}
	}

	if(isset($_GET['pic'])) {
		unlink('../picture/' . $_GET['pic']);
		header("location: index.php?b=file");
	}
?>
	<h1>Fájlok feltöltése</h1>
	<p>A feltöltendő fájlok nevei csak <b>kis- és nagy-, ékezet nélküli betűket</b> ill. <b>számokat</b> tartalmazhatnak, továbbá a mérete max. 2Mb lehet!</p>
	<div class="admin-form">
		<form action="?b=file" method="post" enctype="multipart/form-data">
			<div class="row">
				<label>Feltöltendő fájl:</label>
				<input type="file" name="file" id="file" />
			</div>
			<div class="btn">
				<ul>
					<li><input type="submit" value="Mehet" /></li>
				</ul>
			</div>
		</form>
	</div>
<?php
} else {
	echo "<p>Nincs jogosultságod új fájlt feltölteni!</p>";
	header("refresh: 3 url=index.php");
}
?>
</div>