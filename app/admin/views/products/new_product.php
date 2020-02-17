<?php

if(isset($_POST['btnInsert'])){

    include "../modules/connection.php";

    $name = $_POST['tbName'];
    $desc = $_POST['taDesc'];
    $man = $_POST['ddlMan'];
    $price = $_POST['tbPrice'];
    $cat = $_POST['ddlCategory'];
    $image = $_FILES['fImage'];

    $image_name = $image['name'];
    $image_temp = $image['tmp_name'];
    $image_size = $image['size'];

    $re_name = "/^[A-Z0-9][a-z0-9\-\s]{2,}[A-z0-9\-\s]{1,}$/";
    $re_desc = "/^[A-Z][a-z\-0-9\s\.\!\?]{1,}$/";
    $re_price = "/^[0-9][0-9\.]{1,}$/";

    $errors = [];

    if(!preg_match($re_name, $name)){
        array_push($errors, "Name");
    }
    if(!preg_match($re_desc, $desc)){
        array_push($errors, "Desc");
    }
    if(!preg_match($re_price, $price)){
        array_push($errors, "Price");
    }
    if($man == 0){
        array_push($errors, 'Manufacturer');
    }
    if($cat == 0){
        array_push($errors, 'Category');
    }

    if($image != null){
        $allowed_formats = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

        if(!in_array($image['type'], $allowed_formats)){
            array_push($errors, "Type.");
        }

        if($image_size > 3000000){
            array_push($errors, "Size.");
        }

        

    }else{
        array_push($errors, "moarte staviti sliku");
    }

    if(count($errors) == 0){
        $ime_slike = time() . $image_name;

        $nova_putanja = '../products/' . $ime_slike;

        $db_putanja = substr($nova_putanja, 3);


        if(move_uploaded_file($image_temp, $nova_putanja)){
            $upit_slika = "INSERT INTO products (name, man_id, description, price, image, category_id)
                            VALUES (:name, :man_id, :desc, :price, :slika, :cat)";
            $priprema_slika = $conn->prepare($upit_slika);

            $priprema_slika->bindParam(':name', $name);
            $priprema_slika->bindParam(':slika', $nova_putanja);
            $priprema_slika->bindParam(':man_id', $man);
            $priprema_slika->bindParam(':desc', $desc);
            $priprema_slika->bindParam(':price', $price);
            $priprema_slika->bindParam(':slika', $db_putanja);
            $priprema_slika->bindParam(':cat', $cat);


            try{
                if($priprema_slika->execute()){
                    header('Location: products.php');
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }

        }else{
            echo "image upload failed.";
        }

    }else{
        echo "<ol>";

		foreach ($errors as $error) {
			echo "<li>$error</li>";
		}

		echo "</ol>";
    }

}

?>

<div class="container">
<h1 class="mt-4 mb-3">Admin<small>New product</small></h1>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
    <li class="breadcrumb-item active">New product</li>
    </ol>

    <!-- Intro Content -->
    <div class="row">
        <div id="larry">
            <form action="<?= $_SERVER['PHP_SELF'] ?>?page=new" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="">
                    <strong>Name</strong>
                    <div class="">
                        <input type="text" name="tbName" id="tbName" placeholder="" class="form-control">
                        <p class="breadcrumb-item active">Name of the new product.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Description</strong>
                    <div class="">
                        <textarea name="taDesc" id="taDesc" rows="5" class="form-control"></textarea>
                        <p class="breadcrumb-item active">Description of the new product.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Manufacturer</strong>
                    <div class="">
                        <?php
                            $upit_man = "SELECT * FROM manufacturers";
                            $rezultat = $conn->query($upit_man)->fetchAll();
                        ?>
                        <select name="ddlMan" id="ddlMan" class="form-control">
                            <option value="0">Choose...</option>

                            <?php foreach($rezultat as $m): ?>
                            <option value="<?= $m->id ?>"><?= $m->name ?></option>
                            <?php endforeach; ?>

                        </select>
                        <p class="breadcrumb-item active">Manufacturer of the new product.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Price</strong>
                    <div class="">
                        <input type="text" id="tbPrice" name="tbPrice" placeholder="" class="form-control">
                        <p class="breadcrumb-item active">Price of the new product.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Category</strong>
                    <div class="">
                        <?php
                            $upit_cat = "SELECT * FROM categories";

                            $rezultat = $conn->query($upit_cat)->fetchAll();

                            
                        ?>
                        <select name="ddlCategory" id="ddlCategory" class="form-control">
                            <option value="0">Choose...</option>

                            <?php foreach($rezultat as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="breadcrumb-item active">Category of the new product.</p>
                    </div>
                </div>
                <div class="">
                    <strong>Image</strong>
                    <div class="">
                        <input type="file" id="fImage" name="fImage" placeholder="" class="form-control">
                        <p class="breadcrumb-item active">Product image.</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit" id="btnInsert" name="btnInsert">Insert new</button>
                    </div>
                    <div id="feedback" class="text-danger">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>