	<ul class="icons">
		<li><a href="#" class="close">x</a></li>
	</ul>
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">

<?php
	$mng_publications_query = "SELECT * FROM mng_publications";
	$mng_publications_result = mysql_query($mng_publications_query);
	$lastPublicationItem = mysql_num_rows($mng_publications_result);
	if ($lastPublicationItem > 0) {
		while ($mng_publications_result_row = mysql_fetch_array($mng_publications_result)) {
			echo $mng_publications_result_row["text"];
		}
	} else {
		echo '<p>Hamarosan...</p>';
	}
?>

			</div>
		</div>
	</div>