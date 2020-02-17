<?php

if(!isset($_GET['id'])){
    header("Location: index.php");
}

$id = $_GET['id'];

$upit = "SELECT u.role_id,
                u.first_name,
                u.last_name,
                u.email,
                u.token,
                u.active,
                u.username,
                r.role_name
        FROM users u INNER JOIN roles r ON u.role_id = r.id
        WHERE u.token = :id;";

$update = $conn->prepare($upit);

$update->bindParam(':id', $id);

try{
    $update->execute();

    $korisnik = $update->fetch();

    if($korisnik){
        $f_name = $korisnik->first_name;
        $l_name = $korisnik->last_name;
        $email = $korisnik->email;
        $username = $korisnik->username;
        $role_name = $korisnik->role_name;
        $role_id = $korisnik->role_id;
        $id = $korisnik->token;
        $active = intval($korisnik->active);

        // print_r($korisnik);
    }else{
        echo 'Error';
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

if(isset($_POST['btnEdit'])){

    $edit_first_name = $_POST['first_name'];
    $edit_last_name = $_POST['last_name'];
    $edit_username = $_POST['username'];
    $edit_email = $_POST['email'];
    $edit_role = intval($_POST['ddlRole']);
    $edit_active = isset($_POST['chbActive']) ? $_POST['chbActive'] : false;
    $edit_id = $_POST['hiddenUserID'];

    var_dump($edit_active);
    var_dump($edit_role);

    $errors = [];

    $query = "UPDATE users
                SET first_name = :first_name,
                    last_name = :last_name,
                    username = :username,
                    email = :email,
                    active = :active,
                    role_id = :role_id
                WHERE token = :token;";

    $edit = $conn->prepare($query);

    $edit->bindParam(':first_name', $edit_first_name);
    $edit->bindParam(':last_name', $edit_last_name);
    $edit->bindParam(':username', $edit_username);
    $edit->bindParam(':email', $edit_email);
    $edit->bindParam(':role_id', $edit_role);
    $edit->bindParam(':active', $edit_active);
    $edit->bindParam(':token', $edit_id);

    try{
        if($edit->execute())
            // header("Location: users.php");
            echo "Yeet";
        else {
            echo "nein";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>

<div class="container">
<h1 class="mt-4 mb-3">Edit</h1>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active">User Edit</li>
    </ol>
    <div class="row">
        <div id="larry">
            <form action="<?= $_SERVER['PHP_SELF'] ?>?page=edit&id=<?= $id ?>" class="form-horizontal" method="post">
                <div class="">
                    <strong>First Name</strong>
                    <div class="">
                        <input type="text" id="first_name" name="first_name" placeholder="" class="form-control" value="<?= $f_name ?>">
                        <p class="breadcrumb-item active">First name must start uppercase, person can have multiple first names.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Last Name</strong>
                    <div class="">
                        <input type="text" id="last_name" name="last_name" placeholder="" class="form-control" value="<?= $l_name ?>">
                        <p class="breadcrumb-item active">Last name must start uppercase, person can have multiple first names.</p>
                    </div>
                </div>
                <div class="">
                    <strong>E-mail</strong>
                    <div class="">
                        <input type="text" id="email" name="email" placeholder="" class="form-control" value="<?= $email ?>">
                        <p class="breadcrumb-item active">Please provide your E-mail.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Username</strong>
                    <div class="">
                        <input type="text" id="username" name="username" placeholder="" class="form-control" value="<?= $username ?>">
                        <p class="breadcrumb-item active">Username can contain any letters or numbers, without spaces.</p>
                    </div>
                </div>
                <div>
                    <strong>Role</strong>
                    <div class="">
                        <select name="ddlRole" id="ddlRole" class="form-control">
                            <option value="0">Choose...</option>
                            <?php
                                $rezultat_uloge = $conn->query("SELECT * FROM roles")->fetchAll();

                                foreach($rezultat_uloge as $uloga):
                            ?>
                                <option <?= $uloga->id == $role_id ? "selected" : "" ?> value="<?= $uloga->id ?>"><?= $uloga->role_name ?></option>

                            <?php endforeach; ?>
                        </select>
                        <p class="breadcrumb-item active">Username can contain any letters or numbers, without spaces.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Active user</strong>
                    <div class="">
                        <input type="hidden" id="hiddenUserID" name="hiddenUserID" value="<?= $id ?>">
					    <input type="checkbox" name="chbActive" id="chbActive" <?= $active == 1 ? "checked" : "" ?> value="<?= $active ?>" />
                        <p class="breadcrumb-item active">Username can contain any letters or numbers, without spaces.</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit" id="btnEdit" name="btnEdit">Update</button>
                    </div>
                    <div id="feedback" class="text-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>