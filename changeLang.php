<?php

session_start();

$_SESSION["language"] = $_POST["lang"];

echo $_SESSION["language"];
echo "Hello World";
echo "HAAAAALLELUJA";
?>