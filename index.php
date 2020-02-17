<?php

require_once "app/config/database.php";

include "app/views/shared/head.php";
include "app/views/shared/nav.php";

if(isset($_GET['page'])){
	switch ($_GET['page']) {
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
	}
}else{
	include "app/views/pages/home.php";
}

include "app/views/shared/footer.php";