<?php

if(isset($_POST['btnInsert'])){

	// var_dump($_FILES);

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
	$msg = "";

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
            array_push($errors, "Invalid image type. (png, jpg, jpeg, gif)");
        }

        if($image_size > 3000000){
            array_push($errors, "Image is too large.");
        }

    }else{
        array_push($errors, "Image is required.");
    }

    if(count($errors) == 0){
        $ime_slike = time() . $image_name;

        $nova_putanja = '../app/assets/img/product/' . $ime_slike;

        $db_putanja = substr($nova_putanja, 14);


        if(move_uploaded_file($image_temp, $nova_putanja)){
            $upit_slika = "INSERT INTO products (name, brand_id, description, price, image, category_id)
                            VALUES (?, ?, ?, ?, ?, ?)";
			# jos specifikacije da se insertuju
			$info = [
				$name,
				$man,
				$desc,
				$price,
				$db_putanja,
				$cat
			];

            try{
                if($db->execute_insert($upit_slika, $info)){
                    header("Location: /admin/products.php");
                }
            }catch(PDOException $e){
                $msg = $e->getMessage();
            }

        }else{
            $msg = "Image upload failed.";
        }

    }else{
        $msg = "<ol>";
		foreach ($errors as $error) {
			$msg .= "<li>$error</li>";
		}
		$msg .= "</ol>";
    }
}

?>

<div class="container">
<h1 class="mt-4 mb-3">Admin&nbsp;<small>New product</small></h1>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
    <li class="breadcrumb-item active">New product</li>
    </ol>

    <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-12">
			<form action="<?= $_SERVER['PHP_SELF'] ?>?page=new" class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="mt-10">
					<input type="text" name="tbName" placeholder="Product name" class="single-input" value="">
				</div>
				<div class="mt-10">
					<textarea name="taDesc" id="taDesc" class="single-textarea" placeholder="Product description"></textarea>
				</div>
				<strong>Brand</strong>
				<div class="input-group-icon mt-10">
					<div class="icon"><i class="fa fa-user-tag" aria-hidden="true"></i></div>
					<div class="form-select" id="default-select">
						<select  name="ddlMan" id="ddlMan">
						<option value="0">Choose...</option>
							<?php
								$rezultat = $db->execute_query("SELECT * FROM brands");
								foreach ($rezultat as $b):
                        	?>
								<option value="<?= $b->id ?>"><?= $b->name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="mt-10">
					<input type="text" name="tbPrice" placeholder="Product price" class="single-input" value="">
				</div>
				<strong>Category</strong>
				<div class="input-group-icon mt-10">
					<div class="icon"><i class="fa fa-user-tag" aria-hidden="true"></i></div>
					<div class="form-select" id="default-select">
						<select  name="ddlCategory" id="ddlCategory">
						<option value="0">Choose...</option>
							<?php
								$rezultat = $db->execute_query("SELECT * FROM categories");
								foreach ($rezultat as $c):
                        	?>
								<option value="<?= $c->id ?>"><?= $c->name ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="mt-10">
				<strong>Product image</strong>
					<input type="file" name="fImage" placeholder="Product image" class="single-input" value="">
				</div>
				<br/>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-primary" type="submit" id="btnInsert" name="btnInsert">Insert new</button>
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