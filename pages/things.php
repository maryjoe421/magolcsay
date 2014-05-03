	<ul class="icons">
		<li><a href="#" class="close">x</a></li>
	</ul>
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">

<?php
	if(isset($_SESSION["privilege"]) && $_SESSION["privilege"] == "user") {
		$mng_things_query = "SELECT * FROM mng_things ORDER BY date DESC";
	} else {
		$mng_things_query = "SELECT * FROM mng_things WHERE published=1 ORDER BY date DESC";
	}
	$mng_things_result = mysql_query($mng_things_query);
	$lastThingsItem = mysql_num_rows($mng_things_result);
	if ($lastThingsItem > 0) {
		$thingsItem = 0;
		while ($mng_things_result_row = mysql_fetch_array($mng_things_result)) {
			$thingsItem++;
			echo '<h2>' . $mng_things_result_row["title"] . '</h2>' . $mng_things_result_row["text"];
			if ($thingsItem != $lastThingsItem) echo '<hr />';
		}
	} else {
		echo '<p>Jelenleg nincs semmi újdonság a dolgok közt!</p>';
	}
?>

			</div>
		</div>
	</div>