<div class="text-content">
<?php
if (isset($_POST["save"])) {
	$username = htmlspecialchars($_POST["username"]);
	$password = md5($_POST["password"]);
	$query = "SELECT * FROM sys_user WHERE (username='$username' AND password='$password')";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		$result_row = mysql_fetch_array($result);
		$_SESSION["username"] = $result_row["username"];
		$_SESSION["privilege"] = $result_row["privilege"];
		$_SESSION["userid"] = $result_row["id"];
		header("Location: index.php");
	} else {
		echo '<p class="warning">Hibás Név / Jelszó!</p>';
	}
}
?>
	<h1>Bejelentkezés</h1>
	<div class="admin-form login">
		<form action="?b=login" method="post">
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
</div>