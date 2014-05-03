<div class="header">
	<ul class="mainmenu clearfix">
		<li class="separate-after">
			<a href="?" title="Vissza az admin főoldalra">Főoldal</a>
			<ul>
				<li><a href="../" title="Vissza a <?php echo $_SERVER["SERVER_NAME"]?> oldalra"><?php echo $_SERVER["SERVER_NAME"] ?></a></li>
			</ul>
		</li>

<?php
	if(!isset($_SESSION["username"])) {
		if (isset($_POST["save"])) {
			$username = htmlspecialchars($_POST["username"]);
			$password = md5($_POST["password"]);
			$query = "SELECT * FROM sys_user WHERE (username='$username' AND password='$password')";
			$result = mysql_query($query);
			if (mysql_num_rows($result) > 0) {
				$result_row = mysql_fetch_array($result);
				$privilege = $result_row["privilege"];
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["privilege"] = $privilege;
				header("Location: index.php");
			} else {
				echo '<li><span class="warning">Hibás Név / Jelszó!</span></li>';
			}
		}
?>

		<li><span>Belépés</span>
			<ul>
				<li>

					<div class="admin-form login clearfix">
						<form action="" method="post">
							<div class="row">
								<label>Név:</label>
								<input type="text" name="username" placeholder="Név" />
							</div>
							<div class="row">
								<label>Jelszó:</label>
								<input type="password" name="password" placeholder="Jelszó" />
							</div>
							<div class="btn">
								<ul>
									<li><input type="submit" name="save" value="Bejelentkezes" /></li>
								</ul>
							</div>
						</form>
					</div>

				</li>
			</ul>
		</li>

<?php
	} else { //Be van lépve
		if($_SESSION["privilege"] == "admin") {
?>

		<li class="separate-after">
			<span><?php echo $_SESSION["username"]?> (<?php echo $_SESSION["privilege"]?>)</span>
			<ul>
				<li><a href="?b=set">Beállítások</a></li>
				<li><a href="?b=user">Új felhasználó felvétele</a></li>
			</ul>
		</li>

<?php
		} else {
			foreach ($editable_menuitems as $key => $value) {
				$className = ($p == $key) ? ' class="active"' : '';
				//the code here is impertinent 
				echo '<li'.$className.'>
					<a href="?b=list&amp;p='.$key.'">'.$value.'</a>
					<ul>
						<li><a href="?b=new&amp;p='.$key.'">Új bejegyzés</a></li>
						<li><a href="../#'.$key.'" target="_blank">Megtekintés</a></li>
					</ul>
				</li>';
			}
?>

		<li class="separate-before"><a href="?b=file">Fájl feltöltése</a></li>

<?php
		}
?>

		<li class="logout">
			<span><?php echo $_SESSION["username"]?> (<?php echo $_SESSION["privilege"]?>)</span>
			<ul>
				<li><a href="?b=pwd&amp;username=<?php echo $_SESSION["username"]?>">Adatok módosítása</a></li>
				<li><a href="?b=logout">Kijelentkezés</a></li>
			</ul>
		</li>

<?php
	}
?>

	</ul>
</div>