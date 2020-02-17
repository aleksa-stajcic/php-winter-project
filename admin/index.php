<?php

session_start();

require_once "../app/config/database.php";

if(!isset($_SESSION['user'])){
    header("Location: " . SELF);
}

if($_SESSION['user']->role != 'admin'){
    header("Location: " . SELF);
}

include "views/header.php";
include "views/nav.php";
include "views/panel.php";
include "views/footer.php";
