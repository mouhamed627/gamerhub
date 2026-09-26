<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

if (!isset($_SESSION["userId"]))
    {
        header("Location: SignIn.html");
        exit();
    }
$userId = $_SESSION["userId"];

$query1 = $conn->prepare("select gameId from cartItems where userId = ?");
$query1->bind_param("i",$userId);
$query1->execute();
$result1 = $query1->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
</head>
<body>
    <?php if($result1->num_rows == 0):?>
        <h1>no items yet</h1>
    <?php else:?>
        <h1>Cart Items : </h1>
        <?php while($cartRow = $result1->fetch_assoc()):?>
            <?php $query2 = $conn->prepare("select * from games where id = ?");
            $gameId = $cartRow["gameId"];
            $query2->bind_param("i",$gameId);
            $query2->execute();
            $result2 = $query2->get_result();
            $row = $result2->fetch_assoc();
            ?>
            <img src="<?=$row["urlImage"]?>">
            <p><?=$row["title"]?></p>
            <p><?=$row["description"]?></p>
            <p><?=$row["releaseDate"]?></p>
        <?php endwhile;?>
    <?php endif;?>


</body>
</html>