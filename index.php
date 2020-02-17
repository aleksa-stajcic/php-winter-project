<?php
	session_start();

require_once "app/config/database.php";
require_once "app/Models/DB.php";
$db = new DB();

$page = '';

include "app/views/shared/head.php";
include "app/views/shared/nav.php";

if (isset($_GET['page'])) {
	$page = $_GET['page'];

	switch ($page) {
		case '':
			include "app/views/pages/home.php";
		break;
		case 'register':
			if(isset($_SESSION['user'])){
				include "app/views/pages/home.php";
			}else{
				include "app/views/pages/register.php";
			}
		break;
		case 'products':
			include "app/views/pages/products.php";
		break;
		case 'author':
			include "app/views/pages/author.php";
		break;
		case 'not-found':
			log_error_into_file("User at" . $_SERVER['REMOTE_ADDRESS']. " tried to access forbidden route.\t", 403, "../app/logs/error.log");
			include "app/views/pages/not_found.php";
		break;
		default:
			log_error_into_file("User at" . $_SERVER['REMOTE_ADDRESS'] . " tried to find non existant page.\t", 404, "../app/logs/error.log");
			include "app/views/pages/not_found.php";
	}
}else {
	include "app/views/pages/home.php";
}

include "app/views/shared/footer.php";