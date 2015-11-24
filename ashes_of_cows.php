	<h1 class="mobile-title">ashes of cows</h1>
	<ul class="icons">

<?php
	foreach ($languages as $lang => $language) {
		echo '<li><a href="#' . $lang . '" class="language">' . $language . '</a></li>';
	}
?>

		<li><a href="#" class="close">x</a></li>
	</ul>

<?php
	foreach ($languages as $lang => $language) {
		$langcode = $lang;
?>

	<div class="holder" lang="<?php echo $langcode ?>">
		<div class="scroll-pane">
			<div class="text-content tracks">


<?php

		$jsonfile = file_get_contents("ashes_of_cows.json");
		$aoc = json_decode($jsonfile);
		// usort($aoc, 'JSONcompare');
		$projects = $aoc->projects;
		foreach ($projects as $project) {
			echo '<h2>' . $project->name . '</h2>
				<ul>';
			$tracklist = $project->tracklist;
			foreach ($tracklist as $track) {
				echo '<li><a href="#' . $track->link . '" title="' . $track->title . '" class="track';
				if ($lang == "hu") echo ' track-list';
				echo '">' . $track->title . '</a><em>' . $track->duration . '</em></li>';
			}
			echo '</ul>';
			if ($project->details->$langcode != "") echo '<p>' . $project->details->$langcode . '</p>';
		}
?>

			</div>
		</div>
	</div>

<?php
	}
?>

	<div class="footer"></div>