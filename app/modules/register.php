<?php 
	
	require_once "app/config/database.php";
	require_once "app/Models/DB.php";
	$db = new DB();

	include "app/views/shared/head.php";
	include "app/views/shared/nav.php";

?>

<?php include "app/views/shared/footer.php";