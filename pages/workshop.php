	<ul class="icons">
		<li><a href="#" class="close">x</a></li>
	</ul>
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">

<?php
	if(isset($_SESSION["privilege"]) && $_SESSION["privilege"] == "user") {
		$mng_workshop_query = "SELECT * FROM mng_workshop ORDER BY date DESC";
	} else {
		$mng_workshop_query = "SELECT * FROM mng_workshop WHERE published=1 ORDER BY date DESC";
	}
	$mng_workshop_result = mysql_query($mng_workshop_query);
	$lastWorkshopItem = mysql_num_rows($mng_workshop_result);
	if ($lastWorkshopItem > 0) {
		$workshopItem = 0;
		while ($mng_workshop_result_row = mysql_fetch_array($mng_workshop_result)) {
			$workshopItem++;
			echo '<h2>' . $mng_workshop_result_row["title"] . '</h2>' . $mng_workshop_result_row["text"];
			if ($workshopItem != $lastWorkshopItem) echo '<hr />';
		}
	} else {
		echo '<p>Hamarosan...</p>';
	}
?>

			</div>
		</div>
	</div>