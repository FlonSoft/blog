<?php

$rootDir = $rootAssetUrl = '../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

$title = 'New post';

// logged in?
if(!$loggedIn) {
    header('Location: '.$rootUrl.'auth/?return=new');
    exit;
}


$errorMsg = null;
$errorMsgType = 'red';

// form sumbited
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate password
    if(empty(trim($_POST['title']))) {
        $title_err = "Please enter a title.";     
    }else {
        $postTitle = trim($_POST['title']);
    }

    // Validate content
    if(empty(trim($_POST['content']))) {
        $content_err = "Please enter more content.";     
    }else {
        $content = $_POST['content'];
    }

    // check for any errors
    if(empty($title_err) && empty($content_err)) {
        
        $username = $_SESSION['username'];
        $slug = seoSlug($postTitle);
        $tags = $_POST['tags'];

        $new = array(
            "username"  => $username,
            "title" => $postTitle,
            "slug" => $slug,
            "content" => $content,
            "tags" => $tags
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "posts",
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
            // post created
            header('Location: '.$rootUrl.'post/?id='.$slug);
            exit;
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $title ?> - <?= $blogTitle ?></title>

        <meta name="description" content="Create a post on <?= $blogTitle ?>">

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

        <?php include($rootDir.'/navbar.inc.php'); ?>
            
        <div class="container" style="margin-top: 2rem;">
                
            <div class="content" style="margin: 2rem auto 5rem auto; min-height: 73.75vh;">
                <?php if(isset($errorMsg)) { ?>
                    <div class="card error <?= $errorMsgType ?>" style="margin-bottom: .75rem;"><?= $errorMsg ?></div>
                <?php } ?>
                      
                <form class="card" action="./" method="POST" style="padding: 1rem">
                    
                    <h2 style="color: rgba(255, 255, 255, 0.95); margin: 0 0 1rem 0;"><?= $title ?></h2>

                    <div class="text-input-mb text-input-mt">
                        <input name="title" class="text-input dark block <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>" maxlength="300" placeholder="Title" value="<?= $_POST['title'] ?>" autocomplete="off" required <?php echo ((empty($title_err) && empty($content_err)) || !empty($title_err)) ? 'autofocus' : ''; ?>>
                        <?php echo (!empty($title_err)) ? '<div class="input-error">'.$title_err.'</div>' : ''; ?>
                    </div>

                    <div class="text-input-mb">
                        <textarea name="content" class="text-input dark block <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>" style="min-height: 40vh;" placeholder="Content" required><?= $_POST['content'] ?></textarea>
                        <?php echo (!empty($content_err)) ? '<div class="input-error">'.$content_err.'</div>' : ''; ?>
                    </div>
                        
                    <div class="text-input-mb"> 
                        <input name="tags" class="text-input dark block" type="text" placeholder="Tags (separate with , )" value="<?= $_POST['tags'] ?>">
                    </div>
                            
                    <div class="flex text-input-mb" style="margin: .75rem 0 0 0;">
                        <span class="flex-grow"></span>
                        <button class="button primary" type="submit">&nbsp;Submit&nbsp;</button>
                    </div>
                </form>
                
            </div>
            
        </div><!-- /container -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>