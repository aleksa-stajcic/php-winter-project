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
			if(isset($_SESSION['korisnik'])){
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
		default:
			include "app/views/pages/not_found.php";
	}
}else {
	include "app/views/pages/home.php";
}

include "app/views/shared/footer.php";