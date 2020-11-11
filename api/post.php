<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include('../global.inc.php');
include('../db.inc.php');

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
    $result[0] = array("error" => $error->getMessage());
}

header('Content-Type: application/json');

echo json_encode($result[0], JSON_PRETTY_PRINT);
?>