<?php

session_start();

$_SESSION["animal"] = $_POST["animalSelect"];

header('Location: post_lost.php');

?>