<?php

$status_code = 404;
$data = null;
require_once "../app/config/log_functions.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    header("Location: http://localhost/php1store/index.php");
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $data = $id;
    include "../../../modules/connection.php";

    $upit = $conn->prepare("DELETE FROM users WHERE token = :id;");
    $upit->bindParam(':id', $id);

    try{
        $rezultat = $upit->execute();

        if($rezultat){
			$status_code = 204;
			log_activity_into_file("Admin " . $_SESSION['user']->username . " deleted user ". $_POST['username'] . "\t", '../app/logs/db.log');
        }else{
			$status_code = 500;
			log_error_into_file("Admin " . $_SESSION['user']->username . " tried to delete user ". $_POST['username'] . ", an error occured.\t", $status_code, "../app/logs/db_errors.log");
        }
    }catch(PDOException $e){
		$status_code = 500;
		log_error_into_file("Admin " . $_SESSION['user']->username . " tried to delete user ". $_POST['username'] . ", an error occured.\t", $status_code, "../app/logs/db_errors.log");
		
    }
}

json_encode($data);
http_response_code($status_code);
