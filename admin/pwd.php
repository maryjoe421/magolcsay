<div class="text-content">
<?php

if(isset($_SESSION["username"])) {
	if(isset($_POST["save"])) {
		$userid = $_POST["userid"];
		$password0 = md5($_POST["password0"]);
		$password1 = md5($_POST["password1"]);
		$password2 = md5($_POST["password2"]);

		$pwd_query = "SELECT * FROM mng_users WHERE id='$userid'";
		$pwd_result = mysql_query($pwd_query);
		$pwd_result_row = mysql_fetch_array($pwd_result);

		if ($pwd_result_row["password"] != $password0) {
			echo "<p>HIBA: Nincs ilyen jelszó az adatbázisban!</p>";
			header("Refresh: 2 url=index.php?b=pwd");
		} elseif ($password1 != $password2) {
			echo "<p>HIBA: Nem egyezik meg a két jelszó!</p>";
			header("Refresh: 2 url=index.php?b=pwd");
		} else {
			$query = "UPDATE mng_users SET password='$password' WHERE id='$userid'";
			mysql_query($query);
			header("Location: index.php");
		}
	} elseif(isset($_POST["cancel"])) {
		header("Location: index.php");
	} else {
		if(isset($_GET["userid"])) {
			$userid = $_GET["userid"];
			$query = "SELECT * FROM mng_users WHERE id='$userid'";
			$result = mysql_query($query);
			$result_row = mysql_fetch_array($result);
?>
<h1>Jelszó módosítása</h1>
<div class="admin-form">
	<form action="?b=pwd" method="post">
		<input type="hidden" name="userid" value="<?php echo $userid?>" />
		<p><?php echo $result_row["username"].' - '.$result_row ["email"]?></p>
		<div class="row">
			<label>Jelenlegi jelszó</label>
			<input type="password" placeholder="Jelenlegi jelszó" name="password0" />
		</div>
		<div class="row">
			<label>Új jelszó</label>
			<input type="password" placeholder="Új jelszó" name="password1" />
		</div>
		<div class="row">
			<label>Új jelszó mégegyszer</label>
			<input type="password" placeholder="Új jelszó mégegyszer" name="password2" />
		</div>
		<div class="btn">
			<ul>
				<li><input type="submit" name="save" value="Mentés" /></li>
				<li><input type="submit" name="cancel" value="Mégsem" /></li>
			</ul>
		</div>
	</form>
</div>
<?php
		} else {
			echo "<p>HIBA: Nincs ilyen felhasználónév! ($username)</p>";
			header("Refresh: 2 url=index.php");
		}
	}
} else {
	echo "<p>Nincs jogosultságod adatokat módosítani!</p>";
	header("Refresh: 2 url=index.php");
}
?>
</div>