<?php

$rootDir = $rootAssetUrl = '../../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = 'Sign up';

$errorMsg = null;
$errorMsgType = 'red';

$username = $email = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    }elseif(usernameExists($connection, $_POST['username'])) {
        $username = trim($_POST["username"]);
        $username_err = "This username is already taken.";
    }else {
        $username = trim($_POST["username"]);
    }

    // "Validate" email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    }else {
        $email = $_POST['email'];
    }

    // Validate password
    if(empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";     
    }elseif(strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must be longer than 6 characters.";
    }else {
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = 'Please confirm password.';     
    }else {
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password) {
            $confirm_password_err = 'Passwords did not match.';
        }
    }

    // check for any errors
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $emailHash = emailHash($email);
        $pfp = pfpFromEmailHash($emailHash);

        $new = array(
            "username"  => $username,
            "email" => $email,
            "emailHash" => $emailHash,
            "password" => $hashedPassword,
            "type" => 'normal',
            "pfp" => $pfp
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new)),
                ":" . implode(", :", array_keys($new))
        );

        try {
            $statement = $connection->prepare($sql);
            $statement->execute($new);
            } catch(PDOException $error) {
                echo $sql . " " . $error->getMessage();
            }
            
        if(!isset($error)) {
            // user created
            header('Location: ../');
            exit;
        }
    }else {
        //$errorMsg = 'Please fill out the form correctly.';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $title ?> - <?= $blogTitle ?></title>

        <meta name="description" content="Sign up to <?= $blogTitle ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Styles -->
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>/css/default.css"/>
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>/css/global.css"/>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&amp;text=Flolon%20Blog&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons&family=Roboto&family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css"/>
        
    </head>
    <body>

        <div class="pageHeight">

            <?php include($rootDir.'/navbar.inc.php'); ?>
            
            <div class="container" style="margin-top: 2rem;">
                
                <div class="content">
                    
                    <div class="main-text" style="max-width: 575px; margin: auto;">
                        <?php if(isset($errorMsg)) { ?>
                            <div class="card error <?= $errorMsgType ?>" style="margin-bottom: .75rem;"><?= $errorMsg ?></div>
                        <?php } ?>
                        <div class="card" style="padding: 1.25rem">
                            
                            <h1 class="title" style="margin: 0 0 1rem 0;"><?= $title ?></h1>

                            <form class="form" action="./" method="POST">

                                <div>
                                    <div class="text-input-mb">
                                        <input name="username" class="text-input dark block <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" type="text" placeholder="Username" value="<?= $username ?>" required <?php echo (!empty($username_err) || (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err))) ? 'autofocus' : ''; ?>>
                                        <?php echo (!empty($username_err)) ? '<div class="input-error">'.$username_err.'</div>' : ''; ?>
                                    </div>

                                    <div class="text-input-mb">
                                        <input name="email" class="text-input dark block <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>" type="email" placeholder="Email" value="<?= $email ?>" validate <?php echo (!empty($email_err) || (empty($password_err) && empty($confirm_password_err))) ? 'autofocus' : ''; ?>>
                                        <?php echo (!empty($email_err)) ? '<div class="input-error">'.$email_err.'</div>' : ''; ?>
                                    </div>

                                    <div class="text-input-mb">
                                        <input name="password" class="text-input dark block <?php echo (!empty($password_err) || !empty($confirm_password_err)) ? 'has-error' : ''; ?>" type="password" placeholder="Password" required <?php echo ((!empty($password_err) && empty($username_err) && empty($email_err)) || !empty($confirm_password_err)) ? 'autofocus' : ''; ?>>
                                        <?php echo (!empty($password_err)) ? '<div class="input-error">'.$password_err.'</div>' : ''; ?>
                                    </div>

                                    <div class="text-input-mb">
                                        <input name="confirm_password" class="text-input dark block <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>" type="password" placeholder="Retype Password" required>
                                        <?php echo (!empty($confirm_password_err)) ? '<div class="input-error">'.$confirm_password_err.'</div>' : ''; ?>
                                    </div>
                                </div>

                                <div style="margin: 1rem 0 0 0; display: flex; align-items: center;">
                                    <a class="button outline" href="../">Sign in</a>
                                    <span class="flex-grow"></span>
                                    <button class="button primary" type="submit">Continue</button>
                                </div>

                            </form>

                        </div>

                    </div>
                    
                </div>
                
            </div><!-- /container -->

        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>