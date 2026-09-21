<?php

session_start();

$conn = new mysqli("localhost","root","","gamerhubdb");

$title = $_POST["title"];
$description = $_POST["description"];
$releaseDate = $_POST["releaseDate"];
$url = $_POST["Url"];

$query1 = $conn->prepare("select * from games where title = ?");
$query1->bind_param("s",$title);
$query1->execute();
$result1 = $query1->get_result();

if ($result1->num_rows > 0)
    {
        echo "Error : title already exists";
    }
else
    {
        $query2 = $conn->prepare("insert into games(title,description,releaseDate,urlImage) values(?,?,?,?)");
        $query2->bind_param("ssss",$title,$description,$releaseDate,$url);
        $result2 = $query2->execute();

        if ($result2)
            {
                echo "game added successfully!";
            }
        else
            {
                echo "error";
            }
    }

?>