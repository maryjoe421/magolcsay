<?php
	include("config.php");
	if(isset($_SESSION["username"])) { //Be van lépve
?>

<div class="header">
	<ul class="mainmenu clearfix">
		<li><a href="admin/index.php">Admin</a></li>

<?php
		if($_SESSION["privilege"] == "user") {
		foreach ($editable_menuitems as $key => $value) {
			//the code here is impertinent 
			echo '<li>
				<a href="admin/index.php?b=list&amp;p='.$key.'">'.$value.'</a>
				<ul>
					<li><a href="admin/index.php?b=new&amp;p='.$key.'">Új bejegyzés</a></li>
					<li><a href="#'.$key.'" target="_blank">Megtekintés</a></li>
				</ul>
			</li>';
		}
?>

		<li><a href="admin/index.php?b=file">Fájl feltöltése</a></li>
		<li class="logout">
			<span><?php echo $_SESSION["username"]?> (<?php echo $_SESSION["privilege"]?>)</span>
			<ul>
				<li><a href="admin/index.php?b=pwd&amp;username=<?php echo $_SESSION["username"]?>">Jelszó módosítása</a></li>
				<li><a href="admin/index.php?b=logout">Kijelentkezés</a></li>
			</ul>
		</li>

<?php
		} else {
?>

		<li class="logout">
			<span><?php echo $_SESSION["username"]?> (<?php echo $_SESSION["privilege"]?>)</span>
			<ul>
				<li><a href="admin/index.php?b=set">Beállítások</a></li>
				<li><a href="admin/index.php?b=user">Új felhasználó felvétele</a></li>
				<li><a href="admin/index.php?b=logout">Kijelentkezés</a></li>
			</ul>
		</li>

<?php
		}
?>

	</ul>
</div>

<?php
	}
?>
