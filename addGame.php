<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

$gameId = $_POST["gameId"];
$userId = $_SESSION["userId"];

$query = $conn->prepare("insert into cartItems(userId,gameId) values(?,?)");
$query->bind_param("ii",$userId,$gameId,);
$query->execute();
header("Location: HomePage.php");
exit();

?>