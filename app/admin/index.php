<?php

session_start();

// if(!isset($_SESSION['korisnik'])){
//     header("Location: ../index.php");
// }

// if($_SESSION['korisnik']->role_name != 'admin'){
//     header("Location: ../index.php");
// }

// include "modules/functions.php";
include "views/header.php";
include "views/nav.php";
include "views/panel.php";
include "views/footer.php";
