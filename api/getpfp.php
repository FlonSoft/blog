<?php
include('../global.inc.php');

// page //
header('Content-Type: application/json');
echo pfpFromEmail($_REQUEST['email']);