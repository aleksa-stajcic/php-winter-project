<?php

session_start();

include "../app/config/database.php";

if(!isset($_SESSION['korisnik'])){
    header("Location: " . SELF);
}

if($_SESSION['korisnik']->role_name != 'admin'){
    header("Location: " . SELF);
}

include "../views/header.php";
include "../views/nav.php";

$page = isset($_GET['page']) ? $_GET['page'] : null;

switch($page){
    case 'edit':
        include "../views/products/edit.php";
        break;
    case 'new':
        include "../views/products/new_product.php";
        break;
    default:
        $query = "SELECT COUNT(*) as brojac FROM products";
        $obj = $conn->query($query)->fetch();
        $per_page = 5;
        $number_of_links = ceil($obj->brojac/$per_page);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $from = $per_page * ($page - 1);
        $query = "SELECT p.id,
                    p.name,
                    p.man_id,
                    p.description AS descr,
                    p.price,
                    p.image,
                    p.category_id,
                    m.name AS man_name,
                    c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN manufacturers m ON p.man_id = m.id LIMIT $from, $per_page;";
        $products = $conn->query($query)->fetchAll();
        include "../views/products/index.php";    
}

include "../views/footer.php";