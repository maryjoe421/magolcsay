<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["privilege"]);
header("location: index.php");
?>