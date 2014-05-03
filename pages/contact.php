	<ul class="icons">
		<li><a href="#hu" class="language">magyar</a></li>
		<li><a href="#en" class="language">english</a></li>
		<li><a href="#" class="close">x</a></li>
	</ul>

<?php
	$mng_lang_query = "SELECT DISTINCT language FROM mng_contact";
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
	$mng_contact_query = "SELECT * FROM mng_contact WHERE language='$lang'";
	$mng_contact_result = mysql_query($mng_contact_query);
	$lastContactItem = mysql_num_rows($mng_contact_result);
	if ($lastContactItem > 0) {
		while ($mng_contact_result_row = mysql_fetch_array($mng_contact_result)) {
			echo $mng_contact_result_row["text"];
		}
	} else {
		echo '<p>Hamarosan...</p>';
	}
?>

			</div>
		</div>
	</div>

<?php
		}
	}
?>
