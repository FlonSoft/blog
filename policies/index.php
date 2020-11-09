<?php

$rootDir = $rootAssetUrl = '../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

$pageTitle = 'Privacy & Terms';

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <link rel="icon" type="image/png" href="<?= $rootAssetUrl ?>images/logo.png">

        <title><?= $pageTitle ?> - <?= $blogTitle ?></title>

        <meta name="description" content="<?= $pageTitle ?> for <?= $blogTitle ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Styles -->
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>css/default.css"/>
        <link rel="stylesheet" href="<?= $rootAssetUrl ?>css/global.css"/>
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
                    
                    <div class="meta">
                        <h1 class="title"><?= $pageTitle ?></h1>
                    </div>
                    
                    <div class="main-text">

                        <h2>Privacy Policy</h2>
                        <p>Explains what information we collect and why, how we use it, and how to review and update it.</p>
                        <a class="link primary" href="./privacy/">Read our Privacy Policy</a>


                    </div>
                    
                </div>
                
            </div><!-- /container -->
        
        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>