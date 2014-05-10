	<ul class="icons">
		<li><a href="#hu" class="language">magyar</a></li>
		<li><a href="#en" class="language">english</a></li>
		<li><a href="#" class="close">x</a></li>
	</ul>

<?php
	$mng_lang_query = "SELECT DISTINCT language FROM mng_bio";
	$mng_lang_result = mysql_query($mng_lang_query);
	$lastLangItem = mysql_num_rows($mng_lang_result);
	if ($lastLangItem > 0) {
		while ($mng_lang_result_row = mysql_fetch_array($mng_lang_result)) {
			$lang = $mng_lang_result_row["language"];
?>

	<div class="holder" lang="<?php echo $lang; ?>">
		<div class="scroll-pane">
			<div class="text-content">

<?php
	$mng_bio_query = "SELECT * FROM mng_bio WHERE language='$lang'";
	$mng_bio_result = mysql_query($mng_bio_query);
	$lastBioItem = mysql_num_rows($mng_bio_result);
	if ($lastBioItem > 0) {
		while ($mng_bio_result_row = mysql_fetch_array($mng_bio_result)) {
			echo $mng_bio_result_row["text"];
		}
	} else {
		echo ($lang == "en") ? '<p>Hamarosan...</p>' : '<p>Soon...</p>';
	}
?>

			</div>
		</div>
	</div>

<?
		}
	}
?>
