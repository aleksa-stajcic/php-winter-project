<?php 

session_start();
require_once "app/config/database.php";
require_once "app/Models/DB.php";
$db = new DB();

http_response_code(200);

if (isset($_SESSION['user'])) {
	header("Location: " . SELF);
} else {
	if (isset($_POST['btnLogin'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$msg = "";


	
	try {
		$user = $db->execute_select_one('SELECT * FROM users WHERE username = ? AND password = ?', [$username, $password]);

		if($user){
			$_SESSION['user'] = $user;
		header("Location: " . SELF);

		}else{
			http_response_code(404);
			$msg = "User doesnt exist.";
		}
	} catch (\PDOException $ex) {
		$msg = $ex->getMessage();
	}
}
}

include "app/views/shared/head.php";
include "app/views/shared/nav.php";
include "app/views/pages/login.php";
include "app/views/shared/footer.php";