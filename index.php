<?php
session_start();
ob_start();
require_once 'config/database.php';
require_once 'helper/helper.php';
$userAuthCheck = auth();
$user_profile = getUserDetails($connection);
require_once 'head.php';
include_once 'navbar.php';