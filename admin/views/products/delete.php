<?php

$status_code = 404;
$data = null;

require_once "../../../app/config/database.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    header("Location: " . SELF);
}

require_once "../../../app/Models/DB.php";
$db = new DB();

if(isset($_POST['id'])){
    $id = $_POST['id'];
	$data = $id;
	
	$query = "DELETE FROM products WHERE id = $id;";

    try{
		$delete = $db->execute_delete($query);
        if($delete){
			$status_code = 204;
			log_activity_into_file("Admin " . $_SESSION['user']->username . "deleted product with id: ". $_POST['id'] . ".\t", "../app/logs/db.log");
        }else{
			$status_code = 500;
			log_error_into_file("Admin " . $_SESSION['user']->username . " tried to delete product with id: ". $_POST['id'] . ", an error occured.\t", $status_code, "../app/logs/db_errors.log");
			
        }
    }catch(PDOException $e){
		$status_code = 501;
		log_error_into_file("Admin " . $_SESSION['user']->username . " tried to delete product with id: ". $_POST['id'] . ", an error occured.\t", $status_code, "../app/logs/db_errors.log");
    }
}

json_encode($data);
http_response_code($status_code);
