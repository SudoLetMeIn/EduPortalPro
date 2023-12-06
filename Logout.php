<?php
session_start();
$_SESSION["permission"] = false;
header("Location: Login.php");
exit();

?>