<?php
session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$age = $_POST["age"];
$email = $_POST["email"];
$password = $_POST["password"];
$phoneNumber = $_POST["phoneNumber"];

$_SESSION["firstName"] = $firstName;
$_SESSION["lastName"] = $lastName;
$_SESSION["age"] = $age;
$_SESSION["email"] = $email;
$_SESSION["password"] = $password;
$_SESSION["phoneNumber"] = $phoneNumber;

$query1 = $conn->prepare("select * from users where email = ?");
$query1->bind_param("s",$email);
$query1->execute();
$result1 = $query1->get_result();

if ($result1->num_rows != 0)
    {
        echo "this email already exist,please choose another one!";
        exit();
    }

else
    {
        $query2 = $conn->prepare("insert into users (firstName,lastName,age,email,pw,phoneNumber) values(?,?,?,?,?,?)");
        $query2->bind_param("ssissi",$firstName,$lastName,$age,$email,$password,$phoneNumber);
        $result2 = $query2->execute();

        if ($result2)
            {
                $_SESSION["userId"] = $conn->insert_id;
                header("Location: HomePage.php");
                exit();
            }
        else
            {
                echo "error".$conn->error;
                exit();
            }

    }



?>