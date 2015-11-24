<?php
	if(isset($_GET['menuitem'])) {
		$menuitem = $_GET['menuitem'];
	} else {
		$menuitem = '';
	}

	$table = "mng_" . $menuitem;

	echo '
			<h1 class="mobile-title">' . $editable_menuitems[$menuitem] . '</h1>
			<ul class="icons">';

	$mng_lang_query = "SELECT DISTINCT language FROM $table";
	$mng_lang_result = mysql_query($mng_lang_query);
	$lastLangItem = mysql_num_rows($mng_lang_result);
	if ($lastLangItem != 1) {
		while ($mng_lang_result_row = mysql_fetch_array($mng_lang_result)) {
			echo '<li><a href="#' . $mng_lang_result_row["language"] . '" class="language">' . (($mng_lang_result_row["language"] === "hu") ? 'magyar' : 'english') . '</a></li>';
		}
	}
	echo '
				<li><a href="#" class="close">x</a></li>
			</ul>';
?>