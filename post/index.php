<?php

$rootDir = $rootAssetUrl = '../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include_once($rootDir.'/db.inc.php');

$slug = $_GET['id'];

$result = getPost($connection, $slug);

if($result == '') {
    include($rootDir.'/404.php');
    exit;
}

$pageTitle = escape($result['title']);
$date = $result['date'];
$username = escape($result['username']);
$content = $result['content'];
$tags = explode( ', ', $result['tags']);

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $pageTitle ?> - <?= $blogTitle ?></title>

        <meta name="description" content="<?= escape($content) ?>">

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

            <div class="container">
                
                <div class="content">
                    
                    <div class="meta">
                        <div class="flex" style="align-items: flex-end;">
                            <h1 class="title"><?= $pageTitle ?></h1>
                            <span class="flex-grow"></span>
                            <?php if($loggedIn && $_SESSION['username'] == $username) { ?>
                            <a href="<?= $rootUrl ?>new/?id=<?= escape($slug) ?>"><span class="material-icons icon btn">edit</span></a>
                            <?php } ?>
                        </div>
                        <div>
                            <div class="sub inline">
                                <span class="username">
                                    <span class="material-icons icon">account_circle</span><span id="username"><?= $username ?></span>
                                </span>
                                <span class="spacer"> • </span>
                                <span class="date">
                                    <span class="material-icons icon">calendar_today</span><span id="date"><?= formatDate($date, 'time') ?></span>
                                </span>
                            </div>
                            <?php if($tags[0] !== '' && $tags[0] !== null) { ?>
                            <div class="tags">
                                    <?php
                                    foreach ($tags as $tag) {
                                    echo '<span class="tag">'. escape($tag) .'</span>';
                                    }
                                    ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="main-text">
                    <?= nl2br2($content) ?>
                    </div>
                    
                </div>
                
            </div><!-- /container -->

        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>