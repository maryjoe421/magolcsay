<div class="text-content">

<?php
if($_SESSION["privilege"] == "user") {
	if(isset($_POST["save"])) {
		$name = htmlspecialchars($_POST["name"]);
		$description = htmlspecialchars($_POST["description"]);
		$template_code_before = htmlspecialchars($_POST["template_code_before"]);
		$template_code_after = htmlspecialchars($_POST["template_code_after"]);
		$query = "INSERT INTO sys_tmpl (name, description, template_code_before, template_code_after) VALUES ('$name', '$description', '$template_code_before', '$template_code_after')";
		mysql_query($query);
		header("Location: index.php");
	} elseif(isset($_POST["cancel"])) {
		header("Location: index.php");
	}
?>

<h1>Új sablon felvétele</h1>
<div class="admin-form">
	<form action="?b=tmpl" method="post">
		<div class="row">
			<label>Név:</label>
			<input type="text" placeholder="Név" name="username" />
		</div>
		<div class="row">
			<label>Leírás:</label>
			<input type="password" placeholder="Jelszó" name="password" />
		</div>
		<div class="row">
			<label>sablon kódjának kezdete:</label>
			<textarea name="template_code_before" id="template_code_before" rows="" cols=""></textarea>
		</div>
		<div class="row">
			<label>sablon kódjának vége:</label>
			<textarea name="template_code_after" id="template_code_after" rows="" cols=""></textarea>
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
	echo "<p>Nincs jogosultságod új sablont felvenni!</p>";
	header("Refresh: 3 url=index.php");
}
?>

</div>