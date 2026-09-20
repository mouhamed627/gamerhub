<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

$email = $_POST["email"];
$password = $_POST["password"];

$_SESSION["email"] = $email;
$_SESSION["password"] = $password;

$query = $conn->prepare("select * from users where email = ? and pw = ?");
$query->bind_param("ss",$email,$password);
$query->execute();
$result = $query->get_result();

if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $_SESSION["firstName"] = $row["firstName"];
        $_SESSION["lastName"] = $row["lastName"];
        header("Location: HomePage.php");
        exit();
    }
else
    {
        echo "please verify your credentials!";
        exit();
    }

?>