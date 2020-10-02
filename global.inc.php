<?php
session_start();

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

// global blog vars

$blogTitle = "Flolon Blog";
$blogDesc = "Flolon Fox's blog for himself and others";
$rootUrl = "https://blog.flolon.cc/";
$rootAssetUrl = $rootUrl."assets";
$rootDir = $_SERVER['DOCUMENT_ROOT'];

//

// logged in?
if(isset($_SESSION['auth'])) {
    $loggedIn = true;
}else {
    $loggedIn = false;
}

// escape HTML function
function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// date format function
function formatDate($date, $type = null) {
    $spacer = ' at ';
    $newDate = date("M j, Y", strtotime($date));
    $time = date("H:i T", strtotime($date));
    if($type == 'time') {
        $formatedDate = $newDate.$spacer.$time;
    }else {
        $formatedDate = $newDate;
    }
    return $formatedDate;
}

// create md5 hash of email
function emailHash($email) {
    $email = trim($email);
    $emailHash = md5(strtolower($email));
    return $emailHash;
}

// create pfp link with hash for gravatar
function pfpFromEmailHash($emailHash, $default = 'mp') {
    return 'https://www.gravatar.com/avatar/'.$emailHash.'?d='.$default;
}

// create pfp link via email for gravatar
function pfpFromEmail($email, $default = 'mp') {
    $emailHash = emailHash($email);
    return pfpFromEmailHash($emailHash, $default);
}

function seoSlug($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

// -- db functions -- //

// function to check if username exists
function usernameExists($connection, $username) {
    $stmt = $connection->prepare("SELECT 1 FROM users WHERE username=?");
    $stmt->execute([$username]); 
    return $stmt->fetchColumn();
}

function getAllPosts($connection) {
    // read from db table
    try {
        $sql = "SELECT * 
                        FROM posts
                        ORDER BY id DESC
                        ";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $error) {
        echo $sql . "<br />" . $error->getMessage();
    }
    // return results
    return $result;
}

function getPost($connection, $slug) {
    // read from db table
    try {
        $sql = "SELECT * 
                        FROM posts
                        WHERE slug = :slug
                        ";

            $statement = $connection->prepare($sql);
            $statement->bindParam(':slug', $slug, PDO::FETCH_ASSOC);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $error) {
        echo $sql . "<br />" . $error->getMessage();
    }
    // return results
    return $result[0];
}

?>