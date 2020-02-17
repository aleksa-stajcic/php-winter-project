<?php

session_start();

require_once "../app/config/database.php";

if(!isset($_SESSION['korisnik'])){
    header("Location: " . SELF);
}

if($_SESSION['korisnik']->role_name != 'admin'){
    header("Location: " . SELF);
}

include "views/header.php";
include "views/nav.php";
include "views/panel.php";
include "views/footer.php";
