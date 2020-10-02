<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

$pageTitle = 'Home';

$errorMsg = null;
$errorMsgType = 'red';

$results = getAllPosts($connection);
//$results = null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $pageTitle ?> - <?= $blogTitle ?></title>

        <meta name="description" content="<?= $blogDesc ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Styles -->
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>/css/default.css"/>
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>/css/global.css"/>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&amp;text=The%20Flolon%20Blog&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons&family=Roboto&family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css"/>
        
    </head>
    <body>

        <div class="pageHeight">

            <div class="top hero">
                            
                <?php include($rootDir.'/navbar.inc.php'); ?>

                <a class="noUnderline center logo white-text" href="https://flolon.cc"><h1><?= $blogTitle ?></h1></a>

            </div>
            
            <div class="container" style="margin-top: 2rem;">

                <?php
                if($results[0] == null) {
                    echo '<div class="card error light">No posts yet</div>';
                }else {

                    foreach ($results as $row) {
                ?>
                        
                        <a class="post-card" href="./post/?id=<?= escape($row['slug']) ?>" tabindex="0">	
                            <div class="card">
                                <h2 class="title"><?= escape($row['title']) ?></h2>
                                <div class="sub inline">
                                    <span class="date">
                                        <span class="material-icons icon">calendar_today</span><span><?= formatDate($row['date']) ?></span>
                                    </span>
                                    <?php if($row['tags'] !== '' && $row['tags'] !== null) { ?>
                                    <span class="spacer"> • </span>
                                    <!-- <span class="username">
                                        <span class="material-icons icon">account_circle</span><span><?= escape($row['username']) ?></span>
                                    </span>
                                    <span class="spacer"> • </span> -->
                                    <span class="tags">
                                        <?php
                                        $tags = explode( ', ', $row['tags']);
                                        foreach ($tags as $tag) {
                                            echo '<span class="tag dark">'. escape($tag) .'</span>';
                                        }
                                        ?>
                                    </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>

                <?php
                    }
                }
                ?>
                
            </div><!-- /container -->

        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>