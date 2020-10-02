<?php

include('../global.inc.php');
include('../db.inc.php');

//read from db table //
try {
    $connection = new PDO($sql_dsn, $sql_username, $sql_password, $sql_options);
    $sql = "SELECT * 
                FROM posts
                WHERE slug = :slug
                ";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':slug', $_GET['id'], PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
    echo $sql . "<br />" . $error->getMessage();
}
// page //
header('Content-Type: application/json');

echo json_encode($result, JSON_PRETTY_PRINT);
?>