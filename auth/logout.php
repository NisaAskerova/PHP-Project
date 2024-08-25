<?php
include_once "../index.php";
$_SESSION=[];
session_destroy();

view(route('auth/register.php'));