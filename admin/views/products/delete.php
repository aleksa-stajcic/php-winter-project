<?php

$status_code = 404;
$data = null;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    header("Location: http://localhost/php1store/index.php");
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $data = $id;
    include "../../../modules/connection.php";

    $upit = $conn->prepare("DELETE FROM products WHERE id = :id;");
    $upit->bindParam(':id', $id);

    try{
        $rezultat = $upit->execute();

        if($rezultat){
            $status_code = 204;
        }else{
            $status_code = 500;
        }
    }catch(PDOException $e){
        $status_code = 500;
    }
}

json_encode($data);
http_response_code($status_code);
