<?php
	include("config.php");
	include("function.php");

	if(isset($_GET['menuitem'])) {
		$menuitem = $_GET['menuitem'];
	} else {
		$menuitem = '';
	}

	$table = "mng_" . $menuitem;

	include('language.php');

	$mng_lang_query = "SELECT DISTINCT language FROM $table";
	$mng_lang_result = mysql_query($mng_lang_query);
	$lastLangItem = mysql_num_rows($mng_lang_result);
	if ($lastLangItem > 0) {
		while ($mng_lang_result_row = mysql_fetch_array($mng_lang_result)) {
			$lang = $mng_lang_result_row["language"];

			echo '
			<div class="holder"' . (($lang !== "") ? ' lang="' . $lang . '"' : '') . '>
				<div class="scroll-pane">
					<div class="text-content">';

			$select = "SELECT * FROM $table ";
			$where = (isLoggedUser() === false || $lang != '') ? "WHERE " : "";
			$published = (isLoggedUser() === false) ? "published=1" : "";
			$and = (isLoggedUser() === false && $lang != '') ? " AND " : "";
			$language = ($lang != '') ? "language='$lang'" : "";
			$order = (in_array($menuitem, $orderbynone, true)) ? "" : " ORDER BY date DESC";
			$mng_menu_query = $select . $where . $published . $and . $language . $order;
			// echo $mng_menu_query . " - " . ((isLoggedUser() === true) ? "isLoggedUser igaz": "isLoggedUser hamis") . " - " . (($lang != '') ? "lang igaz": "lang hamis");

			$menuItems = 5;
			$menuItem = 0;
			$mng_menu_result = mysql_query($mng_menu_query);
			$lastMenuItem = mysql_num_rows($mng_menu_result);
			if ($lastMenuItem > 0) {
				while ($mng_menu_result_row = mysql_fetch_array($mng_menu_result)) {
					$menuItem++;
					if ($mng_menu_result_row["title"] != "") {
						echo '<h2>' . $mng_menu_result_row["title"] . '</h2>';
					}
					echo $mng_menu_result_row["text"];
					if (in_array($menuitem, $included, true)) {
						if ($menuItem != $lastMenuItem) {
							echo '<hr />';
						}
					}
				}
			} else {
				echo ($lang == "en") ? '<p>Soon...</p>' : '<p>Hamarosan...</p>';
			}
			echo '
					</div>
				</div>
			</div>';

		}
	}
?>
