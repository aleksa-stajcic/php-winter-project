<?php

session_start();
require_once "../app/config/database.php";

if(!isset($_SESSION['user'])){
    header("Location: " . SELF);
}

if($_SESSION['user']->role != 'admin'){
    header("Location: " . SELF);
}

require_once "../app/Models/DB.php";
$db = new DB();

include "views/header.php";
include "views/nav.php";

$page = isset($_GET['page']) ? $_GET['page'] : null;

switch($page){
    case 'edit':
        include "views/products/edit.php";
        break;
    case 'new':
        include "views/products/new_product.php";
        break;
    default:
        $brojac = $db->execute_select_one("SELECT COUNT(*) as broj FROM products");

        $per_page = 4;
        $number_of_links = ceil($brojac->broj/$per_page);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
		$from = $per_page * ($page - 1);
		
        $query = "SELECT p.id,
                    p.name,
                    p.brand_id,
                    p.description AS descr,
                    p.price,
                    p.image,
                    p.category_id,
                    b.name AS man_name,
                    c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN brands b ON p.brand_id = b.id LIMIT $from, $per_page;";
        $products = $db->execute_query($query);
        include "views/products/index.php";    
}

include "views/footer.php";