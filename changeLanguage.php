<?php

session_start();

$_SESSION["language"] = $_POST["langSelect"];

header('Location: post_lost.php');

?>