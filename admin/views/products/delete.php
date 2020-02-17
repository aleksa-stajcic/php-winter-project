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
        }else{
        	$status_code = 500;
        }
    }catch(PDOException $e){
		$status_code = 501;
		$data = "obrisano";
    }
}

json_encode($data);
http_response_code($status_code);
