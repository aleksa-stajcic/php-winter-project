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

require_once "../app/Models/DB.php";
$db = new DB();

include "views/header.php";
include "views/nav.php";

$page = isset($_GET['page']) ? $_GET['page'] : null;

switch($page){
    case 'edit':
        include "views/users/edit.php";
        break;
    default:
        $brojac = $db->execute_select_one("SELECT COUNT(*) as broj FROM users");

        $per_page = 3;
        $number_of_links = ceil($brojac->broj/$per_page);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
		$from = $per_page * ($page - 1);
		
        $query = "SELECT u.id,
                    u.email,
                    u.username,
                    u.role_id,
                    u.token,
					r.name FROM users u INNER JOIN roles r ON u.role_id = r.id LIMIT $from, $per_page;";	
        $users = $db->execute_query($query);
        include "views/users/index.php";
}

include "views/footer.php";