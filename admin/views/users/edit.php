<?php

if(!isset($_GET['id'])){
    header("Location: index.php");
}

require_once "../app/config/log_functions.php";

$id = $_GET['id'];

$query = "SELECT u.role_id,
                u.email,
                u.token,
                u.active,
                u.username,
                r.name as role_name
        FROM users u INNER JOIN roles r ON u.role_id = r.id
        WHERE u.token = ?;";

try{

	$user = $db->execute_select_one($query, [$id]);

    if($user){
        
        $email = $user->email;
        $username = $user->username;
        $role_name = $user->role_name;
        $role_id = $user->role_id;
        $id = $user->token;
        $active = intval($user->active);

    }else{
        echo 'Error';
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

if(isset($_POST['btnEdit'])){

    $edit_username = $_POST['username'];
    $edit_email = $_POST['email'];
    $edit_role = intval($_POST['ddlRole']);
    $edit_active = isset($_POST['chbActive']) ? $_POST['chbActive'] : false;
    $edit_id = $_POST['hiddenUserID'];

    $errors = [];

    $query = "UPDATE users
                SET username = ?,
                    email = ?,
                    active = ?,
                    role_id = ?
                WHERE token = ?;";

    try{
		$edit = $db->execute_update($query, [
					$edit_username,
					$edit_email,
					$edit_active,
					$edit_role,
					$edit_id
				]);
        if($edit){
			$msg = "User updated.";
			log_activity_into_file("Admin " . $_SESSION['user']->username . " updated user ". $_POST['username'] . "\t", '../app/logs/db.log');
        }else {
			$msg = "An error occured";
			log_error_into_file("Admin " . $_SESSION['user']->username . " tried to update user ". $_POST['username'] . ", an error occured.\t", 422, "../app/logs/db_errors.log");
        }
    }catch(PDOException $e){
		$msg = $e->getMessage();
		log_error_into_file("Admin " . $_SESSION['user']->username . " tried to update user ". $_POST['username'] . ", an error occured.\t", 422, "../app/logs/db_errors.log");
		
    }
}

?>

<div class="container">
<h1 class="mt-4 mb-3">Edit</h1>
    
<div class="row">
	<div class="col-lg-10">
		<form action="<?= $_SERVER['PHP_SELF'] ?>?page=edit&id=<?= $id ?>" class="form-horizontal" method="post">
			<div class="mt-10">
				<input type="text" name="username" placeholder="Username" class="single-input" value="<?= $username ?>">
				<p class="breadcrumb-item active">Username can contain any letters or numbers, without spaces.</p>
			</div>
			<div class="mt-10">
				<input type="email" name="email" placeholder="Email address" class="single-input" value="<?= $email ?>">
				<p class="breadcrumb-item active">Please provide your E-mail.</p>
			</div>
			<div class="input-group-icon mt-10">
				<div class="icon"><i class="fa fa-user-tag" aria-hidden="true"></i></div>
				<div class="form-select" id="default-select">
					<select  name="ddlRole" id="ddlRole">
					<option value="0">Choose...</option>
						<?php
							$rezultat_uloge = $db->execute_query("SELECT * FROM roles");

							foreach($rezultat_uloge as $uloga):
						?>
							<option <?= $uloga->id == $role_id ? "selected" : "" ?> value="<?= $uloga->id ?>"><?= $uloga->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="mt-10">
				<strong>Active user</strong>
				<div class="">
					<input type="hidden" id="hiddenUserID" name="hiddenUserID" value="<?= $id ?>">
					<input type="checkbox" name="chbActive" id="chbActive" <?= $active == 1 ? "checked" : "" ?> value="<?= $active ?>" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button class="btn btn-primary" type="submit" id="btnEdit" name="btnEdit">Update</button>
				</div>
				<div id="feedback" class="text-danger">
				<?php if(isset($msg)): ?>
				<?= $msg ?>
				<?php endif; ?>
				</div>
			</div>
		</form>
	</div>
    </div>
</div>