<div class="text-content">
<?php

if($_SESSION["privilege"] == "admin") {
	if(isset($_POST["save"])) {
		$id = $_POST["id"];
		$password = md5($_POST["password"]);
		$email = htmlspecialchars($_POST["email"]);
		$privilege = htmlspecialchars($_POST["privilege"]);
		$query = "UPDATE sys_user SET password='$password', email='$email', privilege='$privilege' WHERE id='$id'";
		mysql_query($query);
		header("Location: index.php");
	} elseif(isset($_POST["cancel"])) {
		header("Location: index.php");
	}
?>
<h1>Adatok módosítása</h1>
<div class="admin-form">
	<form action="?b=set" method="post">
<?php
		$query = "SELECT * FROM sys_user";
		$result = mysql_query($query);
		while ($result_row = mysql_fetch_array($result)) {
?>
		<fieldset>
			<legend>
				<label for="pass_<?php echo $result_row["id"]?>">
					<input type="radio" name="id" value="<?php echo $result_row["id"]?>" id="pass_<?php echo $result_row["id"]?>" /><?php echo $result_row["username"]?>
				</label>
			</legend>
			<div class="row">
				<label>Jelszó</label>
				<input type="password" placeholder="Jelszó" name="password" />
			</div>
			<div class="row">
				<label>E-mail:</label>
				<input type="text" placeholder="E-mail" name="email" value="<?php echo $result_row["email"]?>" />
			</div>
			<div class="row">
				<label>jog:</label>
				<select name="privilege">
					<option value="user"<?php if ($result_row["privilege"] == "user") { echo ' selected="selected"'; } ?>>felhasználó</option>
					<option value="admin"<?php if ($result_row["privilege"] == "admin") { echo ' selected="selected"'; } ?>>adminisztrátor</option>
				</select>
			</div>
		</fieldset>
<?php
		}
?>
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
	echo "<p>Nincs jogosultságod az admin menü beállításaihoz!</p>";
	header("Refresh: 2 url=index.php");
}
?>
</div>
