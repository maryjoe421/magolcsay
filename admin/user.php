<div class="text-content">
<?php

if($_SESSION["privilege"] == "admin") {
	if(isset($_POST["save"])) {
		$username = htmlspecialchars($_POST["username"]);
		$password = md5($_POST["password"]);
		$email = htmlspecialchars($_POST["email"]);
		$privilege = htmlspecialchars($_POST["privilege"]);
		$query = "INSERT INTO sys_user (username, password, email, privilege) VALUES ('$username', '$password', '$email', '$privilege')";
		mysql_query($query);
		header("Location: index.php");
	} elseif(isset($_POST["cancel"])) {
		header("Location: index.php");
	}
?>
<h1>Új felhasználó felvétele</h1>
<div class="admin-form">
	<form action="?b=user" method="post">
		<div class="row">
			<label>Név:</label>
			<input type="text" placeholder="Név" name="username" />
		</div>
		<div class="row">
			<label>Jelszó:</label>
			<input type="password" placeholder="Jelszó" name="password" />
		</div>
		<div class="row">
			<label>E-mail:</label>
			<input type="text" placeholder="E-mail" name="email" />
		</div>
		<div class="row">
			<label>jog:</label>
			<select name="privilege">
				<option value="user">felhasználó</option>
				<option value="admin">adminisztrátor</option>
			</select>
		</div>
		<div class="btn">
			<ul>
				<li><input type="submit" name="save" value="Mehet" /></li>
				<li><input type="submit" name="cancel" value="Mégsem" /></li>
			</ul>
		</div>
	</form>
</div>
<?php
} else {
	echo "<p>Nincs jogosultságod új felhasználót felvenni!</p>";
	header("Refresh: 3 url=index.php");
}
?>
</div>