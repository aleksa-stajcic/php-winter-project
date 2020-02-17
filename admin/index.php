<?php

session_start();

require_once "../app/config/database.php";

if(!isset($_SESSION['user'])){
    http_response_code(404);
    header("Location: " . NOT_FOUND);
}

if($_SESSION['user']->role != 'admin'){
    http_response_code(404);
    header("Location: " . NOT_FOUND);
}

include "views/header.php";
include "views/nav.php";
include "views/panel.php";
include "views/footer.php";
