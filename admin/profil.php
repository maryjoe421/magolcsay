<?php
if($_SESSION["privilege"] != "") {
	if(isset($_GET["userid"])) {
		$userid = $_GET["userid"];
		$query = "SELECT * FROM sys_user WHERE id='$userid'";
		$result = mysql_query($query);
		$result_row = mysql_fetch_array($result);
?>
<section>
	<div class="holder">
		<div class="scroll-pane">
			<div class="text-content">
				<h2>Adataim</h2>
				<dl>
					<dt>Név:</dt>
					<dd><?php echo $result_row["username"]?></dd>
					<dt>E-mail:</dt>
					<dd><a href="mailto:<?php echo $result_row["email"]?>"><?php echo $result_row["email"]?></a></dd>
					<dt>jog:</dt>
					<dd><?php echo ($result_row["privilege"] == "admin") ? "Adminisztrátor" : "felhasználó"; ?></dd>
				</dl>
			</div>
		</div>
	</div>
</section>
<?php
	}
} else {
	echo "<p>HIBA: Nincs jogosultságod megtekinteni az adatlapot!</p>";
	header("refresh: 2 url=index.php");
}
?>