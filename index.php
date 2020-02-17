<?php

require_once "app/config/database.php";

require_once "app/Models/DB.php";

$db = new DB();

$page = '';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}

include "app/views/shared/head.php";
include "app/views/shared/nav.php";

switch ($page) {
	case 'login':
		include "app/views/pages/login.php";
	break;
	case 'register':
		include "app/views/pages/register.php";
	break;
	case 'products':
		include "app/views/pages/products.php";
	break;
	case 'author':
		include "app/views/pages/author.php";
	break;
	default:
		include "app/views/pages/home.php";
}

include "app/views/shared/footer.php";