<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

$query = $conn->prepare("select * from games order by id desc");
$query->execute();
$result = $query->get_result();

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
    <br><br>
    <h3>available games : </h3>
    <?php if ($result->num_rows == 0):?>
        <p>no games yet</p>
    <?php else:?>
        <?php while ($game = $result->fetch_assoc()):?>
            <img src="<?=$game["urlImage"]?>">
            <p><?=$game["title"]?></p>
            <p><?=$game["description"]?></p>
            <p><?=$game["releaseDate"]?></p>
        <?php endwhile;?>
    <?php endif;?>

</body>
</html>