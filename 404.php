<?php

header("HTTP/1.0 404 Not Found");

include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include_once($rootDir.'/db.inc.php');

$title = 'Not Found! (Error 404)';

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>/images/logo.png">

        <title><?= $title ?> - <?= $blogTitle ?></title>

        <meta name="description" content="<?= $title ?> for <?= $blogTitle ?>">

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

        <div class="container" style="margin-top: 1.5rem;">
            
            <div class="content" style="margin: 2rem 0 5rem 0; min-height: 73.75vh;">
                
                <div class="meta">
                    <h1 class="title"><?= $title ?></h1>
                </div>
                
                <div class="main-text">

                    <p>This resource does not exist</p>
                    <p><a class="link" href="<?= $rootUrl ?>">Home</a></p>


                </div>
                
            </div>
            
        </div><!-- /container -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>