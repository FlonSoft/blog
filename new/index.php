<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

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
$errors = false;

$postTitle = $postDate = $postUsername = $postContent = $postTags = $slug = '';

if(isset($_GET['id']) && $_GET['id'] !== '') {
    $editMode = true;
    $title = 'Edit post';
    $result = getPost($connection, $_GET['id']);
    
    $slug = $result['slug'];
    $postTitle = $result['title'];
    $postDate = $result['date'];
    $postUsername = $result['username'];
    $postContent = $result['content'];
    $postTags = $result['tags'];
}else {
    $editMode = false;
}

// form sumbited
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_SESSION['username'];

    $postTitle = trim($_POST['title']);
    $postContent = $_POST['content'];
    $postTags = $_POST['tags'];

    // Validate password
    if(empty($postTitle)) {
        $title_err = "Please enter a title.";
    }

    // Validate content
    if(empty(trim($postContent))) {
        $content_err = "Please enter more content.";
    }

    // check for any errors
    if(empty($title_err) && empty($content_err)) {
        if($editMode) {
            $new = array(
                "title" => $postTitle,
                "content" => $postContent,
                "tags" => $postTags,
                "slug" => $slug
            );
            $sql = "
            UPDATE posts SET title=:title, content=:content, tags=:tags WHERE slug=:slug
            ";
        }else {
            $slug = seoSlug($postTitle);
            $new = array(
                "username"  => $username,
                "title" => $postTitle,
                "slug" => $slug,
                "content" => $postContent,
                "tags" => $postTags
            );
            $sql = sprintf(
                    "INSERT INTO %s (%s) values (%s)",
                    "posts",
                    implode(", ", array_keys($new)),
                    ":" . implode(", :", array_keys($new))
            );
        }
        try {
            $statement = $connection->prepare($sql);
            $statement->execute($new);
            } catch(PDOException $error) {
                $errorMsg = $sql . " " . $error->getMessage();
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

        <div class="pageHeight">

            <?php include($rootDir.'/navbar.inc.php'); ?>
                
            <div class="container" style="margin-top: 2rem;">
                    
                <div class="content">

                    <?php if(isset($errorMsg)) { ?>
                        <div class="card error <?= $errorMsgType ?>" style="margin-bottom: .75rem;"><?= $errorMsg ?></div>
                    <?php } ?>
                        
                    <form class="card" method="POST" style="padding: 1rem">
                        
                        <h2 style="color: rgba(255, 255, 255, 0.95); margin: 0 0 1rem 0;"><?= $title ?></h2>

                        <div class="text-input-mb text-input-mt">
                            <input name="title" class="text-input dark block <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>" maxlength="300" placeholder="Title" value="<?= $postTitle ?>" autocomplete="off" required <?php echo ((empty($title_err) && empty($content_err)) || !empty($title_err)) ? 'autofocus' : ''; ?>>
                            <?php echo (!empty($title_err)) ? '<div class="input-error">'.$title_err.'</div>' : ''; ?>
                        </div>

                        <div class="text-input-mb">
                            <textarea name="content" class="text-input dark block <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>" style="min-height: 40vh;" placeholder="Content" required><?= $postContent ?></textarea>
                            <?php echo (!empty($content_err)) ? '<div class="input-error">'.$content_err.'</div>' : ''; ?>
                        </div>
                            
                        <div class="text-input-mb"> 
                            <input name="tags" class="text-input dark block" type="text" placeholder="Tags (separate with , )" value="<?= $postTags ?>">
                        </div>
                                
                        <div class="flex text-input-mb" style="margin: .75rem 0 0 0;">
                            <span class="flex-grow"></span>
                            <button class="button primary" type="submit">&nbsp;Submit&nbsp;</button>
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /container -->

        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>