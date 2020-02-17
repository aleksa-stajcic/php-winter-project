<?php 
	
require_once "../config/database.php";
require_once "../Models/DB.php";
$db = new DB();

header("Content-type: application/json");

$code = 404;
$data = null;

if(isset($_POST['send'])){
	$username = $_POST['username'];
    $password = md5($_POST['password']);
	$email = $_POST['email'];
	
	$errors = [];

    $re_password = "/^[A-z0-9]{6,20}$/";
	$re_username = "/^[A-z0-9\_]{4,15}$/";

    if(!$username){
        array_push($errors, "Username must be filled in.");
    }elseif(!preg_match($re_username, $username)){
        array_push($errors, "Username wrong format.");
    }

    if(!$_POST['password']){
        array_push($errors, "Password must be filled in.");
    }elseif(!preg_match($re_password, $_POST['password'])){
        array_push($errors, "Password wrong format.");
    }

    if(!$email){
        array_push($errors, "Email must be filled in.");
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email name wrong format.");
	}
	
	if(count($errors)){
        $code = 422;
        $data = $errors;
    }else{
		
		$query = "INSERT INTO users (email, username, password, role_id, token) VALUES (?, ?, ?, 2, ?)";

		$token = sha1(md5(time() . $email));

		$params = [
			$email,
			$username,
			$password,
			$token
		];

		try {
			$code = $db->execute_insert($query, $params) ? 201 : 500;
			$data = "Uspesno kreiran korisnik";
		} catch (\PDOException $ex) {
			$code = 409;
			$data = $ex->getMessage();
		}
	}

}

http_response_code($code); # xhr.status
echo json_encode($data); # xhr response