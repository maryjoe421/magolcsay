<?php
$p = $_GET["p"];
?>

<section id="<?php echo $p?>_container">
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">
<?php
	if (in_array($p, $included, true)) {
		foreach ($editable_menuitems as $items => $title) {
			if ($p == $items) { echo '<h1 id="'.$items.'">'.$title.'</h1>'; }
		}
	}
	if($_SESSION["privilege"] == "user") {
		$order = (in_array($p, $orderbynone, true)) ? "" : " ORDER BY date DESC";
		$query = "SELECT * FROM mng_".$p.$order;
		$result = mysql_query($query);
		$lastResultItem = mysql_num_rows($result);
		if ($lastResultItem > 0) {
			$resultItem = 0;
			while ($result_row = mysql_fetch_array($result)) {
				$resultItem++;
				if (in_array($p, $included, true)) {
					echo '<h4>' . $result_row["title"] . '</h4>';
				}
				echo $result_row["text"];
				if(isset($_SESSION["username"])) {
					echo '<ul>';
					if ($result_row["published"] == 0) {
						echo '<li><a href="?b=pub&amp;p='.$p.'&amp;id='.$result_row["id"].'">Bejegyzés publikálása</a></li>';
					}
					echo '<li><a href="?b=mod&amp;p='.$p.'&amp;id='.$result_row["id"].'">Bejegyzés módosítása</a></li>
						<li><a href="?b=del&amp;p='.$p.'&amp;id='.$result_row["id"].'">Bejegyzés törlése</a></li>
					</ul>';
				}
				if (in_array($p, $included, true)) {
					if ($resultItem != $lastResultItem) echo '<hr />';
				}
			}
		}
	}
?>

			</div>
		</div>
	</div>
</section>