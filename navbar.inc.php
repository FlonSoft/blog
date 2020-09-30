        
        <nav class="nav">
            <div class="container flex">
                <a class="item logo noUnderline" tabindex="0" href="<?= $rootUrl ?>"><h1><?= $blogTitle ?></h1></a>
                <span class="flex-grow"></span>
<?php if($loggedIn) { ?>
                <a class="item nav-link dp-text " tabindex="0" href="<?= $rootUrl ?>new/" title="New post"><span class="material-icons">add</span></a>
                <span id="navPfpBtn" class="item nav-pfp" tabindex="0"><img src="<?= $_SESSION['pfp'] ?>" height="45px" alt="<?= $_SESSION['username'] ?>"></span>
<?php }else { ?>
                <a class="item nav-link <?php echo ($title == 'Sign in') ? 'active' : ''; ?>" tabindex="0" href="<?= $rootUrl ?>auth/"><span>Sign in</span></a>
 <?php } ?>
            </div>
        </nav>

        <div class="nav-height"></div>

<?php if($loggedIn) { ?>
        <div class="container pfp-dropdown-container">
            <nav id="navPfpDropdown" class="pfp-dropdown dropdown" style="display: none;">
                <div class="dropdown-item"><span class="dp-text"><b><?= $_SESSION['username'] ?></b></span></div>
                <div class="divider"></div>
                <div class="items">
                    <a class="dropdown-item" href="<?= $rootUrl ?>auth/?action=logout"><span class="dp-text"><span class="material-icons">exit_to_app</span>Sign out</span></a>
                </div>
            </nav>
        </div>
<?php } ?>
