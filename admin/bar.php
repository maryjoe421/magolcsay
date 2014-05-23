<?php
	if(isset($_SESSION["username"])) {
		echo '<div class="header">
				<ul class="mainmenu clearfix">
					<li class="separate-after">
						<a href="?" title="Vissza az admin főoldalra">Főoldal</a>
						<ul>
							<li><a href="../" title="Vissza a '.$_SERVER["SERVER_NAME"].' oldalra">'.$_SERVER["SERVER_NAME"].'</a></li>
						</ul>
					</li>';
		if($_SESSION["privilege"] == "user") {
			foreach ($editable_menuitems as $key => $value) {
				$className = ($p == $key) ? ' class="active"' : '';
				echo '<li'.$className.'>
						<a href="?b=list&amp;p='.$key.'">'.$value.'</a>
						<ul>
							<li><a href="?b=new&amp;p='.$key.'">Új bejegyzés</a></li>
							<li><a href="../#'.$key.'" target="_blank">Megtekintés</a></li>
						</ul>
					</li>';
			}
			echo '<li class="separate-before"><a href="?b=file">Fájl feltöltése</a></li>';
		}
		echo '<li class="logout">
				<a href="?b=profil&amp;userid='.$_SESSION["userid"].'">'.$_SESSION["username"].' ('.$_SESSION["privilege"].')</a>
				<ul>';
			if($_SESSION["privilege"] == "admin") {
				echo '<li><a href="?b=set">Adatok módosítása</a></li>
					<li><a href="?b=user">Új felhasználó felvétele</a></li>';
			}
					echo '<li><a href="?b=pwd&amp;userid='.$_SESSION["userid"].'">Jelszó módosítása</a></li>
					<li><a href="?b=logout">Kijelentkezés</a></li>
				</ul>
			</li>
		</ul>
	</div>';
	}
?>
	