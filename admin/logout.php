<?php
session_start();
unset($_SESSION["privilege"]);
unset($_SESSION["username"]);
header("location: index.php");
?>