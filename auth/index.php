<?php

$rootDir = $rootAssetUrl = '../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

$pageTitle = 'Sign in';

$errorMsg = null;
$errorMsgType = 'red';

$returnUrl = $_REQUEST['return'];

// logout
if($_GET['action'] == 'logout') {
    $errorMsg = 'Logging out...';
    $_SESSION['auth'] = false;
    $_SESSION = array();
    session_destroy();
    header('Location: '.$rootUrl.$returnUrl);
    exit;
}

// logged in redirect
if($_SESSION['auth']) {
    $errorMsgType = 'green';
    $errorMsg = 'Signed in!';
    header('Location: '.$rootUrl.$returnUrl);
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

// form sumbited
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    }elseif(!usernameExists($connection, $_POST['username'])) {
        $username = trim($_POST["username"]);
        $username_err = "Username does not exist.";
    }else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if(empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";     
    }else {
        $password = trim($_POST['password']);
    }

    // check for any errors
    if(empty($username_err) && empty($password_err)) {

        //Check password by username
        $sql = "SELECT id, username, email, pfp, password, type
        FROM users
        WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::FETCH_ASSOC);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC)[0];

        if (password_verify($password, $data['password'])) {
            //good, create session
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['pfp'] = $data['pfp'];
            $_SESSION['type'] = $data['type'];
            //
            $errorMsgType = 'green';
            $errorMsg = 'Signed in!';
            header('Location: '.$rootUrl.$returnUrl);
            exit;
        }else {
            //bad
            $password_err = "Invalid password.";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $pageTitle ?> - <?= $blogTitle ?></title>

        <meta name="description" content="Sign in to <?= $blogTitle ?>">

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
                            
                            <h1 class="title" style="margin: 0 0 1rem 0;"><?= $pageTitle ?></h1>

                            <form class="form" action="./" method="POST">

                                <div>
                                    <div class="text-input-mb">
                                        <input name="username" class="text-input dark block <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" type="text" placeholder="Username" value="<?= $username ?>" required <?php echo ((empty($username_err) && empty($password_err)) || !empty($username_err)) ? 'autofocus' : ''; ?>>
                                        <?php echo (!empty($username_err)) ? '<div class="input-error">'.$username_err.'</div>' : ''; ?>
                                    </div>

                                    <div class="text-input-mb">
                                        <input name="password" class="text-input dark block <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" type="password" placeholder="Password" required <?php echo ((!empty($password_err) && empty($username_err)) || empty($username_err)) ? 'autofocus' : ''; ?>>
                                        <?php echo (!empty($password_err)) ? '<div class="input-error">'.$password_err.'</div>' : ''; ?>
                                    </div>
                                </div>

                                <input name="return" value="<?= $returnUrl ?>" hidden>

                                <div style="margin: 1rem 0 0 0; display: flex; align-items: center;">
                                    <a class="button outline" href="./register">Sign up</a>
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