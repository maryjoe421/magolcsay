<div class="text-content">
<?php

if(isset($_SESSION["username"])) {
	if(isset($_POST["save"])) {
		$id = $_POST["id"];
		$password = md5($_POST["password"]);
		$query = "UPDATE mng_users SET password='$password' WHERE id='$id'";
		mysql_query($query);
		header("Location: index.php");
	}
?>
<h1>Jelszó módosítása</h1>
<div class="admin-form">
	<form action="?b=set" method="post">
<?php
		$query = "SELECT * FROM mng_users";
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
				<label>Jelenlegi jelszó</label>
				<input type="password" placeholder="Jelenlegi jelszó" name="password" />
			</div>
			<div class="row">
				<label>Új jelszó</label>
				<input type="password" placeholder="Új jelszó" name="password" />
			</div>
			<div class="row">
				<label>Új jelszó mégegyszer</label>
				<input type="password" placeholder="Új jelszó mégegyszer" name="password" />
			</div>
		</fieldset>
<?php
		}
?>
		<div class="btn">
			<ul>
				<li><input type="submit" name="save" value="Mentés" /></li>
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
