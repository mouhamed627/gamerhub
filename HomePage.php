<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

if (!isset($_SESSION["firstName"]) && !isset($_SESSION["lastName"]))
    {
        header("Location: SignIn.html");
        exit();
    }

$firstName = $_SESSION["firstName"];
$lastName = $_SESSION["lastName"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>homepage</title>
</head>
<body>
    <h2>hello there <?=$firstName?> <?=$lastName?></h2>
</body>
</html>