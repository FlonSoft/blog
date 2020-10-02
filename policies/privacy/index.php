<?php

$rootDir = $rootAssetUrl = '../../';
include_once($_SERVER['DOCUMENT_ROOT'].'/global.inc.php');
include($rootDir.'/db.inc.php');

$title = 'Privacy Policy';

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

        <div class="pageHeight">

            <?php include($rootDir.'/navbar.inc.php'); ?>

            <div class="container" style="margin-top: 2rem;">

                <div class="content">
                    
                    <div class="meta">
                        <div><a class="link" href="../">Privacy & Terms</a></div>
                        <h1 class="title" style="margin: .75rem 0 .75rem 0;"><?= $title ?></h1>
                        <div style="color: rgba(255, 255, 255, 0.9)"><i>Updated 09/17/2020</i></div>
                    </div>
                    
                    <div class="main-text">

                        <p>This Privacy Policy document contains types of information that are collected and recorded by Flolon Blog (accessible at https://blog.flolon.cc) and how we use it.</p>
                        <p>You means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>

                        <p>If you have additional questions or require more information about our Privacy Policy, please contact us at admin@flolon.cc.</p>

                        <h2>Consent</h2>

                        <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                        <h2>Information we collect</h2>

                        <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                        <p>When you create an account, we collect your username, password, name (if provided), email address, and other information. If you create posts and comments, they will be stored with your username and the time they were created. If you edit your profile to add a "bio" it will be collected. Your IP address may be collected as part of standard server logs.
                        </p>

                        <h2>How we use your information</h2>

                        <p>We use the information we collect in various ways, including to:</p>

                        <ul>
                        <li>Provide, operate, and maintain our webste</li>
                        <li>Improve, personalize, and expand our webste</li>
                        <li>Understand and analyze how you use our webste</li>
                        <li>Develop new products, services, features, and functionality</li>
                        <li>Communicate with you, either directly or through one of our partners, including for customer service, and to provide you with updates and other information relating to the webste</li>
                        <li>Send you emails (such as password resets)</li>
                        <li>Find and prevent fraud</li>
                        </ul>

                        <h2>Log Files</h2>

                        <p>Flolon Blog follows a standard procedure of using log files. The information collected by log files includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, and referring/exit pages. These are not linked to any personally identifiable information. The purpose of the information is for analyzing trends and administering the site.</p>

                        <h2>Cookies</h2>

                        <p>Like any other website, Flolon Blog uses 'cookies'. You can instruct your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if you do not accept Cookies, you may not be able to use some parts of Flolon Blog. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

                        <p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/" target="_blank">"What Are Cookies"</a>.</p>

                        <h2>Third Party Privacy Policies</h2>

                        <p>Flolon Blog's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

                        <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

                        <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                        <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
                        <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
                        <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
                        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                        <h2>GDPR Data Protection Rights</h2>

                        <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                        <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                        <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
                        <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
                        <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                        <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
                        <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                        <h2>Children's Information</h2>

                        <p>Flolon Blog does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
                                        
                    </div>
                    
                </div>
                
            </div><!-- /container -->

        </div><!-- /pageHeight -->

        <?php include($rootDir.'/footer.inc.php'); ?>

    </body>
</html>