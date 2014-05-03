	<ul class="icons">
		<li><a href="#" class="close">x</a></li>
	</ul>
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">

<?php
	if(isset($_SESSION["privilege"]) && $_SESSION["privilege"] == "user") {
		$mng_events_query = "SELECT * FROM mng_events ORDER BY date DESC";
	} else {
		$mng_events_query = "SELECT * FROM mng_events WHERE published=1 ORDER BY date DESC";
	}
	$mng_events_result = mysql_query($mng_events_query);
	$lastEventsItem = mysql_num_rows($mng_events_result);
	if ($lastEventsItem > 0) {
		$eventsItem = 0;
		while ($mng_events_result_row = mysql_fetch_array($mng_events_result)) {
			$eventsItem++;
			echo '<h2>' . $mng_events_result_row["title"] . '</h2>' . $mng_events_result_row["text"];
			if ($eventsItem != $lastEventsItem) echo '<hr />';
		}
	} else {
		echo '<p>Hamarosan...</p>';
	}
?>

			</div>
		</div>
	</div>